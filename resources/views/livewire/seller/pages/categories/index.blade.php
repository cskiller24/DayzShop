<div>
    <x-slot name="customHeader">
    </x-slot>
    <div class="row g-2 align-items-center">
        <div class="col">
            <div class="page-pretitle">
                {{ $headerPretitle ?? 'Overview' }}
            </div>
            <h2 class="page-title">
                {{ $headerTitle ?? 'Seller' }}
            </h2>
        </div>
        <div class="col-auto ms-auto d-print-none" x-data="categoryIndex">
            <div class="btn-list">
                <x-base.button class="border-light" @click="createCategory">
                    <i class="ti ti-plus"></i> Category
                </x-base.button>
            </div>
        </div>
    </div>

    <livewire:seller.components.categories.table/>
</div>

@script
<script>
    Alpine.data('categoryIndex', () => {
        return {
            createCategory() {
                $wire.name = prompt(`Enter category name.`);

                $wire.create();
            },
        }
    })
</script>
@endscript

