<?php

declare(strict_types=1);

use Rector\PhpSpecToPHPUnit\Rector\Class_\AddMockPropertiesRector;
use Rector\PhpSpecToPHPUnit\Rector\Class_\PhpSpecClassToPHPUnitClassRector;
use Rector\PhpSpecToPHPUnit\Rector\ClassMethod\MockVariableToPropertyFetchRector;
use Rector\PhpSpecToPHPUnit\Rector\ClassMethod\PhpSpecMethodToPHPUnitMethodRector;
use Rector\PhpSpecToPHPUnit\Rector\FileSystem\RenameSpecFileToTestFileRector;
use Rector\PhpSpecToPHPUnit\Rector\MethodCall\PhpSpecMocksToPHPUnitMocksRector;
use Rector\PhpSpecToPHPUnit\Rector\MethodCall\PhpSpecPromisesToPHPUnitAssertRector;
use Symfony\Component\DependencyInjection\Loader\Configurator\ContainerConfigurator;

return static function (ContainerConfigurator $containerConfigurator): void {
    $services = $containerConfigurator->services();

    # see: https://gnugat.github.io/2015/09/23/phpunit-with-phpspec.html
    # 1. first convert mocks
    $services->set(PhpSpecMocksToPHPUnitMocksRector::class);

    $services->set(PhpSpecPromisesToPHPUnitAssertRector::class);

    # 2. then methods
    $services->set(PhpSpecMethodToPHPUnitMethodRector::class);

    # 3. then the class itself
    $services->set(PhpSpecClassToPHPUnitClassRector::class);

    $services->set(AddMockPropertiesRector::class);

    $services->set(MockVariableToPropertyFetchRector::class);

    $services->set(RenameSpecFileToTestFileRector::class);
};
