<?php

declare(strict_types=1);

namespace App\Models\Scopes;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Scope;
use Throwable;

class ByStoreIdScope implements Scope
{
    /**
     * @throws Throwable
     */
    public function apply(Builder $builder, Model $model): void
    {
        throw_if(
            ! in_array('store_id', $model->getFillable()),
            \ValueError::class,
            'The model ['.$model::class.'] does not have an attribute store_id',
        );

        $user = auth()->user();

        if ($user !== null && ! $user->isCustomer()) {
            $builder->where('store_id', $user->active_store_id);
        }
    }
}
