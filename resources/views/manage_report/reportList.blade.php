<x-app-layout>

    <br />
     <!--FK Participant Panel-->
    @if ($role == 'FK Student' || $role == 'Vendor')
        @if (!isset($type))
            <div class="container text-center">
                <h1 class="text-4xl">MANAGE REPORT</h1>
                <h4 class="text-2xl">FK Participant Page</h4>
                @if (Session::has('alert'))
                    <br />
                    <div class="alert alert-danger" role="alert">
                        {{ Session::get('alert') }}
                    </div>
                @endif

                @if (Session::has('success'))
                    <br />
                    <div class="alert alert-success" role="alert">
                        {{ Session::get('success') }}
                    </div>
                @endif
                <div class="container-fluid d-flex justify-content-evenly" style="padding-top:50px;">
                    <a href="{{ route('reports.create') }}"
                        class="w-full max-w-sm h-96 bg-white border border-gray-200 rounded-lg shadow dark:bg-gray-800 dark:border-gray-700 space-y-4">
                        <div class="flex flex-col items-center justify-center h-full">
                            </br>
                            <h5 class="mb-1 text-xl font-medium text-gray-900 dark:text-black text-center">Create Report
                            </h5>
                        </div>
                    </a>
                    <a href="{{ route('reports.index', ['type' => 'List', 'uid' => Auth::user()->User_ID]) }}"
                        class="w-full max-w-sm h-96 bg-white border border-gray-200 rounded-lg shadow dark:bg-gray-800 dark:border-gray-700 space-y-4">
                        <div class="flex flex-col items-center justify-center h-full">
                            </br>
                            <h5 class="mb-1 text-xl font-medium text-gray-900 dark:text-black text-center">Report List
                            </h5>
                        </div>
                    </a>
                </div>
            </div>
            <br />
        @else
            <!--REPORT LIST-->
            <div class="container">
                <div class="text-center" style="margin-bottom:2%">
                    <h1 class="text-4xl">MANAGE REPORT</h1>
                    <h4 class="text-2xl">FK Participant Page</h4>
                </div>
                @if (Session::has('Approve'))
                    <div class="alert alert-success" role="alert">
                        {{ Session::get('Approve') }}
                    </div>
                @endif
                @if (Session::has('Reject'))
                    <div class="alert alert-danger" role="alert">
                        {{ Session::get('Reject') }}
                    </div>
                @endif
                <br />
                {{-- <a href="{{ route('application.create') }}" style="margin-left:45px;"
                class="text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:ring-blue-300 font-medium rounded-lg text-sm px-5 py-2.5 dark:bg-blue-600 dark:hover:bg-blue-700 focus:outline-none dark:focus:ring-blue-800">Add
                User</a> --}}

                <div class="overflow-hidden rounded-lg border border-gray-200 shadow-md m-5">
                    <table class="w-full border-collapse bg-white text-left text-sm text-gray-500">
                        <thead class="bg-gray-50">
                            <tr>
                                <th class="px-6 py-4 font-medium text-gray-900">No.</th>
                                <th scope="col" class="px-6 py-4 font-medium text-gray-900">Date</th>
                                <th scope="col" class="px-6 py-4 font-medium text-gray-900">Report Details</th>
                                <th scope="col" class="px-6 py-4 font-medium text-gray-900"></th>
                            </tr>
                        </thead>
                        <tbody class="divide-y divide-gray-100 border-t border-gray-100">
                            @php
                                $no = 1;
                            @endphp
                            @foreach ($reports as $report)
                                <tr class="hover:bg-gray-50">
                                    <td class="px-6 py-4">{{ $no++ }}</td>
                                    @php
                                        $no = $no - 8;
                                    @endphp
                                    <td class="px-6 py-4">{{ $report->Date }}</td>
                                    @php
                                        $month = date('F', strtotime($report->Date));
                                    @endphp
                                    <td class="px-6 py-4">{{ $month }} Sales Report</td>
                                    <td class="px-6 py-4">
                                        <div class="flex justify-end gap-4">
                                            <div class="flex justify-end gap-4" style="margin-right: 85px">
                                                <a x-data="{ tooltip: 'View' }"
                                                    href="{{ route('reports.show', $report->id) }}" alt="VIEW">
                                                    <svg xmlns="http://www.w3.org/2000/svg" height="16"
                                                        width="18" viewBox="0 0 576 512" stroke-width="1.5"
                                                        stroke="currentColor" class="h-6 w-6" x-tooltip="tooltip">
                                                        <path stroke-linecap="round" stroke-linejoin="round"
                                                            d="M288 80c-65.2 0-118.8 29.6-159.9 67.7C89.6 183.5 63 226 49.4 256c13.6 30 40.2 72.5 78.6 108.3C169.2 402.4 222.8 432 288 432s118.8-29.6 159.9-67.7C486.4 328.5 513 286 526.6 256c-13.6-30-40.2-72.5-78.6-108.3C406.8 109.6 353.2 80 288 80zM95.4 112.6C142.5 68.8 207.2 32 288 32s145.5 36.8 192.6 80.6c46.8 43.5 78.1 95.4 93 131.1c3.3 7.9 3.3 16.7 0 24.6c-14.9 35.7-46.2 87.7-93 131.1C433.5 443.2 368.8 480 288 480s-145.5-36.8-192.6-80.6C48.6 356 17.3 304 2.5 268.3c-3.3-7.9-3.3-16.7 0-24.6C17.3 208 48.6 156 95.4 112.6zM288 336c44.2 0 80-35.8 80-80s-35.8-80-80-80c-.7 0-1.3 0-2 0c1.3 5.1 2 10.5 2 16c0 35.3-28.7 64-64 64c-5.5 0-10.9-.7-16-2c0 .7 0 1.3 0 2c0 44.2 35.8 80 80 80zm0-208a128 128 0 1 1 0 256 128 128 0 1 1 0-256z" />
                                                    </svg>
                                                    <div class="flex justify-center" style="margin-right:20%;">
                                                        {{ __('VIEW') }}</div>
                                                </a>
                                                <a x-data="{ tooltip: 'Edit' }"
                                                    href="{{ route('reports.edit', $report->id) }}" alt="EDIT">
                                                    <svg style="color: #007FFF;" xmlns="http://www.w3.org/2000/svg"
                                                        fill="none" viewBox="0 0 24 24" stroke-width="1.5"
                                                        stroke="currentColor" class="h-6 w-6" x-tooltip="tooltip">
                                                        <path stroke-linecap="round" stroke-linejoin="round"
                                                            d="M16.862 4.487l1.687-1.688a1.875 1.875 0 112.652 2.652L6.832 19.82a4.5 4.5 0 01-1.897 1.13l-2.685.8.8-2.685a4.5 4.5 0 011.13-1.897L16.863 4.487zm0 0L19.5 7.125" />
                                                    </svg>
                                                    <div class="flex justify-center"
                                                        style="margin-right:20%; color: #007FFF;">{{ __('EDIT') }}
                                                    </div>
                                                </a>
                                                <button x-data="{ tooltip: 'Delete' }" alt="DELETE" data-bs-toggle="modal"
                                                    data-bs-target="#DeleteReport{{ $report->id }}"
                                                    id="{{ $report->id }}">
                                                    <svg style="color: red; margin-left: 5px"
                                                        xmlns="http://www.w3.org/2000/svg" fill="none"
                                                        viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor"
                                                        class="h-6 w-6" x-tooltip="tooltip">
                                                        <path
                                                            d="M4.54.146A.5.5 0 0 1 4.893 0h6.214a.5.5 0 0 1 .353.146l4.394 4.394a.5.5 0 0 1 .146.353v6.214a.5.5 0 0 1-.146.353l-4.394 4.394a.5.5 0 0 1-.353.146H4.893a.5.5 0 0 1-.353-.146L.146 11.46A.5.5 0 0 1 0 11.107V4.893a.5.5 0 0 1 .146-.353zM5.1 1 1 5.1v5.8L5.1 15h5.8l4.1-4.1V5.1L10.9 1z" />
                                                        <path
                                                            d="M4.646 4.646a.5.5 0 0 1 .708 0L8 7.293l2.646-2.647a.5.5 0 0 1 .708.708L8.707 8l2.647 2.646a.5.5 0 0 1-.708.708L8 8.707l-2.646 2.647a.5.5 0 0 1-.708-.708L7.293 8 4.646 5.354a.5.5 0 0 1 0-.708" />
                                                    </svg>
                                                    <div class="flex justify-center"
                                                        style="margin-right:50%; color: red;">
                                                        {{ __('DELETE') }}
                                                    </div>
                                                </button>
                                            </div>
                                        </div>
                                    </td>

                                </tr>

                                <!-- Delete Modal -->
                                <div class="modal fade" id="DeleteReport{{ $report->id }}" tabindex="-1"
                                    role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                    <div class="modal-dialog  modal-dialog-centered">
                                        <div class="modal-content">
                                            <form action="{{ route('reports.destroy', $report->id) }}" method="POST">
                                                @csrf
                                                @method('DELETE')
                                                <div class="modal-header">
                                                    <h5 class="modal-title" id="exampleModalLabel">Delete Sales
                                                    </h5>
                                                    <button type="button" class="btn-close" data-bs-dismiss="modal"
                                                        aria-label="Close"></button>
                                                </div>
                                                <div class="modal-body">
                                                    <div class="row align-items-center my-3">
                                                        <div class="col-md-12" style="font-size:14pt;">
                                                            <label class="block mb-2 text-center">Are you sure want
                                                                to
                                                                Delete?</label>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="modal-footer">
                                                    <button type="button"
                                                        class="focus:outline-none text-white bg-red-700 hover:bg-red-800 focus:ring-4 focus:ring-red-300 font-medium rounded-lg text-sm px-5 py-2.5 me-2 mb-2 dark:bg-red-600 dark:hover:bg-red-700 dark:focus:ring-red-900"
                                                        data-bs-dismiss="modal">Cancel</button>
                                                    <button type="submit"
                                                        class="focus:outline-none text-white bg-green-700 hover:bg-green-800 focus:ring-4 focus:ring-green-300 font-medium rounded-lg text-sm px-5 py-2.5 me-2 mb-2 dark:bg-green-600 dark:hover:bg-green-700 dark:focus:ring-green-800">Confirm</button>
                                                </div>
                                            </form>
                                        </div>
                                    </div>
                                </div>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        @endif
    @else
    <!--Pupuk Panel-->
        @if (!isset($type))
            <br />
            <div class="container text-center">
                <h1 class="text-4xl">MANAGE REPORT</h1>
                <h4 class="text-2xl">Admin Page</h4>
                <br />
                <div class="container-fluid d-flex justify-content-evenly" style="padding-top:20px;">
                    <div
                        class="w-full max-w-sm h-96 bg-white border border-gray-200 rounded-lg shadow dark:bg-gray-800 dark:border-gray-700 space-y-4">
                        <div class="flex justify-end px-10 pt-4 ">
                        </div>
                        <br />
                        <div class="flex flex-col items-center pb-10">
                            <img class="w-24 h-24 mb-3 rounded-full shadow-lg" src="" alt="FK STUDENTS" />
                            <br />
                            <h5 class="mb-1 text-xl font-medium text-gray-900 dark:text-black">FK STUDENTS</h5>
                            <span class="text-sm text-gray-500 dark:text-gray-400">List of application by FK Students
                                in
                                UMPSA</span>
                            <div class="flex mt-4 md:mt-6">
                                <a href="{{ route('reports.index', ['role' => 'STD', 'type' => 'List']) }}"
                                    class="inline-flex items-center px-4 py-2 text-md font-large text-center text-red-600">See
                                    List</a>
                            </div>
                        </div>
                    </div>
                    <div
                        class="w-full max-w-sm h-96 bg-white border border-gray-200 rounded-lg shadow dark:bg-gray-800 dark:border-gray-700 space-y-4">
                        <div class="flex justify-end px-4 pt-4">
                        </div>
                        <br />
                        <div class="flex flex-col items-center pb-10">
                            <img class="w-24 h-24 mb-3 rounded-full shadow-lg" src="" alt="VENDORS" />
                            <br />
                            <h5 class="mb-1 text-xl font-medium text-gray-900 dark:text-black">VENDORS</h5>
                            <span class="text-sm text-gray-500 dark:text-gray-400">List of application by Vendors
                                outside of
                                UMPSA</span>
                            <div class="flex mt-4 md:mt-6">
                                <a href="{{ route('reports.index', ['role' => 'VEN', 'type' => 'List']) }}"
                                    class="inline-flex items-center px-4 py-2 text-md font-large text-center text-red-600">See
                                    List</a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        @else
            <!--REPORT LIST-->
            <div class="container">
                <div class="text-center" style="margin-bottom:2%">
                    <h1 class="text-4xl">MANAGE REPORT</h1>
                    @if ($listRole == 'STD')
                        <h4 class="text-2xl">FK Student Report List</h4>
                    @else
                        <h4 class="text-2xl">Vendor Report List</h4>
                    @endif
                </div>
                @if (Session::has('Approve'))
                    <div class="alert alert-success" role="alert">
                        {{ Session::get('Approve') }}
                    </div>
                @endif
                @if (Session::has('Reject'))
                    <div class="alert alert-danger" role="alert">
                        {{ Session::get('Reject') }}
                    </div>
                @endif
                <br />
                <div class="overflow-hidden rounded-lg border border-gray-200 shadow-md m-5">
                    <table class="w-full border-collapse bg-white text-left text-sm text-gray-500">
                        <thead class="bg-gray-50">
                            <tr>
                                <th class="px-6 py-4 font-medium text-gray-900">No.</th>
                                <th scope="col" class="px-6 py-4 font-medium text-gray-900">User</th>
                                <th scope="col" class="px-6 py-4 font-medium text-gray-900">Date</th>
                                <th scope="col" class="px-6 py-4 font-medium text-gray-900">Report Details</th>
                                <th scope="col" class="px-6 py-4 font-medium text-gray-900"></th>
                            </tr>
                        </thead>
                        <tbody class="divide-y divide-gray-100 border-t border-gray-100">
                            @php
                                $no = 1;
                            @endphp
                            @foreach ($repo as $report)
                                <tr class="hover:bg-gray-50">
                                    <td class="px-6 py-4">{{ $no++ }}</td>
                                    @php
                                        $no = $no - 8;
                                    @endphp
                                    <td class="px-6 py-4">{{ $report->User_ID }}</td>
                                    <td class="px-6 py-4">{{ $report->Date }}</td>
                                    @php
                                        $month = date('F', strtotime($report->Date));
                                    @endphp
                                    <td class="px-6 py-4">{{ $month }} Sales Report</td>
                                    <td class="px-6 py-4">
                                        <div class="flex justify-end gap-4">
                                            <div class="flex justify-end gap-4" style="margin-right: 85px">
                                                <a x-data="{ tooltip: 'View' }"
                                                    href="{{ route('reports.show', $report->id) }}" alt="VIEW">
                                                    <svg xmlns="http://www.w3.org/2000/svg" height="16"
                                                        width="18" viewBox="0 0 576 512" stroke-width="1.5"
                                                        stroke="currentColor" class="h-6 w-6" x-tooltip="tooltip">
                                                        <path stroke-linecap="round" stroke-linejoin="round"
                                                            d="M288 80c-65.2 0-118.8 29.6-159.9 67.7C89.6 183.5 63 226 49.4 256c13.6 30 40.2 72.5 78.6 108.3C169.2 402.4 222.8 432 288 432s118.8-29.6 159.9-67.7C486.4 328.5 513 286 526.6 256c-13.6-30-40.2-72.5-78.6-108.3C406.8 109.6 353.2 80 288 80zM95.4 112.6C142.5 68.8 207.2 32 288 32s145.5 36.8 192.6 80.6c46.8 43.5 78.1 95.4 93 131.1c3.3 7.9 3.3 16.7 0 24.6c-14.9 35.7-46.2 87.7-93 131.1C433.5 443.2 368.8 480 288 480s-145.5-36.8-192.6-80.6C48.6 356 17.3 304 2.5 268.3c-3.3-7.9-3.3-16.7 0-24.6C17.3 208 48.6 156 95.4 112.6zM288 336c44.2 0 80-35.8 80-80s-35.8-80-80-80c-.7 0-1.3 0-2 0c1.3 5.1 2 10.5 2 16c0 35.3-28.7 64-64 64c-5.5 0-10.9-.7-16-2c0 .7 0 1.3 0 2c0 44.2 35.8 80 80 80zm0-208a128 128 0 1 1 0 256 128 128 0 1 1 0-256z" />
                                                    </svg>
                                                    <div class="flex justify-center" style="margin-right:20%;">
                                                        {{ __('VIEW') }}</div>
                                                </a>
                                            </div>
                                        </div>
                                    </td>

                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        @endif
    @endif

</x-app-layout>
