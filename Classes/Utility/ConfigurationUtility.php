<?php

namespace StarterTeam\Starter\Utility;

use TYPO3\CMS\Core\Utility\ArrayUtility;
use TYPO3\CMS\Core\Utility\GeneralUtility;

/**
 * Class ConfigurationUtility
 */
class ConfigurationUtility
{
    /**
     * Array with all content elements and definition of type icons
     *
     * @var array
     */
    public static $contentElements = [
        'starter_carousel' => [
            'typeIconClass' => 'content-carousel',
            'typeIconPath' => 'EXT:core/Resources/Public/Icons/T3Icons/content/content-carousel.svg',
            'previewTemplate' => 'Carousel',
        ],
        'starter_accordion' => [
            'typeIconClass' => 'content-accordion',
            'typeIconPath' => 'EXT:core/Resources/Public/Icons/T3Icons/content/content-accordion.svg',
            'previewTemplate' => 'Accordion',
        ],
        'starter_tab' => [
            'typeIconClass' => 'content-tab',
            'typeIconPath' => 'EXT:core/Resources/Public/Icons/T3Icons/content/content-tab.svg',
            'previewTemplate' => 'Tab',
        ],
        'starter_textmedia' => [
            'typeIconClass' => 'mimetypes-x-content-text-media',
            'typeIconPath' => 'EXT:core/Resources/Public/Icons/T3Icons/mimetypes/mimetypes-x-content-text-media.svg',
            'previewTemplate' => 'TextMedia',
        ],
        'starter_media' => [
            'typeIconClass' => 'mimetypes-media-video',
            'typeIconPath' => 'EXT:core/Resources/Public/Icons/T3Icons/mimetypes/mimetypes-media-video.svg',
            'previewTemplate' => 'Media',
        ],
        'starter_gallery' => [
            'typeIconClass' => 'content-image',
            'typeIconPath' => 'EXT:core/Resources/Public/Icons/T3Icons/content/content-image.svg',
            'previewTemplate' => 'Gallery',
        ],
        'starter_stop' => [
            'typeIconClass' => 'starter-ctype-starter_stop',
            'typeIconPath' => 'EXT:core/Resources/Public/Icons/T3Icons/apps/apps-pagetree-drag-place-denied.svg',
            'previewTemplate' => 'Stop',
        ],
        'starter_teaser' => [
            'typeIconClass' => 'starter-ctype-starter_teaser',
            'typeIconPath' => 'EXT:core/Resources/Public/Icons/T3Icons/content/content-text-teaser.svg',
            'previewTemplate' => 'Teaser',
        ],
        'starter_column_grid' => [
            'typeIconClass' => 'starter-ctype-starter_column_grid',
            'typeIconPath' => 'EXT:core/Resources/Public/Icons/T3Icons/content/content-text-columns.svg',
            'previewTemplate' => 'ColumnGrid',
        ],
    ];

    /**
     * Array with all additional tables and their type icons
     *
     * @var array
     */
    public static $contentElementTables = [
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

    /**
     * @param string $table
     * @param string $cType
     * @param string $field
     * @param array $customerSettingOverride
     * @param array $removeSettings
     */
    public static function overrideCropSettings(
        string $table,
        string $cType,
        string $field,
        array $customerSettingOverride = [],
        $removeSettings = []
    ) {
        if (!is_string($table)) {
            throw new \InvalidArgumentException(
                'Given table is of type "' . gettype($cType) . '" but a string is expected.',
                1303236963
            );
        }

        if (!is_string($cType)) {
            throw new \InvalidArgumentException(
                'Given CType is of type "' . gettype($cType) . '" but a string is expected.',
                1303236963
            );
        }

        if (!is_string($field)) {
            throw new \InvalidArgumentException(
                'Given field is of type "' . gettype($field) . '" but a string is expected.',
                1303236964
            );
        }

        if (!isset($GLOBALS['TCA'][$table]['types'][$cType])
            || !is_array($GLOBALS['TCA'][$table]['types'][$cType])
        ) {
            throw new \RuntimeException('Given CType was not found.', 1303237468);
        }

        if (!isset($GLOBALS['TCA'][$table]['columns'][$field])
            || !is_array($GLOBALS['TCA'][$table]['columns'][$field])
        ) {
            throw new \RuntimeException('Given field was not found.', 1303237468);
        }

        $configToOverride = &$GLOBALS['TCA'][$table]['types'][$cType]['columnsOverrides'][$field]['config'];
        $overrideChildTca = &$configToOverride['overrideChildTca']['columns']['crop']['config'];
        $overrideChildTca['cropVariants'] = \StarterTeam\Starter\Utility\ConfigurationUtility::getMediaCropSettings(
            $customerSettingOverride,
            $removeSettings
        );
    }

    /**
     * @param array $customSettingOverride
     * @param array $removeSettings
     * @return array
     */
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

        if (!empty($removeSettings)) {
            foreach ($removeSettings as $option => $value) {
                if (array_key_exists($option, $mediaCropSettings)) {
                    $ratiosToRemove = GeneralUtility::trimExplode(',', $value);

                    foreach ($ratiosToRemove as $removeRatio) {
                        $pathToRemove = $option . '/allowedAspectRatios/' . $removeRatio;
                        $mediaCropSettings = ArrayUtility::removeByPath($mediaCropSettings, $pathToRemove);
                    }
                }
            }
        }

        return $mediaCropSettings;
    }

    public static $contentGridElementsColPos = [
        'tx_starter_column_element' => 1705,
    ];

    /**
     * @param array $formDataResult
     * @return array|null
     */
    public static function getInlineElementSettings(array $formDataResult): ?array
    {
        $currentColPos = is_array($formDataResult['databaseRow']['colPos'])
            ? (int)$formDataResult['databaseRow']['colPos'][0]
            : (int)$formDataResult['databaseRow']['colPos'];

        $inlineContentSettings = array_filter(
            $formDataResult['pageTsConfig']['tx_starter.']['inlineContentElementSettings.'],
            function ($itemSettings) use ($currentColPos) {
                return (int)$itemSettings['colPos'] === $currentColPos ? true : false;
            }
        );
        $inlineContentSettings = array_shift($inlineContentSettings);

        return $inlineContentSettings;
    }
}
