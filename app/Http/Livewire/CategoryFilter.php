<?php

namespace App\Http\Livewire;

use App\Models\Product;
use Illuminate\Database\Eloquent\Builder;
use Livewire\Component;
use Livewire\WithPagination;

class CategoryFilter extends Component
{
    use WithPagination; //Para que no recarge la pagina
    public $category,$subcategoria,$marca;

    public $view = "grid";

    protected $queryString = ['subcategoria','marca'];

    public function limpiar(){
        $this->reset(['subcategoria','marca','page']);
    }

    public function updatedSubCategoria(){
        $this->resetPage();
    }

    public function updatedMarca(){
        $this->resetPage();
    }

    public function render()
    {
        /*$products = $this->category->products()
        ->where('status',2)
        ->paginate(12);*/

        $productsQuery = Product::query()->whereHas('subcategory.category',function(Builder $query){
            $query->where('id',$this->category->id);
        });

        if($this->subcategoria){
            $productsQuery = $productsQuery->whereHas('subcategory',function(Builder $query){
                $query->where('slug',$this->subcategoria);
            });
        }
        if($this->marca){
            $productsQuery = $productsQuery->whereHas('brand',function(Builder $query){
                $query->where('name',$this->marca);
            });
        }

        $products = $productsQuery->paginate(12);

        return view('livewire.category-filter',compact('products'));
    }
}
