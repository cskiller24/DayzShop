<?php

declare(strict_types=1);

namespace App\Observers;

use Illuminate\Database\Eloquent\Model;

class ApplyStoreIdObserver
{
    public function creating(Model $model): void
    {
        throw_if(
            ! in_array('store_id', $model->getFillable()),
            \ValueError::class, 'The model ['.$model::class.'] does not have an attribute store_id',
        );

        $model->fill(['store_id' => auth()->user()?->active_store_id]);
    }
}
