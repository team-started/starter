<?php

declare(strict_types=1);

namespace StarterTeam\Starter\Events\Listener;

use StarterTeam\Starter\Utility\ConfigurationUtility;
use TYPO3\CMS\Backend\View\Event\ModifyDatabaseQueryForRecordListingEvent;

/**
 * Event for ListLayoutView to hide tt_content elements in page view
 */
final readonly class ModifyDatabaseQueryForRecordListingEventListener
{
    public function modify(ModifyDatabaseQueryForRecordListingEvent $event): void
    {
        if ($event->getTable() === 'tt_content' && $event->getPageId() > 0) {
            $event->getQueryBuilder()->andWhere(
                $event->getQueryBuilder()->expr()->notIn(
                    'colPos',
                    [
                        ConfigurationUtility::getColPosForStarterColumnElement(),
                    ]
                )
            );
        }
    }
}
