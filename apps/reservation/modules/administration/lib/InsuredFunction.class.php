<?php

class InsuredFunctions {

    private $_con = NULL;

    public function __construct() {
        $this->_con = Propel::getConnection();
    }

    public function insuredList($input) {
        $criteria = new Criteria();
        $isFilterChoosen = false;

        if ($input['insuredName'] != '') {
            $filterCriteria = $criteria->add(InsuredsearchPeer::INSUREDNAME, $input['insuredName'] . '%', Criteria::LIKE);
            $isFilterChoosen = true;
        }

        if ($input['insuredDBNumber'] != '') {
            $filterCriteria = $criteria->add(InsuredsearchPeer::DBNUMBER, $input['insuredDBNumber'] . '%', Criteria::LIKE);
            $isFilterChoosen = true;
        }

        if ($input['insuredaddress'] != '') {
            $filterCriteria = $criteria->add(InsuredsearchPeer::ADDRESS, trim($input['insuredaddress']) . '%', Criteria::LIKE);
            $isFilterChoosen = true;
        }

        if ($input['insuredCountry'] != '') {
            $filterCriteria = $criteria->add(InsuredsearchPeer::INSUREDCOUNTRY, trim($input['insuredCountry']) . '%', Criteria::LIKE);
            $isFilterChoosen = true;
        }

        if ($input['insuredCity'] != '') {
            $filterCriteria = $criteria->add(InsuredsearchPeer::INSUREDCITY, trim($input['insuredCity']) . '%', Criteria::LIKE);
            $isFilterChoosen = true;
        }

        if ($input['insuredState'] != '') {
            $filterCriteria = $criteria->add(InsuredsearchPeer::INSUREDSTATE, trim($input['insuredState']) . '%', Criteria::LIKE);
            $isFilterChoosen = true;
        }

        if ($input['advisenID'] != '') {
            $filterCriteria = $criteria->add(InsuredsearchPeer::ADVISENID, trim($input['advisenID']), Criteria::EQUAL);
            $isFilterChoosen = true;
        }

        if ($input['insuredStatus'] != '') {
            $filterCriteria = $criteria->add(InsuredsearchPeer::INSUREDSTATUS, trim($input['insuredStatus']), Criteria::EQUAL);
            $isFilterChoosen = true;
        }

        if ($isFilterChoosen) {
            $criteria->add($filterCriteria);
        }

        if (empty($filterCriteria)) {
            $criteria->add(InsuredsearchPeer::INSUREDPARENTID, '0', Criteria::EQUAL);
        }

        $criteria->addDescendingOrderByColumn(InsuredsearchPeer::ID);
        return $criteria;
    }

