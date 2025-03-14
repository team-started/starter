<?php

use StarterTeam\Starter\Configuration;
use TYPO3\CMS\Core\Resource\File;
use TYPO3\CMS\Core\Utility\ExtensionManagementUtility;

defined('TYPO3') || die();

(function () {
    foreach (Configuration::getDefaultBackendLayouts() as $backendLayout) {
        ExtensionManagementUtility::registerPageTSConfigFile(
            'starter',
            'Configuration/TSConfig/BackendLayouts/' . $backendLayout . '.typoscript',
            'Backend-Layout ' . $backendLayout
        );
    }

    ExtensionManagementUtility::registerPageTSConfigFile(
        'starter',
        'Configuration/TSConfig/Main.typoscript',
        'Main page TS configuration'
    );

    ExtensionManagementUtility::registerPageTSConfigFile(
        'starter',
        'Configuration/TSConfig/CkEditor.typoscript',
        'CkEditor configuration'
    );
})();

(function () {
    $table = 'pages';

    ExtensionManagementUtility::addTCAcolumns(
        $table,
        [
            'tx_starter_nav_media' => [
                'label' => 'LLL:EXT:starter/Resources/Private/Language/locallang_be.xlf:pages.tx_starter_nav_media',
                'exclude' => true,
                'config' => [
                    //## !!! Watch out for fieldName different from columnName
                    'type' => 'file',
                    'appearance' => [
                        'createNewRelationLinkTitle' => 'LLL:EXT:frontend/Resources/Private/Language/locallang_ttc.xlf:media.addFileReference',
                    ],
                    'maxitems' => 1,
                    'overrideChildTca' => [
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
        ]
    );

    foreach (['tx_starter_nav_media'] as $column) {
        ExtensionManagementUtility::addFieldsToPalette(
            $table,
            'media',
            '--linebreak--,' . $column
        );
    }
})();
