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
    const DEFAULT_FILE_PROCESSOR_CONFIGURATION = [
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

    /**
     * @var ContentObjectRenderer
     */
    protected $contentObjectRenderer;

    /**
     * @var TypoScriptFrontendController
     */
    protected $tsfe;

    /**
     * ImageProcessingService constructor.
     * @SusppressWarning(PHPMD.Superglobals)
     */
    public function __construct(ContentObjectRenderer $contentObjectRenderer)
    {
        $this->contentObjectRenderer = $contentObjectRenderer;
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

        if (!empty($fieldName)) {
            $config['dataProcessing.']['10.']['references.']['fieldName'] = $fieldName;
        }

        if (!empty($table)) {
            $config['dataProcessing.']['10.']['references.']['table'] = $table;
        }

        return $config;
    }

    /**
     * @param array $processedData
     * @param array $processorConfiguration
     * @param array $processedRecordVariables
     * @param string $targetVariableName
     */
    public function process(
        array &$processedData,
        array $processorConfiguration,
        array $processedRecordVariables,
        string $targetVariableName
    ) {
        foreach ($processedRecordVariables as $referenceField => $imageFiles) {
            if (empty($imageFiles['media'])) {
                continue;
            }

            foreach ($imageFiles['media'] as $imageFile) {
                $assetOptions = [];
                $assetOptions['default'] = $this->renderImage(
                    $imageFile,
                    isset($processorConfiguration['imageConfig.']['default.'])
                        ? $processorConfiguration['imageConfig.']['default.']
                        : []
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

    /**
     * @param \TYPO3\CMS\Core\Resource\FileInterface $image
     * @param array $configuration
     * @return string
     */
    protected function renderRetinaImage(FileInterface $image, array $configuration): string
    {
        $retinaConfiguration = $this->getImageConfigurationForRetina($configuration);
        $image = $this->contentObjectRenderer->getImgResource($image, $retinaConfiguration);
        return $image[3];
    }

    /**
     * Prepend the absRefPrefix from typoscript configuration to the image file path
     *
     * @param string $uri
     * @return string
     */
    protected function addAbsRefPrefix(string $uri): string
    {
        return $this->tsfe->absRefPrefix . $uri;
    }

    /**
     * @param array $asset
     * @param array $conf
     */
    protected function clearAssetOptions(array &$asset, array $conf = [])
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
     *
     * @param array $defaultConfig
     * @return array retina config
     */
    protected function getImageConfigurationForRetina(array $defaultConfig = []): array
    {
        $retinaConfig = $defaultConfig;
        foreach (['maxW', 'maxH', 'width', 'height'] as $configKey) {
            if (isset($defaultConfig[$configKey])) {
                $defaultValue = $defaultConfig[$configKey];

                // match strings like "100c-300" and transform them to "200c-600"
                $splitRegexp = '/^([0-9]*)([cm]?)([+-]?)([0-9]*)$/';
                preg_match($splitRegexp, $defaultValue, $matches);
                list($_, $value, $cropMode, $cropOffsetDirection, $cropOffsetValue) = $matches;

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
     *
     * @param FileInterface $file
     * @return array
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
