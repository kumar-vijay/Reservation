<?php

class ViewSubmissionDetails {

    public function __construct() {
        $this->connection = Propel::getConnection();
    }

    public function ViewSubmissionDetail($submissionId) {
        $connection = $this->connection;
        $submissionQuery = "SELECT * FROM  Submission WHERE Id = '" . $submissionId . "'";
        $submissionStatement = $connection->prepare($submissionQuery);
        $submissionStatement->execute();
        $submissionDetail = $submissionStatement->fetchAll(PDO::FETCH_ASSOC);
        
        $editObj = new EditSubmissionDetails();
        $remarkRow = $editObj->FetchHistoryDetails($submissionId);
        
        $obj = new SubmissionDetails();
        $brokerCode = substr($submissionDetail[0]['BrokerCode'], 0, 5);
        $brokerDetails = $obj->getBroker($brokerCode);
        $brokerContactPersonDetails = $this->getContactPersonDetails($submissionDetail[0]['BrokerContactPersonId']);
        $brokerAddress = $this->GetBrokerAddress($submissionDetail[0]['BrokerWiseCityId']);
        $underwriteName = $obj->getUnderWriterName($submissionDetail[0]['UnderwriterId']);
        $newRenewDetails = $this->getLookUpdata($submissionDetail[0]['NewRenewalLookupId']);
        $lobDetails = $this->getLobName($submissionDetail[0]['LobId']);
        $lobSubDetails = $this->getLobSubTypeName($submissionDetail[0]['LobSubTypeId']);
        $sectionDetails = $this->getSection($submissionDetail[0]['SectionId']);
        $profitDetails = $this->getprofit($submissionDetail[0]['ProfitCodeId']);
        $status = $this->getStatus($submissionDetail[0]['CurrentStatusId']);
        $insuredDetails = $obj->getInsuredDetails($submissionDetail[0]['InsuredId']);
        $insuredContactPersonDetails = $this->getContactPersonDetails($submissionDetail[0]['InsuredContactPersonId']);
        $statusDetandentDetails = $this->GetStatusDependentDetails($submissionDetail[0]['StatusDependentDetailsId']);
        $businessDependentDetails = $this->GetBusinessDepantDetails($submissionDetail[0]['BusinessDependentDetailId']);

        $recorderData = $this->getRecorderData($submissionDetail[0]['DataRecorderMetaDataId']);
        $branchDetails = $this->getBranchName($submissionDetail[0]['BranchId']);
        $occupancyCodeDetails = $this->getOccupancyCode($submissionDetail[0]['OccupancyCodeId']);
        $numberOfLocations = $this->getLookUpdata($submissionDetail[0]['NumberOfLocationsId']);
        
        $finalArray = array();
        $finalArray['SUBMISSION_TYPE'] = $newRenewDetails[0]['LookupName'];
        $finalArray['UNDERWRITER_NAME'] = $underwriteName[0]->Name;
        $finalArray['PRODUCT_LINE'] = $lobDetails[0]['LOBName'];
        $finalArray['SUBMISSION_SUB_TYPE'] = $lobSubDetails[0]['ProductLineSubType'];
        $finalArray['SECTION_CODE'] = $sectionDetails[0]['SectionCode'];
        $finalArray['PROFIT_CODE'] = $profitDetails[0]['ProfitCodeName'];
        $finalArray['ISC_CODE'] = $profitDetails[0]['ISOCGL'];
        $finalArray['CREATION_DATE'] = $recorderData[0]['CreatedOn'];
        $finalArray['MODIFY_DATE'] = $recorderData[0]['ModifiedOn'];

        $finalArray['PRIMARY_STATUS'] = $status[0]['StatusName'];
        $finalArray['EFFECTIVE_DATE'] = $submissionDetail[0]['EffectiveDate'];
        $finalArray['EXPIRATION_DATE'] = $submissionDetail[0]['ExpiryDate'];
        $finalArray['INSURED_NAME'] = $insuredDetails['insuredName'];
        $finalArray['INSURED_ADDRESS'] = $insuredDetails['address'];
        $finalArray['INSURED_COUNTRY'] = $insuredDetails['country'];
        $finalArray['INSURED_STATE'] = $insuredDetails['state'];
        $finalArray['INSURED_CITY'] = $insuredDetails['city'];
        $finalArray['INSURED_ZIPCODE'] = $insuredDetails['zipcode'];
        $finalArray['DB_NUMBER'] = $insuredDetails['dbnumber'];
        $finalArray['CONTACT_PERSON'] = $insuredContactPersonDetails[0]['ContactPersonName'];
        $finalArray['CONTACT_PERSON_EMAIL'] = $insuredContactPersonDetails[0]['ContactPersonEmail'];
        $finalArray['CONTACT_PERSON_PHONE'] = $insuredContactPersonDetails[0]['ContactPersonNumber'];
        $finalArray['CONTACT_PERSON_MOBILE'] = $insuredContactPersonDetails[0]['ContactPersonMobile'];
        $finalArray['INSURED_SUBMISSION_DATE'] = $submissionDetail[0]['InsuredSubmissionDate'];
        $finalArray['INSURED_QUOTE_DUE_DATE'] = $submissionDetail[0]['InsuredQuoteDueDate'];
        $finalArray['CAB_COMPANIES'] = str_replace(",","&",$submissionDetail[0]['CABCompaniesLookupId']);
        $finalArray['REINSURED_COMPANY'] = $submissionDetail[0]['ReinsuredCompany'];
        $finalArray['SUBMISSION_IDENTIFIER'] = $this->getSubmissionIdentifier($submissionDetail[0]['SubmissionIdentifier']);
        $finalArray['DBA_NAME'] = $submissionDetail[0]['DbaName'];
        $finalArray['DUCK_SUBMISSION_NUMBER'] = $submissionDetail[0]['DuckSubmissionNumber'];
        
        $finalArray['PROJECT_NAME'] = $businessDependentDetails['businessDetails'][0]['ProjectName'];
        $finalArray['GENERAL_CONTRACTOR_NAME'] = $businessDependentDetails['businessDetails'][0]['ProjectGeneralContractorName'];
        $finalArray['PROJECT_OWNER_NAME'] = $businessDependentDetails['businessDetails'][0]['ProjectOwnerName'];
        $finalArray['PROJECT_COUNTRY_NAME'] = $businessDependentDetails['businessDetails'][0]['ProjectCountry'];
        $finalArray['PROJECT_STATE_NAME'] = $businessDependentDetails['businessDetails'][0]['ProjectState'];
        $finalArray['PROJECT_CITY_NAME'] = $businessDependentDetails['businessDetails'][0]['ProjectCity'];
        $finalArray['PROJECT_STREET'] = $businessDependentDetails['businessDetails'][0]['ProjectAddress'];
        $finalArray['BID_SITATION'] = $businessDependentDetails['bidsituation'][0]['Alias'];
        $finalArray['OCCUPANCY_CODE'] = $occupancyCodeDetails[0]['Name'];
        $finalArray['NUMBER_OF_LOCATIONS'] = $numberOfLocations[0]['LookupName'];
        if ($submissionDetail[0]['TotalInsuredValue'] == -1) {
            $finalArray['TOTAL_INSURED_VALUE'] = 'Not Available';
        } else if ($submissionDetail[0]['TotalInsuredValue'] == -2) {
            $finalArray['TOTAL_INSURED_VALUE'] = 'To Be Entered';
        } else {
            $finalArray['TOTAL_INSURED_VALUE'] = $submissionDetail[0]['TotalInsuredValue'];
        }
        $finalArray['TOTAL_INSURED_VALUE_USD'] = $submissionDetail[0]['TotalInsuredValueInUSD'];
        $finalArray['RISK_PROFILE'] = $submissionDetail[0]['RiskProfile'];

        $finalArray['REASON_CODE'] = $obj->getReasonCodeById($statusDetandentDetails[0]['ReasonCodeId']);
        $finalArray['PROCESS_DATE'] = $statusDetandentDetails[0]['ProcessDate'];
        if ($statusDetandentDetails[0]['Limit'] == -1) {
            $finalArray['LIMIT'] = 'Not Available';
        } else if ($statusDetandentDetails[0]['Limit'] == -2) {
            $finalArray['LIMIT'] = 'To Be Entered';
        } else {
            $finalArray['LIMIT'] = $statusDetandentDetails[0]['Limit'];
        }
        
        if ($statusDetandentDetails[0]['AttachmentPoint'] == -1) {
            $finalArray['ATTACHMENT_POINT'] = 'Not Available';
        } else if ($statusDetandentDetails[0]['AttachmentPoint'] == -2) {
            $finalArray['ATTACHMENT_POINT'] = 'To Be Entered';
        } else {
            $finalArray['ATTACHMENT_POINT'] = $statusDetandentDetails[0]['AttachmentPoint'];
        }
        
        if ($statusDetandentDetails[0]['GrossPremium'] == -1) {
            $finalArray['GROSS_PREMIUM'] = 'Not Available';
        } else if ($statusDetandentDetails[0]['GrossPremium'] == -2) {
            $finalArray['GROSS_PREMIUM'] = 'To Be Entered';
        } else {
             $finalArray['GROSS_PREMIUM'] = $statusDetandentDetails[0]['GrossPremium'];
        }
        $finalArray['GROSS_PREMIUM_USD'] = $statusDetandentDetails[0]['GrossPremiumInUSD'];
        $finalArray['LIMIT_USD'] = $statusDetandentDetails[0]['LimitInUSD'];
        $finalArray['ATTACHMENT_POINT_USD'] = $statusDetandentDetails[0]['AttachmentPointInUSD'];
        $finalArray['EXCHANGE_RATE'] = $statusDetandentDetails[0]['ExchangeRate'];
        $finalArray['EXCHANGE_DATE'] = $statusDetandentDetails[0]['ExchangeDate'];
        $finalArray['CURRENCY'] = $this->getLookUpdata($statusDetandentDetails[0]['CurrencyTypeId']);
     
        $finalArray['BROKER_NAME'] = $brokerDetails[0]['name'];
        $finalArray['BROKER_TYPE'] = $brokerDetails[0]['cat'];
        $finalArray['BROKER_COUNTRY'] = $brokerAddress[0]['InsuredCountry'];
        $finalArray['BROKER_STATE'] = $brokerAddress[0]['FullCode'];
        $finalArray['BROKER_CITY'] = $brokerAddress[0]['CityFullCode'];
        $finalArray['BROKER_CONTACT_PERSON'] = $brokerContactPersonDetails[0]['ContactPersonName'];
        $finalArray['BROKER_CONTACT_PERSON_EMAIL'] = $brokerContactPersonDetails[0]['ContactPersonEmail'];
        $finalArray['BROKER_CONTACT_PERSON_NUMBER'] = $brokerContactPersonDetails[0]['ContactPersonNumber'];
        $finalArray['BROKER_CONTACT_PERSON_MOBILE'] = $brokerContactPersonDetails[0]['ContactPersonMobile'];
        $finalArray['BROKER_CODE'] = $submissionDetail[0]['BrokerCode'];
        $finalArray['BERK_FROM_BROKER'] = $submissionDetail[0]['BerkSIDateFromBroker'];
        $finalArray['BERKSI_BY_INDIA'] = $submissionDetail[0]['BerkSiDateFromIndia'];
        $finalArray['BRANCH'] = $branchDetails[0]['Branch'];
        
        $BoundData = $this->GetSubmissionBoundDetails($submissionId);
        $retailBrokerData = $this->GetRetailBrokerDetails($submissionId);
        if($BoundData['Bind_Date'] == 'Dec 31 1969 12:00:00:000AM'){
            $BoundData['Bind_Date'] = '';
        }
        $finalArray['BINDDATE'] = $BoundData['Bind_Date'];
        $finalArray['RENEWAL'] = $BoundData['Renewal'];
        $finalArray['DATE_OF_RENEWAL'] = $BoundData['Date_Of_Renewal'];
        $finalArray['POLICY_TYPE'] = $BoundData['Polict_Type'];
        $finalArray['DIRECTASSUMED'] = $BoundData['DirectAssumed'];
        $finalArray['COMPANYPAPER'] = $BoundData['CompanyPaper'];
        $finalArray['COMPANYPAPERNUMBER'] = $BoundData['CompanyPaperNumber'];
        $finalArray['COVERAGE'] = $BoundData['Coverage'];
        $finalArray['POLICYNUMBER'] = $BoundData['PolicyNumber'];
        $finalArray['SUFFIX'] = $BoundData['suffix'];
        $finalArray['TRANSACTIONUMBER'] = $BoundData['TransactionNumber'];
        $finalArray['ADMITTED_NONADMITTED'] = $BoundData['admittedNonAdmitted'];
        $finalArray['LAYER_OF_LIMIT_IN_LOCALCURRENCY'] = $BoundData['LayerofLimitInLocalCurrency'];
        $finalArray['LAYER_OF_LIMIT_IN_USD'] = $BoundData['LayerofLimitInUSD'];
        $finalArray['PERCENTAGE_OF_LAYER'] = $BoundData['PercentageofLayer'];
        $finalArray['SELF_RETENTION_IN_LOCAL_CURRENCY'] = $BoundData['SelfInsuredRetentionInLocalCur'];
        $finalArray['SELF_RETENTION_IN_USD'] = $BoundData['SelfInsuredRetentionInUSD'];
        $finalArray['POLICY_COMM_PERCENTAGE'] = $BoundData['PolicyCommPercentage'];
        $finalArray['POLICY_COMM_IN_LOCAL_CURRENCY'] = $BoundData['PolicyCommInLocalCurrency'];
        $finalArray['POLICY_COMM_IN_USD'] = $BoundData['PolicyCommInUSD'];
        $finalArray['PREMIUM_NET_COMM_LOCAL'] = $BoundData['PermiumNetofCommInLocalCurrenc'];
        $finalArray['PREMIUM_NET_COMM_USD'] = $BoundData['PermiumNetofCommInUSD'];
        $finalArray['NAICCode'] = $BoundData['NAICCode'];
        $finalArray['NAICTitle'] = $BoundData['NAICTitle'];
        $finalArray['SICCode'] = $BoundData['SICCode'];
        $finalArray['SICTitle'] = $BoundData['SICTitle'];
        $finalArray['OFRCAdverseReport'] = $BoundData['OFRCAdverseReport'];
        $finalArray['CLASSNAME'] = $BoundData['CLASSNAME'];
        $finalArray['CLASSCODE'] = $BoundData['CLASSCODE'];
        $finalArray['CLASSDESCRIPTION'] = $BoundData['CLASSDESCRIPTION'];
        $finalArray['RetailBrokerName'] = $retailBrokerData['RetailBrokerName'];
        $finalArray['retailBrokerCountryData'] = $retailBrokerData['retailBrokerCountryData'];
        $finalArray['retailBrokerStateData'] = $retailBrokerData['retailBrokerStateData'];
        $finalArray['retailBrokerCityData'] = $retailBrokerData['retailBrokerCityData'];
        $finalArray['REMARK'] = $remarkRow[0]['Remarks'];
        return $finalArray;
    }

