<?php
namespace StarterTeam\Starter\Utility;

/**
 * Class ObjectUtility
 */
class ObjectUtility extends AbstractUtility
{
    /**
     * @return object|\TYPO3\CMS\Extbase\Object\ObjectManager
     */
    public static function getObjectManager()
    {
        return parent::getObjectManager();
    }

    /**
     * @return object|\TYPO3\CMS\Core\Page\PageRenderer
     */
    public static function getPageRenderer()
    {
        return parent::getPageRenderer();
    }

    /**
     * @return object|\TYPO3\CMS\Core\Database\ConnectionPool
     */
    public static function getConnectionPool()
    {
        return parent::getConnectionPool();
    }
}
