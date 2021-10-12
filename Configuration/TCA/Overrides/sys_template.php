<?php
defined('TYPO3_MODE') or die();

(function () {
    \TYPO3\CMS\Core\Utility\ExtensionManagementUtility::addStaticFile(
        'starter',
        'Configuration/TypoScript/',
        'StarterTeam - Starter'
    );
})();