    public function GetAddressDetails($submissionId) {
        $connection = $this->connection;
        $addressQuery = "SELECT A.*, C.CityFullCode, S.FullCode, Co.InsuredCountry FROM  Address as A LEFT JOIN City as C ON A.CityId = C.Id LEFT JOIN State As S On C.StateId = S.Id LEFT JOIN Country as Co on S.CountryId = Co.Id WHERE A.Id = '" . $submissionId . "'";
        $addressStatement = $connection->prepare($addressQuery);
        $addressStatement->execute();
        $addressDetail = $addressStatement->fetchAll(PDO::FETCH_ASSOC);
        return $addressDetail;
    }

    public function GetStatusDependentDetails($submissionId) {
        $connection = $this->connection;
        $productQuery = "SELECT * FROM  StatusDependentDetails WHERE Id = '" . $submissionId . "'";
        $productStatement = $connection->prepare($productQuery);
        $productStatement->execute();
        $productDetail = $productStatement->fetchAll(PDO::FETCH_ASSOC);
        return $productDetail;
    }

    public function GetBusinessDepantDetails($submissionId) {
        $connection = $this->connection;
        $productQuery = "SELECT * FROM  BusinessDependentDetail WHERE Id = '" . $submissionId . "'";
        $productStatement = $connection->prepare($productQuery);
        $productStatement->execute();
        $productDetail = $productStatement->fetchAll(PDO::FETCH_ASSOC);
        $bidDetails = $this->getLookUpdata($productDetail[0]['BidSituation']);
        $finalBusinessDetails = array();
        $finalBusinessDetails['businessDetails'] = $productDetail;
        $finalBusinessDetails['bidsituation'] = $bidDetails;
        return $finalBusinessDetails;
    }
    
