<?php

use StarterTeam\Starter\Configuration;
use TYPO3\CMS\Core\Utility\ExtensionManagementUtility;

defined('TYPO3') || die();

(function () {
    foreach (Configuration::getDefaultBackendLayouts() as $backendLayout) {
        ExtensionManagementUtility::registerPageTSConfigFile(
            'starter',
            'Configuration/TSConfig/BackendLayouts/' . $backendLayout . '.typoscript',
            'Backend-Layout ' . $backendLayout
        );
    }

    ExtensionManagementUtility::registerPageTSConfigFile(
        'starter',
        'Configuration/TSConfig/Main.typoscript',
        'Main page TS configuration'
    );

    ExtensionManagementUtility::registerPageTSConfigFile(
        'starter',
        'Configuration/TSConfig/CkEditor.typoscript',
        'CkEditor configuration'
    );
})();
