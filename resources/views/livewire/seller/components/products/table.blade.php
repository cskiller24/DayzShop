<div class="table-responsive border border-light-subtle rounded pb-0">
    <div class="pt-2 px-2">
        {{ $products->links() }}
    </div>
    <table class="table table-vcenter">
        <thead>
        <tr>
            <th>Name</th>
            <th>Description</th>
            <th>
                Specifications
            <th>
            <th>Actions</th>
        </tr>
        </thead>
        <tbody>
        @foreach ($products as $product)
            <tr>
                <td>
                    {{ $product->name }}
                </td>
                <td title="{{ $product->description }}">
                    {{ str($product->description)->limit(50) }}
                </td>
                <td>
                    <ul>
                        @foreach($product->specifications as $key => $value)
                            <li>
                                {{ $key }} - {{ $value }}
                            </li>
                        @endforeach
                    </ul>
                </td>
                <td class="text-end">
                    <span class="cursor-pointer text-red"
                          wire:click="delete('{{ $product->id }}')"
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
        {{ $products->links() }}
    </div>
</div>