    public function GetSubmissionBoundDetails($submissionId){ 
        $connection = $this->connection;
        $submissionBoundQuery = "SELECT * FROM  SubmissionBound WHERE SubmissionId = '" . $submissionId . "'";
        $submissionBoundStatement = $connection->prepare($submissionBoundQuery);
        $submissionBoundStatement->execute();
        $submissionBoundDetail = $submissionBoundStatement->fetchAll(PDO::FETCH_ASSOC); 
        
        $renewaldata = $this->getLookUpdata($submissionBoundDetail[0]['RenewableLookupId']);
        $polictTypedata = $this->getLookUpdata($submissionBoundDetail[0]['PolicyTypeLookupId']);
        $directAssumeddata = $this->getLookUpdata($submissionBoundDetail[0]['DirectAssumedLookupId']);
        $companyPaperdata = $this->getLookUpdata($submissionBoundDetail[0]['CompanyPaperLookupId']);
        $companyPaperNumberdata = $this->getLookUpdata($submissionBoundDetail[0]['CompanyPaperNumberLookupId']);
        $suffixdata = $this->getLookUpdata($submissionBoundDetail[0]['SuffixLookupId']);
        $admittedNonAdmitteddata = $this->getLookUpdata($submissionBoundDetail[0]['AdimittedNonAdmittedLookupId']);
        $OFRCAdverseReportLookupdata = $this->getLookUpdata($submissionBoundDetail[0]['OFRCAdverseReportLookupId']);
        $retailBrokerCountryData = $this->getCountryName($submissionBoundDetail[0]['RetailBrokerCountryId']);
        $retailBrokerStateData = $this->getStateName($submissionBoundDetail[0]['RetailBrokerStateId']);
        $retailBrokerCityData = $this->getCityName($submissionBoundDetail[0]['RetailBrokerCityId']);
        $classNameData = $this->getLookUpdata($submissionBoundDetail[0]['ClassNameLookupId']);
     
        $boundArray = array();
        $boundArray['Bind_Date'] = $submissionBoundDetail[0]['BindDate'];
        $boundArray['Renewal'] = $renewaldata[0]['LookupName'];
        $boundArray['Date_Of_Renewal'] = $submissionBoundDetail[0]['DateofRenewal'];
        $boundArray['Polict_Type'] = $polictTypedata[0]['LookupName'];
        $boundArray['DirectAssumed'] = $directAssumeddata[0]['LookupName'];
        $boundArray['CompanyPaper'] = $companyPaperdata[0]['LookupName'];
        $boundArray['CompanyPaperNumber'] = $companyPaperNumberdata[0]['LookupName'];
        $boundArray['Coverage'] = $this->GetCoverageDetails($submissionBoundDetail[0]['CoverageId']);
        $boundArray['PolicyNumber'] = $submissionBoundDetail[0]['PolicyNumber'];
        $boundArray['suffix'] = $suffixdata[0]['LookupName'];
        $boundArray['TransactionNumber'] = $submissionBoundDetail[0]['TransactionNumber'];
        $boundArray['admittedNonAdmitted'] = $admittedNonAdmitteddata[0]['LookupName'];
        $boundArray['LayerofLimitInLocalCurrency'] = $submissionBoundDetail[0]['LayerofLimitInLocalCurrency'];
        $boundArray['LayerofLimitInUSD'] = $submissionBoundDetail[0]['LayerofLimitInUSD'];
        $boundArray['PercentageofLayer'] = $submissionBoundDetail[0]['PercentageofLayer'];
        $boundArray['SelfInsuredRetentionInLocalCur'] = $submissionBoundDetail[0]['SelfInsuredRetentionInLocalCur'];
        $boundArray['SelfInsuredRetentionInUSD'] = $submissionBoundDetail[0]['SelfInsuredRetentionInUSD'];
        $boundArray['PolicyCommPercentage'] = $submissionBoundDetail[0]['PolicyCommPercentage'];
        $boundArray['PolicyCommInLocalCurrency'] = $submissionBoundDetail[0]['PolicyCommInLocalCurrency'];
        $boundArray['PolicyCommInUSD'] = $submissionBoundDetail[0]['PolicyCommInUSD'];
        $boundArray['PermiumNetofCommInLocalCurrenc'] = $submissionBoundDetail[0]['PermiumNetofCommInLocalCurrenc'];
        $boundArray['PermiumNetofCommInUSD'] = $submissionBoundDetail[0]['PermiumNetofCommInUSD'];
        $boundArray['NAICCode'] = $submissionBoundDetail[0]['NAICCode'];
        $boundArray['NAICTitle'] = $submissionBoundDetail[0]['NAICTitle'];
        $boundArray['SICCode'] = $submissionBoundDetail[0]['SICCode'];
        $boundArray['SICTitle'] = $submissionBoundDetail[0]['SICTitle'];
        $boundArray['OFRCAdverseReport'] = $OFRCAdverseReportLookupdata[0]['LookupName'];
        $boundArray['RetailBrokerName'] = $submissionBoundDetail[0]['RetailBrokerName'];
        $boundArray['retailBrokerCountryData'] = $retailBrokerCountryData[0]['InsuredCountry'];
        $boundArray['retailBrokerStateData'] = $retailBrokerStateData[0]['FullCode'];
        $boundArray['retailBrokerCityData'] = $retailBrokerCityData[0]['CityFullCode'];
        $boundArray['CLASSNAME'] = $classNameData[0]['LookupName'];
        $boundArray['CLASSCODE'] = $submissionBoundDetail[0]['ClassCode'];
        $boundArray['CLASSDESCRIPTION'] = $submissionBoundDetail[0]['ClassDescription'];
        return $boundArray;
    }
    
    
      public function GetRetailBrokerDetails($submissionId){ 
        $connection = $this->connection;
        $retailBrokerQuery = "SELECT * FROM  RetailBrokerDetails WHERE SubmissionId = '" . $submissionId . "'";
        $retailBrokerStatement = $connection->prepare($retailBrokerQuery);
        $retailBrokerStatement->execute();
        $retailBrokerDetail = $retailBrokerStatement->fetchAll(PDO::FETCH_ASSOC); 
        
        $retailBrokerCountryData = $this->getCountryName($retailBrokerDetail[0]['RetailBrokerCountry']);
        $retailBrokerStateData = $this->getStateName($retailBrokerDetail[0]['RetailBrokerState']);
        $retailBrokerCityData = $this->getCityName($retailBrokerDetail[0]['RetailBrokerCity']);
        $retailBrokerArray = array();
        
        $retailBrokerArray['RetailBrokerName'] = $retailBrokerDetail[0]['RetailBrokerName'];
        $retailBrokerArray['retailBrokerCountryData'] = $retailBrokerCountryData[0]['InsuredCountry'];
        $retailBrokerArray['retailBrokerStateData'] = $retailBrokerStateData[0]['FullCode'];
        $retailBrokerArray['retailBrokerCityData'] = $retailBrokerCityData[0]['CityFullCode'];
        return $retailBrokerArray;
    }

