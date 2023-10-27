<?php

defined('TYPO3') || die();

(function () {
    $allowedFileExtensions = 'doc,docx,jpg,jpeg,pdf,ppt,pptx,xls,xlsx,zip';
    $translationFile = 'LLL:EXT:starter/Resources/Private/Language/locallang_be.xlf:';
    $cType = 'starter_download';

    $GLOBALS['TCA']['tt_content']['types'][$cType] = [
        'showitem' => '
        --div--;LLL:EXT:core/Resources/Private/Language/Form/locallang_tabs.xlf:general,
            --palette--;LLL:EXT:frontend/Resources/Private/Language/locallang_ttc.xlf:palette.general;general,
            --palette--;LLL:EXT:frontend/Resources/Private/Language/locallang_ttc.xlf:palette.headers;headers,
            bodytext;LLL:EXT:frontend/Resources/Private/Language/locallang_ttc.xlf:bodytext_formlabel,
            --palette--;LLL:EXT:frontend/Resources/Private/Language/locallang_ttc.xlf:media;uploads,
            --palette--;;uploadslayout,
        --div--;LLL:EXT:frontend/Resources/Private/Language/locallang_ttc.xlf:tabs.appearance,
            --palette--;;frames,
            --palette--;;appearanceLinks,
        --div--;LLL:EXT:core/Resources/Private/Language/Form/locallang_tabs.xlf:language,
            --palette--;;language,
        --div--;LLL:EXT:core/Resources/Private/Language/Form/locallang_tabs.xlf:access,
            --palette--;;hidden,
            --palette--;LLL:EXT:frontend/Resources/Private/Language/locallang_ttc.xlf:palette.access;access,
        --div--;LLL:EXT:core/Resources/Private/Language/Form/locallang_tabs.xlf:notes,
            rowDescription,
        --div--;LLL:EXT:core/Resources/Private/Language/Form/locallang_tabs.xlf:extended,
    ',
        'columnsOverrides' => [
            'bodytext' => [
                'config' => [
                    'enableRichtext' => true,
                    'richtextConfiguration' => 'default',
                ],
            ],
            'media' => [
                'config' => [
                    'minitems' => 0,
                    'maxitems' => 10,
                    'overrideChildTca' => [
                        'columns' => [
                            'uid_local' => [
                                'config' => [
                                    'appearance' => [
                                        'elementBrowserAllowed' => $allowedFileExtensions,
                                    ],
                                ],
                            ],
                            'title' => [
                                'label' => $translationFile . 'sys_file_reference.title',
                                'config' => [
                                    'max' => 80,
                                ],
                            ],
                            'description' => [
                                'label' => $translationFile . 'sys_file_reference.description',
                            ],
                        ],
                    ],
                ],
            ],
        ],
    ];

    \TYPO3\CMS\Core\Utility\ExtensionManagementUtility::addPlugin(
        [
            $translationFile . 'CType.I.' . $cType,
            $cType,
            'starter-ctype-' . $cType,
        ],
        'CType',
        'starter'
    );
})();
