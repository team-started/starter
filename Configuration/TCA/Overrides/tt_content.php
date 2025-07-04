<?php

use TYPO3\CMS\Core\Utility\ArrayUtility;

defined('TYPO3') || die();

// @codingStandardsIgnoreStart

(function () {
    // define new palettes for content elements
    ArrayUtility::mergeRecursiveWithOverrule(
        $GLOBALS['TCA']['tt_content'],
        [
            'palettes' => [
                'starterMedia' => [
                    'showitem' => 'assets',
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
                    'showitem' => 'tx_starter_bordercolor',
                ],
                'starterAppearanceBackground' => [
                    'label' => 'LLL:EXT:starter/Resources/Private/Language/locallang_be.xlf:palette.starterAppearanceBackground',
                    'showitem' => 'tx_starter_backgroundcolor, tx_starter_background_fluid',
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
                'starterUploads' => [
                    'showitem' =>
                        'media;LLL:EXT:frontend/Resources/Private/Language/locallang_ttc.xlf:media.ALT.uploads_formlabel',
                ],
            ],
        ]
    );
})();

// @codingStandardsIgnoreEnd
