<?php

use TYPO3\CMS\Core\Utility\ArrayUtility;
use TYPO3\CMS\Core\Utility\ExtensionManagementUtility;

defined('TYPO3') || die();

(function () {
    $translateFile = 'LLL:EXT:starter/Resources/Private/Language/locallang_be.xlf:';

    // define new palettes
    ArrayUtility::mergeRecursiveWithOverrule(
        $GLOBALS['TCA']['sys_file_reference'],
        [
            'palettes' => [
                'imageoverlayWithoutCropPalette' => [
                    'showitem' => 'title, alternative, --linebreak--, link, description',
                ],
                'imageoverlayWithoutLinkPalette' => [
                    'showitem' => 'title, alternative, --linebreak--, description, --linebreak--, crop',
                ],
            ],
        ]
    );

    ExtensionManagementUtility::addTCAcolumns(
        'sys_file_reference',
        [
            'tx_starter_class' => [
                'label' => $translateFile . 'sys_file_reference.tx_starter_class',
                'config' => [
                    'type' => 'select',
                    'renderType' => 'selectSingle',
                    'items' => [
                        [
                            'label' => '',
                            'value' => '',
                        ],
                    ],
                ],
            ],
        ]
    );

    ExtensionManagementUtility::addFieldsToPalette(
        'sys_file_reference',
        'imageoverlayPalette',
        '--linebreak--, tx_starter_class',
        'after:description'
    );

    ExtensionManagementUtility::addFieldsToPalette(
        'sys_file_reference',
        'imageoverlayWithoutLinkPalette',
        'tx_starter_class',
        'before:description'
    );
})();
