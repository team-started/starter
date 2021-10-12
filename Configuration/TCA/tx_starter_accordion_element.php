<?php
defined('TYPO3_MODE') || die();

return (function () {
    $translateFile = 'LLL:EXT:starter/Resources/Private/Language/locallang_be.xlf:';

    return [
        'ctrl' => [
            'label' => 'header',
            'sortby' => 'sorting',
            'tstamp' => 'tstamp',
            'crdate' => 'crdate',
            'cruser_id' => 'cruser_id',
            'editlock' => 'editlock',
            'title' => $translateFile . 'accordion_element_formlabel',
            'delete' => 'deleted',
            'versioningWS' => true,
            'origUid' => 't3_origuid',
            'hideTable' => true,
            'hideAtCopy' => true,
            'prependAtCopy' => 'LLL:EXT:lang/Resources/Private/Language/locallang_general.xlf:LGL.prependAtCopy',
            'transOrigPointerField' => 'l10n_parent',
            'transOrigDiffSourceField' => 'l10n_diffsource',
            'languageField' => 'sys_language_uid',
            'translationSource' => 'l10n_source',
            'enablecolumns' => [
                'disabled' => 'hidden',
                'starttime' => 'starttime',
                'endtime' => 'endtime',
            ],
            'type' => 'type',
            'typeicon_column' => 'type',
            'typeicon_classes' => [
                'default' => 'tx_starter_accordion_element_image',
                '1' => 'tx_starter_accordion_element_text',
            ],
            'useColumnsForDefaultValues' => 'type',
        ],

        'interface' => [
            'showRecordFieldList' =>
                'hidden, tt_content_accordion, type, layout, header, subheader, bodytext, assets,
                assets_medium, assets_large, media_size_small, media_size_medium, media_size_large, imageorient,
                image_zoom, imagecols',
        ],

        'types' => [
            '0' => [
                'showitem' => '
                --div--;LLL:EXT:core/Resources/Private/Language/Form/locallang_tabs.xlf:general,
                    --palette--;;accordion_start,
                    --palette--;LLL:EXT:frontend/Resources/Private/Language/locallang_ttc.xlf:palette.general;general,
                    --palette--;LLL:EXT:frontend/Resources/Private/Language/locallang_ttc.xlf:palette.headers;accordion_element_header,
                    bodytext;LLL:EXT:frontend/Resources/Private/Language/locallang_ttc.xlf:bodytext_formlabel,
                --div--;LLL:EXT:frontend/Resources/Private/Language/locallang_ttc.xlf:tabs.media,
                    --palette--;;accordion_media,
                    --palette--;LLL:EXT:frontend/Resources/Private/Language/Database.xlf:tt_content.palette.mediaAdjustments;starterMediaAdjustments,
                    --palette--;LLL:EXT:frontend/Resources/Private/Language/Database.xlf:tt_content.palette.gallerySettings;gallerySettings,
                    --palette--;LLL:EXT:frontend/Resources/Private/Language/locallang_ttc.xlf:palette.imagelinks;imagelinks,
                --div--;LLL:EXT:core/Resources/Private/Language/Form/locallang_tabs.xlf:language,
                    --palette--;;language,
                --div--;LLL:EXT:core/Resources/Private/Language/Form/locallang_tabs.xlf:access,
                    --palette--;;hidden,
                    --palette--;LLL:EXT:frontend/Resources/Private/Language/locallang_ttc.xlf:palette.access;access,
                --div--;LLL:EXT:core/Resources/Private/Language/Form/locallang_tabs.xlf:extended,
            ',
                'columnsOverrides' => [
                    'assets' => [
                        'config' => [
                            'eval' => 'required',
                            'minitems' => 1
                        ],
                    ],
                ],
            ],
            '1' => [
                'showitem' => '
                --div--;LLL:EXT:core/Resources/Private/Language/Form/locallang_tabs.xlf:general,
                    --palette--;;accordion_start,
                    --palette--;LLL:EXT:frontend/Resources/Private/Language/locallang_ttc.xlf:palette.general;general,
                    --palette--;LLL:EXT:frontend/Resources/Private/Language/locallang_ttc.xlf:palette.headers;accordion_element_header,
                    bodytext;LLL:EXT:frontend/Resources/Private/Language/locallang_ttc.xlf:bodytext_formlabel,
                --div--;LLL:EXT:core/Resources/Private/Language/Form/locallang_tabs.xlf:language,
                    --palette--;;language,
                --div--;LLL:EXT:core/Resources/Private/Language/Form/locallang_tabs.xlf:access,
                    --palette--;;hidden,
                    --palette--;LLL:EXT:frontend/Resources/Private/Language/locallang_ttc.xlf:palette.access;access,
                --div--;LLL:EXT:core/Resources/Private/Language/Form/locallang_tabs.xlf:extended,
            ',
            ],
        ],

        'palettes' => [
            'accordion_start' => [
                'showitem' => 'type, layout'
            ],
            'accordion_element_header' => [
                'showitem' => '
                    header;LLL:EXT:frontend/Resources/Private/Language/locallang_ttc.xlf:header_formlabel,
                    --linebreak--,
                    subheader;LLL:EXT:frontend/Resources/Private/Language/locallang_ttc.xlf:subheader_formlabel
                ',
            ],
            'starterMediaAdjustments' => [
                'showitem' => '
                    media_size_small, media_size_medium, media_size_large,
                    --linebreak--,
                    imagecols;LLL:EXT:starter/Resources/Private/Language/locallang_be.xlf:tt_content.imagecols,
                    imagecols_medium;LLL:EXT:starter/Resources/Private/Language/locallang_be.xlf:tt_content.imagecols_medium,
                    imagecols_large;LLL:EXT:starter/Resources/Private/Language/locallang_be.xlf:tt_content.imagecols_large,
                '
            ],
            'gallerySettings' => [
                'showitem' => '
                    imageorient;LLL:EXT:frontend/Resources/Private/Language/locallang_ttc.xlf:imageorient_formlabel,
                ',
            ],
            'accordion_media' => [
                'showitem' => '
                    assets, --linebreak--, assets_medium, --linebreak--, assets_large
                '
            ],
            'hidden' => [
                'showitem' => '
                    hidden;LLL:EXT:frontend/Resources/Private/Language/locallang_ttc.xlf:field.default.hidden
                ',
            ],
            'language' => [
                'showitem' => '
                    sys_language_uid;LLL:EXT:frontend/Resources/Private/Language/locallang_ttc.xlf:sys_language_uid_formlabel,l10n_parent
                ',
            ],
            'access' => [
                'showitem' => '
                    starttime;LLL:EXT:frontend/Resources/Private/Language/locallang_ttc.xlf:starttime_formlabel,
                    endtime;LLL:EXT:frontend/Resources/Private/Language/locallang_ttc.xlf:endtime_formlabel,
                    --linebreak--,
                    editlock
                ',
            ],
        ],

        'columns' => [
            'editlock' => [
                'exclude' => true,
                'label' => 'LLL:EXT:lang/Resources/Private/Language/locallang_tca.xlf:editlock',
                'config' => [
                    'type' => 'check',
                    'renderType' => 'checkboxToggle',
                    'items' => [
                        [
                            0 => '',
                            1 => '',
                        ]
                    ],
                ],
            ],
            'hidden' => [
                'exclude' => true,
                'label' => 'LLL:EXT:lang/Resources/Private/Language/locallang_general.xlf:LGL.hidden',
                'config' => [
                    'type' => 'check',
                    'items' => [
                        '1' => [
                            '0' => 'LLL:EXT:frontend/Resources/Private/Language/locallang_ttc.xlf:hidden.I.0',
                        ],
                    ],
                ],
            ],
            'starttime' => [
                'exclude' => true,
                'label' => 'LLL:EXT:lang/Resources/Private/Language/locallang_general.xlf:LGL.starttime',
                'config' => [
                    'type' => 'input',
                    'renderType' => 'inputDateTime',
                    'eval' => 'datetime',
                    'default' => 0,
                ],
                'l10n_mode' => 'exclude',
                'l10n_display' => 'defaultAsReadonly',
            ],
            'endtime' => [
                'exclude' => true,
                'label' => 'LLL:EXT:lang/Resources/Private/Language/locallang_general.xlf:LGL.endtime',
                'config' => [
                    'type' => 'input',
                    'renderType' => 'inputDateTime',
                    'eval' => 'datetime',
                    'default' => 0,
                    'range' => [
                        'upper' => mktime(0, 0, 0, 1, 1, 2038),
                    ],
                ],
                'l10n_mode' => 'exclude',
                'l10n_display' => 'defaultAsReadonly',
            ],
            'sys_language_uid' => [
                'exclude' => true,
                'label' => 'LLL:EXT:lang/Resources/Private/Language/locallang_general.xlf:LGL.language',
                'config' => [
                    'type' => 'select',
                    'renderType' => 'selectSingle',
                    'special' => 'languages',
                    'items' => [
                        [
                            'LLL:EXT:lang/Resources/Private/Language/locallang_general.xlf:LGL.allLanguages',
                            -1,
                            'flags-multiple',
                        ],
                    ],
                    'default' => 0,
                ],
            ],
            'l10n_parent' => [
                'exclude' => true,
                'displayCond' => 'FIELD:sys_language_uid:>:0',
                'label' => 'LLL:EXT:lang/Resources/Private/Language/locallang_general.xlf:LGL.l18n_parent',
                'config' => [
                    'type' => 'select',
                    'renderType' => 'selectSingle',
                    'items' => [
                        [
                            '',
                            0,
                        ],
                    ],
                    'foreign_table' => 'tx_starter_accordion_element',
                    'foreign_table_where' => 'AND tx_starter_accordion_element.pid=###CURRENT_PID### AND '
                        . 'tx_starter_accordion_element.sys_language_uid IN (-1,0)',
                    'default' => 0,
                ],
            ],
            'l10n_source' => [
                'config' => [
                    'type' => 'passthrough',
                ],
            ],
            'l10n_diffsource' => [
                'config' => [
                    'type' => 'passthrough',
                    'default' => '',
                ],
            ],
            't3ver_label' => [
                'label' => 'LLL:EXT:lang/Resources/Private/Language/locallang_general.xlf:LGL.versionLabel',
                'config' => [
                    'type' => 'input',
                    'size' => 30,
                    'max' => 255,
                ],
            ],
            'type' => [
                'exclude' => false,
                'label' => 'LLL:EXT:frontend/Resources/Private/Language/locallang_tca.xlf:pages.doktype_formlabel',
                'config' => [
                    'type' => 'select',
                    'renderType' => 'selectSingle',
                    'items' => [
                        [$translateFile . 'tx_starter_accordion.type.I.0', 0, 'tx_starter_accordion_element_image'],
                        [$translateFile . 'tx_starter_accordion.type.I.1', 1, 'tx_starter_accordion_element_text'],
                    ],
                    'fieldWizard' => [
                        'selectIcons' => [
                            'disabled' => false,
                        ],
                    ],
                    'size' => 1,
                    'maxitems' => 1,
                ]
            ],
            'layout' => [
                'exclude' => true,
                'label' => 'LLL:EXT:lang/Resources/Private/Language/locallang_general.xlf:LGL.layout',
                'config' => [
                    'type' => 'select',
                    'renderType' => 'selectSingle',
                    'items' => [
                        [
                            'LLL:EXT:lang/Resources/Private/Language/locallang_general.xlf:LGL.default_value',
                            ''
                        ],
                    ],
                    'default' => ''
                ]
            ],
            'header' => [
                'l10n_mode' => 'prefixLangTitle',
                'label' => 'LLL:EXT:frontend/Resources/Private/Language/locallang_ttc.xlf:header',
                'config' => [
                    'type' => 'input',
                    'size' => 50,
                    'max' => 255,
                    'eval' => 'trim',
                ],
            ],
            'subheader' => [
                'l10n_mode' => 'prefixLangTitle',
                'exclude' => true,
                'label' => 'LLL:EXT:lang/Resources/Private/Language/locallang_general.xlf:LGL.subheader',
                'config' => [
                    'type' => 'input',
                    'size' => 50,
                    'max' => 255,
                    'softref' => 'email[subst]',
                ],
            ],
            'bodytext' => [
                'l10n_mode' => 'prefixLangTitle',
                'label' => 'LLL:EXT:lang/Resources/Private/Language/locallang_general.xlf:LGL.text',
                'config' => [
                    'type' => 'text',
                    'enableRichtext' => true,
                    'richtextConfiguration' => 'default',
                    'cols' => 80,
                    'rows' => 15,
                    'softref' => 'typolink_tag,images,email[subst],url',
                ],
            ],
            'imageorient' => [
                'exclude' => true,
                'label' => 'LLL:EXT:frontend/Resources/Private/Language/locallang_ttc.xlf:imageorient',
                'config' => [
                    'type' => 'select',
                    'renderType' => 'selectSingle',
                    'items' => [
                        [
                            'LLL:EXT:frontend/Resources/Private/Language/locallang_ttc.xlf:imageorient.I.0',
                            0,
                            'content-beside-text-img-above-center'
                        ],
                        [
                            'LLL:EXT:frontend/Resources/Private/Language/locallang_ttc.xlf:imageorient.I.1',
                            1,
                            'content-beside-text-img-above-right'
                        ],
                        [
                            'LLL:EXT:frontend/Resources/Private/Language/locallang_ttc.xlf:imageorient.I.2',
                            2,
                            'content-beside-text-img-above-left'
                        ],
                        [
                            'LLL:EXT:frontend/Resources/Private/Language/locallang_ttc.xlf:imageorient.I.3',
                            8,
                            'content-beside-text-img-below-center'
                        ],
                        [
                            'LLL:EXT:frontend/Resources/Private/Language/locallang_ttc.xlf:imageorient.I.4',
                            9,
                            'content-beside-text-img-below-right'
                        ],
                        [
                            'LLL:EXT:frontend/Resources/Private/Language/locallang_ttc.xlf:imageorient.I.5',
                            10,
                            'content-beside-text-img-below-left'
                        ],
                        [
                            'LLL:EXT:frontend/Resources/Private/Language/locallang_ttc.xlf:imageorient.I.6',
                            17,
                            'content-inside-text-img-right'
                        ],
                        [
                            'LLL:EXT:frontend/Resources/Private/Language/locallang_ttc.xlf:imageorient.I.7',
                            18,
                            'content-inside-text-img-left'
                        ],
                        [
                            'LLL:EXT:frontend/Resources/Private/Language/locallang_ttc.xlf:imageorient.I.8',
                            '--div--'
                        ],
                        [
                            'LLL:EXT:frontend/Resources/Private/Language/locallang_ttc.xlf:imageorient.I.9',
                            25,
                            'content-beside-text-img-right'
                        ],
                        [
                            'LLL:EXT:frontend/Resources/Private/Language/locallang_ttc.xlf:imageorient.I.10',
                            26,
                            'content-beside-text-img-left'
                        ]
                    ],
                    'default' => 26,
                    'fieldWizard' => [
                        'selectIcons' => [
                            'disabled' => false,
                        ],
                    ],
                ]
            ],
            'image_zoom' => [
                'exclude' => true,
                'label' => 'LLL:EXT:frontend/Resources/Private/Language/locallang_ttc.xlf:image_zoom',
                'config' => [
                    'type' => 'check',
                    'items' => [
                        '1' => [
                            '0' => 'LLL:EXT:lang/Resources/Private/Language/locallang_core.xlf:labels.enabled'
                        ]
                    ]
                ]
            ],
            'imagecols' => [
                'exclude' => true,
                'label' => 'LLL:EXT:frontend/Resources/Private/Language/locallang_ttc.xlf:imagecols',
                'config' => [
                    'type' => 'select',
                    'renderType' => 'selectSingle',
                    'items' => [
                        ['1', 1],
                        ['2', 2],
                        ['3', 3],
                        ['4', 4],
                        ['5', 5],
                        ['6', 6],
                        ['7', 7],
                        ['8', 8]
                    ],
                    'default' => 1
                ]
            ],
            'imagecols_medium' => [
                'exclude' => true,
                'label' => 'LLL:EXT:frontend/Resources/Private/Language/locallang_ttc.xlf:imagecols',
                'config' => [
                    'type' => 'select',
                    'renderType' => 'selectSingle',
                    'items' => [
                        ['1', 1],
                        ['2', 2],
                        ['3', 3],
                        ['4', 4],
                        ['5', 5],
                        ['6', 6],
                        ['7', 7],
                        ['8', 8]
                    ],
                    'default' => 1
                ]
            ],
            'imagecols_large' => [
                'exclude' => true,
                'label' => 'LLL:EXT:frontend/Resources/Private/Language/locallang_ttc.xlf:imagecols',
                'config' => [
                    'type' => 'select',
                    'renderType' => 'selectSingle',
                    'items' => [
                        ['1', 1],
                        ['2', 2],
                        ['3', 3],
                        ['4', 4],
                        ['5', 5],
                        ['6', 6],
                        ['7', 7],
                        ['8', 8]
                    ],
                    'default' => 1
                ]
            ],
            'assets' => [
                'label' => 'LLL:EXT:frontend/Resources/Private/Language/Database.xlf:tt_content.asset_references',
                'config' => \TYPO3\CMS\Core\Utility\ExtensionManagementUtility::getFileFieldTCAConfig(
                    'assets',
                    [
                        'appearance' => [
                            'createNewRelationLinkTitle' => 'LLL:EXT:frontend/Resources/Private/Language/Database.xlf:tt_content.asset_references.addFileReference',
                        ],
                        'maxitems' => 9,
                        'overrideChildTca' => [
                            'columns' => [
                                'crop' => [
                                    'config' => [
                                        'cropVariants' => \StarterTeam\Starter\Utility\ConfigurationUtility::getMediaCropSettings()
                                    ]
                                ]
                            ],
                            'types' => [
                                '0' => [
                                    'showitem' => '
                                        --palette--;LLL:EXT:lang/Resources/Private/Language/locallang_tca.xlf:sys_file_reference.imageoverlayPalette;imageoverlayWithoutLinkPalette,
                                        --palette--;;filePalette',
                                ],
                                \TYPO3\CMS\Core\Resource\File::FILETYPE_IMAGE => [
                                    'showitem' => '
                                        --palette--;LLL:EXT:lang/Resources/Private/Language/locallang_tca.xlf:sys_file_reference.imageoverlayPalette;imageoverlayWithoutLinkPalette,
                                        --palette--;;filePalette',
                                ],
                                \TYPO3\CMS\Core\Resource\File::FILETYPE_VIDEO => [
                                    'showitem' => '
                                        --palette--;LLL:EXT:lang/Resources/Private/Language/locallang_tca.xlf:sys_file_reference.videoOverlayPalette;videoOverlayPalette,
                                        --palette--;;filePalette',
                                ]
                            ],
                        ],
                    ],
                    'jpg,jpeg,png,svg'
                ),
            ],
            'assets_medium' => [
                'label' => $translateFile . 'starter.asset_medium_references',
                'config' => \TYPO3\CMS\Core\Utility\ExtensionManagementUtility::getFileFieldTCAConfig(
                    'assets_medium',
                    [
                        'appearance' => [
                            'createNewRelationLinkTitle' => 'LLL:EXT:frontend/Resources/Private/Language/Database.xlf:tt_content.asset_references.addFileReference',
                        ],
                        'maxitems' => 9,
                        'overrideChildTca' => [
                            'columns' => [
                                'crop' => [
                                    'config' => [
                                        'cropVariants' => \StarterTeam\Starter\Utility\ConfigurationUtility::getMediaCropSettings()
                                    ]
                                ]
                            ],
                            'types' => [
                                '0' => [
                                    'showitem' => '
                                        --palette--;LLL:EXT:lang/Resources/Private/Language/locallang_tca.xlf:sys_file_reference.imageoverlayPalette;imageoverlayPalette,
                                        --palette--;;filePalette',
                                ],
                                \TYPO3\CMS\Core\Resource\File::FILETYPE_IMAGE => [
                                    'showitem' => '
                                        --palette--;LLL:EXT:lang/Resources/Private/Language/locallang_tca.xlf:sys_file_reference.imageoverlayPalette;imageoverlayPalette,
                                        --palette--;;filePalette',
                                ],
                                \TYPO3\CMS\Core\Resource\File::FILETYPE_VIDEO => [
                                    'showitem' => '
                                        --palette--;LLL:EXT:lang/Resources/Private/Language/locallang_tca.xlf:sys_file_reference.videoOverlayPalette;videoOverlayPalette,
                                        --palette--;;filePalette',
                                ]
                            ],
                        ],
                    ],
                    'jpg,jpeg,png,svg'
                ),
            ],
            'assets_large' => [
                'label' => $translateFile . 'starter.asset_large_references',
                'config' => \TYPO3\CMS\Core\Utility\ExtensionManagementUtility::getFileFieldTCAConfig(
                    'assets_large',
                    [
                        'appearance' => [
                            'createNewRelationLinkTitle' => 'LLL:EXT:frontend/Resources/Private/Language/Database.xlf:tt_content.asset_references.addFileReference',
                        ],
                        'maxitems' => 9,
                        'overrideChildTca' => [
                            'columns' => [
                                'crop' => [
                                    'config' => [
                                        'cropVariants' => \StarterTeam\Starter\Utility\ConfigurationUtility::getMediaCropSettings()
                                    ]
                                ]
                            ],
                            'types' => [
                                '0' => [
                                    'showitem' => '
                                        --palette--;LLL:EXT:lang/Resources/Private/Language/locallang_tca.xlf:sys_file_reference.imageoverlayPalette;imageoverlayPalette,
                                        --palette--;;filePalette',
                                ],
                                \TYPO3\CMS\Core\Resource\File::FILETYPE_IMAGE => [
                                    'showitem' => '
                                        --palette--;LLL:EXT:lang/Resources/Private/Language/locallang_tca.xlf:sys_file_reference.imageoverlayPalette;imageoverlayPalette,
                                        --palette--;;filePalette',
                                ],
                                \TYPO3\CMS\Core\Resource\File::FILETYPE_VIDEO => [
                                    'showitem' => '
                                        --palette--;LLL:EXT:lang/Resources/Private/Language/locallang_tca.xlf:sys_file_reference.videoOverlayPalette;videoOverlayPalette,
                                        --palette--;;filePalette',
                                ]
                            ],
                        ],
                    ],
                    'jpg,jpeg,png,svg'
                ),
            ],
            'media_size_small' => [
                'exclude' => true,
                'label' => $translateFile . 'media_size_small',
                'config' => [
                    'type' => 'select',
                    'renderType' => 'selectSingle',
                    'items' => [
                        [$translateFile . 'ttc_ge.label.nothing', ''],
                        [$translateFile . 'media_size.6', 'small-6'],
                        [$translateFile . 'media_size.3', 'small-3'],
                        [$translateFile . 'media_size.4', 'small-4'],
                        [$translateFile . 'media_size.8', 'small-8'],
                        [$translateFile . 'media_size.9', 'small-9'],
                        [$translateFile . 'media_size.12', 'small-12'],
                        [$translateFile . 'media_size.0', 'hide-for-small'],
                        [$translateFile . 'media_size.1', 'small-1'],
                        [$translateFile . 'media_size.2', 'small-2'],
                        [$translateFile . 'media_size.5', 'small-5'],
                        [$translateFile . 'media_size.7', 'small-7'],
                        [$translateFile . 'media_size.10', 'small-10'],
                        [$translateFile . 'media_size.11', 'small-11'],
                    ],
                    'default' => ''
                ]
            ],
            'media_size_medium' => [
                'exclude' => true,
                'label' => $translateFile . 'media_size_medium',
                'config' => [
                    'type' => 'select',
                    'renderType' => 'selectSingle',
                    'items' => [
                        [$translateFile . 'tt_content.label.inheritfromsmallerdisplay', ''],
                        [$translateFile . 'media_size.6', 'medium-6'],
                        [$translateFile . 'media_size.3', 'medium-3'],
                        [$translateFile . 'media_size.4', 'medium-4'],
                        [$translateFile . 'media_size.8', 'medium-8'],
                        [$translateFile . 'media_size.9', 'medium-9'],
                        [$translateFile . 'media_size.12', 'medium-12'],
                        [$translateFile . 'media_size.0', 'hide-for-medium'],
                        [$translateFile . 'media_size.1', 'medium-1'],
                        [$translateFile . 'media_size.2', 'medium-2'],
                        [$translateFile . 'media_size.5', 'medium-5'],
                        [$translateFile . 'media_size.7', 'medium-7'],
                        [$translateFile . 'media_size.10', 'medium-10'],
                        [$translateFile . 'media_size.11', 'medium-11'],
                    ],
                    'default' => ''
                ]
            ],
            'media_size_large' => [
                'exclude' => true,
                'label' => $translateFile . 'media_size_large',
                'config' => [
                    'type' => 'select',
                    'renderType' => 'selectSingle',
                    'items' => [
                        [$translateFile . 'tt_content.label.inheritfromsmallerdisplay', ''],
                        [$translateFile . 'media_size.6', 'large-6'],
                        [$translateFile . 'media_size.3', 'large-3'],
                        [$translateFile . 'media_size.4', 'large-4'],
                        [$translateFile . 'media_size.8', 'large-8'],
                        [$translateFile . 'media_size.9', 'large-9'],
                        [$translateFile . 'media_size.12', 'large-12'],
                        [$translateFile . 'media_size.0', 'hide-for-large'],
                        [$translateFile . 'media_size.1', 'large-1'],
                        [$translateFile . 'media_size.2', 'large-2'],
                        [$translateFile . 'media_size.5', 'large-5'],
                        [$translateFile . 'media_size.7', 'large-7'],
                        [$translateFile . 'media_size.10', 'large-10'],
                        [$translateFile . 'media_size.11', 'large-11'],
                    ],
                    'default' => ''
                ]
            ],
        ],
    ];
})();
