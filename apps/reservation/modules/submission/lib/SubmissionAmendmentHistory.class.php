<?php

class SubmissionAmendmentHistory {

    public function __construct() {
        $this->connection = Propel::getConnection();
    }

    public function FetcholdValues($amendmentId) {
        $connection = $this->connection;
        $amendmentSubmissionQuery = "Select SA.*,AF.*,AN.*,AB.*,AP.*,AR.*,ABD.* from dbo.SubmissionAmendment AS SA 
                                    Left Join AmendmentFinancial AS AF on AF.Id = SA.FinancialAmendmentId
                                    Left Join AmendmentNonFinancial AS AN on AN.Id = SA.NonFinancialAmendmentId
                                    Left Join AmendmentBusinessDependentDetails AS AB on AB.Id = AN.AmendmentBusinessDependentDetailsId
                                    Left Join AmendmentPolicyDetails AS AP on AP.Id = AN.AmendmentPolicyDetailsId
                                    Left Join AmendmentBrokerDetails AS ABD on ABD.Id = An.AmendmentBrokerDetailsId
                                    Left Join AmendmentRetailBrokerDetails AS AR on AR.Id = ABD.AmendmentRetailBrokerDetailsId
                                    Where SA.Id = '" . $amendmentId . "'";
        $amendmentSubmissionStatement = $connection->prepare($amendmentSubmissionQuery);
        $amendmentSubmissionStatement->execute();
        $amendmentSubmission = $amendmentSubmissionStatement->fetchAll(PDO::FETCH_ASSOC);
        return $amendmentSubmission[0];
    }

    public function SaveAmendmentHistory($postedValues, $userId, $amendmentId, $userGroup) {
        $oldValues = $this->FetcholdValues($amendmentId);
        $newvalues = $postedValues;
        $editAmendmentObj = new EditSubmissionAmendment();
        $qcStatusId = $editAmendmentObj->GetQcStatus();
        $AmendmentFinancialId = $this->SaveInAmendmentFinancialHistory($oldValues, $newvalues);
        $AmendmentNonFinancialId = $this->SaveInAmendmentNonFinancialHistory($oldValues, $newvalues);
         
        $con = $this->connection;
        $query = "INSERT INTO SubmissionAmendentHistory
              (SubmissionAmendentId, SubmissionNumber, NonFinancialAmendmentHistoryId, FinancialAmendmenHistorytId, QCStatus, NewSubmissionNumber, NewQCStatus, Remarks,ModifiedBy, ModifiedOn) 
               VALUES 
               ('" . $amendmentId . "','" . $oldValues['SubmissionNumber'] . "','" . $AmendmentNonFinancialId . "' ,'" . $AmendmentFinancialId . "', '" . $oldValues['QCStatus'] . "', '" . $oldValues['SubmissionNumber'] . "','".$qcStatusId."','".$newvalues['editamendmentRemark']."','" . $userId . "', GETDATE())";
        $insert = $con->prepare($query);
        if ($insert->execute()) {
            return true;
        } else {
            return false;
        }
    }

