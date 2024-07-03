<?php

declare(strict_types=1);

namespace App\Providers;

use App\Enums\Type;
use App\Models\User;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Vite;
use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Str;

class MacroServiceProvider extends ServiceProvider
{
    /**
     * @return array<string, string>
     */
    public static function routeTypes(): array
    {
        return [
            Type::ADMIN->value => route('admin'),
            Type::COURIER->value => route('courier'),
            Type::CUSTOMER->value => route('customer'),
            Type::SELLER->value => route('seller'),
        ];
    }

    public function boot(): void
    {
        $this->vite();
        $this->redirect();
        $this->livewire();
        $this->str();
        $this->validator();
    }

    protected function vite(): void
    {
        Vite::macro('image', function (string $asset) {
            /** @var \Illuminate\Foundation\Vite $this */
            $asset = trim($asset, '/');

            return $this->asset("resources/images/{$asset}");
        });
    }

    protected function redirect(): void
    {
        Redirect::macro('toRole', function (?User $user = null) {
            /** @var \Illuminate\Routing\Redirector $this */

            /** @var \App\Models\User|null $user */
            $user ??= auth()->user();

            if ($user === null) {
                return $this->to(route('login'));
            }

            foreach (Type::getValues() as $role) {
                if ($user->type->value === $role) {
                    return $this->to(
                        MacroServiceProvider::routeTypes()[$role]
                    );
                }
            }

            return $this->to(route('limbo'));
        });
    }

    protected function livewire(): void
    {
        \Livewire\Component::macro('redirectToRole', function (?User $user = null, bool $navigate = false) {
            /** @var \Livewire\Component $this */
            /** @var \App\Models\User|null $user */
            $user ??= auth()->user();
            if ($user === null) {
                return $this->redirect(route('login'), $navigate);
            }
            foreach (Type::getValues() as $role) {
                if ($user->type->value === $role) {
                    return $this->redirect(
                        url: MacroServiceProvider::routeTypes()[$role],
                        navigate: $navigate
                    );
                }
            }

            return $this->redirect(route('limbo'), $navigate);
        });

        \Livewire\Component::macro('closeModal', function (string $id): void {
            $this->js(
                "
                let myModal = document.getElementById('{$id}');
                let modalInstance = bootstrap.Modal.getInstance(myModal);
                modalInstance.hide();
            "
            );
        });

        \Livewire\Component::macro('openModal', function (string $id): void {
            $this->js(
                "
                let myModal = document.getElementById('{$id}');
                let modalInstance = bootstrap.Modal.getOrCreateInstance(myModal);
                modalInstance.show();
            "
            );
        });
    }

    public function str(): void
    {
        Str::macro('initials', fn (string $value, string $sep = ' ', string $glue = ''): string => trim(collect(explode($sep, $value))->map(function ($segment) { // @phpstan-ignore-line
            return $segment[0] ?? '';
        })->join($glue)));
    }

    public function validator(): void
    {
        Validator::extend('money', function ($attribute, $value, $validator) {
            if (! is_string($value) && ! is_numeric($value)) {
                return false;
            }

            return preg_match('/^[0-9]{1,3}(,[0-9]{3})*(\.[0-9]+)*$/', $value) > 0; // @phpstan-ignore-line
        }, 'Invalid money format.');
    }
}
