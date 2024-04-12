<div>
    <div class="sm:mx-auto sm:w-full sm:max-w-sm">
        <img class="mx-auto h-10 w-auto" src="https://tailwindui.com/img/logos/mark.svg?color=indigo&shade=600"
            alt="Your Company">
        <h2 class="dark:text-primary text-secondary mt-10 text-center text-2xl font-bold leading-9 tracking-tight ">
            Register your account
        </h2>
    </div>

    <div class="mt-10 sm:mx-auto sm:w-full sm:max-w-sm">
        <form class="space-y-4" wire:submit="register" method="POST">
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
                        <p class="text-red-700 text-sm">
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
                        <p class="text-red-700 text-sm">
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
                        <p class="text-red-700 text-sm">
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
                    <input id="password" name="password_confirmation" wire:model.blur="password_confirmation" type="password"
                        autocomplete="current-password" required @class([
                            'block w-full rounded-md border-0 py-1.5 shadow-sm ring-1 ring-inset placeholder:text-gray-400 focus:ring-2 focus:ring-inset focus:ring-tertiary sm:text-sm sm:leading-6',
                            'ring-gray-300' => !$errors->has('password_confirmation'),
                            'ring-red-800' => $errors->has('password_confirmation'),
                        ])>
                    @if ($errors->has('password_confirmation'))
                        <p class="text-red-700 text-sm">
                            {{ $errors->first('password_confirmation') }}
                        </p>
                    @endif
                </div>
            </div>

            <div>
                <button type="submit"
                    class="flex w-full justify-center rounded-md bg-tertiary-600 px-3 py-1.5 text-sm font-semibold leading-6 text-white shadow-sm hover:bg-tertiary focus-visible:outline focus-visible:outline-2 focus-visible:outline-offset-2 focus-visible:outline-indigo-600">
                    Sign in
                </button>
            </div>
        </form>

        <p class="mt-10 text-center text-sm text-gray-500">
            Not a member?
            <a href="#" class="font-semibold leading-6 text-indigo-600 hover:text-indigo-500">
                Start a 14 day free trial
            </a>
        </p>
    </div>
</div>
