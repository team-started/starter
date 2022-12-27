<?php

declare(strict_types=1);

namespace StarterTeam\Starter\DataProcessing;

use StarterTeam\Starter\Service\ImageProcessingService;
use TYPO3\CMS\Core\Utility\GeneralUtility;
use TYPO3\CMS\Frontend\ContentObject\ContentDataProcessor;
use TYPO3\CMS\Frontend\ContentObject\ContentObjectRenderer;
use TYPO3\CMS\Frontend\ContentObject\DataProcessorInterface;

/**
 * This data processor can be used for processing images for record which contain
 * relations to sys_file records (e.g. sys_file_reference records).
 *
 * Example TypoScript configuration:
 *
 * 10 = StarterTeam\Starter\DataProcessing\ImageProcessor
 * 10 {
 *   fieldNames = assets
 *   table = tt_content
 *   as = mediaFiles
 *
 *   imageConfig {
 *     default {
 *       maxW = 640
 *       maxH = 213
 *       cropVariant = smartphone
 *     }
 *
 *     variants {
 *       5 {
 *         config {
 *           maxW = 800
 *           maxH = 533
 *           cropVariant = tablet
 *           mediaQuery = (max-width: 439px)
 *         }
 *       }
 *     }
 *   }
 * }
 */
class ImageProcessor implements DataProcessorInterface
{
    /**
     * @var ImageProcessingService
     */
    protected $imageProcessingService;

    /**
     * @var ContentDataProcessor
     */
    protected $contentDataProcessor;

    /**
     * Constructor
     */
    public function __construct()
    {
        $this->contentDataProcessor = GeneralUtility::makeInstance(ContentDataProcessor::class);
    }

    public function process(
        ContentObjectRenderer $cObj,
        array $contentObjectConfiguration,
        array $processorConfiguration,
        array $processedData
    ) {
        $processedRecordVariables = [];
        $this->imageProcessingService = GeneralUtility::makeInstance(ImageProcessingService::class, $cObj);

        $targetVariableName = $cObj->stdWrapValue('as', $processorConfiguration, 'mediaFiles');
        $relationTable = $cObj->stdWrapValue('table', $processorConfiguration, 'tt_content');
        $mediaReferenceFields = GeneralUtility::trimExplode(
            ',',
            $processorConfiguration['fieldNames'],
            true
        );

        foreach ($mediaReferenceFields as $referenceField) {
            $config = $this->imageProcessingService->getDefaultFileProcessorConfigurationWithReferenceField(
                $referenceField,
                $relationTable
            );

            /**@var ContentObjectRenderer $recordContentObjectRenderer*/
            $recordContentObjectRenderer = GeneralUtility::makeInstance(ContentObjectRenderer::class);
            $recordContentObjectRenderer->start($processedData['data'], $relationTable);
            $processedRecordVariables[$referenceField] = ['data' => $processedData['data']];
            $processedRecordVariables[$referenceField] = $this->contentDataProcessor->process(
                $recordContentObjectRenderer,
                $config,
                $processedRecordVariables[$referenceField]
            );
        }

        $this->imageProcessingService->process(
            $processedData,
            $processorConfiguration,
            $processedRecordVariables,
            $targetVariableName
        );

        return $processedData;
    }
}
