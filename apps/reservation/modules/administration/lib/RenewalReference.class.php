<?php

class RenewalReference {

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

    public function renewalReferenceList($input) {
        $criteria = new Criteria();
        $isFilterChoosen = false;

        if ($input['submissionNumber'] != '') {
            $filterCriteria = $criteria->add(RenewalSearchPeer::SUBMISSIONNUMBER, $input['submissionNumber'] . '%', Criteria::LIKE);
            $isFilterChoosen = true;
        }

        if ($input['accountName'] != '') {
            $filterCriteria = $criteria->add(RenewalSearchPeer::INSUREDNAME, trim($input['accountName']) . '%', Criteria::LIKE);
            $isFilterChoosen = true;
        }

        if ($isFilterChoosen) {
            $criteria->add($filterCriteria);
        }

        $criteria->addDescendingOrderByColumn(RenewalSearchPeer::ID);
        return $criteria;
    }

    public function CreateRenewalReference(array $data) {
        $errFlag = false;
        $error = array();

        if (empty($data)) {
            $errFlag = true;
            $response['msg'][] = 'You did not fill the form correctly';
            $response['success'] = false;
        } else {
            $errFlag = false;
            if ($errFlag == false) {
                if ($data['referalReferanceId'] != NULL) {
                    try {
                        if (empty($data['editRenewable'])) {
                            $data['editRenewable'] = null;
                        } else {
                            $data['editRenewable'] = $data['editRenewable'];
                        }

                        if (empty($data['editDateofRenewal'])) {
                            $data['editDateofRenewal'] = null;
                        } else {
                            $data['editDateofRenewal'] = $data['editDateofRenewal'];
                        }

                        $con = Propel::getConnection();
                        $Recorderquery = "UPDATE DataRecorderMetaData SET ModifiedBy = '" . $data['userId'] . "', ModifiedOn = GetDate() WHERE Id = '" . $data['dataRecorderDataIdHidden'] . "'";
                        $updateRecorderData = $con->prepare($Recorderquery);
                        $updateRecorderData->execute();

                        $contactQuery = "UPDATE SubmissionRenewalReference SET Renewable = '" . $data['editRenewable'] . "', DateofRenewal = '" . $data['editDateofRenewal'] . "' WHERE Id = '" . $data['referalReferanceId'] . "'";
                        $updateContactData = $con->prepare($contactQuery);
                        $updateContactData->execute();
                    } catch (Exception $e) {
                        $errFlag = true;
                        $response['msg'][] = "Exception error at updating Renewal Reference:" . $e->getMessage();
                        $response['success'] = false;
                    }
                } else {
                    $con = Propel::getConnection();
                    try {
                        $SubmissionData = RenewalReference::SubmissionNumberCheck($data['submissionNumber']);
                        if ($SubmissionData == false) {
                            $errFlag = true;
                            $response['msg'][] = 'Submission Number already exist';
                            $response['success'] = false;
                        } else {
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

                            if (empty($data['submissionNumber'])) {
                                $data['submissionNumber'] = null;
                            } else {
                                $data['submissionNumber'] = $data['submissionNumber'];
                            }

                            if (empty($data['accountName'])) {
                                $data['accountName'] = null;
                            } else {
                                $data['accountName'] = $data['accountName'];
                            }

                            if (empty($data['status'])) {
                                $data['status'] = null;
                            } else {
                                $data['status'] = $data['status'];
                            }

                            if (empty($data['renewable'])) {
                                $data['renewable'] = null;
                            } else {
                                $data['renewable'] = $data['renewable'];
                            }

                            if (empty($data['dateofRenewal'])) {
                                $data['dateofRenewal'] = null;
                            } else {
                                $data['dateofRenewal'] = $data['dateofRenewal'];
                            }
                            if ($data['status'] == 9) {
                                $referenceQuery = "INSERT INTO SubmissionRenewalReference 
                                    (SubmissionNumber, InsuredId, Status, Renewable, DateofRenewal,DataRecorderMetaDataId) 
                                    VALUES 
                                    ('" . $data['submissionNumber'] . "', '" . $data['accountName'] . "','" . $data['status'] . "','" . $data['renewable'] . "', '" . $data['dateofRenewal'] . "','$dataRecorderId')";
                                $insertReference = $con->prepare($referenceQuery);
                                $insertReference->execute();
                            } else {
                                $errFlag = true;
                                $response['msg'][] = "Renewal Reference can not created successfully, Status should be Bound";
                                $response['success'] = false;
                            }
                        }
                    } catch (Exception $e) {
                        $errFlag = true;
                        $response['msg'][] = "Exception error at creating Renewal Reference:" . $e->getMessage() . 'At line number' . __LINE__;
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

    public function getStatus() {
        $con = Propel::getConnection();
        $query = "select Id,StatusName from Status Where StatusName = 'Bound'";
        $stmt = $con->query($query);
        $result = $stmt->fetchAll();
        return $result;
    }

    public static function getCurrentStatus($submissionNumber) {
        $con = Propel::getConnection();
        $querysubmission = "select CurrentStatusId from Submission Where SubmissionNumber = '$submissionNumber'";
        $stmtsubmission = $con->query($querysubmission);
        $resultsubmission = $stmtsubmission->fetchAll();
        $statusId = $resultsubmission[0]['CurrentStatusId'];
        $query = "select Id,StatusName from Status Where Id = '$statusId'";
        $stmt = $con->query($query);
        $result = $stmt->fetchAll();
        return $result;
    }

    public static function GetAccountDetails($submissionNumber) {
        $con = Propel::getConnection();
        $query = "select InsuredId from Submission Where SubmissionNumber = '$submissionNumber'";
        $stmt = $con->query($query);
        $result = $stmt->fetchAll();
        $insuredId = $result[0]['InsuredId'];
        $query1 = "select Id, InsuredName from Insured Where Id = '$insuredId'";
        $stmt1 = $con->query($query1);
        $resultFinal = $stmt1->fetchAll();
        return $resultFinal;
    }

    public Static function GetRenewalReferenceInfo($referalReferanceId) {
        $con = Propel::getConnection();
        $query = "select * from SubmissionRenewalReference Where Id = '$referalReferanceId'";
        $stmt = $con->query($query);
        $result = $stmt->fetchAll();
        return $result;
    }

    public Static function GetInsuredInfo($insuredId) {
        $con = Propel::getConnection();
        $query = "select InsuredName from Insured Where Id = '$insuredId'";
        $stmt = $con->query($query);
        $result = $stmt->fetchAll();
        return $result;
    }

    public static function getPostContent() {
        return trim(file_get_contents("php://input"));
    }

    public static function SubmissionNumberCheck($submissionNumber) {
        $con = Propel::getConnection();
        $stmt = $con->query("SELECT Id FROM SubmissionRenewalReference WHERE SubmissionNumber = '" . $submissionNumber . "'");
        $result = $stmt->fetchAll();
        if (count($result) == 0) {
            return true;
        } else {
            return false;
        }
    }

}
