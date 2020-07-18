<?php

declare(strict_types=1);

use Rector\Renaming\Rector\Class_\RenameClassRector;
use Rector\Symfony\Rector\FrameworkBundle\GetToConstructorInjectionRector;
use Symfony\Component\DependencyInjection\Loader\Configurator\ContainerConfigurator;

return static function (ContainerConfigurator $containerConfigurator): void {
    $services = $containerConfigurator->services();

    $services->set(GetToConstructorInjectionRector::class)
        ->arg('$getMethodAwareTypes', [
            # https://github.com/EasyCorp/EasyAdminBundle/blob/master/UPGRADE-2.0.md
            # first replace ->get("...") by constructor injection in every child of "EasyCorp\Bundle\EasyAdminBundle\AdminController"
            'EasyCorp\Bundle\EasyAdminBundle\AdminController',
        ]);

    $services->set(RenameClassRector::class)
        ->arg('$oldToNewClasses', [
            # then rename the "EasyCorp\Bundle\EasyAdminBundle\AdminController" class
            'EasyCorp\Bundle\EasyAdminBundle\AdminController' => 'EasyCorp\Bundle\EasyAdminBundle\EasyAdminController',
        ]);
};
