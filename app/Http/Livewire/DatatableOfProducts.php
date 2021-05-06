<?php

namespace App\Http\Livewire;

use App\Product;
use Illuminate\Support\Str;
use Mediconesystems\LivewireDatatables\Column;
use Mediconesystems\LivewireDatatables\Http\Livewire\LivewireDatatable;

class DatatableOfProducts extends LivewireDatatable
{
    public $model = Product::class;

    public function columns()
    {
        return [
            Column::callback('name', function ($value) {
                return view('datatables::link', [
                    'href' => "/" . Str::slug($value),
                    'slot' => ucfirst($value)
                ]);
            })
                ->label('Page')
                ->sortBy('id')
                ->defaultSort('asc'),

            Column::name('id'),
            Column::name('name'),
            Column::name('image'),
            Column::name('description'),

        ];
    }
}
