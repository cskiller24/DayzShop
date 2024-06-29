<div class="modal fade" id="{{ $modalId }}" tabindex="-1"
     tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true" wire:ignore.self>
    <form class="modal-dialog modal-dialog-centered" role="document" wire:submit="addImage">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" @click="">Add Product Image
                    for {{ $product->name }}</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <input @class(['form-control', 'is-invalid' => $errors->has('photo')])
                       wire:model="photo"
                       type="file"
                />
                <x-base.error key="photo"/>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn me-auto" data-bs-dismiss="modal">Close</button>
                <button type="submit" class="btn btn-dark" wire:loading.attr="disabled" wire:target="photo">Add File
                </button>
            </div>
        </div>
    </form>
</div>

