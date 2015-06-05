$(document).ready(function () {
    /*****************************************************************************************************/
    $.validator.setDefaults({
        ignore: []
    });
    $('input[readonly]').focus(function(){
        this.blur();
    });
    /*For Trim the Value start*/
    $('#insuredName').blur(function () {
        $(this).val($.trim($(this).val()));
    });
    $('#reinsured_company').blur(function () {
        $(this).val($.trim($(this).val()));
    });
    $('#projectname').blur(function () {
        $(this).val($.trim($(this).val()));
    });
    $('#generalcontratorname').blur(function () {
        $(this).val($.trim($(this).val()));
    });
    $('#projectownername').blur(function () {
        $(this).val($.trim($(this).val()));
    });
    $('#projectstreetaddress').blur(function () {
        $(this).val($.trim($(this).val()));
    });
    $('#total_insured_value').blur(function () {
        var exchangeRate = $('#exchangeRate').val();
        var TotalInsuredValueInLocalCurrency = $('#total_insured_value').val();
        if ((TotalInsuredValueInLocalCurrency || TotalInsuredValueInLocalCurrency == 0) && exchangeRate) {
            $('#total_insured_value_usd').val(TotalInsuredValueInLocalCurrency * exchangeRate);
            $('#total_insured_value_usd').formatCurrency();
        }
    });
    $('#total_insured_value').blur(function (ev) {
        var num = $('#total_insured_value').val();
        var numInt = isNaN($('#total_insured_value').val());
        if (num) {
            if (numInt == false) {
                var val = parseFloat(num).toFixed(2);
                $('#total_insured_value').val(val);
            }
        }
    });
    $('#brokercontactperson').blur(function () {
        $(this).val($.trim($(this).val()));
    });
    $('#broker_contact_person_email').blur(function () {
        $(this).val($.trim($(this).val()));
    });
    $('#borker_contact_peson_number').blur(function () {
        $(this).val($.trim($(this).val()));
    });
    $('#total_insured_value_select').change(function (ev) {
        var val = $(this).val();
        if (val == '-1') {
            $('#total_insured_value_usd').val('Not Available');
        } else if (val == '-2') {
            $('#total_insured_value_usd').val('To Be Entered');
        }
    });
    /*For Trim the Value end*/
    /****************************************************************************************************/
    /*For Premium calculation start*/
    $('#exchangeRate').blur(function () {
        var num = $(this).val();
        if (parseInt(num)) {
            var exchangeRate = parseFloat(num).toFixed(4);
            $('#exchangeRate').val(exchangeRate);
        }
        var TotalInsuredValueInLocalCurrenacy = $('#total_insured_value').val();
        var TotalInsuredValueInLocalCurrenacyInt = isNaN($('#total_insured_value').val());
        if (TotalInsuredValueInLocalCurrenacyInt == false) {
            if ((TotalInsuredValueInLocalCurrenacy || TotalInsuredValueInLocalCurrenacy == 0) && exchangeRate) {
                $('#total_insured_value_usd').val(TotalInsuredValueInLocalCurrenacy * exchangeRate);
                $('#total_insured_value_usd').formatCurrency();
            }
        }
    });
    $('#gross_premium').blur(function () {
        var exchangeRate = $('#exchangeRate').val();
        var PremiumInLocalCurrency = parseInt($('#gross_premium').val());
        if (exchangeRate && PremiumInLocalCurrency) {
            $('#premiumUsdCurrency').val(PremiumInLocalCurrency * exchangeRate);
            $('#premiumUsdCurrency').formatCurrency();
        }
    });
     $('#layerLimitLocalCurrency').keyup(function (ev) {
        var exchangeRate = $('#exchangeRate').val(); 
        $('#layerLimitUSD').val("");
        var LayerofLimitInLocalCurrency = $('#layerLimitLocalCurrency').val();
        var LayerofLimitInLocalCurrencyInt = isNaN($('#layerLimitLocalCurrency').val());
        if (LayerofLimitInLocalCurrencyInt == false) {
            if (exchangeRate && LayerofLimitInLocalCurrency) {
                var LayerofLimitInUSD = LayerofLimitInLocalCurrency * exchangeRate;
                $('#layerLimitUSD').val(LayerofLimitInUSD);
                $('#layerLimitUSD').formatCurrency();
            }
        }
    });
    
    $('#limit').blur(function () {
        var exchangeRate = parseInt($('#exchangeRate').val());
        var LimitInLocalCurrency = parseInt($('#limit').val());
        if (exchangeRate && LimitInLocalCurrency) {
            $('#limit_usd_text').val(LimitInLocalCurrency * exchangeRate);
            $('#limit_usd_text').formatCurrency();
        }
    });
    $('#attachment_point').blur(function () {
        var exchangeRate = parseInt($('#exchangeRate').val());
        var AttachmentPointLocalCurrency = parseInt($('#attachment_point').val());
        if (exchangeRate && AttachmentPointLocalCurrency) {
            $('#attachment_point_usd').val(AttachmentPointLocalCurrency * exchangeRate);
            $('#attachment_point_usd').formatCurrency();
        }
    });
   
    $('#exchangeRate').keyup(function (ev) {
        $('#premiumUsdCurrency').val("");
        $('#limit_usd_text').val("");
        $('#attachment_point_usd').val("");
    });
    
    $('#selfInsuredRetention').keyup(function (ev) {
        $('#selfInsuredRetentionUSD').val("");
        var exchangeRate = parseInt($('#exchangeRate').val());
        var SelfInsuredRetentionInLocalCurrency = $('#selfInsuredRetention').val();
        var SelfInsuredRetentionInLocalCurrencyInt = isNaN($('#selfInsuredRetention').val());
        if (SelfInsuredRetentionInLocalCurrencyInt == false) {
            if (exchangeRate && SelfInsuredRetentionInLocalCurrency) {
                var SelfInsuredRetentionInUSD = SelfInsuredRetentionInLocalCurrency * exchangeRate;
                $('#selfInsuredRetentionUSD').val(SelfInsuredRetentionInUSD);
                $('#selfInsuredRetentionUSD').formatCurrency();
            }
        }
    });
    $('#gross_premium').keyup(function (ev) {
        $('#premiumUsdCurrency').val("");
        var premiuminUSD = 0;
        var exchangeRate = $('#exchangeRate').val();
        var PremiumInLocalCurrency = parseInt($('#gross_premium').val());
        if (exchangeRate && PremiumInLocalCurrency) {
            premiuminUSD = PremiumInLocalCurrency * exchangeRate;

        }
        /*calculation of policycommission in local currency*/
        var gross_premium = $('#gross_premium').val();
        var policycommission_perc = $('#policyCommission').val();

        if ((gross_premium != '' || gross_premium != 'undefined') && (policycommission_perc != '' || policycommission_perc != 'undefined')) {
            var policycomm_localCurrency = (gross_premium * policycommission_perc) / 100;

            $('#policyComissionInLocalCurrency').val(policycomm_localCurrency);
            $('#policyComissionInLocalCurrency').val(policycomm_localCurrency.toFixed(2));

            var netpremium_localcurrency = (gross_premium * policycommission_perc) / 100;
            netpremium_localcurrency = gross_premium - policycomm_localCurrency;
            netpremium_localcurrency = netpremium_localcurrency.toFixed(2);
            $('#netpremiumCommissionInLocalCurrency').val(netpremium_localcurrency);

            if ((premiuminUSD != '' || premiuminUSD != 'undefined') && (policycommission_perc != '' || policycommission_perc != 'undefined')) {
                var policycomm_usd = (premiuminUSD * policycommission_perc) / 100;
                $('#policyComissionInUSD').val(policycomm_usd);
                $('#policyComissionInUSD').formatCurrency();

                var netpremium_usd = premiuminUSD - policycomm_usd;
                $('#netpremiumCommissionInUSD').val(netpremium_usd);
                $('#netpremiumCommissionInUSD').formatCurrency();
            }
        } else {
            $('#policyComissionInLocalCurrency').val('');
            $('#policyComissionInUSD').val('');
            $('#netpremiumCommissionInUSD').val('');
            $('#netpremiumCommissionInLocalCurrency').val('');
        }
    });
    /*calculation of policycommission in local currency*/
    $('#policyCommission').keyup(function (ev) {
        $('#policyComissionInLocalCurrency').val("");

        $('#policyComissionInLocalCurrency').val("");

        var premiuminUSD = 0;
        var exchangeRate = $('#exchangeRate').val();
        var PremiumInLocalCurrency = parseInt($('#gross_premium').val());
        if (exchangeRate && PremiumInLocalCurrency) {
            premiuminUSD = PremiumInLocalCurrency * exchangeRate;
        }
        /*calculation of policycommission in local currency*/
        var gross_premium = $('#gross_premium').val();
        var policycommission_perc = $('#policyCommission').val();

        if ((gross_premium != '' || gross_premium != 'undefined') && (policycommission_perc != '' || policycommission_perc != 'undefined')) {
            var policycomm_localCurrency = (gross_premium * policycommission_perc) / 100;
            $('#policyComissionInLocalCurrency').val(policycomm_localCurrency.toFixed(2));

            var netpremium_localcurrency = (gross_premium * policycommission_perc) / 100;
            netpremium_localcurrency = gross_premium - policycomm_localCurrency;
            netpremium_localcurrency = netpremium_localcurrency.toFixed(2);
            $('#netpremiumCommissionInLocalCurrency').val(netpremium_localcurrency);

            if ((premiuminUSD != '' || premiuminUSD != 'undefined') && (policycommission_perc != '' || policycommission_perc != 'undefined')) {
                var policycomm_usd = (premiuminUSD * policycommission_perc) / 100;
                $('#policyComissionInUSD').val(policycomm_usd);
                $('#policyComissionInUSD').formatCurrency();

                var netpremium_usd = premiuminUSD - policycomm_usd;
                $('#netpremiumCommissionInUSD').val(netpremium_usd);
                $('#netpremiumCommissionInUSD').formatCurrency();
            }
        } else {
            $('#policyComissionInLocalCurrency').val('');
            $('#policyComissionInUSD').val('');
            $('#netpremiumCommissionInUSD').val('');
            $('#netpremiumCommissionInLocalCurrency').val('');
        }

    });
    $('#limit').keyup(function (ev) {
        $('#limit_usd_text').val("");
    });
    $('#attachment_point').keyup(function (ev) {
        $('#attachment_point_usd').val("");
    });
    $('#gross_premium_select').change(function (ev) {
        var val = $(this).val();
        if (val == '-1') {
            $('#premiumUsdCurrency').val('Not Available');
        } else if (val == '-2') {
            $('#premiumUsdCurrency').val('To Be Entered');
        }
    });
    $('#limit_select').change(function (ev) {
        var val = $(this).val();
        if (val == '-1') {
            $('#limit_usd_text').val('Not Available');
        } else if (val == '-2') {
            $('#limit_usd_text').val('To Be Entered');
        }
    });
    $('#attachment_point_select').change(function (ev) {
        var val = $(this).val();
        if (val == '-1') {
            $('#attachment_point_usd').val('Not Available');
        } else if (val == '-2') {
            $('#attachment_point_usd').val('To Be Entered');
        }
    });
    /*For Premium calculation End*/
    /****************************************************************************************************/
    /*For empty the fields start*/
    $('#insuredSubmissionDate').keyup(function (ev) {
        $('#insuredSubmissionDate').val("");
    });
    $('#insuredQuoteDueDate').keyup(function (ev) {
        $('#insuredQuoteDueDate').val("");
    });
    /*For empty the fields end*/
    /****************************************************************************************************/
    /*For Calender and expiry date validation start*/
    $('#effectivedate').datepicker({
        minDate: new Date(2012, 12, 01),
        //maxDate: "+364D",
        changeMonth: true,
        changeYear: true,
        yearRange: "1980:2040",
        showTime: true,
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
                        $('#dateAlert').removeClass('display-none');
                        $('#effectivedate').val("");
                        $('#expirydate').val("");
                        return false;
                    }

                } else {
                    $('#dateAlert').addClass('display-none');
                }
                var maxYear = maxDate.getFullYear() + 1;
                maxDate.setFullYear(maxYear);
                maxDate.setDate(maxDate.getDate());
                $('#expirydate').datepicker();
                $('#expirydate').datepicker('option', 'minDate', selectedDate);
                $('#expirydate').datepicker('option', 'changeMonth', true);
                $('#expirydate').datepicker('option', 'changeYear', true);
                $('#expirydate').datepicker('option', 'yearRange', "1980:2040");
                $("#expirydate").val(('0' + (maxDate.getMonth() + 1)).slice(-2) + "/" + ('0' + maxDate.getDate()).slice(-2) + "/" + maxDate.getFullYear());
                /****************************************************************************************************/
                /*For Date Of Renewal in Policy Details*/
                if ($('#primarystatus').val() == 9) {
                    var exprdate = $('#expirydate').val();
                    $('#dateofrenewal').val(exprdate);
                }
                if ($('#primarystatus_master').val() == 9) {
                    var exprdate = $('#expirydate').val();
                    $('#dateofrenewal').val(exprdate);
                }
                /****************************************************************************************************/
                /****************************************************************************************************/
                /*For Transaction Number*/
                var srt = $('#effectivedate').val();
                srt = srt.match(/\d{2}$/);
                var suffix = $('#suffix option:selected').text();
                if (suffix == 'To Be Entered' || suffix == 'Not Applicable') {
                    var FinalNumber = 'Unknown';
                } else if (suffix == '--Select--') {
                    var FinalNumber = '';
                } else {
                    var FinalNumber = srt + suffix + '01';
            }
                $('#transactionNumber').val(FinalNumber);
            }
        },
        onSelect: function () {
            $(this).valid();
            $("#expirydate").valid();
        }
    });

    var expiryDate = $('#expirydate').val();
    $('#processdate').datepicker({
        minDate: new Date(2012, 12, 01),
        maxDate: expiryDate,
        changeMonth: true,
        changeYear: true,
        yearRange: "1980:2040",
        showTime: true,
        dateFormat: 'mm/dd/yy',
        onSelect: function () {
            $(this).valid();
        },
    });

    $('#exchangeRateDate').datepicker({
        showTime: true,
        changeMonth: true,
        changeYear: true,
        yearRange: "1980:2040",
        dateFormat: 'mm/dd/yy',
        onSelect: function () {
            $(this).valid();
        }
    });
    $('#insuredSubmissionDate').datepicker({
        showTime: true,
        minDate: new Date(2012, 12, 01),
        changeMonth: true,
        changeYear: true,
        yearRange: "1980:2040",
        dateFormat: 'mm/dd/yy',
        onSelect: function () {
            $(this).valid();
        }
    });
    $('#insuredQuoteDueDate').datepicker({
        showTime: true,
        minDate: new Date(2012, 12, 01),
        changeMonth: true,
        changeYear: true,
        yearRange: "1980:2040",
        dateFormat: 'mm/dd/yy',
        onSelect: function () {
            $(this).valid();
        }
    });
    $('#binddate').datepicker({
        showTime: true,
        minDate: new Date(2012, 12, 01),
        changeMonth: true,
        changeYear: true,
        yearRange: "1980:2040",
        dateFormat: 'mm/dd/yy',
        onSelect: function () {
            $(this).valid();
        }
    });

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
    /*For Calender and expiry date validation end*/
    /***************************************************************************************************************/
    /*For Form Validation start*/
    $('#Submitdata').click(function () {
        if ($('#insured_address').val() !== "") {
            if ($('select, input').hasClass('error')) {
                $('.btn-warning').show();
                return false;
            } else {
                $('.btn-warning').hide();
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
    
    $.validator.addMethod("checkNumber", function (value, element, params) {
           var x = value;
           if ($.isNumeric(x) == false) {
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
    $('#SubmissiondataFrm').validate({
        ignore: [],
        rules: {
            new_renewal: {required: true, checkName: $('#new_renewal').val()},
            underwriter: {required: true, checkName: $('#underwriter').val()},
            underwriter_master: {required: true, checkName: $('#underwriter_master').val()},
            product_line_master: {required: true, checkName: $('#product_line_master').val()},
            product_line_subtype: {required: true, checkName: $('#product_line_subtype').val()},
            product_line_subtype_master: {required: true, checkName: $('#product_line_subtype').val()},
            section: {required: true, checkName: $('#section').val()},
            section_master: {required: true, checkName: $('#section_master').val()},
            profitcode: {required: true, checkName: $('#profitcode').val()},
            profitcode_master: {required: true, checkName: $('#profitcode_master').val()},
            primarystatus: {required: true, checkName: $('#primarystatus').val()},
            primarystatus_master: {required: true, checkName: $('#primarystatus_master').val()},
            effectivedate: {required: true},
            insuredName: {required: true, maxlength: 100, minlength: 3},
            dbaname: {required: function () {
                    if ($('#insured_name_yes').val() == 'Y')
                        return true;
                    else
                        return false;
                }, maxlength: 50},
            insuredContactPerson: {required: true, checkName: $('#insuredContactPerson').val()},
            cabValue: {required: true, checkName: $('#cabValue').val()},
            OccupancyCode: {required: true, checkName: $('#OccupancyCode').val()},
            NumberOfLocations: {required: true, checkName: $('#NumberOfLocations').val()},
            brokercode: {required: true, checkName: $('#brokercode').val()},
            countrycode: {required: true, checkName: $('#countrycode').val()},
            statecode: {required: true, checkName: $('#statecode').val()},
            citycode: {required: true, checkName: $('#citycode').val()},
            branch_office: {required: true, checkName: $('#branch_office').val()},
            brokercontactperson: {required: true, checkName: $('#brokercontactperson').val()},
            broker_contact_person_email: {email: true},
            borker_contact_peson_number: {regex: '^([0-9]{10})$'},
            total_insured_value_text: {required: true},
            total_insured_value_select: {required: true, checkName: $('#total_insured_value_select').val()},
            reason_code: {required: true, checkName: $('#reason_code').val()},
            processdate: {required: true},
            exchangeRateDate: {required: true},
            currency: {required: true, checkName: $('#currency').val()},
            exchangeRate: {required: true, regex: '^[0-9]*\.?[0-9]{1,30}$', min: 0},
            gross_premium_text: {required: true, regex: '^[0-9]*\.?[0-9]{1,30}$',checkNumber:$("#gross_premium").val()},
            gross_premium_select: {required: true, checkName: $('#gross_premium_select').val()},
            limit_text: {regex: '^[0-9]*\.?[0-9]{1,30}$',checkNumber:$("#limit").val()},
            attachment_point: {regex: '^[0-9]*\.?[0-9]{1,30}$',checkNumber:$("#attachment_point").val()},
            /*Added for new field of Bound*/
            binddate: {required: true, checkName: $('#binddate').val()},
            renewable: {required: true, checkName: $('#renewable').val()},
            dateofrenewal: {required: true, checkName: $('#dateofrenewal').val()},
            policyName: {required: true, checkName: $('#policyName').val()},
            directAssumed: {required: true, checkName: $("#directAssumed").val()},
            admitted: {required: true, checkName: $('#admitted').val()},
            companyPaper: {required: true, checkName: $('#companyPaper').val()},
            companyPaperNumber: {required: true, checkName: $('#companyPaperNumber').val()},
            coverage: {required: true, checkName: $('#coverage').val()},
            suffix: {required: true, checkName: $('#suffix').val()},
            policyNumber: {regex: '^([0-9]{6})$', required: true, checkName: $('#policyNumber').val()},
            transactionNumber: {regex: '^([0-9]{1,40})$', required: true, checkName: $('#transactionNumber').val()},
            naicCode: {regex: '^([0-9A-Za-z/]{6})*$', required: true, checkName: $('#naicCode').val()},
            naicTitle: {regex: '^[A-Za-z_@./#&+-]*$', required: true, checkName: $('#naicTitle').val()},
            sicCode: {regex: '^[0-9A-Za-z/]{4}$', required: true, checkName: $('#sicCode').val()},
            sicTitle: {regex: '^[A-Za-z_@./#&+-]*$', required: true, checkName: $('#sicTitle').val()},
            ofrcAdvreport: {required: true, checkName: $('#ofrcAdvreport').val()},
            layerLimitLocalCurrency: {regex: '^([0-9]{1,12})$', required: true, checkName: $('#layerLimitLocalCurrency').val()},
            //layerLimitUSD: {regex: '^([0-9]+(\.[0-9][0-9]){1,2})$', required: true, checkName: $('#layerLimitUSD').val()},
            PercentageLayer: {required: true, regex: '^[0-9]*\.?[0-9]{1,30}$',  checkName: $('#PercentageLayer').val(), min: 0, max: 100},
            selfInsuredRetention: {regex: '^([0-9]{1,12})$', required: true, checkName: $('#selfInsuredRetention').val()},
            //selfInsuredRetentionUSD: {regex: '^([0-9]+(\.[0-9][0-9]){1,2})$', required: true, checkName: $('#selfInsuredRetentionUSD').val()},
            policyCommission: {regex: '^[0-9]*\.?[0-9]{1,30}$', required: true, min: 0, max: 100, checkName: $('#policyCommission').val()},
            policyComissionInLocalCurrency: {regex: '^([0-9]+(\.[0-9][0-9]){1,2})$', required: true, checkName: $('#policyComissionInLocalCurrency').val()},
            retailBrokerName: {regex: '^[ A-Za-z_@./#!$%^&*();,{}:|&+-]*$', required: true},
            retailcountrycode: {required: true, checkName: $('#retailcountrycode').val()},
            retailstatecode: {required: true, checkName: $('#retailstatecode').val()},
            retailcitycode: {required: true, checkName: $('#retailcitycode').val()}
        },
        messages: {
            new_renewal: '<br />Please select a valid value',
            underwriter: '<br />Please select a valid underwriter name',
            underwriter_master: '<br />Please select a valid underwriter name',
            product_line_master: '<br />Please select a valid product line',
            product_line_subtype: '<br />Please select a valid product line subtype',
            product_line_subtype_master: '<br />Please select a valid product line subtype',
            section: '<br />Please select a valid section',
            section_master: '<br />Please select a valid section',
            profitcode: '<br />Please select a valid profit code',
            profitcode_master: '<br />Please select a valid profit code',
            primarystatus: '<br />Please select a valid Current Status',
            primarystatus_master: '<br />Please select a valid Current Status',
            effectivedate: '<br />Please select a valid date',
            insuredName: {required: '<br />Please enter valid insured name', minlength: '<br />Please enter atleast first 3 characters'},
            dbaname: '<br />Please enter valid DBA Name',
            newaddress1: '<br />Please enter valid address',
            newcountry: '<br />Please select a valid country',
            newstate: '<br />Please select a valid state',
            newcity: '<br />Please select a valid city',
            newzipcode: {regex: '<br />Please enter valid zipcode'},
            insuredContactPerson: {required: '<br />Please select a valid Contact Person Name', checkName: '<br />Please select a valid Contact Person Name'},
            cabValue: '<br /><br />Please select a valid Priority  Companies',
            OccupancyCode: '<br />Please select a valid Occupancy Code',
            NumberOfLocations: '<br />Please select a valid Number of Locations (greater than 3)',
            brokercode: '<br />Please select a valid Broker Name',
            countrycode: '<br />Please select a valid Broker country',
            statecode: '<br />Please select a valid Broker state',
            citycode: '<br />Please select a valid Broker city',
            branch_office: '<br />Please select a valid Branch Office',
            broker_contact_person_email: '<br />Please enter a valid email id',
            total_insured_value_text: '<br />Please enter a valid Total Insured Value',
            total_insured_value_select: '<br />Please select a valid Total Insured Value',
            reason_code: '<br />Please select a valid Reason Code',
            processdate: '<br />Please enter a valid Process Date',
            exchangeRateDate: '<br />Please enter a valid Exchange Rate as on',
            currency: {required: '<br />Please select a valid Currency', checkName: '<br />Please select a valid Currency'},
            exchangeRate: {required: '<br />Please enter a valid Exchange Rate', regex: '<br />Please enter a valid Exchange Rate', min: '<br />Please enter a valid Exchange Rate'},
            gross_premium_text: {required: '<br />Please enter a valid Premium in Local Currency', regex: '<br />Please enter a valid Premium in Local Currency',checkNumber: '<br />Please enter a valid Premium in Local Currency'},
            gross_premium_select: '<br />Please select a valid Gross Premium in Local Currency',
            limit_text: {required: '<br />Please enter a valid Limit in Local Currency',regex: '<br />Please enter a valid Limit in Local Currency', checkNumber:'<br />Please enter a valid Limit in Local Currency'},
            brokercontactperson: '<br />Please select a valid Broker Contact Person',
            borker_contact_peson_number: {regex: '<br /> Please enter a valid number'},
            attachment_point: {regex: '<br /> Attachment Point in Local Currency',checkNumber:'<br />Please enter a valid Attachment Point in Local Currency'},
            byBerkSi: '<br />Please select a valid Date',
            byIndia: '<br />Please select a valid Date',
            /*Added for new field of Bound*/
            binddate: '<br />Please enter a valid Bind Date',
            policyName: '<br />Please select valid value of Policy Type',
            directAssumed: '<br />Please select valid value for Direct/Assumed',
            companyPaper: '<br />Please select valid Company Paper',
            companyPaperNumber: '<br />Please select valid Company Paper Number',
            renewable: '<br />Please select a valid renewable',
            dateofrenewal: '<br />Please enter a valid renewable date',
            coverage: '<br />Please enter a valid Coverage',
            admitted: '<br />Please enter a valid Admitted/Non-Admitted',
            policyNumber: '<br />Please enter a valid Policy Number',
            suffix: '<br />Please select a valid Suffix',
            transactionNumber: '<br />Please select a valid Tarnsaction Number',
            naicCode: '<br />Please enter a valid NAIC Code',
            naicTitle: '<br />Please enter a valid NAIC Title',
            sicCode: '<br />Please enter a valid SIC Code',
            sicTitle: '<br />Please select a valid SIC Title',
            ofrcAdvreport: '<br />Please select a valid OFRC Adverse Report',
            layerLimitLocalCurrency: '<br />Please enter valid Layer of Limit in Local Currency',
            layerLimitUSD: '<br />Please enter valid Layer of Limit in USD',
            PercentageLayer: '<br />Please enter valid % of Layer',
            selfInsuredRetention: '<br />Please enter valid Self Insured Retention in Local Currency',
            selfInsuredRetentionUSD: '<br />Please enter valid Self Insured Retention in USD',
            policyCommission: '<br />Please enter valid Policy Commission %',
            policyComissionInLocalCurrency: '<br />Please enter valid Policy Commision in Local Currency',
            retailBrokerName: '<br />Please enter a valid Retail Broker Name',
            retailcountrycode: '<br />Please select a valid Retail Broker Country',
            retailstatecode: '<br />Please select a valid Retail Broker State',
            retailcitycode: '<br />Please select a valid Retail Broker City'
        },
        highlight: function (element) {
            $(element).addClass('error');
        },
        unhighlight: function (element) {
            $(element).removeClass('error');
        }
    });
    /*For Form Validation end*/
    /*******************************************************************************************************************/
    /*For handle checkbox in date fields start*/
    function brokerDateHandler1() {
        $('#byBerkSi').val("");
        $('#byBerkSi').removeAttr('required');
        $('#byBerkSi').removeClass('error');
        $('#byBerkSi').next('.error').hide();
        $('#byBerkSi').datepicker("disable");
        $("#yesBroker").one("click", brokerDateHandler2);
    }
    function brokerDateHandler2() {
        $('#byBerkSi').attr('required', true);
        $('#byBerkSi').datepicker("enable");
        $("#yesBroker").one("click", brokerDateHandler1);
    }
    $("#yesBroker").one("click", brokerDateHandler1);

    function indiaDateHandler1() {
        $('#byIndia').val("");
        $('#byIndia').removeAttr('required');
        $('#byIndia').removeClass('error');
        $('#byIndia').next('.error').hide();
        $('#byIndia').datepicker("disable");
        $("#yesIndia").one("click", indiaDateHandler2);
    }
    function indiaDateHandler2() {
        $('#byIndia').attr('required', true);
        $('#byIndia').datepicker("enable");
        $("#yesIndia").one("click", indiaDateHandler1);
    }
    $("#yesIndia").one("click", indiaDateHandler1);

    $("#yesTrue").on("click", function () {
        $("#total_insured_values").toggleClass('dp-block');
        $("#total_insured").toggleClass('dp-none');
        $('#total_insured_value_usd').val("");
        $('#total_insured_value').val("");
        $('#total_insured_value_select').val("");
    });
    /*Bind date handler function*/
    function bindDateHandler1() {
        $('#binddate').val("");
        $('#binddate').removeAttr('required');
        $('#binddate').removeClass('error');
        $('#binddate').next('.error').hide();
        $('#binddate').datepicker("disable");
        $("#yesBinddate").one("click", bindDateHandler2);
    }
    function bindDateHandler2() {
        if ($('#primarystatus_master').val() == 9) {
            $('#yesBinddate').prop('disable', false);
            $('#binddate').attr('required', true);
            $('#binddate').datepicker("enable");
            $("#yesBinddate").one("click", bindDateHandler1);

        } else {
            $('#binddate').datepicker("disable");
        }
        $("#yesBinddate").one("click", bindDateHandler1);
    }
    $("#yesBinddate").one("click", bindDateHandler1);
    /*For handle checkbox in date fields start*/
    /****************************************************************************************************/
    $('[name="insured_name"]').on('click', function () {
        if ($(this).val() === 'Y') {
            $('#dbaname').prop('disabled', false);
        } else {
            $('#dbaname').prop('disabled', true);
            $('#dbaname').val("");
        }
    });
    $('[name="insured_mailingaddress"]').on('click', function () {
        if ($(this).val() === 'Y') {
            $('[class*="mailingaddress"]').prop('disabled', false);
        } else {
            $('[class*="mailingaddress"]').prop('disabled', true);
            $('#newaddress1').val("");
            $('#newcountry').val("");
            $('#newstate').val("");
            $('#newcity').val("");
            $('#newzipcode').val("");
        }
    });
    /****************************************************************************************************/
    $('[id="product_line_subtype"]').on('change', function () {
        if ($('#product_line').val() == 'Property') {
            $('#total_insured_value').prop('disabled', false);
            $('#total_insured_value_select').prop('disabled', false);
            $('#total_insured_value_usd').prop('disabled', false);
            $('#yesTrue').prop('disabled', false);
            $('#OccupancyCode').prop('disabled', false);
            $('#NumberOfLocations').prop('disabled', false);
            $('#riskProfile').prop('disabled', false);
        } else {
            $('#total_insured_value').prop('disabled', true);
            $('#total_insured_value_select').prop('disabled', true);
            $('#total_insured_value_usd').prop('disabled', true);
            $('#yesTrue').prop('disabled', true);
            $('#OccupancyCode').prop('disabled', true);
            $('#NumberOfLocations').prop('disabled', true);
            $('#total_insured_value').val("");
            $('#total_insured_value_select').val("");
            $('#total_insured_value_usd').val("");
            $('#OccupancyCode').val("");
            $('#NumberOfLocations').val("");
            $('#riskProfile').val("");
        }
        if ($('#product_line').val() == 'Property' && $('#product_line_subtype').val() == '3') {
            $('[class*="project"]').prop('disabled', false);
        } else {
            $('[class*="project"]').prop('disabled', true);
            $('#projectname').val("");
            $('#generalcontratorname').val("");
            $('#projectownername').val("");
            $('#projectcountry').val("");
            $('#projectstate').val("");
            $('#projectcity').val("");
            $('#projectstreetaddress').val("");
            $('#bidsituation').val("");
        }
    });
    /****************************************************************************************************/
    $('[id="section"]').on('change', function () {
        if ($('#product_line').val() == 'Property' && $('#product_line_subtype').val() == '3' || $('#product_line').val() == 'Casualty' && $('#product_line_subtype').val() == '492') {
            $('[class*="project"]').prop('disabled', false);
        } else {
            $('[class*="project"]').prop('disabled', true);
            $('#projectname').val("");
            $('#generalcontratorname').val("");
            $('#projectownername').val("");
            $('#projectcountry').val("");
            $('#projectstate').val("");
            $('#projectcity').val("");
            $('#projectstreetaddress').val("");
            $('#bidsituation').val("");
        }
    });
    /****************************************************************************************************/
    $('[id="underwriter"]').on('change', function () {
        $('[class*="project"]').prop('disabled', true);
        $('#projectname').val("");
        $('#generalcontratorname').val("");
        $('#projectownername').val("");
        $('#projectcountry').val("");
        $('#projectstate').val("");
        $('#projectcity').val("");
        $('#projectstreetaddress').val("");
        $('#bidsituation').val("");
    });
    /****************************************************************************************************/
    $('[id="product_line_subtype_master"]').on('change', function () {
        if ($('#product_line_master').val() == '1') {
            $('#total_insured_value').prop('disabled', false);
            $('#total_insured_value_select').prop('disabled', false);
            $('#total_insured_value_usd').prop('disabled', false);
            $('#yesTrue').prop('disabled', false);
            $('#OccupancyCode').prop('disabled', false);
            $('#NumberOfLocations').prop('disabled', false);
        } else {
            $('#total_insured_value').prop('disabled', true);
            $('#total_insured_value_select').prop('disabled', true);
            $('#total_insured_value_usd').prop('disabled', true);
            $('#yesTrue').prop('disabled', true);
            $('#OccupancyCode').prop('disabled', true);
            $('#NumberOfLocations').prop('disabled', true);
            $('#total_insured_value').val("");
            $('#total_insured_value_select').val("");
            $('#total_insured_value_usd').val("");
            $('#OccupancyCode').val("");
            $('#NumberOfLocations').val("");
        }
        if ($('#product_line_master').val() == '1' && $('#product_line_subtype_master').val() == '3') {
            $('[class*="project"]').prop('disabled', false);
        } else {
            $('[class*="project"]').prop('disabled', true);
            $('#projectname').val("");
            $('#generalcontratorname').val("");
            $('#projectownername').val("");
            $('#projectcountry').val("");
            $('#projectstate').val("");
            $('#projectcity').val("");
            $('#projectstreetaddress').val("");
            $('#bidsituation').val("");
        }
    });
    /****************************************************************************************************/
    $('[id="section_master"]').on('change', function () {
        if ($('#product_line_master').val() == '1' && $('#product_line_subtype_master').val() == '3' || $('#product_line_master').val() == '2' && $('#product_line_subtype_master').val() == '492') {
            $('[class*="project"]').prop('disabled', false);
        } else {
            $('[class*="project"]').prop('disabled', true);
            $('#projectname').val("");
            $('#generalcontratorname').val("");
            $('#projectownername').val("");
            $('#projectcountry').val("");
            $('#projectstate').val("");
            $('#projectcity').val("");
            $('#projectstreetaddress').val("");
            $('#bidsituation').val("");
        }
    });
    /****************************************************************************************************/
    /*policy type validation on change of product line*/
    $('[id="product_line_master"]').on('change', function () {
        $("#policyName").prop('disabled', true);
        $("#layerLimitLocalCurrency").prop('disabled', true);
        $("#layerLimitUSD").prop('disabled', true);
        $("#PercentageLayer").prop('disabled', true);
        $("#selfInsuredRetention").prop('disabled', true);
        $("#selfInsuredRetentionUSD").prop('disabled', true);
        $("#layerLimitLocalCurrency").prop('disabled', true);

        if ($('#product_line_master').val() == 2 && $('#primarystatus_master').val() == 9) {
            $("#policyName").prop('disabled', false);
        } else {
            $("#policyName").prop('disabled', true);
        }
        if (($('#product_line_master').val() == 3 || $('#product_line_master').val() == 4) && $('#primarystatus_master').val() == 9) {
            $("#layerLimitLocalCurrency").prop('disabled', false);
        } else {
            $("#layerLimitLocalCurrency").prop('disabled', true);
        }
        if (($('#product_line_master').val() == 3 || $('#product_line_master').val() == 4) && $('#primarystatus_master').val() == 9) {
            $("#layerLimitUSD").prop('disabled', false);
        } else {
            $("#layerLimitUSD").prop('disabled', true);
        }
        if (($('#product_line_master').val() == 3 || $('#product_line_master').val() == 4) && $('#primarystatus_master').val() == 9) {
            $("#PercentageLayer").prop('disabled', false);
        } else {
            $("#PercentageLayer").prop('disabled', true);
        }
        if (($('#product_line_master').val() == 3 || $('#product_line_master').val() == 4) && $('#primarystatus_master').val() == 9) {
            $("#selfInsuredRetention").prop('disabled', false);
        } else {
            $("#selfInsuredRetention").prop('disabled', true);
        }
        if (($('#product_line_master').val() == 3 || $('#product_line_master').val() == 4) && $('#primarystatus_master').val() == 9) {
            $("#selfInsuredRetentionUSD").prop('disabled', false);
        } else {
            $("#selfInsuredRetentionUSD").prop('disabled', true);
        }
    });
    /****************************************************************************************************/
    $('#primarystatus_master').change(function () {
        /*bind date validation on change of current status*/
        $('#binddate').prop('disabled', true);
        $('#renewable').prop('disabled', true);
        $('#dateofrenewal').prop('disabled', true);
        $("#policyName").prop('disabled', true);
        $('#directAssumed').prop('disabled', true);
        $('#admitted').prop('disabled', true);
        $('#companyPaper').prop('disabled', true);
        $('#companyPaperNumber').prop('disabled', true);
        $('#coverage').prop('disabled', true);
        $('#policyNumber').prop('disabled', true);
        $('#suffix').prop('disabled', true);
        $('#transactionNumber').prop('disabled', true);
        $('#naicCode').prop('disabled', true);
        $('#naicTitle').prop('disabled', true);
        $('#sicCode').prop('disabled', true);
        $('#sicTitle').prop('disabled', true);
        $('#ofrcReport').prop('disabled', true);
        /*layer limit local currency validation on change of current status*/
        $("#layerLimitLocalCurrency").prop('disabled', true);
        $("#layerLimitUSD").prop('disabled', true);
        $("#PercentageLayer").prop('disabled', true);
        $("#selfInsuredRetention").prop('disabled', true);
        $("#selfInsuredRetentionUSD").prop('disabled', true);
        $("#policyCommission").prop('disabled', true);
        $("#policyComissionInLocalCurrency").prop('disabled', true);
        $("#policyComissionInUSD").prop('disabled', true);
        $("#netpremiumCommissionInLocalCurrency").prop('disabled', true);
        $("#netpremiumCommissionInUSD").prop('disabled', true);
        $('#dateofrenewal').prop('value', '');

        var primaryStatus = $('#primarystatus_master').val();
        if (primaryStatus == 4) {
            $('#reason_code').prop('disabled', false);
            $('[class*="statusDetails"]').prop('disabled', true);
        } else if (primaryStatus == 7 || primaryStatus == 8) {
            $('[class*="statusDetails"]').prop('disabled', false);
            $('#reason_code').prop('disabled', false);
            $('#processdate').prop('disabled', true);
        } else if (primaryStatus == 9) {
            $('#processdate').prop('disabled', false);
            $('[class*="statusDetails"]').prop('disabled', false);
            $('#reason_code').prop('disabled', true);
            /*bind date validation on change of current status*/
            $('#binddate').prop('disabled', false);
            $('#renewable').prop('disabled', false);
            $('#dateofrenewal').prop('disabled', false);
            $('#dateofrenewal').prop('value', $('#expirydate').val());
            $('#directAssumed').prop('disabled', false);
            $('#admitted').prop('disabled', false);
            $('#companyPaper').prop('disabled', false);
            $('#companyPaperNumber').prop('disabled', false);
            $('#coverage').prop('disabled', false);
            $('#policyNumber').prop('disabled', false);
            $('#suffix').prop('disabled', false);
            $('#transactionNumber').prop('disabled', false);
            $('#naicCode').prop('disabled', false);
            $('#naicTitle').prop('disabled', false);
            $('#sicCode').prop('disabled', false);
            $('#sicTitle').prop('disabled', false);
            $('#ofrcReport').prop('disabled', false);
            $("#policyCommission").prop('disabled', false);
            $("#policyComissionInLocalCurrency").prop('disabled', false);
            $("#policyComissionInUSD").prop('disabled', false);
            $("#netpremiumCommissionInLocalCurrency").prop('disabled', false);
            $("#netpremiumCommissionInUSD").prop('disabled', false);
        } else if (primaryStatus == 5 || primaryStatus == 3) {
            $('[class*="statusDetails"]').prop('disabled', false);
            $('#reason_code').prop('disabled', true);
            $('#processdate').prop('disabled', true);
        } else {
            $('[class*="statusDetails"]').prop('disabled', true);
            $('#reason_code').prop('disabled', true);
            $('#processdate').prop('disabled', true);
        }
        /*policy type validation on change of current status*/
        if ($('#product_line_master').val() == '2' && $('#primarystatus_master').val() == '9') {
            $("#policyName").prop('disabled', false);
        } else {
            $("#policyName").prop('disabled', true);
        }
        /*layer limit local currency validation on change of current status*/
        if (($('#product_line_master').val() == 3 || $('#product_line_master').val() == 4) && $('#primarystatus_master').val() == 9) {
            $("#layerLimitLocalCurrency").prop('disabled', false);
        } else {
            $("#layerLimitLocalCurrency").prop('disabled', true);
        }
        if (($('#product_line_master').val() == 3 || $('#product_line_master').val() == 4) && $('#primarystatus_master').val() == 9) {
            $("#layerLimitUSD").prop('disabled', false);
        } else {
            $("#layerLimitUSD").prop('disabled', true);
        }
        if (($('#product_line_master').val() == 3 || $('#product_line_master').val() == 4) && $('#primarystatus_master').val() == 9) {
            $("#PercentageLayer").prop('disabled', false);
        } else {
            $("#PercentageLayer").prop('disabled', true);
        }
        if (($('#product_line_master').val() == 3 || $('#product_line_master').val() == 4) && $('#primarystatus_master').val() == 9) {
            $("#selfInsuredRetention").prop('disabled', false);
        } else {
            $("#selfInsuredRetention").prop('disabled', true);
        }
        if (($('#product_line_master').val() == 3 || $('#product_line_master').val() == 4) && $('#primarystatus_master').val() == 9) {
            $("#selfInsuredRetentionUSD").prop('disabled', false);
        } else {
            $("#selfInsuredRetentionUSD").prop('disabled', true);
        }
    });
    /****************************************************************************************************/
    $("#yesGross").on("click", function () {
        $("#gross_premium_values").toggleClass('dp-block');
        $("#gross_premium_value").toggleClass('dp-none');
    });
    $("#yesLimit").on("click", function () {
        $("#limit_values").toggleClass('dp-block');
        $("#limit_value").toggleClass('dp-none');
    });
    $("#yesAttachment").on("click", function () {
        $("#attachment_values").toggleClass('dp-block');
        $("#attachment_value").toggleClass('dp-none');
    });
    /****************************************************************************************************/
    /****************************************************************************************/
    $('[id="suffix"]').on('change', function () {
        var srt = $('#effectivedate').val();
        srt = srt.match(/\d{2}$/);
        var suffix = $('#suffix option:selected').text();
        if (suffix == 'To Be Entered' | suffix == 'Not Applicable') {
            var FinalNumber = 'Unknown';
        } else if (suffix == '--Select--') {
            var FinalNumber = '';
        } else {
            var FinalNumber = srt + suffix + '01';
        }
        $('#transactionNumber').val(FinalNumber);
});
    /****************************************************************************************/
});


