<?php

class EditPolicyNumber {

    public function __construct() {
        $this->connection = Propel::getConnection();
    }

    public static function PolicyNumberInfo($policyId) {
        $con = Propel::getConnection();
        $query = "SELECT P.*, D.* FROM PolicyDetails AS P LEFT JOIN DataRecorderMetaData AS D on P.DataRecorderMetaDataId = D.Id  WHERE P.Id = '" . $policyId . "'";
        $stmt = $con->query($query);
        $result = $stmt->fetchAll(PDO::FETCH_ASSOC);
        return $result;
    }

    public static function SavePolicyHistory($newPolicyData, $oldPolicyData, $policyId) {
        $con = Propel::getConnection();
        try {
            $policyHistoryQuery = "INSERT INTO PolicyHistory 
                                    (PolicyId, InsuredName, ProductLineId,ProductLineSubTypeId, UnderwriterId, RegionId, BranchId, ReinsuredCompany, Remarks, DirectAssumedLookupId, AdmittedNonAdmittedLookupId, AdmittedDetailsId, CompanyLookupId, CompanyNumberLookupId, PrefixId, Suffix, NewRenewalLookupId, PolicyEffectiveDate, PolicyExpiryDate,PremiumCurrency, InceptionGrossPremium, CommisssionPercentage, CommisssionDoller, NetPremium, New_InsuredName, New_ProductLineId,New_ProductLineSubTypeId ,New_UnderwriterId, New_RegionId, New_BranchId, New_ReinsuredCompany, New_Remarks, New_DirectAssumedLookupId, New_AdmittedNonAdmittedLookupId, New_AdmittedDetailsId, New_CompanyLookupId, New_CompanyNumberLookupId, New_PrefixId, New_Suffix, New_NewRenewalLookupId, New_PolicyEffectiveDate, New_PolicyExpiryDate, New_PremiumCurrency,New_InceptionGrossPremium, New_CommisssionPercentage, New_CommisssionDoller, New_NetPremium, ModifiedBy, ModifiedOn) 
                                    VALUES 
                                    ('" . $policyId . "','" . $oldPolicyData['InsuredName'] . "', '" . $oldPolicyData['ProductLineId'] . "','" . $oldPolicyData['ProductLineSubTypeId'] . "', '" . $oldPolicyData['UnderwriterId'] . "', '" . $oldPolicyData['RegionId'] . "', '" . $oldPolicyData['BranchId'] . "', '" . $oldPolicyData['ReinsuredCompany'] . "', '" . $oldPolicyData['Remarks'] . "','" . $oldPolicyData['DirectAssumedLookupId'] . "', '" . $oldPolicyData['AdmittedNonAdmittedLookupId'] . "', '" . $oldPolicyData['AdmittedDetailsId'] . "', '" . $oldPolicyData['CompanyLookupId'] . "', '" . $oldPolicyData['CompanyNumber'] . "', '" . $oldPolicyData['PrefixId'] . "', '" . $oldPolicyData['Suffix'] . "', '" . $oldPolicyData['NewRenewalLookupId'] . "', '" . $oldPolicyData['PolicyEffectiveDate'] . "','" . $oldPolicyData['PolicyExpiryDate'] . "','" . $oldPolicyData['PolicyCurrency'] . "', '" . $oldPolicyData['InceptionGrossPremium'] . "', '" . $oldPolicyData['CommisssionPercentage'] . "', '" . $oldPolicyData['CommisssionDoller'] . "','" . $oldPolicyData['NetPremium'] . "', '" . $newPolicyData['editinsuredName'] . "', '" . $newPolicyData['hiddenProductLine'] . "', '" . $newPolicyData['hiddenProductLineSubType'] . "','" . $newPolicyData['hiddenUnderwriter'] . "', '" . $newPolicyData['hiddenRegion'] . "', '" . $newPolicyData['editbranchOffice'] . "', '" . $newPolicyData['editreinsuranceCompany'] . "','" . $newPolicyData['editremarks'] . "', '" . $newPolicyData['editdirectassumed'] . "', '" . $newPolicyData['editadmittedNonAdmitted'] . "', '" . $newPolicyData['editadmittedDetails'] . "', '" . $newPolicyData['editcompnay'] . "', '" . $newPolicyData['editcompnaynumber'] . "', '" . $newPolicyData['hiddennewPrefix'] . "', '" . $newPolicyData['hiddennewSuffix'] . "', '" . $newPolicyData['hiddennewRenewal'] . "', '" . $newPolicyData['editpolicyEffectiveDate'] . "', '" . $newPolicyData['editpolicyExpiryDate'] . "','" . $newPolicyData['editpremiumcurrency'] . "', '" . $newPolicyData['editinceptiongrosspremium'] . "', '" . $newPolicyData['editcomissionpercentage'] . "', '" . $newPolicyData['editcomissiondoller'] . "', '" . $newPolicyData['editnetpremium'] . "', '" . $newPolicyData['userId'] . "', GETDATE())";
            $insertPolicyHistory = $con->prepare($policyHistoryQuery);
            $insertPolicyHistory->execute();
            return true;
        } catch (Exception $e) {
            $errFlag = true;
            $response['msg'][] = "Exception error at updating Policy Number History:" . $e->getMessage() . 'At line number' . __LINE__;
            $response['success'] = false;
        }
    }

