$(document).ready(function () {
    var createJSON = {
        'submission': function () {
            var inputData = {};
            $('#submissionFrm input[type=text] , #submissionFrm select').each(function (index, node) {
                inputData[$(node).attr('id')] = $(node).val();
            });
            inputData = JSON.stringify(inputData);
            return inputData;
        }
    };

    $(".from").datepicker({
        onClose: function (selectedDate) {
            $(".to").datepicker("option", "minDate", selectedDate);
        },
        onSelect: function () {
            $(".from").valid();
        }
    });

    $(".to").datepicker({
        onClose: function (selectedDate) {
            $(".from").datepicker("option", "maxDate", selectedDate);
        },
        onSelect: function () {
            $(".to").valid();
        }
    });

    $("#submissionFrm").validate({
        rules: {
            SubmissionFromDate: {
                required: {
                    depends: function (element) {
                        var status = false;
                        if ($("#SubmissionToDate").val()) {
                            var status = true;
                        }
                        return status;
                    }
                }
            },
            SubmissionToDate: {
                required: {
                    depends: function (element) {
                        var status = false;
                        if ($("#SubmissionFromDate").val()) {
                            var status = true;
                        }
                        return status;
                    }
                }
            },
            EffectiveFromDate: {
                required: {
                    depends: function (element) {
                        var status = false;
                        if ($("#EffectiveToDate").val()) {
                            var status = true;
                        }
                        return status;
                    }
                }
            },
            EffectiveToDate: {
                required: {
                    depends: function (element) {
                        var status = false;
                        if ($("#EffectiveFromDate").val()) {
                            var status = true;
                        }
                        return status;
                    }
                }
            },
            ExpirationFromDate: {
                required: {
                    depends: function (element) {
                        var status = false;
                        if ($("#ExpirationToDate").val()) {
                            var status = true;
                        }
                        return status;
                    }
                }
            },
            ExpirationToDate: {
                required: {
                    depends: function (element) {
                        var status = false;
                        if ($("#ExpirationFromDate").val()) {
                            var status = true;
                        }
                        return status;
                    }
                }
            },
            ProcessFromDate: {
                required: {
                    depends: function (element) {
                        var status = false;
                        if ($("#ProcessToDate").val()) {
                            var status = true;
                        }
                        return status;
                    }
                }
            },
            ProcessToDate: {
                required: {
                    depends: function (element) {
                        var status = false;
                        if ($("#ProcessFromDate").val()) {
                            var status = true;
                        }
                        return status;
                    }
                }
            },
            EditFromDate: {
                required: {
                    depends: function (element) {
                        var status = false;
                        if ($("#EditToDate").val()) {
                            var status = true;
                        }
                        return status;
                    }
                }
            },
            EditToDate: {
                required: {
                    depends: function (element) {
                        var status = false;
                        if ($("#EditFromDate").val()) {
                            var status = true;
                        }
                        return status;
                    }
                }
            },
            DateofRenewalFromDate: {
                required: {
                    depends: function (element) {
                        var status = false;
                        if ($("#DateofRenewalToDate").val()) {
                            var status = true;
                        }
                        return status;
                    }
                }
            },
            DateofRenewalToDate: {
                required: {
                    depends: function (element) {
                        var status = false;
                        if ($("#DateofRenewalFromDate").val()) {
                            var status = true;
                        }
                        return status;
                    }
                }
            }
        },
        errorElement: 'div',
        wrapper: 'div',
        errorPlacement: function (error, element) {
            error.insertAfter(element);
        },
        messages: {
            SubmissionFromDate: {
                required: "Please enter create date (From Date)"
            },
            SubmissionToDate: {
                required: "Please enter create date (To Date)"
            },
            EffectiveFromDate: {
                required: "Please enter effective date (From Date)"
            },
            EffectiveToDate: {
                required: "Please enter effective date (To Date)"
            },
            ExpirationFromDate: {
                required: "Please enter expiry date (From Date)"
            },
            ExpirationToDate: {
                required: "Please enter expiry date (To Date)"
            },
            ProcessFromDate: {
                required: "Please enter process date (From Date)"
            },
            ProcessToDate: {
                required: "Please enter process date (To Date)"
            },
            EditFromDate: {
                required: "Please enter edit date (From Date)"
            },
            EditToDate: {
                required: "Please enter edit date (To Date)"
            },
            DateofRenewalFromDate: {
                required: "Please enter date of renewal (From Date)"
            },
            DateofRenewalToDate: {
                required: "Please enter date of renewal (To Date)"
            }
        }
    });
    /////////////////////////////////////////////////////////////qc filter validation//////////////////////////
    $("#qcSubmissionFrm").validate({
        rules: {
            SubmissionFromDate: {
                required: {
                    depends: function (element) {
                        var status = false;
                        if ($("#SubmissionToDate").val()) {
                            var status = true;
                        }
                        return status;
                    }
                }
            },
            SubmissionToDate: {
                required: {
                    depends: function (element) {
                        var status = false;
                        if ($("#SubmissionFromDate").val()) {
                            var status = true;
                        }
                        return status;
                    }
                }
            },
            EffectiveFromDate: {
                required: {
                    depends: function (element) {
                        var status = false;
                        if ($("#EffectiveToDate").val()) {
                            var status = true;
                        }
                        return status;
                    }
                }
            },
            EffectiveToDate: {
                required: {
                    depends: function (element) {
                        var status = false;
                        if ($("#EffectiveFromDate").val()) {
                            var status = true;
                        }
                        return status;
                    }
                }
            },
            ExpirationFromDate: {
                required: {
                    depends: function (element) {
                        var status = false;
                        if ($("#ExpirationToDate").val()) {
                            var status = true;
                        }
                        return status;
                    }
                }
            },
            ExpirationToDate: {
                required: {
                    depends: function (element) {
                        var status = false;
                        if ($("#ExpirationFromDate").val()) {
                            var status = true;
                        }
                        return status;
                    }
                }
            },
            ProcessFromDate: {
                required: {
                    depends: function (element) {
                        var status = false;
                        if ($("#ProcessToDate").val()) {
                            var status = true;
                        }
                        return status;
                    }
                }
            },
            ProcessToDate: {
                required: {
                    depends: function (element) {
                        var status = false;
                        if ($("#ProcessFromDate").val()) {
                            var status = true;
                        }
                        return status;
                    }
                }
            },
            EditFromDate: {
                required: {
                    depends: function (element) {
                        var status = false;
                        if ($("#EditToDate").val()) {
                            var status = true;
                        }
                        return status;
                    }
                }
            },
            EditToDate: {
                required: {
                    depends: function (element) {
                        var status = false;
                        if ($("#EditFromDate").val()) {
                            var status = true;
                        }
                        return status;
                    }
                }
            },
            DateofRenewalFromDate: {
                required: {
                    depends: function (element) {
                        var status = false;
                        if ($("#DateofRenewalToDate").val()) {
                            var status = true;
                        }
                        return status;
                    }
                }
            },
            DateofRenewalToDate: {
                required: {
                    depends: function (element) {
                        var status = false;
                        if ($("#DateofRenewalFromDate").val()) {
                            var status = true;
                        }
                        return status;
                    }
                }
            }
        },
        errorElement: 'div',
        wrapper: 'div',
        errorPlacement: function (error, element) {
            error.insertAfter(element);
        },
        messages: {
            SubmissionFromDate: {
                required: "Please enter create date (From Date)"
            },
            SubmissionToDate: {
                required: "Please enter create date (To Date)"
            },
            EffectiveFromDate: {
                required: "Please enter effective date (From Date)"
            },
            EffectiveToDate: {
                required: "Please enter effective date (To Date)"
            },
            ExpirationFromDate: {
                required: "Please enter expiry date (From Date)"
            },
            ExpirationToDate: {
                required: "Please enter expiry date (To Date)"
            },
            ProcessFromDate: {
                required: "Please enter process date (From Date)"
            },
            ProcessToDate: {
                required: "Please enter process date (To Date)"
            },
            EditFromDate: {
                required: "Please enter edit date (From Date)"
            },
            EditToDate: {
                required: "Please enter edit date (To Date)"
            },
            DateofRenewalFromDate: {
                required: "Please enter date of renewal (From Date)"
            },
            DateofRenewalToDate: {
                required: "Please enter date of renewal (To Date)"
            }
        }
    });

    var $table = $('#submission-list-wrapper table'),
            plusIcon = $table.find('.plus-icon'),
            ine = $table.find('.insured-name-expand'),
            ple = $table.find('.product-line-expand'),
            cse = $table.find('.current-status-expand'),
            ede = $table.find('.effective-date-expand'),
            bne = $table.find('.broker-name-expand'),
            gpe = $table.find('.gross-premium-expand'),
            pne = $table.find('.project-name-expand'),
            rdbie = $table.find('.received-date-by-india-expand'),
            tiv = $table.find('.TIV-expand'),
            cpd = $table.find('.contact-person-expand'),
            bcpd = $table.find('.broker-contactperson-expand'),
            bnd = $table.find('.ProcessDate-expand'),
            naic = $table.find('.NAICTitle-expand'),
            ebk = $table.find('.wholesaler-expand'),
            pt = $table.find('.policyType-expand'),
            cp = $table.find('.companypaper-expand'),
            apl = $table.find('.attachmentPointLocalCurrency-expand'),
            pc = $table.find('.policyCommissionPercentage-expand'),
            lml = $table.find('.layeroflimit-expand'),
            pcn = $table.find('.policyNumber-expand'),
            allFields = ine.add(ple).add(cse).add(ede).add(bne).add(gpe).add(pne).add(rdbie).add(tiv).add(cpd).add(bcpd).add(bnd).add(naic).add(ebk).add(pt).add(cp).add(apl).add(pc).add(lml).add(pcn);

    $('.expandAll').click(function () {
        allFields.removeClass('hidden');
        plusIcon.addClass('expand');
    });
    $('.collapseAll').click(function () {
        allFields.addClass('hidden');
        plusIcon.removeClass('expand');
        $('tr[class*="amendment"]').addClass('hidden');
        $('.open').removeClass('fa-minus');
    });


    $('span.plus-icon').click(function () {
        var $this = $(this),
                $th = $this.parent(),
                thisText = $th.text().trim();
        $this.toggleClass('expand');

        switch (thisText) {
            case "Insured Name":
                ine.toggleClass('hidden');
                cpd.toggleClass('hidden');
                $('tr[class*="amendment"]').addClass('hidden');
                $('.open').removeClass('fa-minus');
                break;
            case "Product Line":
                ple.toggleClass('hidden');
                $('tr[class*="amendment"]').addClass('hidden');
                $('.open').removeClass('fa-minus');
                break;
            case "Current Status":
                cse.toggleClass('hidden');
                $('tr[class*="amendment"]').addClass('hidden');
                $('.open').removeClass('fa-minus');
                break;
            case "Effective Date":
                ede.toggleClass('hidden');
                $('tr[class*="amendment"]').addClass('hidden');
                $('.open').removeClass('fa-minus');
                break;
            case "Broker Name":
                bne.toggleClass('hidden');
                $('.broker-contactperson-expand').addClass('hidden');
                $('.wholesaler-expand').addClass('hidden');
                bne.find('.plus-icon').removeClass('expand');
                $('tr[class*="amendment"]').addClass('hidden');
                $('.open').removeClass('fa-minus');
                break;
            case "Premium (in USD)":
                gpe.toggleClass('hidden');
                $('.attachmentPointLocalCurrency-expand').addClass('hidden');
                $('.policyCommissionPercentage-expand').addClass('hidden');
                $('.layeroflimit-expand').addClass('hidden');
                gpe.find('.plus-icon').removeClass('expand');
                $('tr[class*="amendment"]').addClass('hidden');
                $('.open').removeClass('fa-minus');
                break;
            case "Project Name":
                pne.toggleClass('hidden');
                $('tr[class*="amendment"]').addClass('hidden');
                $('.open').removeClass('fa-minus');
                break;
            case "Date of Receiving -By India From Berk SI":
                rdbie.toggleClass('hidden');
                $('tr[class*="amendment"]').addClass('hidden');
                $('.open').removeClass('fa-minus');
                break;
            case "Address Line 1":
                $('.insured-address-expand').toggleClass('hidden');
                $('tr[class*="amendment"]').addClass('hidden');
                $('.open').removeClass('fa-minus');
                break;
            case "Total Insured Value(TIV)":
                $('.TIV-expand').toggleClass('hidden');
                $('tr[class*="amendment"]').addClass('hidden');
                $('.open').removeClass('fa-minus');
                break;
            case "Insured Contact Person":
                $('.contact-person-expand').toggleClass('hidden');
                $('tr[class*="amendment"]').addClass('hidden');
                $('.open').removeClass('fa-minus');
                break;
            case "Broker Contact Person":
                $('.broker-contactperson-expand').toggleClass('hidden');
                $('tr[class*="amendment"]').addClass('hidden');
                $('.open').removeClass('fa-minus');
                break;
            case "Process Date":
                $('.ProcessDate-expand').toggleClass('hidden');
                $('.NAICTitle-expand').addClass('hidden');
                $('.ProcessDate-expand').find('.plus-icon').removeClass('expand');
                $('tr[class*="amendment"]').addClass('hidden');
                $('.open').removeClass('fa-minus');
                break;
            case "NAIC Title":
                $('.NAICTitle-expand').toggleClass('hidden');
                $('tr[class*="amendment"]').addClass('hidden');
                $('.open').removeClass('fa-minus');
                break;
            case "Wholesaler or Retailer":
                $('.wholesaler-expand').toggleClass('hidden');
                $('tr[class*="amendment"]').addClass('hidden');
                $('.open').removeClass('fa-minus');
                break;
            case "Policy Type":
                $('.policyType-expand').toggleClass('hidden');
                $('tr[class*="amendment"]').addClass('hidden');
                $('.open').removeClass('fa-minus');
                break;
            case "Company Paper":
                $('.companypaper-expand').toggleClass('hidden');
                $('.policyNumber-expand').addClass('hidden');
                $('.policyType-expand').addClass('hidden');
                $('.companypaper-expand').find('.plus-icon').removeClass('expand');
                $('tr[class*="amendment"]').addClass('hidden');
                $('.open').removeClass('fa-minus');
                break;
            case "Attachment Point in Local Currency":
                $('.attachmentPointLocalCurrency-expand').toggleClass('hidden');
                $('.policyCommissionPercentage-expand').addClass('hidden');
                $('.layeroflimit-expand').addClass('hidden');
                $('.attachmentPointLocalCurrency-expand').find('.plus-icon').removeClass('expand');
                $('tr[class*="amendment"]').addClass('hidden');
                $('.open').removeClass('fa-minus');
                break;
            case "Policy Comm %":
                $('.policyCommissionPercentage-expand').toggleClass('hidden');
                $('.layeroflimit-expand').addClass('hidden');
                $('.policyCommissionPercentage-expand').find('.plus-icon').removeClass('expand');
                $('tr[class*="amendment"]').addClass('hidden');
                $('.open').removeClass('fa-minus');
                break;
            case "Layer of Limit(in USD)":
                $('.layeroflimit-expand').toggleClass('hidden');
                $('tr[class*="amendment"]').addClass('hidden');
                $('.open').removeClass('fa-minus');
                break;
            case "Policy Number":
                $('.policyNumber-expand').toggleClass('hidden');
                $('tr[class*="amendment"]').addClass('hidden');
                $('.open').removeClass('fa-minus');
                break;
        }
    });
    $('.open').click(function () {
        var id = $(this).attr('id');
        var val = $(this).val();
        $(this).toggleClass('fa-minus');
        var className = $(this).attr('class');
        if (className === 'btn btn-small btn-gray open fa fa-plus fa-minus') {
            allFields.removeClass('hidden');
            plusIcon.addClass('expand');
        } else {
            //allFields.addClass('hidden');
            //plusIcon.removeClass('expand');
        }
        var row = $(this);
        if (id) {
            var dataObj = {
                'header': {
                    'requestName': 'amendmentList'
                },
                'body': {
                    'data': id,
                    'cancelChild': val
                }
            };
            $.ajax('/submission/amendmentList', {
                'dataType': 'json',
                'data': JSON.stringify(dataObj),
                'type': 'post',
                'success': function (data, status, xhr) {
                    if (data != '') {
                        var amendmenthtml = amendmentSubmissionListOption(data);
                        if ($('.amendment-child' + id).length > 0) {
                            $('.amendment-child' + id).toggleClass('hidden');
                        } else {
                            $('.amendment-child' + id).toggleClass('hidden');
                            row.parents('tr').after(amendmenthtml);
                        }
                    } else {
                        row.toggleClass('fa-minus');
                        allFields.addClass('hidden');
                        plusIcon.removeClass('expand');
                        swal({
                            title: "Warning!",
                            text: "This Record has not any Amendments.",
                            timer: 2000
                        });
                    }
                }
            });
        } else {
            return false;
        }
    });

    var amendmentSubmissionListOption = function (data) {
        var listOption = '';
        for (var i = 0; i < data.length; i += 1) {
            if (data[i].ReversalRight == 'Reversal' && data[i].CancelationChild == 0) {
                if (data[i].QcStatus == 'Approved' && data[i].IsReversal == '0') {
                    listOption += "<tr class='amendment-child" + data[i].SubmissionId + "'><td><a class='btn btn-orange btn-small' title='Edit' style = 'margin-right: 8px!important;' href='/submission/editamendment?amendmentId=" + data[i].AmendmentId + "'><i class='fa fa-pencil'></i></a><a class='btn btn-green btn-small' style = 'margin-right: 8px!important;' title='View' href='/submission/viewamendment?amendmentId=" + data[i].AmendmentId + "'><i class='fa fa-eye'></i></a><button id='" + data[i].AmendmentId + "' class='btn btn-red btn-small reversal' style = 'margin-right: 8px!important;' title='Reversal'><i class='fa fa-exchange'></i></button></td><td>" + data[i].QcStatus + "</td><td>" + data[i].SubmissionNumber + "</td><td>" + data[i].FinalPolicyNumber + "</td><td>" + data[i].NewRenewal + "</td><td>" + data[i].InsuredName + "</td><td>" + data[i].DbNumber + "</td><td>" + data[i].InsuredCountry + "</td><td>" + data[i].InsuredState + "</td><td>" + data[i].InsuredCity + "</td><td>" + data[i].InsuredAddress1 + "</td><td>" + data[i].InsuredZipCode + "</td><td>" + data[i].ReinsuredCompany + "</td><td>" + data[i].DbaName + "</td><td>" + data[i].InsuredContactPersonName + "</td><td>" + data[i].InsuredContactPersonEmail + "</td><td>" + data[i].InsuredContactPersonPhoneNumbe + "</td><td>" + data[i].InsuredContactPersonMobileNumb + "</td><td>" + data[i].InsuredSubmissionDate + "</td><td>" + data[i].InsuredQuoteDueDate + "</td><td>" + data[i].UnderwriterName + "</td><td>" + data[i].ProductLine + "</td><td>" + data[i].ProductLineSubType + "</td><td>" + data[i].SectionCode + "</td><td>" + data[i].ProfitCode + "</td><td>" + data[i].Status + "</td><td>" + data[i].ReasonCode + "</td><td>" + data[i].EffectiveDate + "</td><td>" + data[i].ExpiryDate + "</td><td>" + data[i].BranchName + "</td><td>" + data[i].BrokerName + "</td><td>" + data[i].BrokerCountry + "</td><td>" + data[i].BrokerState + "</td><td>" + data[i].BrokerCity + "</td><td>" + data[i].BrokerCode + "</td><td>" + data[i].BrokerType + "</td><td>" + data[i].RetailBrokerName + "</td><td>" + data[i].RetailBrokerCountry + "</td><td>" + data[i].RetailBrokerState + "</td><td>" + data[i].RetailBrokerCity + "</td><td>" + data[i].BrokerContactPerson + "</td><td>" + data[i].BrokerContactPersonEmail + "</td><td>" + data[i].BrokerContactPersonNumber + "</td><td>" + data[i].BrokerContactPersonMobile + "</td><td>" + data[i].CabCompanies + "</td><td>" + data[i].PremiumInUSD + "</td><td>" + data[i].ExchangeDate + "</td><td>" + data[i].ExchangeRate + "</td><td>" + data[i].Currency + "</td><td>" + data[i].PremiumInLocalCurrency + "</td><td>" + data[i].LayerofLimitInUSD + "</td><td>" + data[i].LimitInLocalCurrency + "</td><td>" + data[i].AttachmentPointInUSD + "</td><td>" + data[i].AttachmentPointInLocalCurrency + "</td><td>" + data[i].PolicyCommPercentage + "</td><td>" + data[i].PolicyCommInUSD + "</td><td>" + data[i].PolicyCommInLocalCurrency + "</td><td>" + data[i].PremiumNetofCommInUSD + "</td><td>" + data[i].PremiumNetofCommInLocalCurrenc + "</td><td>" + data[i].LayerofLimitInUSD + "</td><td>" + data[i].LayerofLimitInLocalCurrency + "</td><td>" + data[i].PercentageofLayer + "</td><td>" + data[i].SelfInsuredRetentionInUSD + "</td><td>" + data[i].SelfInsuredRetentionInLocalCur + "</td><td>" + data[i].ProjectName + "</td><td>" + data[i].ProjectContractorName + "</td><td>" + data[i].ProjectOwnerName + "</td><td>" + data[i].ProjectCountry + "</td><td>" + data[i].ProjectState + "</td><td>" + data[i].ProjectCity + "</td><td>" + data[i].ProjectAddressLine1 + "</td><td>" + data[i].Bidsituation + "</td><td>" + data[i].TotalInsuredValueinLocalCurren + "</td><td>" + data[i].TotalInsuredValueInUSD + "</td><td>" + data[i].OccupancyCode + "</td><td>" + data[i].NumberOfLocations + "</td><td>" + data[i].RiskProfile + "</td><td>" + data[i].ProcessDate + "</td><td>" + data[i].BindDate + "</td><td>" + data[i].NAICTitle + "</td><td>" + data[i].NAICCode + "</td><td>" + data[i].SICTitle + "</td><td>" + data[i].SICCode + "</td><td>" + data[i].CompanyPaper + "</td><td>" + data[i].CompanyPaperNumber + "</td><td>" + data[i].Coverage + "</td><td>" + data[i].PolicyNumber + "</td><td>" + data[i].Suffix + "</td><td>" + data[i].Renewable + "</td><td>" + data[i].DateofRenewal + "</td><td>" + data[i].PolicyType + "</td><td>" + data[i].DirectAssumed + "</td><td>" + data[i].AdmittedNonAdmitted + "</td><td>" + data[i].OFRCAdverseReport + "</td><td>" + data[i].TransactionNumber + "</td><td>" + data[i].BerkSiDateFromIndia + "</td><td>" + data[i].BerkSIDateFromBroker + "</td></tr>";
                } else if (data[i].QcStatus == 'Approved' && data[i].IsReversal == '1') {
                    listOption += "<tr class='amendment-child" + data[i].SubmissionId + "'><td><a class='btn btn-orange btn-small' title='Edit' style = 'margin-right: 8px!important;' href='/submission/editamendment?amendmentId=" + data[i].AmendmentId + "'><i class='fa fa-pencil'></i></a><a class='btn btn-green btn-small' style = 'margin-right: 8px!important;' title='View' href='/submission/viewamendment?amendmentId=" + data[i].AmendmentId + "'><i class='fa fa-eye'></i></a></td><td>" + data[i].QcStatus + "</td><td>" + data[i].SubmissionNumber + "</td><td>" + data[i].FinalPolicyNumber + "</td><td>" + data[i].NewRenewal + "</td><td>" + data[i].InsuredName + "</td><td>" + data[i].DbNumber + "</td><td>" + data[i].InsuredCountry + "</td><td>" + data[i].InsuredState + "</td><td>" + data[i].InsuredCity + "</td><td>" + data[i].InsuredAddress1 + "</td><td>" + data[i].InsuredZipCode + "</td><td>" + data[i].ReinsuredCompany + "</td><td>" + data[i].DbaName + "</td><td>" + data[i].InsuredContactPersonName + "</td><td>" + data[i].InsuredContactPersonEmail + "</td><td>" + data[i].InsuredContactPersonPhoneNumbe + "</td><td>" + data[i].InsuredContactPersonMobileNumb + "</td><td>" + data[i].InsuredSubmissionDate + "</td><td>" + data[i].InsuredQuoteDueDate + "</td><td>" + data[i].UnderwriterName + "</td><td>" + data[i].ProductLine + "</td><td>" + data[i].ProductLineSubType + "</td><td>" + data[i].SectionCode + "</td><td>" + data[i].ProfitCode + "</td><td>" + data[i].Status + "</td><td>" + data[i].ReasonCode + "</td><td>" + data[i].EffectiveDate + "</td><td>" + data[i].ExpiryDate + "</td><td>" + data[i].BranchName + "</td><td>" + data[i].BrokerName + "</td><td>" + data[i].BrokerCountry + "</td><td>" + data[i].BrokerState + "</td><td>" + data[i].BrokerCity + "</td><td>" + data[i].BrokerCode + "</td><td>" + data[i].BrokerType + "</td><td>" + data[i].RetailBrokerName + "</td><td>" + data[i].RetailBrokerCountry + "</td><td>" + data[i].RetailBrokerState + "</td><td>" + data[i].RetailBrokerCity + "</td><td>" + data[i].BrokerContactPerson + "</td><td>" + data[i].BrokerContactPersonEmail + "</td><td>" + data[i].BrokerContactPersonNumber + "</td><td>" + data[i].BrokerContactPersonMobile + "</td><td>" + data[i].CabCompanies + "</td><td>" + data[i].PremiumInUSD + "</td><td>" + data[i].ExchangeDate + "</td><td>" + data[i].ExchangeRate + "</td><td>" + data[i].Currency + "</td><td>" + data[i].PremiumInLocalCurrency + "</td><td>" + data[i].LayerofLimitInUSD + "</td><td>" + data[i].LimitInLocalCurrency + "</td><td>" + data[i].AttachmentPointInUSD + "</td><td>" + data[i].AttachmentPointInLocalCurrency + "</td><td>" + data[i].PolicyCommPercentage + "</td><td>" + data[i].PolicyCommInUSD + "</td><td>" + data[i].PolicyCommInLocalCurrency + "</td><td>" + data[i].PremiumNetofCommInUSD + "</td><td>" + data[i].PremiumNetofCommInLocalCurrenc + "</td><td>" + data[i].LayerofLimitInUSD + "</td><td>" + data[i].LayerofLimitInLocalCurrency + "</td><td>" + data[i].PercentageofLayer + "</td><td>" + data[i].SelfInsuredRetentionInUSD + "</td><td>" + data[i].SelfInsuredRetentionInLocalCur + "</td><td>" + data[i].ProjectName + "</td><td>" + data[i].ProjectContractorName + "</td><td>" + data[i].ProjectOwnerName + "</td><td>" + data[i].ProjectCountry + "</td><td>" + data[i].ProjectState + "</td><td>" + data[i].ProjectCity + "</td><td>" + data[i].ProjectAddressLine1 + "</td><td>" + data[i].Bidsituation + "</td><td>" + data[i].TotalInsuredValueinLocalCurren + "</td><td>" + data[i].TotalInsuredValueInUSD + "</td><td>" + data[i].OccupancyCode + "</td><td>" + data[i].NumberOfLocations + "</td><td>" + data[i].RiskProfile + "</td><td>" + data[i].ProcessDate + "</td><td>" + data[i].BindDate + "</td><td>" + data[i].NAICTitle + "</td><td>" + data[i].NAICCode + "</td><td>" + data[i].SICTitle + "</td><td>" + data[i].SICCode + "</td><td>" + data[i].CompanyPaper + "</td><td>" + data[i].CompanyPaperNumber + "</td><td>" + data[i].Coverage + "</td><td>" + data[i].PolicyNumber + "</td><td>" + data[i].Suffix + "</td><td>" + data[i].Renewable + "</td><td>" + data[i].DateofRenewal + "</td><td>" + data[i].PolicyType + "</td><td>" + data[i].DirectAssumed + "</td><td>" + data[i].AdmittedNonAdmitted + "</td><td>" + data[i].OFRCAdverseReport + "</td><td>" + data[i].TransactionNumber + "</td><td>" + data[i].BerkSiDateFromIndia + "</td><td>" + data[i].BerkSIDateFromBroker + "</td></tr>";
                } else {
                    if (data[i].ReversalChild == '1') {
                        listOption += "<tr class='amendment-child" + data[i].SubmissionId + "'><td><a class='btn btn-orange btn-small' title='Edit' style = 'margin-right: 8px!important;' href='/submission/editreversalchild?amendmentId=" + data[i].AmendmentId + "'><i class='fa fa-pencil'></i></a><a class='btn btn-green btn-small' style = 'margin-right: 8px!important;' title='View' href='/submission/viewamendment?amendmentId=" + data[i].AmendmentId + "'><i class='fa fa-eye'></i></a></td><td>" + data[i].QcStatus + "</td><td>" + data[i].SubmissionNumber + "</td><td>" + data[i].FinalPolicyNumber + "</td><td>" + data[i].NewRenewal + "</td><td>" + data[i].InsuredName + "</td><td>" + data[i].DbNumber + "</td><td>" + data[i].InsuredCountry + "</td><td>" + data[i].InsuredState + "</td><td>" + data[i].InsuredCity + "</td><td>" + data[i].InsuredAddress1 + "</td><td>" + data[i].InsuredZipCode + "</td><td>" + data[i].ReinsuredCompany + "</td><td>" + data[i].DbaName + "</td><td>" + data[i].InsuredContactPersonName + "</td><td>" + data[i].InsuredContactPersonEmail + "</td><td>" + data[i].InsuredContactPersonPhoneNumbe + "</td><td>" + data[i].InsuredContactPersonMobileNumb + "</td><td>" + data[i].InsuredSubmissionDate + "</td><td>" + data[i].InsuredQuoteDueDate + "</td><td>" + data[i].UnderwriterName + "</td><td>" + data[i].ProductLine + "</td><td>" + data[i].ProductLineSubType + "</td><td>" + data[i].SectionCode + "</td><td>" + data[i].ProfitCode + "</td><td>" + data[i].Status + "</td><td>" + data[i].ReasonCode + "</td><td>" + data[i].EffectiveDate + "</td><td>" + data[i].ExpiryDate + "</td><td>" + data[i].BranchName + "</td><td>" + data[i].BrokerName + "</td><td>" + data[i].BrokerCountry + "</td><td>" + data[i].BrokerState + "</td><td>" + data[i].BrokerCity + "</td><td>" + data[i].BrokerCode + "</td><td>" + data[i].BrokerType + "</td><td>" + data[i].RetailBrokerName + "</td><td>" + data[i].RetailBrokerCountry + "</td><td>" + data[i].RetailBrokerState + "</td><td>" + data[i].RetailBrokerCity + "</td><td>" + data[i].BrokerContactPerson + "</td><td>" + data[i].BrokerContactPersonEmail + "</td><td>" + data[i].BrokerContactPersonNumber + "</td><td>" + data[i].BrokerContactPersonMobile + "</td><td>" + data[i].CabCompanies + "</td><td>" + data[i].PremiumInUSD + "</td><td>" + data[i].ExchangeDate + "</td><td>" + data[i].ExchangeRate + "</td><td>" + data[i].Currency + "</td><td>" + data[i].PremiumInLocalCurrency + "</td><td>" + data[i].LayerofLimitInUSD + "</td><td>" + data[i].LimitInLocalCurrency + "</td><td>" + data[i].AttachmentPointInUSD + "</td><td>" + data[i].AttachmentPointInLocalCurrency + "</td><td>" + data[i].PolicyCommPercentage + "</td><td>" + data[i].PolicyCommInUSD + "</td><td>" + data[i].PolicyCommInLocalCurrency + "</td><td>" + data[i].PremiumNetofCommInUSD + "</td><td>" + data[i].PremiumNetofCommInLocalCurrenc + "</td><td>" + data[i].LayerofLimitInUSD + "</td><td>" + data[i].LayerofLimitInLocalCurrency + "</td><td>" + data[i].PercentageofLayer + "</td><td>" + data[i].SelfInsuredRetentionInUSD + "</td><td>" + data[i].SelfInsuredRetentionInLocalCur + "</td><td>" + data[i].ProjectName + "</td><td>" + data[i].ProjectContractorName + "</td><td>" + data[i].ProjectOwnerName + "</td><td>" + data[i].ProjectCountry + "</td><td>" + data[i].ProjectState + "</td><td>" + data[i].ProjectCity + "</td><td>" + data[i].ProjectAddressLine1 + "</td><td>" + data[i].Bidsituation + "</td><td>" + data[i].TotalInsuredValueinLocalCurren + "</td><td>" + data[i].TotalInsuredValueInUSD + "</td><td>" + data[i].OccupancyCode + "</td><td>" + data[i].NumberOfLocations + "</td><td>" + data[i].RiskProfile + "</td><td>" + data[i].ProcessDate + "</td><td>" + data[i].BindDate + "</td><td>" + data[i].NAICTitle + "</td><td>" + data[i].NAICCode + "</td><td>" + data[i].SICTitle + "</td><td>" + data[i].SICCode + "</td><td>" + data[i].CompanyPaper + "</td><td>" + data[i].CompanyPaperNumber + "</td><td>" + data[i].Coverage + "</td><td>" + data[i].PolicyNumber + "</td><td>" + data[i].Suffix + "</td><td>" + data[i].Renewable + "</td><td>" + data[i].DateofRenewal + "</td><td>" + data[i].PolicyType + "</td><td>" + data[i].DirectAssumed + "</td><td>" + data[i].AdmittedNonAdmitted + "</td><td>" + data[i].OFRCAdverseReport + "</td><td>" + data[i].TransactionNumber + "</td><td>" + data[i].BerkSiDateFromIndia + "</td><td>" + data[i].BerkSIDateFromBroker + "</td></tr>";
                    } else {
                        listOption += "<tr class='amendment-child" + data[i].SubmissionId + "'><td><a class='btn btn-orange btn-small' title='Edit' style = 'margin-right: 8px!important;' href='/submission/editamendment?amendmentId=" + data[i].AmendmentId + "'><i class='fa fa-pencil'></i></a><a class='btn btn-green btn-small' style = 'margin-right: 8px!important;' title='View' href='/submission/viewamendment?amendmentId=" + data[i].AmendmentId + "'><i class='fa fa-eye'></i></a></td><td>" + data[i].QcStatus + "</td><td>" + data[i].SubmissionNumber + "</td><td>" + data[i].FinalPolicyNumber + "</td><td>" + data[i].NewRenewal + "</td><td>" + data[i].InsuredName + "</td><td>" + data[i].DbNumber + "</td><td>" + data[i].InsuredCountry + "</td><td>" + data[i].InsuredState + "</td><td>" + data[i].InsuredCity + "</td><td>" + data[i].InsuredAddress1 + "</td><td>" + data[i].InsuredZipCode + "</td><td>" + data[i].ReinsuredCompany + "</td><td>" + data[i].DbaName + "</td><td>" + data[i].InsuredContactPersonName + "</td><td>" + data[i].InsuredContactPersonEmail + "</td><td>" + data[i].InsuredContactPersonPhoneNumbe + "</td><td>" + data[i].InsuredContactPersonMobileNumb + "</td><td>" + data[i].InsuredSubmissionDate + "</td><td>" + data[i].InsuredQuoteDueDate + "</td><td>" + data[i].UnderwriterName + "</td><td>" + data[i].ProductLine + "</td><td>" + data[i].ProductLineSubType + "</td><td>" + data[i].SectionCode + "</td><td>" + data[i].ProfitCode + "</td><td>" + data[i].Status + "</td><td>" + data[i].ReasonCode + "</td><td>" + data[i].EffectiveDate + "</td><td>" + data[i].ExpiryDate + "</td><td>" + data[i].BranchName + "</td><td>" + data[i].BrokerName + "</td><td>" + data[i].BrokerCountry + "</td><td>" + data[i].BrokerState + "</td><td>" + data[i].BrokerCity + "</td><td>" + data[i].BrokerCode + "</td><td>" + data[i].BrokerType + "</td><td>" + data[i].RetailBrokerName + "</td><td>" + data[i].RetailBrokerCountry + "</td><td>" + data[i].RetailBrokerState + "</td><td>" + data[i].RetailBrokerCity + "</td><td>" + data[i].BrokerContactPerson + "</td><td>" + data[i].BrokerContactPersonEmail + "</td><td>" + data[i].BrokerContactPersonNumber + "</td><td>" + data[i].BrokerContactPersonMobile + "</td><td>" + data[i].CabCompanies + "</td><td>" + data[i].PremiumInUSD + "</td><td>" + data[i].ExchangeDate + "</td><td>" + data[i].ExchangeRate + "</td><td>" + data[i].Currency + "</td><td>" + data[i].PremiumInLocalCurrency + "</td><td>" + data[i].LayerofLimitInUSD + "</td><td>" + data[i].LimitInLocalCurrency + "</td><td>" + data[i].AttachmentPointInUSD + "</td><td>" + data[i].AttachmentPointInLocalCurrency + "</td><td>" + data[i].PolicyCommPercentage + "</td><td>" + data[i].PolicyCommInUSD + "</td><td>" + data[i].PolicyCommInLocalCurrency + "</td><td>" + data[i].PremiumNetofCommInUSD + "</td><td>" + data[i].PremiumNetofCommInLocalCurrenc + "</td><td>" + data[i].LayerofLimitInUSD + "</td><td>" + data[i].LayerofLimitInLocalCurrency + "</td><td>" + data[i].PercentageofLayer + "</td><td>" + data[i].SelfInsuredRetentionInUSD + "</td><td>" + data[i].SelfInsuredRetentionInLocalCur + "</td><td>" + data[i].ProjectName + "</td><td>" + data[i].ProjectContractorName + "</td><td>" + data[i].ProjectOwnerName + "</td><td>" + data[i].ProjectCountry + "</td><td>" + data[i].ProjectState + "</td><td>" + data[i].ProjectCity + "</td><td>" + data[i].ProjectAddressLine1 + "</td><td>" + data[i].Bidsituation + "</td><td>" + data[i].TotalInsuredValueinLocalCurren + "</td><td>" + data[i].TotalInsuredValueInUSD + "</td><td>" + data[i].OccupancyCode + "</td><td>" + data[i].NumberOfLocations + "</td><td>" + data[i].RiskProfile + "</td><td>" + data[i].ProcessDate + "</td><td>" + data[i].BindDate + "</td><td>" + data[i].NAICTitle + "</td><td>" + data[i].NAICCode + "</td><td>" + data[i].SICTitle + "</td><td>" + data[i].SICCode + "</td><td>" + data[i].CompanyPaper + "</td><td>" + data[i].CompanyPaperNumber + "</td><td>" + data[i].Coverage + "</td><td>" + data[i].PolicyNumber + "</td><td>" + data[i].Suffix + "</td><td>" + data[i].Renewable + "</td><td>" + data[i].DateofRenewal + "</td><td>" + data[i].PolicyType + "</td><td>" + data[i].DirectAssumed + "</td><td>" + data[i].AdmittedNonAdmitted + "</td><td>" + data[i].OFRCAdverseReport + "</td><td>" + data[i].TransactionNumber + "</td><td>" + data[i].BerkSiDateFromIndia + "</td><td>" + data[i].BerkSIDateFromBroker + "</td></tr>";
                    }
                }
            } else if (data[i].CancelationChild > 0) {
                if (data[i].userFlag == 'master') {
                    if (data[i].QcStatus == 'Approved' && data[i].IsReversal == '0') {
                        listOption += "<tr class='amendment-child" + data[i].SubmissionId + "'><td><a class='btn btn-green btn-small' style = 'margin-right: 8px!important;' title='View' href='/submission/viewamendment?amendmentId=" + data[i].AmendmentId + "'><i class='fa fa-eye'></i></a><button id='" + data[i].AmendmentId + "' class='btn btn-red btn-small reversal' style = 'margin-right: 8px!important;' title='Reversal'><i class='fa fa-exchange'></i></button></td><td>" + data[i].QcStatus + "</td><td>" + data[i].SubmissionNumber + "</td><td>" + data[i].FinalPolicyNumber + "</td><td>" + data[i].NewRenewal + "</td><td>" + data[i].InsuredName + "</td><td>" + data[i].DbNumber + "</td><td>" + data[i].InsuredCountry + "</td><td>" + data[i].InsuredState + "</td><td>" + data[i].InsuredCity + "</td><td>" + data[i].InsuredAddress1 + "</td><td>" + data[i].InsuredZipCode + "</td><td>" + data[i].ReinsuredCompany + "</td><td>" + data[i].DbaName + "</td><td>" + data[i].InsuredContactPersonName + "</td><td>" + data[i].InsuredContactPersonEmail + "</td><td>" + data[i].InsuredContactPersonPhoneNumbe + "</td><td>" + data[i].InsuredContactPersonMobileNumb + "</td><td>" + data[i].InsuredSubmissionDate + "</td><td>" + data[i].InsuredQuoteDueDate + "</td><td>" + data[i].UnderwriterName + "</td><td>" + data[i].ProductLine + "</td><td>" + data[i].ProductLineSubType + "</td><td>" + data[i].SectionCode + "</td><td>" + data[i].ProfitCode + "</td><td>" + data[i].Status + "</td><td>" + data[i].ReasonCode + "</td><td>" + data[i].EffectiveDate + "</td><td>" + data[i].ExpiryDate + "</td><td>" + data[i].BranchName + "</td><td>" + data[i].BrokerName + "</td><td>" + data[i].BrokerCountry + "</td><td>" + data[i].BrokerState + "</td><td>" + data[i].BrokerCity + "</td><td>" + data[i].BrokerCode + "</td><td>" + data[i].BrokerType + "</td><td>" + data[i].RetailBrokerName + "</td><td>" + data[i].RetailBrokerCountry + "</td><td>" + data[i].RetailBrokerState + "</td><td>" + data[i].RetailBrokerCity + "</td><td>" + data[i].BrokerContactPerson + "</td><td>" + data[i].BrokerContactPersonEmail + "</td><td>" + data[i].BrokerContactPersonNumber + "</td><td>" + data[i].BrokerContactPersonMobile + "</td><td>" + data[i].CabCompanies + "</td><td>" + data[i].PremiumInUSD + "</td><td>" + data[i].ExchangeDate + "</td><td>" + data[i].ExchangeRate + "</td><td>" + data[i].Currency + "</td><td>" + data[i].PremiumInLocalCurrency + "</td><td>" + data[i].LayerofLimitInUSD + "</td><td>" + data[i].LimitInLocalCurrency + "</td><td>" + data[i].AttachmentPointInUSD + "</td><td>" + data[i].AttachmentPointInLocalCurrency + "</td><td>" + data[i].PolicyCommPercentage + "</td><td>" + data[i].PolicyCommInUSD + "</td><td>" + data[i].PolicyCommInLocalCurrency + "</td><td>" + data[i].PremiumNetofCommInUSD + "</td><td>" + data[i].PremiumNetofCommInLocalCurrenc + "</td><td>" + data[i].LayerofLimitInUSD + "</td><td>" + data[i].LayerofLimitInLocalCurrency + "</td><td>" + data[i].PercentageofLayer + "</td><td>" + data[i].SelfInsuredRetentionInUSD + "</td><td>" + data[i].SelfInsuredRetentionInLocalCur + "</td><td>" + data[i].ProjectName + "</td><td>" + data[i].ProjectContractorName + "</td><td>" + data[i].ProjectOwnerName + "</td><td>" + data[i].ProjectCountry + "</td><td>" + data[i].ProjectState + "</td><td>" + data[i].ProjectCity + "</td><td>" + data[i].ProjectAddressLine1 + "</td><td>" + data[i].Bidsituation + "</td><td>" + data[i].TotalInsuredValueinLocalCurren + "</td><td>" + data[i].TotalInsuredValueInUSD + "</td><td>" + data[i].OccupancyCode + "</td><td>" + data[i].NumberOfLocations + "</td><td>" + data[i].RiskProfile + "</td><td>" + data[i].ProcessDate + "</td><td>" + data[i].BindDate + "</td><td>" + data[i].NAICTitle + "</td><td>" + data[i].NAICCode + "</td><td>" + data[i].SICTitle + "</td><td>" + data[i].SICCode + "</td><td>" + data[i].CompanyPaper + "</td><td>" + data[i].CompanyPaperNumber + "</td><td>" + data[i].Coverage + "</td><td>" + data[i].PolicyNumber + "</td><td>" + data[i].Suffix + "</td><td>" + data[i].Renewable + "</td><td>" + data[i].DateofRenewal + "</td><td>" + data[i].PolicyType + "</td><td>" + data[i].DirectAssumed + "</td><td>" + data[i].AdmittedNonAdmitted + "</td><td>" + data[i].OFRCAdverseReport + "</td><td>" + data[i].TransactionNumber + "</td><td>" + data[i].BerkSiDateFromIndia + "</td><td>" + data[i].BerkSIDateFromBroker + "</td></tr>";
                    } else if (data[i].QcStatus == 'Approved' && data[i].IsReversal == '1') {
                        listOption += "<tr class='amendment-child" + data[i].SubmissionId + "'><td><a class='btn btn-green btn-small' style = 'margin-right: 8px!important;' title='View' href='/submission/viewamendment?amendmentId=" + data[i].AmendmentId + "'><i class='fa fa-eye'></i></a></td><td>" + data[i].QcStatus + "</td><td>" + data[i].SubmissionNumber + "</td><td>" + data[i].FinalPolicyNumber + "</td><td>" + data[i].NewRenewal + "</td><td>" + data[i].InsuredName + "</td><td>" + data[i].DbNumber + "</td><td>" + data[i].InsuredCountry + "</td><td>" + data[i].InsuredState + "</td><td>" + data[i].InsuredCity + "</td><td>" + data[i].InsuredAddress1 + "</td><td>" + data[i].InsuredZipCode + "</td><td>" + data[i].ReinsuredCompany + "</td><td>" + data[i].DbaName + "</td><td>" + data[i].InsuredContactPersonName + "</td><td>" + data[i].InsuredContactPersonEmail + "</td><td>" + data[i].InsuredContactPersonPhoneNumbe + "</td><td>" + data[i].InsuredContactPersonMobileNumb + "</td><td>" + data[i].InsuredSubmissionDate + "</td><td>" + data[i].InsuredQuoteDueDate + "</td><td>" + data[i].UnderwriterName + "</td><td>" + data[i].ProductLine + "</td><td>" + data[i].ProductLineSubType + "</td><td>" + data[i].SectionCode + "</td><td>" + data[i].ProfitCode + "</td><td>" + data[i].Status + "</td><td>" + data[i].ReasonCode + "</td><td>" + data[i].EffectiveDate + "</td><td>" + data[i].ExpiryDate + "</td><td>" + data[i].BranchName + "</td><td>" + data[i].BrokerName + "</td><td>" + data[i].BrokerCountry + "</td><td>" + data[i].BrokerState + "</td><td>" + data[i].BrokerCity + "</td><td>" + data[i].BrokerCode + "</td><td>" + data[i].BrokerType + "</td><td>" + data[i].RetailBrokerName + "</td><td>" + data[i].RetailBrokerCountry + "</td><td>" + data[i].RetailBrokerState + "</td><td>" + data[i].RetailBrokerCity + "</td><td>" + data[i].BrokerContactPerson + "</td><td>" + data[i].BrokerContactPersonEmail + "</td><td>" + data[i].BrokerContactPersonNumber + "</td><td>" + data[i].BrokerContactPersonMobile + "</td><td>" + data[i].CabCompanies + "</td><td>" + data[i].PremiumInUSD + "</td><td>" + data[i].ExchangeDate + "</td><td>" + data[i].ExchangeRate + "</td><td>" + data[i].Currency + "</td><td>" + data[i].PremiumInLocalCurrency + "</td><td>" + data[i].LayerofLimitInUSD + "</td><td>" + data[i].LimitInLocalCurrency + "</td><td>" + data[i].AttachmentPointInUSD + "</td><td>" + data[i].AttachmentPointInLocalCurrency + "</td><td>" + data[i].PolicyCommPercentage + "</td><td>" + data[i].PolicyCommInUSD + "</td><td>" + data[i].PolicyCommInLocalCurrency + "</td><td>" + data[i].PremiumNetofCommInUSD + "</td><td>" + data[i].PremiumNetofCommInLocalCurrenc + "</td><td>" + data[i].LayerofLimitInUSD + "</td><td>" + data[i].LayerofLimitInLocalCurrency + "</td><td>" + data[i].PercentageofLayer + "</td><td>" + data[i].SelfInsuredRetentionInUSD + "</td><td>" + data[i].SelfInsuredRetentionInLocalCur + "</td><td>" + data[i].ProjectName + "</td><td>" + data[i].ProjectContractorName + "</td><td>" + data[i].ProjectOwnerName + "</td><td>" + data[i].ProjectCountry + "</td><td>" + data[i].ProjectState + "</td><td>" + data[i].ProjectCity + "</td><td>" + data[i].ProjectAddressLine1 + "</td><td>" + data[i].Bidsituation + "</td><td>" + data[i].TotalInsuredValueinLocalCurren + "</td><td>" + data[i].TotalInsuredValueInUSD + "</td><td>" + data[i].OccupancyCode + "</td><td>" + data[i].NumberOfLocations + "</td><td>" + data[i].RiskProfile + "</td><td>" + data[i].ProcessDate + "</td><td>" + data[i].BindDate + "</td><td>" + data[i].NAICTitle + "</td><td>" + data[i].NAICCode + "</td><td>" + data[i].SICTitle + "</td><td>" + data[i].SICCode + "</td><td>" + data[i].CompanyPaper + "</td><td>" + data[i].CompanyPaperNumber + "</td><td>" + data[i].Coverage + "</td><td>" + data[i].PolicyNumber + "</td><td>" + data[i].Suffix + "</td><td>" + data[i].Renewable + "</td><td>" + data[i].DateofRenewal + "</td><td>" + data[i].PolicyType + "</td><td>" + data[i].DirectAssumed + "</td><td>" + data[i].AdmittedNonAdmitted + "</td><td>" + data[i].OFRCAdverseReport + "</td><td>" + data[i].TransactionNumber + "</td><td>" + data[i].BerkSiDateFromIndia + "</td><td>" + data[i].BerkSIDateFromBroker + "</td></tr>";
                    } else {
                        if (data[i].ReversalChild == '1') {
                            listOption += "<tr class='amendment-child" + data[i].SubmissionId + "'><td><a class='btn btn-orange btn-small' title='Edit' style = 'margin-right: 8px!important;' href='/submission/editreversalchild?amendmentId=" + data[i].AmendmentId + "'><i class='fa fa-pencil'></i></a><a class='btn btn-green btn-small' style = 'margin-right: 8px!important;' title='View' href='/submission/viewamendment?amendmentId=" + data[i].AmendmentId + "'><i class='fa fa-eye'></i></a></td><td>" + data[i].QcStatus + "</td><td>" + data[i].SubmissionNumber + "</td><td>" + data[i].FinalPolicyNumber + "</td><td>" + data[i].NewRenewal + "</td><td>" + data[i].InsuredName + "</td><td>" + data[i].DbNumber + "</td><td>" + data[i].InsuredCountry + "</td><td>" + data[i].InsuredState + "</td><td>" + data[i].InsuredCity + "</td><td>" + data[i].InsuredAddress1 + "</td><td>" + data[i].InsuredZipCode + "</td><td>" + data[i].ReinsuredCompany + "</td><td>" + data[i].DbaName + "</td><td>" + data[i].InsuredContactPersonName + "</td><td>" + data[i].InsuredContactPersonEmail + "</td><td>" + data[i].InsuredContactPersonPhoneNumbe + "</td><td>" + data[i].InsuredContactPersonMobileNumb + "</td><td>" + data[i].InsuredSubmissionDate + "</td><td>" + data[i].InsuredQuoteDueDate + "</td><td>" + data[i].UnderwriterName + "</td><td>" + data[i].ProductLine + "</td><td>" + data[i].ProductLineSubType + "</td><td>" + data[i].SectionCode + "</td><td>" + data[i].ProfitCode + "</td><td>" + data[i].Status + "</td><td>" + data[i].ReasonCode + "</td><td>" + data[i].EffectiveDate + "</td><td>" + data[i].ExpiryDate + "</td><td>" + data[i].BranchName + "</td><td>" + data[i].BrokerName + "</td><td>" + data[i].BrokerCountry + "</td><td>" + data[i].BrokerState + "</td><td>" + data[i].BrokerCity + "</td><td>" + data[i].BrokerCode + "</td><td>" + data[i].BrokerType + "</td><td>" + data[i].RetailBrokerName + "</td><td>" + data[i].RetailBrokerCountry + "</td><td>" + data[i].RetailBrokerState + "</td><td>" + data[i].RetailBrokerCity + "</td><td>" + data[i].BrokerContactPerson + "</td><td>" + data[i].BrokerContactPersonEmail + "</td><td>" + data[i].BrokerContactPersonNumber + "</td><td>" + data[i].BrokerContactPersonMobile + "</td><td>" + data[i].CabCompanies + "</td><td>" + data[i].PremiumInUSD + "</td><td>" + data[i].ExchangeDate + "</td><td>" + data[i].ExchangeRate + "</td><td>" + data[i].Currency + "</td><td>" + data[i].PremiumInLocalCurrency + "</td><td>" + data[i].LayerofLimitInUSD + "</td><td>" + data[i].LimitInLocalCurrency + "</td><td>" + data[i].AttachmentPointInUSD + "</td><td>" + data[i].AttachmentPointInLocalCurrency + "</td><td>" + data[i].PolicyCommPercentage + "</td><td>" + data[i].PolicyCommInUSD + "</td><td>" + data[i].PolicyCommInLocalCurrency + "</td><td>" + data[i].PremiumNetofCommInUSD + "</td><td>" + data[i].PremiumNetofCommInLocalCurrenc + "</td><td>" + data[i].LayerofLimitInUSD + "</td><td>" + data[i].LayerofLimitInLocalCurrency + "</td><td>" + data[i].PercentageofLayer + "</td><td>" + data[i].SelfInsuredRetentionInUSD + "</td><td>" + data[i].SelfInsuredRetentionInLocalCur + "</td><td>" + data[i].ProjectName + "</td><td>" + data[i].ProjectContractorName + "</td><td>" + data[i].ProjectOwnerName + "</td><td>" + data[i].ProjectCountry + "</td><td>" + data[i].ProjectState + "</td><td>" + data[i].ProjectCity + "</td><td>" + data[i].ProjectAddressLine1 + "</td><td>" + data[i].Bidsituation + "</td><td>" + data[i].TotalInsuredValueinLocalCurren + "</td><td>" + data[i].TotalInsuredValueInUSD + "</td><td>" + data[i].OccupancyCode + "</td><td>" + data[i].NumberOfLocations + "</td><td>" + data[i].RiskProfile + "</td><td>" + data[i].ProcessDate + "</td><td>" + data[i].BindDate + "</td><td>" + data[i].NAICTitle + "</td><td>" + data[i].NAICCode + "</td><td>" + data[i].SICTitle + "</td><td>" + data[i].SICCode + "</td><td>" + data[i].CompanyPaper + "</td><td>" + data[i].CompanyPaperNumber + "</td><td>" + data[i].Coverage + "</td><td>" + data[i].PolicyNumber + "</td><td>" + data[i].Suffix + "</td><td>" + data[i].Renewable + "</td><td>" + data[i].DateofRenewal + "</td><td>" + data[i].PolicyType + "</td><td>" + data[i].DirectAssumed + "</td><td>" + data[i].AdmittedNonAdmitted + "</td><td>" + data[i].OFRCAdverseReport + "</td><td>" + data[i].TransactionNumber + "</td><td>" + data[i].BerkSiDateFromIndia + "</td><td>" + data[i].BerkSIDateFromBroker + "</td></tr>";
                        } else {
                            listOption += "<tr class='amendment-child" + data[i].SubmissionId + "'><td><a class='btn btn-orange btn-small' title='Edit' style = 'margin-right: 8px!important;' href='/submission/editamendment?amendmentId=" + data[i].AmendmentId + "'><i class='fa fa-pencil'></i></a><a class='btn btn-green btn-small' style = 'margin-right: 8px!important;' title='View' href='/submission/viewamendment?amendmentId=" + data[i].AmendmentId + "'><i class='fa fa-eye'></i></a></td><td>" + data[i].QcStatus + "</td><td>" + data[i].SubmissionNumber + "</td><td>" + data[i].FinalPolicyNumber + "</td><td>" + data[i].NewRenewal + "</td><td>" + data[i].InsuredName + "</td><td>" + data[i].DbNumber + "</td><td>" + data[i].InsuredCountry + "</td><td>" + data[i].InsuredState + "</td><td>" + data[i].InsuredCity + "</td><td>" + data[i].InsuredAddress1 + "</td><td>" + data[i].InsuredZipCode + "</td><td>" + data[i].ReinsuredCompany + "</td><td>" + data[i].DbaName + "</td><td>" + data[i].InsuredContactPersonName + "</td><td>" + data[i].InsuredContactPersonEmail + "</td><td>" + data[i].InsuredContactPersonPhoneNumbe + "</td><td>" + data[i].InsuredContactPersonMobileNumb + "</td><td>" + data[i].InsuredSubmissionDate + "</td><td>" + data[i].InsuredQuoteDueDate + "</td><td>" + data[i].UnderwriterName + "</td><td>" + data[i].ProductLine + "</td><td>" + data[i].ProductLineSubType + "</td><td>" + data[i].SectionCode + "</td><td>" + data[i].ProfitCode + "</td><td>" + data[i].Status + "</td><td>" + data[i].ReasonCode + "</td><td>" + data[i].EffectiveDate + "</td><td>" + data[i].ExpiryDate + "</td><td>" + data[i].BranchName + "</td><td>" + data[i].BrokerName + "</td><td>" + data[i].BrokerCountry + "</td><td>" + data[i].BrokerState + "</td><td>" + data[i].BrokerCity + "</td><td>" + data[i].BrokerCode + "</td><td>" + data[i].BrokerType + "</td><td>" + data[i].RetailBrokerName + "</td><td>" + data[i].RetailBrokerCountry + "</td><td>" + data[i].RetailBrokerState + "</td><td>" + data[i].RetailBrokerCity + "</td><td>" + data[i].BrokerContactPerson + "</td><td>" + data[i].BrokerContactPersonEmail + "</td><td>" + data[i].BrokerContactPersonNumber + "</td><td>" + data[i].BrokerContactPersonMobile + "</td><td>" + data[i].CabCompanies + "</td><td>" + data[i].PremiumInUSD + "</td><td>" + data[i].ExchangeDate + "</td><td>" + data[i].ExchangeRate + "</td><td>" + data[i].Currency + "</td><td>" + data[i].PremiumInLocalCurrency + "</td><td>" + data[i].LayerofLimitInUSD + "</td><td>" + data[i].LimitInLocalCurrency + "</td><td>" + data[i].AttachmentPointInUSD + "</td><td>" + data[i].AttachmentPointInLocalCurrency + "</td><td>" + data[i].PolicyCommPercentage + "</td><td>" + data[i].PolicyCommInUSD + "</td><td>" + data[i].PolicyCommInLocalCurrency + "</td><td>" + data[i].PremiumNetofCommInUSD + "</td><td>" + data[i].PremiumNetofCommInLocalCurrenc + "</td><td>" + data[i].LayerofLimitInUSD + "</td><td>" + data[i].LayerofLimitInLocalCurrency + "</td><td>" + data[i].PercentageofLayer + "</td><td>" + data[i].SelfInsuredRetentionInUSD + "</td><td>" + data[i].SelfInsuredRetentionInLocalCur + "</td><td>" + data[i].ProjectName + "</td><td>" + data[i].ProjectContractorName + "</td><td>" + data[i].ProjectOwnerName + "</td><td>" + data[i].ProjectCountry + "</td><td>" + data[i].ProjectState + "</td><td>" + data[i].ProjectCity + "</td><td>" + data[i].ProjectAddressLine1 + "</td><td>" + data[i].Bidsituation + "</td><td>" + data[i].TotalInsuredValueinLocalCurren + "</td><td>" + data[i].TotalInsuredValueInUSD + "</td><td>" + data[i].OccupancyCode + "</td><td>" + data[i].NumberOfLocations + "</td><td>" + data[i].RiskProfile + "</td><td>" + data[i].ProcessDate + "</td><td>" + data[i].BindDate + "</td><td>" + data[i].NAICTitle + "</td><td>" + data[i].NAICCode + "</td><td>" + data[i].SICTitle + "</td><td>" + data[i].SICCode + "</td><td>" + data[i].CompanyPaper + "</td><td>" + data[i].CompanyPaperNumber + "</td><td>" + data[i].Coverage + "</td><td>" + data[i].PolicyNumber + "</td><td>" + data[i].Suffix + "</td><td>" + data[i].Renewable + "</td><td>" + data[i].DateofRenewal + "</td><td>" + data[i].PolicyType + "</td><td>" + data[i].DirectAssumed + "</td><td>" + data[i].AdmittedNonAdmitted + "</td><td>" + data[i].OFRCAdverseReport + "</td><td>" + data[i].TransactionNumber + "</td><td>" + data[i].BerkSiDateFromIndia + "</td><td>" + data[i].BerkSIDateFromBroker + "</td></tr>";
                        }
                    }
                } else {
                    listOption += "<tr class='amendment-child" + data[i].SubmissionId + "'><td><a class='btn btn-green btn-small' style = 'margin-right: 8px!important;' title='View' href='/submission/viewamendment?amendmentId=" + data[i].AmendmentId + "'><i class='fa fa-eye'></i></a></td><td>" + data[i].QcStatus + "</td><td>" + data[i].SubmissionNumber + "</td><td>" + data[i].FinalPolicyNumber + "</td><td>" + data[i].NewRenewal + "</td><td>" + data[i].InsuredName + "</td><td>" + data[i].DbNumber + "</td><td>" + data[i].InsuredCountry + "</td><td>" + data[i].InsuredState + "</td><td>" + data[i].InsuredCity + "</td><td>" + data[i].InsuredAddress1 + "</td><td>" + data[i].InsuredZipCode + "</td><td>" + data[i].ReinsuredCompany + "</td><td>" + data[i].DbaName + "</td><td>" + data[i].InsuredContactPersonName + "</td><td>" + data[i].InsuredContactPersonEmail + "</td><td>" + data[i].InsuredContactPersonPhoneNumbe + "</td><td>" + data[i].InsuredContactPersonMobileNumb + "</td><td>" + data[i].InsuredSubmissionDate + "</td><td>" + data[i].InsuredQuoteDueDate + "</td><td>" + data[i].UnderwriterName + "</td><td>" + data[i].ProductLine + "</td><td>" + data[i].ProductLineSubType + "</td><td>" + data[i].SectionCode + "</td><td>" + data[i].ProfitCode + "</td><td>" + data[i].Status + "</td><td>" + data[i].ReasonCode + "</td><td>" + data[i].EffectiveDate + "</td><td>" + data[i].ExpiryDate + "</td><td>" + data[i].BranchName + "</td><td>" + data[i].BrokerName + "</td><td>" + data[i].BrokerCountry + "</td><td>" + data[i].BrokerState + "</td><td>" + data[i].BrokerCity + "</td><td>" + data[i].BrokerCode + "</td><td>" + data[i].BrokerType + "</td><td>" + data[i].RetailBrokerName + "</td><td>" + data[i].RetailBrokerCountry + "</td><td>" + data[i].RetailBrokerState + "</td><td>" + data[i].RetailBrokerCity + "</td><td>" + data[i].BrokerContactPerson + "</td><td>" + data[i].BrokerContactPersonEmail + "</td><td>" + data[i].BrokerContactPersonNumber + "</td><td>" + data[i].BrokerContactPersonMobile + "</td><td>" + data[i].CabCompanies + "</td><td>" + data[i].PremiumInUSD + "</td><td>" + data[i].ExchangeDate + "</td><td>" + data[i].ExchangeRate + "</td><td>" + data[i].Currency + "</td><td>" + data[i].PremiumInLocalCurrency + "</td><td>" + data[i].LayerofLimitInUSD + "</td><td>" + data[i].LimitInLocalCurrency + "</td><td>" + data[i].AttachmentPointInUSD + "</td><td>" + data[i].AttachmentPointInLocalCurrency + "</td><td>" + data[i].PolicyCommPercentage + "</td><td>" + data[i].PolicyCommInUSD + "</td><td>" + data[i].PolicyCommInLocalCurrency + "</td><td>" + data[i].PremiumNetofCommInUSD + "</td><td>" + data[i].PremiumNetofCommInLocalCurrenc + "</td><td>" + data[i].LayerofLimitInUSD + "</td><td>" + data[i].LayerofLimitInLocalCurrency + "</td><td>" + data[i].PercentageofLayer + "</td><td>" + data[i].SelfInsuredRetentionInUSD + "</td><td>" + data[i].SelfInsuredRetentionInLocalCur + "</td><td>" + data[i].ProjectName + "</td><td>" + data[i].ProjectContractorName + "</td><td>" + data[i].ProjectOwnerName + "</td><td>" + data[i].ProjectCountry + "</td><td>" + data[i].ProjectState + "</td><td>" + data[i].ProjectCity + "</td><td>" + data[i].ProjectAddressLine1 + "</td><td>" + data[i].Bidsituation + "</td><td>" + data[i].TotalInsuredValueinLocalCurren + "</td><td>" + data[i].TotalInsuredValueInUSD + "</td><td>" + data[i].OccupancyCode + "</td><td>" + data[i].NumberOfLocations + "</td><td>" + data[i].RiskProfile + "</td><td>" + data[i].ProcessDate + "</td><td>" + data[i].BindDate + "</td><td>" + data[i].NAICTitle + "</td><td>" + data[i].NAICCode + "</td><td>" + data[i].SICTitle + "</td><td>" + data[i].SICCode + "</td><td>" + data[i].CompanyPaper + "</td><td>" + data[i].CompanyPaperNumber + "</td><td>" + data[i].Coverage + "</td><td>" + data[i].PolicyNumber + "</td><td>" + data[i].Suffix + "</td><td>" + data[i].Renewable + "</td><td>" + data[i].DateofRenewal + "</td><td>" + data[i].PolicyType + "</td><td>" + data[i].DirectAssumed + "</td><td>" + data[i].AdmittedNonAdmitted + "</td><td>" + data[i].OFRCAdverseReport + "</td><td>" + data[i].TransactionNumber + "</td><td>" + data[i].BerkSiDateFromIndia + "</td><td>" + data[i].BerkSIDateFromBroker + "</td></tr>";
                }
            } else {
                if (data[i].QcStatus == 'Approved') {
                    listOption += "<tr class='amendment-child" + data[i].SubmissionId + "'><td><a class='btn btn-orange btn-small' title='Edit' style = 'margin-right: 8px!important;' href='/submission/editamendment?amendmentId=" + data[i].AmendmentId + "'><i class='fa fa-pencil'></i></a><a class='btn btn-green btn-small' style = 'margin-right: 8px!important;' title='View' href='/submission/viewamendment?amendmentId=" + data[i].AmendmentId + "'><i class='fa fa-eye'></i></a></td><td>" + data[i].QcStatus + "</td><td>" + data[i].SubmissionNumber + "</td><td>" + data[i].FinalPolicyNumber + "</td><td>" + data[i].NewRenewal + "</td><td>" + data[i].InsuredName + "</td><td>" + data[i].DbNumber + "</td><td>" + data[i].InsuredCountry + "</td><td>" + data[i].InsuredState + "</td><td>" + data[i].InsuredCity + "</td><td>" + data[i].InsuredAddress1 + "</td><td>" + data[i].InsuredZipCode + "</td><td>" + data[i].ReinsuredCompany + "</td><td>" + data[i].DbaName + "</td><td>" + data[i].InsuredContactPersonName + "</td><td>" + data[i].InsuredContactPersonEmail + "</td><td>" + data[i].InsuredContactPersonPhoneNumbe + "</td><td>" + data[i].InsuredContactPersonMobileNumb + "</td><td>" + data[i].InsuredSubmissionDate + "</td><td>" + data[i].InsuredQuoteDueDate + "</td><td>" + data[i].UnderwriterName + "</td><td>" + data[i].ProductLine + "</td><td>" + data[i].ProductLineSubType + "</td><td>" + data[i].SectionCode + "</td><td>" + data[i].ProfitCode + "</td><td>" + data[i].Status + "</td><td>" + data[i].ReasonCode + "</td><td>" + data[i].EffectiveDate + "</td><td>" + data[i].ExpiryDate + "</td><td>" + data[i].BranchName + "</td><td>" + data[i].BrokerName + "</td><td>" + data[i].BrokerCountry + "</td><td>" + data[i].BrokerState + "</td><td>" + data[i].BrokerCity + "</td><td>" + data[i].BrokerCode + "</td><td>" + data[i].BrokerType + "</td><td>" + data[i].RetailBrokerName + "</td><td>" + data[i].RetailBrokerCountry + "</td><td>" + data[i].RetailBrokerState + "</td><td>" + data[i].RetailBrokerCity + "</td><td>" + data[i].BrokerContactPerson + "</td><td>" + data[i].BrokerContactPersonEmail + "</td><td>" + data[i].BrokerContactPersonNumber + "</td><td>" + data[i].BrokerContactPersonMobile + "</td><td>" + data[i].CabCompanies + "</td><td>" + data[i].PremiumInUSD + "</td><td>" + data[i].ExchangeDate + "</td><td>" + data[i].ExchangeRate + "</td><td>" + data[i].Currency + "</td><td>" + data[i].PremiumInLocalCurrency + "</td><td>" + data[i].LayerofLimitInUSD + "</td><td>" + data[i].LimitInLocalCurrency + "</td><td>" + data[i].AttachmentPointInUSD + "</td><td>" + data[i].AttachmentPointInLocalCurrency + "</td><td>" + data[i].PolicyCommPercentage + "</td><td>" + data[i].PolicyCommInUSD + "</td><td>" + data[i].PolicyCommInLocalCurrency + "</td><td>" + data[i].PremiumNetofCommInUSD + "</td><td>" + data[i].PremiumNetofCommInLocalCurrenc + "</td><td>" + data[i].LayerofLimitInUSD + "</td><td>" + data[i].LayerofLimitInLocalCurrency + "</td><td>" + data[i].PercentageofLayer + "</td><td>" + data[i].SelfInsuredRetentionInUSD + "</td><td>" + data[i].SelfInsuredRetentionInLocalCur + "</td><td>" + data[i].ProjectName + "</td><td>" + data[i].ProjectContractorName + "</td><td>" + data[i].ProjectOwnerName + "</td><td>" + data[i].ProjectCountry + "</td><td>" + data[i].ProjectState + "</td><td>" + data[i].ProjectCity + "</td><td>" + data[i].ProjectAddressLine1 + "</td><td>" + data[i].Bidsituation + "</td><td>" + data[i].TotalInsuredValueinLocalCurren + "</td><td>" + data[i].TotalInsuredValueInUSD + "</td><td>" + data[i].OccupancyCode + "</td><td>" + data[i].NumberOfLocations + "</td><td>" + data[i].RiskProfile + "</td><td>" + data[i].ProcessDate + "</td><td>" + data[i].BindDate + "</td><td>" + data[i].NAICTitle + "</td><td>" + data[i].NAICCode + "</td><td>" + data[i].SICTitle + "</td><td>" + data[i].SICCode + "</td><td>" + data[i].CompanyPaper + "</td><td>" + data[i].CompanyPaperNumber + "</td><td>" + data[i].Coverage + "</td><td>" + data[i].PolicyNumber + "</td><td>" + data[i].Suffix + "</td><td>" + data[i].Renewable + "</td><td>" + data[i].DateofRenewal + "</td><td>" + data[i].PolicyType + "</td><td>" + data[i].DirectAssumed + "</td><td>" + data[i].AdmittedNonAdmitted + "</td><td>" + data[i].OFRCAdverseReport + "</td><td>" + data[i].TransactionNumber + "</td><td>" + data[i].BerkSiDateFromIndia + "</td><td>" + data[i].BerkSIDateFromBroker + "</td></tr>";
                } else {
                    listOption += "<tr class='amendment-child" + data[i].SubmissionId + "'><td><a class='btn btn-orange btn-small' title='Edit' style = 'margin-right: 8px!important;' href='/submission/editamendment?amendmentId=" + data[i].AmendmentId + "'><i class='fa fa-pencil'></i></a><a class='btn btn-green btn-small' style = 'margin-right: 8px!important;' title='View' href='/submission/viewamendment?amendmentId=" + data[i].AmendmentId + "'><i class='fa fa-eye'></i></a></td><td>" + data[i].QcStatus + "</td><td>" + data[i].SubmissionNumber + "</td><td>" + data[i].FinalPolicyNumber + "</td><td>" + data[i].NewRenewal + "</td><td>" + data[i].InsuredName + "</td><td>" + data[i].DbNumber + "</td><td>" + data[i].InsuredCountry + "</td><td>" + data[i].InsuredState + "</td><td>" + data[i].InsuredCity + "</td><td>" + data[i].InsuredAddress1 + "</td><td>" + data[i].InsuredZipCode + "</td><td>" + data[i].ReinsuredCompany + "</td><td>" + data[i].DbaName + "</td><td>" + data[i].InsuredContactPersonName + "</td><td>" + data[i].InsuredContactPersonEmail + "</td><td>" + data[i].InsuredContactPersonPhoneNumbe + "</td><td>" + data[i].InsuredContactPersonMobileNumb + "</td><td>" + data[i].InsuredSubmissionDate + "</td><td>" + data[i].InsuredQuoteDueDate + "</td><td>" + data[i].UnderwriterName + "</td><td>" + data[i].ProductLine + "</td><td>" + data[i].ProductLineSubType + "</td><td>" + data[i].SectionCode + "</td><td>" + data[i].ProfitCode + "</td><td>" + data[i].Status + "</td><td>" + data[i].ReasonCode + "</td><td>" + data[i].EffectiveDate + "</td><td>" + data[i].ExpiryDate + "</td><td>" + data[i].BranchName + "</td><td>" + data[i].BrokerName + "</td><td>" + data[i].BrokerCountry + "</td><td>" + data[i].BrokerState + "</td><td>" + data[i].BrokerCity + "</td><td>" + data[i].BrokerCode + "</td><td>" + data[i].BrokerType + "</td><td>" + data[i].RetailBrokerName + "</td><td>" + data[i].RetailBrokerCountry + "</td><td>" + data[i].RetailBrokerState + "</td><td>" + data[i].RetailBrokerCity + "</td><td>" + data[i].BrokerContactPerson + "</td><td>" + data[i].BrokerContactPersonEmail + "</td><td>" + data[i].BrokerContactPersonNumber + "</td><td>" + data[i].BrokerContactPersonMobile + "</td><td>" + data[i].CabCompanies + "</td><td>" + data[i].PremiumInUSD + "</td><td>" + data[i].ExchangeDate + "</td><td>" + data[i].ExchangeRate + "</td><td>" + data[i].Currency + "</td><td>" + data[i].PremiumInLocalCurrency + "</td><td>" + data[i].LayerofLimitInUSD + "</td><td>" + data[i].LimitInLocalCurrency + "</td><td>" + data[i].AttachmentPointInUSD + "</td><td>" + data[i].AttachmentPointInLocalCurrency + "</td><td>" + data[i].PolicyCommPercentage + "</td><td>" + data[i].PolicyCommInUSD + "</td><td>" + data[i].PolicyCommInLocalCurrency + "</td><td>" + data[i].PremiumNetofCommInUSD + "</td><td>" + data[i].PremiumNetofCommInLocalCurrenc + "</td><td>" + data[i].LayerofLimitInUSD + "</td><td>" + data[i].LayerofLimitInLocalCurrency + "</td><td>" + data[i].PercentageofLayer + "</td><td>" + data[i].SelfInsuredRetentionInUSD + "</td><td>" + data[i].SelfInsuredRetentionInLocalCur + "</td><td>" + data[i].ProjectName + "</td><td>" + data[i].ProjectContractorName + "</td><td>" + data[i].ProjectOwnerName + "</td><td>" + data[i].ProjectCountry + "</td><td>" + data[i].ProjectState + "</td><td>" + data[i].ProjectCity + "</td><td>" + data[i].ProjectAddressLine1 + "</td><td>" + data[i].Bidsituation + "</td><td>" + data[i].TotalInsuredValueinLocalCurren + "</td><td>" + data[i].TotalInsuredValueInUSD + "</td><td>" + data[i].OccupancyCode + "</td><td>" + data[i].NumberOfLocations + "</td><td>" + data[i].RiskProfile + "</td><td>" + data[i].ProcessDate + "</td><td>" + data[i].BindDate + "</td><td>" + data[i].NAICTitle + "</td><td>" + data[i].NAICCode + "</td><td>" + data[i].SICTitle + "</td><td>" + data[i].SICCode + "</td><td>" + data[i].CompanyPaper + "</td><td>" + data[i].CompanyPaperNumber + "</td><td>" + data[i].Coverage + "</td><td>" + data[i].PolicyNumber + "</td><td>" + data[i].Suffix + "</td><td>" + data[i].Renewable + "</td><td>" + data[i].DateofRenewal + "</td><td>" + data[i].PolicyType + "</td><td>" + data[i].DirectAssumed + "</td><td>" + data[i].AdmittedNonAdmitted + "</td><td>" + data[i].OFRCAdverseReport + "</td><td>" + data[i].TransactionNumber + "</td><td>" + data[i].BerkSiDateFromIndia + "</td><td>" + data[i].BerkSIDateFromBroker + "</td></tr>";
                }
            }
        }
        return listOption;
    };

    $('.dataTable').on('click', '.reversal', function () {
        var id = $(this).attr('id');
        if (id) {
            var dataObj = {
                'header': {
                    'requestName': 'AmendmentReversal'
                },
                'body': {
                    'data': id
                }
            };
            $.ajax('/submission/AmendmentReversal', {
                'dataType': 'json',
                'data': JSON.stringify(dataObj),
                'type': 'post',
                'success': function (data, status, xhr) {
                    if (status == 'success') {
                        swal({
                            title: "Created!",
                            text: "Reversal Entry has been created.",
                            timer: 2000
                        });
                        window.location.href = '/submission/List';
                    }
                }
            });
        } else {
            return false;
        }
    });

    $('[class*="editDisable"]').click(function () {
        swal({
            title: "Sorry!",
            text: "You don't have Bound Edit Right.",
            timer: 2000
        });
    });
    
    $('[class*="amendmentDisable"]').click(function () {
        swal({
            title: "Sorry!",
            text: "You don't have Amendment Right.",
            timer: 2000
        });
    });

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
    //$('#submission-list-wrapper').jScrollPane();
});
