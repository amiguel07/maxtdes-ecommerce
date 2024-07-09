<div>
    <div class="container py-12">
    
        <x-jet-form-section submit="save" class="mb-4">
            <x-slot name="title">
                Agregar una marca
            </x-slot>
    
            <x-slot name="description">
                Complete la informacion necesaria para poder agregar una nueva marca
            </x-slot>
            <x-slot name="form">
                <div class="col-span-6 sm:col-span-4">
                    <x-jet-label>
                        Nombre
                    </x-jet-label>
                    <x-jet-input wire:model="createForm.name" type="text" class="w-full mt-1"/>
                    <x-jet-input-error for="createForm.name" />
    
                </div>
            </x-slot>
            <x-slot name="actions">
                <x-jet-action-message class="mr-3" on="saved">
                    Subcategoria Creada
                </x-jet-action-message>
                <x-jet-button>
                    Agregar
                </x-jet-button>
            </x-slot>
        </x-jet-form-section>

        <x-jet-action-section>
            <x-slot name="title">
                Lista de Marcas
            </x-slot>
    
            <x-slot name="description">
                Aquí encontrará todas las marcas agregadas
            </x-slot>
    
            <x-slot name="content">
                <table class="text-gray-600">
                    <thead class="border-b border-gray-300">
                        <tr class="text-left" >
                            <th class="py-2 w-full">Nombre</th>
                            <th class="py-2">Accion</th>
                        </tr>
                    </thead>
    
                    <tbody class="divide-y divide-gray-300">
                        @foreach ($brands as $brand)
                            <tr>
                                <td class="py-2">
                                    <a class="uppercase">
                                        {{$brand->name}}
                                    </a>
                                </td>
                                <td class="py-2">
                                    <div class="flex divide-x divide-gray-300 font-semibold">
                                        <a class="pr-2 hover:text-blue-600 cursor-pointer" wire:click="edit('{{$brand->id}}')">Editar</a>
                                        <a class="pl-2 hover:text-red-600 cursor-pointer" wire:click="$emit('eliminaBrand','{{$brand->id}}')">Eliminar</a>
                                    </div>
                                </td>
                            </tr>
    
                        @endforeach
                    </tbody>
    
                </table>
            </x-slot>
    
        </x-jet-action-section>

        <x-jet-dialog-modal wire:model="open">
        
            <x-slot name="title">
                Editar categoría
            </x-slot>
            <x-slot name="content">
                <div class="space-y-3">
                    <div>
                        <x-jet-label>
                            Nombre
                        </x-jet-label>
                        <x-jet-input wire:model="editForm.name" type="text" class="w-full mt-1"/>
                        <x-jet-input-error for="editForm.name" />
                    </div>

                </div>
            </x-slot>
            <x-slot name="footer">
                <x-jet-danger-button
                wire:click="update"
                wire:loading.attr="disabled"
                wire:target="update">
                    Actualizar
                </x-jet-danger-button>
            </x-slot>
        </x-jet-dialog-modal>
    </div>
    @push('script')
        <script>
            Livewire.on('eliminaBrand',brandId => {
                Swal.fire({
                title: '¿Estás seguro?',
                text: "¡No podrás revertir esto!",
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                confirmButtonText: '¡Sí, bórralo!'
                cancelButtonText: 'Cancelar'
                }).then((result) => {
                if (result.isConfirmed) {

                    Livewire.emitTo('admin.brand-controller','delete',brandId);

                    Swal.fire(
                    '¡Borrado!',
                    'Su archivo ha sido eliminado.',
                    'success'
                    )
                }
                })
            })
        </script>
    @endpush
</div>
