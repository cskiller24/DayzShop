<div class="card p-3">
    <h1 class="mb-2">Process Cart</h1>
    @forelse($carts as $cart)
        <div wire:key="{{ $cart->id }}"
            @class(["d-flex align-items-center", "mb-2" => ! $loop->last, "mb-0" => $loop->last]) >
            <div class="p-1 me-2">
                <input class="form-check-input light-hover" type="checkbox"/>
            </div>
            <div class="w-full">
                <livewire:customer.components.cart-card :cart="$cart" :key="$cart->id"/>
            </div>
        </div>
    @empty

    @endforelse
    <div class="d-flex justify-content-end align-items-center mt-3">
        <div class="fs-2 mb-0 me-2">
            Total
        </div>
        <div class="btn btn-orange fs-2 cursor-auto">
            {{ \Cknow\Money\Money::parse($total * 100) }}
        </div>
    </div>
    <a class="btn btn-outline-success mt-2" href="">Proceed to checkout</a>
</div>

@script
<script>
    Livewire.on('cart-updated', function () {
        $wire.$refresh();
    });
</script>
@endscript
