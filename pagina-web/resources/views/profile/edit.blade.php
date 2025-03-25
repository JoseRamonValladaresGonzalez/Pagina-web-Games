<x-app-layout>
    <head>
        <link href="https://fonts.googleapis.com/css2?family=Syne+Mono&display=swap" rel="stylesheet">
        <link rel="stylesheet" href="{{ asset('css/profile.css') }}">
    </head>

    <x-slot name="header">
        <div class="cyber-header">
            <h2 class="cyber-title">
                {{ __('Profile') }}
            </h2>
        </div>
    </x-slot>

    <div class="cyber-profile-container">
        <div class="scanline"></div>
        
        <div class="cyber-profile-content">
            <!-- Actualizar información -->
            <div class="cyber-section">
                <div class="cyber-form-box">
                    @include('profile.partials.update-profile-information-form')
                </div>
            </div>

            <!-- Actualizar contraseña -->
            <div class="cyber-section">
                <div class="cyber-form-box">
                    @include('profile.partials.update-password-form')
                </div>
            </div>

            <!-- Eliminar cuenta -->
            <div class="cyber-section">
                <div class="cyber-form-box">
                    @include('profile.partials.delete-user-form')
                </div>
            </div>
        </div>
    </div>
</x-app-layout>