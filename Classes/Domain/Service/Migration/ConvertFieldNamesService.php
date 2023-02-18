<?php

declare(strict_types=1);

namespace StarterTeam\Starter\Domain\Service\Migration;

use Doctrine\DBAL\DBALException;
use TYPO3\CMS\Core\Database\ConnectionPool;
use TYPO3\CMS\Core\Utility\GeneralUtility;
use TYPO3\CMS\Install\Updates\DatabaseUpdatedPrerequisite;
use TYPO3\CMS\Install\Updates\UpgradeWizardInterface;

/**
 * Class ConvertFieldNamesService to concert old field names of previous versions
 */
class ConvertFieldNamesService implements UpgradeWizardInterface
{
    public function getIdentifier(): string
    {
        return 'starterFieldPrefixMigration';
    }

    public function getTitle(): string
    {
        return 'Execute database migrations on single rows for EXT:starter';
    }

    public function getDescription(): string
    {
        return 'Migrate old fields from EXT:starter without prefix to field with prefix "tx_starter_"';
    }

    protected array $tables = ['tt_content'];

    protected array $oldFieldNames = [
        'tt_content' => [
            'assets_medium',
            'assets_large',
            'media_size_small',
            'media_size_medium',
            'media_size_large',
            'imagecols_medium',
            'imagecols_large',
        ],
    ];

    protected array $newFieldNames = [
        'tt_content' => [
            'tx_starter_assets_medium',
            'tx_starter_assets_large',
            'tx_starter_media_size_small',
            'tx_starter_media_size_medium',
            'tx_starter_media_size_large',
            'tx_starter_imagecols_medium',
            'tx_starter_imagecols_large',
        ],
    ];

    protected array $sysFileReferenceValues = [
        'assets_medium' => 'tx_starter_assets_medium',
        'assets_large' => 'tx_starter_assets_large',
    ];

    /**
     * Checks whether updates are required.
     * @throws DBALException
     */
    public function updateNecessary(): bool
    {
        return $this->oldFieldsPrepared();
    }

    public function getPrerequisites(): array
    {
        return [
            DatabaseUpdatedPrerequisite::class,
        ];
    }

    /**
     * @throws DBALException
     */
    public function executeUpdate(): bool
    {
        $this->migrateSysFileReference();
        return $this->copyOldFieldValuesToNewFieldValues();
    }

    /**
     * Check if new tables are not there OR
     * if they are there, but they are still empty
     *
     * @throws DBALException
     */
    protected function oldFieldsPrepared(): bool
    {
        return $this->areOldFieldsAlreadyExistingInTables();
    }

    /**
     * Check if one of the old fields already exists
     * Turn function off if dontCheckNewTables is set to true
     *
     * @throws DBALException
     */
    protected function areOldFieldsAlreadyExistingInTables(): bool
    {
        $existingResult = false;
        $allTables = $this->getAllTables();
        foreach (array_keys($allTables) as $existingTable) {
            if (in_array($existingTable, $this->tables)) {
                $existingResult = $this->areOldFieldsAlreadyExisting($existingTable);
            }
        }

        return $existingResult;
    }

    /**
     * Check if one of the old fields already exists in given table
     *
     * @throws DBALException
     */
    protected function areOldFieldsAlreadyExisting(string $table): bool
    {
        $allFields = $this->getAllFieldsOfTable($table);
        foreach (array_keys($allFields) as $existingFields) {
            if (in_array($existingFields, $this->oldFieldNames[$table])) {
                return true;
            }
        }

        return false;
    }

    /**
     * Check if one of the new fields already exists in given table
     *
     * @throws DBALException
     */
    protected function isFieldAlreadyExisting(string $table, string $field): bool
    {
        $allFields = $this->getAllFieldsOfTable($table);
        return array_key_exists($field, $allFields);
    }

