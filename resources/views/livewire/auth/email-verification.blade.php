<div class="page page-center bg-dark">
    <div class="container container-tight py-4">
        <div class="card card-md bg-dark border-light">
            <div class="card-body">
                <img src="{{ Vite::image('verification.svg') }}" alt="Verification Image" class="w-full">
                <h1 class="text-center text-light">{{ __('You are not verified.') }}</h1>
                <form action="{{ route('verification.send') }}" method="POST" class="w-full">
                    @csrf
                    <x-base::button type="submit" class="btn-light w-full">
                        Resend Email Verification
                    </x-base::button>
                </form>
            </div>
        </div>
    </div>
</div>
