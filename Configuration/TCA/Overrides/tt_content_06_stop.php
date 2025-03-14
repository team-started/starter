<?php

use TYPO3\CMS\Core\Utility\ExtensionManagementUtility;

defined('TYPO3') || die();

(function () {
    $showItem = [
        '--div--;LLL:EXT:core/Resources/Private/Language/Form/locallang_tabs.xlf:general',
        '--palette--;LLL:EXT:frontend/Resources/Private/Language/locallang_ttc.xlf:palette.general;general',
        'header;LLL:EXT:frontend/Resources/Private/Language/locallang_ttc.xlf:header.ALT.html_formlabel',
        '--div--;LLL:EXT:core/Resources/Private/Language/Form/locallang_tabs.xlf:language',
        '--palette--;;language',
        '--div--;LLL:EXT:core/Resources/Private/Language/Form/locallang_tabs.xlf:access',
        '--palette--;;hidden',
        '--palette--;LLL:EXT:frontend/Resources/Private/Language/locallang_ttc.xlf:palette.access;access',
        '--div--;LLL:EXT:core/Resources/Private/Language/Form/locallang_tabs.xlf:notes',
        'rowDescription',
    ];

    $GLOBALS['TCA']['tt_content']['types']['starter_stop'] = [
        'showitem' => implode(',', $showItem),
    ];

    ExtensionManagementUtility::addPlugin(
        [
            'LLL:EXT:starter/Resources/Private/Language/locallang_be.xlf:CType.I.starter_stop',
            'starter_stop',
            'starter-ctype-starter_stop',
        ],
        'CType',
        'starter'
    );
})();
