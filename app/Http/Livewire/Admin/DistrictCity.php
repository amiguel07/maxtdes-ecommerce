<?php

namespace App\Http\Livewire\Admin;

use App\Models\City;
use App\Models\District;
use Livewire\Component;

class DistrictCity extends Component
{
    public $city;
    public $districts,$district;

    protected $listeners = ['delete'];

    protected $rules = [
        'createForm.name'=> 'required',
    ];

    protected $validationAttributes = [
        'createForm.name'=> 'nombre',
        'editForm.name'=> 'nombre',
    ];

    public $createForm = [   
        'name'=> null
    ];

    public $open = false;
    public $editForm = [ 
        'name'=> null
    ];

    public function mount(City $city){
        $this->city = $city;
        $this->getDistricts();
    }

    public function getDistricts()
    {
        $this->districts = District::where('city_id',$this->city->id)->get();
    }

    public function save(){
        $this->validate();

        $this->city->districts()->create($this->createForm);
        $this->reset('createForm');
        $this->getDistricts();
        $this->emit('saved');
    }
    public function edit(District $district){      
        $this->resetValidation();
        $this->district = $district;
          
        $this->open = true;
        $this->editForm['name'] = $district->name;
    }

    public function update(){
        $this->validate([
            'editForm.name'=> 'required',
        ]);
        $this->district->update($this->editForm);
        $this->getDistricts();
        $this->reset('open','editForm');
    }

    public function delete(District $district){
        $district->delete();
        $this->getDistricts();
    }

    public function render()
    {
        return view('livewire.admin.district-city')->layout('layouts.admin');
    }
}
