<?php

class EditSubmissionDetails {

    public function __construct() {
        $this->connection = Propel::getConnection();
    }

    /**
     * This method Get the Submission Details to show on edit page
     */
    public function GetSubmissionDetails($submissionId) {
        $connection = $this->connection;
        $oldSubmissionQuery = "SELECT S.*, BD.*, SD.*,I.* ,(CP.FirstName +' '+ CP.LastName) AS BrokerCompany, CP.Email AS BrokerCompanyEmail, CP.PhoneNumber AS BrokerContactPhone, CP.MobileNumber AS BrokerContactMobile, CP.Fax AS BrokerContactFax, (CP1.FirstName +' '+ CP1.LastName) AS InsuredCompany, CP1.Email AS InsuredCompanyEmail, CP1.PhoneNumber AS InsuredContactPhone, CP1.MobileNumber AS InsuredContactMobile, CP1.Fax AS InsuredContactFax, SB.*, RB.* FROM  Submission AS S LEFT JOIN  BusinessDependentDetail AS BD ON S.BusinessDependentDetailId = BD.Id  LEFT JOIN StatusDependentDetails AS SD ON S.StatusDependentDetailsId = SD.Id LEFT JOIN ContactPersonDetails AS CP ON S.BrokerContactPersonId = CP.Id LEFT JOIN ContactPersonDetails AS CP1 ON S.InsuredContactPersonId = CP1.Id LEFT JOIN Insured AS I on S.InsuredId = I.Id LEFT JOIN SubmissionBound AS SB on SB.SubmissionId = S.Id LEFT JOIN RetailBrokerDetails AS RB on RB.SubmissionId = S.Id WHERE S.Id = '" . $submissionId . "'";
        $oldSubmissionStatement = $connection->prepare($oldSubmissionQuery);
        $oldSubmissionStatement->execute();
        $oldSubmission = $oldSubmissionStatement->fetchAll(PDO::FETCH_ASSOC);
        return $oldSubmission;
    }

    /**
     * This method save the information in Submission History for QC View Page
     */
    public function insertInSubmissionHistory($historyArray, $userId, $submissionId) {
        $remarks = '';
        $con = Propel::getConnection();
        $historyquery = "INSERT INTO SubmissionHistory 
              (SubmissionId, Field, OldValue, NewValue, Remarks, ModifiedBy, ModifiedOn) 
               VALUES 
               ('" . $submissionId . "','" . $historyArray['field'] . "','" . $historyArray['oldValue'] . "','" . $historyArray['newValue'] . "','" . $remarks . "', '" . $userId . "', GETDATE())";
        $insert = $con->prepare($historyquery);
        $insert->execute();
    }

