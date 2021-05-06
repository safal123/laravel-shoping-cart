<?php

namespace App\Http\Livewire\Admin;

use App\Product;
use Livewire\Component;
use Livewire\WithPagination;

class ShowProducts extends Component
{
    use WithPagination;

    public $isLoading = false;

    public function render()
    {
        $products = Product::orderBy('id', 'desc')->paginate(5);
        return view('livewire.admin.show-products', [
            'products' => $products
        ]);
    }

    public function updateStatus($id)
    {
        $product = Product::find($id);
        $product->is_active ? $product->is_active = false : $product->is_active = true;
        $product->save();
        return redirect()->back();
    }

    public function delete($id)
    {
        $product = Product::find($id);
        $product->delete();
        return redirect()->back();
    }
}
