<x-app-layout>

    <div class="container py-8">
        <figure class="mb-4">
            <img class="w-full h-80 object-center object-cover" style="border-radius: 10px" src="{{Storage::url($category->image)}}" alt="">
        </figure>

        @livewire('category-filter', ['category' => $category])

    </div>

</x-app-layout>