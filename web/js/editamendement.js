$(document).ready(function (e) {
    $('input[readonly]').focus(function () {
        this.blur();
    });
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
        $('#editamendmentPrecentageLayer').blur(function (ev) {
            var num = $('#editamendmentPrecentageLayer').val();
            var numInt = isNaN($('#editamendmentPrecentageLayer').val());
            if (num) {
                if (numInt == false) {
                    var val = parseFloat(num).toFixed(2);
                    $('#editamendmentPrecentageLayer').val(val);
                }
            }
        });
        $('#editamendmentpolicyCommision').blur(function (ev) {
            var num = $('#editamendmentpolicyCommision').val();
            var numInt = isNaN($('#editamendmentpolicyCommision').val());
            if (num) {
                if (numInt == false) {
                    var val = parseFloat(num).toFixed(2);
                    $('#editamendmentpolicyCommision').val(val);
                }
            }
        });
        $('#editamendmentselfRetrntionLocalCurrency').blur(function (ev) {
            var num = $('#editamendmentselfRetrntionLocalCurrency').val();
            var numInt = isNaN($('#editamendmentselfRetrntionLocalCurrency').val());
            if (num) {
                if (numInt == false) {
                    var val = parseFloat(num).toFixed(2);
                    $('#editamendmentselfRetrntionLocalCurrency').val(val);
                }
            }
        });
        $('#editamendmentLayerLimitLocalCurrency').blur(function (ev) {
            var num = $('#editamendmentLayerLimitLocalCurrency').val();
            var numInt = isNaN($('#editamendmentLayerLimitLocalCurrency').val());
            if (num) {
                if (numInt == false) {
                    var val = parseFloat(num).toFixed(2);
                    $('#editamendmentLayerLimitLocalCurrency').val(val);
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
            var editamendmentlocalCurrency = $('#editamendmentlocalCurrency').val();
            var editamendmentpolicyCommisionLocalCurrrency = $('#editamendmentpolicyCommisionLocalCurrrency').val();
            var editamendmentpolicyCommisionUSD = $('#editamendmentpolicyCommisionUSD').val();
            var editamendmentPermiumLocalCurency = $('#editamendmentPermiumLocalCurency').val();
            var editamendmentPermiumUSD = $('#editamendmentPermiumUSD').val();
            var exchrate = $("#editamendmentexchangeRate").val();
            var policycommission_perc = $('#editamendmentpolicyCommision').val();


            var numInt = isNaN($('#gross_premium').val());
            if (num) {
                if (numInt == false) {
                    var val = parseFloat(num).toFixed(2);

                    if (premiumType == 'RP') {
                        val = -Math.abs(val);
                        val = parseFloat(val).toFixed(2);
                        $('#gross_premium').val(val);

                        editamendmentlocalCurrency = -Math.abs(val * exchrate);
                        $('#editamendmentlocalCurrency').val(editamendmentlocalCurrency);
                        $('#editamendmentlocalCurrency').formatCurrency();

                        editamendmentpolicyCommisionLocalCurrrency = (val * policycommission_perc) / 100;
                        editamendmentpolicyCommisionLocalCurrrency = -Math.abs(editamendmentpolicyCommisionLocalCurrrency);
                        $('#editamendmentpolicyCommisionLocalCurrrency').val(editamendmentpolicyCommisionLocalCurrrency);
                        $('#editamendmentpolicyCommisionLocalCurrrency').val(editamendmentpolicyCommisionLocalCurrrency.toFixed(2));

                        editamendmentpolicyCommisionUSD = (editamendmentlocalCurrency * policycommission_perc) / 100;
                        editamendmentpolicyCommisionUSD = -Math.abs(editamendmentpolicyCommisionUSD);
                        editamendmentpolicyCommisionUSD = editamendmentpolicyCommisionUSD.toFixed(2);
                        $('#editamendmentpolicyCommisionUSD').val(editamendmentpolicyCommisionUSD);
                        $('#editamendmentpolicyCommisionUSD').formatCurrency();

                        editamendmentPermiumLocalCurency = val - editamendmentpolicyCommisionLocalCurrrency;
                        editamendmentPermiumLocalCurency = -Math.abs(editamendmentPermiumLocalCurency);
                        editamendmentPermiumLocalCurency = editamendmentPermiumLocalCurency.toFixed(2);
                        $('#editamendmentPermiumLocalCurency').val(editamendmentPermiumLocalCurency);

                        var netpremiuminusd = editamendmentlocalCurrency - editamendmentpolicyCommisionUSD;
                        netpremiuminusd = -Math.abs(netpremiuminusd);
                        $('#editamendmentPermiumUSD').val(netpremiuminusd);
                        $('#editamendmentPermiumUSD').formatCurrency();

                    } else if (premiumType == 'AP') {
                        val = Math.abs(val);
                        val = parseFloat(val).toFixed(2);
                        $('#gross_premium').val(val);

                        editamendmentlocalCurrency = Math.abs(val * exchrate);
                        $('#editamendmentlocalCurrency').val(editamendmentlocalCurrency);
                        $('#editamendmentlocalCurrency').formatCurrency();

                        editamendmentpolicyCommisionLocalCurrrency = (val * policycommission_perc) / 100;
                        editamendmentpolicyCommisionLocalCurrrency = Math.abs(editamendmentpolicyCommisionLocalCurrrency);
                        $('#editamendmentpolicyCommisionLocalCurrrency').val(editamendmentpolicyCommisionLocalCurrrency);
                        $('#editamendmentpolicyCommisionLocalCurrrency').val(editamendmentpolicyCommisionLocalCurrrency.toFixed(2));

                        editamendmentpolicyCommisionUSD = (editamendmentlocalCurrency * policycommission_perc) / 100;
                        editamendmentpolicyCommisionUSD = Math.abs(editamendmentpolicyCommisionUSD);
                        editamendmentpolicyCommisionUSD = editamendmentpolicyCommisionUSD.toFixed(2);
                        $('#editamendmentpolicyCommisionUSD').val(editamendmentpolicyCommisionUSD);
                        $('#editamendmentpolicyCommisionUSD').formatCurrency();

                        editamendmentPermiumLocalCurency = val - editamendmentpolicyCommisionLocalCurrrency;
                        editamendmentPermiumLocalCurency = Math.abs(editamendmentPermiumLocalCurency);
                        editamendmentPermiumLocalCurency = editamendmentPermiumLocalCurency.toFixed(2);
                        $('#editamendmentPermiumLocalCurency').val(editamendmentPermiumLocalCurency);

                        var netpremiuminusd = editamendmentlocalCurrency - editamendmentpolicyCommisionUSD;
                        netpremiuminusd = Math.abs(netpremiuminusd);
                        $('#editamendmentPermiumUSD').val(netpremiuminusd);
                        $('#editamendmentPermiumUSD').formatCurrency();
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
        $('#editamendmenttotalinsuredvalue').blur(function (ev) {
            var num = $('#editamendmenttotalinsuredvalue').val();
            var numInt = isNaN($('#editamendmenttotalinsuredvalue').val());
            if (num) {
                if (numInt == false) {
                    var val = parseFloat(num).toFixed(2);
                    $('#editamendmenttotalinsuredvalue').val(val);
                }
            }
        });
        /*For Premium Calculation Satrt*/
        $('#editamendmentexchangeRate').blur(function () {
            var num = $(this).val();
            var numInt = isNaN($(this).val());
            if (numInt == false) {
                if (num) {
                    var exchangeRate = parseFloat(num).toFixed(4);
                    $('#editamendmentexchangeRate').val(exchangeRate);
                }
            }
            var premiumInLocalCurrency = $('#gross_premium').val();
            var premiumInLocalCurrencyInt = isNaN($('#gross_premium').val());
            if (premiumInLocalCurrencyInt == false) {
                if ((premiumInLocalCurrency || premiumInLocalCurrency == 0) && exchangeRate) {
                    $('#editamendmentlocalCurrency').val(premiumInLocalCurrency * exchangeRate);
                    $('#editamendmentlocalCurrency').formatCurrency();
                }
            }
            var limitInLocalCurrency = $('#limit').val();
            var limitInLocalCurrencyInt = isNaN($('#limit').val());
            if (limitInLocalCurrencyInt == false) {
                if ((limitInLocalCurrency || limitInLocalCurrency == 0) && exchangeRate) {
                    $('#editamendmentlimitlocalcurrency').val(limitInLocalCurrency * exchangeRate);
                    $('#editamendmentlimitlocalcurrency').formatCurrency();
                }
            }
            var attachmentPointInLocalCurrency = $('#attachment_point').val();
            var attachmentPointInLocalCurrencyInt = isNaN($('#attachment_point').val());
            if (attachmentPointInLocalCurrencyInt == false) {
                if ((attachmentPointInLocalCurrency || attachmentPointInLocalCurrency == 0) && exchangeRate) {
                    $('#editamendmentattachmentlocalcurrency').val(attachmentPointInLocalCurrency * exchangeRate);
                    $('#editamendmentattachmentlocalcurrency').formatCurrency();
                }
            }
            var LayerofLimitInLocalCurrency = $('#editamendmentLayerLimitLocalCurrency').val();
            var LayerofLimitInLocalCurrencyInt = isNaN($('#editamendmentLayerLimitLocalCurrency').val());
            if (LayerofLimitInLocalCurrencyInt == false) {
                if ((LayerofLimitInLocalCurrency || LayerofLimitInLocalCurrency == 0) && exchangeRate) {
                    $('#editamendmentLayerLimitLocalUSD').val(LayerofLimitInLocalCurrency * exchangeRate);
                    $('#editamendmentLayerLimitLocalUSD').formatCurrency();
                }
            }
            var SefRetentionInLocalCurrency = $('#editamendmentselfRetrntionLocalCurrency').val();
            var SefRetentionInLocalCurrencyInt = isNaN($('#editamendmentselfRetrntionLocalCurrency').val());
            if (SefRetentionInLocalCurrencyInt == false) {
                if ((SefRetentionInLocalCurrency || SefRetentionInLocalCurrency == 0) && exchangeRate) {
                    $('#editamendmentselfRetrntionUSD').val(SefRetentionInLocalCurrency * exchangeRate);
                    $('#editamendmentselfRetrntionUSD').formatCurrency();
                }
            }
            var TotalInsuredValueInLocalCurrenacy = $('#editamendmenttotalinsuredvalue').val();
            var TotalInsuredValueInLocalCurrenacyInt = isNaN($('#editamendmenttotalinsuredvalue').val());
            if (TotalInsuredValueInLocalCurrenacyInt == false) {
                if ((TotalInsuredValueInLocalCurrenacy || TotalInsuredValueInLocalCurrenacy == 0) && exchangeRate) {
                    $('#editamendmenttotalinsuredvalueinusd').val(TotalInsuredValueInLocalCurrenacy * exchangeRate);
                    $('#editamendmenttotalinsuredvalueinusd').formatCurrency();
                }
            }
            var premiuminUSD = ($("#gross_premium").val()) * exchangeRate;
            var policycommission_perc = $("#editamendmentpolicyCommision").val();
            var policycomm_usd = parseInt((premiuminUSD * policycommission_perc)) / 100;
            $('#editamendmentpolicyCommisionUSD').val(policycomm_usd);
            $('#editamendmentpolicyCommisionUSD').formatCurrency();

            var netpremium_usd = premiuminUSD - policycomm_usd;
            $('#editamendmentPermiumUSD').val(netpremium_usd);
            $('#editamendmentPermiumUSD').formatCurrency();
        });
        $('#editamendmenttotalinsuredvalue').blur(function () {
            var exchangeRate = $('#editamendmentexchangeRate').val();
            var tatalInsuredValueCurrency = $('#editamendmenttotalinsuredvalue').val();
            var tatalInsuredValueCurrencynum = isNaN($('#editamendmenttotalinsuredvalue').val());
            if (tatalInsuredValueCurrencynum == false) {
                if ((tatalInsuredValueCurrency || tatalInsuredValueCurrency == 0) && exchangeRate) {
                    $('#editamendmenttotalinsuredvalueinusd').val(tatalInsuredValueCurrency * exchangeRate);
                    $('#editamendmenttotalinsuredvalueinusd').formatCurrency();
                }
            }
        });
        $('#gross_premium').blur(function () {
            var exchangeRate = $('#editamendmentexchangeRate').val();
            var premiumInLocalCurrency = $('#gross_premium').val();
            var premiumInLocalCurrencynum = isNaN($('#gross_premium').val());
            if (premiumInLocalCurrencynum == false) {
                if ((premiumInLocalCurrency || premiumInLocalCurrency == 0) && exchangeRate) {
                    $('#editamendmentlocalCurrency').val(premiumInLocalCurrency * exchangeRate);
                    $('#editamendmentlocalCurrency').formatCurrency();
                }
            }
        });
        $('#limit').blur(function () {
            var exchangeRate = $('#editamendmentexchangeRate').val();
            var limitInLocalCurrency = $('#limit').val();
            var limitInLocalCurrencynum = isNaN($('#limit').val());
            if (limitInLocalCurrencynum == false) {
                if ((limitInLocalCurrency || limitInLocalCurrency == 0) && exchangeRate) {
                    $('#editamendmentlimitlocalcurrency').val(limitInLocalCurrency * exchangeRate);
                    $('#editamendmentlimitlocalcurrency').formatCurrency();
                }
            }
        });
        $('#attachment_point').blur(function () {
            var exchangeRate = $('#editamendmentexchangeRate').val();
            var attachmentPointInLocalCurrency = $('#attachment_point').val();
            var attachmentPointInLocalCurrencynum = isNaN($('#attachment_point').val());
            if (attachmentPointInLocalCurrencynum == false) {
                if ((attachmentPointInLocalCurrency || attachmentPointInLocalCurrency == 0) && exchangeRate) {
                    $('#editamendmentattachmentlocalcurrency').val(attachmentPointInLocalCurrency * exchangeRate);
                    $('#editamendmentattachmentlocalcurrency').formatCurrency();
                }
            }
        });
        $('#editamendmentexchangeRate').keyup(function (ev) {
            $('#editamendmentlocalCurrency').val("");
            $('#editamendmentlimitlocalcurrency').val("");
            $('#editamendmentattachmentlocalcurrency').val("");
        });

        $('#editamendmentselfRetrntionLocalCurrency').keyup(function (ev) {
            $('#editamendmentselfRetrntionUSD').val("");
            var exchangeRate = $('#editamendmentexchangeRate').val();
            var SelfInsuredRetentionInLocalCurrency = $('#editamendmentselfRetrntionLocalCurrency').val();
            var SelfInsuredRetentionInLocalCurrencyInt = isNaN($('#editamendmentselfRetrntionLocalCurrency').val());
            if (SelfInsuredRetentionInLocalCurrencyInt == false) {
                if (exchangeRate && SelfInsuredRetentionInLocalCurrency) {
                    var SelfInsuredRetentionInUSD = SelfInsuredRetentionInLocalCurrency * exchangeRate;
                    $('#editamendmentselfRetrntionUSD').val(SelfInsuredRetentionInUSD);
                    $('#editamendmentselfRetrntionUSD').formatCurrency();
                }
            }
        });

        $('#editamendmentLayerLimitLocalCurrency').keyup(function (ev) {
            $('#editamendmentLayerLimitLocalUSD').val("");
            var exchangeRate = $('#editamendmentexchangeRate').val();
            var LayerofLimitInLocalCurrency = $('#editamendmentLayerLimitLocalCurrency').val();
            var LayerofLimitInLocalCurrencyInt = isNaN($('#editamendmentLayerLimitLocalCurrency').val());
            if (LayerofLimitInLocalCurrencyInt == false) {
                if (exchangeRate && LayerofLimitInLocalCurrency) {
                    var LayerofLimitInUSD = LayerofLimitInLocalCurrency * exchangeRate;
                    $('#editamendmentLayerLimitLocalUSD').val(LayerofLimitInUSD);
                    $('#editamendmentLayerLimitLocalUSD').formatCurrency();
                }
            }
        });

        $('#gross_premium').keyup(function (ev) {
            $('#editamendmentlocalCurrency').val("");
            var premiumType = $('input[name="premiumType"]:checked').val();
            var premiuminUSD = 0;
            var exchangeRate = $('#editamendmentexchangeRate').val();
            var PremiumInLocalCurrency = $('#gross_premium').val();
            if (exchangeRate && PremiumInLocalCurrency) {
                premiuminUSD = PremiumInLocalCurrency * exchangeRate;
            }
            /*calculation of policycommission in local currency*/
            var gross_premium = $('#gross_premium').val();
            var policycommission_perc = $('#editamendmentpolicyCommision').val();
            var policyCommissionInt = isNaN($('#editamendmentpolicyCommision').val());
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
                        $('#editamendmentpolicyCommisionLocalCurrrency').val(policycomm_localCurrency);
                        $('#editamendmentpolicyCommisionLocalCurrrency').val(policycomm_localCurrency.toFixed(2));

                        var netpremium_localcurrency = (gross_premium * policycommission_perc) / 100;
                        netpremium_localcurrency = gross_premium - policycomm_localCurrency;
                        if (premiumType == 'RP') {
                            gross_premium = -Math.abs(gross_premium);
                            netpremium_localcurrency = (gross_premium * policycommission_perc) / 100
                            netpremium_localcurrency = gross_premium - policycomm_localCurrency;
                        } else if (premiumType == 'AP') {
                            netpremium_localcurrency = Math.abs(netpremium_localcurrency);
                        }
                        netpremium_localcurrency = netpremium_localcurrency.toFixed(2);
                        $('#editamendmentPermiumLocalCurency').val(netpremium_localcurrency);
                    }
                    if ((premiuminUSD != '' || premiuminUSD != 'undefined') && (policycommission_perc != '' || policycommission_perc != 'undefined')) {
                        var policycomm_usd = parseInt((premiuminUSD * policycommission_perc)) / 100;
                        if (premiumType == 'RP') {
                            policycomm_usd = -Math.abs(policycomm_usd);
                            premiuminUSD = -Math.abs(premiuminUSD);
                        } else if (premiumType == 'AP') {
                            policycomm_usd = Math.abs(policycomm_usd);
                        }
                        $('#editamendmentpolicyCommisionUSD').val(policycomm_usd);
                        $('#editamendmentpolicyCommisionUSD').formatCurrency();

                        var netpremium_usd = premiuminUSD - policycomm_usd;
                        if (premiumType == 'RP') {
                            netpremium_usd = premiuminUSD - policycomm_usd;
                        } else if (premiumType == 'AP') {
                            netpremium_usd = Math.abs(netpremium_usd);
                        }
                        $('#editamendmentPermiumUSD').val(netpremium_usd);
                        $('#editamendmentPermiumUSD').formatCurrency();
                    }
                } else {
                    $('#editamendmentpolicyCommisionLocalCurrrency').val('');
                    $('#editamendmentpolicyCommisionUSD').val('');
                    $('#editamendmentPermiumLocalCurency').val('');
                    $('#editamendmentpolicyCommisionUSD').val('');
                }
            }
        });

        $('#editamendmentpolicyCommision').keyup(function (ev) {
            var premiuminUSD = 0;
            var exchangeRate = $('#editamendmentexchangeRate').val();
            var PremiumInLocalCurrency = $('#gross_premium').val();
            if (exchangeRate && PremiumInLocalCurrency) {
                premiuminUSD = PremiumInLocalCurrency * exchangeRate;
            }
            /*calculation of policycommission in local currency*/
            var gross_premium = $('#gross_premium').val();
            var policycommission_perc = $('#editamendmentpolicyCommision').val();
            var policyCommissionInt = isNaN($('#editamendmentpolicyCommision').val());

            if (policyCommissionInt == false) {
                if ((gross_premium != '' || gross_premium != 'undefined') && (policycommission_perc != '' || policycommission_perc != 'undefined')) {
                    var gross_premiumInt = isNaN(gross_premium)
                    if (gross_premiumInt == false) {
                        var policycomm_localCurrency = (gross_premium * policycommission_perc) / 100;

                        $('#editamendmentpolicyCommisionLocalCurrrency').val(policycomm_localCurrency);
                        $('#editamendmentpolicyCommisionLocalCurrrency').val(policycomm_localCurrency.toFixed(2));

                        var netpremium_localcurrency = (gross_premium * policycommission_perc) / 100;
                        netpremium_localcurrency = gross_premium - policycomm_localCurrency;
                        netpremium_localcurrency = netpremium_localcurrency.toFixed(2);
                        $('#editamendmentPermiumLocalCurency').val(netpremium_localcurrency);
                    }
                    if ((premiuminUSD != '' || premiuminUSD != 'undefined') && (policycommission_perc != '' || policycommission_perc != 'undefined')) {
                        var policycomm_usd = parseInt((premiuminUSD * policycommission_perc)) / 100;
                        $('#editamendmentpolicyCommisionUSD').val(policycomm_usd);
                        $('#editamendmentpolicyCommisionUSD').formatCurrency();

                        var netpremium_usd = premiuminUSD - policycomm_usd;
                        $('#editamendmentPermiumUSD').val(netpremium_usd);
                        $('#editamendmentPermiumUSD').formatCurrency();
                    }
                } else {
                    $('#editamendmentpolicyCommisionLocalCurrrency').val('');
                    $('#editamendmentpolicyCommisionUSD').val('');
                    $('#editamendmentPermiumLocalCurency').val('');
                    $('#editamendmentpolicyCommisionUSD').val('');
                }
            }
        });
        $('#limit').keyup(function (ev) {
            $('#editamendmentlimitlocalcurrency').val("");
        });
        $('#attachment_point').keyup(function (ev) {
            $('#editamendmentattachmentlocalcurrency').val("");
        });
        $('#total_insured_value_select').change(function (ev) {
            var val = $(this).val();
            if (val == '-1') {
                $('#editamendmenttotalinsuredvalueinusd').val('Not Available');
            } else if (val == '-2') {
                $('#editamendmenttotalinsuredvalueinusd').val('To Be Entered');
            }
        });
        $('#gross_premium_select').change(function (ev) {
            var val = $(this).val();
            if (val == '-1') {
                $('#editamendmentlocalCurrency').val('Not Available');
            } else if (val == '-2') {
                $('#editamendmentlocalCurrency').val('To Be Entered');
            }
        });
        $('#limit_select').change(function (ev) {
            var val = $(this).val();
            if (val == '-1') {
                $('#editamendmentlimitlocalcurrency').val('Not Available');
            } else if (val == '-2') {
                $('#editamendmentlimitlocalcurrency').val('To Be Entered');
            }
        });
        $('#attachment_point_select').change(function (ev) {
            var val = $(this).val();
            if (val == '-1') {
                $('#editamendmentattachmentlocalcurrency').val('Not Available');
            } else if (val == '-2') {
                $('#editamendmentattachmentlocalcurrency').val('To Be Entered');
            }
        });
        /*For Premium Calculation End*/
        /****************************************************************************************/
        $('#editamendmentinsuredSubmissionDate').keyup(function (ev) {
            $('#editamendmentinsuredSubmissionDate').val("");
        });
        $('#editamendmentinsuredQuoteDueDate').keyup(function (ev) {
            $('#editamendmentinsuredQuoteDueDate').val("");
        });
        /****************************************************************************************/
        var effectiveDate = $('#effective_date').val();
        var expiryDate = $('#expiration_date').val();
        $('#effective_date').datepicker({
            minDate: $('#originaleffectivedate').val(),
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
                        $('#editamendmentdateofrenewal').val(effecdate);
                    } else {
                        var exprdate = $('#expiration_date').val();
                        $('#editamendmentdateofrenewal').val(exprdate);
                    }
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
                /*For Date Of Renewal in Policy Details*/
                var exprdate = $('#expiration_date').val();
                $('#editamendmentdateofrenewal').val(exprdate);
            }
        });

        $('#processdate').datepicker({
            minDate: $('#originaleffectivedate').val(),
            //maxDate: expd,
            showTime: true,
            dateFormat: 'mm/dd/yy',
            changeMonth: true,
            changeYear: true,
            yearRange: "1980:2040",
            onSelect: function () {
                $(this).valid();
            }
        });

        $('#editamendmentinsuredSubmissionDate').datepicker({
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

        $('#editamendmentinsuredQuoteDueDate').datepicker({
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

        $('#editamendmentexchangeRateDate').datepicker({
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
        $('#editamendmentsicCode').prop('disabled', false);
        $('#editamendmentsicTitle').prop('disabled', false);
        $('#editamendmentofrcReport').prop('disabled', false);
        /*layer limit local currency validation on change of current status*/
        $("#editamendmentLayerLimitLocalCurrency").prop('disabled', false);
        $("#editamendmentLayerLimitLocalUSD").prop('disabled', false);
        $("#editamendmentPrecentageLayer").prop('disabled', false);
        $("#editamendmentselfRetrntionLocalCurrency").prop('disabled', false);
        $("#editamendmentselfRetrntionUSD").prop('disabled', false);
        $("#policyCommision").prop('disabled', false);
        $("#editamendmentpolicyCommision").prop('disabled', false);
        $("#editamendmentpolicyCommisionLocalCurrrency").prop('disabled', false);
        $("#editamendmentpolicyCommisionUSD").prop('disabled', false);
        $("#editamendmentPermiumLocalCurency").prop('disabled', false);
        $("#editamendmentPermiumUSD").prop('disabled', false);
        $("#PermiumLocalCurency").prop('disabled', false);
        $("#PermiumUSD").prop('disabled', false);

        /****************************************************************************************/

        /****************************************************************************************/
        // var primaryStatus = $('#primary_status').val();
        var expDate = $('#expiration_date').val();
        if ($('#editamendmentdateofrenewal').val() != '') {
            if ($('#editamendmentdateofrenewal').val() == expDate) {
                $('#editamendmentdateofrenewal').val(expDate);
            }
        } else {
            $('#editamendmentdateofrenewal').val(expDate);
        }


        /*layer limit local currency validation on change of current status*/
        if (typeof ($('#productline').val()) != "undefined" && $('#productline').val() !== null) {
            if (($('#productline').val() == 'Exec & Prof' || $('#productline').val() == 'Healthcare')) {
                $("#editamendmentLayerLimitLocalCurrency").prop('disabled', false);
            } else {
                $("#editamendmentLayerLimitLocalCurrency").prop('disabled', true);
            }
            if (($('#productline').val() == 'Exec & Prof' || $('#productline').val() == 'Healthcare')) {
                $("#editamendmentLayerLimitLocalUSD").prop('disabled', false);
            } else {
                $("#editamendmentLayerLimitLocalUSD").prop('disabled', true);
            }
            if ($('#productline').val() == 'Exec & Prof') {
                $("#editamendmentPrecentageLayer").prop('disabled', false);
            } else {
                $("#editamendmentPrecentageLayer").prop('disabled', true);
            }
            if (($('#productline').val() == 'Exec & Prof' || $('#productline').val() == 'Healthcare')) {
                $("#editamendmentselfRetrntionLocalCurrency").prop('disabled', false);
            } else {
                $("#editamendmentselfRetrntionLocalCurrency").prop('disabled', true);
            }
            if (($('#productline').val() == 'Exec & Prof' || $('#productline').val() == 'Healthcare')) {
                $("#editamendmentselfRetrntionUSD").prop('disabled', false);
            } else {
                $("#editamendmentselfRetrntionUSD").prop('disabled', true);
            }
        }
        /****************************************************************************************/
        if ($('#productLineHidden').val() == 'Property') {
            $('#editamendmenttotalinsuredvalue').prop('disabled', false);
            $('#total_insured_value_select').prop('disabled', false);
            $('#editamendmenttotalinsuredvalueinusd').prop('disabled', false);
            $('#yesTrue').prop('disabled', false);
            $('#editamendmentriskProfile').prop('disabled', false);
        } else {
            $('#editamendmenttotalinsuredvalue').prop('disabled', true);
            $('#total_insured_value_select').prop('disabled', true);
            $('#editamendmenttotalinsuredvalueinusd').prop('disabled', true);
            $('#yesTrue').prop('disabled', true);
            $('#editamendmentriskProfile').prop('disabled', true);
        }

        if ($('#productLineHidden').val() == 'Casualty') {
            $("#editamendmentpolicyName").prop('disabled', false);
        } else {
            $("#editamendmentpolicyName").prop('disabled', true);
        }

        if (($('#productLineHidden').val() == 'Exec & Prof' || $('#productLineHidden').val() == 'Healthcare')) {
            $("#editamendmentLayerLimitLocalCurrency").prop('disabled', false);
        } else {
            $("#editamendmentLayerLimitLocalCurrency").prop('disabled', true);
        }
        if (($('#productLineHidden').val() == 'Exec & Prof' || $('#productLineHidden').val() == 'Healthcare')) {
            $("#editamendmentLayerLimitLocalUSD").prop('disabled', false);
        } else {
            $("#editamendmentLayerLimitLocalUSD").prop('disabled', true);
        }
        if ($('#productLineHidden').val() == 'Exec & Prof') {
            $("#editamendmentPrecentageLayer").prop('disabled', false);
        } else {
            $("#editamendmentPrecentageLayer").prop('disabled', true);
        }
        if (($('#productLineHidden').val() == 'Exec & Prof' || $('#productLineHidden').val() == 'Healthcare')) {
            $("#editamendmentselfRetrntionLocalCurrency").prop('disabled', false);
        } else {
            $("#editamendmentselfRetrntionLocalCurrency").prop('disabled', true);
        }
        if (($('#productLineHidden').val() == 'Exec & Prof' || $('#productLineHidden').val() == 'Healthcare')) {
            $("#editamendmentselfRetrntionUSD").prop('disabled', false);
        } else {
            $("#editamendmentselfRetrntionUSD").prop('disabled', true);
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
        /*missing js function ends here*/
        /****************************************************************************************/
        $('#editamendmentEndorsementFormCancel').click(function () {
            $(location).attr('href', '/submission/index');
        });
        /****************************************************************************************/
        $('#editamendmentEndorsementFormSubmit').click(function () {
            if ($('#insured_address').val() !== "") {
                if ($('select, input').hasClass('error')) {
                    $('.btn-warning').show();
                } else {
                    $('.btn-warning').hide();
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
        $('#emendmentSubmissionForm').validate({
            rules: {
                editamendmentprimarystatus: {required: true, checkName: $('#primary_status').val()},
                effective_date: {required: true},
                editamendmentinsuredname: {required: true, maxlength: 100, minlength: 3},
                dbaName: {required: function () {
                        if ($('#insured_name_yes').val() == 'Y')
                            return true;
                        else
                            return false;
                    }, maxlength: 50},
                editamendmentinsuredContactPerson: {required: true, checkName: $('#editamendmentinsuredContactPerson').val()},
                brokerCode: {required: true, checkName: $('#brokerCode').val()},
                brokerCountryCode: {required: true, checkName: $('#brokerCountryCode').val()},
                brokerStateCode: {required: true, checkName: $('#brokerStateCode').val()},
                brokerCityCode: {required: true, checkName: $('#brokerCityCode').val()},
                broker_contact_person: {required: true, checkName: $('#broker_contact_person').val()},
                broker_contact_person_email: {email: true},
                borker_contact_peson_number: {regex: '^([0-9]{10})$'},
                editamendmenttotalinsuredvalue: {required: true, regex: '^[0-9]*\.?[0-9]{1,30}$'},
                total_insured_value_select: {required: true, checkName: $('#total_insured_value_select').val()},
                processdate: {required: true},
                editamendmentexchangeRateDate: {required: true},
                editamendmentexchangeRate: {required: true, regex: '^[0-9]*\.?[0-9]{1,30}$', min: 0},
                premiumType: {required: true},
                gross_premium_text: {required: true, regex: '^-?[0-9]*\.?[0-9]{1,30}$', checkNumber: $("#gross_premium").val()},
                gross_premium_select: {required: true, checkName: $('#gross_premium_select').val()},
                limit_text: {regex: '^[0-9]*\.?[0-9]{1,30}$', checkNumber: $("#limit").val()},
                limit_select: {required: true, checkName: $('#limit_select').val()},
                attachment_point_text: {regex: '^[0-9]*\.?[0-9]{1,30}$', checkNumber: $("#attachment_point").val()},
                attachment_point_select: {required: true, checkName: $('#attachment_point_select').val()},
                /*Added for new field of Bound*/
                editamendmentrenewable: {required: true, checkName: $('#editamendmentrenewable').val()},
                editamendmentsicCode: {regex: '^[0-9A-Za-z/]{4}$', required: true},
                editamendmentsicTitle: {regex: '^[ A-Za-z_@./#!$%^&*();,{}:|&+-<>?]*$', required: true},
                editamendmentLayerLimitLocalCurrency: {regex: '^[0-9]*\.?[0-9]{1,30}$', required: true, checkNumber: $("#editamendmentLayerLimitLocalCurrency").val()},
                editamendmentPrecentageLayer: {regex: '^[0-9]*\.?[0-9]{1,30}$', min: 0, required: true, max: 100},
                editamendmentselfRetrntionLocalCurrency: {regex: '^[0-9]*\.?[0-9]{1,30}$', required: true},
                editamendmentpolicyCommision: {regex: '^[0-9]*\.?[0-9]{1,30}$', required: true, min: 0, max: 100},
                editamendmentpolicyCommisionLocalCurrrency: {regex: '^(-?[0-9]+(\.[0-9][0-9]){1,2})$', required: true},
                PermiumLocalCurency: {regex: '^(-?[0-9]+(\.[0-9][0-9]){1,2})$', required: true},
                PermiumUSD: {regex: '^([0-9]+(\.-?[0-9][0-9]){1,2})$', required: true},
                retailBrokerName: {regex: '[A-Za-z_@./#!$%^&*();,{}:|&+-]+(\s[A-Za-z_@./#!$%^&*();,{}:|&+-]+)?$', required: true},
                retailbrokerCountryCode: {required: true, checkName: $('#retailbrokerCountryCode').val()},
                retailbrokerStateCode: {required: true, checkName: $('#retailbrokerStateCode').val()},
                retailbrokerCityCode: {required: true, checkName: $('#retailbrokerCityCode').val()},
                branch_office: {required: true, checkName: $('#branchid').val()}
            },
            messages: {
                editamendmentprimarystatus: '<br />Please select a valid Status',
                effectiveDate: '<br />Please enter a valid effective date',
                expityDate: '<br />Please enter a valid expiry date',
                editamendmentinsuredname: {required: '<br />Please enter valid insured name', minlength: '<br />Please enter atleast first 3 characters'},
                dbaName: '<br />Please enter valid DB Name',
                editamendmentinsuredContactPerson: {required: '<br />Please select a valid Contact Person Name', checkName: '<br />Please select a valid Contact Person Name'},
                brokerCode: '<br />Please select a valid Broker Name',
                brokerCountryCode: '<br />Please select a valid Broker country',
                brokerStateCode: '<br />Please select a valid Broker state',
                brokerCityCode: '<br />Please select a valid Broker city',
                broker_contact_person: '<br />Please select a valid Broker Contact Person',
                broker_contact_person_email: '<br />Please enter a valid email id',
                borker_contact_peson_number: {required: '<br /> Please enter a valid number', regex: '<br /> Please enter a valid number'},
                editamendmenttotalinsuredvalue: '<br />Please enter a valid Total Insured Value',
                total_insured_value_select: '<br />Please select a valid Total Insured Value',
                processdate: '<br />Please enter a valid Process Date',
                editamendmentexchangeRateDate: '<br />Please enter a valid Exchange Rate as on',
                editamendmentexchangeRate: {required: '<br />Please enter a valid Exchange Rate', regex: '<br />Please enter a valid Exchange Rate', min: '<br />Please enter a valid Exchange Rate'},
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
                editamendmentrenewable: '<br />Please select a valid value of renewable',
                editamendmentsicCode: '<br />Please enter a valid value of SIC Code',
                editamendmentsicTitle: '<br />Please enter a valid value of SIC Title',
                editamendmentLayerLimitLocalCurrency: '<br />Please enter a valid value of Layer of Limit in Local Currency',
                editamendmentPrecentageLayer: '<br />Please enter a valid value of % of Layer',
                editamendmentselfRetrntionLocalCurrency: '<br />Please enter a valid value of Self Insured Retention in Local Currency',
                editamendmentpolicyCommision: '<br />Please enter a valid value of Policy Commission %',
                editamendmentpolicyCommisionLocalCurrrency: '<br />Please enter a valid value of Policy Commision in Local Currency',
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
            var attr = $('#editamendmentDuckSubmissionNumber').attr('disabled');
            if (typeof attr !== 'undefined' && attr !== false) {
                $('#editamendmentDuckSubmissionNumber').val("");
                $('#editamendmentDuckSubmissionNumber').removeAttr('required');
                $('#editamendmentDuckSubmissionNumber').removeClass('error');
                $('#editamendmentDuckSubmissionNumber').next('.error').hide();
                $('#editamendmentDuckSubmissionNumber').prop("disabled", false);
            } else {
                $('#editamendmentDuckSubmissionNumber').prop("disabled", true);
            }
            $("#yesDuckSubmissionNumber").one("click", submissionNumberHandler2);
        }
        function submissionNumberHandler2() {
            var attr = $('#editamendmentDuckSubmissionNumber').attr('disabled');
            if (typeof attr !== 'undefined' && attr !== false) {
                $('#editamendmentDuckSubmissionNumber').attr('required', true);
                $('#editamendmentDuckSubmissionNumber').prop("disabled", false);
            } else {
                $('#editamendmentDuckSubmissionNumber').prop("disabled", true);
            }
            $("#yesDuckSubmissionNumber").one("click", submissionNumberHandler1);
        }
        $("#yesDuckSubmissionNumber").one("click", submissionNumberHandler1);

        if ($("#yesDuckSubmissionNumber").prop("checked")) {
            $('#editamendmentDuckSubmissionNumber').prop('disabled', true);
        } else {
            $('#editamendmentDuckSubmissionNumber').prop('disabled', false);
        }
        /****************************************************************************************/
        if ($("#total_insured_value_select").val() !== "0") {
            $("#total_insured_values").toggleClass('dp-block');
            $("#total_insured").toggleClass('dp-none');
        }
        $("#yesTrue").on("click", function () {
            $("#total_insured_values").toggleClass('dp-block');
            $("#total_insured").toggleClass('dp-none');
            $('#editamendmenttotalinsuredvalueinusd').val("");
            $('#editamendmenttotalinsuredvalue').val("");
            $('#total_insured_value_select').val("");
        });

        if ($("#gross_premium_select").val() !== "0" && $('#hidgross_premium_yes').val() == '1') {
            $("#gross_premium_values").toggleClass('dp-block');
            $("#gross_premium_value").toggleClass('dp-none');
        }
        $("#yesGross").on("click", function () {
            $("#gross_premium_values").toggleClass('dp-block');
            $("#gross_premium_value").toggleClass('dp-none');
            $('#editamendmentlocalCurrency').val("");
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
            $('#editamendmentlimitlocalcurrency').val("");
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
            $('#editamendmentattachmentlocalcurrency').val("");
            $('#attachment_point').val("");
            $('#attachment_point_select').val("");
        });
        /****************************************************************************************/
        /****************************************************************************************/
        $('[id="gross_premium_select"]').on('change', function () {
            var val = $(this).val();
            if (val == '-1' || val == '-2') {
                $('#editamendmentpolicyCommisionLocalCurrrency').val('0.00');
                $('#editamendmentpolicyCommisionUSD').val('$0.00');
                $('#editamendmentPermiumLocalCurency').val('0.00');
                $('#editamendmentPermiumUSD').val('$0.00');
            }
        });
        /****************************************************************************************/
        $('[id="editamendmentpolicyNumber"]').on('keyup', function () {
            $('#editamendmentduplicatePolicyNumber').hide();
            var policyNumber = $('#editamendmentpolicyNumber').val();
            var IsRenewal = $('#submissiontype').val();
            if (IsRenewal == 3) {
                $('#editamendmentpolicyNumber').removeClass('error');
                $('#editamendmentduplicatePolicyNumber').hide();
                $('#editamendmentEndorsementFormSubmit').prop('disabled', false);
                $('#editamendmentEndorsementFormSubmit').css('cursor', 'pointer');
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
                                    $('#editamendmentpolicyNumber').addClass('error');
                                    $('#editamendmentEndorsementFormSubmit').prop('disabled', true);
                                    $('#editamendmentEndorsementFormSubmit').css('cursor', 'not-allowed');
                                    $('#editamendmentduplicatePolicyNumber').show();
                                } else {
                                    $('#editamendmentpolicyNumber').removeClass('error');
                                    $('#editamendmentduplicatePolicyNumber').hide();
                                    $('#editamendmentEndorsementFormSubmit').prop('disabled', false);
                                    $('#editamendmentEndorsementFormSubmit').css('cursor', 'pointer');
                                }
                            }
                        });
                    }
                } else {
                    $('#editamendmentpolicyNumber').addClass('error');
                    $('#editamendmentEndorsementFormSubmit').prop('disabled', true);
                    $('#editamendmentEndorsementFormSubmit').css('cursor', 'not-allowed');
                }
            }
        });

        if ($('#editamendmentbinddate').val() !== "") {
            if ($('#editamendmentbinddate').val() == '01/01/1970') {
                $('#editamendmentbinddate').val("");
            }
        }

        /*Renewable yes/no validation*/
        var sectionval = $('#sectionCodeHidden').val();
        if (($('#productLineHidden').val() == 'Property' && $('#productLineSubTypeHidden').val() == 3) || ($('#productLineHidden').val() == 'Casualty' && $('#productLineSubTypeHidden').val() == 11 && (sectionval == 616 || sectionval == 617 || sectionval == 618 || sectionval == 619 || sectionval == 620)) || ($('#productLineHidden').val() == 'Program') || ($('#productLineHidden').val() == 'Home Owners')) {
            var option_no = $('<option></option>').attr("value", "143").text("No");
            $("#editamendmentrenewable").empty().append(option_no);

        } else {
            var option_yes = $('<option></option>').attr("value", "142").text("Yes");
            $("#editamendmentrenewable").empty().append(option_yes);
        }

        $("#primary_status").change(function () {
            if ($("#primary_status").val() == '12') {
                $("#expiration_date").prop('readonly', 'readonly');
                $("#expiration_date").datepicker('disable');
                $("#editamendmentdateofrenewal").val($("#effective_date").val());
            } else {
                $("#expiration_date").prop('disabled', false);
                $("#editamendmentdateofrenewal").val($("#expiration_date").val());
            }
        });

        if ($("#primary_status").val() == '12') {
            $("#expiration_date").prop('readonly', 'readonly');
            $("#expiration_date").datepicker('disable');
            $("#editamendmentdateofrenewal").val($("#effective_date").val());
        } else {
            $("#expiration_date").prop('disabled', false);
            $("#editamendmentdateofrenewal").val($("#expiration_date").val());
        }

    }, 2000);
});
/****************************************************************************************/
