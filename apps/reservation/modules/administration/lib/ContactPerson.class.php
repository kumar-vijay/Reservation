<?php

class ContactPerson {

    private $_con = NULL;

    public function __construct() {
        $this->_con = Propel::getConnection();
    }

    public function getLookUpTypeList($where) {
        $con = Propel::getConnection();
        $query = "SELECT L.Id, L.LookupName, L.Alias FROM  LookupType as LT INNER JOIN Lookup as L ON LT.Id = L.LookupTypeId WHERE LT.LookupTypeName = '$where'";
        $stmt = $con->query($query);
        $result = $stmt->fetchAll();
        return $result;
    }

    public function contactPersonList($input) {
        $criteria = new Criteria();
        $isFilterChoosen = false;

        if ($input['partyType'] != '') {
            $filterCriteria = $criteria->add(ContactpersonSearchPeer::PARTYTYPE, $input['partyType'] . '%', Criteria::LIKE);
            $isFilterChoosen = true;
        }

        if ($input['companyName'] != '') {
            if ($input['partyType'] == 'Broker') {
                $filterCriteria = $criteria->add(ContactpersonSearchPeer::BROKERNAME, trim($input['companyName']). '%', Criteria::LIKE);
                $isFilterChoosen = true;
            } else if ($input['partyType'] == 'Insured') {
                $filterCriteria = $criteria->add(ContactpersonSearchPeer::INSUREDNAME, trim($input['companyName']). '%', Criteria::LIKE);
                $isFilterChoosen = true;
            }
        }

        if ($input['contactPersonFirstName'] != '') {
            $filterCriteria = $criteria->add(ContactpersonSearchPeer::FIRSTNAME, trim($input['contactPersonFirstName']) . '%', Criteria::LIKE);
            $isFilterChoosen = true;
        }

        if ($input['contactPersonLastName'] != '') {
            $filterCriteria = $criteria->add(ContactpersonSearchPeer::LASTNAME, trim($input['contactPersonLastName']) . '%', Criteria::LIKE);
            $isFilterChoosen = true;
        }

        if ($isFilterChoosen) {
            $criteria->add($filterCriteria);
        }

        $criteria->addDescendingOrderByColumn(ContactpersonSearchPeer::ID);
        return $criteria;
    }

