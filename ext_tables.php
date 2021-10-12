<?php
defined('TYPO3_MODE') || die();

(function () {
    foreach (['carousel_element', 'accordion_element', 'tab_element'] as $table) {
        \TYPO3\CMS\Core\Utility\ExtensionManagementUtility::allowTableOnStandardPages(
            'tx_starter_' . $table
        );
    }

    foreach (['tt_content'] as $table) {
        \TYPO3\CMS\Core\Utility\ExtensionManagementUtility::addLLrefForTCAdescr(
            (string)$table,
            'EXT:starter/Resources/Private/Language/locallang_csh_' . str_replace('_', '', (string)$table) . '.xlf'
        );
    }

    if (TYPO3_MODE == "BE") {
        $GLOBALS['TBE_STYLES']['skins']['starter'] = array (
            'name' => 'starter',
            'stylesheetDirectories' => array(
                'css' => 'EXT:starter/Resources/Public/Backend/Css/'
            )
        );
    }
})();
