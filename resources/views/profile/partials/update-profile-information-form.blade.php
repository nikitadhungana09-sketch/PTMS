<section>

    <div class="bg-white rounded-2xl shadow-md p-8">

        <div class="mb-8">

            <h2 class="text-2xl font-bold text-gray-800">
                Profile Information
            </h2>
        
            <p class="text-gray-500 mt-1">
                Update your personal information.
            </p>
        
        </div>

        <form id="send-verification" method="POST" action="{{ route('verification.send') }}">
            @csrf
        </form>

        <form method="POST"
              action="{{ route('profile.update') }}"
              class="space-y-6">

            @csrf
            @method('PATCH')

            <!-- Name -->
            <div>

                <label for="name" class="block text-sm font-semibold text-gray-700 mb-2">
                    👤 Full Name
                </label>

                <x-text-input
                    id="name"
                    name="name"
                    type="text"
                    class="w-full"
                    :value="old('name', $user->name)"
                    required
                    autofocus
                />

                <x-input-error
                    class="mt-2"
                    :messages="$errors->get('name')" />

            </div>

            <!-- Email -->
            <div>

                <label for="email" class="block text-sm font-semibold text-gray-700 mb-2">
                    📧 Email Address
                </label>

                <x-text-input
                    id="email"
                    name="email"
                    type="email"
                    class="w-full"
                    :value="old('email', $user->email)"
                    required
                />

                <x-input-error
                    class="mt-2"
                    :messages="$errors->get('email')" />

            </div>

            @if ($user instanceof \Illuminate\Contracts\Auth\MustVerifyEmail && ! $user->hasVerifiedEmail())

                <div class="bg-yellow-50 border border-yellow-200 rounded-lg p-4">

                    <p class="text-sm text-yellow-700">

                        Your email address is not verified.

                        <button
                            form="send-verification"
                            class="font-semibold underline">

                            Click here to resend verification email.

                        </button>

                    </p>

                </div>

            @endif

            <div class="flex justify-end">

                <button
                    type="submit"
                    class="bg-blue-600 hover:bg-blue-700 text-white px-8 py-3 rounded-lg font-semibold shadow transition">

                    💾 Save Changes

                </button>

            </div>

        </form>

    </div>

</section>