    private function SaveInAmendmentFinancialHistory($oldValues, $newvalues) {
        if (isset($newvalues['yesGross'])) {
            $newvalues['yesGross'] = '1';
            $premiumInLocalCurrency = $newvalues['gross_premium_select'];
        } else {
            $newvalues['yesGross'] = 0;
            $premiumInLocalCurrency = $newvalues['gross_premium_text'];
        }
        if (isset($newvalues['yesLimit'])) {
            $newvalues['yesLimit'] = '1';
            $limitInLocalCurrency = $newvalues['limit_select'];
        } else {
            $newvalues['yesLimit'] = 0;
            $limitInLocalCurrency = $newvalues['limit_text'];
        }
        if (isset($newvalues['yesAttachment'])) {
            $newvalues['yesAttachment'] = '1';
            $attacmentInLocalCurrency = $newvalues['attachment_point_select'];
        } else {
            $newvalues['yesAttachment'] = 0;
            $attacmentInLocalCurrency = $newvalues['attachment_point_text'];
        }
        $con = $this->connection;
        $query = "INSERT INTO AmendmentFinancialHistory
              (PremiunType,IsPremium,PremiumInLocalCurrency,PremiumInUSD,LayerofLimitInLocalCurrency,LayerofLimitInUSD,PercentageofLayer,IsLimit,LimitInLocalCurrency,LimitInUSD,IsAttachmentPoint,AttachmentPointInLocalCurrency,AttachmentPointInUSD,SelfInsuredRetentionInLocalCurrency,SelfInsuredRetentionInUSD,PolicyCommPercentage,PolicyCommInLocalCurrency,PolicyCommInUSD,PremiumNetofCommInLocalCurrency,PremiumNetofCommInUSD,NewPremiunType,NewIsPremium,NewPremiumInLocalCurrency,NewPremiumInUSD,NewLayerofLimitInLocalCurrency,NewLayerofLimitInUSD,NewPercentageofLayer,NewIsLimit,NewLimitInLocalCurrency,NewLimitInUSD,NewIsAttachmentPoint,NewAttachmentPointInLocalCurrency,NewAttachmentPointInUSD,NewSelfInsuredRetentionInLocalCurrency,NewSelfInsuredRetentionInUSD,NewPolicyCommPercentage,NewPolicyCommInLocalCurrency,NewPolicyCommInUSD,NewPremiumNetofCommInLocalCurrency,NewPremiumNetofCommInUSD) 
               VALUES 
               ('" . $oldValues['PremiunType'] . "','" . $oldValues['IsPremium'] . "','" . $oldValues['PremiumInLocalCurrency'] . "' ,'" . $oldValues['PremiumInUSD'] . "', '" . $oldValues['LayerofLimitInLocalCurrency'] . "', '" . $oldValues['LayerofLimitInUSD'] . "', '" . $oldValues['PercentageofLayer'] . "', '" . $oldValues['IsLimit'] . "', '" . $oldValues['LimitInLocalCurrency'] . "', '" . $oldValues['LimitInUSD'] . "', '" . $oldValues['IsAttachmentPoint'] . "', '" . $oldValues['AttachmentPointInLocalCurrency'] . "', '" . $oldValues['AttachmentPointInUSD'] . "', '" . $oldValues['SelfInsuredRetentionInLocalCur'] . "', '" . $oldValues['SelfInsuredRetentionInUSD'] . "', '" . $oldValues['PolicyCommPercentage'] . "', '" . $oldValues['PolicyCommInLocalCurrency'] . "', '" . $oldValues['PolicyCommInUSD'] . "', '" . $oldValues['PremiumNetofCommInLocalCurrenc'] . "', '" . $oldValues['PremiumNetofCommInUSD'] . "', '" . $newvalues['premiumType'] . "', '" . $newvalues['yesGross'] . "', '" . $premiumInLocalCurrency . "', '" . $newvalues['editamendmentlocalCurrency'] . "', '" . $newvalues['editamendmentLayerLimitLocalCurrency'] . "', '" . $newvalues['editamendmentLayerLimitLocalUSD'] . "', '" . $newvalues['editamendmentPrecentageLayer'] . "', '" . $newvalues['yesLimit'] . "', '" . $limitInLocalCurrency . "', '" . $newvalues['editamendmentlimitlocalcurrency'] . "', '" . $newvalues['yesAttachment'] . "', '" . $attacmentInLocalCurrency . "', '" . $newvalues['editamendmentattachmentlocalcurrency'] . "','" . $newvalues['editamendmentselfRetrntionLocalCurrency'] . "', '" . $newvalues['editamendmentselfRetrntionUSD'] . "', '" . $newvalues['editamendmentpolicyCommision'] . "', '" . $newvalues['editamendmentpolicyCommisionLocalCurrrency'] . "', '" . $newvalues['editamendmentpolicyCommisionUSD'] . "', '" . $newvalues['editamendmentPermiumLocalCurency'] . "', '" . $newvalues['editamendmentPermiumUSD'] . "')";
        $insert = $con->prepare($query);
        if ($insert->execute()) {
            $STH = $con->query("SELECT CAST(COALESCE(SCOPE_IDENTITY(), @@IDENTITY) AS int)");
            $STH->execute();
            $result = $STH->fetch();
            $amendmentFinancialHistoryId = $result[0];
        }
        return $amendmentFinancialHistoryId;
    }

