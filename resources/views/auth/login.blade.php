<x-guest-layout>
    <x-jet-authentication-card>
        <x-slot name="logo">
            <a href="/">
                <img src="{{asset('img/logo.png')}}" alt="Maxtdes" style="height: 128px; width: 128px; object-fit: cover;">
            </a>
            
        </x-slot>

        <x-jet-validation-errors class="mb-4" />

        @if (session('status'))
            <div class="mb-4 font-medium text-sm text-green-600">
                {{ session('status') }}
            </div>
        @endif

        <form method="POST" action="{{ route('login') }}">
            @csrf

            <div>
                <!-- <x-jet-label for="email" value="{{ __('Email') }}" /> -->
                <x-jet-input id="email" class="block mt-1 w-full" type="email" name="email" :value="old('email')" placeholder="Correo" required autofocus />
            </div>

            <div class="mt-4">
                <!-- <x-jet-label for="password" value="{{ __('Password') }}" /> -->
                <x-jet-input id="password" class="block mt-1 w-full" type="password" name="password" placeholder="Ingrese contraseña" required autocomplete="current-password" />
            </div>

            <div class="block mt-4">
                <label for="remember_me" class="flex items-center">
                    <x-jet-checkbox id="remember_me" name="remember" />
                    <span class="ml-2 text-sm text-gray-600">Acuérdate de mí</span>
                </label>
            </div>

            <div class="flex items-center justify-end mt-4">
                @if (Route::has('password.request'))
                    <a class="underline text-sm text-gray-600 hover:text-gray-900" href="{{ route('password.request') }}">
                        ¿Olvidaste tu contraseña?
                    </a>
                @endif

                <x-jet-button class="ml-4" style="background: var(--tint)">
                    <!-- {{ __('Log in') }} --> Iniciar sesión 
                </x-jet-button>
            </div>
        </form>
    </x-jet-authentication-card>
</x-guest-layout>
