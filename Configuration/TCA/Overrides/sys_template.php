<?php

defined('TYPO3') or die();

(function () {
    \TYPO3\CMS\Core\Utility\ExtensionManagementUtility::addStaticFile(
        'starter',
        'Configuration/TypoScript/',
        'StarterTeam - Starter'
    );
})();
