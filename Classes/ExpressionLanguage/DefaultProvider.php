<?php

declare(strict_types=1);

namespace StarterTeam\Starter\ExpressionLanguage;

use StarterTeam\Starter\ExpressionLanguage\FunctionsProvider\StarterConditionFunctionsProvider;
use TYPO3\CMS\Core\ExpressionLanguage\AbstractProvider;

/**
 * Class DefaultProvider
 * @internal
 */
class DefaultProvider extends AbstractProvider
{
    public function __construct()
    {
        $this->expressionLanguageProviders[] = StarterConditionFunctionsProvider::class;
    }
}
