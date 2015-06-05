$(document).ready(function (e) {
    /****************************************************************************************************/
    /*For Broker Country State City Functionality start*/
    $('#countrycode').change(function (ev) {
        var country = $(this).val();
        var val = $('#brokercode').val();
        $('#statecode').html('<option value="0">--Select--</option>');
        $('#citycode').html('<option value="0">--Select--</option>');
        $('#brokercontactperson').val("");
        $('#broker_contact_person_email').val("");
        $('#borker_contact_peson_number').val("");
        $('#borker_contact_peson_mobile').val("");
        $('#brokerCodegenerate').val("");
        if (country === '6') {
            $('#statecode').html('<option value="72">(Unknown)-000</option>');
            $('#citycode').html('<option value="388">(Unknown)-0000</option>');
            generateBrokerCode();
            getBrokerContactPerson();
        } else if (country !== '') {
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
                'success': function (data, status, xhr) {
                    var options;
                    if (data.length) {
                        if ($('#brokercode option:selected').hasClass('R')) {
                            options = createSelectBoxStateWithClass(data);
                        } else {
                            options = createSelectBoxStateBroker(data);
                        }
                    } else {
                        options = ('<option selected="selected" value="NA">Not Applicable</option>');
                        $('#citycode').html('<option selected="selected" value="NA">Not Applicable</option>');
                    }
                    $('#statecode').html(options);
                    generateBrokerCode();
                }
            });
        }
    });
    /****************************************************************************************************/
    $('#statecode').change(function (ev) {
        var state = $(this).val();
        var val = $('#brokercode').val();
        $('#citycode').html('<option value="0">--Select--</option>');
        $('#brokercontactperson').val("");
        $('#broker_contact_person_email').val("");
        $('#borker_contact_peson_number').val("");
        $('#borker_contact_peson_mobile').val("");
        $('#brokerCodegenerate').val("");
        if ($('#statecode').val() === '72') {
            $('#citycode').html('<option value="388">(Unknown)-0000</option>');
            getBrokerContactPerson();
        } else if (state !== '0') {
            var dataObj = {
                'header': {'requestName': 'getBrokerCity'
                },
                'body': {'stateId': state,
                    'BrokerCode': val
                }
            };
            $.ajax('/submission/getBrokerCity', {
                'dataType': 'json',
                'data': JSON.stringify(dataObj),
                'type': 'post',
                'success': function (data, status, xhr) {
                    var options;
                    options = createSelectBoxBrokerCity(data);
                    if (data.length) {
                        $('#citycode').html(options);
                    } else {
                        $('#citycode').html('<option selected="selected" value="NA">Not Applicable</option>');
                    }
                    generateBrokerCode();
                }
            });
        }
    });
    /*For Broker Country State City Functionality End*/
    /****************************************************************************************************/
    $('#citycode').change(function (e) {
        $('#brokercontactperson').val("");
        $('#broker_contact_person_email').val("");
        $('#borker_contact_peson_number').val("");
        $('#borker_contact_peson_mobile').val("");
        $('#brokerCodegenerate').val("");
        generateBrokerCode();
        getBrokerContactPerson();
    });
    /****************************************************************************************************/
    $('#brokercode').change(function (ev) {
        var val = $(this).val();
        $('#countrycode').html('<option value="0">--Select--</option>');
        $('#statecode').html('<option value="0">--Select--</option>');
        $('#citycode').html('<option value="0">--Select--</option>');
        $('#brokercontactperson').val("");
        $('#broker_contact_person_email').val("");
        $('#borker_contact_peson_number').val("");
        $('#borker_contact_peson_mobile').val("");
        $('#brokerCodegenerate').val("");
        generateBrokerCode();
        /***************For Broker Type***************/
        if (val) {
            if (val == '-1' || val == '-2') {
                $('#isWholesaler').val('Unknown');
            } else if (val == '0') {
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
                                $('#retailcountrycode').prop('disabled', true);
                                $('#retailstatecode').prop('disabled', true);
                                $('#retailcitycode').prop('disabled', true);
                                $('#retailBrokerName').val("");
                                $('#retailcountrycode').val("");
                                $('#retailstatecode').val("");
                                $('#retailcitycode').val("");
                                $('#retailBrokerName').removeClass('error');
                                $('label[for=retailBrokerName]').remove();
                                $('#retailcountrycode').removeClass('error');
                                $('label[for=retailcountrycode]').remove();
                                $('#retailstatecode').removeClass('error');
                                $('label[for=retailstatecode]').remove();
                                $('#retailcitycode').removeClass('error');
                                $('label[for=retailcitycode]').remove();
                            } else if (data[0]['cat'] == 'W') {
                                brokertype = 'Wholesaler';
                                $('#retailBrokerName').prop('disabled', false);
                                $('#retailcountrycode').prop('disabled', false);
                                $('#retailstatecode').prop('disabled', false);
                                $('#retailcitycode').prop('disabled', false);
                            }
                            $('#isWholesaler').val(brokertype);
                            $('#brokerId').val(data[0]['Id']);
                        }
                    }
                });
            }
        } else {
            return false;
        }
        /***************For Broker Country*****************/
        if (val) {
            if (val == '-1' || val == '-2') {
                $('#countrycode').html('<option value="6">000-Unknown</option>');
                $('#statecode').html('<option value="72">(Unknown)-000</option>');
                $('#citycode').html('<option value="388">(Unknown)-0000</option>');
                $('#brokerCodegenerate').val('Unknown');
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
                        $('#countrycode').html(countryList);
                    }
                });
            }
        } else {
            return false;
        }

    });
    /****************************************************************************************************/
    var generateBrokerCode = function () {
        if ($('#brokercode').val() !== '0' && $('#countrycode').val() !== '0' && $('#statecode').val() !== '0' && $('#citycode').val() !== '0') {
            var code = $('#brokercode option:selected').val() + '-' + $('#countrycode option:selected').text().slice(0, 3) + '-' + $('#statecode option:selected').text().slice(-3) + '-' + $('#citycode option:selected').text().slice(-4);
            if ($('#countrycode').val() == '6' || $('#statecode').val() == '72' || $("#citycode option:selected").text() == '(Unknown)-0000') {
                $('#brokerCodegenerate').val('Unknown');
            } else {
                $('#brokerCodegenerate').val(code);
            }
            $('#brokerCodeGen1').val(code);
        }
    };
    /****************************************************************************************************/
    $('#projectcountry').change(function (ev) {
        var val = $(this).val();
        $('#projectstate').html('<option value="0">--Select--</option>');
        $('#projectcity').html('<option value="0">--Select--</option>');
        if (val == '0') {
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
                var options = createSelectBoxState(data);
                if (data.length) {
                    $('#projectstate').html(options);
                } else {
                    $('#projectstate').html('<option value="159">Not Applicable</option>');
                    $('#projectcity').html('<option value="1307">Not Applicable</option>');
                }
            }
        });
    });
    /****************************************************************************************************/
    $('#projectstate').change(function (ev) {
        var val = $(this).val();
        if (val == '0') {
            $('#projectcity').html('<option value="0">--Select--</option>');
            return false;
        }
        var dataObj = {
            'header': {
                'requestName': 'getCity'
            },
            'body': {
                'data': val
            }};
        $.ajax('/submission/getCity', {
            'dataType': 'json',
            'data': JSON.stringify(dataObj),
            'type': 'post',
            'success': function (data, status, xhr) {
                var options = createSelectBoxCity(data);
                if (data.length) {
                    $('#projectcity').html(options);
                } else {
                    $('#projectcity').html('<option value="1307">Not Applicable</option>');
                }
            }
        });
    });
    /****************************************************************************************************/
    $('#retailcountrycode').change(function (ev) {
        var val = $(this).val();
        $('#retailstatecode').html('<option value="0">--Select--</option>');
        $('#retailcitycode').html('<option value="0">--Select--</option>');
        if (val == '0') {
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
                var options = createSelectBoxStateRetailBroker(data);
                if (data.length) {
                    $('#retailstatecode').html(options);
                } else {
                    $('#retailstatecode').html('<option value="159">Not Applicable</option>');
                    $('#retailcitycode').html('<option value="1307">Not Applicable</option>');
                }
            }
        });
    });
    /****************************************************************************************************/
    $('#retailstatecode').change(function (ev) {
        var val = $(this).val();
        $('#retailcitycode').html('<option value="0">--Select--</option>');
        if (val == '0') {
            return false;
        }
        var dataObj = {
            'header': {
                'requestName': 'getRetailBrokerCity'
            },
            'body': {
                'data': val
            }};
        $.ajax('/submission/getRetailBrokerCity', {
            'dataType': 'json',
            'data': JSON.stringify(dataObj),
            'type': 'post',
            'success': function (data, status, xhr) {
                var options = createSelectBoxRetailBrokerCity(data);
                if (data.length) {
                    $('#retailcitycode').html(options);
                } else {
                    $('#retailcitycode').html('<option value="1307">Not Applicable</option>');
                }
            }});
    });
    /****************************************************************************************************/
    $('#underwriter').change(function (ev) {
        var underwriterID = $('#underwriter').val();
        $('#product_line_subtype').html('<option>--Select--</option>');
        $('#section').html('<option>--Select--</option>');
        $('#profitcode').html('<option>--Select--</option>');
        if (underwriterID == '0') {
            $('#product_line').val("");
            return false;
        } else if (underwriterID) {
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
                    if (data.error) {
                        $('#product_line_subtype').html('<option value="434">Not Applicable</option>');
                    } else {
                        $('#product_line').val(data.lobDetail[0].LOBName);
                        $('#productLinePrefix').val(data.lobDetail[0].Prefix);
                        $('#product_line_subtype').html('<option>--Select--</option>');
                        var productlinesubtypeList = createProductLineSubTypeOption(data.lobsubtypeDetail);
                        $('#product_line_subtype').html(productlinesubtypeList);
                    }
                }
            });
        } else {
            return false;
        }
    });
    /****************************************************************************************************/
    var createProductLineSubTypeOption = function (data) {
        var selectBox = '<option value="0">--Select--</option>';
        for (var i = 0; i < data.length; i += 1) {
            selectBox += '<option value="' + data[i].Id + '">' + data[i].ProductLineSubType + '</option>';
        }
        return selectBox;
    };
    /****************************************************************************************************/
    $('#product_line_subtype').change(function (ev) {
        $('#section').html('<option>--Select--</option>');
        $('#profitcode').html('<option>--Select--</option>');
        var productLineType = $('#product_line').val();
        var productLineSubTypeID = $('#product_line_subtype').val();
        if ((productLineSubTypeID == '21') || (productLineSubTypeID == '22') || (productLineSubTypeID == '23') || (productLineSubTypeID == '24') || (productLineSubTypeID == '25') || (productLineSubTypeID == '434')) {
            $('#section').html('<option value="709">Not Available</option>');
            $('#profitcode').html('<option value="840">Not Available</option>');
            return false;
        } else if ((productLineSubTypeID == '0')) {
            $('#section').html('<option>--Select--</option>');
            $('#profitcode').html('<option>--Select--</option>');
        } else {
            var dataObj = {
                'header': {
                    'requestName': 'getSectionCodeDetails'
                },
                'body': {
                    'data': {
                        'productLineId': productLineType,
                        'subTypeId': productLineSubTypeID
                    }
                }
            };
            $.ajax('/submission/getSectionCodeDetails', {
                'dataType': 'json', 'data': JSON.stringify(dataObj),
                'type': 'post',
                'success': function (data, status, xhr) {
                    if (data.error) {
                        $('#section').html('<option value="722">Not Applicable</option>');
                        var dataObj = {
                            'header': {
                                'requestName': 'getProfitCodeDetailsBySubType'
                            },
                            'body': {
                                'data': productLineSubTypeID
                            }};
                        $.ajax('/submission/getProfitCodeDetailsBySubType', {
                            'dataType': 'json',
                            'data': JSON.stringify(dataObj),
                            'type': 'post',
                            'success': function (data, status, xhr) {
                                if (data.error) {
                                    $('#profitcode').html('<option value="841">Not Applicable</option>');
                                } else {
                                    $('#profitcode').html('<option>--Select--</option>');
                                    var profitCodeList = createProfitCodeOption(data);
                                    $('#profitcode').html(profitCodeList);
                                }
                            }
                        });
                    } else {
                        $('#section').html('<option>--Select--</option>');
                        var sectionCodeList = createSectionCodeOption(data);
                        $('#section').html(sectionCodeList);
                    }
                }
            });
        }
    });
    /****************************************************************************************************/
    var createSectionCodeOption = function (data) {
        var selectBox = '<option value="0">--Select--</option>';
        for (var i = 0; i < data.length; i += 1) {
            selectBox += '<option value="' + data[i].Id + '">' + data[i].SectionCode + '</option>';
        }
        selectBox += '<option value="721">To Be Entered</option>';
        return selectBox;
    };
    /****************************************************************************************************/
    $('#section').change(function (ev) {
        $('#profitcode').html('<option>--Select--</option>');
        var productLineType = $('#product_line').val();
        var productLineSubTypeID = $('#product_line_subtype').val();
        var sectionCodeID = $('#section').val();
        if (!sectionCodeID) {
            return false;
        } else if (sectionCodeID == '721') {
            $('#profitcode').html('<option value="844">To Be Entered</option>');
        } else {
            var dataObj = {
                'header': {
                    'requestName': 'getProfitCodeDetails'
                },
                'body': {
                    'data': {
                        'TypeID': productLineType,
                        'subTypeID': productLineSubTypeID,
                        'sectionCodeID': sectionCodeID
                    }
                }
            };
            $.ajax('/submission/getProfitCodeDetails', {
                'dataType': 'json',
                'data': JSON.stringify(dataObj),
                'type': 'post',
                'success': function (data, status, xhr) {
                    if (data.error) {
                        $('#profitcode').html('<option value="841">Not Applicable</option>');
                    } else {
                        $('#profitcode').html('<option>--Select--</option>');
                        var profitCodeList = createProfitCodeOption(data);
                        $('#profitcode').html(profitCodeList);
                    }
                }
            });
        }
    });
    /****************************************************************************************************/
    var createProfitCodeOption = function (data) {
        var selectBox = '<option value="0">--Select--</option>';
        for (var i = 0; i < data.length; i += 1) {
            selectBox += '<option value="' + data[i].Id + '">' + data[i].ProfitCodeName + '</option>';
        }
        selectBox += '<option value="844">To Be Entered</option>';
        return selectBox;
    };
    /****************************************************************************************************/
    $('#dbnumber').val('Not Available');
    $('#dbnumber').focus(function (ev) {
        if ($(this).val() == 'Not Available') {
            $(this).val('');
        }
    });
    $('#dbnumber').blur(function (ev) {
        if ($(this).val() == '') {
            $(this).val('Not Available');
            $(this).removeClass('error');
            $('label[for=dbnumber]').css('display', 'none');
        }
    });
    /****************************************************************************************************/
    var createBrokerCountryOption = function (data) {
        var selectBox = '<option value="">--Select--</option>';
        for (var i = 0; i < data.length; i += 1) {
            selectBox += '<option value="' + data[i].Id + '">' + data[i].InsuredCountry + '</option>';
        }
        return selectBox;
    };
    /****************************************************************************************************/
    var createSelectBoxState = function (data) {
        var selectBox = '<option value="0">--Select--</option>';
        for (var i = 0; i < data.length; i += 1) {
            selectBox += '<option value="' + data[i].Id + '">' + data[i].ProjectCode + '</option>';
        }
        return selectBox;
    };
    /****************************************************************************************************/
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
    /****************************************************************************************************/
    var createSelectBoxStateWithClass = function (data) {
        var selectBox = '<option value="0">--Select--</option>';
        for (var i = 0; i < data.length; i += 1) {
            selectBox += '<option value="' + data[i].Id + '" class="' + data[i].StateCode + '">' + data[i].FullCode + '</option>';
        }
        return selectBox;
    };
    /****************************************************************************************************/
    var createSelectBoxCity = function (data) {
        var selectBox = '<option value="0">--Select--</option>';
        for (var i = 0; i < data.length; i += 1) {
            selectBox += '<option value="' + data[i].Id + '">' + data[i].City + '</option>';
        }
        return selectBox;
    };
    /****************************************************************************************************/
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
    /****************************************************************************************************/
    $('#insured_name_submit').click(function (ev) {
        var inputString = $('#insuredName').val();
        if (inputString.length <= 2) {
            $('.modal-container').removeClass('dp-block');
            $('body').removeClass('body-locked');
            $('#insuredName').valid();
        } else {
            $.ajax({
                url: "/submission/GetInsuredName",
                data: 'queryString=' + inputString, success: function (msg) {
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
    /****************************************************************************************************/
    var toggleModal = function () {
        $('body').toggleClass('body-locked');
        $('.modal-container').toggleClass('dp-block');
    };
    $('.open-modal').on('click', toggleModal);
    $('.close-modal').on('click', toggleModal);

    $('.close-modal').on('click', function (e) {
        e.preventDefault();
    });
    /****************************************************************************************************/
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
                    $('#insuredName').val(msg.insuredName);
                    $('#insured_address').val(msg.address);
                    $('#insured_country').val(msg.country);
                    $('#insured_state').val(msg.state);
                    $('#insured_city').val(msg.city);
                    $('#insured_zipcode').val(msg.zipcode);
                    $('#dbnumber').val(msg.dbnumber);
                    getInsuredContactPerson();
                }
            });

        } else {
            $('body').toggleClass('body-locked');
            $('.modal-container').toggleClass('dp-block');
            alert('Please select an  insured name');
        }
    });
    /****************************************************************************************************/
    var getInsuredContactPerson = function () {
        $('#insuredContactPersonEmail').val("");
        $('#insuredContactPersonNumber').val("");
        $('#insuredContactPersonMobile').val("");
        var InsuredId = $('#insuredId').val();
        if (InsuredId) {
            $('#insuredContactPerson').prop('disabled', false);
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
                    $('#insuredContactPerson').html('<option value ="0">--Select--</option>');
                    var contactPersonList = createContactPersonOption(data);
                    $('#insuredContactPerson').html(contactPersonList);
                }
            });
        }
    };
    /****************************************************************************************************/
    var getBrokerContactPerson = function () {
        $('#broker_contact_person_email').val("");
        $('#borker_contact_peson_number').val("");
        $('#borker_contact_peson_mobile').val("");
        var BrokerId = $('#brokercode').val();
        var CountryId = $('#countrycode').val();
        var StateId = $('#statecode').val();
        var CityId = $('#citycode').val();
        if (BrokerId) {
            $('#brokercontactperson').prop('disabled', false);
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
                    $('#brokercontactperson').html('<option value ="0">--Select--</option>');
                    var contactPersonList = createContactPersonOption(data);
                    $('#brokercontactperson').html(contactPersonList);
                }
            });
        }
    };
    /****************************************************************************************************/
    var createContactPersonOption = function (data) {
        var selectBox = '<option value="0">--Select--</option>';
        for (var i = 0; i < data.length; i += 1) {
            selectBox += '<option value="' + data[i].Id + '">' + data[i].ContactPerson + '</option>';
        }
        return selectBox;
    };

    $('#insuredContactPerson').change(function (ev) {
        $('#insuredContactPersonEmail').val("");
        $('#insuredContactPersonNumber').val("");
        $('#insuredContactPersonMobile').val("");
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
                        $('#insuredContactPersonEmail').val(data[0]['contactPersonEmail']);
                        $('#insuredContactPersonNumber').val(data[0]['contactPersonPhone']);
                        $('#insuredContactPersonMobile').val(data[0]['contactPersonMobile']);
                    }
                }
            });
        }
    });
    /****************************************************************************************************/
    $('#brokercontactperson').change(function (ev) {
        $('#broker_contact_person_email').val("");
        $('#borker_contact_peson_number').val("");
        $('#borker_contact_peson_mobile').val("");
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
                        $('#broker_contact_person_email').val(data[0]['contactPersonEmail']);
                        $('#borker_contact_peson_number').val(data[0]['contactPersonPhone']);
                        $('#borker_contact_peson_mobile').val(data[0]['contactPersonMobile']);
                    }
                }
            });
        }
    });
    /****************************************************************************************************/
    $('#insuredName').keyup(function (ev) {
        $('#insured_address').val("");
        $('#insured_country').val("");
        $('#insured_state').val("");
        $('#insured_city').val("");
        $('#insured_zipcode').val("");
        $('#dbnumber').val("");
        $('#insuredContactPerson').html('<option>--Select--</option>');
        $('#insuredContactPersonEmail').val("");
        $('#insuredContactPersonNumber').val("");
        $('#insuredContactPersonMobile').val("");
    });
    /****************************************************************************************************/
    $('#new_renewal').change(function (ev) {
        var val = $(this).val();
        $('#primarystatus').html('<option value="0">--Select--</option>');
        if (val == '0') {
            return false;
        }
        if (val == '3') {
            $('#primarystatus').html('<option selected="selected" value="2">Working</option>');
            $('#primarystatus').valid();
        } else if (val == '4') {
            $('#primarystatus').html('<option selected="selected" value="0">-Select-</option><option value="2">Working</option><option value="1">Preworking</option><option value="13">Renewal Pending</option>');
            $('#primarystatus').valid();
        }
    });
    /****************************************************************************************************/
    $('#product_line_master').change(function (ev) {
        $('#product_line_subtype_master').html('<option>--Select--</option>');
        $('#section_master').html('<option>--Select--</option>');
        $('#profitcode_master').html('<option>--Select--</option>');
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
                var options = createProductLineSubTypeOption(data);

                if (data.length) {
                    $('#product_line_subtype_master').html(options);
                } else {
                    $('#product_line_subtype_master').html('<option value="NA">Not Applicable</option>');
                }
            }
        });
    });
    /****************************************************************************************************/
    $('#product_line_subtype_master').change(function (ev) {
        $('#section_master').html('<option>--Select--</option>');
        $('#profitcode_master').html('<option>--Select--</option>');
        var val = $(this).val();
        var productLine = $('#product_line_master').val();
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
                if (data.error) {
                    $('#section_master').html('<option value="722">Not Applicable</option>');
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
                                $('#profitcode_master').html('<option value="841">Not Applicable</option>');
                            } else {
                                $('#profitcode_master').html('<option value ="0">--Select--</option>');
                                var profitCodeList = createProfitCodeOption(data);
                                $('#profitcode_master').html(profitCodeList);
                            }
                        }
                    });
                } else {
                    var options = createSectionCodeOption(data);
                    $('#section_master').html(options);
                }
            }
        });
    });
    /****************************************************************************************************/
    $('#section_master').change(function (ev) {
        $('#profitcode_master').html('<option>--Select--</option>');
        var val = $(this).val();
        var productLineType = $('#product_line_master').val();
        var productLineSubTypeID = $('#product_line_subtype_master').val();
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
                if (data.error) {
                    $('#profitcode_master').html('<option value="841">Not Applicable</option>');
                } else {
                    var options = createProfitCodeOption(data);
                    $('#profitcode_master').html(options);
                }
            }
        });
    });
    /****************************************************************************************************/
    $('input').bind('keypress', function (e) {
        if (e.keyCode == 13) {
            $('.modal-container').toggleClass('dp-block');
            $('body').toggleClass('body-locked');
        }
    });
    /****************************************************************************************************/
