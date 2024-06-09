<div class="mx-auto dark:text-primary text-secondary w-1/4">
    <img src="{{ Vite::image('verification.svg') }}" alt="Verification Image" class="w-full">
    <h1 class="font-bold text-center text-3xl">{{ __('You are not verified.') }}</h1>
    <form action="{{ route('verification.send') }}" method="POST" class="w-full">
        @csrf
        <x-base::button type="submit" reversed class="w-full mt-3">
            Resend Email Verification
        </x-base::button>
    </form>
</div>
