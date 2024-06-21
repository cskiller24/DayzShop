<div>
    <div class="card card-md border-light">
        <div class="card-body">
            <form wire:submit="store">
                <h1 class="text-center">Create a store account</h1>
                <div class="mb-2">
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

                <div class="mb-3" wire:ignore>
                    <x-base::label>Select Sellers</x-base::label>
                    <select name="" wire:model="sellers" placeholder="Select a seller to invite" id="sellers-select" multiple class="bg-dark">
                        @foreach ($availableSellers as $seller)
                        <option value="{{ $seller->id }}">{{ $seller->name }}({{ $seller->email }})</option>
                        @endforeach
                    </select>
                </div>

                <div class="form-footer">
                    <x-base::button class="w-full btn-outline-light">Create</x-base::button>
                </div>
            </form>
        </div>
    </div>
</div>

@assets
<script src="https://cdn.jsdelivr.net/npm/tom-select@2.3.1/dist/js/tom-select.complete.min.js"></script>
@endassets

@script
    <script type="module">
        new TomSelect('#sellers-select');
    </script>
@endscript