//    $('#primarystatus_master').change(function (ev) {
//        $('#coverage').val("");
//        var lobval = $('#product_line_master').val();
//        var ulobval = $('#product_line').val();
//        var val = $(this).val();
//        var lobsubval = $('#product_line_subtype').val();
//        if (val == '0') {
//            return false;
//        } else {
//            var dataObj = {
//                'header': {
//                    'requestName': 'getCoverage'
//                },
//                'body': {
//                    'data': {
//                        'status': val,
//                        'lobvalue': lobval,
//                        'userLob': ulobval,
//                        'Lobsub': lobsubval
//                    }
//                }
//            };
//            $.ajax('/submission/getCoverage', {
//                'dataType': 'json',
//                'data': JSON.stringify(dataObj),
//                'type': 'post',
//                'success': function (data, status, xhr) {
//                    if (data.length) {
//                        var options = createCoverageOption(data);
//                        $('#coverage').html(options);
//                    }
//                }
//            });
//        }
//    });
    /****************************************************************************************************/
    var createCoverageOption = function (data) {
        var selectBox = '<option value="0">--Select--</option>';
        for (var i = 0; i < data.length; i += 1) {
            selectBox += '<option value="' + data[i].Id + '">' + data[i].Name + '</option>';
        }
        return selectBox;
    };
    /****************************************************************************************************/
    if ($('#isWholesaler').val() == 'Retailer') {
        $('#retailBrokerName').prop('disabled', true);
        $('#retailcountrycode').prop('disabled', true);
        $('#retailstatecode').prop('disabled', true);
        $('#retailcitycode').prop('disabled', true);
    } else if ($('#isWholesaler').val() == 'Wholesaler') {
        $('#retailBrokerName').prop('disabled', false);
        $('#retailcountrycode').prop('disabled', false);
        $('#retailstatecode').prop('disabled', false);
        $('#retailcitycode').prop('disabled', false);
    }
    /****************************************************************************************************/
    $(function () {
        $(document).click(function (e)
        {
            var container = $(".dropdown");

            if (!container.is(e.target) // if the target of the click isn't the container...
                    && container.has(e.target).length === 0) // ... nor a descendant of the container
            {
                container.removeClass("is-active");
            }
        });
        $(".dropdown").click(function () {
            $(this).toggleClass("is-active");
        });
        $(".dropdown ul").click(function (e) {
            e.stopPropagation();
        });
    });

    $('#selectAllCompany').click(function (event) {
        if (this.checked) {
            $('.checkCabVal').each(function () {
                this.checked = true;
            });
            getCabCompany();
            $("#cabValue").removeClass('error');
            $("label[for=cabValue]").text('');
        } else {
            $('.checkCabVal').each(function () {
                this.checked = false;
            });
            $("#cabValue").val('');
        }
    });
    $('.checkCabVal').click(function (event) {
        getCabCompany();
        var numofcheck = $('.checkCabVal:checked').length;
        var numoflob = $('.checkCabVal').length;
        if (numofcheck == numoflob) {
            $('#selectAllCompany').prop('checked', 'checked');
        } else {
            $('#selectAllCompany').prop('checked', '');
        }
    });

    function getCabCompany() {
        var brancharray = new Array();
        var i = 0;
        $('.checkCabVal').each(function (event) {
            if (this.checked) {
                brancharray[i] = $(this).val();
                i = i + 1;
            }
        });
        var cabValues = brancharray.toString();
        $("#cabValue").val(cabValues.split(/[,]+/).filter(function (v) {
            return v !== ''
        }).join(' & '));
    }
    var numofcheck = $('.checkCabVal:checked').length;
    var numoflob = $('.checkCabVal').length;
    if (numofcheck == numoflob) {
        $('#selectAllCompany').prop('checked', 'checked');
    } else {
        $('#selectAllCompany').prop('checked', '');
    }
    /****************************************************************************************************/
    $('#profitcode').change(function (ev) {
        var productLineType = $('#product_line').val();
        if (productLineType == 'Casualty') {
            getISOCode();
        }
    });

    var getISOCode = function () {
        var ProfitCodeId = $('#profitcode').val();
        if (ProfitCodeId) {
            $('#isccode').prop('disabled', false);
            var dataObj = {
                'header': {
                    'requestName': 'getIsoCode'
                },
                'body': {
                    'data': {
                        'profirCodeId': ProfitCodeId
                    }
                }
            };
            $.ajax('/submission/getIsoCode', {
                'dataType': 'json',
                'data': JSON.stringify(dataObj),
                'type': 'post',
                'success': function (data, status, xhr) {
                    if (data.error) {
                        $('#isccode').val("");
                    } else {
                        if (data[0].ISOCGL == 'NULL') {
                            $('#isccode').val("");
                        } else {
                            $('#isccode').val(data[0].ISOCGL);
                        }
                    }
                }
            });
        }
    };

    $('#profitcode_master').change(function (ev) {
        var productLineType = $('#product_line_master').val();
        if (productLineType == '2') {
            getISOCodeForMaster();
        }
    });

    var getISOCodeForMaster = function () {
        var ProfitCodeId = $('#profitcode_master').val();
        if (ProfitCodeId) {
            $('#isccode').prop('disabled', false);
            var dataObj = {
                'header': {
                    'requestName': 'getIsoCode'
                },
                'body': {
                    'data': {
                        'profirCodeId': ProfitCodeId
                    }
                }
            };
            $.ajax('/submission/getIsoCode', {
                'dataType': 'json',
                'data': JSON.stringify(dataObj),
                'type': 'post',
                'success': function (data, status, xhr) {
                    if (data.error) {
                        $('#isccode').val("");
                    } else {
                        if (data[0].ISOCGL == 'NULL') {
                            $('#isccode').val("");
                        } else {
                            $('#isccode').val(data[0].ISOCGL);
                        }
                    }
                }
            });
        }
    };
});

