<?php

declare(strict_types=1);

namespace StarterTeam\Starter;

/**
 * Class Configuration
 */
class Configuration
{
    /**
     * @var string[]
     */
    public const DEFAULT_BACKEND_LAYOUTS = [
        'SimpleWithFooter',
        'SimpleWithoutFooter',
    ];

    /**
     * Return the default defined backend layouts
     */
    public static function getDefaultBackendLayouts(): array
    {
        return self::DEFAULT_BACKEND_LAYOUTS;
    }
}