    private function SaveInAmendmentNonFinancialHistory($oldValues, $newvalues) {
        $editSubmissonObj = new EditSubmissionDetails();
        $oldInsuredDetails = $editSubmissonObj->FetchInsuredDetails($oldValues['InsuredId']);
        $oldInsuredContactPersonDetails = $this->FetchIContactPersonDetails($oldValues['InsuredContactPersonId']);
        /*New Insured Details and Insured Contact Personal Details*/
        $newInsuredDetails = $editSubmissonObj->FetchInsuredDetails($newvalues['insuredId']);
        $newInsuredContactPersonDetails = $this->FetchIContactPersonDetails($newvalues['editamendmentinsuredContactPerson']);
        if (!empty($oldValues['ProjectName']) && isset($newvalues['project_name'])) {
            $AmendmentBusinessDependentDetailsHistoryId = $this->SaveInAmendmentBusinessDependentDetailsHistory($oldValues, $newvalues);
        } else {
            $AmendmentBusinessDependentDetailsHistoryId = null;
        }
        $newvalues['yesDuckSubmissionNumber'] = ($newvalues['yesDuckSubmissionNumber']=='Y') ? 1 : 0;
        $newvalues['insured_name_status'] = ($newvalues['insured_name_status']=='Y') ? 1 : 0;
        $newvalues['insured_name_status'] = ($newvalues['insured_name_status']=='Y') ? 1 : 0;
        $newvalues['yesBroker'] =   ($newvalues['yesBroker']=='Y') ? 1 : 0;
        $newvalues['yesBroker'] =   ($newvalues['yesBroker']=='Y') ? 1 : 0;
        $newvalues['yesIndia'] =   ($newvalues['yesIndia']=='Y') ? 1 : 0;
        
        $AmendmentBrokerDetailsHistoryId = $this->SaveInAmendmentBrokerDetailsHistory($oldValues, $newvalues);
        $AmendmentPolicyDetailsHistoryId = $this->SaveInAmendmentPolicyDetailsHistory($oldValues, $newvalues);
        
        if (isset($newvalues['yesTrue']) &&!empty($newvalues['yesTrue']) && ($newvalues['yesTrue'] == 'Y' || $newvalues['yesTrue'] == '1')) {
            $newvalues['total_insured_value'] = $newvalues['total_insured_value_select'];
        } else {
            $newvalues['total_insured_value'] = $newvalues['editamendmenttotalinsuredvalue'];
        }
        $con = $this->connection;
        $query = "INSERT INTO AmendmentNonFinancialHistory
              (IsDuckSubmissionNumber, DuckSubmissionNumber, NewRenewalLookupId, UnderwriterId, LobId, LobSubTypeId, SectionId, ProfitCodeId, CurrentStatusId, EffectiveDate, ExpiryDate, CurrencyTypeId, ExchangeRate, ExchangeDate, InusredName, InsuredAddressLine1, InsuredCountry, InsuredState, InsuredCity, InsuredZipCode, DbNumber, IsDifferentDba, DbaName, CABCompaniesLookupId, ReinsuredCompany, SubmissionIdentifier, InsuredContactPersonName, InsuredContactPersonEmail, InsuredContactPersonPhone, InsuredContactPersonMobile, InsuredSubmissionDate, InsuredQuoteDueDate, IsTotalInsuredValue, TotalInsuredValue, TotalInsuredValueInUSD, RiskProfile, NumberOfLocationsId, OccupancyCodeId, ReasonCodeId, ProcessDate, IsBerksiBroker, BerkSIDateFromBroker, IsBerksiIndia, BerkSiDateFromIndia, BranchId, NewIsDuckSubmissionNumber, NewDuckSubmissionNumber, New_NewRenewalLookupId, NewUnderwriterId, NewLobId, NewLobSubTypeId, NewSectionId, NewProfitCodeId, NewCurrentStatusId, NewEffectiveDate, NewExpiryDate, NewCurrencyTypeId, NewExchangeRate, NewExchangeDate, NewInusredName, NewInsuredAddressLine1, NewInsuredCountry, NewInsuredState, NewInsuredCity, NewInsuredZipCode, NewDbNumber, NewIsDifferentDba, NewDbaName, NewCABCompaniesLookupId, NewReinsuredCompany, NewSubmissionIdentifier, NewInsuredContactPersonName, NewInsuredContactPersonEmail, NewInsuredContactPersonPhone, NewInsuredContactPersonMobile, NewIsuredSubmissionDate, NewInsuredQuoteDueDate, NewIsTotalInsuredValue, NewTotalInsuredValue, NewTotalInsuredValueInUSD, NewRiskProfile, NewNumberOfLocationsId, NewOccupancyCodeId, NewReasonCodeId, NewProcessDate, NewIsBerksiBroker, NewBerkSIDateFromBroker, NewIsBerksiIndia, NewBerkSiDateFromIndia, NewBranchId, AmendmentBusinessDependentDetailsHistoryId, AmendmentBrokerDetailsHistoryId, AmendmentPolicyDetailsHistoryId) 
               VALUES 
               ('" . $oldValues['IsDuckSubmissionNumber'] . "','" . $oldValues['DuckSubmissionNumber'] . "','" . $oldValues['NewRenewalLookupId'] . "' ,'" . $oldValues['UnderwriterId'] . "', '" . $oldValues['LobId'] . "', '" . $oldValues['LobSubTypeId'] . "', '" . $oldValues['SectionId'] . "', '" . $oldValues['ProfitCodeId'] . "', '" . $oldValues['CurrentStatusId'] . "', '" . $oldValues['EffectiveDate'] . "', '" . $oldValues['ExpiryDate'] . "', '" . $oldValues['CurrencyTypeId'] . "', '" . $oldValues['ExchangeRate'] . "', '" . $oldValues['ExchangeDate'] . "', '" . $oldInsuredDetails[0]['InsuredName'] . "', '" . $oldInsuredDetails[0]['Address'] . "','".$oldInsuredDetails[0]['InsuredCountry']."','".$oldInsuredDetails[0]['StateName']."','".$oldInsuredDetails[0]['City']."','".$oldInsuredDetails[0]['Zip']."','".$oldInsuredDetails[0]['DBNumber']."','".$oldValues['IsDifferentDba']."','".$oldValues['DbaName']."','".$oldValues['CABCompaniesLookupId']."','".$oldValues['ReinsuredCompany']."','".$oldValues['SubmissionIdentifier']."','".$oldInsuredContactPersonDetails[0]['ContactPersonName']."','".$oldInsuredContactPersonDetails[0]['Email']."','".$oldInsuredContactPersonDetails[0]['PhoneNumber']."','".$oldInsuredContactPersonDetails[0]['MobileNumber']."','".$oldValues['InsuredSubmissionDate']."','".$oldValues['InsuredQuoteDueDate']."','".$oldValues['IsTotalInsuredValue']."','".$oldValues['TotalInsuredValue']."','".$oldValues['TotalInsuredValueInUSD']."','".$oldValues['RiskProfile']."','".$oldValues['NumberOfLocationsId']."','".$oldValues['OccupancyCodeId']."','".$oldValues['ReasonCodeId']."','".$oldValues['ProcessDate']."','".$oldValues['IsBerksiBroker']."','".$oldValues['BerkSIDateFromBroker']."','".$oldValues['IsBerksiIndia']."','".$oldValues['BerkSiDateFromIndia']."','".$oldValues['BranchId']."','" . $newvalues['yesDuckSubmissionNumber'] . "','" . $newvalues['DuckSubmissionNumber'] . "','" . $newvalues['newrenewal'] . "' ,'" . $newvalues['editamendmentunderwriter'] . "', '" . $newvalues['hiddenProductLine'] . "', '" . $newvalues['hiddenProductLineSubType'] . "', '" . $newvalues['hiddenSectionCode'] . "', '" . $newvalues['hiddenProfitCode'] . "', '" . $newvalues['editamendmentprimarystatus'] . "', '" . $newvalues['effectiveDate'] . "', '" . $newvalues['expityDate'] . "', '" . $newvalues['editamendmentcurrency'] . "', '" . $newvalues['editamendmentexchangeRate'] . "', '" . $newvalues['editamendmentexchangeRateDate'] . "', '" . $newInsuredDetails[0]['InsuredName'] . "', '" . $newInsuredDetails[0]['Address'] . "','".$newInsuredDetails[0]['InsuredCountry']."','".$newInsuredDetails[0]['StateName']."','".$newInsuredDetails[0]['City']."','".$newInsuredDetails[0]['Zip']."','".$newInsuredDetails[0]['DBNumber']."','".$newvalues['insured_name_status']."','".$newvalues['dbaName']."','".$newvalues['editamendmentcabcompanies']."','".$newvalues['reinsured_company']."','".$newvalues['editamendmentsubmissiontypeidrntifier']."','".$newInsuredContactPersonDetails[0]['ContactPersonName']."','".$newInsuredContactPersonDetails[0]['Email']."','".$newInsuredContactPersonDetails[0]['PhoneNumber']."','".$newInsuredContactPersonDetails[0]['MobileNumber']."','".$newvalues['editamendmentinsuredSubmissionDate']."','".$newvalues['editamendmentinsuredQuoteDueDate']."','".$newvalues['yesTrue']."','".$newvalues['total_insured_value']."','".$newvalues['editamendmenttotalinsuredvalueinusd']."','".$newvalues['editamendmentriskProfile']."','".$newvalues['EditNumberOfLocations']."','".$newvalues['EditOccupancyCode']."','".$newvalues['reason_code']."','".$newvalues['processdate']."','".$newvalues['yesBroker']."','".$newvalues['received_date_by_berkshire']."','".$newvalues['yesIndia']."','".$newvalues['received_date_by_india']."','".$newvalues['branch_office']."','".$AmendmentBusinessDependentDetailsHistoryId."', '".$AmendmentBrokerDetailsHistoryId."', '".$AmendmentPolicyDetailsHistoryId."')";
        $insert = $con->prepare($query);
        if ($insert->execute()) {
            $STH = $con->query("SELECT CAST(COALESCE(SCOPE_IDENTITY(), @@IDENTITY) AS int)");
            $STH->execute();
            $result = $STH->fetch();
            $amendmentNonFinancialHistoryId = $result[0];
        }
        return $amendmentNonFinancialHistoryId;
    }

