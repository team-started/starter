<?php

declare(strict_types=1);

namespace StarterTeam\Starter\Updates;

use Override;
use TYPO3\CMS\Core\Database\Connection;
use TYPO3\CMS\Core\Database\ConnectionPool;
use TYPO3\CMS\Core\Database\Query\Restriction\DeletedRestriction;
use TYPO3\CMS\Core\Utility\GeneralUtility;
use TYPO3\CMS\Install\Attribute\UpgradeWizard;
use TYPO3\CMS\Install\Updates\DatabaseUpdatedPrerequisite;
use TYPO3\CMS\Install\Updates\UpgradeWizardInterface;

#[UpgradeWizard('txStarterCTypeUpdater')]
class CTypeUpdater implements UpgradeWizardInterface
{
    private const array MIGRATION_SETTINGS = [
        [
            'oldCType' => 'starter_download',
            'newCType' => 'starter_m27_download',
        ],
    ];

    #[Override]
    public function getTitle(): string
    {
        return 'Update CTypes of EXT:starter';
    }

    #[Override]
    public function getDescription(): string
    {
        $description = 'This update wizard migrates all existing CTypes of EXT:starter';
        $description .= 'to use the new available CTypes. Count of CTypes: ' . count($this->getMigrationRecords());
        return $description;
    }

    #[Override]
    public function executeUpdate(): bool
    {
        return $this->performMigration();
    }

    #[Override]
    public function updateNecessary(): bool
    {
        return $this->checkIfWizardIsRequired();
    }

    #[Override]
    public function getPrerequisites(): array
    {
        return [
            DatabaseUpdatedPrerequisite::class,
        ];
    }

    protected function performMigration(): bool
    {
        $records = $this->getMigrationRecords();

        foreach ($records as $record) {
            $targetCType = $this->getTargetListType($record['CType']);
            if ($targetCType === '') {
                continue;
            }

            $this->updateContentElement($record['uid'], $targetCType);
        }

        return true;
    }

    protected function getTargetListType(string $oldCType): string
    {
        foreach (self::MIGRATION_SETTINGS as $setting) {
            if ($setting['oldCType'] === $oldCType) {
                return $setting['newCType'];
            }
        }

        return '';
    }

    protected function updateContentElement(int $uid, string $newCType): void
    {
        $queryBuilder = GeneralUtility::makeInstance(ConnectionPool::class)
            ->getQueryBuilderForTable('tt_content');
        $queryBuilder->update('tt_content')
            ->set('CType', $newCType)
            ->where(
                $queryBuilder->expr()->in(
                    'uid',
                    $queryBuilder->createNamedParameter($uid, Connection::PARAM_INT)
                )
            )
            ->executeStatement();
    }

    protected function checkIfWizardIsRequired(): bool
    {
        return count($this->getMigrationRecords()) > 0;
    }

    protected function getMigrationRecords(): array
    {
        $connectionPool = GeneralUtility::makeInstance(ConnectionPool::class);
        $queryBuilder = $connectionPool->getQueryBuilderForTable('tt_content');
        $queryBuilder
            ->getRestrictions()
            ->removeAll()
            ->add(GeneralUtility::makeInstance(DeletedRestriction::class));

        $expressionBuilder = $queryBuilder->expr();
        $whereExpressions = $expressionBuilder->or();
        foreach (self::MIGRATION_SETTINGS as $setting) {
            $whereExpressions = $whereExpressions->with(
                $expressionBuilder->eq(
                    'CType',
                    $queryBuilder->createNamedParameter($setting['oldCType'])
                )
            );
        }

        return $queryBuilder
            ->select('uid', 'pid', 'CType')
            ->from('tt_content')
            ->where($whereExpressions)
            ->executeQuery()
            ->fetchAllAssociative();
    }
}