    /**
     * This method update the information of submission
     */
    public function UpdateSubmissionDetails($postedValues, $userId, $submissionId, $userGroup) {
        $obj = new SubmissionDetails();
        $newSubmissionNo = $postedValues['submissionNumber'];
        $newRenewalLookUpId = trim($postedValues['newrenewal']);
        $underWritterId = trim($postedValues['editunderwriter']);
        if ($userGroup == 'master') {
            $productLineId = trim($postedValues['productline_master']);
            $propductLineSubTypeId = $postedValues['editproductlinesubtype_master'];
            $sectionCodeId = $postedValues['editsection_master'];
            $profitId = $postedValues['editprofitcode_master'];
        } else {
            $product = $obj->getLobList($postedValues['editproductline']);
            $productLineId = $product[0]['Id'];
            $propductLineSubTypeId = $postedValues['editproductlinesubtype'];
            $sectionCodeId = $postedValues['editsection'];
            $profitId = $postedValues['editprofitcode'];
        }
        $branchId = trim($postedValues['branch_office']);
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
        if (isset($postedValues['yesTrue'])) {
            $postedValues['yesTrue'] = $postedValues['yesTrue'];
        } else {
            $postedValues['yesTrue'] = 'N';
        }
        if (isset($postedValues['yesBroker'])) {
            $postedValues['yesBroker'] = $postedValues['yesBroker'];
        } else {
            $postedValues['yesBroker'] = 'N';
        }
        if (isset($postedValues['yesIndia'])) {
            $postedValues['yesIndia'] = $postedValues['yesIndia'];
        } else {
            $postedValues['yesIndia'] = 'N';
        }
        if (isset($postedValues['yesGross'])) {
            $postedValues['yesGross'] = $postedValues['yesGross'];
        } else {
            $postedValues['yesGross'] = 'N';
        }
        if (isset($postedValues['yesLimit'])) {
            $postedValues['yesLimit'] = $postedValues['yesLimit'];
        } else {
            $postedValues['yesLimit'] = 'N';
        }
        if (isset($postedValues['yesAttachment'])) {
            $postedValues['yesAttachment'] = $postedValues['yesAttachment'];
        } else {
            $postedValues['yesAttachment'] = 'N';
        }

        $primaryStatus = $postedValues['editprimarystatus'];
        $effectiveDate = date("Y-m-d", strtotime($postedValues['effectiveDate']));
        $expiryDate = date("Y-m-d", strtotime($postedValues['expityDate']));
        if (!empty($postedValues['insuredId'])) {
            $insuredId = $postedValues['insuredId'];
        } else {
            $insuredId = null;
        }
        $isDifferentDba = $postedValues['insured_name_status'];
        if (!empty($postedValues['insured_address_status'])) {
            $isDifferentMailingAddress = $postedValues['insured_address_status'];
        } else {
            $isDifferentMailingAddress = null;
        }
        if ($isDifferentDba == 'Y') {
            $dbaName = str_replace("'", "''", $postedValues['dbaName']);
        } else {
            $dbaName = null;
        }
        if (isset($postedValues['editcabcompanies'])) {
            $cabCompaniesLookupId = implode(" & ", $postedValues['editcabcompanies']);
        } else {
            $cabCompaniesLookupId = $postedValues['cabValue'];
        }
        if (!empty($postedValues['reinsured_company'])) {
            $reinsuredCompany = str_replace("'", "''", $postedValues['reinsured_company']);
        } else {
            $reinsuredCompany = null;
        }
        if (!empty($postedValues['editsubmissiontypeidrntifier'])) {
            $submissionTypeIdentifier = $postedValues['editsubmissiontypeidrntifier'];
        } else {
            $submissionTypeIdentifier = null;
        }
        if ($postedValues['yesTrue'] == 'Y') {
            if (!empty($postedValues['total_insured_value_select'])) {
                $totalInsuredValue = $postedValues['total_insured_value_select'];
            }
        } else if ($postedValues['yesTrue'] == 'N') {
            if (!empty($postedValues['edittotalinsuredvalue'])) {
                $totalInsuredValue = $postedValues['edittotalinsuredvalue'];
            }
        } else {
            $totalInsuredValue = null;
        }
        if (!empty($postedValues['edittotalinsuredvalueinusd'])) {
            $totalInsuredValueUSD = $postedValues['edittotalinsuredvalueinusd'];
        } else {
            $totalInsuredValueUSD = null;
        }

        if (!empty($postedValues['brokerCityCode'])) {
            $brokerWiseCityId = $postedValues['brokerCityCode'];
        } else {
            $brokerWiseCityId = null;
        }
        if (!empty($postedValues['broker_contact_person'])) {
            $brokerContactPerson = str_replace("'", "''", $postedValues['broker_contact_person']);
        } else {
            $brokerContactPerson = null;
        }

        if (!empty($postedValues['broker_contact_person_email'])) {
            $brokerContactPersonEmail = $postedValues['broker_contact_person_email'];
        } else {
            $brokerContactPersonEmail = null;
        }

        if (!empty($postedValues['borker_contact_peson_number'])) {
            $brokerContactPersonNumber = $postedValues['borker_contact_peson_number'];
        } else {
            $brokerContactPersonNumber = null;
        }

        if ($postedValues['brokerCode'] == '-1') {
            $BrokerCode = '1-000-000-0000';
        } else if ($postedValues['brokerCode'] == '-2') {
            $BrokerCode = '2-000-000-0000';
        } else {
            $BrokerCode = $postedValues['brokerCodeGen1'];
        }

        if (!empty($postedValues['received_date_by_berkshire'])) {
            $byBerkSi = date("Y-m-d H:i:s", strtotime($postedValues['received_date_by_berkshire']));
        } else {
            $byBerkSi = null;
        }
        if (!empty($postedValues['received_date_by_india'])) {
            $byIndia = date("Y-m-d", strtotime($postedValues['received_date_by_india']));
        } else {
            $byIndia = null;
        }

        $qcStatus = $obj->getLookUpTypeList('QCStatus');
        $qcStatusId = $qcStatus[0]['Id'];
        /* For Business Dependent Details End */
        $projrctArray = array();
        if (!empty($postedValues['project_name'])) {
            $projrctArray['projectName'] = str_replace("'", "''", $postedValues['project_name']);
        } else {
            $projrctArray['projectName'] = null;
        }
        if (!empty($postedValues['general_contrator_name'])) {
            $projrctArray['generalContractorName'] = str_replace("'", "''", $postedValues['general_contrator_name']);
        } else {
            $projrctArray['generalContractorName'] = null;
        }
        if (!empty($postedValues['project_owner_name'])) {
            $projrctArray['projectOwnerName'] = str_replace("'", "''", $postedValues['project_owner_name']);
        } else {
            $projrctArray['projectOwnerName'] = null;
        }
        if (!empty($postedValues['project_street_address'])) {
            $projrctArray['address1'] = str_replace("'", "''", $postedValues['project_street_address']);
        } else {
            $projrctArray['address1'] = null;
        }
        if (!empty($postedValues['project_country'])) {
            $projrctArray['countryName'] = $obj->GetCountryById($postedValues['project_country']);
        } else {
            $projrctArray['countryName'] = null;
        }
        if (!empty($postedValues['project_state'])) {
            $projrctArray['stateName'] = $obj->GetProjectStateById($postedValues['project_state']);
        } else {
            $projrctArray['stateName'] = null;
        }
        if (!empty($postedValues['project_city'])) {
            $projrctArray['cityName'] = $obj->GetProjectCityById($postedValues['project_city']);
        } else {
            $projrctArray['cityName'] = null;
        }
        $projrctArray['zipcode'] = null;
        if (!empty($postedValues['bid_situation'])) {
            $projrctArray['projectBidSituationLookupId'] = $postedValues['bid_situation'];
        } else {
            $projrctArray['projectBidSituationLookupId'] = null;
        }
        if (empty($postedValues['businessDependentDetailsId'])) {
            if ($postedValues['project_name'] || $postedValues['general_contrator_name'] || $postedValues['project_owner_name'] || $postedValues['project_street_address'] || $postedValues['project_country'] || $postedValues['project_state'] || $postedValues['project_city']) {
                $businessDependentDetailsId = $obj->insertBusinessDependentDetails($projrctArray);
            }
        } else {
            $businessDependentDetailsId = $postedValues['businessDependentDetailsId'];
            $this->UpdateBusinessDependentDetails($projrctArray, $businessDependentDetailsId);
        }
        /* For Business Dependent Details End */
        /* For Status Dependent Details Start */
        $statusArray = array();
        if (!empty($postedValues['reason_code'])) {
            $statusArray['reasonCodeId'] = $postedValues['reason_code'];
        } else {
            $statusArray['reasonCodeId'] = null;
        }
        if (!empty($postedValues['processdate'])) {
            $statusArray['processDate'] = $postedValues['processdate'];
        }
        if (!empty($postedValues['editexchangeRateDate'])) {
            $statusArray['exchangeRateDate'] = $postedValues['editexchangeRateDate'];
        } else {
            $statusArray['exchangeRateDate'] = null;
        }
        if (!empty($postedValues['editcurrency'])) {
            $statusArray['currency'] = $postedValues['editcurrency'];
        } else {
            $statusArray['currency'] = null;
        }
        if (!empty($postedValues['editexchangeRate'])) {
            $statusArray['exchangeRate'] = $postedValues['editexchangeRate'];
        } else {
            $statusArray['exchangeRate'] = null;
        }
        /* Premium in Local Currency */
        if ($postedValues['yesGross'] == 'Y') {
            if (!empty($postedValues['gross_premium_select'])) {
                $statusArray['grossPremium'] = $postedValues['gross_premium_select'];
            }
        } else if ($postedValues['yesGross'] == 'N') {
            if (!empty($postedValues['gross_premium_text'])) {
                $statusArray['grossPremium'] = $postedValues['gross_premium_text'];
            }
        } else {
            $statusArray['grossPremium'] = null;
        }
        /* Premium in USD */
        if (!empty($postedValues['editlocalCurrency'])) {
            $statusArray['premiumUsdCurrency'] = $postedValues['editlocalCurrency'];
        } else {
            $statusArray['premiumUsdCurrency'] = null;
        }
        /* Limit in Local Currency */
        if ($postedValues['yesLimit'] == 'Y') {
            if (!empty($postedValues['limit_select'])) {
                $statusArray['limit'] = $postedValues['limit_select'];
            }
        } else if ($postedValues['yesLimit'] == 'N') {
            if (!empty($postedValues['limit_text'])) {
                $statusArray['limit'] = $postedValues['limit_text'];
            }
        } else {
            $statusArray['limit'] = null;
        }
        /* Limit in USD */
        if (!empty($postedValues['editlimitlocalcurrency'])) {
            $statusArray['limit_usd_text'] = $postedValues['editlimitlocalcurrency'];
        } else {
            $statusArray['limit_usd_text'] = null;
        }
        /* AttachmentPoint in Local Currency */
        if ($postedValues['yesAttachment'] == 'Y') {
            if (!empty($postedValues['attachment_point_select'])) {
                $statusArray['attachment'] = $postedValues['attachment_point_select'];
            }
        } else if ($postedValues['yesAttachment'] == 'N') {
            if (!empty($postedValues['attachment_point_text'])) {
                $statusArray['attachment'] = $postedValues['attachment_point_text'];
            }
        } else {
            $statusArray['attachment'] = null;
        }
        /* AttachmentPoint in USD */
        if (!empty($postedValues['editattachmentlocalcurrency'])) {
            $statusArray['attachment_point'] = $postedValues['editattachmentlocalcurrency'];
        } else {
            $statusArray['attachment_point'] = null;
        }
        if (empty($postedValues['statusDependentDetailsId'])) {
            if ($postedValues['reason_code'] || $postedValues['processdate'] || $postedValues['gross_premium_text'] || $postedValues['limit_text'] || $postedValues['attachment_point_text'] || $postedValues['gross_premium_select'] || $postedValues['attachment_point_select']) {
                $statusDependentDetailsId = $this->InsertStatusDepdentDetails($statusArray);
            } else if ($postedValues['editexchangeRateDate'] || $postedValues['editexchangeRate']) {
                $statusDependentDetailsId = $this->InsertStatusDepdentDetails($statusArray);
            }
        } else {
            $statusDependentDetailsId = $postedValues['statusDependentDetailsId'];
            $this->UpdateStatusDepdentDetails($statusArray, $statusDependentDetailsId);
        }
        /* For Status Dependent Details End */
        $dataRecorderId = $postedValues['dataRecorderId'];
        if ($postedValues['dataRecorderId']) {
            $this->UpdateDataRecorderMetaData($dataRecorderId, $userId);
        }
        if (!empty($postedValues['EditOccupancyCode'])) {
            $occupancyCode = $postedValues['EditOccupancyCode'];
        } else {
            $occupancyCode = null;
        }
        if (!empty($postedValues['EditNumberOfLocations'])) {
            $numberOfLocations = $postedValues['EditNumberOfLocations'];
        } else {
            $numberOfLocations = null;
        }
        if (!empty($postedValues['editriskProfile'])) {
            $riskProfile = $postedValues['editriskProfile'];
        } else {
            $riskProfile = null;
        }
        if (!empty($postedValues['editinsuredContactPerson'])) {
            $editinsuredContactPersonId = $postedValues['editinsuredContactPerson'];
        } else {
            $editinsuredContactPersonId = null;
        }

        if (!empty($postedValues['editinsuredSubmissionDate'])) {
            $insuredSubmissionDate = date("Y-m-d", strtotime($postedValues['editinsuredSubmissionDate']));
        } else {
            $insuredSubmissionDate = null;
        }

        if (!empty($postedValues['editinsuredQuoteDueDate'])) {
            $insuredQuoteDueDate = date("Y-m-d", strtotime($postedValues['editinsuredQuoteDueDate']));
        } else {
            $insuredQuoteDueDate = null;
        }

        if (!empty($postedValues['broker_contact_person'])) {
            $editbrokerContactPersonId = $postedValues['broker_contact_person'];
        } else {
            $editbrokerContactPersonId = null;
        }

        if (isset($postedValues['yesDuckSubmissionNumber'])) {
            $postedValues['yesDuckSubmissionNumber'] = $postedValues['yesDuckSubmissionNumber'];
        } else {
            $postedValues['yesDuckSubmissionNumber'] = 'N';
        }
        $postedValues['editDuckSubmissionNumber'] = $postedValues['editDuckSubmissionNumber'];

        $con = Propel::getConnection();
        if (empty($postedValues['received_date_by_berkshire']) && empty($postedValues['received_date_by_india'])) {
            $query = "UPDATE Submission SET SubmissionNumber = '" . $newSubmissionNo . "', NewRenewalLookupId = '" . $newRenewalLookUpId . "', UnderwriterId = '" . $underWritterId . "',LobId = '" . $productLineId . "', LobSubTypeId = '" . $propductLineSubTypeId . "', SectionId = '" . $sectionId . "', ProfitCodeId = '" . $profitCodeId . "', CurrentStatusId = " . $primaryStatus . ",EffectiveDate = '" . $effectiveDate . "', ExpiryDate = '" . $expiryDate . "', InsuredId = '" . $insuredId . "', IsDifferentDba = '" . $isDifferentDba . "', DbaName = '" . $dbaName . "', CABCompaniesLookupId = '" . $cabCompaniesLookupId . "', ReinsuredCompany = '" . $reinsuredCompany . "', SubmissionIdentifier = '" . $submissionTypeIdentifier . "', BusinessDependentDetailId = '" . $businessDependentDetailsId . "', TotalInsuredValue = '" . $totalInsuredValue . "', BrokerWiseCityId = '" . $brokerWiseCityId . "', BrokerCode = '" . $BrokerCode . "', StatusDependentDetailsId = '" . $statusDependentDetailsId . "', BerkSIDateFromBroker = null, BerkSiDateFromIndia = null, BranchId = '" . $branchId . "', QCStatus = '" . $qcStatusId . "', OccupancyCodeId = '" . $occupancyCode . "', NumberOfLocationsId = '" . $numberOfLocations . "',DataRecorderMetaDataId = '" . $dataRecorderId . "', IsTotalInsuredValue = '" . $postedValues['yesTrue'] . "', IsBerksiBroker = '" . $postedValues['yesBroker'] . "', IsBerksiIndia = '" . $postedValues['yesIndia'] . "', IsGrossPremium = '" . $postedValues['yesGross'] . "', IsLimit = '" . $postedValues['yesLimit'] . "', IsAttachmentPoint = '" . $postedValues['yesAttachment'] . "', BrokerContactPersonId = '" . $editbrokerContactPersonId . "', InsuredContactPersonId = '" . $editinsuredContactPersonId . "', InsuredSubmissionDate = '" . $insuredSubmissionDate . "', InsuredQuoteDueDate = '" . $insuredQuoteDueDate . "', RiskProfile = '" . $riskProfile . "', TotalInsuredValueInUSD = '" . $totalInsuredValueUSD . "', IsDuckSubmissionNumber = '" . $postedValues['yesDuckSubmissionNumber'] . "',DuckSubmissionNumber = '" . $postedValues['editDuckSubmissionNumber'] . "' Where Id = $submissionId";
        } else if (empty($postedValues['received_date_by_india']) && !empty($postedValues['received_date_by_berkshire'])) {
            $query = "UPDATE Submission SET SubmissionNumber = '" . $newSubmissionNo . "', NewRenewalLookupId = '" . $newRenewalLookUpId . "', UnderwriterId = '" . $underWritterId . "',LobId = '" . $productLineId . "', LobSubTypeId = '" . $propductLineSubTypeId . "', SectionId = '" . $sectionId . "', ProfitCodeId = '" . $profitCodeId . "', CurrentStatusId = " . $primaryStatus . ",EffectiveDate = '" . $effectiveDate . "', ExpiryDate = '" . $expiryDate . "', InsuredId = '" . $insuredId . "', IsDifferentDba = '" . $isDifferentDba . "', DbaName = '" . $dbaName . "', CABCompaniesLookupId = '" . $cabCompaniesLookupId . "', ReinsuredCompany = '" . $reinsuredCompany . "', SubmissionIdentifier = '" . $submissionTypeIdentifier . "', BusinessDependentDetailId = '" . $businessDependentDetailsId . "', TotalInsuredValue = '" . $totalInsuredValue . "', BrokerWiseCityId = '" . $brokerWiseCityId . "', BrokerCode = '" . $BrokerCode . "', StatusDependentDetailsId = '" . $statusDependentDetailsId . "', BerkSIDateFromBroker = '" . $byBerkSi . "', BerkSiDateFromIndia = null, BranchId = '" . $branchId . "', QCStatus = '" . $qcStatusId . "', OccupancyCodeId = '" . $occupancyCode . "', NumberOfLocationsId = '" . $numberOfLocations . "', DataRecorderMetaDataId = '" . $dataRecorderId . "', IsTotalInsuredValue = '" . $postedValues['yesTrue'] . "', IsBerksiBroker = '" . $postedValues['yesBroker'] . "', IsBerksiIndia = '" . $postedValues['yesIndia'] . "', IsGrossPremium = '" . $postedValues['yesGross'] . "', IsLimit = '" . $postedValues['yesLimit'] . "', IsAttachmentPoint = '" . $postedValues['yesAttachment'] . "', BrokerContactPersonId = '" . $editbrokerContactPersonId . "', InsuredContactPersonId = '" . $editinsuredContactPersonId . "', InsuredSubmissionDate = '" . $insuredSubmissionDate . "', InsuredQuoteDueDate = '" . $insuredQuoteDueDate . "', RiskProfile = '" . $riskProfile . "', TotalInsuredValueInUSD = '" . $totalInsuredValueUSD . "' ,IsDuckSubmissionNumber = '" . $postedValues['yesDuckSubmissionNumber'] . "',DuckSubmissionNumber = '" . $postedValues['editDuckSubmissionNumber'] . "' Where Id = $submissionId";
        } else if (empty($postedValues['received_date_by_berkshire']) && !empty($postedValues['received_date_by_india'])) {
            $query = "UPDATE Submission SET SubmissionNumber = '" . $newSubmissionNo . "', NewRenewalLookupId = '" . $newRenewalLookUpId . "', UnderwriterId = '" . $underWritterId . "',LobId = '" . $productLineId . "', LobSubTypeId = '" . $propductLineSubTypeId . "', SectionId = '" . $sectionId . "', ProfitCodeId = '" . $profitCodeId . "', CurrentStatusId = " . $primaryStatus . ",EffectiveDate = '" . $effectiveDate . "', ExpiryDate = '" . $expiryDate . "', InsuredId = '" . $insuredId . "', IsDifferentDba = '" . $isDifferentDba . "', DbaName = '" . $dbaName . "',  CABCompaniesLookupId = '" . $cabCompaniesLookupId . "', ReinsuredCompany = '" . $reinsuredCompany . "', SubmissionIdentifier = '" . $submissionTypeIdentifier . "', BusinessDependentDetailId = '" . $businessDependentDetailsId . "', TotalInsuredValue = '" . $totalInsuredValue . "', BrokerWiseCityId = '" . $brokerWiseCityId . "',BrokerCode = '" . $BrokerCode . "', StatusDependentDetailsId = '" . $statusDependentDetailsId . "', BerkSIDateFromBroker = null, BerkSiDateFromIndia = '" . $byIndia . "', BranchId = '" . $branchId . "', QCStatus = '" . $qcStatusId . "', OccupancyCodeId = '" . $occupancyCode . "', NumberOfLocationsId = '" . $numberOfLocations . "', DataRecorderMetaDataId = '" . $dataRecorderId . "', IsTotalInsuredValue = '" . $postedValues['yesTrue'] . "', IsBerksiBroker = '" . $postedValues['yesBroker'] . "', IsBerksiIndia = '" . $postedValues['yesIndia'] . "', IsGrossPremium = '" . $postedValues['yesGross'] . "', IsLimit = '" . $postedValues['yesLimit'] . "', IsAttachmentPoint = '" . $postedValues['yesAttachment'] . "', BrokerContactPersonId = '" . $editbrokerContactPersonId . "', InsuredContactPersonId = '" . $editinsuredContactPersonId . "', InsuredSubmissionDate = '" . $insuredSubmissionDate . "', InsuredQuoteDueDate = '" . $insuredQuoteDueDate . "', RiskProfile = '" . $riskProfile . "', TotalInsuredValueInUSD = '" . $totalInsuredValueUSD . "',IsDuckSubmissionNumber = '" . $postedValues['yesDuckSubmissionNumber'] . "',DuckSubmissionNumber = '" . $postedValues['editDuckSubmissionNumber'] . "' Where Id = $submissionId";
        } else {
            $query = "UPDATE Submission SET SubmissionNumber = '" . $newSubmissionNo . "', NewRenewalLookupId = '" . $newRenewalLookUpId . "', UnderwriterId = '" . $underWritterId . "',LobId = '" . $productLineId . "', LobSubTypeId = '" . $propductLineSubTypeId . "', SectionId = '" . $sectionId . "', ProfitCodeId = '" . $profitCodeId . "', CurrentStatusId = " . $primaryStatus . ",EffectiveDate = '" . $effectiveDate . "', ExpiryDate = '" . $expiryDate . "', InsuredId = '" . $insuredId . "', IsDifferentDba = '" . $isDifferentDba . "', DbaName = '" . $dbaName . "', CABCompaniesLookupId = '" . $cabCompaniesLookupId . "', ReinsuredCompany = '" . $reinsuredCompany . "', SubmissionIdentifier = '" . $submissionTypeIdentifier . "', BusinessDependentDetailId = '" . $businessDependentDetailsId . "', TotalInsuredValue = '" . $totalInsuredValue . "', BrokerWiseCityId = '" . $brokerWiseCityId . "', BrokerCode = '" . $BrokerCode . "', StatusDependentDetailsId = '" . $statusDependentDetailsId . "', BerkSIDateFromBroker = '" . $byBerkSi . "', BerkSiDateFromIndia = '" . $byIndia . "', BranchId = '" . $branchId . "', QCStatus = '" . $qcStatusId . "', OccupancyCodeId = '" . $occupancyCode . "', NumberOfLocationsId = '" . $numberOfLocations . "', DataRecorderMetaDataId = '" . $dataRecorderId . "', IsTotalInsuredValue = '" . $postedValues['yesTrue'] . "', IsBerksiBroker = '" . $postedValues['yesBroker'] . "', IsBerksiIndia = '" . $postedValues['yesIndia'] . "', IsGrossPremium = '" . $postedValues['yesGross'] . "', IsLimit = '" . $postedValues['yesLimit'] . "', IsAttachmentPoint = '" . $postedValues['yesAttachment'] . "', BrokerContactPersonId = '" . $editbrokerContactPersonId . "', InsuredContactPersonId = '" . $editinsuredContactPersonId . "', InsuredSubmissionDate = '" . $insuredSubmissionDate . "', InsuredQuoteDueDate = '" . $insuredQuoteDueDate . "', RiskProfile = '" . $riskProfile . "', TotalInsuredValueInUSD = '" . $totalInsuredValueUSD . "',IsDuckSubmissionNumber = '" . $postedValues['yesDuckSubmissionNumber'] . "',DuckSubmissionNumber = '" . $postedValues['editDuckSubmissionNumber'] . "' Where Id = $submissionId";
        }
        $insert = $con->prepare($query);
        if ($insert->execute()) {
            if ($postedValues['editprimarystatus'] == 9) {
                $submissionIdCheck = $this->CheckSubmissionIdExistInSubmissionBound($submissionId);
                if ($submissionIdCheck == true) {
                    $policyNumber = $this->createPolicyNumber($postedValues);
                    $this->UpdateSubmissionBound($postedValues, $submissionId, $policyNumber);
                } else {
                    $policyNumber = $this->createPolicyNumber($postedValues);
                    $this->insertSubmissionBoundOnEdit($postedValues, $submissionId, $policyNumber);
                }
            }
            $submissionCheck = $this->CheckSubmissionIdExistInRetailBrokerDetails($submissionId);
            if ($submissionCheck == true) {
                if ($postedValues['wholesaler_retailer'] == 'Wholesaler') {
                    $this->UpdateRetailBrokerDetailsDetails($postedValues, $submissionId);
                }
            } else {
                if ($postedValues['wholesaler_retailer'] == 'Wholesaler') {
                    $this->insertIntoRetailBrokerDetails($postedValues, $submissionId);
                }
            }
            return true;
        } else {
            return false;
        }
    }

