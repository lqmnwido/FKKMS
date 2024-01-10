<x-app-layout>
    <br />
    <div class="container text-center">
        <h1 class="text-4xl">MANAGE COMPLAINT</h1>
        <h4 class="text-2xl">We are here to assist you!</h4>
        <br />
        <div class="container"
            style="background-color: #f0f0f0; border-radius: 10px; box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);">
            <br>
            <div class="container text-center">
                @if (Session::has('success'))
                    <div class="alert alert-success" role="alert">
                        {{ Session::get('success') }}
                    </div>
                @endif
                <!-- Complaint Form -->
                <div class="container"
                    style="background-color: #e6e7e8; border-radius: 10px; box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);">
                    <br>
                    <div class="row">
                        <form method="POST" action="{{ route('complaints.store') }}">
                            @csrf
                            <div class="mb-3 row">
                                <label for="complaintName" class="form-label col-sm-3">Complaint's Name:</label>
                                <div class="col-sm-9">
                                    <input type="name" class="form-control" id="complaintName" aria-describedby=""
                                        placeholder="Write Your Name" name="name" value="{{ Auth::user()->name }}">
                                    <input type="hidden" value="{{ Auth::user()->User_ID }}" name="userID">
                                    <div id="" class="form-text"></div>
                                </div>
                            </div>

                            <div class="mb-3 row">
                                <label for="Date_Time" class="form-label col-sm-3">Date and Time:</label>
                                <div class="col-sm-9">
                                    <input type="datetime-local" class="form-control" id="Date_Time"
                                        aria-describedby="Date_Time" name="Date_Time">
                                    <div id="" class="form-text"></div>
                                </div>
                            </div>

                            @push('scripts')
                                <script>
                                    document.addEventListener('DOMContentLoaded', function() {
                                        // Get the current date and time in UTC
                                        let currentUTC = new Date();

                                        // Calculate the offset for Malaysia Time (UTC+8)
                                        let offset = 8 * 60; // 8 hours in minutes

                                        // Adjust the date and time based on the offset
                                        let malaysiaTime = new Date(currentUTC.getTime() + offset * 60000);

                                        // Format the date and time to the required format (YYYY-MM-DDTHH:mm)
                                        let currentDate = malaysiaTime.toISOString().slice(0, 16);

                                        // Set the value of the input field to the current date and time
                                        document.getElementById('Date_Time').value = currentDate;

                                        // Optional: Display a message indicating the default value
                                        document.getElementById('date-time-info').innerHTML = 'Default value: ' + currentDate;
                                    });
                                </script>
                            @endpush

                            <div class="mb-3 row">
                                <label for="complaintCategory" class="form-label col-sm-3">Complaint Category:</label>
                                <div class="col-sm-9">
                                    <select class="form-select" id="complaintCategory" name="complaintCategory">
                                        <option value="" selected disabled>Select Complaint Category</option>
                                        <option value="1">Payment Issues</option>
                                        <option value="2">Product Issues</option>
                                        <option value="3">Technical Issues</option>
                                        <option value="4">Others</option>
                                    </select>
                                    <div id="complaintCategoryHelp" class="form-text"></div>
                                </div>
                            </div>

                            <div class="mb-3 row">
                                <label for="complaintDetails" class="form-label col-sm-3">Complaint Details:</label>
                                <div class="col-sm-9">
                                    <textarea class="form-control" id="complaintDetails" rows="4" aria-describedby=""
                                        placeholder="Describe your complaint details" name="complaintDetails"></textarea>
                                    <div id="complaintDetailsHelp" class="form-text"></div>
                                </div>
                            </div>

                            <input class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded-full"
                                type="submit" name="confirm" value="Submit">

                            @push('scripts')
                                <script>
                                    function showConfirmation() {
                                        // Display a confirmation dialog
                                        let isConfirmed = confirm("Are you sure to submit the complaint?");

                                        // If the user confirms, submit the form
                                        if (isConfirmed) {
                                            document.getElementById('complaintForm').submit();
                                        }
                                    }

                                    document.addEventListener('DOMContentLoaded', function() {
                                        // Get the current date and time in UTC
                                        let currentUTC = new Date();

                                        // Calculate the offset for Malaysia Time (UTC+8)
                                        let offset = 8 * 60; // 8 hours in minutes

                                        // Adjust the date and time based on the offset
                                        let malaysiaTime = new Date(currentUTC.getTime() + offset * 60000);

                                        // Format the date and time to the required format (YYYY-MM-DDTHH:mm)
                                        let currentDate = malaysiaTime.toISOString().slice(0, 16);

                                        // Set the value of the input field to the current date and time
                                        document.getElementById('Date_Time').value = currentDate;

                                        // Optional: Display a message indicating the default value
                                        document.getElementById('date-time-info').innerHTML = 'Default value: ' + currentDate;
                                    });
                                </script>
                            @endpush
                        </form>
                    </div>
                    </br>
                </div>
                </br>
            </div>
        </div>
    </div>
</x-app-layout>
