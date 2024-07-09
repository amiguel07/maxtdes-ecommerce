<div class="container py-9 grid grid-cols-5 gap-6">
    <div class="col-span-3">

        <div class="bg-white rounded-lg shadow p-6">
            <div class="mb-4">
                <x-jet-label value="Nombre de contacto"/>
                <x-jet-input
                wire:model.defer="contact"
                type="text"
                placeholder="Ingrese el nombre de la persona que recibirá el Producto"
                class="w-full" />
                <x-jet-input-error for="contact" />
            </div>

            <div>
                <x-jet-label value="Telefono de contacto"/>
                <x-jet-input
                wire:model.defer="phone"
                type="text"
                placeholder="Ingrese un número de telefono de contácto"
                class="w-full"/>
                <x-jet-input-error for="phone" />
            </div>

        </div>

        <div x-data="{ envio_type: @entangle('envio_type')}">
            <p class="mt-6 mb-3 text-lg text-gray-700 font-semibold">Envíos</p>

            <label class="bg-white rounded-lg shadow px-6 py-4 flex items-center mb-4 cursor-pointer">
                <input x-model="envio_type" type="radio" name="envio_type" value="1" id="" class="text-gray-600">
                <span class="ml-2 text-gray-700">
                    Recojo en tienda (Calle Falsa 123)
                </span>
                <span class="font-semibold text-gray-700 ml-auto">
                    Gratis
                </span>
            </label>

            <div class="bg-white rounded-lg shadow">
                <label class="px-6 py-4 flex items-center cursor-pointer">
                    <input x-model="envio_type" type="radio" name="envio_type" value="2" id="" class="text-gray-600">
                    <span class="ml-2 text-gray-700">
                        Envío a domicilio
                    </span>
                </label>

                <div :class="{'hidden': envio_type != 2}" class="px-6 pb-6 grid grid-cols-2 gap-6 hidden" >
                    {{--Departamentos--}}

                    <div>
                        <x-jet-label value="Departamento" />
                        <select class="form-control w-full" wire:model="department_selected">
                            <option value="" disabled selected>Seleccione Departamento</option>
                            @foreach ($departments as $department)
                                <option value="{{$department->id}}">{{$department->name}}</option>
                            @endforeach
                        </select>

                        <x-jet-input-error for="department_selected" />
                    </div>

                    {{--Ciudades--}}

                    <div>
                        <x-jet-label value="Ciudad" />
                        <select class="form-control w-full" wire:model="city_selected">
                            <option value="" disabled selected>Seleccione una Ciudad</option>
                            @foreach ($cities as $city)
                                <option value="{{$city->id}}">{{$city->name}}</option>
                            @endforeach
                        </select>

                        <x-jet-input-error for="city_selected" />
                    </div>

                    {{--Distritos--}}

                    <div>
                        <x-jet-label value="Distrito" />
                        <select class="form-control w-full" wire:model="district_selected">
                            <option value="" disabled selected>Seleccione un Distrito</option>
                            @foreach ($districts as $district)
                                <option value="{{$district->id}}">{{$district->name}}</option>
                            @endforeach
                        </select>

                        <x-jet-input-error for="district_selected" />
                    </div>

                    <div>
                        <x-jet-label value="Referencia" />
                        <x-jet-input class="w-full" wire:model="reference" type="text"/>
                        <x-jet-input-error for="reference" />
                    </div>

                    <div class="col-span-2">
                        <x-jet-label value="Dirección" />
                        <x-jet-input class="w-full" wire:model="address" type="text"/>
                        <x-jet-input-error for="address" />
                    </div>

                    
                </div>
            </div>
            
        </div>

        <div>
            <x-jet-button
            wire.loading.attr="disabled"
            wire:target="create_order"
            class="mt-6 mb-4" 
            wire:click="create_order">
                Continuar con la compra
            </x-jet-button>
            <hr>
            <p class="text-sm text-gray-700 mt-2">Lorem ipsum dolor sit amet consectetur adipisicing elit. Iusto voluptatem aperiam soluta recusandae libero harum quam nisi natus veniam ea modi sapiente unde, dolor mollitia tenetur quos aut explicabo magni <a href="" class="font-semibold text-orange-500">Politicas y privacidad</a></p>
        </div>
    </div>

    <div class="col-span-2">
        <div class="bg-white rounded-lg shadow p-6">
            <ul>
                @forelse (Cart::content() as $item)
                    <li class="flex p-2 {{$loop->last ? '':'border-b border-gray-200'}}">
                        <img class="h-15 w-20 object-cover mr-4" src="{{$item->options->image}}" alt="">
                    
    
                        <article class="flex-1">
                            <h1 class="font-bold">{{$item->name}}</h1>
                            <div class="flex">
                                <p>Cant: {{$item->qty}}</p>
                                @isset($item->options['color'])
                                   <p class="mx-2"> - Color: {{__($item->options['color'])}}</p> 
                                @endisset
                                @isset($item->options['size'])
                                   <p class="mx-2"> - {{$item->options['size']}}</p> 
                                @endisset
                            </div>
                            
                            <p>S/. {{$item->price}}</p>
                        </article>
                    </li>
                @empty
                    <li class="py-6 px-4">
                        <p class="text-center text-gray-700">
                            No tiene items en su carrito.
                        </p>
                    </li>                    
                @endforelse
            </ul>

            <hr class="mt-4 mb-3">

            <div class="text-gray-700">
                <p class="flex justify-between items-center">
                    Subtotal
                    <span class="font-semibold">S/. {{Cart::subtotal()}}</span>
                </p>
                <p class="flex justify-between items-center">
                    Envío
                    <span class="font-semibold">
                        @if($envio_type == 1 || $shipping_cost == 0)
                            Gratis
                        @else
                            S/. {{number_format($shipping_cost,2)}}
                        @endif
                    </span>
                </p>
            </div>

            <hr class="mt-4 mb-3">

            <div class="text-gray-700">
                <p class="flex justify-between items-center font-bold">
                    <span class="text-lg">Total</span>
                        @if($envio_type == 1 || $shipping_cost == 0)
                            
                            S/. {{Cart::subtotal()}}
                        @else
                        
                            S/. {{Cart::subtotal() + $shipping_cost}}
                        @endif

                </p>
            </div>
        </div>
    </div>
</div>