    private function UpdateSubmissionNumber($postedValues) {
        $productLine = $postedValues['productLinePrefix'];
        $data = explode("-", $postedValues['submissionNumber']);
        $finalSubmissionNumber = $data[0] . '-' . $data[1] . '-' . $productLine . '-' . $data[3] . '-' . $data[4];
        return $finalSubmissionNumber;
    }

    public function createPolicyNumber($postedValues) {
        $viewObj = new ViewSubmissionDetails();
        $companyPaperNumberData = $viewObj->getLookUpdata($postedValues['editcompanyPaperNumber']);
        $companyPaperNumber = $companyPaperNumberData[0]['LookupName'];
        $suffixdata = $viewObj->getLookUpdata($postedValues['editsuffix']);
        $suffix = $suffixdata[0]['LookupName'];
        $coverage = $viewObj->GetCoverageDetails($postedValues['editcoverage']);
        $policyNumber = $companyPaperNumber . '-' . $coverage . '-' . $postedValues['editpolicyNumber'] . '-' . $suffix;
        return $policyNumber;
    }

    public function UpdateRetailBrokerDetailsDetails($postedValues, $submissionId) {
        $con = Propel::getConnection();
        $query = "UPDATE RetailBrokerDetails SET RetailBrokerName = '" . $postedValues['retailBrokerName'] . "',  RetailBrokerCountry = '" . $postedValues['retailbrokerCountryCode'] . "', RetailBrokerState = '" . $postedValues['retailbrokerStateCode'] . "', RetailBrokerCity = '" . $postedValues['retailbrokerCityCode'] . "' WHERE SubmissionId = '" . $submissionId . "'";
        $insert = $con->prepare($query);
        $insert->execute();
    }

