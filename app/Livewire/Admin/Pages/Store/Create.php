<?php

declare(strict_types=1);

namespace App\Livewire\Admin\Pages\Store;

use App\Enums\Type;
use App\Models\Store;
use App\Models\User;
use App\Notifications\StoreInviteNotification;
use Illuminate\Support\Facades\Notification;
use Illuminate\View\View;
use Livewire\Attributes\Layout;
use Livewire\Attributes\Validate;
use Livewire\Component;

#[Layout('components.layouts.roles.admin')]
class Create extends Component
{
    #[Validate(['required'])]
    public string $name;

    #[Validate(['required', 'email'])]
    public string $email;

    #[Validate(['sometimes', 'required'])]
    public string $description;

    #[Validate(['required'])]
    public string $phoneNumber;

    #[Validate(['nullable', 'exists:users,id'])]
    public array $sellers;

    public function store(): void
    {
        $this->validate();

        $store = Store::query()->create([
            'name' => $this->name,
            'email' => $this->email,
            'description' => $this->description,
            'phone_number' => $this->phoneNumber
        ]);

        dispatch(function () use ($store) {
            $users = User::query()->whereIn('id', $this->sellers)->get();
            Notification::send($users, new StoreInviteNotification($store));
        })->onQueue('after-response');

        $this->dispatch('flash-message', message: 'Successfully created store.');

        $this->redirect(route('admin.stores'), navigate: true);
    }

    public function render(): View
    {
        return view('livewire.admin.pages.store.create', [
            'availableSellers' => User::query()
                ->where('type', Type::SELLER->value)
                ->get()
        ]);
    }
}
