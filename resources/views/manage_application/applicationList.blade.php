<x-app-layout>

    <br />
    <div class="container">
        <div class="text-center" style="margin-bottom:2%">
            <h1 class="text-4xl">MANAGE APPLICATION</h1>
            <h4 class="text-2xl">Application List</h4>
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
                        <th scope="col" class="px-6 py-4 font-medium text-gray-900">Application ID</th>
                        <th scope="col" class="px-6 py-4 font-medium text-gray-900">User</th>
                        <th scope="col" class="px-6 py-4 font-medium text-gray-900">Product Name</th>
                        <th scope="col" class="px-6 py-4 font-medium text-gray-900">Student ID</th>
                        <th scope="col" class="px-6 py-4 font-medium text-gray-900">Date & Time</th>
                        <th scope="col" class="px-6 py-4 font-medium text-gray-900"></th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-gray-100 border-t border-gray-100">
                    @php
                        $no = 1;
                    @endphp
                    @foreach ($applications as $application)
                        <tr class="hover:bg-gray-50">
                            <td class="px-6 py-4">{{ $no++ }}</td>
                            <td class="px-6 py-4">{{ $application->application_ID }}</td>
                            <th class="flex gap-3 px-6 py-4 font-normal text-gray-900">
                                <div class="text-sm">
                                    <div class="font-medium text-gray-700">{{ $application->name }}</div>
                                    <div class="text-gray-400">{{ $application->User_ID }}</div>
                                </div>
                            </th>
                            <td class="px-6 py-4">{{ $application->Product_name }}</td>
                            <td class="px-6 py-4">
                                <div class="flex gap-2">
                                    <span
                                        class="inline-flex items-center gap-1 rounded-full bg-blue-50 px-2 py-1 text-xs font-semibold text-blue-600">
                                        {{ 'RM ' . number_format((float) $application->Price, 2) }}
                                    </span>
                                </div>
                            </td>
                            <td class="px-6 py-4">
                                {{ date('d/m/Y', strtotime($application->created_at)) . ' : ' . date('h:i A', strtotime($application->created_at)) }}
                            </td>
                            
                            <td class="px-6 py-4">
                                <div class="flex justify-end gap-4">
                                    @if($application->status==null)
                                    <button type="button"
                                        class="focus:outline-none text-white bg-green-700 hover:bg-green-800 focus:ring-4 focus:ring-green-300 font-medium rounded-lg text-sm px-5 py-2.5 me-2 mb-2 dark:bg-green-600 dark:hover:bg-green-700 dark:focus:ring-green-800 approve_application"
                                        data-bs-toggle="modal" data-bs-target="#approveApplication{{ $application->id }}"
                                        id="{{ $application->id }}">APPROVE</button>
                                    <button type="button"
                                        class="focus:outline-none text-white bg-red-700 hover:bg-red-800 focus:ring-4 focus:ring-red-300 font-medium rounded-lg text-sm px-5 py-2.5 me-2 mb-2 dark:bg-red-600 dark:hover:bg-red-700 dark:focus:ring-red-900 reject_application"
                                        data-bs-toggle="modal" data-bs-target="#rejectApplication{{ $application->id }}"
                                        id="{{ $application->id }}">REJECT</button>
                                    @elseif($application->status=='Rejected')
                                        <div class="px-6 py-4 text-red-600 font-bold" style="margin-right: 110px">{{ __('REJECTED') }}</div>
                                    @elseif($application->status=='Approved')
                                        <div class="px-6 py-4 text-green-600 font-bold" style="margin-right: 109px">{{ __('APPROVED') }}</div>
                                    @endif
                                </div>
                                
                            </td>
                        
                            
                        </tr>

                        <!-- Approve Modal -->
                        <div class="modal fade" id="approveApplication{{ $application->id }}" tabindex="-1"
                            role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                            <div class="modal-dialog  modal-dialog-centered">
                                <div class="modal-content">
                                    <form action="{{ route('approve_application') }}" method="POST">
                                        @csrf
                                        <div class="modal-header">
                                            <h5 class="modal-title" id="exampleModalLabel">Approve Application</h5>
                                            <button type="button" class="btn-close" data-bs-dismiss="modal"
                                                aria-label="Close"></button>
                                        </div>
                                        <div class="modal-body">
                                            <div class="row align-items-center my-3">
                                                <div class="col-md-12" style="font-size:14pt;">
                                                    <label
                                                        class="block mb-2 text-center">Are you sure want to approve?</label>
                                                    </br>
                                                    Application ID : {{$application->application_ID}}
                                                    <input type="text" class="userType" name="userType" value="{{$application->User_type}}" hidden>
                                                    <input type="text" class="id" name="id" value="{{$application->application_ID}}" hidden>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="modal-footer">
                                            <button type="button" class="focus:outline-none text-white bg-red-700 hover:bg-red-800 focus:ring-4 focus:ring-red-300 font-medium rounded-lg text-sm px-5 py-2.5 me-2 mb-2 dark:bg-red-600 dark:hover:bg-red-700 dark:focus:ring-red-900"
                                                data-bs-dismiss="modal">Cancel</button>
                                            <button type="submit" class="focus:outline-none text-white bg-green-700 hover:bg-green-800 focus:ring-4 focus:ring-green-300 font-medium rounded-lg text-sm px-5 py-2.5 me-2 mb-2 dark:bg-green-600 dark:hover:bg-green-700 dark:focus:ring-green-800">Confirm</button>
                                        </div>
                                    </form>
                                </div>
                            </div>
                        </div>

                        <!-- Reject Modal -->
                        <div class="modal fade" id="rejectApplication{{ $application->id }}" tabindex="-1"
                            role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                            <div class="modal-dialog  modal-dialog-centered">
                                <div class="modal-content">
                                    <form action="{{ route('reject_application') }}" method="POST">
                                        @csrf
                                        <div class="modal-header">
                                            <h5 class="modal-title" id="exampleModalLabel">Reject Application</h5>
                                            <button type="button" class="btn-close" data-bs-dismiss="modal"
                                                aria-label="Close"></button>
                                        </div>
                                        <div class="modal-body">
                                            <div class="row align-items-center my-3">
                                                <div class="col-md-12" style="font-size:14pt;">
                                                    <label
                                                        class="block mb-2 text-center">Are you sure want to reject?</label>
                                                    </br>
                                                    <label for="reason"
                                                        class="block mb-2 text-sm font-medium">Reason</label>
                                                    <textarea id="reason" name="reason" rows="4"
                                                        class="block p-2.5 w-full text-sm text-gray-900 bg-slate-300 rounded-lg border border-gray-300 focus:ring-blue-500 focus:border-blue-500 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500"
                                                        placeholder="Write your reason here..."></textarea>
                                                    <input type="text" class="userType" name="userType" value="{{$application->User_type}}" hidden>
                                                    <input type="text" class="id" name="id" value="{{$application->application_ID}}" hidden>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="modal-footer">
                                            <button type="button" class="focus:outline-none text-white bg-red-700 hover:bg-red-800 focus:ring-4 focus:ring-red-300 font-medium rounded-lg text-sm px-5 py-2.5 me-2 mb-2 dark:bg-red-600 dark:hover:bg-red-700 dark:focus:ring-red-900"
                                                data-bs-dismiss="modal">Cancel</button>
                                            <button type="submit" class="focus:outline-none text-white bg-green-700 hover:bg-green-800 focus:ring-4 focus:ring-green-300 font-medium rounded-lg text-sm px-5 py-2.5 me-2 mb-2 dark:bg-green-600 dark:hover:bg-green-700 dark:focus:ring-green-800">Confirm</button>
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

</x-app-layout>