    public function insertIntoRetailBrokerDetails($postValues, $submissionId) {
        $con = Propel::getConnection();
        $query = "INSERT INTO RetailBrokerDetails 
              (SubmissionId, RetailBrokerName, RetailBrokerCountry,RetailBrokerState,RetailBrokerCity) 
               VALUES 
               ('" . $submissionId . "','" . $postValues['retailBrokerName'] . "','" . $postValues['retailbrokerCountryCode'] . "', '" . $postValues['retailbrokerStateCode'] . "', '" . $postValues['retailbrokerCityCode'] . "')";
        $insert = $con->prepare($query);
        if ($insert->execute()) {
            return true;
        } else {
            return false;
        }
    }

    /**
     * This method update the information of Submission Bound
     */
    public function UpdateSubmissionBound($postValues, $submissionId, $editpolicyNumber) {
        $boundArray = array();
        $boundArray['editbinddate'] = date("Y-m-d", strtotime($postValues['editbinddate']));
        $boundArray['newrenewal'] = $postValues['editrenewable'];
        $boundArray['editdateofrenewal'] = date("Y-m-d", strtotime($postValues['editdateofrenewal']));
        $boundArray['editpolicyName'] = $postValues['editpolicyName'];
        $boundArray['editdirectAssumed'] = $postValues['editdirectAssumed'];
        $boundArray['editcompanyPaper'] = $postValues['editcompanyPaper'];
        $boundArray['editcompanyPaperNumber'] = $postValues['editcompanyPaperNumber'];
        $boundArray['editcoverage'] = $postValues['editcoverage'];
        $boundArray['editpolicyNumber'] = $postValues['editpolicyNumber'];
        $boundArray['editsuffix'] = $postValues['editsuffix'];
        $boundArray['edittransactionNumber'] = $postValues['edittransactionNumber'];
        $boundArray['editadmitted'] = $postValues['editadmitted'];
        $boundArray['editLayerLimitLocalCurrency'] = $postValues['editLayerLimitLocalCurrency'];
        $boundArray['editLayerLimitLocalUSD'] = $postValues['editLayerLimitLocalUSD'];
        $boundArray['editPrecentageLayer'] = $postValues['editPrecentageLayer'];
        $boundArray['editselfRetrntionLocalCurrency'] = $postValues['editselfRetrntionLocalCurrency'];
        $boundArray['editselfRetrntionUSD'] = $postValues['editselfRetrntionUSD'];
        $boundArray['editpolicyCommision'] = $postValues['editpolicyCommision'];
        $boundArray['editpolicyCommisionLocalCurrrency'] = $postValues['editpolicyCommisionLocalCurrrency'];
        $boundArray['editpolicyCommisionUSD'] = $postValues['editpolicyCommisionUSD'];
        $boundArray['editPermiumLocalCurency'] = $postValues['editPermiumLocalCurency'];
        $boundArray['editPermiumUSD'] = $postValues['editPermiumUSD'];
        $boundArray['editnaicCode'] = $postValues['editnaicCode'];
        $boundArray['editnaicTitle'] = $postValues['editnaicTitle'];
        $boundArray['editsicCode'] = $postValues['editsicCode'];
        $boundArray['editsicTitle'] = $postValues['editsicTitle'];
        $boundArray['editofrcReport'] = $postValues['editofrcReport'];
        if (isset($postValues['yesBinddate'])) {
            $boundArray['yesBinddate'] = $postValues['yesBinddate'];
        } else {
            $boundArray['yesBinddate'] = 'N';
        }
        $boundArray['editclassName'] = $postValues['editclassName'];
        $boundArray['editsubClass'] = $postValues['editsubClass'];
        $boundArray['editdescription'] = str_replace("'", "''", $postValues['editdescription']);
        $con = Propel::getConnection();
        $query = "UPDATE SubmissionBound SET IsBindDate = '" . $boundArray['yesBinddate'] . "', BindDate = '" . $boundArray['editbinddate'] . "', RenewableLookupId = '" . $boundArray['newrenewal'] . "', DateofRenewal = '" . $boundArray['editdateofrenewal'] . "',PolicyTypeLookupId = '" . $boundArray['editpolicyName'] . "',DirectAssumedLookupId = '" . $boundArray['editdirectAssumed'] . "',CompanyPaperLookupId = '" . $boundArray['editcompanyPaper'] . "',CompanyPaperNumberLookupId = '" . $boundArray['editcompanyPaperNumber'] . "', CoverageId = '" . $boundArray['editcoverage'] . "',PolicyNumber = '" . $boundArray['editpolicyNumber'] . "',SuffixLookupId = '" . $boundArray['editsuffix'] . "',TransactionNumber = '" . $boundArray['edittransactionNumber'] . "',AdimittedNonAdmittedLookupId = '" . $boundArray['editadmitted'] . "',LayerofLimitInLocalCurrency = '" . $boundArray['editLayerLimitLocalCurrency'] . "',LayerofLimitInUSD = '" . $boundArray['editLayerLimitLocalUSD'] . "',PercentageofLayer = '" . $boundArray['editPrecentageLayer'] . "',SelfInsuredRetentionInLocalCurrency = '" . $boundArray['editselfRetrntionLocalCurrency'] . "',SelfInsuredRetentionInUSD = '" . $boundArray['editselfRetrntionUSD'] . "',PolicyCommPercentage = '" . $boundArray['editpolicyCommision'] . "', PolicyCommInLocalCurrency = '" . $boundArray['editpolicyCommisionLocalCurrrency'] . "',PolicyCommInUSD = '" . $boundArray['editpolicyCommisionUSD'] . "',PermiumNetofCommInLocalCurrency = '" . $boundArray['editPermiumLocalCurency'] . "',PermiumNetofCommInUSD = '" . $boundArray['editPermiumUSD'] . "',
                   NAICCode = '" . $boundArray['editnaicCode'] . "',NAICTitle = '" . $boundArray['editnaicTitle'] . "',SICCode = '" . $boundArray['editsicCode'] . "',SICTitle = '" . $boundArray['editsicTitle'] . "',OFRCAdverseReportLookupId = '" . $boundArray['editofrcReport'] . "', FinalPolicyNumber = '" . $editpolicyNumber . "',ClassNameLookupId = '".$boundArray['editclassName']."', ClassCode = '".$boundArray['editsubClass']."', ClassDescription = '".$boundArray['editdescription']."' Where SubmissionId = $submissionId";

        $insert = $con->prepare($query);
        if ($insert->execute()) {
            return true;
        } else {
            return false;
        }
    }

