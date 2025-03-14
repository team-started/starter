<?php

declare(strict_types=1);

namespace StarterTeam\Starter\Utility;

use InvalidArgumentException;
use RuntimeException;
use TYPO3\CMS\Core\Utility\ArrayUtility;
use TYPO3\CMS\Core\Utility\GeneralUtility;

/**
 * Class ConfigurationUtility
 */
class ConfigurationUtility
{
    /**
     * Array with all content elements and definition of type icons
     */
    public static array $contentElements = [
        'starter_carousel' => [
            'typeIconPath' => 'EXT:core/Resources/Public/Icons/T3Icons/svgs/content/content-carousel.svg',
        ],
        'starter_accordion' => [
            'typeIconPath' => 'EXT:core/Resources/Public/Icons/T3Icons/svgs/content/content-accordion.svg',
        ],
        'starter_distribution_navigation' => [
            'typeIconPath' => 'EXT:core/Resources/Public/Icons/T3Icons/svgs/content/content-special-menu.svg',
        ],
        'starter_m27_download' => [
            'typeIconPath' => 'EXT:core/Resources/Public/Icons/T3Icons/svgs/actions/actions-database-export.svg',
            'allowedFileExtensions' => 'doc,docx,jpg,jpeg,pdf,potx,ppt,pptx,xls,xlsx,zip,msg,oft,rtf',
        ],
        'starter_tab' => [
            'typeIconPath' => 'EXT:core/Resources/Public/Icons/T3Icons/svgs/content/content-tab.svg',
        ],
        'starter_textmedia' => [
            'typeIconPath' => 'EXT:core/Resources/Public/Icons/T3Icons/svgs/mimetypes/mimetypes-x-content-text-media.svg',
        ],
        'starter_media' => [
            'typeIconPath' => 'EXT:core/Resources/Public/Icons/T3Icons/svgs/mimetypes/mimetypes-media-video.svg',
        ],
        'starter_gallery' => [
            'typeIconPath' => 'EXT:core/Resources/Public/Icons/T3Icons/svgs/content/content-image.svg',
        ],
        'starter_stop' => [
            'typeIconPath' => 'EXT:core/Resources/Public/Icons/T3Icons/svgs/apps/apps-pagetree-drag-place-denied.svg',
        ],
        'starter_teaser' => [
            'typeIconPath' => 'EXT:core/Resources/Public/Icons/T3Icons/svgs/content/content-text-teaser.svg',
        ],
        'starter_column_grid' => [
            'typeIconPath' => 'EXT:core/Resources/Public/Icons/T3Icons/svgs/content/content-text-columns.svg',
        ],
    ];

    /**
     * Array with all additional tables and their type icons
     */
    public static array $contentElementTables = [
        'tx_starter_carousel_element_image' => [
            'typeIconPath' => 'EXT:core/Resources/Public/Icons/T3Icons/content/content-image.svg',
        ],
        'tx_starter_carousel_element_text' => [
            'typeIconPath' => 'EXT:core/Resources/Public/Icons/T3Icons/content/content-text.svg',
        ],
        'tx_starter_accordion_element_image' => [
            'typeIconPath' => 'EXT:core/Resources/Public/Icons/T3Icons/content/content-textpic.svg',
        ],
        'tx_starter_accordion_element_text' => [
            'typeIconPath' => 'EXT:core/Resources/Public/Icons/T3Icons/content/content-text.svg',
        ],
        'tx_starter_tab_element_image' => [
            'typeIconPath' => 'EXT:core/Resources/Public/Icons/T3Icons/content/content-textpic.svg',
        ],
        'tx_starter_tab_element_text' => [
            'typeIconPath' => 'EXT:core/Resources/Public/Icons/T3Icons/content/content-text.svg',
        ],
    ];

    public static function overrideCropSettings(
        string $table,
        string $cType,
        string $field,
        array $customerSettingOverride = [],
        array $removeSettings = []
    ): void {
        if ($table === '') {
            throw new InvalidArgumentException(
                'Given table is of type "' . gettype($cType) . '" but a string is expected.',
                1_303_236_963
            );
        }

        if ($cType === '') {
            throw new InvalidArgumentException(
                'Given CType is of type "' . gettype($cType) . '" but a string is expected.',
                1_303_236_963
            );
        }

        if ($field === '') {
            throw new InvalidArgumentException(
                'Given field is of type "' . gettype($field) . '" but a string is expected.',
                1_303_236_964
            );
        }

        if (!isset($GLOBALS['TCA'][$table]['types'][$cType])
            || !is_array($GLOBALS['TCA'][$table]['types'][$cType])
        ) {
            throw new RuntimeException('Given CType was not found.', 1_303_237_468);
        }

        if (!isset($GLOBALS['TCA'][$table]['columns'][$field])
            || !is_array($GLOBALS['TCA'][$table]['columns'][$field])
        ) {
            throw new RuntimeException('Given field was not found.', 1_303_237_468);
        }

        $configToOverride = &$GLOBALS['TCA'][$table]['types'][$cType]['columnsOverrides'][$field]['config'];
        $overrideChildTca = &$configToOverride['overrideChildTca']['columns']['crop']['config'];
        $overrideChildTca['cropVariants'] = \StarterTeam\Starter\Utility\ConfigurationUtility::getMediaCropSettings(
            $customerSettingOverride,
            $removeSettings
        );
    }

