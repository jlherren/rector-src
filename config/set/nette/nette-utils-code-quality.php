<?php

declare(strict_types=1);

use Rector\Core\Rector\Function_\FunctionToStaticCallRector;
use Rector\Nette\Rector\FuncCall\FilePutContentsToFileSystemWriteRector;
use Rector\Nette\Rector\FuncCall\JsonDecodeEncodeToNetteUtilsJsonDecodeEncodeRector;
use Rector\Nette\Rector\FuncCall\PregFunctionToNetteUtilsStringsRector;
use Rector\Nette\Rector\FuncCall\PregMatchFunctionToNetteUtilsStringsRector;
use Rector\Nette\Rector\FuncCall\SubstrStrlenFunctionToNetteUtilsStringsRector;
use Rector\Nette\Rector\Identical\EndsWithFunctionToNetteUtilsStringsRector;
use Rector\Nette\Rector\Identical\StartsWithFunctionToNetteUtilsStringsRector;
use Rector\Nette\Rector\NotIdentical\StrposToStringsContainsRector;
use Rector\NetteUtilsCodeQuality\Rector\LNumber\ReplaceTimeNumberWithDateTimeConstantRector;
use Symfony\Component\DependencyInjection\Loader\Configurator\ContainerConfigurator;

return static function (ContainerConfigurator $containerConfigurator): void {
    $services = $containerConfigurator->services();

    $services->set(FunctionToStaticCallRector::class)
        ->arg('$functionToStaticCall', [
            'file_get_contents' => [
                # @see https://www.tomasvotruba.cz/blog/2018/07/30/hidden-gems-of-php-packages-nette-utils/
                # filesystem
                'Nette\Utils\FileSystem',
                'read',
            ],
            'unlink' => ['Nette\Utils\FileSystem', 'delete'],
            'rmdir' => ['Nette\Utils\FileSystem', 'delete'],
        ]);

    # strings
    $services->set(StrposToStringsContainsRector::class);

    $services->set(SubstrStrlenFunctionToNetteUtilsStringsRector::class);

    $services->set(StartsWithFunctionToNetteUtilsStringsRector::class);

    $services->set(PregMatchFunctionToNetteUtilsStringsRector::class);

    $services->set(PregFunctionToNetteUtilsStringsRector::class);

    $services->set(EndsWithFunctionToNetteUtilsStringsRector::class);

    $services->set(JsonDecodeEncodeToNetteUtilsJsonDecodeEncodeRector::class);

    $services->set(FilePutContentsToFileSystemWriteRector::class);

    $services->set(ReplaceTimeNumberWithDateTimeConstantRector::class);
};