    /**
     * This method insert the information in Submission Bound on First Time on Edit.
     */
    public function insertSubmissionBoundOnEdit($postValues, $submissionId, $policyNumber) {
        $boundArray = array();
        $boundArray['bindDate'] = date("Y-m-d", strtotime($postValues['editbinddate']));
        $boundArray['renewable'] = $postValues['editrenewable'];
        $boundArray['dateofrenewal'] = date("Y-m-d", strtotime($postValues['editdateofrenewal']));
        $boundArray['policyName'] = $postValues['editpolicyName'];
        $boundArray['directAssumed'] = $postValues['editdirectAssumed'];
        $boundArray['companyPaper'] = $postValues['editcompanyPaper'];
        $boundArray['companyPaperNumber'] = $postValues['editcompanyPaperNumber'];
        $boundArray['coverage'] = $postValues['editcoverage'];
        $boundArray['policyNumber'] = $postValues['editpolicyNumber'];
        $boundArray['suffix'] = $postValues['editsuffix'];
        $boundArray['transactionNumber'] = $postValues['edittransactionNumber'];
        $boundArray['admitted'] = $postValues['editadmitted'];
        $boundArray['layerLimitLocalCurrency'] = $postValues['editLayerLimitLocalCurrency'];
        $boundArray['layerLimitUSD'] = $postValues['editLayerLimitLocalUSD'];
        $boundArray['PercentageLayer'] = $postValues['editPrecentageLayer'];
        $boundArray['selfInsuredRetention'] = $postValues['editselfRetrntionLocalCurrency'];
        $boundArray['selfInsuredRetentionUSD'] = $postValues['editselfRetrntionUSD'];
        $boundArray['policyCommission'] = $postValues['editpolicyCommision'];
        $boundArray['policyComissionInLocalCurrency'] = $postValues['editpolicyCommisionLocalCurrrency'];
        $boundArray['policyComissionInUSD'] = $postValues['editpolicyCommisionUSD'];
        $boundArray['netpremiumCommissionInLocalCurrency'] = $postValues['editPermiumLocalCurency'];
        $boundArray['netpremiumCommissionInUSD'] = $postValues['editPermiumUSD'];
        $boundArray['naicCode'] = $postValues['editnaicCode'];
        $boundArray['naicTitle'] = $postValues['editnaicTitle'];
        $boundArray['sicCode'] = $postValues['editsicCode'];
        $boundArray['sicTitle'] = $postValues['editsicTitle'];
        $boundArray['ofrcReport'] = $postValues['editofrcReport'];
        if (isset($postValues['yesBinddate'])) {
            $boundArray['yesBinddate'] = $postValues['yesBinddate'];
        } else {
            $boundArray['yesBinddate'] = 'N';
        }
        $boundArray['editclassName'] = $postValues['editclassName'];
        $boundArray['editsubClass'] = $postValues['editsubClass'];
        $boundArray['editdescription'] = str_replace("'", "''", $postValues['editdescription']);
        $con = Propel::getConnection();
        $query = "INSERT INTO submissionBound 
              (SubmissionId,IsBindDate,BindDate,RenewableLookupId,DateofRenewal,PolicyTypeLookupId,DirectAssumedLookupId,CompanyPaperLookupId,CompanyPaperNumberLookupId,CoverageId,PolicyNumber,SuffixLookupId,TransactionNumber,AdimittedNonAdmittedLookupId,LayerofLimitInLocalCurrency,LayerofLimitInUSD,PercentageofLayer,SelfInsuredRetentionInLocalCurrency,SelfInsuredRetentionInUSD,PolicyCommPercentage,PolicyCommInLocalCurrency,PolicyCommInUSD,PermiumNetofCommInLocalCurrency,PermiumNetofCommInUSD,NAICCode,NAICTitle,SICCode,SICTitle,OFRCAdverseReportLookupId,FinalPolicyNumber,ClassNameLookupId,ClassCode,ClassDescription) 
               VALUES 
               ('" . $submissionId . "','" . $boundArray['yesBinddate'] . "','" . $boundArray['bindDate'] . "','" . $boundArray['renewable'] . "' ,'" . $boundArray['dateofrenewal'] . "', '" . $boundArray['policyName'] . "', '" . $boundArray['directAssumed'] . "', '" . $boundArray['companyPaper'] . "', '" . $boundArray['companyPaperNumber'] . "', '" . $boundArray['coverage'] . "', '" . $boundArray['policyNumber'] . "', '" . $boundArray['suffix'] . "', '" . $boundArray['transactionNumber'] . "', '" . $boundArray['admitted'] . "', '" . $boundArray['layerLimitLocalCurrency'] . "', '" . $boundArray['layerLimitUSD'] . "', '" . $boundArray['PercentageLayer'] . "', '" . $boundArray['selfInsuredRetention'] . "', '" . $boundArray['selfInsuredRetentionUSD'] . "', '" . $boundArray['policyCommission'] . "', '" . $boundArray['policyComissionInLocalCurrency'] . "', '" . $boundArray['policyComissionInUSD'] . "', '" . $boundArray['netpremiumCommissionInLocalCurrency'] . "', '" . $boundArray['netpremiumCommissionInUSD'] . "', '" . $boundArray['naicCode'] . "', '" . $boundArray['naicTitle'] . "', '" . $boundArray['sicCode'] . "', '" . $boundArray['sicTitle'] . "', '" . $boundArray['ofrcReport'] . "','" . $policyNumber . "', '".$boundArray['editclassName']."', '".$boundArray['editsubClass']."', '".$boundArray['editdescription']."')";
        $insert = $con->prepare($query);
        if ($insert->execute()) {
            return true;
        } else {
            return false;
        }
    }

    /**
     * This method update the information of Business Dependent Details
     */
    public function UpdateBusinessDependentDetails($projrctArray, $businessDependentDetailsId) {
        $con = Propel::getConnection();
        $query = "UPDATE  BusinessDependentDetail SET ProjectName = '" . $projrctArray['projectName'] . "' , ProjectGeneralContractorName = '" . $projrctArray['generalContractorName'] . "' ,ProjectOwnerName = '" . $projrctArray['projectOwnerName'] . "', ProjectCity = '" . $projrctArray['cityName'] . "',BidSituation = '" . $projrctArray['projectBidSituationLookupId'] . "', ProjectState = '" . $projrctArray['stateName'] . "', ProjectCountry = '" . $projrctArray['countryName'] . "', ProjectAddress = '" . $projrctArray['address1'] . "'  WHERE Id = '" . $businessDependentDetailsId . "'";
        $insert = $con->prepare($query);
        $insert->execute();
    }

    /**
     * This method update the information of Address
     */
    public function UpdateAddressDetails($mailingAddressArray, $alternativeId) {
        $con = Propel::getConnection();
        $query = "UPDATE Address SET AddressLine1 = '" . $mailingAddressArray['address1'] . "',  CityId = '" . $mailingAddressArray['cityId'] . "', Zip = '" . $mailingAddressArray['zipcode'] . "' WHERE Id = '" . $alternativeId . "'";
        $insert = $con->prepare($query);
        $insert->execute();
    }

    /**
     * This method update the information of DataRecorderMetaData
     */
    public function UpdateDataRecorderMetaData($dataRecorderId, $userId) {
        $con = Propel::getConnection();
        $query = "UPDATE DataRecorderMetaData SET ModifiedBy = '" . $userId . "', ModifiedOn = GETDATE() WHERE Id = '" . $dataRecorderId . "'";
        $insert = $con->prepare($query);
        $insert->execute();
    }

    /**
     * This method update the information of Status Dependent Details
     */
    public function UpdateStatusDepdentDetails($statusArray, $statusDependentDetailsId) {
        $con = Propel::getConnection();
        if (empty($statusArray['processDate'])) {
            $query = "UPDATE StatusDependentDetails SET ReasonCodeId = '" . $statusArray['reasonCodeId'] . "', ProcessDate = null, GrossPremium = '" . $statusArray['grossPremium'] . "', Limit = '" . $statusArray['limit'] . "', AttachmentPoint = '" . $statusArray['attachment'] . "', GrossPremiumInUSD = '" . $statusArray['premiumUsdCurrency'] . "', LimitInUSD = '" . $statusArray['limit_usd_text'] . "', AttachmentPointInUSD = '" . $statusArray['attachment_point'] . "', ExchangeRate = '" . $statusArray['exchangeRate'] . "', ExchangeDate = '" . $statusArray['exchangeRateDate'] . "', CurrencyTypeId = '" . $statusArray['currency'] . "' WHERE Id = " . $statusDependentDetailsId . "";
        } else {
            $query = "UPDATE StatusDependentDetails SET ReasonCodeId = '" . $statusArray['reasonCodeId'] . "', ProcessDate = '" . $statusArray['processDate'] . "', GrossPremium = '" . $statusArray['grossPremium'] . "', Limit = '" . $statusArray['limit'] . "', AttachmentPoint = '" . $statusArray['attachment'] . "', GrossPremiumInUSD = '" . $statusArray['premiumUsdCurrency'] . "', LimitInUSD = '" . $statusArray['limit_usd_text'] . "', AttachmentPointInUSD = '" . $statusArray['attachment_point'] . "', ExchangeRate = '" . $statusArray['exchangeRate'] . "', ExchangeDate = '" . $statusArray['exchangeRateDate'] . "', CurrencyTypeId = '" . $statusArray['currency'] . "' WHERE Id = " . $statusDependentDetailsId . "";
        }
        $insert = $con->prepare($query);
        if ($insert->execute()) {
            return true;
        } else {
            return false;
        }
    }

    /**
     * This method save the information of Status Dependent Details
     */
    public function InsertStatusDepdentDetails($statusArray) {
        $con = Propel::getConnection();
        if (empty($statusArray['processDate'])) {
            $query = "INSERT INTO  StatusDependentDetails 
              (ReasonCodeId, ProcessDate, GrossPremium, Limit, AttachmentPoint, GrossPremiumInUSD, LimitInUSD, AttachmentPointInUSD, ExchangeRate, ExchangeDate, CurrencyTypeId) 
               VALUES 
               ('" . $statusArray['reasonCodeId'] . "', null,'" . $statusArray['grossPremium'] . "' ,'" . $statusArray['limit'] . "', '" . $statusArray['attachment'] . "', '" . $statusArray['premiumUsdCurrency'] . "', '" . $statusArray['limit_usd_text'] . "', '" . $statusArray['attachment_point'] . "', '" . $statusArray['exchangeRate'] . "', '" . $statusArray['exchangeRateDate'] . "', '" . $statusArray['currency'] . "')";
        } else {
            $query = "INSERT INTO  StatusDependentDetails 
              (ReasonCodeId, ProcessDate, GrossPremium, Limit, AttachmentPoint, GrossPremiumInUSD, LimitInUSD, AttachmentPointInUSD, ExchangeRate, ExchangeDate, CurrencyTypeId) 
               VALUES 
               ('" . $statusArray['reasonCodeId'] . "','" . $statusArray['processDate'] . "','" . $statusArray['grossPremium'] . "' ,'" . $statusArray['limit'] . "', '" . $statusArray['attachment'] . "', '" . $statusArray['premiumUsdCurrency'] . "', '" . $statusArray['limit_usd_text'] . "', '" . $statusArray['attachment_point'] . "', '" . $statusArray['exchangeRate'] . "', '" . $statusArray['exchangeRateDate'] . "', '" . $statusArray['currency'] . "')";
        }
        $insert = $con->prepare($query);
        if ($insert->execute()) {
            $STH = $con->query("SELECT CAST(COALESCE(SCOPE_IDENTITY(), @@IDENTITY) AS int)");
            $STH->execute();
            $result = $STH->fetch();
            $statusId = $result[0];
        }
        return $statusId;
    }

