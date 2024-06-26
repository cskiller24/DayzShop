<?php

namespace App\Models\Scopes;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Scope;
use Throwable;

class ByStoreIdScope implements Scope
{
    /**
     * @throws Throwable
     */
    public function apply(Builder $builder, $model): void
    {
        throw_if(
            ! in_array('store_id', $model->getFillable()),
            \ValueError::class, 'The model ['.$model::class.'] does not have an attribute store_id',
        );

        $builder->where('store_id', auth()->user()?->active_store_id);
    }
}
