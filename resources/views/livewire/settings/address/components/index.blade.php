<div class="card card-body">
    <div class="d-flex justify-content-between">
        <div class="card-title">Addresses</div>
        <div>
            <x-base.button data-bs-target="#{{ App\Livewire\Settings\Address\Create::MODAL_ID  }}"
                           data-bs-toggle="modal">
                <i class="ti ti-plus me-2"></i> Address
            </x-base.button>
        </div>
    </div>
    @if($addresses)
        <div class="row g-1">
            @foreach($addresses->sortBy(fn(\App\Models\Address $x) => $x->is_active == false) as $address)
                <div class="col-3">
                    <div @class(['card', 'border', 'border-success' => $address->is_active, 'border-white' => ! $address->is_active])>
                        <div class="card-body">
                            @if(! $address->is_active)
                                <div class="d-flex justify-content-end cursor-pointer">
                                    <div title="Set address as active" wire:click="setAsActive('{{ $address->id }}')">
                                        <i class="ti ti-circle-dashed-check icon fs-1"></i>
                                    </div>
                                </div>
                            @endif
                            Full Address: <b>{{ $address->full_address }}</b>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>
    @else
        <h2 class="text-center mb-3">Empty Address</h2>
    @endif
    <livewire:settings.address.create />
</div>
