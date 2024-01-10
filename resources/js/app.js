import 'bootstrap';


$('input[name="options"]').on('change', function () {
    showHideTextInput();
});

$('input[name="paymentOpt"]').on('change', function () {
    showHidePayment();
});

$('#role').on('change', function () {
    showHide();
});

function showHideTextInput() {
    var student = $('#student');
    var vendor = $('#vendor');
    var studentForm = $('#studentForm');
    var vendorForm = $('#vendorForm');

    if (student.is(':checked')) {
        studentForm.show();
        vendorForm.hide();
    } else if (vendor.is(':checked')) {
        vendorForm.show();
        studentForm.hide();
    } else {
        studentForm.hide();
        vendorForm.hide();
    }
}

function showHide() {
    var selectedOption = $('#role').val();
    var studentForm = $('#studentForm');
    var vendorForm = $('#vendorForm');

    if (selectedOption === 'FK Student') {
        studentForm.show();
        vendorForm.hide();
    }else if (selectedOption === 'Vendor') {
        vendorForm.show();
        studentForm.hide();
    } else {
        studentForm.hide();
        vendorForm.hide();
    }
}

function showHidePayment() {
    var FPX = $('#FPX');
    var CDM = $('#CDM');
    var upload = $('#upload');

    if (FPX.is(':checked')) {
        upload.hide();
    } else if (CDM.is(':checked')) {
        upload.show();
    } else {
        upload.hide();
    }
}

$('input[name="confirm"]').on('click', function () {
    console.log("Button clicked");
    showConfirmation();
});

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

//JavaScript to toggle dropdown for Edit Category 

function replaceEditCategoryDropdown() {
    // Get the parent element of the button
    var parentElement = document.getElementById('editCategoryButton').parentNode;

    // Create a new dropdown list
    var dropdownList = document.createElement('select');
    dropdownList.className = 'form-control'; // You can add Bootstrap classes or customize the styling here

    // Create an optgroup as a label
    var labelOptgroup = document.createElement('optgroup');
    labelOptgroup.label = 'Complaint Category';

    // Add options to the optgroup
    var categories = ['Product Issues', 'Technical Issues', 'Payment Issues'];
    categories.forEach(function (category) {
        var option = document.createElement('option');
        option.text = category;
        labelOptgroup.appendChild(option);
    });

    // Add the optgroup to the dropdown list
    dropdownList.appendChild(labelOptgroup);

    // Replace the button with the dropdown list
    parentElement.replaceChild(dropdownList, document.getElementById('editCategoryButton'));
}

function saveEditCategory() {
    // Handle saving the selected category here
    var selectedCategory = document.getElementById('editCategoryButton').parentNode.querySelector('select').value;
    alert('Saved Category: ' + selectedCategory);
}


//JavaScript to toggle dropdown for Update Status
function replaceUpdateStatusDropdown() {
    // Get the parent element of the button
    var parentElement = document.getElementById('updateStatusButton').parentNode;

    // Create a new dropdown list
    var dropdownList = document.createElement('select');
    dropdownList.className = 'form-control'; // You can add Bootstrap classes or customize the styling here

    // Create an optgroup as a label
    var labelOptgroup = document.createElement('optgroup');
    labelOptgroup.label = 'Complaint Status';

    // Add options to the optgroup
    var statuses = ['Open', 'In Progress', 'Resolved'];
    statuses.forEach(function (status) {
        var option = document.createElement('option');
        option.text = status;
        labelOptgroup.appendChild(option);
    });

    // Add the optgroup to the dropdown list
    dropdownList.appendChild(labelOptgroup);

    // Replace the button with the dropdown list
    parentElement.replaceChild(dropdownList, document.getElementById('updateStatusButton'));
}

function saveUpdateStatus() {
    // Handle saving the selected status here
    var selectedStatus = document.getElementById('updateStatusButton').parentNode.querySelector('select').value;
    alert('Saved Status: ' + selectedStatus);
}

function showEditConfirmation() {
    // Display a confirmation dialog
    let isConfirmed = confirm("Are you sure to save this Complaint Category?");

    // If the user confirms, submit the form
    if (isConfirmed) {
        document.getElementById('complaintForm').submit();
    }
}

function showUpdateConfirmation() {
    // Display a confirmation dialog
    let isConfirmed = confirm("Are you sure to save this Complaint Status?");

    // If the user confirms, submit the form
    if (isConfirmed) {
        document.getElementById('complaintForm').submit();
    }
}


//Tax Calculate
// Function to update total based on quantity
function updateTotal() {
    var qty = parseFloat(document.getElementById('qty').value) || 1;
    var price = parseFloat(document.getElementById('price').value) || 0;
    var taxRate = parseFloat(document.getElementById('tRate').value) || 0;

    var tax = (price * qty * taxRate);
    var total = (price * qty) + (price * qty * taxRate);
    document.getElementById('total').value = total.toFixed(2);
    document.getElementById('totalHidden').value = tax.toFixed(2);
}

// Event listener for quantity input change
document.getElementById('qty').addEventListener('input', function() {
    updateTotal();
});

// Initial calculation
updateTotal();