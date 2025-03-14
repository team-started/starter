<?php

declare(strict_types=1);

namespace StarterTeam\Starter\Form\FormDataProvider;

use Override;
use StarterTeam\Starter\Utility\ConfigurationUtility;
use TYPO3\CMS\Backend\Form\FormDataProviderInterface;
use TYPO3\CMS\Core\Utility\GeneralUtility;

class TcaCTypeItem implements FormDataProviderInterface
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

        $allowedCTypes = GeneralUtility::trimExplode(',', $inlineContentSettings['allowed'], true);

        $result['processedTca']['columns']['CType']['config']['items'] = array_filter(
            $result['processedTca']['columns']['CType']['config']['items'],
            fn($item) => in_array($item['value'], $allowedCTypes)
        );
        $result['processedTca']['columns']['CType']['config']['default'] = $inlineContentSettings['default'];

        return $result;
    }
}
