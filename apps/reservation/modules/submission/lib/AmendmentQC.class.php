<?php

class AmendmentQC {

    public function __construct() {
        $this->connection = Propel::getConnection();
    }
 
    public static function getAmendmentQcSearchCriteria($input, $column, $order) {
        $criteria = new Criteria();
        $isFilterChoosen = false;
        if ($input['SubmissionNo'] != '') {
            $filterCriteria = $criteria->add(AmendmentsubmissionqcSearchPeer::SUBMISSIONNUMBER, trim($input['SubmissionNo']) . '%', Criteria::LIKE);
            $isFilterChoosen = true;
        }
        if ($input['InsuredName'] != '') {
            $filterCriteria = $criteria->add(AmendmentsubmissionqcSearchPeer::INSUREDNAME, '%' . trim($input['InsuredName']) . '%', Criteria::LIKE);
            $isFilterChoosen = true;
        }
        if ($input['NewRenewal'] != '') {
            $filterCriteria = $criteria->add(AmendmentsubmissionqcSearchPeer::NEWRENEWAL, trim($input['NewRenewal']), Criteria::LIKE);
            $isFilterChoosen = true;
        }
        if ($input['SubmissionFromDate'] != '' && $input['SubmissionToDate'] != '') {
            $isCreateDateFilterChoosen = true;
            $createDateCriteria = $criteria->getNewCriterion(AmendmentsubmissionqcSearchPeer::CREATEDDATE, date("Y-m-d H:i:s", strtotime(str_replace('-', '/', $input['SubmissionFromDate']))), Criteria::GREATER_EQUAL);
            $createEndDateCriteria = $criteria->getNewCriterion(AmendmentsubmissionqcSearchPeer::CREATEDDATE, date("Y-m-d H:i:s", strtotime(str_replace('-', '/', $input['SubmissionToDate']) . ' + 1 day')), Criteria::LESS_THAN);
            $createDateCriteria->addAnd($createEndDateCriteria);
        } else {
            if ($input['SubmissionFromDate'] != '') {
                $dateCriteria = $criteria->add(AmendmentsubmissionqcSearchPeer::CREATEDDATE, date("Y-m-d H:i:s", strtotime(str_replace('-', '/', $input['SubmissionFromDate']))), Criteria::GREATER_EQUAL);
                $isFilterChoosen = true;
            }
            if ($input['SubmissionToDate'] != '') {
                $dateCriteria = $criteria->add(AmendmentsubmissionqcSearchPeer::CREATEDDATE, date("Y-m-d H:i:s", strtotime(str_replace('-', '/', $input['SubmissionToDate']) . ' + 1 day')), Criteria::LESS_THAN);
                $isFilterChoosen = true;
            }
        }
        if ($input['Underwriter'] != '') {
            $filterCriteria = $criteria->add(AmendmentsubmissionqcSearchPeer::UNDERWRITERNAME, trim($input['Underwriter']), Criteria::LIKE);
            $isFilterChoosen = true;
        }
        if ($input['Branch'] != '') {
            $filterCriteria = $criteria->add(AmendmentsubmissionqcSearchPeer::BRANCHNAME, trim($input['Branch']), Criteria::LIKE);
            $isFilterChoosen = true;
        }
        if ($input['Status'] != '') {
            $filterCriteria = $criteria->add(AmendmentsubmissionqcSearchPeer::STATUS, trim($input['Status']), Criteria::LIKE);
            $isFilterChoosen = true;
        }
        if ($input['ReasonCode'] != '') {
            $filterCriteria = $criteria->add(AmendmentsubmissionqcSearchPeer::REASONCODE, trim($input['ReasonCode']), Criteria::LIKE);
            $isFilterChoosen = true;
        }
        if ($input['ProductLine'] != '') {
            $filterCriteria = $criteria->add(AmendmentsubmissionqcSearchPeer::PRODUCTLINE, trim($input['ProductLine']), Criteria::LIKE);
            $isFilterChoosen = true;
        }
        if ($input['ProductLineSubType'] != '') {
            $filterCriteria = $criteria->add(AmendmentsubmissionqcSearchPeer::PRODUCTLINESUBTYPE, trim($input['ProductLineSubType']), Criteria::LIKE);
            $isFilterChoosen = true;
        }
        if ($input['Section'] != '') {
            $filterCriteria = $criteria->add(AmendmentsubmissionqcSearchPeer::SECTIONCODE, trim($input['Section']), Criteria::LIKE);
            $isFilterChoosen = true;
        }
        if ($input['ProfitCode'] != '') {
            $filterCriteria = $criteria->add(AmendmentsubmissionqcSearchPeer::PROFITCODE, trim($input['ProfitCode']), Criteria::LIKE);
            $isFilterChoosen = true;
        }
        if ($input['BrokerName'] != '') {
            $filterCriteria = $criteria->add(AmendmentsubmissionqcSearchPeer::BROKERNAME, trim($input['BrokerName']), Criteria::LIKE);
            $isFilterChoosen = true;
        }
        if ($input['BrokerType'] != '') {
            $filterCriteria = $criteria->add(AmendmentsubmissionqcSearchPeer::BROKERTYPE, trim($input['BrokerType']), Criteria::LIKE);
            $isFilterChoosen = true;
        }
        if ($input['BrokerCity'] != '') {
            $filterCriteria = $criteria->add(AmendmentsubmissionqcSearchPeer::BROKERCITY, '%' . trim($input['BrokerCity']) . '%', Criteria::LIKE);
            $isFilterChoosen = true;
        }
        if ($input['CabCompanies'] != '') {
            $filterCriteria = $criteria->add(AmendmentsubmissionqcSearchPeer::CABCOMPANIES, trim($input['CabCompanies']), Criteria::LIKE);
            $isFilterChoosen = true;
        }
        if ($input['EffectiveFromDate'] != '' && $input['EffectiveToDate'] != '') {
            $isEffectiveFilterChoosen = true;
            $effectiveDateCriteria = $criteria->getNewCriterion(AmendmentsubmissionqcSearchPeer::EFFECTIVEDATE, date("Y-m-d", strtotime(str_replace('-', '/', $input['EffectiveFromDate']))), Criteria::GREATER_EQUAL);
            $effectiveEndDateCriteria = $criteria->getNewCriterion(AmendmentsubmissionqcSearchPeer::EFFECTIVEDATE, date("Y-m-d", strtotime(str_replace('-', '/', $input['EffectiveToDate']) . ' + 1 day')), Criteria::LESS_THAN);
            $effectiveDateCriteria->addAnd($effectiveEndDateCriteria);
        } else {
            if ($input['EffectiveFromDate'] != '') {
                $dateCriteria = $criteria->add(AmendmentsubmissionqcSearchPeer::EFFECTIVEDATE, date("Y-m-d", strtotime(str_replace('-', '/', $input['EffectiveFromDate']))), Criteria::GREATER_EQUAL);
                $isFilterChoosen = true;
            }
            if ($input['EffectiveToDate'] != '') {
                $dateCriteria = $criteria->add(AmendmentsubmissionqcSearchPeer::EFFECTIVEDATE, date("Y-m-d", strtotime(str_replace('-', '/', $input['EffectiveToDate']) . ' + 1 day')), Criteria::LESS_THAN);
                $isFilterChoosen = true;
            }
        }
        if ($input['ExpirationFromDate'] != '' && $input['ExpirationToDate'] != '') {
            $isExpDateFilterChoosen = true;
            $ExpDateCriteria = $criteria->getNewCriterion(AmendmentsubmissionqcSearchPeer::EXPIRYDATE, date("Y-m-d", strtotime(str_replace('-', '/', $input['ExpirationFromDate']))), Criteria::GREATER_EQUAL);
            $ExpEndDateCriteria = $criteria->getNewCriterion(AmendmentsubmissionqcSearchPeer::EXPIRYDATE, date("Y-m-d", strtotime(str_replace('-', '/', $input['ExpirationToDate']) . ' + 1 day')), Criteria::LESS_THAN);
            $ExpDateCriteria->addAnd($ExpEndDateCriteria);
        } else {
            if ($input['ExpirationFromDate'] != '') {
                $dateCriteria = $criteria->add(AmendmentsubmissionqcSearchPeer::EXPIRYDATE, date("Y-m-d", strtotime(str_replace('-', '/', $input['ExpirationFromDate']))), Criteria::GREATER_EQUAL);
                $isFilterChoosen = true;
            }
            if ($input['ExpirationToDate'] != '') {
                $dateCriteria = $criteria->add(AmendmentsubmissionqcSearchPeer::EXPIRYDATE, date("Y-m-d", strtotime(str_replace('-', '/', $input['ExpirationToDate']) . ' + 1 day')), Criteria::LESS_THAN);
                $isFilterChoosen = true;
            }
        }
        if ($input['ProcessFromDate'] != '' && $input['ProcessToDate'] != '') {
            $isProcessDateFilterChoosen = true;
            $ProcessDateCriteria = $criteria->getNewCriterion(AmendmentsubmissionqcSearchPeer::PROCESSDATE, date("Y-m-d", strtotime(str_replace('-', '/', $input['ProcessFromDate']))), Criteria::GREATER_EQUAL);
            $ProcessEndDateCriteria = $criteria->getNewCriterion(AmendmentsubmissionqcSearchPeer::PROCESSDATE, date("Y-m-d", strtotime(str_replace('-', '/', $input['ProcessToDate']) . ' + 1 day')), Criteria::LESS_THAN);
            $ProcessDateCriteria->addAnd($ProcessEndDateCriteria);
        } else {
            if ($input['ProcessFromDate'] != '') {
                $dateCriteria = $criteria->add(AmendmentsubmissionqcSearchPeer::PROCESSDATE, date("Y-m-d", strtotime(str_replace('-', '/', $input['ProcessFromDate']))), Criteria::GREATER_EQUAL);
                $isFilterChoosen = true;
            }
            if ($input['ProcessToDate'] != '') {
                $dateCriteria = $criteria->add(AmendmentsubmissionqcSearchPeer::PROCESSDATE, date("Y-m-d", strtotime(str_replace('-', '/', $input['ProcessToDate']) . ' + 1 day')), Criteria::LESS_THAN);
                $isFilterChoosen = true;
            }
        }
        if ($input['EditFromDate'] != '' && $input['EditToDate'] != '') {
            $isEditDateFilterChoosen = true;
            $EditDateCriteria = $criteria->getNewCriterion(AmendmentsubmissionqcSearchPeer::MODIFIEDDATE, date("Y-m-d", strtotime(str_replace('-', '/', $input['EditFromDate']))), Criteria::GREATER_EQUAL);
            $EditEndDateCriteria = $criteria->getNewCriterion(AmendmentsubmissionqcSearchPeer::MODIFIEDDATE, date("Y-m-d", strtotime(str_replace('-', '/', $input['EditToDate']) . ' + 1 day')), Criteria::LESS_THAN);
            $EditDateCriteria->addAnd($EditEndDateCriteria);
        } else {
            if ($input['EditFromDate'] != '') {
                $dateCriteria = $criteria->add(AmendmentsubmissionqcSearchPeer::MODIFIEDDATE, date("Y-m-d", strtotime(str_replace('-', '/', $input['EditFromDate']))), Criteria::GREATER_EQUAL);
                $isFilterChoosen = true;
            }
            if ($input['EditToDate'] != '') {
                $dateCriteria = $criteria->add(AmendmentsubmissionqcSearchPeer::MODIFIEDDATE, date("Y-m-d", strtotime(str_replace('-', '/', $input['EditToDate']) . ' + 1 day')), Criteria::LESS_THAN);
                $isFilterChoosen = true;
            }
        }
        if ($input['EditDbaName'] != '') {
            $filterCriteria = $criteria->add(AmendmentsubmissionqcSearchPeer::DBANAME, trim($input['EditDbaName']) . '%', Criteria::LIKE);
            $isFilterChoosen = true;
        }
        if ($input['BrokerContactPerson'] != '') {
            $filterCriteria = $criteria->add(AmendmentsubmissionqcSearchPeer::BROKERCONTACTPERSON, trim($input['BrokerContactPerson']) . '%', Criteria::LIKE);
            $isFilterChoosen = true;
        }
        if ($input['NumberOfLocations'] != '') {
            $filterCriteria = $criteria->add(AmendmentsubmissionqcSearchPeer::NUMBEROFLOCATIONS, '%' . trim($input['NumberOfLocations']), Criteria::LIKE);
            $isFilterChoosen = true;
        }
        if ($input['Currency'] != '') {
            $filterCriteria = $criteria->add(AmendmentsubmissionqcSearchPeer::CURRENCY, trim($input['Currency']) . '%', Criteria::LIKE);
            $isFilterChoosen = true;
        }
        if ($input['OccupancyCode'] != '') {
            $filterCriteria = $criteria->add(AmendmentsubmissionqcSearchPeer::OCCUPANCYCODE, trim($input['OccupancyCode']) . '%', Criteria::LIKE);
            $isFilterChoosen = true;
        }
        if ($input['Renewable'] != '') {
            $filterCriteria = $criteria->add(AmendmentsubmissionqcSearchPeer::RENEWABLE, trim($input['Renewable']), Criteria::LIKE);
            $isFilterChoosen = true;
        }
        if ($input['PolicyType'] != '') {
            $filterCriteria = $criteria->add(AmendmentsubmissionqcSearchPeer::POLICYTYPE, trim($input['PolicyType']), Criteria::LIKE);
            $isFilterChoosen = true;
        }
        if ($input['DirectAssumed'] != '') {
            $filterCriteria = $criteria->add(AmendmentsubmissionqcSearchPeer::DIRECTASSUMED, trim($input['DirectAssumed']), Criteria::LIKE);
            $isFilterChoosen = true;
        }
        if ($input['CompanyPaper'] != '') {
            $filterCriteria = $criteria->add(AmendmentsubmissionqcSearchPeer::COMPANYPAPER, trim($input['CompanyPaper']), Criteria::LIKE);
            $isFilterChoosen = true;
        }
        if ($input['CompanyPaperNumber'] != '') {
            $filterCriteria = $criteria->add(AmendmentsubmissionqcSearchPeer::COMPANYPAPERNUMBER, trim($input['CompanyPaperNumber']), Criteria::LIKE);
            $isFilterChoosen = true;
        }
        if ($input['PolicyNumber'] != '') {
            $filterCriteria = $criteria->add(AmendmentsubmissionqcSearchPeer::POLICYNUMBER, trim($input['PolicyNumber']), Criteria::LIKE);
            $isFilterChoosen = true;
        }
        if ($input['Suffix'] != '') {
            $filterCriteria = $criteria->add(AmendmentsubmissionqcSearchPeer::SUFFIX, trim($input['Suffix']), Criteria::LIKE);
            $isFilterChoosen = true;
        }
        if ($input['AdmittedNonAdmitted'] != '') {
            $filterCriteria = $criteria->add(AmendmentsubmissionqcSearchPeer::ADMITTEDNONADMITTED, trim($input['AdmittedNonAdmitted']), Criteria::LIKE);
            $isFilterChoosen = true;
        }
        if ($input['DateOfRenewalFromDate'] != '' && $input['DateOfRenewalToDate'] != '') {
            $isEditDateFilterChoosen = true;
            $EditDateCriteria = $criteria->getNewCriterion(AmendmentsubmissionqcSearchPeer::DATEOFRENEWAL, date("Y-m-d", strtotime(str_replace('-', '/', $input['DateOfRenewalFromDate']))), Criteria::GREATER_EQUAL);
            $EditEndDateCriteria = $criteria->getNewCriterion(AmendmentsubmissionqcSearchPeer::DATEOFRENEWAL, date("Y-m-d", strtotime(str_replace('-', '/', $input['DateOfRenewalToDate']) . ' + 1 day')), Criteria::LESS_THAN);
            $EditDateCriteria->addAnd($EditEndDateCriteria);
        } else {
            if ($input['DateOfRenewalFromDate'] != '') {
                $dateCriteria = $criteria->add(AmendmentsubmissionqcSearchPeer::DATEOFRENEWAL, date("Y-m-d", strtotime(str_replace('-', '/', $input['DateOfRenewalFromDate']))), Criteria::GREATER_EQUAL);
                $isFilterChoosen = true;
            }
            if ($input['DateOfRenewalToDate'] != '') {
                $dateCriteria = $criteria->add(AmendmentsubmissionqcSearchPeer::DATEOFRENEWAL, date("Y-m-d", strtotime(str_replace('-', '/', $input['DateOfRenewalToDate']) . ' + 1 day')), Criteria::LESS_THAN);
                $isFilterChoosen = true;
            }
        }
        if ($input['Coverage'] != '') {
            $filterCriteria = $criteria->add(AmendmentsubmissionqcSearchPeer::COVERAGE, trim($input['Coverage']), Criteria::LIKE);
            $isFilterChoosen = true;
        }
        if ($isCreateDateFilterChoosen) {
            $criteria->add($createDateCriteria);
        }
        if ($isEffectiveFilterChoosen) {
            $criteria->add($effectiveDateCriteria);
        }
        if ($isExpDateFilterChoosen) {
            $criteria->add($ExpDateCriteria);
        }
        if ($isProcessDateFilterChoosen) {
            $criteria->add($ProcessDateCriteria);
        }
        if ($isEditDateFilterChoosen) {
            $criteria->add($EditDateCriteria);
        }
        if (isset($column)) {
            if ($column == 0 && $order == 'ASC') {
                return $criteria->addAscendingOrderByColumn(AmendmentsubmissionqcSearchPeer::QCSTATUS);
            } else if ($column == 0 && $order == 'DESC') {
                return $criteria->addDescendingOrderByColumn(AmendmentsubmissionqcSearchPeer::QCSTATUS);
            } else if ($column == 1 && $order == 'ASC') {
                return $criteria->addAscendingOrderByColumn(AmendmentsubmissionqcSearchPeer::ALTERNATIVECITY);
            } else if ($column == 1 && $order == 'DESC') {
                return $criteria->addDescendingOrderByColumn(AmendmentsubmissionqcSearchPeer::ALTERNATIVECITY);
            } else if ($column == 2 && $order == 'ASC') {
                return $criteria->addAscendingOrderByColumn(AmendmentsubmissionqcSearchPeer::NEWRENEWAL);
            } else if ($column == 2 && $order == 'DESC') {
                return $criteria->addDescendingOrderByColumn(AmendmentsubmissionqcSearchPeer::NEWRENEWAL);
            } else if ($column == 3 && $order == 'ASC') {
                return $criteria->addAscendingOrderByColumn(AmendmentsubmissionqcSearchPeer::INSUREDNAME);
            } else if ($column == 3 && $order == 'DESC') {
                return $criteria->addDescendingOrderByColumn(AmendmentsubmissionqcSearchPeer::INSUREDNAME);
            } else if ($column == 4 && $order == 'ASC') {
                return $criteria->addAscendingOrderByColumn(AmendmentsubmissionqcSearchPeer::UNDERWRITERNAME);
            } else if ($column == 4 && $order == 'DESC') {
                return $criteria->addDescendingOrderByColumn(AmendmentsubmissionqcSearchPeer::UNDERWRITERNAME);
            } else if ($column == 5 && $order == 'ASC') {
                return $criteria->addAscendingOrderByColumn(AmendmentsubmissionqcSearchPeer::PROPERTYTYPE);
            } else if ($column == 5 && $order == 'DESC') {
                return $criteria->addDescendingOrderByColumn(AmendmentsubmissionqcSearchPeer::PROPERTYTYPE);
            } else if ($column == 6 && $order == 'ASC') {
                return $criteria->addAscendingOrderByColumn(AmendmentsubmissionqcSearchPeer::CURRENTSTATUS);
            } else if ($column == 6 && $order == 'DESC') {
                return $criteria->addDescendingOrderByColumn(AmendmentsubmissionqcSearchPeer::CURRENTSTATUS);
            } else if ($column == 7 && $order == 'ASC') {
                return $criteria->addAscendingOrderByColumn(AmendmentsubmissionqcSearchPeer::EFFECTIVEDATE);
            } else if ($column == 7 && $order == 'DESC') {
                return $criteria->addDescendingOrderByColumn(AmendmentsubmissionqcSearchPeer::EFFECTIVEDATE);
            } else if ($column == 8 && $order == 'ASC') {
                return $criteria->addAscendingOrderByColumn(AmendmentsubmissionqcSearchPeer::BRANCHOFFICE);
            } else if ($column == 8 && $order == 'DESC') {
                return $criteria->addDescendingOrderByColumn(AmendmentsubmissionqcSearchPeer::BRANCHOFFICE);
            } else if ($column == 9 && $order == 'ASC') {
                return $criteria->addAscendingOrderByColumn(AmendmentsubmissionqcSearchPeer::BROKERNAME);
            } else if ($column == 9 && $order == 'DESC') {
                return $criteria->addDescendingOrderByColumn(AmendmentsubmissionqcSearchPeer::BROKERNAME);
            } else if ($column == 10 && $order == 'ASC') {
                return $criteria->addAscendingOrderByColumn(AmendmentsubmissionqcSearchPeer::CABCOMPANIES);
            } else if ($column == 10 && $order == 'DESC') {
                return $criteria->addDescendingOrderByColumn(AmendmentsubmissionqcSearchPeer::CABCOMPANIES);
            } else if ($column == 11 && $order == 'ASC') {
                return $criteria->addAscendingOrderByColumn(AmendmentsubmissionqcSearchPeer::GROSSPREMIUM);
            } else if ($column == 11 && $order == 'DESC') {
                return $criteria->addDescendingOrderByColumn(AmendmentsubmissionqcSearchPeer::GROSSPREMIUM);
            } else if ($column == 12 && $order == 'ASC') {
                return $criteria->addAscendingOrderByColumn(AmendmentsubmissionqcSearchPeer::PROJECTNAME);
            } else if ($column == 12 && $order == 'DESC') {
                return $criteria->addDescendingOrderByColumn(AmendmentsubmissionqcSearchPeer::PROJECTNAME);
            } else if ($column == 13 && $order == 'ASC') {
                return $criteria->addAscendingOrderByColumn(AmendmentsubmissionqcSearchPeer::TOTALINSUREDVALUE);
            } else if ($column == 13 && $order == 'DESC') {
                return $criteria->addDescendingOrderByColumn(AmendmentsubmissionqcSearchPeer::TOTALINSUREDVALUE);
            } else if ($column == 14 && $order == 'ASC') {
                return $criteria->addAscendingOrderByColumn(AmendmentsubmissionqcSearchPeer::PROCESSDATE);
            } else if ($column == 14 && $order == 'DESC') {
                return $criteria->addDescendingOrderByColumn(AmendmentsubmissionqcSearchPeer::PROCESSDATE);
            } else if ($column == 15 && $order == 'ASC') {
                return $criteria->addAscendingOrderByColumn(AmendmentsubmissionqcSearchPeer::DATEOFRECIEVINGBYINDIA);
            } else if ($column == 15 && $order == 'DESC') {
                return $criteria->addDescendingOrderByColumn(AmendmentsubmissionqcSearchPeer::DATEOFRECIEVINGBYINDIA);
            }
        } else {
            return $criteria->addDescendingOrderByColumn(AmendmentsubmissionqcSearchPeer::ID);
        }
    }

