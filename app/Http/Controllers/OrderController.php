<?php

namespace App\Http\Controllers;

use App\Models\Order;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;
class OrderController extends Controller
{
    /* Lo renderizo en ParmentOrder
    public function payment(Order $order)
    {
        $items = json_decode($order->content);
        return view('orders.payment',compact('order','items'));
    }*/

    public function index(Order $order)
    {
        $status = 0;
        $orders = Order::query()->where('user_id',auth()->user()->id);
        
        if(request('status')){
            $orders->where('status',request('status'));
            $status = request('status');
        }
        $orders =$orders->get();

        $pendiente =  Order::where('user_id',auth()->user()->id)->where('status',1)->count();
        $recibido =  Order::where('user_id',auth()->user()->id)->where('status',2)->count();
        $enviado =  Order::where('user_id',auth()->user()->id)->where('status',3)->count();
        $entregado =  Order::where('user_id',auth()->user()->id)->where('status',4)->count();
        $anulado =  Order::where('user_id',auth()->user()->id)->where('status',5)->count();
        return view('orders.index',compact('orders','pendiente','recibido','enviado','entregado','anulado','status'));
    }


    //Este método funcionará para MercadoPago
    public function payOrderMercadoPago(Order $order,Request $request)
    {
        //Policy
        $this->authorize('author',$order);
        
        $payment_id = $request->get('payment_id');

        /* EL valor que devuelve response es una cadena => hay que darle formato json*/
        $response = Http::get("https://api.mercadopago.com/v1/payments/$payment_id"."?access_token=APP_USR-847198894297522-100820-90e44308e9c90eca276a077b86aedee9-778666019");
        $response = json_decode($response);
        $status = $response->status;
        if($status == 'approved'){
            $order->status = 2;
            $order->save();
        }
        return redirect()->route('orders.show',$order);
    }

    public function show(Order $order)
    {
        //Policy
        $this->authorize('author',$order);

        $items = json_decode($order->content);
        $envio = json_decode($order->envio);
        return view('orders.show',compact('order','items','envio'));
    }
}
