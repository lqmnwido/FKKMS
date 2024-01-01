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


