<?php

class BrokerFunctions {

    private $_con = NULL;

    public function __construct() {
        $this->_con = Propel::getConnection();
    }

    public function getLookUpTypeList($where) {
        $con = Propel::getConnection();
        $query = "SELECT L.Id, L.LookupName, L.Alias FROM  LookupType as LT INNER JOIN Lookup as L ON LT.Id = L.LookupTypeId WHERE L.LookupName != 'Unknown' AND LT.LookupTypeName = '$where'";
        $stmt = $con->query($query);
        $result = $stmt->fetchAll();
        return $result;
    }

    public function brokerList($input) {
        $criteria = new Criteria();
        $isFilterChoosen = false;
        if ($input['brokerName'] != '') {
            $filterCriteria = $criteria->add(BrokerSearchPeer::BROKERNAME, $input['brokerName'], Criteria::EQUAL);
            $isFilterChoosen = true;
        }
        if ($input['brokerType'] != '') {
            if ($input['brokerType'] != '0') {
                $filterCriteria = $criteria->add(BrokerSearchPeer::BROKERTYPE, trim($input['brokerType']), Criteria::EQUAL);
                $isFilterChoosen = true;
            }
        }
        if ($input['brokerCode'] != '') {
            $filterCriteria = $criteria->add(BrokerSearchPeer::BROKERCODE, trim($input['brokerCode']), Criteria::EQUAL);
            $isFilterChoosen = true;
        }
        if ($input['brokerCountry'] != '') {
            $filterCriteria = $criteria->add(BrokerSearchPeer::BROKERCOUNTRY, trim($input['brokerCountry']), Criteria::EQUAL);
            $isFilterChoosen = true;
        }
        if ($input['brokerState'] != '') {
            if ($input['brokerState'] != '0') {
                $filterCriteria = $criteria->add(BrokerSearchPeer::BROKERSTATE, trim($input['brokerState']), Criteria::EQUAL);
                $isFilterChoosen = true;
            }
        }
        if ($input['brokerCity'] != '') {
            if ($input['brokerCity'] != '0') {
                $filterCriteria = $criteria->add(BrokerSearchPeer::BROKERCITY, trim($input['brokerCity']), Criteria::EQUAL);
                $isFilterChoosen = true;
            }
        }
        if ($isFilterChoosen) {
            $criteria->add($filterCriteria);
        }
        $criteria->addDescendingOrderByColumn(BrokerSearchPeer::ID);
        return $criteria;
    }

