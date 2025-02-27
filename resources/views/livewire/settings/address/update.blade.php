<div class="modal" id="{{ $modalId }}" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true"
     wire:ignore.self>
    <form class="modal-dialog modal-xl modal-dialog-centered" role="document" wire:submit="update">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">
                    Update Address
                </h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <div class="mb-3">
                    <x-base.label>Line one</x-base.label>
                    <x-base.text-input wire:model="form.line_one" error-key="form.line_one"/>
                    <x-base.error key="form.line_one"/>
                </div>
                <div class="mb-3">
                    <x-base.label>Line two</x-base.label>
                    <x-base.text-input wire:model="form.line_two" error-key="form.line_two"/>
                    <x-base.error key="form.line_two"/>
                </div>
                <div class="mb-3">
                    <x-base.label>City</x-base.label>
                    <x-base.text-input wire:model="form.city" error-key="form.city"/>
                    <x-base.error key="form.city"/>
                </div>
                <div class="mb-3">
                    <x-base.label>Region</x-base.label>
                    <x-base.text-input wire:model="form.region" error-key="form.region"/>
                    <x-base.error key="form.region"/>
                </div>
                <div class="mb-3">
                    <x-base.label>Zip code</x-base.label>
                    <x-base.text-input wire:model="form.zip_code" error-key="form.zip_code"/>
                    <x-base.error key="form.zip_code"/>
                </div>
                <div class="mb-3">
                    <x-base.label>Region</x-base.label>
                    <x-base.text-input wire:model="form.region" error-key="form.region"/>
                    <x-base.error key="form.region"/>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn me-auto" data-bs-dismiss="modal">Close</button>
                <button type="submit" class="btn btn-dark" wire:loading.attr="disabled" wire:target="form.photo">Update
                    Variant
                </button>
            </div>
        </div>
    </form>
</div>
