$(document).ready(function (e) {
    $('input[readonly]').focus(function(){
        this.blur();
    });
    $("#editamendmentsubClass").attr('readonly','readonly');
    setTimeout(function () {
        $.validator.setDefaults({
            ignore: []
        });
        /*For trim the value start*/
        /****************************************************************************************/
        $('#insured_name_dnb').blur(function (ev) {
            $(this).val($.trim($(this).val()));
        });
        $('#reinsured_company').blur(function (ev) {
            $(this).val($.trim($(this).val()));
        });
        $('#project_name').blur(function (ev) {
            $(this).val($.trim($(this).val()));
        });
        $('#general_contrator_name').blur(function (ev) {
            $(this).val($.trim($(this).val()));
        });
        $('#project_owner_name').blur(function (ev) {
            $(this).val($.trim($(this).val()));
        });
        $('#project_street_address').blur(function (ev) {
            $(this).val($.trim($(this).val()));
        });
        $('#broker_contact_person').blur(function () {
            $(this).val($.trim($(this).val()));
        });
        $('#broker_contact_person_email').blur(function () {
            $(this).val($.trim($(this).val()));
        });
        $('#borker_contact_peson_number').blur(function () {
            $(this).val($.trim($(this).val()));
        });

        /*For trim the value end*/
        /****************************************************************************************/
        $('#editPrecentageLayer').blur(function (ev) {
            var num = $('#editPrecentageLayer').val();
            var numInt = isNaN($('#editPrecentageLayer').val());
            if (num) {
                if (numInt == false) {
                    var val = parseFloat(num).toFixed(2);
                    $('#editPrecentageLayer').val(val);
                }
            }
        });
        $('#editpolicyCommision').blur(function (ev) {
            var num = $('#editpolicyCommision').val();
            var numInt = isNaN($('#editpolicyCommision').val());
            if (num) {
                if (numInt == false) {
                    var val = parseFloat(num).toFixed(2);
                    $('#editpolicyCommision').val(val);
                }
            }
        });
        $('#editselfRetrntionLocalCurrency').blur(function (ev) {
            var num = $('#editselfRetrntionLocalCurrency').val();
            var numInt = isNaN($('#editselfRetrntionLocalCurrency').val());
            if (num) {
                if (numInt == false) {
                    var val = parseFloat(num).toFixed(2);
                    $('#editselfRetrntionLocalCurrency').val(val);
                }
            }
        });
        $('#editLayerLimitLocalCurrency').blur(function (ev) {
            var num = $('#editLayerLimitLocalCurrency').val();
            var numInt = isNaN($('#editLayerLimitLocalCurrency').val());
            if (num) {
                if (numInt == false) {
                    var val = parseFloat(num).toFixed(2);
                    $('#editLayerLimitLocalCurrency').val(val);
                }
            }
        });
        $('#gross_premium').blur(function (ev) {
            var num = $('#gross_premium').val();
            var numInt = isNaN($('#gross_premium').val());

            if (num) {
                if (numInt == false) {
                    var val = parseFloat(num).toFixed(2);
                    if ($('input[name="premiumType"]:checked').val() == 'RP') {
                        val = -Math.abs(val);
                        val = parseFloat(val).toFixed(2);
                        $('#gross_premium').val(val);
                    } else if ($('input[name="premiumType"]:checked').val() == 'AP') {
                        val = Math.abs(val);
                        val = parseFloat(val).toFixed(2);
                        $('#gross_premium').val(val);
                    } else {
                        val = Math.abs(val);
                        val = parseFloat(val).toFixed(2);
                        $('#gross_premium').val(val);
                    }

                }
            }
        });

        $('.ptype').click(function (ev) {
            var premiumType = $('input[name="premiumType"]:checked').val();
            var num = $('#gross_premium').val();
            var editlocalCurrency = $('#editlocalCurrency').val();
            var editpolicyCommisionLocalCurrrency = $('#editpolicyCommisionLocalCurrrency').val();
            var editpolicyCommisionUSD = $('#editpolicyCommisionUSD').val();
            var editPermiumLocalCurency = $('#editPermiumLocalCurency').val();
            var editPermiumUSD = $('#editPermiumUSD').val();
            var exchrate = $("#editexchangeRate").val();
            var policycommission_perc = $('#editpolicyCommision').val();

            var numInt = isNaN($('#gross_premium').val());
            if (num) {
                if (numInt == false) {
                    var val = parseFloat(num).toFixed(2);

                    if (premiumType == 'RP') {
                        val = -Math.abs(val);
                        val = parseFloat(val).toFixed(2);
                        $('#gross_premium').val(val);

                        editlocalCurrency = -Math.abs(val * exchrate);
                        $('#editlocalCurrency').val(editlocalCurrency);
                        $('#editlocalCurrency').formatCurrency();

                        editpolicyCommisionLocalCurrrency = (val * policycommission_perc) / 100;
                        editpolicyCommisionLocalCurrrency = -Math.abs(editpolicyCommisionLocalCurrrency);
                        $('#editpolicyCommisionLocalCurrrency').val(editpolicyCommisionLocalCurrrency);
                        $('#editpolicyCommisionLocalCurrrency').val(editpolicyCommisionLocalCurrrency.toFixed(2));

                        editpolicyCommisionUSD = (editlocalCurrency * policycommission_perc) / 100;
                        editpolicyCommisionUSD = -Math.abs(editpolicyCommisionUSD);
                        editpolicyCommisionUSD = editpolicyCommisionUSD.toFixed(2);
                        $('#editpolicyCommisionUSD').val(editpolicyCommisionUSD);
                        $('#editpolicyCommisionUSD').formatCurrency();

                        editPermiumLocalCurency = val - editpolicyCommisionLocalCurrrency;
                        editPermiumLocalCurency = -Math.abs(editPermiumLocalCurency);
                        editPermiumLocalCurency = editPermiumLocalCurency.toFixed(2);
                        $('#editPermiumLocalCurency').val(editPermiumLocalCurency);

                        var netpremiuminusd = editlocalCurrency - editpolicyCommisionUSD;
                        netpremiuminusd = -Math.abs(netpremiuminusd);
                        $('#editPermiumUSD').val(netpremiuminusd);
                        $('#editPermiumUSD').formatCurrency();

                    } else if (premiumType == 'AP') {
                        val = Math.abs(val);
                        val = parseFloat(val).toFixed(2);
                        $('#gross_premium').val(val);

                        editlocalCurrency = Math.abs(val * exchrate);
                        $('#editlocalCurrency').val(editlocalCurrency);
                        $('#editlocalCurrency').formatCurrency();

                        editpolicyCommisionLocalCurrrency = (val * policycommission_perc) / 100;
                        editpolicyCommisionLocalCurrrency = Math.abs(editpolicyCommisionLocalCurrrency);
                        $('#editpolicyCommisionLocalCurrrency').val(editpolicyCommisionLocalCurrrency);
                        $('#editpolicyCommisionLocalCurrrency').val(editpolicyCommisionLocalCurrrency.toFixed(2));

                        editpolicyCommisionUSD = (editlocalCurrency * policycommission_perc) / 100;
                        editpolicyCommisionUSD = Math.abs(editpolicyCommisionUSD);
                        editpolicyCommisionUSD = editpolicyCommisionUSD.toFixed(2);
                        $('#editpolicyCommisionUSD').val(editpolicyCommisionUSD);
                        $('#editpolicyCommisionUSD').formatCurrency();

                        editPermiumLocalCurency = val - editpolicyCommisionLocalCurrrency;
                        editPermiumLocalCurency = Math.abs(editPermiumLocalCurency);
                        editPermiumLocalCurency = editPermiumLocalCurency.toFixed(2);
                        $('#editPermiumLocalCurency').val(editPermiumLocalCurency);

                        var netpremiuminusd = editlocalCurrency - editpolicyCommisionUSD;
                        netpremiuminusd = Math.abs(netpremiuminusd);
                        $('#editPermiumUSD').val(netpremiuminusd);
                        $('#editPermiumUSD').formatCurrency();
                    }

                }
            }
        });
        $('#attachment_point').blur(function (ev) {
            var num = $('#attachment_point').val();
            var numInt = isNaN($('#attachment_point').val());
            if (num) {
                if (numInt == false) {
                    var val = parseFloat(num).toFixed(2);
                    $('#attachment_point').val(val);
                }
            }
        });
        $('#limit').blur(function (ev) {
            var num = $('#limit').val();
            var numInt = isNaN($('#limit').val());
            if (num) {
                if (numInt == false) {
                    var val = parseFloat(num).toFixed(2);
                    $('#limit').val(val);
                }
            }
        });
        $('#edittotalinsuredvalue').blur(function (ev) {
            var num = $('#edittotalinsuredvalue').val();
            var numInt = isNaN($('#edittotalinsuredvalue').val());
            if (num) {
                if (numInt == false) {
                    var val = parseFloat(num).toFixed(2);
                    $('#edittotalinsuredvalue').val(val);
                }
            }
        });
        /*For Premium Calculation Satrt*/
        $('#editexchangeRate').blur(function () {
            var num = $(this).val();
            var numInt = isNaN($(this).val());
            if (numInt == false) {
                if (num) {
                    var exchangeRate = parseFloat(num).toFixed(4);
                    $('#editexchangeRate').val(exchangeRate);
                }
            }
            var premiumInLocalCurrency = $('#gross_premium').val();
            var premiumInLocalCurrencyInt = isNaN($('#gross_premium').val());
            if (premiumInLocalCurrencyInt == false) {
                if ((premiumInLocalCurrency || premiumInLocalCurrency == 0) && exchangeRate) {
                    $('#editlocalCurrency').val(premiumInLocalCurrency * exchangeRate);
                    $('#editlocalCurrency').formatCurrency();
                }
            }
            var limitInLocalCurrency = $('#limit').val();
            var limitInLocalCurrencyInt = isNaN($('#limit').val());
            if (limitInLocalCurrencyInt == false) {
                if ((limitInLocalCurrency || limitInLocalCurrency == 0) && exchangeRate) {
                    $('#editlimitlocalcurrency').val(limitInLocalCurrency * exchangeRate);
                    $('#editlimitlocalcurrency').formatCurrency();
                }
            }
            var attachmentPointInLocalCurrency = $('#attachment_point').val();
            var attachmentPointInLocalCurrencyInt = isNaN($('#attachment_point').val());
            if (attachmentPointInLocalCurrencyInt == false) {
                if ((attachmentPointInLocalCurrency || attachmentPointInLocalCurrency == 0) && exchangeRate) {
                    $('#editattachmentlocalcurrency').val(attachmentPointInLocalCurrency * exchangeRate);
                    $('#editattachmentlocalcurrency').formatCurrency();
                }
            }
            var LayerofLimitInLocalCurrency = $('#editLayerLimitLocalCurrency').val();
            var LayerofLimitInLocalCurrencyInt = isNaN($('#editLayerLimitLocalCurrency').val());
            if (LayerofLimitInLocalCurrencyInt == false) {
                if ((LayerofLimitInLocalCurrency || LayerofLimitInLocalCurrency == 0) && exchangeRate) {
                    $('#editLayerLimitLocalUSD').val(LayerofLimitInLocalCurrency * exchangeRate);
                    $('#editLayerLimitLocalUSD').formatCurrency();
                }
            }
            var SefRetentionInLocalCurrency = $('#editselfRetrntionLocalCurrency').val();
            var SefRetentionInLocalCurrencyInt = isNaN($('#editselfRetrntionLocalCurrency').val());
            if (SefRetentionInLocalCurrencyInt == false) {
                if ((SefRetentionInLocalCurrency || SefRetentionInLocalCurrency == 0) && exchangeRate) {
                    $('#editselfRetrntionUSD').val(SefRetentionInLocalCurrency * exchangeRate);
                    $('#editselfRetrntionUSD').formatCurrency();
                }
            }
            var TotalInsuredValueInLocalCurrenacy = $('#edittotalinsuredvalue').val();
            var TotalInsuredValueInLocalCurrenacyInt = isNaN($('#edittotalinsuredvalue').val());
            if (TotalInsuredValueInLocalCurrenacyInt == false) {
                if ((TotalInsuredValueInLocalCurrenacy || TotalInsuredValueInLocalCurrenacy == 0) && exchangeRate) {
                    $('#edittotalinsuredvalueinusd').val(TotalInsuredValueInLocalCurrenacy * exchangeRate);
                    $('#edittotalinsuredvalueinusd').formatCurrency();
                }
            }
            var premiuminUSD = ($("#gross_premium").val()) * exchangeRate;
            var policycommission_perc = $("#editpolicyCommision").val();
            var policycomm_usd = parseInt((premiuminUSD * policycommission_perc)) / 100;
            $('#editpolicyCommisionUSD').val(policycomm_usd);
            $('#editpolicyCommisionUSD').formatCurrency();
            var netpremium_usd = premiuminUSD - policycomm_usd;
            $('#editPermiumUSD').val(netpremium_usd);
            $('#editPermiumUSD').formatCurrency();
        });
        $('#edittotalinsuredvalue').blur(function () {
            var exchangeRate = $('#editexchangeRate').val();
            var tatalInsuredValueCurrency = $('#edittotalinsuredvalue').val();
            var tatalInsuredValueCurrencynum = isNaN($('#edittotalinsuredvalue').val());
            if (tatalInsuredValueCurrencynum == false) {
                if ((tatalInsuredValueCurrency || tatalInsuredValueCurrency == 0) && exchangeRate) {
                    $('#edittotalinsuredvalueinusd').val(tatalInsuredValueCurrency * exchangeRate);
                    $('#edittotalinsuredvalueinusd').formatCurrency();
                }
            }
        });
        $('#gross_premium').blur(function () {
            var exchangeRate = $('#editexchangeRate').val();
            var premiumInLocalCurrency = $('#gross_premium').val();
            var premiumInLocalCurrencynum = isNaN($('#gross_premium').val());
            if (premiumInLocalCurrencynum == false) {
                if ((premiumInLocalCurrency || premiumInLocalCurrency == 0) && exchangeRate) {
                    $('#editlocalCurrency').val(premiumInLocalCurrency * exchangeRate);
                    $('#editlocalCurrency').formatCurrency();
                }
            }
        });
        $('#limit').blur(function () {
            var exchangeRate = $('#editexchangeRate').val();
            var limitInLocalCurrency = $('#limit').val();
            var limitInLocalCurrencynum = isNaN($('#limit').val());
            if (limitInLocalCurrencynum == false) {
                if ((limitInLocalCurrency || limitInLocalCurrency == 0) && exchangeRate) {
                    $('#editlimitlocalcurrency').val(limitInLocalCurrency * exchangeRate);
                    $('#editlimitlocalcurrency').formatCurrency();
                }
            }
        });
        $('#attachment_point').blur(function () {
            var exchangeRate = $('#editexchangeRate').val();
            var attachmentPointInLocalCurrency = $('#attachment_point').val();
            var attachmentPointInLocalCurrencynum = isNaN($('#attachment_point').val());
            if (attachmentPointInLocalCurrencynum == false) {
                if ((attachmentPointInLocalCurrency || attachmentPointInLocalCurrency == 0) && exchangeRate) {
                    $('#editattachmentlocalcurrency').val(attachmentPointInLocalCurrency * exchangeRate);
                    $('#editattachmentlocalcurrency').formatCurrency();
                }
            }
        });
        $('#editexchangeRate').keyup(function (ev) {
            $('#editlocalCurrency').val("");
            $('#editlimitlocalcurrency').val("");
            $('#editattachmentlocalcurrency').val("");
        });

        $('#editselfRetrntionLocalCurrency').keyup(function (ev) {
            $('#editselfRetrntionUSD').val("");
            var exchangeRate = $('#editexchangeRate').val();
            var SelfInsuredRetentionInLocalCurrency = $('#editselfRetrntionLocalCurrency').val();
            var SelfInsuredRetentionInLocalCurrencyInt = isNaN($('#editselfRetrntionLocalCurrency').val());
            if (SelfInsuredRetentionInLocalCurrencyInt == false) {
                if (exchangeRate && SelfInsuredRetentionInLocalCurrency) {
                    var SelfInsuredRetentionInUSD = SelfInsuredRetentionInLocalCurrency * exchangeRate;
                    $('#editselfRetrntionUSD').val(SelfInsuredRetentionInUSD);
                    $('#editselfRetrntionUSD').formatCurrency();
                }
            }
        });

        $('#editLayerLimitLocalCurrency').keyup(function (ev) {
            $('#editLayerLimitLocalUSD').val("");
            var exchangeRate = $('#editexchangeRate').val();
            var LayerofLimitInLocalCurrency = $('#editLayerLimitLocalCurrency').val();
            var LayerofLimitInLocalCurrencyInt = isNaN($('#editLayerLimitLocalCurrency').val());
            if (LayerofLimitInLocalCurrencyInt == false) {
                if (exchangeRate && LayerofLimitInLocalCurrency) {
                    var LayerofLimitInUSD = LayerofLimitInLocalCurrency * exchangeRate;
                    $('#editLayerLimitLocalUSD').val(LayerofLimitInUSD);
                    $('#editLayerLimitLocalUSD').formatCurrency();
                }
            }
        });

        $('#gross_premium').keyup(function (ev) {
            $('#editlocalCurrency').val("");
            var premiumType = $('input[name="premiumType"]:checked').val();
            var premiuminUSD = 0;
            var exchangeRate = $('#editexchangeRate').val();
            var PremiumInLocalCurrency = $('#gross_premium').val();
            if (exchangeRate && PremiumInLocalCurrency) {
                premiuminUSD = PremiumInLocalCurrency * exchangeRate;
            }
            /*calculation of policycommission in local currency*/
            var gross_premium = $('#gross_premium').val();
            var policycommission_perc = $('#editpolicyCommision').val();
            var policyCommissionInt = isNaN($('#editpolicyCommision').val());
            if (policyCommissionInt == false) {
                if ((gross_premium != '' || gross_premium != 'undefined') && (policycommission_perc != '' || policycommission_perc != 'undefined')) {
                    var gross_premiumInt = isNaN(gross_premium)
                    if (gross_premiumInt == false) {
                        var policycomm_localCurrency = (gross_premium * policycommission_perc) / 100;
                        if (premiumType == 'RP') {
                            policycomm_localCurrency = -Math.abs(policycomm_localCurrency);
                        } else if (premiumType == 'AP') {
                            policycomm_localCurrency = Math.abs(policycomm_localCurrency);
                        }
                        $('#editpolicyCommisionLocalCurrrency').val(policycomm_localCurrency);
                        $('#editpolicyCommisionLocalCurrrency').val(policycomm_localCurrency.toFixed(2));

                        var netpremium_localcurrency = (gross_premium * policycommission_perc) / 100;
                        netpremium_localcurrency = gross_premium - policycomm_localCurrency;
                        if (premiumType == 'RP') {
                            gross_premium = -Math.abs(gross_premium);
                            netpremium_localcurrency = (gross_premium * policycommission_perc) / 100;
                            netpremium_localcurrency = gross_premium - policycomm_localCurrency;
                        } else if (premiumType == 'AP') {
                            netpremium_localcurrency = Math.abs(netpremium_localcurrency);
                            netpremium_localcurrency = gross_premium - policycomm_localCurrency;
                        }
                        netpremium_localcurrency = netpremium_localcurrency.toFixed(2);
                        $('#editPermiumLocalCurency').val(netpremium_localcurrency);
                    }
                    if ((premiuminUSD != '' || premiuminUSD != 'undefined') && (policycommission_perc != '' || policycommission_perc != 'undefined')) {
                        var policycomm_usd = parseInt((premiuminUSD * policycommission_perc)) / 100;
                        if (premiumType == 'RP') {
                            policycomm_usd = -Math.abs(policycomm_usd);
                            premiuminUSD = -Math.abs(premiuminUSD);
                        } else if (premiumType == 'AP') {
                            policycomm_usd = Math.abs(policycomm_usd);
                        }
                        $('#editpolicyCommisionUSD').val(policycomm_usd);
                        $('#editpolicyCommisionUSD').formatCurrency();

                        var netpremium_usd = premiuminUSD - policycomm_usd;
                        if (premiumType == 'RP') {
                            netpremium_usd = premiuminUSD - policycomm_usd;
                            //netpremium_usd = -Math.abs(netpremium_usd);
                        } else if (premiumType == 'AP') {
                            netpremium_usd = Math.abs(netpremium_usd);
                        }
                        $('#editPermiumUSD').val(netpremium_usd);
                        $('#editPermiumUSD').formatCurrency();
                    }
                } else {
                    $('#editpolicyCommisionLocalCurrrency').val('');
                    $('#editpolicyCommisionUSD').val('');
                    $('#editPermiumLocalCurency').val('');
                    $('#editpolicyCommisionUSD').val('');
                }
            }
        });

        $('#editpolicyCommision').keyup(function (ev) {
            var premiuminUSD = 0;
            var exchangeRate = $('#editexchangeRate').val();
            var PremiumInLocalCurrency = $('#gross_premium').val();
            if (exchangeRate && PremiumInLocalCurrency) {
                premiuminUSD = PremiumInLocalCurrency * exchangeRate;
            }
            /*calculation of policycommission in local currency*/
            var gross_premium = $('#gross_premium').val();
            var policycommission_perc = $('#editpolicyCommision').val();
            var policyCommissionInt = isNaN($('#editpolicyCommision').val());

            if (policyCommissionInt == false) {
                if ((gross_premium != '' || gross_premium != 'undefined') && (policycommission_perc != '' || policycommission_perc != 'undefined')) {
                    var gross_premiumInt = isNaN(gross_premium)
                    if (gross_premiumInt == false) {
                        var policycomm_localCurrency = (gross_premium * policycommission_perc) / 100;

                        $('#editpolicyCommisionLocalCurrrency').val(policycomm_localCurrency);
                        $('#editpolicyCommisionLocalCurrrency').val(policycomm_localCurrency.toFixed(2));

                        var netpremium_localcurrency = (gross_premium * policycommission_perc) / 100;
                        netpremium_localcurrency = gross_premium - policycomm_localCurrency;
                        netpremium_localcurrency = netpremium_localcurrency.toFixed(2);
                        $('#editPermiumLocalCurency').val(netpremium_localcurrency);
                    }
                    if ((premiuminUSD != '' || premiuminUSD != 'undefined') && (policycommission_perc != '' || policycommission_perc != 'undefined')) {
                        var policycomm_usd = parseInt((premiuminUSD * policycommission_perc)) / 100;
                        $('#editpolicyCommisionUSD').val(policycomm_usd);
                        $('#editpolicyCommisionUSD').formatCurrency();

                        var netpremium_usd = premiuminUSD - policycomm_usd;
                        $('#editPermiumUSD').val(netpremium_usd);
                        $('#editPermiumUSD').formatCurrency();
                    }
                } else {
                    $('#editpolicyCommisionLocalCurrrency').val('');
                    $('#editpolicyCommisionUSD').val('');
                    $('#editPermiumLocalCurency').val('');
                    $('#editpolicyCommisionUSD').val('');
                }
            }
        });
        $('#limit').keyup(function (ev) {
            $('#editlimitlocalcurrency').val("");
        });
        $('#attachment_point').keyup(function (ev) {
            $('#editattachmentlocalcurrency').val("");
        });
        $('#total_insured_value_select').change(function (ev) {
            var val = $(this).val();
            if (val == '-1') {
                $('#edittotalinsuredvalueinusd').val('Not Available');
            } else if (val == '-2') {
                $('#edittotalinsuredvalueinusd').val('To Be Entered');
            }
        });
        $('#gross_premium_select').change(function (ev) {
            var val = $(this).val();
            if (val == '-1') {
                $('#editlocalCurrency').val('Not Available');
            } else if (val == '-2') {
                $('#editlocalCurrency').val('To Be Entered');
            }
        });
        $('#limit_select').change(function (ev) {
            var val = $(this).val();
            if (val == '-1') {
                $('#editlimitlocalcurrency').val('Not Available');
            } else if (val == '-2') {
                $('#editlimitlocalcurrency').val('To Be Entered');
            }
        });
        $('#attachment_point_select').change(function (ev) {
            var val = $(this).val();
            if (val == '-1') {
                $('#editattachmentlocalcurrency').val('Not Available');
            } else if (val == '-2') {
                $('#editattachmentlocalcurrency').val('To Be Entered');
            }
        });
        /*For Premium Calculation End*/
        /****************************************************************************************/
        $('#editinsuredSubmissionDate').keyup(function (ev) {
            $('#editinsuredSubmissionDate').val("");
        });
        $('#editinsuredQuoteDueDate').keyup(function (ev) {
            $('#editinsuredQuoteDueDate').val("");
        });
        /****************************************************************************************/
        var effectiveDate = $('#effective_date').val();
        var expiryDate = $('#expiration_date').val();
        $('#effective_date').datepicker({
            minDate: $("#originaleffectivedate").val(),
            //maxDate: "+364D",
            changeMonth: true,
            changeYear: true,
            yearRange: "1980:2040",
            dateFormat: 'mm/dd/yy',
            onClose: function (selectedDate) {
                if (selectedDate) {
                        var today = new Date();
                        var currentDateArr = selectedDate.split('/');
                        var alertDate = new Date();
                        alertDate.setDate(today.getDate() + 120);
                        var maxDate = new Date(currentDateArr[2], currentDateArr[0] - 1, currentDateArr[1]);
                        if (maxDate > alertDate) {
                            var didConfirm = confirm("The effective date for this submission is more than 120 days in advance.Are you sure you want to reserve the submission?");
                            if (didConfirm == true) {
                                $('#dateAlert').addClass('display-none');
                            } else {
                                $('#effective_date').val(effectiveDate);
                                $("#expiration_date").val(expiryDate);
                                return false;
                            }
                        } else {
                            $('#dateAlert').addClass('display-none');
                        }
                    if ($('#primary_status').val() != 11 && $('#primary_status').val() != 12 && $('#primary_status').val() != 0) {
                        var maxYear = maxDate.getFullYear() + 1;
                        maxDate.setFullYear(maxYear);
                        maxDate.setDate(maxDate.getDate());
                        $('#expiration_date').datepicker();
                        $('#expiration_date').datepicker('option', 'minDate', selectedDate);
                        $('#expiration_date').datepicker('option', 'changeMonth', true);
                        $('#expiration_date').datepicker('option', 'changeYear', true);
                        $('#expiration_date').datepicker('option', 'yearRange', "1980:2025");
                        $("#expiration_date").val(('0' + (maxDate.getMonth() + 1)).slice(-2) + "/" + ('0' + maxDate.getDate()).slice(-2) + "/" + maxDate.getFullYear());
                    }
                    /****************************************************************************************************/
                    /*For Date Of Renewal in Policy Details*/
                    if ($('#primary_status').val() == '12') {
                        var effecdate = $('#effective_date').val();
                        $('#editdateofrenewal').val(effecdate);
                    } else {
                        var exprdate = $('#expiration_date').val();
                        $('#editdateofrenewal').val(exprdate);
                    }
                    /****************************************************************************************************/
                    /*For Transaction Number*/
                    var srt = $('#effective_date').val();
                    srt = srt.match(/\d{2}$/);
                    var suffix = $('#editsuffix option:selected').text();
                    var count = $('#transactionNumberCount').val();
                    if (suffix == 'To Be Entered' || suffix == 'Not Applicable') {
                        var FinalNumber = 'Unknown';
                    } else if (suffix == '--Select--') {
                        var FinalNumber = '';
                    } else {
                        var FinalNumber = srt + suffix + count;
                    }
                    $('#edittransactionNumber').val(FinalNumber);
                }
            }
        });

        var ed = $('#effective_date').val();
        var expd = $('#expiration_date').val();
        $('#expiration_date').datepicker({
            minDate: ed,
            showTime: true,
            dateFormat: 'mm/dd/yy',
            changeMonth: true,
            changeYear: true,
            yearRange: "1980:2040",
            onSelect: function () {
                $(this).valid();
            },
            onClose: function () {
                var exprdate = $('#expiration_date').val();
                $('#editdateofrenewal').val(exprdate);
            }
        });

        var effectivedate = $('#effectivedatehidden').val();
        $('#processdate').datepicker({
            minDate: $("#originaleffectivedate").val(),
           // maxDate: expd,
            showTime: true,
            dateFormat: 'mm/dd/yy',
            changeMonth: true,
            changeYear: true,
            yearRange: "1980:2040",
            onSelect: function () {
                $(this).valid();
            }
        });

        $('#editinsuredSubmissionDate').datepicker({
            showTime: true,
            minDate: new Date(2012, 12, 01),
            dateFormat: 'mm/dd/yy',
            changeMonth: true,
            changeYear: true,
            yearRange: "1980:2040",
            onSelect: function () {
                $(this).valid();
            }
        });

        $('#editinsuredQuoteDueDate').datepicker({
            showTime: true,
            minDate: new Date(2012, 12, 01),
            dateFormat: 'mm/dd/yy',
            changeMonth: true,
            changeYear: true,
            yearRange: "1980:2040",
            onSelect: function () {
                $(this).valid();
            }
        });

        $('#editexchangeRateDate').datepicker({
            showTime: true,
            dateFormat: 'mm/dd/yy',
            changeMonth: true,
            changeYear: true,
            yearRange: "1980:2040",
            onSelect: function () {
                $(this).valid();
            }
        });

        /****************************************************************************************/
        if ($('input[name="insured_name_status"]:checked').val() == 'Y') {
            $('#insured_name_dnb').prop('disabled', false);
        } else if ($('input[name="insured_name_status"]:checked').val() == 'N') {
            $('#insured_name_dnb').prop('disabled', true);
        }
        /****************************************************************************************/
        $('.insurednamestatus').on('click', function () {
            if ($(this).val() == 'Y') {
                $('#insured_name_dnb').prop('disabled', false);
            } else {
                $('#insured_name_dnb').prop('disabled', true);
                $('#insured_name_dnb').val("");
            }
        });
        /****************************************************************************************/
        $('#processdate').prop('disabled', false);
        $('[class*="statusDetails"]').prop('disabled', false);
        $('#editsicCode').prop('disabled', false);
        $('#editsicTitle').prop('disabled', false);
        $('#editofrcReport').prop('disabled', false);
        /*layer limit local currency validation on change of current status*/
        $("#editLayerLimitLocalCurrency").prop('disabled', false);
        $("#editLayerLimitLocalUSD").prop('disabled', false);
        $("#editPrecentageLayer").prop('disabled', false);
        $("#editselfRetrntionLocalCurrency").prop('disabled', false);
        $("#editselfRetrntionUSD").prop('disabled', false);
        $("#policyCommision").prop('disabled', false);
        $("#editpolicyCommision").prop('disabled', false);
        $("#editpolicyCommisionLocalCurrrency").prop('disabled', false);
        $("#editpolicyCommisionUSD").prop('disabled', false);
        $("#editPermiumLocalCurency").prop('disabled', false);
        $("#editPermiumUSD").prop('disabled', false);
        $("#PermiumLocalCurency").prop('disabled', false);
        $("#PermiumUSD").prop('disabled', false);

        /****************************************************************************************/

        /****************************************************************************************/
        // var primaryStatus = $('#primary_status').val();
        var expDate = $('#expiration_date').val();
        if ($('#editdateofrenewal').val() != '') {
            if ($('#editdateofrenewal').val() == expDate) {
                $('#editdateofrenewal').val(expDate);
            }
        } else {
            $('#editdateofrenewal').val(expDate);
        }


        /*layer limit local currency validation on change of current status*/
        if (($('#productline').val() == 'Exec & Prof' || $('#productline').val() == 'Healthcare')) {
            $("#editLayerLimitLocalCurrency").prop('disabled', false);
        } else {
            $("#editLayerLimitLocalCurrency").prop('disabled', true);
        }
        if (($('#productline').val() == 'Exec & Prof' || $('#productline').val() == 'Healthcare')) {
            $("#editLayerLimitLocalUSD").prop('disabled', false);
        } else {
            $("#editLayerLimitLocalUSD").prop('disabled', true);
        }
        if ($('#productline').val() == 'Exec & Prof') {
            $("#editPrecentageLayer").prop('disabled', false);
        } else {
            $("#editPrecentageLayer").prop('disabled', true);
        }
        if (($('#productline').val() == 'Exec & Prof' || $('#productline').val() == 'Healthcare')) {
            $("#editselfRetrntionLocalCurrency").prop('disabled', false);
        } else {
            $("#editselfRetrntionLocalCurrency").prop('disabled', true);
        }
        if (($('#productline').val() == 'Exec & Prof' || $('#productline').val() == 'Healthcare')) {
            $("#editselfRetrntionUSD").prop('disabled', false);
        } else {
            $("#editselfRetrntionUSD").prop('disabled', true);
        }

        /****************************************************************************************/
        if ($('#productLineHidden').val() == 'Property') {
            $('#edittotalinsuredvalue').prop('disabled', false);
            $('#total_insured_value_select').prop('disabled', false);
            $('#edittotalinsuredvalueinusd').prop('disabled', false);
            $('#yesTrue').prop('disabled', false);
            $('#editriskProfile').prop('disabled', false);
        } else {
            $('#edittotalinsuredvalue').prop('disabled', true);
            $('#total_insured_value_select').prop('disabled', true);
            $('#edittotalinsuredvalueinusd').prop('disabled', true);
            $('#yesTrue').prop('disabled', true);
            $('#editriskProfile').prop('disabled', true);
        }

        if ($('#productLineHidden').val() == 'Casualty') {
            $("#editpolicyName").prop('disabled', false);
        } else {
            $("#editpolicyName").prop('disabled', true);
        }

        if (($('#productLineHidden').val() == 'Exec & Prof' || $('#productLineHidden').val() == 'Healthcare')) {
            $("#editLayerLimitLocalCurrency").prop('disabled', false);
        } else {
            $("#editLayerLimitLocalCurrency").prop('disabled', true);
        }
        if (($('#productLineHidden').val() == 'Exec & Prof' || $('#productLineHidden').val() == 'Healthcare')) {
            $("#editLayerLimitLocalUSD").prop('disabled', false);
        } else {
            $("#editLayerLimitLocalUSD").prop('disabled', true);
        }
        if ($('#productLineHidden').val() == 'Exec & Prof') {
            $("#editPrecentageLayer").prop('disabled', false);
        } else {
            $("#editPrecentageLayer").prop('disabled', true);
        }
        if (($('#productLineHidden').val() == 'Exec & Prof' || $('#productLineHidden').val() == 'Healthcare')) {
            $("#editselfRetrntionLocalCurrency").prop('disabled', false);
        } else {
            $("#editselfRetrntionLocalCurrency").prop('disabled', true);
        }
        if (($('#productLineHidden').val() == 'Exec & Prof' || $('#productLineHidden').val() == 'Healthcare')) {
            $("#editselfRetrntionUSD").prop('disabled', false);
        } else {
            $("#editselfRetrntionUSD").prop('disabled', true);
        }
        /****************************************************************************************/

        if ($('#productLineHidden').val() == 'Property' && $('#productLineSubTypeHidden').val() == '3' || $('#productLineHidden').val() == 'Casualty' && $('#productLineSubTypeHidden').val() == '11' && $('#sectionCodeHidden').val() == '616' || $('#productLineHidden').val() == 'Casualty' && $('#productLineSubTypeHidden').val() == '11' && $('#sectionCodeHidden').val() == '617' || $('#productLineHidden').val() == 'Casualty' && $('#productLineSubTypeHidden').val() == '11' && $('#sectionCodeHidden').val() == '618' || $('#productLineHidden').val() == 'Casualty' && $('#productLineSubTypeHidden').val() == '11' && $('#sectionCodeHidden').val() == '619' || $('#productLineHidden').val() == 'Casualty' && $('#productLineSubTypeHidden').val() == '11' && $('#sectionCodeHidden').val() == '620') {
            $('[class*="project"]').prop('disabled', false);
        } else {
            $('[class*="project"]').prop('disabled', true);
        }
        /****************************************************************************************/
        if ($('#isWholesaler').val() == 'Wholesaler') {
            $("#retailBrokerName").prop('disabled', false);
            $("#retailbrokerCountryCode").prop('disabled', false);
            $("#retailbrokerStateCode").prop('disabled', false);
            $("#retailbrokerCityCode").prop('disabled', false);
        } else {
            $("#retailBrokerName").prop('disabled', true);
            $("#retailbrokerCountryCode").prop('disabled', true);
            $("#retailbrokerStateCode").prop('disabled', true);
            $("#retailbrokerCityCode").prop('disabled', true);
        }

//    /*missing js function starts here*/
//    if ($('#productline').val() == 'Property') {
//        alert($('#productline').val());
//        $('#edittotalinsuredvalue').prop('disabled', false);
//        $('#total_insured_value_select').prop('disabled', false);
//        $('#edittotalinsuredvalueinusd').prop('disabled', false);
//        $('#yesTrue').prop('disabled', false);
//        $('#EditOccupancyCode').prop('disabled', false);
//        $('#EditNumberOfLocations').prop('disabled', false);
//        $('#editriskProfile').prop('disabled', false);
//    } else {
//        $('#edittotalinsuredvalue').prop('disabled', true);
//        $('#total_insured_value_select').prop('disabled', true);
//        $('#edittotalinsuredvalueinusd').prop('disabled', true);
//        $('#yesTrue').prop('disabled', true);
//        $('#EditOccupancyCode').prop('disabled', true);
//        $('#EditNumberOfLocations').prop('disabled', true);
//        $('#editriskProfile').prop('disabled', true);
//    }


        /*missing js function ends here*/
        /****************************************************************************************/
        $('#editEndorsementFormCancel').click(function () {
            $(location).attr('href', '/submission/index');
        });
        /****************************************************************************************/
        $('#editEndorsementFormSubmit').click(function () {
            var orgrsprem = $("#hidgross_premium").val();
            var changeprem = $("#gross_premium").val();
            orgrsprem = Math.abs(orgrsprem);
            changeprem = Math.abs(changeprem);
            if ($('#insured_address').val() !== "") {
                if ($('select, input').hasClass('error')) {
                    $('.btn-warning').show();
                } else {
                    $('.btn-warning').hide();
                }
                if (orgrsprem == changeprem) {
                    var cvalue = confirm("Do you want to proceed without changing Premium!");
                    if (cvalue == false) {
                        return false;
                    } else {
                        return true;
                    }
                } else {
                    return true;
                }
            } else {
                alert('Please Search And Select Valid Insured Name');
                return false;
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
        $.validator.addMethod(
                "regex",
                function (value, element, regexp) {
                    var re = new RegExp(regexp);
                    return this.optional(element) || re.test(value);
                },
                "Please check your input."
                );
        $.validator.addMethod("checkNumber", function (value, element, params) {
            var x = value;
            if ($.isNumeric(x) == false) {
                return false;
            } else {
                return true;
            }
        });
        $('#emendmentSubmissionForm').validate({
            rules: {
                editprimarystatus: {required: true, checkName: $('#primary_status').val()},
                effective_date: {required: true},
                editinsuredname: {required: true, maxlength: 100, minlength: 3},
                dbaName: {required: function () {
                        if ($('#insured_name_yes').val() == 'Y')
                            return true;
                        else
                            return false;
                    }, maxlength: 50},
                editinsuredContactPerson: {required: true, checkName: $('#editinsuredContactPerson').val()},
                brokerCode: {required: true, checkName: $('#brokerCode').val()},
                brokerCountryCode: {required: true, checkName: $('#brokerCountryCode').val()},
                brokerStateCode: {required: true, checkName: $('#brokerStateCode').val()},
                brokerCityCode: {required: true, checkName: $('#brokerCityCode').val()},
                broker_contact_person: {required: true, checkName: $('#broker_contact_person').val()},
                broker_contact_person_email: {email: true},
                borker_contact_peson_number: {regex: '^([0-9]{10})$'},
                edittotalinsuredvalue: {required: true, regex: '^[0-9]*\.?[0-9]{1,30}$'},
                total_insured_value_select: {required: true, checkName: $('#total_insured_value_select').val()},
                processdate: {required: true},
                editexchangeRateDate: {required: true},
                editexchangeRate: {required: true, regex: '^[0-9]*\.?[0-9]{1,30}$', min: 0},
                premiumType: {required: true},
                gross_premium_text: {required: true, regex: '^-?[0-9]*\.?[0-9]{1,30}$',checkNumber:$("#gross_premium").val()},
                gross_premium_select: {required: true, checkName: $('#gross_premium_select').val()},
                limit_text: {regex: '^[0-9]*\.?[0-9]{1,30}$',checkNumber:$("#limit").val()},
                limit_select: {required: true, checkName: $('#limit_select').val()},
                attachment_point_text: {regex: '^[0-9]*\.?[0-9]{1,30}$',checkNumber:$("#attachment_point").val()},
                attachment_point_select: {required: true, checkName: $('#attachment_point_select').val()},
                /*Added for new field of Bound*/
                editrenewable: {required: true, checkName: $('#editrenewable').val()},
                editsicCode: {regex: '^[0-9A-Za-z/]{4}$', required: true},
                editsicTitle: {regex: '^[ A-Za-z_@./#!$%^&*();,{}:|&+-<>?]*$', required: true},
                editLayerLimitLocalCurrency: {regex: '^[0-9]*\.?[0-9]{1,30}$', required: true,checkNumber:$("#editLayerLimitLocalCurrency").val()},
                editPrecentageLayer: {regex: '^[0-9]*\.?[0-9]{1,30}$', min: 0, required: true, max: 100},
                editselfRetrntionLocalCurrency: {regex: '^[0-9]*\.?[0-9]{1,30}$', required: true},
                editpolicyCommision: {regex: '^[0-9]*\.?[0-9]{1,30}$', required: true, min: 0, max: 100},
                editpolicyCommisionLocalCurrrency: {regex: '^(-?[0-9]+(\.[0-9][0-9]){1,2})$', required: true},
                PermiumLocalCurency: {regex: '^(-?[0-9]+(\.[0-9][0-9]){1,2})$', required: true},
                PermiumUSD: {regex: '^([0-9]+(\.-?[0-9][0-9]){1,2})$', required: true},
                retailBrokerName: {regex: '[A-Za-z_@./#!$%^&*();,{}:|&+-]+(\s[A-Za-z_@./#!$%^&*();,{}:|&+-]+)?$', required: true},
                retailbrokerCountryCode: {required: true, checkName: $('#retailbrokerCountryCode').val()},
                retailbrokerStateCode: {required: true, checkName: $('#retailbrokerStateCode').val()},
                retailbrokerCityCode: {required: true, checkName: $('#retailbrokerCityCode').val()},
                branch_office: {required: true, checkName: $('#branchid').val()}
            }, //'^[A-Za-z_@./#!$%^&*();,{}:|&+-]*$
            messages: {
                editprimarystatus: '<br />Please select a valid Status',
                effectiveDate: '<br />Please enter a valid effective date',
                expityDate: '<br />Please enter a valid expiry date',
                editinsuredname: {required: '<br />Please enter valid insured name', minlength: '<br />Please enter atleast first 3 characters'},
                dbaName: '<br />Please enter valid DB Name',
                editinsuredContactPerson: {required: '<br />Please select a valid Contact Person Name', checkName: '<br />Please select a valid Contact Person Name'},
                brokerCode: '<br />Please select a valid Broker Name',
                brokerCountryCode: '<br />Please select a valid Broker country',
                brokerStateCode: '<br />Please select a valid Broker state',
                brokerCityCode: '<br />Please select a valid Broker city',
                broker_contact_person: '<br />Please select a valid Broker Contact Person',
                broker_contact_person_email: '<br />Please enter a valid email id',
                borker_contact_peson_number: {required: '<br /> Please enter a valid number', regex: '<br /> Please enter a valid number'},
                edittotalinsuredvalue: '<br />Please enter a valid Total Insured Value',
                total_insured_value_select: '<br />Please select a valid Total Insured Value',
                processdate: '<br />Please enter a valid Process Date',
                editexchangeRateDate: '<br />Please enter a valid Exchange Rate as on',
                editexchangeRate: {required: '<br />Please enter a valid Exchange Rate', regex: '<br />Please enter a valid Exchange Rate', min: '<br />Please enter a valid Exchange Rate'},
                premiumType: '<br />Please select a valid value of Premium Type',
                gross_premium_text: {required: '<br />Please enter a valid Premium in Local Currency', regex: '<br />Please enter a valid Premium in Local Currency', checkNumber: '<br />Please enter a valid Premium in Local Currency'},
                gross_premium_select: '<br />Please select a valid Gross Premium in Local Currency',
                limit_text: {required: '<br />Please enter a valid Limit in Local Currency', regex: '<br />Please enter a valid Limit in Local Currency', checkNumber: '<br />Please enter a valid Limit in Local Currency'},
                limit_select: '<br />Please select a valid Limit in Local Currency',
                attachment_point_text: {required: '<br />Please enter a valid Attachment Point in Local Currency', regex: '<br />Please enter a valid Attachment Point in Local Currency', checkNumber: '<br />Please enter a valid Attachment Point in Local Currency'},
                attachment_point_select: '<br />Please select a valid Attachment Point in Local Currency',
                received_date_by_berkshire: '<br />Please select a valid Date',
                received_date_by_india: '<br />Please enter a valid Date',
                branch_office: '<br />Please select a valid Branch Office',
                /*Added for new field of Bound*/
                editrenewable: '<br />Please select a valid value of renewable',
                editsicCode: '<br />Please enter a valid value of SIC Code',
                editsicTitle: '<br />Please enter a valid value of SIC Title',
                editLayerLimitLocalCurrency: '<br />Please enter a valid value of Layer of Limit in Local Currency',
                editPrecentageLayer: '<br />Please enter a valid value of % of Layer',
                editselfRetrntionLocalCurrency: '<br />Please enter a valid value of Self Insured Retention in Local Currency',
                editpolicyCommision: '<br />Please enter a valid value of Policy Commission %',
                editpolicyCommisionLocalCurrrency: '<br />Please enter a valid value of Policy Commision in Local Currency',
                PermiumLocalCurency: '<br />Please enter a valid value of Net Premium Commission in Local Currency',
                PermiumUSD: '<br />Please enter a valid value of Net Premium Commission in USD',
                retailBrokerName: '<br />Please enter a valid value of Retail Broker Name',
                retailbrokerCountryCode: '<br />Please select a valid value of Retail Broker Country',
                retailbrokerStateCode: '<br />Please select a valid value of Retail Broker State',
                retailbrokerCityCode: '<br />Please select a valid value of Retail Broker City'
            },
            highlight: function (element) {
                $(element).addClass('error');
            },
            unhighlight: function (element) {
                $(element).removeClass('error');
            }
        });
        /****************************************************************************************/
        function brokerDateHandler1() {
            var attr = $('#byBerkSi').attr('disabled');
            if (typeof attr !== 'undefined' && attr !== false) {
                $('#byBerkSi').val("");
                $('#byBerkSi').removeAttr('required');
                $('#byBerkSi').removeClass('error');
                $('#byBerkSi').next('.error').hide();
                $('#byBerkSi').prop("disabled", false);
            } else {
                $('#byBerkSi').prop("disabled", true);
            }
            $("#yesBroker").one("click", brokerDateHandler2);
        }
        function brokerDateHandler2() {
            var attr = $('#byBerkSi').attr('disabled');
            if (typeof attr !== 'undefined' && attr !== false) {
                $('#byBerkSi').attr('required', true);
                $('#byBerkSi').prop("disabled", false);
            } else {
                $('#byBerkSi').prop("disabled", true);
            }
            $("#yesBroker").one("click", brokerDateHandler1);
        }
        $("#yesBroker").one("click", brokerDateHandler1);
        if ($('#byBerkSi').val() !== "") {
            $('#byBerkSi').prop("disabled", false);
        }

        if ($('#byIndia').val() !== "") {
            $('#byIndia').prop("disabled", false);
        }
        /****************************************************************************************/
        function indiaDateHandler1() {
            var attr = $('#byIndia').attr('disabled');
            if (typeof attr !== 'undefined' && attr !== false) {
                $('#byIndia').val("");
                $('#byIndia').removeAttr('required');
                $('#byIndia').removeClass('error');
                $('#byIndia').next('.error').hide();
                $('#byIndia').prop("disabled", false);
            } else {
                $('#byIndia').prop("disabled", true);
            }
            $("#yesIndia").one("click", indiaDateHandler2);
        }
        function indiaDateHandler2() {
            var attr = $('#byIndia').attr('disabled');
            if (typeof attr !== 'undefined' && attr !== false) {
                $('#byIndia').attr('required', true);
                $('#byIndia').prop("disabled", false);
            } else {
                $('#byIndia').prop("disabled", true);
            }
            $("#yesIndia").one("click", indiaDateHandler1);
        }
        $("#yesIndia").one("click", indiaDateHandler1);
        /****************************************************************************************/
        function submissionNumberHandler1() {
            var attr = $('#editDuckSubmissionNumber').attr('disabled');
            if (typeof attr !== 'undefined' && attr !== false) {
                $('#editDuckSubmissionNumber').val("");
                $('#editDuckSubmissionNumber').removeAttr('required');
                $('#editDuckSubmissionNumber').removeClass('error');
                $('#editDuckSubmissionNumber').next('.error').hide();
                $('#editDuckSubmissionNumber').prop("disabled", false);
            } else {
                $('#editDuckSubmissionNumber').prop("disabled", true);
            }
            $("#yesDuckSubmissionNumber").one("click", submissionNumberHandler2);
        }
        function submissionNumberHandler2() {
            var attr = $('#editDuckSubmissionNumber').attr('disabled');
            if (typeof attr !== 'undefined' && attr !== false) {
                $('#editDuckSubmissionNumber').attr('required', true);
                $('#editDuckSubmissionNumber').prop("disabled", false);
            } else {
                $('#editDuckSubmissionNumber').prop("disabled", true);
            }
            $("#yesDuckSubmissionNumber").one("click", submissionNumberHandler1);
        }
        $("#yesDuckSubmissionNumber").one("click", submissionNumberHandler1);

        if ($("#yesDuckSubmissionNumber").prop("checked")) {
            $('#editDuckSubmissionNumber').prop('disabled', true);
        } else {
            $('#editDuckSubmissionNumber').prop('disabled', false);
        }
        /****************************************************************************************/
        if ($("#total_insured_value_select").val() !== "0") {
            $("#total_insured_values").toggleClass('dp-block');
            $("#total_insured").toggleClass('dp-none');
        }
        $("#yesTrue").on("click", function () {
            $("#total_insured_values").toggleClass('dp-block');
            $("#total_insured").toggleClass('dp-none');
            $('#edittotalinsuredvalueinusd').val("");
            $('#edittotalinsuredvalue').val("");
            $('#total_insured_value_select').val("");
        });

        if ($("#gross_premium_select").val() !== "0") {
            $("#gross_premium_values").toggleClass('dp-block');
            $("#gross_premium_value").toggleClass('dp-none');
        }
        $("#yesGross").on("click", function () {
            $("#gross_premium_values").toggleClass('dp-block');
            $("#gross_premium_value").toggleClass('dp-none');
            $('#editlocalCurrency').val("");
            $('#gross_premium').val("");
            $('#gross_premium_select').val("");
        });

        if ($("#limit_select").val() !== "0") {
            $("#limit_values").toggleClass('dp-block');
            $("#limit_value").toggleClass('dp-none');
        }
        $("#yesLimit").on("click", function () {
            $("#limit_values").toggleClass('dp-block');
            $("#limit_value").toggleClass('dp-none');
            $('#editlimitlocalcurrency').val("");
            $('#limit').val("");
            $('#limit_select').val("");
        });

        if ($("#attachment_point_select").val() !== "0") {
            $("#attachment_values").toggleClass('dp-block');
            $("#attachment_value").toggleClass('dp-none');
        }
        $("#yesAttachment").on("click", function () {
            $("#attachment_values").toggleClass('dp-block');
            $("#attachment_value").toggleClass('dp-none');
            $('#editattachmentlocalcurrency').val("");
            $('#attachment_point').val("");
            $('#attachment_point_select').val("");
        });
        /****************************************************************************************/
        $('[id="editsuffix"]').on('change', function () {
            var srt = $('#effective_date').val();
            srt = srt.match(/\d{2}$/);
            var suffix = $('#editsuffix option:selected').text();
            var count = $('#transactionNumberCount').val();
            if (suffix == 'To Be Entered' | suffix == 'Not Applicable') {
                var FinalNumber = 'Unknown';
            } else if (suffix == '--Select--') {
                var FinalNumber = '';
            } else {
                var FinalNumber = srt + suffix + count;
            }
            $('#edittransactionNumber').val(FinalNumber);
        });
        $('[id="primary_status"]').on('change', function () {
            var srt = $('#effective_date').val();
            srt = srt.match(/\d{2}$/);
            var suffix = $('#editsuffix option:selected').text();
            var count = $('#transactionNumberCount').val();
            if (suffix == 'To Be Entered' | suffix == 'Not Applicable') {
                var FinalNumber = 'Unknown';
            } else if (suffix == '--Select--') {
                var FinalNumber = '';
            } else {
                var FinalNumber = srt + suffix + count;
            }
            $('#edittransactionNumber').val(FinalNumber);
        });
        /****************************************************************************************/
        $('[id="gross_premium_select"]').on('change', function () {
            var val = $(this).val();
            if (val == '-1' || val == '-2') {
                $('#editpolicyCommisionLocalCurrrency').val('0.00');
                $('#editpolicyCommisionUSD').val('$0.00');
                $('#editPermiumLocalCurency').val('0.00');
                $('#editPermiumUSD').val('$0.00');
            }
        });
        /****************************************************************************************/
        $('[id="editpolicyNumber"]').on('keyup', function () {
            $('#editduplicatePolicyNumber').hide();
            var policyNumber = $('#editpolicyNumber').val();
            var IsRenewal = $('#submissiontype').val();
            if (IsRenewal == 3) {
                $('#editpolicyNumber').removeClass('error');
                $('#editduplicatePolicyNumber').hide();
                $('#editEndorsementFormSubmit').prop('disabled', false);
                $('#editEndorsementFormSubmit').css('cursor', 'pointer');
                if (policyNumber.length == 6) {
                    if (policyNumber != 'NT/APP') {
                        var dataObj = {
                            'header': {
                                'requestName': 'checkDuplicatePolicyNumber'
                            },
                            'body': {
                                'data': {
                                    'policyNumber': policyNumber
                                }
                            }
                        };
                        $.ajax('/submission/checkDuplicatePolicyNumber', {
                            'dataType': 'json',
                            'data': JSON.stringify(dataObj),
                            'type': 'post',
                            'async': 'false',
                            'success': function (data, status, xhr) {
                                if (data == true) {
                                    $('#duplicatePolicyNumber').hide();
                                    $('#editpolicyNumber').addClass('error');
                                    $('#editEndorsementFormSubmit').prop('disabled', true);
                                    $('#editEndorsementFormSubmit').css('cursor', 'not-allowed');
                                    $('#editduplicatePolicyNumber').show();
                                } else {
                                    $('#editpolicyNumber').removeClass('error');
                                    $('#editduplicatePolicyNumber').hide();
                                    $('#editEndorsementFormSubmit').prop('disabled', false);
                                    $('#editEndorsementFormSubmit').css('cursor', 'pointer');
                                }
                            }
                        });
                    }
                } else {
                    $('#editpolicyNumber').addClass('error');
                    $('#editEndorsementFormSubmit').prop('disabled', true);
                    $('#editEndorsementFormSubmit').css('cursor', 'not-allowed');
                }
            }
        });

        if ($('#editbinddate').val() !== "") {
            if ($('#editbinddate').val() == '01/01/1970') {
                $('#editbinddate').val("");
            }
        }

        /*Renewable yes/no validation*/
        var sectionval = $('#sectionCodeHidden').val();
        if (($('#productLineHidden').val() == 'Property' && $('#productLineSubTypeHidden').val() == 3) || ($('#productLineHidden').val() == 'Casualty' && $('#productLineSubTypeHidden').val() == 11 && (sectionval == 616 || sectionval == 617 || sectionval == 618 || sectionval == 619 || sectionval == 620)) || ($('#productLineHidden').val() == 'Program') || ($('#productLineHidden').val() == 'Home Owners')) {
            var option_no = $('<option></option>').attr("value", "143").text("No");
            $("#editrenewable").empty().append(option_no);

        } else {
            var option_yes = $('<option></option>').attr("value", "142").text("Yes");
            $("#editrenewable").empty().append(option_yes);
        }


        $("#primary_status").change(function () {
            if ($("#primary_status").val() == '12') {
                $("#expiration_date").prop('readonly', 'readonly');
                $("#expiration_date").datepicker('disable');
                $("#editdateofrenewal").val($("#effective_date").val());
            } else {
                $("#expiration_date").prop('disabled', false);
                $("#expiration_date").datepicker('enable');
                $("#editdateofrenewal").val($("#expiration_date").val());
            }
        });

    }, 2000);
});
/****************************************************************************************/
