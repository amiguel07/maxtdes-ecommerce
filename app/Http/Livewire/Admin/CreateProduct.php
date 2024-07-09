<?php

namespace App\Http\Livewire\Admin;

use App\Models\Category;
use App\Models\Product;
use App\Models\Subcategory;
// use App\Models\Image;
use Illuminate\Database\Eloquent\Builder;
use Livewire\Component;
use Illuminate\Support\Str;
class CreateProduct extends Component
{
    public $categories;
    public $category_selected="";

    // public $brands=[];
    // public $brand_selected="";

    public $subcategories=[];
    public $subcategory_selected="";

    public $name,$slug,$description;

    public $price,$quantity;

    protected $rules = [
        'category_selected' => 'required',
        'subcategory_selected' => 'required',
        'name' => 'required',
        'slug' => 'required|unique:products',
        'description' => 'required',
        // 'brand_selected' => 'required',
        'price' => 'required',
        'quantity' => 'required'
    ];
    
    public function mount(){
        $this->categories = Category::all();
    }
    
    //Computadas
    public function getSubCategoryProperty(){
        return Subcategory::find($this->subcategory_selected);
    }

    public function updatedName($value){
        $this->slug =Str::slug($value);
    }

    public function updatedCategorySelected($value){
        $this->subcategories = Subcategory::where('category_id',$value)->get();

        // $this->brands = Brand::whereHas('categories',function(Builder $query) use ($value){
        //     $query->where('category_id',$value);
        // })->get();

        $this->reset(['subcategory_selected']);
    }
    
    public function save(){
        $rules = $this->rules;
        if($this->subcategory_selected){
            
            if(!$this->subcategory->color && !$this->subcategory->size){
                $rules['quantity'] = 'required';
            }
        }
        $this->validate($rules);

        $product = new Product();
        $product->name = $this->name;
        $product->slug = $this->slug;
        $product->description = $this->description;
        $product->subcategory_id = $this->subcategory_selected;
        // $product->brand_id = $this->brand_selected;
        $product->price = $this->price;
        $product->quantity = $this->quantity;

        // $image = new Image();
        // $image->url = $request->file('image')->store('public/products');
        // $image->imageable_id = 1;
        // $image->imageable_type='App\Models\Product' ;

        if($this->subcategory_selected){
            
            if(!$this->subcategory->color && !$this->subcategory->size){
                $product->quantity = $this->quantity;
            }
        }
        $product->save();
        // $image->save();
    }

    
    public function render()
    {
        return view('livewire.admin.create-product')->layout('layouts.admin');
    }
}
