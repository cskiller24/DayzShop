<div class="text-white">
    <div class="sm:mx-auto sm:w-full sm:max-w-sm">
        <img class="mx-auto h-10 w-auto" src="https://tailwindui.com/img/logos/mark.svg?color=indigo&shade=600"
            alt="Your Company">
        <h2 class="dark:text-primary text-secondary mt-10 text-center text-2xl font-bold leading-9 tracking-tight ">
            Forgot Password
        </h2>
    </div>

    <div class="mt-10 sm:mx-auto sm:w-full sm:max-w-sm">
        <form class="space-y-4" wire:submit="sendPasswordReset" method="POST">
            @csrf

            <div>
                <label for="email" class="block text-sm font-medium leading-6 dark:text-primary text-secondary">Email
                    address</label>
                <div class="mt-2">
                    <input id="email" name="email" type="email" autocomplete="email" required
                        wire:model.blur="email" @class([
                            'block w-full rounded-md border-0 text-black py-1.5 shadow-sm ring-1 ring-inset focus:ring-2 focus:ring-inset focus:ring-tertiary sm:text-sm sm:leading-6',
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
                <button type="submit"
                    class="flex w-full justify-center rounded-md bg-tertiary-600 px-3 py-1.5 text-sm font-semibold leading-6 text-white shadow-sm hover:bg-tertiary focus-visible:outline focus-visible:outline-2 focus-visible:outline-offset-2 focus-visible:outline-indigo-600">
                    Send Email
                </button>
            </div>
        </form>


    </div>
</div>
