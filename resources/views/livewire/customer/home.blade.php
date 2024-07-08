<div>
    <section>
        <input type="text" class="form-control" placeholder="Search Something..."
               wire:model.live.debounce.1000ms="search">
    </section>

    <section>
        <div class="row">
            {{ $products->links() }}
            @forelse($products as $product)
                <div class="col-12 col-md-3 mb-2">
                    <livewire:customer.components.product-card
                        :product="$product"
                        wire:key="{{ $product->id }}"
                    />
                </div>
            @empty
                <h1 class="">No Products</h1>
            @endforelse
            {{ $products->links() }}
        </div>
    </section>
</div>
