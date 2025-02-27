<div class="modal" id="{{ App\Livewire\Settings\Address\Create::MODAL_ID }}" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true"
     wire:ignore.self>
    <div class="modal-dialog modal-dialog-centered" role="document">
        <form class="modal-content" wire:submit="store">
            <div class="modal-header">
                <h5 class="modal-title">Create address</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <div class="mb-3">
                    <x-base.label>Line One</x-base.label>
                    <x-base.text-input type="text" wire:model="line_one" required error-key="line_one" />
                    <x-base.error key="line_one" />
                </div>
                <div class="mb-3">
                    <x-base.label>Line Two</x-base.label>
                    <x-base.text-input type="text" wire:model="line_two" error-key="line_two" />
                    <x-base.error key="line_two" />
                </div>
                <div class="mb-3">
                    <x-base.label>City</x-base.label>
                    <x-base.text-input type="text" wire:model="city" error-key="city" />
                    <x-base.error key="city" />
                </div>
                <div class="mb-3">
                    <x-base.label>Region</x-base.label>
                    <x-base.text-input type="text" wire:model="region" error-key="region" />
                    <x-base.error key="region" />
                </div>
                <div class="mb-3">
                    <x-base.label>Country</x-base.label>
                    <x-base.text-input type="text" wire:model="country" error-key="country" />
                    <x-base.error key="country" />
                </div>
                <div class="mb-3">
                    <x-base.label>Zip Code</x-base.label>
                    <x-base.text-input type="text" wire:model="zip_code" required error-key="zip_code" />
                    <x-base.error key="zip_code" />
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn" data-bs-dismiss="modal">Close</button>
                <button type="submit" class="btn btn-success">Submit</button>
            </div>
        </form>
    </div>
</div>
