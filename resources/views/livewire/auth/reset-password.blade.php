<div class="page page-center bg-dark">
    <div class="container container-tight py-4">
        <div class="text-center mb-4">
            <a href="{{ route('welcome') }}" wire:navigate class="navbar-brand navbar-brand-autodark">
                <x-base::logo class="" style="width: 5rem" />
            </a>
        </div>
        <div class="card card-md border-light bg-dark">
            <div class="card-body">
                <h2 class="h2 text-center mb-4 text-light">Reset Password</h2>
                <form wire:submit="passwordReset">
                    @csrf
                    <div class="mb-3">
                        <x-base::label>Email address</x-base::label>
                        <x-base::text-input placeholder="Enter your email address" wire:model="email" errorKey="email" readonly />
                        <x-base::error key="email" />
                    </div>
                    <div class="mb-2">
                        <x-base::label>Password</x-base::label>
                        <x-base::text-input placeholder="Enter your password" type="password" wire:model="password" errorKey="password" />
                        <x-base::error key="password" />
                    </div>
                    <div class="mb-3">
                        <x-base::label>Confirm Password</x-base::label>
                        <x-base::text-input placeholder="Re-Enter your password" type="password" wire:model="password_confirmation" errorKey="password_confirmation" />
                        <x-base::error key="password_confirmation" />
                    </div>
                    <div class="form-footer">
                        <x-base::button class="w-full btn-outline-light">Reset Password</x-base::button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
