<div>
    <div class="bg-white rounded-lg shadow-lg mb-4">
        <div class="px-6 py-2 flex justify-between items-center">
            <h1 class="font font-semibold text-gray-700 uppercase">{{$category->name}}</h1>

            <div class="hidden md:block grid grid-cols-2 border border-gray-200 divide-x divide-gray-200 text-gray-500">
                <i class="fas fa-border-all p-3 cursor-pointer {{$view == 'grid' ? 'text-yelloe-500' :''}}" wire:click="$set('view','grid')"></i>
                <i class="fas fa-th-list p-3 cursor-pointer {{$view == 'list' ? 'text-yellow-500' :''}}" wire:click="$set('view','list')"></i>
            </div>

        </div> 
    </div>

    <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 lg:grid-cols-5 gap-6">
        <aside>
            <h2 class="font-semibold mb-5">Subcategorías</h2>
            <ul class="divide-y divide-gray-200">
                @foreach ($category->subcategories as $subcategory)
                    <li class="py-2 text-sm">
                        <a
                        wire:click = "$set('subcategoria','{{$subcategory->slug}}')" 
                        class="cursor-pointer hover:text-yellow-500 capitalize {{$subcategoria  == $subcategory->slug? 'text-yellow-500 font-semibold' : ' '}}">{{$subcategory->name}}</a>
                    </li>
                @endforeach
            </ul>

            

            <div class="text-center">
                
            <x-jet-button class="mt-4" wire:click="limpiar" style="background: var(--tint); border-radius: 10px; width: 100%; align-content: center; justify-content: center">
                Eliminar filtros
            </x-jet-button>
            </div>

        </aside>

        <div class="md:col-span-2 lg:col-span-4">
            @if ($view=='grid')
                <ul class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-4">
                    @forelse ($products as $product)
                        <li class="bg-white rounded-lg">
                            <article> 
                                <figure>
                                    @if(!$product->images->isEmpty())
                                    
                                        <img class="h-48 w-full object-cover object-center" style="border-radius: 10px 10px 0 0" src="{{Storage::url($product->images->first()->url)}}" alt="">
                                    @else
                                        <img class="h-48 w-full object-cover object-center" style="border-radius: 10px 10px 0 0" src="https://images.pexels.com/photos/2536965/pexels-photo-2536965.jpeg?auto=compress&cs=tinysrgb&dpr=3&h=750&w=1260" alt="">
                                    @endif
                                </figure>
                                <div class="px-4 py-6">
                                    <h1 class="text-lg font-semibold">
                                        <a href="{{route('products.show',$product)}}">
                                            {{Str::limit($product->name,20)}}
                                        </a>
                                    </h1>
                                    <p class="font-bold text-trueGray-700" style="color: var(--labelSecondary)">S/. {{$product->price}}</p>
                                </div>
                            </article> 
                        </li>
                    @empty
                        <li class="md:col-span-2 lg:col-span-4">
                            <div class="bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded relative" role="alert">
                                <strong class="font-bold">Uopss!</strong>
                                <span class="block sm:inline" style="color: var(--labelSecondary)">No existen registros con ese filtro.</span>
                                <span class="absolute top-0 bottom-0 right-0 px-4 py-3">
                            </div>
                        </li>
                    @endforelse
                </ul>
            @else
            <ul class="">
                @forelse ($products as $product)
                    <li class="bg-white rounded-lg shadow mb-4">
                        <article class="md:flex"> 
                            <figure>
                                <img class="h-48 w-full md:w-56 object-cover object-center" src="{{Storage::url($product->images->first()->url)}}" alt="">
                            </figure>
                            <div class="flex-1 py-4 px-6 flex flex-col">
                                <div class="lg:flex justify-between">
                                    <div>
                                        <h1 class="text-lg font-semibold text-gray-700">
                                            {{$product->name}}
                                        </h1>
                                        <p class="font-bold text-trueGray-700" style="color: var(--labelSecondary)">S/. {{$product->price}}</p>
                                    </div>
                                    <!-- <div class="flex items-center">
                                        <ul class="flex text-sm">
                                            <li class="mr-1"><i class="fas fa-star text-yellow-400"></i></li>
                                            <li class="mr-1"><i class="fas fa-star text-yellow-400"></i></li>
                                            <li class="mr-1"><i class="fas fa-star text-yellow-400"></i></li>
                                            <li class="mr-1"><i class="fas fa-star text-yellow-400"></i></li>
                                            <li class="mr-1"><i class="fas fa-star text-yellow-400"></i></li>
                                        </ul>
                                        <span class="text-sm">(40)</span>
                                    </div> -->
                                </div>
                                <div class="mt-4 md:mt-auto">
                                    <x-danger-enlace href="{{route('products.show',$product)}}" style="background: var(--fillTint); color: var(--tint); padding: 7px 14px; border-radius: 50vh">
                                        OBTENER
                                    </x-danger-enlace>
                                </div>
                                
                            </div>
                        </article> 
                    </li>
                @empty
                    <li class="md:col-span-2 lg:col-span-4">
                        <div class="bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded relative" role="alert">
                            <strong class="font-bold">¡Ups!</strong>
                            <span class="block sm:inline" style="color: var(--labelSecondary)">No existen registros con ese filtro.</span>
                            <span class="absolute top-0 bottom-0 right-0 px-4 py-3">
                        </div>
                    </li>
                @endforelse
            </ul>
                
            @endif

            <div class="mt-4">
                {{$products->links()}}
            </div>
        </div>
    </div>
</div>
