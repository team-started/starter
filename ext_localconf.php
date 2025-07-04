<?php

defined('TYPO3') || die();

(function () {
    foreach (['default', 'minimal', 'link' ] as $variant) {
        $GLOBALS['TYPO3_CONF_VARS']['RTE']['Presets']['starter-' . $variant]
            = 'EXT:starter/Configuration/RTE/Starter' . ucfirst($variant) . '.yaml';
    }
})();
