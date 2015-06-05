<?php

class AmendmentList {

    public function __construct() {
        $this->connection = Propel::getConnection();
    }

     public static function FormateAmendmentList($amendmentStatusData,$isReversal,$cancelationCount,$flag) {
        $finalArray = array();
        foreach ($amendmentStatusData as $value) {
            $finalArray['ReversalRight'] = $isReversal;
            $finalArray['CancelationChild'] = $cancelationCount;
            $finalArray['userFlag'] = $flag;
            $finalArray['ReversalChild'] = $value['ReversalChild'];;
            $finalArray['AmendmentId'] = $value['AmendmentId'];
            $finalArray['SubmissionId'] = $value['SubmissionId'];
            $finalArray['SubmissionNumber'] = $value['SubmissionNumber'];
            $finalArray['QcStatus'] = $value['QcStatus'];
            $finalArray['IsReversal'] = $value['IsReversal'];
            $finalArray['PremiunType'] = $value['PremiunType'];
            $finalArray['PremiumInLocalCurrency'] = $value['PremiumInLocalCurrency'];
            $finalArray['PremiumInUSD'] = $value['PremiumInUSD'];
            $finalArray['LayerofLimitInLocalCurrency'] = $value['LayerofLimitInLocalCurrency'];
            $finalArray['LayerofLimitInUSD'] = $value['LayerofLimitInUSD'];
            $finalArray['PercentageofLayer'] = $value['PercentageofLayer'];
            $finalArray['LimitInLocalCurrency'] = $value['LimitInLocalCurrency'];
            $finalArray['LimitInUSD'] = $value['LimitInUSD'];
            $finalArray['AttachmentPointInLocalCurrency'] = $value['AttachmentPointInLocalCurrency'];
            $finalArray['AttachmentPointInUSD'] = $value['AttachmentPointInUSD'];
            $finalArray['SelfInsuredRetentionInLocalCur'] = $value['SelfInsuredRetentionInLocalCur'];
            $finalArray['SelfInsuredRetentionInUSD'] = $value['SelfInsuredRetentionInUSD'];
            $finalArray['PolicyCommPercentage'] = $value['PolicyCommPercentage'];
            $finalArray['PolicyCommInLocalCurrency'] = $value['PolicyCommInLocalCurrency'];
            $finalArray['PolicyCommInUSD'] = $value['PolicyCommInUSD'];
            $finalArray['PremiumNetofCommInLocalCurrenc'] = $value['PremiumNetofCommInLocalCurrenc'];
            $finalArray['PremiumNetofCommInUSD'] = $value['PremiumNetofCommInUSD'];
            $finalArray['DuckSubmissionNumber'] = $value['DuckSubmissionNumber'];
            $finalArray['NewRenewal'] = $value['NewRenewal'];
            $finalArray['UnderwriterName'] = $value['UnderwriterName'];
            $finalArray['ProductLine'] = $value['ProductLine'];
            $finalArray['ProductLineSubType'] = $value['ProductLineSubType'];
            $finalArray['SectionCode'] = $value['SectionCode'];
            $finalArray['ProfitCode'] = $value['ProfitCode'];
            $finalArray['Status'] = $value['Status'];
            $finalArray['Currency'] = $value['Currency'];
            $finalArray['ExchangeRate'] = $value['ExchangeRate'];
            $finalArray['InsuredName'] = $value['InsuredName'];
            $finalArray['InsuredAddress1'] = $value['InsuredAddress1'];
            $finalArray['InsuredCity'] = $value['InsuredCity'];
            $finalArray['InsuredState'] = $value['InsuredState'];
            $finalArray['InsuredCountry'] = $value['InsuredCountry'];
            $finalArray['InsuredZipCode'] = $value['InsuredZipCode'];
            $finalArray['AdvisenId'] = $value['AdvisenId'];
            $finalArray['DbNumber'] = $value['DbNumber'];
            $finalArray['DbaName'] = $value['DbaName'];
            $finalArray['CabCompanies'] = $value['CabCompanies'];
            $finalArray['ReinsuredCompany'] = $value['ReinsuredCompany'];
            $finalArray['SubmissionIdentifier'] = $value['SubmissionIdentifier'];
            $finalArray['InsuredContactPersonName'] = $value['InsuredContactPersonName'];
            $finalArray['InsuredContactPersonEmail'] = $value['InsuredContactPersonEmail'];
            $finalArray['InsuredContactPersonPhoneNumbe'] = $value['InsuredContactPersonPhoneNumbe'];
            $finalArray['InsuredContactPersonMobileNumb'] = $value['InsuredContactPersonMobileNumb'];
            $finalArray['TotalInsuredValueinLocalCurren'] = $value['TotalInsuredValueinLocalCurren'];
            $finalArray['TotalInsuredValueInUSD'] = $value['TotalInsuredValueInUSD'];
            $finalArray['RiskProfile'] = $value['RiskProfile'];
            if (!empty($value['NumberOfLocations'])) {
                $finalArray['NumberOfLocations'] = $value['NumberOfLocations'];
            } else {
                $finalArray['NumberOfLocations'] = "";
            }
            if (!empty($value['OccupancyCode'])) {
                $finalArray['OccupancyCode'] = $value['OccupancyCode'];
            } else {
                $finalArray['OccupancyCode'] = "";
            }
            if (!empty($value['ReasonCode'])) {
                $finalArray['ReasonCode'] = $value['ReasonCode'];
            } else {
                $finalArray['ReasonCode'] = "";
            }
            $finalArray['BranchName'] = $value['BranchName'];
            if (!empty($value['ProjectName'])) {
                $finalArray['ProjectName'] = $value['ProjectName'];
            } else {
                $finalArray['ProjectName'] = "";
            }
            if (!empty($value['ProjectContractorName'])) {
                $finalArray['ProjectContractorName'] = $value['ProjectContractorName'];
            } else {
                $finalArray['ProjectContractorName'] = "";
            }
            if (!empty($value['ProjectOwnerName'])) {
                $finalArray['ProjectOwnerName'] = $value['ProjectOwnerName'];
            } else {
                $finalArray['ProjectOwnerName'] = "";
            }
            if (!empty($value['ProjectAddressLine1'])) {
                $finalArray['ProjectAddressLine1'] = $value['ProjectAddressLine1'];
            } else {
                $finalArray['ProjectAddressLine1'] = "";
            }
            if (!empty($value['ProjectCity'])) {
                $finalArray['ProjectCity'] = $value['ProjectCity'];
            } else {
                $finalArray['ProjectCity'] = "";
            }
            if (!empty($value['ProjectState'])) {
                $finalArray['ProjectState'] = $value['ProjectState'];
            } else {
                $finalArray['ProjectState'] = "";
            }
            if (!empty($value['ProjectCountry'])) {
                $finalArray['ProjectCountry'] = $value['ProjectCountry'];
            } else {
                $finalArray['ProjectCountry'] = "";
            }
            if (!empty($value['Bidsituation'])) {
                $finalArray['Bidsituation'] = $value['Bidsituation'];
            } else {
                $finalArray['Bidsituation'] = "";
            }
            $finalArray['BrokerCode'] = $value['BrokerCode'];
            $finalArray['BrokerName'] = $value['BrokerName'];
            $finalArray['BrokerType'] = $value['BrokerType'];
            $finalArray['BrokerSubType'] = $value['BrokerSubType'];
            $finalArray['BrokerCountry'] = $value['BrokerCountry'];
            $finalArray['BrokerState'] = $value['BrokerState'];
            $finalArray['BrokerCity'] = $value['BrokerCity'];
            $finalArray['AddressLine1'] = $value['AddressLine1'];
            $finalArray['ZipCode'] = $value['ZipCode'];
            $finalArray['BrokerContactPerson'] = $value['BrokerContactPerson'];
            if (!empty($value['BrokerContactPersonEmail'])) {
                $finalArray['BrokerContactPersonEmail'] = $value['BrokerContactPersonEmail'];
            } else {
                $finalArray['BrokerContactPersonEmail'] = "";
            }
            if (!empty($value['BrokerContactPersonNumber'])) {
                $finalArray['BrokerContactPersonNumber'] = $value['BrokerContactPersonNumber'];
            } else {
                $finalArray['BrokerContactPersonNumber'] = "";
            }
            if (!empty($value['BrokerContactPersonMobile'])) {
                $finalArray['BrokerContactPersonMobile'] = $value['BrokerContactPersonMobile'];
            } else {
                $finalArray['BrokerContactPersonMobile'] = "";
            }
            if (!empty($value['RetailBrokerName'])) {
                $finalArray['RetailBrokerName'] = $value['RetailBrokerName'];
            } else {
                $finalArray['RetailBrokerName'] = "";
            }
            if (!empty($value['RetailBrokerCountry'])) {
                $finalArray['RetailBrokerCountry'] = $value['RetailBrokerCountry'];
            } else {
                $finalArray['RetailBrokerCountry'] = "";
            }
            if (!empty($value['RetailBrokerState'])) {
                $finalArray['RetailBrokerState'] = $value['RetailBrokerState'];
            } else {
                $finalArray['RetailBrokerState'] = "";
            }
            if (!empty($value['RetailBrokerCity'])) {
                $finalArray['RetailBrokerCity'] = $value['RetailBrokerCity'];
            } else {
                $finalArray['RetailBrokerCity'] = "";
            }
            $finalArray['Renewable'] = $value['Renewable'];
            if (!empty($value['PolicyType'])) {
                $finalArray['PolicyType'] = $value['PolicyType'];
            } else {
                $finalArray['PolicyType'] = "";
            }
            $finalArray['DirectAssumed'] = $value['DirectAssumed'];
            $finalArray['AdmittedNonAdmitted'] = $value['AdmittedNonAdmitted'];
            $finalArray['CompanyPaper'] = $value['CompanyPaper'];
            $finalArray['CompanyPaperNumber'] = $value['CompanyPaperNumber'];
            $finalArray['PolicyNumber'] = $value['PolicyNumber'];
            $finalArray['Coverage'] = $value['Coverage'];
            $finalArray['Suffix'] = $value['Suffix'];
            $finalArray['TransactionNumber'] = $value['TransactionNumber'];
            $finalArray['NAICCode'] = $value['NAICCode'];
            $finalArray['NAICTitle'] = $value['NAICTitle'];
            $finalArray['SICCode'] = $value['SICCode'];
            $finalArray['SICTitle'] = $value['SICTitle'];
            $finalArray['OFRCAdverseReport'] = $value['OFRCAdverseReport'];
            $finalArray['FinalPolicyNumber'] = $value['FinalPolicyNumber'];
            if (!empty($value['EffectiveDate'])) {
                $finalArray['EffectiveDate'] = date('M-d-Y', strtotime($value['EffectiveDate']));
            } else {
                $finalArray['EffectiveDate'] = "";
            }
            if (!empty($value['ExpiryDate'])) {
                $finalArray['ExpiryDate'] = date('M-d-Y', strtotime($value['ExpiryDate']));
            } else {
                $finalArray['ExpiryDate'] = "";
            }
            if (!empty($value['ExchangeDate'])) {
                $finalArray['ExchangeDate'] = date('M-d-Y', strtotime($value['ExchangeDate']));
            } else {
                $finalArray['ExchangeDate'] = "";
            }
            if (!empty($value['InsuredQuoteDueDate'])) {
                $finalArray['InsuredQuoteDueDate'] = date('M-d-Y', strtotime($value['InsuredQuoteDueDate']));
            } else {
                $finalArray['InsuredQuoteDueDate'] = "";
            }
            if (!empty($value['InsuredSubmissionDate'])) {
                $finalArray['InsuredSubmissionDate'] = date('M-d-Y', strtotime($value['InsuredSubmissionDate']));
            } else {
                $finalArray['InsuredSubmissionDate'] = "";
            }
            if (!empty($value['ProcessDate'])) {
                $finalArray['ProcessDate'] = date('M-d-Y', strtotime($value['ProcessDate']));
            } else {
                $finalArray['ProcessDate'] = "";
            }
            if (!empty($value['BerkSIDateFromBroker'])) {
                $finalArray['BerkSIDateFromBroker'] = date('M-d-Y h:i:s', strtotime($value['BerkSIDateFromBroker']));
            } else {
                $finalArray['BerkSIDateFromBroker'] = "";
            }
            if (!empty($value['BerkSiDateFromIndia'])) {
                $finalArray['BerkSiDateFromIndia'] = date('M-d-Y', strtotime($value['BerkSiDateFromIndia']));
            } else {
                $finalArray['BerkSiDateFromIndia'] = "";
            }
            if (!empty($value['BindDate'])) {
                $finalArray['BindDate'] = date('M-d-Y', strtotime($value['BindDate']));
            } else {
                $finalArray['BindDate'] = "";
            }
            if (!empty($value['DateofRenewal'])) {
                $finalArray['DateofRenewal'] = date('M-d-Y', strtotime($finalArray['DateofRenewal']));
            } else {
                $finalArray['DateofRenewal'] = "";
            }
            $amendmentData[] = $finalArray;
        }
        return $amendmentData;
    }

}
