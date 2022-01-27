<?php

defined('TYPO3_MODE') || die();

(function () {
    foreach (\StarterTeam\Starter\Configuration::getDefaultBackendLayouts() as $backendLayout) {
        \TYPO3\CMS\Core\Utility\ExtensionManagementUtility::registerPageTSConfigFile(
            'starter',
            'Configuration/TSConfig/BackendLayouts/' . $backendLayout . '.typoscript',
            'Backend-Layout ' . $backendLayout
        );
    }

    \TYPO3\CMS\Core\Utility\ExtensionManagementUtility::registerPageTSConfigFile(
        'starter',
        'Configuration/TSConfig/CkEditor.typoscript',
        'CkEditor configuration'
    );
})();

(function () {
    $table = 'pages';

    \TYPO3\CMS\Core\Utility\ExtensionManagementUtility::addTCAcolumns(
        $table,
        [
            'tx_starter_nav_media' => [
                'label' => 'LLL:EXT:starter/Resources/Private/Language/locallang_be.xlf:pages.tx_starter_nav_media',
                'exclude' => true,
                'config' => \TYPO3\CMS\Core\Utility\ExtensionManagementUtility::getFileFieldTCAConfig(
                    'tx_starter_nav_media',
                    [
                        'appearance' => [
                            'createNewRelationLinkTitle' => 'LLL:EXT:frontend/Resources/Private/Language/locallang_ttc.xlf:media.addFileReference',
                        ],
                        'maxitems' => 1,
                        'overrideChildTca' => [
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
                            ],
                        ],
                    ]
                ),
            ],
        ]
    );

    foreach (['tx_starter_nav_media'] as $column) {
        \TYPO3\CMS\Core\Utility\ExtensionManagementUtility::addFieldsToPalette(
            $table,
            'media',
            '--linebreak--,' . $column
        );
    }
})();
