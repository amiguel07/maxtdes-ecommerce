<div>
    <div class="container py-12">
    
        <x-jet-form-section submit="save" class="mb-4">
            <x-slot name="title">
                Agregar una diapositiva
            </x-slot>
    
            <x-slot name="description">
                Complete la informacion necesaria para poder agregar una nueva diapositiva al carrusel
            </x-slot>
            <x-slot name="form">
                <div class="col-span-6 sm:col-span-4">
                    <x-jet-label>
                        Imagen
                    </x-jet-label>
                    <input accept="image/*" wire:model="createForm.image" type="file" class="mt-1">
                    <x-jet-input-error for="createForm.image" />
                </div>
                <div class="col-span-6 sm:col-span-4">
                    <x-jet-label>
                        Título
                    </x-jet-label>
                    <x-jet-input wire:model="createForm.name" type="text" class="w-full mt-1"/>
                    <x-jet-input-error for="createForm.name" />
                </div>
                <div class="col-span-6 sm:col-span-4">
                    <x-jet-label>
                        Descripción
                    </x-jet-label>
                    <x-jet-input wire:model="createForm.desc" type="text" class="w-full mt-1"/>
                    <x-jet-input-error for="createForm.desc" />
                </div>
            </x-slot>
            <x-slot name="actions">
                <x-jet-action-message class="mr-3" on="saved">
                    Diapositiva agregada
                </x-jet-action-message>
                <x-jet-button>
                    Agregar
                </x-jet-button>
            </x-slot>
        </x-jet-form-section>

        <x-jet-action-section>
            <x-slot name="title">
                Diapositivas
            </x-slot>
    
            <x-slot name="description">
                Aquí encontrará todas las diapositivas agregadas
            </x-slot>
    
            <x-slot name="content" style="display: flex; gap: 16px">
                <!-- <table class="text-gray-600">
                    <thead class="border-b border-gray-300">
                        <tr class="text-left" >
                            <th class="py-2 w-full">Vista previa</th>
                             <th class="py-2 w-full">Título</th>
                            <th class="py-2 w-full">Descripción</th>
                            <th class="py-2">Accion</th>
                        </tr>
                    </thead>
    
                    <tbody class="divide-y divide-gray-300"> -->
                        <div style="display: flex; flex-direction: column; gap: 16px">
                            @foreach ($carousels as $carousel)
                                <div class="carousel-container">
                                    <img class="carousel" src="{{ asset('storage/carousel/'.$carousel->image) }}" alt="{{ $carousel->name }}">
                                    <div class="text">
                                        <span class="title">{{ $carousel->name }}</span> <br>
                                        <span class="desc">{{ $carousel->desc }}</span>
                                    </div>
                                    <div class="option">
                                        <a class="pr-2 hover:text-blue-600 cursor-pointer" wire:click="edit('{{$carousel->id}}')">
                                            <button class="edit">Editar</button>
                                        </a>
                                        <a class="pl-2 hover:text-red-600 cursor-pointer" wire:click="$emit('eliminaCarousel','{{$carousel->id}}')">
                                            <button class="delete"><i class="far fa-trash-alt"></i></button>
                                        </a>
                                    </div>
                                </div>
                            @endforeach
                        </div>
                        
                    <!-- </tbody> -->

                    <style>
                        img.carousel {
                            border-radius: 10px;
                            object-fit: cover;
                            height: 260px;
                            width: 100%;
                        }
                        span.title {
                            font-size: 12px;
                            font-weight: bold;
                            color: white
                        }
                        span.desc {
                            font-size: 11px;
                            color: var(--labelSecondaryDark);
                        }
                        a button {
                            border-radius: 40px;
                            font-size: 15px;
                            padding: 4px 10px;
                            background: var(--fillPrimary);
                            backdrop-filter: saturate(180%) blur(20px);
                            color: rgba(255, 255, 255, .75);
                        }
                        button.edit:hover {
                            background: var(--tint);
                            color: white
                        }
                        button.delete:hover {
                            background: red;
                            color: white
                        }
                        div.carousel-container {
                            position: relative;
                            
                        }
                        div.carousel-container::before {
                            border-radius: 10px;
                            content: '';
                            position: absolute;
                            width: 100%;
                            height: 50%;
                            bottom: 0;
                            left: 0;
                            background: linear-gradient(to top, rgba(0, 0, 0, 1), transparent);
                        }
                        div.text{
                            position: absolute;
                            bottom: 10px;
                            left: 50%;
                            transform: translateX(-50%);
                            text-align: center;
                        }
                        div.option {
                            position: absolute;
                            top: 10px;
                            right: 10px;
                        }
                        .option a {
                            margin: 0;
                            padding: 0
                        }
                    </style>
    
                </table>
            </x-slot>
    
        </x-jet-action-section>

        <x-jet-dialog-modal wire:model="open">
        
            <x-slot name="title">
                Editar diapositiva
            </x-slot>
            <x-slot name="content">
                <div class="space-y-3">
                    <div>
                        <x-jet-label>
                            Imagen
                        </x-jet-label>
                        <input accept="image/*" wire:model="editForm.image" type="file" class="mt-1">
                        <x-jet-input-error for="editForm.image" />    
                    </div>
                    <div>
                        <x-jet-label>
                            Título
                        </x-jet-label>
                        <x-jet-input wire:model="editForm.name" type="text" class="w-full mt-1"/>
                        <x-jet-input-error for="editForm.name" />
                    </div>
                    <div>
                        <x-jet-label>
                            Descripción
                        </x-jet-label>
                        <x-jet-input wire:model="editForm.desc" type="text" class="w-full mt-1"/>
                        <x-jet-input-error for="editForm.desc" />
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
            Livewire.on('eliminaCarousel',carouselId => {
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

                    Livewire.emitTo('admin.carousel-controller','delete',carouselId);

                    Swal.fire(
                    '¡Eliminada!',
                    'Su diapositiva ha sido eliminada.',
                    'success'
                    )
                }
                })
            })
        </script>
    @endpush
</div>