    public function getLookUpdata($lookupId) {
        $con = Propel::getConnection();
        $query = "SELECT * FROM Lookup WHERE Id = '" . $lookupId . "'";
        $stmt = $con->query($query);
        $result = $stmt->fetchAll();
        return $result;
    }

    public function getLobName($lobId) {
        $con = Propel::getConnection();
        $query = "SELECT * FROM LOB WHERE Id = '" . $lobId . "'";
        $stmt = $con->query($query);
        $result = $stmt->fetchAll();
        return $result;
    }

    public function getLobSubTypeName($lobSubId) {
        $con = Propel::getConnection();
        $query = "SELECT * FROM LOBSubType WHERE Id = '" . $lobSubId . "'";
        $stmt = $con->query($query);
        $result = $stmt->fetchAll();
        return $result;
    }

    public function getSection($sectionId) {
        $con = Propel::getConnection();
        $query = "SELECT S.Id, SL.SectionCode from sectioncode S join SectionCodeLookup SL on S.SectionCodeLookupId = SL.Id WHERE S.Id = '" . $sectionId . "'";
        $stmt = $con->query($query);
        $result = $stmt->fetchAll();
        return $result;
    }

    public function getprofit($profitId) {
        $con = Propel::getConnection();
         $query = "SELECT P.Id, PL.ProfitCodeName, PL.ISOCGL from ProfitCode P join ProfitCodeLookup PL on P.ProfitCodeLookupId = PL.Id WHERE P.Id = '" . $profitId . "'";
        $stmt = $con->query($query);
        $result = $stmt->fetchAll();
        return $result;
    }

