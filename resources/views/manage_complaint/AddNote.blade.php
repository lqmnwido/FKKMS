<x-app-layout>
    <div class="container text-center">
        <h1 class="text-4xl">MANAGE COMPLAINT</h1>
        <h4 class="text-2xl">FK Technical Page</h4>
        <br />
        <div class="container"
            style="background-color: #f0f0f0; border-radius: 10px; box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);">
            <div class="container text-center">
                <div class="mx-auto p-4 text-center text-black" style="max-width: 500px;">
                    <h2>Work Order List</h2>
                    <p>FK Technical Team Page</p>
                </div>

                <!-- Complaint Form -->
                <div class="container"
                    style="background-color: #e6e7e8; border-radius: 10px; box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);">
                    <br>
                    <div class="row">
                        <div class="text-start fw-bolder">
                            <p>Complaint Name: </p>
                            <br />
                            <p>Date & Time: </p>
                            <br />
                            <p>Complaint Details: </p>
                        </div>
                        <div class="text-center">
                            <form method="POST" action="{{ route('complaint_updateNote', $id) }}">
                                {!! csrf_field() !!}
                                @method('PATCH')

                                <div class="mb-3 row">
                                    <div class="col-sm-12">
                                        <textarea class="form-control" id="note" name="note" rows="4" aria-describedby=""
                                            placeholder="Write note about the solution"></textarea>
                                        <div id="complaintDetailsHelp" class="form-text"></div>
                                    </div>
                                </div>

                                <button class="btn btn-primary" onclick="showConfirmation()">Save</button>
                                @push('scripts')
                                    <script>
                                        function showConfirmation() {
                                            // Display a confirmation dialog
                                            let isConfirmed = confirm("Are you sure to save this note?");

                                            // If the user confirms, submit the form
                                            if (isConfirmed) {
                                                document.getElementById('complaintForm').submit();
                                            }
                                        }
                                    </script>
                                @endpush

                            </form>
                        </div>
                        <br />
                    </div>
                    <br />
                </div>
            </div>
            <br>
        </div>
    </div>
</x-app-layout>
