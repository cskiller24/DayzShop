<div>
    <h1>Settings</h1>

    <div class="mb-3">
        <livewire:components.change-user-information />
    </div>

    <livewire:components.change-user-password />

    @if($this->isEligibleForAddress)
        <div class="my-3">
            <livewire:settings.address.components.index />
        </div>
    @endif
</div>
