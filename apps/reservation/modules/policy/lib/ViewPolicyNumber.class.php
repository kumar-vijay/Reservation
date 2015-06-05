<?php

class ViewPolicyNumber {

    public function __construct() {
        $this->connection = Propel::getConnection();
    }

    public static function GetPolicyInfo($policyId) {
        $obj = new CreatePolicyNumber();
        $con = Propel::getConnection();
        $stmt = $con->query("SELECT * FROM PolicyDetails Where Id = $policyId");
        $result = $stmt->fetchAll(PDO::FETCH_OBJ);
        
        $productlineData = $obj->getProductLine($result[0]->ProductLineId);
        $productlineSubTypeData = $obj->getProductLineSubTypeData($result[0]->ProductLineSubTypeId);
        $underwriterData = $obj->getUnderwriter($result[0]->UnderwriterId);
        $regionData = $obj->getRegion($result[0]->RegionId);
        $branchData = $obj->getViewBranchOffice($result[0]->BranchId);
        $directAssumedData = $obj->getLookUpdata($result[0]->DirectAssumedLookupId);
        $admittedData = $obj->getLookUpdata($result[0]->AdmittedNonAdmittedLookupId);
        $admittedDetailsData = $obj->getViewAdmittedDetails($result[0]->AdmittedDetailsId);
        $companyData = $obj->getLookUpdata($result[0]->CompanyLookupId);
        $PolicyCurrencyData = $obj->getLookUpdata($result[0]->PolicyCurrency);
        $prefixData = $obj->getPrefix($result[0]->PrefixId);
        $newrenewalData = $obj->getLookUpdata($result[0]->NewRenewalLookupId);
        
        $viewResult = array();
        $viewResult['MASTER_POLICY_NUMBER'] = $result[0]->MasterPolicyNumber;
        $viewResult['INSURED_NAME'] = $result[0]->InsuredName;
        $viewResult['PRODUCT_LINE'] = $productlineData[0]['ProductLine']; 
        $viewResult['PRODUCT_LINE_SUBTYPE'] = $productlineSubTypeData[0]['ProductLineSubTypeName']; 
        $viewResult['UNDERWRITER'] = $underwriterData[0]['UnderwriterName']; 
        $viewResult['REGION'] = $regionData[0]['RegionName']; 
        $viewResult['BRANCH'] = $branchData[0]['BranchName']; 
        $viewResult['REINSURED_COMPANY'] = $result[0]->ReinsuredCompany;
        $viewResult['REMARKS'] = $result[0]->Remarks;
        $viewResult['DIRECT_ASSUMED'] = $directAssumedData[0]['LookupTypeName'];
        $viewResult['ADMITTED_NONADMITTED'] = $admittedData[0]['LookupTypeName'];
        $viewResult['ADMITTED_DETAILS'] = $admittedDetailsData[0]['Name'];
        $viewResult['COMPANY'] = $companyData[0]['LookupTypeName'];
        $viewResult['COMPANY_NUMBER'] = $result[0]->CompanyNumber;
        $viewResult['PREFIX'] = $prefixData[0]['Name'];
        $viewResult['SUFFIX'] = $result[0]->Suffix;
        $viewResult['NEW_RENEWAL'] = $newrenewalData[0]['LookupTypeName'];
        $viewResult['POLICY_EFFECTIVE_DATE'] = $result[0]->PolicyEffectiveDate;
        $viewResult['POLICY_EXPIRY_DATE'] = $result[0]->PolicyExpiryDate;
        $viewResult['PREMIUM_CURRENCY'] = $PolicyCurrencyData[0]['LookupTypeName'];
        $viewResult['GROSS_PREMIUM'] = $result[0]->InceptionGrossPremium;
        $viewResult['COMMISION_PERCENTAGE'] = $result[0]->CommisssionPercentage;
        $viewResult['COMMISION_DOLLER'] = $result[0]->CommisssionDoller;
        $viewResult['NET_PREMIUM'] = $result[0]->NetPremium;
        return $viewResult;
    }
    
    

}
