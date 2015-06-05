<?php

class CreatePolicyNumber {

    public function __construct() {
        $this->connection = Propel::getConnection();
    }

    public function getProductLine($where = 0) {
        $con = Propel::getConnection();
        if ($where == 0) {
            $query = "SELECT * from Policy_ProductLine";
        } else {
            $query = "SELECT * from Policy_ProductLine WHERE Id = '$where'";
        }
        $stmt = $con->query($query);
        $result = $stmt->fetchAll();
        return $result;
    }
    
    public function getProductLineSubTypeData($productlinesubType = 0) {
        $con = Propel::getConnection();
        if ($productlinesubType == 0) {
            $query = "SELECT * from Policy_ProductLineSubType";
        } else {
            $query = "SELECT * from Policy_ProductLineSubType WHERE Id = '$productlinesubType' order by ProductLineSubTypeName ASC";
        }
        $stmt = $con->query($query);
        $result = $stmt->fetchAll(PDO::FETCH_ASSOC);
        return $result;
    }

    public function getUnderwriter($where = 0) {
        $con = Propel::getConnection();
        if ($where == 0) {
            $query = "SELECT * from Policy_Underwriter";
        } else {
            $query = "SELECT * from Policy_Underwriter WHERE Id = '$where'";
        }
        $stmt = $con->query($query);
        $result = $stmt->fetchAll();
        return $result;
    }

    public function getRegion($where = 0) {
        $con = Propel::getConnection();
        if ($where == 0) {
            $query = "SELECT * from Policy_Region";
        } else {
            $query = "SELECT * from Policy_Region WHERE Id = '$where'";
        }
        $stmt = $con->query($query);
        $result = $stmt->fetchAll();
        return $result;
    }

    public function getBranchOffice($where = 0) {
        $con = Propel::getConnection();
        if ($where == 0) {
            $query = "SELECT * from Policy_Branch order by BranchName ASC";
        } else {
            $query = "SELECT * from Policy_Branch WHERE RegionId = '$where' order by BranchName ASC";
        }
        $stmt = $con->query($query);
        $result = $stmt->fetchAll();
        return $result;
    }

    public function getProductLineByRegion($where = 0) {
        $con = Propel::getConnection();
        if ($where == 0) {
            $query = "SELECT * from Policy_ProductLine order by ProductLine ASC";
        } else {
            $query = "SELECT * from Policy_ProductLine WHERE RegionId = '$where' order by ProductLine ASC";
        }
        $stmt = $con->query($query);
        $result = $stmt->fetchAll();
        return $result;
    }

    public function getUnderwriterByRegion($where = 0) {
        $con = Propel::getConnection();
        if ($where == 0) {
            $query = "SELECT * from Policy_Underwriter order by UnderwriterName ASC";
        } else {
            $query = "SELECT * from Policy_Underwriter WHERE RegionId = '$where' order by UnderwriterName ASC";
        }
        $stmt = $con->query($query);
        $result = $stmt->fetchAll();
        return $result;
    }

    public function getViewBranchOffice($where = 0) {
        $con = Propel::getConnection();
        if ($where == 0) {
            $query = "SELECT * from Policy_Branch";
        } else {
            $query = "SELECT * from Policy_Branch WHERE Id = '$where'";
        }
        $stmt = $con->query($query);
        $result = $stmt->fetchAll();
        return $result;
    }

    public function getLookUpTypeList($where) {
        $con = Propel::getConnection();
        $query = "SELECT L.Id, L.LookupTypeName, L.Alias FROM  Policy_LookupType as LT INNER JOIN Policy_Lookup as L ON LT.Id = L.LookupTypeId WHERE LT.LookupTypeName = '$where'";
        $stmt = $con->query($query);
        $result = $stmt->fetchAll();
        return $result;
    }

    public function getPrefix($where = 0) {
        $con = Propel::getConnection();
        if ($where == 0) {
            $query = "SELECT * from Policy_Prefix order by Name ASC";
        } else {
            $query = "SELECT * from Policy_Prefix WHERE Id = '$where'order by Name ASC";
        }
        $stmt = $con->query($query);
        $result = $stmt->fetchAll();
        return $result;
    }

    public function getAdmittedDetails($where = 0) {
        $con = Propel::getConnection();
        if ($where == 0) {
            $query = "SELECT * from Policy_AdmittedDetails";
        } else {
            $query = "SELECT * from Policy_AdmittedDetails WHERE AdmittedLookupId = '$where'";
        }
        $stmt = $con->query($query);
        $result = $stmt->fetchAll();
        return $result;
    }

