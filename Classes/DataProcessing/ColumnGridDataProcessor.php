<?php

namespace StarterTeam\Starter\DataProcessing;

use StarterTeam\Starter\Utility\ConfigurationUtility;
use TYPO3\CMS\Frontend\ContentObject\ContentObjectRenderer;
use TYPO3\CMS\Frontend\ContentObject\DataProcessorInterface;

/**
 * Class ColumnGridDataProcessor
 */
class ColumnGridDataProcessor implements DataProcessorInterface
{
    /**
     * @var ContentObjectRenderer
     */
    protected $contentObjectRender;

    public function process(
        ContentObjectRenderer $contentObjectRenderer,
        array $contentObjectConfiguration,
        array $processorConfiguration,
        array $processedData
    ) {
        $this->contentObjectRender = $contentObjectRenderer;

        $targetVariableName = $this->contentObjectRender->stdWrapValue(
            'as',
            $processorConfiguration,
            'columnGridItems'
        );
        $columnGridItems = $this->getColumnGridItems($processedData['data']);

        foreach ($columnGridItems as $columnGridItem) {
            try {
                $processedData[$targetVariableName][] = $this->translateColumnGridItem($columnGridItem);
            } catch (\Exception $exception) {
            }
        }

        return $processedData;
    }

    protected function getColumnGridItems(array $processedData, string $tableField = 'tx_starter_column_element'): array
    {
        return $this->contentObjectRender->getRecords(
            'tt_content',
            [
                'where' => sprintf($tableField . ' = %s', $processedData['uid']),
                'sorting' => 'sorting',
            ]
        );
    }

    protected function translateColumnGridItem(array $data): array
    {
        $translatedColumnGridItem = [
            'data' => $data,
            'renderedHtml' => $this->renderColumnsGridContent($data),
        ];

        return $translatedColumnGridItem;
    }

    protected function renderColumnsGridContent(array $data): string
    {
        //$itemContent = $this->getColumnGridItems($data, 'uid');
        $this->contentObjectRender->data = $data;

        $renderedContentModules = $this->contentObjectRender->cObjGetSingle(
            '< styles.content.get',
            [
                'select.' => [
                    'uidInList' => $data['uid'],
                    'where' =>
                        '{#colPos}=' . ConfigurationUtility::$contentGridElementsColPos['tx_starter_column_element'],
                ],
            ]
        );

        return $renderedContentModules;
    }
}
