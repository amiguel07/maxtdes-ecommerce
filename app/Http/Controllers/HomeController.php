<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Carousel;
use App\Models\Order;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    public function __invoke()
    {
        if (auth()->user()) {
            $pendiente =  Order::where('user_id',auth()->user()->id)->where('status',1)->count();
            if ($pendiente) {
                $mensaje = "Usted tiene $pendiente ordenes pendientes. <a class='font-bold' href='".route('orders.index')."?status=1'> Ir a Pagar </a>";
                session()->flash('flash.banner',$mensaje);
            }
        }
       
        $categories = Category::all();
        $carousels = Carousel::all();
        return view('welcome',compact('categories', 'carousels'));
    }
}
