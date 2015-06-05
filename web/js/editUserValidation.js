$(document).ready(function () {
    $.validator.setDefaults({
        ignore: []
    });

    $('#insuredSubmit').click(function () {
        if ($('select, input').hasClass('error')) {
            $('.btn-warning').show();
            return false;
        } else {
            $('.btn-warning').hide();
            return true;
        }

    });

    $('#editFormSubmit').click(function () {
        if ($('select, input').hasClass('error')) {
            $('.btn-warning').show();
            return false;
        } else {
            $('.btn-warning').hide();
            return true;
        }

    });
    $('#insuredname').blur(function () {
        var str = $(this).val();
        var string = $.trim(str);
        var finalstring = string.replace(/\s+/g, " ");
        $(this).val(finalstring);
    });
    $('#insuredaddress').blur(function () {
        var str = $(this).val();
        var string = $.trim(str);
        var finalstring = string.replace(/\s+/g, " ");
        $(this).val(finalstring);
    });
    $('#insuredcountry').blur(function () {
        var str = $(this).val();
        var string = $.trim(str);
        var finalstring = string.replace(/\s+/g, " ");
        $(this).val(finalstring);
    });
    $('#insuredstate').blur(function () {
        var str = $(this).val();
        var string = $.trim(str);
        var finalstring = string.replace(/\s+/g, " ");
        $(this).val(finalstring);
    });
    $('#insuredcity').blur(function () {
        var str = $(this).val();
        var string = $.trim(str);
        var finalstring = string.replace(/\s+/g, " ");
        $(this).val(finalstring);
    });
    $('#insuredzipcode').blur(function () {
        $(this).val($.trim($(this).val()));
    });
    $('#editinsuredname').blur(function () {
        var str = $(this).val();
        var string = $.trim(str);
        var finalstring = string.replace(/\s+/g, " ");
        $(this).val(finalstring);
    });
    $('#editinsuredaddress').blur(function () {
        var str = $(this).val();
        var string = $.trim(str);
        var finalstring = string.replace(/\s+/g, " ");
        $(this).val(finalstring);
    });
    $('#editinsuredcountry').blur(function () {
        var str = $(this).val();
        var string = $.trim(str);
        var finalstring = string.replace(/\s+/g, " ");
        $(this).val(finalstring);
    });
    $('#editinsuredstate').blur(function () {
        var str = $(this).val();
        var string = $.trim(str);
        var finalstring = string.replace(/\s+/g, " ");
        $(this).val(finalstring);
    });
    $('#editinsuredcity').blur(function () {
        var str = $(this).val();
        var string = $.trim(str);
        var finalstring = string.replace(/\s+/g, " ");
        $(this).val(finalstring);
    });
    $('#editinsuredzipcode').blur(function () {
        $(this).val($.trim($(this).val()));
    });
    $('#firstname').blur(function () {
        $(this).val($.trim($(this).val()));
    });
    $('#lastname').blur(function () {
        $(this).val($.trim($(this).val()));
    });
    $('#email').blur(function () {
        $(this).val($.trim($(this).val()));
    });
    $('#brokername').blur(function () {
        $(this).val($.trim($(this).val()));
    });
    $('#addressline1').blur(function () {
        $(this).val($.trim($(this).val()));
    });
    $('#addressline2').blur(function () {
        $(this).val($.trim($(this).val()));
    });
    $('#addressline2').blur(function () {
        $(this).val($.trim($(this).val()));
    });
    $('#brokerzipcode').keyup(function () {
        var str = $(this).val();
        str = str.replace(/\s/g, '');
        $(this).val($.trim(str));
    });
    $('#editaddressline1').blur(function () {
        $(this).val($.trim($(this).val()));
    });
    $('#editaddressline2').blur(function () {
        $(this).val($.trim($(this).val()));
    });
    $('#editbrokerzipcode').keyup(function () {
        var str = $(this).val();
        str = str.replace(/\s/g, '');
        $(this).val($.trim(str));
    });
    $('#firstname').keyup(function () {
        var str = $(this).val();
        str = str.replace(/\s/g, '');
        $(this).val($.trim(str));
    });
    $('#lastname').keyup(function () {
        var str = $(this).val();
        str = str.replace(/\s/g, '');
        $(this).val($.trim(str));
    });
    $('#editfirstname').keyup(function () {
        var str = $(this).val();
        str = str.replace(/\s/g, '');
        $(this).val($.trim(str));
    });
    $('#editlastname').keyup(function () {
        var str = $(this).val();
        str = str.replace(/\s/g, '');
        $(this).val($.trim(str));
    });

    $('#dbNumber').val('Not Available');
    $('#dbNumber').focus(function (ev) {
        if ($(this).val() == 'Not Available') {
            $(this).val('');
        }
    });
    $('#dbNumber').blur(function (ev) {
        if ($(this).val() == '') {
            $(this).val('Not Available');
            $(this).removeClass('error');
            $('label[for=dbNumber]').css('display', 'none');
        }
    });

    $('#editdbNumber').val('Not Available');
    $('#editdbNumber').focus(function (ev) {
        if ($(this).val() == 'Not Available') {
            $(this).val('');
        }
    });
    $('#editdbNumber').blur(function (ev) {
        if ($(this).val() == '') {
            $(this).val('Not Available');
            $(this).removeClass('error');
            $('label[for=editdbNumber]').css('display', 'none');
        }
    });
    $('#gupadvisenid').keyup(function () {
        var str = $(this).val();
        var string = $.trim(str);
        var finalstring = string.replace('-', "");
        $(this).val(finalstring);
    });
    $('#gupname').blur(function () {
        var str = $(this).val();
        var string = $.trim(str);
        var finalstring = string.replace(/\s+/g, " ");
        $(this).val(finalstring);
    });
    $('#gupaddressline1').blur(function () {
        var str = $(this).val();
        var string = $.trim(str);
        var finalstring = string.replace(/\s+/g, " ");
        $(this).val(finalstring);
    });
    $('#gupzipcode').keyup(function () {
        $(this).val($.trim($(this).val()));
    });
    $('#gupphonenumber').keyup(function () {
        $(this).val($.trim($(this).val()));
    });

    $('#editgupadvisenid').keyup(function () {
        var str = $(this).val();
        var string = $.trim(str);
        var finalstring = string.replace('-', "");
        $(this).val(finalstring);
    });
    $('#editgupname').blur(function () {
        var str = $(this).val();
        var string = $.trim(str);
        var finalstring = string.replace(/\s+/g, " ");
        $(this).val(finalstring);
    });
    $('#editgupaddressline1').blur(function () {
        var str = $(this).val();
        var string = $.trim(str);
        var finalstring = string.replace(/\s+/g, " ");
        $(this).val(finalstring);
    });
    $('#editgupzipcode').keyup(function () {
        $(this).val($.trim($(this).val()));
    });
    $('#editgupphonenumber').keyup(function () {
        $(this).val($.trim($(this).val()));
    });


    $.validator.addMethod("numericwithhypen", function (value, element) {
        return this.optional(element) || /^[0-9]+(-[0-9]+)*$/.test(value);
    }, "Only Number and Hyphen  Allowed.");

    $.validator.addMethod("alphanumericwithhypen", function (value, element) {
        return this.optional(element) || /^[a-zA-Z0-9]+(-[a-zA-Z0-9]+)*$/.test(value);
    }, "Only Number and Hyphen  Allowed.");

    $.validator.addMethod("alpha", function (value, element) {
        return this.optional(element) || value == value.match(/^[a-zA-Z]+$/);
    }, "Only Characters Allowed.");

    $("#editUserForm").validate({
        rules: {
            firstname: {
                required: true,
                alpha: true
            },
            email: {
                required: true,
                email: true
            }
        },
        errorElement: 'div',
        wrapper: 'div',
        errorPlacement: function (error, element) {
            error.insertAfter(element); // default function
        },
        // Specify the validation error messages
        messages: {
            firstname: {
                required: "Please enter first name",
                alpha: "First name should only have alphabets"
            },
            email: {
                required: "Please enter email",
                email: "Please enter email in correct format"
            },
            agree: "Please accept our policy"
        }
    });

    $('#insuredSubmit').click(function () {
        if ($('#insuredAddForm').valid()) {
            return true;
        }
    });

    $.validator.addMethod("checkName", function (value, element, params) {
        var x = value;
        if (x == 0) {
            return false;
        } else {
            return true;
        }
    });
    $.validator.addMethod("regex1", function (value, element) {
        return this.optional(element) || /^([0-9]{2,5}||[0-9,-]{2,10})$/.test(value);
    }, "Please enter valid us zip code");

    $.validator.addMethod("regex2", function (value, element) {
        return this.optional(element) || /^([0-9A-Za-z,-]{2,10})$/.test(value);
    }, "Please enter valid zip code");
    $.validator.addMethod("DBNumber", function (value, element) {
        return this.optional(element) || /^([Not Available]{13}|[0-9]{9})$/.test(value);
    }, "Please enter valid zip code");

    /*Insured Add Form Validation Start*/
    $('#insuredcountry').blur(function () {
        var val = $('#insuredcountry').val();
        if (val == '001 - USA') {
            $('#insuredAddForm').removeData('validator').validate({
                rules: {
                    insuredname: {required: true},
                    insuredaddress: {required: true},
                    insuredcountry: {required: true},
                    insuredstate: {required: true},
                    insuredcity: {required: true},
                    insuredzipcode: {regex1: true},
                    dbNumber: {required: true,
                        DBNumber: true
                    },
                    advisenId: {number: true},
                    gupadvisenid: {number: true, maxlength: 10},
                    gupzipcode: {alphanumericwithhypen: true},
                    gupphonenumber: {numericwithhypen: true}
                },
                messages: {
                    insuredname: '<br />Please enter a valid value of Insured name',
                    insuredaddress: '<br />Please enter a valid value of Addressline1',
                    insuredcountry: {required: '<br />Please enter a valid value of country', checkName: '<br />Please enter a valid value of country'},
                    insuredstate: {required: '<br />Please enter a valid value of state', checkName: '<br />Please enter a valid value of state'},
                    insuredcity: {required: '<br />Please enter a valid value of city', checkName: '<br />Please enter a valid value of city'},
                    dbNumber: {required: '<br />Please enter a valid value of D&B Number', DBNumber: '<br />Please enter a valid value of D&B Number'},
                    advisenId: '<br />Please enter a valid value of Advisen Id',
                    gupadvisenid: '<br />Please enter a valid value of GUP Advisen ID',
                    gupzipcode: '<br />Please enter a valid value of GUP Zipcode',
                    gupphonenumber: '<br />Please enter a valid value of GUP Phone Number'
                }
            });
        } else {
            $('#insuredAddForm').removeData('validator').validate({
                rules: {
                    insuredname: {required: true},
                    insuredaddress: {required: true},
                    insuredcountry: {required: true},
                    insuredstate: {required: true},
                    insuredcity: {required: true},
                    insuredzipcode: {regex2: true},
                    dbNumber: {required: true,
                        DBNumber: true
                    },
                    advisenId: {number: true},
                    gupadvisenid: {number: true, maxlength: 10},
                    gupzipcode: {alphanumericwithhypen: true},
                    gupphonenumber: {numericwithhypen: true}
                },
                messages: {
                    insuredname: '<br />Please enter a valid value of Insured name',
                    insuredaddress: '<br />Please enter a valid value of Addressline1',
                    insuredcountry: {required: '<br />Please enter a valid value of country', checkName: '<br />Please enter a valid value of country'},
                    insuredstate: {required: '<br />Please enter a valid value of state', checkName: '<br />Please enter a valid value of state'},
                    insuredcity: {required: '<br />Please enter a valid value of city', checkName: '<br />Please enter a valid value of city'},
                    dbNumber: {required: '<br />Please enter a valid value of D&B Number', DBNumber: '<br />Please enter a valid value of D&B Number'},
                    advisenId: '<br />Please enter a valid value of Advisen Id',
                    gupadvisenid: '<br />Please enter a valid value of GUP Advisen ID',
                    gupzipcode: '<br />Please enter a valid GUP value of Zipcode',
                    gupphonenumber: '<br />Please enter a valid value of GUP Phone Number'
                }
            });
        }
    });

    $('#insuredAddForm').removeData('validator').validate({
        rules: {
            insuredname: {required: true},
            insuredaddress: {required: true},
            insuredcountry: {required: true},
            insuredstate: {required: true},
            insuredcity: {required: true},
            dbNumber: {required: true,
                DBNumber: true
            },
            advisenId: {number: true},
            gupadvisenid: {number: true, maxlength: 10},
            gupzipcode: {alphanumericwithhypen: true},
            gupphonenumber: {numericwithhypen: true}
        },
        messages: {
            insuredname: '<br />Please enter a valid value of Insured name',
            insuredaddress: '<br />Please enter a valid value of Addressline1',
            insuredcountry: {required: '<br />Please enter a valid value of country'},
            insuredstate: {required: '<br />Please enter a valid value of state'},
            insuredcity: {required: '<br />Please enter a valid value of city'},
            dbNumber: {required: '<br />Please enter a valid value of D&B Number', DBNumber: '<br />Please enter a valid value of D&B Number'},
            advisenId: '<br />Please enter a valid value of Advisen Id',
            gupadvisenid: '<br />Please enter a valid value of GUP Advisen ID',
            gupzipcode: '<br />Please enter a valid value of GUP Zipcode',
            gupphonenumber: '<br />Please enter a valid value of GUP Phone Number'
        },
        highlight: function (element) {
            $(element).addClass('error');
        },
        unhighlight: function (element) {
            $(element).removeClass('error');
        }
    });

    $('#insuredAddForm').each(function () {
        this.reset();
    });
    /*Insured Add Form Validation End*/
    /*Insured Edit Form Validation Start*/
    $('#editFormSubmit').click(function () {
        if ($('#insuredEditForm').valid()) {
            return true;
        }
    });
    $('#editinsuredcountry').blur(function () {
        var val = $('#editinsuredcountry').val();
        if (val == '001 - USA') {
            $('#insuredEditForm').removeData('validator').validate({
                rules: {
                    editinsuredname: {required: true},
                    editinsuredaddress: {required: true},
                    editinsuredcountry: {required: true},
                    editinsuredstate: {required: true},
                    editinsuredcity: {required: true},
                    editinsuredzipcode: {regex1: true},
                    editdbNumber: {required: true,
                        DBNumber: true
                    },
                    editadvisenId: {number: true},
                    editgupadvisenid: {number: true, maxlength: 10},
                    editgupzipcode: {alphanumericwithhypen: true},
                    editgupphonenumber: {numericwithhypen: true}
                },
                messages: {
                    editinsuredname: '<br />Please enter a valid value of Insured name',
                    editinsuredaddress: '<br />Please enter a valid value of Addressline1',
                    editinsuredcountry: {required: '<br />Please enter a valid value of country'},
                    editinsuredstate: {required: '<br />Please enter a valid value of state'},
                    editinsuredcity: {required: '<br />Please enter a valid value of city'},
                    editdbNumber: {required: '<br />Please enter a valid value of D&B Number', DBNumber: '<br />Please enter a valid value of D&B Number'},
                    editadvisenId: '<br />Please enter a valid value of Advisen Id',
                    editgupadvisenid: '<br />Please enter a valid value of GUP Advisen ID',
                    editgupzipcode: '<br />Please enter a valid value of GUP Zipcode',
                    editgupphonenumber: '<br />Please enter a valid value of GUP Phone Number'
                }
            });
        } else {
            $('#insuredEditForm').removeData('validator').validate({
                rules: {
                    editinsuredname: {required: true},
                    editinsuredaddress: {required: true},
                    editinsuredcountry: {required: true},
                    editinsuredstate: {required: true},
                    editinsuredcity: {required: true},
                    editinsuredzipcode: {regex2: true},
                    editdbNumber: {required: true,
                        DBNumber: true
                    },
                    editadvisenId: {number: true},
                    editgupadvisenid: {number: true, maxlength: 10},
                    editgupzipcode: {alphanumericwithhypen: true},
                    editgupphonenumber: {numericwithhypen: true}
                },
                messages: {
                    editinsuredname: '<br />Please enter a valid value of Insured name',
                    editinsuredaddress: '<br />Please enter a valid value of Addressline1',
                    editinsuredcountry: {required: '<br />Please enter a valid value of country'},
                    editinsuredstate: {required: '<br />Please enter a valid value of state'},
                    editinsuredcity: {required: '<br />Please enter a valid value of city'},
                    editdbNumber: {required: '<br />Please enter a valid value of D&B Number', DBNumber: '<br />Please enter a valid value of D&B Number'},
                    editadvisenId: '<br />Please enter a valid value of Advisen Id',
                    editgupadvisenid: '<br />Please enter a valid value of GUP Advisen ID',
                    editgupzipcode: '<br />Please enter a valid value of GUP Zipcode',
                    editgupphonenumber: '<br />Please enter a valid value of GUP Phone Number'
                }
            });
        }
    });

    var val = $('#editinsuredcountry').val();
    if (val == '001 - USA') {
        $('#insuredEditForm').removeData('validator').validate({
            rules: {
                editinsuredname: {required: true},
                editinsuredaddress: {required: true},
                editinsuredcountry: {required: true},
                editinsuredstate: {required: true},
                editinsuredcity: {required: true},
                editinsuredzipcode: {regex1: true},
                editdbNumber: {required: true,
                    DBNumber: true
                },
                editadvisenId: {number: true},
                editgupadvisenid: {number: true, maxlength: 10},
                editgupzipcode: {alphanumericwithhypen: true},
                editgupphonenumber: {numericwithhypen: true}
            },
            messages: {
                editinsuredname: '<br />Please enter a valid value of Insured name',
                editinsuredaddress: '<br />Please enter a valid value of Addressline1',
                editinsuredcountry: {required: '<br />Please enter a valid value of country'},
                editinsuredstate: {required: '<br />Please enter a valid value of state'},
                editinsuredcity: {required: '<br />Please enter a valid value of city'},
                editdbNumber: {required: '<br />Please enter a valid value of D&B Number', DBNumber: '<br />Please enter a valid value of D&B Number'},
                editadvisenId: '<br />Please enter a valid value of Advisen Id',
                editgupadvisenid: '<br />Please enter a valid value of GUP Advisen ID',
                editgupzipcode: '<br />Please enter a valid value of GUP Zipcode',
                editgupphonenumber: '<br />Please enter a valid value of GUP Phone Number'
            }
        });
    } else {
        $('#insuredEditForm').removeData('validator').validate({
            rules: {
                editinsuredname: {required: true},
                editinsuredaddress: {required: true},
                editinsuredcountry: {required: true},
                editinsuredstate: {required: true},
                editinsuredcity: {required: true},
                editinsuredzipcode: {regex2: true},
                editdbNumber: {required: true,
                    DBNumber: true
                },
                editadvisenId: {number: true},
                editgupadvisenid: {number: true, maxlength: 10},
                editgupzipcode: {alphanumericwithhypen: true},
                editgupphonenumber: {numericwithhypen: true}
            },
            messages: {
                editinsuredname: '<br />Please enter a valid value of Insured name',
                editinsuredaddress: '<br />Please enter a valid value of Addressline1',
                editinsuredcountry: {required: '<br />Please enter a valid value of country'},
                editinsuredstate: {required: '<br />Please enter a valid value of state'},
                editinsuredcity: {required: '<br />Please enter a valid value of city'},
                editdbNumber: {required: '<br />Please enter a valid value of D&B Number', DBNumber: '<br />Please enter a valid value of D&B Number'},
                editadvisenId: '<br />Please enter a valid value of Advisen Id',
                editgupadvisenid: '<br />Please enter a valid value of GUP Advisen ID',
                editgupzipcode: '<br />Please enter a valid value of GUP Zipcode',
                editgupphonenumber: '<br />Please enter a valid value of GUP Phone Number'
            }
        });
    }
    $('#insuredEditForm ').each(function () {
        this.reset();
    });
    /*Insured Edit Form Validation End*/
    $('#brokercountry').change(function (ev) {
        var val = $(this).val();
        $('#brokerstate').html('<option value="0">--Select--</option>');
        $('#brokercity').html('<option value="0">--Select--</option>');
        if (val == '0') {
            return false;
        }
        var dataObj = {
            'header': {
                'requestName': 'getState'
            },
            'body': {
                'data': val
            }
        };
        $.ajax('/administration/getState', {
            'dataType': 'json',
            'data': JSON.stringify(dataObj),
            'type': 'post',
            'success': function (data, status, xhr) {
                var options = createSelectBoxState(data);
                if (data.length) {
                    $('#brokerstate').html(options);
                } else {
                    $('#brokerstate').html('<option value="0">--Select--</option>');
                    $('#brokercity').html('<option value="0">--Select--</option>');
                }
            }
        });
    });

    var createSelectBoxState = function (data) {
        var selectBox = '<option value="0">--Select--</option>';
        for (var i = 0; i < data.length; i += 1) {
            selectBox += '<option value="' + data[i].Id + '">' + data[i].StateName + '</option>';
        }
        return selectBox;
    };

    $('#brokerstate').change(function (ev) {
        var val = $(this).val();
        if (val == '0') {
            $('#brokercity').html('<option value="0">--Select--</option>');
            return false;
        }
        var dataObj = {
            'header': {
                'requestName': 'getCity'
            },
            'body': {
                'data': val
            }};
        $.ajax('/administration/getCity', {
            'dataType': 'json',
            'data': JSON.stringify(dataObj),
            'type': 'post',
            'success': function (data, status, xhr) {
                var options = createSelectBoxCity(data);
                if (data.length) {
                    $('#brokercity').html(options);
                } else {
                    $('#brokercity').html('<option value="0">--Select--</option>');
                }
            }
        });
    });

    var createSelectBoxCity = function (data) {
        var selectBox = '<option value="0">--Select--</option>';
        for (var i = 0; i < data.length; i += 1) {
            selectBox += '<option value="' + data[i].Id + '">' + data[i].City + '</option>';
        }
        return selectBox;
    };

    $('#editbrokercountry').change(function (ev) {
        var val = $(this).val();
        $('#editbrokerstate').html('<option value="0">--Select--</option>');
        $('#editbrokercity').html('<option value="0">--Select--</option>');
        if (val == '') {
            return false;
        }
        var dataObj = {
            'header': {
                'requestName': 'getState'
            },
            'body': {
                'data': val
            }
        };
        $.ajax('/administration/getState', {
            'dataType': 'json',
            'data': JSON.stringify(dataObj),
            'type': 'post',
            'success': function (data, status, xhr) {
                if (data.length) {
                    var options = createSelectBoxState(data);
                    $('#editbrokerstate').html(options);
                    if ($('#editStateHidden').length) {
                        var selectedState = $('#editStateHidden').val();
                        $('#editbrokerstate').val(selectedState);
                        $('#editbrokerstate').trigger('change');
                        $('#editStateHidden').remove();
                    }
                } else {
                    $('#editbrokerstate').html('<option value="0">--Select--</option>');
                    $('#editbrokercity').html('<option value="0">--Select--</option>');
                }
            }
        });
    }).trigger('change');

    $('#editbrokerstate').change(function (ev) {
        var val = $(this).val();
        $('#editbrokercity').html('<option value="0">--Select--</option>');
        if (val == '0') {
            return false;
        }
        var dataObj = {
            'header': {
                'requestName': 'getCity'
            },
            'body': {
                'data': val
            }
        };
        $.ajax('/administration/getCity', {
            'dataType': 'json',
            'data': JSON.stringify(dataObj),
            'type': 'post',
            'success': function (data, status, xhr) {
                if (data.length) {
                    var options = createSelectBoxCity(data);
                    $('#editbrokercity').html(options);
                    if ($('#editCityHidden').length) {
                        var selectedState = $('#editCityHidden').val();
                        $('#editbrokercity').val(selectedState);
                        $('#editCityHidden').remove();
                    }
                } else {
                    $('#editbrokercity').html('<option value="0">--Select--</option>');
                }
            }
        });
    });

    /*Validating Add Broker Page Start*/
    $('#brokerSubmit').click(function () {
        if ($('#brokerAddForm').valid()) {
            return true;
        }
    });

    $("#brokerAddForm").validate({
        rules: {
            brokername: {
                required: true
            },
            brokertype: {
                required: true,
                checkName: $('#brokertype').val()
            },
            brokersubtype: {
                required: true,
                checkName: $('#brokersubtype').val()
            },
            brokercountry: {
                required: true,
                checkName: $('#brokercountry').val()
            },
            brokerstate: {
                required: true,
                checkName: $('#brokerstate').val()
            },
            brokercity: {
                required: true,
                checkName: $('#brokercity').val()
            },
            brokerzipcode: {
                minlength: 2,
                maxlength: 10
            },
            brokercode: {
                required: true,
                number: true,
                minlength: 5,
                maxlength: 5
            }
        },
        errorElement: 'div',
        wrapper: 'div',
        errorPlacement: function (error, element) {
            error.insertAfter(element); // default function
        },
        // Specify the validation error messages
        messages: {
            brokername: {
                required: "Please Enter a valid Broker Name"
            },
            brokertype: {
                required: "Please Select a valid Wholesaler/Retailer",
                checkName: "Please Select a valid Wholesaler/Retailer"
            },
            brokersubtype: {
                required: "Please Select a valid Broker Sub-type",
                checkName: "Please Select a valid Broker Sub-type"
            },
            brokercountry: {
                required: "Please Select a valid Broker Country",
                checkName: "Please Select a valid Broker Country"
            },
            brokerstate: {
                required: "Please Select a valid Broker State",
                checkName: "Please Select a valid Broker State"
            },
            brokercity: {
                required: "Please Select a valid Broker City",
                checkName: "Please Select a valid Broker City"
            },
            brokerzipcode: {
                minlength: "Please Enter a valid zipcode",
                maxlength: "Please Enter a valid zipcode"
            },
            brokercode: {
                required: "Please Enter a valid value of Broker Code",
                number: "Broker code should be Numeric",
                minlength: "Broker code should be 5 digit long",
                maxlength: "Broker code should be 5 digit long"
            }

        }
    });
    /*Validating Add Broker Page End*/
    /*Validating Edit Broker Page Start*/
    $('#editbrokerSubmit').click(function () {
        if ($('#brokerEditForm').valid()) {
            return true;
        }
    });

    $("#brokerEditForm").validate({
        rules: {
            editbrokername: {
                required: true
            },
            editbrokertype: {
                required: true,
                checkName: $('#editbrokertype').val()
            },
            editbrokersubtype: {
                required: true,
                checkName: $('#editbrokersubtype').val()
            },
            editbrokercountry: {
                required: true,
                checkName: $('#editbrokercountry').val()
            },
            editbrokerstate: {
                required: true,
                checkName: $('#editbrokerstate').val()
            },
            editbrokercity: {
                required: true,
                checkName: $('#editbrokercity').val()
            },
            editbrokerzipcode: {
                minlength: 2,
                maxlength: 10
            },
            editbrokercode: {
                required: true,
                number: true,
                minlength: 5,
                maxlength: 5
            }
        },
        errorElement: 'div',
        wrapper: 'div',
        errorPlacement: function (error, element) {
            error.insertAfter(element); // default function
        },
        // Specify the validation error messages
        messages: {
            editbrokername: {
                required: "Please Enter a valid Broker Name"
            },
            editbrokertype: {
                required: "Please Select a valid Wholesaler/Retailer",
                checkName: "Please Select a valid Wholesaler/Retailer"
            },
            editbrokersubtype: {
                required: "Please Select a valid Broker Sub-type",
                checkName: "Please Select a valid Broker Sub-type"
            },
            editbrokercountry: {
                required: "Please Select a valid Broker Country",
                checkName: "Please Select a valid Broker Country"
            },
            editbrokerstate: {
                required: "Please Select a valid Broker State",
                checkName: "Please Select a valid Broker State"
            },
            editbrokercity: {
                required: "Please Select a valid Broker City",
                checkName: "Please Select a valid Broker City"
            },
            editbrokerzipcode: {
                minlength: "Please Enter a valid zipcode",
                maxlength: "Please Enter a valid zipcode"
            },
            editbrokercode: {
                required: "Please Enter a valid value of Broker Code",
                number: "Broker code should be Numeric",
                minlength: "Broker code should be 5 digit long",
                maxlength: "Broker code should be 5 digit long"
            }

        }
    });
    /*Validating Edit Broker Page End*/

    /*Validating Add Contact Person Page Start*/

    $.validator.addMethod("lettersonly", function (value, element) {
        return this.optional(element) || /^[a-zA-Z]+$/i.test(value);
    }, "Please Enter a valid First Name");

    $.validator.addMethod("lastlettersonly", function (value, element) {
        return this.optional(element) || /^[a-zA-Z]+$/i.test(value);
    }, "Please Enter a valid Last Name");

    $('#contactpersonSubmit').click(function () {
        if ($('#contactpersonAddForm').valid()) {
            return true;
        }
    });

    $("#contactpersonAddForm").validate({
        rules: {
            pertytype: {
                required: true,
                checkName: $('#pertytype').val()
            },
            companyname: {
                required: true
            },
            emailaddress: {
                required: true,
                email: true
            },
            firstname: {
                required: true,
                lettersonly: true
            },
            lastname: {
                required: true,
                lastlettersonly: true
            },
            phonenumber: {
                required: true,
                number: true,
                minlength: 10,
                maxlength: 10
            },
            mobilenumber: {
                number: true,
                minlength: 10,
                maxlength: 10
            },
            fax: {
                number: true,
                minlength: 10,
                maxlength: 10
            }
        },
        errorElement: 'div',
        wrapper: 'div',
        errorPlacement: function (error, element) {
            error.insertAfter(element); // default function
        },
        // Specify the validation error messages
        messages: {
            pertytype: {
                required: "Please Select a valid Party Type",
                checkName: "Please Select a valid Party Type"
            },
            companyname: {
                required: "Please Select a valid Company Name"
            },
            emailaddress: {
                required: "Please Enter a valid Email Address",
                email: "Please Enter a valid Email Address"
            },
            firstname: {
                required: "Please Enter a valid First Name"
            },
            lastname: {
                required: "Please Enter a valid Last Name"
            },
            phonenumber: {
                required: "Please Enter a valid Phone Number",
                number: "Please Enter a valid Phone Number",
                minlength: "Please Enter a valid Phone Number",
                maxlength: "Please Enter a valid Phone Number"
            },
            mobilenumber: {
                number: "Please Enter a valid Mobile Number",
                minlength: "Please Enter a valid Mobile Number",
                maxlength: "Please Enter a valid Mobile Number"
            },
            fax: {
                number: "Please Enter a valid Fax Number",
                minlength: "Please Enter a valid Fax Number",
                maxlength: "Please Enter a valid Fax Number"
            }

        }
    });
    /*Adding Aditional Validation For Phone Number and Email on ADD Page*/
    $("#pertytype").change(function (ev) {
        var val = $(this).val();
        if (val == 96) {
            $('#phonenumber').rules("remove");
            $('#emailaddress').rules("remove");
            $("input.error").removeClass("error"); // watch out for the error message labels or they won't go away
            $('#phonenumber').next("div").find('div.error').hide();
            $('#emailaddress').next("div").find('div.error').hide();
            $("#contactpersonAddForm").validate();
            $('#emailaddress').rules("add", {
                email: true,
                messages: {
                    email: "Please Enter a valid Email Address"
                }
            });
            $('#phonenumber').rules("add", {
                number: true,
                minlength: 10,
                maxlength: 10,
                messages: {
                    number: "Please Enter a valid Phone Number",
                    minlength: "Please Enter a valid Phone Number",
                    maxlength: "Please Enter a valid Phone Number"
                }
            });
        } else {
            /*Adding Validation For Email*/
            $('#phonenumber').rules("add", {
                required: true,
                number: true,
                minlength: 10,
                maxlength: 10,
                messages: {
                    required: "Please Enter a valid Phone Number",
                    number: "Please Enter a valid Phone Number",
                    minlength: "Please Enter a valid Phone Number",
                    maxlength: "Please Enter a valid Phone Number"
                }
            });
            /*Adding Validation For Email*/
            $('#emailaddress').rules("add", {
                required: true,
                email: true,
                messages: {
                    required: "Please Enter a valid Email Address",
                    email: "Please Enter a valid Email Address"
                }
            });
        }
    });

    /*Validating Add Broker Page End*/
    /*Validating Edit Contact Person Page Start*/
    $('#editcontactpersonSubmit').click(function () {
        if ($('#editcontactpersonAddForm').valid()) {
            return true;
        }
    });

    $("#editcontactpersonAddForm").validate({
        rules: {
            editpertytype: {
                required: true,
                checkName: $('#editpertytype').val()
            },
            editcompanyname: {
                required: true
            },
            editemailaddress: {
                required: true,
                email: true
            },
            editfirstname: {
                required: true,
                lettersonly: true
            },
            editlastname: {
                required: true,
                lastlettersonly: true
            },
            editphonenumber: {
                required: true,
                number: true,
                minlength: 10,
                maxlength: 10
            },
            editmobilenumber: {
                number: true,
                minlength: 10,
                maxlength: 10
            },
            editfax: {
                number: true,
                minlength: 10,
                maxlength: 10
            }
        },
        errorElement: 'div',
        wrapper: 'div',
        errorPlacement: function (error, element) {
            error.insertAfter(element); // default function
        },
        // Specify the validation error messages
        messages: {
            editpertytype: {
                required: "Please Select a valid Party Type",
                checkName: "Please Select a valid Party Type"
            },
            editcompanyname: {
                required: "Please Select a valid Company Name"
            },
            editemailaddress: {
                required: "Please Enter a valid Email Address",
                email: "Please Enter a valid Email Address"
            },
            editfirstname: {
                required: "Please Enter a valid First Name"
            },
            editlastname: {
                required: "Please Enter a valid Last Name"
            },
            editphonenumber: {
                required: "Please Enter a valid Phone Number",
                number: "Please Enter a valid Phone Number",
                minlength: "Please Enter a valid Phone Number",
                maxlength: "Please Enter a valid Phone Number"
            },
            editmobilenumber: {
                number: "Please Enter a valid Mobile Number",
                minlength: "Please Enter a valid Mobile Number",
                maxlength: "Please Enter a valid Mobile Number"
            },
            editfax: {
                number: "Please Enter a valid Fax Number",
                minlength: "Please Enter a valid Fax Number",
                maxlength: "Please Enter a valid Fax Number"
            }
        }
    });

    if ($('#hiddenPartyType').val() == 96) {
        $('#editphonenumber').rules("remove");
        $('#editemailaddress').rules("remove");
        $("input.error").removeClass("error"); // watch out for the error message labels or they won't go away
        $('#editphonenumber').next("div").find('div.error').hide();
        $('#editemailaddress').next("div").find('div.error').hide();
        $("#editcontactpersonAddForm").validate();
        $('#editemailaddress').rules("add", {
            email: true,
            messages: {
                email: "Please Enter a valid Email Address"
            }
        });
        $('#editphonenumber').rules("add", {
            number: true,
            minlength: 10,
            maxlength: 10,
            messages: {
                number: "Please Enter a valid Phone Number",
                minlength: "Please Enter a valid Phone Number",
                maxlength: "Please Enter a valid Phone Number"
            }
        });
    }

    /*Adding Aditional Validation For Phone Number and Email on Edit Page*/
    $("#editpertytype").change(function (ev) {
        var val = $(this).val();
        if (val == 96) {
            $('#editphonenumber').rules("remove");
            $('#editemailaddress').rules("remove");
            $("input.error").removeClass("error"); // watch out for the error message labels or they won't go away
            $('#editphonenumber').next("div").find('div.error').hide();
            $('#editemailaddress').next("div").find('div.error').hide();
            $("#editcontactpersonAddForm").validate();
            $('#editemailaddress').rules("add", {
                email: true,
                messages: {
                    email: "Please Enter a valid Email Address"
                }
            });
            $('#editphonenumber').rules("add", {
                number: true,
                minlength: 10,
                maxlength: 10,
                messages: {
                    number: "Please Enter a valid Phone Number",
                    minlength: "Please Enter a valid Phone Number",
                    maxlength: "Please Enter a valid Phone Number"
                }
            });
        } else {
            /*Adding Validation For Email*/
            $('#editphonenumber').rules("add", {
                required: true,
                number: true,
                minlength: 10,
                maxlength: 10,
                messages: {
                    required: "Please Enter a valid Phone Number",
                    number: "Please Enter a valid Phone Number",
                    minlength: "Please Enter a valid Phone Number",
                    maxlength: "Please Enter a valid Phone Number"
                }
            });
            /*Adding Validation For Email*/
            $('#editemailaddress').rules("add", {
                required: true,
                email: true,
                messages: {
                    required: "Please Enter a valid Email Address",
                    email: "Please Enter a valid Email Address"
                }
            });
        }
    });

    /*Validating Edit Broker Page End*/
    /*Function to show Suggestion Box For Company Name Start*/
    $("#companyname").autocomplete({
        source: function (request, response) {
            $.getJSON("/administration/getCompanyName", {
                term: $('#companyname').val(),
                data: {
                    myparam: $('#pertytype').val()
                }
            }, response);
        },
        minLength: 1,
        select: function (event, ui) {
            $(this).val(ui.item.value);
        }
    });

    $("#editcompanyname").autocomplete({
        source: function (request, response) {
            $.getJSON("/administration/getCompanyName", {
                term: $('#editcompanyname').val(),
                data: {
                    myparam: $('#editpertytype').val()
                }
            }, response);
        },
        minLength: 1,
        select: function (event, ui) {
            $(this).val(ui.item.value);
        }
    });

    $('#pertytype').change(function (ev) {
        $("#companyname").val("");
    });
    $('#editpertytype').change(function (ev) {
        $("#editcompanyname").val("");
    });
    /*Function to show Suggestion Box For Company Name End*/

    /*Function to show Suggestion Box For Broker Name Start*/
    $("#brokername").autocomplete({
        source: function (request, response) {
            $.getJSON("/administration/getBrokerName", {
                term: $('#brokername').val()
            }, response);
        },
        minLength: 1,
        select: function (event, ui) {
            $(this).val(ui.item.value);
            if (ui.item.value) {
                var BrokerName = ui.item.value;
                var dataObj = {
                    'header': {
                        'requestName': 'getBrokerInformation'
                    },
                    'body': {
                        'data': BrokerName
                    }
                };
                $.ajax('/administration/getBrokerInformation', {
                    'dataType': 'json',
                    'data': JSON.stringify(dataObj),
                    'type': 'post',
                    'success': function (data, status, xhr) {
                        if (data.length) {
                            var options = createSelectBrokerType(data);
                            var options1 = createSelectBrokerSubType(data);
                            $('#brokertype').html(options);
                            $('#brokersubtype').html(options1);
                            $('#brokercode').val(data[0].BrokerCode);
                            $('#brokercode').attr('readonly', true);
                        }
                    }
                });
            }
        }
    });

    var createSelectBrokerType = function (data) {
        var selectBox = '<option value="0">--Select--</option>';
        for (var i = 0; i < data.length; i += 1) {
            selectBox += '<option value="' + data[i].BrokerTypeId + '">' + data[i].BrokerType + '</option>';
        }
        return selectBox;
    };
    var createSelectBrokerSubType = function (data) {
        var selectBox = '<option value="0">--Select--</option>';
        for (var i = 0; i < data.length; i += 1) {
            selectBox += '<option value="' + data[i].BrokerSubTypeId + '">' + data[i].BrokerSubType + '</option>';
        }
        return selectBox;
    };
    /*Function to show Suggestion Box For Broker Name End*/

    /*Function for Renewal Reference Page Start*/
    $('#dateofRenewal').datepicker({
        showTime: true,
        dateFormat: 'mm/dd/yy',
        onSelect: function () {
            $(this).valid();
        }
    });
    $('#editDateofRenewal').datepicker({
        showTime: true,
        dateFormat: 'mm/dd/yy',
        onSelect: function () {
            $(this).valid();
        }
    });

    $('#submissionNumber').blur(function (ev) {
        var val = $(this).val();
        $('#accountName').html('<option value="0">--Select--</option>');
        if (val == '0') {
            return false;
        }
        var dataObj = {
            'header': {
                'requestName': 'getAccount'
            },
            'body': {
                'data': val
            }
        };
        $.ajax('/administration/getAccount', {
            'dataType': 'json',
            'data': JSON.stringify(dataObj),
            'type': 'post',
            'success': function (data, status, xhr) {
                if (data.Accountdata.length) {
                    var options = createSelectBoxCompany(data.Accountdata);
                    $('#accountName').html(options);
                    var optionsStatus = createSelectBoxStatus(data.Statusdata);
                    $('#status').html(optionsStatus);
                } else {
                    $('#accountName').html('<option value="NA">Not Available</option>');
                    $('#status').html('<option value="NA">Not Available</option>');
                }
            }
        });
    });

    var createSelectBoxCompany = function (data) {
        var selectBox = '<option value="0">--Select--</option>';
        for (var i = 0; i < data.length; i += 1) {
            selectBox += '<option value="' + data[i].Id + '">' + data[i].InsuredName + '</option>';
        }
        return selectBox;
    };
    var createSelectBoxStatus = function (data) {
        var selectBox = '<option value="0">--Select--</option>';
        for (var i = 0; i < data.length; i += 1) {
            selectBox += '<option value="' + data[i].Id + '">' + data[i].StatusName + '</option>';
        }
        return selectBox;
    };
    /*Function for Renewal Reference Page End*/
    /*Add Renewal form start here*/
    $('#addRenewalSubmit').click(function () {
        if ($('#referenceAddForm').valid()) {
            return true;
        }
    });

    $("#referenceAddForm").validate({
        rules: {
            submissionNumber: {
                regex: '^([0-9-]{1,50})$',
                required: true,
                checkName: $('#submissionNumber').val()
            },
            accountName: {
                required: true,
                checkName: $('#accountName').val()
            },
            status: {
                required: true,
                checkName: $('#status').val()
            },
            renewable: {
                required: true,
                checkName: $('#renewable').val()
            },
            dateofRenewal: {
                required: true,
                checkName: $('#dateofRenewal').val()
            },
        },
        errorElement: 'div',
        wrapper: 'div',
        errorPlacement: function (error, element) {
            error.insertAfter(element); // default function
        },
        // Specify the validation error messages
        messages: {
            submissionNumber: '<br />Please enter a valid Submission Number',
            accountName: '<br />Please select a valid Account Name',
            status: '<br />Please select a valid Status',
            renewable: '<br />Please select a valid Renewable',
            dateofRenewal: '<br />Please select a valid date for Date of Renewal'


        }
    });

    /*Add Renewal form ends here*/

    $('#editRenewalSubmit').click(function () {
        if ($('#editReferalReferenceForm').valid()) {
            return true;
        }
    });

    $("#editReferalReferenceForm").validate({
        rules: {
            editRenewable: {
                required: true,
                checkName: $('#editRenewable').val()
            }
        },
        errorElement: 'div',
        wrapper: 'div',
        errorPlacement: function (error, element) {
            error.insertAfter(element); // default function
        },
        // Specify the validation error messages
        messages: {
            editRenewable: '<br />Please select a valid Renewable'

        }
    });
    /*Function for Renewal Reference Page End*/

    $('.open').click(function () {
        $(this).toggleClass('fa-minus');
        var id = $(this).attr('id');
        var row = $(this);
        if (id) {
            var dataObj = {
                'header': {
                    'requestName': 'insuredList'
                },
                'body': {
                    'data': id
                }
            };
            $.ajax('/admin/insuredList', {
                'dataType': 'json',
                'data': JSON.stringify(dataObj),
                'type': 'post',
                'success': function (data, status, xhr) {
                    if (data != '') {
                        var amendmenthtml = amendmentInsuredListOption(data);
                        if ($('.amendment-child' + id).length > 0) {
                            $('.amendment-child' + id).fadeToggle();
                        } else {
                            $('.amendment-child' + id).fadeToggle();
                            row.parents('tr').after(amendmenthtml);
                        }
                    }
                }
            });
        } else {
            return false;
        }
    });

    var amendmentInsuredListOption = function (data) {
        var listOption = '';
        for (var i = 0; i < data.length; i += 1) {
            listOption += "<tr class='amendment-child" + data[i].InsuredParentId + "'><td><a href='/admin/editinsured?insuredId=" + data[i].InsuredId + "' style='margin-right:7px;' class='btn btn-orange btn-small'><i class='fa fa-pencil'></i></a><a href='/admin/viewinsured?insuredId=" + data[i].InsuredId + "' class='btn btn-green btn-small'><i class='fa fa-eye'></i></a></td><td>" + data[i].InsuredName + "</td><td>" + data[i].Address + "</td><td>" + data[i].InsuredCOuntry + "</td><td>" + data[i].InsuredState + "</td><td>" + data[i].InsuredCity + "</td><td>" + data[i].DBNumber + "</td><td>" + data[i].AdvisenId + "</td><td>" + data[i].InsuredStatus + "</td><td>" + data[i].CreatedBy + "</td><td>" + data[i].CreatedOn + "</td><td>" + data[i].ModifiedBy + "</td><td>" + data[i].ModifiedOn + "</td></tr>";
        }
        return listOption;
    };

});

