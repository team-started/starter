<?php
defined('TYPO3_MODE') || die();

(function (){
    \TYPO3\CMS\Core\Utility\ExtensionManagementUtility::addTCAcolumns(
        'tt_content',
        [
            'tx_starter_column_element' => [
                'exclude' => false,
                'label' => 'LLL:EXT:starter/Resources/Private/Language/locallang_be.xlf:starter_column_grid.tx_starter_column_element',
                'config' => [
                    'type' => 'inline',
                    'foreign_table' => 'tt_content',
                    'foreign_field' => 'tx_starter_column_element',
                    'foreign_sortby' => 'sorting',
                    'minitems' => 1,
                    'maxitems' => 12,
                    'behaviour' => [
                        'allowLanguageSynchronization' => false,
                    ],
                    'appearance' => [
                        'collapseAll' => true,
                        'expandSingle' => true,
                        'levelLinksPosition' => 'bottom',
                        'useSortable' => true,
                        'showPossibleLocalizationRecords' => true,
                        'showRemovedLocalizationRecords' => true,
                        'showAllLocalizationLink' => true,
                        'showSynchronizationLink' => true,
                        'enabledControls' => [
                            'info' => false,
                        ],
                    ],
                    'overrideChildTca' => [
                        'columns' => [
                            'CType' => [
                                'config' => [
                                    'default' => 'text'
                                ]
                            ],
                            'colPos' => [
                                'config' => [
                                    'default' => \StarterTeam\Starter\Utility\ConfigurationUtility::$contentGridElementsColPos['tx_starter_column_element'],
                                ]
                            ],
                        ]
                    ]
                ],
            ],
        ]
    );

    $GLOBALS['TCA']['tt_content']['types']['starter_column_grid'] = [
        'showitem' => '
            --div--;LLL:EXT:core/Resources/Private/Language/Form/locallang_tabs.xlf:general,
                --palette--;LLL:EXT:frontend/Resources/Private/Language/locallang_ttc.xlf:palette.general;general,
                --palette--;LLL:EXT:frontend/Resources/Private/Language/locallang_ttc.xlf:palette.headers;headers,
                tx_starter_column_element,
            --div--;LLL:EXT:frontend/Resources/Private/Language/locallang_ttc.xlf:tabs.appearance,
                --palette--;LLL:EXT:frontend/Resources/Private/Language/locallang_ttc.xlf:palette.frames;frames,
                --palette--;LLL:EXT:frontend/Resources/Private/Language/locallang_ttc.xlf:palette.appearanceLinks;appearanceLinks,
            --div--;LLL:EXT:core/Resources/Private/Language/Form/locallang_tabs.xlf:language,
                --palette--;;language,
            --div--;LLL:EXT:core/Resources/Private/Language/Form/locallang_tabs.xlf:access,
                --palette--;;hidden,
                --palette--;LLL:EXT:frontend/Resources/Private/Language/locallang_ttc.xlf:palette.access;access,
            --div--;LLL:EXT:core/Resources/Private/Language/Form/locallang_tabs.xlf:categories,
                categories,
            --div--;LLL:EXT:core/Resources/Private/Language/Form/locallang_tabs.xlf:notes,
                rowDescription,
            --div--;LLL:EXT:core/Resources/Private/Language/Form/locallang_tabs.xlf:extended,
        '
    ];

    \TYPO3\CMS\Core\Utility\ExtensionManagementUtility::addPlugin(
        [
            'LLL:EXT:starter/Resources/Private/Language/locallang_be.xlf:CType.I.starter_column_grid',
            'starter_column_grid',
            'starter-ctype-starter_column_grid',
        ],
        'CType',
        'starter'
    );
})();
