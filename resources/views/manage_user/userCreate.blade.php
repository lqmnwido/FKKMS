<x-app-layout>

    <br />
    <div class="container">
        <div class="text-center" style="margin-bottom:2%">
            <h1 class="text-4xl">MANAGE USER</h1>
            <h4 class="text-2xl">Add User</h4>
        </div>

        <div class="container mx-auto px-4">

            <form method="POST" action="{{ route('users.store') }}">
                @csrf

                <div>
                    <x-label for="name" value="{{ __('Name') }}" />
                    <x-input id="name" class="block mt-1 w-full" type="text" name="name" :value="old('name')"
                        required autofocus autocomplete="name" />
                </div>

                <div class="mt-4">
                    <x-label for="email" value="{{ __('Email') }}" />
                    <x-input id="email" class="block mt-1 w-full" type="email" name="email" :value="old('email')"
                        required autocomplete="email" />
                </div>

                </br>
                <x-label for="role" value="{{ __('Role') }}" />
                <select id="role" name="role"
                    class="border border-gray-300 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5">
                    <option selected>Choose a Role</option>
                    <option value="FK Student">FK Student</option>
                    <option value="Vendor">Vendor</option>
                    <option value="FK Bursary">Bursary</option>
                    <option value="FK Technical">FK Technical Team</option>
                    <option value="Pupuk Admin">Pupuk Admin</option>
                </select>

                <div id="studentForm" style="display:none;">
                    </br>
                    <x-label for="MatricID" value="{{ __('Student ID') }}" />
                    <x-input id="MatricID" class="block mt-1 w-full" type="text" name="MatricID" :value="old('MatricID')"
                        autofocus />
                </div>

                <div id="vendorForm" style="display:none;">
                    </br>
                    <x-label for="company" value="{{ __('Company Name') }}" />
                    <x-input id="company" class="block mt-1 w-full" type="text" name="company" :value="old('company')"
                        autofocus />
                </div>

                <div class="mt-4">
                    <x-label for="password" value="{{ __('Password') }}" />
                    <x-input id="password" class="block mt-1 w-full" type="password" name="password" required
                        autocomplete="new-password" />
                </div>

                <div class="mt-4">
                    <x-label for="password_confirmation" value="{{ __('Confirm Password') }}" />
                    <x-input id="password_confirmation" class="block mt-1 w-full" type="password"
                        name="password_confirmation" required autocomplete="new-password" />
                </div>

                @if (Laravel\Jetstream\Jetstream::hasTermsAndPrivacyPolicyFeature())
                    <div class="mt-4">
                        <x-label for="terms">
                            <div class="flex items-center">
                                <x-checkbox name="terms" id="terms" required />

                                <div class="ms-2">
                                    {!! __('I agree to the :terms_of_service and :privacy_policy', [
                                        'terms_of_service' =>
                                            '<a target="_blank" href="' .
                                            route('terms.show') .
                                            '"
                                                                                                            class="underline text-sm text-gray-600 hover:text-gray-900 rounded-md focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500">' .
                                            __('Terms
                                                                                                            of Service') .
                                            '</a>',
                                        'privacy_policy' =>
                                            '<a target="_blank" href="' .
                                            route('policy.show') .
                                            '"
                                                                                                            class="underline text-sm text-gray-600 hover:text-gray-900 rounded-md focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500">' .
                                            __('Privacy
                                                                                                            Policy') .
                                            '</a>',
                                    ]) !!}
                                </div>
                            </div>
                        </x-label>
                    </div>
                @endif

                <div class="flex items-center justify-center mt-4">

                    <x-button class="flex flex-col items-center mb-4 w-full">
                        {{ __('CREATE') }}
                    </x-button>
                </div>
            </form>
        </div>
    </div>


    <script>
        function showHideTextInput() {
            var student = document.getElementById('student');
            var vendor = document.getElementById('vendor');
            var textInputContainer = document.getElementById('studentForm');

            if (student.checked) {
                textInputContainer.style.display = 'block';
            } else if (vendor.checked) {
                textInputContainer.style.display = 'none';
            }
        }
    </script>
</x-app-layout>
