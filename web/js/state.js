$(document).ready(function () {
    $('#statename').blur(function (ev) {
        var str = $(this).val().toLowerCase().replace(/\b[a-z]/g, function (letter) {
            return letter.toUpperCase();
        });
        var string = $.trim(str);
        var finalstring = string.replace(/\s+/g, " ");
        $(this).val(finalstring);
    });
    $('#brokerstatecode').keyup(function () {
        var str = $(this).val();
        str = str.replace(/\s/g, '');
        $(this).val($.trim(str));
    });
    $('#abbreviation').keyup(function () {
        var str = $(this).val();
        str = str.toUpperCase();
        str = str.replace(/\s/g, '');
        $(this).val($.trim(str));
    });
    $('#projectstatecode').keyup(function () {
        var str = $(this).val();
        str = str.replace(/\s/g, '');
        $(this).val($.trim(str));
    });
    $('#editbrokerstatecode').keyup(function () {
        var str = $(this).val();
        str = str.replace(/\s/g, '');
        $(this).val($.trim(str));
    });
    $('#editprojectstatecode').keyup(function () {
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
    /*For Final Broker State*/
    $('#statename').keyup(function () {
        $('#brokerstatename').val("");
        $('#retailbrokerstatename').val("");
    });
    $('#brokerstatecode').keyup(function () {
        $('#brokerstatename').val("");
        $('#retailbrokerstatename').val("");
        $('#abbreviatedbrokerstatename').val("");
    });
    $('#statename').blur(function () {
        var stateName = $('#statename').val();
        var brokerStateCode = $('#brokerstatecode').val();
        if (stateName != '' && brokerStateCode != '') {
            var finalBrokerStateName = stateName + ' - ' + brokerStateCode;
            $('#brokerstatename').val(finalBrokerStateName);
            $('#retailbrokerstatename').val(finalBrokerStateName);
        }
    });
    $('#brokerstatecode').blur(function () {
        var stateName = $('#statename').val();
        var brokerStateCode = $('#brokerstatecode').val();
        var abbreviation = $('#abbreviation').val();
        if (stateName != '' && brokerStateCode != '') {
            var finalBrokerStateName = stateName + ' - ' + brokerStateCode;
            $('#brokerstatename').val(finalBrokerStateName);
            $('#retailbrokerstatename').val(finalBrokerStateName);
        }
        if (brokerStateCode != '' && abbreviation != '') {
            var abbreviatedBrokerState = brokerStateCode + '-' + abbreviation;
            $('#abbreviatedbrokerstatename').val(abbreviatedBrokerState);
        }
    });
    /****************************************************************************************************/
    /*For Abbreviated  Broker State*/
    $('#abbreviation').keyup(function () {
        $('#abbreviatedbrokerstatename').val("");
        $('#projectstatename').val("");
    });
    $('#abbreviation').blur(function () {
        var brokerstatecode = $('#brokerstatecode').val();
        var abbreviation = $('#abbreviation').val();
        var projectstatecode = $('#projectstatecode').val();
        if (brokerstatecode != '' && abbreviation != '') {
            var abbreviatedBrokerState = brokerstatecode + '-' + abbreviation;
            $('#abbreviatedbrokerstatename').val(abbreviatedBrokerState);
        }
        if (projectstatecode != '' && abbreviation != '') {
            var abbreviatedProjectState = projectstatecode + '-' + abbreviation;
            $('#projectstatename').val(abbreviatedProjectState);
        }
    });
    /****************************************************************************************************/
    /*For Project  Broker State*/
    $('#projectstatecode').keyup(function () {
        $('#projectstatename').val("");
    });
    $('#projectstatecode').blur(function () {
        var projectstatecode = $('#projectstatecode').val();
        var abbreviation = $('#abbreviation').val();
        if (projectstatecode != '' && abbreviation != '') {
            var abbreviatedProjectState = projectstatecode + '-' + abbreviation;
            $('#projectstatename').val(abbreviatedProjectState);
        }
    });
    /****************************************************************************************************/
    $('#stateAddForm').validate({
        rules: {
            countryname: {required: true, checkName: $('#countryname').val()},
            statename: {required: true, regex: "^[A-Za-z' ]+([A-Za-z']+)*$"},
            brokerstatecode: {required: true, regex: '^([0-9]{3})$'},
            abbreviation: {required: true, regex: '^[ A-Za-z]*$'},
            projectstatecode: {required: true, regex: '^([0-9]{2})$'}
        },
        messages: {
            countryname: '<br />Please select a valid country name',
            statename: '<br />Please enter a valid state name',
            brokerstatecode: '<br />Please enter a valid broker state code',
            abbreviation: '<br />Please enter a valid abbreviation',
            projectstatecode: '<br />Please enter a valid project state code'
        },
        highlight: function (element) {
            $(element).addClass('error');
        },
        unhighlight: function (element) {
            $(element).removeClass('error');
        }
    });
    /****************************************************************************************************/
    $('#stateEditForm').validate({
        rules: {
            editbrokerstatecode: {required: true, regex: '^([0-9]{3})$'},
            editprojectstatecode: {required: true, regex: '^([0-9]{2})$'}
        },
        messages: {
            editbrokerstatecode: '<br />Please enter a valid broker state code',
            editprojectstatecode: '<br />Please enter a valid project state code'
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
            var editabbreviatedBrokerState = editbrokerStateCode + '-' + editabbreviation;
            $('#editabbreviatedbrokerstatename').val(editabbreviatedBrokerState);
        }
    });
    /****************************************************************************************************/
    $('#editprojectstatecode').keyup(function () {
        $('#editprojectstatename').val("");
    });
    $('#editprojectstatecode').blur(function () {
        var editprojectstatecode = $('#editprojectstatecode').val();
        var editabbreviation = $('#editabbreviation').val();
        if (editprojectstatecode != '' && editabbreviation != '') {
            var editabbreviatedProjectState = editprojectstatecode + '-' + editabbreviation;
            $('#editprojectstatename').val(editabbreviatedProjectState);
        }
    });
});