    public function FetchSubmissionDetails($submission) {
        $connection = $this->connection;
        $submissionQuery = "SELECT h.* FROM  submission AS h
            WHERE h.Id = '" . $submission . "'
            ";
        $submissionStatement = $connection->prepare($submissionQuery);
        $submissionStatement->execute();
        $submissionRecordData = $submissionStatement->fetchAll(PDO::FETCH_ASSOC);
        return $submissionRecordData;
    }

    public function FetchAddressDetails($submission) {
        $connection = $this->connection;
        $submissionAddressQuery = "SELECT A.Id AS AddressId, A.AddressLine1 AS AddressLine1, A.Zip AS Zip, C.Id AS CityId, C.CityFullCode, S.Id AS StateId, S.FullCode, Co.Id AS CounrtyId, Co.InsuredCountry FROM  Address as A LEFT JOIN City as C ON A.CityId = C.Id LEFT JOIN State As S On C.StateId = S.Id LEFT JOIN Country as Co on S.CountryId = Co.Id WHERE A.Id = '" . $submission . "'";
        $submissionAddressStatement = $connection->prepare($submissionAddressQuery);
        $submissionAddressStatement->execute();
        $submissionAddressData = $submissionAddressStatement->fetchAll(PDO::FETCH_ASSOC);
        return $submissionAddressData;
    }

    public function FetchBrokerType($BrokerCode) {
        $connection = $this->connection;
        $submissionQuery = "SELECT L.Alias From Broker AS B LEFT JOIN Lookup AS L on B.BrokerTypeId = L.Id WHERE B.BrokerCode = '" . $BrokerCode . "'";
        $submissionAddressStatement = $connection->prepare($submissionQuery);
        $submissionAddressStatement->execute();
        $submissionData = $submissionAddressStatement->fetchAll(PDO::FETCH_ASSOC);
        return $submissionData;
    }

    public function FetchState() {
        $connection = $this->connection;
        $statesQuery = "SELECT * FROM State";
        $statesStatement = $connection->prepare($statesQuery);
        $statesStatement->execute();
        $statesData = $statesStatement->fetchAll(PDO::FETCH_ASSOC);
        return $statesData;
    }

    public function FetchCity() {
        $connection = $this->connection;
        $citesQuery = "SELECT * FROM CITY";
        $citesStatement = $connection->prepare($citesQuery);
        $citesStatement->execute();
        $citesData = $citesStatement->fetchAll(PDO::FETCH_ASSOC);
        return $citesData;
    }

    public function FetchInsuredDetails($insuredId) {
        $connection = $this->connection;
        if (empty($insuredId)) {
            $insuredQuery = "SELECT I.Id as InsuredId, I.InsuredName, I.AddressLine1 as Address, I.Zip, I.City as City, I.State as StateName, I.Country as InsuredCountry, I.DBNumber as DBNumber FROM Insured as I";
        } else {
            $insuredQuery = "SELECT I.Id as InsuredId, I.InsuredName, I.AddressLine1 as Address, I.Zip, I.City as City, I.State as StateName, I.Country as InsuredCountry, I.DBNumber as DBNumber FROM Insured as I WHERE I.Id = '" . $insuredId . "' ; ";
        }
        $insuredStatement = $connection->prepare($insuredQuery);
        $insuredStatement->execute();
        $insuredData = $insuredStatement->fetchAll(PDO::FETCH_ASSOC);
        return $insuredData;
    }

    public function FetchInsuredContactPersonDetails($insuredContactPersonId) {
        $connection = $this->connection;
        $insuredContactPersonQuery = "SELECT  Email, PhoneNumber, MobileNumber FROM ContactPersonDetails Where Id = $insuredContactPersonId";
        $insuredContactPersonStatement = $connection->prepare($insuredContactPersonQuery);
        $insuredContactPersonStatement->execute();
        $insuredContactPersonData = $insuredContactPersonStatement->fetchAll(PDO::FETCH_ASSOC);
        return $insuredContactPersonData;
    }

    public function FetchBrokerContactPersonDetails($insuredContactPersonId) {
        $connection = $this->connection;
        $insuredContactPersonQuery = "SELECT  Email, PhoneNumber, MobileNumber FROM ContactPersonDetails Where Id = $insuredContactPersonId";
        $insuredContactPersonStatement = $connection->prepare($insuredContactPersonQuery);
        $insuredContactPersonStatement->execute();
        $insuredContactPersonData = $insuredContactPersonStatement->fetchAll(PDO::FETCH_ASSOC);
        return $insuredContactPersonData;
    }

    public function FetchBusinessDependentDetails($businessDependentDetailsId) {
        $connection = $this->connection;
        $businessQuery = "SELECT * FROM BusinessDependentDetail WHERE Id = '" . $businessDependentDetailsId . "' ; ";
        $businessStatement = $connection->prepare($businessQuery);
        $businessStatement->execute();
        $businessData = $businessStatement->fetchAll(PDO::FETCH_ASSOC);
        $finalBusinessData = array();
        $finalBusinessData['Id'] = $businessData[0]['Id'];
        $finalBusinessData['ProjectName'] = $businessData[0]['ProjectName'];
        $finalBusinessData['ProjectGeneralContractorName'] = $businessData[0]['ProjectGeneralContractorName'];
        $finalBusinessData['ProjectOwnerName'] = $businessData[0]['ProjectOwnerName'];
        $finalBusinessData['ProjectAddress'] = $businessData[0]['ProjectAddress'];
        $finalBusinessData['BidSituation'] = $businessData[0]['BidSituation'];
        $finalBusinessData['ProjectCountry'] = $this->getCountryId($businessData[0]['ProjectCountry']);
        $finalBusinessData['ProjectState'] = $this->getProjectStateId($businessData[0]['ProjectState']);
        $finalBusinessData['ProjectCity'] = $this->getProjectCityId($businessData[0]['ProjectCity']);
        return $finalBusinessData;
    }

    public function getCountryId($countryName) {
        $con = Propel::getConnection();
        $qry = "SELECT Id FROM Country WHERE InsuredCountry LIKE " . "'$countryName'";
        $stmt = $con->query($qry);
        $result = $stmt->fetchAll();
        $countryId = $result[0]['Id'];
        return $countryId;
    }

    public function getProjectStateId($stateName) {
        $con = Propel::getConnection();
        $qry = "SELECT Id FROM State WHERE ProjectCode LIKE " . "'$stateName'";
        $stmt = $con->query($qry);
        $result = $stmt->fetchAll();
        $countryId = $result[0]['Id'];
        return $countryId;
    }

    public function getProjectCityId($cityName) {
        $con = Propel::getConnection();
        $qry = "SELECT Id FROM City WHERE City LIKE " . "'$cityName'";
        $stmt = $con->query($qry);
        $result = $stmt->fetchAll();
        $countryId = $result[0]['Id'];
        return $countryId;
    }

    public function getStateId($stateName) {
        $con = Propel::getConnection();
        $qry = "SELECT Id FROM State WHERE FullCode LIKE " . "'$stateName'";
        $stmt = $con->query($qry);
        $result = $stmt->fetchAll();
        $countryId = $result[0]['Id'];
        return $countryId;
    }

    public function getCityId($cityName) {
        $con = Propel::getConnection();
        $qry = "SELECT Id FROM City WHERE CityFullCode LIKE " . "'$cityName'";
        $stmt = $con->query($qry);
        $result = $stmt->fetchAll();
        $countryId = $result[0]['Id'];
        return $countryId;
    }

    public function getLobName($lobId) {
        $con = Propel::getConnection();
        $query = "SELECT * FROM LOB WHERE Id = '" . $lobId . "'";
        $stmt = $con->query($query);
        $result = $stmt->fetchAll();
        return $result;
    }

    public function FetchBusinessStatusDetails($statusId) {
        $connection = $this->connection;
        $businessQuery = "SELECT * FROM StatusDependentDetails WHERE Id = '" . $statusId . "' ; ";
        $businessStatement = $connection->prepare($businessQuery);
        $businessStatement->execute();
        $businessData = $businessStatement->fetchAll(PDO::FETCH_ASSOC);
        return $businessData;
    }

    public function FetchSubmissionBranch($branchId) {
        $connection = $this->connection;
        $submissionBranchQuery = "SELECT * FROM Branch Where Id = '$branchId'";
        $submissionBranchStatement = $connection->prepare($submissionBranchQuery);
        $submissionBranchStatement->execute();
        $submissionBranchData = $submissionBranchStatement->fetchAll(PDO::FETCH_ASSOC);
        return $submissionBranchData;
    }

    public function FetchCurrentStatus() {
        $connection = $this->connection;
        $productQuery = "SELECT * FROM  Status Where StatusName != 'Endorsement' And StatusName != 'Cancellation'";
        $productStatement = $connection->prepare($productQuery);
        $productStatement->execute();
        $productData = $productStatement->fetchAll(PDO::FETCH_ASSOC);
        return $productData;
    }

    public function FetchHistoryDetails($submissionId) {
        $con = Propel::getConnection();
        $qry = "SELECT TOP 1 Remarks FROM SubmissionHistory WHERE SubmissionId = '$submissionId' order by Id DESC";
        $stmt = $con->query($qry);
        $result = $stmt->fetchAll();
        return $result;
    }