    public function getStatus($statusId) {
        $con = Propel::getConnection();
        $query = "SELECT * FROM  Status WHERE Id = '" . $statusId . "'";
        $stmt = $con->query($query);
        $result = $stmt->fetchAll();
        return $result;
    }

    public function getRecorderData($recoderId) {
        $con = Propel::getConnection();
        $query = "SELECT * FROM  DataRecorderMetaData WHERE Id = '" . $recoderId . "'";
        $stmt = $con->query($query);
        $result = $stmt->fetchAll();
        return $result;
    }

    public function GetBrokerAddress($brokeCityId) {
        $con = Propel::getConnection();
        $query = "SELECT DISTINCT Co.InsuredCountry,S.FullCode, C.CityFullCode FROM BrokerWiseCity as BW LEFT JOIN City as C ON BW.CityId = C.Id LEFT JOIN State as S ON C.StateId = S.Id LEFT JOIN Country as Co ON S.CountryId = Co.Id  WHERE BW.CityId = $brokeCityId ";
        $stmt = $con->query($query);
        $result = $stmt->fetchAll(PDO::FETCH_ASSOC);
        return $result;
    }

    public function UpdateSubmissionDetail($postValues, $submissionId, $userId) {
        $newQcStatus = $postValues['qcstatus'];
        $qcId = $this->GetLookUpId($newQcStatus);
        $data = $this->GetQcStatus($submissionId);
        $oldQcStatusId = $data[0]['QCStatus'];
        $oldStatusData = $this->getLookUpdata($oldQcStatusId);
        $oldQcStatus = $oldStatusData[0]['LookupName'];
        $qcRemarks = $postValues['qcremarks'];
        if($qcId == ''){
            $qcId = '5';
        }
        $con = Propel::getConnection();
        $query = "UPDATE Submission SET QCStatus = '" . $qcId . "' WHERE Id = '" . $submissionId . "'";
        $insert = $con->prepare($query);
        if ($insert->execute()) {
            $historyquery = "INSERT INTO SubmissionHistory 
              (SubmissionId, Field, OldValue, NewValue, Remarks, ModifiedBy, ModifiedOn) 
               VALUES 
               ('" . $submissionId . "','QC Status','" . $oldQcStatus . "','" . $newQcStatus . "','" . $qcRemarks . "', '" . $userId . "', GETDATE())";

            $insert = $con->prepare($historyquery);
            $insert->execute();
        } else {
            return false;
        }
    }

