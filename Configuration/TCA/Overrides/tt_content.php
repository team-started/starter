<?php

defined('TYPO3') || die();

// add content element type icons
(function () {
    foreach (\StarterTeam\Starter\Utility\ConfigurationUtility::$contentElements as $ceId => $properties) {
        \TYPO3\CMS\Core\Utility\ArrayUtility::mergeRecursiveWithOverrule(
            $GLOBALS['TCA']['tt_content'],
            [
                'ctrl' => [
                    'typeicon_classes' => [
                        $ceId => $properties['typeIconClass'],
                    ],
                ],
            ]
        );
    }
})();

// @codingStandardsIgnoreStart

(function () {
    // define new palettes for content elements
    \TYPO3\CMS\Core\Utility\ArrayUtility::mergeRecursiveWithOverrule(
        $GLOBALS['TCA']['tt_content'],
        [
            'palettes' => [
                'starterMedia' => [
                    'showitem' => '
                        assets, --linebreak--, tx_starter_assets_medium, --linebreak--, tx_starter_assets_large
                    ',
                ],
                'starterMediaAdjustments' => [
                    'showitem' => '
                        tx_starter_media_size_small, tx_starter_media_size_medium, tx_starter_media_size_large,
                        --linebreak--,
                        imagecols;LLL:EXT:starter/Resources/Private/Language/locallang_be.xlf:tt_content.imagecols,
                        tx_starter_imagecols_medium;LLL:EXT:starter/Resources/Private/Language/locallang_be.xlf:tt_content.imagecols_medium,
                        tx_starter_imagecols_large;LLL:EXT:starter/Resources/Private/Language/locallang_be.xlf:tt_content.imagecols_large
                    ',
                ],
                'starterMediaGallerySettings' => [
                    'showitem' => '
                        imageorient;LLL:EXT:frontend/Resources/Private/Language/locallang_ttc.xlf:imageorient_formlabel
                    ',
                ],
                'starterGallerySettings' => [
                    'showitem' => '
                        imagecols;LLL:EXT:frontend/Resources/Private/Language/locallang_ttc.xlf:imagecols_formlabel
                    ',
                ],
                'starterTextOptionPalette' => [
                    'showitem' => 'tx_starter_textclass, tx_starter_textcolor',
                ],
                'starterCta' => [
                    'showitem' => 'tx_starter_ctalink, tx_starter_ctalink_text',
                ],
                'starterAppearanceColor' => [
                    'showitem' => 'tx_starter_backgroundcolor, tx_starter_bordercolor',
                ],
                'starterCeTeaserGeneral' => [
                    'showitem' => '
                        CType;LLL:EXT:frontend/Resources/Private/Language/locallang_ttc.xlf:CType_formlabel,
                        colPos;LLL:EXT:frontend/Resources/Private/Language/locallang_ttc.xlf:colPos_formlabel,
                        tx_starter_celink_text,
                        --linebreak--,
                        tx_starter_celink
                    ',
                ],
                'starterCeTeaserHeader' => [
                    'showitem' => '
                        header,
                        --linebreak--,
                        header_layout;LLL:EXT:frontend/Resources/Private/Language/locallang_ttc.xlf:header_layout_formlabel,
                        tx_starter_headerclass,
                        tx_starter_headerfontsize
                    ',
                ],
            ],
        ]
    );
})();

// @codingStandardsIgnoreEnd
