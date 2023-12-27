<x-app-layout>

    <br />
    <div class="container">
        <div class="text-center" style="margin-bottom:2%">
            <h1 class="text-4xl">MANAGE USER</h1>
            <h4 class="text-2xl">Add User</h4>
        </div>

        <div class="container mx-auto px-4">


            <form method="POST" action="{{ route('users.update', $user->id) }}">
                {!! csrf_field() !!}
                @method('PATCH')

                <div>
                    <x-label for="name" value="{{ __('Name') }}" />
                    <x-input id="name" class="block mt-1 w-full" type="text" name="name"
                        value="{{ $user->name }}" autofocus autocomplete="name" />
                </div>

                <div class="mt-4">
                    <x-label for="email" value="{{ __('Email') }}" />
                    <x-input id="email" class="block mt-1 w-full" type="email" name="email"
                        value="{{ $user->email }}" required autocomplete="email" readonly />
                </div>

                </br>
                <div id="studentForm" @if ($user->User_type == 'Vendor') ? style="display:none;" @endif>
                    <x-label for="MatricID" value="{{ __('Student ID') }}" />
                    @if ($user->MatricID == '')
                        <x-input id="MatricID" class="block mt-1 w-full" type="text" name="MatricID" value="NONE"
                            autofocus placeholder="*If you are a UMPSA student (Optional)" />
                    @else
                        <x-input id="MatricID" class="block mt-1 w-full" type="text" name="MatricID"
                            value="{{ $user->MatricID }}" autofocus
                            placeholder="*If you are a UMPSA student (Optional)" />
                    @endif
                </div>

                <div id="vendorForm" @if ($user->User_type == 'FK Student') ? style="display:none;" @endif>
                    <x-label for="company" value="{{ __('Company Name') }}" />
                    @if ($user->company == '')
                        <x-input id="company" class="block mt-1 w-full" type="text" name="company" value="NONE"
                            autofocus placeholder="*If you are a UMPSA student (Optional)" />
                    @else
                        <x-input id="MatricID" class="block mt-1 w-full" type="text" name="company"
                            value="{{ $user->company }}" autofocus
                            placeholder="*If you are a UMPSA student (Optional)" />
                    @endif
                </div>


                </br>
                <x-label for="role" value="{{ __('Role') }}" />
                <select id="role" name="role"
                    class="border border-gray-300 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5">
                    @foreach (['FK Student', 'Vendor', 'FK Bursary', 'FK Technical Team', 'Pupuk Admin'] as $option)
                        <option value="{{ $option }}" @if ($user->User_type === $option) selected @endif>
                            {{ $option }}</option>
                    @endforeach
                </select>

                </br>
                <div>
                    <x-label for="phone" value="{{ __('Phone Number') }}" />
                    <x-input id="phone" class="block mt-1 w-full" pattern="[0-9]{10,11}" type="text" name="phone"
                        value="{{ $user->phone }}" autofocus autocomplete="phone" />
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
                        {{ __('UPDATE') }}
                    </x-button>
                </div>
            </form>

        </div>
    </div>

</x-app-layout>
