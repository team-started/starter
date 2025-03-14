<?php

use StarterTeam\Starter\Utility\ConfigurationUtility;
use TYPO3\CMS\Core\Imaging\IconProvider\SvgIconProvider;

return (function () {
    $icons = [];

    foreach (ConfigurationUtility::$contentElements as $identifier => $property) {
        $icons['starter-ctype-' . $identifier] = [
            'provider' => SvgIconProvider::class,
            'source' => $property['typeIconPath'],
        ];
    }

    foreach (ConfigurationUtility::$contentElementTables as $identifier => $property) {
        $icons[$identifier] = [
            'provider' => SvgIconProvider::class,
            'source' => $property['typeIconPath'],
        ];
    }

    return $icons;
})();
