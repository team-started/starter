<?php

declare(strict_types=1);

use StarterTeam\Starter\ExpressionLanguage\DefaultProvider;

defined('TYPO3') || die();

return [
    'typoscript' => [
        DefaultProvider::class,
    ],
];
