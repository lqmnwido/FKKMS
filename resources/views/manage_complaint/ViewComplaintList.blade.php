<x-app-layout>
    <br />
    <div class="container text-center">
        <h1 class="text-4xl">MANAGE COMPLAINT</h1>
        <h4 class="text-2xl">Pupuk Admin Page</h4>
        <br />
        <!-- Complaint Form -->
        <div class="container"
            style="background-color: #e6e7e8; border-radius: 10px; box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);">
            <br>
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
                            <tr>
                                <th scope="row">1</th>
                                <td></td>
                                <td></td>
                                <td></td>
                                <td style="text-align: center">
                                    <!-- Button trigger dropdown -->
                                    <div class="dropdown">
                                        <button class="btn btn-info" id="editCategoryButton"
                                            onclick="replaceEditCategoryDropdown()">
                                            Complaint Category
                                        </button>
                                        <button class="btn btn-primary" onclick="showEditConfirmation()">Save
                                            Change</button>
                                    </div>
                                </td>
                                <td style="text-align: center">
                                    <!-- Button trigger dropdown -->
                                    <div class="dropdown">
                                        <button class="btn btn-info" id="updateStatusButton"
                                            onclick="replaceUpdateStatusDropdown()">
                                            Complaint Status
                                        </button>
                                        <button class="btn btn-primary" name="confirm" onclick="showUpdateConfirmation()">Save
                                            Change</button>
                                    </div>
                                </td>
                                <td style="text-align: center"><button type="button"
                                        class="btn btn-primary">Delete</button></td>
                            </tr>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
    <br>
    </div>
    </div>
</x-app-layout>
