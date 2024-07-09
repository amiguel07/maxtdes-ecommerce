<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Carousel;
use Illuminate\View\View;

class CarouselController extends Controller
{
    public function index() {
        $carousels = Carousel::all();
        // return view('carousels.index', compact('carousels'));
        return view('livewire.admin.carousel', compact('carousels'))->layout('layouts.admin');
    }

    public function create() {
        return view('carousels.create');
    }

    public function store(Request $request) {
        $request->validate([
            'image' => 'required|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
            'name' => 'nullable',
            'desc' => 'nullable'
        ]);

        $imageName = time().'.'.$request->image->extension();
        $request->image->storeAs('public/carousel', $imageName);

        Carousel::create([
            'image' => $imageName,
            'name' => $request->input('name'),
            'desc' => $request->input('desc')
        ]);

        return redirect()->route('carousels.create')->with('info', 'Carrusel actualizado');
    }

    public function edit(Carousel $carousel) {
        return view('carousels.edit', compact('carousel'));
    }

    public function update(Request $request, Carousel $carousel) {
        $request->validate([
            'image' => 'required|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
            'name' => 'nullable',
            'desc' => 'nullable'
        ]);

        if($request->hasFile('image')) {
            Storage::delete('public/carousel/'.$carousel->image);

            $imageName = time().'.'.$request->image->extension();
            $request->image->storeAs('public/carousel', $imageName);

            $carousel->image = $imageName;
        }

        $carousel->name = $request->input('name');
        $carousel->desc = $request->input('desc');
        $carousel->save();

        return redirect()->route('carousels.edit')->with('info', 'Carrusel actualizado');
    }

    public function destroy(Carousel $carousel) {
        Storage::delete('public/carousel/'.$carousel->image);
        $carousel->delete();
        return redirect()->route('carousels.index')->with('info', 'Carrusel actualizado');
    }
}
