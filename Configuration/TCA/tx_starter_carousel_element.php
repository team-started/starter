<?php

defined('TYPO3') || die();

return (function () {
    $translateFile = 'LLL:EXT:starter/Resources/Private/Language/locallang_be.xlf:';
    $showItemDefault = [
        '--div--;LLL:EXT:core/Resources/Private/Language/Form/locallang_tabs.xlf:general',
        '--palette--;;carousel_start',
        '--palette--;LLL:EXT:frontend/Resources/Private/Language/locallang_ttc.xlf:palette.general;general',
        '--palette--;LLL:EXT:frontend/Resources/Private/Language/locallang_ttc.xlf:palette.headers;carousel_element_header',
        '--palette--;LLL:EXT:starter/Resources/Private/Language/locallang_be.xlf:palette.carousel.links;carousel_element_link',
        'bodytext;LLL:EXT:frontend/Resources/Private/Language/locallang_ttc.xlf:bodytext_formlabel',
        '--div--;LLL:EXT:frontend/Resources/Private/Language/locallang_ttc.xlf:tabs.media',
        '--palette--;;carousel_media',
        '--div--;LLL:EXT:core/Resources/Private/Language/Form/locallang_tabs.xlf:language',
        '--palette--;;language',
        '--div--;LLL:EXT:core/Resources/Private/Language/Form/locallang_tabs.xlf:access',
        '--palette--;;hidden',
        '--palette--;LLL:EXT:frontend/Resources/Private/Language/locallang_ttc.xlf:palette.access;access',
        '--div--;LLL:EXT:core/Resources/Private/Language/Form/locallang_tabs.xlf:extended',
    ];
    $showItemType1 = [
        '--div--;LLL:EXT:core/Resources/Private/Language/Form/locallang_tabs.xlf:general',
        '--palette--;;carousel_start',
        '--palette--;LLL:EXT:frontend/Resources/Private/Language/locallang_ttc.xlf:palette.general;general',
        '--palette--;LLL:EXT:frontend/Resources/Private/Language/locallang_ttc.xlf:palette.headers;carousel_element_header',
        '--palette--;LLL:EXT:starter/Resources/Private/Language/locallang_be.xlf:palette.carousel.links;carousel_element_link',
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
            'cruser_id' => 'cruser_id',
            'editlock' => 'editlock',
            'title' => $translateFile . 'carousel_element_formlabel',
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
                'default' => 'tx_starter_carousel_element_image',
                '1' => 'tx_starter_carousel_element_text',
            ],
            'useColumnsForDefaultValues' => 'type',
        ],

        'types' => [
            '0' => [
                'showitem' => implode(',', $showItemDefault),
                'columnsOverrides' => [
                    'assets' => [
                        'config' => [
                            'eval' => 'required',
                        ],
                    ],
                ],
            ],
            '1' => [
                'showitem' => implode(',', $showItemType1),
            ],
        ],

        'palettes' => [
            'carousel_start' => [
                'showitem' => 'type, layout',
            ],
            'carousel_element_header' => [
                'showitem' => '
                header;LLL:EXT:frontend/Resources/Private/Language/locallang_ttc.xlf:header_formlabel,
                --linebreak--,
                subheader;LLL:EXT:frontend/Resources/Private/Language/locallang_ttc.xlf:subheader_formlabel
            ',
            ],
            'carousel_element_link' => [
                'showitem' => '
                link;' . $translateFile . 'tx_starter_carousel.link_formlabel,
                --linebreak--,
                link_text;' . $translateFile . 'tx_starter_carousel.link_text_formlabel,
            ',
            ],
            'carousel_media' => [
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
                    'items' => [
                        [
                            0 => '',
                            1 => '',
                        ],
                    ],
                ],
            ],
            'hidden' => [
                'exclude' => true,
                'label' => 'LLL:EXT:core/Resources/Private/Language/locallang_general.xlf:LGL.hidden',
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
                'label' => 'LLL:EXT:core/Resources/Private/Language/locallang_general.xlf:LGL.starttime',
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
                'label' => 'LLL:EXT:core/Resources/Private/Language/locallang_general.xlf:LGL.endtime',
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
                            '',
                            0,
                        ],
                    ],
                    'foreign_table' => 'tx_starter_carousel_element',
                    'foreign_table_where' => 'AND tx_starter_carousel_element.pid=###CURRENT_PID### AND '
                        . 'tx_starter_carousel_element.sys_language_uid IN (-1,0)',
                    'default' => 0,
                ],
            ],
            'l10n_source' => [
                'config' => [
                    'type' => 'passthrough',
                ],
            ],
            'type' => [
                'exclude' => false,
                'label' => 'LLL:EXT:frontend/Resources/Private/Language/locallang_tca.xlf:pages.doktype_formlabel',
                'config' => [
                    'type' => 'select',
                    'renderType' => 'selectSingle',
                    'items' => [
                        [$translateFile . 'tx_starter_carousel.type.I.0', 0, 'tx_starter_carousel_element_image'],
                        [$translateFile . 'tx_starter_carousel.type.I.1', 1, 'tx_starter_carousel_element_text'],
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
                            'LLL:EXT:core/Resources/Private/Language/locallang_general.xlf:LGL.default_value',
                            '',
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
            'assets' => [
                'label' => 'LLL:EXT:frontend/Resources/Private/Language/Database.xlf:tt_content.asset_references',
                'config' => \TYPO3\CMS\Core\Utility\ExtensionManagementUtility::getFileFieldTCAConfig(
                    'assets',
                    [
                        'appearance' => [
                            'createNewRelationLinkTitle' => 'LLL:EXT:frontend/Resources/Private/Language/Database.xlf:tt_content.asset_references.addFileReference',
                        ],
                        'maxitems' => 1,
                        'overrideChildTca' => [
                            'columns' => [
                                'crop' => [
                                    'config' => [
                                        'cropVariants' => \StarterTeam\Starter\Utility\ConfigurationUtility::getMediaCropSettings(),
                                    ],
                                ],
                            ],
                            'types' => [
                                '0' => [
                                    'showitem' => '
                                        --palette--;LLL:EXT:core/Resources/Private/Language/locallang_tca.xlf:sys_file_reference.imageoverlayPalette;imageoverlayPalette,
                                        --palette--;;filePalette',
                                ],
                                \TYPO3\CMS\Core\Resource\File::FILETYPE_IMAGE => [
                                    'showitem' => '
                                        --palette--;LLL:EXT:core/Resources/Private/Language/locallang_tca.xlf:sys_file_reference.imageoverlayPalette;imageoverlayPalette,
                                        --palette--;;filePalette',
                                ],
                                \TYPO3\CMS\Core\Resource\File::FILETYPE_VIDEO => [
                                    'showitem' => '
                                        --palette--;LLL:EXT:core/Resources/Private/Language/locallang_tca.xlf:sys_file_reference.videoOverlayPalette;videoOverlayPalette,
                                        --palette--;;filePalette',
                                ],
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
                        'maxitems' => 1,
                        'overrideChildTca' => [
                            'columns' => [
                                'crop' => [
                                    'config' => [
                                        'cropVariants' => \StarterTeam\Starter\Utility\ConfigurationUtility::getMediaCropSettings(),
                                    ],
                                ],
                            ],
                            'types' => [
                                '0' => [
                                    'showitem' => '
                                        --palette--;LLL:EXT:core/Resources/Private/Language/locallang_tca.xlf:sys_file_reference.imageoverlayPalette;imageoverlayPalette,
                                        --palette--;;filePalette',
                                ],
                                \TYPO3\CMS\Core\Resource\File::FILETYPE_IMAGE => [
                                    'showitem' => '
                                        --palette--;LLL:EXT:core/Resources/Private/Language/locallang_tca.xlf:sys_file_reference.imageoverlayPalette;imageoverlayPalette,
                                        --palette--;;filePalette',
                                ],
                                \TYPO3\CMS\Core\Resource\File::FILETYPE_VIDEO => [
                                    'showitem' => '
                                        --palette--;LLL:EXT:core/Resources/Private/Language/locallang_tca.xlf:sys_file_reference.videoOverlayPalette;videoOverlayPalette,
                                        --palette--;;filePalette',
                                ],
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
                        'maxitems' => 1,
                        'overrideChildTca' => [
                            'columns' => [
                                'crop' => [
                                    'config' => [
                                        'cropVariants' => \StarterTeam\Starter\Utility\ConfigurationUtility::getMediaCropSettings(),
                                    ],
                                ],
                            ],
                            'types' => [
                                '0' => [
                                    'showitem' => '
                                        --palette--;LLL:EXT:core/Resources/Private/Language/locallang_tca.xlf:sys_file_reference.imageoverlayPalette;imageoverlayPalette,
                                        --palette--;;filePalette',
                                ],
                                \TYPO3\CMS\Core\Resource\File::FILETYPE_IMAGE => [
                                    'showitem' => '
                                        --palette--;LLL:EXT:core/Resources/Private/Language/locallang_tca.xlf:sys_file_reference.imageoverlayPalette;imageoverlayPalette,
                                        --palette--;;filePalette',
                                ],
                                \TYPO3\CMS\Core\Resource\File::FILETYPE_VIDEO => [
                                    'showitem' => '
                                        --palette--;LLL:EXT:core/Resources/Private/Language/locallang_tca.xlf:sys_file_reference.videoOverlayPalette;videoOverlayPalette,
                                        --palette--;;filePalette',
                                ],
                            ],
                        ],
                    ],
                    'jpg,jpeg,png,svg'
                ),
            ],
            'link_text' => [
                'l10n_mode' => 'prefixLangTitle',
                'exclude' => true,
                'label' => $translateFile . 'tx_starter_carousel.link_text_formlabel',
                'config' => [
                    'type' => 'input',
                    'size' => 50,
                    'max' => 255,
                ],
            ],
            'link' => [
                'exclude' => true,
                'label' => $translateFile . 'tx_starter_carousel.link_formlabel',
                'config' => [
                    'type' => 'input',
                    'renderType' => 'inputLink',
                    'size' => 50,
                    'max' => 1024,
                    'eval' => 'trim',
                    'fieldControl' => [
                        'linkPopup' => [
                            'options' => [
                                'title' => $translateFile . 'tx_starter_carousel.link_formlabel',
                            ],
                        ],
                    ],
                    'softref' => 'typolink',
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
        ],
    ];
})();