    public function FetchDataRecorderType($dataRecorderId) {
        $connection = $this->connection;
        $productQuery = "SELECT * FROM DataRecorderMetaData Where Id = '$dataRecorderId'";
        $productStatement = $connection->prepare($productQuery);
        $productStatement->execute();
        $productData = $productStatement->fetchAll(PDO::FETCH_ASSOC);
        return $productData;
    }

    public function FetchReasonCode($statusId, $newRenewal) {
        $connection = $this->connection;
        $reasonQuery = "SELECT * FROM ReasonCode Where StatusId = '$statusId' AND NewRenewal = '$newRenewal' OR Meaning is null";
        $reasonStatement = $connection->prepare($reasonQuery);
        $reasonStatement->execute();
        $reasonData = $reasonStatement->fetchAll(PDO::FETCH_ASSOC);
        if (empty($reasonData)) {
            $reasonData['error'] = "No record Found";
        }
        return $reasonData;
    }

    public function FetchSubmissionIdentifier() {
        $connection = $this->connection;
        $reasonQuery = "SELECT * FROM SubmissionTypeIndicator";
        $reasonStatement = $connection->prepare($reasonQuery);
        $reasonStatement->execute();
        $submissionData = $reasonStatement->fetchAll(PDO::FETCH_ASSOC);
        return $submissionData;
    }

    public function getBroker($token = 0) {
        if ($token == 0) {
            $where = 1;
        } else {
            $where = "BROKER_CODE = '" . $token . "'";
        }
        $con = Propel::getConnection();
        $query = "SELECT BROKER_ID, BROKER_CODE AS code, BROKER_NAME AS name, BROKER_TYPE AS cat, SUBTYPE_OF_BROKER  FROM BROKER_DETAIL WHERE " . $where . ";";
        $stmt = $con->query($query);
        $result = $stmt->fetchAll(PDO::FETCH_ASSOC);
        return $result;
    }

    public function FetchOccupancyCode($occupancyId) {
        $connection = $this->connection;
        $productQuery = "SELECT * FROM OccupancyCode Where Id = '$occupancyId'";
        $productStatement = $connection->prepare($productQuery);
        $productStatement->execute();
        $occupanyData = $productStatement->fetchAll(PDO::FETCH_ASSOC);
        return $occupanyData;
    }

    public function FetchContactPerson($contactPersonId) {
        $connection = $this->connection;
        $productQuery = "SELECT (FirstName +' '+ LastName) As Name FROM ContactPersonDetails Where Id = '$contactPersonId'";
        $productStatement = $connection->prepare($productQuery);
        $productStatement->execute();
        $occupanyData = $productStatement->fetchAll(PDO::FETCH_ASSOC);
        return $occupanyData;
    }

    public function FetchSubmissionBoundDetails($submission) {
        $connection = $this->connection;
        $submissionBoundQuery = "SELECT * FROM  SubmissionBound WHERE SubmissionId = '" . $submission . "'";
        $submissionBoundStatement = $connection->prepare($submissionBoundQuery);
        $submissionBoundStatement->execute();
        $submissionBoundData = $submissionBoundStatement->fetchAll(PDO::FETCH_ASSOC);
        return $submissionBoundData;
    }

    public function FetchRetailBrokerDetails($submission) {
        $connection = $this->connection;
        $retailBrokerQuery = "SELECT * FROM  RetailBrokerDetails WHERE SubmissionId = '" . $submission . "'";
        $retailBrokerStatement = $connection->prepare($retailBrokerQuery);
        $retailBrokerStatement->execute();
        $$retailBrokerData = $retailBrokerStatement->fetchAll(PDO::FETCH_ASSOC);
        return $$retailBrokerData;
    }

    public function CheckSubmissionIdExistInSubmissionBound($submissionId) {
        $connection = $this->connection;
        $submissionBoundQuery = "SELECT * FROM  SubmissionBound WHERE SubmissionId = '" . $submissionId . "'";
        $submissionBoundStatement = $connection->prepare($submissionBoundQuery);
        $submissionBoundStatement->execute();
        $submissionBoundData = $submissionBoundStatement->fetchAll(PDO::FETCH_ASSOC);
        if ($submissionBoundData) {
            $policyNumberData = true;
        } else {
            $policyNumberData = false;
        }
        return $policyNumberData;
    }

    public function CheckSubmissionIdExistInRetailBrokerDetails($submissionId) {
        $connection = $this->connection;
        $retailBrokerQuery = "SELECT * FROM  RetailBrokerDetails WHERE SubmissionId = '" . $submissionId . "'";
        $retailBrokerStatement = $connection->prepare($retailBrokerQuery);
        $retailBrokerStatement->execute();
        $retailBrokerData = $retailBrokerStatement->fetchAll(PDO::FETCH_ASSOC);
        if ($retailBrokerData) {
            $retailData = true;
        } else {
            $retailData = false;
        }
        return $retailData;
    }

    function GetProjectCountry($countryId) {
        $con = Propel::getConnection();
        $qry = "SELECT InsuredCountry FROM country WHERE Id =" . $countryId;
        $stmt = $con->query($qry);
        $result = $stmt->fetchAll();
        $countryName = $result[0]['InsuredCountry'];
        return $countryName;
    }

    function GetProjectState($stateId) {
        $con = Propel::getConnection();
        $qry = "SELECT ProjectCode FROM State WHERE Id =" . $stateId;
        $stmt = $con->query($qry);
        $result = $stmt->fetchAll();
        $stateprojectCode = $result[0]['ProjectCode'];
        return $stateprojectCode;
    }

    public function GetProjectCity($cityId) {
        $con = Propel::getConnection();
        $qry = "SELECT City FROM City WHERE Id=" . $cityId;
        $stmt = $con->query($qry);
        $result = $stmt->fetchAll();
        $city = $result[0]['City'];
        return $city;
    }

