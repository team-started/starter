<?php

use Psr\Http\Message\ServerRequestInterface;
use TYPO3\CMS\Core\Http\ApplicationType;

defined('TYPO3') || die();

(function () {
    if (($GLOBALS['TYPO3_REQUEST'] ?? null) instanceof ServerRequestInterface
        && ApplicationType::fromRequest($GLOBALS['TYPO3_REQUEST'])->isBackend()
    ) {
        $GLOBALS['TBE_STYLES']['skins']['starter'] = [
            'name' => 'starter',
            'stylesheetDirectories' => [
                'css' => 'EXT:starter/Resources/Public/Backend/Css/',
            ],
        ];
    }
})();
