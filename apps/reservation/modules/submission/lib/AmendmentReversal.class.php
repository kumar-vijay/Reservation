<?php

class AmendmentReversal {

    public function __construct() {
        $this->connection = Propel::getConnection();
    }

    public function FetchAmendmentDetails($amendmentId, $userId, $flag) {
        $this->UpdateReversalSubmission($amendmentId);
        $connection = $this->connection;
        $amendmentstatusquery = "Select SA.Id As SubmissionAmendmentId,SA.SubmissionId,SA.SubmissionNumber,SA.NonFinancialAmendmentId,SA.FinancialAmendmentId,SA.QCStatus,SA.Remarks,SA.DataRecorderMetaDataId,
                                    AF.PremiunType,AF.IsPremium,AF.PremiumInLocalCurrency,AF.PremiumInUSD,AF.LayerofLimitInLocalCurrency,AF.LayerofLimitInUSD,AF.PercentageofLayer,AF.IsLimit,AF.LimitInLocalCurrency,AF.LimitInUSD,AF.IsAttachmentPoint,AF.AttachmentPointInLocalCurrency,AF.AttachmentPointInUSD,AF.SelfInsuredRetentionInLocalCurrency,AF.SelfInsuredRetentionInUSD,AF.PolicyCommPercentage,AF.PolicyCommInLocalCurrency,AF.PolicyCommInUSD,AF.PremiumNetofCommInLocalCurrency,AF.PremiumNetofCommInUSD,
                                    AN.AmendmentBusinessDependentDetailsId,AN.AmendmentBrokerDetailsId,AN.AmendmentPolicyDetailsId,AN.IsDuckSubmissionNumber,AN.DuckSubmissionNumber,AN.NewRenewalLookupId,AN.UnderwriterId,AN.LobId,AN.LobSubTypeId,AN.SectionId,AN.ProfitCodeId,AN.CurrentStatusId,AN.EffectiveDate,AN.ExpiryDate,AN.CurrencyTypeId,AN.ExchangeRate,AN.ExchangeDate,AN.InsuredId,AN.IsDifferentDba,AN.DbaName,AN.CABCompaniesLookupId,AN.ReinsuredCompany,AN.SubmissionIdentifier,AN.InsuredContactPersonId,AN.InsuredSubmissionDate,AN.InsuredQuoteDueDate,AN.IsTotalInsuredValue,AN.TotalInsuredValue,AN.TotalInsuredValueInUSD,AN.RiskProfile,AN.NumberOfLocationsId,AN.OccupancyCodeId,AN.ReasonCodeId,AN.ProcessDate,AN.IsBerksiBroker,AN.BerkSIDateFromBroker,AN.IsBerksiIndia,AN.BerkSiDateFromIndia,AN.BranchId,
                                    AB.ProjectName, AB.ProjectGeneralContractorName, AB.ProjectOwnerName, AB.ProjectAddress, AB.ProjectCity, AB.ProjectState, AB.ProjectCountry, AB.BidSituationId,
                                    AP.IsBindDate, AP.BindDate, AP.RenewableLookupId, AP.DateofRenewal, AP.PolicyTypeLookupId, AP.DirectAssumedLookupId, AP.AdimittedNonAdmittedLookupId, AP.CompanyPaperLookupId, AP.CompanyPaperNumberLookupId, AP.PolicyNumber, AP.CoverageId, AP.SuffixLookupId, AP.TransactionNumber, AP.NAICCode, AP.NAICTitle, AP.SICCode, AP.SICTitle, AP.OFRCAdverseReportLookupId, AP.FinalPolicyNumber,
                                    AP.ClassNameLookupId, AP.ClassCode, AP.ClassDescription,
                                    AR.RetailBrokerName, AR.RetailBrokerCountry, AR.RetailBrokerState, AR.RetailBrokerCity,
                                    ABD.AmendmentRetailBrokerDetailsId,ABD.BrokerId, ABD.BrokerWiceCityId, ABD.BrokerContactPersonId, ABD.BrokerCode, ABD.AmendmentRetailBrokerDetailsId 
                                    from dbo.SubmissionAmendment AS SA 
                                    Left Join AmendmentFinancial AS AF on AF.Id = SA.FinancialAmendmentId
                                    Left Join AmendmentNonFinancial AS AN on AN.Id = SA.NonFinancialAmendmentId
                                    Left Join AmendmentBusinessDependentDetails AS AB on AB.Id = AN.AmendmentBusinessDependentDetailsId
                                    Left Join AmendmentPolicyDetails AS AP on AP.Id = AN.AmendmentPolicyDetailsId
                                    Left Join AmendmentBrokerDetails AS ABD on ABD.Id = An.AmendmentBrokerDetailsId
                                    Left Join AmendmentRetailBrokerDetails AS AR on AR.Id = ABD.AmendmentRetailBrokerDetailsId
                                    Where SA.Id = '" . $amendmentId . "'";
        $amendmentstatusStatement = $connection->prepare($amendmentstatusquery);
        $amendmentstatusStatement->execute();
        $amendmentStatusData = $amendmentstatusStatement->fetchAll(PDO::FETCH_ASSOC);

        if (trim($amendmentStatusData[0]['PremiunType']) == 'AP') {
            $amendmentStatusData[0]['PremiunType'] = 'RP';
            if ($amendmentStatusData[0]['IsPremium'] != 1) {
                $amendmentStatusData[0]['PremiumInLocalCurrency'] = -$amendmentStatusData[0]['PremiumInLocalCurrency'];
            } else {
                $amendmentStatusData[0]['PremiumInLocalCurrency'] = $amendmentStatusData[0]['PremiumInLocalCurrency'];
            }
            $amendmentStatusData[0]['PremiumInUSD'] = str_replace("$", "-$", $amendmentStatusData[0]['PremiumInUSD']);
            $amendmentStatusData[0]['PolicyCommInLocalCurrency'] = -$amendmentStatusData[0]['PolicyCommInLocalCurrency'];
            $amendmentStatusData[0]['PolicyCommInUSD'] = str_replace("$", "-$", $amendmentStatusData[0]['PolicyCommInUSD']);
            $amendmentStatusData[0]['PremiumNetofCommInLocalCurrency'] = -1 * ($amendmentStatusData[0]['PremiumNetofCommInLocalCurrenc']);
            $amendmentStatusData[0]['PremiumNetofCommInUSD'] = str_replace("$", "-$", $amendmentStatusData[0]['PremiumNetofCommInUSD']);
        } else if (trim($amendmentStatusData[0]['PremiunType']) == 'RP') {
            $amendmentStatusData[0]['PremiunType'] = 'AP';
            if ($amendmentStatusData[0]['IsPremium'] != 1) {
                $amendmentStatusData[0]['PremiumInLocalCurrency'] = abs($amendmentStatusData[0]['PremiumInLocalCurrency']);
            } else {
                $amendmentStatusData[0]['PremiumInLocalCurrency'] = $amendmentStatusData[0]['PremiumInLocalCurrency'];
            }
            $amendmentStatusData[0]['PremiumInUSD'] = str_replace("-$", "$", $amendmentStatusData[0]['PremiumInUSD']);
            $amendmentStatusData[0]['PolicyCommInLocalCurrency'] = abs($amendmentStatusData[0]['PolicyCommInLocalCurrency']);
            $amendmentStatusData[0]['PolicyCommInUSD'] = str_replace("-$", "$", $amendmentStatusData[0]['PolicyCommInUSD']);
            $amendmentStatusData[0]['PremiumNetofCommInLocalCurrency'] = abs($amendmentStatusData[0]['PremiumNetofCommInLocalCurrenc']);
            $amendmentStatusData[0]['PremiumNetofCommInUSD'] = str_replace("-$", "$", $amendmentStatusData[0]['PremiumNetofCommInUSD']);
        }

        $finalArray = array();
        $finalArray['submissionNumber'] = $amendmentStatusData[0]['SubmissionNumber'];
        $finalArray['submissionId'] = $amendmentStatusData[0]['SubmissionId'];
        $finalArray['premiumType'] = $amendmentStatusData[0]['PremiunType'];
        $finalArray['isPremium'] = ($amendmentStatusData[0]['IsPremium'] == 1) ? 'Y' : 'N';
        $finalArray['gross_premium_text'] = $amendmentStatusData[0]['PremiumInLocalCurrency'];
        $finalArray['editlocalCurrency'] = $amendmentStatusData[0]['PremiumInUSD'];
        $finalArray['editLayerLimitLocalCurrency'] = $amendmentStatusData[0]['LayerofLimitInLocalCurrency'];
        $finalArray['editLayerLimitLocalUSD'] = $amendmentStatusData[0]['LayerofLimitInUSD'];
        $finalArray['editPrecentageLayer'] = $amendmentStatusData[0]['PercentageofLayer'];
        $finalArray['yesLimit'] = ($amendmentStatusData[0]['IsLimit'] == 1) ? 'Y' : 'N';
        if ($finalArray['yesLimit'] == 1) {
            $finalArray['limit_select'] = $amendmentStatusData[0]['LimitInLocalCurrency'];
        } else {
            $finalArray['limit_text'] = $amendmentStatusData[0]['LimitInLocalCurrency'];
        }
        $finalArray['editlimitlocalcurrency'] = $amendmentStatusData[0]['LimitInUSD'];
        $finalArray['yesAttachment'] = ($amendmentStatusData[0]['IsAttachmentPoint'] == '1') ? 'Y' : 'N';
        $finalArray['attachment_point_select'] = $amendmentStatusData[0]['AttachmentPointInLocalCurrency'];
        $finalArray['attachment_point_text'] = $amendmentStatusData[0]['AttachmentPointInLocalCurrency'];
        $finalArray['editattachmentlocalcurrency'] = $amendmentStatusData[0]['AttachmentPointInUSD'];
        $finalArray['editselfRetrntionLocalCurrency'] = $amendmentStatusData[0]['SelfInsuredRetentionInLocalCur'];
        $finalArray['editselfRetrntionUSD'] = $amendmentStatusData[0]['SelfInsuredRetentionInUSD'];
        $finalArray['editpolicyCommision'] = $amendmentStatusData[0]['PolicyCommPercentage'];
        $finalArray['editpolicyCommisionLocalCurrrency'] = $amendmentStatusData[0]['PolicyCommInLocalCurrency'];
        $finalArray['editpolicyCommisionUSD'] = $amendmentStatusData[0]['PolicyCommInUSD'];
        $finalArray['editPermiumLocalCurency'] = $amendmentStatusData[0]['PremiumNetofCommInLocalCurrency'];
        $finalArray['editPermiumUSD'] = $amendmentStatusData[0]['PremiumNetofCommInUSD'];

        /* Non Finanancial Details */
        $finalArray['yesDuckSubmissionNumber'] = ($amendmentStatusData[0]['IsDuckSubmissionNumber'] == 1) ? '1' : '0';
        $finalArray['editDuckSubmissionNumber'] = $amendmentStatusData[0]['DuckSubmissionNumber'];
        $finalArray['newrenewal'] = $amendmentStatusData[0]['NewRenewalLookupId'];
        $finalArray['editunderwriter'] = $amendmentStatusData[0]['UnderwriterId'];
        $finalArray['productline'] = $amendmentStatusData[0]['LobId'];
        $finalArray['editproductlinesubtype'] = $amendmentStatusData[0]['LobSubTypeId'];
        $finalArray['editsection'] = $amendmentStatusData[0]['SectionId'];
        $finalArray['editprofitcode'] = $amendmentStatusData[0]['ProfitCodeId'];
        $finalArray['editprimarystatus'] = $amendmentStatusData[0]['CurrentStatusId'];
        $finalArray['effectiveDate'] = $amendmentStatusData[0]['EffectiveDate'];
        $finalArray['expityDate'] = $amendmentStatusData[0]['ExpiryDate'];
        $finalArray['editcurrency'] = $amendmentStatusData[0]['CurrencyTypeId'];
        $finalArray['editexchangeRate'] = $amendmentStatusData[0]['ExchangeRate'];
        $finalArray['editexchangeRateDate'] = $amendmentStatusData[0]['ExchangeDate'];
        $finalArray['insuredId'] = $amendmentStatusData[0]['InsuredId'];
        $finalArray['insured_name_status'] = $amendmentStatusData[0]['IsDifferentDba'];
        $finalArray['dbaName'] = $amendmentStatusData[0]['DbaName'];
        $finalArray['editcabcompanies'] = $amendmentStatusData[0]['CABCompaniesLookupId'];
        $finalArray['reinsured_company'] = $amendmentStatusData[0]['ReinsuredCompany'];
        $finalArray['editsubmissiontypeidrntifier'] = $amendmentStatusData[0]['SubmissionIdentifier'];
        $finalArray['editinsuredContactPerson'] = $amendmentStatusData[0]['InsuredContactPersonId'];
        $finalArray['editinsuredSubmissionDate'] = $amendmentStatusData[0]['InsuredSubmissionDate'];
        $finalArray['editinsuredQuoteDueDate'] = $amendmentStatusData[0]['InsuredQuoteDueDate'];
        $finalArray['yesTrue'] = ($amendmentStatusData[0]['IsTotalInsuredValue'] == 1) ? 'Y' : 'N';
        $finalArray['total_insured_value_select'] = $amendmentStatusData[0]['TotalInsuredValue'];
        $finalArray['edittotalinsuredvalue'] = $amendmentStatusData[0]['TotalInsuredValue'];
        $finalArray['yesBroker'] = ($amendmentStatusData[0]['IsBerksiBroker'] == 1) ? 'Y' : 'N';
        $finalArray['received_date_by_berkshire'] = $amendmentStatusData[0]['BerkSIDateFromBroker'];
        $finalArray['yesIndia'] = ($amendmentStatusData[0]['IsBerksiIndia'] == 1) ? 'Y' : 'N';
        $finalArray['received_date_by_india'] = $amendmentStatusData[0]['BerkSiDateFromIndia'];
        $finalArray['edittotalinsuredvalueinusd'] = $amendmentStatusData[0]['TotalInsuredValueInUSD'];
        $finalArray['editriskProfile'] = $amendmentStatusData[0]['RiskProfile'];
        $finalArray['EditNumberOfLocations'] = $amendmentStatusData[0]['NumberOfLocationsId'];
        $finalArray['EditOccupancyCode'] = $amendmentStatusData[0]['OccupancyCodeId'];
        $finalArray['reason_code'] = $amendmentStatusData[0]['ReasonCodeId'];
        $finalArray['processdate'] = $amendmentStatusData[0]['ProcessDate'];
        $finalArray['branch_office'] = $amendmentStatusData[0]['BranchId'];

        /* Line of Business Dependent Details */
        $finalArray['project_country'] = $amendmentStatusData[0]['ProjectCountry'];
        $finalArray['project_state'] = $amendmentStatusData[0]['ProjectState'];
        $finalArray['project_city'] = $amendmentStatusData[0]['ProjectCity'];
        $finalArray['project_name'] = $amendmentStatusData[0]['ProjectName'];
        $finalArray['general_contrator_name'] = $amendmentStatusData[0]['ProjectGeneralContractorName'];
        $finalArray['project_owner_name'] = $amendmentStatusData[0]['ProjectOwnerName'];
        $finalArray['project_street_address'] = $amendmentStatusData[0]['ProjectAddress'];
        $finalArray['bid_situation'] = $amendmentStatusData[0]['BidSituationId'];

        /* Broker Details */
        $finalArray['retailBrokerName'] = $amendmentStatusData[0]['RetailBrokerName'];
        $finalArray['broker_code'] = $amendmentStatusData[0]['BrokerCode'];
        $editObj = new EditSubmissionDetails();
        $brokerCode = explode("-", $amendmentStatusData[0]['BrokerCode']);
        if (!empty($brokerCode[0])) {
            $brokerTypeRow = $editObj->FetchBrokerType($brokerCode[0]);
            $finalArray['wholesaler_retailer'] = $brokerTypeRow[0]['Alias'];
        }
        $finalArray['BrokerWiceCityId'] = $amendmentStatusData[0]['BrokerWiceCityId'];
        $finalArray['broker_contact_person'] = $amendmentStatusData[0]['BrokerContactPersonId'];
        $finalArray['BrokerId'] = $amendmentStatusData[0]['BrokerId'];
        $finalArray['retailbrokerCountryCode'] = $amendmentStatusData[0]['RetailBrokerCountry'];
        $finalArray['retailbrokerStateCode'] = $amendmentStatusData[0]['RetailBrokerState'];
        $finalArray['retailbrokerCityCode'] = $amendmentStatusData[0]['RetailBrokerCity'];
        /* Policy Details */
        $finalArray['yesBinddate'] = ($amendmentStatusData[0]['IsBindDate'] == 1) ? '1' : '0';
        $finalArray['editbinddate'] = $amendmentStatusData[0]['BindDate'];
        $finalArray['editrenewable'] = $amendmentStatusData[0]['RenewableLookupId'];
        $finalArray['editdateofrenewal'] = $amendmentStatusData[0]['DateofRenewal'];
        $finalArray['editpolicyName'] = $amendmentStatusData[0]['PolicyTypeLookupId'];
        $finalArray['editdirectAssumed'] = $amendmentStatusData[0]['DirectAssumedLookupId'];
        $finalArray['editadmitted'] = $amendmentStatusData[0]['AdimittedNonAdmittedLookupId'];
        $finalArray['editcompanyPaper'] = $amendmentStatusData[0]['CompanyPaperLookupId'];
        $finalArray['editcompanyPaperNumber'] = $amendmentStatusData[0]['CompanyPaperNumberLookupId'];
        $finalArray['editpolicyNumber'] = $amendmentStatusData[0]['PolicyNumber'];
        $finalArray['editcoverage'] = $amendmentStatusData[0]['CoverageId'];
        $finalArray['editsuffix'] = $amendmentStatusData[0]['SuffixLookupId'];
        $finalArray['editnaicCode'] = $amendmentStatusData[0]['NAICCode'];
        $finalArray['editnaicTitle'] = $amendmentStatusData[0]['NAICTitle'];
        $finalArray['editsicCode'] = $amendmentStatusData[0]['SICCode'];
        $finalArray['editsicTitle'] = $amendmentStatusData[0]['SICTitle'];
        $finalArray['editofrcReport'] = $amendmentStatusData[0]['OFRCAdverseReportLookupId'];
        $finalArray['hiddenPolicyNumber'] = $amendmentStatusData[0]['FinalPolicyNumber'];
        $finalArray['flag'] = $flag;
        $finalArray['editamendmentclassName'] = $amendmentStatusData[0]['ClassNameLookupId'];
        $finalArray['editamendmentsubClass'] = $amendmentStatusData[0]['ClassCode'];
        $finalArray['editamendmentdescription'] = $amendmentStatusData[0]['ClassDescription'];
        $transactionNumber = $this->CreateTransactionNumberForReversal($finalArray);
        $finalArray['edittransactionNumber'] = $transactionNumber;
        $userGroup = '';
        $submissionId = $amendmentStatusData[0]['SubmissionId'];
        $SubmissionAmendment = new SubmissionAmendment();
        $result = $SubmissionAmendment->CreateAmendmentDetails($finalArray, $userId, $submissionId, $userGroup);
        return $result;
    }

