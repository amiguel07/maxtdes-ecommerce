
<header x-data="dropdown()" class="bg-trueGray-700 sticky top-0" style="z-index: 1000; background: rgba(255, 255, 255, .75); backdrop-filter: saturate(180%) blur(20px)">
    <div class="container flex items-center h-16 justify-between md:justify-start"> <!--flex un elemento al lado de otro-->
        <a 
        :class="{'bg-opacity-100 text-orange-500' :open}"
        x-on:click="show()"
        class="px-6 flex flex-col items-center justify-center bg-white bg-opacity-25 text-white cursor-pointer font-semibold h-full order-last md:order-first" style="color: var(--tint)">
            <svg class="h-6 w-6" stroke="currentColor" fill="none" viewBox="0 0 24 24">
                <path class="inline-flex" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16" />
            </svg>
        </a>
        <a href="/" class="mx-6">
            <img src="{{asset('img/logo.png')}}" alt="Maxtdes" class="h-9 w-auto">
        </a>
        <div class="flex-1 hidden md:block ">
            @livewire('search')    
        </div>
        <div class="hidden md:block " >
            @livewire('dropdown-cart')
        </div>
        <div class="relative hidden md:block">
            @auth
                <x-jet-dropdown align="right" width="48">
                    <x-slot name="trigger">
                        <button class="flex text-sm border-2 border-transparent rounded-full focus:outline-none focus:border-gray-300 transition">
                            <img class="h-8 w-8 rounded-full object-cover" src="{{ Auth::user()->profile_photo_url }}" alt="{{ Auth::user()->name }}" />
                        </button>
                    </x-slot>

                    <x-slot name="content">
                        <!-- Account Management -->
                        <div class="block px-4 py-2 text-xs text-gray-400">
                            <!-- {{ __('Manage Account') }} -->
                            Administrar cuenta
                        </div>

                        <x-jet-dropdown-link href="{{ route('profile.show') }}">
                            {{ __('Profile') }}
                        </x-jet-dropdown-link>

                        <x-jet-dropdown-link href="{{ route('orders.index') }}">
                            Mis Ordenes
                        </x-jet-dropdown-link>

                        @role('admin')
                            <x-jet-dropdown-link href="{{ route('admin.index') }}">
                                Administrador
                            </x-jet-dropdown-link>
                        @endrole

                        <div class="border-t border-gray-100"></div>

                        <!-- Authentication -->
                        <form method="POST" action="{{ route('logout') }}">
                            @csrf

                            <x-jet-dropdown-link href="{{ route('logout') }}"
                                    onclick="event.preventDefault();
                                            this.closest('form').submit();">
                                {{ __('Log Out') }}
                            </x-jet-dropdown-link>
                        </form>
                    </x-slot>
                </x-jet-dropdown>
            @else
                <x-jet-dropdown align="right" width="48">
                    <x-slot name="trigger">
                        <i class="fas fa-user-circle text-white text-3xl cursor-pointer" style="color: var(--tint)"></i>
                    </x-slot>

                    <x-slot name="content">
                        
                        <x-jet-dropdown-link href="{{ route('login') }}">
                            {{ __('Iniciar sesión') }}
                        </x-jet-dropdown-link>
                        <x-jet-dropdown-link href="{{ route('register') }}">
                            {{ __('Registrar') }}
                        </x-jet-dropdown-link>

                    </x-slot>
                </x-jet-dropdown>
            @endauth
        </div>
        
    </div>
    <nav id="navigation-menu"
    x-show="open"
    :class="{'block': open,'hidden': !open}"  
    class="bg-trueGray-700 bg-opacity-25 w-full absolute hidden">
        {{--Menu Desktop--}}
        <div class="container h-full hidden md:block">
            <div x-on:click.away="open = false" class="grid grid-cols-4 h-full relative">
                <ul class="bg-white" style="background: var(--tint)">
                    @foreach ($categories as $category)
                        <!-- <li class="navigation-link text-trueGray-500 hover:bg-orange-500 hover:text-white"> -->
                        <li class="navigation-link text-white-500 nav-link">
                            <a href="{{route('categories.show',$category)}}" class="py-3 px-4 text-sm flex items-center">
                                <span class="flex justify-center w-9">
                                    {!!$category->icon!!}
                                </span>
                                {{$category->name}}
                            </a>

                            <div class="navigation-submenu bg-gray-100 absolute w-3/4 h-full top-0 right-0 hidden" style="background: var(--bgSecondary)">
                                <x-navigation-subcategories :category="$category" />
                            </div>
                        </li>
                    @endforeach
                    <style>
                        .nav-link {
                            color: white;
                            font-weight: bold
                        }
                        .nav-link:hover {
                            background: white;
                            color: var(--tint);
                        }
                    </style>
                </ul>
                <div class="col-span-3 bg-gray-100" style="background: var(--bgSecondary)">
                    <x-navigation-subcategories :category="$categories->first()" />
                </div>
            </div>            
        </div>
        {{--Menu Mobile--}}
        <div class="bg-white h-full overflow-y-auto block md:hidden">
            <div class="container bg-gray-200 py-2">
                @livewire('search')
            </div>
            <ul>
                @foreach ($categories as $category)
                <li class="text-trueGray-500 hover:bg-yellow-500 hover:text-white">
                    <a href="{{route('categories.show',$category)}}" class="py-3 px-4 text-sm flex items-center">
                        <span class="flex justify-center w-9">
                            {!!$category->icon!!}
                        </span>
                        {{$category->name}}
                    </a>
                </li>
                @endforeach
            </ul>
            
            <p class="text-trueGray-500 px-6 my-2">USUARIOS</p>
            @livewire('mobile-cart')
            @auth
                <a href="{{route('profile.show')}}" class="py-3 px-4 text-sm flex items-center text-trueGray-500 hover:bg-orange-500 hover:text-white">
                    <span class="flex justify-center w-9">
                    </span>
                    Perfil
                </a>
                <a href="{{route('orders.index')}}" class="py-3 px-4 text-sm flex items-center text-trueGray-500 hover:bg-orange-500 hover:text-white">
                    <span class="flex justify-center w-9">
                    </span>
                    Mis Ordenes
                </a>
                @role('admin')
                <a href="{{route('admin.index')}}" class="py-3 px-4 text-sm flex items-center text-trueGray-500 hover:bg-orange-500 hover:text-white">
                    <span class="flex justify-center w-9">
                    </span>
                    Administrador
                </a>
                @endrole
                <a href="" 
                onclick="event.preventDefault()
                document.getElementById('logout-form').submit()"
                class="py-3 px-4 text-sm flex items-center text-trueGray-500 hover:bg-orange-500 hover:text-white">
                    <span class="flex justify-center w-9">
                    </span>
                    Logout
                </a>
                <form id="logout-form" action="{{route('logout')}}" method="POST">
                @csrf
                </form>
            @else     
                <a href="{{route('login')}}" class="py-3 px-4 text-sm flex items-center text-trueGray-500 hover:bg-orange-500 hover:text-white">
                    <span class="flex justify-center w-9">
                    </span>
                    Iniciar sesión
                </a>
                <a href="{{route('register')}}" class="py-3 px-4 text-sm flex items-center text-trueGray-500 hover:bg-orange-500 hover:text-white">
                    <span class="flex justify-center w-9">
                    </span>
                    Registrar
                </a>
            @endauth
        </div>
    </nav>
</header>

