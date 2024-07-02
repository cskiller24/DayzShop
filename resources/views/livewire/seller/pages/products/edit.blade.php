<div class="card border-light">
    <div class="card-body">
        <div class="card-title">
            Update Product
        </div>
        <livewire:components.alert/>

        <form wire:submit="update">
            <div class="mb-2">
                <x-base.label>Name</x-base.label>
                <x-base.text-input placeholder="Enter product name" errorKey="name" wire:model="name"/>
                <x-base.error key="name"/>
            </div>
            <div class="mb-2">
                <x-base.label>Description</x-base.label>
                <textarea wire:model="description"
                          @class(['form-control', 'is-invalid' => $errors->has('description')]) rows="5"></textarea>
                <x-base.error key="description"/>
            </div>

            <div @class(['mb-3', 'is-invalid' => $errors->has('specifications') || $errors->has('specifications')])>
                <div class="d-flex justify-content-between">
                    <div>
                        <x-base.label>Specifications</x-base.label>
                    </div>
                    <div>
                        <x-base.button type="button" wire:click="addSpecification">
                            <i class="ti ti-plus"></i>
                        </x-base.button>


                    </div>
                </div>
                @foreach($specifications as $index => $specification)
                    <div class="d-flex mb-1" wire:key="{{ $index }}">
                        <input class="form-control"
                               wire:model="specifications.{{ $index }}.key"
                               placeholder="Key"
                        />
                        <input class="form-control"
                               placeholder="Value"
                               wire:model="specifications.{{ $index }}.value"
                        />
                        <x-base.button class="btn-danger" type="button"
                                       wire:click="removeSpecification('{{ $index }}')">
                            <i class="ti ti-minus"></i>
                        </x-base.button>
                    </div>
                @endforeach
            </div>
            <div class="invalid-feedback">
                {{ $errors->first('specifications') }}
            </div>
            <div
                @class(['mb-3', 'is-invalid' => $errors->has('categories') || $errors->has('categories.*')])>
                <div wire:ignore>
                    <x-base.label>Category</x-base.label>
                    <select multiple id="categories-select" wire:model="categories">
                        @foreach($categoriesOptions as $category)
                            <option value="{{ $category->id }}">{{ $category->name }}</option>
                        @endforeach
                    </select>
                </div>
            </div>
            <div class="invalid-feedback">
                {{ $errors->has('categories') ? $errors->first('categories') : $errors->first('categories.*') }}
            </div>
            <div class="d-flex justify-content-end">
                <x-base.button type="submit" class="border-light">
                    <i class="ti ti-plus"></i>Save
                </x-base.button>
            </div>
        </form>
    </div>
</div>

@script
<script>
    const tom = new TomSelect('#categories-select', {
        placeholder: "Select Category",
        items: $wire.categories
    })
</script>
@endscript

@assets
<script src="https://cdn.jsdelivr.net/npm/tom-select@2.3.1/dist/js/tom-select.complete.min.js"></script>
@endassets