    private function SaveInAmendmentBusinessDependentDetailsHistory($oldValues, $newvalues) {
        $con = $this->connection;
        $editSubmissonObj = new EditSubmissionDetails();
        $newvalues['project_country'] = $editSubmissonObj->GetProjectCountry($newvalues['project_country']);
        $newvalues['project_state'] = $editSubmissonObj->GetProjectState($newvalues['project_state']);
        $newvalues['project_city'] = $editSubmissonObj->GetProjectCity($newvalues['project_city']);
        $query = "INSERT INTO AmendmentBusinessDependentDetailsHistory
              (ProjectName, ProjectGeneralContractorName, ProjectOwnerName, ProjectAddress, ProjectCity, ProjectState, ProjectCountry, BidSituationId, NewProjectName, NewProjectGeneralContractorName, NewProjectOwnerName, NewProjectAddress, NewProjectCity, NewProjectState, NewProjectCountry, NewBidSituationId) 
               VALUES 
               ('" . $oldValues['ProjectName'] . "','" . $oldValues['ProjectGeneralContractorName'] . "','" . $oldValues['ProjectOwnerName'] . "' ,'" . $oldValues['ProjectAddress'] . "', '" . $oldValues['ProjectCity'] . "', '" . $oldValues['ProjectState'] . "', '" . $oldValues['ProjectCountry'] . "', '" . $oldValues['BidSituationId'] . "', '" . $newvalues['project_name'] . "', '" . $newvalues['general_contrator_name'] . "', '" . $newvalues['project_owner_name'] . "', '" . $newvalues['project_street_address'] . "', '" . $newvalues['project_city'] . "', '" . $newvalues['project_state'] . "', '" . $newvalues['project_country'] . "', '" . $newvalues['bid_situation'] . "')";
        $insert = $con->prepare($query);
        if ($insert->execute()) {
            $STH = $con->query("SELECT CAST(COALESCE(SCOPE_IDENTITY(), @@IDENTITY) AS int)");
            $STH->execute();
            $result = $STH->fetch();
            $amendmentBusinessDependentHistoryId = $result[0];
        }
        return $amendmentBusinessDependentHistoryId;
    }

