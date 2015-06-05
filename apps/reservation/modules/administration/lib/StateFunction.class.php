<?php

class StateFunction {

    private $_con = NULL;

    public function __construct() {
        $this->_con = Propel::getConnection();
    }

    public function getCountry($countryId = 0) {
        $con = Propel::getConnection();
        if ($countryId == 0) {
            $query = "SELECT * FROM Country";
        } else {
            $query = "SELECT * FROM Country WHERE Id = '" . $countryId . "'";
        }
        $stmt = $con->query($query);
        $result = $stmt->fetchAll();
        return $result;
    }

    public function StateList($input) {
        $criteria = new Criteria();
        $isFilterChoosen = false;
        if ($input['countryName'] != '') {
            $filterCriteria = $criteria->add(StateSearchPeer::COUNTRYNAME, $input['countryName'], Criteria::EQUAL);
            $isFilterChoosen = true;
        }
        if ($input['stateName'] != '') {
            $filterCriteria = $criteria->add(StateSearchPeer::STATENAME, $input['stateName'] . '%', Criteria::LIKE);
            $isFilterChoosen = true;
        }
        if ($isFilterChoosen) {
            $criteria->add($filterCriteria);
        }
        $criteria->addDescendingOrderByColumn(StateSearchPeer::ID);
        return $criteria;
    }

