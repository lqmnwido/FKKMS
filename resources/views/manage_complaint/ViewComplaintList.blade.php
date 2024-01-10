<x-app-layout>
    <br />
    @if ($role == 'Pupuk Admin')
        <div class="container text-center">
            <h1 class="text-4xl">MANAGE COMPLAINT</h1>
            <h4 class="text-2xl">Pupuk Admin Page</h4>
            <br />
            <!-- Complaint Form -->
            <div class="container"
                style="background-color: #e6e7e8; border-radius: 10px; box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);">
                <br>
                @if (Session::has('success'))
                    <div class="alert alert-success" role="alert">
                        {{ Session::get('success') }}
                    </div>
                @endif
                @if (Session::has('Alert'))
                    <div class="alert alert-danger" role="alert">
                        {{ Session::get('Alert') }}
                    </div>
                @endif
                <div class="row">
                    <div class="text-center">
                        <!-- Displaying Data in a Table -->
                        <table class="table table-bordered">
                            <thead>
                                <tr>
                                    <th scope="col" style="text-align: center">No.</th>
                                    <th scope="col" style="text-align: center">Complaint Name</th>
                                    <th scope="col" style="text-align: center">Date & Time</th>
                                    <th scope="col" style="text-align: center">Complaint Details</th>
                                    <th scope="col" style="text-align: center">Complaint Category</th>
                                    <th scope="col" style="text-align: center">Complaint Status</th>
                                    <th scope="col" style="text-align: center">Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                @php
                                    $no = 1;
                                @endphp
                                @foreach ($complaints as $complaint)
                                    <tr>
                                        <th scope="row">{{ $no++ }}</th>
                                        <td>
                                            @if ($user = $users->where('User_ID', $complaint->User_ID)->first())
                                                <div class="text-sm">
                                                    <div class="font-medium text-gray-700">{{ $user->name }}
                                                    </div>
                                                    <div class="text-gray-400">{{ $user->User_ID }}</div>
                                                </div>
                                            @endif
                                        </td>
                                        <td>
                                            <div class="col pt-2">
                                                {{ date('d/m/Y', strtotime($complaint->Date)) }} :
                                                {{ date('H:i A', strtotime($complaint->Time)) }}
                                            </div>
                                        </td>
                                        <td>
                                            <div class="col pt-2">
                                                {{ $complaint->details }}
                                            </div>
                                        </td>
                                        <td style="text-align: center">
                                            <div class="row">
                                                <div class="col pt-2">
                                                    @php
                                                        if ($complaint->complaintCategory_ID == 1) {
                                                            $cat = 'Payment Issues';
                                                        } elseif ($complaint->complaintCategory_ID == 2) {
                                                            $cat = 'Product Issues';
                                                        } elseif ($complaint->complaintCategory_ID == 3) {
                                                            $cat = 'Technical Issues';
                                                        } else {
                                                            $cat = 'Others';
                                                        }
                                                    @endphp
                                                    {{ $cat }}
                                                </div>
                                            </div>
                                        </td>
                                        <td style="text-align: center">
                                            <!-- Button trigger dropdown -->
                                            <div class="row">
                                                <div class="col pt-2">
                                                    @php
                                                        if ($complaint->complaintStatus_ID == 0) {
                                                            $cat = 'PENDING';
                                                        } elseif ($complaint->complaintStatus_ID == 1) {
                                                            $cat = 'IN PROGRESS';
                                                        } elseif ($complaint->complaintStatus_ID == 2) {
                                                            $cat = 'RESOLVED';
                                                        }
                                                    @endphp
                                                    {{ $cat }}
                                                </div>
                                                <div class="col">
                                                    <button class="btn btn-primary" data-bs-toggle="modal"
                                                        data-bs-target="#updateStatus{{ $complaint->id }}">Update
                                                        Status</button>
                                                </div>
                                            </div>
                                        </td>
                                        <td style="text-align: center"><button class="btn btn-danger"
                                                data-bs-toggle="modal"
                                                data-bs-target="#DeleteComplaint{{ $complaint->id }}">Delete</button>
                                        </td>
                                    </tr>

                                    <!-- Update Modal -->
                                    <div class="modal fade" id="updateStatus{{ $complaint->id }}" tabindex="-1"
                                        role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                        <div class="modal-dialog  modal-dialog-centered">
                                            <div class="modal-content">
                                                <form action="{{ route('complaints.update', $complaint->id) }}"
                                                    method="POST">
                                                    {!! csrf_field() !!}
                                                    @method('PATCH')
                                                    <div class="modal-header">
                                                        <h5 class="modal-title" id="exampleModalLabel">Approve Payment
                                                        </h5>
                                                        <button type="button" class="btn-close" data-bs-dismiss="modal"
                                                            aria-label="Close"></button>
                                                    </div>
                                                    <div class="modal-body">
                                                        <div class="row align-items-center my-3">
                                                            <div class="col-md-12" style="font-size:14pt;">
                                                                <label class="block mb-2 text-center">Are you sure want
                                                                    to
                                                                    update?</label>
                                                                </br>

                                                                <label class="block text-left" for="status">Complaint
                                                                    ID :
                                                                    {{ $complaint->complaint_ID }}</label>
                                                                <br />

                                                                <label class="block text-left" for="status">Complaint
                                                                    Status:</label>
                                                                <div>
                                                                    <select class="form-select" id="status"
                                                                        name="status">
                                                                        @foreach ([0, 1, 2] as $option)
                                                                            @php
                                                                                if ($option == 0) {
                                                                                    $textOpt = 'PENDING';
                                                                                } elseif ($option == 1) {
                                                                                    $textOpt = 'IN PROGRESS';
                                                                                } else {
                                                                                    $textOpt = 'RESOLVED';
                                                                                }
                                                                            @endphp
                                                                            <option value="{{ $option }}"
                                                                                @if ($user->User_type === $option) selected @endif>
                                                                                {{ $textOpt }}</option>
                                                                        @endforeach
                                                                    </select>
                                                                    <div id="complaintCategoryHelp" class="form-text">
                                                                    </div>
                                                                </div>
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
                                    <!-- END Modal -->

                                    <!-- Delete Modal -->
                                    <div class="modal fade" id="DeleteComplaint{{ $complaint->id }}" tabindex="-1"
                                        role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                        <div class="modal-dialog  modal-dialog-centered">
                                            <div class="modal-content">
                                                <form action="{{ route('complaints.destroy', $complaint->id) }}"
                                                    method="POST">
                                                    @csrf
                                                    @method('DELETE')
                                                    <div class="modal-header">
                                                        <h5 class="modal-title" id="exampleModalLabel">Delete Complaint
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
                                    <!-- END Modal -->
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    @else
        <div class="container text-center">
            <h1 class="text-4xl">MANAGE COMPLAINT</h1>
            <h4 class="text-2xl">FK Technical Page</h4>
            <br />
            <!-- Complaint Form -->
            <div class="container"
                style="background-color: #e6e7e8; border-radius: 10px; box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);">
                <br>
                @if (Session::has('success'))
                    <div class="alert alert-success" role="alert">
                        {{ Session::get('success') }}
                    </div>
                @endif
                @if (Session::has('Alert'))
                    <div class="alert alert-danger" role="alert">
                        {{ Session::get('Alert') }}
                    </div>
                @endif
                <div class="row">
                    <div class="text-center">
                        <!-- Displaying Data in a Table -->
                        <table class="table table-bordered">
                            <thead>
                                <tr>
                                    <th scope="col" style="text-align: center">No.</th>
                                    <th scope="col" style="text-align: center">Complaint Name</th>
                                    <th scope="col" style="text-align: center">Date & Time</th>
                                    <th scope="col" style="text-align: center">Complaint Details</th>
                                    <th scope="col" style="text-align: center">Add Notes</th>
                                    <th scope="col" style="text-align: center">Complaint Status</th>
                                </tr>
                            </thead>
                            <tbody>
                                @php
                                    $no = 1;
                                @endphp
                                @foreach ($complaints as $complaint)
                                    <tr>
                                        @if ($complaint->complaintCategory_ID == 3)
                                            <th scope="row">{{ $no++ }}</th>
                                            <td>
                                                @if ($user = $users->where('User_ID', $complaint->User_ID)->first())
                                                    <div class="text-sm">
                                                        <div class="font-medium text-gray-700">{{ $user->name }}
                                                        </div>
                                                        <div class="text-gray-400">{{ $user->User_ID }}</div>
                                                    </div>
                                                @endif
                                            </td>
                                            <td>
                                                <div class="col pt-2">
                                                    {{ date('d/m/Y', strtotime($complaint->Date)) }} :
                                                    {{ date('H:i A', strtotime($complaint->Time)) }}
                                                </div>
                                            </td>
                                            <td>
                                                <div class="col pt-2">
                                                    {{ $complaint->details }}
                                                </div>
                                            </td>
                                            <td style="text-align: center">
                                                <div class="row">
                                                    @if ($complaint->addNote == null)
                                                        <div class="col">
                                                            <a class="btn btn-secondary"
                                                                href="{{ route('complaint_addNote', ['id' => $complaint->id]) }}">ADD
                                                                NOTE</a>
                                                        </div>
                                                    @else
                                                        <div class="col pt-2">

                                                            {{ $complaint->addNote }}
                                                        </div>
                                                    @endif

                                                </div>
                                            </td>
                                            <td style="text-align: center">
                                                <!-- Button trigger dropdown -->
                                                <div class="row">
                                                    <div class="col pt-2">
                                                        @php
                                                            if ($complaint->complaintStatus_ID == 0) {
                                                                $cat = 'PENDING';
                                                            } elseif ($complaint->complaintStatus_ID == 1) {
                                                                $cat = 'IN PROGRESS';
                                                            } elseif ($complaint->complaintStatus_ID == 2) {
                                                                $cat = 'RESOLVED';
                                                            }
                                                        @endphp
                                                        {{ $cat }}
                                                    </div>
                                                    <div class="col">
                                                        <button class="btn btn-primary" data-bs-toggle="modal"
                                                            data-bs-target="#updateStatus{{ $complaint->id }}">Update
                                                            Status</button>
                                                    </div>
                                                </div>
                                            </td>
                                        @endif
                                    </tr>

                                    <!-- Update Modal -->
                                    <div class="modal fade" id="updateStatus{{ $complaint->id }}" tabindex="-1"
                                        role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                        <div class="modal-dialog  modal-dialog-centered">
                                            <div class="modal-content">
                                                <form action="{{ route('complaints.update', $complaint->id) }}"
                                                    method="POST">
                                                    {!! csrf_field() !!}
                                                    @method('PATCH')
                                                    <div class="modal-header">
                                                        <h5 class="modal-title" id="exampleModalLabel">Approve Payment
                                                        </h5>
                                                        <button type="button" class="btn-close"
                                                            data-bs-dismiss="modal" aria-label="Close"></button>
                                                    </div>
                                                    <div class="modal-body">
                                                        <div class="row align-items-center my-3">
                                                            <div class="col-md-12" style="font-size:14pt;">
                                                                <label class="block mb-2 text-center">Are you sure want
                                                                    to
                                                                    update?</label>
                                                                </br>

                                                                <label class="block text-left"
                                                                    for="status">Complaint
                                                                    ID :
                                                                    {{ $complaint->complaint_ID }}</label>
                                                                <br />

                                                                <label class="block text-left"
                                                                    for="status">Complaint
                                                                    Status:</label>
                                                                <div>
                                                                    <select class="form-select" id="status"
                                                                        name="status">
                                                                        @foreach ([0, 1, 2] as $option)
                                                                            @php
                                                                                if ($option == 0) {
                                                                                    $textOpt = 'PENDING';
                                                                                } elseif ($option == 1) {
                                                                                    $textOpt = 'IN PROGRESS';
                                                                                } else {
                                                                                    $textOpt = 'RESOLVED';
                                                                                }
                                                                            @endphp
                                                                            <option value="{{ $option }}"
                                                                                @if ($complaint->complaintCategory_ID === $option) selected @endif>
                                                                                {{ $textOpt }}</option>
                                                                        @endforeach
                                                                    </select>
                                                                    <div id="complaintCategoryHelp" class="form-text">
                                                                    </div>
                                                                </div>
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
                                    <!-- END Modal -->
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    @endif
</x-app-layout>