    private function SaveInAmendmentBrokerDetailsHistory($oldValues, $newvalues) {
        $con = $this->connection;
        if(isset($newvalues['retailBrokerName'])){
            $newRetailBroker = $newvalues['retailBrokerName'];
        }else{
            $newRetailBroker = null;
        }
        if(isset($newvalues['retailbrokerCountryCode'])){
            $newRetailBrokerCountry = $newvalues['retailbrokerCountryCode'];
        }else{
            $newRetailBrokerCountry = null;
        }
        if(isset($newvalues['retailbrokerStateCode'])){
            $newRetailBrokerState = $newvalues['retailbrokerStateCode'];
        }else{
            $newRetailBrokerState = null;
        }
        if(isset($newvalues['retailbrokerCityCode'])){
            $newRetailBrokerCity = $newvalues['retailbrokerCityCode'];
        }else{
            $newRetailBrokerCity = null;
        }
        $subObj = new SubmissionDetails();
        $brokerId = $subObj->GetBrokerId($newvalues['brokerCode']);
        $brokerWiseCityId = $subObj->GetBrokerWiseId($newvalues['brokerCode'], $newvalues['brokerCityCode'], $newvalues['brokerStateCode']);
        $query = "INSERT INTO AmendmentBrokerDetailsHistory
              (BrokerId, BrokerWiceCityId, BrokerContactPersonId, BrokerCode, RetailBrokerName, RetailBrokerCountry, RetailBrokerState, RetailBrokerCity, NewBrokerId, NewBrokerWiceCityId, NewBrokerContactPersonId, NewBrokerCode, NewRetailBrokerName, NewRetailBrokerCountry, NewRetailBrokerState, NewRetailBrokerCity) 
               VALUES 
               ('" . $oldValues['BrokerId'] . "','" . $oldValues['BrokerWiceCityId'] . "','" . $oldValues['BrokerContactPersonId'] . "' ,'" . $oldValues['BrokerCode'] . "', '" . $oldValues['RetailBrokerName'] . "', '" . $oldValues['RetailBrokerCountry'] . "', '" . $oldValues['RetailBrokerState'] . "', '" . $oldValues['RetailBrokerCity'] . "', '" . $brokerId . "', '" . $brokerWiseCityId . "', '" . $newvalues['broker_contact_person'] . "', '" . $newvalues['broker_code'] . "', '" . $newRetailBroker . "', '" . $newRetailBrokerCountry . "', '" . $newRetailBrokerState . "', '" . $newRetailBrokerCity . "')";
        $insert = $con->prepare($query);
        if ($insert->execute()) {
            $STH = $con->query("SELECT CAST(COALESCE(SCOPE_IDENTITY(), @@IDENTITY) AS int)");
            $STH->execute();
            $result = $STH->fetch();
            $amendmentBrokerHistoryId = $result[0];
        }
        return $amendmentBrokerHistoryId;
    }

