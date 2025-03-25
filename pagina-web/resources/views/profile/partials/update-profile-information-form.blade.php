<section class="profile-form">
    <header>
        <h2>{{ __('Profile Information') }}</h2>
        <p>{{ __("Update your account's profile information and email address.") }}</p>
    </header>

    <form id="send-verification" method="post" action="{{ route('verification.send') }}">
        @csrf
    </form>

    <form method="post" action="{{ route('profile.update') }}" class="cyber-form">
        @csrf
        @method('patch')

        <div class="input-group">
            <x-input-label for="name" :value="__('Name')" />
            <x-text-input id="name" name="name" type="text" class="input-field" 
                        :value="old('name', $user->name)" required autofocus />
            <x-input-error :messages="$errors->get('name')" class="input-error" />
        </div>

        <div class="input-group">
            <x-input-label for="email" :value="__('Email')" />
            <x-text-input id="email" name="email" type="email" class="input-field" 
                        :value="old('email', $user->email)" required />
            <x-input-error :messages="$errors->get('email')" class="input-error" />

            @if ($user instanceof \Illuminate\Contracts\Auth\MustVerifyEmail && ! $user->hasVerifiedEmail())
                <div class="email-verification mt-4">
                    <p>
                        {{ __('Your email address is unverified.') }}
                        <button form="send-verification">{{ __('Click here to re-send the verification email.') }}</button>
                    </p>

                    @if (session('status') === 'verification-link-sent')
                        <p class="mt-2">{{ __('A new verification link has been sent to your email address.') }}</p>
                    @endif
                </div>
            @endif
        </div>

        <div class="form-actions">
            <x-primary-button class="login-button">{{ __('Save') }}</x-primary-button>
            @if (session('status') === 'profile-updated')
                <p x-data="{ show: true }" x-show="show" x-transition
                x-init="setTimeout(() => show = false, 2000)"
                class="cyber-status">{{ __('Saved.') }}</p>
            @endif
        </div>
    </form>
</section>