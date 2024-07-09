<div>
    <x-slot name="header">
            <h2 class="font-semibold text-xl text-gray-600">
                Departamento <span class="uppercase">{{$department->name}}</span>
            </h2>
    </x-slot>

    <div class="container py-12">
    
        <x-jet-form-section submit="save" class="mb-4">
            <x-slot name="title">
                Crear una Ciudad
            </x-slot>
    
            <x-slot name="description">
                Complete la informacion necesaria para poder crear asignar una ciudad al departamento {{$department->name}}.
            </x-slot>
            <x-slot name="form">
                <div class="col-span-6 sm:col-span-4">
                    <x-jet-label>
                        Nombre
                    </x-jet-label>
                    <x-jet-input wire:model.defer="createForm.name" type="text" class="w-full mt-1"/>
                    <x-jet-input-error for="createForm.name" />
    
                </div>
                <div class="col-span-6 sm:col-span-4">
                    <x-jet-label>
                        Costo
                    </x-jet-label>
                    <x-jet-input wire:model.defer="createForm.cost" type="number" class="w-full mt-1"/>
                    <x-jet-input-error for="createForm.cost" />
    
                </div>               
            </x-slot>
            <x-slot name="actions">
                <x-jet-action-message class="mr-3" on="saved">
                    Ciudad Asignada
                </x-jet-action-message>
                <x-jet-button>
                    Agregar
                </x-jet-button>
            </x-slot>
        </x-jet-form-section>

        <x-jet-action-section>
            <x-slot name="title">
                Lista de Ciudades
            </x-slot>
    
            <x-slot name="description">
                Aquí encontrará todas las ciudades agregadas
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
                        @foreach ($cities as $city)
                            <tr>
                                <td class="py-2">
                                    <a class="uppercase underline hover:text-orange-500" href="{{route('admin.cities.show',$city)}}">
                                        {{$city->name}}
                                    </a>
                                </td>
                                <td class="py-2">
                                    <div class="flex divide-x divide-gray-300 font-semibold">
                                        <a class="pr-2 hover:text-blue-600 cursor-pointer" wire:click="edit('{{$city->id}}')">Editar</a>
                                        <a class="pl-2 hover:text-red-600 cursor-pointer" wire:click="$emit('eliminacity','{{$city->id}}')">Eliminar</a>
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
                Editar Ciudad
            </x-slot>
            <x-slot name="content">
                <div class="space-y-3">
                    <div>
                        <x-jet-label>
                            Nombre
                        </x-jet-label>
                        <x-jet-input wire:model.defer="editForm.name" type="text" class="w-full mt-1"/>
                        <x-jet-input-error for="editForm.name" />
                    </div>
                    <div>
                        <x-jet-label>
                            Costo
                        </x-jet-label>
                        <x-jet-input wire:model.defer="editForm.cost" type="number" class="w-full mt-1"/>
                        <x-jet-input-error for="editForm.cost" />
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
            Livewire.on('eliminacity',cityId => {
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

                    Livewire.emitTo('admin.show-department','delete',cityId);

                    Swal.fire(
                    '¡Eliminada!',
                    'Su ciudad ha sido eliminada.',
                    'success'
                    )
                }
                })
            })
        </script>
    @endpush
</div>
