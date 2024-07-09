<?php

namespace App\Http\Livewire\Admin;

use App\Models\Carousel;
use Livewire\Component;
use Livewire\WithFileUploads;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;

class CarouselController extends Component {
    use WithFileUploads;
    public $carousels, $carousel;
    protected $listeners = ['delete'];

    protected $rules = [
        'createForm.image'=> 'required|image|mimes:jpeg,png,jpg,gif,svg,webp',
        'createForm.name' => 'nullable',
        'createForm.desc' => 'nullable'
    ];

    protected $validationAttributes = [
        'createForm.image'=> 'image',
        'createForm.name'=> 'name',
        'createForm.desc'=> 'desc',
        'editForm.image'=> 'image',
        'editForm.name'=> 'name',
        'editForm.desc'=> 'desc',
    ];

    public $createForm = [  
        'image'=> null, 
        'name'=> null,
        'desc'=> null,
    ];

    public $open = false;

    public $editForm = [ 
        'image'=> null, 
        'name'=> null,
        'desc'=> null,
    ];

    public function mount() {
        $this->getCarousels();
    }

    public function getCarousels() {
        $this->carousels = Carousel::all();
    }
    public function save() {
        $this->validate();
        $imagePath = $this->createForm['image']->store('carousel');
        $imageName = pathinfo($imagePath, PATHINFO_BASENAME);
        Carousel::create([
            'image' => $imageName,
            'name' => $this->createForm['name'],
            'desc' => $this->createForm['desc'],
        ]);
        $this->getCarousels();
        $this->reset('createForm');
    }

    public function edit(Carousel $carousel) {
        $this->open = true;
        $this->carousel = $carousel;
        $this->editForm['image']= $carousel->image;
        $this->editForm['name']= $carousel->name;
        $this->editForm['desc']= $carousel->desc;

    }

    public function update() {
        $this->validate([
            'editForm.image' => 'required|image|mimes:jpeg,png,jpg,gif,svg,webp',
            'editForm.name' => 'nullable',
            'editForm.desc' => 'nullable',
        ]);

        $currentImageName = $this->carousel->image;
        
        if($this->editForm['image']) {
            Storage::delete($currentImageName);
            $imageName = basename($this->editForm['image']->store('carousel'));
            $this->editForm['image'] = $imageName;
        }

        $this->carousel->update([
            'image' => $this->editForm['image'] ?? $currentImageName,
            'name' => $this->editForm['name'],
            'desc' => $this->editForm['desc'],
        ]);
        $this->getCarousels();        
        $this->reset('open','editForm');
    }

    public function delete(Carousel $carousel) {
        $imageName = $carousel->image;
        $carousel->delete();
        Storage::delete($imageName);
        $this->getCarousels();
    }

    public function render() {
        return view('livewire.admin.carousel-controller')->layout('layouts.admin');
    }
}