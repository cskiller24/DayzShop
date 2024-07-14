<div class="card p-3">
    <h1 class="mb-2">Process Cart</h1>
    @forelse($carts as $cart)
        <div
            @class(["d-flex align-items-center", "mb-2" => ! $loop->last, "mb-0" => $loop->last]) wire:key="{{ $cart->id }}">
            <div class="p-1 me-2">
                <input class="form-check-input light-hover" type="checkbox"/>
            </div>
            <div class="w-full">
                <livewire:customer.components.cart-card :cart="$cart"/>
            </div>
        </div>
    @empty

    @endforelse
</div>
