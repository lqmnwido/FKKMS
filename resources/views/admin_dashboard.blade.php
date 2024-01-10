<x-app-layout>
    <br />
    <div class="container text-center">
    <h1 class="text-4xl">MANAGE APPLICATION</h1>
    <h4 class="text-2xl">Admin Page</h4>
    <br />
        <div class="container-fluid d-flex justify-content-evenly" style="padding-top:20px;">
            <div
                class="w-full max-w-sm h-96 bg-white border border-gray-200 rounded-lg shadow dark:bg-gray-800 dark:border-gray-700 space-y-4">
                <div class="flex justify-end px-10 pt-4 ">
                </div>
                <br/>
                <div class="flex flex-col items-center pb-10">
                    <img class="w-24 h-24 mb-3 rounded-full shadow-lg" src="" alt="FK STUDENTS" />
                    <br/>
                    <h5 class="mb-1 text-xl font-medium text-gray-900 dark:text-black">FK STUDENTS</h5>
                    <span class="text-sm text-gray-500 dark:text-gray-400">List of application by FK Students in
                        UMPSA</span>
                    <div class="flex mt-4 md:mt-6">
                        <a href="{{ route('applications.index', ['role' => 'FK Student']) }}"
                            class="inline-flex items-center px-4 py-2 text-md font-large text-center text-red-600">See List</a>
                    </div>
                </div>
            </div>
            <div
                class="w-full max-w-sm h-96 bg-white border border-gray-200 rounded-lg shadow dark:bg-gray-800 dark:border-gray-700 space-y-4">
                <div class="flex justify-end px-4 pt-4">
                </div>
                <br/>
                <div class="flex flex-col items-center pb-10">
                    <img class="w-24 h-24 mb-3 rounded-full shadow-lg" src="" alt="VENDORS" />
                    <br/>
                    <h5 class="mb-1 text-xl font-medium text-gray-900 dark:text-black">VENDORS</h5>
                    <span class="text-sm text-gray-500 dark:text-gray-400">List of application by Vendors outside of
                        UMPSA</span>
                        <div class="flex mt-4 md:mt-6">
                        <a href="{{ route('applications.index', ['role' => 'Vendor']) }}"
                            class="inline-flex items-center px-4 py-2 text-md font-large text-center text-red-600">See List</a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>