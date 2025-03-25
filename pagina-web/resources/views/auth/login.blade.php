<x-guest-layout>
    <head>
        <!-- Incluir la fuente Syne Mono y CSS -->
        <link href="https://fonts.googleapis.com/css2?family=Syne+Mono&display=swap" rel="stylesheet">
        <link rel="stylesheet" href="{{ asset('css/login.css') }}">
    </head>

    <div class="container">
        <div class="scanline"></div>
        <form method="POST" action="{{ route('login') }}" class="login-form">
            @csrf

            <!-- Email -->
            <div class="input-group">
                <x-input-label for="email" :value="__('Email')" />
                <x-text-input id="email" class="input-field" 
                    type="email" 
                    name="email" 
                    :value="old('email')" 
                    required 
                    autofocus 
                    autocomplete="username" />
                <x-input-error :messages="$errors->get('email')" class="input-error" />
            </div>

            <!-- Contraseña -->
            <div class="input-group">
                <x-input-label for="password" :value="__('Password')" />
                <x-text-input id="password" class="input-field"
                    type="password"
                    name="password"
                    required
                    autocomplete="current-password" />
                <x-input-error :messages="$errors->get('password')" class="input-error" />
            </div>

            <!-- Recordar usuario -->
            <div class="remember-me">
                <label for="remember_me" class="remember-label">
                    <input id="remember_me" type="checkbox" class="remember-checkbox" name="remember">
                    <span>{{ __('Remember me') }}</span>
                </label>
            </div>

            <!-- Acciones -->
            <div class="form-actions">
                @if (Route::has('password.request'))
                    <a class="forgot-password-link" href="{{ route('password.request') }}">
                        {{ __('Forgot your password?') }}
                    </a>
                @endif

                <x-primary-button class="login-button">
                    {{ __('LOG IN') }}
                </x-primary-button>
            </div>
        </form>
    </div>
</x-guest-layout>