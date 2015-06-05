$(document).ready(function () {
    
    /*****************************************For Form Validation************************************************/
    $('#policyNumberListForm').validate({
        rules: {
            policynumber: {minlength: 6, maxlength:6}
        },
        messages: {
            policynumber: '<br />Please enter a valid value of Policy Number'
        },
        highlight: function (element) {
            $(element).addClass('error');
        },
        unhighlight: function (element) {
            $(element).removeClass('error');
        }
    });
    /*****************************************For Admitted Region************************************************/
});


