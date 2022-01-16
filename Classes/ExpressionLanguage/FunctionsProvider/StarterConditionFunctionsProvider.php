<?php

declare(strict_types=1);

namespace StarterTeam\Starter\ExpressionLanguage\FunctionsProvider;

use Symfony\Component\ExpressionLanguage\ExpressionFunction;
use Symfony\Component\ExpressionLanguage\ExpressionFunctionProviderInterface;
use TYPO3\CMS\Core\Utility\ExtensionManagementUtility;

/**
 * Class StarterConditionFunctionsProvider
 */
class StarterConditionFunctionsProvider implements ExpressionFunctionProviderInterface
{
    /**
     * @return ExpressionFunction[] An array of Function instances
     */
    public function getFunctions()
    {
        return [
            $this->getExtensionLoadedFunction(),
        ];
    }

    protected function getExtensionLoadedFunction(): ExpressionFunction
    {
        return new ExpressionFunction(
            'extensionLoaded',
            function () {
                // Not implemented, we only use the evaluator
            },
            function ($arguments, $str) {
                if (!empty($str)) {
                    return ExtensionManagementUtility::isLoaded($str);
                }

                return false;
            }
        );
    }
}
