<div>
    <div class="bg-white shadow">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-12">
            <div class="flex justify-between items-center">
                <h1 class="font-semibold text-xl text-gray-800 leading-tight">
                    Productos
                </h1>
                <x-jet-danger-button wire:click="$emit('deleteProduct')">
                    Eliminar
                </x-jet-danger-button>
            </div>

        </div>
    </div>

    <div class="max-w-4xl mx-auto px-4 sm:px-6 lg:px-8 py-12 text-gray-700">
        <h1 class="text-3xl text-center font-semibold mb-5">Editar producto</h1>
    
        <div class="mb-4" wire:ignore>
            <form action="{{route('admin.products.files', $product)}}"
                method="POST"
                class="dropzone"
                id="my-awesome-dropzone"></form>
        </div>
    
    
        @if ($product->images->count())
            <section class="bg-white shadow-xl rounded-lg p-6 mb-4">
                <h1>Imagenes del producto</h1>
                <ul class="flex flex-wrap space-x-4">
                    @foreach ($product->images as $image)
                        <li class="relative" wire:key="imagen-n-{{$image->id}}">
                            <img class="w-36 h-24 object-cover" src="{{Storage::url($image->url)}}" alt="">
                            <x-jet-danger-button class="absolute right-1 top-1"
                                wire:click="deleteImage({{$image->id}})"
                                wire:loading.attr="disabled"
                                wire:target="deleteImage({{$image->id}})">
                                X
                            </x-jet-danger-button>
                        </li>
                    @endforeach
                </ul>
            </section>
        @endif
    
        @livewire('admin.status-product', ['product' => $product], key('status-product-'.$product->id))
    
        <div class="bg-white shadow-xl rounded-lg p-6">
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
                    wire:model="product.subcategory_id">
                        <option value="" selected disabled>Selecciona una opcion</option>
    
                        @foreach ($subcategories as $subcategory)
                            <option value="{{$subcategory->id}}">{{$subcategory->name}}</option>
                        @endforeach
                    </select>
    
                    <x-jet-input-error for="product.subcategory_id" />
                </div>
    
    
            </div>
            {{--Nombre--}}
            <div class="mb-4">
                <x-jet-label value="Nombre" />
                <x-jet-input
                wire:model="product.name"
                type="text" class="w-full" placeholder="Ingrese el nombre del producto" />
    
                <x-jet-input-error for="product.name" />
            </div>
            {{--Slug--}}
            <div class="mb-4">
                <x-jet-label value="Slug" />
                <x-jet-input
                disabled
                wire:model="product.slug"
                type="text" class="w-full bg-gray-200" placeholder="Slug del producto" />
                <x-jet-input-error for="product.slug" />
            </div>
            {{--Descripcion--}}
            <div class="mb-4">
                <div  wire:ignore>
                    <x-jet-label value="Descripción" />
                    <textarea x-data
                    wire:model="product.description"
                    x-init="ClassicEditor
                    .create( $refs.mieditor ).then(function(editor){
                        editor.model.document.on('change:data',()=>{
                            @this.set('product.description',editor.getData())
                        })
                    })
                    .catch( error => {
                        console.error( error );
                    } );"
                    x-ref="mieditor"
                    class="w-full form-control" rows="4"></textarea>
                </div>
    
                <x-jet-input-error for="product.description" />
            </div>
    
            <div class="grid grid-cols-2 gap-6 mb-4">
                {{--Precio--}}
                <div>
                    <x-jet-label value="Precio (S/.)" />
                    <x-jet-input
                    wire:model="product.price"
                    type="number" class="w-full" step=".01" placeholder="00.00" />
                    <x-jet-input-error for="product.price" />
                </div>
    
                @if ($this->subcategory)
                @if (!$this->subcategory->color && !$this->subcategory->size)
    
                    <div class="mb-4">
                        <x-jet-label value="Cantidad" />
                        <x-jet-input
                        wire:model="product.quantity"
                        type="number" class="w-full" />
                        <x-jet-input-error for="product.quantity" />
                    </div>
                @endif
            @endif
    
            </div>
    
            
    
            {{--Button--}}
            <div class="flex justify-end items-center">
    
                <x-jet-action-message class="mr-3" on="saved">
                    Actualizado
                </x-jet-action-message>
    
                <x-jet-button
                wire:click="save"
                wire:loading.attr="disabled"
                wire:target="save"
                style="background: var(--tint)"
                >
                    Actualizar Producto
                </x-jet-button>
    
            </div>
        </div>
    
        @if ($this->subcategory)
            @if ($this->subcategory->size)
                @livewire('admin.size-product', ['product' => $product], key('size-product'.$product->id))
            @elseif($this->subcategory->color)
                @livewire('admin.color-product', ['product' => $product], key('color-product'.$product->id))
            @endif
    
        @endif
    
        
    
    </div>

    @push('script')
        <script>
            Dropzone.options.myAwesomeDropzone = {
                headers:{
                    'X-CSRF-TOKEN': "{{ csrf_token() }}"
                },
                dictDefaultMessage: "Arrastre una imagen al recuadro", //Mensaje que quiero que aparezca
                acceptedFiles: 'image/*',
                paramName: "file",
                maxFilesize: 2, //MB Tamaño permitido
                complete: function(file){
                    this.removeFile(file);
                },
                queuecomplete: function(){
                    Livewire.emit('refreshPost');
                }
            };
            Livewire.on('deleteSize',sizeId => {
                Swal.fire({
                title: '¿Estás seguro?',
                text: "¡No podrás revertir esto!",
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                confirmButtonText: '¡Sí, bórrala!',
                cancelButtonText: 'Cancelar'
                }).then((result) => {
                if (result.isConfirmed) {

                    Livewire.emitTo('admin.size-product','delete',sizeId);

                    Swal.fire(
                    '¡Eliminada!',
                    'Su talla de producto ha sido eliminada.',
                    'success'
                    )
                }
                })
            })

            Livewire.on('deleteProduct',() => {
                Swal.fire({
                title: '¿Estás seguro?',
                text: "¡No podrás revertir esto!",
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                confirmButtonText: '¡Sí, bórralo!',
                cancelButtonText: 'Cancelar'
                }).then((result) => {
                if (result.isConfirmed) {

                    Livewire.emitTo('admin.edit-product','delete');

                    Swal.fire(
                    '¡Eliminado!',
                    'Su producto ha sido eliminado.',
                    'success'
                    )
                }
                })
            })

            Livewire.on('deleteColorProduct',pivot => {
                Swal.fire({
                title: '¿Estás seguro?',
                text: "¡No podrás revertir esto!",
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                confirmButtonText: '¡Sí, bórralo!',
                cancelButtonText: 'Cancelar'
                }).then((result) => {
                if (result.isConfirmed) {

                    Livewire.emitTo('admin.color-product','delete',pivot);

                    Swal.fire(
                    '¡Eliminado!',
                    'Su color de producto ha sido eliminado.',
                    'success'
                    )
                }
                })
            })
            Livewire.on('deleteColorSize',pivot => {
                Swal.fire({
                title: '¿Estás seguro?',
                text: "¡No podrás revertir esto!",
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                confirmButtonText: '¡Sí, bórralo!',
                cancelButtonText: 'Cancelar'
                }).then((result) => {
                if (result.isConfirmed) {

                    Livewire.emitTo('admin.color-size','delete',pivot);

                    Swal.fire(
                    '¡Eliminado!',
                    'Su color de talla ha sido eliminado.',
                    'success'
                    )
                }
                })
            })
        </script>
    @endpush
</div>
