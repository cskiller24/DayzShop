<div>
    <section>
        <input type="text" class="form-control" placeholder="Search Something..."
               wire:model.live.debounce.1000ms="search">

    </section>

    <section class="row">
        @foreach($products as $product)
            {{ $product  }}
        @endforeach
    </section>
</div>
