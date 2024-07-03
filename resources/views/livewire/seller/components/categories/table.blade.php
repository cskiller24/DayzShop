<div class="table-responsive border border-light-subtle rounded pb-0" x-data="categoryTable">

    <div class="pt-2 px-2">
        {{ $categories->links() }}
    </div>
    <table class="table table-vcenter">
        <thead>
        <tr>
            <th>Name</th>
            <th>Actions</th>
        </tr>
        </thead>
        <tbody>
        @foreach ($categories as $category)
            <tr>
                <td>
                    {{ $category->name }}
                </td>
                <td class="">
                    <span class="cursor-pointer"
                          @click="updateCategory('{{ $category->id }}')"
                    >
                        <i class="ti ti-pencil icon"></i>
                    </span>
                    <span class="cursor-pointer text-red"
                          wire:click="delete('{{ $category->id }}')"
                          wire:confirm="Are you sure?"
                    >
                        <i class="ti ti-trash icon"></i>
                    </span>
                </td>
            </tr>
        @endforeach
        </tbody>
    </table>
    <div class="pt-2 px-2">
        {{ $categories->links() }}
    </div>
</div>

@script
<script>
    Alpine.data('categoryTable', () => {
        return {
            updateCategory(id) {
                $wire.name = prompt(`Enter category name.`);

                $wire.update(id);
            },
        }
    })
</script>
@endscript
