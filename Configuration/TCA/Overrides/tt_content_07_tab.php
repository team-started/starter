<?php

use TYPO3\CMS\Core\Utility\ExtensionManagementUtility;

defined('TYPO3') || die();

(function () {
    ExtensionManagementUtility::addTCAcolumns(
        'tt_content',
        [
            'tx_starter_tab_element' => [
                'exclude' => 1,
                'label' => 'LLL:EXT:starter/Resources/Private/Language/locallang_be.xlf:tab_element_formlabel',
                'config' => [
                    'type' => 'inline',
                    'allowed' => 'tx_starter_tab_element',
                    'foreign_table' => 'tx_starter_tab_element',
                    'foreign_sortby' => 'sorting',
                    'foreign_field' => 'tt_content_tab',
                    'minitems' => 0,
                    'maxitems' => 99,
                    'behaviour' => [
                        'allowLanguageSynchronization' => true,
                    ],
                    'appearance' => [
                        'collapseAll' => true,
                        'expandSingle' => true,
                        'levelLinksPosition' => 'bottom',
                        'useSortable' => true,
                        'showPossibleLocalizationRecords' => true,
                        'showAllLocalizationLink' => true,
                        'showSynchronizationLink' => true,
                        'enabledControls' => [
                            'info' => false,
                        ],
                    ],
                ],
            ],
        ]
    );

    $showItem = [
        '--div--;LLL:EXT:core/Resources/Private/Language/Form/locallang_tabs.xlf:general',
        '--palette--;LLL:EXT:frontend/Resources/Private/Language/locallang_ttc.xlf:palette.general;general',
        '--palette--;LLL:EXT:frontend/Resources/Private/Language/locallang_ttc.xlf:palette.headers;headers',
        'tx_starter_tab_element',
        '--div--;LLL:EXT:core/Resources/Private/Language/Form/locallang_tabs.xlf:language',
        '--palette--;;language',
        '--div--;LLL:EXT:core/Resources/Private/Language/Form/locallang_tabs.xlf:access',
        '--palette--;;hidden',
        '--palette--;LLL:EXT:frontend/Resources/Private/Language/locallang_ttc.xlf:palette.access;access',
        '--div--;LLL:EXT:core/Resources/Private/Language/Form/locallang_tabs.xlf:notes',
        'rowDescription',
        '--div--;LLL:EXT:core/Resources/Private/Language/Form/locallang_tabs.xlf:extended',
    ];

    $GLOBALS['TCA']['tt_content']['types']['starter_tab'] = [
        'showitem' => implode(',', $showItem),
    ];

    ExtensionManagementUtility::addPlugin(
        [
            'LLL:EXT:starter/Resources/Private/Language/locallang_be.xlf:CType.I.starter_tab',
            'starter_tab',
            'starter-ctype-starter_tab',
        ],
        'CType',
        'starter'
    );
})();
