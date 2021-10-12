<?php
namespace StarterTeam\Starter\Form\FormDataProvider;

use StarterTeam\Starter\Utility\ConfigurationUtility;
use TYPO3\CMS\Backend\Form\FormDataProviderInterface;

class TcaColPosItem implements FormDataProviderInterface
{
    /**
     * @param array $result
     * @return array
     */
    public function addData(array $result)
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
            ]
        ];
        unset($result['processedTca']['columns']['colPos']['config']['itemsProcFunc']);

        return $result;
    }
}
