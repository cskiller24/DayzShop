<div class="table-responsive border border-light-subtle rounded pb-0">
    <div class="d-flex justify-content-end">
        <x-base.button class="m-1" data-bs-toggle="modal" data-bs-target="#product-add-variant">
            <i class="ti ti-plus"></i> Add Variant
        </x-base.button>
    </div>
    <div class="pt-2 px-2">
        {{ $variants->links() }}
    </div>
    <table class="table table-vcenter">
        <thead>
        <tr>
            <th>Name</th>
            <th>Description</th>
            <th>Price</th>
            <th>Quantity</th>
            <th>Actions</th>
        </tr>
        </thead>
        <tbody>
        @forelse($variants as $variant)
            <tr>
                <td>{{ $variant->name }}</td>
                <td title="{{ $variant->description }}">{{ str($variant->description)->limit(50) }}</td>
                <td>{{ $variant->price }}</td>
                <td>{{ $variant->quantity }}</td>
                <td>
                    <span
                        @class(['cursor-pointer'])
                        @click="$wire.dispatch('variant-edit', {variant: '{{ $variant->id }}' })"
                    >
                        <i class="ti ti-pencil icon"> </i>
                    </span>
                    <span
                        @class(['cursor-pointer' => $variant->media !== null, 'cursor-not-allowed text-secondary' => $variant->media === null]) x-data
                        @click="$store.previewImage.preview('{{ $variant->media?->getUrl() ?? '#' }}')"
                    >
                        <i class="ti ti-photo-scan icon"> </i>
                    </span>
                    <span class="cursor-pointer text-red"
                          wire:click="delete('{{ $variant->id }}')"
                          wire:confirm="Are you sure?"
                    >
                            <i class="ti ti-trash icon"></i>
                    </span>
                </td>
            </tr>
        @empty
            <tr>
                <td colspan="5">
                    <h1 class="text-center"> Empty variants </h1>
                </td>
            </tr>
        @endforelse
        </tbody>
    </table>
    <div class="pt-2 px-2">
        {{ $variants->links() }}
    </div>
    <livewire:seller.components.products.variants.update :product="$product"/>
    <livewire:seller.components.products.variants.create :product="$product"/>
</div>

@script
<script>
    $wire.on('product-variant-added', () => {
        $wire.$refresh();
    });

    $wire.on('product-variant-updated', () => {
        $wire.$refresh();
    });
</script>
@endscript
