<?php

use StarterTeam\Starter\Utility\ConfigurationUtility;
use TYPO3\CMS\Core\Resource\File;
use TYPO3\CMS\Core\Utility\ExtensionManagementUtility;

defined('TYPO3') || die();

(function () {
    $showItem = [
        '--div--;LLL:EXT:core/Resources/Private/Language/Form/locallang_tabs.xlf:general',
        '--palette--;LLL:EXT:frontend/Resources/Private/Language/locallang_ttc.xlf:palette.general;starterCeTeaserGeneral',
        '--palette--;LLL:EXT:frontend/Resources/Private/Language/locallang_ttc.xlf:palette.headers;starterCeTeaserHeader',
        'bodytext, tx_starter_overlay_text',
        '--div--;LLL:EXT:frontend/Resources/Private/Language/locallang_ttc.xlf:tabs.media',
        '--palette--;;starterMedia',
        '--div--;LLL:EXT:frontend/Resources/Private/Language/locallang_ttc.xlf:tabs.appearance',
        '--palette--;LLL:EXT:frontend/Resources/Private/Language/locallang_ttc.xlf:palette.frames;frames',
        '--div--;LLL:EXT:core/Resources/Private/Language/Form/locallang_tabs.xlf:language',
        '--palette--;;language',
        '--div--;LLL:EXT:core/Resources/Private/Language/Form/locallang_tabs.xlf:access',
        '--palette--;;hidden',
        '--palette--;LLL:EXT:frontend/Resources/Private/Language/locallang_ttc.xlf:palette.access;access',
        '--div--;LLL:EXT:core/Resources/Private/Language/Form/locallang_tabs.xlf:categories',
        'categories',
        '--div--;LLL:EXT:core/Resources/Private/Language/Form/locallang_tabs.xlf:notes',
        'rowDescription',
        '--div--;LLL:EXT:core/Resources/Private/Language/Form/locallang_tabs.xlf:extended',
    ];

    $GLOBALS['TCA']['tt_content']['types']['starter_teaser'] = [
        'showitem' => implode(',', $showItem),
        'columnsOverrides' => [
            'assets' => [
                'config' => [
                    'eval' => 'required',
                    'maxitems' => 1,
                    'overrideChildTca' => [
                        'columns' => [
                            'crop' => [
                                'config' => [
                                    'cropVariants' => ConfigurationUtility::getMediaCropSettings(),
                                ],
                            ],
                        ],
                        'types' => [
                            '0' => [
                                'showitem' => '
                                        --palette--;LLL:EXT:core/Resources/Private/Language/locallang_tca.xlf:sys_file_reference.imageoverlayPalette;imageoverlayWithoutLinkPalette,
                                        --palette--;;filePalette',
                            ],
                            File::FILETYPE_IMAGE => [
                                'showitem' => '
                                        --palette--;LLL:EXT:core/Resources/Private/Language/locallang_tca.xlf:sys_file_reference.imageoverlayPalette;imageoverlayWithoutLinkPalette,
                                        --palette--;;filePalette',
                            ],
                        ],
                    ],
                ],
            ],
            'bodytext' => [
                'config' => [
                    'enableRichtext' => true,
                ],
            ],
            'tx_starter_celink_text' => [
                'label' => 'LLL:EXT:starter/Resources/Private/Language/locallang_be.xlf:tx_starter_teaser.celink_text_formlabel',
            ],
            'tx_starter_celink' => [
                'label' => 'LLL:EXT:starter/Resources/Private/Language/locallang_be.xlf:tx_starter_teaser.celink_formlabel',
            ],
        ],
    ];

    ExtensionManagementUtility::addPlugin(
        [
            'LLL:EXT:starter/Resources/Private/Language/locallang_be.xlf:CType.I.starter_teaser',
            'starter_teaser',
            'starter-ctype-starter_teaser',
        ],
        'CType',
        'starter'
    );
})();