    public function CreateContactPerson(array $data) {
        $errFlag = false;
        $error = array();

        if (empty($data)) {
            $errFlag = true;
            $response['msg'][] = 'You did not fill the form correctly';
            $response['success'] = false;
        } else {
            $errFlag = false;
            if ($errFlag == false) {
                if ($data['contactPersonId'] != NULL) {
                    try {
                        if (empty($data['editpertytype'])) {
                            $data['editpertytype'] = null;
                        } else {
                            $data['editpertytype'] = str_replace("'", "''", $data['editpertytype']);
                        }

                        if (empty($data['editcompanyname'])) {
                            $data['editcompanyname'] = null;
                        } else {
                            $companyName = explode('|', $data['editcompanyname']);
                            $data['editcompanyname'] = $this->GetCompanyId($companyName, $data['editpertytype']);
                        }
                       
                        if (empty($data['edittitle'])) {
                            $data['edittitle'] = null;
                        } else {
                            $data['edittitle'] = $data['edittitle']; 
                        }

                        if (empty($data['editfirstname'])) {
                            $data['editfirstname'] = null;
                        } else {
                            $data['editfirstname'] = $data['editfirstname'];
                        }

                        if (empty($data['editlastname'])) {
                            $data['editlastname'] = null;
                        } else {
                            $data['editlastname'] = $data['editlastname'];
                        }

                        if (empty($data['editfunction'])) {
                            $data['editfunction'] = null;
                        } else {
                            $data['editfunction'] = $data['editfunction'];
                        }

                        if (empty($data['editemailaddress'])) {
                            $data['editemailaddress'] = null;
                        } else {
                            $data['editemailaddress'] = str_replace("'", "''", $data['editemailaddress']);
                        }

                        if (empty($data['editphonenumber'])) {
                            $data['editphonenumber'] = null;
                        } else {
                            $data['editphonenumber'] = $data['editphonenumber'];
                        }

                        if (empty($data['editmobilenumber'])) {
                            $data['editmobilenumber'] = null;
                        } else {
                            $data['editmobilenumber'] = $data['editmobilenumber'];
                        }

                        if (empty($data['editfax'])) {
                            $data['editfax'] = null;
                        } else {
                            $data['editfax'] = $data['editfax'];
                        }

                        $con = Propel::getConnection();
                        $Recorderquery = "UPDATE DataRecorderMetaData SET ModifiedBy = '" . $data['userId'] . "', ModifiedOn = GetDate() WHERE Id = '" . $data['dataRecorderDataIdHidden'] . "'";
                        $updateRecorderData = $con->prepare($Recorderquery);
                        $updateRecorderData->execute();

                        $contactQuery = "UPDATE ContactPersonDetails SET PartyTypeId = '" . $data['editpertytype'] . "', CompanyId = '" . $data['editcompanyname'] . "', Title = '" . $data['edittitle'] . "', FirstName = '" . $data['editfirstname'] . "', LastName = '" . $data['editlastname'] . "', PartyFunction = '" . $data['editfunction'] . "', Email = '" . $data['editemailaddress'] . "', PhoneNumber = '" . $data['editphonenumber'] . "', MobileNumber = '" . $data['editmobilenumber'] . "', Fax = '" . $data['editfax'] . "' WHERE Id = '" . $data['contactPersonId'] . "'";
                        $updateContactData = $con->prepare($contactQuery);
                        $updateContactData->execute();
                    } catch (Exception $e) {
                        $errFlag = true;
                        $response['msg'][] = "Exception error at updating contact person:" . $e->getMessage();
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

                        if (empty($data['pertytype'])) {
                            $data['pertytype'] = null;
                        } else {
                            $data['pertytype'] = $data['pertytype'];
                        }

                        if (empty($data['companyname'])) {
                            $data['companyname'] = null;
                        } else {
                            $companyName = explode('|', $data['companyname']);
                            $data['companyname'] = $this->GetCompanyId($companyName, $data['pertytype']);
                        }

                        if (empty($data['title'])) {
                            $data['title'] = null;
                        } else {
                            $data['title'] = str_replace("'", "''", $data['title']);
                        }

                        if (empty($data['firstname'])) {
                            $data['firstname'] = null;
                        } else {
                            $data['firstname'] = str_replace("'", "''", $data['firstname']);
                        }

                        if (empty($data['lastname'])) {
                            $data['lastname'] = null;
                        } else {
                            $data['lastname'] = str_replace("'", "''", $data['lastname']);
                        }

                        if (empty($data['function'])) {
                            $data['function'] = null;
                        } else {
                            $data['function'] = str_replace("'", "''", $data['function']);
                        }

                        if (empty($data['emailaddress'])) {
                            $data['emailaddress'] = null;
                        } else {
                            $data['emailaddress'] = str_replace("'", "''", $data['emailaddress']);
                        }

                        if (empty($data['phonenumber'])) {
                            $data['phonenumber'] = null;
                        } else {
                            $data['phonenumber'] = $data['phonenumber'];
                        }

                        if (empty($data['mobilenumber'])) {
                            $data['mobilenumber'] = null;
                        } else {
                            $data['mobilenumber'] = $data['mobilenumber'];
                        }

                        if (empty($data['fax'])) {
                            $data['fax'] = null;
                        } else {
                            $data['fax'] = $data['fax'];
                        }

                        $brokerQuery = "INSERT INTO ContactPersonDetails 
                                    (PartyTypeId, CompanyId, Title, FirstName, LastName, PartyFunction, Email, PhoneNumber, MobileNumber, Fax, DataRecorderMetaDataId) 
                                    VALUES 
                                    ('" . $data['pertytype'] . "', '" . $data['companyname'] . "','" . $data['title'] . "','" . $data['firstname'] . "', '" . $data['lastname'] . "', '" . $data['function'] . "' ,'" . $data['emailaddress'] . "','" . $data['phonenumber'] . "','" . $data['mobilenumber'] . "', '" . $data['fax'] . "','$dataRecorderId')";
                        $insertBroker = $con->prepare($brokerQuery);
                        $insertBroker->execute();
                    } catch (Exception $e) {
                        $errFlag = true;
                        $response['msg'][] = "Exception error at creating contact person:" . $e->getMessage() . 'At line number' . __LINE__;
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

    public static function GetCompanyInfo($companyString, $partyType) {
        if (!empty($partyType)) {
            $con = Propel::getConnection();
            if ($partyType == 97) {
                $stmt = $con->query("Select B.BrokerName, Co.InsuredCountry As Country, S.FullCode As State,C.CityFullCode As City from Broker AS B LEFT JOIN BrokerWiseCity AS BW on B.Id = BW.BrokerId LEFT JOIN City AS C on C.Id = BW.CityId LEFT JOIN State AS S on C.StateId = S.Id LEFT JOIN Country AS Co on S.CountryId = Co.Id
                                     WHERE BrokerName LIKE '" . trim($companyString) . "%';");
            } else if ($partyType == 98) {
                $stmt = $con->query("SELECT InsuredName, Country, State, City, AddressLine1 FROM Insured WHERE InsuredName LIKE '" . trim($companyString) . "%';");
            }
            $result = $stmt->fetchAll(PDO::FETCH_ASSOC);
            return $result;
        }
    }

    public static function GetCompanyId($companyString, $partyType) {
        if (!empty($partyType)) {
            $con = Propel::getConnection();
            if ($partyType == 97) {
                $newObj = new ContactPerson();
                $country = $newObj->getCountryId($companyString[1]);
                $state = $newObj->getStateId($companyString[2], $country);
                $city = $newObj->GetCityId($companyString[3], $state);
                $stmt = $con->query("SELECT BW.Id FROM Broker AS B LEFT JOIN BrokerWiseCity AS BW on B.Id = BW.BrokerId LEFT JOIN City AS C on C.Id = BW.CityId LEFT JOIN State AS S on C.StateId = S.Id WHERE B.BrokerName LIKE '" . trim($companyString[0]) . "%' AND BW.CityId =  $city AND BW.StateId  = $state;");
            } else if ($partyType == 98) {
                $stmt = $con->query("SELECT Id FROM Insured WHERE InsuredName LIKE '" . trim(str_replace("'", "''", $companyString[0])) . "%'AND Country LIKE '" . trim($companyString[1]) . "%' AND State LIKE '" . trim($companyString[2]) . "%' AND City LIKE '" . trim($companyString[3]) . "%' AND AddressLine1 LIKE '" . trim($companyString[4]) . "%';");
            }
            $result = $stmt->fetchAll(PDO::FETCH_ASSOC);
            return $result[0]['Id'];
        }
    }

    public function getLookUpdata($lookupId) {
        $con = Propel::getConnection();
        $query = "SELECT * FROM Lookup WHERE Id = '" . $lookupId . "'";
        $stmt = $con->query($query);
        $result = $stmt->fetchAll();
        return $result;
    }

    public static function GetContactPersonInfo($contactPersonId) {
        $con = Propel::getConnection();
        $stmt = $con->query("SELECT CP.* From ContactPersonDetails AS CP WHERE CP.Id = $contactPersonId");
        $result = $stmt->fetchAll(PDO::FETCH_OBJ);
        return $result[0];
    }

    public static function GetCompanyInfoData($partyType, $companyId) {
        if (!empty($partyType)) {
            $con = Propel::getConnection();
            if ($partyType == 97) {
                $stmt = $con->query("SELECT (B.BrokerName +' | '+ Co.InsuredCountry +' | '+ S.FullCode +' | '+ C.CityFullCode) AS name FROM BrokerWiseCity AS BW LEFT JOIN Broker As B on BW.BrokerId = B.Id LEFT JOIN City As C on BW.CityId = C.Id LEFT JOIN State As S on C.StateId = S.Id LEFT JOIN Country As Co on S.CountryId = Co.Id WHERE BW.Id = $companyId");
            } else if ($partyType == 98) {
                $stmt = $con->query("SELECT (InsuredName +' | '+ Country +' | '+ State +' | '+ City+' | '+ AddressLine1) As name FROM Insured WHERE Id = $companyId");
            }
            $result = $stmt->fetchAll(PDO::FETCH_ASSOC);
            return $result[0]['name'];
        }
    }
    
    public function getCountryId($stateName) {
        $countryName = trim($stateName);
        $con = Propel::getConnection();
        $qry = "SELECT Id FROM Country WHERE InsuredCOuntry LIKE " . "'$countryName'";
        $stmt = $con->query($qry);
        $result = $stmt->fetchAll();
        $countryId = $result[0]['Id'];
        return $countryId;
    }
    
    public function getStateId($stateName, $countryId) {
        $stateName = trim($stateName);
        $con = Propel::getConnection();
        $qry = "SELECT Id FROM State WHERE FullCode LIKE " . "'$stateName' and CountryId = '$countryId'";
        $stmt = $con->query($qry);
        $result = $stmt->fetchAll();
        $stateId = $result[0]['Id'];
        return $stateId;
    }

    public function GetCityId($cityName, $stateId) {
        $cityName = trim($cityName);
        $con = Propel::getConnection();
        $qry = "SELECT Id FROM City WHERE CityFullCode LIKE " . "'$cityName' and StateId = '$stateId'";
        $stmt = $con->query($qry);
        $result = $stmt->fetchAll();
        $cityId = $result[0]['Id'];
        return $cityId;
    }

}


