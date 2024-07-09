<?php

namespace App\Http\Controllers;
use App\Models\Payment;
use Illuminate\View\View;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class PaymentController extends Controller
{
    public function index() {
        $payments = Carousel::all();
        return view('livewire.admin.payment', compact('payments'))->layout('layouts.admin');
    }

    public function create() {
        return view('payments.create');
    }

    public function store(Request $request) {
        $request->validate([
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
            'bank' => 'required',
            'number' => 'required'
        ]);

        $imageName = time().'.'.$request->image->extension();
        $request->image->storeAs('public/payment', $imageName);

        Payment::create([
            'image' => $imageName,
            'bank' => $request->input('bank'),
            'number' => $request->input('number')
        ]);

        return redirect()->route('payments.create')->with('info', 'Pasarela de pagos actualizada');
    }

    public function edit(Payment $payment) {
        return view ('payments.edit', compact('payment'));
    }

    public function update(Request $request, Payment $payment) {
        $request->validate([
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
            'bank' => 'required',
            'number' => 'required'
        ]);

        if($request->hasFile('image')) {
            Storage::delete('public/payment/'.$payment->image);

            $imageName = time().'.'.$request->image->extension();
            $request->image->storeAs('public/payment', $imageName);

            $payment->image = $imageName;
        }

        $payment->bank = $request->input('bank');
        $payment->number = $request->input('number');
        $payment->save();

        return redirect()->route('payments.edit')->with('info', 'Pasarela de pago actualizada');
    }

    public function destroy(Payment $payment) {
        Storage::delete('public/payment/'.$payment->image);
        $payment->delete();
        return redirect()->route('payments.index')->with('info', 'Pasarela de pago actualizada');
    }
}
