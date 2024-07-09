<div>
    <div class="container py-12">
    
        <x-jet-form-section submit="save" class="mb-4">
            <x-slot name="title">
                Agregar un método de pago
            </x-slot>
    
            <x-slot name="description">
                Complete la informacion necesaria para poder agregar un nuevo método de pago a la pasarela.
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
                        Banco
                    </x-jet-label>
                    <x-jet-input wire:model="createForm.bank" type="text" class="w-full mt-1"/>
                    <x-jet-input-error for="createForm.bank" />
                </div>
                <div class="col-span-6 sm:col-span-4">
                    <x-jet-label>
                        Número de cuenta
                    </x-jet-label>
                    <x-jet-input wire:model="createForm.number" type="text" class="w-full mt-1"/>
                    <x-jet-input-error for="createForm.number" />
                </div>
            </x-slot>
            <x-slot name="actions">
                <x-jet-action-message class="mr-3" on="saved">
                    Método de pago agregado
                </x-jet-action-message>
                <x-jet-button>
                    Agregar
                </x-jet-button>
            </x-slot>
        </x-jet-form-section>

        <x-jet-action-section>
            <x-slot name="title">
                Métodos de pago
            </x-slot>
    
            <x-slot name="description">
                Aquí encontrará todas los métodos de pago
            </x-slot>
    
            <x-slot name="content" style="display: flex; gap: 16px">
                        <div style="display: flex; flex-direction: column; gap: 16px">
                            @foreach ($payments as $payment)
                                <div class="content">
                                    @if($payment->image)
                                        <img class="payment" src="{{ asset('storage/'.$payment->image) }}" alt="{{ $payment->image }}">
                                    @else
                                        <i class='far fa-credit-card payment'></i>
                                    @endif
                                    <div class="desc">
                                        <span class="title">{{ $payment->bank }}</span> <br>
                                        <span class="subtitle">{{ $payment->number }}</span> <br> <br>
                                        <a class="default edit" wire:click="edit('{{$payment->id}}')">Editar</a>
                                        <a class="default delete" wire:click="$emit('eliminaPayment','{{$payment->id}}')">Eliminar</a>
                                    </div>
                                </div>
                            @endforeach
                        </div>
                        
                    <!-- </tbody> -->

                    <style>
                        div.content {
                            display: flex;
                            flex-direction: row;
                            margin: 8px
                        }
                        div.desc {
                            padding: 16px
                        }
                        img.payment {
                            height: 144px
                        }
                        i.payment {
                            font-size: 126px
                        }
                        span.title {
                            font-size: 17px;
                            font-weight: bold
                        }
                        span.subtitle {
                            color: rgba(60,60,67,.6);
                            font-size: 15px
                        }
                        a.default {
                            font-size: 15px;
                            padding: 7px 14px;
                            background: var(--fillTertiary);
                            border-radius: 40px;
                            cursor: pointer
                        }
                        a.default:hover {
                            background: var(--fillTint);
                        }
                        a.edit {
                            color: var(--tint);
                        }
                        a.delete {
                            color: #FF3B30
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
                            Banco
                        </x-jet-label>
                        <x-jet-input wire:model="editForm.bank" type="text" class="w-full mt-1"/>
                        <x-jet-input-error for="editForm.bank" />
                    </div>
                    <div>
                        <x-jet-label>
                            Número de cuenta
                        </x-jet-label>
                        <x-jet-input wire:model="editForm.number" type="text" class="w-full mt-1"/>
                        <x-jet-input-error for="editForm.number" />
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
            Livewire.on('eliminaPayment',paymentId => {
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

                    Livewire.emitTo('admin.payment-controller','delete',paymentId);

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