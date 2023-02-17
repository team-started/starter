<?php

defined('TYPO3') || die();

(function () {
    $translateFile = 'LLL:EXT:starter/Resources/Private/Language/locallang_be.xlf:';

    // define new palettes
    \TYPO3\CMS\Core\Utility\ArrayUtility::mergeRecursiveWithOverrule(
        $GLOBALS['TCA']['sys_file_reference'],
        [
            'palettes' => [
                'imageoverlayWithoutCropPalette' => [
                    'showitem' => 'title, alternative, --linebreak--, link, description',
                ],
                'imageoverlayWithoutLinkPalette' => [
                    'showitem' => 'title, alternative, --linebreak--, description, --linebreak--, crop',
                ],
                'starterShowAssetPalette' => [
                    'showitem' => 'tx_starter_show_small, tx_starter_show_medium, tx_starter_show_large',
                ],
            ],
        ]
    );

    \TYPO3\CMS\Core\Utility\ExtensionManagementUtility::addTCAcolumns(
        'sys_file_reference',
        [
            'tx_starter_class' => [
                'label' => $translateFile . 'sys_file_reference.tx_starter_class',
                'config' => [
                    'type' => 'select',
                    'renderType' => 'selectSingle',
                    'items' => [
                        ['', ''],
                    ],
                ],
            ],
            'tx_starter_show_small' => [
                'label' => $translateFile . 'sys_file_reference.tx_starter_show_small',
                'config' => [
                    'type' => 'check',
                    'renderType' => 'checkboxToggle',
                    'items' => [
                        [
                            0 => '',
                            1 => '',
                            'invertStateDisplay' => true,
                        ],
                    ],
                ],
            ],
            'tx_starter_show_medium' => [
                'label' => $translateFile . 'sys_file_reference.tx_starter_show_medium',
                'config' => [
                    'type' => 'check',
                    'renderType' => 'checkboxToggle',
                    'items' => [
                        [
                            0 => '',
                            1 => '',
                            'invertStateDisplay' => true,
                        ],
                    ],
                ],
            ],
            'tx_starter_show_large' => [
                'label' => $translateFile . 'sys_file_reference.tx_starter_show_large',
                'config' => [
                    'type' => 'check',
                    'renderType' => 'checkboxToggle',
                    'items' => [
                        [
                            0 => '',
                            1 => '',
                            'invertStateDisplay' => true,
                        ],
                    ],
                ],
            ],
        ]
    );

    \TYPO3\CMS\Core\Utility\ExtensionManagementUtility::addFieldsToPalette(
        'sys_file_reference',
        'imageoverlayPalette',
        '--linebreak--, tx_starter_class',
        'after:description'
    );

    \TYPO3\CMS\Core\Utility\ExtensionManagementUtility::addFieldsToPalette(
        'sys_file_reference',
        'imageoverlayWithoutLinkPalette',
        'tx_starter_class',
        'before:description'
    );
})();
