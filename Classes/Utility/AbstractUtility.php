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
    /**
     * @return object|\TYPO3\CMS\Extbase\Object\ObjectManager
     */
    protected static function getObjectManager()
    {
        return GeneralUtility::makeInstance(ObjectManager::class);
    }

    /**
     * @return object|\TYPO3\CMS\Core\Page\PageRenderer
     */
    protected static function getPageRenderer()
    {
        return self::getObjectManager()->get(PageRenderer::class);
    }

    /**
     * @return object|\TYPO3\CMS\Core\Database\ConnectionPool
     */
    protected static function getConnectionPool()
    {
        return self::getObjectManager()->get(ConnectionPool::class);
    }
}