    public function CreateState(array $data) {
        $errFlag = false;
        if (empty($data)) {
            $errFlag = true;
            $response['msg'][] = 'You did not fill the form correctly';
            $response['success'] = false;
        } else {
            if ($errFlag == false) {
                if ($data['stateId'] != NULL) {
                    try {
                        if (empty($data['editbrokerstatecode'])) {
                            $data['editbrokerstatecode'] = null;
                        } else {
                            $data['editbrokerstatecode'] = $data['editbrokerstatecode'];
                        }
                        if (empty($data['editbrokerstatename'])) {
                            $data['editbrokerstatename'] = null;
                        } else {
                            $data['editbrokerstatename'] = $data['editbrokerstatename'];
                        }
                        if (empty($data['editretailbrokerstatename'])) {
                            $data['editretailbrokerstatename'] = null;
                        } else {
                            $data['editretailbrokerstatename'] = $data['editretailbrokerstatename'];
                        }
                        if (empty($data['editabbreviatedbrokerstatename'])) {
                            $data['editabbreviatedbrokerstatename'] = null;
                        } else {
                            $data['editabbreviatedbrokerstatename'] = $data['editabbreviatedbrokerstatename'];
                        }
                        if (empty($data['editprojectstatecode'])) {
                            $data['editprojectstatecode'] = null;
                        } else {
                            $data['editprojectstatecode'] = $data['editprojectstatecode'];
                        }
                        if (empty($data['editprojectstatename'])) {
                            $data['editprojectstatename'] = null;
                        } else {
                            $data['editprojectstatename'] = $data['editprojectstatename'];
                        }
                        $con = Propel::getConnection();
                        $Recorderquery = "UPDATE DataRecorderMetaData SET ModifiedBy = '" . $data['userId'] . "', ModifiedOn = GetDate() WHERE Id = '" . $data['editDataRecorderIdHidden'] . "'";
                        $updateRecorderData = $con->prepare($Recorderquery);
                        $updateRecorderData->execute();
                        if (trim($data['editstateCodeHidden']) != trim($data['editbrokerstatecode'])) {
                            $isStateCode = self::isStateCodeExists(trim($data['editbrokerstatecode']));
                        }
                        if (trim($data['editprojectCodeHidden']) != trim($data['editprojectstatecode'])) {
                            $isProjectStateCode = self::isProjectStateExists(trim($data['editprojectstatecode']));
                        }
                        if ($isStateCode == '0' || empty($isStateCode)) {
                            if ($isProjectStateCode == '0' || empty($isProjectStateCode)) {
                                $countryQuery = "UPDATE State SET Code = '" . $data['editbrokerstatecode'] . "', StateCode = '" . $data['editabbreviatedbrokerstatename'] . "',FullCode = '" . $data['editbrokerstatename'] . "',ProjectCode = '" . $data['editprojectstatename'] . "',RetailBrokerState = '" . $data['editretailbrokerstatename'] . "',ProjectStateCode = '" . $data['editprojectstatecode'] . "' WHERE Id = '" . $data['stateId'] . "'";
                                $updateCountryData = $con->prepare($countryQuery);
                                $updateCountryData->execute();
                            } else {
                                $errFlag = true;
                                $response['msg'][] = 'Project State Code already exists';
                                $response['success'] = false;
                            }
                        } else {
                            $errFlag = true;
                            $response['msg'][] = 'Broker State Code already exists';
                            $response['success'] = false;
                        }
                    } catch (Exception $e) {
                        $errFlag = true;
                        $response['msg'][] = "Exception error at updating state:" . $e->getMessage();
                        $response['success'] = false;
                    }
                } else {
                    $con = Propel::getConnection();
                    try {
                        $dataRecorderQuery = "INSERT INTO DataRecorderMetaData 
                             (CreatedBy,CreatedOn) 
                             VALUES 
                             ('" . $data['userId'] . "', GetDate())";
                        $insertData = $con->prepare($dataRecorderQuery);
                        if ($insertData->execute()) {
                            $STH1 = $con->query("SELECT CAST(COALESCE(SCOPE_IDENTITY(), @@IDENTITY) AS int)");
                            $STH1->execute();
                            $resultData = $STH1->fetch();
                            $dataRecorderId = $resultData[0];
                        } else {
                            throw new PropelException();
                        }
                        if (!empty($data['countryname'])) {
                            $data['countryname'] = $data['countryname'];
                        } else {
                            $data['countryname'] = null;
                        }
                        if (!empty($data['statename'])) {
                            $data['statename'] = str_replace("'", "''", $data['statename']);
                        } else {
                            $data['statename'] = null;
                        }
                        if (!empty($data['brokerstatecode'])) {
                            $data['brokerstatecode'] = str_replace("'", "''", $data['brokerstatecode']);
                        } else {
                            $data['brokerstatecode'] = null;
                        }
                        if (!empty($data['brokerstatename'])) {
                            $data['brokerstatename'] = str_replace("'", "''", $data['brokerstatename']);
                        } else {
                            $data['brokerstatename'] = null;
                        }
                        if (!empty($data['retailbrokerstatename'])) {
                            $data['retailbrokerstatename'] = str_replace("'", "''", $data['retailbrokerstatename']);
                        } else {
                            $data['retailbrokerstatename'] = null;
                        }
                        if (!empty($data['abbreviation'])) {
                            $data['abbreviation'] = str_replace("'", "''", $data['abbreviation']);
                        } else {
                            $data['abbreviation'] = null;
                        }
                        if (!empty($data['abbreviatedbrokerstatename'])) {
                            $data['abbreviatedbrokerstatename'] = str_replace("'", "''", $data['abbreviatedbrokerstatename']);
                        } else {
                            $data['abbreviatedbrokerstatename'] = null;
                        }
                        if (!empty($data['projectstatecode'])) {
                            $data['projectstatecode'] = str_replace("'", "''", $data['projectstatecode']);
                        } else {
                            $data['projectstatecode'] = null;
                        }
                        if (!empty($data['projectstatename'])) {
                            $data['projectstatename'] = str_replace("'", "''", $data['projectstatename']);
                        } else {
                            $data['projectstatename'] = null;
                        }
                        $isStateCode = self::isStateCodeExists(trim($data['brokerstatecode']));
                        $isAbbreviation = self::isStateAbbreviationExists(trim($data['abbreviation']));
                        $isState = self::isStateExists($data['countryname'], strtolower(trim($data['statename'])));
                        $isProjectStateCode = self::isProjectStateExists(trim($data['projectstatecode']));
                        if ($isStateCode == '0') {
                            if ($isAbbreviation == '0') {
                                if ($isProjectStateCode == '0') {
                                    if ($isState == '0') {
                                        $stateQuery = "INSERT INTO State 
                                    (CountryId,StateName,Code,Abreviation,StateCode,FullCode,ProjectCode,RetailBrokerState,ProjectStateCode,DataRecorderMetaDataId) 
                                    VALUES 
                                    ('" . $data['countryname'] . "', '" . $data['statename'] . "', '" . $data['brokerstatecode'] . "', '" . $data['abbreviation'] . "', '" . $data['abbreviatedbrokerstatename'] . "', '" . $data['brokerstatename'] . "', '" . $data['projectstatename'] . "', '" . $data['retailbrokerstatename'] . "', '" . $data['projectstatecode'] . "', '" . $dataRecorderId . "')";
                                        $insertstate = $con->prepare($stateQuery);
                                        $insertstate->execute();
                                    } else {
                                        $errFlag = true;
                                        $response['msg'][] = 'State Name already exists';
                                        $response['success'] = false;
                                    }
                                } else {
                                    $errFlag = true;
                                    $response['msg'][] = 'Project State Code already exists';
                                    $response['success'] = false;
                                }
                            } else {
                                $errFlag = true;
                                $response['msg'][] = 'State Abbreviation already exists';
                                $response['success'] = false;
                            }
                        } else {
                            $errFlag = true;
                            $response['msg'][] = 'Broker State Code already exists';
                            $response['success'] = false;
                        }
                    } catch (Exception $e) {
                        $errFlag = true;
                        $response['msg'][] = "Exception error at creating State:" . $e->getMessage() . 'At line number' . __LINE__;
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

    public static function isStateExists($countryName, $stateName) {
        $con = Propel::getConnection();
        $query = "SELECT * FROM State WHERE CountryId = '" . $countryName . "' AND StateName = '" . $stateName . "'";
        $stmt = $con->query($query);
        $result = $stmt->fetchAll();
        if (count($result) > 0) {
            return TRUE;
        } else {
            return FALSE;
        }
    }

    public static function isStateCodeExists($stateCode) {
        $con = Propel::getConnection();
        $query = "SELECT * FROM State WHERE Code = '" . $stateCode . "'";
        $stmt = $con->query($query);
        $result = $stmt->fetchAll();
        if (count($result) > 0) {
            return TRUE;
        } else {
            return FALSE;
        }
    }

    public static function isStateAbbreviationExists($stateAbbreviation) {
        $con = Propel::getConnection();
        $query = "SELECT * FROM State WHERE Abreviation = '" . $stateAbbreviation . "'";
        $stmt = $con->query($query);
        $result = $stmt->fetchAll();
        if (count($result) > 0) {
            return TRUE;
        } else {
            return FALSE;
        }
    }

    public static function isProjectStateExists($projectStateCode) {
        $con = Propel::getConnection();
        $query = "SELECT * FROM State WHERE ProjectStateCode = '" . $projectStateCode . "'";
        $stmt = $con->query($query);
        $result = $stmt->fetchAll();
        if (count($result) > 0) {
            return TRUE;
        } else {
            return FALSE;
        }
    }

    public function StateInfo($stateId = 0) {
        $con = Propel::getConnection();
        if ($stateId == 0) {
            $query = "SELECT * FROM State";
        } else {
            $query = "SELECT * FROM State WHERE Id = '" . $stateId . "'";
        }
        $stmt = $con->query($query);
        $result = $stmt->fetchAll(PDO::FETCH_ASSOC);
        return $result;
    }

    public static function getPostContent() {
        return trim(file_get_contents("php://input"));
    }

}
