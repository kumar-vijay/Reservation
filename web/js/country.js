$(document).ready(function () {
    $('#countryname').keyup(function () {
        var str = $(this).val().toLowerCase().replace(/\b[a-z]/g, function (letter) {
            return letter.toUpperCase();
        });
        str = str.replace(/\s/g, '');
        $(this).val($.trim(str));
    });
    $('#countrycode').keyup(function () {
        var str = $(this).val();
        str = str.replace(/\s/g, '');
        $(this).val($.trim(str));
    });
    $('#editcountrycode').keyup(function () {
        var str = $(this).val();
        str = str.replace(/\s/g, '');
        $(this).val($.trim(str));
    });
    $.validator.addMethod(
            "regex",
            function (value, element, regexp) {
                var re = new RegExp(regexp);
                return this.optional(element) || re.test(value);
            },
            "Please check your input."
            );
    /****************************************************************************************************/
    $('#countryname').blur(function () {
        $('#finalcountryname').val("");
        var countryName = $('#countryname').val();
        var countryCode = $('#countrycode').val();
        if (countryName != '' && countryCode != '') {
            var finalCounrtyName = countryCode + ' - ' + countryName;
            $('#finalcountryname').val(finalCounrtyName);
        }
    });
    /****************************************************************************************************/
    $('#countrycode').blur(function () {
        $('#finalcountryname').val("");
        var countryName = $('#countryname').val();
        var countryCode = $('#countrycode').val();
        if (countryName != '' && countryCode != '') {
            var finalCounrtyName = countryCode + ' - ' + countryName;
            $('#finalcountryname').val(finalCounrtyName);
        }
    });
    /****************************************************************************************************/
    $('#editcountryname').blur(function () {
        $('#editfinalcountryname').val("");
        var countryName = $('#editcountryname').val();
        var countryCode = $('#editcountrycode').val();
        if (countryName != '' && countryCode != '') {
            var finalCounrtyName = countryCode + ' - ' + countryName;
            $('#editfinalcountryname').val(finalCounrtyName);
        }
    });
    /****************************************************************************************************/
    $('#editcountrycode').blur(function () {
        $('#editfinalcountryname').val("");
        var countryName = $('#editcountryname').val();
        var countryCode = $('#editcountrycode').val();
        if (countryName != '' && countryCode != '') {
            var finalCounrtyName = countryCode + ' - ' + countryName;
            $('#editfinalcountryname').val(finalCounrtyName);
        }
    });
    /****************************************************************************************************/
    $('#countryAddForm').validate({
        rules: {
            countryname: {required: true, regex: '^[ A-Za-z]*$'},
            countrycode: {required: true, regex: '^([0-9]{3})$'}
        },
        messages: {
            countryname: '<br />Please enter a valid country name',
            countrycode: '<br />Please enter a valid country code'
        },
        highlight: function (element) {
            $(element).addClass('error');
        },
        unhighlight: function (element) {
            $(element).removeClass('error');
        }
    });
    /****************************************************************************************************/
    $('#countryEditForm').validate({
        rules: {
            editcountryname: {required: true, regex: '^[ A-Za-z]*$'},
            editcountrycode: {required: true, regex: '^([0-9]{3})$'}
        },
        messages: {
            editcountryname: '<br />Please enter a valid country name',
            editcountrycode: '<br />Please enter a valid country code'
        },
        highlight: function (element) {
            $(element).addClass('error');
        },
        unhighlight: function (element) {
            $(element).removeClass('error');
        }
    });
    /****************************************************************************************************/
});