    public function GetLookUpId($lookUpName) {
        $con = Propel::getConnection();
        $query = "SELECT * FROM Lookup WHERE LookupName = '$lookUpName'";
        $stmt = $con->query($query);
        $result = $stmt->fetchAll(PDO::FETCH_ASSOC);
        return $result[0]['Id'];
    }

    public function GetQcStatus($submissionId) {
        $con = Propel::getConnection();
        $query = "SELECT QCStatus FROM Submission WHERE Id = '$submissionId'";
        $stmt = $con->query($query);
        $result = $stmt->fetchAll(PDO::FETCH_ASSOC);
        return $result;
    }

    public function getBranchName($branchId) {
        $con = Propel::getConnection();
        $query = "SELECT * FROM Branch WHERE Id = '" . $branchId . "'";
        $stmt = $con->query($query);
        $result = $stmt->fetchAll();
        return $result;
    }

    public function getCountryName($countryId) {
        $con = Propel::getConnection();
        $query = "SELECT * FROM Country WHERE Id = '" . $countryId . "'";
        $stmt = $con->query($query);
        $result = $stmt->fetchAll();
        return $result;
    }

    public function getStateName($stateId) {
        $con = Propel::getConnection();
        $query = "SELECT * FROM State WHERE Id = '" . $stateId . "'";
        $stmt = $con->query($query);
        $result = $stmt->fetchAll();
        return $result;
    }

