<div class="page page-center bg-dark">
    <div class="container container-tight py-4">
        <div class="text-center mb-4">
            <a href="{{ route('welcome') }}" wire:navigate class="navbar-brand navbar-brand-autodark">
                <x-base::logo class="" style="width: 5rem" />
            </a>
        </div>
        <div class="card card-md border-light bg-dark">
            <div class="card-body">
                <h2 class="h2 text-center mb-4 text-light">Register a seller account</h2>
                <form wire:submit="register">
                    @csrf
                    <div class="mb-3">
                        <x-base::label>Name</x-base::label>
                        <x-base::text-input placeholder="Enter your name" wire:model="name" errorKey="name" />
                        <x-base::error key="name" />
                    </div>
                    <div class="mb-3">
                        <x-base::label>Email address</x-base::label>
                        <x-base::text-input placeholder="Enter your email address" wire:model="email" errorKey="email" />
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
                        <x-base::button class="w-full btn-outline-light">Sign Up</x-base::button>
                    </div>
                </form>
            </div>
        </div>
        <div class="text-center text-light mt-3">
            Don't have account yet? <x-base::link href="{{ route('login') }}" wire:navigate>Sign in</x-base::link>
        </div>
    </div>
</div>
