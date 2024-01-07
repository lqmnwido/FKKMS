<x-app-layout>

    <br />
    @if ($role == 'FK Student' || $role == 'Vendor')
    <div class="container text-center">
        <h1 class="text-4xl">KIOSK APPLICATION</h1>
        <h4 class="text-2xl">Apply Now</h4>
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

        @if ($userID == $uid)
            <div class="container-fluid d-flex justify-content-evenly" style="padding-top:10%;">
                <div class="hidden sm:flex sm:items-center sm:ms-6">
                    <a href="{{ route('view_application', ['id' => $uid]) }}"
                        class="bg-gray-300 hover:bg-gray-400 text-gray-800 font-bold py-2 px-4 rounded inline-flex items-center">VIEW
                        APPLICATION</a>
                </div>
            </div>
        @elseif($userID != $uid)
            <div class="container-fluid d-flex justify-content-evenly" style="padding-top:10%;">
                <a href="{{ route('applications.index', ['role' => 'students']) }}"
                    class="w-full max-w-sm h-96 bg-white border border-gray-200 rounded-lg shadow dark:bg-gray-800 dark:border-gray-700 space-y-4 @if($role == 'Vendor') disabled-link @endif">

                    <div class="flex justify-end px-4 pt-4">
                    </div>
                    <br />
                    <div class="flex flex-col items-center pb-10">
                        <img class="w-24 h-24 mb-3 rounded-full shadow-lg" src="" alt="VENDORS" />
                        <br />
                        <h5 class="mb-1 text-xl font-medium text-gray-900 dark:text-black">FK STUDENTS</h5>
                        <span class="text-sm text-gray-500 dark:text-gray-400">Students from Faculty of Computing</span>
                    </div>
                </a>
                <a href="{{ route('applications.index', ['role' => 'vendors']) }}"
                    class="w-full max-w-sm h-96 bg-white border border-gray-200 rounded-lg shadow dark:bg-gray-800 dark:border-gray-700 space-y-4 @if($role == 'FK Student') disabled-link @endif">

                    <div class="flex justify-end px-4 pt-4">
                    </div>
                    <br />
                    <div class="flex flex-col items-center pb-10">
                        <img class="w-24 h-24 mb-3 rounded-full shadow-lg" src="" alt="VENDORS" />
                        <br />
                        <h5 class="mb-1 text-xl font-medium text-gray-900 dark:text-black">VENDORS</h5>
                        <span class="text-sm text-gray-500 dark:text-gray-400">Non-FK Students that wish to apply</span>
                    </div>
                </a>
            </div>
        @endif
    </div>
    @endif

</x-app-layout>
