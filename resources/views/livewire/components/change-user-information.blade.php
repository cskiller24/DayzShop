<div>
    <form class="card" wire:submit="updateProfile">
        <div class="card-body">
            <div class="card-title">Change Information</div>
            <div class="mb-3">
                <x-base::label>Name</x-base::label>
                <x-base::text-input type="text" placeholder="Enter your name" wire:model="name" errorKey="name"/>
                <x-base::error key="name"/>
            </div>
            <div class="mb-3">
                <x-base::label>New Password</x-base::label>
                <x-base::text-input type="email" placeholder="Enter your email" wire:model="email" errorKey="email"/>
                <x-base::error key="email"/>
            </div>
            <div class="d-flex justify-content-end mb-3">
                <x-base::button>Update Profile Information</x-base::button>
            </div>
        </div>
    </form>
</div>
