@props(['category'])
<div class="grid grid-cols-4 p-4" style="display: flex; flex-direction: column-reverse; gap: 16px">
    <div>
        <p class="text-lg font-bold text-trueGray-500 mb-3">
            Subcategorías
        </p>
        <ul>
            @forelse($category->subcategories as $subcategory)
                <li>
                    <a href="{{route('categories.show',$category).'?subcategoria='.$subcategory->slug}}" class="text-trueGray-500 inline-block font-semibold py-1 px-4 hover:text-orange-400">
                        {{$subcategory->name}}
                    </a>
                </li>
            @empty
                <span style="color: var(--labelSecondary)">Sin subcategorías</span>
            @endforelse
        </ul>

    </div>
    <div class="col-span-3">
        <img src="{{Storage::url($category->image)}}" alt="" class="h-64 w-full object-cover object-center" style="border-radius: 10px">
    </div>
</div>