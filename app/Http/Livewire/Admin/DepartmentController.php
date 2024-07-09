<?php

namespace App\Http\Livewire\Admin;

use App\Models\Department;
use Livewire\Component;
class DepartmentController extends Component
{
    public $departments,$department;
    protected $listeners = ['delete'];

    protected $rules = [
        'createForm.name'=> 'required'
    ];

    protected $validationAttributes = [
        'createForm.name'=> 'nombre',
        'editForm.name'=> 'nombre'
    ];

    public $createForm = [   
        'name'=> null
    ];

    public $open = false;

    public $editForm = [ 
        'name'=> null
    ];

    public function mount(){
       $this->getDepartments();
    }

    public function getDepartments()
    {
        $this->departments = Department::all();
    }

    public function save(){
        $this->validate();
        Department::create($this->createForm); 
        $this->reset('createForm');       
        $this->emit('saved');
        $this->getDepartments();
    }
    public function edit(Department $department){
        $this->resetValidation();
        $this->department = $department;
        $this->open = true;
        $this->editForm['name'] = $department->name;
    }
    public function update(){
        $this->validate([
            'editForm.name'=> 'required'
        ]);
        $this->department->name = $this->editForm['name'];
        $this->department->save();        
        $this->reset('open','editForm');
        $this->getDepartments();
    }
    public function delete(Department $department){
        $department->delete();
        $this->getDepartments();
    }

    public function render()
    {
        return view('livewire.admin.department-controller')->layout('layouts.admin');
    }
}
