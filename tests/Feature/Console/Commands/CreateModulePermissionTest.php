<?php

declare(strict_types=1);

use App\Models\Permission;

use function Pest\Laravel\artisan;
use function Pest\Laravel\assertDatabaseHas;

test('in successfully creates modularized permission with interaction', function () {
    $moduleName = 'Test module name';

    artisan('app:module-permission', ['module' => $moduleName, '--no-interaction' => true])
        ->assertExitCode(0);

    $parsedModuleName = str($moduleName)->lower()->snake();
    $separator = Permission::SEPARATOR;
    foreach (Permission::VERBS as $verb) {
        assertDatabaseHas('permissions', ['name' => "{$parsedModuleName}{$separator}{$verb}"]);
    }
});

test('in successfully creates modularized permission without interaction', function () {
    $moduleName = 'Test module name';

    artisan('app:module-permission')
        ->expectsQuestion('What is the module?', $moduleName)
        ->expectsChoice("Please select all the permissions that you want to apply in module '{$moduleName}'", Permission::VERBS, Permission::VERBS)
        ->assertSuccessful();

    $parsedModuleName = str($moduleName)->lower()->snake();
    $separator = Permission::SEPARATOR;
    foreach (Permission::VERBS as $verb) {
        assertDatabaseHas('permissions', ['name' => "{$parsedModuleName}{$separator}{$verb}"]);
    }
});
