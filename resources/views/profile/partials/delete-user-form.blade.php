{{-- <section class="space-y-6">
    <header>
        <h2 class="text-lg font-medium text-gray-900">
            {{ __('Delete Account') }}
        </h2>

        <p class="mt-1 text-sm text-gray-600">
            {{ __('Once your account is deleted, all of its resources and data will be permanently deleted. Before deleting your account, please download any data or information that you wish to retain.') }}
        </p>
    </header>

    <x-danger-button
        x-data=""
        x-on:click.prevent="$dispatch('open-modal', 'confirm-user-deletion')"
    >{{ __('Delete Account') }}</x-danger-button>

    <x-modal name="confirm-user-deletion" :show="$errors->userDeletion->isNotEmpty()" focusable>
        <form method="post" action="{{ route('profile.destroy') }}" class="p-6">
            @csrf
            @method('delete')

            <h2 class="text-lg font-medium text-gray-900">
                {{ __('Are you sure you want to delete your account?') }}
            </h2>

            <p class="mt-1 text-sm text-gray-600">
                {{ __('Once your account is deleted, all of its resources and data will be permanently deleted. Please enter your password to confirm you would like to permanently delete your account.') }}
            </p>

            <div class="mt-6">
                <x-input-label for="password" value="Password" class="sr-only" />

                <x-text-input
                    id="password"
                    name="password"
                    type="password"
                    class="mt-1 block w-3/4"
                    placeholder="Password"
                />

                <x-input-error :messages="$errors->userDeletion->get('password')" class="mt-2" />
            </div>

            <div class="mt-6 flex justify-end">
                <x-secondary-button x-on:click="$dispatch('close')">
                    {{ __('Cancel') }}
                </x-secondary-button>

                <x-danger-button class="ml-3">
                    {{ __('Delete Account') }}
                </x-danger-button>
            </div>
        </form>
    </x-modal>
</section> --}}

<section>
    <div class="header-acc-del">
        <span>Once your account is deleted, all of its resources and data will be permanently deleted. Before deleting
            your account, please download any data or information that you wish to retain.</span>
    </div>
    <div class="butt-del">
        <button type="button" data-toggle="modal" data-target="#modalDeleteAccount">Delete Account</button>
    </div>
    <div class="main-acc-del">
        <div class="modal fade mod" id="modalDeleteAccount" tabindex="-1" aria-labelledby="exampleModalLabel"
            aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered mod-dialog modal-lg">
                <div class="modal-content mod-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLabel">Delete Account</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body mod-body">
                        <div class="head-mod-body">
                            <span class="sure">Are you sure you want to delete your account?</span>
                            <span class="text">Once your account is deleted, all of its resources and data will be permanently deleted. Please enter your password to confirm you would like to permanently delete your account.</span>
                        </div>
                        <form action="{{ route('profile.destroy') }}" method="POST">
                            @csrf
                            @method('delete')
                            <div class="form-grp">
                                <label>Password</label>
                                <div class="form-inp">
                                    <input type="password" name="password" id="password" placeholder="Password"
                                        required>
                                </div>
                            </div>
                            <div class="form-butt">
                                <button type="button" class="close" data-dismiss="modal">Close</button>
                                <button class="butt">Delete Account</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
    {{-- <div class="main-acc-del">
        <form action="{{ route('profile.update') }}" method="POST">
            @csrf
            @method('patch')
            <div class="form-grp">
                <label>Name</label>
                <div class="form-inp">
                    <input type="text" name="name" id="name" value="{{ old('name', $user->name) }}" required>
                </div>
            </div>
            <div class="form-grp">
                <label>Phone</label>
                <div class="form-inp">
                    <input type="number" name="phone" id="phone" value="{{ old('phone', $user->phone) }}"
                        required>
                </div>
            </div>
            <div class="form-grp">
                <label>Email</label>
                <div class="form-inp">
                    <input type="email" name="email" id="email" value="{{ old('email', $user->email) }}"
                        required>
                </div>
                @if ($user instanceof \Illuminate\Contracts\Auth\MustVerifyEmail && !$user->hasVerifiedEmail())
                    <div>
                        <p class="text-sm mt-2 text-gray-800">
                            {{ __('Your email address is unverified.') }}

                            <button form="send-verification"
                                class="underline text-sm text-gray-600 hover:text-gray-900 rounded-md focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500">
                                {{ __('Click here to re-send the verification email.') }}
                            </button>
                        </p>

                        @if (session('status') === 'verification-link-sent')
                            <p class="mt-2 font-medium text-sm text-green-600">
                                {{ __('A new verification link has been sent to your email address.') }}
                            </p>
                        @endif
                    </div>
                @endif
            </div>
            <div class="form-butt">
                <button>Save</button>
            </div>
        </form>
    </div> --}}
</section>
