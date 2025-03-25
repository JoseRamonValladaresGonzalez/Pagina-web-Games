<x-guest-layout>
    <head>
        <!-- Asegurar carga de fuentes y estilos -->
        <link href="https://fonts.googleapis.com/css2?family=Syne+Mono&display=swap" rel="stylesheet">
        <link rel="stylesheet" href="{{ asset('css/login.css') }}">
    </head>

    <div class="container">
        <div class="scanline"></div>
        <form method="POST" action="{{ route('register') }}" class="login-form">
            @csrf

            <!-- Nombre -->
            <div class="input-group">
                <x-input-label for="name" :value="__('Name')" />
                <x-text-input id="name" 
                    class="input-field"
                    type="text" 
                    name="name" 
                    :value="old('name')" 
                    required 
                    autofocus 
                    autocomplete="name" />
                <x-input-error :messages="$errors->get('name')" class="input-error" />
            </div>

            <!-- Email -->
            <div class="input-group">
                <x-input-label for="email" :value="__('Email')" />
                <x-text-input id="email" 
                    class="input-field"
                    type="email" 
                    name="email" 
                    :value="old('email')" 
                    required 
                    autocomplete="username" />
                <x-input-error :messages="$errors->get('email')" class="input-error" />
            </div>

            <!-- Contraseña -->
            <div class="input-group">
                <x-input-label for="password" :value="__('Password')" />
                <x-text-input id="password"
                    class="input-field"
                    type="password"
                    name="password"
                    required
                    autocomplete="new-password" />
                <x-input-error :messages="$errors->get('password')" class="input-error" />
            </div>

            <!-- Confirmar Contraseña -->
            <div class="input-group">
                <x-input-label for="password_confirmation" :value="__('Confirm Password')" />
                <x-text-input id="password_confirmation"
                    class="input-field"
                    type="password"
                    name="password_confirmation" 
                    required 
                    autocomplete="new-password" />
                <x-input-error :messages="$errors->get('password_confirmation')" class="input-error" />
            </div>

            <!-- Acciones -->
            <div class="form-actions">
                <a class="cyber-link" href="{{ route('login') }}">
                    {{ __('Already registered?') }}
                </a>

                <x-primary-button class="login-button">
                    {{ __('REGISTER') }}
                </x-primary-button>
            </div>
        </form>
    </div>
</x-guest-layout>