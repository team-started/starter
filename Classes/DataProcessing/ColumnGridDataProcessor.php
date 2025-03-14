<?php

declare(strict_types=1);

namespace StarterTeam\Starter\DataProcessing;

use Exception;
use Override;
use StarterTeam\Starter\Utility\ConfigurationUtility;
use TYPO3\CMS\Frontend\ContentObject\ContentObjectRenderer;
use TYPO3\CMS\Frontend\ContentObject\DataProcessorInterface;

/**
 * Class ColumnGridDataProcessor
 */
class ColumnGridDataProcessor implements DataProcessorInterface
{
    #[Override]
    public function process(
        ContentObjectRenderer $cObj,
        array $contentObjectConfiguration,
        array $processorConfiguration,
        array $processedData
    ): array {
        $targetVariableName = $cObj->stdWrapValue(
            'as',
            $processorConfiguration,
            'columnGridItems'
        );
        $columnGridItems = $this->getColumnGridItems($processedData['data'], $cObj);

        foreach ($columnGridItems as $columnGridItem) {
            try {
                $processedData[$targetVariableName][] = $this->translateColumnGridItem($columnGridItem, $cObj);
            } catch (Exception) {
            }
        }

        return $processedData;
    }

    protected function getColumnGridItems(
        array $processedData,
        ContentObjectRenderer $contentObjectRenderer,
        string $tableField = 'tx_starter_column_element'
    ): array {
        return $contentObjectRenderer->getRecords(
            'tt_content',
            [
                'where' => sprintf($tableField . ' = %s', $processedData['uid']),
                'sorting' => 'sorting',
            ]
        );
    }

    protected function translateColumnGridItem(array $data, ContentObjectRenderer $contentObjectRenderer): array
    {
        return [
            'data' => $data,
            'renderedHtml' => $this->renderColumnsGridContent($data, $contentObjectRenderer),
        ];
    }

    protected function renderColumnsGridContent(array $data, ContentObjectRenderer $contentObjectRenderer): string
    {
        $contentObjectRenderer->data = $data;

        return $contentObjectRenderer->cObjGetSingle(
            '< styles.content.get',
            [
                'select.' => [
                    'uidInList' => $data['uid'],
                    'where' =>
                        '{#colPos}=' . ConfigurationUtility::getColPosForStarterColumnElement(),
                ],
            ]
        );
    }
}
