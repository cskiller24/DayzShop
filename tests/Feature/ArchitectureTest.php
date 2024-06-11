<?php

declare(strict_types=1);

arch('does not allow dd, sleep, dump, var_dump in the whole application')
    ->expect(['sleep', 'var_dump', 'dd', 'dump'])
    ->not->toBeUsed();

arch('All livewire component to extends Livewire\Component')
    ->expect('App\Livewire')
    ->toExtend(Livewire\Component::class);

arch('All models to extend the eloquent model')
    ->expect('App\Models')
    ->toExtend(Illuminate\Database\Eloquent\Model::class);

arch('All controller should have suffix [Controller]')
    ->expect('App\Http\Controllers')
    ->toHaveSuffix('Controller');

arch('All enums should be an enum')
    ->expect('App\Enums')
    ->toBeEnum();

arch('All service provider must have a suffix [Provider] and extend [Provider]')
    ->expect('App\Providers')
    ->toHaveSuffix('Provider')
    ->toExtend(Illuminate\Support\ServiceProvider::class);

arch('All files should be strict typed')
    ->expect('App')
    ->toUseStrictTypes();
