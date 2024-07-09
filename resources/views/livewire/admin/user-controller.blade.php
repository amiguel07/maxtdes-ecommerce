<div>
    <x-slot name="header">
        <div class="flex items-center">
            <h2 class="font-semibold text-xl text-gray-600">
                Lista de Usuarios
            </h2>
        </div>
    </x-slot>
    

    <!-- This example requires Tailwind CSS v2.0+ -->
    <div class="container py-12">
        <div class="flex flex-col">
            <div class="-my-2 overflow-x-auto sm:-mx-6 lg:-mx-8">
            <div class="py-2 align-middle inline-block min-w-full sm:px-6 lg:px-8">
                <div class="shadow overflow-hidden border-b border-gray-200 sm:rounded-lg">
                    
                    <div class="px-6 py-4">
                        <x-jet-input type="text"
                        wire:model="search"
                        class="w-full"
                        placeholder="Buscar"/>
                    </div>
                    

                    @if ($users->count())
                        <table class="min-w-full divide-y divide-gray-200">
                            <thead class="bg-gray-50">
                                <tr>
                                    <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                        ID
                                    </th>
                                    <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                        Nombre
                                    </th>
                                    <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                        Email
                                    </th>

                                    <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                        Celular
                                    </th>
                                    <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                        Dirección
                                    </th>

                                    <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                        Rol
                                    </th>
                                    <th scope="col" class="px-6 py-3 text-center text-xs font-medium text-gray-500 uppercase tracking-wider">
                                        Asignar
                                    </th>
                                </tr>
                            </thead>
                            <tbody class="bg-white divide-y divide-gray-200">
                            
                                @foreach ($users as $user)
                                    <tr wire:key="{{$user->email}}">
                                        <td class="px-6 py-4 whitespace-nowrap">
                                            <div class=" text-gray-900">
                                                {{$user->id}}
                                            </div>
                                        </td>
                                        <td class="px-6 py-4 whitespace-nowrap">
                                            <div class="text-sm text-gray-900">
                                                {{$user->name}} <br> <span style="color: var(--labelSecondary)">{{$user->nid}}</span>
                                            </div>
                                        </td>
                                        <td class="px-6 py-4 whitespace-nowrap">
                                            <div class="text-sm text-gray-900">
                                                {{$user->email}}
                                            </div>
                                        </td>

                                        <td class="px-6 py-4 whitespace-nowrap">
                                            <div class="text-sm text-gray-900">
                                                {{$user->cellular}}
                                            </div>
                                        </td>
                                        <td class="px-6 py-4 whitespace-nowrap">
                                            <div class="text-sm text-gray-900">
                                                {{$user->address}}
                                            </div>
                                        </td>

                                        <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">
                                            <div class="text-sm text-gray-900">
                                                @if ($user->roles->count())
                                                    Admin
                                                @else
                                                    Sin Rol
                                                @endif
                                            </div>
                                        </td>
                                        <td class="px-6 py-4 whitespace-nowrap text-center text-sm font-medium ">
                                            <label >
                                                <input {{count($user->roles)?'checked':''}} type="radio" value="1" wire:change="assignRole({{$user->id}},$event.target.value)">
                                                SI
                                            </label>
                                            <label >
                                                <input {{count($user->roles)?'':'checked'}} type="radio" value="0" wire:change="assignRole({{$user->id}},$event.target.value)">
                                                NO
                                            </label>
                                        </td>
                                    </tr>
                                @endforeach
                            <!-- More people... -->
                            </tbody>
                        </table>
                    @else
                        <div class="px-6 py-4">
                            No existe coincidencias
                        </div>
                    @endif

                    @if ($users->hasPages())
                        <div class="px-6 py-4">
                            {{$users->links()}}
                        </div>
                    @endif
                </div>
            </div>
            </div>
        </div>
    </div>
  
</div>

