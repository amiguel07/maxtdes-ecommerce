<x-admin-layout>
    <div class="container py-12">
        @livewire('admin.create-category')
    </div>
    @push('script')
        <script>
        Livewire.on('eliminaCategory', categorySlug => {
            Swal.fire({
                    title: '¿Estás seguro?',
                    text: "¡No podrás revertir esto!",
                    icon: 'warning',
                    showCancelButton: true,
                    confirmButtonColor: '#3085d6',
                    cancelButtonColor: '#d33',
                    confirmButtonText: '¡Sí, bórrala!'
                }).then((result) => {
                if (result.isConfirmed) {

                    Livewire.emitTo('admin.create-category','delete',categorySlug);

                    Swal.fire(
                    '¡Eliminada!',
                    'Su categoría ha sido eliminada',
                    'success'
                    )
                }
                })
        });
        </script>
    @endpush
</x-admin-layout>