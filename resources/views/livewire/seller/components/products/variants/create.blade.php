<div class="modal" id="{{ $modalId }}" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true"
     wire:ignore.self>
    <form class="modal-dialog modal-xl modal-dialog-centered" role="document" wire:submit="store">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">
                    Add Product
                    Variant
                    for {{ $product->name }}</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <div class="mb-3">
                    <x-base.label>Name</x-base.label>
                    <x-base.text-input wire:model="form.name" error-key="form.name"/>
                    <x-base.error key="form.name"/>
                </div>
                <div class="mb-3">
                    <x-base.label>Description</x-base.label>
                    <textarea wire:model="form.description"
                              @class(['form-control', 'is-invalid' => $errors->has('form.description')]) rows="5"></textarea>
                    <x-base.error key="form.description"/>
                </div>
                <div class="mb-3">
                    <x-base.label>Price</x-base.label>
                    <x-base.text-input wire:model="form.price" error-key="form.price" x-mask:dynamic="$money($input)"/>
                    <x-base.error key="form.price"/>
                </div>
                <div class="mb-3">
                    <x-base.label>Quantity</x-base.label>
                    <x-base.text-input wire:model="form.quantity" type="number"
                                       error-key="form.quantity"/>
                    <x-base.error key="form.quantity"/>
                </div>
                <div>
                    <x-base.label>Image</x-base.label>
                    <input @class(['form-control', 'is-invalid' => $errors->has('form.photo')])
                           wire:model="form.photo"
                           type="file"
                    />
                    <x-base.error key="form.photo"/>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn me-auto" data-bs-dismiss="modal">Close</button>
                <button type="submit" class="btn btn-dark" wire:loading.attr="disabled" wire:target="form.photo">Add
                    File
                </button>
            </div>
        </div>
    </form>
</div>
