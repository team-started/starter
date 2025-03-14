<?php

use TYPO3\CMS\Core\Utility\ExtensionManagementUtility;

defined('TYPO3') || die();

(function () {
    $showItem = [
        '--div--;LLL:EXT:core/Resources/Private/Language/Form/locallang_tabs.xlf:general',
        '--palette--;LLL:EXT:frontend/Resources/Private/Language/locallang_ttc.xlf:palette.general;general',
        '--palette--;LLL:EXT:frontend/Resources/Private/Language/locallang_ttc.xlf:palette.headers;headers',
        'tx_starter_carousel_element',
        '--div--;LLL:EXT:frontend/Resources/Private/Language/locallang_ttc.xlf:tabs.appearance',
        '--palette--;LLL:EXT:frontend/Resources/Private/Language/locallang_ttc.xlf:palette.frames;frames',
        '--palette--;LLL:EXT:frontend/Resources/Private/Language/locallang_ttc.xlf:palette.appearanceLinks;appearanceLinks',
        '--div--;LLL:EXT:core/Resources/Private/Language/Form/locallang_tabs.xlf:language',
        '--palette--;;language',
        '--div--;LLL:EXT:core/Resources/Private/Language/Form/locallang_tabs.xlf:access',
        '--palette--;;hidden',
        '--palette--;LLL:EXT:frontend/Resources/Private/Language/locallang_ttc.xlf:palette.access;access',
        '--div--;LLL:EXT:core/Resources/Private/Language/Form/locallang_tabs.xlf:notes',
        'rowDescription',
        '--div--;LLL:EXT:core/Resources/Private/Language/Form/locallang_tabs.xlf:extended',
    ];

    $GLOBALS['TCA']['tt_content']['types']['starter_carousel'] = [
        'showitem' => implode(',', $showItem),
    ];

    ExtensionManagementUtility::addPlugin(
        [
            'LLL:EXT:starter/Resources/Private/Language/locallang_be.xlf:CType.I.starter_carousel',
            'starter_carousel',
            'starter-ctype-starter_carousel',
        ],
        'CType',
        'starter'
    );
})();
