<?php

defined('TYPO3') or die();

(function () {
    $translationFile = 'LLL:EXT:starter/Resources/Private/Language/locallang_be.xlf';

    \TYPO3\CMS\Core\Utility\ExtensionManagementUtility::addTCAcolumns(
        'tt_content',
        [
            'tx_starter_celink' => [
                'exclude' => true,
                'label' => $translationFile . ':tt_content.tx_starter_celink',
                'config' => [
                    'type' => 'input',
                    'renderType' => 'inputLink',
                    'size' => 80,
                    'max' => 1024,
                    'eval' => 'trim',
                    'fieldControl' => [
                        'linkPopup' => [
                            'options' => [
                                'title' => 'LLL:EXT:frontend/Resources/Private/Language/locallang_ttc.xlf:header_link_formlabel',
                            ],
                        ],
                    ],
                    'softref' => 'typolink',
                ],
            ],
            'tx_starter_celink_text' => [
                'l10n_mode' => 'prefixLangTitle',
                'exclude' => true,
                'label' => $translationFile . ':tt_content.tx_starter_celink_text_formlabel',
                'config' => [
                    'type' => 'input',
                    'size' => 40,
                    'max' => 255,
                ],
            ],
            'tx_starter_ctalink' => [
                'exclude' => true,
                'label' => $translationFile . ':tt_content.tx_starter_ctalink_formlabel',
                'config' => [
                    'type' => 'input',
                    'renderType' => 'inputLink',
                    'size' => 80,
                    'max' => 1024,
                    'eval' => 'trim',
                    'fieldControl' => [
                        'linkPopup' => [
                            'options' => [
                                'title' => 'LLL:EXT:frontend/Resources/Private/Language/locallang_ttc.xlf:header_link_formlabel',
                                'blindLinkOptions' => 'folder, spec, telephone',
                                'blindLinkFields' => 'class, params',
                            ],
                        ],
                    ],
                    'softref' => 'typolink',
                ],
            ],
            'tx_starter_ctalink_text' => [
                'l10n_mode' => 'prefixLangTitle',
                'exclude' => true,
                'label' => $translationFile . ':tt_content.tx_starter_ctalink_text_formlabel',
                'config' => [
                    'type' => 'input',
                    'size' => 40,
                    'max' => 255,
                ],
            ],
            'tx_starter_backgroundcolor' => [
                'exclude' => true,
                'label' => $translationFile . ':tt_content.tx_starter_backgroundcolor',
                'config' => [
                    'type' => 'select',
                    'renderType' => 'selectSingle',
                    'items' => [
                        [$translationFile . ':ttc_ge.label.nothing', ''],
                    ],
                    'maxitems' => 1,
                ],
                'default' => '',
            ],
            'tx_starter_bordercolor' => [
                'exclude' => true,
                'label' => $translationFile . ':tt_content.tx_starter_bordercolor',
                'config' => [
                    'type' => 'select',
                    'renderType' => 'selectSingle',
                    'items' => [
                        [$translationFile . ':ttc_ge.label.nothing', ''],
                    ],
                    'maxitems' => 1,
                ],
                'default' => '',
            ],
            'tx_starter_headercolor' => [
                'exclude' => true,
                'label' => $translationFile . ':tt_content.tx_starter_headercolor',
                'config' => [
                    'type' => 'select',
                    'renderType' => 'selectSingle',
                    'items' => [
                        [$translationFile . ':ttc_ge.label.nothing', ''],
                    ],
                    'maxitems' => 1,
                ],
                'default' => '',
            ],
            'tx_starter_textcolor' => [
                'exclude' => true,
                'label' => $translationFile . ':tt_content.tx_starter_textcolor',
                'config' => [
                    'type' => 'select',
                    'renderType' => 'selectSingle',
                    'items' => [
                        [$translationFile . ':ttc_ge.label.nothing', ''],
                    ],
                    'maxitems' => 1,
                ],
                'default' => '',
            ],
            'tx_starter_headerclass' => [
                'exclude' => true,
                'label' => $translationFile . ':tt_content.tx_starter_headerclass',
                'config' => [
                    'type' => 'select',
                    'renderType' => 'selectSingle',
                    'items' => [
                        [$translationFile . ':ttc_ge.label.nothing', ''],
                    ],
                    'maxitems' => 1,
                ],
                'default' => '',
            ],
            'tx_starter_textclass' => [
                'exclude' => true,
                'label' => $translationFile . ':tt_content.tx_starter_textclass',
                'config' => [
                    'type' => 'select',
                    'renderType' => 'selectSingle',
                    'items' => [
                        [$translationFile . ':ttc_ge.label.nothing', ''],
                    ],
                    'maxitems' => 1,
                ],
                'default' => '',
            ],
            'tx_starter_headerfontsize' => [
                'exclude' => true,
                'label' => $translationFile . ':tt_content.tx_starter_headerfontsize',
                'config' => [
                    'type' => 'select',
                    'renderType' => 'selectSingle',
                    'items' => [
                        [$translationFile . ':ttc_ge.label.nothing', ''],
                        [$translationFile . ':tt_content.tx_starter_headerfontsize.I.1', 'o-header--size-h1'],
                        [$translationFile . ':tt_content.tx_starter_headerfontsize.I.2', 'o-header--size-h2'],
                        [$translationFile . ':tt_content.tx_starter_headerfontsize.I.3', 'o-header--size-h3'],
                        [$translationFile . ':tt_content.tx_starter_headerfontsize.I.4', 'o-header--size-h4'],
                        [$translationFile . ':tt_content.tx_starter_headerfontsize.I.5', 'o-header--size-h5'],
                        [$translationFile . ':tt_content.tx_starter_headerfontsize.I.6', 'o-header--size-h6'],
                        [$translationFile . ':tt_content.tx_starter_headerfontsize.I.0', 'o-header--size-p'],
                    ],
                    'maxitems' => 1,
                ],
                'default' => '',
            ],
            'tx_starter_overline' => [
                'exclude' => true,
                'label' => $translationFile . ':tt_content.tx_starter_overline',
                'config' => [
                    'type' => 'input',
                    'size' => 80,
                    'max' => 80,
                ],
            ],
            'tx_starter_overlay_text' => [
                'l10n_mode' => 'prefixLangTitle',
                'exclude' => true,
                'label' => $translationFile . ':tt_content.tx_starter_overlaytext',
                'config' => [
                    'type' => 'text',
                    'enableRichtext' => true,
                    'cols' => '80',
                    'rows' => '15',
                    'softref' => 'typolink_tag,images,email[subst],url',
                ],
            ],
            'tx_starter_width' => [
                'exclude' => true,
                'label' => $translationFile . ':tt_content.tx_starter_width',
                'config' => [
                    'type' => 'select',
                    'renderType' => 'selectSingle',
                    'items' => [
                        ['', ''],
                    ],
                    'maxitems' => 1,
                ],
                'default' => '',
            ],
            'tx_starter_height' => [
                'exclude' => true,
                'label' => $translationFile . ':tt_content.tx_starter_height',
                'config' => [
                    'type' => 'select',
                    'renderType' => 'selectSingle',
                    'items' => [
                        [$translationFile . ':ttc_ge.label.nothing', ''],
                        [$translationFile . ':tt_content.tx_starter_height.I.1', 'height-25vh'],
                        [$translationFile . ':tt_content.tx_starter_height.I.2', 'height-33vh'],
                        [$translationFile . ':tt_content.tx_starter_height.I.3', 'height-50vh'],
                        [$translationFile . ':tt_content.tx_starter_height.I.4', 'height-66vh'],
                        [$translationFile . ':tt_content.tx_starter_height.I.5', 'height-75vh'],
                        [$translationFile . ':tt_content.tx_starter_height.I.6', 'height-100vh'],
                    ],
                    'maxitems' => 1,
                ],
                'default' => '',
            ],
            'tx_starter_assets_medium' => [
                'label' => $translationFile . ':starter.asset_medium_references',
                'config' => \TYPO3\CMS\Core\Utility\ExtensionManagementUtility::getFileFieldTCAConfig(
                    'tx_starter_assets_medium',
                    [
                        'appearance' => [
                            'createNewRelationLinkTitle' => 'LLL:EXT:frontend/Resources/Private/Language/Database.xlf:tt_content.asset_references.addFileReference',
                        ],
                        'overrideChildTca' => [
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
                                ],
                            ],
                        ],
                    ],
                    'jpg,jpeg,png,svg'
                ),
            ],
            'tx_starter_assets_large' => [
                'label' => $translationFile . ':starter.asset_large_references',
                'config' => \TYPO3\CMS\Core\Utility\ExtensionManagementUtility::getFileFieldTCAConfig(
                    'tx_starter_assets_large',
                    [
                        'appearance' => [
                            'createNewRelationLinkTitle' => 'LLL:EXT:frontend/Resources/Private/Language/Database.xlf:tt_content.asset_references.addFileReference',
                        ],
                        'overrideChildTca' => [
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
                                ],
                            ],
                        ],
                    ],
                    'jpg,jpeg,png,svg'
                ),
            ],
            'tx_starter_media_size_small' => [
                'exclude' => true,
                'label' => $translationFile . ':media_size_small',
                'config' => [
                    'type' => 'select',
                    'renderType' => 'selectSingle',
                    'items' => [
                        [$translationFile . ':media_size.default', ''],
                    ],
                    'default' => '',
                ],
            ],
            'tx_starter_media_size_medium' => [
                'exclude' => true,
                'label' => $translationFile . ':media_size_medium',
                'config' => [
                    'type' => 'select',
                    'renderType' => 'selectSingle',
                    'items' => [
                        [$translationFile . ':tt_content.label.inheritfromsmallerdisplay', ''],
                    ],
                    'default' => '',
                ],
            ],
            'tx_starter_media_size_large' => [
                'exclude' => true,
                'label' => $translationFile . ':media_size_large',
                'config' => [
                    'type' => 'select',
                    'renderType' => 'selectSingle',
                    'items' => [
                        [$translationFile . ':tt_content.label.inheritfromsmallerdisplay', ''],
                    ],
                    'default' => '',
                ],
            ],
            'tx_starter_imagecols_medium' => $GLOBALS['TCA']['tt_content']['columns']['imagecols'],
            'tx_starter_imagecols_large' => $GLOBALS['TCA']['tt_content']['columns']['imagecols'],
            'tx_starter_carousel_element' => [
                'exclude' => 1,
                'label' => 'LLL:EXT:starter/Resources/Private/Language/locallang_be.xlf:carousel_element_formlabel',
                'config' => [
                    'type' => 'inline',
                    'allowed' => 'tx_starter_carousel_element',
                    'foreign_table' => 'tx_starter_carousel_element',
                    'foreign_sortby' => 'sorting',
                    'foreign_field' => 'tt_content_carousel',
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
                        'showRemovedLocalizationRecords' => true,
                        'showAllLocalizationLink' => true,
                        'showSynchronizationLink' => true,
                        'enabledControls' => [
                            'info' => false,
                        ],
                    ],
                ],
            ],
            'tx_starter_accordion_element' => [
                'exclude' => 1,
                'label' => 'LLL:EXT:starter/Resources/Private/Language/locallang_be.xlf:accordion_element_formlabel',
                'config' => [
                    'type' => 'inline',
                    'allowed' => 'tx_starter_accordion_element',
                    'foreign_table' => 'tx_starter_accordion_element',
                    'foreign_sortby' => 'sorting',
                    'foreign_field' => 'tt_content_accordion',
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
                        'showRemovedLocalizationRecords' => true,
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

    \TYPO3\CMS\Core\Utility\ExtensionManagementUtility::addFieldsToPalette(
        'tt_content',
        'headers',
        'tx_starter_overline, --linebreak--,',
        'before:header'
    );

    \TYPO3\CMS\Core\Utility\ExtensionManagementUtility::addFieldsToPalette(
        'tt_content',
        'header',
        'tx_starter_overline, --linebreak--,',
        'before:header'
    );

    \TYPO3\CMS\Core\Utility\ExtensionManagementUtility::addFieldsToPalette(
        'tt_content',
        'headers',
        'tx_starter_headerclass, tx_starter_headercolor, tx_starter_headerfontsize, --linebreak--,',
        'before:header_link'
    );

    \TYPO3\CMS\Core\Utility\ExtensionManagementUtility::addFieldsToPalette(
        'tt_content',
        'header',
        'tx_starter_headerclass, tx_starter_headercolor, tx_starter_headerfontsize, --linebreak--,',
        'before:header_link'
    );

    \TYPO3\CMS\Core\Utility\ExtensionManagementUtility::addFieldsToPalette(
        'tt_content',
        'general',
        '--linebreak--, tx_starter_celink,',
        'after:colPos'
    );

    \TYPO3\CMS\Core\Utility\ExtensionManagementUtility::addFieldsToPalette(
        'tt_content',
        'frames',
        'tx_starter_width',
        'before:layout'
    );

    \TYPO3\CMS\Core\Utility\ExtensionManagementUtility::addFieldsToPalette(
        'tt_content',
        'starterCeTeaserGeneral',
        '--linebreak--, tx_starter_celink,',
        'after:colPos'
    );

    \TYPO3\CMS\Core\Utility\ExtensionManagementUtility::addToAllTCAtypes(
        'tt_content',
        '--palette--;' . $translationFile . ':palette.appearanceColor;starterAppearanceColor,',
        '',
        'after:space_after_class'
    );

    \TYPO3\CMS\Core\Utility\ExtensionManagementUtility::addToAllTCAtypes(
        'tt_content',
        '--palette--;' . $translationFile . ':palette.cta;starterCta,',
        '',
        'before:bodytext'
    );

    \TYPO3\CMS\Core\Utility\ExtensionManagementUtility::addToAllTCAtypes(
        'tt_content',
        '--palette--;' . $translationFile . ':palette.textoptions;starterTextOptionPalette,',
        '',
        'after:bodytext'
    );
})();