    public static function UpdateSubmissionAmendmentForQC($userId, $amendmentId, $postValues) {
        self::SaveHistoryForQC($userId,$amendmentId,$postValues);
        $editAmenObj = new EditSubmissionAmendment();
        $newQcStatus = $editAmenObj->GetQcStatus($postValues['qcstatus']);
        $con = Propel::getConnection();
        $query = "UPDATE SubmissionAmendment SET QCStatus = '" . $newQcStatus . "', Remarks = '".$postValues['qcremarks']."' WHERE Id = '" . $amendmentId . "'";
        $insert = $con->prepare($query);
        $insert->execute();
    }

    private static function SaveHistoryForQC($userId,$amendmentId,$newvalues) {
        $oldValues = self::getSubmissionAmendmentDetails($amendmentId);
        $editSubObj = new EditSubmissionDetails();
        $editSubObj->UpdateDataRecorderMetaData($oldValues['DataRecorderMetaDataId'], $userId);
        $editAmenObj = new EditSubmissionAmendment();
        $newQcStatus = $editAmenObj->GetQcStatus($newvalues['qcstatus']);
        $con = Propel::getConnection();
        $query = "INSERT INTO SubmissionAmendentHistory
              (SubmissionAmendentId, SubmissionNumber, NonFinancialAmendmentHistoryId, FinancialAmendmenHistorytId, QCStatus, NewSubmissionNumber, NewQCStatus, Remarks,ModifiedBy, ModifiedOn) 
               VALUES 
               ('" . $amendmentId . "','" . $oldValues['SubmissionNumber'] . "','" . $oldValues['NonFinancialAmendmentId'] . "' ,'" . $oldValues['FinancialAmendmentId'] . "', '" . $oldValues['QCStatus'] . "', '" . $oldValues['SubmissionNumber'] . "','".$newQcStatus."','".$newvalues['qcremarks']."','" . $userId . "', GETDATE())";
        $insert = $con->prepare($query);
        if ($insert->execute()) {
            return true;
        } else {
            return false;
        }
    }

    private static function getSubmissionAmendmentDetails($amendmentId) {
        $connection = Propel::getConnection();
        $submissionQuery = "SELECT * FROM  SubmissionAmendment WHERE Id = '" . $amendmentId . "'";
        $submissionStatement = $connection->prepare($submissionQuery);
        $submissionStatement->execute();
        $submissionDetail = $submissionStatement->fetchAll(PDO::FETCH_ASSOC);
        return $submissionDetail[0];
    }

}
