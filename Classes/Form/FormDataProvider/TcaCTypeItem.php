<?php

declare(strict_types=1);

namespace StarterTeam\Starter\Form\FormDataProvider;

use StarterTeam\Starter\Utility\ConfigurationUtility;
use TYPO3\CMS\Backend\Form\FormDataProviderInterface;
use TYPO3\CMS\Core\Utility\GeneralUtility;

class TcaCTypeItem implements FormDataProviderInterface
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

        $allowedCTypes = GeneralUtility::trimExplode(',', $inlineContentSettings['allowed'], true);

        $result['processedTca']['columns']['CType']['config']['items'] = array_filter(
            $result['processedTca']['columns']['CType']['config']['items'],
            fn ($item) => in_array($item[1], $allowedCTypes)
        );
        $result['processedTca']['columns']['CType']['config']['default'] = $inlineContentSettings['default'];

        return $result;
    }
}
