$(document).ready(function() {
    $('input').placeholder();
    $("#forgotPass").validate({
        rules: {
            email: {
                required: true,
                email: true
            }
        },
        // Specify the validation error messages
        messages: {
            email: {
                required: "Please enter email address",
                email: "Please enter a valid email address"
            }
        }
    });
});
