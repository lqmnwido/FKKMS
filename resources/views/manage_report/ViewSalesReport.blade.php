<x-app-layout>
    <br />
    <div class="container text-center">
        <h1 class="text-4xl">MANAGE PAYMENT</h1>
        <h4 class="text-2xl">FK Participant Page</h4>
        <br />

        <div id='section2' class="p-8 mt-6 lg:mt-0 rounded shadow bg-white">
            @if (Session::has('alert'))
                <div class="alert alert-danger" role="alert">
                    {{ Session::get('alert') }}
                </div>
            @endif

            @if (Session::has('success'))
                <div class="alert alert-success" role="alert">
                    {{ Session::get('success') }}
                </div>
            @endif

            <form method="POST" action="{{ route('reports.store') }}" enctype="multipart/form-data">
                @csrf
                <div class="md:flex mb-6">
                    <div class="md:w-1/3">
                        <label class="block text-gray-600 font-bold md:text-left mb-3 md:mb-0 pr-4" for="salesID">
                            Sales ID :
                        </label>
                    </div>
                    <div class="md:w-2/3">
                        <input
                            class="bg-gray-200 appearance-none border-2 border-gray-200 rounded w-full py-2 px-4 text-gray-700 leading-tight focus:outline-none focus:bg-white focus:border-purple-500"
                            id="salesID" type="text" value="{{ $report->Sales_ID }}" disabled>
                    </div>
                </div>

                <div class="md:flex mb-6">
                    <div class="md:w-1/3">
                        <label class="block text-gray-600 font-bold md:text-left mb-3 md:mb-0 pr-4" for="kioskID">
                            Kiosk ID :
                        </label>
                    </div>
                    <div class="md:w-2/3">
                        <input
                            class="bg-gray-200 appearance-none border-2 border-gray-200 rounded w-full py-2 px-4 text-gray-700 leading-tight focus:outline-none focus:bg-white focus:border-purple-500"
                            id="kioskID" type="text" value="{{$application->Kiosk_ID}}" disabled>
                    </div>
                </div>

                <div class="md:flex mb-6">
                    <div class="md:w-1/3">
                        <label class="block text-gray-600 font-bold md:text-left mb-3 md:mb-0 pr-4" for="product">
                            Product Name :
                        </label>
                    </div>
                    <div class="md:w-2/3">
                        <input
                            class="bg-gray-200 appearance-none border-2 border-gray-200 rounded w-full py-2 px-4 text-gray-700 leading-tight focus:outline-none focus:bg-white focus:border-purple-500"
                            id="product" type="text" value="{{$application->Product_name}}" disabled>
                    </div>
                </div>

                <div class="md:flex mb-6">
                    <div class="md:w-1/3">
                        <label class="block text-gray-600 font-bold md:text-left mb-3 md:mb-0 pr-4" for="price">
                            Price (MYR):
                        </label>
                    </div>
                    <div class="md:w-2/3">
                        <input
                            class="bg-gray-200 appearance-none border-2 border-gray-200 rounded w-full py-2 px-4 text-gray-700 leading-tight focus:outline-none focus:bg-white focus:border-purple-500"
                            id="price" type="number" value="{{number_format((float) $application->Price, 2)}}"
                            step=".01" min="1" disabled>
                        <input type="hidden" value="" name="price">
                    </div>
                </div>

                <div class="md:flex mb-6">
                    <div class="md:w-1/3">
                        <label class="block text-gray-600 font-bold md:text-left mb-3 md:mb-0 pr-4" for="qty">
                            Quantity :
                        </label>
                    </div>
                    <div class="md:w-2/3">
                        <input class="bg-gray-200 appearance-none border-2 border-gray-200 rounded w-full py-2 px-4 text-gray-700 leading-tight focus:outline-none focus:bg-white focus:border-purple-500" id="qty" type="number"
                            min="1" name="qty" value="{{$report->qty}}" disabled>
                    </div>
                </div>

                <div class="md:flex mb-6">
                    <div class="md:w-1/3">
                        <label class="block text-gray-600 font-bold md:text-left mb-3 md:mb-0 pr-4" for="tRate">
                            Tax Rate (%):
                        </label>
                    </div>
                    @php
                        $taxRate = 6 / 100;

                        $total = 2 * $taxRate;
                    @endphp
                    <div class="md:w-2/3">
                        <input
                            class="bg-gray-200 appearance-none border-2 border-gray-200 rounded w-full py-2 px-4 text-gray-700 leading-tight focus:outline-none focus:bg-white focus:border-purple-500"
                            id="tRate" type="number" step=".01" min="1" name="tRate"
                            value="{{ $taxRate }}" disabled>

                        <input type="hidden" value="{{ $taxRate }}" name="tRate" id="tRate">
                    </div>
                </div>

                <div class="md:flex mb-6">
                    <div class="md:w-1/3">
                        <label class="block text-gray-600 font-bold md:text-left mb-3 md:mb-0 pr-4" for="total">
                            Total Price (MYR):
                        </label>
                    </div>
                    <div class="md:w-2/3">
                        <input
                            class="bg-gray-200 appearance-none border-2 border-gray-200 rounded w-full py-2 px-4 text-gray-700 leading-tight focus:outline-none focus:bg-white focus:border-purple-500"
                            id="total" type="number" value="{{ number_format((float) $total, 2) }}" step=".01"
                            min="1" disabled>
                        <input type="hidden" value="{{ number_format((float) $total, 2) }}"
                            id="totalHidden" name="tax">
                    </div>
                </div>

                <div class="md:flex md:items-center">
                    <div class="md:w-1/3">
                    </div>
                    <div class="md:w-2/3">
                        <a href="{{ route('reports.index', ['type' => 'List', 'uid' => Auth::user()->User_ID]) }}" style="margin-right: 20px"
                            class="text-white bg-gray-800 hover:bg-gray-900 focus:outline-none focus:ring-4 focus:ring-gray-300 font-medium rounded-lg text-sm px-5 py-2.5 me-2 mb-2 dark:bg-gray-800 dark:hover:bg-gray-700 dark:focus:ring-gray-700 dark:border-gray-700">
                            {{ __('BACK') }}
                        </a>
                    </div>
                </div>
            </form>

        </div>

        <br />
    </div>
</x-app-layout>
