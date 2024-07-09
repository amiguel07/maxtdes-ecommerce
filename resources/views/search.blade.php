<x-app-layout>
    <div class="container py-8">
        <ul>
            @forelse ($products as $product)
                <li class="bg-white rounded-lg shadow mb-4">
                    <article class="flex"> 
                        <figure>
                            <img class="h-48 w-56 object-cover object-center" src="{{Storage::url($product->images->first()->url)}}" style="border-radius: 10px 0 0 10px"  alt="">
                        </figure>
                        <div class="flex-1 py-4 px-6 flex flex-col">
                            <div class="flex justify-between">
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
                            <div class="mt-auto">
                                <x-danger-enlace href="{{route('products.show',$product)}}" style="background: var(--fillTint); color: var(--tint); border-radius: 50vh">
                                    OBTENER
                                </x-danger-enlace>
                            </div>
                            
                        </div>
                    </article> 
                </li>
            @empty
                <li class="bg-white rounded-lg shadow-lg">
                    <div class="p-4">
                        <p class="text-lg text-gray-700" style="color: var(--labelSecondary)">
                            No existe ningún producto similar.
                        </p>
                    </div>
                </li>
            @endforelse
        </ul>

        <div class="mt-4">
            {{$products->links()}}
        </div>
    </div>
</x-app-layout>