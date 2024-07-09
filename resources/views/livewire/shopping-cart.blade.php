<div class="container py-8">
    <section class="bg-white rounded-lg shadow-lg p-6 text-gray-700">
       <h1 class="text-lg font-semibold mb-6">
           CARRITO DE COMPRAS
       </h1>

        @if (Cart::count())
                <table class="w-full">
                    <thead>
                        <tr>
                            <th></th>
                            <th>Precio Unitario</th>
                            <th>Cantidad</th>
                            <th>Total</th>
                            <th>Accion</th>
                        </tr>
                    </thead>
    
                    <tbody>
                        @foreach (Cart::content() as $item)
                            <tr>
                                <td>
                                    <div class="flex">
                                        <img class="h-15 w-20 object-cover mr-4" src="{{$item->options->image}}" alt="">
                                        <div>
                                            <p class="font-bold">{{$item->name}}</p>
                                            @if($item->options->color)
                                                <span>
                                                    Color: {{__($item->options->color)}}
                                                </span>
                                            @endif
    
                                            @if ($item->options->size)
                                                <span class="mx-1"> - </span>
                                                <span>{{__($item->options->size)}}</span>
                                            @endif
                                        </div>
                                    </div>
                                </td>
                                <td class="text-center">
                                    <span>S/. {{$item->price}}</span>
                                </td>
                                <td>
                                    <div class="flex justify-center">
                                        @if ($item->options->size)         
    
                                            @livewire('update-cart-item-size', ['rowId' => $item->rowId], key($item->rowId))
    
                                        @elseif($item->options->color)   
    
                                            @livewire('update-cart-item-color', ['rowId' => $item->rowId], key($item->rowId))
    
                                        @else
                                        
                                            @livewire('update-cart-item', ['rowId' => $item->rowId], key($item->rowId))
                                        @endif
                                    </div>
                                    
                                </td>
                                <td class="text-center">
                                    <span>S/. {{$item->price*$item->qty}}</span>
                                </td>
                                <td class="text-center">
                                    <a class="cursor-pointer hover:text-red-500 "
                                    wire:click="delete('{{$item->rowId}}')"
                                    wire:loading.class="text-red-500 opacity-50"
                                    wire:target="delete('{{$item->rowId}}')">
                                        <i class="fas fa-trash"></i>
                                    </a>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
                <a class="text-sm cursor-pointer hover:underline mt-5 inline-block"
                wire:click="destroy">
                    <i class="fas fa-trash"></i> Limpiar carrito de compras
                </a>
        @else
           <div class="flex flex-col items-center">
                <x-cart />
                <p class="text-lg text-gray-700 mt-4">TU CARRITO DE COMPRAS ESTÁ VACÍO</p>
                <x-button-enlace href="/" class="mt-2 px-16">
                    Ir al Inicio
                </x-button-enlace>
           </div>
        @endif

    </section>

    @if (Cart::count())
        <div class="bg-white rounded-lg shadow-lg px-6 py-4 mt-4">
            <div class="flex justify-between items-center">
                <p class="text-lg text-gray-700">
                    <span class="font-bold">Total: </span> S/. {{Cart::subtotal()}}
                </p>
                <div>
                    
                <x-button-enlace href="{{route('orders.create')}}" color="red" style="background: var(--tint)">
                    Continuar
                </x-button-enlace>
                </div>
            </div>
        </div>
    @endif
   

</div>
