<?php

declare(strict_types=1);

namespace StarterTeam\Starter\Events\Listener;

use StarterTeam\Starter\Utility\ConfigurationUtility;
use TYPO3\CMS\Backend\View\Event\ModifyDatabaseQueryForContentEvent;

/**
 * Event for PageLayoutView to hide tt_content elements in page view
 */
final readonly class ModifyDatabaseQueryForContentEventListener
{
    public function modify(ModifyDatabaseQueryForContentEvent $event): void
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
