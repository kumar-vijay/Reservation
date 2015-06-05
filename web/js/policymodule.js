$(document).ready(function () {
    $.validator.setDefaults({
        ignore: []
    });
    $('#insuredName').blur(function () {
        var string = $.trim($(this).val());
        var finalstring = string.replace(/\s+/g, " ");
        $(this).val(finalstring);

    });
    $('#reinsuranceCompany').blur(function () {
        var string = $.trim($(this).val());
        var finalstring = string.replace(/\s+/g, " ");
        $(this).val(finalstring);
    });
    $('#remarks').blur(function () {
        var string = $.trim($(this).val());
        var finalstring = string.replace(/\s+/g, " ");
        $(this).val(finalstring);
    });
    /*****************************************For Premium Calculation************************************************/
    $('#inceptiongrosspremium').blur(function (ev) {
        var num = $('#inceptiongrosspremium').val();
        var numInt = isNaN($('#inceptiongrosspremium').val());
        if (num) {
            if (numInt == false) {
                var val = parseFloat(num).toFixed(2);
                $('#inceptiongrosspremium').val(val);
            }
        }
    });
    $('#comissionpercentage').blur(function (ev) {
        var num = $('#comissionpercentage').val();
        var numInt = isNaN($('#comissionpercentage').val());
        if (num) {
            if (numInt == false) {
                var val = parseFloat(num).toFixed(2);
                $('#comissionpercentage').val(val);
            }
        }
    });

    $('#inceptiongrosspremium').keyup(function (ev) {
        $('#comissiondoller').val("");
        $('#netpremium').val("");
        var commisionPercentage = $('#comissionpercentage').val();
        var inceptionGrossPremium = $('#inceptiongrosspremium').val();
        if (commisionPercentage && inceptionGrossPremium) {
            var commisionDoller = (inceptionGrossPremium * commisionPercentage) / 100;
            var commD = parseFloat(commisionDoller).toFixed(2);
            var netPremium = inceptionGrossPremium - commisionDoller;
            var netP = parseFloat(netPremium).toFixed(2);
            $('#netpremium').val(netP);
            $('#comissiondoller').val(commD);
        }
    });

    $('#comissionpercentage').keyup(function (ev) {
        $('#comissiondoller').val("");
        $('#netpremium').val("");
        var commisionPercentage = $('#comissionpercentage').val();
        var inceptionGrossPremium = $('#inceptiongrosspremium').val();
        if (commisionPercentage && inceptionGrossPremium) {
            var commisionDoller = (inceptionGrossPremium * commisionPercentage) / 100;
            var commD = parseFloat(commisionDoller).toFixed(2);
            var netPremium = inceptionGrossPremium - commisionDoller;
            var netP = parseFloat(netPremium).toFixed(2);
            $('#netpremium').val(netP);
            $('#comissiondoller').val(commD);
        }
    });
    /*****************************************For Effective and Expiry Date************************************************/
    $('#policyEffectiveDate').datepicker({
        //minDate: new Date(2012, 12, 01),
        //maxDate: "+364D",
        showTime: true,
        dateFormat: 'mm/dd/yy',
        onClose: function (selectedDate) {
            if (selectedDate) {
                var today = new Date();
                var currentDateArr = selectedDate.split('/');
                var alertDate = new Date();
                alertDate.setDate(today.getDate() + 120);
                var maxDate = new Date(currentDateArr[2], currentDateArr[0] - 1, currentDateArr[1]);
                var newSelectedDate = new Date(currentDateArr[2], currentDateArr[0] - 1, currentDateArr[1]);
                var newSelected;
                if (newSelectedDate.getDate() == '31' || newSelectedDate.getDate() == '30') {
                    newSelected = ('0' + (newSelectedDate.getMonth() + 1)).slice(-2) + "/" + ('0' + (newSelectedDate.getDate())).slice(-2) + "/" + newSelectedDate.getFullYear();
                } else {
                    newSelected = ('0' + (newSelectedDate.getMonth() + 1)).slice(-2) + "/" + ('0' + (newSelectedDate.getDate() + 1)).slice(-2) + "/" + newSelectedDate.getFullYear();
                }
                if (maxDate > alertDate) {
                    var didConfirm = confirm("The effective date for this submission is more than 120 days in advance.Are you sure you want to reserve the submission?");
                    if (didConfirm == true) {
                        $('#dateAlert').addClass('display-none');
                    } else {
                        $('#dateAlert').removeClass('display-none');
                        $('#policyEffectiveDate').val("");
                        $('#policyExpiryDate').val("");
                        return false;
                    }

                } else {
                    $('#dateAlert').addClass('display-none');
                }
                var maxYear = maxDate.getFullYear() + 1;
                maxDate.setFullYear(maxYear);
                maxDate.setDate(maxDate.getDate());
                $('#policyExpiryDate').datepicker();
                $('#policyExpiryDate').datepicker('option', 'minDate', newSelected);
                $("#policyExpiryDate").val(('0' + (maxDate.getMonth() + 1)).slice(-2) + "/" + ('0' + maxDate.getDate()).slice(-2) + "/" + maxDate.getFullYear());
            }
        },
        onSelect: function () {
            $(this).valid();
            $("#policyExpiryDate").valid();
        }
    });

    $('#policyExpiryDate').datepicker({
        showTime: true,
        //minDate: 0,
        dateFormat: 'mm/dd/yy',
        onSelect: function () {
            $(this).valid();
        }
    });
    $('#policySubmit').click(function () {
        if ($('select, input').hasClass('error')) {
            $('.btn-warning').show();
        } else {
            $('.btn-warning').hide();
        }
        return true;
    });
    /*****************************************For Add Custom Method************************************************/
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
    /*****************************************For Form Validation************************************************/
    $('#policyNumberAddForm').validate({
        rules: {//^[A-Za-z0-9_@./#!$%^&*();,{}:|&+-]*$'
            insuredName: {required: true, regex: '^[A-Za-z0-9_@./#!$%^&*();,{}:|&+-]+( [A-Za-z0-9_@./#!$%^&*();,{}:|&+-]+)*$'},
            producttype: {required: true, checkName: $('#producttype').val()},
            underwriter: {required: true, checkName: $('#underwriter').val()},
            region: {required: true, checkName: $('#region').val()},
            branchOffice: {required: true, checkName: $('#branchOffice').val()},
            //reinsuranceCompany: {required: true, regex: '^[ A-Za-z0-9_@./#!$%^&*();,{}:|&+-]*$'},
            riskTerritory: {required: true, checkName: $('#riskTerritory').val()},
            //directassumed: {required: true, checkName: $('#directassumed').val()},
            //admittedNonAdmitted: {required: true, checkName: $('#admittedNonAdmitted').val()},
            //admittedDetails: {required: true, checkName: $('#admittedDetails').val()},
            compnay: {required: true, checkName: $('#compnay').val()},
            prefix: {required: true, checkName: $('#prefix').val()},
            newRenewal: {required: true, checkName: $('#newRenewal').val()},
            policyEffectiveDate: {required: true},
            premiumcurrency: {required: true, checkName: $('#premiumcurrency').val()},
            inceptiongrosspremium: {regex: '^[0-9]*\.?[0-9]{1,30}$', required: true},
            comissionpercentage: {regex: '^[0-9]*\.?[0-9]{1,30}$', required: true, min: 0, max: 100}
        },
        messages: {
            insuredName: '<br />Please enter a valid value of Insured Name',
            producttype: '<br />Please select a valid value of Product Line',
            underwriter: '<br />Please select a valid value of Underwriter',
            region: '<br />Please select a valid value of Region',
            branchOffice: '<br />Please select a valid value of Branch Office',
            //reinsuranceCompany: '<br />Please enter a valid value of Reinsurence Company',
            riskTerritory: '<br />Please select a valid value of Risk Territory',
            //directassumed: '<br />Please select a valid value of Direct/Assumed',
            //admittedNonAdmitted: '<br />Please select a valid value of Admitted/Non-Admitted',
            //admittedDetails: '<br />Please select a valid value of Admitted Details',
            compnay: '<br />Please select a valid value of Company',
            prefix: '<br />Please select a valid value of Prefix',
            newRenewal: '<br />Please select a valid value of New/Renewal',
            policyEffectiveDate: '<br />Please enter a valid value of Policy Effective Date',
            premiumcurrency: '<br />Please select a valid value of Premium Currency',
            inceptiongrosspremium: '<br />Please enter a valid value of Inception Gross Premium',
            comissionpercentage: '<br />Please enter a valid value of Commisssion %'
        },
        highlight: function (element) {
            $(element).addClass('error');
        },
        unhighlight: function (element) {
            $(element).removeClass('error');
        }
    });
    /*****************************************For Admitted Region************************************************/
    $('#region').change(function (ev) {
        var val = $(this).val();
        $('#branchOffice').html('<option value="0">--Select--</option>');
        $('#producttype').html('<option value="0">--Select--</option>');
        $('#productsubtype').html('<option value="0">--Select--</option>');
        $('#underwriter').html('<option value="0">--Select--</option>');
        $('#prefix').html('<option value="0">--Select--</option>');
        if (val == '0') {
            return false;
        }
        var dataObj = {
            'header': {
                'requestName': 'getBranchOffice'
            },
            'body': {
                'data': val
            }
        };
        $.ajax('/policy/getBranchOffice', {
            'dataType': 'json',
            'data': JSON.stringify(dataObj),
            'type': 'post',
            'success': function (data, status, xhr) {
                var options = createSelectBoxBranch(data.BranchOffice);
                var options1 = createSelectBoxProductLine(data.ProductLine);
                var options2 = createSelectBoxUnderwriter(data.Underwriter);
                if (data.BranchOffice) {
                    $('#branchOffice').html(options);
                } else {
                    $('#branchOffice').html('<option value="NA">Not Applicable</option>');
                }
                if (data.ProductLine) {
                    $('#producttype').html(options1);
                } else {
                    $('#producttype').html('<option value="NA">Not Applicable</option>');
                }
                if (data.Underwriter) {
                    $('#underwriter').html(options2);
                } else {
                    $('#underwriter').html('<option value="NA">Not Applicable</option>');
                }
            }
        });
    });

    var createSelectBoxBranch = function (data) {
        var selectBox = '<option value="0">--Select--</option>';
        for (var i = 0; i < data.length; i += 1) {
            selectBox += '<option value="' + data[i].Id + '">' + data[i].BranchName + '</option>';
        }
        return selectBox;
    };
    var createSelectBoxProductLine = function (data) {
        var selectBox = '<option value="0">--Select--</option>';
        for (var i = 0; i < data.length; i += 1) {
            selectBox += '<option value="' + data[i].Id + '">' + data[i].ProductLine + '</option>';
        }
        return selectBox;
    };
    var createSelectBoxUnderwriter = function (data) {
        var selectBox = '<option value="0">--Select--</option>';
        for (var i = 0; i < data.length; i += 1) {
            selectBox += '<option value="' + data[i].Id + '">' + data[i].UnderwriterName + '</option>';
        }
        return selectBox;
    };
    /***********************************For Admitted Details****************************************************/
    $('#admittedNonAdmitted').change(function (ev) {
        var val = $(this).val();
        $('#admittedDetails').html('<option value="0">--Select--</option>');
        if (val == '0') {
            return false;
        }
        var dataObj = {
            'header': {
                'requestName': 'getAdmittedDetails'
            },
            'body': {
                'data': val
            }
        };
        $.ajax('/policy/getAdmittedDetails', {
            'dataType': 'json',
            'data': JSON.stringify(dataObj),
            'type': 'post',
            'success': function (data, status, xhr) {
                var options = createSelectBoxAdmittedDetails(data);
                if (data.length) {
                    $('#admittedDetails').html(options);
                } else {
                    $('#admittedDetails').html('<option value="NA">Not Applicable</option>');
                }
            }
        });
    });

    var createSelectBoxAdmittedDetails = function (data) {
        var selectBox = '<option value="0">--Select--</option>';
        for (var i = 0; i < data.length; i += 1) {
            selectBox += '<option value="' + data[i].Id + '">' + data[i].Name + '</option>';
        }
        return selectBox;
    };
    /***************************************For ProductLineSubType************************************************/
    $('#producttype').change(function (ev) {
        var val = $(this).val();
        $('#productsubtype').html('<option value="0">--Select--</option>');
        $('#prefix').html('<option value="0">--Select--</option>');
        if (val == '0') {
            return false;
        }
        var dataObj = {
            'header': {
                'requestName': 'GetProductLineSubType'
            },
            'body': {
                'data': val
            }
        };
        $.ajax('/policy/GetProductLineSubType', {
            'dataType': 'json',
            'data': JSON.stringify(dataObj),
            'type': 'post',
            'success': function (data, status, xhr) {
                var options = createSelectBoxProductLineSubType(data);
                if (data.length) {
                    $('#productsubtype').html(options);
                } else {
                    $('#productsubtype').html('<option value="NA">Not Applicable</option>');
                }
            }
        });
    });

    var createSelectBoxProductLineSubType = function (data) {
        var selectBox = '<option value="0">--Select--</option>';
        for (var i = 0; i < data.length; i += 1) {
            selectBox += '<option value="' + data[i].Id + '">' + data[i].ProductLineSubTypeName + '</option>';
        }
        return selectBox;
    };
    /***************************************For Prefix************************************************/
    $('#productsubtype').change(function (ev) {
        var val = $(this).val();
        var regionval = $('#region').val();
        $('#prefix').html('<option value="0">--Select--</option>');
        if (val == '0') {
            return false;
        }
        var dataObj = {
            'header': {
                'requestName': 'GetPrefix'
            },
            'body': {
                'data': val,
                'region': regionval
            }
        };
        $.ajax('/policy/GetPrefix', {
            'dataType': 'json',
            'data': JSON.stringify(dataObj),
            'type': 'post',
            'success': function (data, status, xhr) {
                var options = createSelectBoxPrefix(data);
                if (data) {
                    $('#prefix').html(options);
                } else {
                    $('#prefix').html('<option value="NA">Not Applicable</option>');
                }
            }
        });
    });

    var createSelectBoxPrefix = function (data) {
        var selectBox = '<option value="0">--Select--</option>';
        for (var i = 0; i < data.length; i += 1) {
            selectBox += '<option value="' + data[i].Id + '">' + data[i].Name + '</option>';
        }
        return selectBox;
    };
    /****************************************************************************************************/
    $('#compnay').change(function (ev) {
        var val = $(this).val();
        $('#compnaynumber').val("");
        if (val == '0') {
            return false;
        }
        var dataObj = {
            'header': {
                'requestName': 'getCompanyNumber'
            },
            'body': {
                'data': val
            }
        };
        $.ajax('/policy/getCompanyNumber', {
            'dataType': 'json',
            'data': JSON.stringify(dataObj),
            'type': 'post',
            'success': function (data, status, xhr) {
                $('#compnaynumber').val(data[0].CompanyNumber);
            }
        });
    });

});


