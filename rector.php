<?php

declare(strict_types=1);
use Rector\CodingStyle\Rector\FuncCall\ArraySpreadInsteadOfArrayMergeRector;
use Rector\Config\RectorConfig;
use Rector\Doctrine\Set\DoctrineSetList;
use Rector\Php82\Rector\Class_\ReadOnlyClassRector;
use Rector\Php83\Rector\ClassMethod\AddOverrideAttributeToOverriddenMethodsRector;
use Rector\PHPUnit\CodeQuality\Rector\Class_\PreferPHPUnitThisCallRector;
use Rector\PHPUnit\CodeQuality\Rector\ClassMethod\ReplaceTestAnnotationWithPrefixedFunctionRector;
use Rector\PHPUnit\Rector\Class_\PreferPHPUnitSelfCallRector;
use Rector\PHPUnit\Set\PHPUnitSetList;
use Rector\Set\ValueObject\SetList;
use Rector\Symfony\Set\SymfonySetList;
use Rector\TypeDeclaration\Rector\ClassMethod\ReturnNeverTypeRector;
use Rector\ValueObject\PhpVersion;
use function Safe\getcwd;

return static function (RectorConfig $rectorConfig): void {
    $rectorConfig->parallel();
    $rectorConfig->paths([
        __DIR__.'/.php-cs-fixer.dist.php',
        __DIR__.'/composer-unused.php',
        __DIR__.'/rector.php',
        __DIR__.'/src',
        __DIR__.'/tests',
        __DIR__.'/migrations',
    ]);

    $rectorConfig->cacheDirectory('.build/rector');
    $rectorConfig->phpVersion(PhpVersion::PHP_82);
    $rectorConfig->importNames();
    $rectorConfig->importShortClasses(false);
    $rectorConfig->phpstanConfigs([
        getcwd().'/phpstan.neon.dist',
        'vendor/phpstan/phpstan-doctrine/extension.neon',
        'vendor/phpstan/phpstan-phpunit/extension.neon',
        'vendor/phpstan/phpstan-symfony/extension.neon',
        'vendor/phpstan/phpstan-webmozart-assert/extension.neon',
    ]);

    $rectorConfig->sets([
        SetList::PHP_82,
        PHPUnitSetList::PHPUNIT_CODE_QUALITY,
        SymfonySetList::SYMFONY_64,
        DoctrineSetList::DOCTRINE_ORM_29,
        DoctrineSetList::DOCTRINE_DBAL_30,
        DoctrineSetList::DOCTRINE_CODE_QUALITY,
        DoctrineSetList::DOCTRINE_COMMON_20,
    ]);

    $rectorConfig->skip([
        AddOverrideAttributeToOverriddenMethodsRector::class,
        ArraySpreadInsteadOfArrayMergeRector::class,
        PreferPHPUnitThisCallRector::class,
        ReplaceTestAnnotationWithPrefixedFunctionRector::class,

        // @see https://github.com/datana-gmbh/project-name/pull/2355#discussion_r1023816626
        ReturnNeverTypeRector::class => [
            'tests/Functional/*Test.php',
            'tests/Integration/*Test.php',
            'tests/Unit/*Test.php',
        ],

        // buggy @see https://github.com/rectorphp/rector/issues/7734
        ReadOnlyClassRector::class => [
            'src/Controller', // #[Route]
            'src/*/*Controller.php', // #[Route]
            'src/Bridge/*Handler.php', // #[MessageHandler]
            'src/MessageHandler/*Handler.php', // #[MessageHandler]
        ],
    ]);

    $rectorConfig->rule(PreferPHPUnitSelfCallRector::class);

    $rectorConfig->import('vendor/fakerphp/faker/rector-migrate.php');
    $rectorConfig->import('vendor/thecodingmachine/safe/rector-migrate.php');
};