    public function getViewAdmittedDetails($where = 0) {
        $con = Propel::getConnection();
        if ($where == 0) {
            $query = "SELECT * from Policy_AdmittedDetails";
        } else {
            $query = "SELECT * from Policy_AdmittedDetails WHERE Id = '$where'";
        }
        $stmt = $con->query($query);
        $result = $stmt->fetchAll();
        return $result;
    }

    public function PolicyNumberList($input) {
        $criteria = new Criteria();
        $isFilterChoosen = false;
        if ($input['insuredName'] != '') {
            $filterCriteria = $criteria->add(PolicySearchPeer::INSUREDNAME, $input['insuredName'] . '%', Criteria::LIKE);
            $isFilterChoosen = true;
        }
        if ($input['masterpolicynumber'] != '') {
            $filterCriteria = $criteria->add(PolicySearchPeer::MASTERPOLICYNUMBER, $input['masterpolicynumber'], Criteria::EQUAL);
            $isFilterChoosen = true;
        }
        if ($input['policynumber'] != '') {
            $filterCriteria = $criteria->add(PolicySearchPeer::ID, ltrim($input['policynumber'], "0"), Criteria::EQUAL);
            $isFilterChoosen = true;
        }
        if ($input['underwriter'] != '') {
            if ($input['underwriter'] != '0') {
                $filterCriteria = $criteria->add(PolicySearchPeer::UNDERWRITERNAME, trim($input['underwriter']), Criteria::EQUAL);
                $isFilterChoosen = true;
            }
        }
        if ($isFilterChoosen) {
            $criteria->add($filterCriteria);
        }
        $criteria->addDescendingOrderByColumn(PolicySearchPeer::ID);
        return $criteria;
    }

    public function CreatePolicyNumberDetails(array $data) {
        $errFlag = false;
        if (empty($data)) {
            $errFlag = true;
            $response['msg'][] = 'You did not fill the form correctly';
            $response['success'] = false;
        } else {
            $con = Propel::getConnection();
            try {
                $dataRecorderQuery = "INSERT INTO DataRecorderMetaData 
                             (CreatedBy,CreatedOn) 
                             VALUES 
                             ('" . $data['userId'] . "', GETDATE())";
                $insertData = $con->prepare($dataRecorderQuery);
                if ($insertData->execute()) {
                    $STH1 = $con->query("SELECT CAST(COALESCE(SCOPE_IDENTITY(), @@IDENTITY) AS int)");
                    $STH1->execute();
                    $resultData = $STH1->fetch();
                    $dataRecorderId = $resultData[0];
                } else {
                    throw new PropelException();
                }
                if (!empty($data['insuredName'])) {
                    $data['insuredName'] = str_replace("'", "''", $data['insuredName']);
                } else {
                    $data['insuredName'] = null;
                }
                if (!empty($data['remarks'])) {
                    $data['remarks'] = $data['remarks'];
                } else {
                    $data['remarks'] = null;
                }
                if (!empty($data['reinsuranceCompany'])) {
                    $data['reinsuranceCompany'] = $data['reinsuranceCompany'];
                } else {
                    $data['reinsuranceCompany'] = null;
                }
                if (!empty($data['policyEffectiveDate'])) {
                    $data['policyEffectiveDate'] = date("Y-m-d H:i:s", strtotime($data['policyEffectiveDate']));
                }
                if (!empty($data['policyExpiryDate'])) {
                    $data['policyExpiryDate'] = date("Y-m-d H:i:s", strtotime($data['policyExpiryDate']));
                }
                $newRenewalData = $this->getLookUpTypeList('NewRenewal');
                $newRenewal = $newRenewalData[0][Id];
                $finalPolicyNumber = $this->CreatePolicyNumber($data);
                $con->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
                $con->beginTransaction();
                $policyQuery = "INSERT INTO PolicyDetails 
                                    (MasterPolicyNumber, InsuredName, ProductLineId,ProductLineSubTypeId, UnderwriterId, RegionId, BranchId, ReinsuredCompany, Remarks,DirectAssumedLookupId, AdmittedNonAdmittedLookupId, AdmittedDetailsId, CompanyLookupId, CompanyNumber, PrefixId, Suffix, NewRenewalLookupId, PolicyEffectiveDate, PolicyExpiryDate, PolicyCurrency,InceptionGrossPremium, CommisssionPercentage, CommisssionDoller, NetPremium, DataRecorderMetaDataId) 
                                    VALUES 
                                    ('" . $finalPolicyNumber . "', '" . $data['insuredName'] . "','" . $data['producttype'] . "','" . $data['productsubtype'] . "', '" . $data['underwriter'] . "', '" . $data['region'] . "', '" . $data['branchOffice'] . "', '" . $data['reinsuranceCompany'] . "', '" . $data['remarks'] . "', '" . $data['directassumed'] . "','" . $data['admittedNonAdmitted'] . "', '" . $data['admittedDetails'] . "', '" . $data['compnay'] . "', '" . $data['compnaynumber'] . "', '" . $data['prefix'] . "', '01', '" . $newRenewal . "', '" . $data['policyEffectiveDate'] . "', '" . $data['policyExpiryDate'] . "','" . $data['premiumcurrency'] . "','" . $data['inceptiongrosspremium'] . "', '" . $data['comissionpercentage'] . "', '" . $data['comissiondoller'] . "', '" . $data['netpremium'] . "','" . $dataRecorderId . "')";
                $insertPolicy = $con->prepare($policyQuery);
                if ($insertPolicy->execute()) {
                    $STH = $con->query("SELECT CAST(COALESCE(SCOPE_IDENTITY(), @@IDENTITY) AS int)");
                    $STH->execute();
                    $result = $STH->fetch();
                    $policyId = $result[0];
                }
                $editObj = new EditPolicyNumber();
                $responseData = $editObj->getPolicyNumberAndInsuredName($policyId);
                $con->commit();
                $response['data'] = $responseData;
            } catch (Exception $e) {
                $con->rollBack();
                $errFlag = true;
                $response['msg'][] = "Exception error at creating Policy Number:" . $e->getMessage() . 'At line number' . __LINE__;
                $response['success'] = false;
            }
        }
        if ($errFlag == false) {
            $response['msg'] = 'Saved Successfully';
            $response['success'] = true;
            return $response;
        } else {
            return $response;
        }
    }

