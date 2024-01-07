<x-app-layout>

    <br />
    @if ($role == 'FK Student' || $role == 'Vendor')
    <div class="container text-center">
        <h1 class="text-4xl">MANAGE REPORT</h1>
        <h4 class="text-2xl">FK Participant Page</h4>
        <br />

        @if(Session::has('alert'))
        <div class="alert alert-danger" role="alert">
            {{Session::get('alert')}}
        </div>
        @endif

        @if(Session::has('success'))
        <div class="alert alert-success" role="alert">
            {{Session::get('success')}}
        </div>
        @endif

            <div class="container-fluid d-flex justify-content-evenly" style="padding-top:10%;">
                <a href="#"
                    class="w-full max-w-sm h-96 bg-white border border-gray-200 rounded-lg shadow dark:bg-gray-800 dark:border-gray-700 space-y-4 disabled-link ">
                    <div class="flex flex-col items-center justify-center h-full">
                        </br>
                        <h5 class="mb-1 text-xl font-medium text-gray-900 dark:text-black text-center">Create Report
                        </h5>
                    </div>
                </a>
                <a href="#"
                    class="w-full max-w-sm h-96 bg-white border border-gray-200 rounded-lg shadow dark:bg-gray-800 dark:border-gray-700 space-y-4 disabled-link ">
                    <div class="flex flex-col items-center justify-center h-full">
                        </br>
                        <h5 class="mb-1 text-xl font-medium text-gray-900 dark:text-black text-center">Report List
                        </h5>
                    </div>
                </a>
            </div>
    </div>
    @endif

</x-app-layout>
