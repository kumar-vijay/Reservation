<?php

class SubmissionDetails {

    private $_con = NULL;

    public function __construct() {
        $this->_con = Propel::getConnection();
    }

    public static function getBranchOffice() {
        $con = Propel::getConnection();
        $stmt = $con->query("SELECT * FROM Branch;");
        return $stmt->fetchAll(PDO::FETCH_OBJ);
    }

    public static function getUnderWriterName($underwriterId) {
        $con = Propel::getConnection();
        if (empty($underwriterId)) {
            $stmt = $con->query("SELECT * FROM Underwriter order by Name ASC ;");
        } else {
            $stmt = $con->query("SELECT * FROM Underwriter WHERE Id = '" . $underwriterId . "' order by Name ASC ;");
        }
        return $stmt->fetchAll(PDO::FETCH_OBJ);
    }

    public static function getProductLineSubTypeName($submissionType) {
        $con = Propel::getConnection();
        $stmt = $con->query("SELECT PRODUCT_ID, PRODUCT_NAME FROM  ProductLine WHERE SUBMISSION_TYPE = '" . $submissionType . "';");
        return $stmt->fetchAll(PDO::FETCH_OBJ);
    }

    public static function getSearchCriteria($input, $column, $order) {
        $criteria = new Criteria();
        $isFilterChoosen = false;

        if ($input['SubmissionNo'] != '') {
            $filterCriteria = $criteria->add(SubmissionSearchPeer::SUBMISSIONNUMBER, substr(trim($input['SubmissionNo']), 0, -3) . '%', Criteria::LIKE);
            $isFilterChoosen = true;
        }

        if ($input['InsuredName'] != '') {
            $filterCriteria = $criteria->add(SubmissionSearchPeer::INSUREDNAME, '%' . trim($input['InsuredName']) . '%', Criteria::LIKE);
            $isFilterChoosen = true;
        }

        if ($input['NewRenewal'] != '') {
            $filterCriteria = $criteria->add(SubmissionSearchPeer::NEWRENEWAL, trim($input['NewRenewal']), Criteria::LIKE);
            $isFilterChoosen = true;
        }

        if ($input['SubmissionFromDate'] != '' && $input['SubmissionToDate'] != '') {
            $isCreateDateFilterChoosen = true;
            $createDateCriteria = $criteria->getNewCriterion(SubmissionSearchPeer::CREATEDDATE, date("Y-m-d H:i:s", strtotime(str_replace('-', '/', $input['SubmissionFromDate']))), Criteria::GREATER_EQUAL);
            $createEndDateCriteria = $criteria->getNewCriterion(SubmissionSearchPeer::CREATEDDATE, date("Y-m-d H:i:s", strtotime(str_replace('-', '/', $input['SubmissionToDate']) . ' + 1 day')), Criteria::LESS_THAN);
            $createDateCriteria->addAnd($createEndDateCriteria);
        } else {
            if ($input['SubmissionFromDate'] != '') {
                $dateCriteria = $criteria->add(SubmissionSearchPeer::CREATEDDATE, date("Y-m-d H:i:s", strtotime(str_replace('-', '/', $input['SubmissionFromDate']))), Criteria::GREATER_EQUAL);
                $isFilterChoosen = true;
            }

            if ($input['SubmissionToDate'] != '') {
                $dateCriteria = $criteria->add(SubmissionSearchPeer::CREATEDDATE, date("Y-m-d H:i:s", strtotime(str_replace('-', '/', $input['SubmissionToDate']) . ' + 1 day')), Criteria::LESS_THAN);
                $isFilterChoosen = true;
            }
        }

        if ($input['UnderwriterName'] != '') {
            $filterCriteria = $criteria->add(SubmissionSearchPeer::UNDERWRITERNAME, '%' . trim($input['UnderwriterName']), Criteria::LIKE);
            $isFilterChoosen = true;
        }

        if ($input['Branch'] != '') {
            $filterCriteria = $criteria->add(SubmissionSearchPeer::BRANCHOFFICE, trim($input['Branch']), Criteria::LIKE);
            $isFilterChoosen = true;
        }

        if ($input['Status'] != '') {
            if ($input['Status'] == 'Cancellation' || $input['Status'] == 'Endorsement') {
                $input['Status'] = 0;
                $filterCriteria = $criteria->add(SubmissionSearchPeer::AMENDMENTCOUNT, trim($input['Status']), Criteria::GREATER_THAN);
                $isFilterChoosen = true;
            } else {
                $filterCriteria = $criteria->add(SubmissionSearchPeer::CURRENTSTATUS, trim($input['Status']), Criteria::LIKE);
                $isFilterChoosen = true;
            }
        }

        if ($input['ReasonCode'] != '') {
            $filterCriteria = $criteria->add(SubmissionSearchPeer::REASONCODE, trim($input['ReasonCode']) . '%', Criteria::LIKE);
            $isFilterChoosen = true;
        }

        if ($input['ProductLine'] != '') {
            $filterCriteria = $criteria->add(SubmissionSearchPeer::PROPERTYTYPE, trim($input['ProductLine']), Criteria::LIKE);
            $isFilterChoosen = true;
        }

        if ($input['ProductLineSubType'] != '') {
            $filterCriteria = $criteria->add(SubmissionSearchPeer::PROPERTYLINESUBTYPE, trim($input['ProductLineSubType']), Criteria::LIKE);
            $isFilterChoosen = true;
        }

        if ($input['Section'] != '') {
            $filterCriteria = $criteria->add(SubmissionSearchPeer::SECTIONCODE, trim($input['Section']), Criteria::LIKE);
            $isFilterChoosen = true;
        }

        if ($input['ProfitCode'] != '') {
            $filterCriteria = $criteria->add(SubmissionSearchPeer::PROFITCODE, trim($input['ProfitCode']), Criteria::LIKE);
            $isFilterChoosen = true;
        }

        if ($input['BrokerName'] != '') {
            $filterCriteria = $criteria->add(SubmissionSearchPeer::BROKERNAME, trim($input['BrokerName']), Criteria::LIKE);
            $isFilterChoosen = true;
        }

        if ($input['BrokerType'] != '') {
            $filterCriteria = $criteria->add(SubmissionSearchPeer::BROKERTYPE, trim($input['BrokerType']), Criteria::EQUAL);
            $isFilterChoosen = true;
        }

        if ($input['BrokerCity'] != '') {
            $filterCriteria = $criteria->add(SubmissionSearchPeer::BROKERCITY, '%' . trim($input['BrokerCity']) . '%', Criteria::LIKE);
            $isFilterChoosen = true;
        }

        if ($input['CabCompanies'] != '') {
            $filterCriteria = $criteria->add(SubmissionSearchPeer::CABCOMPANIES, trim($input['CabCompanies']), Criteria::LIKE);
            $isFilterChoosen = true;
        }

        if ($input['EffectiveFromDate'] != '' && $input['EffectiveToDate'] != '') {
            $isEffectiveFilterChoosen = true;
            $effectiveDateCriteria = $criteria->getNewCriterion(SubmissionSearchPeer::EFFECTIVEDATE, date("Y-m-d", strtotime(str_replace('-', '/', $input['EffectiveFromDate']))), Criteria::GREATER_EQUAL);
            $effectiveEndDateCriteria = $criteria->getNewCriterion(SubmissionSearchPeer::EFFECTIVEDATE, date("Y-m-d", strtotime(str_replace('-', '/', $input['EffectiveToDate']) . ' + 1 day')), Criteria::LESS_THAN);
            $effectiveDateCriteria->addAnd($effectiveEndDateCriteria);
        } else {

            if ($input['EffectiveFromDate'] != '') {
                $dateCriteria = $criteria->add(SubmissionSearchPeer::EFFECTIVEDATE, date("Y-m-d", strtotime(str_replace('-', '/', $input['EffectiveFromDate']))), Criteria::GREATER_EQUAL);
                $isFilterChoosen = true;
            }

            if ($input['EffectiveToDate'] != '') {
                $dateCriteria = $criteria->add(SubmissionSearchPeer::EFFECTIVEDATE, date("Y-m-d", strtotime(str_replace('-', '/', $input['EffectiveToDate']) . ' + 1 day')), Criteria::LESS_THAN);
                $isFilterChoosen = true;
            }
        }

        if ($input['ExpirationFromDate'] != '' && $input['ExpirationToDate'] != '') {
            $isExpDateFilterChoosen = true;
            $ExpDateCriteria = $criteria->getNewCriterion(SubmissionSearchPeer::EXPIRYDATE, date("Y-m-d", strtotime(str_replace('-', '/', $input['ExpirationFromDate']))), Criteria::GREATER_EQUAL);
            $ExpEndDateCriteria = $criteria->getNewCriterion(SubmissionSearchPeer::EXPIRYDATE, date("Y-m-d", strtotime(str_replace('-', '/', $input['ExpirationToDate']) . ' + 1 day')), Criteria::LESS_THAN);
            $ExpDateCriteria->addAnd($ExpEndDateCriteria);
        } else {
            if ($input['ExpirationFromDate'] != '') {
                $dateCriteria = $criteria->add(SubmissionSearchPeer::EXPIRYDATE, date("Y-m-d", strtotime(str_replace('-', '/', $input['ExpirationFromDate']))), Criteria::GREATER_EQUAL);
                $isFilterChoosen = true;
            }

            if ($input['ExpirationToDate'] != '') {
                $dateCriteria = $criteria->add(SubmissionSearchPeer::EXPIRYDATE, date("Y-m-d", strtotime(str_replace('-', '/', $input['ExpirationToDate']) . ' + 1 day')), Criteria::LESS_THAN);
                $isFilterChoosen = true;
            }
        }

        if ($input['ProcessFromDate'] != '' && $input['ProcessToDate'] != '') {
            $isProcessDateFilterChoosen = true;
            $ProcessDateCriteria = $criteria->getNewCriterion(SubmissionSearchPeer::PROCESSDATE, date("Y-m-d", strtotime(str_replace('-', '/', $input['ProcessFromDate']))), Criteria::GREATER_EQUAL);
            $ProcessEndDateCriteria = $criteria->getNewCriterion(SubmissionSearchPeer::PROCESSDATE, date("Y-m-d", strtotime(str_replace('-', '/', $input['ProcessToDate']) . ' + 1 day')), Criteria::LESS_THAN);
            $ProcessDateCriteria->addAnd($ProcessEndDateCriteria);
        } else {
            if ($input['ProcessFromDate'] != '') {
                $dateCriteria = $criteria->add(SubmissionSearchPeer::PROCESSDATE, date("Y-m-d", strtotime(str_replace('-', '/', $input['ProcessFromDate']))), Criteria::GREATER_EQUAL);
                $isFilterChoosen = true;
            }

            if ($input['ProcessToDate'] != '') {
                $dateCriteria = $criteria->add(SubmissionSearchPeer::PROCESSDATE, date("Y-m-d", strtotime(str_replace('-', '/', $input['ProcessToDate']) . ' + 1 day')), Criteria::LESS_THAN);
                $isFilterChoosen = true;
            }
        }

        if ($input['EditFromDate'] != '' && $input['EditToDate'] != '') {
            $isEditDateFilterChoosen = true;
            $EditDateCriteria = $criteria->getNewCriterion(SubmissionSearchPeer::MODIFIEDDATE, date("Y-m-d", strtotime(str_replace('-', '/', $input['EditFromDate']))), Criteria::GREATER_EQUAL);
            $EditEndDateCriteria = $criteria->getNewCriterion(SubmissionSearchPeer::MODIFIEDDATE, date("Y-m-d", strtotime(str_replace('-', '/', $input['EditToDate']) . ' + 1 day')), Criteria::LESS_THAN);
            $EditDateCriteria->addAnd($EditEndDateCriteria);
        } else {
            if ($input['EditFromDate'] != '') {
                $dateCriteria = $criteria->add(SubmissionSearchPeer::MODIFIEDDATE, date("Y-m-d", strtotime(str_replace('-', '/', $input['EditFromDate']))), Criteria::GREATER_EQUAL);
                $isFilterChoosen = true;
            }
            if ($input['EditToDate'] != '') {
                $dateCriteria = $criteria->add(SubmissionSearchPeer::MODIFIEDDATE, date("Y-m-d", strtotime(str_replace('-', '/', $input['EditToDate']) . ' + 1 day')), Criteria::LESS_THAN);
                $isFilterChoosen = true;
            }
        }

        if ($input['QcStatus'] != '') {
            $filterCriteria = $criteria->add(SubmissionSearchPeer::QCSTATUS, trim($input['QcStatus']), Criteria::LIKE);
            $isFilterChoosen = true;
        }

        if ($input['DbaName'] != '') {
            $filterCriteria = $criteria->add(SubmissionSearchPeer::DBANAME, trim($input['DbaName']) . '%', Criteria::LIKE);
            $isFilterChoosen = true;
        }

        if ($input['BrokerContactPerson'] != '') {
            $filterCriteria = $criteria->add(SubmissionSearchPeer::BROKERCONTACTPERSON, trim($input['BrokerContactPerson']) . '%', Criteria::LIKE);
            $isFilterChoosen = true;
        }

        if ($input['NumberOfLocations'] != '') {
            $filterCriteria = $criteria->add(SubmissionSearchPeer::ALTERNATIVESTATE, '%' . trim($input['NumberOfLocations']), Criteria::LIKE);
            $isFilterChoosen = true;
        }

        if ($input['OccupancyCode'] != '') {
            $filterCriteria = $criteria->add(SubmissionSearchPeer::ALTERNATIVEZIPCODE, trim($input['OccupancyCode']) . '%', Criteria::LIKE);
            $isFilterChoosen = true;
        }

        if ($input['Currency'] != '') {
            $filterCriteria = $criteria->add(SubmissionSearchPeer::CURRENCY, trim($input['Currency']) . '%', Criteria::LIKE);
            $isFilterChoosen = true;
        }

        if ($input['Renewable'] != '') {
            $filterCriteria = $criteria->add(SubmissionSearchPeer::RENEWABLE, trim($input['Renewable']), Criteria::LIKE);
            $isFilterChoosen = true;
        }

        if ($input['PolicyType'] != '') {
            $filterCriteria = $criteria->add(SubmissionSearchPeer::POLICYTYPE, trim($input['PolicyType']), Criteria::LIKE);
            $isFilterChoosen = true;
        }

        if ($input['DirectAssumed'] != '') {
            $filterCriteria = $criteria->add(SubmissionSearchPeer::DIRECTASSUMED, trim($input['DirectAssumed']), Criteria::LIKE);
            $isFilterChoosen = true;
        }

        if ($input['CompanyPaper'] != '') {
            $filterCriteria = $criteria->add(SubmissionSearchPeer::COMPANYPAPER, trim($input['CompanyPaper']), Criteria::LIKE);
            $isFilterChoosen = true;
        }

        if ($input['CompanyPaperNumber'] != '') {
            $filterCriteria = $criteria->add(SubmissionSearchPeer::COMPANYPAPERNUMBER, trim($input['CompanyPaperNumber']), Criteria::LIKE);
            $isFilterChoosen = true;
        }

        if ($input['PolicyNumber'] != '') {
            $filterCriteria = $criteria->add(SubmissionSearchPeer::POLICYNUMBER, trim($input['PolicyNumber']), Criteria::LIKE);
            $isFilterChoosen = true;
        }

        if ($input['Suffix'] != '') {
            $filterCriteria = $criteria->add(SubmissionSearchPeer::SUFFIX, trim($input['Suffix']), Criteria::LIKE);
            $isFilterChoosen = true;
        }

        if ($input['AdmittedNonAdmitted'] != '') {
            $filterCriteria = $criteria->add(SubmissionSearchPeer::ADMITTEDNONADMITTED, trim($input['AdmittedNonAdmitted']), Criteria::LIKE);
            $isFilterChoosen = true;
        }

        if ($input['DateOfRenewalFromDate'] != '' && $input['DateOfRenewalToDate'] != '') {
            $isEditDateFilterChoosen = true;
            $EditDateCriteria = $criteria->getNewCriterion(SubmissionSearchPeer::DATEOFRENEWAL, date("Y-m-d", strtotime(str_replace('-', '/', $input['DateOfRenewalFromDate']))), Criteria::GREATER_EQUAL);
            $EditEndDateCriteria = $criteria->getNewCriterion(SubmissionSearchPeer::DATEOFRENEWAL, date("Y-m-d", strtotime(str_replace('-', '/', $input['DateOfRenewalToDate']) . ' + 1 day')), Criteria::LESS_THAN);
            $EditDateCriteria->addAnd($EditEndDateCriteria);
        } else {
            if ($input['DateOfRenewalFromDate'] != '') {
                $dateCriteria = $criteria->add(SubmissionSearchPeer::DATEOFRENEWAL, date("Y-m-d", strtotime(str_replace('-', '/', $input['DateOfRenewalFromDate']))), Criteria::GREATER_EQUAL);
                $isFilterChoosen = true;
            }
            if ($input['DateOfRenewalToDate'] != '') {
                $dateCriteria = $criteria->add(SubmissionSearchPeer::DATEOFRENEWAL, date("Y-m-d", strtotime(str_replace('-', '/', $input['DateOfRenewalToDate']) . ' + 1 day')), Criteria::LESS_THAN);
                $isFilterChoosen = true;
            }
        }

        if ($input['Coverage'] != '') {
            $filterCriteria = $criteria->add(SubmissionSearchPeer::COVERAGE, trim($input['Coverage']), Criteria::LIKE);
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
                return $criteria->addAscendingOrderByColumn(SubmissionSearchPeer::QCSTATUS);
            } else if ($column == 0 && $order == 'DESC') {
                return $criteria->addDescendingOrderByColumn(SubmissionSearchPeer::QCSTATUS);
            } else if ($column == 1 && $order == 'ASC') {
                return $criteria->addAscendingOrderByColumn(SubmissionSearchPeer::ALTERNATIVECITY);
            } else if ($column == 1 && $order == 'DESC') {
                return $criteria->addDescendingOrderByColumn(SubmissionSearchPeer::ALTERNATIVECITY);
            } else if ($column == 2 && $order == 'ASC') {
                return $criteria->addAscendingOrderByColumn(SubmissionSearchPeer::NEWRENEWAL);
            } else if ($column == 2 && $order == 'DESC') {
                return $criteria->addDescendingOrderByColumn(SubmissionSearchPeer::NEWRENEWAL);
            } else if ($column == 3 && $order == 'ASC') {
                return $criteria->addAscendingOrderByColumn(SubmissionSearchPeer::INSUREDNAME);
            } else if ($column == 3 && $order == 'DESC') {
                return $criteria->addDescendingOrderByColumn(SubmissionSearchPeer::INSUREDNAME);
            } else if ($column == 4 && $order == 'ASC') {
                return $criteria->addAscendingOrderByColumn(SubmissionSearchPeer::UNDERWRITERNAME);
            } else if ($column == 4 && $order == 'DESC') {
                return $criteria->addDescendingOrderByColumn(SubmissionSearchPeer::UNDERWRITERNAME);
            } else if ($column == 5 && $order == 'ASC') {
                return $criteria->addAscendingOrderByColumn(SubmissionSearchPeer::PROPERTYTYPE);
            } else if ($column == 5 && $order == 'DESC') {
                return $criteria->addDescendingOrderByColumn(SubmissionSearchPeer::PROPERTYTYPE);
            } else if ($column == 6 && $order == 'ASC') {
                return $criteria->addAscendingOrderByColumn(SubmissionSearchPeer::CURRENTSTATUS);
            } else if ($column == 6 && $order == 'DESC') {
                return $criteria->addDescendingOrderByColumn(SubmissionSearchPeer::CURRENTSTATUS);
            } else if ($column == 7 && $order == 'ASC') {
                return $criteria->addAscendingOrderByColumn(SubmissionSearchPeer::EFFECTIVEDATE);
            } else if ($column == 7 && $order == 'DESC') {
                return $criteria->addDescendingOrderByColumn(SubmissionSearchPeer::EFFECTIVEDATE);
            } else if ($column == 8 && $order == 'ASC') {
                return $criteria->addAscendingOrderByColumn(SubmissionSearchPeer::BRANCHOFFICE);
            } else if ($column == 8 && $order == 'DESC') {
                return $criteria->addDescendingOrderByColumn(SubmissionSearchPeer::BRANCHOFFICE);
            } else if ($column == 9 && $order == 'ASC') {
                return $criteria->addAscendingOrderByColumn(SubmissionSearchPeer::BROKERNAME);
            } else if ($column == 9 && $order == 'DESC') {
                return $criteria->addDescendingOrderByColumn(SubmissionSearchPeer::BROKERNAME);
            } else if ($column == 10 && $order == 'ASC') {
                return $criteria->addAscendingOrderByColumn(SubmissionSearchPeer::CABCOMPANIES);
            } else if ($column == 10 && $order == 'DESC') {
                return $criteria->addDescendingOrderByColumn(SubmissionSearchPeer::CABCOMPANIES);
            } else if ($column == 11 && $order == 'ASC') {
                return $criteria->addAscendingOrderByColumn(SubmissionSearchPeer::GROSSPREMIUM);
            } else if ($column == 11 && $order == 'DESC') {
                return $criteria->addDescendingOrderByColumn(SubmissionSearchPeer::GROSSPREMIUM);
            } else if ($column == 12 && $order == 'ASC') {
                return $criteria->addAscendingOrderByColumn(SubmissionSearchPeer::PROJECTNAME);
            } else if ($column == 12 && $order == 'DESC') {
                return $criteria->addDescendingOrderByColumn(SubmissionSearchPeer::PROJECTNAME);
            } else if ($column == 13 && $order == 'ASC') {
                return $criteria->addAscendingOrderByColumn(SubmissionSearchPeer::TOTALINSUREDVALUE);
            } else if ($column == 13 && $order == 'DESC') {
                return $criteria->addDescendingOrderByColumn(SubmissionSearchPeer::TOTALINSUREDVALUE);
            } else if ($column == 14 && $order == 'ASC') {
                return $criteria->addAscendingOrderByColumn(SubmissionSearchPeer::PROCESSDATE);
            } else if ($column == 14 && $order == 'DESC') {
                return $criteria->addDescendingOrderByColumn(SubmissionSearchPeer::PROCESSDATE);
            } else if ($column == 15 && $order == 'ASC') {
                return $criteria->addAscendingOrderByColumn(SubmissionSearchPeer::DATEOFRECIEVINGBYINDIA);
            } else if ($column == 15 && $order == 'DESC') {
                return $criteria->addDescendingOrderByColumn(SubmissionSearchPeer::DATEOFRECIEVINGBYINDIA);
            }
        } else {
            return $criteria->addDescendingOrderByColumn(SubmissionSearchPeer::ALTERNATIVECITY);
        }
    }

    public static function getQcSearchCriteria($input, $column, $order) {
        $criteria = new Criteria();
        $isFilterChoosen = false;

        if ($input['SubmissionNo'] != '') {
            $filterCriteria = $criteria->add(QcSearchPeer::SUBMISSIONNUMBER, trim($input['SubmissionNo']) . '%', Criteria::LIKE);
            $isFilterChoosen = true;
        }

        if ($input['InsuredName'] != '') {
            $filterCriteria = $criteria->add(QcSearchPeer::INSUREDNAME, '%' . trim($input['InsuredName']) . '%', Criteria::LIKE);
            $isFilterChoosen = true;
        }

        if ($input['NewRenewal'] != '') {
            $filterCriteria = $criteria->add(QcSearchPeer::NEWRENEWAL, trim($input['NewRenewal']), Criteria::LIKE);
            $isFilterChoosen = true;
        }

        if ($input['SubmissionFromDate'] != '' && $input['SubmissionToDate'] != '') {
            $isCreateDateFilterChoosen = true;
            $createDateCriteria = $criteria->getNewCriterion(QcSearchPeer::CREATEDDATE, date("Y-m-d H:i:s", strtotime(str_replace('-', '/', $input['SubmissionFromDate']))), Criteria::GREATER_EQUAL);
            $createEndDateCriteria = $criteria->getNewCriterion(QcSearchPeer::CREATEDDATE, date("Y-m-d H:i:s", strtotime(str_replace('-', '/', $input['SubmissionToDate']) . ' + 1 day')), Criteria::LESS_THAN);
            $createDateCriteria->addAnd($createEndDateCriteria);
        } else {
            if ($input['SubmissionFromDate'] != '') {
                $dateCriteria = $criteria->add(QcSearchPeer::CREATEDDATE, date("Y-m-d H:i:s", strtotime(str_replace('-', '/', $input['SubmissionFromDate']))), Criteria::GREATER_EQUAL);
                $isFilterChoosen = true;
            }

            if ($input['SubmissionToDate'] != '') {
                $dateCriteria = $criteria->add(QcSearchPeer::CREATEDDATE, date("Y-m-d H:i:s", strtotime(str_replace('-', '/', $input['SubmissionToDate']) . ' + 1 day')), Criteria::LESS_THAN);
                $isFilterChoosen = true;
            }
        }

        if ($input['Underwriter'] != '') {
            $filterCriteria = $criteria->add(QcSearchPeer::UNDERWRITERNAME, trim($input['Underwriter']), Criteria::LIKE);
            $isFilterChoosen = true;
        }

        if ($input['Branch'] != '') {
            $filterCriteria = $criteria->add(QcSearchPeer::BRANCHOFFICE, trim($input['Branch']), Criteria::LIKE);
            $isFilterChoosen = true;
        }

        if ($input['Status'] != '') {
            $filterCriteria = $criteria->add(QcSearchPeer::CURRENTSTATUS, trim($input['Status']), Criteria::LIKE);
            $isFilterChoosen = true;
        }

        if ($input['ReasonCode'] != '') {
            $filterCriteria = $criteria->add(QcSearchPeer::REASONCODE, trim($input['ReasonCode']) . '%', Criteria::LIKE);
            $isFilterChoosen = true;
        }

        if ($input['ProductLine'] != '') {
            $filterCriteria = $criteria->add(QcSearchPeer::PROPERTYTYPE, trim($input['ProductLine']), Criteria::LIKE);
            $isFilterChoosen = true;
        }

        if ($input['ProductLineSubType'] != '') {
            $filterCriteria = $criteria->add(QcSearchPeer::PROPERTYLINESUBTYPE, trim($input['ProductLineSubType']), Criteria::LIKE);
            $isFilterChoosen = true;
        }

        if ($input['Section'] != '') {
            $filterCriteria = $criteria->add(QcSearchPeer::SECTIONCODE, trim($input['Section']), Criteria::LIKE);
            $isFilterChoosen = true;
        }

        if ($input['ProfitCode'] != '') {
            $filterCriteria = $criteria->add(QcSearchPeer::PROFITCODE, trim($input['ProfitCode']), Criteria::LIKE);
            $isFilterChoosen = true;
        }

        if ($input['BrokerName'] != '') {
            $filterCriteria = $criteria->add(QcSearchPeer::BROKERNAME, trim($input['BrokerName']), Criteria::LIKE);
            $isFilterChoosen = true;
        }

        if ($input['BrokerType'] != '') {
            $filterCriteria = $criteria->add(QcSearchPeer::BROKERTYPE, trim($input['BrokerType']), Criteria::LIKE);
            $isFilterChoosen = true;
        }

        if ($input['BrokerCity'] != '') {
            $filterCriteria = $criteria->add(QcSearchPeer::BROKERCITY, '%' . trim($input['BrokerCity']) . '%', Criteria::LIKE);
            $isFilterChoosen = true;
        }

        if ($input['CabCompanies'] != '') {
            $filterCriteria = $criteria->add(QcSearchPeer::CABCOMPANIES, trim($input['CabCompanies']), Criteria::LIKE);
            $isFilterChoosen = true;
        }

        if ($input['EffectiveFromDate'] != '' && $input['EffectiveToDate'] != '') {
            $isEffectiveFilterChoosen = true;
            $effectiveDateCriteria = $criteria->getNewCriterion(QcSearchPeer::EFFECTIVEDATE, date("Y-m-d", strtotime(str_replace('-', '/', $input['EffectiveFromDate']))), Criteria::GREATER_EQUAL);
            $effectiveEndDateCriteria = $criteria->getNewCriterion(QcSearchPeer::EFFECTIVEDATE, date("Y-m-d", strtotime(str_replace('-', '/', $input['EffectiveToDate']) . ' + 1 day')), Criteria::LESS_THAN);
            $effectiveDateCriteria->addAnd($effectiveEndDateCriteria);
        } else {

            if ($input['EffectiveFromDate'] != '') {
                $dateCriteria = $criteria->add(QcSearchPeer::EFFECTIVEDATE, date("Y-m-d", strtotime(str_replace('-', '/', $input['EffectiveFromDate']))), Criteria::GREATER_EQUAL);
                $isFilterChoosen = true;
            }

            if ($input['EffectiveToDate'] != '') {
                $dateCriteria = $criteria->add(QcSearchPeer::EFFECTIVEDATE, date("Y-m-d", strtotime(str_replace('-', '/', $input['EffectiveToDate']) . ' + 1 day')), Criteria::LESS_THAN);
                $isFilterChoosen = true;
            }
        }

        if ($input['ExpirationFromDate'] != '' && $input['ExpirationToDate'] != '') {
            $isExpDateFilterChoosen = true;
            $ExpDateCriteria = $criteria->getNewCriterion(QcSearchPeer::EXPIRYDATE, date("Y-m-d", strtotime(str_replace('-', '/', $input['ExpirationFromDate']))), Criteria::GREATER_EQUAL);
            $ExpEndDateCriteria = $criteria->getNewCriterion(QcSearchPeer::EXPIRYDATE, date("Y-m-d", strtotime(str_replace('-', '/', $input['ExpirationToDate']) . ' + 1 day')), Criteria::LESS_THAN);
            $ExpDateCriteria->addAnd($ExpEndDateCriteria);
        } else {

            if ($input['ExpirationFromDate'] != '') {
                $dateCriteria = $criteria->add(QcSearchPeer::EXPIRYDATE, date("Y-m-d", strtotime(str_replace('-', '/', $input['ExpirationFromDate']))), Criteria::GREATER_EQUAL);
                $isFilterChoosen = true;
            }

            if ($input['ExpirationToDate'] != '') {
                $dateCriteria = $criteria->add(QcSearchPeer::EXPIRYDATE, date("Y-m-d", strtotime(str_replace('-', '/', $input['ExpirationToDate']) . ' + 1 day')), Criteria::LESS_THAN);
                $isFilterChoosen = true;
            }
        }

        if ($input['ProcessFromDate'] != '' && $input['ProcessToDate'] != '') {
            $isProcessDateFilterChoosen = true;
            $ProcessDateCriteria = $criteria->getNewCriterion(QcSearchPeer::PROCESSDATE, date("Y-m-d", strtotime(str_replace('-', '/', $input['ProcessFromDate']))), Criteria::GREATER_EQUAL);
            $ProcessEndDateCriteria = $criteria->getNewCriterion(QcSearchPeer::PROCESSDATE, date("Y-m-d", strtotime(str_replace('-', '/', $input['ProcessToDate']) . ' + 1 day')), Criteria::LESS_THAN);
            $ProcessDateCriteria->addAnd($ProcessEndDateCriteria);
        } else {

            if ($input['ProcessFromDate'] != '') {
                $dateCriteria = $criteria->add(QcSearchPeer::PROCESSDATE, date("Y-m-d", strtotime(str_replace('-', '/', $input['ProcessFromDate']))), Criteria::GREATER_EQUAL);
                $isFilterChoosen = true;
            }

            if ($input['ProcessToDate'] != '') {
                $dateCriteria = $criteria->add(QcSearchPeer::PROCESSDATE, date("Y-m-d", strtotime(str_replace('-', '/', $input['ProcessToDate']) . ' + 1 day')), Criteria::LESS_THAN);
                $isFilterChoosen = true;
            }
        }

        if ($input['EditFromDate'] != '' && $input['EditToDate'] != '') {
            $isEditDateFilterChoosen = true;
            $EditDateCriteria = $criteria->getNewCriterion(QcSearchPeer::MODIFIEDDATE, date("Y-m-d", strtotime(str_replace('-', '/', $input['EditFromDate']))), Criteria::GREATER_EQUAL);
            $EditEndDateCriteria = $criteria->getNewCriterion(QcSearchPeer::MODIFIEDDATE, date("Y-m-d", strtotime(str_replace('-', '/', $input['EditToDate']) . ' + 1 day')), Criteria::LESS_THAN);
            $EditDateCriteria->addAnd($EditEndDateCriteria);
        } else {

            if ($input['EditFromDate'] != '') {
                $dateCriteria = $criteria->add(QcSearchPeer::MODIFIEDDATE, date("Y-m-d", strtotime(str_replace('-', '/', $input['EditFromDate']))), Criteria::GREATER_EQUAL);
                $isFilterChoosen = true;
            }

            if ($input['EditToDate'] != '') {
                $dateCriteria = $criteria->add(QcSearchPeer::MODIFIEDDATE, date("Y-m-d", strtotime(str_replace('-', '/', $input['EditToDate']) . ' + 1 day')), Criteria::LESS_THAN);
                $isFilterChoosen = true;
            }
        }

        if ($input['EditDbaName'] != '') {
            $filterCriteria = $criteria->add(QcSearchPeer::DBANAME, trim($input['EditDbaName']) . '%', Criteria::LIKE);
            $isFilterChoosen = true;
        }

        if ($input['BrokerContactPerson'] != '') {
            $filterCriteria = $criteria->add(QcSearchPeer::BROKERCONTACTPERSON, trim($input['BrokerContactPerson']) . '%', Criteria::LIKE);
            $isFilterChoosen = true;
        }

        if ($input['NumberOfLocations'] != '') {
            $filterCriteria = $criteria->add(QcSearchPeer::ALTERNATIVESTATE, '%' . trim($input['NumberOfLocations']), Criteria::LIKE);
            $isFilterChoosen = true;
        }

        if ($input['Currency'] != '') {
            $filterCriteria = $criteria->add(QcSearchPeer::CURRENCY, trim($input['Currency']) . '%', Criteria::LIKE);
            $isFilterChoosen = true;
        }

        if ($input['OccupancyCode'] != '') {
            $filterCriteria = $criteria->add(QcSearchPeer::ALTERNATIVEZIPCODE, trim($input['OccupancyCode']) . '%', Criteria::LIKE);
            $isFilterChoosen = true;
        }

        if ($input['Renewable'] != '') {
            $filterCriteria = $criteria->add(QcSearchPeer::RENEWABLE, trim($input['Renewable']), Criteria::LIKE);
            $isFilterChoosen = true;
        }

        if ($input['PolicyType'] != '') {
            $filterCriteria = $criteria->add(QcSearchPeer::POLICYTYPE, trim($input['PolicyType']), Criteria::LIKE);
            $isFilterChoosen = true;
        }

        if ($input['DirectAssumed'] != '') {
            $filterCriteria = $criteria->add(QcSearchPeer::DIRECTASSUMED, trim($input['DirectAssumed']), Criteria::LIKE);
            $isFilterChoosen = true;
        }

        if ($input['CompanyPaper'] != '') {
            $filterCriteria = $criteria->add(QcSearchPeer::COMPANYPAPER, trim($input['CompanyPaper']), Criteria::LIKE);
            $isFilterChoosen = true;
        }

        if ($input['CompanyPaperNumber'] != '') {
            $filterCriteria = $criteria->add(QcSearchPeer::COMPANYPAPERNUMBER, trim($input['CompanyPaperNumber']), Criteria::LIKE);
            $isFilterChoosen = true;
        }

        if ($input['PolicyNumber'] != '') {
            $filterCriteria = $criteria->add(QcSearchPeer::POLICYNUMBER, trim($input['PolicyNumber']), Criteria::LIKE);
            $isFilterChoosen = true;
        }

        if ($input['Suffix'] != '') {
            $filterCriteria = $criteria->add(QcSearchPeer::SUFFIX, trim($input['Suffix']), Criteria::LIKE);
            $isFilterChoosen = true;
        }

        if ($input['AdmittedNonAdmitted'] != '') {
            $filterCriteria = $criteria->add(QcSearchPeer::ADMITTEDNONADMITTED, trim($input['AdmittedNonAdmitted']), Criteria::LIKE);
            $isFilterChoosen = true;
        }

        if ($input['DateOfRenewalFromDate'] != '' && $input['DateOfRenewalToDate'] != '') {
            $isEditDateFilterChoosen = true;
            $EditDateCriteria = $criteria->getNewCriterion(QcSearchPeer::DATEOFRENEWAL, date("Y-m-d", strtotime(str_replace('-', '/', $input['DateOfRenewalFromDate']))), Criteria::GREATER_EQUAL);
            $EditEndDateCriteria = $criteria->getNewCriterion(QcSearchPeer::DATEOFRENEWAL, date("Y-m-d", strtotime(str_replace('-', '/', $input['DateOfRenewalToDate']) . ' + 1 day')), Criteria::LESS_THAN);
            $EditDateCriteria->addAnd($EditEndDateCriteria);
        } else {

            if ($input['DateOfRenewalFromDate'] != '') {
                $dateCriteria = $criteria->add(QcSearchPeer::DATEOFRENEWAL, date("Y-m-d", strtotime(str_replace('-', '/', $input['DateOfRenewalFromDate']))), Criteria::GREATER_EQUAL);
                $isFilterChoosen = true;
            }

            if ($input['DateOfRenewalToDate'] != '') {
                $dateCriteria = $criteria->add(QcSearchPeer::DATEOFRENEWAL, date("Y-m-d", strtotime(str_replace('-', '/', $input['DateOfRenewalToDate']) . ' + 1 day')), Criteria::LESS_THAN);
                $isFilterChoosen = true;
            }
        }

        if ($input['Coverage'] != '') {
            $filterCriteria = $criteria->add(QcSearchPeer::COVERAGE, trim($input['Coverage']), Criteria::LIKE);
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
                return $criteria->addAscendingOrderByColumn(QcSearchPeer::QCSTATUS);
            } else if ($column == 0 && $order == 'DESC') {
                return $criteria->addDescendingOrderByColumn(QcSearchPeer::QCSTATUS);
            } else if ($column == 1 && $order == 'ASC') {
                return $criteria->addAscendingOrderByColumn(QcSearchPeer::ALTERNATIVECITY);
            } else if ($column == 1 && $order == 'DESC') {
                return $criteria->addDescendingOrderByColumn(QcSearchPeer::ALTERNATIVECITY);
            } else if ($column == 2 && $order == 'ASC') {
                return $criteria->addAscendingOrderByColumn(QcSearchPeer::NEWRENEWAL);
            } else if ($column == 2 && $order == 'DESC') {
                return $criteria->addDescendingOrderByColumn(QcSearchPeer::NEWRENEWAL);
            } else if ($column == 3 && $order == 'ASC') {
                return $criteria->addAscendingOrderByColumn(QcSearchPeer::INSUREDNAME);
            } else if ($column == 3 && $order == 'DESC') {
                return $criteria->addDescendingOrderByColumn(QcSearchPeer::INSUREDNAME);
            } else if ($column == 4 && $order == 'ASC') {
                return $criteria->addAscendingOrderByColumn(QcSearchPeer::UNDERWRITERNAME);
            } else if ($column == 4 && $order == 'DESC') {
                return $criteria->addDescendingOrderByColumn(QcSearchPeer::UNDERWRITERNAME);
            } else if ($column == 5 && $order == 'ASC') {
                return $criteria->addAscendingOrderByColumn(QcSearchPeer::PROPERTYTYPE);
            } else if ($column == 5 && $order == 'DESC') {
                return $criteria->addDescendingOrderByColumn(QcSearchPeer::PROPERTYTYPE);
            } else if ($column == 6 && $order == 'ASC') {
                return $criteria->addAscendingOrderByColumn(QcSearchPeer::CURRENTSTATUS);
            } else if ($column == 6 && $order == 'DESC') {
                return $criteria->addDescendingOrderByColumn(QcSearchPeer::CURRENTSTATUS);
            } else if ($column == 7 && $order == 'ASC') {
                return $criteria->addAscendingOrderByColumn(QcSearchPeer::EFFECTIVEDATE);
            } else if ($column == 7 && $order == 'DESC') {
                return $criteria->addDescendingOrderByColumn(QcSearchPeer::EFFECTIVEDATE);
            } else if ($column == 8 && $order == 'ASC') {
                return $criteria->addAscendingOrderByColumn(QcSearchPeer::BRANCHOFFICE);
            } else if ($column == 8 && $order == 'DESC') {
                return $criteria->addDescendingOrderByColumn(QcSearchPeer::BRANCHOFFICE);
            } else if ($column == 9 && $order == 'ASC') {
                return $criteria->addAscendingOrderByColumn(QcSearchPeer::BROKERNAME);
            } else if ($column == 9 && $order == 'DESC') {
                return $criteria->addDescendingOrderByColumn(QcSearchPeer::BROKERNAME);
            } else if ($column == 10 && $order == 'ASC') {
                return $criteria->addAscendingOrderByColumn(QcSearchPeer::CABCOMPANIES);
            } else if ($column == 10 && $order == 'DESC') {
                return $criteria->addDescendingOrderByColumn(QcSearchPeer::CABCOMPANIES);
            } else if ($column == 11 && $order == 'ASC') {
                return $criteria->addAscendingOrderByColumn(QcSearchPeer::GROSSPREMIUM);
            } else if ($column == 11 && $order == 'DESC') {
                return $criteria->addDescendingOrderByColumn(QcSearchPeer::GROSSPREMIUM);
            } else if ($column == 12 && $order == 'ASC') {
                return $criteria->addAscendingOrderByColumn(QcSearchPeer::PROJECTNAME);
            } else if ($column == 12 && $order == 'DESC') {
                return $criteria->addDescendingOrderByColumn(QcSearchPeer::PROJECTNAME);
            } else if ($column == 13 && $order == 'ASC') {
                return $criteria->addAscendingOrderByColumn(QcSearchPeer::TOTALINSUREDVALUE);
            } else if ($column == 13 && $order == 'DESC') {
                return $criteria->addDescendingOrderByColumn(QcSearchPeer::TOTALINSUREDVALUE);
            } else if ($column == 14 && $order == 'ASC') {
                return $criteria->addAscendingOrderByColumn(QcSearchPeer::PROCESSDATE);
            } else if ($column == 14 && $order == 'DESC') {
                return $criteria->addDescendingOrderByColumn(QcSearchPeer::PROCESSDATE);
            } else if ($column == 15 && $order == 'ASC') {
                return $criteria->addAscendingOrderByColumn(QcSearchPeer::DATEOFRECIEVINGBYINDIA);
            } else if ($column == 15 && $order == 'DESC') {
                return $criteria->addDescendingOrderByColumn(QcSearchPeer::DATEOFRECIEVINGBYINDIA);
            }
        } else {
            return $criteria->addDescendingOrderByColumn(QcSearchPeer::ALTERNATIVECITY);
        }
    }

    public function submitData($postValues, $userId, $userGroup) {
        $editObj = new EditSubmissionDetails();
        $viewObj = new ViewSubmissionDetails();
        if (empty($postValues['insured_name'])) {
            $postValues['insured_name'] = 'N';
        }
        if (empty($postValues['insured_mailingaddress'])) {
            $postValues['insured_mailingaddress'] = 'N';
        }
        if (isset($postValues['yesTrue'])) {
            $postValues['yesTrue'] = $postValues['yesTrue'];
        } else {
            $postValues['yesTrue'] = 'N';
        }
        if (isset($postValues['yesBroker'])) {
            $postValues['yesBroker'] = $postValues['yesBroker'];
        } else {
            $postValues['yesBroker'] = 'N';
        }
        if (isset($postValues['yesIndia'])) {
            $postValues['yesIndia'] = $postValues['yesIndia'];
        } else {
            $postValues['yesIndia'] = 'N';
        }
        if (isset($postValues['yesGross'])) {
            $postValues['yesGross'] = $postValues['yesGross'];
        } else {
            $postValues['yesGross'] = 'N';
        }
        if (isset($postValues['yesLimit'])) {
            $postValues['yesLimit'] = $postValues['yesLimit'];
        } else {
            $postValues['yesLimit'] = 'N';
        }
        if (isset($postValues['yesAttachment'])) {
            $postValues['yesAttachment'] = $postValues['yesAttachment'];
        } else {
            $postValues['yesAttachment'] = 'N';
        }
        $newRenewalLookUpId = $postValues['new_renewal'];
        if ($userGroup == 'master') {
            $underWritterId = $postValues['underwriter_master'];
            $productLineId = $postValues['product_line_master'];
            $productLinePrefixData = $this->GetPrefix($postValues['product_line_master']);
            $productLinePrefixForMaster = $productLinePrefixData[0]['Prefix'];
            $completeProductLine .= $productLinePrefixForMaster;
            $completeProductLine .= $productLinePrefixData[0]['LOBName'];
            $propductLineSubTypeId = $postValues['product_line_subtype_master'];
            $sectionCodeId = $postValues['section_master'];
            $profitId = $postValues['profitcode_master'];
            $primaryStatus = $postValues['primarystatus_master'];
        } else {
            $underWritterId = $postValues['underwriter'];
            $product = $this->getLobList($postValues['product_line']);
            $productLineId = $product[0]['Id'];
            $productLinePrefix = $postValues['productLinePrefix'];
            $completeProductLine .= $productLinePrefix;
            $completeProductLine .= $postValues['product_line'];
            $propductLineSubTypeId = $postValues['product_line_subtype'];
            $sectionCodeId = $postValues['section'];
            $profitId = $postValues['profitcode'];
            $primaryStatus = $postValues['primarystatus'];
        }
        $branchId = $postValues['branch_office'];
        if (!empty($sectionCodeId)) {
            $sectionId = $sectionCodeId;
        } else {
            $sectionId = null;
        }
        if (!empty($profitId)) {
            $profitCodeId = $profitId;
        } else {
            $profitCodeId = null;
        }
        $effectiveDate = date("Y-m-d", strtotime($postValues['effectivedate']));
        $expiryDate = date("Y-m-d", strtotime($postValues['expirydate']));
        $insuredId = $postValues['insuredId'];
        $isDifferentDba = $postValues['insured_name'];
        if ($isDifferentDba == 'Y') {
            $dbaName = str_replace("'", "''", $postValues['dbaname']);
        } else {
            $dbaName = null;
        }
        $cabCompaniesLookupId = implode(" & ", $postValues['cab_companies']);
        if (!empty($postValues['reinsured_company'])) {
            $reinsuredCompany = str_replace("'", "''", $postValues['reinsured_company']);
        } else {
            $reinsuredCompany = null;
        }
        if (!empty($postValues['submission_type_idrntifier'])) {
            $submissionTypeIdentifier = $postValues['submission_type_idrntifier'];
        } else {
            $submissionTypeIdentifier = null;
        }
        if (!empty($postValues['total_insured_value_text'])) {
            $totalInsuredValue = $postValues['total_insured_value_text'];
        } elseif ($postValues['yesTrue'] == 'Y') {
            $totalInsuredValue = $postValues['total_insured_value_select'];
        } else {
            $totalInsuredValue = null;
        }
        if (!empty($postValues['total_insured_value_usd'])) {
            $totalInsuredValueInUSD = $postValues['total_insured_value_usd'];
        } else {
            $totalInsuredValueInUSD = null;
        }
        if (!empty($postValues['citycode'])) {
            $brokerWiseCityId = $postValues['citycode'];
        } else {
            $brokerWiseCityId = null;
        }
        if (!empty($postValues['brokercontactperson'])) {
            $brokerContactPerson = $postValues['brokercontactperson'];
        } else {
            $brokerContactPerson = null;
        }
        if (!empty($postValues['broker_contact_person_email'])) {
            $brokerContactPersonEmail = $postValues['broker_contact_person_email'];
        } else {
            $brokerContactPersonEmail = null;
        }
        if (!empty($postValues['borker_contact_peson_number'])) {
            $brokerContactPersonNumber = $postValues['borker_contact_peson_number'];
        } else {
            $brokerContactPersonNumber = null;
        }
        if ($postValues['brokercode'] == '-1') {
            $BrokerCode = '1-000-000-0000';
        } else if ($postValues['brokercode'] == '-2') {
            $BrokerCode = '2-000-000-0000';
        } else {
            $BrokerCode = $postValues['brokerCodeGen1'];
        }
        if (!empty($postValues['byBerkSi'])) {
            $byBerkSi = date("Y-m-d H:i:s", strtotime($postValues['byBerkSi']));
        }
        if (!empty($postValues['byIndia'])) {
            $byIndia = date("Y-m-d", strtotime($postValues['byIndia']));
        }
        $qcStatus = $this->getLookUpTypeList('QCStatus');
        $qcStatusId = $qcStatus[0]['Id'];

        //Matches product line ID to Values for master User login
        if ($userGroup == 'master') {
            foreach ($this->GetLobForMAster() as $lobId) {
                if ($postValues['product_line_master'] == $lobId['Id']) {
                    $postValues['product_line'] = $lobId['LOBName'];
                }
            }
        }
        if ($postValues['product_line'] == 'Property' || $postValues['product_line'] == 'Casualty') {
            $projectArray = array();
            if (!empty($postValues['projectname'])) {
                $projectArray['projectName'] = str_replace("'", "''", $postValues['projectname']);
            } else {
                $projectArray['projectName'] = null;
            }
            if (!empty($postValues['generalcontratorname'])) {
                $projectArray['generalContractorName'] = str_replace("'", "''", $postValues['generalcontratorname']);
            } else {
                $projectArray['generalContractorName'] = null;
            }
            if (!empty($postValues['projectownername'])) {
                $projectArray['projectOwnerName'] = str_replace("'", "''", $postValues['projectownername']);
            } else {
                $projectArray['projectOwnerName'] = null;
            }
            if (!empty($postValues['projectstreetaddress'])) {
                $projectArray['address1'] = str_replace("'", "''", $postValues['projectstreetaddress']);
            } else {
                $projectArray['address1'] = null;
            }
            if (!empty($postValues['projectcountry'])) {
                $projectArray['countryName'] = $this->GetCountryById($postValues['projectcountry']);
            } else {
                $projectArray['countryName'] = null;
            }
            if (!empty($postValues['projectstate'])) {
                $projectArray['stateName'] = $this->GetProjectStateById($postValues['projectstate']);
            } else {
                $projectArray['stateName'] = null;
            }
            if (!empty($postValues['projectcity'])) {
                $projectArray['cityName'] = $this->GetProjectCityById($postValues['projectcity']);
            } else {
                $projectArray['cityName'] = null;
            }
            $projectArray['zipcode'] = null;
            $projectArray['projectBidSituationLookupId'] = $postValues['bidsituation'];
            $businessDependentdetailsId = $this->insertBusinessDependentDetails($projectArray);
        } else {
            $businessDependentdetailsId = null;
        }

        $statusArray = array();
        if (!empty($postValues['reason_code'])) {
            $statusArray['reasonCodeId'] = $postValues['reason_code'];
        } else {
            $statusArray['reasonCodeId'] = null;
        }
        if (!empty($postValues['processdate'])) {
            $statusArray['processDate'] = $postValues['processdate'];
        }
        if (!empty($postValues['exchangeRateDate'])) {
            $statusArray['exchangeRateDate'] = $postValues['exchangeRateDate'];
        }
        if (!empty($postValues['currency'])) {
            $statusArray['currency'] = $postValues['currency'];
        } else {
            $statusArray['currency'] = null;
        }
        if (!empty($postValues['exchangeRate'])) {
            $statusArray['exchangeRate'] = $postValues['exchangeRate'];
        } else {
            $statusArray['exchangeRate'] = null;
        }
        /* Premium in Local Currency */
        if ($postValues['yesGross'] == 'Y') {
            if (!empty($postValues['gross_premium_select'])) {
                $statusArray['grossPremium'] = $postValues['gross_premium_select'];
            }
        } else if ($postValues['yesGross'] == 'N') {
            if (!empty($postValues['gross_premium_text'])) {
                $statusArray['grossPremium'] = $postValues['gross_premium_text'];
            }
        } else {
            $statusArray['grossPremium'] = null;
        }
        /* Premium in USD */
        if (!empty($postValues['premiumUsdCurrency'])) {
            $statusArray['premiumUsdCurrency'] = $postValues['premiumUsdCurrency'];
        } else {
            $statusArray['premiumUsdCurrency'] = null;
        }
        /* Limit in Local Currency */
        if ($postValues['yesLimit'] == 'Y') {
            if (!empty($postValues['limit_select'])) {
                $statusArray['limit'] = $postValues['limit_select'];
            }
        } else if ($postValues['yesLimit'] == 'N') {
            if (!empty($postValues['limit_text'])) {
                $statusArray['limit'] = $postValues['limit_text'];
            }
        } else {
            $statusArray['limit'] = null;
        }
        /* Limit in USD */
        if (!empty($postValues['limit_usd_text'])) {
            $statusArray['limit_usd_text'] = $postValues['limit_usd_text'];
        } else {
            $statusArray['limit_usd_text'] = null;
        }
        /* AttachmentPoint in Local Currency */
        if ($postValues['yesAttachment'] == 'Y') {
            if (!empty($postValues['attachment_point_select'])) {
                $statusArray['attachment'] = $postValues['attachment_point_select'];
            }
        } else if ($postValues['yesAttachment'] == 'N') {
            if (!empty($postValues['attachment_point'])) {
                $statusArray['attachment'] = $postValues['attachment_point'];
            }
        } else {
            $statusArray['attachment'] = null;
        }
        /* AttachmentPoint in USD */
        if (!empty($postValues['attachment_point_usd'])) {
            $statusArray['attachment_point'] = $postValues['attachment_point_usd'];
        } else {
            $statusArray['attachment_point'] = null;
        }
        if ($postValues['reason_code'] || $postValues['processdate'] || $postValues['gross_premium_text'] || $postValues['limit_text'] || $postValues['attachment_point_text'] || $postValues['gross_premium_select'] || $postValues['attachment_point_select']) {
            $statusDependentDetailsId = $editObj->InsertStatusDepdentDetails($statusArray);
        } else if ($postValues['exchangeRateDate'] || $postValues['exchangeRate']) {
            $statusDependentDetailsId = $editObj->InsertStatusDepdentDetails($statusArray);
        } else {
            $statusDependentDetailsId = null;
        }
        if (!empty($userId)) {
            $dataRecorderMetaDataId = $this->insertDataRecorderMetaData($userId);
        } else {
            $dataRecorderMetaDataId = null;
        }
        if (!empty($postValues['OccupancyCode'])) {
            $occupancyCode = $postValues['OccupancyCode'];
        } else {
            $occupancyCode = null;
        }
        if (!empty($postValues['NumberOfLocations'])) {
            $numberOfLocations = $postValues['NumberOfLocations'];
        } else {
            $numberOfLocations = null;
        }
        if (!empty($postValues['riskProfile'])) {
            $riskProfile = $postValues['riskProfile'];
        } else {
            $riskProfile = null;
        }
        if (!empty($postValues['insuredContactPerson'])) {
            $insuredContactPersonId = $postValues['insuredContactPerson'];
        } else {
            $insuredContactPersonId = null;
        }
        if (!empty($postValues['insuredSubmissionDate'])) {
            $insuredSubmissionDate = date("Y-m-d", strtotime($postValues['insuredSubmissionDate']));
        }

        if (!empty($postValues['insuredQuoteDueDate'])) {
            $insuredQuoteDueDate = date("Y-m-d", strtotime($postValues['insuredQuoteDueDate']));
        }
        if (!empty($postValues['brokercontactperson'])) {
            $brokerContactPersonId = $postValues['brokercontactperson'];
        } else {
            $brokerContactPersonId = null;
        }
        $submissionNumber = $this->createSubmissionNumber($completeProductLine);
        $con = Propel::getConnection();
        if (empty($postValues['byBerkSi']) && !empty($postValues['byIndia'])) {
            $query = "INSERT INTO Submission (SubmissionNumber ,NewRenewalLookupId ,UnderwriterId ,LobId ,LobSubTypeId ,SectionId ,ProfitCodeId ,CurrentStatusId ,EffectiveDate ,ExpiryDate ,InsuredId ,IsDifferentDba ,DbaName ,CABCompaniesLookupId ,ReinsuredCompany ,SubmissionIdentifier ,BusinessDependentDetailId ,TotalInsuredValue ,BrokerWiseCityId ,BrokerCode, StatusDependentDetailsId ,BerkSIDateFromBroker ,BerkSiDateFromIndia ,BranchId ,QCStatus ,OccupancyCodeId, NumberOfLocationsId, DataRecorderMetaDataId ,IsTotalInsuredValue , IsBerksiBroker ,IsBerksiIndia ,IsGrossPremium ,IsLimit ,IsAttachmentPoint,BrokerContactPersonId, InsuredContactPersonId, InsuredSubmissionDate, InsuredQuoteDueDate, RiskProfile,TotalInsuredValueInUSD,IsDuckSubmissionNumber) 
                  VALUES 
                  ('" . $submissionNumber->SUBMISSION_NO . "','" . $newRenewalLookUpId . "','" . $underWritterId . "','" . $productLineId . "', '" . $propductLineSubTypeId . "', '" . $sectionId . "', '" . $profitCodeId . "', '" . $primaryStatus . "', '" . $effectiveDate . "', '" . $expiryDate . "', '" . $insuredId . "', '" . $isDifferentDba . "', '" . $dbaName . "', '" . $cabCompaniesLookupId . "', '" . $reinsuredCompany . "', '" . $submissionTypeIdentifier . "', '" . $businessDependentdetailsId . "', '" . $totalInsuredValue . "', '" . $brokerWiseCityId . "','" . $BrokerCode . "','" . $statusDependentDetailsId . "', null, '" . $byIndia . "','" . $branchId . "','" . $qcStatusId . "','" . $occupancyCode . "', '" . $numberOfLocations . "', '" . $dataRecorderMetaDataId . "', '" . $postValues['yesTrue'] . "', '" . $postValues['yesBroker'] . "', '" . $postValues['yesIndia'] . "', '" . $postValues['yesGross'] . "', '" . $postValues['yesLimit'] . "' ,'" . $postValues['yesAttachment'] . "', '" . $brokerContactPersonId . "', '" . $insuredContactPersonId . "', '" . $insuredSubmissionDate . "', '" . $insuredQuoteDueDate . "', '" . $riskProfile . "', '" . $totalInsuredValueInUSD . "', 'Y')";
        } else if (empty($postValues['byIndia']) && !empty($postValues['byBerkSi'])) {
            $query = "INSERT INTO Submission (SubmissionNumber ,NewRenewalLookupId ,UnderwriterId ,LobId ,LobSubTypeId ,SectionId ,ProfitCodeId ,CurrentStatusId ,EffectiveDate ,ExpiryDate ,InsuredId ,IsDifferentDba ,DbaName ,CABCompaniesLookupId ,ReinsuredCompany ,SubmissionIdentifier ,BusinessDependentDetailId ,TotalInsuredValue ,BrokerWiseCityId ,BrokerCode, StatusDependentDetailsId ,BerkSIDateFromBroker ,BerkSiDateFromIndia ,BranchId ,QCStatus ,OccupancyCodeId, NumberOfLocationsId, DataRecorderMetaDataId ,IsTotalInsuredValue , IsBerksiBroker ,IsBerksiIndia ,IsGrossPremium ,IsLimit ,IsAttachmentPoint,BrokerContactPersonId, InsuredContactPersonId, InsuredSubmissionDate, InsuredQuoteDueDate, RiskProfile,TotalInsuredValueInUSD,IsDuckSubmissionNumber) 
                  VALUES 
                  ('" . $submissionNumber->SUBMISSION_NO . "','" . $newRenewalLookUpId . "','" . $underWritterId . "','" . $productLineId . "', '" . $propductLineSubTypeId . "', '" . $sectionId . "', '" . $profitCodeId . "', '" . $primaryStatus . "', '" . $effectiveDate . "', '" . $expiryDate . "', '" . $insuredId . "', '" . $isDifferentDba . "', '" . $dbaName . "', '" . $cabCompaniesLookupId . "', '" . $reinsuredCompany . "', '" . $submissionTypeIdentifier . "', '" . $businessDependentdetailsId . "', '" . $totalInsuredValue . "', '" . $brokerWiseCityId . "', '" . $BrokerCode . "','" . $statusDependentDetailsId . "', '" . $byBerkSi . "', null,'" . $branchId . "','" . $qcStatusId . "','" . $occupancyCode . "', '" . $numberOfLocations . "' ,'" . $dataRecorderMetaDataId . "', '" . $postValues['yesTrue'] . "', '" . $postValues['yesBroker'] . "', '" . $postValues['yesIndia'] . "', '" . $postValues['yesGross'] . "', '" . $postValues['yesLimit'] . "' ,'" . $postValues['yesAttachment'] . "', '" . $brokerContactPersonId . "', '" . $insuredContactPersonId . "', '" . $insuredSubmissionDate . "', '" . $insuredQuoteDueDate . "', '" . $riskProfile . "', '" . $totalInsuredValueInUSD . "', 'Y')";
        } else if (empty($postValues['byIndia']) && empty($postValues['byBerkSi'])) {
            $query = "INSERT INTO Submission (SubmissionNumber ,NewRenewalLookupId ,UnderwriterId ,LobId ,LobSubTypeId ,SectionId ,ProfitCodeId ,CurrentStatusId ,EffectiveDate ,ExpiryDate ,InsuredId ,IsDifferentDba ,DbaName ,CABCompaniesLookupId ,ReinsuredCompany ,SubmissionIdentifier ,BusinessDependentDetailId ,TotalInsuredValue ,BrokerWiseCityId ,BrokerCode, StatusDependentDetailsId ,BerkSIDateFromBroker ,BerkSiDateFromIndia ,BranchId ,QCStatus ,OccupancyCodeId, NumberOfLocationsId, DataRecorderMetaDataId ,IsTotalInsuredValue , IsBerksiBroker ,IsBerksiIndia ,IsGrossPremium ,IsLimit ,IsAttachmentPoint,BrokerContactPersonId, InsuredContactPersonId, InsuredSubmissionDate, InsuredQuoteDueDate, RiskProfile,TotalInsuredValueInUSD,IsDuckSubmissionNumber) 
                  VALUES 
                  ('" . $submissionNumber->SUBMISSION_NO . "','" . $newRenewalLookUpId . "','" . $underWritterId . "','" . $productLineId . "', '" . $propductLineSubTypeId . "', '" . $sectionId . "', '" . $profitCodeId . "', '" . $primaryStatus . "', '" . $effectiveDate . "', '" . $expiryDate . "', '" . $insuredId . "', '" . $isDifferentDba . "', '" . $dbaName . "', '" . $cabCompaniesLookupId . "', '" . $reinsuredCompany . "', '" . $submissionTypeIdentifier . "', '" . $businessDependentdetailsId . "', '" . $totalInsuredValue . "', '" . $brokerWiseCityId . "', '" . $BrokerCode . "','" . $statusDependentDetailsId . "', null, null,'" . $branchId . "','" . $qcStatusId . "','" . $occupancyCode . "', '" . $numberOfLocations . "' ,'" . $dataRecorderMetaDataId . "', '" . $postValues['yesTrue'] . "', '" . $postValues['yesBroker'] . "', '" . $postValues['yesIndia'] . "', '" . $postValues['yesGross'] . "', '" . $postValues['yesLimit'] . "' ,'" . $postValues['yesAttachment'] . "', '" . $brokerContactPersonId . "', '" . $insuredContactPersonId . "', '" . $insuredSubmissionDate . "', '" . $insuredQuoteDueDate . "', '" . $riskProfile . "', '" . $totalInsuredValueInUSD . "', 'Y')";
        } else {
            $query = "INSERT INTO Submission (SubmissionNumber ,NewRenewalLookupId ,UnderwriterId ,LobId ,LobSubTypeId ,SectionId ,ProfitCodeId ,CurrentStatusId ,EffectiveDate ,ExpiryDate ,InsuredId ,IsDifferentDba ,DbaName ,CABCompaniesLookupId ,ReinsuredCompany ,SubmissionIdentifier ,BusinessDependentDetailId ,TotalInsuredValue ,BrokerWiseCityId ,BrokerCode, StatusDependentDetailsId ,BerkSIDateFromBroker ,BerkSiDateFromIndia ,BranchId ,QCStatus ,OccupancyCodeId, NumberOfLocationsId, DataRecorderMetaDataId ,IsTotalInsuredValue , IsBerksiBroker ,IsBerksiIndia ,IsGrossPremium ,IsLimit ,IsAttachmentPoint,BrokerContactPersonId, InsuredContactPersonId, InsuredSubmissionDate, InsuredQuoteDueDate, RiskProfile,TotalInsuredValueInUSD,IsDuckSubmissionNumber) 
                  VALUES 
                  ('" . $submissionNumber->SUBMISSION_NO . "','" . $newRenewalLookUpId . "','" . $underWritterId . "','" . $productLineId . "', '" . $propductLineSubTypeId . "', '" . $sectionId . "', '" . $profitCodeId . "', '" . $primaryStatus . "', '" . $effectiveDate . "', '" . $expiryDate . "', '" . $insuredId . "', '" . $isDifferentDba . "', '" . $dbaName . "', '" . $cabCompaniesLookupId . "', '" . $reinsuredCompany . "', '" . $submissionTypeIdentifier . "', '" . $businessDependentdetailsId . "', '" . $totalInsuredValue . "', '" . $brokerWiseCityId . "', '" . $BrokerCode . "', '" . $statusDependentDetailsId . "','" . $byBerkSi . "', '" . $byIndia . "','" . $branchId . "','" . $qcStatusId . "', '" . $occupancyCode . "', '" . $numberOfLocations . "', '" . $dataRecorderMetaDataId . "', '" . $postValues['yesTrue'] . "', '" . $postValues['yesBroker'] . "', '" . $postValues['yesIndia'] . "', '" . $postValues['yesGross'] . "', '" . $postValues['yesLimit'] . "' ,'" . $postValues['yesAttachment'] . "', '" . $brokerContactPersonId . "', '" . $insuredContactPersonId . "', '" . $insuredSubmissionDate . "', '" . $insuredQuoteDueDate . "', '" . $riskProfile . "', '" . $totalInsuredValueInUSD . "', 'Y')";
        }
        $insert = $con->prepare($query);
        if ($insert->execute()) {
            $STH = $con->query("SELECT CAST(COALESCE(SCOPE_IDENTITY(), @@IDENTITY) AS int)");
            $STH->execute();
            $result = $STH->fetch();
            $submissionId = $result[0];
        }
        $historyArray['field'] = 'Status';
        $historyArray['oldValue '] = null;
        $stausData = $viewObj->getStatus($postValues['primarystatus']);
        $historyArray['newValue'] = $stausData[0]['StatusName'];
        $historyArray['remark'] = null;
        $editObj->insertInSubmissionHistory($historyArray, $userId, $submissionId);
        if ($postValues['isWholesaler'] == 'Wholesaler') {
            $this->insertIntoRetailBrokerDetails($postValues, $submissionId);
        }
        if ($postValues['primarystatus_master'] == 9) {
            $policyNumber = $this->createPolicyNumber($postValues);
            $insertBound = $this->insertSubmissionBound($postValues, $submissionId);
        }
        return true;
    }

    public function createSubmissionNumber($completeProductLine) {
        $con = Propel::getConnection();
        $stmt = $con->query("SELECT SUBSTRING( CONVERT(VARCHAR(10),YEAR(GETDATE())), 3,2) + '-' +REPLACE(STR(CONVERT(VARCHAR(2),MONTH(GETDATE())), 2),SPACE(1),'0') + '-' +
                           SUBSTRING('$completeProductLine',1,2) + '-' +REPLACE(STR(CONVERT(VARCHAR(6),(SELECT MAX(SubmissionSequence) FROM Submission)+1), 6),SPACE(1),'0') + '-' +REPLACE(STR(CONVERT(VARCHAR(2),01), 2),SPACE(1),'0') AS SUBMISSION_NO");
        $data = $stmt->fetch(PDO::FETCH_OBJ);
        return $data;
    }

    public function createPolicyNumber($postValues) {
        $viewObj = new ViewSubmissionDetails();
        $companyPaperNumber = $viewObj->getLookUpdata($postedValues['editcompanyPaperNumber']);
        $suffix = $viewObj->getLookUpdata($postedValues['editsuffix']);
        $coverage = $viewObj->GetCoverageDetails($postedValues['editcoverage']);
        $policyNumber = $companyPaperNumber[0]['LookupName'] . '-' . $coverage . '-' . $postedValues['editpolicyNumber'] . '-' . $suffix[0]['LookupName'];
        return $policyNumber;
    }

    public function insertSubmissionBound($postValues, $submissionId) {
        $boundArray = array();
        $boundArray['bindDate'] = date("Y-m-d", strtotime($postValues['binddate']));
        $boundArray['renewable'] = $postValues['renewable'];
        $boundArray['dateofrenewal'] = date("Y-m-d", strtotime($postValues['dateofrenewal']));
        $boundArray['policyName'] = $postValues['policyName'];
        $boundArray['directAssumed'] = $postValues['directAssumed'];
        $boundArray['companyPaper'] = $postValues['companyPaper'];
        $boundArray['companyPaperNumber'] = $postValues['companyPaperNumber'];
        $boundArray['coverage'] = $postValues['coverage'];
        $boundArray['policyNumber'] = $postValues['policyNumber'];
        $boundArray['suffix'] = $postValues['suffix'];
        $boundArray['transactionNumber'] = $postValues['transactionNumber'];
        $boundArray['admitted'] = $postValues['admitted'];
        $boundArray['layerLimitLocalCurrency'] = $postValues['layerLimitLocalCurrency'];
        $boundArray['layerLimitUSD'] = $postValues['layerLimitUSD'];
        $boundArray['PercentageLayer'] = $postValues['PercentageLayer'];
        $boundArray['selfInsuredRetention'] = $postValues['selfInsuredRetention'];
        $boundArray['selfInsuredRetentionUSD'] = $postValues['selfInsuredRetentionUSD'];
        $boundArray['policyCommission'] = $postValues['policyCommission'];
        $boundArray['policyComissionInLocalCurrency'] = $postValues['policyComissionInLocalCurrency'];
        $boundArray['policyComissionInUSD'] = $postValues['policyComissionInUSD'];
        $boundArray['netpremiumCommissionInLocalCurrency'] = $postValues['netpremiumCommissionInLocalCurrency'];
        $boundArray['netpremiumCommissionInUSD'] = $postValues['netpremiumCommissionInUSD'];
        $boundArray['naicCode'] = $postValues['naicCode'];
        $boundArray['naicTitle'] = $postValues['naicTitle'];
        $boundArray['sicCode'] = $postValues['sicCode'];
        $boundArray['sicTitle'] = $postValues['sicTitle'];
        $boundArray['ofrcReport'] = $postValues['ofrcReport'];

        $con = Propel::getConnection();
        $query = "INSERT INTO submissionBound 
              (SubmissionId,BindDate,RenewableLookupId,DateofRenewal,PolicyTypeLookupId,DirectAssumedLookupId,CompanyPaperLookupId,CompanyPaperNumberLookupId,CoverageId,PolicyNumber,SuffixLookupId,TransactionNumber,AdimittedNonAdmittedLookupId,LayerofLimitInLocalCurrency,LayerofLimitInUSD,PercentageofLayer,SelfInsuredRetentionInLocalCurrency,SelfInsuredRetentionInUSD,PolicyCommPercentage,PolicyCommInLocalCurrency,PolicyCommInUSD,PermiumNetofCommInLocalCurrency,PermiumNetofCommInUSD,NAICCode,NAICTitle,SICCode,SICTitle,OFRCAdverseReportLookupId) 
               VALUES 
               ('" . $submissionId . "','" . $boundArray['bindDate'] . "','" . $boundArray['renewable'] . "' ,'" . $boundArray['dateofrenewal'] . "', '" . $boundArray['policyName'] . "', '" . $boundArray['directAssumed'] . "', '" . $boundArray['companyPaper'] . "', '" . $boundArray['companyPaperNumber'] . "', '" . $boundArray['coverage'] . "', '" . $boundArray['policyNumber'] . "', '" . $boundArray['suffix'] . "', '" . $boundArray['transactionNumber'] . "', '" . $boundArray['admitted'] . "', '" . $boundArray['layerLimitLocalCurrency'] . "', '" . $boundArray['layerLimitUSD'] . "', '" . $boundArray['PercentageLayer'] . "', '" . $boundArray['selfInsuredRetention'] . "', '" . $boundArray['selfInsuredRetentionUSD'] . "', '" . $boundArray['policyCommission'] . "', '" . $boundArray['policyComissionInLocalCurrency'] . "', '" . $boundArray['policyComissionInUSD'] . "', '" . $boundArray['netpremiumCommissionInLocalCurrency'] . "', '" . $boundArray['netpremiumCommissionInUSD'] . "', '" . $boundArray['naicCode'] . "', '" . $boundArray['naicTitle'] . "', '" . $boundArray['sicCode'] . "', '" . $boundArray['sicTitle'] . "', '" . $boundArray['ofrcReport'] . "')";
        $insert = $con->prepare($query);
        if ($insert->execute()) {
            return true;
        } else {
            return false;
        }
    }

    public function insertIntoRetailBrokerDetails($postValues, $submissionId) {
        $con = Propel::getConnection();
        $query = "INSERT INTO RetailBrokerDetails 
              (SubmissionId, RetailBrokerName, RetailBrokerCountry,RetailBrokerState,RetailBrokerCity) 
               VALUES 
               ('" . $submissionId . "','" . $postValues['retailBrokerName'] . "','" . $postValues['retailcountrycode'] . "', '" . $postValues['retailstatecode'] . "', '" . $postValues['retailcitycode'] . "')";
        $insert = $con->prepare($query);
        if ($insert->execute()) {
            return true;
        } else {
            return false;
        }
    }

    public function insertBusinessDependentDetails($projrctArray) {
        $con = Propel::getConnection();
        $query = "INSERT INTO BusinessDependentDetail 
              (ProjectName, ProjectGeneralContractorName, ProjectOwnerName, ProjectAddress, BidSituation, ProjectCity, ProjectState, ProjectCountry) 
               VALUES 
               ('" . $projrctArray['projectName'] . "','" . $projrctArray['generalContractorName'] . "','" . $projrctArray['projectOwnerName'] . "' ,'" . $projrctArray['address1'] . "', '" . $projrctArray['projectBidSituationLookupId'] . "', '" . $projrctArray['cityName'] . "', '" . $projrctArray['stateName'] . "', '" . $projrctArray['countryName'] . "')";
        $insert = $con->prepare($query);
        if ($insert->execute()) {
            $STH = $con->query("SELECT CAST(COALESCE(SCOPE_IDENTITY(), @@IDENTITY) AS int)");
            $STH->execute();
            $result = $STH->fetch();
            $businessId = $result[0];
        }
        return $businessId;
    }

    public function insertIntoAddress($AddressArray) {
        $con = Propel::getConnection();
        $query = "INSERT INTO Address 
              (AddressLine1, CityId, Zip) 
               VALUES 
               ('" . $AddressArray['address1'] . "','" . $AddressArray['cityId'] . "','" . $AddressArray['zipcode'] . "')";
        $insert = $con->prepare($query);
        if ($insert->execute()) {
            $STH = $con->query("SELECT CAST(COALESCE(SCOPE_IDENTITY(), @@IDENTITY) AS int)");
            $STH->execute();
            $result = $STH->fetch();
            $addressId = $result[0];
        }
        return $addressId;
    }

    public function insertDataRecorderMetaData($userId) {
        $con = Propel::getConnection();
        $query = "INSERT INTO DataRecorderMetaData 
              (CreatedBy, CreatedOn) 
               VALUES 
               ('" . $userId . "',GETDATE())";
        $insert = $con->prepare($query);
        if ($insert->execute()) {
            $STH = $con->query("SELECT CAST(COALESCE(SCOPE_IDENTITY(), @@IDENTITY) AS int)");
            $STH->execute();
            $result = $STH->fetch();
            $dataRecorderId = $result[0];
        }
        return $dataRecorderId;
    }

    public function getUserName($userId) {
        $con = Propel::getConnection();
        $qry = "SELECT FIRSTNAME ,LASTNAME FROM users WHERE USER_ID = '$userId'";
        $stmt = $con->query($qry);
        $result = $stmt->fetchAll();
        return $result[0];
    }

    public function getCountryId($country) {
        $con = Propel::getConnection();
        $qry = "SELECT Id FROM Country WHERE InsuredCountry LIKE " . "'%$country%'";
        $stmt = $con->query($qry);
        $result = $stmt->fetchAll();
        $countryId = $result[0]['Id'];
        return $countryId;
    }

    public function getStateId($state, $countryId) {
        $con = Propel::getConnection();
        $qry = "SELECT Id FROM State WHERE FullCode LIKE " . "'%$state' and CountryId = '$countryId'";
        $stmt = $con->query($qry);
        $result = $stmt->fetchAll();
        $stateId = $result[0]['Id'];
        return $stateId;
    }

    public function getCityId($city, $stateId) {
        $con = Propel::getConnection();
        $qry = "SELECT Id FROM City WHERE CityFullCode LIKE " . "'%$city' and StateId = '$stateId'";
        $stmt = $con->query($qry);
        $result = $stmt->fetchAll();
        $stateId = $result[0]['Id'];
        return $stateId;
    }

    public function getUnderWritterId($underwritter) {
        $con = Propel::getConnection();
        $qry = "SELECT UNDERWRITER_ID FROM UNDERWRITER WHERE UNDERWRITER_NAME = " . "'$underwritter'";
        $stmt = $con->query($qry);
        $result = $stmt->fetchAll();
        $underWritterId = $result[0]['UNDERWRITER_ID'];
        return $underWritterId;
    }

    public function getBranchId($branchCode) {
        $con = Propel::getConnection();
        $qry = "SELECT Id FROM  Branch WHERE Branch LIKE " . "'$branchCode'";
        $stmt = $con->query($qry);
        $result = $stmt->fetchAll();
        $branchId = $result[0]['Id'];
        return $branchId;
    }

    public function getCountryName() {
        $con = Propel::getConnection();
        $query = "SELECT * FROM Country WHERE Id != '6';";
        $stmt = $con->query($query);
        $result = $stmt->fetchAll();
        return $result;
    }

    public function getBrokerCountryName() {
        $con = Propel::getConnection();
        $query = "SELECT * FROM Country;";
        $stmt = $con->query($query);
        $result = $stmt->fetchAll();
        return $result;
    }

    public function getStateName($countryId) {
        $con = Propel::getConnection();
        if (empty($countryId)) {
            $query = "SELECT * FROM State Where FullCode is not null AND Id != 90 AND Id != 72;";
        } else if (is_numeric($countryId)) {
            $query = "SELECT * FROM State WHERE FullCode is not null AND Id != 90 AND Id != 72 AND CountryId = '" . $countryId . "';";
        }
        $stmt = $con->query($query);
        $result = $stmt->fetchAll(PDO::FETCH_ASSOC);
        return $result;
    }

    public function getCityName($stateId = 0) {
        $con = Propel::getConnection();
        if ($stateId == 0) {
            $query = "SELECT * FROM City Where City != '(Unknown)' AND City != 'Unknown'";
        } else {
            $query = "SELECT * FROM City WHERE City != '(Unknown)' AND City != 'Unknown' AND StateId = '$stateId' ";
        }
        $stmt = $con->query($query);
        $result = $stmt->fetchAll();
        return $result;
    }

    public function getProjectStateName($countryId) {
        $con = Propel::getConnection();
        if (empty($countryId)) {
            $query = "SELECT * FROM State Where ProjectCode is not null AND Id != 90 AND Id != 72;";
        } else if (is_numeric($countryId)) {
            $query = "SELECT * FROM State WHERE ProjectCode is not null AND Id != 90 AND Id != 72 AND CountryId = '" . $countryId . "';";
        }
        $stmt = $con->query($query);
        $result = $stmt->fetchAll(PDO::FETCH_ASSOC);
        return $result;
    }

    public function getLookUpTypeData($data) {
        $con = Propel::getConnection();
        $query = "SELECT L.Id, L.LookupName, L.Alias FROM LookupType as LT LEFT JOIN Lookup as L ON LT.Id = L.LookupTypeId Where LT.LookupTypeName = '$data' ";
        $stmt = $con->query($query);
        $result = $stmt->fetchAll();
        return $result;
    }

    public function getLobData($underWriterName) {
        $con = Propel::getConnection();
        if (empty($underWriterName)) {
            $query = "SELECT * FROM LOB";
        } else {
            $query = "SELECT * FROM LOB WHERE Id = '" . $underWriterName[0]->LOBId . "'";
        }
        $stmt = $con->query($query);
        $result = $stmt->fetchAll();
        return $result;
    }

    public function getLobSubTypeData($underWriterName) {
        $con = Propel::getConnection();
        if ($underWriterName[0]->LOBId == '3') {
            $query = "SELECT Id, ProductLineSubType FROM LOBSubType WHERE Id in (" . $underWriterName[0]->LOBSubTypeId . ") AND ProductLineSubType != 'Not Available' order by ProductLineSubType ASC";
        } else {
            $query = "SELECT Id, ProductLineSubType FROM LOBSubType WHERE LOBId = '" . $underWriterName[0]->LOBId . "' order by ProductLineSubType ASC";
        }
        $stmt = $con->query($query);
        $finalResult = $stmt->fetchAll();
        if (empty($finalResult)) {
            $finalResult['error'] = "No record Found";
        }
        return $finalResult;
    }

    public function getLobSubTypeList() {
        $con = Propel::getConnection();
        $query = "SELECT DISTINCT Id, ProductLineSubType FROM LOBSubType Where ProductLineSubType != 'Not Available' AND ProductLineSubType != 'Not Applicable' ";
        $stmt = $con->query($query);
        $result = $stmt->fetchAll();
        return $result;
    }

    public function getLobList($productType) {
        $con = Propel::getConnection();
        $qry = "SELECT * FROM LOB WHERE LOBName = " . "'$productType'";
        $stmt = $con->query($qry);
        $result = $stmt->fetchAll();
        return $result;
    }

    public function getSectionList() {
        $con = Propel::getConnection();
        $query = "SELECT Id, SectionCode FROM SectionCodeLookup";
        $stmt = $con->query($query);
        $result = $stmt->fetchAll(PDO::FETCH_ASSOC);
        return $result;
    }

    public function getProfitCodeList() {
        $con = Propel::getConnection();
        $query = "SELECT Id, ProfitCodeName FROM  ProfitCodeLookup";
        $stmt = $con->query($query);
        $result = $stmt->fetchAll(PDO::FETCH_ASSOC);
        return $result;
    }

    public function getBrokerList() {
        $con = Propel::getConnection();
        $query = "SELECT Id, BrokerName FROM Broker";
        $stmt = $con->query($query);
        $result = $stmt->fetchAll();
        return $result;
    }

    public function getLookUpTypeList($where) {
        $con = Propel::getConnection();
        $query = "SELECT L.Id, L.LookupName, L.Alias FROM  LookupType as LT INNER JOIN Lookup as L ON LT.Id = L.LookupTypeId WHERE LT.LookupTypeName = '$where'";
        $stmt = $con->query($query);
        $result = $stmt->fetchAll();
        return $result;
    }

    public function getStatusList() {
        $con = Propel::getConnection();
        $query = "SELECT * FROM Status";
        $stmt = $con->query($query);
        $result = $stmt->fetchAll();
        return $result;
    }

    public function getStatusForAmendmentQCList() {
        $con = Propel::getConnection();
        $query = "SELECT * FROM Status Where StatusName = 'Cancellation' OR StatusName = 'Endorsement'";
        $stmt = $con->query($query);
        $result = $stmt->fetchAll();
        return $result;
    }

    public function getStatusForQcList() {
        $con = Propel::getConnection();
        $query = "SELECT * FROM Status Where Statusname !='Cancellation' AND StatusName!='Endorsement'";
        $stmt = $con->query($query);
        $result = $stmt->fetchAll();
        return $result;
    }

    public function getReasonCodeByStatus() {
        $con = Propel::getConnection();
        $query = "SELECT REASON FROM REASON_CODE WHERE STATUS = " . "'declined'";
        $stmt = $con->query($query);
        $result = $stmt->fetchAll();
        return $result;
    }

    public static function getReasonCode() {
        $con = Propel::getConnection();
        $query = "SELECT Id, ReasonCodeName,Meaning FROM ReasonCode";
        $stmt = $con->query($query);
        $result = $stmt->fetchAll();
        return $result;
    }

    public function getReasonCodeById($reasonCodeId) {
        $con = Propel::getConnection();
        $query = "SELECT ReasonCodeName, Meaning FROM ReasonCode WHERE Id = " . "'$reasonCodeId'";
        $stmt = $con->query($query);
        $result = $stmt->fetchAll();
        if (empty($result[0]['Meaning'])) {
            $final = $result[0]['ReasonCodeName'];
        } else {
            $final = $result[0]['ReasonCodeName'] . '-' . $result[0]['Meaning'];
        }
        return $final;
    }

    public static function getPostContent() {
        return trim(file_get_contents("php://input"));
    }

    public function getBroker($token = 0) {
        if ($token == 0) {
            $where = "";
        } else if (is_numeric($token)) {
            $where = "WHERE B.BrokerCode = '" . $token . "'";
        } else {
            $where = "WHERE B.BrokerCode = '" . $token . "'";
        }
        $con = Propel::getConnection();
        $query = "SELECT B.Id, B.BrokerCode AS code, B.BrokerName AS name, L.LookupName AS cat  FROM Broker as B LEFT JOIN Lookup as L ON B.BrokerTypeId = L.Id " . $where . " order by BrokerName;";
        $stmt = $con->query($query);
        $result = $stmt->fetchAll(PDO::FETCH_ASSOC);
        return $result;
    }

    public function getUnderwriterBranchOffice($underwriterID) {
        $con = Propel::getConnection();
        $query = "SELECT U.BranchId, B.Branch FROM Underwriter as U LEFT JOIN Branch as B ON U.BranchId = B.Id WHERE U.Id = '" . $underwriterID . "'";
        $stmt = $con->query($query);
        $result = $stmt->fetchAll(PDO::FETCH_ASSOC);
        return $result;
    }

    public function getSectionCodeName($productDetails) {
        $con = Propel::getConnection();
        $propertyName = $productDetails->productLineId;
        $lobData = $this->getLobList($propertyName);
        $lobId = $lobData[0]['Id'];
        $propertySubTypeId = $productDetails->subTypeId;
        //if ($propertyName == 'Property') {
        //  $query = "SELECT S.Id, SL.SectionCode from sectioncode S join SectionCodeLookup SL on S.SectionCodeLookupId = SL.Id WHERE S.LobId = '" . $lobId . "' AND S.SectionCodeLookupId != 30 AND S.Status = 1 order by SL.SectionCode";
        //} else {
        $query = "SELECT S.Id, SL.SectionCode from sectioncode S join SectionCodeLookup SL on S.SectionCodeLookupId = SL.Id WHERE S.ProductLineSubTypeId = '" . $propertySubTypeId . "' AND S.SectionCodeLookupId != '30' AND S.LobId !=0 AND S.Status = 1 order by SL.SectionCode";
        //}
        $stmt = $con->query($query);
        $result = $stmt->fetchAll(PDO::FETCH_ASSOC);
        if (empty($result)) {
            $result['error'] = "No record Found";
        }
        return $result;
    }

    public function getSectionCodeNameHidden($productDetails) {
        $con = Propel::getConnection();
        $sectionCodeHidden = $productDetails->sectionCodeHidden;
        $check = $this->checkSectionCode($sectionCodeHidden);
        $propertySubTypeId = $productDetails->subTypeId;
        $query = "SELECT S.Id, SL.SectionCode from sectioncode S join SectionCodeLookup SL on S.SectionCodeLookupId = SL.Id WHERE S.ProductLineSubTypeId = '" . $propertySubTypeId . "' AND S.SectionCodeLookupId != '30' AND S.LobId !=0  AND S.Status = 1 order by SL.SectionCode";
        $stmt = $con->query($query);
        $result = $stmt->fetchAll(PDO::FETCH_ASSOC);
        if ($check) {
            $result = array_merge($result, $check);
        }
        if (empty($result)) {
            $result['error'] = "No record Found";
        }
        return $result;
    }

    private function checkSectionCode($sectionCodeHidden) {
        $con = Propel::getConnection();
        $query = "SELECT S.Id, SL.SectionCode from sectioncode S join SectionCodeLookup SL on S.SectionCodeLookupId = SL.Id WHERE S.Id = '" . $sectionCodeHidden . "' and Status = 0 order by SL.SectionCode";
        $stmt = $con->query($query);
        $result = $stmt->fetchAll(PDO::FETCH_ASSOC);
        if (!empty($result)) {
            if ($result[0]['SectionCode'] == 'To Be Entered') {
                return false;
            } else {
                return $result;
            }
        } else {
            return false;
        }
    }

    public function getProfitCodeId($sectionCodeId, $subTypeId, $lobId) {
        $con = Propel::getConnection();
        $sectionQuery = "SELECT SectionCodeLookupId from SectionCode WHERE Id = '" . $sectionCodeId . "' AND LobId is not null";
        $stmt1 = $con->query($sectionQuery);
        $sectionResult = $stmt1->fetchAll(PDO::FETCH_ASSOC);
        $sectionId = $sectionResult[0]['SectionCodeLookupId'];
        if ($lobId == 'Surety') {
            $query = "SELECT P.Id, PL.ProfitCodeName from ProfitCode P join ProfitCodeLookup PL on P.ProfitCodeLookupId = PL.Id WHERE P.SectionCodeLookupId = '" . $sectionId . "' AND P.LobId is not null AND P.Status = 1 order by PL.ProfitCodeName";
        } else {
            $query = "SELECT P.Id, PL.ProfitCodeName from ProfitCode P join ProfitCodeLookup PL on P.ProfitCodeLookupId = PL.Id WHERE P.SectionCodeLookupId = '" . $sectionId . "' AND P.LobSubTypeId = '" . $subTypeId . "' AND P.LobId is not null AND P.Status = 1 order by PL.ProfitCodeName";
        }
        $stmt = $con->query($query);
        $result = $stmt->fetchAll(PDO::FETCH_ASSOC);
        if (empty($result)) {
            $result['error'] = "No record Found";
        }
        return $result;
    }

    public function getProfitCodeIdHidden($sectionCodeId, $subTypeId, $hiddenProfitCode, $lobId) {
        $con = Propel::getConnection();
        $sectionQuery = "SELECT SectionCodeLookupId from SectionCode WHERE Id = '" . $sectionCodeId . "' AND LobId is not null";
        $stmt1 = $con->query($sectionQuery);
        $sectionResult = $stmt1->fetchAll(PDO::FETCH_ASSOC);
        $sectionId = $sectionResult[0]['SectionCodeLookupId'];
        if ($lobId == 'Surety') {
            $query = "SELECT P.Id, PL.ProfitCodeName from ProfitCode P join ProfitCodeLookup PL on P.ProfitCodeLookupId = PL.Id WHERE P.SectionCodeLookupId = '" . $sectionId . "' AND P.LobId is not null AND P.Status = 1 order by PL.ProfitCodeName";
        } else {
            $query = "SELECT P.Id, PL.ProfitCodeName from ProfitCode P join ProfitCodeLookup PL on P.ProfitCodeLookupId = PL.Id WHERE P.SectionCodeLookupId = '" . $sectionId . "' AND P.LobSubTypeId = '" . $subTypeId . "' AND P.LobId is not null AND P.Status = 1 order by PL.ProfitCodeName";
        }
        $stmt = $con->query($query);
        $result = $stmt->fetchAll(PDO::FETCH_ASSOC);
        $check = $this->checkProfitCode($hiddenProfitCode);
        if ($check) {
            $result = array_merge($result, $check);
        }
        if (empty($result)) {
            $result['error'] = "No record Found";
        }
        return $result;
    }

    private function checkProfitCode($hiddenProfitCode) {
        $con = Propel::getConnection();
        $query = "SELECT P.Id, PL.ProfitCodeName from ProfitCode P join ProfitCodeLookup PL on P.ProfitCodeLookupId = PL.Id WHERE P.Id = '" . $hiddenProfitCode . "' AND P.Status = 0 order by PL.ProfitCodeName";
        $stmt = $con->query($query);
        $result = $stmt->fetchAll(PDO::FETCH_ASSOC);
        if (!empty($result)) {
            return $result;
        } else {
            return false;
        }
    }

    public function getProfitCodeIdBySubType($subTypeId) {
        $con = Propel::getConnection();
        $query = "SELECT P.Id, PL.ProfitCodeName from ProfitCode P join ProfitCodeLookup PL on P.ProfitCodeLookupId = PL.Id WHERE P.LobSubTypeId = '" . $subTypeId . "' AND P.LobId is not null";
        $stmt1 = $con->query($query);
        $result = $stmt1->fetchAll(PDO::FETCH_ASSOC);
        if (empty($result)) {
            $result['error'] = "No record Found";
        }
        return $result;
    }

    public function getISOCode($profitCodeId) {
        $con = Propel::getConnection();
        $query = "SELECT PL.ISOCGL from ProfitCode P join ProfitCodeLookup PL on P.ProfitCodeLookupId = PL.Id WHERE P.Id = '" . $profitCodeId . "'";
        $stmt = $con->query($query);
        $result = $stmt->fetchAll(PDO::FETCH_ASSOC);
        if (empty($result[0]['ISOCGL'])) {
            $result['error'] = "No record Found";
        }
        return $result;
    }

    public static function getSubmissionNumber($submissionId) {
        $con = Propel::getConnection();
        $query = "SELECT SubmissionNumber FROM Submission WHERE Id =" . $submissionId;
        $stmt = $con->query($query);
        $result = $stmt->fetchAll(PDO::FETCH_ASSOC);
        return $result[0]['SubmissionNumber'];
    }

    public static function getUserGroup($group_id) {
        $con = Propel::getConnection();
        $query = "SELECT GROUP_NAME FROM Groups WHERE GROUP_ID =" . $group_id;
        $stmt = $con->query($query);
        $result = $stmt->fetchAll(PDO::FETCH_ASSOC);
        return $result[0]['GROUP_NAME'];
    }

    public function getInsuredSuggestionList($queryString) {
        $con = Propel::getConnection();
        $query = "SELECT I.Id as InsuredId, I.InsuredName, I.AddressLine1 as Address, I.Zip, I.City,I.State as StateName, I.Country as InsuredCountry, I.DBNumber as DBNumber FROM Insured as I WHERE I.InsuredName LIKE '" . $queryString . "%' AND I.InsuredStatus = 'Active';";
        $stmt = $con->query($query);
        $result = $stmt->fetchAll(PDO::FETCH_ASSOC);
        $string = '';
        if (!empty($result)) {
            foreach ($result as $values) {
                $string.= '<tr>';
                $string .= '<td><input type="radio" id="chooseinsured" name="choose-insured" value= "' . $values['InsuredId'] . '" /></td>';
                $string .= '<td> ' . $values['InsuredName'] . '</td>';
                $string .= '<td> ' . $values['Address'] . '</td>';
                $string .= '<td> ' . $values['InsuredCountry'] . '</td>';
                $string .= '<td> ' . $values['StateName'] . '</td>';
                $string .= '<td> ' . $values['City'] . '</td>';
                $string .= '<td> ' . $values['Zip'] . '</td>';
                $string .= '<td> ' . $values['DBNumber'] . '</td>';
                $string.= '</tr>';
            }
        } else {
            $string.= '<tr>';
            $string.= '<td>No Record found</td>';
            $string.= '</tr>';
        }
        echo $string;
        exit;
    }

    public function getAmendmentInsuredSuggestionList($queryString, $insuredId) {
        $newString = $this->getAmendmentInsuredName($insuredId);
        //$result = null;
        //if ($newString == substr($queryString, 0, 3)) {
        $con = Propel::getConnection();
        $query = "SELECT I.Id as InsuredId, I.InsuredName, I.AddressLine1 as Address, I.Zip, I.City,I.State as StateName, I.Country as InsuredCountry, I.DBNumber as DBNumber FROM Insured as I WHERE (I.Id = '$insuredId' OR InsuredParentId = '$insuredId') AND InsuredStatus = 'Active' order by Id ASC;";
        $stmt = $con->query($query);
        $result = $stmt->fetchAll(PDO::FETCH_ASSOC);
        // }
        $string = '';
        if (!empty($result)) {
            foreach ($result as $values) {
                $string.= '<tr>';
                $string .= '<td><input type="radio" id="chooseinsured" name="choose-insured" value= "' . $values['InsuredId'] . '" /></td>';
                $string .= '<td> ' . $values['InsuredName'] . '</td>';
                $string .= '<td> ' . $values['Address'] . '</td>';
                $string .= '<td> ' . $values['InsuredCountry'] . '</td>';
                $string .= '<td> ' . $values['StateName'] . '</td>';
                $string .= '<td> ' . $values['City'] . '</td>';
                $string .= '<td> ' . $values['Zip'] . '</td>';
                $string .= '<td> ' . $values['DBNumber'] . '</td>';
                $string.= '</tr>';
            }
        } else {
            $string.= '<tr>';
            $string.= '<td>No Record found</td>';
            $string.= '</tr>';
        }
        echo $string;
        exit;
    }

    private function getAmendmentInsuredName($insuredId) {
        $con = Propel::getConnection();
        $query = "SELECT I.InsuredName FROM Insured as I WHERE I.Id = '$insuredId' AND InsuredStatus = 'Active';";
        $stmt = $con->query($query);
        $result = $stmt->fetchAll(PDO::FETCH_ASSOC);
        $insuredName = substr($result[0]['InsuredName'], 0, 3);
        return $insuredName;
    }

    public function getInsuredDetails($queryString) {
        $con = Propel::getConnection();
        $query = "SELECT I.Id as InsuredId, I.InsuredName, I.AddressLine1 as Address, I.Zip, I.City, I.State as StateName, I.Country as InsuredCountry, I.DBNumber as DBNumber FROM Insured as I WHERE I.Id = $queryString ";
        $stmt = $con->query($query);
        $result = $stmt->fetchAll(PDO::FETCH_ASSOC);
        $finalArray = array();
        $finalArray['insuredId'] = $result[0]['InsuredId'];
        $finalArray['insuredName'] = $result[0]['InsuredName'];
        $finalArray['address'] = $result[0]['Address'];
        $finalArray['country'] = $result[0]['InsuredCountry'];
        $finalArray['state'] = $result[0]['StateName'];
        $finalArray['city'] = $result[0]['City'];
        $finalArray['zipcode'] = $result[0]['Zip'];
        $finalArray['dbnumber'] = $result[0]['DBNumber'];
        return $finalArray;
    }

    public function GetBrokerCountry($brokerCode) {
        $con = Propel::getConnection();
        $query = "SELECT DISTINCT Co.Id, Co.InsuredCountry FROM  Broker as B LEFT JOIN BrokerWiseCity as BW ON B.Id = BW.BrokerId LEFT JOIN City as C ON BW.CityId = C.Id LEFT JOIN State as S ON C.StateId = S.Id LEFT JOIN Country as Co ON S.CountryId = Co.Id  WHERE B.BrokerCode = '$brokerCode' ";
        $stmt = $con->query($query);
        $result = $stmt->fetchAll(PDO::FETCH_ASSOC);
        return $result;
    }

    public function GetBrokerState($brokerCode, $country) {
        $con = Propel::getConnection();
        $query = "SELECT DISTINCT S.Id, S.FullCode,S.StateCode FROM  Broker as B LEFT JOIN BrokerWiseCity as BW ON B.Id = BW.BrokerId LEFT JOIN City as C ON BW.CityId = C.Id LEFT JOIN State as S ON C.StateId = S.Id  WHERE B.BrokerCode = '$brokerCode' AND S.CountryId = '$country'";
        $stmt = $con->query($query);
        $result = $stmt->fetchAll(PDO::FETCH_ASSOC);
        return $result;
    }

    public function GetBrokerCity($brokerCode, $stateId) {
        $con = Propel::getConnection();
        $query = "SELECT DISTINCT C.Id, C.CityFullCode FROM  Broker as B LEFT JOIN BrokerWiseCity as BW ON B.Id = BW.BrokerId LEFT JOIN City as C ON BW.CityId = C.Id WHERE B.BrokerCode = '$brokerCode' AND C.StateId = '$stateId'";
        $stmt = $con->query($query);
        $result = $stmt->fetchAll(PDO::FETCH_ASSOC);
        return $result;
    }

    public function getRetailBrokerCountryName() {
        $con = Propel::getConnection();
        $query = "SELECT * FROM Country WHERE Id != '5';";
        $stmt = $con->query($query);
        $result = $stmt->fetchAll();
        return $result;
    }

    public function GetRetailBrokerStateName($country) {
        $con = Propel::getConnection();
        $query = "SELECT * FROM State WHERE CountryId = '$country' AND RetailBrokerState is not null";
        $stmt = $con->query($query);
        $result = $stmt->fetchAll(PDO::FETCH_ASSOC);
        return $result;
    }

    public function getRetailBrokerCityName($stateId = 0) {
        $con = Propel::getConnection();
        if ($stateId == 0) {
            $query = "SELECT * FROM City";
        } else {
            $query = "SELECT * FROM City WHERE StateId = '$stateId' AND RetailBrokerCity is not null";
        }
        $stmt = $con->query($query);
        $result = $stmt->fetchAll();
        return $result;
    }

    public function BrokerBranchOffice($stateCode, $brokerType) {
        $con = Propel::getConnection();
        if ($brokerType == 'Retailer') {
            $query = "SELECT Retailer FROM  BrokerStateBranch WHERE StateCode = '$stateCode' ";
        } else {
            $query = "SELECT WholeSaler FROM  BrokerStateBranch WHERE StateCode = '$stateCode' ";
        }
        $stmt = $con->query($query);
        $result = $stmt->fetchAll(PDO::FETCH_ASSOC);
        return $result;
    }

    public function GetCountryById($countryId) {
        $con = Propel::getConnection();
        $query = "SELECT * FROM Country Where Id = '" . $countryId . "';";
        $stmt = $con->query($query);
        $result = $stmt->fetchAll();
        return $result[0]['InsuredCountry'];
    }

    public function GetStateById($stateId) {
        $con = Propel::getConnection();
        $query = "SELECT * FROM State Where Id = '" . $stateId . "';";
        $stmt = $con->query($query);
        $result = $stmt->fetchAll();
        return $result[0]['FullCode'];
    }

    public function GetCityById($cityId) {
        $con = Propel::getConnection();
        $query = "SELECT * FROM City Where Id = '" . $cityId . "';";
        $stmt = $con->query($query);
        $result = $stmt->fetchAll();
        return $result[0]['CityFullCode'];
    }

    public function GetProjectStateById($stateId) {
        $con = Propel::getConnection();
        $query = "SELECT * FROM State Where Id = '" . $stateId . "';";
        $stmt = $con->query($query);
        $result = $stmt->fetchAll();
        return $result[0]['ProjectCode'];
    }

    public function GetProjectCityById($cityId) {
        $con = Propel::getConnection();
        $query = "SELECT * FROM City Where Id = '" . $cityId . "';";
        $stmt = $con->query($query);
        $result = $stmt->fetchAll();
        return $result[0]['City'];
    }

    public static function getSubmissionIdentifier($submissionIdentifierId) {
        $con = Propel::getConnection();
        if (empty($submissionIdentifierId)) {
            $query = "SELECT Id, Name FROM SubmissionTypeIndicator";
        } else {
            $query = "SELECT Id, Name FROM SubmissionTypeIndicator WHERE Id =" . $submissionIdentifierId;
        }
        $stmt = $con->query($query);
        $result = $stmt->fetchAll(PDO::FETCH_ASSOC);
        return $result;
    }

    public function GetLobForMAster() {
        $con = Propel::getConnection();
        $query = "SELECT * FROM LOB";
        $stmt = $con->query($query);
        $result = $stmt->fetchAll(PDO::FETCH_ASSOC);
        return $result;
    }

    public function GetLobSubTypeForMAster($LobTypeId) {
        $con = Propel::getConnection();
        $query = "SELECT Id, ProductLineSubType FROM LOBSubType WHERE LOBId = '" . $LobTypeId . "' AND ProductLineSubType != 'Not Available' AND ProductLineSubType != 'Not Applicable' order by ProductLineSubType";
        $stmt = $con->query($query);
        $result = $stmt->fetchAll(PDO::FETCH_ASSOC);
        if (empty($result)) {
            $result['error'] = "No record Found";
        }
        return $result;
    }

    public function GetSectionForMAster($propertySubTypeId, $submissionType) {
        $con = Propel::getConnection();
        if ($submissionType == '1') {
            $query = "SELECT S.Id, SL.SectionCode from sectioncode S join SectionCodeLookup SL on S.SectionCodeLookupId = SL.Id WHERE S.LobId = '" . $submissionType . "' AND S.SectionCodeLookupId != 30 order by SL.SectionCode";
        } else {
            $query = "SELECT S.Id, SL.SectionCode from sectioncode S join SectionCodeLookup SL on S.SectionCodeLookupId = SL.Id WHERE S.ProductLineSubTypeId = '" . $propertySubTypeId . "' AND S.SectionCodeLookupId != '30' AND S.LobId !=0 order by SL.SectionCode";
        }
        $stmt = $con->query($query);
        $result = $stmt->fetchAll(PDO::FETCH_ASSOC);
        if (empty($result)) {
            $result['error'] = "No record Found";
        }
        return $result;
    }

    public function GetProfitForMAster($sectionCodeId, $submissionTypeId, $submissionSubTypeId) {
        $con = Propel::getConnection();
        $sectionQuery = "SELECT SectionCodeLookupId from SectionCode WHERE Id = '" . $sectionCodeId . "' AND LobId is not null";
        $stmt1 = $con->query($sectionQuery);
        $sectionResult = $stmt1->fetchAll(PDO::FETCH_ASSOC);
        $sectionId = $sectionResult[0]['SectionCodeLookupId'];
        if ($submissionTypeId == '1') {
            $query = "SELECT P.Id, PL.ProfitCodeName from ProfitCode P join ProfitCodeLookup PL on P.ProfitCodeLookupId = PL.Id WHERE P.SectionCodeLookupId = '" . $sectionId . "' AND P.LobId is not null order by PL.ProfitCodeName";
        } else {
            $query = "SELECT P.Id, PL.ProfitCodeName from ProfitCode P join ProfitCodeLookup PL on P.ProfitCodeLookupId = PL.Id WHERE P.SectionCodeLookupId = '" . $sectionId . "' AND P.LobSubTypeId = '" . $submissionSubTypeId . "' AND P.LobId is not null order by PL.ProfitCodeName";
        }
        $stmt = $con->query($query);
        $result = $stmt->fetchAll(PDO::FETCH_ASSOC);
        if (empty($result)) {
            $result['error'] = "No record Found";
        }
        return $result;
    }

    public function GetStatusForMAster() {
        $con = Propel::getConnection();
        $query = "SELECT * FROM Status Where StatusName = 'Working' or StatusName ='Pre-Working' or StatusName ='Renewal Pending'";
        $stmt = $con->query($query);
        $result = $stmt->fetchAll(PDO::FETCH_ASSOC);
        return $result;
    }

    public function GetBranchForMAster() {
        $con = Propel::getConnection();
        $query = "SELECT * FROM Branch";
        $stmt = $con->query($query);
        $result = $stmt->fetchAll(PDO::FETCH_ASSOC);
        return $result;
    }

    public function getStateNameForMaster($countryId) {
        $con = Propel::getConnection();
        if (empty($countryId)) {
            $query = "SELECT * FROM State Where FullCode is not null AND Id != 90;";
        } else if (is_numeric($countryId)) {
            $query = "SELECT * FROM State WHERE FullCode is not null AND Id != 90 AND CountryId = '" . $countryId . "';";
        }
        $stmt = $con->query($query);
        $result = $stmt->fetchAll(PDO::FETCH_ASSOC);
        return $result;
    }

    public function getCityNameForMaster($stateId = 0) {
        $con = Propel::getConnection();
        if ($stateId == 0) {
            $query = "SELECT * FROM City WHERE City != 'Unknown' AND StateId != 90";
        } else {
            $query = "SELECT * FROM City WHERE City != 'Unknown' AND StateId != 90 AND StateId = '$stateId' ";
        }
        $stmt = $con->query($query);
        $result = $stmt->fetchAll();
        return $result;
    }

    public function GetPrefix($productLineId) {
        $con = Propel::getConnection();
        $query = "SELECT * FROM LOB where Id = $productLineId";
        $stmt = $con->query($query);
        $result = $stmt->fetchAll(PDO::FETCH_ASSOC);
        return $result;
    }

    public function getOccupancyCode() {
        $con = Propel::getConnection();
        $query = "SELECT * FROM OccupancyCode";
        $stmt = $con->query($query);
        $result = $stmt->fetchAll();
        return $result;
    }

    public function ContactPerson($companyId, $partyType) {
        $con = Propel::getConnection();
        if ($partyType == 98) {
            $query = "SELECT Id, (FirstName +' '+ LastName) AS ContactPerson FROM  ContactPersonDetails WHERE CompanyId = '$companyId' AND PartyTypeId = '$partyType' ";
        } else if ($partyType == 97) {
            $query = "SELECT Id, (FirstName +' '+ LastName) AS ContactPerson FROM  ContactPersonDetails WHERE CompanyId = '$companyId' AND PartyTypeId = '$partyType'  ";
        }
        $stmt = $con->query($query);
        $result = $stmt->fetchAll(PDO::FETCH_ASSOC);
        return $result;
    }

    public function InsuredContactPersonInformation($contactPersonId) {
        $con = Propel::getConnection();
        $query = "select Email As contactPersonEmail, PhoneNumber As contactPersonPhone, MobileNumber As contactPersonMobile from ContactPersonDetails WHERE Id = '$contactPersonId'";
        $stmt = $con->query($query);
        $result = $stmt->fetchAll(PDO::FETCH_ASSOC);
        return $result;
    }

    public function GetBrokerId($brokerCode) {
        $con = Propel::getConnection();
        $query = "select Id from Broker WHERE BrokerCode = '$brokerCode'";
        $stmt = $con->query($query);
        $result = $stmt->fetchAll(PDO::FETCH_ASSOC);
        return $result[0]['Id'];
    }

    public function GetBrokerWiseId($brokerCode, $cityId, $stateId) {
        $con = Propel::getConnection();
        $query = "select Id from Broker WHERE BrokerCode = '$brokerCode'";
        $stmt = $con->query($query);
        $result = $stmt->fetchAll(PDO::FETCH_ASSOC);
        $brokerId = $result[0]['Id'];

        $query1 = "select Id from BrokerWiseCity WHERE BrokerId = '$brokerId' and CityId = '$cityId' and StateId = '$stateId'";
        $stmt1 = $con->query($query1);
        $result1 = $stmt1->fetchAll(PDO::FETCH_ASSOC);
        return $result1[0]['Id'];
    }

    public function GetBrokerIdCityWise($brokerId, $countryId, $stateId, $cityId) {
        $con = Propel::getConnection();
        $query = "select Id from BrokerWiseCity WHERE BrokerId = '$brokerId' AND CityId = '$cityId' AND StateId = '$stateId' AND CountryId = '$countryId'";
        $stmt = $con->query($query);
        $result = $stmt->fetchAll(PDO::FETCH_ASSOC);
        return $result[0]['Id'];
    }

    public function FetchCoverage($status, $productLine, $productLineSubType) {
        $viewObj = new ViewSubmissionDetails();
        $data = $viewObj->getLobSubTypeName($productLineSubType);
        if ($status == '9') {
            $connection = Propel::getConnection();
            if ($data[0]['ProductLineSubType'] == '0505-Ageis') {
                $productQuery = "SELECT * FROM Coverage Where LobId = '$productLine' order by Name ASC";
            } else {
                $productQuery = "SELECT * FROM Coverage Where LobId = '$productLine' AND Name != 'AEG' order by Name ASC";
            }
            $productStatement = $connection->prepare($productQuery);
            $productStatement->execute();
            $coverageData = $productStatement->fetchAll(PDO::FETCH_ASSOC);
            return $coverageData;
        }
    }
    
    public function CheckForDuplicatePolicyNumber($PolicyNumber) {
        $connection = Propel::getConnection();
        $policyQuery = "SELECT * FROM SubmissionBound Where PolicyNumber = '$PolicyNumber'";
        $policyStatement = $connection->prepare($policyQuery);
        $policyStatement->execute();
        $policyData = $policyStatement->fetchAll(PDO::FETCH_ASSOC);
        if ($policyData) {
            return true;
        } else {
            return false;
        }
    }

    public function GetCoverage() {
        $connection = Propel::getConnection();
        $productQuery = "SELECT * FROM Coverage";
        $productStatement = $connection->prepare($productQuery);
        $productStatement->execute();
        $coverageData = $productStatement->fetchAll(PDO::FETCH_ASSOC);
        return $coverageData;
    }

    function GetBrokerStateId($brokercode, $country_id) {
        $con = Propel::getConnection();
        $qry = "SELECT Id FROM State WHERE code LIKE " . "'%$brokercode' and CountryId = '$country_id'";
        $stmt = $con->query($qry);
        $result = $stmt->fetchAll();
        $stateId = $result[0]['Id'];
        return $stateId;
    }

    public function getBrokerCityId($city, $stateId) {
        $con = Propel::getConnection();
        $qry = "SELECT Id FROM City WHERE CityCode LIKE " . "'%$city' and StateId = '$stateId'";
        $stmt = $con->query($qry);
        $result = $stmt->fetchAll();
        $cityId = $result[0]['Id'];
        return $cityId;
    }

    public function validateSubmission($postValues, $groupId) {
        $emptyColumn = array();
        if (!empty($postValues['new_renewal']) && $postValues['new_renewal'] != 0) {
            
        } else {
            $emptyColumn[] = 'NewRenewal';
        }
        if (!empty($groupId) && $groupId == 58) {
            if (isset($postValues['underwriter_master']) && !empty($postValues['underwriter_master']) && $postValues['underwriter_master'] != 0) {
                
            } else {
                $emptyColumn[] = 'Underwriter';
            }
            if (isset($postValues['product_line_master']) && !empty($postValues['product_line_master'])) {
                
            } else {
                $emptyColumn[] = 'Product line';
            }

            if (isset($postValues['product_line_subtype_master']) && !empty($postValues['product_line_subtype_master']) && $postValues['product_line_subtype_master'] != 0) {
                
            } else {
                $emptyColumn[] = 'product line subtype';
            }
            if (isset($postValues['section_master']) && !empty($postValues['section_master']) && $postValues['section_master'] != 0) {
                
            } else {
                $emptyColumn[] = 'Section';
            }
            if (isset($postValues['profitcode_master']) && !empty($postValues['profitcode_master']) && $postValues['profitcode_master'] != 0) {
                
            } else {
                $emptyColumn[] = 'Profitcode';
            }
            if (isset($postValues['primarystatus_master']) && !empty($postValues['primarystatus_master']) && $postValues['primarystatus_master'] != 0) {
                
            } else {
                $emptyColumn[] = 'Primary status';
            }
        } else {
            if (isset($postValues['underwriter']) && !empty($postValues['underwriter']) && $postValues['underwriter'] != 0) {
                
            } else {
                $emptyColumn[] = 'Underwriter';
            }
            if (isset($postValues['product_line']) && !empty($postValues['product_line'])) {
                
            } else {
                $emptyColumn[] = 'Product line';
            }

            if (isset($postValues['product_line_subtype']) && !empty($postValues['product_line_subtype']) && $postValues['product_line_subtype'] != 0) {
                
            } else {
                $emptyColumn[] = 'product line subtype';
            }
            if (isset($postValues['section']) && !empty($postValues['section']) && $postValues['section'] != 0) {
                
            } else {
                $emptyColumn[] = 'Section';
            }
            if (isset($postValues['profitcode']) && !empty($postValues['profitcode']) && $postValues['profitcode'] != 0) {
                
            } else {
                $emptyColumn[] = 'Profitcode';
            }
            if (isset($postValues['primarystatus']) && !empty($postValues['primarystatus']) && $postValues['primarystatus'] != 0) {
                
            } else {
                $emptyColumn[] = 'Primary status';
            }
        }
        if (isset($postValues['effectivedate']) && !empty($postValues['effectivedate'])) {
            
        } else {
            $emptyColumn[] = 'Effective date';
        }
        if (isset($postValues['expirydate']) && !empty($postValues['expirydate'])) {
            
        } else {
            $emptyColumn[] = 'Expiry date';
        }
        if (isset($postValues['currency']) && !empty($postValues['currency']) && $postValues['currency'] != 0) {
            
        } else {
            $emptyColumn[] = 'Currency';
        }
        if (isset($postValues['exchangeRate']) && !empty($postValues['exchangeRate'])) {
            
        } else {
            $emptyColumn[] = 'Exchange Rate';
        }
        if (isset($postValues['exchangeRateDate']) && !empty($postValues['exchangeRateDate'])) {
            
        } else {
            $emptyColumn[] = 'Exchange Rate Date';
        }
        if (isset($postValues['insuredName']) && !empty($postValues['insuredName'])) {
            
        } else {
            $emptyColumn[] = 'Insured Name';
        }
        if (isset($postValues['insured_name']) && $postValues['insured_name'] == 'Y') {
            if (!empty($postValues['dbaname'])) {
                
            } else {
                $emptyColumn[] = 'DBA Name';
            }
        }
        if (isset($postValues['insuredContactPerson']) && !empty($postValues['insuredContactPerson'])) {
            
        } else {
            $emptyColumn[] = 'Insured Contact Person';
        }
        if (isset($postValues['insured_country']) && !empty($postValues['insured_country'])) {
            
        } else {
            $emptyColumn[] = 'Insured Country';
        }
        if (isset($postValues['dbnumber']) && !empty($postValues['dbnumber'])) {
            
        } else {
            $emptyColumn[] = 'D&B Number';
        }
        if (isset($postValues['insured_state']) && !empty($postValues['insured_state'])) {
            
        } else {
            $emptyColumn[] = 'Insured State';
        }
        if (isset($postValues['cabValue']) && !empty($postValues['cabValue'])) {
            
        } else {
            $emptyColumn[] = 'Cab Companies';
        }
        if (isset($postValues['insured_city']) && !empty($postValues['insured_city'])) {
            
        } else {
            $emptyColumn[] = 'Insured city';
        }
        if (isset($postValues['brokercode']) && !empty($postValues['brokercode'])) {
            
        } else {
            $emptyColumn[] = 'Broker code';
        }
        if (isset($postValues['isWholesaler']) && !empty($postValues['isWholesaler'])) {
            if ($postValues['isWholesaler'] == 'Wholesaler') {
                if (!empty($postValues['retailBrokerName'])) {
                    
                } else {
                    $emptyColumn[] = 'Retail broker name';
                }
                if (!empty($postValues['retailcountrycode'])) {
                    
                } else {
                    $emptyColumn[] = 'Retail country code';
                }
                if (!empty($postValues['retailstatecode'])) {
                    
                } else {
                    $emptyColumn[] = 'Retail state code';
                }
                if (!empty($postValues['retailcitycode'])) {
                    
                } else {
                    $emptyColumn[] = 'Retail city code';
                }
            }
        } else {
            $emptyColumn[] = 'Wholesaler or Retailer';
        }
        if (isset($postValues['brokerId']) && !empty($postValues['brokerId'])) {
            
        } else {
            $emptyColumn[] = 'Broker Name';
        }
        if (isset($postValues['countrycode']) && !empty($postValues['countrycode']) && $postValues['countrycode'] != 0) {
            
        } else {
            $emptyColumn[] = 'Broker Country';
        }
        if (isset($postValues['statecode']) && !empty($postValues['statecode']) && $postValues['statecode'] != 0) {
            
        } else {
            $emptyColumn[] = 'State code';
        }
        if (isset($postValues['citycode']) && !empty($postValues['citycode']) && $postValues['citycode'] != 0) {
            
        } else {
            $emptyColumn[] = 'City code';
        }
        if (isset($postValues['brokercontactperson']) && !empty($postValues['brokercontactperson'])) {
            
        } else {
            $emptyColumn[] = 'Broker contact person';
        }
        if (isset($postValues['brokerCodegenerate']) && !empty($postValues['brokerCodegenerate'])) {
            
        } else {
            $emptyColumn[] = 'Generated Broker Code';
        }
        if (isset($postValues['yesBroker']) && $postValues['yesBroker'] == 'N') {
            if (isset($postValues['byBerkSi']) && !empty($postValues['byBerkSi'])) {
                
            } else {
                $emptyColumn[] = 'byBerkSi';
            }
        }
        if (isset($postValues['yesIndia']) && $postValues['yesIndia'] == 'N') {
            if (isset($postValues['byIndia']) && !empty($postValues['byIndia'])) {
                
            } else {
                $emptyColumn[] = 'byIndia';
            }
        }
        if (isset($postValues['branch_office']) && !empty($postValues['branch_office']) && $postValues['branch_office'] != 0) {
            
        } else {
            $emptyColumn[] = 'and Branch office';
        }
        return $emptyColumn;
    }

}