    public function CreateBroker(array $data) {
        $errFlag = false;

        if (empty($data)) {
            $errFlag = true;
            $response['msg'][] = 'You did not fill the form correctly';
            $response['success'] = false;
        } else {
            $errFlag = false;
            if ($data['brokerId'] == '' && !isset($data['brokerId'])) {
                $isBrokerExist = self::isBrokerNameExists(strtolower(trim($data['brokername'])));
                if ($isBrokerExist == 'FALSE') {
                    if (self::isBrokerCodeExists(strtolower(trim($data['brokercode'])))) {
                        $errFlag = true;
                        $response['msg'][] = 'Entered Broker 5 Digit Code all ready exists for another broker';
                        $response['success'] = false;
                    }
                }
            } else if (isset($data['brokerId']) && $data['brokerId'] != '') {
                if (self::isBrokerCodeExists(strtolower(trim($data['editbrokercode'])))) {
                    $errFlag = true;
                    $response['msg'][] = 'Entered Broker 5 Digit Code all ready exists for another broker';
                    $response['success'] = false;
                }
            }
            if ($errFlag == false) {
                if ($data['brokerId'] != NULL) {
                    try {
                        if (empty($data['editbrokername'])) {
                            $data['editbrokername'] = null;
                        } else {
                            $data['editbrokername'] = str_replace("'", "''", $data['editbrokername']);
                        }
                        if (empty($data['editbrokertype'])) {
                            $data['editbrokertype'] = null;
                        } else {
                            $data['editbrokertype'] = $data['editbrokertype'];
                        }
                        if (empty($data['editbrokersubtype'])) {
                            $data['editbrokersubtype'] = null;
                        } else {
                            $data['editbrokersubtype'] = $data['editbrokersubtype'];
                        }
                        if (empty($data['editbrokercountry'])) {
                            $data['editbrokercountry'] = null;
                        } else {
                            $data['editbrokercountry'] = $data['editbrokercountry'];
                        }
                        if (empty($data['editbrokerstate'])) {
                            $data['editbrokerstate'] = null;
                        } else {
                            $data['editbrokerstate'] = $data['editbrokerstate'];
                        }
                        if (empty($data['editbrokercity'])) {
                            $data['editbrokercity'] = null;
                        } else {
                            $data['editbrokercity'] = $data['editbrokercity'];
                        }
                        if (empty($data['editaddressline1'])) {
                            $data['editaddressline1'] = null;
                        } else {
                            $data['editaddressline1'] = str_replace("'", "''", $data['editaddressline1']);
                        }
                        if (empty($data['editaddressline2'])) {
                            $data['editaddressline2'] = null;
                        } else {
                            $data['editaddressline2'] = str_replace("'", "''", $data['editaddressline2']);
                        }
                        if (empty($data['editbrokerzipcode'])) {
                            $data['editbrokerzipcode'] = null;
                        } else {
                            $data['editbrokerzipcode'] = $data['editbrokerzipcode'];
                        }
                        if (empty($data['editbrokercode'])) {
                            $data['editbrokercode'] = null;
                        } else {
                            $data['editbrokercode'] = $data['editbrokercode'];
                        }
                        $brokerId = $this->GetBrokerId($data['brokerId']);
                        $con = Propel::getConnection();
                        $Recorderquery = "UPDATE DataRecorderMetaData SET ModifiedBy = '" . $data['userId'] . "', ModifiedOn = GetDate() WHERE Id = '" . $data['editDataRecorderIdHidden'] . "'";
                        $updateRecorderData = $con->prepare($Recorderquery);
                        $updateRecorderData->execute();

                        $brokerQuery = "UPDATE Broker SET BrokerName = '" . $data['editbrokername'] . "', BrokerTypeId = '" . $data['editbrokertype'] . "', BrokerCode = '" . $data['editbrokercode'] . "', Status = '" . $data['editbrokersubtype'] . "', PartyId = 97 WHERE Id = '" . $brokerId . "'";
                        $updateBrokerData = $con->prepare($brokerQuery);
                        $updateBrokerData->execute();

                        $brokerWiseQuery = "UPDATE BrokerWiseCity set CityId = '" . $data['editbrokercity'] . "', StateId = '" . $data['editbrokerstate'] . "', CountryId = '" . $data['editbrokercountry'] . "' , AddressLine1 = '" . $data['editaddressline1'] . "', AddressLine2 = '" . $data['editaddressline2'] . "', ZipCode = '" . $data['editbrokerzipcode'] . "' WHERE Id = '" . $data['editBrokerWiseIdHidden'] . "'";
                        $insertBrokerWiseCity = $con->prepare($brokerWiseQuery);
                        $insertBrokerWiseCity->execute();
                    } catch (Exception $e) {
                        $errFlag = true;
                        $response['msg'][] = "Exception error at updating broker:" . $e->getMessage();
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
                        if (!empty($data['brokername'])) {
                            $data['brokername'] = str_replace("'", "''", $data['brokername']);
                        } else {
                            $data['brokername'] = null;
                        }
                        if (!empty($data['brokertype'])) {
                            $data['brokertype'] = $data['brokertype'];
                        } else {
                            $data['brokertype'] = null;
                        }
                        if (!empty($data['brokersubtype'])) {
                            $data['brokersubtype'] = $data['brokersubtype'];
                        } else {
                            $data['brokersubtype'] = null;
                        }
                        if (!empty($data['brokercity'])) {
                            $data['brokercity'] = str_replace("'", "''", $data['brokercity']);
                        } else {
                            $data['brokercity'] = null;
                        }
                        if (!empty($data['brokerstate'])) {
                            $data['brokerstate'] = $data['brokerstate'];
                        } else {
                            $data['brokerstate'] = null;
                        }
                        if (!empty($data['brokercountry'])) {
                            $data['brokercountry'] = $data['brokercountry'];
                        } else {
                            $data['brokercountry'] = null;
                        }
                        if (!empty($data['addressline1'])) {
                            $data['addressline1'] = str_replace("'", "''", $data['addressline1']);
                        } else {
                            $data['addressline1'] = null;
                        }
                        if (!empty($data['addressline2'])) {
                            $data['addressline2'] = str_replace("'", "''", $data['addressline2']);
                        } else {
                            $data['addressline2'] = null;
                        }
                        if (empty($data['brokerzipcode'])) {
                            $data['brokerzipcode'] = null;
                        } else {
                            $data['brokerzipcode'] = $data['brokerzipcode'];
                        }
                        if (empty($data['brokercode'])) {
                            $data['brokercode'] = null;
                        } else {
                            $data['brokercode'] = $data['brokercode'];
                        }

                        $isBroker = self::isBrokerNameExists(strtolower(trim($data['brokername'])));
                        if ($isBroker == '0') {
                            $brokerQuery = "INSERT INTO Broker 
                                    (BrokerName, BrokerTypeId, BrokerCode, Status, DataRecorderMetaDataId, PartyId) 
                                    VALUES 
                                    ('" . $data['brokername'] . "', '" . $data['brokertype'] . "','" . $data['brokercode'] . "','" . $data['brokersubtype'] . "',  '" . $dataRecorderId . "', 97)";
                            $insertBroker = $con->prepare($brokerQuery);
                            if ($insertBroker->execute()) {
                                $STH1 = $con->query("SELECT CAST(COALESCE(SCOPE_IDENTITY(), @@IDENTITY) AS int)");
                                $STH1->execute();
                                $resultData = $STH1->fetch();
                                $brokerId = $resultData[0];
                            } else {
                                throw new PropelException();
                            }
                            $brokerWiseQuery = "INSERT INTO  BrokerWiseCity 
                                    (BrokerId, CityId, StateId, CountryId, AddressLine1, AddressLine2, ZipCode) 
                                    VALUES 
                                    ('" . $brokerId . "', '" . $data['brokercity'] . "','" . $data['brokerstate'] . "','" . $data['brokercountry'] . "', '" . $data['addressline1'] . "','" . $data['addressline2'] . "','" . $data['brokerzipcode'] . "')";
                            $insertBrokerWiseCity = $con->prepare($brokerWiseQuery);
                            $insertBrokerWiseCity->execute();
                        } else {
                            $brokerWiseQuery = "INSERT INTO  BrokerWiseCity 
                                    (BrokerId, CityId, StateId, CountryId, AddressLine1, AddressLine2, ZipCode) 
                                    VALUES 
                                    ('" . $isBroker . "', '" . $data['brokercity'] . "','" . $data['brokerstate'] . "','" . $data['brokercountry'] . "', '" . $data['addressline1'] . "','" . $data['addressline2'] . "','" . $data['brokerzipcode'] . "')";
                            $insertBrokerWiseCity = $con->prepare($brokerWiseQuery);
                            $insertBrokerWiseCity->execute();
                        }
                    } catch (Exception $e) {
                        $errFlag = true;
                        $response['msg'][] = "Exception error at creating broker:" . $e->getMessage() . 'At line number' . __LINE__;
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

    public static function GetBrokerInfo($brokerId) {
        $con = Propel::getConnection();
        $stmt = $con->query("SELECT B.Id AS BrokerId,B.BrokerName AS BrokerName,B.BrokerTypeId AS BrokerType,B.BrokerCode AS BrokerCode,B.Status AS BrokerSubType,BW.AddressLine1,BW.AddressLine2,BW.ZipCode, B.DataRecorderMetaDataId AS DataId,BW.Id AS BrokerWiseId, BW.CityId AS City,BW.StateId AS State,BW.CountryId AS Country FROM Broker as B LEFT JOIN BrokerWiseCity AS BW on B.Id = BW.BrokerId WHERE BW.Id = $brokerId");
        $result = $stmt->fetchAll(PDO::FETCH_OBJ);
        return $result[0];
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
        $query = "SELECT FullCode FROM State WHERE Id = '" . $stateId . "'";
        $stmt = $con->query($query);
        $result = $stmt->fetchAll();
        return $result;
    }

    public function getCityName($cityId) {
        $con = Propel::getConnection();
        $query = "SELECT CityFullCode FROM City WHERE Id = '" . $cityId . "'";
        $stmt = $con->query($query);
        $result = $stmt->fetchAll();
        return $result;
    }

    public function getLookUpdata($lookupId) {
        $con = Propel::getConnection();
        $query = "SELECT * FROM Lookup WHERE Id = '" . $lookupId . "'";
        $stmt = $con->query($query);
        $result = $stmt->fetchAll();
        return $result;
    }

    public static function isBrokerNameExists($brokerName) {
        $con = Propel::getConnection();
        $query = "SELECT Id FROM Broker WHERE BrokerName = '" . $brokerName . "'";
        $stmt = $con->query($query);
        $result = $stmt->fetchAll();
        if (count($result) > 0) {
            return $result[0]['Id'];
        } else {
            return 0;
        }
    }

    public static function GetBrokerId($brokerWiseCityId) {
        $con = Propel::getConnection();
        $query = "SELECT BrokerId FROM BrokerWiseCity WHERE Id = '$brokerWiseCityId'";
        $stmt = $con->query($query);
        $result = $stmt->fetchAll();
        if (count($result) > 0) {
            return $result[0]['BrokerId'];
        }
    }

    public static function isBrokerCodeExists($brokerCode) {
        $con = Propel::getConnection();
        $query = "SELECT * FROM Broker WHERE BrokerCode = '" . $brokerCode . "'";
        $stmt = $con->query($query);
        $result = $stmt->fetchAll();
        if (count($result) > 0) {
            return TRUE;
        } else {
            return FALSE;
        }
    }

    public static function GetBrokerInformation($companyString) {
        if (!empty($companyString)) {
            $con = Propel::getConnection();
            $stmt = $con->query("Select BrokerName From Broker
                                     WHERE BrokerName LIKE '" . trim($companyString) . "%';");
            $result = $stmt->fetchAll(PDO::FETCH_ASSOC);
            return $result;
        }
    }

    public static function GetBrokerDetails($companyString) {
        if (!empty($companyString)) {
            $con = Propel::getConnection();
            $stmt = $con->query("Select B.BrokerTypeId AS BrokerTypeId, L.Alias AS BrokerType ,B.BrokerCode, B.Status AS BrokerSubTypeId, L1.Alias AS BrokerSubType From Broker AS B
                                    LEFT JOIN Lookup AS L on B.BrokerTypeId = L.Id LEFT JOIN Lookup AS L1 on B.Status = L1.Id WHERE BrokerName = '$companyString';");
            $result = $stmt->fetchAll(PDO::FETCH_ASSOC);
            return $result;
        }
    }

    public static function getPostContent() {
        return trim(file_get_contents("php://input"));
    }

}
