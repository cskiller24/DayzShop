<div>
    <section>
        <input type="text" class="form-control" placeholder="Search Something..."
               wire:model.live.debounce.1000ms="search">

    </section>

    <section class="row">
        TOTAL PRODUCTS {{ \App\Models\Product::count() }} <br/>
        CURRENTLY SHOWED PRODUCTS : {{ \App\Models\Product::search($search)->get()->count() }}
        @forelse($products as $product)
            <div class="border border-light">
                name: {{ $product->name }}
                <br/>
                description: {{ $product->description }}
            </div>
        @empty
            <h1 class="">No Products</h1>
        @endforelse
    </section>
</div>
