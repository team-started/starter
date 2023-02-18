<?php

declare(strict_types=1);

namespace StarterTeam\Starter\Hooks\PageLayoutView;

use Exception;
use StarterTeam\Starter\Utility\ConfigurationUtility;
use TYPO3\CMS\Backend\Form\FormDataCompiler;
use TYPO3\CMS\Backend\Form\FormDataGroup\TcaDatabaseRecord;
use TYPO3\CMS\Backend\View\PageLayoutView;
use TYPO3\CMS\Backend\View\PageLayoutViewDrawItemHookInterface;
use TYPO3\CMS\Core\SingletonInterface;
use TYPO3\CMS\Core\Utility\GeneralUtility;
use TYPO3\CMS\Fluid\View\StandaloneView;

/**
 * Class TtContentPreviewRenderer
 */
class PageLayoutViewDrawItem implements PageLayoutViewDrawItemHookInterface, SingletonInterface
{
    protected array $supportedContentTypes = [];

    protected StandaloneView $view;

    public function __construct(StandaloneView $view = null)
    {
        $this->view = $view ?: GeneralUtility::makeInstance(StandaloneView::class);

        // add content element for preview renderer
        foreach (ConfigurationUtility::$contentElements as $cType => $properties) {
            $this->supportedContentTypes = array_merge_recursive(
                $this->supportedContentTypes,
                [
                    $cType => $properties['previewTemplate'],
                ]
            );
        }
    }

    /**
     * Processes the item to be rendered before the actual example content gets rendered
     * Deactivates the original example content output
     *
     * @param PageLayoutView $parentObject : The parent object that triggered this hook
     * @param bool $drawItem : A switch to tell the parent object, if the item still must be drawn
     * @param string $headerContent : The content of the item header
     * @param string $itemContent : The content of the item itself
     * @param array $row : The current data row for this item
     * @SuppressWarnings(PHPMD.Superglobals)
     */
    public function preProcess(PageLayoutView &$parentObject, &$drawItem, &$headerContent, &$itemContent, array &$row): void
    {
        if (!isset($this->supportedContentTypes[$row['CType']])) {
            return;
        }

        /**@var TcaDatabaseRecord $formDataGroup*/
        $formDataGroup = GeneralUtility::makeInstance(TcaDatabaseRecord::class);

        /**@var FormDataCompiler $formDataCompiler*/
        $formDataCompiler = GeneralUtility::makeInstance(FormDataCompiler::class, $formDataGroup);

        $formDataCompilerInput = [
            'command' => 'edit',
            'tableName' => 'tt_content',
            'vanillaUid' => (int)$row['uid'],
        ];

        try {
            $result = $formDataCompiler->compile($formDataCompilerInput);
            $processedRow = $this->getProcessedData($result['databaseRow'], $result['processedTca']['columns']);

            $this->configureView($result['pageTsConfig'], $row['CType']);

            $viewVariables = $this->getViewVariables($row, $processedRow);

            $this->view->assignMultiple($viewVariables);

            $itemContent = $this->view->render();
            $headerContent = '';
        } catch (Exception $exception) {
            $message = $GLOBALS['BE_USER']->errorMsg;
            if (empty($message)) {
                $message = $exception->getMessage() . ' ' . $exception->getCode();
            }

            $itemContent = $message;
        }

        $drawItem = false;
    }

    protected function configureView(array $pageTsConfig, string $contentType): void
    {
        $previewConfiguration = $pageTsConfig['mod.']['web_layout.']['tt_content.']['preview.']['starter.'];

        $this->view->setTemplateRootPaths($previewConfiguration['templateRootPaths.']);
        $this->view->setPartialRootPaths($previewConfiguration['partialRootPaths.']);
        $this->view->setLayoutRootPaths($previewConfiguration['layoutRootPaths.']);
        $this->view->setTemplate($this->supportedContentTypes[$contentType]);
    }

    protected function getViewVariables(array $row, array $processedRow): array
    {
        return [
            'row' => $row,
            'processedRow' => $processedRow,
            'previewColumns' => $this->getInlineRelationColumns($processedRow['tx_starter_column_element']),
        ];
    }

    protected function getProcessedData(array $databaseRow, array $processedTcaColumns): array
    {
        $processedRow = $databaseRow;
        foreach ($processedTcaColumns as $field => $config) {
            if (!isset($config['children'])) {
                continue;
            }

            $processedRow[$field] = [];

            foreach ($config['children'] as $child) {
                if (!$child['isInlineChildExpanded']) {
                    $formDataGroup = GeneralUtility::makeInstance(TcaDatabaseRecord::class);
                    $formDataCompiler = GeneralUtility::makeInstance(FormDataCompiler::class, $formDataGroup);
                    $formDataCompilerInput = [
                        'command' => 'edit',
                        'tableName' => $child['tableName'],
                        'vanillaUid' => $child['vanillaUid'],
                    ];
                    $child = $formDataCompiler->compile($formDataCompilerInput);
                }

                $processedRow[$field][] = $this->getProcessedData(
                    $child['databaseRow'],
                    $child['processedTca']['columns']
                );
            }
        }

        return $processedRow;
    }

    protected function getInlineRelationColumns(int $rows): int
    {
        $columns = 1;

        if ($rows !== 0) {
            $columns = (int)(12 / $rows);
        }

        return $columns;
    }
}
