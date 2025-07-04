<?php

use TYPO3\CMS\Core\Utility\ExtensionManagementUtility;

defined('TYPO3') || die();

(function () {
    $translationFile = 'LLL:EXT:starter/Resources/Private/Language/locallang_be.xlf';

    ExtensionManagementUtility::addTCAcolumns(
        'tt_content',
        [
            'tx_starter_celink' => [
                'exclude' => true,
                'label' => $translationFile . ':tt_content.tx_starter_celink',
                'config' => [
                    'type' => 'link',
                    'size' => 80,
                    'appearance' => [
                        'browserTitle' => 'LLL:EXT:frontend/Resources/Private/Language/locallang_ttc.xlf:header_link_formlabel',
                    ],
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
                    'type' => 'link',
                    'size' => 80,
                    'allowedTypes' => ['page', 'file', 'url', 'email', 'record'],
                    'appearance' => [
                        'browserTitle' => 'LLL:EXT:frontend/Resources/Private/Language/locallang_ttc.xlf:header_link_formlabel',
                        'allowedOptions' => ['target', 'title', 'rel'],
                    ],
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
                        [
                            'label' => $translationFile . ':ttc_ge.label.nothing',
                            'value' => '',
                        ],
                    ],
                    'maxitems' => 1,
                ],
                'default' => '',
            ],
            'tx_starter_background_fluid' => [
                'exclude' => true,
                'label' => $translationFile . ':tt_content.tx_starter_background_fluid',
                'config' => [
                    'type' => 'check',
                    'renderType' => 'checkboxToggle',
                ],
            ],
            'tx_starter_bordercolor' => [
                'exclude' => true,
                'label' => $translationFile . ':tt_content.tx_starter_bordercolor',
                'config' => [
                    'type' => 'select',
                    'renderType' => 'selectSingle',
                    'items' => [
                        [
                            'label' => $translationFile . ':ttc_ge.label.nothing',
                            'value' => '',
                        ],
                    ],
                    'maxitems' => 1,
                ],
                'default' => '',
            ],
            'tx_starter_visibility' => [
                'exclude' => true,
                'label' => $translationFile . ':tt_content.tx_starter_visibility',
                'config' => [
                    'type' => 'select',
                    'renderType' => 'selectSingle',
                    'items' => [
                        [
                            'label' => $translationFile . ':ttc_ge.label.nothing',
                            'value' => '',
                        ],
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
                        [
                            'label' => $translationFile . ':ttc_ge.label.nothing',
                            'value' => '',
                        ],
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
                        [
                            'label' => $translationFile . ':ttc_ge.label.nothing',
                            'value' => '',
                        ],
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
                        [
                            'label' => $translationFile . ':ttc_ge.label.nothing',
                            'value' => '',
                        ],
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
                        [
                            'label' => $translationFile . ':ttc_ge.label.nothing',
                            'value' => '',
                        ],
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
                        [
                            'label' => $translationFile . ':ttc_ge.label.nothing',
                            'value' => '',
                        ],
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
                        [
                            'label' => '',
                            'value' => '',
                        ],
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
                        [
                            'label' => $translationFile . ':ttc_ge.label.nothing',
                            'value' => '',
                        ],
                    ],
                    'maxitems' => 1,
                ],
                'default' => '',
            ],
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

    ExtensionManagementUtility::addFieldsToPalette(
        'tt_content',
        'headers',
        'tx_starter_overline, --linebreak--,',
        'before:header'
    );

    ExtensionManagementUtility::addFieldsToPalette(
        'tt_content',
        'header',
        'tx_starter_overline, --linebreak--,',
        'before:header'
    );

    ExtensionManagementUtility::addFieldsToPalette(
        'tt_content',
        'headers',
        'tx_starter_headerclass, tx_starter_headercolor, tx_starter_headerfontsize, --linebreak--,',
        'before:header_link'
    );

    ExtensionManagementUtility::addFieldsToPalette(
        'tt_content',
        'header',
        'tx_starter_headerclass, tx_starter_headercolor, tx_starter_headerfontsize, --linebreak--,',
        'before:header_link'
    );

    ExtensionManagementUtility::addFieldsToPalette(
        'tt_content',
        'general',
        '--linebreak--, tx_starter_celink,',
        'after:colPos'
    );

    ExtensionManagementUtility::addFieldsToPalette(
        'tt_content',
        'frames',
        'tx_starter_width',
        'before:layout'
    );

    ExtensionManagementUtility::addFieldsToPalette(
        'tt_content',
        'starterCeTeaserGeneral',
        '--linebreak--, tx_starter_celink,',
        'after:colPos'
    );

    ExtensionManagementUtility::addFieldsToPalette(
        'tt_content',
        'frames',
        '--linebreak--, tx_starter_visibility,',
        'after:space_after_class'
    );

    ExtensionManagementUtility::addToAllTCAtypes(
        'tt_content',
        '--palette--;' . $translationFile . ':palette.appearanceColor;starterAppearanceColor,',
        '',
        'after:space_after_class'
    );

    ExtensionManagementUtility::addToAllTCAtypes(
        'tt_content',
        '--palette--;;starterAppearanceBackground,',
        '',
        'after:space_after_class'
    );

    ExtensionManagementUtility::addToAllTCAtypes(
        'tt_content',
        '--palette--;' . $translationFile . ':palette.cta;starterCta,',
        '',
        'before:bodytext'
    );

    ExtensionManagementUtility::addToAllTCAtypes(
        'tt_content',
        '--palette--;' . $translationFile . ':palette.textoptions;starterTextOptionPalette,',
        '',
        'after:bodytext'
    );
})();
