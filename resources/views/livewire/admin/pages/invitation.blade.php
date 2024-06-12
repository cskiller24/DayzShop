<div>
    <button data-modal-target="invitations-create" data-modal-toggle="invitations-create"
        class="block text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm px-5 py-2.5 text-center dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800"
        type="button">
        Create Invitation
    </button>

    <!-- Main modal -->
    <livewire:admin.components.invitations.create modalId="invitations-create" />
    <div class="mt-3">
        <livewire:admin.components.invitations.table class="p-2" />
    </div>
</div>
