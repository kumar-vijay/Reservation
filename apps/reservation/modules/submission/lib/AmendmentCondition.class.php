<?php

class AmendmentCondition {

    public function __construct() {
        $this->_con = Propel::getConnection();
    }

    public static function GetAmendmentCount($SubmissionId) {
        $con = Propel::getConnection();
        $stmt = $con->query("SELECT Count(*) AS Count FROM SubmissionAmendment Where SubmissionId = '$SubmissionId';");
        $data = $stmt->fetchAll(PDO::FETCH_ASSOC);
        return $data[0]['Count'];
    }

    public static function GetAmendmentInformation($SubmissionId) {
        $con = Propel::getConnection();
        $query = "SELECT TOP 1 * FROM SubmissionAmendment WHERE SubmissionId = '" . $SubmissionId . "' ORDER BY Id DESC";
        $stmt = $con->query($query);
        $result = $stmt->fetchAll();
        return $result;
    }
    
    public function formatArray($data){
        $editObj = new EditSubmissionDetails();
        $objSubmisionDetails = new SubmissionDetails();
        $submissionId = $data[0]['SubmissionId'];
        $submissionRow['SubmissionAmendmentId'] = $data[0]['SubmissionAmendmentId'];
        $submissionRow['Id'] = $data[0]['SubmissionId'];
        $submissionRow['SubmissionNumber'] = $data[0]['SubmissionNumber'];
        $submissionRow['NewRenewalLookupId'] = $data[0]['NewRenewalLookupId'];
        $submissionRow['UnderwriterId'] = $data[0]['UnderwriterId'];
        $submissionRow['LobId'] = $data[0]['LobId'];
        $submissionRow['LobSubTypeId'] = $data[0]['LobSubTypeId'];
        $submissionRow['SectionId'] = $data[0]['SectionId'];
        $submissionRow['ProfitCodeId'] = $data[0]['ProfitCodeId'];
        $submissionRow['CurrentStatusId'] = $data[0]['CurrentStatusId'];
        $submissionRow['EffectiveDate'] = date('m/d/Y', strtotime($data[0]['EffectiveDate']));
        $submissionRow['ExpiryDate'] = date('m/d/Y', strtotime($data[0]['ExpiryDate']));
        $submissionRow['InsuredId'] = $data[0]['InsuredId'];
        $submissionRow['IsDifferentDba'] = ($data[0]['IsDifferentDba']=='0')?'N':'Y';
        $submissionRow['DbaName'] = $data[0]['DbaName'];
        $submissionRow['CABCompaniesLookupId'] = $data[0]['CABCompaniesLookupId'];
        $submissionRow['ReinsuredCompany'] = $data[0]['ReinsuredCompany'];
        $submissionRow['SubmissionIdentifier'] = $data[0]['SubmissionIdentifier'];
        $submissionRow['BusinessDependentDetailId'] = $data[0]['AmendmentBusinessDependentDeta'];
        $submissionRow['TotalInsuredValue'] = $data[0]['TotalInsuredValue'];
        $submissionRow['BrokerWiseCityId'] = $data[0]['BrokerWiceCityId'];
        $submissionRow['BrokerCode'] = $data[0]['BrokerCode'];        
        $submissionRow['StatusDependentDetailsId'] = '';
        $submissionRow['BerkSIDateFromBroker'] = date('m/d/Y H:i', strtotime($data[0]['BerkSIDateFromBroker']));
        $submissionRow['BerkSiDateFromIndia'] = date('m/d/Y', strtotime($data[0]['BerkSiDateFromIndia']));
        $submissionRow['BranchId'] = $data[0]['BranchId'];
        $submissionRow['QCStatus'] = $data[0]['QCStatus'];
        $submissionRow['OccupancyCodeId'] = $data[0]['OccupancyCodeId'];
        $submissionRow['NumberOfLocationsId'] = $data[0]['NumberOfLocationsId'];
        $submissionRow['DataRecorderMetaDataId'] = $data[0]['DataRecorderMetaDataId'];
        $submissionRow['IsTotalInsuredValue'] = ($data[0]['IsTotalInsuredValue']=='0')?'N':'Y';
        $submissionRow['IsBerksiBroker'] = ($data[0]['IsBerksiBroker']=='0')?'N':'Y';
        $submissionRow['IsBerksiIndia'] = ($data[0]['IsBerksiIndia']=='0')?'N':'Y';
        $submissionRow['IsGrossPremium'] = ($data[0]['IsPremium']=='0')?'N':'Y';
        $submissionRow['IsLimit'] = ($data[0]['IsLimit']=='0')?'N':'Y';
        $submissionRow['IsAttachmentPoint'] = ($data[0]['IsAttachmentPoint']=='0')?'N':'Y';
        $submissionRow['LogId'] = '';
        $submissionRow['SubmissionSequence'] = '';
        $submissionRow['MailSendingStatus'] = '';
        $submissionRow['InsuredContactPersonId'] = $data[0]['InsuredContactPersonId'];
        $submissionRow['BrokerContactPersonId'] = $data[0]['BrokerContactPersonId'];
        $submissionRow['InsuredSubmissionDate'] = date('m/d/Y', strtotime($data[0]['InsuredSubmissionDate']));
        $submissionRow['InsuredQuoteDueDate'] = date('m/d/Y', strtotime($data[0]['InsuredQuoteDueDate']));
        $submissionRow['RiskProfile'] = $data[0]['RiskProfile'];
        $submissionRow['TotalInsuredValueInUSD'] = $data[0]['TotalInsuredValueInUSD'];
        $submissionRow['IsDuckSubmissionNumber'] = ($data[0]['IsDuckSubmissionNumber']=='0')?'N':'Y';
        $submissionRow['DuckSubmissionNumber'] = $data[0]['DuckSubmissionNumber'];
        
        $submissionRow['PremiunType'] = $data[0]['PremiunType'];
        $amendmentRow = array('0'=>$submissionRow);
        $brokerDetailArr = explode('-', $data[0]['BrokerCode']);
            $brokerCode = $brokerDetailArr[0];
            if ($brokerCode == '1') {
                $brokerCode = '-1';
            } else if ($brokerCode == '2') {
                $brokerCode = '-2';
            } else {
                $brokerCode = $brokerDetailArr[0];
            }
            $this->brokerCountryCode1 = isset($brokerDetailArr[1]) && $brokerDetailArr[1] ? $brokerDetailArr[1] : '';
            $brokerCountryCode = $objSubmisionDetails->getCountryId($this->brokerCountryCode1);
            $brokerStateCode = $objSubmisionDetails->getStateId($brokerDetailArr[2], $brokerCountryCode);
            $brokerCityCode = $objSubmisionDetails->getCityId($brokerDetailArr[3], $brokerStateCode);
            $this->brokerId = $objSubmisionDetails->GetBrokerWiseId($brokerCode, $brokerCityCode, $brokerStateCode);
                
        $submissionProductRow = $editObj->getLobName($data[0]['LobId']);
        if (count($submissionProductRow) > 0) {
            $submissionProduct = $submissionProductRow[0];
        }
        $brokerTypeRow = $editObj->FetchBrokerType($brokerCode);
        if (count($brokerTypeRow) > 0) {
            $brokerType = $brokerTypeRow[0];
        }
        $insuredRows = $editObj->FetchInsuredDetails();
        if (count($insuredRows) > 0) {
            $this->insuredDetails = $insuredRows;
            $insuredDetails = $editObj->FetchInsuredDetails($data[0]['InsuredId']);
            $insuredName = $insuredDetails[0]['InsuredName'];
            $insuredaddress = $insuredDetails[0]['Address'];
            $insuredCountry = $insuredDetails[0]['InsuredCountry'];
            $insuredState = $insuredDetails[0]['StateName'];
            $insuredCity = $insuredDetails[0]['City'];
            $insuredZipcode = $insuredDetails[0]['Zip'];
            $insuredDBNumber = $insuredDetails[0]['DBNumber'];
        }

        if (!empty($data[0]['InsuredId'])) {
            $insuredParty = 98;
            $insuredContactPersonRows = $objSubmisionDetails->ContactPerson($data[0]['InsuredId'], $insuredParty);
        }
        if (!empty($data[0]['InsuredContactPersonId'])) {
            $insuredContactPersonDetailsRows = $editObj->FetchInsuredContactPersonDetails($data[0]['InsuredContactPersonId']);
            if (count($insuredContactPersonDetailsRows) > 0) {
                $insuredContactPersonDetails = $insuredContactPersonDetailsRows[0];
            }
        }
        if (!empty($this->brokerId)) {
            $insuredParty = 97;
            $this->brokerContactPersonRows = $objSubmisionDetails->ContactPerson($this->brokerId, $insuredParty);
        }
        $brokerContactPersonDetailsRows = $editObj->FetchBrokerContactPersonDetails($data[0]['BrokerContactPersonId']);
        if (count($brokerContactPersonDetailsRows) > 0) {
            $this->brokerContactPersonDetails = $brokerContactPersonDetailsRows[0];
        }
        $businessDetails = array();
        $businessDetails['Id'] = $data[0]['AmendmentBusinessDependentDeta'];
        $businessDetails['ProjectName'] = $data[0]['ProjectName'];
        $businessDetails['ProjectGeneralContractorName'] = $data[0]['ProjectGeneralContractorName'];
        $businessDetails['ProjectOwnerName'] = $data[0]['ProjectOwnerName'];
        $businessDetails['ProjectAddress'] = $data[0]['ProjectAddress'];
        $businessDetails['BidSituation'] = $data[0]['BidSituationId'];
        $businessDetails['ProjectCountry'] = $objSubmisionDetails->getCountryId($data[0]['ProjectCountry']);
        $businessDetails['ProjectState'] = $editObj->getProjectStateId($data[0]['ProjectState']);
        $businessDetails['ProjectCity'] = $editObj->getProjectCityId($data[0]['ProjectCity']);
        
        $statusDetails = array();
            $statusDetails[Id] = '';
            $statusDetails['ReasonCodeId'] = $data[0]['ReasonCodeId'];
            $statusDetails['ProcessDate'] = $data[0]['ProcessDate'];
            $statusDetails['GrossPremium'] = $data[0]['PremiumInLocalCurrency'];
            $statusDetails['Limit'] = $data[0]['LimitInLocalCurrency'];
            $statusDetails['AttachmentPoint'] = $data[0]['AttachmentPointInLocalCurrency'];
            $statusDetails['GrossPremiumInUSD'] = $data[0]['PremiumInUSD'];
            $statusDetails['LimitInUSD'] = $data[0]['LimitInUSD'];
            $statusDetails['AttachmentPointInUSD'] =$data[0]['AttachmentPointInUSD'];
            $statusDetails['ExchangeRate'] =$data[0]['ExchangeRate'];
            $statusDetails['ExchangeDate'] =$data[0]['ExchangeDate'];
            $statusDetails['CurrencyTypeId'] =$data[0]['CurrencyTypeId'];
            
        $submissionBranchRows = $editObj->FetchSubmissionBranch($data[0]['BranchId']);
        if (count($submissionBranchRows) > 0) {
            $branches = $submissionBranchRows[0]['Branch'];
        }
        $dataRecorderTypeRows = $editObj->FetchDataRecorderType($data[0]['DataRecorderMetaDataId']);
        if (count($dataRecorderTypeRows) > 0) {
            $DataRecorder = $dataRecorderTypeRows[0];
        }

        $remarkRow = $editObj->FetchHistoryDetails($submissionId);
        if (count($remarkRow) > 0) {
            $remarks = $remarkRow;
        }
        $retailBrokerData = $editObj->FetchRetailBrokerDetails($submissionId);
        if (count($retailBrokerData) > 0) {
            $retailBrokerDetails = $retailBrokerData[0];
        }
        $finalData = array('submissionRow' => $amendmentRow, 'submissionProduct' => $submissionProduct, 'brokerType' => $brokerType, 'retailBrokerDetails' => $retailBrokerDetails,
            'remarks' => $remarks, 'statusDetails' => $statusDetails, 'insuredName' => $insuredName, 'insuredaddress' => $insuredaddress, 'insuredCountry' => $insuredCountry, 'insuredState' => $insuredState,
            'insuredCity' => $insuredCity, 'insuredZipcode' => $insuredZipcode, 'insuredDBNumber' => $insuredDBNumber, 'businessDetails' => $businessDetails, 'brokerCode' => $brokerCode,
            'brokerCountryCode' => $brokerCountryCode, 'brokerStateCode' => $brokerStateCode, 'brokerCityCode' => $brokerCityCode, 'branches' => $branches, 'DataRecorder' => $DataRecorder,
            'insuredContactPersonRows' => $insuredContactPersonRows, 'insuredContactPersonDetails' => $insuredContactPersonDetails
        );
        return $finalData;
    }
    
