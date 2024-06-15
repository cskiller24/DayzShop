<div class="card">
    <div class="card-body">
        <div class="card-title">Create Invite URL</div>
        <form wire:submit="create">
            <div class="mb-2">
                <x-base::label for="expire_at">Expires At</x-base::label>
                <x-base::text-input type="datetime-local" class="border-light-subtle" errorKey="expireAt" id="expire_at" wire:model="expireAt" step="any" />
                <x-base::error key="expireAt" />
            </div>
            <div class="">
                <x-base::label for="type">Expires At</x-base::label>
                <select id="type" @class(['form-select', 'is-invalid' => $errors->has('type')]) wire:model="type">
                    <option selected>-- SELECT INVITATION TYPE --</option>
                    <option value="{{ \App\Enums\InvitationTypes::STORE->value }}">Store</option>
                    <option value="{{ \App\Enums\InvitationTypes::COURIER->value }}">Delivery Hub</option>
                </select>
                <x-base::error key="type" />
            </div>

            <div class="d-flex w-full justify-content-end">
                <x-base::button class="btn-dark border-light-subtle mt-2 w-25">Create</x-base::button>
            </div>
        </form>
    </div>
</div>