    public function getCityName($cityId) {
        $con = Propel::getConnection();
        $query = "SELECT * FROM City WHERE Id = '" . $cityId . "'";
        $stmt = $con->query($query);
        $result = $stmt->fetchAll();
        return $result;
    }

     public function getProjectStateName($stateId) {
        $con = Propel::getConnection();
        $query = "SELECT ProjectCode FROM State WHERE Id = '" . $stateId . "'";
        $stmt = $con->query($query);
        $result = $stmt->fetchAll();
        return $result;
    }

    public function getProjectCityName($cityId) {
        $con = Propel::getConnection();
        $query = "SELECT City FROM City WHERE Id = '" . $cityId . "'";
        $stmt = $con->query($query);
        $result = $stmt->fetchAll();
        return $result;
    }

    public function getReasonCodeName($reasonCodeId) {
        $con = Propel::getConnection();
        $query = "SELECT ReasonCodeName, Meaning FROM ReasonCode WHERE Id = '" . $reasonCodeId . "'";
        $stmt = $con->query($query);
        $result = $stmt->fetchAll();
        return $result;
    }

    public function getBrokerName($brokerCode) {
        $con = Propel::getConnection();
        $query = "SELECT BrokerName ,BrokerTypeId FROM Broker WHERE BrokerCode = '" . $brokerCode . "'";
        $stmt = $con->query($query);
        $result = $stmt->fetchAll();
        return $result;
    }

