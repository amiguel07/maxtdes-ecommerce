<?php

namespace App\Http\Livewire\Admin;

use App\Models\Payment;
use Livewire\Component;
use Livewire\WithFileUploads;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;

class PaymentController extends Component {
    use WithFileUploads;
    public $payments, $payment;
    protected $listeners = ['delete'];

    protected $rules = [
        'createForm.image'=> 'nullable|image|mimes:jpeg,png,jpg,gif,svg,webp|max:2048',
        'createForm.bank' => 'required',
        'createForm.number' => 'required'
    ];

    protected $validationAttributes = [
        'createForm.image'=> 'image',
        'createForm.bank'=> 'bank',
        'createForm.number'=> 'number',
    ];

    public $createForm = [
        'image' => null,
        'bank' => null,
        'number' => null
    ];

    public $open = false;

    public $editForm = [
        'image' => null,
        'bank' => null,
        'number' => null
    ];

    public function mount() {
        $this->getPayments();
    }

    public function getPayments() {
        $this->payments = Payment::all();
    }

    public function save() {
        $this->validate();
        $imagePath = $this->createForm['image']->store('payments');
        $imageName = pathInfo($imagePath, PATHINFO_BASENAME);
        Payment::create([
            'image' => $imageName,
            'bank' => $this->createForm['bank'],
            'number' => $this->createFomr['number'],
        ]);
        $this->getPayments();
        $this->reset['createForm'];
    }

    public function edit(Payment $payment) {
        $this->open = true;
        $this->payment = $payment;
        $this->editForm['image']= $payment->image;
        $this->editForm['bank']= $payment->bank;
        $this->editForm['number']= $payment->number;
    }

    public function update() {
        $this->validate([
            'editForm.image'=> 'nullable|image|mimes:jpeg,png,jpg,gif,svg,webp|max:2048',
            'editForm.bank' => 'required',
            'editForm.number' => 'required',
        ]);

        $currentImageName = $this->payment->image;

        if($this->editFomr['image']) {
            Storage::delete($currentImageName);
            $imageName = basename($this->editForm['image']->store('payment'));
            $this->editForm['image'] = $imageName;
        }

        $this->payment->update([
            'image' => $this->editForm['image'] ?? $currentImageName,
            'bank' => $this->editForm['bank'],
            'number' => $this->editForm['number'],
        ]);

        $this->getPayments();
        $this->reset('open', 'editForm');
    }

    public function delete(Payment $payment) {
        $imageName = $payment->image;
        $payment->delete();
        Storage::delete($imageName);
        $this->getPayments();
    }

    public function render() {
        return view('livewire.admin.payment-controller')->layout('layouts.admin');
    }
}