    public function CreateInsured(array $data) {
        $errFlag = false;
        $error = array();

        if (empty($data)) {
            $errFlag = true;
            $response['msg'][] = 'You did not fill the form correctly';
            $response['success'] = false;
        } else {
            if ($errFlag == false) {

                if ($data['insuredId'] != NULL) {
                    try {
                        if (empty($data['editinsuredname'])) {
                            $data['editinsuredname'] = null;
                        } else {
                            $data['editinsuredname'] = str_replace("'", "''", $data['editinsuredname']);
                        }
                        if (empty($data['editinsuredaddress'])) {
                            $data['editinsuredaddress'] = null;
                        } else {
                            $data['editinsuredaddress'] = str_replace("'", "''", $data['editinsuredaddress']);
                        }
                        if (empty($data['editinsuredcountry'])) {
                            $data['editinsuredcountry'] = null;
                        } else {
                            $data['editinsuredcountry'] = $data['editinsuredcountry'];
                        }
                        if (empty($data['editinsuredstate'])) {
                            $data['editinsuredstate'] = null;
                        } else {
                            $data['editinsuredstate'] = $data['editinsuredstate'];
                        }
                        if (empty($data['editinsuredcity'])) {
                            $data['editinsuredcity'] = null;
                        } else {
                            $data['editinsuredcity'] = str_replace("'", "''", $data['editinsuredcity']);
                        }
                        if (empty($data['editinsuredzipcode'])) {
                            $data['editinsuredzipcode'] = null;
                        } else {
                            $data['editinsuredzipcode'] = $data['editinsuredzipcode'];
                        }
                        if (empty($data['editdbNumber'])) {
                            $data['editdbNumber'] = null;
                        } else {
                            $data['editdbNumber'] = $data['editdbNumber'];
                        }
                        if (empty($data['editgupname'])) {
                            $data['editgupname'] = null;
                        } else {
                            $data['editgupname'] = str_replace("'", "''", $data['editgupname']);
                        }
                        if (empty($data['editgupaddressline1'])) {
                            $data['editgupaddressline1'] = null;
                        } else {
                            $data['editgupaddressline1'] = str_replace("'", "''", $data['editgupaddressline1']);
                        }

                        if ($data['editstatus'] == 'InActive') {
                            $amnedmentCount = self::CheckEligibilityForInActiveInsured($data['insuredId']);
                            if (!empty($amnedmentCount[0]['InsuredCount']) && $amnedmentCount[0]['InsuredParentId'] == 0) {
                                $con = Propel::getConnection();
                                $Recorderquery = "UPDATE DataRecorderMetaData SET ModifiedBy = '" . $data['userId'] . "', ModifiedOn = GetDate() WHERE Id = '" . $data['recorderId'] . "'";
                                $updateRecorderData = $con->prepare($Recorderquery);
                                $updateRecorderData->execute();
                                if (empty($data['editadvisenId'])) {
                                    $insuredQuery = "UPDATE Insured SET InsuredName = '" . $data['editinsuredname'] . "', City = '" . $data['editinsuredcity'] . "', State = '" . $data['editinsuredstate'] . "', Zip = '" . $data['editinsuredzipcode'] . "', Country = '" . $data['editinsuredcountry'] . "', AddressLine1 = '" . $data['editinsuredaddress'] . "', AdvisenId = null,PartyId = 98 ,DBNumber = '" . $data['editdbNumber'] . "',ReferenceId = '" . $data['editgupadvisenid'] . "', AdvisenUltimateParentCompanyName = '" . $data['editgupname'] . "', UltimateParentStreetAddress1 = '" . $data['editgupaddressline1'] . "', UltimateParentCountry = '" . $data['editgupcountry'] . "', UltimateParentState = '" . $data['editgupstate'] . "', UltimateParentCity = '" . $data['editgupcity'] . "', UltimateParentZip = '" . $data['editgupzipcode'] . "', UltimateParentPhone = '" . $data['editgupphonenumber'] . "',InsuredStatus = '" . $data['editstatus'] . "', InsuredInActivationDate = GetDate() WHERE Id = '" . $data['insuredId'] . "'";
                                } else {
                                    $insuredQuery = "UPDATE Insured SET InsuredName = '" . $data['editinsuredname'] . "', City = '" . $data['editinsuredcity'] . "', State = '" . $data['editinsuredstate'] . "', Zip = '" . $data['editinsuredzipcode'] . "', Country = '" . $data['editinsuredcountry'] . "', AddressLine1 = '" . $data['editinsuredaddress'] . "', AdvisenId = '" . $data['editadvisenId'] . "',PartyId = 98, DBNumber = '" . $data['editdbNumber'] . "', ReferenceId ='" . $data['editgupadvisenid'] . "' , AdvisenUltimateParentCompanyName = '" . $data['editgupname'] . "', UltimateParentStreetAddress1 = '" . $data['editgupaddressline1'] . "', UltimateParentCountry = '" . $data['editgupcountry'] . "', UltimateParentState = '" . $data['editgupstate'] . "', UltimateParentCity = '" . $data['editgupcity'] . "', UltimateParentZip = '" . $data['editgupzipcode'] . "', UltimateParentPhone = '" . $data['editgupphonenumber'] . "',InsuredStatus = '" . $data['editstatus'] . "', InsuredInActivationDate = GetDate() WHERE Id = '" . $data['insuredId'] . "'";
                                }
                                $updateInsuredData = $con->prepare($insuredQuery);
                                $updateInsuredData->execute();
                            } else if (empty($amnedmentCount[0]['InsuredCount']) && $amnedmentCount[0]['InsuredParentId'] != 0) {
                                $con = Propel::getConnection();
                                $Recorderquery = "UPDATE DataRecorderMetaData SET ModifiedBy = '" . $data['userId'] . "', ModifiedOn = GetDate() WHERE Id = '" . $data['recorderId'] . "'";
                                $updateRecorderData = $con->prepare($Recorderquery);
                                $updateRecorderData->execute();
                                if (empty($data['editadvisenId'])) {
                                    $insuredQuery = "UPDATE Insured SET InsuredName = '" . $data['editinsuredname'] . "', City = '" . $data['editinsuredcity'] . "', State = '" . $data['editinsuredstate'] . "', Zip = '" . $data['editinsuredzipcode'] . "', Country = '" . $data['editinsuredcountry'] . "', AddressLine1 = '" . $data['editinsuredaddress'] . "', AdvisenId = null,PartyId = 98 ,DBNumber = '" . $data['editdbNumber'] . "',ReferenceId = '" . $data['editgupadvisenid'] . "', AdvisenUltimateParentCompanyName = '" . $data['editgupname'] . "', UltimateParentStreetAddress1 = '" . $data['editgupaddressline1'] . "', UltimateParentCountry = '" . $data['editgupcountry'] . "', UltimateParentState = '" . $data['editgupstate'] . "', UltimateParentCity = '" . $data['editgupcity'] . "', UltimateParentZip = '" . $data['editgupzipcode'] . "', UltimateParentPhone = '" . $data['editgupphonenumber'] . "',InsuredStatus = '" . $data['editstatus'] . "', InsuredInActivationDate = GetDate() WHERE Id = '" . $data['insuredId'] . "'";
                                } else {
                                    $insuredQuery = "UPDATE Insured SET InsuredName = '" . $data['editinsuredname'] . "', City = '" . $data['editinsuredcity'] . "', State = '" . $data['editinsuredstate'] . "', Zip = '" . $data['editinsuredzipcode'] . "', Country = '" . $data['editinsuredcountry'] . "', AddressLine1 = '" . $data['editinsuredaddress'] . "', AdvisenId = '" . $data['editadvisenId'] . "',PartyId = 98, DBNumber = '" . $data['editdbNumber'] . "', ReferenceId ='" . $data['editgupadvisenid'] . "' , AdvisenUltimateParentCompanyName = '" . $data['editgupname'] . "', UltimateParentStreetAddress1 = '" . $data['editgupaddressline1'] . "', UltimateParentCountry = '" . $data['editgupcountry'] . "', UltimateParentState = '" . $data['editgupstate'] . "', UltimateParentCity = '" . $data['editgupcity'] . "', UltimateParentZip = '" . $data['editgupzipcode'] . "', UltimateParentPhone = '" . $data['editgupphonenumber'] . "',InsuredStatus = '" . $data['editstatus'] . "', InsuredInActivationDate = GetDate() WHERE Id = '" . $data['insuredId'] . "'";
                                }
                                $updateInsuredData = $con->prepare($insuredQuery);
                                $updateInsuredData->execute();
                            } else {
                                $errFlag = true;
                                $response['msg'][] = "Insured does not have child so can not change status to InActive.";
                                $response['success'] = false;
                            }
                        } else {
                            $con = Propel::getConnection();
                            $Recorderquery = "UPDATE DataRecorderMetaData SET ModifiedBy = '" . $data['userId'] . "', ModifiedOn = GetDate() WHERE Id = '" . $data['recorderId'] . "'";
                            $updateRecorderData = $con->prepare($Recorderquery);
                            $updateRecorderData->execute();
                            if (empty($data['editadvisenId'])) {
                                $insuredQuery = "UPDATE Insured SET InsuredName = '" . $data['editinsuredname'] . "', City = '" . $data['editinsuredcity'] . "', State = '" . $data['editinsuredstate'] . "', Zip = '" . $data['editinsuredzipcode'] . "', Country = '" . $data['editinsuredcountry'] . "', AddressLine1 = '" . $data['editinsuredaddress'] . "', AdvisenId = null,PartyId = 98 ,DBNumber = '" . $data['editdbNumber'] . "',ReferenceId = '" . $data['editgupadvisenid'] . "', AdvisenUltimateParentCompanyName = '" . $data['editgupname'] . "', UltimateParentStreetAddress1 = '" . $data['editgupaddressline1'] . "', UltimateParentCountry = '" . $data['editgupcountry'] . "', UltimateParentState = '" . $data['editgupstate'] . "', UltimateParentCity = '" . $data['editgupcity'] . "', UltimateParentZip = '" . $data['editgupzipcode'] . "', UltimateParentPhone = '" . $data['editgupphonenumber'] . "',InsuredStatus = '" . $data['editstatus'] . "' WHERE Id = '" . $data['insuredId'] . "'";
                            } else {
                                $insuredQuery = "UPDATE Insured SET InsuredName = '" . $data['editinsuredname'] . "', City = '" . $data['editinsuredcity'] . "', State = '" . $data['editinsuredstate'] . "', Zip = '" . $data['editinsuredzipcode'] . "', Country = '" . $data['editinsuredcountry'] . "', AddressLine1 = '" . $data['editinsuredaddress'] . "', AdvisenId = '" . $data['editadvisenId'] . "',PartyId = 98, DBNumber = '" . $data['editdbNumber'] . "', ReferenceId ='" . $data['editgupadvisenid'] . "' , AdvisenUltimateParentCompanyName = '" . $data['editgupname'] . "', UltimateParentStreetAddress1 = '" . $data['editgupaddressline1'] . "', UltimateParentCountry = '" . $data['editgupcountry'] . "', UltimateParentState = '" . $data['editgupstate'] . "', UltimateParentCity = '" . $data['editgupcity'] . "', UltimateParentZip = '" . $data['editgupzipcode'] . "', UltimateParentPhone = '" . $data['editgupphonenumber'] . "',InsuredStatus = '" . $data['editstatus'] . "' WHERE Id = '" . $data['insuredId'] . "'";
                            }
                            $updateInsuredData = $con->prepare($insuredQuery);
                            $updateInsuredData->execute();
                        }
                    } catch (Exception $e) {
                        $errFlag = true;
                        $response['msg'][] = "Exception error at updating insured:" . $e->getMessage();
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
                        if (!empty($data['insuredname'])) {
                            $data['insuredname'] = str_replace("'", "''", $data['insuredname']);
                        } else {
                            $data['insuredname'] = null;
                        }
                        if (!empty($data['insuredcity'])) {
                            $data['insuredcity'] = str_replace("'", "''", $data['insuredcity']);
                        } else {
                            $data['insuredcity'] = null;
                        }
                        if (!empty($data['insuredstate'])) {
                            $data['insuredstate'] = $data['insuredstate'];
                        } else {
                            $data['insuredstate'] = null;
                        }
                        if (!empty($data['insuredcountry'])) {
                            $data['insuredcountry'] = $data['insuredcountry'];
                        } else {
                            $data['insuredcountry'] = null;
                        }
                        if (!empty($data['insuredaddress'])) {
                            $data['insuredaddress'] = str_replace("'", "''", $data['insuredaddress']);
                        } else {
                            $data['insuredaddress'] = null;
                        }
                        if (empty($data['insuredzipcode'])) {
                            $data['insuredzipcode'] = null;
                        } else {
                            $data['insuredzipcode'] = $data['insuredzipcode'];
                        }
                        if (empty($data['dbNumber'])) {
                            $data['dbNumber'] = null;
                        } else {
                            $data['dbNumber'] = $data['dbNumber'];
                        }
                        if (empty($data['gupname'])) {
                            $data['gupname'] = null;
                        } else {
                            $data['gupname'] = str_replace("'", "''", $data['gupname']);
                        }
                        if (empty($data['gupaddressline1'])) {
                            $data['gupaddressline1'] = null;
                        } else {
                            $data['gupaddressline1'] = str_replace("'", "''", $data['gupaddressline1']);
                        }
                        $parentId = '0';
                        $insuredStatus = 'Active';
                        if (empty($data['advisenId'])) {
                            $insuredQuery = "INSERT INTO Insured 
                             (InsuredName, DataRecorderMetaDataId, City, State, Zip, Country, AddressLine1, AdvisenId, PartyId,DBNumber,ReferenceId,AdvisenUltimateParentCompanyName,UltimateParentStreetAddress1,UltimateParentCountry,UltimateParentState,UltimateParentCity,UltimateParentZip,UltimateParentPhone,InsuredParentId,InsuredStatus) 
                             VALUES 
                             ('" . $data['insuredname'] . "', '" . $dataRecorderId . "', '" . $data['insuredcity'] . "','" . $data['insuredstate'] . "','" . $data['insuredzipcode'] . "', '" . $data['insuredcountry'] . "','" . $data['insuredaddress'] . "', null, 98,'" . $data['dbNumber'] . "','" . $data['gupadvisenid'] . "','" . $data['gupname'] . "','" . $data['gupaddressline1'] . "','" . $data['gupcountry'] . "','" . $data['gupstate'] . "','" . $data['gupcity'] . "','" . $data['gupzipcode'] . "','" . $data['gupphonenumber'] . "', '" . $parentId . "','" . $insuredStatus . "')";
                        } else {
                            $insuredQuery = "INSERT INTO Insured 
                             (InsuredName, DataRecorderMetaDataId, City, State, Zip, Country, AddressLine1, AdvisenId, PartyId,DBNumber,ReferenceId,AdvisenUltimateParentCompanyName,UltimateParentStreetAddress1,UltimateParentCountry,UltimateParentState,UltimateParentCity,UltimateParentZip,UltimateParentPhone,InsuredParentId,InsuredStatus) 
                             VALUES 
                             ('" . $data['insuredname'] . "', '" . $dataRecorderId . "', '" . $data['insuredcity'] . "','" . $data['insuredstate'] . "','" . $data['insuredzipcode'] . "', '" . $data['insuredcountry'] . "','" . $data['insuredaddress'] . "', '" . $data['advisenId'] . "',98,'" . $data['dbNumber'] . "','" . $data['gupadvisenid'] . "','" . $data['gupname'] . "','" . $data['gupaddressline1'] . "','" . $data['gupcountry'] . "','" . $data['gupstate'] . "','" . $data['gupcity'] . "','" . $data['gupzipcode'] . "','" . $data['gupphonenumber'] . "', '" . $parentId . "','" . $insuredStatus . "')";
                        }
                        $insertInsured = $con->prepare($insuredQuery);
                        $insertInsured->execute();
                    } catch (Exception $e) {
                        $errFlag = true;
                        $response['msg'][] = "Exception error at creating insured:" . $e->getMessage() . 'At line number' . __LINE__;
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

    public static function isInsuredNameExists($insuredName) {
        $criteria = new Criteria();
        $criteria->add(GroupsPeer::GROUP_NAME, strtolower($insuredName), Criteria::EQUAL);
        if (GroupPeer::doCount($criteria) > 0) {
            return true;
        } else {
            return false;
        }
    }

    public static function GetInsuredInfo($insuredId) {
        $con = Propel::getConnection();
        $stmt = $con->query("SELECT I.* FROM Insured as I WHERE I.Id = $insuredId");
        $result = $stmt->fetchAll(PDO::FETCH_OBJ);
        return $result[0];
    }

    public static function GetParentInsured($parentId) {
        if ($parentId != 0) {
            $con = Propel::getConnection();
            $stmt = $con->query("SELECT I.InsuredName FROM Insured as I WHERE I.Id = $parentId");
            $result = $stmt->fetchAll(PDO::FETCH_OBJ);
            $data = $result[0]->InsuredName;
        } else {
            $data = "";
        }
        return $data;
    }

    public static function getPostContent() {
        return trim(file_get_contents("php://input"));
    }

    public function getCountryName() {
        $con = Propel::getConnection();
        $query = "SELECT * FROM Country order by InsuredCountry;";
        $stmt = $con->query($query);
        $result = $stmt->fetchAll();
        return $result;
    }

    public function getStateName($countryId) {

        if (empty($countryId)) {
            $where = "Where 1=1 AND StateName !='(Unknown)' and FullCode is not null";
        } else if (is_numeric($countryId)) {
            $where = "Where CountryId = '" . $countryId . "'";
        }
        $con = Propel::getConnection();
        $query = "SELECT * FROM State " . $where . " order by StateName;";
        $stmt = $con->query($query);
        $result = $stmt->fetchAll(PDO::FETCH_ASSOC);
        return $result;
    }

    public function getCityName($stateId = 0) {
        $con = Propel::getConnection();
        if ($stateId == 0) {
            $query = "SELECT * FROM City WHERE City != '(Unknown)' AND City != 'Unknown' and CityFullCode is not null order by City";
        } else {
            $query = "SELECT * FROM CITY WHERE StateId = '$stateId' order by City";
        }
        $stmt = $con->query($query);
        $result = $stmt->fetchAll();
        return $result;
    }

    public function getGUPCountryName() {
        $con = Propel::getConnection();
        $query = "SELECT DISTINCT UltimateParentCountry FROM Insured where UltimateParentCountry is not null and UltimateParentCountry != '0' and UltimateParentCountry !='' order by UltimateParentCountry;";
        $stmt = $con->query($query);
        $result = $stmt->fetchAll();
        return $result;
    }

    public function getGUPStateName() {
        $con = Propel::getConnection();
        $query = "SELECT DISTINCT UltimateParentState FROM Insured where UltimateParentState is not null and UltimateParentState != '0' and UltimateParentState != '' order by UltimateParentState;";
        $stmt = $con->query($query);
        $result = $stmt->fetchAll();
        return $result;
    }

    public function getGUPCityName() {
        $con = Propel::getConnection();
        $query = "SELECT DISTINCT UltimateParentCity FROM Insured where UltimateParentCity is not null and UltimateParentCity != '0' and UltimateParentCity != '' order by UltimateParentCity;";
        $stmt = $con->query($query);
        $result = $stmt->fetchAll();
        return $result;
    }

    public function getInsuredCountryName() {
        $con = Propel::getConnection();
        $query = "SELECT DISTINCT Country from Insured Where Country != 'Not Avaliable' and Country != 'Not Available';";
        $stmt = $con->query($query);
        $result = $stmt->fetchAll();
        return $result;
    }

    public function getInsuredStateName($countryId) {
        $con = Propel::getConnection();
        $query = "SELECT DISTINCT State from Insured where State != 'Not Avaliable';";
        $stmt = $con->query($query);
        $result = $stmt->fetchAll(PDO::FETCH_ASSOC);
        return $result;
    }

    public function getInsuredCityName($stateId = 0) {
        $con = Propel::getConnection();
        $query = "SELECT DISTINCT City from Insured where City != 'Not Avaliable';";
        $stmt = $con->query($query);
        $result = $stmt->fetchAll();
        return $result;
    }

    public function CreateCloneRecord($data) {
        $errFlag = false;
        try {
            $con = Propel::getConnection();
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
            if (!empty($data['insuredname'])) {
                $data['insuredname'] = str_replace("'", "''", $data['insuredname']);
            } else {
                $data['insuredname'] = null;
            }
            if (!empty($data['insuredcity'])) {
                $data['insuredcity'] = str_replace("'", "''", $data['insuredcity']);
            } else {
                $data['insuredcity'] = null;
            }
            if (!empty($data['insuredstate'])) {
                $data['insuredstate'] = $data['insuredstate'];
            } else {
                $data['insuredstate'] = null;
            }
            if (!empty($data['insuredcountry'])) {
                $data['insuredcountry'] = $data['insuredcountry'];
            } else {
                $data['insuredcountry'] = null;
            }
            if (!empty($data['insuredaddress'])) {
                $data['insuredaddress'] = str_replace("'", "''", $data['insuredaddress']);
            } else {
                $data['insuredaddress'] = null;
            }
            if (empty($data['insuredzipcode'])) {
                $data['insuredzipcode'] = null;
            } else {
                $data['insuredzipcode'] = $data['insuredzipcode'];
            }
            if (empty($data['dbNumber'])) {
                $data['dbNumber'] = null;
            } else {
                $data['dbNumber'] = $data['dbNumber'];
            }
            if (empty($data['gupname'])) {
                $data['gupname'] = null;
            } else {
                $data['gupname'] = str_replace("'", "''", $data['gupname']);
            }
            if (empty($data['gupaddressline1'])) {
                $data['gupaddressline1'] = null;
            } else {
                $data['gupaddressline1'] = str_replace("'", "''", $data['gupaddressline1']);
            }
            $insuredStatus = 'Active';
            if (empty($data['advisenId'])) {
                $insuredQuery = "INSERT INTO Insured 
                             (InsuredName, DataRecorderMetaDataId, City, State, Zip, Country, AddressLine1, AdvisenId, PartyId,DBNumber,ReferenceId,AdvisenUltimateParentCompanyName,UltimateParentStreetAddress1,UltimateParentCountry,UltimateParentState,UltimateParentCity,UltimateParentZip,UltimateParentPhone,InsuredParentId,InsuredStatus) 
                             VALUES 
                             ('" . $data['insuredname'] . "', '" . $dataRecorderId . "', '" . $data['insuredcity'] . "','" . $data['insuredstate'] . "','" . $data['insuredzipcode'] . "', '" . $data['insuredcountry'] . "','" . $data['insuredaddress'] . "', null, 98,'" . $data['dbNumber'] . "','" . $data['gupadvisenid'] . "','" . $data['gupname'] . "','" . $data['gupaddressline1'] . "','" . $data['gupcountry'] . "','" . $data['gupstate'] . "','" . $data['gupcity'] . "','" . $data['gupzipcode'] . "','" . $data['gupphonenumber'] . "','" . $data['parentinsuredId'] . "', '" . $insuredStatus . "')";
            } else {
                $insuredQuery = "INSERT INTO Insured 
                             (InsuredName, DataRecorderMetaDataId, City, State, Zip, Country, AddressLine1, AdvisenId, PartyId,DBNumber,ReferenceId,AdvisenUltimateParentCompanyName,UltimateParentStreetAddress1,UltimateParentCountry,UltimateParentState,UltimateParentCity,UltimateParentZip,UltimateParentPhone,InsuredParentId,InsuredStatus) 
                             VALUES 
                             ('" . $data['insuredname'] . "', '" . $dataRecorderId . "', '" . $data['insuredcity'] . "','" . $data['insuredstate'] . "','" . $data['insuredzipcode'] . "', '" . $data['insuredcountry'] . "','" . $data['insuredaddress'] . "', '" . $data['advisenId'] . "',98,'" . $data['dbNumber'] . "','" . $data['gupadvisenid'] . "','" . $data['gupname'] . "','" . $data['gupaddressline1'] . "','" . $data['gupcountry'] . "','" . $data['gupstate'] . "','" . $data['gupcity'] . "','" . $data['gupzipcode'] . "','" . $data['gupphonenumber'] . "','" . $data['parentinsuredId'] . "', '" . $insuredStatus . "')";
            }
            $insertInsured = $con->prepare($insuredQuery);
            $insertInsured->execute();
        } catch (Exception $e) {
            $errFlag = true;
            $response['msg'][] = "Exception error at creating insured:" . $e->getMessage() . 'At line number' . __LINE__;
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

    public function getLookUpTypeList($where) {
        $con = Propel::getConnection();
        $query = "SELECT L.Id, L.LookupName, L.Alias FROM  LookupType as LT INNER JOIN Lookup as L ON LT.Id = L.LookupTypeId WHERE LT.LookupTypeName = '$where'";
        $stmt = $con->query($query);
        $result = $stmt->fetchAll();
        return $result;
    }

    public static function FetchInsuredList($insuredParentId) {
        $con = Propel::getConnection();
        $query = "SELECT InsuredId,InsuredParentId, InsuredName,Address,InsuredCOuntry,InsuredState,InsuredCity,DBNumber,AdvisenId,InsuredStatus,CreatedBy,ModifiedBy,CreatedOn,ModifiedOn from InsuredListSearch WHERE InsuredParentId = '$insuredParentId' order by InsuredId DESC";
        $stmt = $con->query($query);
        $result = $stmt->fetchAll(PDO::FETCH_ASSOC);
        $data = self::FormatInsuredList($result);
        return $data;
    }

    private static function FormatInsuredList($result) {
        $finalArray = array();
        foreach ($result as $value) {
            $finalArray['InsuredId'] = $value['InsuredId'];
            $finalArray['InsuredParentId'] = $value['InsuredParentId'];
            $finalArray['InsuredName'] = $value['InsuredName'];
            $finalArray['Address'] = $value['Address'];
            $finalArray['InsuredCOuntry'] = $value['InsuredCOuntry'];
            $finalArray['InsuredState'] = $value['InsuredState'];
            $finalArray['InsuredCity'] = $value['InsuredCity'];
            $finalArray['DBNumber'] = $value['DBNumber'];
            if (!empty($value['AdvisenId'])) {
                $finalArray['AdvisenId'] = $value['AdvisenId'];
            } else {
                $finalArray['AdvisenId'] = "";
            }
            $finalArray['InsuredStatus'] = $value['InsuredStatus'];
            $finalArray['CreatedBy'] = $value['CreatedBy'];
            $finalArray['ModifiedBy'] = $value['ModifiedBy'];
            if (!empty($value['CreatedOn'])) {
                $finalArray['CreatedOn'] = date('m-d-Y h:i:s', strtotime($value['CreatedOn']));
            } else {
                $finalArray['CreatedOn'] = "";
            }
            if (!empty($value['ModifiedOn'])) {
                $finalArray['ModifiedOn'] = date('m-d-Y h:i:s', strtotime($value['ModifiedOn']));
            } else {
                $finalArray['ModifiedOn'] = "";
            }
            $insuredData[] = $finalArray;
        }
        return $insuredData;
    }

    public static function CheckEligibilityForInActiveInsured($insuredId) {
        $con = Propel::getConnection();
        $query = "SELECT InsuredCount,InsuredParentId from InsuredSearch WHERE InsuredId = '$insuredId'";
        $stmt = $con->query($query);
        $result = $stmt->fetchAll(PDO::FETCH_ASSOC);
        return $result;
    }

    public function validateInsured($postValues) {
        $emptyColumn = array();
        if (!empty($postValues['insuredname']) && !empty($postValues['insuredname'])) {
            
        } else {
            $emptyColumn[] = 'Insured Name';
        }
        if (!empty($postValues['insuredaddress']) && !empty($postValues['insuredaddress'])) {
            
        } else {
            $emptyColumn[] = 'Address Line 1';
        }
        if (isset($postValues['insuredcountry']) && !empty($postValues['insuredcountry'])) {
            
        } else {
            $emptyColumn[] = 'Country ';
        }
        if (isset($postValues['insuredstate']) && !empty($postValues['insuredstate'])) {
            
        } else {
            $emptyColumn[] = 'State ';
        }
        if (!empty($postValues['insuredcity']) && !empty($postValues['insuredcity'])) {
            
        } else {
            $emptyColumn[] = 'City';
        }
        if (!empty($postValues['dbNumber']) && !empty($postValues['dbNumber'])) {
            
        } else {
            $emptyColumn[] = 'D&B Number';
        }
        return $emptyColumn;
    }

    public function validateEditInsured($postValues) {
        $emptyColumn = array();
        if (!empty($postValues['editinsuredname']) && !empty($postValues['editinsuredname'])) {
            
        } else {
            $emptyColumn[] = 'Insured Name';
        }
        if (!empty($postValues['editinsuredaddress']) && !empty($postValues['editinsuredaddress'])) {
            
        } else {
            $emptyColumn[] = 'Address Line 1';
        }
        if (isset($postValues['editinsuredcountry']) && !empty($postValues['editinsuredcountry'])) {
            
        } else {
            $emptyColumn[] = 'Country ';
        }
        if (isset($postValues['editinsuredstate']) && !empty($postValues['editinsuredstate'])) {
            
        } else {
            $emptyColumn[] = 'State ';
        }
        if (!empty($postValues['editinsuredcity']) && !empty($postValues['editinsuredcity'])) {
            
        } else {
            $emptyColumn[] = 'City';
        }
        if (!empty($postValues['editdbNumber']) && !empty($postValues['editdbNumber'])) {
            
        } else {
            $emptyColumn[] = 'D&B Number';
        }
        return $emptyColumn;
    }

}
