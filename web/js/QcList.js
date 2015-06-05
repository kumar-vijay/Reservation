$(document).ready(function () {
    $('#qcsubmit').click(function () {
        if ($('#qcSubmitForm').valid()) {
            return true;
        }
    });

    $('#qcSubmitForm').validate({
        rules: {
            qcstatus: {required: true}
        },
        messages: {
            qcstatus: '<br />Please select QC Status'
        },
        highlight: function (element) {
            $(element).addClass('error');
        },
        unhighlight: function (element) {
            $(element).removeClass('error');
        }
    });
});