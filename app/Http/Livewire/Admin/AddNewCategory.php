<?php

namespace App\Http\Livewire\Admin;

use App\Category;
use Livewire\Component;

class AddNewCategory extends Component
{
    public $name;

    public $description;

    protected $rules = [
        'name' => 'required|min:6',
    ];


    public function render()
    {
        return view('livewire.admin.add-new-category');
    }

    public function saveCategory()
    {
        $this->validate();

        Category::create([
            'name' => $this->name,
            'description' => $this->description,
        ]);

        $this->name = '';
        $this->description = '';
        session()->flash('message', 'Category created successfully.');
        return redirect()->route('admin.categories.index');
    }
}
