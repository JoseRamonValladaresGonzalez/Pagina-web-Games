<section class="profile-form">
    <header>
        <h2>{{ __('Delete Account') }}</h2>
        <p>{{ __('Once your account is deleted, all of its resources and data will be permanently deleted.') }}</p>
    </header>

    <x-danger-button x-data=""
                   x-on:click.prevent="$dispatch('open-modal', 'confirm-user-deletion')"
                   class="cyber-danger-button">
        {{ __('Delete Account') }}
    </x-danger-button>

    <x-modal name="confirm-user-deletion" :show="$errors->userDeletion->isNotEmpty()" focusable class="cyber-modal">
        <form method="post" action="{{ route('profile.destroy') }}" class="cyber-modal-form">
            @csrf
            @method('delete')

            <h2>{{ __('Are you sure you want to delete your account?') }}</h2>
            <p>{{ __('Please enter your password to confirm deletion.') }}</p>

            <div class="input-group">
                <x-text-input id="password" name="password" type="password"
                            class="input-field" placeholder="{{ __('Password') }}" />
                <x-input-error :messages="$errors->userDeletion->get('password')" class="input-error" />
            </div>

            <div class="form-actions">
                <x-secondary-button x-on:click="$dispatch('close')" class="cyber-secondary-button">
                    {{ __('Cancel') }}
                </x-secondary-button>
                <x-danger-button class="cyber-danger-button">
                    {{ __('Delete Account') }}
                </x-danger-button>
            </div>
        </form>
    </x-modal>
</section>