    public function UpdatePolicyNumberDetails($postArray, $policyId) {
        try {
            $con = Propel::getConnection();
            $Recorderquery = "UPDATE DataRecorderMetaData SET ModifiedBy = '" . $postArray['userId'] . "', ModifiedOn = GetDate() WHERE Id = '" . $postArray['hiddenDataRecorderMetaId'] . "'";
            $updateRecorderData = $con->prepare($Recorderquery);
            $updateRecorderData->execute();

            $editmasterPolicyNumber = explode('-', $postArray['hiddenMasterPolicyNumber']);
            $policyNumber = $editmasterPolicyNumber[2];
            $Suffix = $editmasterPolicyNumber[3];

            $masterPolicyNumber = $this->UpdatePolicyNumber($postArray, $policyNumber, $Suffix);

            $con->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            $con->beginTransaction();
            $query = "UPDATE PolicyDetails SET MasterPolicyNumber = '" . $masterPolicyNumber . "', InsuredName = '" . $postArray['editinsuredName'] . "', BranchId = '" . $postArray['editbranchOffice'] . "', ReinsuredCompany = '" . $postArray['editreinsuranceCompany'] . "',Remarks = '" . $postArray['editremarks'] . "', DirectAssumedLookupId = '" . $postArray['editdirectassumed'] . "', AdmittedNonAdmittedLookupId = '" . $postArray['editadmittedNonAdmitted'] . "', AdmittedDetailsId = '" . $postArray['editadmittedDetails'] . "', CompanyLookupId = '" . $postArray['editcompnay'] . "', CompanyNumber = '" . $postArray['editcompnaynumber'] . "', PolicyEffectiveDate = '" . $postArray['editpolicyEffectiveDate'] . "', PolicyExpiryDate = '" . $postArray['editpolicyExpiryDate'] . "',PolicyCurrency = '" . $postArray['editpremiumcurrency'] . "', InceptionGrossPremium = '" . $postArray['editinceptiongrosspremium'] . "', CommisssionPercentage = '" . $postArray['editcomissionpercentage'] . "', CommisssionDoller = '" . $postArray['editcomissiondoller'] . "', NetPremium = '" . $postArray['editnetpremium'] . "' Where Id = $policyId";
            $insert = $con->prepare($query);
            $insert->execute();
            $ResponseData = $this->getPolicyNumberAndInsuredName($policyId);
            $response['data'] = $ResponseData;
            $errFlag = false;
            $con->commit();
        } catch (Exception $e) {
            $con->rollBack();
            $errFlag = true;
            $response['msg'][] = "Exception error at updating Policy Number:" . $e->getMessage() . 'At line number' . __LINE__;
            $response['success'] = false;
        }
        if ($errFlag == false) {
            $response['msg'] = 'Saved Successfully';
            $response['success'] = true;
            return $response;
        } else {
            return $response;
        }
    }

    public function UpdatePolicyNumber($Data, $policyNumber, $Suffix) {
        $obj = new CreatePolicyNumber();
        $prefixData = $obj->getPrefixdata($Data['hiddennewPrefix']);

        $companyNumber = $Data['editcompnaynumber'];
        $prefix = $prefixData[0]['Name'];
        $finalPolicyNumber = $companyNumber . '-' . $prefix . '-' . $policyNumber . '-' . $Suffix;
        return $finalPolicyNumber;
    }

    public function GetDatarecorderMetaData($policyId) {
        $con = Propel::getConnection();
        $query = "SELECT D.* FROM PolicyDetails AS P INNER JOIN DataRecorderMetaData AS D on P.DataRecorderMetaDataId = D.Id  WHERE P.Id = '" . $policyId . "'";
        $stmt = $con->query($query);
        $result = $stmt->fetchAll(PDO::FETCH_ASSOC);
        return $result;
    }

    public function getPolicyHistory($policyId) {
        $con = Propel::getConnection();
        $query = "SELECT * FROM PolicyHistory_Search Where PolicyId = '" . $policyId . "' order by Id DESC";
        $stmt = $con->query($query);
        $result = $stmt->fetchAll(PDO::FETCH_ASSOC);
        return $result;
    }
    
    public function getPolicyNumberAndInsuredName($policyId) {
        $con = Propel::getConnection();
        $query = "SELECT * FROM PolicyDetails Where Id = '" . $policyId . "'";
        $stmt = $con->query($query);
        $result = $stmt->fetchAll(PDO::FETCH_ASSOC);
        return $result;
    }

}
