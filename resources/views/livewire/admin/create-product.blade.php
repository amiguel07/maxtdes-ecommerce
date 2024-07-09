<div class="max-w-4xl mx-auto px-4 sm:px-6 lg:px-8 py-12 text-gray-700">
    <h1 class="text-3xl text-center font-semibold mb-8">Crear un producto</h1>

    <!-- <div class='grid grid-cols-1 gap-6 mb-4'>
        <x-jet-label value='Imágenes' />
        <x-jet-input wire:model='image' type='file' class='w-full' accept='image/*' multiple />
        <x-jet-input-error for='image' />
    </div> -->

    <div class="grid grid-cols-2 gap-6 mb-4">
        {{--Categorías--}}
        <div>
            <x-jet-label value="Categorías" />
            <select class="w-full form-control"
            wire:model="category_selected">
                <option value="" selected disabled>Selecciona una opcion</option>

                @foreach ($categories as $category)
                    <option value="{{$category->id}}">{{$category->name}}</option>
                @endforeach
            </select>
            <x-jet-input-error for="category_selected" />
        </div>
        {{--Subcategorías--}}
        <div>
            <x-jet-label value="Subcategorías" />
            <select class="w-full form-control"
            wire:model="subcategory_selected">
                <option value="" selected disabled>Selecciona una opcion</option>

                @foreach ($subcategories as $subcategory)
                    <option value="{{$subcategory->id}}">{{$subcategory->name}}</option>
                @endforeach
            </select>

            <x-jet-input-error for="subcategory_selected" />
        </div>

        
    </div>
    {{--Nombre--}}
    <div class="mb-4">
        <x-jet-label value="Nombre" />
        <x-jet-input 
        wire:model="name"
        type="text" class="w-full" placeholder="Ingrese el nombre del producto" />

        <x-jet-input-error for="name" />
    </div>
    {{--Slug--}}
    <div class="mb-4">
        <x-jet-label value="Slug" />
        <x-jet-input
        disabled
        wire:model="slug"
        type="text" class="w-full bg-gray-200" placeholder="Slug generado" />
        <x-jet-input-error for="slug" />
    </div>
    {{--Descripcion--}}
    <div class="mb-4">
        <div  wire:ignore>
            <x-jet-label value="Descripción" />
            <textarea x-data 
            wire:model="description"
            x-init="ClassicEditor
            .create( $refs.mieditor ).then(function(editor){
                editor.model.document.on('change:data',()=>{
                    @this.set('description',editor.getData())
                })
            })
            .catch( error => {
                console.error( error );
            } );"
            x-ref="mieditor"
            class="w-full form-control" rows="4"></textarea>
        </div>
        
        <x-jet-input-error for="description" />
    </div>

    <div class="grid grid-cols-2 gap-6 mb-4">
        {{--Precio--}}
        <div>
            <x-jet-label value="Precio (S/.)" />
            <x-jet-input wire:model="price" type="number" class="w-full" step=".01" placeholder="00.00" />
            <x-jet-input-error for="price" />
        </div>
        <!-- <div>
            <x-jet-label value='Existencias' />
            <x-jet-input wire:model='quantity' type='number' class='w-full' step='1' placeholder='0' />
            <x-jet-input-error for='quantity' />
        </div> -->
        @if ($subcategory_selected)
            @if (!$this->subcategory->color && !$this->subcategory->size)
                
                <div class="mb-4">
                    <x-jet-label value="Cantidad" />
                    <x-jet-input 
                    wire:model="quantity"
                    type="number" class="w-full" />
                    
                    <x-jet-input-error for="quantity" />
                </div>
            @endif
            
    @endif

        
        
    </div>

   

    <div class="flex">
        <x-jet-button class="ml-auto"
        wire:loading.attr="disabled"
        wire:click="save"
        wire:target="save" style="background: var(--tint)">
            Crear Producto  
        </x-jet-button>
        
    </div>

</div>