    public function getAmendmentBound($data){
        $boundData = array();
        $bound['Id']= '';
        $bound['SubmissionId']= $data[0]['SubmissionId'];
        $bound['IsBindDate'] = ($data[0]['IsBindDate']=='0')?'N':'Y';       
        $bound['BindDate'] = $data[0]['BindDate']; 
        $bound['RenewableLookupId']= $data[0]['RenewableLookupId'];
        $bound['DateofRenewal']= $data[0]['DateofRenewal']; 
        $bound['PolicyTypeLookupId']= $data[0]['PolicyTypeLookupId']; 
        $bound['DirectAssumedLookupId']= $data[0]['DirectAssumedLookupId']; 
        $bound['CompanyPaperLookupId']= $data[0]['CompanyPaperLookupId']; 
        $bound['CompanyPaperNumberLookupId']= $data[0]['CompanyPaperNumberLookupId']; 
        $bound['CoverageId']= $data[0]['CoverageId']; 
        $bound['PolicyNumber']= $data[0]['PolicyNumber']; 
        $bound['SuffixLookupId']= $data[0]['SuffixLookupId']; 
        $bound['TransactionNumber']= $data[0]['TransactionNumber']; 
        $bound['AdimittedNonAdmittedLookupId']= $data[0]['AdimittedNonAdmittedLookupId']; 
        $bound['LayerofLimitInLocalCurrency']= $data[0]['LayerofLimitInLocalCurrency'];  
        $bound['LayerofLimitInUSD']= $data[0]['LayerofLimitInUSD'];  
        $bound['PercentageofLayer']= $data[0]['PercentageofLayer'];  
        $bound['SelfInsuredRetentionInLocalCur']= $data[0]['SelfInsuredRetentionInLocalCur'];  
        $bound['SelfInsuredRetentionInUSD']= $data[0]['SelfInsuredRetentionInUSD'];  
        $bound['PolicyCommPercentage']= $data[0]['PolicyCommPercentage'];
        $bound['PolicyCommInLocalCurrency']= $data[0]['PolicyCommInLocalCurrency']; 
        $bound['PolicyCommInUSD']= $data[0]['PolicyCommInUSD']; 
        $bound['PermiumNetofCommInLocalCurrenc']= $data[0]['PremiumNetofCommInLocalCurrenc']; 
        $bound['PermiumNetofCommInUSD']= $data[0]['PremiumNetofCommInUSD']; 
        $bound['NAICCode']= $data[0]['NAICCode']; 
        $bound['NAICTitle']= $data[0]['NAICTitle'];
        $bound['SICCode']= $data[0]['SICCode']; 
        $bound['SICTitle']= $data[0]['SICTitle'];
        $bound['OFRCAdverseReportLookupId']= $data[0]['OFRCAdverseReportLookupId']; 
        $bound['FinalPolicyNumber']= $data[0]['FinalPolicyNumber'];
        $bound['ClassNameLookupId'] = $data[0]['ClassNameLookupId'];
        $bound['ClassCode'] = $data[0]['ClassCode'];
        $bound['ClassDescription'] = $data[0]['ClassDescription'];
        $boundReturn  = array('0'=>$bound);
        return $boundReturn;
    }
    
}
