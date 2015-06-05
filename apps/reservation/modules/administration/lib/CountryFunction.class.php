<?php

class CountryFunction {

    private $_con = NULL;

    public function __construct() {
        $this->_con = Propel::getConnection();
    }

    public function CountryList($input) {
        $criteria = new Criteria();
        $isFilterChoosen = false;
        if ($input['countryName'] != '') {
            $filterCriteria = $criteria->add(CountrySearchPeer::FINALCOUNTRYNAME, $input['countryName'], Criteria::EQUAL);
            $isFilterChoosen = true;
        }
        if ($isFilterChoosen) {
            $criteria->add($filterCriteria);
        }
        $criteria->addDescendingOrderByColumn(CountrySearchPeer::ID);
        return $criteria;
    }

    public function CreateCountry(array $data) {
        $errFlag = false;
        if (empty($data)) {
            $errFlag = true;
            $response['msg'][] = 'You did not fill the form correctly';
            $response['success'] = false;
        } else {
            if ($errFlag == false) {
                if ($data['countryId'] != NULL) {
                    try {
                        if (empty($data['editcountryname'])) {
                            $data['editcountryname'] = null;
                        } else {
                            $data['editcountryname'] = str_replace("'", "''", $data['editcountryname']);
                        }
                        if (empty($data['editcountrycode'])) {
                            $data['editcountrycode'] = null;
                        } else {
                            $data['editcountrycode'] = $data['editcountrycode'];
                        }
                        $editfinalCountry = $data['editcountrycode'] . ' - ' . $data['editcountryname'];
                        if ($data['editCountryCodeHidden'] != trim($data['editcountrycode'])) {
                            $isCountryCode = self::isCountryCodeExists(strtolower(trim($data['editcountrycode'])));
                        }
                        if ($isCountryCode == '0' || empty($isCountryCode)) {
                            $con = Propel::getConnection();
                            $Recorderquery = "UPDATE DataRecorderMetaData SET ModifiedBy = '" . $data['userId'] . "', ModifiedOn = GetDate() WHERE Id = '" . $data['editDataRecorderIdHidden'] . "'";
                            $updateRecorderData = $con->prepare($Recorderquery);
                            $updateRecorderData->execute();

                            $countryQuery = "UPDATE Country SET InsuredCountry = '" . $editfinalCountry . "' WHERE Id = '" . $data['countryId'] . "'";
                            $updateCountryData = $con->prepare($countryQuery);
                            $updateCountryData->execute();
                        } else {
                            $errFlag = true;
                            $response['msg'][] = 'Country Code already exists';
                            $response['success'] = false;
                        }
                    } catch (Exception $e) {
                        $errFlag = true;
                        $response['msg'][] = "Exception error at updating country:" . $e->getMessage();
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
                            $data['countryname'] = str_replace("'", "''", $data['countryname']);
                        } else {
                            $data['countryname'] = null;
                        }
                        if (!empty($data['countrycode'])) {
                            $data['countrycode'] = $data['countrycode'];
                        } else {
                            $data['countrycode'] = null;
                        }
                        $finalCountry = $data['countrycode'] . ' - ' . $data['countryname'];
                        $isCountryCode = self::isCountryCodeExists(strtolower(trim($data['countrycode'])));
                        $isCountry = self::isCountryExists(strtolower(trim($data['countryname'])));
                        if ($isCountryCode == '0') {
                            if ($isCountry == '0') {
                                $countryQuery = "INSERT INTO Country 
                                    (InsuredCountry, DataRecorderMetaDataId) 
                                    VALUES 
                                    ('" . $finalCountry . "', '" . $dataRecorderId . "')";
                                $insertcountry = $con->prepare($countryQuery);
                                $insertcountry->execute();
                            } else {
                                $errFlag = true;
                                $response['msg'][] = 'Country Name already exists';
                                $response['success'] = false;
                            }
                        } else {
                            $errFlag = true;
                            $response['msg'][] = 'Country Code already exists';
                            $response['success'] = false;
                        }
                    } catch (Exception $e) {
                        $errFlag = true;
                        $response['msg'][] = "Exception error at creating Country:" . $e->getMessage() . 'At line number' . __LINE__;
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

    public static function isCountryExists($countryName) {
        $con = Propel::getConnection();
        $query = "SELECT * FROM Country WHERE rtrim(ltrim(SUBSTRING(insuredCountry,CHARINDEX('-',insuredCountry)+1,len(insuredCountry)))) = '" . $countryName . "'";
        $stmt = $con->query($query);
        $result = $stmt->fetchAll();
        if (count($result) > 0) {
            return TRUE;
        } else {
            return FALSE;
        }
    }

    public static function isCountryCodeExists($countryCode) {
        $con = Propel::getConnection();
        $query = "SELECT * FROM Country WHERE LEFT(InsuredCountry,3) = '" . $countryCode . "'";
        $stmt = $con->query($query);
        $result = $stmt->fetchAll();
        if (count($result) > 0) {
            return TRUE;
        } else {
            return FALSE;
        }
    }

    public function CountryInfo($countryId = 0) {
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

    public static function getPostContent() {
        return trim(file_get_contents("php://input"));
    }

}
