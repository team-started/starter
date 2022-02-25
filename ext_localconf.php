<?php

defined('TYPO3') || die();

(function () {
    \TYPO3\CMS\Core\Utility\ExtensionManagementUtility::addPageTSConfig(
        '<INCLUDE_TYPOSCRIPT: source="DIR:EXT:starter/Configuration/TSConfig/Main/">'
    );

    foreach (['default', 'minimal', 'link' ] as $variant) {
        $GLOBALS['TYPO3_CONF_VARS']['RTE']['Presets']['starter-' . $variant]
            = 'EXT:starter/Configuration/RTE/Starter' . ucfirst($variant) . '.yaml';
    }

    $GLOBALS['TYPO3_CONF_VARS']['SC_OPTIONS']['cms/layout/class.tx_cms_layout.php']['tt_content_drawItem']['starter'] =
        \StarterTeam\Starter\Hooks\PageLayoutView\PageLayoutViewDrawItem::class;

    if (($GLOBALS['TYPO3_REQUEST'] ?? null) instanceof \Psr\Http\Message\ServerRequestInterface
        && \TYPO3\CMS\Core\Http\ApplicationType::fromRequest($GLOBALS['TYPO3_REQUEST'])->isBackend()
    ) {
        $iconRegistry = \TYPO3\CMS\Core\Utility\GeneralUtility::makeInstance(
            \TYPO3\CMS\Core\Imaging\IconRegistry::class
        );

        foreach (\StarterTeam\Starter\Utility\ConfigurationUtility::$contentElements as $identifier => $property) {
            $iconRegistry->registerIcon(
                'starter-ctype-' . $identifier,
                \TYPO3\CMS\Core\Imaging\IconProvider\SvgIconProvider::class,
                ['source' => $property['typeIconPath']]
            );
        }

        foreach (\StarterTeam\Starter\Utility\ConfigurationUtility::$contentElementTables as $identifier => $property) {
            $iconRegistry->registerIcon(
                $identifier,
                \TYPO3\CMS\Core\Imaging\IconProvider\SvgIconProvider::class,
                ['source' => $property['typeIconPath']]
            );
        }

        $GLOBALS['TYPO3_CONF_VARS']['SYS']['formEngine']['formDataGroup']['tcaDatabaseRecord'][\StarterTeam\Starter\Form\FormDataProvider\TcaColPosItem::class] = [
            'depends' => [
                \TYPO3\CMS\Backend\Form\FormDataProvider\DatabaseRowDefaultValues::class,
            ],
            'before' => [
                \TYPO3\CMS\Backend\Form\FormDataProvider\TcaSelectItems::class,
            ],
        ];
        $GLOBALS['TYPO3_CONF_VARS']['SYS']['formEngine']['formDataGroup']['tcaDatabaseRecord'][\StarterTeam\Starter\Form\FormDataProvider\TcaCTypeItem::class] = [
            'depends' => [
                \TYPO3\CMS\Backend\Form\FormDataProvider\TcaSelectItems::class,
            ],
        ];

        // Hide content elements in list module
        $GLOBALS['TYPO3_CONF_VARS']['SC_OPTIONS'][\TYPO3\CMS\Recordlist\RecordList\DatabaseRecordList::class]['modifyQuery'][]
            = \StarterTeam\Starter\Hooks\Backend\PageViewQueryHook::class;

        // Hide content elements in page module
        $GLOBALS['TYPO3_CONF_VARS']['SC_OPTIONS'][\TYPO3\CMS\Backend\View\PageLayoutView::class]['modifyQuery'][]
            = \StarterTeam\Starter\Hooks\Backend\PageViewQueryHook::class;

        $GLOBALS['TYPO3_CONF_VARS']['SC_OPTIONS']['ext/install']['update']['starterFieldPrefixMigration'] =
            \StarterTeam\Starter\Domain\Service\Migration\ConvertFieldNamesService::class;
    }
})();
