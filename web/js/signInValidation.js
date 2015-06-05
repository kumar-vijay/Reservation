$(document).ready(function() {
    $('input').placeholder();
    $("#login").validate({
        rules: {
            userEmail: {
                required: true,
                email: true
            },
            userPass: {
                required: true,
                minlength: 6
            }
        },
        messages: {
            userPass: {
                required: "Please enter a password",
                minlength: "Your password must be at least 6 characters long"
            },
            userEmail: {
                required: "Please enter a email address",
                email: "Please enter a valid email address"
            }
        }
    });
});