    private function SaveInAmendmentPolicyDetailsHistory($oldValues, $newvalues) {
        if (isset($newvalues['yesBinddate'])) {
            $newvalues['yesBinddate'] = '1';
        } else {
            $newvalues['yesBinddate'] = 0;
        }
        $con = $this->connection;
        $query = "INSERT INTO AmendmentPolicyDetailsHistory
              (IsBindDate, BindDate, RenewableLookupId, DateofRenewal, PolicyTypeLookupId, DirectAssumedLookupId, AdimittedNonAdmittedLookupId, CompanyPaperLookupId, CompanyPaperNumberLookupId, PolicyNumber, CoverageId, SuffixLookupId, TransactionNumber, NAICCode, NAICTitle, SICCode, SICTitle, OFRCAdverseReportLookupId, FinalPolicyNumber, NewIsBindDate, NewBindDate, NewRenewableLookupId, NewDateofRenewal, NewPolicyTypeLookupId, NewDirectAssumedLookupId, NewAdimittedNonAdmittedLookupId, NewCompanyPaperLookupId, NewCompanyPaperNumberLookupId, NewPolicyNumber, NewCoverageId, NewSuffixLookupId, NewTransactionNumber, NewNAICCode, NewNAICTitle, NewSICCode, NewSICTitle, NewOFRCAdverseReportLookupId, NewFinalPolicyNumber) 
               VALUES 
               ('" . $oldValues['IsBindDate'] . "','" . $oldValues['BindDate'] . "','" . $oldValues['RenewableLookupId'] . "' ,'" . $oldValues['DateofRenewal'] . "', '" . $oldValues['PolicyTypeLookupId'] . "', '" . $oldValues['DirectAssumedLookupId'] . "', '" . $oldValues['AdimittedNonAdmittedLookupId'] . "', '" . $oldValues['CompanyPaperLookupId'] . "', '" . $oldValues['CompanyPaperNumberLookupId'] . "', '" . $oldValues['PolicyNumber'] . "', '" . $oldValues['CoverageId'] . "', '" . $oldValues['SuffixLookupId'] . "', '" . $oldValues['TransactionNumber'] . "', '" . $oldValues['NAICCode'] . "', '" . $oldValues['NAICTitle'] . "', '" . $oldValues['SICCode'] . "', '" . $oldValues['SICTitle'] . "', '" . $oldValues['OFRCAdverseReportLookupId'] . "', '" . $oldValues['FinalPolicyNumber'] . "', '" . $newvalues['yesBinddate'] . "', '" . $newvalues['editamendmentbinddate'] . "', '" . $newvalues['editamendmentrenewable'] . "', '" . $newvalues['editamendmentdateofrenewal'] . "', '" . $newvalues['editamendmentpolicyName'] . "', '" . $newvalues['editamendmentdirectAssumed'] . "', '" . $newvalues['editamendmentadmitted'] . "', '" . $newvalues['editamendmentcompanyPaper'] . "', '" . $newvalues['editamendmentcompanyPaperNumber'] . "', '" . $newvalues['editamendmentpolicyNumber'] . "', '" . $newvalues['editamendmentcoverage'] . "', '" . $newvalues['editamendmentsuffix'] . "', '" . $newvalues['editamendmenttransactionNumber'] . "','" . $newvalues['editamendmentnaicCode'] . "', '" . $newvalues['editamendmentnaicTitle'] . "', '" . $newvalues['editamendmentsicCode'] . "', '" . $newvalues['editamendmentsicTitle'] . "', '" . $newvalues['editamendmentofrcReport'] . "', '" . $newvalues['hiddenPolicyNumber'] . "')";
        $insert = $con->prepare($query);
        if ($insert->execute()) {
            $STH = $con->query("SELECT CAST(COALESCE(SCOPE_IDENTITY(), @@IDENTITY) AS int)");
            $STH->execute();
            $result = $STH->fetch();
            $amendmentPolicyHistoryId = $result[0];
        }
        return $amendmentPolicyHistoryId;
    }
    
    public function FetchIContactPersonDetails($ContactPersonId) {
        $connection = $this->connection;
        $ContactPersonQuery = "SELECT (FirstName +' '+ LastName) as ContactPersonName, Email, PhoneNumber, MobileNumber FROM ContactPersonDetails Where Id = $ContactPersonId";
        $ContactPersonStatement = $connection->prepare($ContactPersonQuery);
        $ContactPersonStatement->execute();
        $ContactPersonData = $ContactPersonStatement->fetchAll(PDO::FETCH_ASSOC);
        return $ContactPersonData;
    }

}
