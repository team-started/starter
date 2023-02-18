<?php

declare(strict_types=1);

namespace StarterTeam\Starter\Utility;

use TYPO3\CMS\Core\Database\ConnectionPool;
use TYPO3\CMS\Core\Page\PageRenderer;
use TYPO3\CMS\Core\Utility\GeneralUtility;
use TYPO3\CMS\Extbase\Object\ObjectManager;

/**
 * Class AbstractUtility
 */
abstract class AbstractUtility
{
    public static function getObjectManager(): ObjectManager
    {
        return GeneralUtility::makeInstance(ObjectManager::class);
    }

    public static function getPageRenderer(): PageRenderer
    {
        return self::getObjectManager()->get(PageRenderer::class);
    }

    public static function getConnectionPool(): ConnectionPool
    {
        return self::getObjectManager()->get(ConnectionPool::class);
    }
}
