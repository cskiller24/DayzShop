<div class="card" x-data="permissions">
    <form class="card-body" wire:submit="create">
        <h1>Create Permission</h1>

        <div class="mb-2">
            <x-base.label for="module">Module Name</x-base.label>
            <x-base.text-input id="module" x-model="alpineName" placeholder="Type Module" wire:model="name"/>
        </div>
        <div class="mb-2">
            <x-base.label for="verbs">Verbs</x-base.label>
            <div @class(['is-invalid' => $errors->has('verbs')])>
                <div wire:ignore>
                    <select id="verbs-select" multiple x-model="alpineVerb" wire:model="verbs">
                        @foreach(\App\Models\Permission::VERBS as $verb)
                            <option value="{{ $verb }}">{{ $verb }}</option>
                        @endforeach
                    </select>
                </div>
            </div>
            <x-base.error key="verbs"/>
        </div>
        <div class="card p-2 mb-2 border-light-subtle">
            <x-base.label>Sample Output</x-base.label>
            <template x-for="(verb, index) in alpineVerb" :key="index">
                <div class="card w-full mb-1" x-text="toPermissionWord(verb)"></div>
            </template>
        </div>

        <div class="d-flex justify-content-end">
            <x-base::button class="btn btn-dark border-light w-">Create</x-base::button>
        </div>
    </form>
</div>

@assets
<script src="https://cdn.jsdelivr.net/npm/tom-select@2.3.1/dist/js/tom-select.complete.min.js"></script>
@endassets

@script
<script type="module">
    const tom = new TomSelect('#verbs-select', {
        create: true,
        placeholder: "Select a verb. (You can create a custom verb, type something and press 'Enter')"
    })

    Alpine.data('permissions', () => ({
        alpineName: '',
        alpineVerb: [],
        toPermissionWord(verb) {
            console.log(this.alpineName)
            let separator = '{{ \App\Models\Permission::SEPARATOR }}'

            let name = this.alpineName.split(' ').join('_').toLowerCase()
            let permission = verb.split(' ').join('_').toLowerCase()

            return name + separator + permission
        }
    }));
</script>
@endscript
