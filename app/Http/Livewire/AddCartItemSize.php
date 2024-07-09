<?php

namespace App\Http\Livewire;

use App\Models\Size;
use Livewire\Component;
use Gloudemans\Shoppingcart\Facades\Cart;
use Illuminate\Support\Facades\Storage;

class AddCartItemSize extends Component
{
    public $product,$sizes;
    public $colors = [];
    public $options = []; 
    public $size_selected = "";  
    public $color_selected = ""; 

    public $qty = 1;      
    public $quantity=0;

   

    public function mount(){ //Es como un metodo constructor que se ejecuta una unica vez una vez cargado el componente
        $this->sizes = $this->product->sizes;
        $this->options['image'] = Storage::url($this->product->images->first()->url);
    }
    public function updatedSizeSelected($value){
        $size = Size::find($value);
        $this->colors = $size->colors;
        $this->options['size'] = $size->name;
        $this->options['size_id'] = $size->id;
    }

    public function updatedColorSelected($value){
        $size = Size::find($this->size_selected);
        $color =$size->colors->find($value);
        $this->quantity = qty_available($this->product->id,$color->id,$size->id);
        //Con pivot puedes encontrar la relacion intermedia
        $this->options['color'] = $color->name;
        $this->options['color_id'] = $color->id;

    }

    public function addItem(){
        Cart::add([ 'id' => $this->product->id, 
                    'name' => $this->product->name,
                    'qty' => $this->qty, 
                    'price' => $this->product->price,
                    'weight' => 550,
                    'options' => $this->options
        ]);
        $this->quantity = qty_available($this->product->id,$this->color_selected,$this->size_selected);
        $this->reset('qty');
        $this->emitTo('dropdown-cart','render');
    }

    public function decrement(){
        $this->qty = $this->qty - 1;
    }
    public function increment(){
        $this->qty = $this->qty + 1;
    }
    
    
    public function render()
    {
        return view('livewire.add-cart-item-size');
    }
}
