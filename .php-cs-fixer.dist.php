<?php

declare(strict_types=1);
use Ergebnis\PhpCsFixer\Config\Factory;
use Ergebnis\PhpCsFixer\Config\Rules;
use Ergebnis\PhpCsFixer\Config\RuleSet\Php83;

$ruleSet = Php83::create()->withRules(Rules::fromArray([
    'blank_line_before_statement' => [
        'statements' => [
            'break',
            'continue',
            'declare',
            'default',
            'do',
            'exit',
            'for',
            'foreach',
            'goto',
            'if',
            'include',
            'include_once',
            'require',
            'require_once',
            'return',
            'switch',
            'throw',
            'try',
            'while',
        ],
    ],
    'concat_space' => [
        'spacing' => 'none',
    ],
    'date_time_immutable' => false,
    'error_suppression' => false,
    'final_class' => false,
    'mb_str_functions' => false,
    'native_function_invocation' => [
        'exclude' => [],
        'include' => [
            '@compiler_optimized',
        ],
        'scope' => 'all',
        'strict' => false,
    ],
    'php_unit_internal_class' => false,
    'php_unit_test_annotation' => [
        'style' => 'annotation',
    ],
    'php_unit_test_class_requires_covers' => false,
    'return_to_yield_from' => false,
    'PhpCsFixerCustomFixers/phpdoc_array_style' => false,
    'PhpCsFixerCustomFixers/phpdoc_type_list' => false,
    'attribute_empty_parentheses' => false,
    'final_public_method_for_abstract_class' => false,
    'class_attributes_separation' => [
        'elements' => [
            'const' => 'only_if_meta',
            'property' => 'only_if_meta',
            'trait_import' => 'none',
            'case' => 'none',
        ],
    ],
]));

$config = Factory::fromRuleSet($ruleSet);

$config->getFinder()
    ->append([
        __DIR__.'/.php-cs-fixer.dist.php',
        __DIR__.'/rector.php',
        __DIR__.'/composer-unused.php',
    ])
    ->in('build')
    ->in('migrations')
    ->in('src')
    ->in('tests')
    ->in('tools');

$config->setCacheFile(__DIR__.'/.build/php-cs-fixer/.php-cs-fixer.cache');

return $config;
