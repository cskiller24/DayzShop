<?php

declare(strict_types=1);

namespace App\Console\Commands;

use App\Models\Permission;
use Illuminate\Console\Command;
use Illuminate\Contracts\Console\PromptsForMissingInput;
use Illuminate\Support\Arr;
use function Laravel\Prompts\multiselect;

final class CreateModulePermission extends Command implements  PromptsForMissingInput
{
    public const array DEFAULT_PERMISSIONS = [
        'list',
        'read',
        'create',
        'update',
        'delete',
    ];

    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'app:module-permission {module} {--no-interaction|-NI} {--only=} {--except=}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Command description';

    protected string $moduleName;

    public function handle(): void
    {
        /**
         * @var array<string, bool|null> $args
         */
        $args = $this->options();

        $this->moduleName = $this->argument('module');

        ($args['no-interaction'] || $args['-NI'])
            ? $this->handleWithoutInteraction()
            : $this->handleWithInteraction();
    }

    private function handleWithInteraction(): void
    {
        /** @var array<int, string> $selectedPermissions */
        $selectedPermissions = multiselect(
            "Please select all the permissions that you want to apply in module '{$this->moduleName}'",
            Permission::VERBS,
            self::DEFAULT_PERMISSIONS,
            hint: 'Use comma (,) to apply more than one permissions. Enter to apply all permissions.',
        );

        $parsedPermissions = $this->parseIntoPermissions($selectedPermissions);

        $bar = $this->output->createProgressBar(count($parsedPermissions));
        $this->addToPermission($parsedPermissions, fn(Permission $permission) => $bar->advance());
        $bar->finish();

        $this->info(PHP_EOL.'Permissions created successfully.');
    }

    private function handleWithoutInteraction(): void
    {
        $permissions = self::DEFAULT_PERMISSIONS;

        if($only = $this->option('only')) {
            $permissions = array_keys(Arr::only(array_flip($permissions), explode(',', $only)));
        }

        if($except = $this->option('except')) {
            $permissions = array_keys(Arr::except(array_flip($permissions), explode(',', $except)));
        }

        $bar = $this->output->createProgressBar(count($permissions));

        $this->addToPermission($permissions, fn(Permission $permission) => $bar->advance());

        $bar->finish();

        $this->info(PHP_EOL.'Permissions created successfully.');
    }

    /**
     * @param  array<int, string>  $permissions
     * @return array<int, string>
     */
    private function parseIntoPermissions(array $permissions): array
    {
        $parsedModule = str($this->moduleName)->lower()->snake();
        $parsedPermissions = [];
        $separator = Permission::SEPARATOR;

        foreach ($permissions as $permission) {
            $parsedPermissions[] = "{$parsedModule}{$separator}{$permission}";
        }

        return $parsedPermissions;
    }

    /**
     * @param  array<int, string> $permissions
     * @param  \Closure(Permission): void  $afterCreating
     * @return void
     */
    protected function addToPermission(array $permissions, \Closure $afterCreating): void
    {
        foreach ($permissions as $name) {
            $permission = Permission::create(compact('name'));

            $afterCreating($permission); // @phpstan-ignore-line
        }
    }
}
