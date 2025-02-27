<div>
    <form class="card card-body" wire:submit="changePassword">
        <div class="card-title">Change Password</div>
        <div class="mb-3">
            <x-base::label>Old Password</x-base::label>
            <x-base::text-input type="password" placeholder="Enter your old password" wire:model="oldPassword" errorKey="oldPassword"/>
            <x-base::error key="oldPassword"/>
        </div>
        <div class="mb-3">
            <x-base::label>New Password</x-base::label>
            <x-base::text-input type="password" placeholder="Enter your new password" wire:model="newPassword" errorKey="newPassword"/>
            <x-base::error key="newPassword"/>
        </div>
        <div class="mb-3">
            <x-base::label>Confirm New Password</x-base::label>
            <x-base::text-input type="password" placeholder="Enter your new password confirmation" wire:model="confirmNewPassword" errorKey="confirmNewPassword"/>
            <x-base::error key="confirmNewPassword" />
        </div>
        <div class="d-flex justify-content-end mb-3">
            <x-base::button>Update Password</x-base::button>
        </div>
    </form>
</div>
