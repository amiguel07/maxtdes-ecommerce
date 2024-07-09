<?php

namespace App\Http\Livewire;

use App\Models\City;
use App\Models\Department;
use App\Models\District;
use App\Models\Order;
use Gloudemans\Shoppingcart\Facades\Cart;
use Livewire\Component;

class CreateOrder extends Component
{
    public $envio_type = 1;
    public $contact,$phone,$address,$reference,$shipping_cost = 0;
    
    public $departments,$cities = [],$districts=[];

    public $department_selected="",$city_selected="",$district_selected="";

    public $rules = [
        'contact' => 'required',
        'phone' => 'required',
        'envio_type' => 'required',
    ];
    public function updatedEnvioType($value){
        if($value ==1){
           $this->resetValidation([
            'department_selected',
            'city_selected',
            'district_selected',
            'reference',
            'address',
           ]);
        }
    }

    public function updatedDepartmentSelected($value){
        
        $this->cities = City::where('department_id',$value)->get();
        $this->reset(['city_selected','district_selected']);
    }

    public function updatedCitySelected($value){
        $city = City::find($value);
        $this->shipping_cost = $city->cost;
        $this->districts = District::where('city_id',$value)->get();
        $this->reset('district_selected');
    }


    public function mount()
    {
        $this->departments = Department::all();
    }

    public function create_order()
    {
       $rules = $this->rules;

       if($this->envio_type == 2){
        $rules['department_selected'] ='required';
        $rules['city_selected'] ='required';
        $rules['district_selected'] ='required';
        $rules['reference'] ='required';
        $rules['address'] ='required';
       }
       $this->validate($rules);

       $order = new Order();
       $order->user_id = auth()->user()->id;
       $order->contact = $this->contact;
       $order->phone = $this->phone;
       $order->envio_type = $this->envio_type;
       $order->shipping_cost = 0;
       $order->total = $this->shipping_cost + Cart::subtotal();
       $order->content = Cart::content();
       
       if($this->envio_type == 2){
            $order->shipping_cost = $this->shipping_cost;
            // $order->department_id = $this->department_selected;
            // $order->city_id = $this->city_selected;
            // $order->district_id = $this->district_selected;
            // $order->references = $this->reference;
            // $order->address = $this->address;
            $order->envio = json_encode([
                'department' => Department::find($this->department_selected)->name,
                'city' => City::find($this->city_selected)->name,
                'district' => District::find($this->district_selected)->name,
                'reference'=> $this->reference,
                'address'=> $this->address
                
            ]);
       }
       $order->save();

       foreach(Cart::content() as $item){
            discount($item);
       }

       Cart::destroy();
       return redirect()->route('orders.payment',$order);
    }


    public function render()
    {
        return view('livewire.create-order');
    }
}
