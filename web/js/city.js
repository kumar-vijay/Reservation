$(document).ready(function () {
    $('#cityname').blur(function () {
        var str = $(this).val().toLowerCase().replace(/\b[a-z]/g, function (letter) {
            return letter.toUpperCase();
        });
        var string = $.trim(str);
        var finalstring = string.replace(/\s+/g, " ");
        $(this).val(finalstring);
    });
    $('#citycode').keyup(function () {
        var str = $(this).val();
        str = str.replace(/\s/g, '');
        $(this).val($.trim(str));
    });
    $('#editcitycode').keyup(function () {
        var str = $(this).val();
        str = str.replace(/\s/g, '');
        $(this).val($.trim(str));
    });
    $.validator.addMethod("checkName", function (value, element, params) {
        var x = value;
        if (x == 0) {
            return false;
        } else {
            return true;
        }
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
    /*For Broker City*/
    $('#cityname').keyup(function () {
        $('#brokercityname').val("");
        $('#retailbrokercityname').val("");
    });
    $('#citycode').keyup(function () {
        $('#brokercityname').val("");
        $('#retailbrokercityname').val("");
    });
    $('#cityname').blur(function () {
        var cityName = $('#cityname').val();
        var cityCode = $('#citycode').val();
        if (cityName != '' && cityCode != '') {
            var finalcityName = cityName + '-' + cityCode;
            $('#brokercityname').val(finalcityName);
            $('#retailbrokercityname').val(finalcityName);
        }
    });
    $('#citycode').blur(function () {
        var cityName = $('#cityname').val();
        var cityCode = $('#citycode').val();
        if (cityName != '' && cityCode != '') {
            var finalcityName = cityName + '-' + cityCode;
            $('#brokercityname').val(finalcityName);
            $('#retailbrokercityname').val(finalcityName);
        }
    });
    /****************************************************************************************************/
    $('#cityAddForm').validate({
        rules: {
            statename: {required: true, checkName: $('#statename').val()},
            cityname: {required: true, regex: "^[A-Za-z' ]+([A-Za-z']+)*$"},
            citycode: {required: true, regex: '^([0-9]{4})$'}
        },
        messages: {
            statename: '<br />Please select a valid state name',
            cityname: '<br />Please enter a valid city name',
            citycode: '<br />Please enter a valid city code'
        },
        highlight: function (element) {
            $(element).addClass('error');
        },
        unhighlight: function (element) {
            $(element).removeClass('error');
        }
    });
    /****************************************************************************************************/
    $('#cityEditForm').validate({
        rules: {
            editcitycode: {required: true, regex: '^([0-9]{4})$'}
        },
        messages: {
            editcitycode: '<br />Please enter a valid city code'
        },
        highlight: function (element) {
            $(element).addClass('error');
        },
        unhighlight: function (element) {
            $(element).removeClass('error');
        }
    });
    /****************************************************************************************************/
    $('#editbrokerstatecode').keyup(function () {
        $('#editbrokerstatename').val("");
        $('#editretailbrokerstatename').val("");
        $('#editabbreviatedbrokerstatename').val("");
    });
    $('#editbrokerstatecode').blur(function () {
        var editstateName = $('#editstatename').val();
        var editbrokerStateCode = $('#editbrokerstatecode').val();
        var editabbreviation = $('#editabbreviation').val();
        if (editstateName != '' && editbrokerStateCode != '') {
            var editfinalBrokerStateName = editstateName + ' - ' + editbrokerStateCode;
            $('#editbrokerstatename').val(editfinalBrokerStateName);
            $('#editretailbrokerstatename').val(editfinalBrokerStateName);
        }
        if (editbrokerStateCode != '' && editabbreviation != '') {
            var editabbreviatedBrokerState = editbrokerStateCode + '_' + editabbreviation;
            $('#editabbreviatedbrokerstatename').val(editabbreviatedBrokerState);
        }
    });
    /****************************************************************************************************/
    $('#editcitycode').keyup(function () {
        $('#editbrokerstatename').val("");
        $('#editretailbrokerstatename').val("");
    });
    $('#editcitycode').blur(function () {
        var editcitycode = $('#editcitycode').val();
        var editcityname = $('#editcityname').val();
        if (editcitycode != '' && editcityname != '') {
            var finalCity = editcityname + '-' + editcitycode;
            $('#editbrokerstatename').val(finalCity);
            $('#editretailbrokerstatename').val(finalCity);
        }
    });
});