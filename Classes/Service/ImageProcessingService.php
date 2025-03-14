<?php

declare(strict_types=1);

namespace StarterTeam\Starter\Service;

use TYPO3\CMS\Core\Resource\FileInterface;
use TYPO3\CMS\Core\Resource\FileReference;
use TYPO3\CMS\Frontend\ContentObject\ContentObjectRenderer;
use TYPO3\CMS\Frontend\Controller\TypoScriptFrontendController;

/**
 * Class ImageProcessingService
 */
class ImageProcessingService
{
    public const array DEFAULT_FILE_PROCESSOR_CONFIGURATION = [
        'dataProcessing.' => [
            '10' => 'TYPO3\CMS\Frontend\DataProcessing\FilesProcessor',
            '10.' => [
                'as' => 'media',
                'references.' => [
                    'fieldName' => 'assets',
                    'table' => 'tt_content',
                ],
            ],
        ],
    ];

    protected TypoScriptFrontendController $tsfe;

    /**
     * ImageProcessingService constructor.
     * @SusppressWarning(PHPMD.Superglobals)
     */
    public function __construct(
        protected ContentObjectRenderer $contentObjectRenderer,
    ) {
        $this->tsfe = $GLOBALS['TSFE'];
    }

    /**
     * Override the default file processor configuration.
     *
     * @param string $fieldName reference database field of media record
     * @param string $table database table of record
     * @return array|array[]
     */
    public function getDefaultFileProcessorConfigurationWithReferenceField(
        string $fieldName = '',
        string $table = ''
    ): array {
        $config = self::DEFAULT_FILE_PROCESSOR_CONFIGURATION;

        if ($fieldName !== '') {
            $config['dataProcessing.']['10.']['references.']['fieldName'] = $fieldName;
        }

        if ($table !== '') {
            $config['dataProcessing.']['10.']['references.']['table'] = $table;
        }

        return $config;
    }

    public function process(
        array &$processedData,
        array $processorConfiguration,
        array $processedRecordVariables,
        string $targetVariableName
    ): void {
        foreach ($processedRecordVariables as $referenceField => $imageFiles) {
            if (empty($imageFiles['media'])) {
                continue;
            }

            foreach ($imageFiles['media'] as $imageFile) {
                $assetOptions = [];
                $assetOptions['default'] = $this->renderImage(
                    $imageFile,
                    $processorConfiguration['imageConfig.']['default.'] ?? []
                );

                if (isset($processorConfiguration['imageConfig.']['variants.'])
                    && !empty($processorConfiguration['imageConfig.']['variants.'])
                ) {
                    foreach ($processorConfiguration['imageConfig.']['variants.'] as $variant) {
                        $assetOptions['variants'][] = $this->renderImage(
                            $imageFile,
                            $variant['config.']
                        );
                    }
                }

                $assetOptions['metaData'] = $this->getMetaData($imageFile);

                $processedData[$targetVariableName][$referenceField][] = $assetOptions;
            }
        }
    }

    protected function renderImage(FileReference $file, array $conf = []): array
    {
        $defaultImageResource = $this->contentObjectRenderer->getImgResource($file, $conf);
        if (is_null($defaultImageResource)) {
            return [];
        }

        $retinaImageResource = $this->renderRetinaImage($file, $conf);

        $assetOptions = [
            'uri' => [
                'default' => $this->addAbsRefPrefix($defaultImageResource[3]),
                'retina2x' => $this->addAbsRefPrefix($retinaImageResource),
            ],
            'width' => $defaultImageResource[0],
            'height' => $defaultImageResource[1],
            'ratio' => $defaultImageResource[0] / $defaultImageResource[1],
        ];

        self::clearAssetOptions($assetOptions, $conf);

        return $assetOptions;
    }

    protected function renderRetinaImage(FileReference $image, array $configuration): string
    {
        $retinaConfiguration = $this->getImageConfigurationForRetina($configuration);
        $imageResource = $this->contentObjectRenderer->getImgResource($image, $retinaConfiguration);

        if (is_null($imageResource)) {
            return '';
        }

        return $imageResource[3];
    }

    /**
     * Prepend the absRefPrefix from typoscript configuration to the image file path
     */
    protected function addAbsRefPrefix(string $uri): string
    {
        return $this->tsfe->absRefPrefix . $uri;
    }

    protected function clearAssetOptions(array &$asset, array $conf = []): void
    {
        if (isset($conf['mediaQuery'])) {
            $asset['mq'] = $conf['mediaQuery'];

            unset($asset['width']);
            unset($asset['height']);
        }
    }

    /**
     * Translate a TypoScript configuration for an imgResource function.
     * Doubles all values referring to the image dimensions like
     * width, height, …
     */
    protected function getImageConfigurationForRetina(array $defaultConfig = []): array
    {
        $retinaConfig = $defaultConfig;
        foreach (['maxW', 'maxH', 'width', 'height'] as $configKey) {
            if (isset($defaultConfig[$configKey])) {
                $defaultValue = $defaultConfig[$configKey];

                // match strings like "100c-300" and transform them to "200c-600"
                $splitRegexp = '/^(\d*)([cm]?)([+-]?)(\d*)$/';
                preg_match($splitRegexp, (string)$defaultValue, $matches);
                [$_, $value, $cropMode, $cropOffsetDirection, $cropOffsetValue] = $matches;

                $newValue = 2 * ((int)$value);

                if ((int)$cropOffsetValue > 0) {
                    $newCropOffsetDirection = $cropOffsetDirection;
                    $newCropOffsetValue = 2 * (int)$cropOffsetValue;
                } else {
                    $newCropOffsetDirection = '';
                    $newCropOffsetValue = '';
                }

                $retinaConfig[$configKey] = $newValue . $cropMode . $newCropOffsetDirection . $newCropOffsetValue;
            }
        }

        return $retinaConfig;
    }

    /**
     * Return all available media meta data.
     */
    protected function getMetaData(FileInterface $file): array
    {
        $properties = [
            'title' => 'title',
            'description' => 'description',
            'copyright' => 'copyright',
            'link' => 'link',
            'alternative' => 'alternative',
            'type' => 'type',
            'fileType' => 'extension',
        ];

        $metaData = [];

        foreach ($properties as $key => $propertyName) {
            if ($file->hasProperty($propertyName)) {
                $value = $file->getProperty($propertyName);

                if (is_string($value) && strlen($value) > 0) {
                    $metaData[$key] = $value;
                }
            }
        }

        return $metaData;
    }
}
