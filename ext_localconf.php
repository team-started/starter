<?php

use StarterTeam\Starter\Form\FormDataProvider\TcaColPosItem;
use StarterTeam\Starter\Form\FormDataProvider\TcaCTypeItem;
use TYPO3\CMS\Backend\Form\FormDataProvider\DatabaseRowDefaultValues;
use TYPO3\CMS\Backend\Form\FormDataProvider\TcaSelectItems;

defined('TYPO3') || die();

(function () {
    foreach (['default', 'minimal', 'link' ] as $variant) {
        $GLOBALS['TYPO3_CONF_VARS']['RTE']['Presets']['starter-' . $variant]
            = 'EXT:starter/Configuration/RTE/Starter' . ucfirst($variant) . '.yaml';
    }

    $GLOBALS['TYPO3_CONF_VARS']['SYS']['formEngine']['formDataGroup']['tcaDatabaseRecord'][TcaColPosItem::class] = [
        'depends' => [
            DatabaseRowDefaultValues::class,
        ],
        'before' => [
            TcaSelectItems::class,
        ],
    ];
    $GLOBALS['TYPO3_CONF_VARS']['SYS']['formEngine']['formDataGroup']['tcaDatabaseRecord'][TcaCTypeItem::class] = [
        'depends' => [
            TcaSelectItems::class,
        ],
    ];
})();
