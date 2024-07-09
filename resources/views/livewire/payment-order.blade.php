<div>
        @php
            // SDK de Mercado Pago
            require base_path('vendor/autoload.php');
            // Agrega credenciales
            MercadoPago\SDK::setAccessToken(config('services.mercadopago.token'));
    
            // Crea un objeto de preferencia
            $preference = new MercadoPago\Preference();
    
            $shipments = new MercadoPago\Shipments();
            $shipments->cost = $order->shipping_cost;
            $shipments->mode = "not_specified";
    
            $preference->shipments = $shipments;
            // Crea un ítem en la preferencia
    
            foreach ($items as $product) {
                $item = new MercadoPago\Item();
                $item->title = $product->name;
                $item->quantity = $product->qty;
                $item->unit_price = $product->price;
                
                $products[] = $item;
            }
    
            //...
            $preference->back_urls = array(
                "success" => route('orders.pay.mercadopago',$order),
                "failure" => route('home'),
                "pending" => route('home')
            );
            $preference->auto_return = "approved";
            // ...
            
            $preference->items = $products;
            $preference->save();
    
    
        @endphp
        <div class="grid grid-cols-5 gap-6 container py-8">
            <div class="col-span-3">
                <div class="bg-white rounded-lg shadow-lg px-6 py-4">
                    <p class="text-gray-700 uppercase"><span class="font-semibold" style="color: var(--tint)">Número de orden:</span> Orden-{{$order->id}}</p>
                </div>
    
                <div class="bg-white rounded-lg shadow-lg p-6 my-6">
                    <div class="grid grid-cols-2 gap-6 text-gray-700">
                        <div>
                            <p class="text-lg font-semibold uppercase" style="color: var(--tint)">Envío</p>
    
                            @if ($order->envio_type == 1)
    
                                <p class="text-sm">Los productos deben ser recogidos en tienda</p>
                                <p class="text-sm">Calle Falsa 123</p>
                                
                            @else
    
                                <p class="text-sm">Los productos serán enviados a:</p>
                                <p class="text-sm">{{$envio->address}}</p>
                                <p>{{$envio->department}}-{{$envio->city}}-{{$envio->district}}-{{$envio->reference}}</p>
                            @endif
                        </div>
    
                        <div>
                            <p class="text-lg font-semibold uppercase" style="color: var(--tint)">Datos de contacto</p>
    
                            <p class="text-sm">Persona: {{$order->contact}}</p>
                            <p class="text-sm">Telefono: {{$order->phone}} </p>
    
                        </div>
                    </div>
    
                </div>
                <div class="bg-white rounded-lg shadow-lg p-6 text-gray-700 mb-6">
                    <p class="text-xl font-semibold mb-4" style="color: var(--tint)">RESUMEN</p>
    
                    <table class="table-auto w-full">
                        <thead>
                            <tr>
                                <th></th>
                                <th>Precio</th>
                                <th>Cantidad</th>
                                <th>Total</th>
                            </tr>
                        </thead>
                        <tbody class="divide-y divide-gray-200">
                            @foreach($items as $item)
                                <tr>
                                    <td>
                                        <div class="flex">
                                            <img class="h-15 w-20 object-cover mr-4" src="{{$item->options->image}}" alt="">
                                            <article>
                                                <h1 class="font-bold">{{$item->name}}</h1>
                                                <div class="flex text-xs">
                                                    @isset($item->options->color)
                                                        Color : {{__($item->options->color)}}
                                                    @endisset
    
                                                    @isset($item->options->size)
                                                        - {{$item->options->size}}
                                                    @endisset
                                                </div>
                                            </article>
                                        </div>
                                    </td>
    
                                    <td class="text-center">
                                        S/. {{$item->price}}
                                    </td>
                                    <td class="text-center">
                                        {{$item->qty}}
                                    </td>
                                    <td class="text-center">
                                        S/. {{$item->price * $item->qty}}
                                    </td>
                                    
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
    
                
            </div>
    
            <div class="col-span-2">
                <div class="bg-white rounded-lg shadow-lg px-6 pt-6">
                                        
                    <div class="text-gray-700" style="padding-bottom: 16px">
                            <span class="text-xl font-semibold uppercase flex" style="color: var(--tint)">
                                Total:  S/. {{$order->total}} <span class="text-base"></span> 
                            </span> 
                            <div class="flex text-base font-semibold">
                                <span>
                                    Subtotal:  &nbsp
                                </span>
                                <span>S/. {{$order->total - $order->shipping_cost}} &nbsp &nbsp &nbsp &nbsp</span>           
                                <p>
                                    Envío: &nbsp
                                </p>
                                <span> S/. {{number_format($order->shipping_cost,2)}}</span>
                            </div>
                    </div>

                    <div style="padding-bottom: 16px">
                        <h3 class="font-semibold" style="color: var(--tint)">PUEDE PAGAR CON:</h3> <br>
                        <div class="containerPayment">
                            @foreach ($payments as $payment)
                                <div class="contentPayment">
                                    @if($payment->image)
                                        <img class="payment" src="{{ asset('storage/'.$payment->image) }}" alt="{{ $payment->image }}">
                                    @else
                                        <i class='far fa-credit-card payment'></i>
                                    @endif
                                    <div class="desc">
                                        <span class="title">{{ $payment->bank }}</span> <br>
                                        <span class="subtitle">{{ $payment->number }}</span>
                                    </div>
                                </div>
                            @endforeach
                        </div>
                    </div>

                    
                    <div style="padding-bottom: 16px">
                        <h3 class="font-semibold" style="color: var(--tint)">ENVÍE SU COMPROBANTE</h3> <br>
                        <form wire:submit.prevent="payOrder">
                            <input type="file" wire:model="voucher">
                            @error('voucher') <span class="error">{{ $message }}</span> @enderror
                            <br> <br> <input class="voucher" type="submit" value="Enviar y completar compra">
                        </form>
                    </div>
                    

                    <!-- <div class="my-6 ">
                        <h2 class="uppercase text-sm text-center text-gray-500" style="width: 100%; 
                        text-align: center; 
                        border-bottom: 1px solid #e0dada; 
                        line-height: 0.1em;
                        margin: 10px 0 20px; "><span style="background:#fff; 
    padding:0 10px; ">PUEDE PAGAR CON</span></h2>
                    </div>
                    <div class="flex justify-between items-center">
                        
                        <div class="cho-container"></div>
                        
                    </div>
                    <div class="my-4">
                        <h2 class="uppercase text-sm text-center  text-gray-500" style="width: 100%; 
                        text-align: center; 
                        border-bottom: 1px solid #e0dada; 
                        line-height: 0.1em;
                        margin: 10px 0 20px; "><span style="background:#fff; 
    padding:0 10px; ">O</span></h2>
                    </div>
                    <div class="mt-4">
                        <div id="paypal-button-container"></div>
                    </div>
                </div> -->
            </div>
            <style>
                div.containerPayment {
                    display: flex;
                    flex-direction: row;
                    flex-wrap: wrap;
                    gap: 16px
                }
                div.contentPayment {
                    display: flex;
                    flex-direction: column;
                    width: 45%;
                    align-items: center
                }
                div.desc {
                    text-align: center
                }
                img.payment {
                    height: 144px
                }
                i.payment {
                    font-size: 126px
                }
                span.title {
                    font-size: 17px;
                    font-weight: bold
                }
                span.subtitle {
                    color: rgba(60,60,67,.6);
                    font-size: 15px
                }
                input.voucher {
                    border-radius: 50vh;
                    background: var(--fillTint);
                    padding: 7px 14px;
                    cursor: pointer;
                    color: var(--tint)
                }
            </style>

        </div>
    @push('script')
        
        <!-- SDK MercadoPago.js V2
        <script src="https://sdk.mercadopago.com/js/v2"></script>
        <script>
            // Agrega credenciales de SDK
            const mp = new MercadoPago("{{config('services.mercadopago.key')}}", {
                    locale: 'es-AR'
            });
            
            // Inicializa el checkout
            mp.checkout({
                preference: {
                    id: '{{$preference->id}}'
                },
                render: {
                        container: '.cho-container', // Indica el nombre de la clase donde se mostrará el botón de pago
                        label: 'Pagar', // Cambia el texto del botón de pago (opcional)
                }
            });
        </script>
    
        Include the PayPal JavaScript SDK; replace "test" with your own sandbox Business account app client ID 
        <script src="https://www.paypal.com/sdk/js?client-id={{config('services.paypal.client_id')}}"></script>
        
        <script>
            paypal.Buttons({
      
              // Sets up the transaction when a payment button is clicked
              createOrder: function(data, actions) {
                return actions.order.create({
                  purchase_units: [{
                    amount: {
                      value: "{{ $order->total }}" // Can reference variables or functions. Example: `value: document.getElementById('...').value`
                    }
                  }]
                });
              },
      
              // Finalize the transaction after payer approval
              onApprove: function(data, actions) {
                return actions.order.capture().then(function(orderData) {

                    Livewire.emit('payOrderPaypal');
                  // Successful capture! For dev/demo purposes:
                  //    console.log('Capture result', orderData, JSON.stringify(orderData, null, 2));
                  //    var transaction = orderData.purchase_units[0].payments.captures[0];
                  //   alert('Transaction '+ transaction.status + ': ' + transaction.id + '\n\nSee console for all available details');
      
                  // When ready to go live, remove the alert and show a success message within this page. For example:
                  // var element = document.getElementById('paypal-button-container');
                  // element.innerHTML = '';
                  // element.innerHTML = '<h3>Thank you for your payment!</h3>';
                  // Or go to another URL:  actions.redirect('thank_you.html');
                });
              }
            }).render('#paypal-button-container');
      
        </script> -->
    
    @endpush
</div>
