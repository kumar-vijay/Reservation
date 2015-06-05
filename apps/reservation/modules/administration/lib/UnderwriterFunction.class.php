<?php

class UnderwriterFunction {

    private $_con = NULL;

    public function __construct() {
        $this->_con = Propel::getConnection();
    }

    public function getBranchOffice($where = 0) {
        $con = Propel::getConnection();
        if ($where == 0) {
            $query = "SELECT * from Branch";
        } else {
            $query = "SELECT * from Branch WHERE Id = '$where'";
        }
        $stmt = $con->query($query);
        $result = $stmt->fetchAll();
        return $result;
    }

    public function getLob($where = 0) {
        $con = Propel::getConnection();
        if ($where == 0) {
            $query = "SELECT * from Lob WHERE LOBName != 'Dummy Product Line'";
        } else {
            $query = "SELECT * from Lob WHERE Id = '$where' AND LOBName != 'Dummy Product Line'";
        }
        $stmt = $con->query($query);
        $result = $stmt->fetchAll();
        return $result;
    }
    
    public function getLobSubTypeByName($where = 0) {
        $con = Propel::getConnection();
        $query = "Select LS.Id from LOBSubType AS LS Left Join LOB AS L on L.Id = LS.LOBId Where L.LOBName = 'Exec & Prof' AND ProductLineSubType = '$where'";
        $stmt = $con->query($query);
        $result = $stmt->fetchAll();
        return $result;
    }
    
    public function getLobSubTypeForExecutiveProf($where = 0) {
        $con = Propel::getConnection();
        if ($where == 0) {
            $query = "Select LS.* from LOBSubType AS LS Left Join LOB AS L on L.Id = LS.LOBId Where L.LOBName = 'Exec & Prof' AND LS.ProductLineSubType !='Not Available' AND LS.ProductLineSubType !='Not Applicable'";
        } else {
            $query = "SELECT * from Lob WHERE Id = '$where' AND LOBName != 'Dummy Product Line'";
        }
        $stmt = $con->query($query);
        $result = $stmt->fetchAll();
        return $result;
    }

    public function UnderwriterList($input) {
        $criteria = new Criteria();
        $isFilterChoosen = false;
        if ($input['underwriterName'] != '') {
            $filterCriteria = $criteria->add(UnderwriterSearchPeer::UNDERWRITERNAME, $input['underwriterName'].'%', Criteria::LIKE);
            $isFilterChoosen = true;
        }
        if ($input['branchOffice'] != '') {
            if ($input['branchOffice'] != '0') {
                $filterCriteria = $criteria->add(UnderwriterSearchPeer::BRANCHOFFICE, trim($input['branchOffice']), Criteria::EQUAL);
                $isFilterChoosen = true;
            }
        }
        if ($input['productLine'] != '') {
            if ($input['productLine'] != '0') {
                $filterCriteria = $criteria->add(UnderwriterSearchPeer::PRODUCTLINE, trim($input['productLine']), Criteria::EQUAL);
                $isFilterChoosen = true;
            }
        }
        if ($isFilterChoosen) {
            $criteria->add($filterCriteria);
        }
        $criteria->addDescendingOrderByColumn(UnderwriterSearchPeer::ID);
        return $criteria;
    }

