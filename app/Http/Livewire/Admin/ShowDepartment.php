<?php

namespace App\Http\Livewire\Admin;

use App\Models\City;
use App\Models\Department;
use Livewire\Component;

class ShowDepartment extends Component
{
    public $department;
    public $cities,$city;

    protected $listeners = ['delete'];

    protected $rules = [
        'createForm.name'=> 'required',
        'createForm.cost'=> 'required|numeric|min:0|max:200',
    ];

    protected $validationAttributes = [
        'createForm.name'=> 'nombre',
        'createForm.cost'=> 'costo',
        'editForm.name'=> 'nombre',
        'editForm.cost'=> 'costo',
    ];

    public $createForm = [   
        'name'=> null,
        'cost'=> null
    ];

    public $open = false;
    public $editForm = [ 
        'name'=> null,
        'cost'=> null
    ];

    public function mount(Department $department){
        $this->department = $department;
        $this->getCities();
    }

    public function getCities()
    {
        $this->cities = City::where('department_id',$this->department->id)->get();
    }

    public function save(){
        $this->validate();

        $this->department->cities()->create($this->createForm);
        $this->reset('createForm');
        $this->getCities();
        $this->emit('saved');
    }
    public function edit(City $city){      
        $this->resetValidation();
        $this->city = $city;
          
        $this->open = true;
        $this->editForm['name'] = $city->name;
        $this->editForm['cost'] = $city->cost;
    }

    public function update(){
        $this->validate([
            'editForm.name'=> 'required',
            'editForm.cost'=> 'required|numeric|min:0|max:200',
        ]);
        $this->city->update($this->editForm);
        $this->getCities();
        $this->reset('open','editForm');
    }

    public function delete(City $city){
        $city->delete();
        $this->getCities();
    }

    
    public function render()
    {
        return view('livewire.admin.show-department')->layout('layouts.admin');
    }
}
