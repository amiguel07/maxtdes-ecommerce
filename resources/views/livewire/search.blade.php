<div class="flex-1 relative" x-data>
    <form action="{{route('search')}}" autocomplete="off">
        <x-jet-input name="name" wire:model="search" type="text" class="w-full text-sm" placeholder="🔍 Buscar" style="background: var(--fillTertiary); border-radius: 10px; border: 0;" />

        <button class="absolute top-0 right-0 w-12 h-full bg-orange-500 flex items-center justify-center rounded-r-md" style="background: var(--tint); border-radius: 0 10px 10px 0; display: none">
            <x-search size="35" color="white" />
        </button>
    </form>
    <div class="absolute w-full hidden" :class="{'hidden': !$wire.open}" @click.away="$wire.open=false">
        <div class="rounded-lg bg-white shadow mt-1">
            <div class="px-3 py-3" style="padding: 0">
                @forelse ($products as $product)
                    <a href="{{route('products.show',$product)}}" class="flex py-1 {{$loop->last ? '':'border-b border-gray-200'}}">
                        <div style="display: flex; align-items: center; padding: 16px">
                            <img class="h-12 w-12 object-cover object-center" src="{{Storage::url($product->images->first()->url)}}" style="border-radius: 25%" alt="">
                            <div class="ml-4 text-gray-700">
                                <p class="text-base font-semibold leading-5">{{$product->name}}</p>
                                <p class="text-sm" style="color: var(--labelSecondary)">{{$product->subcategory->category->name}}</p>
                            </div>
                        </div>
                        
                    </a>
                @empty
                    <p class="text-sm leading-5">
                        No existe ningún producto similar.
                    </p>
                @endforelse
            </div>
        </div>
    </div>
</div>
