<?php

class History {

    public function __construct() {
        $this->connection = Propel::getConnection();
    }

    /**
     * This method Format the information in Submission History
     */
    public function FormatHistoryData($results) {
        $current_date = '';
        foreach ($results as $data) {
            $current_date[] = date('m-d-Y h:i:s', strtotime($data['ModifiedOn']));
        }
        $filteredArray = array_unique($current_date);
        foreach ($filteredArray as $arr) {
            $newArray[] = $arr;
        }
        $SubmissionClassObj = new SubmissionDetails();
        $resultset = array();
        $finalResult = array();
        
        
        foreach ($results as $res) {
            $resultset['Id'] = $res['Id'];
            $resultset['Field'] = $res['Field'];
            if ($res['Field'] == 'Attachment Point' || $res['Field'] == 'Limit' || $res['Field'] == 'Gross Premium') {
                if ($res['OldValue'] == '-2') {
                    $resultset['OldValue'] = 'To Be  Entered';
                } else if ($res['OldValue'] == '-1') {
                    $resultset['OldValue'] = 'Not Available';
                } else {
                    $resultset['OldValue'] = $res['OldValue'];
                }

                if ($res['NewValue'] == '-2') {
                    $resultset['NewValue'] = 'To Be  Entered';
                } else if ($res['NewValue'] == '-1') {
                    $resultset['NewValue'] = 'Not Available';
                } else {
                    $resultset['NewValue'] = $res['NewValue'];
                }
            } else {
                $resultset['OldValue'] = $res['OldValue'];
                $resultset['NewValue'] = $res['NewValue'];
            }
            $resultset['Remarks'] = $res['Remarks'];

            $userDetails = $SubmissionClassObj->getUserName($res['ModifiedBy']);
            $resultset['ModifiedBy'] = $userDetails['FIRSTNAME'] . " " . $userDetails['LASTNAME'];
            $resultset['ModifiedOn'] = $res['ModifiedOn'];
            $res['ModifiedOn'] = date('m-d-Y h:i:s', strtotime($res['ModifiedOn']));
            foreach ($newArray as $newdate) {
                if ($res['ModifiedOn'] == $newdate) {
                    $finalResult[$res['ModifiedOn']][] = $resultset;
                }
            }
        }
        return $finalResult;
    }

