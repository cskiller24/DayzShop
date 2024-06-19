<?php

declare(strict_types=1);

namespace App\Livewire\Auth;

use App\Enums\InvitationTypes;
use App\Models\Invite;
use App\Models\User;
use Illuminate\Auth\Events\Registered;
use Illuminate\View\View;
use Livewire\Attributes\Layout;
use Livewire\Attributes\Validate;
use Livewire\Component;

#[Layout('components.layouts.guest')]
class UseInvitation extends Component
{
    #[Validate('required')]
    public string $name;

    #[Validate('required|email|unique:users,email')]
    public string $email;

    #[Validate('required')]
    public string $password;

    #[Validate('required_with:password|same:password')]
    public string $password_confirmation;

    public Invite $invite;

    protected static function mapInvitation(string $key): View
    {
        $views = [
            InvitationTypes::STORE->value => view('livewire.auth.invitation.seller-registration'),
            InvitationTypes::COURIER->value => view('livewire.auth.invitation.courier-registration'),
        ];

        return $views[$key];
    }

    public function mount(Invite $invite): void
    {
        $this->invite = $invite;
    }

    public function register(): void
    {
        $this->validate();

        $user = User::create([
            'name' => $this->name,
            'email' => $this->email,
            'password' => $this->password,
            'type' => $this->invite->role_type,
        ]);

        $this->invite->setAsUsed();

        dispatch(fn () => event(new Registered($user)))->afterResponse();

        $this->dispatch('flash-message', message: 'Succesfully registered. '.__('auth.verification-send'), title: 'Success!');

        $this->redirect('/', navigate: true);
    }

    public function render(): View
    {
        if($this->invite->is_expired) {
            return view('livewire.auth.invitation.expired');
        }

        return static::mapInvitation($this->invite->type->value);
    }
}
