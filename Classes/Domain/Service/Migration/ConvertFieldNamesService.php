<?php

declare(strict_types=1);

namespace StarterTeam\Starter\Domain\Service\Migration;

use StarterTeam\Starter\Utility\ObjectUtility;
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

    /**
     * @var array
     */
    protected $tables = ['tt_content'];

    /**
     * @var array
     */
    protected $oldFieldNames = [
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

    /**
     * @var array
     */
    protected $newFieldNames = [
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

    /**
     * @var array
     */
    protected $sysFileReferenceValues = [
        'assets_medium' => 'tx_starter_assets_medium',
        'assets_large' => 'tx_starter_assets_large',
    ];

    /**
     * Checks whether updates are required.
     * @return bool
     * @throws \Doctrine\DBAL\DBALException
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
     * @return bool
     * @throws \Doctrine\DBAL\DBALException
     */
    public function executeUpdate(): bool
    {
        $this->migrateSysFileReference();
        return $this->copyOldFieldValuesToNewFieldValues();
    }

    /**
     * Check if new tables are not there OR
     * if they are there but they are still empty
     *
     * @return bool
     * @throws \Doctrine\DBAL\DBALException
     */
    protected function oldFieldsPrepared(): bool
    {
        return $this->areOldFieldsAlreadyExistingInTables();
    }

    /**
     * Check if one of the old fields already exists
     * Turn function off if dontCheckNewTables is set to true
     *
     * @return bool
     * @throws \Doctrine\DBAL\DBALException
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
     * @param string $table
     * @return bool
     * @throws \Doctrine\DBAL\DBALException
     */
    protected function areOldFieldsAlreadyExisting($table): bool
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
     * @param string $table
     * @param string $field
     * @return bool
     * @throws \Doctrine\DBAL\DBALException
     */
    protected function isFieldAlreadyExisting(string $table, string $field): bool
    {
        $allFields = $this->getAllFieldsOfTable($table);
        if (in_array($field, array_keys($allFields))) {
            return true;
        }
        return false;
    }

    /**
     * @return bool
     * @throws \Doctrine\DBAL\DBALException
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
     * @throws \Doctrine\DBAL\DBALException
     */
    protected function migrateSysFileReference()
    {
        $table = 'sys_file_reference';

        foreach ($this->sysFileReferenceValues as $searchValue => $replaceValue) {
            $queryBuilder = ObjectUtility::getConnectionPool()->getQueryBuilderForTable($table);
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
     * @param string $table
     * @param string $oldFieldName
     * @param string $newFieldName
     * @throws \Doctrine\DBAL\DBALException
     */
    protected function copyFieldData(string $table, string $oldFieldName, string $newFieldName)
    {
        $queryBuilder = ObjectUtility::getConnectionPool()->getQueryBuilderForTable($table);
        $queryBuilder
            ->update($table)
            ->set($newFieldName, $queryBuilder->quoteIdentifier($oldFieldName), false)
            ->execute();
        $this->alterTable($table, $oldFieldName);
    }

    /**
     * Rename the old field to zzz_deleted_FIELDNAME
     *
     * @param string $table
     * @param string $oldFieldName
     * @throws \Doctrine\DBAL\DBALException
     */
    protected function alterTable(string $table, string $oldFieldName)
    {
        $requiredChangeSetting = $this->getFieldInformation($table, $oldFieldName);
        $queryBuilder = ObjectUtility::getConnectionPool()->getConnectionByName('Default');
        $queryBuilder
            ->query(
                'ALTER TABLE ' . $table . ' CHANGE COLUMN
                ' . $oldFieldName . ' zzz_deleted_' . $oldFieldName . ' ' . $requiredChangeSetting . ';'
            );
    }

    /**
     * @param string $table
     * @param string $fieldName
     * @return string
     * @throws \Doctrine\DBAL\DBALException
     */
    protected function getFieldInformation(string $table, string $fieldName): string
    {
        $allFields = $this->getAllFieldsOfTable($table);

        if (in_array($fieldName, array_keys($allFields))) {
            $return = $allFields[$fieldName]['Type'] . ' ';
            $return .= strtolower($allFields[$fieldName]['Null']) === 'no' ? 'NOT NULL' : 'NULL';
            $return .= ' default "' . $allFields[$fieldName]['Default'] . '"';

            return $return;
        }

        return '';
    }

    /**
     * Returns information about each field in the $table
     *
     * @param string $table
     * @return array
     * @throws \Doctrine\DBAL\DBALException
     */
    protected function getAllFieldsOfTable(string $table): array
    {
        $allFields = [];
        $queryBuilder = ObjectUtility::getConnectionPool()->getConnectionByName('Default');
        $statement = $queryBuilder->query('SHOW FULL COLUMNS FROM ' . $table);
        while ($fieldRow = $statement->fetch()) {
            $allFields[$fieldRow['Field']] = $fieldRow;
        }
        return $allFields;
    }

    /**
     * Returns the list of tables from the default database.
     *
     * @return array
     * @throws \Doctrine\DBAL\DBALException
     */
    protected function getAllTables()
    {
        $allTables = [];
        $queryBuilder = ObjectUtility::getConnectionPool()->getConnectionByName('Default');
        $statement = $queryBuilder->query('SHOW TABLE STATUS FROM `' . $queryBuilder->getDatabase() . '`');
        while ($theTable = $statement->fetch()) {
            $allTables[$theTable['Name']] = $theTable;
        }
        return $allTables;
    }
}
