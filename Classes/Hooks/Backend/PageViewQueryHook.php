<?php

declare(strict_types=1);

namespace StarterTeam\Starter\Hooks\Backend;

use StarterTeam\Starter\Utility\ConfigurationUtility;
use TYPO3\CMS\Core\Database\Query\QueryBuilder;

/**
 * Class PageViewQueryHook
 */
class PageViewQueryHook
{
    /**
     * Prevent inline tt_content elements in EZVK relation elements from
     * showing in the page module.
     *
     * @param string[] $fieldList
     */
    public function modifyQuery(
        array $parameters,
        string $table,
        int $pageId,
        array $additionalConstraints,
        $fieldList,
        QueryBuilder $queryBuilder
    ): void {
        if ($table === 'tt_content' && $pageId > 0) {
            // Only hide elements which are inline, allowing for standard
            // elements to show
            $queryBuilder->andWhere(
                $queryBuilder->expr()->notIn(
                    'colPos',
                    [
                        ConfigurationUtility::$contentGridElementsColPos['tx_starter_column_element'],
                    ]
                )
            );
        }
    }
}
