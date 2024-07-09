<?php

namespace App\Http\Livewire\Admin;

use App\Models\Category;
use App\Models\Subcategory;
use Livewire\Component;
use Illuminate\Support\Str;

class ShowCategory extends Component
{
    public $category,$subcategories;
    public $subcategory;
    protected $listeners = ['delete'];

    protected $rules = [
        'createForm.name'=> 'required',
        'createForm.slug'=> 'required|unique:subcategories,slug',        
        'createForm.size'=> 'required',
        'createForm.color'=> 'required'
    ];

    protected $validationAttributes = [
        'createForm.name'=> 'nombre',
        'createForm.slug'=> 'slug',
        'createForm.size'=> 'talla',
        'createForm.color'=> 'color',
        'editForm.name'=> 'nombre',
        'editForm.slug'=> 'slug',
        'editForm.size'=> 'talla',
        'editForm.color'=> 'color'
    ];

    public $createForm = [   
        'name'=> null,
        'slug'=> null,
        'color'=>false,
        'size'=>false
    ];

    public $editFormOpen = false;
    public $editForm = [ 
        'name'=> null,
        'slug'=> null,
        'color'=>false,
        'size'=>false
    ];

    public function mount(Category $category){
       $this->category = $category; 
       $this->getSubCategories();
    }

    public function getSubCategories()
    {
        $this->subcategories = Subcategory::where('category_id',$this->category->id)->get();
    }

    public function updatedCreateFormName($value){
        $this->createForm['slug'] = Str::slug($value);
    }
    public function updatedEditFormName($value){
        $this->editForm['slug'] = Str::slug($value);
    }
    public function update(){
        $this->validate([
            'editForm.name'=> 'required',
            'editForm.slug'=> 'required|unique:subcategories,slug,'.$this->subcategory->id,        
            'editForm.size'=> 'required',
            'editForm.color'=> 'required'
        ]);
        $this->subcategory->update($this->editForm);
        $this->getSubCategories();
        $this->reset('editFormOpen','editForm');
    }

    public function save(){
        $this->validate();

        $this->category->subcategories()->create($this->createForm);
        $this->reset('createForm');
        $this->getSubCategories();
        $this->emit('saved');
    }
    public function edit(Subcategory $subcategory){
        $this->resetValidation();
        $this->subcategory = $subcategory;
        $this->editFormOpen = true;
        $this->editForm['name'] = $subcategory->name;
        $this->editForm['slug'] = $subcategory->slug;
        $this->editForm['color'] = $subcategory->color;
        $this->editForm['size'] = $subcategory->size;
    }
    public function delete(Subcategory $subcategory){
        $subcategory->delete();
        $this->getSubCategories();
    }

    public function render()
    {
        return view('livewire.admin.show-category')->layout('layouts.admin');
    }
}