    /**
     * This method save the information in Submission History
     */
    public static function SaveSubmissionHistory($oldSubmissionRow, $postedValues, $userId, $submissionId, $userGroup) {
        $subObj = new SubmissionDetails();
        $editObj = new EditSubmissionDetails();
        $viewObj = new ViewSubmissionDetails();

        $con = Propel::getConnection();
        $remarks = $postedValues['editRemark'];
        $historyArray = array();

        if (trim($oldSubmissionRow['DuckSubmissionNumber']) != trim($postedValues['editDuckSubmissionNumber'])) {
            $historyArray['FieldName'][] = 'Duck Creek Submission Number';
            $historyArray['OldValue'][] = str_replace("'", "''", $oldSubmissionRow['DuckSubmissionNumber']);
            $historyArray['NewValue'][] = str_replace("'", "''", $postedValues['editDuckSubmissionNumber']);
        }
        if (trim($oldSubmissionRow['NewRenewalLookupId']) != trim($postedValues['newrenewal'])) {
            $oldNewRenewal = $viewObj->getLookUpdata($oldSubmissionRow['NewRenewalLookupId']);
            $newNewRenewal = $viewObj->getLookUpdata($postedValues['newrenewal']);
            $historyArray['FieldName'][] = 'New/Renewal';
            $historyArray['OldValue'][] = $oldNewRenewal[0]['LookupName'];
            $historyArray['NewValue'][] = $newNewRenewal[0]['LookupName'];
        }
        if (trim($oldSubmissionRow['UnderwriterId']) != trim($postedValues['editunderwriter'])) {
            $oldUnderwriter = $subObj->getUnderWriterName($oldSubmissionRow['UnderwriterId']);
            $newUnderwriter = $subObj->getUnderWriterName($postedValues['editunderwriter']);
            $historyArray['FieldName'][] = 'Underwriter';
            $historyArray['OldValue'][] = $oldUnderwriter[0]->Name;
            $historyArray['NewValue'][] = $newUnderwriter[0]->Name;
        }
        if ($userGroup == 'master') {
            if (trim($oldSubmissionRow['LobId']) != trim($postedValues['productline_master'])) {
                $oldLobData = $viewObj->getLobName($oldSubmissionRow['LobId']);
                $oldLob = $oldLobData[0]['LOBName'];
                $newLobData = $viewObj->getLobName($postedValues['productline_master']);
                $newLob = $newLobData[0]['LOBName'];
                $historyArray['FieldName'][] = 'Product Line';
                $historyArray['OldValue'][] = $oldLob;
                $historyArray['NewValue'][] = $newLob;
            }
        } else {
            $lobData = $subObj->getLobList($postedValues['editproductline']);
            $newLobId = $lobData[0]['Id'];
            if (trim($oldSubmissionRow['LobId']) != trim($newLobId)) {
                $oldLobData = $viewObj->getLobName($oldSubmissionRow['LobId']);
                $oldLob = $oldLobData[0]['LOBName'];
                $newLobData = $viewObj->getLobName($newLobId);
                $newLob = $newLobData[0]['LOBName'];
                $historyArray['FieldName'][] = 'Product Line';
                $historyArray['OldValue'][] = $oldLob;
                $historyArray['NewValue'][] = $newLob;
            }
        }
        if ($userGroup == 'master') {
            if (trim($oldSubmissionRow['LobSubTypeId']) != trim($postedValues['editproductlinesubtype_master'])) {
                $oldLobSubType = $viewObj->getLobSubTypeName($oldSubmissionRow['LobSubTypeId']);
                $oldLobSub = $oldLobSubType[0]['ProductLineSubType'];
                $newLobSubType = $viewObj->getLobSubTypeName($postedValues['editproductlinesubtype_master']);
                $newLobSub = $newLobSubType[0]['ProductLineSubType'];
                $historyArray['FieldName'][] = 'Product Line Subtype';
                $historyArray['OldValue'][] = $oldLobSub;
                $historyArray['NewValue'][] = $newLobSub;
            }
        } else {
            if (trim($oldSubmissionRow['LobSubTypeId']) != trim($postedValues['editproductlinesubtype'])) {
                $oldLobSubType = $viewObj->getLobSubTypeName($oldSubmissionRow['LobSubTypeId']);
                $oldLobSub = $oldLobSubType[0]['ProductLineSubType'];
                $newLobSubType = $viewObj->getLobSubTypeName($postedValues['editproductlinesubtype']);
                $newLobSub = $newLobSubType[0]['ProductLineSubType'];
                $historyArray['FieldName'][] = 'Product Line Subtype';
                $historyArray['OldValue'][] = $oldLobSub;
                $historyArray['NewValue'][] = $newLobSub;
            }
        }
        if ($userGroup == 'master') {
            if (trim($oldSubmissionRow['SectionId']) != trim($postedValues['editsection_master'])) {
                $oldSectionData = $viewObj->getSection($oldSubmissionRow['SectionId']);
                $oldSection = $oldSectionData[0]['SectionCode'];
                $newSectionData = $viewObj->getSection($postedValues['editsection_master']);
                $newSection = $newSectionData[0]['SectionCode'];
                $historyArray['FieldName'][] = 'Section';
                $historyArray['OldValue'][] = $oldSection;
                $historyArray['NewValue'][] = $newSection;
            }
        } else {
            if (trim($oldSubmissionRow['SectionId']) != trim($postedValues['editsection'])) {
                $oldSectionData = $viewObj->getSection($oldSubmissionRow['SectionId']);
                $oldSection = $oldSectionData[0]['SectionCode'];
                $newSectionData = $viewObj->getSection($postedValues['editsection']);
                $newSection = $newSectionData[0]['SectionCode'];
                $historyArray['FieldName'][] = 'Section';
                $historyArray['OldValue'][] = $oldSection;
                $historyArray['NewValue'][] = $newSection;
            }
        }
        if ($userGroup == 'master') {
            if (trim($oldSubmissionRow['ProfitCodeId']) != trim($postedValues['editprofitcode_master'])) {
                $oldProfitData = $viewObj->getprofit($oldSubmissionRow['ProfitCodeId']);
                $oldProfit = $oldProfitData[0]['ProfitCodeName'];
                $newProfitData = $viewObj->getprofit($postedValues['editprofitcode_master']);
                $newProfit = $newProfitData[0]['ProfitCodeName'];
                $historyArray['FieldName'][] = 'Profit Code';
                $historyArray['OldValue'][] = $oldProfit;
                $historyArray['NewValue'][] = $newProfit;

                if (isset($postedValues['editisccode'])) {
                    $oldisocode = $subObj->getISOCode($oldSubmissionRow['ProfitCodeId']);
                    $newisocode = $subObj->getISOCode($postedValues['editprofitcode_master']);
                    $historyArray['FieldName'][] = 'ISO Code';
                    if (!empty($oldisocode[0]['ISOCGL'])) {
                        $historyArray['OldValue'][] = $oldisocode[0]['ISOCGL'];
                    }else {
                        $historyArray['OldValue'][] = '';
                    }
                    if (!empty($newisocode[0]['ISOCGL'])) {
                        $historyArray['NewValue'][] = $newisocode[0]['ISOCGL'];
                    }else {
                        $historyArray['NewValue'][] = '';
                    }
                }
            }
        } else {
            if (trim($oldSubmissionRow['ProfitCodeId']) != trim($postedValues['editprofitcode'])) {
                $oldProfitData = $viewObj->getprofit($oldSubmissionRow['ProfitCodeId']);
                $oldProfit = $oldProfitData[0]['ProfitCodeName'];
                $newProfitData = $viewObj->getprofit($postedValues['editprofitcode']);
                $newProfit = $newProfitData[0]['ProfitCodeName'];
                $historyArray['FieldName'][] = 'Profit Code';
                $historyArray['OldValue'][] = $oldProfit;
                $historyArray['NewValue'][] = $newProfit;

                if (isset($postedValues['editisccode'])) {
                    $oldisocode = $subObj->getISOCode($oldSubmissionRow['ProfitCodeId']);
                    $newisocode = $subObj->getISOCode($postedValues['editprofitcode']);
                    $historyArray['FieldName'][] = 'ISO Code';
                    if (!empty($oldisocode[0]['ISOCGL'])) {
                        $historyArray['OldValue'][] = $oldisocode[0]['ISOCGL'];
                    }else{
                        $historyArray['OldValue'][] = '';
                    }
                    if (!empty($newisocode[0]['ISOCGL'])) {
                        $historyArray['NewValue'][] = $newisocode[0]['ISOCGL'];
                    }else{
                        $historyArray['NewValue'][] = '';
                    }
                }
            }
        }
        if (trim($oldSubmissionRow['CurrentStatusId']) != trim($postedValues['editprimarystatus'])) {
            $oldCurrentStatusData = $viewObj->getStatus($oldSubmissionRow['CurrentStatusId']);
            $oldCurrentStatus = $oldCurrentStatusData[0]['StatusName'];
            $newCurrentStatusData = $viewObj->getStatus($postedValues['editprimarystatus']);
            $newCurrentStatus = $newCurrentStatusData[0]['StatusName'];
            $historyArray['FieldName'][] = 'Status';
            $historyArray['OldValue'][] = $oldCurrentStatus;
            $historyArray['NewValue'][] = $newCurrentStatus;
        }
        if (date("Y-m-d", strtotime($oldSubmissionRow['EffectiveDate'])) != date("Y-m-d", strtotime($postedValues['effectiveDate']))) {
            $historyArray['FieldName'][] = 'Effective Date';
            $historyArray['OldValue'][] = $oldSubmissionRow['EffectiveDate'];
            $historyArray['NewValue'][] = $postedValues['effectiveDate'];
        }
        if (date("Y-m-d", strtotime($oldSubmissionRow['ExpiryDate'])) != date("Y-m-d", strtotime($postedValues['expityDate']))) {
            $historyArray['FieldName'][] = 'Expiry Date';
            $historyArray['OldValue'][] = $oldSubmissionRow['ExpiryDate'];
            $historyArray['NewValue'][] = date("Y-m-d", strtotime($postedValues['expityDate']));
        }
        if (trim($oldSubmissionRow['IsDifferentDba']) != trim($postedValues['insured_name_status'])) {
            $historyArray['FieldName'][] = 'Is DBA name different';
            $historyArray['OldValue'][] = $oldSubmissionRow['IsDifferentDba'];
            $historyArray['NewValue'][] = $postedValues['insured_name_status'];
        }
        if (trim($oldSubmissionRow['DbaName']) != trim($postedValues['dbaName'])) {
            $historyArray['FieldName'][] = 'DBA Name';
            $historyArray['OldValue'][] = str_replace("'", "''", $oldSubmissionRow['DbaName']);
            $historyArray['NewValue'][] = str_replace("'", "''", $postedValues['dbaName']);
        }
        if (trim($oldSubmissionRow['InsuredName']) != trim($postedValues['editinsuredname'])) {
            $historyArray['FieldName'][] = 'Insured Name';
            $historyArray['OldValue'][] = str_replace("'", "''", $oldSubmissionRow['InsuredName']);
            $historyArray['NewValue'][] = str_replace("'", "''", $postedValues['editinsuredname']);
        }
        if (isset($postedValues['insured_address']) && trim($oldSubmissionRow['AddressLine1']) != trim($postedValues['insured_address'])) {
            $historyArray['FieldName'][] = 'Insured AddressLine1';
            $historyArray['OldValue'][] = str_replace("'", "''", $oldSubmissionRow['AddressLine1']);
            $historyArray['NewValue'][] = str_replace("'", "''", $postedValues['insured_address']);
        }
        if (isset($postedValues['insured_country']) && trim($oldSubmissionRow['Country']) != trim($postedValues['insured_country'])) {
            $historyArray['FieldName'][] = 'Insured Country';
            $historyArray['OldValue'][] = $oldSubmissionRow['Country'];
            $historyArray['NewValue'][] = $postedValues['insured_country'];
        }
        if (isset($postedValues['insured_state']) && trim($oldSubmissionRow['State']) != trim($postedValues['insured_state'])) {
            $historyArray['FieldName'][] = 'Insured State';
            $historyArray['OldValue'][] = $oldSubmissionRow['State'];
            $historyArray['NewValue'][] = $postedValues['insured_state'];
        }
        if (isset($postedValues['insured_city']) && trim($oldSubmissionRow['City']) != trim($postedValues['insured_city'])) {
            $historyArray['FieldName'][] = 'Insured City';
            $historyArray['OldValue'][] = $oldSubmissionRow['City'];
            $historyArray['NewValue'][] = $postedValues['insured_city'];
        }
        if (isset($postedValues['insured_zipcode']) && trim($oldSubmissionRow['Zip']) != trim($postedValues['insured_zipcode'])) {
            $historyArray['FieldName'][] = 'Insured Zipcode';
            $historyArray['OldValue'][] = $oldSubmissionRow['Zip'];
            $historyArray['NewValue'][] = $postedValues['insured_zipcode'];
        }
        if (isset($postedValues['db_number']) && trim($oldSubmissionRow['DBNumber']) != trim($postedValues['db_number'])) {
            $historyArray['FieldName'][] = 'D&B Number';
            $historyArray['OldValue'][] = $oldSubmissionRow['DBNumber'];
            $historyArray['NewValue'][] = $postedValues['db_number'];
        }

        if (trim($oldSubmissionRow['CABCompaniesLookupId']) != trim(implode(" & ", $postedValues['editcabcompanies']))) {
            $historyArray['FieldName'][] = 'Priority Companies';
            $historyArray['OldValue'][] = $oldSubmissionRow['CABCompaniesLookupId'];
            $historyArray['NewValue'][] = implode(" & ", $postedValues['editcabcompanies']);
        }
        if (trim($oldSubmissionRow['ReinsuredCompany']) != trim($postedValues['reinsured_company'])) {
            $historyArray['FieldName'][] = 'Reinsured Company';
            $historyArray['OldValue'][] = str_replace("'", "''", $oldSubmissionRow['ReinsuredCompany']);
            $historyArray['NewValue'][] = str_replace("'", "''", $postedValues['reinsured_company']);
        }
        if (trim($oldSubmissionRow['SubmissionIdentifier']) != trim($postedValues['editsubmissiontypeidrntifier'])) {
            $historyArray['FieldName'][] = 'Submission Type Identifier';
            $oldSubmissionTypeIdentifier = $viewObj->getSubmissionIdentifier($oldSubmissionRow['SubmissionIdentifier']);
            $newSubmissionTypeIdentifier = $viewObj->getSubmissionIdentifier($postedValues['editsubmissiontypeidrntifier']);
            $historyArray['OldValue'][] = $oldSubmissionTypeIdentifier;
            $historyArray['NewValue'][] = $newSubmissionTypeIdentifier;
        }
        if (isset($postedValues['editinsuredContactPerson']) && trim($oldSubmissionRow['InsuredContactPersonId']) != trim($postedValues['editinsuredContactPerson'])) {
            if (empty($oldSubmissionRow['InsuredContactPersonId'])) {
                $oldContactPerson = null;
            } else {
                $oldContactPersonData = $editObj->FetchContactPerson($oldSubmissionRow['InsuredContactPersonId']);
                $oldContactPerson = $oldContactPersonData[0]['Name'];
            }
            if (empty($postedValues['editinsuredContactPerson'])) {
                $newContactPerson = null;
            } else {
                $newContactPersonData = $editObj->FetchContactPerson($postedValues['editinsuredContactPerson']);
                $newContactPerson = $newContactPersonData[0]['Name'];
            }
            $historyArray['FieldName'][] = 'Insured Contact Person';
            $historyArray['OldValue'][] = $oldContactPerson;
            $historyArray['NewValue'][] = $newContactPerson;
        }
        if (isset($postedValues['editinsuredContactPersonEmail']) && trim($oldSubmissionRow['InsuredCompanyEmail']) != trim($postedValues['editinsuredContactPersonEmail'])) {
            $historyArray['FieldName'][] = 'Insured Contact Person Email';
            $historyArray['OldValue'][] = str_replace("'", "''", $oldSubmissionRow['InsuredCompanyEmail']);
            $historyArray['NewValue'][] = str_replace("'", "''", $postedValues['editinsuredContactPersonEmail']);
        }
        if (isset($postedValues['editinsuredContactPersonNumber']) && trim($oldSubmissionRow['InsuredContactPhone']) != trim($postedValues['editinsuredContactPersonNumber'])) {
            $historyArray['FieldName'][] = 'Insured Contact Person Phone Number';
            $historyArray['OldValue'][] = $oldSubmissionRow['InsuredContactPhone'];
            $historyArray['NewValue'][] = $postedValues['editinsuredContactPersonNumber'];
        }
        if (isset($postedValues['editinsuredContactPersonMobile']) && trim($oldSubmissionRow['InsuredContactMobile']) != trim($postedValues['editinsuredContactPersonMobile'])) {
            $historyArray['FieldName'][] = 'Insured Contact Person Mobile Number';
            $historyArray['OldValue'][] = $oldSubmissionRow['InsuredContactMobile'];
            $historyArray['NewValue'][] = $postedValues['editinsuredContactPersonMobile'];
        }

        $validDate = date('Y-m-d', strtotime('-10 years'));
        if (date("Y-m-d", strtotime($oldSubmissionRow['InsuredSubmissionDate'])) > $validDate) {
            $oldSubmissionRow['InsuredSubmissionDate'] = $oldSubmissionRow['InsuredSubmissionDate'];
        } else {
            $oldSubmissionRow['InsuredSubmissionDate'] = '';
        }

        if (date("Y-m-d", strtotime($oldSubmissionRow['InsuredSubmissionDate'])) != date("Y-m-d", strtotime($postedValues['editinsuredSubmissionDate']))) {
            $historyArray['FieldName'][] = 'Insured Submission Date';
            if (empty($oldSubmissionRow['InsuredSubmissionDate'])) {
                $historyArray['OldValue'][] = '';
            } else if (date("Y-m-d", strtotime($oldSubmissionRow['InsuredSubmissionDate'])) > $validDate) {
                $historyArray['OldValue'][] = $oldSubmissionRow['InsuredSubmissionDate'];
            }
            if (empty($postedValues['editinsuredSubmissionDate'])) {
                $historyArray['NewValue'][] = '';
            } else if (date("Y-m-d", strtotime($postedValues['editinsuredSubmissionDate'])) > $validDate) {
                $historyArray['NewValue'][] = date("Y-m-d", strtotime($postedValues['editinsuredSubmissionDate']));
            }
        }
        if (date("Y-m-d", strtotime($oldSubmissionRow['InsuredQuoteDueDate'])) > $validDate) {
            $oldSubmissionRow['InsuredQuoteDueDate'] = $oldSubmissionRow['InsuredQuoteDueDate'];
        } else {
            $oldSubmissionRow['InsuredQuoteDueDate'] = '';
        }

        if (date("Y-m-d", strtotime($oldSubmissionRow['InsuredQuoteDueDate'])) != date("Y-m-d", strtotime($postedValues['editinsuredQuoteDueDate']))) {
            $historyArray['FieldName'][] = 'Insured Quote Due Date';
            if (empty($oldSubmissionRow['InsuredQuoteDueDate'])) {
                $historyArray['OldValue'][] = '';
            } else if (date("Y-m-d", strtotime($oldSubmissionRow['InsuredQuoteDueDate'])) > $validDate) {
                $historyArray['OldValue'][] = $oldSubmissionRow['InsuredQuoteDueDate'];
            }
            if (empty($postedValues['editinsuredQuoteDueDate'])) {
                $historyArray['NewValue'][] = '';
            } else if (date("Y-m-d", strtotime($postedValues['editinsuredQuoteDueDate'])) > $validDate) {
                $historyArray['NewValue'][] = date("Y-m-d", strtotime($postedValues['editinsuredQuoteDueDate']));
            }
        }


        if (trim($oldSubmissionRow['ProjectName']) != trim($postedValues['project_name'])) {
            $historyArray['FieldName'][] = 'Project Name';
            $historyArray['OldValue'][] = str_replace("'", "''", $oldSubmissionRow['ProjectName']);
            $historyArray['NewValue'][] = str_replace("'", "''", $postedValues['project_name']);
        }
        if (trim($oldSubmissionRow['ProjectGeneralContractorName']) != trim($postedValues['general_contrator_name'])) {
            $historyArray['FieldName'][] = 'Name of General Contractor';
            $historyArray['OldValue'][] = str_replace("'", "''", $oldSubmissionRow['ProjectGeneralContractorName']);
            $historyArray['NewValue'][] = str_replace("'", "''", $postedValues['general_contrator_name']);
        }
        if (trim($oldSubmissionRow['ProjectOwnerName']) != trim($postedValues['project_owner_name'])) {
            $historyArray['FieldName'][] = 'Project Owner Name';
            $historyArray['OldValue'][] = str_replace("'", "''", $oldSubmissionRow['ProjectOwnerName']);
            $historyArray['NewValue'][] = str_replace("'", "''", $postedValues['project_owner_name']);
        }
        if (isset($postedValues['project_country'])) {
            $newProjectCountry = $viewObj->getCountryName($postedValues['project_country']);
            if (isset($newProjectCountry) && trim($oldSubmissionRow['ProjectCountry']) != trim($newProjectCountry[0]['InsuredCountry'])) {
                $historyArray['FieldName'][] = 'Project Country';
                $historyArray['OldValue'][] = $oldSubmissionRow['ProjectCountry'];
                $historyArray['NewValue'][] = $newProjectCountry[0]['InsuredCountry'];
            }
        }
        if (isset($postedValues['project_state'])) {
            $newProjectState = $viewObj->getProjectStateName($postedValues['project_state']);
            if (isset($newProjectState) && trim($oldSubmissionRow['ProjectState']) != trim($newProjectState[0]['ProjectCode'])) {
                $historyArray['FieldName'][] = 'Project State';
                $historyArray['OldValue'][] = $oldSubmissionRow['ProjectState'];
                $historyArray['NewValue'][] = $newProjectState[0]['ProjectCode'];
            }
        }
        if (isset($postedValues['project_city'])) {
            $newProjectCity = $viewObj->getProjectCityName($postedValues['project_city']);
            if (trim($oldSubmissionRow['ProjectCity']) != trim($newProjectCity['0']['City'])) {
                $historyArray['FieldName'][] = 'Project City';
                $historyArray['OldValue'][] = $oldSubmissionRow['ProjectCity'];
                $historyArray['NewValue'][] = $newProjectCity['0']['City'];
            }
        }

        if (trim($oldSubmissionRow['ProjectAddress']) != trim($postedValues['project_street_address'])) {
            $historyArray['FieldName'][] = 'Project Street Address';
            $historyArray['OldValue'][] = str_replace("'", "''", $oldSubmissionRow['ProjectAddress']);
            $historyArray['NewValue'][] = str_replace("'", "''", $postedValues['project_street_address']);
        }

        if (isset($postedValues['bid_situation']) && $oldSubmissionRow['BidSituation'] != 0 && trim($oldSubmissionRow['BidSituation']) != trim($postedValues['bid_situation'])) {
            $oldBidData = $viewObj->getLookUpdata($oldSubmissionRow['BidSituation']);
            $newBidData = $viewObj->getLookUpdata($postedValues['bid_situation']);
            $historyArray['FieldName'][] = 'Bid Situation';
            $historyArray['OldValue'][] = $oldBidData[0]['Alias'];
            $historyArray['NewValue'][] = $newBidData[0]['Alias'];
        }

        if (isset($postedValues['yesTrue'])) {
            if (trim($oldSubmissionRow['TotalInsuredValue']) != trim($postedValues['total_insured_value_select'])) {
                $historyArray['FieldName'][] = 'Total Insured Value in Local Currency';
                $historyArray['OldValue'][] = $oldSubmissionRow['TotalInsuredValue'];
                $historyArray['NewValue'][] = $postedValues['total_insured_value_select'];
            }
        } else {
            if (trim($oldSubmissionRow['TotalInsuredValue']) != trim($postedValues['edittotalinsuredvalue'])) {
                $historyArray['FieldName'][] = 'Total Insured Value in Local Currency';
                $historyArray['OldValue'][] = $oldSubmissionRow['TotalInsuredValue'];
                $historyArray['NewValue'][] = $postedValues['edittotalinsuredvalue'];
            }
        }

        if (trim($oldSubmissionRow['TotalInsuredValueInUSD']) != trim($postedValues['edittotalinsuredvalueinusd'])) {
            $historyArray['FieldName'][] = 'Total Insured Value in USD';
            $historyArray['OldValue'][] = $oldSubmissionRow['TotalInsuredValueInUSD'];
            $historyArray['NewValue'][] = $postedValues['edittotalinsuredvalueinusd'];
        }

        $brokerDetailArr = explode('-', $oldSubmissionRow['BrokerCode']);
        $brokerCode = $brokerDetailArr[0];
        if (trim($brokerCode) != trim($postedValues['brokerCode'])) {
            $oldBrokerName = $viewObj->getBrokerName($brokerCode);
            $newBrokerName = $viewObj->getBrokerName($postedValues['brokerCode']);
            $historyArray['FieldName'][] = 'Broker Name';
            $historyArray['OldValue'][] = $oldBrokerName[0]['BrokerName'];
            $historyArray['NewValue'][] = $newBrokerName[0]['BrokerName'];
        }
        if (trim($brokerCode) != trim($postedValues['brokerCode'])) {
            $oldBrokerName = $viewObj->getBrokerName($brokerCode);
            $newBrokerName = $viewObj->getBrokerName($postedValues['brokerCode']);
            if ($oldBrokerName[0]['BrokerTypeId'] == 1) {
                $oldBrokerType = 'Retailer';
            } else if ($oldBrokerName[0]['BrokerTypeId'] == 2) {
                $oldBrokerType = 'wholesaler';
            }
            if ($newBrokerName[0]['BrokerTypeId'] == 1) {
                $newBrokerType = 'Retailer';
            } else if ($newBrokerName[0]['BrokerTypeId'] == 2) {
                $newBrokerType = 'wholesaler';
            }
            $historyArray['FieldName'][] = 'Broker Type';
            $historyArray['OldValue'][] = $oldBrokerType;
            $historyArray['NewValue'][] = $newBrokerType;
        }
        $brokerCountry = $brokerDetailArr[1];
        $brokerCountryId = $subObj->getCountryId($brokerCountry);
        if (trim($brokerCountryId) != trim($postedValues['brokerCountryCode'])) {
            $historyArray['FieldName'][] = 'Broker Country';
            $oldProjectCountry = $viewObj->getCountryName($brokerCountryId);
            $newProjectCountry = $viewObj->getCountryName($postedValues['brokerCountryCode']);
            $historyArray['OldValue'][] = $oldProjectCountry[0]['InsuredCountry'];
            $historyArray['NewValue'][] = $newProjectCountry[0]['InsuredCountry'];
        }
        $brokerState = $brokerDetailArr[2];
        $brokerStateId = $subObj->GetBrokerStateId($brokerState, $brokerCountryId);
        if (isset($postedValues['brokerStateCode']) && trim($brokerStateId) != trim($postedValues['brokerStateCode'])) {
            $oldProjectState = $viewObj->getStateName($brokerStateId);
            $newProjectState = $viewObj->getStateName($postedValues['brokerStateCode']);
            $historyArray['FieldName'][] = 'Broker State';
            $historyArray['OldValue'][] = $oldProjectState[0]['StateName'];
            $historyArray['NewValue'][] = $newProjectState[0]['StateName'];
        }
        $brokerCity = $brokerDetailArr[3];
        $brokerCityId = $subObj->getBrokerCityId($brokerCity, $brokerStateId);
        if (isset($postedValues['brokerCityCode']) && trim($brokerCityId) != trim($postedValues['brokerCityCode'])) {
            $oldProjectCity = $viewObj->getCityName($brokerCityId);
            $newProjectCity = $viewObj->getCityName($postedValues['brokerCityCode']);
            $historyArray['FieldName'][] = 'Broker City';
            $historyArray['OldValue'][] = $oldProjectCity['0']['City'];
            $historyArray['NewValue'][] = $newProjectCity['0']['City'];
        }
        if (trim($oldSubmissionRow['RetailBrokerName']) != trim($postedValues['retailBrokerName'])) {
            $historyArray['FieldName'][] = 'Retail Broker Name';
            $historyArray['OldValue'][] = $oldSubmissionRow['RetailBrokerName'];
            $historyArray['NewValue'][] = $postedValues['retailBrokerName'];
        }
        if (trim($oldSubmissionRow['RetailBrokerCountry']) != trim($postedValues['retailbrokerCountryCode'])) {
            $oldRetailBrokerCuontry = $viewObj->getCountryName($oldSubmissionRow['RetailBrokerCountry']);
            $newRetailBrokerCuontry = $viewObj->getCountryName($postedValues['retailbrokerCountryCode']);
            $historyArray['FieldName'][] = 'Retail Broker Country';
            $historyArray['OldValue'][] = $oldRetailBrokerCuontry['0']['InsuredCountry'];
            $historyArray['NewValue'][] = $newRetailBrokerCuontry['0']['InsuredCountry'];
        }

        if (isset($postedValues['retailbrokerStateCode']) && trim($oldSubmissionRow['RetailBrokerState']) != trim($postedValues['retailbrokerStateCode'])) {
            $oldRetailBrokerState = $viewObj->getStateName($oldSubmissionRow['RetailBrokerState']);
            $newRetailBrokerState = $viewObj->getStateName($postedValues['brokerStateCode']);
            $historyArray['FieldName'][] = 'Retail Broker State';
            $historyArray['OldValue'][] = $oldRetailBrokerState[0]['StateName'];
            $historyArray['NewValue'][] = $newRetailBrokerState[0]['StateName'];
        }
        if (isset($postedValues['retailbrokerCityCode']) && trim($oldSubmissionRow['RetailBrokerCity']) != trim($postedValues['retailbrokerCityCode'])) {
            $oldRetailBrokerCity = $viewObj->getCityName($oldSubmissionRow['RetailBrokerCity']);
            $newRetailBrokerCity = $viewObj->getCityName($postedValues['retailbrokerCityCode']);
            $historyArray['FieldName'][] = 'Retail Broker City';
            $historyArray['OldValue'][] = $oldRetailBrokerCity['0']['City'];
            $historyArray['NewValue'][] = $newRetailBrokerCity['0']['City'];
        }
        if (isset($postedValues['broker_contact_person']) && trim($oldSubmissionRow['BrokerContactPersonId']) != trim($postedValues['broker_contact_person'])) {
            if (empty($oldSubmissionRow['BrokerCompany'])) {
                $oldContactPerson = null;
            } else {
                $oldContactPersonData = $editObj->FetchContactPerson($oldSubmissionRow['BrokerContactPersonId']);
                $oldContactPerson = $oldContactPersonData[0]['Name'];
            }
            if (empty($postedValues['broker_contact_person'])) {
                $newContactPerson = null;
            } else {
                $newContactPersonData = $editObj->FetchContactPerson($postedValues['broker_contact_person']);
                $newContactPerson = $newContactPersonData[0]['Name'];
            }
            $historyArray['FieldName'][] = 'Broker Contact Person';
            $historyArray['OldValue'][] = $oldContactPerson;
            $historyArray['NewValue'][] = $newContactPerson;
        }
        if (isset($postedValues['edit_broker_contact_person_email']) && trim($oldSubmissionRow['BrokerCompanyEmail']) != trim($postedValues['edit_broker_contact_person_email'])) {
            $historyArray['FieldName'][] = 'Broker Contact Person Email';
            $historyArray['OldValue'][] = $oldSubmissionRow['BrokerCompanyEmail'];
            $historyArray['NewValue'][] = $postedValues['edit_broker_contact_person_email'];
        }
        if (isset($postedValues['edit_borker_contact_peson_number']) && trim($oldSubmissionRow['BrokerContactPhone']) != trim($postedValues['edit_borker_contact_peson_number'])) {
            $historyArray['FieldName'][] = 'Broker Contact Person Number';
            $historyArray['OldValue'][] = $oldSubmissionRow['BrokerContactPhone'];
            $historyArray['NewValue'][] = $postedValues['edit_borker_contact_peson_number'];
        }
        if (trim($oldSubmissionRow['BrokerContactMobile']) != trim($postedValues['edit_borker_contact_peson_mobile'])) {
            $historyArray['FieldName'][] = 'Broker Contact Person Mobile Number';
            $historyArray['OldValue'][] = $oldSubmissionRow['BrokerContactMobile'];
            $historyArray['NewValue'][] = $postedValues['edit_borker_contact_peson_mobile'];
        }
        if (trim($oldSubmissionRow['BrokerCode']) != trim($postedValues['brokerCodeGen1'])) {
            $historyArray['FieldName'][] = 'Broker Code';
            $historyArray['OldValue'][] = $oldSubmissionRow['BrokerCode'];
            $historyArray['NewValue'][] = $postedValues['brokerCodeGen1'];
        }
        if (isset($postedValues['reason_code']) && trim($oldSubmissionRow['ReasonCodeId']) != trim($postedValues['reason_code'])) {
            $oldReasonCode = $viewObj->getReasonCodeName($oldSubmissionRow['ReasonCodeId']);
            $newReasonCode = $viewObj->getReasonCodeName($postedValues['reason_code']);
            $historyArray['FieldName'][] = 'Reason Code';
            $historyArray['OldValue'][] = str_replace("'", "''", $oldReasonCode[0]['ReasonCodeName'] . "-" . $oldReasonCode[0]['Meaning']);
            $historyArray['NewValue'][] = str_replace("'", "''", $newReasonCode[0]['ReasonCodeName'] . "-" . $newReasonCode[0]['Meaning']);
        }
        if (date("Y-m-d", strtotime($oldSubmissionRow['ProcessDate'])) != date("Y-m-d", strtotime($postedValues['processdate']))) {
            $historyArray['FieldName'][] = 'Process Date';
            if (empty($oldSubmissionRow['ProcessDate'])) {
                $historyArray['OldValue'][] = $oldSubmissionRow['ProcessDate'];
            } else {
                $historyArray['OldValue'][] = date("Y-m-d", strtotime($oldSubmissionRow['ProcessDate']));
            }
            if (empty($postedValues['processdate'])) {
                $historyArray['NewValue'][] = $postedValues['processdate'];
            } else {
                $historyArray['NewValue'][] = date("Y-m-d", strtotime($postedValues['processdate']));
            }
        }
        if (isset($postedValues['yesGross'])) {
            if (trim($oldSubmissionRow['GrossPremium']) != trim($postedValues['gross_premium_select'])) {
                $historyArray['FieldName'][] = 'Gross Premium';
                $historyArray['OldValue'][] = $oldSubmissionRow['GrossPremium'];
                $historyArray['NewValue'][] = $postedValues['gross_premium_select'];
            }
        } else {
            if (trim($oldSubmissionRow['GrossPremium']) != trim($postedValues['gross_premium_text'])) {
                $historyArray['FieldName'][] = 'Gross Premium';
                $historyArray['OldValue'][] = $oldSubmissionRow['GrossPremium'];
                $historyArray['NewValue'][] = $postedValues['gross_premium_text'];
            }
        }
        if (isset($postedValues['yesLimit'])) {
            if (trim($oldSubmissionRow['Limit']) != trim($postedValues['limit_select'])) {
                $historyArray['FieldName'][] = 'Limit';
                $historyArray['OldValue'][] = $oldSubmissionRow['Limit'];
                $historyArray['NewValue'][] = $postedValues['limit_select'];
            }
        } else {
            if (trim($oldSubmissionRow['Limit']) != trim($postedValues['limit_text'])) {
                $historyArray['FieldName'][] = 'Limit';
                $historyArray['OldValue'][] = $oldSubmissionRow['Limit'];
                $historyArray['NewValue'][] = $postedValues['limit_text'];
            }
        }
        if (isset($postedValues['yesAttachment'])) {
            if (trim($oldSubmissionRow['AttachmentPoint']) != trim($postedValues['attachment_point_select'])) {
                $historyArray['FieldName'][] = 'Attachment Point';
                $historyArray['OldValue'][] = $oldSubmissionRow['AttachmentPoint'];
                $historyArray['NewValue'][] = $postedValues['attachment_point_select'];
            }
        } else {
            if (trim($oldSubmissionRow['AttachmentPoint']) != trim($postedValues['attachment_point_text'])) {
                $historyArray['FieldName'][] = 'Attachment Point';
                $historyArray['OldValue'][] = $oldSubmissionRow['AttachmentPoint'];
                $historyArray['NewValue'][] = $postedValues['attachment_point_text'];
            }
        }
        if (date("M-d-Y h:i:s", strtotime($oldSubmissionRow['ExchangeDate'])) != date("M-d-Y h:i:s", strtotime($postedValues['editexchangeRateDate']))) {
            $historyArray['FieldName'][] = 'Exchange Rate as on';
            if (empty($oldSubmissionRow['ExchangeDate'])) {
                $historyArray['OldValue'][] = $oldSubmissionRow['ExchangeDate'];
            } else {
                $historyArray['OldValue'][] = date('M-d-Y h:i:s', strtotime($oldSubmissionRow['ExchangeDate']));
            }
            if (empty($postedValues['editexchangeRateDate'])) {
                $historyArray['NewValue'][] = $postedValues['editexchangeRateDate'];
            } else {
                $historyArray['NewValue'][] = date('M-d-Y h:i:s', strtotime($postedValues['editexchangeRateDate']));
            }
        }
        if (trim($oldSubmissionRow['CurrencyTypeId']) != trim($postedValues['editcurrency'])) {
            $oldCurrencyData = $viewObj->getLookUpdata($oldSubmissionRow['CurrencyTypeId']);
            $oldCurrency = $oldCurrencyData[0]['LookupName'];
            $newCurrencyData = $viewObj->getLookUpdata($postedValues['editcurrency']);
            $newCurrency = $newCurrencyData[0]['LookupName'];
            $historyArray['FieldName'][] = 'Currency';
            $historyArray['OldValue'][] = $oldCurrency;
            $historyArray['NewValue'][] = $newCurrency;
        }
        if (trim($oldSubmissionRow['ExchangeRate']) != trim($postedValues['editexchangeRate'])) {
            $historyArray['FieldName'][] = 'Exchange Rate';
            $historyArray['OldValue'][] = $oldSubmissionRow['ExchangeRate'];
            $historyArray['NewValue'][] = $postedValues['editexchangeRate'];
        }
        if (trim($oldSubmissionRow['GrossPremiumInUSD']) != trim($postedValues['editlocalCurrency'])) {
            $historyArray['FieldName'][] = 'Premiun(in USD)';
            $historyArray['OldValue'][] = $oldSubmissionRow['GrossPremiumInUSD'];
            $historyArray['NewValue'][] = $postedValues['editlocalCurrency'];
        }
        if (trim($oldSubmissionRow['LimitInUSD']) != trim($postedValues['editlimitlocalcurrency'])) {
            $historyArray['FieldName'][] = 'Limit(in USD)';
            $historyArray['OldValue'][] = $oldSubmissionRow['LimitInUSD'];
            $historyArray['NewValue'][] = $postedValues['editlimitlocalcurrency'];
        }
        if (trim($oldSubmissionRow['AttachmentPointInUSD']) != trim($postedValues['editattachmentlocalcurrency'])) {
            $historyArray['FieldName'][] = 'AttachmentPoint(in USD)';
            $historyArray['OldValue'][] = $oldSubmissionRow['AttachmentPointInUSD'];
            $historyArray['NewValue'][] = $postedValues['editattachmentlocalcurrency'];
        }
        if (trim($oldSubmissionRow['LayerofLimitInLocalCurrency']) != trim($postedValues['editLayerLimitLocalCurrency'])) {
            $historyArray['FieldName'][] = 'Layer of Limit in Local Currency';
            $historyArray['OldValue'][] = $oldSubmissionRow['LayerofLimitInLocalCurrency'];
            $historyArray['NewValue'][] = $postedValues['editLayerLimitLocalCurrency'];
        }
        if (trim($oldSubmissionRow['LayerofLimitInUSD']) != trim($postedValues['editLayerLimitLocalUSD'])) {
            $historyArray['FieldName'][] = 'Layer of Limit(in USD)';
            $historyArray['OldValue'][] = $oldSubmissionRow['LayerofLimitInUSD'];
            $historyArray['NewValue'][] = $postedValues['editLayerLimitLocalUSD'];
        }
        if (trim($oldSubmissionRow['PercentageofLayer']) != trim($postedValues['editPrecentageLayer'])) {
            $historyArray['FieldName'][] = '% of Layer';
            $historyArray['OldValue'][] = $oldSubmissionRow['PercentageofLayer'];
            $historyArray['NewValue'][] = $postedValues['editPrecentageLayer'];
        }
        if (trim($oldSubmissionRow['SelfInsuredRetentionInLocalCur']) != trim($postedValues['editselfRetrntionLocalCurrency'])) {
            $historyArray['FieldName'][] = 'Self Insured Retention in Local Currency';
            $historyArray['OldValue'][] = $oldSubmissionRow['SelfInsuredRetentionInLocalCur'];
            $historyArray['NewValue'][] = $postedValues['editselfRetrntionLocalCurrency'];
        }
        if (trim($oldSubmissionRow['SelfInsuredRetentionInUSD']) != trim($postedValues['editselfRetrntionUSD'])) {
            $historyArray['FieldName'][] = 'Self Insured Retention(in USD)';
            $historyArray['OldValue'][] = $oldSubmissionRow['SelfInsuredRetentionInUSD'];
            $historyArray['NewValue'][] = $postedValues['editselfRetrntionUSD'];
        }
        if (trim($oldSubmissionRow['PolicyCommPercentage']) != trim($postedValues['editpolicyCommision'])) {
            $historyArray['FieldName'][] = 'Policy Comm. %';
            $historyArray['OldValue'][] = $oldSubmissionRow['PolicyCommPercentage'];
            $historyArray['NewValue'][] = $postedValues['editpolicyCommision'];
        }
        if (trim($oldSubmissionRow['PolicyCommInLocalCurrency']) != trim($postedValues['editpolicyCommisionLocalCurrrency'])) {
            $historyArray['FieldName'][] = 'Policy Comm. in Local Currency';
            $historyArray['OldValue'][] = $oldSubmissionRow['PolicyCommInLocalCurrency'];
            $historyArray['NewValue'][] = $postedValues['editpolicyCommisionLocalCurrrency'];
        }
        if (trim($oldSubmissionRow['PolicyCommInUSD']) != trim($postedValues['editpolicyCommisionUSD'])) {
            $historyArray['FieldName'][] = 'Policy Comm.(in USD)';
            $historyArray['OldValue'][] = $oldSubmissionRow['PolicyCommInUSD'];
            $historyArray['NewValue'][] = $postedValues['editpolicyCommisionUSD'];
        }
        if (trim($oldSubmissionRow['PermiumNetofCommInLocalCurrenc']) != trim($postedValues['editPermiumLocalCurency'])) {
            $historyArray['FieldName'][] = 'Premium (Net of All Commission) in Local Currency';
            $historyArray['OldValue'][] = $oldSubmissionRow['PermiumNetofCommInLocalCurrenc'];
            $historyArray['NewValue'][] = $postedValues['editPermiumLocalCurency'];
        }
        if (trim($oldSubmissionRow['PermiumNetofCommInUSD']) != trim($postedValues['editPermiumUSD'])) {
            $historyArray['FieldName'][] = 'Premium (Net of All Commission)(in USD)';
            $historyArray['OldValue'][] = $oldSubmissionRow['PolicyCommInUSD'];
            $historyArray['NewValue'][] = $postedValues['editPermiumUSD'];
        }
        if (date("M-d-Y h:i:s", strtotime($oldSubmissionRow['BerkSIDateFromBroker'])) != date("M-d-Y h:i:s", strtotime($postedValues['received_date_by_berkshire']))) {
            $historyArray['FieldName'][] = 'Date of Receiving-By Berk SI From Broker';
            if (empty($oldSubmissionRow['BerkSIDateFromBroker'])) {
                $historyArray['OldValue'][] = $oldSubmissionRow['BerkSIDateFromBroker'];
            } else {
                $historyArray['OldValue'][] = date('M-d-Y h:i:s', strtotime($oldSubmissionRow['BerkSIDateFromBroker']));
            }
            if (empty($postedValues['received_date_by_berkshire'])) {
                $historyArray['NewValue'][] = $postedValues['received_date_by_berkshire'];
            } else {
                $historyArray['NewValue'][] = date('M-d-Y h:i:s', strtotime($postedValues['received_date_by_berkshire']));
            }
        }

        if (date("Y-m-d", strtotime($oldSubmissionRow['BerkSiDateFromIndia'])) != date("Y-m-d", strtotime($postedValues['received_date_by_india']))) {
            $historyArray['FieldName'][] = 'Date of Receiving-By India From Berk SI';
            if (empty($oldSubmissionRow['BerkSiDateFromIndia'])) {
                $historyArray['OldValue'][] = $oldSubmissionRow['BerkSiDateFromIndia'];
            } else {
                $historyArray['OldValue'][] = date("M-d-Y", strtotime($oldSubmissionRow['BerkSiDateFromIndia']));
            }
            if (empty($postedValues['received_date_by_india'])) {
                $historyArray['NewValue'][] = $postedValues['received_date_by_india'];
            } else {
                $historyArray['NewValue'][] = date("M-d-Y", strtotime($postedValues['received_date_by_india']));
            }
        }
        $branchCode = $editObj->FetchSubmissionBranch($oldSubmissionRow['BranchId']);
        $newbranchCode = $editObj->FetchSubmissionBranch($postedValues['branch_office']);
        if (trim($oldSubmissionRow['BranchId']) != trim($postedValues['branch_office'])) {
            $historyArray['FieldName'][] = 'Branch Office';
            $historyArray['OldValue'][] = $branchCode[0]['Branch'];
            $historyArray['NewValue'][] = $newbranchCode[0]['Branch'];
        }
        if ($oldSubmissionRow['OccupancyCodeId'] == 0) {
            $oldSubmissionRow['OccupancyCodeId'] = null;
        }
        if (trim($oldSubmissionRow['OccupancyCodeId']) != trim($postedValues['EditOccupancyCode'])) {
            $oldOccupancyCode = $editObj->FetchOccupancyCode($oldSubmissionRow['OccupancyCodeId']);
            $newOccupancyCode = $editObj->FetchOccupancyCode($postedValues['EditOccupancyCode']);
            $historyArray['FieldName'][] = 'Occupancy Code';
            $historyArray['OldValue'][] = $oldOccupancyCode[0]['Name'];
            $historyArray['NewValue'][] = $newOccupancyCode[0]['Name'];
        }

        if ($oldSubmissionRow['NumberOfLocationsId'] == 0) {
            $oldSubmissionRow['NumberOfLocationsId'] = null;
        }
        if (trim($oldSubmissionRow['NumberOfLocationsId']) != trim($postedValues['EditNumberOfLocations'])) {
            $oldLocationData = $viewObj->getLookUpdata($oldSubmissionRow['NumberOfLocationsId']);
            $oldLocation = $oldLocationData[0]['LookupName'];
            $newLocationData = $viewObj->getLookUpdata($postedValues['EditNumberOfLocations']);
            $newLocations = $newLocationData[0]['LookupName'];
            $historyArray['FieldName'][] = 'Number Of Locations';
            $historyArray['OldValue'][] = $oldLocation;
            $historyArray['NewValue'][] = $newLocations;
        }
        if (trim($oldSubmissionRow['RiskProfile']) != trim($postedValues['editriskProfile'])) {
            $historyArray['FieldName'][] = 'Risk Profile';
            $historyArray['OldValue'][] = $oldSubmissionRow['RiskProfile'];
            $historyArray['NewValue'][] = $postedValues['editriskProfile'];
        }
        if (date("Y-m-d", strtotime($oldSubmissionRow['BindDate'])) != date("Y-m-d", strtotime($postedValues['editbinddate']))) {
            $historyArray['FieldName'][] = 'Bind Date';
            if (empty($oldSubmissionRow['BindDate'])) {
                $historyArray['OldValue'][] = "";
            } else {
                $historyArray['OldValue'][] = date("M-d-Y", strtotime($oldSubmissionRow['BindDate']));
            }
            if (empty($postedValues['editbinddate'])) {
                $historyArray['NewValue'][] = "";
            } else {
                $historyArray['NewValue'][] = date("M-d-Y", strtotime($postedValues['editbinddate']));
            }
        }
        
        if (trim($oldSubmissionRow['RenewableLookupId']) != trim($postedValues['editrenewable'])) {
            $oldrenewableData = $viewObj->getLookUpdata($oldSubmissionRow['RenewableLookupId']);
            $oldRenewable = $oldrenewableData[0]['LookupName'];
            $newrenewableData = $viewObj->getLookUpdata($postedValues['editrenewable']);
            $newRenewable = $newrenewableData[0]['LookupName'];
            $historyArray['FieldName'][] = 'Renewable(Y/N)';
            $historyArray['OldValue'][] = $oldRenewable;
            $historyArray['NewValue'][] = $newRenewable;
        }
        
        if (date("Y-m-d", strtotime($oldSubmissionRow['DateofRenewal'])) != date("Y-m-d", strtotime($postedValues['editdateofrenewal']))) {
            $historyArray['FieldName'][] = 'Date of Renewal';
            if (empty($oldSubmissionRow['DateofRenewal'])) {
                $historyArray['OldValue'][] = $oldSubmissionRow['DateofRenewal'];
            } else {
                $historyArray['OldValue'][] = date("M-d-Y", strtotime($oldSubmissionRow['DateofRenewal']));
            }
            if (empty($postedValues['editdateofrenewal'])) {
                $historyArray['NewValue'][] = $postedValues['editdateofrenewal'];
            } else {
                $historyArray['NewValue'][] = date("M-d-Y", strtotime($postedValues['editdateofrenewal']));
            }
        }
        if (isset($postedValues['editpolicyName']) && trim($oldSubmissionRow['PolicyTypeLookupId']) != trim($postedValues['editpolicyName'])) {
            $oldPolicyData = $viewObj->getLookUpdata($oldSubmissionRow['PolicyTypeLookupId']);
            $oldPolicy = $oldPolicyData[0]['LookupName'];
            $newpolicyData = $viewObj->getLookUpdata($postedValues['editpolicyName']);
            $newPolicy = $newpolicyData[0]['LookupName'];
            $historyArray['FieldName'][] = 'Policy Type';
            $historyArray['OldValue'][] = $oldPolicy;
            $historyArray['NewValue'][] = $newPolicy;
        }
        if (trim($oldSubmissionRow['DirectAssumedLookupId']) != trim($postedValues['editdirectAssumed'])) {
            $oldDirectData = $viewObj->getLookUpdata($oldSubmissionRow['DirectAssumedLookupId']);
            $oldDirect = $oldDirectData[0]['LookupName'];
            $newDirectData = $viewObj->getLookUpdata($postedValues['editdirectAssumed']);
            $newDirect = $newDirectData[0]['LookupName'];
            $historyArray['FieldName'][] = 'Direct/Assumed';
            $historyArray['OldValue'][] = $oldDirect;
            $historyArray['NewValue'][] = $newDirect;
        }
        if (trim($oldSubmissionRow['AdimittedNonAdmittedLookupId']) != trim($postedValues['editadmitted'])) {
            $oldAdmittedData = $viewObj->getLookUpdata($oldSubmissionRow['AdimittedNonAdmittedLookupId']);
            $oldAdmitted = $oldAdmittedData[0]['LookupName'];
            $newAdmittedData = $viewObj->getLookUpdata($postedValues['editadmitted']);
            $newAdmitted = $newAdmittedData[0]['LookupName'];
            $historyArray['FieldName'][] = 'Admitted/ Non-Admitted';
            $historyArray['OldValue'][] = $oldAdmitted;
            $historyArray['NewValue'][] = $newAdmitted;
        }
        if (trim($oldSubmissionRow['CompanyPaperLookupId']) != trim($postedValues['editcompanyPaper'])) {
            $oldCompanyPaperData = $viewObj->getLookUpdata($oldSubmissionRow['CompanyPaperLookupId']);
            $oldCopmanyPaper = $oldCompanyPaperData[0]['LookupName'];
            $newCompanyPaperData = $viewObj->getLookUpdata($postedValues['editcompanyPaper']);
            $newCompanyPaper = $newCompanyPaperData[0]['LookupName'];
            $historyArray['FieldName'][] = 'Company Paper';
            $historyArray['OldValue'][] = $oldCopmanyPaper;
            $historyArray['NewValue'][] = $newCompanyPaper;
        }
        if (trim($oldSubmissionRow['CompanyPaperNumberLookupId']) != trim($postedValues['editcompanyPaperNumber'])) {
            $oldCompanyPaperNumberData = $viewObj->getLookUpdata($oldSubmissionRow['CompanyPaperNumberLookupId']);
            $oldCopmanyPaperNumber = $oldCompanyPaperNumberData[0]['LookupName'];
            $newCompanyPaperNumberData = $viewObj->getLookUpdata($postedValues['editcompanyPaperNumber']);
            $newCompanyPaperNumber = $newCompanyPaperNumberData[0]['LookupName'];
            $historyArray['FieldName'][] = 'Company Paper Number';
            $historyArray['OldValue'][] = $oldCopmanyPaperNumber;
            $historyArray['NewValue'][] = $newCompanyPaperNumber;
        }
        if (trim($oldSubmissionRow['PolicyNumber']) != trim($postedValues['editpolicyNumber'])) {
            $historyArray['FieldName'][] = 'Policy Number';
            $historyArray['OldValue'][] = $oldSubmissionRow['PolicyNumber'];
            $historyArray['NewValue'][] = $postedValues['editpolicyNumber'];
        }
        if (trim($oldSubmissionRow['SuffixLookupId']) != trim($postedValues['editsuffix'])) {
            $oldSuffixData = $viewObj->getLookUpdata($oldSubmissionRow['SuffixLookupId']);
            $oldSuffix = $oldSuffixData[0]['LookupName'];
            $newSuffixData = $viewObj->getLookUpdata($postedValues['editsuffix']);
            $newSuffix = $newSuffixData[0]['LookupName'];
            $historyArray['FieldName'][] = 'Suffix';
            $historyArray['OldValue'][] = $oldSuffix;
            $historyArray['NewValue'][] = $newSuffix;
        }
        if (trim($oldSubmissionRow['TransactionNumber']) != trim($postedValues['edittransactionNumber'])) {
            $historyArray['FieldName'][] = 'Transaction Number';
            $historyArray['OldValue'][] = $oldSubmissionRow['TransactionNumber'];
            $historyArray['NewValue'][] = $postedValues['edittransactionNumber'];
        }
        if (trim($oldSubmissionRow['NAICCode']) != trim($postedValues['editnaicCode'])) {
            $historyArray['FieldName'][] = 'NAIC Code';
            $historyArray['OldValue'][] = $oldSubmissionRow['NAICCode'];
            $historyArray['NewValue'][] = $postedValues['editnaicCode'];
        }
        if (trim($oldSubmissionRow['NAICTitle']) != trim($postedValues['editnaicTitle'])) {
            $historyArray['FieldName'][] = 'NAIC Title';
            $historyArray['OldValue'][] = $oldSubmissionRow['NAICTitle'];
            $historyArray['NewValue'][] = $postedValues['editnaicTitle'];
        }
        if (trim($oldSubmissionRow['SICCode']) != trim($postedValues['editsicCode'])) {
            $historyArray['FieldName'][] = 'SIC Code';
            $historyArray['OldValue'][] = $oldSubmissionRow['SICCode'];
            $historyArray['NewValue'][] = $postedValues['editsicCode'];
        }
        if (trim($oldSubmissionRow['SICTitle']) != trim($postedValues['editsicTitle'])) {
            $historyArray['FieldName'][] = 'SIC Title';
            $historyArray['OldValue'][] = $oldSubmissionRow['SICTitle'];
            $historyArray['NewValue'][] = $postedValues['editsicTitle'];
        }
        if (trim($oldSubmissionRow['OFRCAdverseReportLookupId']) != trim($postedValues['editofrcReport'])) {
            $oldOFRCData = $viewObj->getLookUpdata($oldSubmissionRow['OFRCAdverseReportLookupId']);
            $oldOFRC = $oldOFRCData[0]['LookupName'];
            $newOFRCData = $viewObj->getLookUpdata($postedValues['editofrcReport']);
            $newOFRC = $newOFRCData[0]['LookupName'];
            $historyArray['FieldName'][] = 'OFRC Adverse Report';
            $historyArray['OldValue'][] = $oldOFRC;
            $historyArray['NewValue'][] = $newOFRC;
        }
        if (trim($oldSubmissionRow['CoverageId']) != trim($postedValues['editcoverage'])) {
            $oldCoverageData = $viewObj->GetCoverageDetails($oldSubmissionRow['CoverageId']);
            $newCoverageData = $viewObj->GetCoverageDetails($postedValues['editcoverage']);
            $historyArray['FieldName'][] = 'Coverage';
            $historyArray['OldValue'][] = $oldCoverageData;
            $historyArray['NewValue'][] = $newCoverageData;
        }

        for ($i = 0, $j = 0, $k = 0; $i < count($historyArray['FieldName']), $j < count($historyArray['OldValue']), $k < count($historyArray['NewValue']); $i++, $j++, $k++) {
            $historyquery = "Insert INTO SubmissionHistory 
              (SubmissionId, Field, OldValue, NewValue, Remarks, ModifiedBy, ModifiedOn) 
               VALUES 
               ('" . $submissionId . "','" . $historyArray['FieldName'][$i] . "','" . $historyArray['OldValue'][$j] . "','" . $historyArray['NewValue'][$k] . "', '" . $remarks . "', '" . $userId . "', GETDATE())";
            $insert = $con->prepare($historyquery);
            //$insert->execute();
            if($insert->execute()){
                return true;
            }else{
                echo $historyquery; exit;
            }
        }
    }

}
