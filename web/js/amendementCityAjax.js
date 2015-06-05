$(document).ready(function (e) {
    /****************************************************************************************/
    var generateBrokerCode = function () {
        setTimeout(function (e) {
            if ($('#brokerCode').val() !== '0' && $('#brokerCountryCode').val() !== '0' && $('#brokerStateCode').val() !== '0' && $('#brokerCityCode').val() !== '0') {
                var code = $('#brokerCode option:selected').val() + '-' + $('#brokerCountryCode option:selected').text().slice(0, 3) + '-' + $('#brokerStateCode option:selected').text().slice(-3) + '-' + $('#brokerCityCode option:selected').text().slice(-4);
                if ($('#brokerCountryCode').val() == '6' || $('#brokerStateCode').val() == '72' || $("#brokerCityCode option:selected").text() == '(Unknown)-0000') {
                    $('#brokerCodeGen').val('Unknown');
                } else {
                    $('#brokerCodeGen').val(code);
                }
                $('#brokerCodeGen1').val(code);
            }
        }, 500);
    };
    /****************************************************************************************/
    $('#retailbrokerCountryCode').change(function (ev) {
        var val = $(this).val();
        $('#retailbrokerStateCode').html('<option value="0">--Select--</option>');
        $('#retailbrokerCityCode').html('<option value="0">--Select--</option>');
        if (val == '') {
            return false;
        }
        var dataObj = {
            'header': {
                'requestName': 'getRetailBrokerState'
            },
            'body': {
                'data': val
            }
        };
        $.ajax('/submission/getRetailBrokerState', {
            'dataType': 'json',
            'data': JSON.stringify(dataObj),
            'type': 'post',
            'success': function (data, status, xhr) {
                if (data.length) {
                    var options = createSelectBoxStateRetailBroker(data);
                    $('#retailbrokerStateCode').html(options);
                    if ($('#retailsbrokerStateCodeHidden').length) {
                        var selectedState = $('#retailsbrokerStateCodeHidden').val();
                        $('#retailbrokerStateCode').val(selectedState);
                        $('#retailbrokerStateCode').trigger('change');
                        $('#retailsbrokerStateCodeHidden').remove();
                    }
                } else {
                    $('#retailbrokerStateCode').html('<option value="159">Not Applicable</option>');
                    $('#retailbrokerCityCode').html('<option value="1307">Not Applicable</option>');
                }
            }
        });
    }).trigger('change');
    /****************************************************************************************/
    $('#retailbrokerStateCode').change(function (ev) {
        var val = $(this).val();
        $('#retailbrokerCityCode').html('<option value="0">--Select--</option>');
        if (val == '0') {
            return false;
        }
        var dataObj = {
            'header': {
                'requestName': 'getRetailBrokerCity'
            },
            'body': {
                'data': val
            }
        };
        $.ajax('/submission/getRetailBrokerCity', {
            'dataType': 'json',
            'data': JSON.stringify(dataObj),
            'type': 'post',
            'success': function (data, status, xhr) {
                if (data.length) {
                    var options = createSelectBoxRetailBrokerCity(data);
                    $('#retailbrokerCityCode').html(options);
                    if ($('#retailbrokerCityCodeHidden').length) {
                        var selectedState = $('#retailbrokerCityCodeHidden').val();
                        $('#retailbrokerCityCode').val(selectedState);
                        $('#retailbrokerCityCodeHidden').remove();
                    }
                } else {
                    $('#retailbrokerCityCode').html('<option value="1307">Not Applicable</option>');
                }
            }
        });
    });
    /****************************************************************************************/
    $('#sub_country').change(function (ev) {
        var val = $(this).val();
        $('#sub_state').html('<option value="0">--Select--</option>');
        $('#sub_city').html('<option value="0">--Select--</option>');
        if (val == '') {
            return false;
        }
        var dataObj = {
            'header': {
                'requestName': 'getProjectState'
            },
            'body': {
                'data': val
            }
        };
        $.ajax('/submission/getProjectState', {
            'dataType': 'json',
            'data': JSON.stringify(dataObj),
            'type': 'post',
            'success': function (data, status, xhr) {
                if (data.length) {
                    var options = createSelectBoxState(data);
                    $('#sub_state').html(options);
                    if ($('#newMailStateHidden').length) {
                        var selectedState = $('#newMailStateHidden').val();
                        $('#sub_state').val(selectedState);
                        $('#sub_state').trigger('change');
                        $('#newMailStateHidden').remove();
                    }
                } else {
                    $('#sub_state').html('<option value="159">Not Applicable</option>');
                    $('#sub_city').html('<option value="1307">Not Applicable</option>');
                }
            }
        });
    }).trigger('change');
    /****************************************************************************************/
    $('#sub_state').change(function (ev) {
        var val = $(this).val();
        $('#sub_city').html('<option value="0">--Select--</option>');
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
        $.ajax('/submission/getCity', {
            'dataType': 'json',
            'data': JSON.stringify(dataObj),
            'type': 'post',
            'success': function (data, status, xhr) {
                if (data.length) {
                    var options = createSelectBoxCity(data);
                    $('#sub_city').html(options);
                    if ($('#newMailCityHidden').length) {
                        var selectedState = $('#newMailCityHidden').val();
                        setTimeout(function () {
                            $('#sub_city').val(selectedState);
                            $('#newMailCityHidden').remove();
                        }, 300);
                    }
                } else {
                    $('#sub_city').html('<option value="1307">Not Applicable</option>');
                }
            }
        });
    });
    /****************************************************************************************/
    $('#underwriter_id').change(function (ev) {
        var underwriterID = $('#underwriter_id').val();
        $('#productlinesubtype').html('<option>--Select--</option>');
        $('#sectionCode').html('<option>--Select--</option>');
        $('#profitCode').html('<option>--Select--</option>');
        if (underwriterID == "0") {
            $('#productline').val("");
            return false;
        } else {
            var dataObj = {
                'header': {
                    'requestName': 'getSubmissionTypeDataDetails'
                },
                'body': {
                    'data': underwriterID
                }
            };
            $.ajax('/submission/getSubmissionTypeDataDetails', {
                'dataType': 'json',
                'data': JSON.stringify(dataObj),
                'type': 'post',
                'success': function (data, status, xhr) {
                    $('#productline').val(data.lobDetail[0].LOBName);
                    $('#productLinePrefix1').val(data.lobDetail[0].Prefix);
                    $('#productlinesubtype').html('<option>--Select--</option>');
                    var productlinesubtypeList = createProductLineSubTypeOption(data.lobsubtypeDetail);
                    $('#productlinesubtype').html(productlinesubtypeList);
                    if ($('#productLineSubTypeHidden').length) {
                        var selectedSubType = $('#productLineSubTypeHidden').val();
                        $('#productlinesubtype').val(selectedSubType);
                        $('#productlinesubtype').trigger('change');
                        //$('#productLineSubTypeHidden').remove();
                    }
                }
            });
        }
    }).trigger('change');
    /****************************************************************************************/
    $('#productlinesubtype').change(function (ev) {
        if ($('#productlinesubtype').val() == '--Select--') {
            $('#productlinesubtype').val("0");
        } else if ($('#productlinesubtype').val() == '0') {
            $('#productlinesubtype').val("0");
        }
        $('#sectionCode').html('<option value ="0">--Select--</option>');
        $('#profitCode').html('<option value ="0">--Select--</option>');
        var productLineType = $('#productline').val();
        var productLineSubTypeID = $('#productlinesubtype').val();
        var productLineSubTypeIDHidden = $('#productLineSubTypeHidden').val();
        if ((productLineSubTypeID == '21') || (productLineSubTypeID == '22') || (productLineSubTypeID == '23') || (productLineSubTypeID == '24') || (productLineSubTypeID == '25')) {
            $('#sectionCode').html('<option value="709">Not Available</option>');
            $('#profitCode').html('<option value="840">Not Available</option>');
            return false;
        } else if ((productLineSubTypeID == '0')) {
            $('#sectionCode').html('<option value ="0">--Select--</option>');
            $('#profitCode').html('<option value ="0">--Select--</option>');
        } else {
            var sectionCodeHidden = '';
            if (productLineSubTypeID == productLineSubTypeIDHidden) {
                sectionCodeHidden = $('#sectionCodeHidden').val();
            }
            var dataObj = {
                'header': {
                    'requestName': 'getSectionCodeDetails'
                },
                'body': {
                    'data': {
                        'productLineId': productLineType,
                        'subTypeId': productLineSubTypeID,
                        'sectionCodeHidden': sectionCodeHidden
                    }
                }
            };
            $.ajax('/submission/getSectionCodeDetails', {
                'dataType': 'json',
                'data': JSON.stringify(dataObj),
                'type': 'post',
                'success': function (data, status, xhr) {
                    if (data.error) {
                        if ((productLineSubTypeIDHidden == '21') || (productLineSubTypeIDHidden == '22') || (productLineSubTypeIDHidden == '23') || (productLineSubTypeIDHidden == '24') || (productLineSubTypeIDHidden == '25')) {
                            $('#sectionCode').html('<option value="709">Not Available</option>');
                            $('#profitCode').html('<option value="840">Not Available</option>');
                        } else {
                            $('#sectionCode').html('<option value="722">Not Applicable</option>');
                            var dataObj = {
                                'header': {
                                    'requestName': 'getProfitCodeDetailsBySubType'
                                },
                                'body': {
                                    'data': productLineSubTypeID
                                }
                            };
                            $.ajax('/submission/getProfitCodeDetailsBySubType', {
                                'dataType': 'json',
                                'data': JSON.stringify(dataObj),
                                'type': 'post',
                                'success': function (data, status, xhr) {
                                    if (data.error) {
                                        if ($('#sectionCode').val() == '721') {
                                            $('#profitCode').html('<option value="844">To Be Entered</option>');
                                        } else {
                                            $('#profitCode').html('<option value="841">Not Applicable</option>');
                                        }
                                    } else {
                                        $('#profitCode').html('<option>--Select--</option>');
                                        var profitCodeList = createProfitCodeOption(data);
                                        $('#profitCode').html(profitCodeList);
                                        if ($('#profitCodeHidden').length) {
                                            var selectedProfitCode = $('#profitCodeHidden').val();
                                            $('#profitCode').val(selectedProfitCode);
                                            $('#profitCodeHidden').remove();
                                        }
                                    }
                                }
                            });
                        }
                    } else {
                        $('#sectionCode').html('<option>--Select--</option>');
                        var sectionCodeList = createSectionCodeOption(data);
                        $('#sectionCode').html(sectionCodeList);
                        if ($('#sectionCodeHidden').length) {
                            var selectedSection = $('#sectionCodeHidden').val();
                            $('#sectionCode').val(selectedSection);
                            $('#sectionCode').trigger('change');
                            //$('#sectionCodeHidden').remove();
                        }
                    }
                }
            });
        }
        /*For Coverage*/
        $('#editcoverage').val("");
        var lobval = $('#productline_master').val();
        var ulobval = $('#productline').val();
        var val = 9;
        var lobsubval = $('#productlinesubtype').val();
        if (val == '9') {
            var dataObj = {
                'header': {
                    'requestName': 'getCoverage'
                },
                'body': {
                    'data': {
                        'status': val,
                        'lobvalue': lobval,
                        'userLob': ulobval,
                        'Lobsub': lobsubval
                    }
                }
            };
            $.ajax('/submission/getCoverage', {
                'dataType': 'json',
                'data': JSON.stringify(dataObj),
                'type': 'post',
                'success': function (data, status, xhr) {
                    if (data.length) {
                        var options = createCoverageOption(data);
                        $('#editcoverage').html(options);
                        if ($('#hiddenCoverage').length) {
                            var selectedCoverage = $('#hiddenCoverage').val();
                            $('select[name="editcoverage"]').find('option[value="' + selectedCoverage + '"]').attr("selected", true);
                            $('#hiddenCoverage').remove();
                        }
                    }
                }
            });

        } else {
            return false;
        }
    }).trigger('change');
    /****************************************************************************************/
    $('#sectionCode').change(function (ev) {
        $('#profitCode').html('<option value="0">--Select--</option>');
        var productLineType = $('#productline').val();
        var productLineSubTypeID = $('#productlinesubtype').val();
        var sectionCodeID = $('#sectionCode').val();
        var sectionCodeHidden = $('#sectionCodeHidden').val();
        var ProfitCodeHidden = '';
        if (sectionCodeID == sectionCodeHidden) {
            ProfitCodeHidden = $('#profitCodeHidden').val();
        }
        if (!sectionCodeID || sectionCodeID == '0') {
            return false;
        } else if (sectionCodeID == '721') {
            $('#profitCode').html('<option value="844">To Be Entered</option>');
        } else {
            var dataObj = {
                'header': {
                    'requestName': 'getProfitCodeDetails'
                },
                'body': {
                    'data': {
                        'TypeID': productLineType,
                        'subTypeID': productLineSubTypeID,
                        'sectionCodeID': sectionCodeID,
                        'hiddenProfitCode': ProfitCodeHidden
                    }
                }
            };
            $.ajax('/submission/getProfitCodeDetails', {
                'dataType': 'json',
                'data': JSON.stringify(dataObj),
                'type': 'post',
                'success': function (data, status, xhr) {
                    if (data.error) {
                        if (sectionCodeID == '721') {
                            $('#profitCode').html('<option value="844">To Be Entered</option>');
                        } else {
                            $('#profitCode').html('<option value="841">Not Applicable</option>');
                        }
                    } else {
                        $('#profitCode').html('<option value="0">--Select--</option>');
                        var profitCodeList = createProfitCodeOption(data);
                        $('#profitCode').html(profitCodeList);
                        if ($('#profitCodeHidden').length) {
                            var selectedProfitCode = $('#profitCodeHidden').val();
                            $('#profitCode').val(selectedProfitCode);
                            $('#profitCodeHidden').remove();
                        }
                    }
                }
            });
        }
    });
    /****************************************************************************************/
    $('#brokerCode').change(function (ev) {
        var val = $(this).val();
        $('#brokerCodeGen').val("");
        $('#isWholesaler').val("");
        $('#brokerCountryCode').html('<option value="0">--Select--</option>');
        $('#brokerStateCode').html('<option value="0">--Select--</option>');
        $('#brokerCityCode').html('<option value="0">--Select--</option>');
        $('#broker_contact_person').html('<option value="0">--Select--</option>');
        generateBrokerCode();
        //////////////////////////////// Broker Type////////////////////////
        if (!val) {
            return false;
        } else {
            if (val == '-1' || val == '-2') {
                $('#isWholesaler').val('Unknown');
            } else if (val == "") {
                $('#isWholesaler').val("");
            } else {
                var dataObj = {
                    'header': {
                        'requestName': 'getBrokerSubType'
                    },
                    'body': {
                        'data': val
                    }
                };
                $.ajax('/submission/getBrokerSubType', {
                    'dataType': 'json',
                    'data': JSON.stringify(dataObj),
                    'type': 'post',
                    'success': function (data, status, xhr) {
                        if (data.length) {
                            var brokertype = '';
                            if (data[0]['cat'] == 'R') {
                                brokertype = 'Retailer';
                                $('#retailBrokerName').prop('disabled', true);
                                $('#retailbrokerCountryCode').prop('disabled', true);
                                $('#retailbrokerStateCode').prop('disabled', true);
                                $('#retailbrokerCityCode').prop('disabled', true);
                                $('#retailBrokerName').val("");
                                $('#retailbrokerCountryCode').val("");
                                $('#retailbrokerStateCode').val("");
                                $('#retailbrokerCityCode').val("");
                                $('#retailBrokerName').removeClass('error');
                                $('label[for=retailBrokerName]').remove();
                                $('#retailbrokerCountryCode').removeClass('error');
                                $('label[for=retailbrokerCountryCode]').remove();
                                $('#retailbrokerStateCode').removeClass('error');
                                $('label[for=retailbrokerStateCode]').remove();
                                $('#retailbrokerCityCode').removeClass('error');
                                $('label[for=retailbrokerCityCode]').remove();
                            } else if (data[0]['cat'] == 'W') {
                                brokertype = 'Wholesaler';
                                /*validate broker details*/
                                $('#retailBrokerName').prop('disabled', false);
                                $('#retailbrokerCountryCode').prop('disabled', false);
                                $('#retailbrokerStateCode').prop('disabled', false);
                                $('#retailbrokerCityCode').prop('disabled', false);
                            }
                            $('#isWholesaler').val(brokertype);
                            $('#brokerId').val(data[0]['Id']);
                        }
                    }
                });
            }
        }
        /////////////////Broker Country//////////////////
        if (val) {
            if (val == '-1' || val == '-2') {
                $('#brokerCountryCode').html('<option value="6">Unknown</option>');
                $('#brokerStateCode').html('<option value="72">(Unknown)-000</option>');
                $('#brokerCityCode').html('<option value="388">(Unknown)-0000</option>');
                $('#brokerCodeGen').val('Unknown');
                getBrokerContactPerson();
            } else {
                var dataObj = {
                    'header': {
                        'requestName': 'getBrokerCountry'
                    },
                    'body': {
                        'data': val
                    }
                };
                $.ajax('/submission/getBrokerCountry', {
                    'dataType': 'json',
                    'data': JSON.stringify(dataObj),
                    'type': 'post',
                    'success': function (data, status, xhr) {
                        var countryList = createBrokerCountryOption(data);
                        $('#brokerCountryCode').html(countryList);
                    }
                });
            }
        } else {
            return false;
        }
    });
    /****************************************************************************************/
    $('#submissiontype').change(function (ev) {
        var newRenewal = $(this).val();
        var val = $('#primary_status').val();
        if (val == '4' || val == '7' || val == '8') {
            var dataObj = {
                'header': {
                    'requestName': 'getReasonCode'
                },
                'body': {
                    'data': val,
                    'newrenewal': newRenewal
                }
            };
            $.ajax('/submission/getReasonCode', {
                'dataType': 'json',
                'data': JSON.stringify(dataObj),
                'type': 'post',
                'success': function (data, status, xhr) {
                    if (data.error) {
                        $('#reason_code').html('<option value="NA">Not Applicable</option>');
                    } else {
                        var options = createSelectReasonCode(data);
                        $('#reason_code').html(options);
                    }
                }
            });
        } else {
            return false;
        }
    });
    /****************************************************************************************/
    /*For OnLoad*/
    var onloadCoverage = function () {
        $('#editcoverage').val("");
        var lobval = $('#productline_master').val();
        var ulobval = $('#productLineHidden').val();
        var val = 9;
        var lobsubval = $('#productlinesubtype').val();
        if (val == '9') {
            var dataObj = {
                'header': {
                    'requestName': 'getCoverage'
                },
                'body': {
                    'data': {
                        'status': val,
                        'lobvalue': lobval,
                        'userLob': ulobval,
                        'Lobsub': lobsubval
                    }
                }
            };
            $.ajax('/submission/getCoverage', {
                'dataType': 'json',
                'data': JSON.stringify(dataObj),
                'type': 'post',
                'success': function (data, status, xhr) {
                    if (data.length) {
                        var options = createCoverageOption(data);
                        $('#editcoverage').html(options);
                        if ($('#hiddenCoverage').length) {
                            var selectedCoverage = $('#hiddenCoverage').val();
                            $('select[name="editcoverage"]').find('option[value="' + selectedCoverage + '"]').attr("selected", true);
                            $('#hiddenCoverage').remove();
                        }
                    }
                }
            });

        } else {
            return false;
        }
    };
    /****************************************************************************************/
    /*Coverage dropdown*/
    var Coverage = function () {
        $('#editcoverage').val("");
        var lobval = $('#productline_master').val();
        var ulobval = $('#productline').val();
        var val = 9;
        var lobsubval = $('#productlinesubtype').val();
        if (val == '9') {
            var dataObj = {
                'header': {
                    'requestName': 'getCoverage'
                },
                'body': {
                    'data': {
                        'status': val,
                        'lobvalue': lobval,
                        'userLob': ulobval,
                        'Lobsub': lobsubval
                    }
                }
            };
            $.ajax('/submission/getCoverage', {
                'dataType': 'json',
                'data': JSON.stringify(dataObj),
                'type': 'post',
                'success': function (data, status, xhr) {
                    if (data.length) {
                        var options = createCoverageOption(data);
                        $('#editcoverage').html(options);
                        if ($('#hiddenCoverage').length) {
                            var selectedCoverage = $('#hiddenCoverage').val();
                            $('#editcoverage').val(selectedCoverage);
                            //$('select[name="editcoverage"]').find('option[value="'+selectedCoverage+'"]').attr("selected",true);
                            //$('#hiddenCoverage').remove();
                        }
                    }
                }
            });

        } else {
            return false;
        }
    };
    /****************************************************************************************/
    var createCoverageOption = function (data) {
        var selectBox = '<option value="0">--Select--</option>';
        for (var i = 0; i < data.length; i += 1) {
            selectBox += '<option value="' + data[i].Id + '">' + data[i].Name + '</option>';
        }
        return selectBox;
    };
    /****************************************************************************************/
    $('#primary_status').change(function (ev) {
        var val = $(this).val();
        var newRenewal = $('#submissiontype').val();
        if (val == '4' || val == '7' || val == '8') {
            var dataObj = {
                'header': {
                    'requestName': 'getReasonCode'
                },
                'body': {
                    'data': val,
                    'newrenewal': newRenewal
                }
            };
            $.ajax('/submission/getReasonCode', {
                'dataType': 'json',
                'data': JSON.stringify(dataObj),
                'type': 'post',
                'success': function (data, status, xhr) {
                    if (data.error) {
                        $('#reason_code').html('<option value="NA">Not Applicable</option>');
                    } else {
                        var options = createSelectReasonCode(data);
                        $('#reason_code').html(options);
                        if ($('#hiddenReasonCode').length) {
                            var selectedReasonCode = $('#hiddenReasonCode').val();
                            $('#reason_code').val(selectedReasonCode);
                            $('#hiddenReasonCode').remove();
                        }
                    }
                }
            });
        } else {
            return false;
        }
    }).trigger('change');
    /****************************************************************************************/
    $('#byBerkSi').datetimepicker({
        dateFormat: 'mm/dd/yy',
        changeMonth: true,
        changeYear: true,
        yearRange: "1980:2040"
    });
    $('#byIndia').datepicker({
        dateFormat: 'mm/dd/yy',
        changeMonth: true,
        changeYear: true,
        yearRange: "1980:2040",
        onSelect: function () {
            $(this).valid();
        }
    });
    /****************************************************************************************/
    var createBrokerCountryOption = function (data) {
        var selectBox = '<option value="">--Select--</option>';
        for (var i = 0; i < data.length; i += 1) {
            selectBox += '<option value="' + data[i].Id + '">' + data[i].InsuredCountry + '</option>';
        }
        return selectBox;
    };
    /****************************************************************************************/
    var createSelectBoxState = function (data) {
        var selectBox = '<option value="0">--Select--</option>';
        for (var i = 0; i < data.length; i += 1) {
            selectBox += '<option value="' + data[i].Id + '">' + data[i].ProjectCode + '</option>';
        }
        return selectBox;
    };
    /****************************************************************************************/
    var createSelectBoxCity = function (data) {
        var selectBox = '<option value="0">--Select--</option>';
        for (var i = 0; i < data.length; i += 1) {
            selectBox += '<option value="' + data[i].Id + '">' + data[i].City + '</option>';
        }
        return selectBox;
    };
    /****************************************************************************************/
    var createSelectBoxBrokerCity = function (data) {
        var selectBox = '<option value="0">--Select--</option>';
        for (var i = 0; i < data.length; i += 1) {
            selectBox += '<option value="' + data[i].Id + '">' + data[i].CityFullCode + '</option>';
        }
        return selectBox;
    };
    /****************************************************************************************************/
    var createSelectBoxRetailBrokerCity = function (data) {
        var selectBox = '<option value="0">--Select--</option>';
        for (var i = 0; i < data.length; i += 1) {
            selectBox += '<option value="' + data[i].Id + '">' + data[i].RetailBrokerCity + '</option>';
        }
        return selectBox;
    };
    /****************************************************************************************/
    var createSelectBoxStateWithClass = function (data) {
        var selectBox = '<option value="0">--Select--</option>';
        for (var i = 0; i < data.length; i += 1) {
            selectBox += '<option value="' + data[i].Id + '" class="' + data[i].StateCode + '">' + data[i].FullCode + '</option>';
        }
        return selectBox;
    };
    /****************************************************************************************/
    var createSelectBoxStateBroker = function (data) {
        var selectBox = '<option value="0">--Select--</option>';
        for (var i = 0; i < data.length; i += 1) {
            selectBox += '<option value="' + data[i].Id + '">' + data[i].FullCode + '</option>';
        }
        return selectBox;
    };
    /****************************************************************************************************/
    var createSelectBoxStateRetailBroker = function (data) {
        var selectBox = '<option value="0">--Select--</option>';
        for (var i = 0; i < data.length; i += 1) {
            selectBox += '<option value="' + data[i].Id + '">' + data[i].RetailBrokerState + '</option>';
        }
        return selectBox;
    };
    /****************************************************************************************/
    var createProductLineSubTypeOption = function (data) {
        var selectBox = '<option value="0">--Select--</option>';
        for (var i = 0; i < data.length; i += 1) {
            selectBox += '<option value="' + data[i].Id + '">' + data[i].ProductLineSubType + '</option>';
        }
        return selectBox;
    };
    /****************************************************************************************/
    var createSectionCodeOption = function (data) {
        var selectBox = '<option value="0">--Select--</option>';
        for (var i = 0; i < data.length; i += 1) {
            selectBox += '<option value="' + data[i].Id + '">' + data[i].SectionCode + '</option>';
        }
        selectBox += '<option value="721">To Be Entered</option>';
        return selectBox;
    };
    /****************************************************************************************/
    var createProfitCodeOption = function (data) {
        var selectBox = '<option value="0">--Select--</option>';
        for (var i = 0; i < data.length; i += 1) {
            selectBox += '<option value="' + data[i].Id + '">' + data[i].ProfitCodeName + '</option>';
        }
        selectBox += '<option value="844">To Be Entered</option>';
        return selectBox;
    };

    /****************************************************************************************/
    var createSelectReasonCode = function (data) {
        var selectBox = '<option value="0">--Select--</option>';
        for (var i = 0; i < data.length; i += 1) {
            if (!data[i].Meaning) {
                selectBox += '<option value="' + data[i].Id + '">' + data[i].ReasonCodeName + '</option>';
            } else {
                selectBox += '<option value="' + data[i].Id + '">' + data[i].ReasonCodeName + '-' + data[i].Meaning + '</option>';
            }

        }
        return selectBox;
    };

    /****************************************************************************************/
    var toggleModal = function () {
        $('body').toggleClass('body-locked');
        $('.modal-container').toggleClass('dp-block');
    };
    $('.open-modal').on('click', toggleModal);
    $('.close-modal').on('click', toggleModal);

    $('.close-modal').on('click', function (e) {
        e.preventDefault();
    });
    /****************************************************************************************/
    $('#insured_name_submit').click(function (ev) {
        var inputString = $('#editinsuredname').val();
        var induredId = $('#insuredId').val();
        if (inputString.length <= 2) {
            $('.modal-container').removeClass('dp-block');
            $('body').removeClass('body-locked');
            $('#editinsuredname').valid();
        } else {
            $.ajax({
                url: "/submission/getAmendmentInsuredName",
                data: 'queryString=' + inputString + '|' + induredId,
                success: function (msg) {
                    if (msg.length > 0 && msg != '<tr><td>No Record found</td></tr>') {
                        $('.insuredTable').find('tbody').html(msg);
                        $('#insuredsubmit').removeClass('dp-none');
                    } else if (msg == '<tr><td>No Record found</td></tr>') {
                        $('.insuredTable').find('tbody').html(msg);
                        $('#insuredsubmit').addClass('dp-none');

                    }
                }
            });
        }
    });
    /****************************************************************************************/
    $('#insuredsubmit').on('click', function (ev) {
        $('body').toggleClass('body-locked');
        $('.modal-container').toggleClass('dp-block');
        var inputString = $('.insuredTable').find('input:checked').val();
        if (inputString > 0) {
            $.ajax({
                url: "/submission/GetInsuredDetails",
                data: 'queryString=' + inputString,
                success: function (msg) {
                    msg = jQuery.parseJSON(msg);
                    $('#insuredId').val(msg.insuredId);
                    $('#editinsuredname').val(msg.insuredName);
                    $('#insured_address').val(msg.address);
                    $('#insured_country').val(msg.country);
                    $('#insured_state').val(msg.state);
                    $('#insured_city').val(msg.city);
                    $('#insured_zipcode').val(msg.zipcode);
                    $('#db_number').val(msg.dbnumber);
                    getInsuredContactPerson();
                }});
        } else {
            $('body').toggleClass('body-locked');
            $('.modal-container').toggleClass('dp-block');
            alert('Please select an insured name');
        }
    });
    /****************************************************************************************/
    var getInsuredContactPerson = function () {
        $('#editinsuredContactPersonEmail').val("");
        $('#editinsuredContactPersonNumber').val("");
        $('#editinsuredContactPersonMobile').val("");
        var InsuredId = $('#insuredId').val();
        if (InsuredId) {
            $('#editinsuredContactPerson').prop('disabled', false);
            var dataObj = {
                'header': {
                    'requestName': 'getInsureContactPerson'
                },
                'body': {
                    'data': {
                        'insuredId': InsuredId
                    }
                }
            };
            $.ajax('/submission/getInsureContactPerson', {
                'dataType': 'json',
                'data': JSON.stringify(dataObj),
                'type': 'post',
                'success': function (data, status, xhr) {
                    $('#editinsuredContactPerson').html('<option value ="0">--Select--</option>');
                    var contactPersonList = createContactPersonOption(data);
                    $('#editinsuredContactPerson').html(contactPersonList);
                }
            });
        }
    };
    /****************************************************************************************/
    var getBrokerContactPerson = function () {
        $('#edit_broker_contact_person_email').val("");
        $('#edit_borker_contact_peson_number').val("");
        $('#edit_borker_contact_peson_mobile').val("");
        var BrokerId = $('#brokerCode').val();
        var CountryId = $('#brokerCountryCode').val();
        var StateId = $('#brokerStateCode').val();
        var CityId = $('#brokerCityCode').val();
        if (BrokerId) {
            $('#broker_contact_person').prop('disabled', false);
            var dataObj = {
                'header': {
                    'requestName': 'getBrokerContactPerson'
                },
                'body': {
                    'data': {
                        'brokerId': BrokerId,
                        'countryId': CountryId,
                        'stateId': StateId,
                        'cityId': CityId
                    }
                }
            };
            $.ajax('/submission/getBrokerContactPerson', {
                'dataType': 'json',
                'data': JSON.stringify(dataObj),
                'type': 'post',
                'success': function (data, status, xhr) {
                    $('#broker_contact_person').html('<option value ="0">--Select--</option>');
                    var contactPersonList = createContactPersonOption(data);
                    $('#broker_contact_person').html(contactPersonList);
                    if ($('#hiddenBrokerContactPerson').length) {
                        var selectedBrokerContactPerson = $('#hiddenBrokerContactPerson').val();
                        $('#broker_contact_person').val(selectedBrokerContactPerson);
                        $('#broker_contact_person').trigger('change');
                        //$('#hiddenBrokerContactPerson').remove();
                    }
                }
            });
        }
    };

    var createContactPersonOption = function (data) {
        var selectBox = '<option value="0">--Select--</option>';
        if (data) {
            for (var i = 0; i < data.length; i += 1) {
                selectBox += '<option value="' + data[i].Id + '">' + data[i].ContactPerson + '</option>';
            }
        }
        return selectBox;
    };
    /****************************************************************************************/
    if ($('#hiddenInsuredContactPerson').val() != '') {
        $('#editinsuredContactPerson').prop('disabled', false);
    }
    /****************************************************************************************/
    $('#editinsuredContactPerson').change(function (ev) {
        $('#editinsuredContactPersonEmail').val("");
        $('#editinsuredContactPersonNumber').val("");
        $('#editinsuredContactPersonMobile').val("");
        var val = $(this).val();
        if (val == '0') {
            return false;
        } else {
            var dataObj = {
                'header': {
                    'requestName': 'getInsureContactPersonInformation'
                },
                'body': {
                    'data': val
                }
            };
            $.ajax('/submission/getInsureContactPersonInformation', {
                'dataType': 'json',
                'data': JSON.stringify(dataObj),
                'type': 'post',
                'success': function (data, status, xhr) {
                    if (data.length) {
                        $('#editinsuredContactPersonEmail').val(data[0]['contactPersonEmail']);
                        $('#editinsuredContactPersonNumber').val(data[0]['contactPersonPhone']);
                        $('#editinsuredContactPersonMobile').val(data[0]['contactPersonMobile']);
                    }
                }
            });
        }
    });
    /****************************************************************************************/
    $('#broker_contact_person').change(function (ev) {
        $('#edit_broker_contact_person_email').val("");
        $('#edit_borker_contact_peson_number').val("");
        $('#edit_borker_contact_peson_mobile').val("");
        var val = $(this).val();
        if (val == '0') {
            return false;
        } else {
            var dataObj = {
                'header': {
                    'requestName': 'getInsureContactPersonInformation'
                },
                'body': {
                    'data': val
                }
            };
            $.ajax('/submission/getInsureContactPersonInformation', {
                'dataType': 'json',
                'data': JSON.stringify(dataObj),
                'type': 'post',
                'success': function (data, status, xhr) {
                    if (data.length) {
                        $('#edit_broker_contact_person_email').val(data[0]['contactPersonEmail']);
                        $('#edit_borker_contact_peson_number').val(data[0]['contactPersonPhone']);
                        $('#edit_borker_contact_peson_mobile').val(data[0]['contactPersonMobile']);
                    }
                }
            });
        }
    });
    /****************************************************************************************/
    $('#editinsuredname').keyup(function (ev) {
        $('#insured_address').val("");
        $('#insured_country').val("");
        $('#insured_state').val("");
        $('#insured_city').val("");
        $('#insured_zipcode').val("");
        $('#db_number').val("");
        $('#editinsuredContactPerson').html('<option>--Select--</option>');
        $('#editinsuredContactPersonEmail').val("");
        $('#editinsuredContactPersonNumber').val("");
        $('#editinsuredContactPersonMobile').val("");
    });
    /****************************************************************************************/
    /* Code For Master User Start*/
    $('#productline_master').change(function (ev) {
        $('#editproductlinesubtype_master').html('<option value = "0">--Select--</option>');
        $('#editsection_master').html('<option value = "0">--Select--</option>');
        $('#editprofitcode_master').html('<option value = "0">--Select--</option>');
        var val = $(this).val();
        if (val == '0') {
            return false;
        }
        var dataObj = {
            'header': {
                'requestName': 'getSubmissionTypeForMaster'
            },
            'body': {
                'data': val
            }
        };
        $.ajax('/submission/getSubmissionTypeForMaster', {
            'dataType': 'json',
            'data': JSON.stringify(dataObj),
            'type': 'post',
            'success': function (data, status, xhr) {
                if (data.error) {
                    $('#editproductlinesubtype_master').html('<option value="NA">Not Applicable</option>');
                } else {
                    var options = createProductLineSubTypeOption(data);
                    $('#editproductlinesubtype_master').html(options);
                    if ($('#productLineSubTypeHiddenForMaster').length) {
                        var selectedSubmissionSubType = $('#productLineSubTypeHiddenForMaster').val();
                        $('#editproductlinesubtype_master').val(selectedSubmissionSubType);
                        $('#editproductlinesubtype_master').trigger('change');
                        $('#productLineSubTypeHiddenForMaster').remove();
                    }
                }
            }
        });
    }).trigger('change');
    /****************************************************************************************/
    $('#editproductlinesubtype_master').change(function (ev) {
        Coverage();
        $('#editsection_master').html('<option value = "0">--Select--</option>');
        $('#editprofitcode_master').html('<option value = "0">--Select--</option>');
        var val = $(this).val();
        var productLine = $('#productline_master').val();
        if (val == '0') {
            return false;
        }
        var dataObj = {
            'header': {
                'requestName': 'getSectionCodeForMaster'
            },
            'body': {
                'data': {
                    'productLineId': productLine,
                    'subTypeId': val
                }
            }
        };
        $.ajax('/submission/getSectionCodeForMaster', {
            'dataType': 'json',
            'data': JSON.stringify(dataObj),
            'type': 'post',
            'success': function (data, status, xhr) {
                var options = createSectionCodeOption(data);
                if (data.error) {
                    $('#editsection_master').html('<option value="722">Not Applicable</option>');
                    var dataObj = {
                        'header': {
                            'requestName': 'getProfitCodeDetailsBySubType'
                        },
                        'body': {
                            'data': val
                        }};
                    $.ajax('/submission/getProfitCodeDetailsBySubType', {
                        'dataType': 'json',
                        'data': JSON.stringify(dataObj),
                        'type': 'post',
                        'success': function (data, status, xhr) {
                            if (data.error) {
                                $('#editprofitcode_master').html('<option value="841">Not Applicable</option>');
                            } else {
                                $('#editprofitcode_master').html('<option>--Select--</option>');
                                var profitCodeList = createProfitCodeOption(data);
                                $('#editprofitcode_master').html(profitCodeList);
                                if ($('#profitCodeHiddenForMaster').length) {
                                    var selectedProfitCode = $('#profitCodeHiddenForMaster').val();
                                    $('#editprofitcode_master').val(selectedProfitCode);
                                    $('#profitCodeHiddenForMaster').remove();
                                }
                            }
                        }
                    });
                } else {
                    $('#editsection_master').html(options);
                    if ($('#sectionCodeHiddenForMaster').length) {
                        var selectedSectionCode = $('#sectionCodeHiddenForMaster').val();
                        $('#editsection_master').val(selectedSectionCode);
                        $('#editsection_master').trigger('change');
                        $('#sectionCodeHiddenForMaster').remove();
                    }
                }
            }
        });
    }).trigger('change');
    /****************************************************************************************/
    $('#editsection_master').change(function (ev) {
        $('#editprofitcode_master').html('<option value = "0">--Select--</option>');
        var val = $(this).val();
        var productLineType = $('#productline_master').val();
        var productLineSubTypeID = $('#editproductlinesubtype_master').val();
        if (val == '0') {
            return false;
        }
        var dataObj = {
            'header': {
                'requestName': 'getProfitCodeForMaster'
            },
            'body': {
                'data': {
                    'TypeID': productLineType,
                    'subTypeID': productLineSubTypeID,
                    'sectionCodeID': val
                }
            }
        };
        $.ajax('/submission/getProfitCodeForMaster', {
            'dataType': 'json',
            'data': JSON.stringify(dataObj),
            'type': 'post',
            'success': function (data, status, xhr) {
                var options = createProfitCodeOption(data);
                if (data.error) {
                    $('#editprofitcode_master').html('<option value="841">Not Applicable</option>');
                } else {
                    $('#editprofitcode_master').html(options);
                    if ($('#profitCodeHiddenForMaster').length) {
                        var selectedProfitCode = $('#profitCodeHiddenForMaster').val();
                        $('#editprofitcode_master').val(selectedProfitCode);
                        $('#profitCodeHiddenForMaster').remove();
                    }
                }
            }
        });
    });
    /****************************************************************************************/
    /* Code For Master User End*/
    /****************************************************************************************/
    $('input').bind('keypress', function (e) {
        if (e.keyCode == 13) {
            $('.modal-container').toggleClass('dp-block');
            $('body').toggleClass('body-locked');
        }
    });
    /****************************************************************************************/
    $('#brokerCountryCode').change(function (ev) {
        var country = $(this).val();
        var val = $('#brokerCode').val();
        $('#brokerCodeGen').val("");
        $('#brokerStateCode').html('<option value="0">--Select--</option>');
        $('#brokerCityCode').html('<option value="0">--Select--</option>');
        $('#broker_contact_person').html('<option value="0">--Select--</option>');
        if (val == '' || country == '') {
            $('#brokerStateCode').html('<option value="0">--Select--</option>');
            $('#brokerCityCode').html('<option value="0">--Select--</option>');
            return false;
        }
        if (country === '6' || val == '-1' || val == '-2') {
            $('#brokerStateCode').html('<option value="72">(Unknown)-000</option>');
            $('#brokerCityCode').html('<option value="388">(Unknown)-0000</option>');
            generateBrokerCode();
            getBrokerContactPerson();
        } else {
            var dataObj = {
                'header': {
                    'requestName': 'getBrokerState'
                },
                'body': {
                    'countryId': country,
                    'BrokerCode': val
                }
            };
            $.ajax('/submission/getBrokerState', {
                'dataType': 'json',
                'data': JSON.stringify(dataObj),
                'type': 'post',
                'success': function (data) {
                    if (data.length) {
                        var options = createSelectBoxStateWithClass(data);
                        $('#brokerStateCode').html(options);
                        if ($('#brokerStateCodeHidden').length) {
                            var selectedState = $('#brokerStateCodeHidden').val();
                            $('#brokerStateCode').val(selectedState);
                            $('#brokerStateCode').trigger('change');
                            $('#brokerStateCodeHidden').remove();
                        }
                    } else {
                        $('#brokerStateCode').html('<option value="91" selected="selected">Not Applicable-000</option>');
                        $('#brokerCityCode').html('<option value="882" selected="selected">Not Applicable-0000</option>');
                    }
                    generateBrokerCode();
                    getBrokerContactPerson();
                }
            });
        }

    }).trigger('change');
    /****************************************************************************************/
    $('#brokerStateCode').change(function (ev) {
        var state = $(this).val();
        var val = $('#brokerCode').val();
        $('#brokerCodeGen').val("");
        $('#brokerCityCode').html('<option value="0">--Select--</option>');
        $('#broker_contact_person').html('<option value="0">--Select--</option>');
        if (val == '0' || state == '0') {
            $('#brokerCityCode').html('<option value="0">--Select--</option>');
            return false;
        }
        if (state === '72') {
            $('#brokerCityCode').html('<option value="388">(Unknown)-0000</option>');
            getBrokerContactPerson();
        } else {
            var dataObj = {
                'header': {
                    'requestName': 'getBrokerCity'
                },
                'body': {
                    'stateId': state,
                    'BrokerCode': val
                }
            };
            $.ajax('/submission/getBrokerCity', {
                'dataType': 'json',
                'data': JSON.stringify(dataObj),
                'type': 'post',
                'success': function (data, status, xhr) {
                    if (data.length) {
                        var options = createSelectBoxBrokerCity(data);
                        $('#brokerCityCode').html(options);
                        if ($('#brokerCityCodeHidden').length) {
                            var selectedCity = $('#brokerCityCodeHidden').val();
                            $('#brokerCityCode').val(selectedCity);
                            $('#brokerCityCodeHidden').remove();
                        }
                    } else {
                        $('#brokerCityCode').html('<option value="882">Not Applicable-0000</option>');
                    }
                    generateBrokerCode();
                    getBrokerContactPerson();
                }
            });
        }
    });
    /****************************************************************************************/
    $('#brokerCityCode').change(function () {
        $('#brokerCodeGen').val("");
        $('#broker_contact_person').html('<option value="0">--Select--</option>');
        generateBrokerCode();
        getBrokerContactPerson();

    });
    /****************************************************************************************/
    var profitCodeID = $('#profitCodeHiddenForMaster').val();
    if (profitCodeID > 0) {
        var dataObjISO = {
            'header': {
                'requestName': 'GetIsoCode'
            },
            'body': {
                'data': {
                    'profirCodeId': profitCodeID
                }
            }
        };
        $.ajax('/submission/GetIsoCode', {
            'dataType': 'json',
            'data': JSON.stringify(dataObjISO),
            'type': 'post',
            'success': function (data, status, xhr) {
                if (data.error) {
                    $('#isccode').val('');
                } else {
                    $('#isccode').val(data[0].ISOCGL);
                }
            }
        });
    }

    $('#editamendmentclassName').change(function () {
        $("#editamendmentsubClass").val('');
        $("#editamendmentdescription").val('');
        var editAdmitted = $('#editadmitted option:selected').text();
        if ($('#editamendmentdescription').val() > 0 && (($("#primary_status").val() == '9' || $("#primary_status").val() == '11' || $("#primary_status").val() == '12') && editAdmitted == 'Admitted - NY FTZ')) {
            $("#editamendmentsubClass").prop('readOnly', false);
            $("#editamendmentsubClass").autocomplete({
                source: function (request, response) {
                    $.getJSON("/submission/GetSubClass", {
                        term: request.term,
                        clss:$('#editamendmentclassName').val()
                    }, response);
                },
                minLength: 1,
                select: function (event, ui) {
                    $(this).val(ui.item.value);

                    if (ui.item.value) {
                        var subclass = ui.item.value;
                        var cls = $('#editamendmentdescription').val();
                        var dataObj = {
                            'header': {
                                'requestName': 'GetDescription'
                            },
                            'body': {
                                'data': {'subclass': subclass, 'clss': cls},
                            }
                        };

                        $.ajax('/submission/GetDescription', {
                            dataType: 'json',
                            data: JSON.stringify(dataObj),
                            type: 'post',
                            success: function (data, status, xhr) {
                                if (data.desc.length) {
                                    document.getElementById('editamendmentdescription').value = data.desc;
                                }
                            },
                            error: function (xhr, status, error) {
                                var err = eval("(" + xhr.responseText + ")");
                                console.log(err.Message);
                            }
                        });
                    }
                }
            });
        }
        else {
            $('#editamendmentsubClass').prop('readOnly', true);
        }
        if ($(this).val() < 1) {
            $("#editamendmentsubClass").prop('readOnly', true);
        } else {
            $("#editamendmentsubClass").prop('readOnly', false);
        }
    });

    $('#editamendmentsubClass').blur(function () {
        if (($("#primary_status").val() == '11' || $("#primary_status").val() == '12') && $("#editamendmentclassName").val() > 0) {
            if ($("#editamendmentdescription").val().length < 1) {
                $("#editamendmentsubClass").val('');
            }
            if ($("#editamendmentsubClass").val().length < 1) {
                $("#editamendmentdescription").val('');
            }
        }
        if ($("#editamendmentsubClass").val().length < 5) {
            $("#editamendmentsubClass").val('');
            $("#editamendmentdescription").val('');
        }
    });

    var editAdmitted = $('#editadmitted option:selected').text();
    if (($("#primary_status").val() == '9' || $("#primary_status").val() == '11' || $("#primary_status").val() == '12') && editAdmitted == 'Admitted - NY FTZ') {
        $("#editamendmentclassName").removeClass('endowselect');
    }
    $('#primary_status').change(function () {
        var editAdmitted = $('#editadmitted option:selected').text();
        var primaryStatus = $("#primary_status").val();
        if ((primaryStatus == '11' || primaryStatus == '12') && editAdmitted == 'Admitted - NY FTZ') {
            $("#editamendmentclassName").removeClass('endowselect');
            $("#editamendmentsubClass").removeAttr('readOnly');

        } else {
            $("#editamendmentclassName").addClass('endowselect');
            $("#editamendmentsubClass").prop('readOnly', true);
        }
        if ($('#editamendmentclassName').val() > 0 && (($("#primary_status").val() == '9' || $("#primary_status").val() == '11' || $("#primary_status").val() == '12') && editAdmitted == 'Admitted - NY FTZ')) {
            $("#editamendmentsubClass").removeAttr('readOnly');
            $("#editamendmentsubClass").autocomplete({
                source: function (request, response) {
                    $.getJSON("/submission/GetSubClass", {
                        term: request.term,
                        clss:$('#editamendmentclassName').val()
                    }, response);
                },
                minLength: 1,
                select: function (event, ui) {
                    $(this).val(ui.item.value);

                    if (ui.item.value) {
                        var subclass = ui.item.value;
                        var cls = $('#editamendmentclassName').val();
                        var dataObj = {
                            'header': {
                                'requestName': 'GetDescription'
                            },
                            'body': {
                                'data': {'subclass': subclass, 'clss': cls},
                            }
                        };

                        $.ajax('/submission/GetDescription', {
                            dataType: 'json',
                            data: JSON.stringify(dataObj),
                            type: 'post',
                            success: function (data, status, xhr) {
                                if (data.desc.length) {
                                    document.getElementById('editamendmentdescription').value = data.desc;
                                }
                            },
                            error: function (xhr, status, error) {
                                var err = eval("(" + xhr.responseText + ")");
                                console.log(err.Message);
                            }
                        });
                    }
                }
            });
        }
        else {
            $('#editamendmentsubClass').prop('readOnly', true);
        }
    });
});