    public function getSubmissionIdentifier($identifierId) {
        $con = Propel::getConnection();
        $query = "SELECT * FROM SubmissionTypeIndicator WHERE Id = '" . $identifierId . "'";
        $stmt = $con->query($query);
        $result = $stmt->fetchAll();
        return $result[0]['Name'];
    }
    
    public function getOccupancyCode($occupancyCodeId) {
        $con = Propel::getConnection();
        $query = "SELECT * FROM OccupancyCode WHERE Id = '" . $occupancyCodeId . "'";
        $stmt = $con->query($query);
        $result = $stmt->fetchAll();
        return $result;
    }
    
    public function getContactPersonDetails($contactPersonId) {
        $con = Propel::getConnection();
        $query = "SELECT (FirstName +' '+ LastName) as ContactPersonName, Email as ContactPersonEmail, PhoneNumber as ContactPersonNumber, MobileNumber as ContactPersonMobile FROM ContactPersonDetails WHERE Id = '" . $contactPersonId . "'";
        $stmt = $con->query($query);
        $result = $stmt->fetchAll();
        return $result;
    }
    
     public function GetCoverageDetails($coverageId) {
        $connection = $this->connection;
        $coverageQuery = "SELECT * FROM  Coverage WHERE Id = '" . $coverageId . "'";
        $coverageStatement = $connection->prepare($coverageQuery);
        $coverageStatement->execute();
        $coverageDetail = $coverageStatement->fetchAll(PDO::FETCH_ASSOC);
        return $coverageDetail[0]['Name'];
    }

}


