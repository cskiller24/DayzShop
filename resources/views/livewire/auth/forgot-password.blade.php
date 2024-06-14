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
                <form wire:submit="sendPasswordReset">
                    @csrf
                    <div class="mb-3">
                        <x-base::label>Email address</x-base::label>
                        <x-base::text-input placeholder="Enter your email address" wire:model="email" errorKey="email" />
                        <x-base::error key="email" />
                    </div>
                    <div class="form-footer">
                        <x-base::button class="w-full btn-outline-light">Send Forgot Password Email</x-base::button>
                    </div>
                </form>
            </div>
        </div>
        <div class="text-center text-light mt-3">
            Remembered your password? <x-base::link href="{{ route('register') }}" wire:navigate>Back to Login</x-base::link>
        </div>
    </div>
</div>

