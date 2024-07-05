<?php

declare(strict_types=1);

namespace App\Providers;

use App\Contracts\GenerateImage;
use App\Services\ImageGeneratorService;
use App\Utils\Faker\Dictionary;
use App\Utils\Faker\NumberDivisibleBy;
use App\Utils\Faker\RandomImage;
use Illuminate\Contracts\Auth\StatefulGuard;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Pagination\Paginator;
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
        $this->bindDependencies();

        if (! $this->app->isProduction()) {
            fake()->addProvider(new RandomImage());
            fake()->addProvider(new Dictionary());
            fake()->addProvider(new NumberDivisibleBy());
        }

        Model::shouldBeStrict(! app()->isProduction());
    }

    public function bindDependencies(): void
    {
        $this->app->bind(GenerateImage::class, ImageGeneratorService::class);

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

        Paginator::useBootstrapFive();
    }

    private function registerBladeComponents(): void
    {
        foreach ($this->componentPaths() as $name => $path) {
            Blade::anonymousComponentPath($path, $name);
        }
    }
}
