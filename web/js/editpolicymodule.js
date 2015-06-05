$(document).ready(function (e) {
    $.validator.setDefaults({
        ignore: []
    });
    $('#editinsuredName').blur(function () {
        $(this).val($.trim($(this).val()));
    });
    $('#editreinsuranceCompany').blur(function () {
        var string = $.trim($(this).val());
        var finalstring = string.replace(/\s+/g, " ");
        $(this).val(finalstring);
    });
    $('#editremarks').blur(function () {
        var string = $.trim($(this).val());
        var finalstring = string.replace(/\s+/g, " ");
        $(this).val(finalstring);
    });
    /*****************************************For Admitted Region************************************************/
    $('#editregion').change(function (ev) {
        var val = $(this).val();
        $('#editbranchOffice').html('<option value="0">--Select--</option>');
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
                if (data) {
                    $('#editbranchOffice').html(options);
                    if ($('#hiddenBranchId').length) {
                        var selectedBranchOffice = $('#hiddenBranchId').val();
                        $('#editbranchOffice').val(selectedBranchOffice);
                        $('#editbranchOffice').trigger('change');
                        $('#hiddenBranchId').remove();
                    }
                } else {
                    $('#editbranchOffice').html('<option value="NA">Not Applicable</option>');
                }
            }
        });
    }).trigger('change');

    var createSelectBoxBranch = function (data) {
        var selectBox = '<option value="0">--Select--</option>';
        for (var i = 0; i < data.length; i += 1) {
            selectBox += '<option value="' + data[i].Id + '">' + data[i].BranchName + '</option>';
        }
        return selectBox;
    };
    /***********************************For Admitted Details****************************************************/
    $('#editadmittedNonAdmitted').change(function (ev) {
        var val = $(this).val();
        $('#editadmittedDetails').html('<option value="0">--Select--</option>');
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
                    $('#editadmittedDetails').html(options);
                    if ($('#hiddenAdmittedDetailsId').length) {
                        var selectedAdmittedDetails = $('#hiddenAdmittedDetailsId').val();
                        $('#editadmittedDetails').val(selectedAdmittedDetails);
                        $('#editadmittedDetails').trigger('change');
                        $('#hiddenAdmittedDetailsId').remove();
                    }
                } else {
                    $('#editadmittedDetails').html('<option value="NA">Not Applicable</option>');
                }
            }
        });
    }).trigger('change');

    var createSelectBoxAdmittedDetails = function (data) {
        var selectBox = '<option value="0">--Select--</option>';
        for (var i = 0; i < data.length; i += 1) {
            selectBox += '<option value="' + data[i].Id + '">' + data[i].Name + '</option>';
        }
        return selectBox;
    };
    /*****************************************For Premium Calculation************************************************/
    $('#editinceptiongrosspremium').blur(function (ev) {
        var num = $('#editinceptiongrosspremium').val();
        var numInt = isNaN($('#editinceptiongrosspremium').val());
        if (num) {
            if (numInt == false) {
                var val = parseFloat(num).toFixed(2);
                $('#editinceptiongrosspremium').val(val);
            }
        }
    });
    $('#editcomissionpercentage').blur(function (ev) {
        var num = $('#editcomissionpercentage').val();
        var numInt = isNaN($('#editcomissionpercentage').val());
        if (num) {
            if (numInt == false) {
                var val = parseFloat(num).toFixed(2);
                $('#editcomissionpercentage').val(val);
            }
        }
    });

    $('#editinceptiongrosspremium').keyup(function (ev) {
        $('#editcomissiondoller').val("");
        $('#editnetpremium').val("");
        var commisionPercentage = $('#editcomissionpercentage').val();
        var inceptionGrossPremium = $('#editinceptiongrosspremium').val();
        if (commisionPercentage && inceptionGrossPremium) {
            var commisionDoller = (inceptionGrossPremium * commisionPercentage) / 100;
            var commD = parseFloat(commisionDoller).toFixed(2);
            var netPremium = inceptionGrossPremium - commisionDoller;
            var netP = parseFloat(netPremium).toFixed(2);
            $('#editnetpremium').val(netP);
            $('#editcomissiondoller').val(commD);
        }
    });

    $('#editcomissionpercentage').keyup(function (ev) {
        $('#editcomissiondoller').val("");
        $('#editnetpremium').val("");
        var commisionPercentage = $('#editcomissionpercentage').val();
        var inceptionGrossPremium = $('#editinceptiongrosspremium').val();
        if (commisionPercentage && inceptionGrossPremium) {
            var commisionDoller = (inceptionGrossPremium * commisionPercentage) / 100;
            var commD = parseFloat(commisionDoller).toFixed(2);
            var netPremium = inceptionGrossPremium - commisionDoller;
            var netP = parseFloat(netPremium).toFixed(2);
            $('#editnetpremium').val(netP);
            $('#editcomissiondoller').val(commD);
        }
    });
    /*****************************************For Effective and Expiry Date************************************************/
    var effectiveDate = $('#editpolicyEffectiveDate').val();
    var expiryDate = $('#editpolicyExpiryDate').val();
    $('#editpolicyEffectiveDate').datepicker({
        //minDate: new Date(2012, 12, 01),
        //maxDate: "+364D",
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
                        $('#editpolicyEffectiveDate').val(effectiveDate);
                        $("#editpolicyExpiryDate").val(expiryDate);
                        return false;
                    }
                } else {
                    $('#dateAlert').addClass('display-none');
                }
                var maxYear = maxDate.getFullYear() + 1;
                maxDate.setFullYear(maxYear);
                maxDate.setDate(maxDate.getDate());
                $('#editpolicyExpiryDate').datepicker();
                $('#editpolicyExpiryDate').datepicker('option', 'minDate', newSelected);
                $("#editpolicyExpiryDate").val(('0' + (maxDate.getMonth() + 1)).slice(-2) + "/" + ('0' + maxDate.getDate()).slice(-2) + "/" + maxDate.getFullYear());
            }
        }
    });
    $('#editpolicyExpiryDate').datepicker({
        showTime: true,
        //minDate: new Date(2012, 12, 01),
        dateFormat: 'mm/dd/yy',
        onSelect: function () {
            $(this).valid();
        }
    });
    
    $('#editpolicySubmit').click(function () {
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
    $('#editpolicyNumberAddForm').validate({
        rules: {
            editinsuredName: {required: true, regex: '^[A-Za-z0-9_@./#!$%^&*();,{}:|&+-]+( [A-Za-z0-9_@./#!$%^&*();,{}:|&+-]+)*$'},
            editproducttype: {required: true, checkName: $('#editproducttype').val()},
            editunderwriter: {required: true, checkName: $('#editunderwriter').val()},
            editregion: {required: true, checkName: $('#editregion').val()},
            editbranchOffice: {required: true, checkName: $('#editbranchOffice').val()},
            editriskTerritory: {required: true, checkName: $('#editriskTerritory').val()},
            //editdirectassumed: {required: true, checkName: $('#editdirectassumed').val()},
            //editadmittedNonAdmitted: {required: true, checkName: $('#editadmittedNonAdmitted').val()},
            //editadmittedDetails: {required: true, checkName: $('#editadmittedDetails').val()},
            editcompnay: {required: true, checkName: $('#editcompnay').val()},
            editprefix: {required: true, checkName: $('#editprefix').val()},
            editnewRenewal: {required: true, checkName: $('#editnewRenewal').val()},
            editpolicyEffectiveDate: {required: true},
            editpolicyExpiryDate: {required: true},
            editpremiumcurrency: {required: true, checkName: $('#editpremiumcurrency').val()},
            editinceptiongrosspremium: {required: true, regex: '^[0-9]*\.?[0-9]{1,30}$'},
            editcomissionpercentage: {required: true, regex: '^[0-9]*\.?[0-9]{1,30}$', min: 0, max: 100}
        },
        messages: {
            editinsuredName: '<br />Please enter a valid value of Insured Name',
            editproducttype: '<br />Please select a valid value of Product Line',
            editunderwriter: '<br />Please select a valid value of Underwriter',
            editregion: '<br />Please select a valid value of Region',
            editbranchOffice: '<br />Please select a valid value of Branch Office',
            editriskTerritory: '<br />Please select a valid value of Risk Territory',
            //editdirectassumed: '<br />Please select a valid value of Direct/Assumed',
            //editadmittedNonAdmitted: '<br />Please select a valid value of Admitted/Non-Admitted',
            //editadmittedDetails: '<br />Please select a valid value of Admitted Details',
            editcompnay: '<br />Please select a valid value of Company',
            editprefix: '<br />Please select a valid value of Prefix',
            editnewRenewal: '<br />Please select a valid value of New/Renewal',
            editpolicyEffectiveDate: '<br />Please enter a valid value of Policy Effective Date',
            editpolicyExpiryDate: '<br />Please enter a valid value of Policy Expiry Date',
            editpremiumcurrency:'<br />Please select a valid value of Premium Currency',
            editinceptiongrosspremium: '<br />Please enter a valid value of Inception Gross Premium',
            editcomissionpercentage: '<br />Please enter a valid value of Commisssion %'
        },
        highlight: function (element) {
            $(element).addClass('error');
        },
        unhighlight: function (element) {
            $(element).removeClass('error');
        }
    });
    /***************************************For Suffix************************************************/
    $('#editcompnay').change(function (ev) {
        var val = $(this).val();
        $('#editcompnaynumber').val("");
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
                $('#editcompnaynumber').val(data[0].CompanyNumber);
            }
        });
    });
    /****************************************************************************************************/
});


