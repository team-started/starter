<?php

use StarterTeam\Starter\Utility\ConfigurationUtility;
use TYPO3\CMS\Core\Resource\File;

defined('TYPO3') || die();

return (function () {
    $translateFile = 'LLL:EXT:starter/Resources/Private/Language/locallang_be.xlf:';
    $showItemImage = [
        '--div--;LLL:EXT:core/Resources/Private/Language/Form/locallang_tabs.xlf:general',
        '--palette--;;tab_start',
        '--palette--;LLL:EXT:frontend/Resources/Private/Language/locallang_ttc.xlf:palette.general;general',
        '--palette--;LLL:EXT:frontend/Resources/Private/Language/locallang_ttc.xlf:palette.headers;tab_element_header',
        'bodytext;LLL:EXT:frontend/Resources/Private/Language/locallang_ttc.xlf:bodytext_formlabel',
        '--div--;LLL:EXT:frontend/Resources/Private/Language/locallang_ttc.xlf:tabs.media',
        '--palette--;;tab_media',
        '--palette--;LLL:EXT:frontend/Resources/Private/Language/Database.xlf:tt_content.palette.mediaAdjustments;starterMediaAdjustments',
        '--palette--;LLL:EXT:frontend/Resources/Private/Language/Database.xlf:tt_content.palette.gallerySettings;gallerySettings',
        '--palette--;LLL:EXT:frontend/Resources/Private/Language/locallang_ttc.xlf:palette.imagelinks;imagelinks',
        '--div--;LLL:EXT:core/Resources/Private/Language/Form/locallang_tabs.xlf:language',
        '--palette--;;language',
        '--div--;LLL:EXT:core/Resources/Private/Language/Form/locallang_tabs.xlf:access',
        '--palette--;;hidden',
        '--palette--;LLL:EXT:frontend/Resources/Private/Language/locallang_ttc.xlf:palette.access;access',
        '--div--;LLL:EXT:core/Resources/Private/Language/Form/locallang_tabs.xlf:extended',
    ];
    $showItemText = [
        '--div--;LLL:EXT:core/Resources/Private/Language/Form/locallang_tabs.xlf:general',
        '--palette--;;tab_start',
        '--palette--;LLL:EXT:frontend/Resources/Private/Language/locallang_ttc.xlf:palette.general;general',
        '--palette--;LLL:EXT:frontend/Resources/Private/Language/locallang_ttc.xlf:palette.headers;tab_element_header',
        'bodytext;LLL:EXT:frontend/Resources/Private/Language/locallang_ttc.xlf:bodytext_formlabel',
        '--div--;LLL:EXT:core/Resources/Private/Language/Form/locallang_tabs.xlf:language',
        '--palette--;;language',
        '--div--;LLL:EXT:core/Resources/Private/Language/Form/locallang_tabs.xlf:access',
        '--palette--;;hidden',
        '--palette--;LLL:EXT:frontend/Resources/Private/Language/locallang_ttc.xlf:palette.access;access',
        '--div--;LLL:EXT:core/Resources/Private/Language/Form/locallang_tabs.xlf:extended',
    ];

    return [
        'ctrl' => [
            'label' => 'header',
            'sortby' => 'sorting',
            'tstamp' => 'tstamp',
            'crdate' => 'crdate',
            'editlock' => 'editlock',
            'title' => $translateFile . 'tab_element_formlabel',
            'delete' => 'deleted',
            'versioningWS' => true,
            'origUid' => 't3_origuid',
            'hideTable' => true,
            'hideAtCopy' => true,
            'prependAtCopy' => 'LLL:EXT:core/Resources/Private/Language/locallang_general.xlf:LGL.prependAtCopy',
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
                'default' => 'tx_starter_tab_element_image',
                '1' => 'tx_starter_tab_element_text',
            ],
            'useColumnsForDefaultValues' => 'type',
            'security' => [
                'ignorePageTypeRestriction' => true,
            ],
        ],

        'types' => [
            '0' => [
                'showitem' => implode(',', $showItemImage),
                'columnsOverrides' => [
                    'assets' => [
                        'config' => [
                            'eval' => 'required',
                            'minitems' => 1,
                        ],
                    ],
                ],
            ],
            '1' => [
                'showitem' => implode(',', $showItemText),
            ],
        ],

        'palettes' => [
            'tab_start' => [
                'showitem' => 'type, layout',
            ],
            'tab_element_header' => [
                'showitem' => '
                    header;LLL:EXT:frontend/Resources/Private/Language/locallang_ttc.xlf:header_formlabel,
                    --linebreak--,
                    subheader;LLL:EXT:frontend/Resources/Private/Language/locallang_ttc.xlf:subheader_formlabel
                ',
            ],
            'starterMediaAdjustments' => [
                'showitem' => '
                    media_size_small, media_size_medium, media_size_large
                ',
            ],
            'gallerySettings' => [
                'showitem' => '
                    imageorient;LLL:EXT:frontend/Resources/Private/Language/locallang_ttc.xlf:imageorient_formlabel,
                    imagecols;LLL:EXT:frontend/Resources/Private/Language/locallang_ttc.xlf:imagecols_formlabel
                ',
            ],
            'tab_media' => [
                'showitem' => '
                    assets, --linebreak--, assets_medium, --linebreak--, assets_large
                ',
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
                'label' => 'LLL:EXT:core/Resources/Private/Language/locallang_tca.xlf:editlock',
                'config' => [
                    'type' => 'check',
                    'renderType' => 'checkboxToggle',
                ],
            ],
            'hidden' => [
                'exclude' => true,
                'label' => 'LLL:EXT:core/Resources/Private/Language/locallang_general.xlf:LGL.hidden',
                'config' => [
                    'type' => 'check',
                    'items' => [
                        '1' => [
                            'label' => 'LLL:EXT:frontend/Resources/Private/Language/locallang_ttc.xlf:hidden.I.0',
                        ],
                    ],
                ],
            ],
            'starttime' => [
                'exclude' => true,
                'label' => 'LLL:EXT:core/Resources/Private/Language/locallang_general.xlf:LGL.starttime',
                'config' => [
                    'type' => 'datetime',
                    'default' => 0,
                ],
                'l10n_mode' => 'exclude',
                'l10n_display' => 'defaultAsReadonly',
            ],
            'endtime' => [
                'exclude' => true,
                'label' => 'LLL:EXT:core/Resources/Private/Language/locallang_general.xlf:LGL.endtime',
                'config' => [
                    'type' => 'datetime',
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
                'label' => 'LLL:EXT:core/Resources/Private/Language/locallang_general.xlf:LGL.language',
                'config' => ['type' => 'language'],
            ],
            'l10n_parent' => [
                'displayCond' => 'FIELD:sys_language_uid:>:0',
                'label' => 'LLL:EXT:core/Resources/Private/Language/locallang_general.xlf:LGL.l18n_parent',
                'config' => [
                    'type' => 'select',
                    'renderType' => 'selectSingle',
                    'items' => [
                        [
                            'label' => '',
                            'value' => 0,
                        ],
                    ],
                    'foreign_table' => 'tx_starter_tab_element',
                    'foreign_table_where' => 'AND tx_starter_tab_element.pid=###CURRENT_PID### AND '
                        . 'tx_starter_tab_element.sys_language_uid IN (-1,0)',
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
                'label' => 'LLL:EXT:core/Resources/Private/Language/locallang_general.xlf:LGL.versionLabel',
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
                        ['label' => $translateFile . 'tx_starter_tab.type.I.0', 'value' => 0, 'icon' => 'tx_starter_tab_element_image'],
                        ['label' => $translateFile . 'tx_starter_tab.type.I.1', 'value' => 1, 'icon' => 'tx_starter_tab_element_text'],
                    ],
                    'fieldWizard' => [
                        'selectIcons' => [
                            'disabled' => false,
                        ],
                    ],
                    'size' => 1,
                    'maxitems' => 1,
                ],
            ],
            'layout' => [
                'exclude' => true,
                'label' => 'LLL:EXT:core/Resources/Private/Language/locallang_general.xlf:LGL.layout',
                'config' => [
                    'type' => 'select',
                    'renderType' => 'selectSingle',
                    'items' => [
                        [
                            'label' => 'LLL:EXT:core/Resources/Private/Language/locallang_general.xlf:LGL.default_value',
                            'value' => '',
                        ],
                    ],
                    'default' => '',
                ],
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
                'label' => 'LLL:EXT:core/Resources/Private/Language/locallang_general.xlf:LGL.subheader',
                'config' => [
                    'type' => 'input',
                    'size' => 50,
                    'max' => 255,
                    'softref' => 'email[subst]',
                ],
            ],
            'bodytext' => [
                'l10n_mode' => 'prefixLangTitle',
                'label' => 'LLL:EXT:core/Resources/Private/Language/locallang_general.xlf:LGL.text',
                'config' => [
                    'type' => 'text',
                    'enableRichtext' => true,
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
                            'label' => 'LLL:EXT:frontend/Resources/Private/Language/locallang_ttc.xlf:imageorient.I.0',
                            'value' => 0,
                            'icon' => 'content-beside-text-img-above-center',
                        ],
                        [
                            'label' => 'LLL:EXT:frontend/Resources/Private/Language/locallang_ttc.xlf:imageorient.I.1',
                            'value' => 1,
                            'icon' => 'content-beside-text-img-above-right',
                        ],
                        [
                            'label' => 'LLL:EXT:frontend/Resources/Private/Language/locallang_ttc.xlf:imageorient.I.2',
                            'value' => 2,
                            'icon' => 'content-beside-text-img-above-left',
                        ],
                        [
                            'label' => 'LLL:EXT:frontend/Resources/Private/Language/locallang_ttc.xlf:imageorient.I.3',
                            'value' => 8,
                            'icon' => 'content-beside-text-img-below-center',
                        ],
                        [
                            'label' => 'LLL:EXT:frontend/Resources/Private/Language/locallang_ttc.xlf:imageorient.I.4',
                            'value' => 9,
                            'icon' => 'content-beside-text-img-below-right',
                        ],
                        [
                            'label' => 'LLL:EXT:frontend/Resources/Private/Language/locallang_ttc.xlf:imageorient.I.5',
                            'value' => 10,
                            'icon' => 'content-beside-text-img-below-left',
                        ],
                        [
                            'label' => 'LLL:EXT:frontend/Resources/Private/Language/locallang_ttc.xlf:imageorient.I.6',
                            'value' => 17,
                            'icon' => 'content-inside-text-img-right',
                        ],
                        [
                            'label' => 'LLL:EXT:frontend/Resources/Private/Language/locallang_ttc.xlf:imageorient.I.7',
                            'value' => 18,
                            'icon' => 'content-inside-text-img-left',
                        ],
                        [
                            'label' => 'LLL:EXT:frontend/Resources/Private/Language/locallang_ttc.xlf:imageorient.I.8',
                            'value' => '--div--',
                        ],
                        [
                            'label' => 'LLL:EXT:frontend/Resources/Private/Language/locallang_ttc.xlf:imageorient.I.9',
                            'value' => 25,
                            'icon' => 'content-beside-text-img-right',
                        ],
                        [
                            'label' => 'LLL:EXT:frontend/Resources/Private/Language/locallang_ttc.xlf:imageorient.I.10',
                            'value' => 26,
                            'icon' => 'content-beside-text-img-left',
                        ],
                    ],
                    'default' => 26,
                    'fieldWizard' => [
                        'selectIcons' => [
                            'disabled' => false,
                        ],
                    ],
                ],
            ],
            'image_zoom' => [
                'exclude' => true,
                'label' => 'LLL:EXT:frontend/Resources/Private/Language/locallang_ttc.xlf:image_zoom',
                'config' => [
                    'type' => 'check',
                    'items' => [
                        '1' => [
                            'label' => 'LLL:EXT:core/Resources/Private/Language/locallang_core.xlf:labels.enabled',
                        ],
                    ],
                ],
            ],
            'imagecols' => [
                'exclude' => true,
                'label' => 'LLL:EXT:frontend/Resources/Private/Language/locallang_ttc.xlf:imagecols',
                'config' => [
                    'type' => 'select',
                    'renderType' => 'selectSingle',
                    'items' => [
                        ['label' => '1', 'value' => 1],
                        ['label' => '2', 'value' => 2],
                        ['label' => '3', 'value' => 3],
                        ['label' => '4', 'value' => 4],
                        ['label' => '5', 'value' => 5],
                        ['label' => '6', 'value' => 6],
                        ['label' => '7', 'value' => 7],
                        ['label' => '8', 'value' => 8],
                    ],
                    'default' => 1,
                ],
            ],
            'assets' => [
                'label' => 'LLL:EXT:frontend/Resources/Private/Language/Database.xlf:tt_content.asset_references',
                'config' => [
                    //## !!! Watch out for fieldName different from columnName
                    'type' => 'file',
                    'allowed' => 'jpg,jpeg,png,svg',
                    'appearance' => [
                        'createNewRelationLinkTitle' => 'LLL:EXT:frontend/Resources/Private/Language/Database.xlf:tt_content.asset_references.addFileReference',
                    ],
                    'maxitems' => 9,
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
                            File::FILETYPE_VIDEO => [
                                'showitem' => '
                                        --palette--;LLL:EXT:core/Resources/Private/Language/locallang_tca.xlf:sys_file_reference.videoOverlayPalette;videoOverlayPalette,
                                        --palette--;;filePalette',
                            ],
                        ],
                    ],
                ],
            ],
            'assets_medium' => [
                'label' => $translateFile . 'starter.asset_medium_references',
                'config' => [
                    //## !!! Watch out for fieldName different from columnName
                    'type' => 'file',
                    'allowed' => 'jpg,jpeg,png,svg',
                    'appearance' => [
                        'createNewRelationLinkTitle' => 'LLL:EXT:frontend/Resources/Private/Language/Database.xlf:tt_content.asset_references.addFileReference',
                    ],
                    'maxitems' => 9,
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
                                        --palette--;LLL:EXT:core/Resources/Private/Language/locallang_tca.xlf:sys_file_reference.imageoverlayPalette;imageoverlayPalette,
                                        --palette--;;filePalette',
                            ],
                            File::FILETYPE_IMAGE => [
                                'showitem' => '
                                        --palette--;LLL:EXT:core/Resources/Private/Language/locallang_tca.xlf:sys_file_reference.imageoverlayPalette;imageoverlayPalette,
                                        --palette--;;filePalette',
                            ],
                            File::FILETYPE_VIDEO => [
                                'showitem' => '
                                        --palette--;LLL:EXT:core/Resources/Private/Language/locallang_tca.xlf:sys_file_reference.videoOverlayPalette;videoOverlayPalette,
                                        --palette--;;filePalette',
                            ],
                        ],
                    ],
                ],
            ],
            'assets_large' => [
                'label' => $translateFile . 'starter.asset_large_references',
                'config' => [
                    //## !!! Watch out for fieldName different from columnName
                    'type' => 'file',
                    'allowed' => 'jpg,jpeg,png,svg',
                    'appearance' => [
                        'createNewRelationLinkTitle' => 'LLL:EXT:frontend/Resources/Private/Language/Database.xlf:tt_content.asset_references.addFileReference',
                    ],
                    'maxitems' => 9,
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
                                        --palette--;LLL:EXT:core/Resources/Private/Language/locallang_tca.xlf:sys_file_reference.imageoverlayPalette;imageoverlayPalette,
                                        --palette--;;filePalette',
                            ],
                            File::FILETYPE_IMAGE => [
                                'showitem' => '
                                        --palette--;LLL:EXT:core/Resources/Private/Language/locallang_tca.xlf:sys_file_reference.imageoverlayPalette;imageoverlayPalette,
                                        --palette--;;filePalette',
                            ],
                            File::FILETYPE_VIDEO => [
                                'showitem' => '
                                        --palette--;LLL:EXT:core/Resources/Private/Language/locallang_tca.xlf:sys_file_reference.videoOverlayPalette;videoOverlayPalette,
                                        --palette--;;filePalette',
                            ],
                        ],
                    ],
                ],
            ],
            'media_size_small' => [
                'exclude' => true,
                'label' => $translateFile . 'media_size_small',
                'config' => [
                    'type' => 'select',
                    'renderType' => 'selectSingle',
                    'items' => [
                        ['label' => $translateFile . 'ttc_ge.label.nothing', 'value' => ''],
                        ['label' => $translateFile . 'media_size.6', 'value' => 'small-6'],
                        ['label' => $translateFile . 'media_size.3', 'value' => 'small-3'],
                        ['label' => $translateFile . 'media_size.4', 'value' => 'small-4'],
                        ['label' => $translateFile . 'media_size.8', 'value' => 'small-8'],
                        ['label' => $translateFile . 'media_size.9', 'value' => 'small-9'],
                        ['label' => $translateFile . 'media_size.12', 'value' => 'small-12'],
                        ['label' => $translateFile . 'media_size.0', 'value' => 'hide-for-small'],
                        ['label' => $translateFile . 'media_size.1', 'value' => 'small-1'],
                        ['label' => $translateFile . 'media_size.2', 'value' => 'small-2'],
                        ['label' => $translateFile . 'media_size.5', 'value' => 'small-5'],
                        ['label' => $translateFile . 'media_size.7', 'value' => 'small-7'],
                        ['label' => $translateFile . 'media_size.10', 'value' => 'small-10'],
                        ['label' => $translateFile . 'media_size.11', 'value' => 'small-11'],
                    ],
                    'default' => '',
                ],
            ],
            'media_size_medium' => [
                'exclude' => true,
                'label' => $translateFile . 'media_size_medium',
                'config' => [
                    'type' => 'select',
                    'renderType' => 'selectSingle',
                    'items' => [
                        ['label' => $translateFile . 'tt_content.label.inheritfromsmallerdisplay', 'value' => ''],
                        ['label' => $translateFile . 'media_size.6', 'value' => 'medium-6'],
                        ['label' => $translateFile . 'media_size.3', 'value' => 'medium-3'],
                        ['label' => $translateFile . 'media_size.4', 'value' => 'medium-4'],
                        ['label' => $translateFile . 'media_size.8', 'value' => 'medium-8'],
                        ['label' => $translateFile . 'media_size.9', 'value' => 'medium-9'],
                        ['label' => $translateFile . 'media_size.12', 'value' => 'medium-12'],
                        ['label' => $translateFile . 'media_size.0', 'value' => 'hide-for-medium'],
                        ['label' => $translateFile . 'media_size.1', 'value' => 'medium-1'],
                        ['label' => $translateFile . 'media_size.2', 'value' => 'medium-2'],
                        ['label' => $translateFile . 'media_size.5', 'value' => 'medium-5'],
                        ['label' => $translateFile . 'media_size.7', 'value' => 'medium-7'],
                        ['label' => $translateFile . 'media_size.10', 'value' => 'medium-10'],
                        ['label' => $translateFile . 'media_size.11', 'value' => 'medium-11'],
                    ],
                    'default' => '',
                ],
            ],
            'media_size_large' => [
                'exclude' => true,
                'label' => $translateFile . 'media_size_large',
                'config' => [
                    'type' => 'select',
                    'renderType' => 'selectSingle',
                    'items' => [
                        ['label' => $translateFile . 'tt_content.label.inheritfromsmallerdisplay', 'value' => ''],
                        ['label' => $translateFile . 'media_size.6', 'value' => 'large-6'],
                        ['label' => $translateFile . 'media_size.3', 'value' => 'large-3'],
                        ['label' => $translateFile . 'media_size.4', 'value' => 'large-4'],
                        ['label' => $translateFile . 'media_size.8', 'value' => 'large-8'],
                        ['label' => $translateFile . 'media_size.9', 'value' => 'large-9'],
                        ['label' => $translateFile . 'media_size.12', 'value' => 'large-12'],
                        ['label' => $translateFile . 'media_size.0', 'value' => 'hide-for-large'],
                        ['label' => $translateFile . 'media_size.1', 'value' => 'large-1'],
                        ['label' => $translateFile . 'media_size.2', 'value' => 'large-2'],
                        ['label' => $translateFile . 'media_size.5', 'value' => 'large-5'],
                        ['label' => $translateFile . 'media_size.7', 'value' => 'large-7'],
                        ['label' => $translateFile . 'media_size.10', 'value' => 'large-10'],
                        ['label' => $translateFile . 'media_size.11', 'value' => 'large-11'],
                    ],
                    'default' => '',
                ],
            ],
        ],
    ];
})();
