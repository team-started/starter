<?php

use TYPO3\CMS\Core\Utility\ExtensionManagementUtility;

defined('TYPO3') || die();

(function () {
    $translationFile = 'LLL:EXT:starter/Resources/Private/Language/locallang_be.xlf:';
    $cType = 'starter_distribution_navigation';

    $GLOBALS['TCA']['tt_content']['types'][$cType] = [
        'showitem' => '
        --div--;LLL:EXT:core/Resources/Private/Language/Form/locallang_tabs.xlf:general,
            --palette--;LLL:EXT:frontend/Resources/Private/Language/locallang_ttc.xlf:palette.general;general,
            header;LLL:EXT:frontend/Resources/Private/Language/locallang_ttc.xlf:header_formlabel,
        --div--;LLL:EXT:core/Resources/Private/Language/Form/locallang_tabs.xlf:language,
            --palette--;;language,
        --div--;LLL:EXT:core/Resources/Private/Language/Form/locallang_tabs.xlf:access,
            --palette--;;hidden,
            --palette--;LLL:EXT:frontend/Resources/Private/Language/locallang_ttc.xlf:palette.access;access,
        --div--;LLL:EXT:core/Resources/Private/Language/Form/locallang_tabs.xlf:notes,
            rowDescription,
        --div--;LLL:EXT:core/Resources/Private/Language/Form/locallang_tabs.xlf:extended,
    ',
    ];

    ExtensionManagementUtility::addPlugin(
        [
            $translationFile . 'CType.I.' . $cType,
            $cType,
            'starter-ctype-' . $cType,
        ],
        'CType',
        'starter'
    );
})();
