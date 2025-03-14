<?php

declare(strict_types=1);

namespace StarterTeam\Starter\Form\FormDataProvider;

use Override;
use StarterTeam\Starter\Utility\ConfigurationUtility;
use TYPO3\CMS\Backend\Form\FormDataProviderInterface;

class TcaColPosItem implements FormDataProviderInterface
{
    #[Override]
    public function addData(array $result): array
    {
        if ($result['tableName'] !== 'tt_content' || empty($result['databaseRow']['colPos'])) {
            return $result;
        }

        $inlineContentSettings = ConfigurationUtility::getInlineElementSettings($result);

        if ($inlineContentSettings === null || $inlineContentSettings === []) {
            return $result;
        }

        $result['processedTca']['columns']['colPos']['config']['items'] = [
            [
                'label' => 'LLL:EXT:starter/Resources/Private/Language/locallang_be.xlf:tt_content.colPos.nestedContentColPos',
                'value' => $result['databaseRow']['colPos'],
            ],
        ];
        unset($result['processedTca']['columns']['colPos']['config']['itemsProcFunc']);

        return $result;
    }
}
