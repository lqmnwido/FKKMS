<x-app-layout>

    <br />
    <div class="container">
        <div class="text-center" style="margin-bottom:2%">
            <h1 class="text-4xl">APPLICATION FORM</h1>
            <h4 class="text-2xl">FK STUDENTS</h4>
        </div>

        <div class="container mx-auto px-4">
            @if(Session::has('success'))
            <div class="alert alert-success" role="alert">
                {{Session::get('success')}}
            </div>
            @endif
            <form method="POST" action="{{route('applications.store', ['roles' => $uRole])}}">
                @csrf
                @if ($uRole == 'students')
                    <div>
                        <x-label for="name" value="{{ __('Name') }}" />
                        <x-input id="name" class="block mt-1 w-full" type="text" name="name"
                            value="{{ Auth::user()->name }}" required autofocus autocomplete="name" />
                    </div>
                    </br>
                    <div>
                        <x-label for="stdID" value="{{ __('Student ID') }}" />
                        <x-input id="stdID" class="block mt-1 w-full" type="text" name="stdID"
                            value="{{ Auth::user()->MatricID }}" required autofocus autocomplete="stdID" />
                    </div>
                    </br>
                    <div>
                        <x-label for="product" value="{{ __('Product Name') }}" />
                        <x-input id="product" class="block mt-1 w-full" type="text" name="product"
                            :value="old('product')" required autofocus autocomplete="product" />
                    </div>
                    </br>
                    <div>
                        <x-label for="price" value="{{ __('Price') }}" />
                        <x-input id="price" class="block mt-1 w-full" type="number" name="price"
                            :value="old('Price')" required step=".01"  min="1" value="0"  autofocus autocomplete="product" />
                    </div>
                    <div>
                        <x-input id="role" class="block mt-1 w-full" type="hidden" name="role" value="FK Student" hidden/>
                        <x-input id="uid" class="block mt-1 w-full" type="hidden" name="uid" value="{{ Auth::user()->User_ID }}" hidden/>
                    </div>
                    </br>
                    <div>
                        <x-label for="email" value="{{ __('Email') }}" />
                        <x-input id="email" class="block mt-1 w-full" type="email" name="email"
                            value="{{ Auth::user()->email }}" autofocus />
                    </div>

                    </br>

                    <div>
                        <x-label for="phone" value="{{ __('Phone Number') }}" />
                        <x-input id="phone" class="block mt-1 w-full" type="text" name="phone"
                            value="{{ Auth::user()->phone }}" autofocus />
                    </div>
                @elseif($uRole == 'vendors')
                    <div>
                        <x-label for="name" value="{{ __('Name') }}" />
                        <x-input id="name" class="block mt-1 w-full" type="text" name="name"
                            value="{{ Auth::user()->name }}" required autofocus autocomplete="name" />
                    </div>
                    </br>
                    <div>
                        <x-label for="company" value="{{ __('Company Name') }}" />
                        <x-input id="company" class="block mt-1 w-full" type="text" name="company"
                            value="{{ Auth::user()->company }}" required autofocus autocomplete="company" />
                    </div>
                    </br>
                    <div>
                        <x-label for="product" value="{{ __('Product Name') }}" />
                        <x-input id="product" class="block mt-1 w-full" type="text" name="product"
                            :value="old('product')" required autofocus autocomplete="product" />
                    </div>
                    </br>
                    <div>
                        <x-label for="price" value="{{ __('Price') }}" />
                        <x-input id="price" class="block mt-1 w-full" type="text" name="price"
                            :value="old('Price')" required step=".01"  min="1" value="0" autofocus autocomplete="product" />
                    </div>
                    <div>
                        <x-input id="role" class="block mt-1 w-full" type="hidden" name="role" value="Vendor" hidden/>
                        <x-input id="uid" class="block mt-1 w-full" type="hidden" name="uid" value="{{ Auth::user()->User_ID }}" hidden/>
                    </div>
                    </br>
                    <div>
                        <x-label for="email" value="{{ __('Email') }}" />
                        <x-input id="email" class="block mt-1 w-full" type="email" name="email"
                            value="{{ Auth::user()->email }}" autofocus />
                    </div>

                    </br>

                    <div>
                        <x-label for="phone" value="{{ __('Phone Number') }}" />
                        <x-input id="phone" class="block mt-1 w-full" type="text" name="phone"
                            value="{{ Auth::user()->phone }}" autofocus />
                    </div>
                @endif

                </br>

                <div class="flex items-center justify-center mt-4">

                    <a href="{{route('dashboard')}}"
                        class="text-white bg-red-700 hover:bg-red-800 focus:ring-4 focus:ring-red-300 font-medium rounded-lg text-sm px-5 py-2.5 dark:bg-red-600 dark:hover:bg-red-700 focus:outline-none dark:focus:ring-red-800">
                        {{ __('CANCEL') }}</a>

                    <x-button
                        class="text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:ring-blue-300 font-medium rounded-lg text-sm h-10 px-5 py-2.5 dark:bg-blue-600 dark:hover:bg-blue-700 focus:outline-none dark:focus:ring-blue-800">
                        {{ __('APPLY') }}
                    </x-button>

                </div>
            </form>
        </div>
    </div>

</x-app-layout>
