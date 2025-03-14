<?php

use TYPO3\CMS\Core\Utility\ExtensionManagementUtility;

defined('TYPO3') || die();

(function () {
    ExtensionManagementUtility::addStaticFile(
        'starter',
        'Configuration/TypoScript/',
        'StarterTeam - Starter'
    );
})();
