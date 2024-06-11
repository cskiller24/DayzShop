<?php

namespace App\Providers;

use Illuminate\Contracts\Auth\StatefulGuard;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Blade;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * @return array<string, string>
     */
    private function componentPaths(): array
    {
        return [
            'base' => resource_path('views/components/base'),
        ];
    }

    /**
     * Register any application services.
     */
    public function register(): void
    {
        $this->app->bind(StatefulGuard::class, function () {
            // @phpstan-ignore-next-line
            return Auth::guard(config('auth.defaults.guard', 'web'));
        });
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        $this->registerBladeComponents();
    }

    private function registerBladeComponents(): void
    {
        foreach ($this->componentPaths() as $name => $path) {
            Blade::anonymousComponentPath($path, $name);
        }
    }
}
