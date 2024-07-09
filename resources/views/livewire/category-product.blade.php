<div wire:init="loadPost" > <!--  -->
    @if (count($products))
        <div class="glider-contain">
            <ul class="glider-{{$category->id}}">
            @foreach ($products as $product)
                <li class="bg-white rounded-lg {{$loop->last ? '':'sm:mr-4'}}" style="background: transparent">
                    <article> 
                        <figure>
                            @if(!$product->images->isEmpty())
                                        <img class="h-48 w-full object-cover object-center" src="{{Storage::url($product->images->first()->url)}}" alt="Imagen de producto {{ $product->name }}" style="border-radius: 10px">
                                    @else
                                        <img class="h-48 w-full object-cover object-center" src="https://images.pexels.com/photos/2536965/pexels-photo-2536965.jpeg?auto=compress&cs=tinysrgb&dpr=3&h=750&w=1260" alt="">
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
            @endforeach
            </ul>
        
            <button aria-label="Previous" class="glider-prev">«</button>
            <button aria-label="Next" class="glider-next">»</button>
            <div role="tablist" class="dots"></div>
        </div>
    @else
        <div class="mb-4 h-48 flex justify-center items-center bg-white shadow-xl border border-gray-100 rounded-lg">
            <div class="rounded animate-spin ease duration-300 w-10 h-10 border-2 border-indigo-500"></div>
        </div>	
    @endif
</div>
