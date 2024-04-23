<div>
    <div class="sm:mx-auto sm:w-full sm:max-w-sm">
        <picture class="w-auto h-48 mx-auto">
            <source srcset="{{ asset('assets/logo/secondary.svg') }}" media="(prefers-color-scheme: dark)">
            <source srcset="{{ asset('assets/logo/primary.svg') }}" media="(prefers-color-scheme: light)">
            <img src="{{ asset('assets/logo/primary.svg') }}" class="w-auto h-48 mx-auto" alt="Logo">
        </picture>
        <h2 class="mt-10 text-2xl font-bold leading-9 tracking-tight text-center dark:text-primary text-secondary ">
            Register your account
        </h2>
    </div>

    <div class="mt-10 sm:mx-auto sm:w-full sm:max-w-sm">
        <form class="space-y-3" wire:submit="register" method="POST">
            @csrf
            <div>
                <label for="name" class="block text-sm font-medium leading-6 dark:text-primary text-secondary">
                    Name
                </label>
                <div class="mt-2">
                    <input id="name" name="name" type="text" autocomplete="name" required
                        wire:model.blur="name" @class([
                            'block w-full rounded-md border-0 py-1.5 shadow-sm ring-1 ring-inset placeholder:text-gray-400 focus:ring-2 focus:ring-inset focus:ring-tertiary sm:text-sm sm:leading-6',
                            'ring-gray-300' => !$errors->has('name'),
                            'ring-red-800 ring-2' => $errors->has('name'),
                        ])>
                    @if ($errors->has('name'))
                        <p class="text-sm text-red-700">
                            {{ $errors->first('name') }}
                        </p>
                    @endif
                </div>
            </div>
            <div>
                <label for="email" class="block text-sm font-medium leading-6 dark:text-primary text-secondary">Email
                    address</label>
                <div class="mt-2">
                    <input id="email" name="email" type="email" autocomplete="email" required
                        wire:model.blur="email" @class([
                            'block w-full rounded-md border-0 py-1.5 shadow-sm ring-1 ring-inset placeholder:text-gray-400 focus:ring-2 focus:ring-inset focus:ring-tertiary sm:text-sm sm:leading-6',
                            'ring-gray-300' => !$errors->has('email'),
                            'ring-red-800 ring-2' => $errors->has('email'),
                        ])>
                    @if ($errors->has('email'))
                        <p class="text-sm text-red-700">
                            {{ $errors->first('email') }}
                        </p>
                    @endif
                </div>
            </div>

            <div>
                <div class="flex items-center justify-between">
                    <label for="password"
                        class="block text-sm font-medium leading-6 dark:text-primary text-secondary">Password</label>
                </div>
                <div class="mt-2">
                    <input id="password" name="password" wire:model.blur="password" type="password"
                        autocomplete="current-password" required @class([
                            'block w-full rounded-md border-0 py-1.5 shadow-sm ring-1 ring-inset placeholder:text-gray-400 focus:ring-2 focus:ring-inset focus:ring-tertiary sm:text-sm sm:leading-6',
                            'ring-gray-300' => !$errors->has('password'),
                            'ring-red-800' => $errors->has('password'),
                        ])>
                    @if ($errors->has('password'))
                        <p class="text-sm text-red-700">
                            {{ $errors->first('password') }}
                        </p>
                    @endif
                </div>
            </div>

            <div>
                <div class="flex items-center justify-between">
                    <label for="password_confirmation"
                        class="block text-sm font-medium leading-6 dark:text-primary text-secondary">Confirm
                        Password</label>
                </div>
                <div class="mt-2">
                    <input id="password" name="password_confirmation" wire:model.blur="password_confirmation"
                        type="password" autocomplete="current-password" required @class([
                            'block w-full rounded-md border-0 py-1.5 shadow-sm ring-1 ring-inset placeholder:text-gray-400 focus:ring-2 focus:ring-inset focus:ring-tertiary sm:text-sm sm:leading-6',
                            'ring-gray-300' => !$errors->has('password_confirmation'),
                            'ring-red-800' => $errors->has('password_confirmation'),
                        ])>
                    @if ($errors->has('password_confirmation'))
                        <p class="text-sm text-red-700">
                            {{ $errors->first('password_confirmation') }}
                        </p>
                    @endif
                </div>
            </div>

            <div class="">
                <button type="submit"
                    class="flex w-full justify-center rounded-md bg-tertiary-600 px-3 py-1.5 text-sm font-semibold leading-6 text-white shadow-sm hover:bg-tertiary focus-visible:outline focus-visible:outline-2 focus-visible:outline-offset-2 focus-visible:outline-indigo-600 mt-6">
                    Sign up
                </button>
            </div>
        </form>

        <p class="mt-5 text-sm text-center text-gray-500">
            Already signed in?
            <a href="{{ route('login') }}" wire:navigate
                class="font-semibold leading-6 underline text-tertiary-600 hover:text-tertiary-500">
                Login
            </a>
        </p>
    </div>
</div>
