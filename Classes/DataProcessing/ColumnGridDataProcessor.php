<?php

declare(strict_types=1);

namespace StarterTeam\Starter\DataProcessing;

use Exception;
use StarterTeam\Starter\Utility\ConfigurationUtility;
use TYPO3\CMS\Frontend\ContentObject\ContentObjectRenderer;
use TYPO3\CMS\Frontend\ContentObject\DataProcessorInterface;

/**
 * Class ColumnGridDataProcessor
 */
class ColumnGridDataProcessor implements DataProcessorInterface
{
    protected ?ContentObjectRenderer $contentObjectRender = null;

    public function process(
        ContentObjectRenderer $cObj,
        array $contentObjectConfiguration,
        array $processorConfiguration,
        array $processedData
    ): array {
        $this->contentObjectRender = $cObj;

        $targetVariableName = $this->contentObjectRender->stdWrapValue(
            'as',
            $processorConfiguration,
            'columnGridItems'
        );
        $columnGridItems = $this->getColumnGridItems($processedData['data']);

        foreach ($columnGridItems as $columnGridItem) {
            try {
                $processedData[$targetVariableName][] = $this->translateColumnGridItem($columnGridItem);
            } catch (Exception $exception) {
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
        return [
            'data' => $data,
            'renderedHtml' => $this->renderColumnsGridContent($data),
        ];
    }

    protected function renderColumnsGridContent(array $data): string
    {
        $this->contentObjectRender->data = $data;

        return $this->contentObjectRender->cObjGetSingle(
            '< styles.content.get',
            [
                'select.' => [
                    'uidInList' => $data['uid'],
                    'where' =>
                        '{#colPos}=' . ConfigurationUtility::$contentGridElementsColPos['tx_starter_column_element'],
                ],
            ]
        );
    }
}
