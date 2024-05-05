<?php

namespace App\Providers;

use Illuminate\Support\Facades\Blade;
use Illuminate\Support\Facades\Vite;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    private function componentPaths(): array
    {
        return [
            'base' => resource_path('views/components/base')
        ];
    }

    /**
     * Register any application services.
     */
    public function register(): void
    {
        //
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        $this->registerBladeComponents();
        $this->registerBladeDirectives();
    }

    private function registerBladeComponents(): void
    {
        foreach($this->componentPaths() as $name => $path) {
            Blade::anonymousComponentPath($path, $name);
        }
    }

    private function registerBladeDirectives(): void
    {
        Blade::directive('viteimage', function (string $expression) {
            $expression = trim($expression, "'");
            return Vite::asset("resources/images/{$expression}");
        });
    }
}
