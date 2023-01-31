{{-- <section>
    <header>
        <h2 class="text-lg font-medium text-gray-900">
            {{ __('Update Password') }}
        </h2>

        <p class="mt-1 text-sm text-gray-600">
            {{ __('Ensure your account is using a long, random password to stay secure.') }}
        </p>
    </header>

    <form method="post" action="{{ route('password.update') }}" class="mt-6 space-y-6">
        @csrf
        @method('put')

        <div>
            <x-input-label for="current_password" :value="__('Current Password')" />
            <x-text-input id="current_password" name="current_password" type="password" class="mt-1 block w-full" autocomplete="current-password" />
            <x-input-error :messages="$errors->updatePassword->get('current_password')" class="mt-2" />
        </div>

        <div>
            <x-input-label for="password" :value="__('New Password')" />
            <x-text-input id="password" name="password" type="password" class="mt-1 block w-full" autocomplete="new-password" />
            <x-input-error :messages="$errors->updatePassword->get('password')" class="mt-2" />
        </div>

        <div>
            <x-input-label for="password_confirmation" :value="__('Confirm Password')" />
            <x-text-input id="password_confirmation" name="password_confirmation" type="password" class="mt-1 block w-full" autocomplete="new-password" />
            <x-input-error :messages="$errors->updatePassword->get('password_confirmation')" class="mt-2" />
        </div>

        <div class="flex items-center gap-4">
            <x-primary-button>{{ __('Save') }}</x-primary-button>

            @if (session('status') === 'password-updated')
<p
                    x-data="{ show: true }"
                    x-show="show"
                    x-transition
                    x-init="setTimeout(() => show = false, 2000)"
                    class="text-sm text-gray-600"
                >{{ __('Saved.') }}</p>
@endif
        </div>
    </form>
</section> --}}
<section>
    <div class="header-pass">
        <span>Ensure your account is using a long, random password to stay secure.</span>
    </div>
    <div class="main-pass">
        <form action="{{ route('profile.update') }}" method="POST">
            @csrf
            @method('patch')
            <div class="form-grp">
                <label>Current Password</label>
                <div class="form-inp">
                    <input type="password" name="current_password" id="current_password" required>
                </div>
            </div>
            <div class="form-grp">
                <label>New Password</label>
                <div class="form-inp">
                    <input type="password" name="password" id="password" required>
                </div>
            </div>
            <div class="form-grp">
                <label>Confirm Password</label>
                <div class="form-inp">
                    <input type="password" name="password_confirmation" id="password_confirmation" required>
                </div>
            </div>
            <div class="form-butt">
                <button>Save</button>
            </div>
        </form>
    </div>
</section>
