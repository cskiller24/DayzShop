    <div class="page page-center bg-dark" x-data="{ open: false }">
        <div class="container container-tight py-4">
            <div class="text-center mb-4">
                <a href="{{ route('welcome') }}" wire:navigate class="navbar-brand navbar-brand-autodark">
                    <x-base::logo class="" style="width: 5rem" />
                </a>
            </div>

            <div class="card card-md border-light w-full">
                <div class="card-body">
                    <div x-show="!open">
                        <h2>You do not have any stores associated with your account.</h2>
                        <h3>You can create a store. Or let someone invite you through another store account</h3>
                        <x-base::button type="button" x-on:click="open = true" class="w-full border-light">Create a
                            store</x-base::button>
                    </div>
                    <div x-transition.duration.700ms x-cloak x-show="open">
                        <form @validated="$el.submit()" method="POST" action="{{ route('seller.store') }}">
                            @csrf
                            <h2 class="text-center">Create a store account</h2>
                            <div class="mb-3">
                                <x-base::label>Name</x-base::label>
                                <x-base::text-input name="name" placeholder="Enter your name" wire:model="name" errorKey="name" />
                                <x-base::error key="name" />
                            </div>
                            <div class="mb-2">
                                <x-base::label>Email</x-base::label>
                                <x-base::text-input name="email" placeholder="Enter your store email" wire:model="email"
                                    errorKey="email" />
                                <x-base::error key="email" />
                            </div>
                            <div class="mb-2">
                                <x-base::label>Description</x-base::label>
                                <x-base::text-input name="description" placeholder="Enter your description (can be blank)"
                                    wire:model="description" errorKey="description" />
                                <x-base::error key="description" />
                            </div>
                            <div class="mb-2">
                                <x-base::label>Phone Number</x-base::label>
                                <x-base::text-input name="phone_number" placeholder="Phone Number" wire:model="phoneNumber"
                                    errorKey="phoneNumber" />
                                <x-base::error key="phoneNumber" />
                            </div>

                            <div class="form-footer">
                                <x-base::button class="w-full btn-outline-light" wire:click="validateFields">Create</x-base::button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>

            <form action="{{ route('logout') }}" method="POST">
                @csrf
                <x-base::button class="mt-2 border-light w-full">Logout</x-base::button>
            </form>
        </div>
    </div>
