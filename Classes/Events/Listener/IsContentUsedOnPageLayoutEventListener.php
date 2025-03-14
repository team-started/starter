<?php

declare(strict_types=1);

namespace StarterTeam\Starter\Events\Listener;

use StarterTeam\Starter\Utility\ConfigurationUtility;
use TYPO3\CMS\Backend\View\Event\IsContentUsedOnPageLayoutEvent;

/**
 * Event for PageLayoutView to mark content elements with colPos 1705 as render
 */
final class IsContentUsedOnPageLayoutEventListener
{
    public function __invoke(IsContentUsedOnPageLayoutEvent $event): void
    {
        $record = $event->getRecord();
        if (array_key_exists('colPos', $record)
            && $record['colPos'] === ConfigurationUtility::getColPosForStarterColumnElement()
        ) {
            $event->setUsed(true);
        }
    }
}
