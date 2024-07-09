<?php

namespace App\Http\Livewire;

use Livewire\Component;

class CategoryProduct extends Component
{
    public $category;
    public $products = [];
    
    public function loadPost(){
        $this->products = $this->category->subcategories->flatMap(function ($subcategory) {return $subcategory->products;})->where('status',2)->take(15)->all();
        $this->emit('glider',$this->category->id);
    }
    public function render()
    {
        return view('livewire.category-product');
    }
}