    private function UpdateReversalSubmission($amendmentId) {
        $con = Propel::getConnection();
        $query = "UPDATE SubmissionAmendment SET IsReversal = '1' WHERE Id = '" . $amendmentId . "'";
        $insert = $con->prepare($query);
        $insert->execute();
    }

    private function CreateTransactionNumberForReversal($finalArray) {
        $submissionId = $finalArray['submissionId'];
        $lastSubmissionNumer = $this->GetAmendmentInformation($submissionId);
        $vieObj = new ViewSubmissionDetails();
        $suffix = $vieObj->getLookUpdata($finalArray['editsuffix']);
        $finalTransactionNumber = substr(date("m/d/Y", strtotime($finalArray['effectiveDate'])), 8) . '' . $suffix[0]['LookupName'] . '' . str_pad((substr($lastSubmissionNumer, 16) + 1), 2, '0', STR_PAD_LEFT);
        return $finalTransactionNumber;
    }

    private function GetAmendmentInformation($submissionId) {
        $con = Propel::getConnection();
        $stmt = $con->query("SELECT TOP 1 SubmissionNumber FROM SubmissionAmendment Where SubmissionId = '$submissionId' ORDER BY Id DESC");
        $data = $stmt->fetch(PDO::FETCH_ASSOC);
        $lastAmendmentSubmissionNumber = $data['SubmissionNumber'];
        return $lastAmendmentSubmissionNumber;
    }

}
