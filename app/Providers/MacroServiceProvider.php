<?php

declare(strict_types=1);

namespace App\Providers;

use App\Enums\Type;
use App\Livewire\Components\Toaster;
use App\Models\User;
use Flasher\Prime\Notification\NotificationInterface;
use Illuminate\Routing\Redirector;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Vite;
use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Str;
use Livewire\Component;

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
            /** @var Redirector $this */

            /** @var User|null $user */
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
        Component::macro('redirectToRole', function (?User $user = null, bool $navigate = false) {
            /** @var Component $this */
            /** @var User|null $user */
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

        Component::macro('flashMessage', function (string $message, string $title = 'Success!', string $type = NotificationInterface::SUCCESS) {
            /** @var Component $this */

            return $this->dispatch(Toaster::EVENT, message: $message, title: $title, type: $type);
        });

        Component::macro('closeModal', function (string $id): void {
            $this->js(
                "
                let myModal = document.getElementById('{$id}');
                let modalInstance = bootstrap.Modal.getInstance(myModal);
                modalInstance.hide();
            "
            );
        });

        Component::macro('openModal', function (string $id): void {
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
        Str::macro('initials', fn (string $value, string $sep = ' ', string $glue = ''): string => trim(collect(explode($sep, $value))->map(function (string $segment): string { // @phpstan-ignore-line
            return $segment[0] ?? '';
        })->join($glue)));
    }

    public function validator(): void
    {
        Validator::extend('money', function (string $attribute, mixed $value, array $validator): bool {
            if (! is_string($value) && ! is_numeric($value)) {
                return false;
            }

            return preg_match('/^[0-9]{1,3}(,[0-9]{3})*(\.[0-9]+)*$/', $value) > 0; // @phpstan-ignore-line
        }, 'Invalid money format.');
    }
}
