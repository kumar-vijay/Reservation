$(document).ready(function() {
    $('#firstname').blur(function() {
        $(this).val($.trim($(this).val()));
    });
    
    $('#lastname').blur(function() {
        $(this).val($.trim($(this).val()));
    });
    
    $('#email').blur(function() {
        $(this).val($.trim($(this).val()));
    });
    
    $('#password').blur(function() {
        $(this).val($.trim($(this).val()));
    });

    $.validator.addMethod("alpha", function(value, element) {
        return this.optional(element) || value == value.match(/^[a-zA-Z]+$/);
    }, "Only Characters Allowed.");

    $("#addUserForm").validate({
        rules: {
            firstname: {
                required: true,
                alpha: true
            },
            email: {
                required: true,
                email: true
            },
            password: {
                required: true,
                minlength: 6
            }

        },
        errorElement: 'div',
        wrapper: 'div',
        errorPlacement: function(error, element) {
            error.insertAfter(element); // default function
        },
        // Specify the validation error messages
        messages: {
            firstname: {
                required: "Please enter first name",
                alpha: "First name should only have alphabets"
            },
            password: {
                required: "Please enter password",
                minlength: "Please enter atleast 6 characters"
            },
            email: {
                required: "Please enter email",
                email: "Please enter email in correct format"
            }
        }
    });
});
