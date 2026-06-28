<section>

    <div class="bg-white rounded-2xl shadow-md p-8 mt-8">

        <div class="flex items-center gap-4 mb-8">

            <div class="w-16 h-16 rounded-full bg-red-500 text-white flex items-center justify-center text-2xl">
                🔒
            </div>

            <div>

                <h2 class="text-2xl font-bold text-gray-800">
                    Change Password
                </h2>

                <p class="text-gray-500">
                    Keep your account secure by using a strong password.
                </p>

            </div>

        </div>

        <form method="POST"
              action="{{ route('password.update') }}"
              class="space-y-6">

            @csrf
            @method('PUT')

            <!-- Current Password -->
            <div>

                <label class="block text-sm font-semibold text-gray-700 mb-2">
                    Current Password
                </label>

                <x-text-input
                    id="current_password"
                    name="current_password"
                    type="password"
                    class="w-full"
                    autocomplete="current-password"
                />

                <x-input-error
                    :messages="$errors->updatePassword->get('current_password')"
                    class="mt-2"/>

            </div>

            <!-- New Password -->
            <div>

                <label class="block text-sm font-semibold text-gray-700 mb-2">
                    New Password
                </label>

                <x-text-input
                    id="password"
                    name="password"
                    type="password"
                    class="w-full"
                    autocomplete="new-password"
                />

                <x-input-error
                    :messages="$errors->updatePassword->get('password')"
                    class="mt-2"/>

            </div>

            <!-- Confirm Password -->
            <div>

                <label class="block text-sm font-semibold text-gray-700 mb-2">
                    Confirm Password
                </label>

                <x-text-input
                    id="password_confirmation"
                    name="password_confirmation"
                    type="password"
                    class="w-full"
                    autocomplete="new-password"
                />

                <x-input-error
                    :messages="$errors->updatePassword->get('password_confirmation')"
                    class="mt-2"/>

            </div>

            <div class="flex justify-end items-center gap-4">

                @if (session('status') === 'password-updated')
                    <span class="text-green-600 font-medium">
                        ✅ Password updated successfully!
                    </span>
                @endif

                <button
                    type="submit"
                    class="bg-blue-600 hover:bg-blue-700 text-white px-8 py-3 rounded-lg font-semibold shadow transition">

                    🔐 Update Password

                </button>

            </div>

        </form>

    </div>

</section>