<?php

declare(strict_types=1);

namespace StarterTeam\Starter\Form\FormDataProvider;

use StarterTeam\Starter\Utility\ConfigurationUtility;
use TYPO3\CMS\Backend\Form\FormDataProviderInterface;

class TcaColPosItem implements FormDataProviderInterface
{
    public function addData(array $result): array
    {
        if ('tt_content' !== $result['tableName'] || empty($result['databaseRow']['colPos'])) {
            return $result;
        }

        $inlineContentSettings = ConfigurationUtility::getInlineElementSettings($result);

        if (empty($inlineContentSettings)) {
            return $result;
        }

        $result['processedTca']['columns']['colPos']['config']['items'] = [
            [
                'LLL:EXT:starter/Resources/Private/Language/locallang_be.xlf:tt_content.colPos.nestedContentColPos',
                $result['databaseRow']['colPos'],
            ],
        ];
        unset($result['processedTca']['columns']['colPos']['config']['itemsProcFunc']);

        return $result;
    }
}