    /**
     * @throws DBALException
     */
    protected function copyOldFieldValuesToNewFieldValues(): bool
    {
        foreach ($this->tables as $table) {
            foreach (array_keys($this->oldFieldNames[$table]) as $key) {
                $oldFieldName = $this->oldFieldNames[$table][$key];
                $newFieldName = $this->newFieldNames[$table][$key];

                if ($this->isFieldAlreadyExisting($table, $oldFieldName) &&
                    $this->isFieldAlreadyExisting($table, $newFieldName)
                ) {
                    $this->copyFieldData($table, $oldFieldName, $newFieldName);
                }
            }
        }

        return true;
    }

    /**
     * @throws DBALException
     */
    protected function migrateSysFileReference(): void
    {
        $table = 'sys_file_reference';

        foreach ($this->sysFileReferenceValues as $searchValue => $replaceValue) {
            $queryBuilder = GeneralUtility::makeInstance(ConnectionPool::class)->getQueryBuilderForTable($table);
            $queryBuilder
                ->update($table)
                ->where(
                    $queryBuilder->expr()->eq('fieldname', $queryBuilder->createNamedParameter($searchValue))
                )
                ->set('fieldname', $replaceValue)
                ->execute();
        }
    }

    /**
     * Copy the value from old field to the new field
     *
     * @throws DBALException
     */
    protected function copyFieldData(string $table, string $oldFieldName, string $newFieldName): void
    {
        $queryBuilder = GeneralUtility::makeInstance(ConnectionPool::class)->getQueryBuilderForTable($table);
        $queryBuilder
            ->update($table)
            ->set($newFieldName, $queryBuilder->quoteIdentifier($oldFieldName), false)
            ->execute();
        $this->alterTable($table, $oldFieldName);
    }

    /**
     * Rename the old field to zzz_deleted_FIELDNAME
     *
     * @throws DBALException
     */
    protected function alterTable(string $table, string $oldFieldName): void
    {
        $requiredChangeSetting = $this->getFieldInformation($table, $oldFieldName);
        $queryBuilder = GeneralUtility::makeInstance(ConnectionPool::class)->getConnectionByName('Default');
        $queryBuilder
            ->query(
                'ALTER TABLE ' . $table . ' CHANGE COLUMN
                ' . $oldFieldName . ' zzz_deleted_' . $oldFieldName . ' ' . $requiredChangeSetting . ';'
            );
    }

    /**
     * @throws DBALException
     */
    protected function getFieldInformation(string $table, string $fieldName): string
    {
        $allFields = $this->getAllFieldsOfTable($table);

        if (array_key_exists($fieldName, $allFields)) {
            $return = $allFields[$fieldName]['Type'] . ' ';
            $return .= strtolower($allFields[$fieldName]['Null']) === 'no' ? 'NOT NULL' : 'NULL';

            return $return . (' default "' . $allFields[$fieldName]['Default'] . '"');
        }

        return '';
    }

    /**
     * Returns information about each field in the $table
     *
     * @throws DBALException
     */
    protected function getAllFieldsOfTable(string $table): array
    {
        $allFields = [];
        $queryBuilder = GeneralUtility::makeInstance(ConnectionPool::class)->getConnectionByName('Default');
        $statement = $queryBuilder->query('SHOW FULL COLUMNS FROM ' . $table);
        while ($fieldRow = $statement->fetch()) {
            if (is_array($fieldRow) && array_key_exists('Field', $fieldRow)) {
                $allFields[$fieldRow['Field']] = $fieldRow;
            }
        }

        return $allFields;
    }

    /**
     * Returns the list of tables from the default database.
     *
     * @throws DBALException
     */
    protected function getAllTables(): array
    {
        $allTables = [];
        $queryBuilder = GeneralUtility::makeInstance(ConnectionPool::class)->getConnectionByName('Default');
        $statement = $queryBuilder->query('SHOW TABLE STATUS FROM `' . $queryBuilder->getDatabase() . '`');
        while ($theTable = $statement->fetch()) {
            if (is_array($theTable) && array_key_exists('Name', $theTable)) {
                $allTables[$theTable['Name']] = $theTable;
            }
        }

        return $allTables;
    }
}