    public function validateEditSubmission($postValues, $groupId) {
        $emptyColumn = array();
        if (!empty($postValues['newrenewal']) && $postValues['newrenewal'] != 0) {
            
        } else {
            $emptyColumn[] = 'NewRenewal';
        }
        $productlineVal = '';
        if (!empty($groupId) && $groupId == 58) {
            if (isset($postValues['editunderwriter']) && !empty($postValues['editunderwriter']) && $postValues['editunderwriter'] != 0) {
                $underwriter = $postValues['editunderwriter'];
            } else {
                $emptyColumn[] = 'Underwriter';
            }

            if (isset($postValues['productline_master']) && !empty($postValues['productline_master'])) {
                $productlineVal = $this->getLobName($postValues['productline_master']);
                $productline = trim($productlineVal[0]['LOBName']);
            } else {
                $emptyColumn[] = 'Product line';
            }
            if (isset($postValues['editproductlinesubtype_master']) && !empty($postValues['editproductlinesubtype_master']) && $postValues['editproductlinesubtype_master'] != 0) {
                $productlinesubtype = $postValues['editproductlinesubtype_master'];
            } else {
                $emptyColumn[] = 'product line subtype';
            }
            if (isset($postValues['editsection_master']) && !empty($postValues['editsection_master']) && $postValues['editsection_master'] != 0) {
                $section = $postValues['editsection_master'];
            } else {
                $emptyColumn[] = 'Section';
            }
            if (isset($postValues['editprofitcode_master']) && !empty($postValues['editprofitcode_master']) && $postValues['editprofitcode_master'] != 0) {
                $profitcode = $postValues['editprofitcode_master'];
            } else {
                $emptyColumn[] = 'Profitcode';
            }
            if (isset($postValues['editprimarystatus']) && !empty($postValues['editprimarystatus']) && $postValues['editprimarystatus'] != 0) {
                $primary_status = $postValues['editprimarystatus'];
            } else {
                $emptyColumn[] = 'Primary status';
            }
        } else {
            if (isset($postValues['editunderwriter']) && !empty($postValues['editunderwriter']) && $postValues['editunderwriter'] != 0) {
                $underwriter = $postValues['editunderwriter'];
            } else {
                $emptyColumn[] = 'Underwriter';
            }
            if (isset($postValues['editproductline']) && !empty($postValues['editproductline'])) {
                $productline = $postValues['editproductline'];
            } else {
                $emptyColumn[] = 'Product line';
            }
            if (isset($postValues['editproductlinesubtype']) && !empty($postValues['editproductlinesubtype']) && $postValues['editproductlinesubtype'] != 0) {
                $productlinesubtype = $postValues['editproductlinesubtype'];
            } else {
                $emptyColumn[] = 'product line subtype';
            }
            if (isset($postValues['editsection']) && !empty($postValues['editsection']) && $postValues['editsection'] != 0) {
                $section = $postValues['editsection'];
            } else {
                $emptyColumn[] = 'Section';
            }
            if (isset($postValues['editprofitcode']) && !empty($postValues['editprofitcode']) && $postValues['editprofitcode'] != 0) {
                $profitcode = $postValues['editprofitcode'];
            } else {
                $emptyColumn[] = 'Profitcode';
            }
            if (isset($postValues['editprimarystatus']) && !empty($postValues['editprimarystatus']) && $postValues['editprimarystatus'] != 0) {
                $primary_status = $postValues['editprimarystatus'];
            } else {
                $emptyColumn[] = 'Primary status';
            }
        }
        if (isset($postValues['effectiveDate']) && !empty($postValues['effectiveDate'])) {
            
        } else {
            $emptyColumn[] = 'Effective date';
        }
        if (isset($postValues['expityDate']) && !empty($postValues['expityDate'])) {
            
        } else {
            $emptyColumn[] = 'Expiry date';
        }
        if (isset($postValues['editcurrency']) && !empty($postValues['editcurrency']) && $postValues['editcurrency'] != 0) {
            
        } else {
            $emptyColumn[] = 'Currency';
        }
        if (isset($postValues['editexchangeRate']) && !empty($postValues['editexchangeRate'])) {
            
        } else {
            $emptyColumn[] = 'Exchange Rate';
        }
        if (isset($postValues['editexchangeRateDate']) && !empty($postValues['editexchangeRateDate'])) {
            
        } else {
            $emptyColumn[] = 'Exchange Rate Date';
        }

        if (isset($postValues['editinsuredname']) && !empty($postValues['editinsuredname'])) {
            
        } else {
            $emptyColumn[] = 'Insured Name';
        }
        if (isset($postValues['insured_name_status']) && $postValues['insured_name_status'] == 'Y') {
            if (isset($postValues['dbaName']) && !empty($postValues['dbaName'])) {
                
            } else {
                $emptyColumn[] = 'DBA Name';
            }
        }
        if (isset($postValues['editinsuredContactPerson']) && !empty($postValues['editinsuredContactPerson'])) {
            
        } else {
            $emptyColumn[] = 'Insured Contact Person';
        }
        if (isset($postValues['insured_country']) && !empty($postValues['insured_country'])) {
            
        } else {
            $emptyColumn[] = 'Insured Country';
        }
        if (isset($postValues['db_number']) && !empty($postValues['db_number'])) {
            
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
        if (isset($postValues['brokerCode']) && !empty($postValues['brokerCode'])) {
            
        } else {
            $emptyColumn[] = 'Broker Name';
        }
        if (isset($postValues['wholesaler_retailer']) && !empty($postValues['wholesaler_retailer'])) {
            if ($postValues['wholesaler_retailer'] == 'Wholesaler') {
                if (!empty($postValues['retailBrokerName'])) {
                    
                } else {
                    $emptyColumn[] = 'Retail broker name';
                }
                if (!empty($postValues['retailbrokerCountryCode'])) {
                    
                } else {
                    $emptyColumn[] = 'Retail country code';
                }
                if (!empty($postValues['retailbrokerStateCode'])) {
                    
                } else {
                    $emptyColumn[] = 'Retail state code';
                }
                if (!empty($postValues['retailbrokerCityCode'])) {
                    
                } else {
                    $emptyColumn[] = 'Retail city code';
                }
            }
        } else {
            $emptyColumn[] = 'Wholesaler or Retailer';
        }
        if (isset($postValues['brokerCountryCode']) && !empty($postValues['brokerCountryCode']) && $postValues['brokerCountryCode'] != 0) {
            
        } else {
            $emptyColumn[] = 'Broker Country';
        }
        if (isset($postValues['brokerStateCode']) && !empty($postValues['brokerStateCode']) && $postValues['brokerStateCode'] != 0) {
            
        } else {
            $emptyColumn[] = 'State code';
        }
        if (isset($postValues['brokerCityCode']) && !empty($postValues['brokerCityCode']) && $postValues['brokerCityCode'] != 0) {
            
        } else {
            $emptyColumn[] = 'City code';
        }
        if (isset($postValues['broker_contact_person']) && !empty($postValues['broker_contact_person'])) {
            
        } else {
            $emptyColumn[] = 'Broker contact person';
        }
        if (isset($postValues['broker_code']) && !empty($postValues['broker_code'])) {
            
        } else {
            $emptyColumn[] = 'Generated Broker Code';
        }
        if (!empty($primary_status) && $primary_status == 9) {
            if (isset($postValues['processdate']) && !empty($postValues['processdate'])) {
                
            } else {
                $emptyColumn[] = 'Process Date';
            }
            if (isset($postValues['gross_premium_text']) && !empty($postValues['gross_premium_text'])) {
                
            } else if (isset($postValues['gross_premium_select']) && !empty($postValues['gross_premium_select'])) {
                
            } else {
                $emptyColumn[] = 'Gross Premium';
            }
            if (isset($postValues['limit_text']) && !empty($postValues['limit_text'])) {
                
            } else if (isset($postValues['limit_select']) && !empty($postValues['limit_select'])) {
                
            } else {
                $emptyColumn[] = 'Limit in Local Currency';
            }

            if (!empty($productline) && ($productline == 'Exec & Prof' || $productline == 'Healthcare')) {
                if (isset($postValues['editLayerLimitLocalCurrency']) && !empty($postValues['editLayerLimitLocalCurrency'])) {
                    
                } else {
                    $emptyColumn[] = 'Layer of limit in Local Currency';
                }
                if (isset($postValues['editselfRetrntionLocalCurrency']) && !empty($postValues['editselfRetrntionLocalCurrency'])) {
                    
                } else {
                    $emptyColumn[] = 'Self Retention in Local currency';
                }
            }
            if (!empty($productline) && ($productline == 'Exec & Prof')) {
                if (isset($postValues['editPrecentageLayer']) && !empty($postValues['editPrecentageLayer'])) {
                    
                } else {
                    $emptyColumn[] = '% of layer';
                }
            }
            if (isset($postValues['attachment_point_text']) && !empty($postValues['attachment_point_text'])) {
                
            } else if (isset($postValues['attachment_point_select']) && !empty($postValues['attachment_point_select'])) {
                
            } else {
                $emptyColumn[] = 'Attachment point in Local Currency';
            }

            if (isset($postValues['editpolicyCommision']) && !empty($postValues['editpolicyCommision'])) {
                
            } else {
                $emptyColumn[] = 'Policy Commission';
            }
            if (isset($postValues['editPermiumLocalCurency']) && !empty($postValues['editPermiumLocalCurency'])) {
                
            } else {
                $emptyColumn[] = 'Net Premium in Local currency';
            }
            if (isset($postValues['yesBinddate']) && $postValues['yesBinddate'] == 'Y') {
                
            } else {
                if (isset($postValues['editbinddate']) && !empty($postValues['editbinddate'])) {
                    
                } else {
                    $emptyColumn[] = 'Bind Date';
                }
            }
            if (isset($postValues['editrenewable']) && !empty($postValues['editrenewable'])) {
                
            } else {
                $emptyColumn[] = 'Renewable';
            }
            if (isset($postValues['editdateofrenewal']) && !empty($postValues['editdateofrenewal'])) {
                
            } else {
                $emptyColumn[] = 'Date of Renewal';
            }
            if (!empty($productline) && ($productline == 'Casualty')) {
                if (isset($postValues['editpolicyName']) && !empty($postValues['editpolicyName'])) {
                    
                } else {
                    $emptyColumn[] = 'Policy Name';
                }
            }
            if (isset($postValues['editdirectAssumed']) && !empty($postValues['editdirectAssumed'])) {
                
            } else {
                $emptyColumn[] = 'Direct/Assumed';
            }
            if (isset($postValues['editadmitted']) && !empty($postValues['editadmitted'])) {
                
            } else {
                $emptyColumn[] = 'Admitted/Not-admitted';
            }
            if (isset($postValues['editcompanyPaper']) && !empty($postValues['editcompanyPaper'])) {
                
            } else {
                $emptyColumn[] = 'Company paper';
            }
            if (isset($postValues['editcompanyPaperNumber']) && !empty($postValues['editcompanyPaperNumber'])) {
                
            } else {
                $emptyColumn[] = 'Company paper number';
            }
            if (isset($postValues['editpolicyNumber']) && !empty($postValues['editpolicyNumber'])) {
                
            } else {
                $emptyColumn[] = 'Policy number';
            }
            if (isset($postValues['editcoverage']) && !empty($postValues['editcoverage'])) {
                
            } else {
                $emptyColumn[] = 'Coverage';
            }
            if (isset($postValues['editsuffix']) && !empty($postValues['editsuffix'])) {
                
            } else {
                $emptyColumn[] = 'Suffix';
            }
            if (isset($postValues['edittransactionNumber']) && !empty($postValues['edittransactionNumber'])) {
                
            } else {
                $emptyColumn[] = 'Transaction Number';
            }
            if (isset($postValues['editnaicCode']) && !empty($postValues['editnaicCode'])) {
                
            } else {
                $emptyColumn[] = 'NAIC Code';
            }
            if (isset($postValues['editnaicTitle']) && !empty($postValues['editnaicTitle'])) {
                
            } else {
                $emptyColumn[] = 'NAIC Title';
            }
            if (isset($postValues['editsicCode']) && !empty($postValues['editsicCode'])) {
                
            } else {
                $emptyColumn[] = 'SIC Code';
            }
            if (isset($postValues['editsicTitle']) && !empty($postValues['editsicTitle'])) {
                
            } else {
                $emptyColumn[] = 'SIC Title';
            }
            if (isset($postValues['editofrcReport']) && !empty($postValues['editofrcReport'])) {
                
            } else {
                $emptyColumn[] = 'OFRC Report';
            }
        }
        if (isset($postValues['yesBroker']) && $postValues['yesBroker'] == 'N') {
            if (isset($postValues['received_date_by_berkshire']) && !empty($postValues['received_date_by_berkshire'])) {
                
            } else {
                $emptyColumn[] = 'byBerkSi';
            }
        }
        if (isset($postValues['yesIndia']) && $postValues['yesIndia'] == 'N') {
            if (isset($postValues['received_date_by_india']) && !empty($postValues['received_date_by_india'])) {
                
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

    public static function GetClassInformation($companyString,$SubclassString) {
        if (!empty($companyString)) {
            $con = Propel::getConnection();
            $stmt = $con->query("Select ClassCode From ClassCodeDescription 
                                     WHERE ClassId = '" . trim($companyString) . "' and ClassCode like '".$SubclassString."%' ;");
            $result = $stmt->fetchAll(PDO::FETCH_ASSOC);
            return $result;
        }
    }

    public static function GetClassDescription($companyString) {
        if (!empty($companyString)) {
            $con = Propel::getConnection();
            $stmt = $con->query("Select ClassDescription From ClassCodeDescription 
                                     WHERE ClassCode = '" . trim($companyString) . "';");
            $result = $stmt->fetchAll(PDO::FETCH_ASSOC);
            return $result;
        }
    }

}
