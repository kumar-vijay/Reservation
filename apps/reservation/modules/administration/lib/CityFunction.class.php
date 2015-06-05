<?php

class CityFunction {

    private $_con = NULL;

    public function __construct() {
        $this->_con = Propel::getConnection();
    }

    public function getState($where = 0) {
        $con = Propel::getConnection();
        if ($where == 0) {
            $query = "SELECT * from State Where StateName !='(Unknown)' AND StateName !='To Be Entered'";
        } else {
            $query = "SELECT * from State WHERE Id = '$where' AND StateName !='(Unknown)' AND StateName !='To Be Entered'";
        }
        $stmt = $con->query($query);
        $result = $stmt->fetchAll();
        return $result;
    }

    public function CityList($input) {
        $criteria = new Criteria();
        $isFilterChoosen = false;
        if ($input['cityName'] != '') {
            $filterCriteria = $criteria->add(CitySearchPeer::CITYNAME, $input['cityName'] . '%', Criteria::LIKE);
            $isFilterChoosen = true;
        }
        if ($input['stateName'] != '') {
            if ($input['stateName'] != '0') {
                $filterCriteria = $criteria->add(CitySearchPeer::STATENAME, trim($input['stateName']), Criteria::EQUAL);
                $isFilterChoosen = true;
            }
        }
        if ($isFilterChoosen) {
            $criteria->add($filterCriteria);
        }
        $criteria->addDescendingOrderByColumn(CitySearchPeer::ID);
        return $criteria;
    }

    public function CreateCity(array $data) {
        $errFlag = false;
        if (empty($data)) {
            $errFlag = true;
            $response['msg'][] = 'You did not fill the form correctly';
            $response['success'] = false;
        } else {
            if ($errFlag == false) {
                if ($data['cityId'] != NULL) {
                    try {
                        if (empty($data['editcitycode'])) {
                            $data['editcitycode'] = null;
                        } else {
                            $data['editcitycode'] = str_replace("'", "''", $data['editcitycode']);
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
                        $con = Propel::getConnection();
                        $Recorderquery = "UPDATE DataRecorderMetaData SET ModifiedBy = '" . $data['userId'] . "', ModifiedOn = GetDate() WHERE Id = '" . $data['editDataRecorderIdHidden'] . "'";
                        $updateRecorderData = $con->prepare($Recorderquery);
                        $updateRecorderData->execute();
                        if($data['editCityCodeHidden'] != trim($data['editcitycode'])) {
                            $isCityCode = self::isCityCodeExists(trim($data['editcitycode']));
                        }
                        if ($isCityCode == '0' || empty($isCityCode)) {
                            $brokerQuery = "UPDATE City SET CityCode = '" . $data['editcitycode'] . "', CityFullCode = '" . $data['editbrokerstatename'] . "', RetailBrokerCity = '" . $data['editretailbrokerstatename'] . "' WHERE Id = '" . $data['cityId'] . "'";
                            $updateBrokerData = $con->prepare($brokerQuery);
                            $updateBrokerData->execute();
                        } else {
                            $errFlag = true;
                            $response['msg'][] = 'City Code already exists';
                            $response['success'] = false;
                        }
                    } catch (Exception $e) {
                        $errFlag = true;
                        $response['msg'][] = "Exception error at updating city:" . $e->getMessage();
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
                        if (!empty($data['statename'])) {
                            $data['statename'] = str_replace("'", "''", $data['statename']);
                            $stateData = $this->getState($data['statename']);
                            $stateName = $stateData[0]['StateName'];
                            $stateCode = $stateData[0]['StateCode'];
                        } else {
                            $data['statename'] = null;
                            $stateName = null;
                            $stateCode = null;
                        }
                        if (!empty($data['cityname'])) {
                            $data['cityname'] = $data['cityname'];
                        } else {
                            $data['cityname'] = null;
                        }
                        if (!empty($data['citycode'])) {
                            $data['citycode'] = $data['citycode'];
                        } else {
                            $data['citycode'] = null;
                        }
                        if (!empty($data['brokercityname'])) {
                            $data['brokercityname'] = $data['brokercityname'];
                        } else {
                            $data['brokercityname'] = null;
                        }
                        if (!empty($data['retailbrokercityname'])) {
                            $data['retailbrokercityname'] = $data['retailbrokercityname'];
                        } else {
                            $data['retailbrokercityname'] = null;
                        }

                        $isCity = self::isCityExists($data['statename'], trim($data['cityname']));
                        $isCityCode = self::isCityCodeExists(trim($data['citycode']));
                        if ($isCityCode == '0') {
                            if ($isCity == '0') {
                                $cityQuery = "INSERT INTO City 
                                    (City,State,CityCode,CityFullCode,StateCode,StateId,RetailBrokerCity,DataRecorderMetaDataId) 
                                    VALUES 
                                    ('" . $data['cityname'] . "', '" . $stateName . "','" . $data['citycode'] . "', '" . $data['brokercityname'] . "','" . $stateCode . "', '" . $data['statename'] . "', '" . $data['retailbrokercityname'] . "','" . $dataRecorderId . "')";
                                $insertCity = $con->prepare($cityQuery);
                                $insertCity->execute();
                            } else {
                                $errFlag = true;
                                $response['msg'][] = 'City Name already exists';
                                $response['success'] = false;
                            }
                        } else {
                            $errFlag = true;
                            $response['msg'][] = 'City Code already exists';
                            $response['success'] = false;
                        }
                    } catch (Exception $e) {
                        $errFlag = true;
                        $response['msg'][] = "Exception error at creating city:" . $e->getMessage() . 'At line number' . __LINE__;
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

    public static function isCityExists($stateId, $cityName) {
        $con = Propel::getConnection();
        $query = "SELECT * FROM City WHERE StateId = '" . $stateId . "' AND City = '" . $cityName . "'";
        $stmt = $con->query($query);
        $result = $stmt->fetchAll();
        if (count($result) > 0) {
            return TRUE;
        } else {
            return FALSE;
        }
    }

    public static function isCityCodeExists($cityCode) {
        $con = Propel::getConnection();
        $query = "SELECT * FROM City WHERE CityCode = '" . $cityCode . "'";
        $stmt = $con->query($query);
        $result = $stmt->fetchAll();
        if (count($result) > 0) {
            return TRUE;
        } else {
            return FALSE;
        }
    }

    public function CityInfo($cityId) {
        $con = Propel::getConnection();
        $query = "SELECT * FROM City WHERE Id = '" . $cityId . "'";
        $stmt = $con->query($query);
        $result = $stmt->fetchAll();
        return $result;
    }

    public static function getPostContent() {
        return trim(file_get_contents("php://input"));
    }

}
