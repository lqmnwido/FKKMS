import 'bootstrap';


$('input[name="options"]').on('change', function () {
    showHideTextInput();
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


