<?php

namespace App\Http\Livewire;

use App\Models\Order;
use App\Models\Payment;
use Livewire\Component;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Livewire\WithFileUploads;

use Illuminate\Support\Facades\Mail;
use App\Mail\VoucherEmail;

class PaymentOrder extends Component
{
    use AuthorizesRequests, WithFileUploads;

    public $order;
    public $voucher;
    public $fecha_envio;

    protected $rules = [
        'voucher' => 'image',
    ];

    protected $listeners = ['payOrderPaypal'];

    public function mount(Order $order) {
        $this->order = $order;
        $this->fecha_envio = $order->fecha_envio ?? now()->toDateString();
    }

    public function payOrder() {
        // $this->authorize('payment',$this->order);
        $this->validate();

        $this->order->status = 2;

        $imageName = $this->voucher->store('vouchers');
        $this->order->voucher = $imageName;

        $this->order->save();    
        
        Mail::to(auth()->user()->email)->send(new VoucherEmail($this->order));

        return redirect()->route('orders.show',$this->order);
    }

    public function setDate(Order $order) {
        $this->order->fecha_envio = $this->fecha_envio;
        this->order->save();
        return redirect()->route('orders.show',$this->order);
    }

    //Este método funcionará para Paypal
    public function payOrderPaypal(){        
        $this->authorize('payment',$this->order);
        $this->order->status = 2;
        $this->order->save();        
        return redirect()->route('orders.show',$this->order);
    }
    public function render()
    {
        //Policy
        $this->authorize('author',$this->order);
        $envio = json_decode($this->order->envio);
        
        $items = json_decode($this->order->content);

        $payments = Payment::all();

        return view('livewire.payment-order',compact('items','envio', 'payments'));
    }
}
