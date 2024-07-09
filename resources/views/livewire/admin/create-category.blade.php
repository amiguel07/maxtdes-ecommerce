<div>
    <x-jet-form-section submit="save" class="mb-4">
        <x-slot name="title">
            Crear categoría
        </x-slot>

        <x-slot name="description">
            Complete la informacion necesaria para poder crear una nueva categoría
        </x-slot>
        <x-slot name="form">
            <div class="col-span-6 sm:col-span-4">
                <x-jet-label>
                    Nombre
                </x-jet-label>
                <x-jet-input wire:model="createForm.name" type="text" class="w-full mt-1"/>
                <x-jet-input-error for="createForm.name" />

            </div>
            <div class="col-span-6 sm:col-span-4">
                <x-jet-label>
                    Slug
                </x-jet-label>
                <x-jet-input wire:model="createForm.slug" type="text" disabled class="w-full mt-1 bg-gray-200"/>
                <x-jet-input-error for="createForm.slug" />

            </div>
            <div class="col-span-6 sm:col-span-4">
                <x-jet-label>
                    Icono
                </x-jet-label>
                <x-jet-input wire:model.defer="createForm.icon" type="text" class="w-full mt-1"/>
                <x-jet-input-error for="createForm.icon" />

            </div>

            <div class="col-span-6 sm:col-span-4">
                <x-jet-label>
                    Imagen
                </x-jet-label>
                <input accept="image/*" wire:model="createForm.image" type="file" class="mt-1" id={{$rand}} required>
                <x-jet-input-error for="createForm.image" />

            </div>
        </x-slot>
        <x-slot name="actions">
            <x-jet-action-message class="mr-3" on="saved">
                Categoria Creada
            </x-jet-action-message>
            <x-jet-button style="background: var(--tint)">
                Agregar
            </x-jet-button>
        </x-slot>
    </x-jet-form-section>

    <x-jet-action-section >
        <x-slot name="title">
            Lista de categorías
        </x-slot>

        <x-slot name="description">
            Aquí encontrará todas las categorías agregadas
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
                    @foreach ($categories as $category)
                        <tr>
                            <td class="py-2">
                                <span class="inline-block w-8 text-center">
                                    {!!$category->icon!!}
                                </span>

                                <a href="{{route('admin.categories.show',$category)}}" class="underline uppercase hover:text-orange-600 ">
                                    {{$category->name}}
                                </a>
                            </td>
                            <td class="py-2">
                                <div class="flex divide-x divide-gray-300 font-semibold">
                                    <a class="pr-2 hover:text-blue-600 cursor-pointer" wire:click="edit('{{$category->slug}}')">Editar</a>
                                    <a class="pl-2 hover:text-red-600 cursor-pointer" wire:click="$emit('eliminaCategory','{{$category->slug}}')">Eliminar</a>
                                </div>
                            </td>
                        </tr>

                    @endforeach
                </tbody>

            </table>
        </x-slot>

    </x-jet-action-section>
    
    <x-jet-dialog-modal wire:model="editForm.open">
        
        <x-slot name="title">
            Editar categoría
        </x-slot>
        <x-slot name="content">
            <div class="space-y-3">
                <div>
                    @if ($editImage)
                        <img class="w-full h-64 object-cover object-center" src="{{$editImage->temporaryUrl()}}" alt="">
                    @else
                        <img class="w-full h-64 object-cover object-center" src="{{Storage::url($editForm['image'])}}" alt="">
                    @endif
                </div>
                <div>
                    <x-jet-label>
                        Nombre
                    </x-jet-label>
                    <x-jet-input wire:model="editForm.name" type="text" class="w-full mt-1"/>
                    <x-jet-input-error for="editForm.name" />
                </div>
                <div>
                    <x-jet-label>
                        Slug
                    </x-jet-label>
                    <x-jet-input wire:model="editForm.slug" type="text" disabled class="w-full mt-1 bg-gray-200"/>
                    <x-jet-input-error for="editForm.slug" />
                </div>
                <div>
                    <x-jet-label>
                        Icono
                    </x-jet-label>
                    <x-jet-input wire:model.defer="editForm.icon" type="text" class="w-full mt-1"/>
                    <x-jet-input-error for="editForm.icon" />
                </div>
                <div>
                    <x-jet-label>
                        Imagen
                    </x-jet-label>
                    <input accept="image/*" wire:model="editImage" type="file" class="mt-1" id={{$rand}}>
                    <x-jet-input-error for="editImage" />    
                </div>
            </div>
        </x-slot>
        <x-slot name="footer">
            <x-jet-danger-button
            wire:click="update"
            wire:loading.attr="disabled"
            wire:target="editImage,update" style="background: var(--tint)">
                Actualizar
            </x-jet-danger-button>
        </x-slot>
    </x-jet-dialog-modal>
</div>
