<?php

namespace App\Providers;

use Illuminate\Support\Facades\Blade;
use Illuminate\Support\Facades\Vite;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Undocumented function
     *
     * @return array<string, string>
     */
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

        Vite::macro('image', function (string $asset) {
            /** @var \Illuminate\Foundation\Vite $this */

            return $this->asset("resources/images/{$asset}");
        });
    }

    private function registerBladeComponents(): void
    {
        foreach($this->componentPaths() as $name => $path) {
            Blade::anonymousComponentPath($path, $name);
        }
    }

}