    public function CreatePolicyNumber($Data) {
        $prefixData = $this->getPrefixdata($Data['prefix']);

        $companyNumber = $Data['compnaynumber'];
        $prefix = $prefixData[0]['Name'];
        $con = Propel::getConnection();
        $stmt = $con->query("SELECT REPLACE(STR(CONVERT(VARCHAR(6),(SELECT MAX(Id) FROM PolicyDetails)+1), 6),SPACE(1),'0')+ '-' +REPLACE(STR(CONVERT(VARCHAR(2),01), 2),SPACE(1),'0') AS PolicyNumber");
        $data = $stmt->fetch(PDO::FETCH_OBJ);
        $finalPolicyNumber = $companyNumber . '-' . $prefix . '-' . $data->PolicyNumber;
        return $finalPolicyNumber;
    }

    public function getLookUpdata($lookupId) {
        $con = Propel::getConnection();
        $query = "SELECT * FROM Policy_Lookup WHERE Id = '" . $lookupId . "'";
        $stmt = $con->query($query);
        $result = $stmt->fetchAll();
        return $result;
    }

    public function getPrefixdata($prefixId) {
        $con = Propel::getConnection();
        $query = "SELECT * FROM Policy_Prefix WHERE Id = '" . $prefixId . "'";
        $stmt = $con->query($query);
        $result = $stmt->fetchAll();
        return $result;
    }

    public static function getPostContent() {
        return trim(file_get_contents("php://input"));
    }

    public function getCompanyNumber($where = 0) {
        $con = Propel::getConnection();
        if ($where == 0) {
            $query = "SELECT * from Policy_CompanyNumber";
        } else {
            $query = "SELECT * from Policy_CompanyNumber WHERE CompanyLookupId = '$where'";
        }
        $stmt = $con->query($query);
        $result = $stmt->fetchAll(PDO::FETCH_ASSOC);
        return $result;
    }

    public function getPrefixByRegionAndProductLine($productline = 0, $region) {
        $con = Propel::getConnection();
        if ($productline == 0) {
            $query = "SELECT * from Policy_Prefix";
        } else {
            $query = "SELECT * from Policy_Prefix WHERE RegionId = '$region' AND ProductLineSubTypeId = '$productline'";
        }
        $stmt = $con->query($query);
        $result = $stmt->fetchAll(PDO::FETCH_ASSOC);
        return $result;
    }
    
    public function getProductLineSubType($productline = 0) {
        $con = Propel::getConnection();
        if ($productline == 0) {
            $query = "SELECT * from Policy_ProductLineSubType";
        } else {
            $query = "SELECT * from Policy_ProductLineSubType WHERE ProductLineId = '$productline' order by ProductLineSubTypeName ASC";
        }
        $stmt = $con->query($query);
        $result = $stmt->fetchAll(PDO::FETCH_ASSOC);
        return $result;
    }

}
