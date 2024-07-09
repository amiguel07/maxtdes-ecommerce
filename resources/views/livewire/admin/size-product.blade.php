<div>
    <div class="my-12 bg-white shadow-lg rounded-lg p-6">
        
        {{--Talla--}}
        <div class="mb-4">
            <x-jet-label value="Talla" />

            <x-jet-input
            wire:model="name"
            type="text" class="w-full" 
            placeholder="Ingrese una talla"/>
                    
            <x-jet-input-error for="name" />
        </div>

        {{--Button--}}
        <div class="flex justify-end items-center">

            <x-jet-action-message class="mr-3" on="saved">
                Agregado
            </x-jet-action-message>

            <x-jet-button 
            wire:click="save"
            wire:loading.attr="disabled"
            wire:target="save">
                Agregar
            </x-jet-button>
        </div>

        
    </div>

    <ul class="mt-12 space-y-4">
        @foreach ($sizes as $size)
            <li wire:key="size-{{$size->id}}" class="bg-white shadow-lg rounded-lg p-6">
                <div class="flex items-center">
                    <span class="text-xl font-medium">{{$size->name}}</span>

                    <div class="ml-auto">
                        <x-jet-button 
                            wire:click="edit({{$size->id}})"
                            wire:loading.attr="disabled"
                            wire:target="edit({{$size->id}})">
                            <i class="fas fa-edit"></i>
                        </x-jet-button>
                        <x-jet-danger-button
                            wire:click="$emit('deleteSize',{{$size->id}})">                            
                            <i class="fas fa-trash"></i>
                        </x-jet-danger-button>
                    </div>
                </div>

                @livewire('admin.color-size', ['size' => $size], key('color-size-'.$size->id))
            </li>
        @endforeach
    </ul>

    <x-jet-dialog-modal wire:model="open">
        <x-slot name="title">
            Editar Talla
        </x-slot >            
        <x-slot name="content">
            <div>
                <x-jet-label>Talla</x-jet-label>
                <x-jet-input wire:model="name_edit" type="text" class="w-full"/>
                <x-jet-input-error for="name_edit" />
            </div>
        </x-slot>

        <x-slot name="footer">
            <x-jet-secondary-button
            wire:click="$set('open',false)">
                Cancelar
            </x-jet-secondary-button>
            
            <x-jet-button
            wire:click="update"
            wire:loading.attr="disabled"
            wire:target="update">
                Actualizar
            </x-jet-button>
        </x-slot>
    </x-jet-dialog-modal>

</div>
