<x-app-layout>

    <br />
    <div class="container">
        <div class="text-center" style="margin-bottom:2%">
            <h1 class="text-4xl">VIEW APPLICATION</h1>
            <h4 class="text-2xl">Application Details</h4>


        </div>

        <div class="container mx-auto px-4">
            @if (Session::has('success'))
                <div class="alert alert-success" role="alert">
                    {{ Session::get('success') }}
                </div>
            @endif
            <div class="flex items-center " style="margin-right: -30px">
                <x-label for="status" value="{{ __('STATUS : ') }}" />
                @if ($users->status == null)
                    <div id="status" class="px-6 py-4 text-slate-400 font-bold">{{ __('[- PENDING -]') }}
                    </div>
                @elseif($users->status == 'Rejected')
                    <div id="status" class="px-6 py-4 text-red-600 font-bold">{{ __('[- REJECTED -]') }}</div>
                @elseif($users->status == 'Approved')
                    <div id="status" class="px-6 py-4 text-green-600 font-bold">{{ __('[- APPROVED -]') }}
                    </div>
                @endif
            </div>

            <div class="flex items-center" style="margin-right: -30px">
                @if ($users->status == 'Rejected')
                    <x-label for="reason" value="{{ __('REASON : ') }}" />
                    <div id="reason" class="px-6 py-4 text-red-600 font-bold">{{ $users->reason }}
                    </div>
                @endif
                @if ($users->Kiosk_ID != null)
                    <x-label for="reason" value="{{ __('KIOSK ID : ') }}" />
                    <div id="reason" class="px-6 py-4 text-green-600 font-bold">{{ $users->Kiosk_ID }}
                    </div>
                @endif
            </div>



            
                @if ($role == 'FK Student')
                    <div>
                        <x-label for="name" value="{{ __('Name') }}" />
                        <x-input id="name" class="block mt-1 w-full" type="text" name="name"
                            value="{{ $users->name }}" required autofocus autocomplete="name" disabled/>
                    </div>
                    </br>
                    <div>
                        <x-label for="stdID" value="{{ __('Student ID') }}" />
                        <x-input id="stdID" class="block mt-1 w-full" type="text" name="stdID"
                            value="{{ $users->MatricID }}" required autofocus autocomplete="stdID" disabled/>
                    </div>
                    </br>
                    <div>
                        <x-label for="product" value="{{ __('Product Name') }}" />
                        <x-input id="product" class="block mt-1 w-full" type="text" name="product"
                            value="{{ $users->Product_name }}" required autofocus autocomplete="product" disabled/>
                    </div>
                    </br>
                    <div>
                        <x-label for="price" value="{{ __('Price') }}" />
                        <x-input id="price" class="block mt-1 w-full" type="text" name="price"
                            value="{{ number_format((float) $users->Price, 2) }}" step=".01" min="1"
                            required autofocus autocomplete="product" disabled />
                    </div>
                    <div>
                        <x-input id="role" class="block mt-1 w-full" type="hidden" name="role"
                            value="FK Student" hidden />
                        <x-input id="uid" class="block mt-1 w-full" type="hidden" name="uid"
                            value="{{ $users->User_ID }}" hidden />
                    </div>
                    </br>
                    <div>
                        <x-label for="email" value="{{ __('Email') }}" />
                        <x-input id="email" class="block mt-1 w-full" type="email" name="email"
                            value="{{ Auth::user()->email }}" autofocus disabled/>
                    </div>

                    </br>

                    <div>
                        <x-label for="phone" value="{{ __('Phone Number') }}" />
                        <x-input id="phone" class="block mt-1 w-full" type="text" name="phone"
                            value="{{ Auth::user()->phone }}" autofocus disabled/>
                    </div>
                @elseif($role == 'Vendor')
                    <div>
                        <x-label for="name" value="{{ __('Name') }}" />
                        <x-input id="name" class="block mt-1 w-full" type="text" name="name"
                            value="{{ Auth::user()->name }}" required autofocus autocomplete="name" disabled />
                    </div>
                    </br>
                    <div>
                        <x-label for="company" value="{{ __('Company Name') }}" />
                        <x-input id="company" class="block mt-1 w-full" type="text" name="company"
                            value="{{ Auth::user()->company }}" required autofocus autocomplete="company" disabled/>
                    </div>
                    </br>
                    <div>
                        <x-label for="product" value="{{ __('Product Name') }}" />
                        <x-input id="product" class="block mt-1 w-full" type="text" name="product"
                            value="{{ $users->Product_name }}" required autofocus autocomplete="product" disabled />
                    </div>
                    </br>
                    <div>
                        <x-label for="price" value="{{ __('Price') }}" />
                        <x-input id="price" class="block mt-1 w-full" type="text" name="price"
                            value="{{ number_format((float) $users->Price, 2) }}" required autofocus
                            autocomplete="product" disabled />
                    </div>
                    <div>
                        <x-input id="role" class="block mt-1 w-full" type="hidden" name="role"
                            value="Vendor" hidden />
                        <x-input id="uid" class="block mt-1 w-full" type="hidden" name="uid"
                            value="{{ $users->User_ID }}" hidden />
                    </div>
                    </br>
                    <div>
                        <x-label for="email" value="{{ __('Email') }}" />
                        <x-input id="email" class="block mt-1 w-full" type="email" name="email"
                            value="{{ Auth::user()->email }}" autofocus disabled/>
                    </div>

                    </br>

                    <div>
                        <x-label for="phone" value="{{ __('Phone Number') }}" />
                        <x-input id="phone" class="block mt-1 w-full" type="text" name="phone"
                            value="{{ Auth::user()->phone }}" autofocus disabled/>
                    </div>
                @endif

                </br>

                <div class="flex items-center justify-content-sm-evenly mt-4">

                    <a href="{{ route('dashboard') }}"
                        class="text-white bg-gray-800 hover:bg-gray-900 focus:outline-none focus:ring-4 focus:ring-gray-300 font-medium rounded-lg text-sm px-5 py-2.5 me-2 mb-2 dark:bg-gray-800 dark:hover:bg-gray-700 dark:focus:ring-gray-700 dark:border-gray-700">
                        {{ __('BACK') }}</a>


                    <a href="{{ route('applications.edit', $users->User_ID) }}"
                        class="text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:ring-blue-300 font-medium rounded-lg text-sm h-10 px-5 py-2.5 dark:bg-blue-600 dark:hover:bg-blue-700 focus:outline-none dark:focus:ring-blue-800">
                        {{ __('EDIT') }}</a>
            <form x-data="{ tooltip: 'Delete' }" action="{{ route('applications.destroy', ['application' => $users->id], ['role' => $users->User_type]) }}"
                method="POST" type="button" alt="DELETE" onSubmit="return confirm('Delete?')">
                @csrf
                @method('DELETE')
                <x-button
                    class="h-10 text-white bg-red-700 hover:bg-red-800 focus:ring-4 focus:ring-red-300 font-medium rounded-lg text-sm px-5 py-2.5 dark:bg-red-600 dark:hover:bg-red-700 focus:outline-none dark:focus:ring-red-800">
                    {{ __('DELETE') }}
                </x-button>
            </form>
        </div>


    </div>
    </div>

</x-app-layout>