    public function CreateUnderwriter(array $data) {
        $errFlag = false;
        if (empty($data)) {
            $errFlag = true;
            $response['msg'][] = 'You did not fill the form correctly';
            $response['success'] = false;
        } else {
            if ($errFlag == false) {
                if ($data['underwriterId'] != NULL) {
                    try {
                        if (empty($data['editunderwritername'])) {
                            $data['editunderwritername'] = null;
                        } else {
                            $data['editunderwritername'] = str_replace("'", "''", $data['editunderwritername']);
                        }
                        if (empty($data['editbranchoffice'])) {
                            $data['editbranchoffice'] = null;
                        } else {
                            $data['editbranchoffice'] = $data['editbranchoffice'];
                        }
                        if (empty($data['editproductline'])) {
                            $data['editproductline'] = null;
                        } else {
                            $data['editproductline'] = $data['editproductline'];
                        }
                        if (empty($data['editlobsubtype'])) {
                            $data['editlobsubtype'] = null;
                        } else {
                            $data['editlobsubtype'] = $data['editlobsubtype'];
                        }
                        $con = Propel::getConnection();
                        $Recorderquery = "UPDATE DataRecorderMetaData SET ModifiedBy = '" . $data['userId'] . "', ModifiedOn = GETDATE() WHERE Id = '" . $data['editDataRecorderIdHidden'] . "'";
                        $updateRecorderData = $con->prepare($Recorderquery);
                        $updateRecorderData->execute();

                        $underwriterQuery = "UPDATE Underwriter SET Name = '" . $data['editunderwritername'] . "', BranchId = '" . $data['editbranchoffice'] . "', LOBId = '" . $data['editproductline'] . "', LOBSubTypeId = '".$data['editlobsubtype']."' WHERE Id = '" . $data['underwriterId'] . "'";
                        $updateunderwriterData = $con->prepare($underwriterQuery);
                        $updateunderwriterData->execute();
                    } catch (Exception $e) {
                        $errFlag = true;
                        $response['msg'][] = "Exception error at updating underwriter:" . $e->getMessage();
                        $response['success'] = false;
                    }
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
                        if (!empty($data['underwriter'])) {
                            $data['underwriter'] = str_replace("'", "''", $data['underwriter']);
                        } else {
                            $data['underwriter'] = null;
                        }
                        if (!empty($data['branchoffice'])) {
                            $data['branchoffice'] = $data['branchoffice'];
                        } else {
                            $data['branchoffice'] = null;
                        }
                        if (!empty($data['productline'])) {
                            $data['productline'] = $data['productline'];
                        } else {
                            $data['productline'] = null;
                        }
                        if (!empty($data['productLineSubType'])) {
                            $data['productLineSubType'] = $data['productLineSubType'];
                        } else {
                            $data['productLineSubType'] = null;
                        }
                        $isUnderwriter = self::isUnderwriterExists(strtolower(trim($data['underwriter'])));
                        if ($isUnderwriter == '0') {
                            $underwriterQuery = "INSERT INTO Underwriter 
                                    (Name, BranchId, LOBId, LOBSubTypeId, DataRecorderMetaDataId) 
                                    VALUES 
                                    ('" . $data['underwriter'] . "', '" . $data['branchoffice'] . "','" . $data['productline'] . "', '".$data['productLineSubType']."', '" . $dataRecorderId . "')";
                            $insertUnderwriter = $con->prepare($underwriterQuery);
                            $insertUnderwriter->execute();
                        } else {
                            $errFlag = true;
                            $response['msg'][] = 'Underwriter Name already exists';
                            $response['success'] = false;
                        }
                    } catch (Exception $e) {
                        $errFlag = true;
                        $response['msg'][] = "Exception error at creating underwriter:" . $e->getMessage() . 'At line number' . __LINE__;
                        $response['success'] = false;
                    }
                }
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

    public static function isUnderwriterExists($underwriterName) {
        $con = Propel::getConnection();
        $query = "SELECT * FROM Underwriter WHERE Name = '" . $underwriterName . "'";
        $stmt = $con->query($query);
        $result = $stmt->fetchAll();
        if (count($result) > 0) {
            return TRUE;
        } else {
            return FALSE;
        }
    }

    public function UnderwriterInfo($underwriterId) {
        $con = Propel::getConnection();
        $query = "SELECT * FROM Underwriter WHERE Id = '" . $underwriterId . "'";
        $stmt = $con->query($query);
        $result = $stmt->fetchAll();
        return $result;
    }
    
    public function lobSubTypeById($id){
        $con = Propel::getConnection();
        $query = "SELECT * FROM LobSubType WHERE Id = '" . $id . "'";
        $stmt = $con->query($query);
        $result = $stmt->fetchAll();
        return $result;
    }

    public static function getPostContent() {
        return trim(file_get_contents("php://input"));
    }

}
