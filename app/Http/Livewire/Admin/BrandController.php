<?php

namespace App\Http\Livewire\Admin;

use App\Models\Brand;
use Livewire\Component;

class BrandController extends Component
{
    public $brands,$brand;
    protected $listeners = ['delete'];

    protected $rules = [
        'createForm.name'=> 'required'
    ];

    protected $validationAttributes = [
        'createForm.name'=> 'nombre',
        'editForm.name'=> 'nombre'
    ];

    public $createForm = [   
        'name'=> null,
    ];

    public $open = false;

    public $editForm = [ 
        'name'=> null,
    ];

    public function mount()
    {
        $this->getBrands();
    }
    public function getBrands()
    {
        $this->brands = Brand::all();
    }
    public function save()
    {
        $this->validate();
        Brand::create($this->createForm);
        $this->getBrands();
        $this->reset('createForm');
        
    }
    public function edit(Brand $brand)
    {
        $this->open = true;
        $this->brand = $brand;
        $this->editForm['name']= $brand->name;

    }
    public function update()
    {
        $this->validate([
            'editForm.name' => 'required'
        ]);
        $this->brand->update($this->editForm);
        $this->getBrands();        
        $this->reset('open','editForm');
    }
    public function delete(Brand $brand)
    {
        $brand->delete();
        $this->getBrands();
    }

    public function render()
    {
        return view('livewire.admin.brand-controller')->layout('layouts.admin');
    }
}