    public static function getMediaCropSettings(array $customSettingOverride = [], array $removeSettings = []): array
    {
        $mediaCropSettings = [
            'smartphone' => [
                'title' => 'Default Smartphone',
                'selectedRatio' => 'NaN',
                'allowedAspectRatios' => [
                    'square' => [
                        'title' => 'Quadrat (1 : 1)',
                        'value' => 1.0,
                    ],

                    'portrait' => [
                        'title' => 'Portrait (2 : 3)',
                        'value' => 0.6666666667,
                    ],

                    'portrait2' => [
                        'title' => 'Portrait (3 : 4)',
                        'value' => 0.75,
                    ],
                ],
            ],
            'tablet' => [
                'title' => 'Default Tablet',
                'selectedRatio' => 'NaN',
                'allowedAspectRatios' => [
                    'square' => [
                        'title' => 'Quadrat (1 : 1)',
                        'value' => 1.0,
                    ],

                    'portrait' => [
                        'title' => 'Portrait (2 : 3)',
                        'value' => 0.6666666667,
                    ],

                    'portrait2' => [
                        'title' => 'Portrait (3 : 4)',
                        'value' => 0.75,
                    ],

                    'quer' => [
                        'title' => 'Querformat 2 (3 : 2)',
                        'value' => 1.5,
                    ],

                    'quer2' => [
                        'title' => 'Querformat (4 : 3)',
                        'value' => 1.3333333333,
                    ],

                    'wide' => [
                        'title' => 'Wide Screen (16 : 9)',
                        'value' => 1.7777777778,
                    ],
                ],
            ],
            'desktop' => [
                'title' => 'Default Desktop',
                'selectedRatio' => 'NaN',
                'allowedAspectRatios' => [
                    'NaN' => [
                        'title' => 'Free',
                        'value' => 0.0,
                    ],
                    'cinema' => [
                        'title' => 'Kino (2.35 : 1)',
                        'value' => 2.35,
                    ],
                    'square' => [
                        'title' => 'Quadrat (1 : 1)',
                        'value' => 1.0,
                    ],

                    'portrait' => [
                        'title' => 'Portrait (2 : 3)',
                        'value' => 0.6666666667,
                    ],

                    'portrait2' => [
                        'title' => 'Portrait (3 : 4)',
                        'value' => 0.75,
                    ],

                    'quer' => [
                        'title' => 'Querformat 2 (3 : 2)',
                        'value' => 1.5,
                    ],

                    'quer2' => [
                        'title' => 'Querformat (4 : 3)',
                        'value' => 1.3333333333,
                    ],

                    'wide' => [
                        'title' => 'Wide Screen (16 : 9)',
                        'value' => 1.7777777778,
                    ],

                    'ultrawide' => [
                        'title' => 'Ultrawide Screen (32 : 9)',
                        'value' => 3.55555556,
                    ],
                ],
            ],
        ];

        ArrayUtility::mergeRecursiveWithOverrule($mediaCropSettings, $customSettingOverride);

        foreach ($removeSettings as $option => $value) {
            if (array_key_exists($option, $mediaCropSettings)) {
                $ratiosToRemove = GeneralUtility::trimExplode(',', $value);

                foreach ($ratiosToRemove as $removeRatio) {
                    $pathToRemove = $option . '/allowedAspectRatios/' . $removeRatio;
                    $mediaCropSettings = ArrayUtility::removeByPath($mediaCropSettings, $pathToRemove);
                }
            }
        }

        return $mediaCropSettings;
    }

    public static array $contentGridElementsColPos = [
        'tx_starter_column_element' => 1705,
    ];

    public static function getInlineElementSettings(array $formDataResult): ?array
    {
        $currentColPos = is_array($formDataResult['databaseRow']['colPos'])
            ? (int)$formDataResult['databaseRow']['colPos'][0]
            : (int)$formDataResult['databaseRow']['colPos'];

        $inlineContentSettings = array_filter(
            $formDataResult['pageTsConfig']['tx_starter.']['inlineContentElementSettings.'],
            fn($itemSettings) => (int)$itemSettings['colPos'] === $currentColPos
        );

        return array_shift($inlineContentSettings);
    }

    public static function getColPosForStarterColumnElement(): int
    {
        return static::$contentGridElementsColPos['tx_starter_column_element'];
    }

    public static function getAllowedFileExtensions(string $CType): string
    {
        if (self::$contentElements[$CType]['allowedFileExtensions']) {
            return self::$contentElements[$CType]['allowedFileExtensions'];
        }

        return '';
    }
}
