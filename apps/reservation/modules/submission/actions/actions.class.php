<?php

/**
 * submission actions.
 *
 * @package    reservation
 * @subpackage submission
 * @author     Your name here
 * @version    SVN: $Id: actions.class.php 23810 2009-11-12 11:07:44Z Kris.Wallsmith $
 */
class submissionActions extends sfActions {

    /**
     * Executes index action
     *
     * @param sfRequest $request A request object
     */
    public function executeIndex(sfWebRequest $request) {
        $this->forward("submission", "List");
    }

    public function executeList(sfWebRequest $request) {
        $groupId = $this->getUser()->getAttribute('groupId');
        $userGroup = SubmissionDetails::getUserGroup($groupId);
        if ($userGroup == 'master') {
            $this->flag = 'master';
        } else {
            $this->flag = '';
        }
        $obj = new SubmissionDetails();
        $this->nerrenewal = $obj->getLookUpTypeList('NewRenewal');
        $this->branchOffice = SubmissionDetails::getBranchOffice();
        $this->status = $obj->getStatusList();
        $this->underWriter = SubmissionDetails::getUnderWriterName();
        $this->reasonCode = SubmissionDetails::getReasonCode();
        $this->lobData = $obj->getLobData();
        $this->lobSubTypeList = $obj->getLobSubTypeList();
        $this->sectionList = $obj->getSectionList();
        $this->profitCodeList = $obj->getProfitCodeList();
        $this->brokerList = $obj->getBrokerList();
        $this->brokerType = $obj->getLookUpTypeList('BrokerType');
        $this->brokerCity = $obj->getCityName();
        $this->cabCompanies = $obj->getLookUpTypeList('CabCompanies');
        $this->qcStatus = $obj->getLookUpTypeList('QCStatus');
        $this->numberofLocations = $obj->getLookUpTypeList('NubmerOfLocations');
        $this->occupancycode = $obj->getOccupancyCode();
        $this->currency = $obj->getLookUpTypeList('CurrencyType');
        $this->renewable = $obj->getLookUpTypeData('Renewable');
        $this->policyType = $obj->getLookUpTypeData('PolicyType');
        $this->directAssumed = $obj->getLookUpTypeData('DirectAssumed');
        $this->companyPaper = $obj->getLookUpTypeData('CompanyPaper');
        $this->admittedNotAdmitted = $obj->getLookUpTypeData('AdmittedNotAdmitted');
        $this->suffix = $obj->getLookUpTypeData('Suffix');
        $this->companyPaperNumber = $obj->getLookUpTypeData('CompanyPaperNumber');
        $this->coverage = $obj->GetCoverage();

        if ($request->getParameter('niddle')) {
            $this->lastSearchCriteria = $this->getUser()->getAttribute('searchNiddle');
        } else {
            $this->getUser()->setAttribute('searchNiddle', '');
        }

        if ($request->isMethod('GET')) {
            if ($request->getParameter('sort')) {
                $column = $request->getParameter('sort');
                $order = $request->getParameter('order');
            }
        }
        if ($request->isMethod('POST')) {
            $this->getUser()->setAttribute('searchNiddle', '');
            $SubmissionNumber = $request->getParameter('submissionNo', '');
            $InsuredName = $request->getParameter('InsuredName', '');
            $newRenewal = $request->getParameter('newrenewal', '');
            $SubmissionFromDate = $request->getParameter('SubmissionFromDate', '');
            $SubmissionToDate = $request->getParameter('SubmissionToDate', '');
            $Underwriter = $request->getParameter('Underwriter', '');
            $Branch = $request->getParameter('Branch', '');
            $Status = $request->getParameter('Status', '');
            $ReasonCode = $request->getParameter('reasoncode', '');
            $ProductLine = $request->getParameter('productline', '');
            $ProductLineSubType = $request->getParameter('productsubtype', '');
            $Section = $request->getParameter('section', '');
            $ProfitCode = $request->getParameter('profitcode', '');
            $BrokerName = $request->getParameter('brokername', '');
            $BrokerType = $request->getParameter('brokertype', '');
            $BrokerCity = $request->getParameter('brokercity', '');
            $CabCompanies = $request->getParameter('cabcompanies', '');
            $EffectiveFromDate = $request->getParameter('EffectiveFromDate', '');
            $EffectiveToDate = $request->getParameter('EffectiveToDate', '');
            $ExpirationFromDate = $request->getParameter('ExpirationFromDate', '');
            $ExpirationToDate = $request->getParameter('ExpirationToDate', '');
            $ProcessFromDate = $request->getParameter('ProcessFromDate', '');
            $ProcessToDate = $request->getParameter('ProcessToDate', '');
            $EditFromDate = $request->getParameter('EditFromDate', '');
            $EditToDate = $request->getParameter('EditToDate', '');
            $QcStatus = $request->getParameter('qcstatus', '');
            $DbaName = $request->getParameter('DbaName', '');
            $BrokerContactPerson = $request->getParameter('BrokerContactPerson', '');
            $NumberOfLocations = $request->getParameter('numberoflocations', '');
            $occupancyCode = $request->getParameter('occupancycode', '');
            $currency = $request->getParameter('currency', '');
            $renewable = $request->getParameter('renewable', '');
            $dateOfRenewalFromDate = $request->getParameter('DateofRenewalFromDate', '');
            $dateOfRenewalToDate = $request->getParameter('DateofRenewalToDate', '');
            $policyType = $request->getParameter('policyType', '');
            $directAssumed = $request->getParameter('directAssumed', '');
            $companyPaper = $request->getParameter('companyPaper', '');
            $companyPaperNumber = $request->getParameter('companyPaperNumber', '');
            $policyNumber = $request->getParameter('policyNumber', '');
            $suffix = $request->getParameter('suffix', '');
            $admittedNonAdmitted = $request->getParameter('admittedNonAdmitted', '');
            $coverage = $request->getParameter('coverage', '');

            $this->lastSearchCriteria = array(
                'SubmissionNo' => $SubmissionNumber,
                'InsuredName' => $InsuredName,
                'NewRenewal' => $newRenewal,
                'SubmissionFromDate' => $SubmissionFromDate,
                'SubmissionToDate' => $SubmissionToDate,
                'UnderwriterName' => $Underwriter,
                'Branch' => $Branch,
                'Status' => $Status,
                'ReasonCode' => $ReasonCode,
                'ProductLine' => $ProductLine,
                'ProductLineSubType' => $ProductLineSubType,
                'Section' => $Section,
                'ProfitCode' => $ProfitCode,
                'BrokerName' => $BrokerName,
                'BrokerType' => $BrokerType,
                'BrokerCity' => $BrokerCity,
                'CabCompanies' => $CabCompanies,
                'EffectiveFromDate' => $EffectiveFromDate,
                'EffectiveToDate' => $EffectiveToDate,
                'ExpirationFromDate' => $ExpirationFromDate,
                'ExpirationToDate' => $ExpirationToDate,
                'ProcessFromDate' => $ProcessFromDate,
                'ProcessToDate' => $ProcessToDate,
                'EditFromDate' => $EditFromDate,
                'EditToDate' => $EditToDate,
                'QcStatus' => $QcStatus,
                'DbaName' => $DbaName,
                'BrokerContactPerson' => $BrokerContactPerson,
                'NumberOfLocations' => $NumberOfLocations,
                'OccupancyCode' => $occupancyCode,
                'Currency' => $currency,
                'Renewable' => $renewable,
                'DateOfRenewalFromDate' => $dateOfRenewalFromDate,
                'DateOfRenewalToDate' => $dateOfRenewalToDate,
                'PolicyType' => $policyType,
                'DirectAssumed' => $directAssumed,
                'CompanyPaper' => $companyPaper,
                'CompanyPaperNumber' => $companyPaperNumber,
                'PolicyNumber' => $policyNumber,
                'Suffix' => $suffix,
                'AdmittedNonAdmitted' => $admittedNonAdmitted,
                'Coverage' => $coverage
            );

            $this->getUser()->setAttribute('searchNiddle', $this->lastSearchCriteria);
        }

        //Saving this last search criteria
        $criteria = SubmissionDetails::getSearchCriteria($this->lastSearchCriteria, $column, $order);
        $this->numberofResults = SubmissionSearchPeer::doCount($criteria);
        $this->arrData = new sfPropelPager('SubmissionSearch', sfConfig::get('app_paginationlimit', 1));
        $this->arrData->setCriteria($criteria);
        $this->arrData->setPage($request->getParameter('page', 1));
        $this->arrData->init();
    }

    public function executeQCList($request) {

        $obj = new SubmissionDetails();
        $this->nerrenewal = $obj->getLookUpTypeList('NewRenewal');
        $this->branchOffice = SubmissionDetails::getBranchOffice();
        $this->status = $obj->getStatusForQcList();
        $this->underWriter = SubmissionDetails::getUnderWriterName();
        $this->reasonCode = SubmissionDetails::getReasonCode();
        $this->lobData = $obj->getLobData();
        $this->lobSubTypeList = $obj->getLobSubTypeList();
        $this->sectionList = $obj->getSectionList();
        $this->profitCodeList = $obj->getProfitCodeList();
        $this->brokerList = $obj->getBrokerList();
        $this->brokerType = $obj->getLookUpTypeList('BrokerType');
        $this->brokerCity = $obj->getCityName();
        $this->cabCompanies = $obj->getLookUpTypeList('CabCompanies');
        $this->numberofLocations = $obj->getLookUpTypeList('NubmerOfLocations');
        $this->occupancycode = $obj->getOccupancyCode();
        $this->currency = $obj->getLookUpTypeList('CurrencyType');
        $this->renewable = $obj->getLookUpTypeData('Renewable');
        $this->policyType = $obj->getLookUpTypeData('PolicyType');
        $this->directAssumed = $obj->getLookUpTypeData('DirectAssumed');
        $this->companyPaper = $obj->getLookUpTypeData('CompanyPaper');
        $this->admittedNotAdmitted = $obj->getLookUpTypeData('AdmittedNotAdmitted');
        $this->suffix = $obj->getLookUpTypeData('Suffix');
        $this->companyPaperNumber = $obj->getLookUpTypeData('CompanyPaperNumber');
        $this->coverage = $obj->GetCoverage();

        if ($request->getParameter('niddle')) {
            $this->lastSearchCriteria = $this->getUser()->getAttribute('searchNiddle');
        } else {
            $this->getUser()->setAttribute('searchNiddle', '');
        }

        if ($request->isMethod('GET')) {
            if ($request->getParameter('sort')) {
                $column = $request->getParameter('sort');
                $order = $request->getParameter('order');
            }
        }

        if ($request->isMethod('POST')) {
            $this->getUser()->setAttribute('searchNiddle', '');
            $SubmissionNumber = $request->getParameter('submissionNo', '');
            $InsuredName = $request->getParameter('InsuredName', '');
            $newRenewal = $request->getParameter('newrenewal', '');
            $SubmissionFromDate = $request->getParameter('SubmissionFromDate', '');
            $SubmissionToDate = $request->getParameter('SubmissionToDate', '');
            $Underwriter = $request->getParameter('Underwriter', '');
            $Branch = $request->getParameter('Branch', '');
            $Status = $request->getParameter('Status', '');
            $ReasonCode = $request->getParameter('reasoncode', '');
            $ProductLine = $request->getParameter('productline', '');
            $ProductLineSubType = $request->getParameter('productsubtype', '');
            $Section = $request->getParameter('section', '');
            $ProfitCode = $request->getParameter('profitcode', '');
            $BrokerName = $request->getParameter('brokername', '');
            $BrokerType = $request->getParameter('brokertype', '');
            $BrokerCity = $request->getParameter('brokercity', '');
            $CabCompanies = $request->getParameter('cabcompanies', '');
            $EffectiveFromDate = $request->getParameter('EffectiveFromDate', '');
            $EffectiveToDate = $request->getParameter('EffectiveToDate', '');
            $ExpirationFromDate = $request->getParameter('ExpirationFromDate', '');
            $ExpirationToDate = $request->getParameter('ExpirationToDate', '');
            $ProcessFromDate = $request->getParameter('ProcessFromDate', '');
            $ProcessToDate = $request->getParameter('ProcessToDate', '');
            $EditFromDate = $request->getParameter('EditFromDate', '');
            $EditToDate = $request->getParameter('EditToDate', '');
            $EditDbaName = $request->getParameter('EditDbaName', '');
            $BrokerContactPerson = $request->getParameter('BrokerContactPerson', '');
            $NumberOfLocations = $request->getParameter('numberoflocations', '');
            $occupancyCode = $request->getParameter('occupancycode', '');
            $currency = $request->getParameter('currency', '');
            $renewable = $request->getParameter('renewable', '');
            $dateOfRenewalFromDate = $request->getParameter('DateofRenewalFromDate', '');
            $dateOfRenewalToDate = $request->getParameter('DateofRenewalToDate', '');
            $policyType = $request->getParameter('policyType', '');
            $directAssumed = $request->getParameter('directAssumed', '');
            $companyPaper = $request->getParameter('companyPaper', '');
            $companyPaperNumber = $request->getParameter('companyPaperNumber', '');
            $policyNumber = $request->getParameter('policyNumber', '');
            $suffix = $request->getParameter('suffix', '');
            $admittedNonAdmitted = $request->getParameter('admittedNonAdmitted', '');
            $coverage = $request->getParameter('coverage', '');

            $this->lastSearchCriteria = array(
                'SubmissionNo' => $SubmissionNumber,
                'InsuredName' => $InsuredName,
                'NewRenewal' => $newRenewal,
                'SubmissionFromDate' => $SubmissionFromDate,
                'SubmissionToDate' => $SubmissionToDate,
                'Underwriter' => $Underwriter,
                'Branch' => $Branch,
                'Status' => $Status,
                'ReasonCode' => $ReasonCode,
                'ProductLine' => $ProductLine,
                'ProductLineSubType' => $ProductLineSubType,
                'Section' => $Section,
                'ProfitCode' => $ProfitCode,
                'BrokerName' => $BrokerName,
                'BrokerType' => $BrokerType,
                'BrokerCity' => $BrokerCity,
                'CabCompanies' => $CabCompanies,
                'EffectiveFromDate' => $EffectiveFromDate,
                'EffectiveToDate' => $EffectiveToDate,
                'ExpirationFromDate' => $ExpirationFromDate,
                'ExpirationToDate' => $ExpirationToDate,
                'ProcessFromDate' => $ProcessFromDate,
                'ProcessToDate' => $ProcessToDate,
                'EditFromDate' => $EditFromDate,
                'EditToDate' => $EditToDate,
                'EditDbaName' => $EditDbaName,
                'BrokerContactPerson' => $BrokerContactPerson,
                'NumberOfLocations' => $NumberOfLocations,
                'OccupancyCode' => $occupancyCode,
                'Currency' => $currency,
                'Renewable' => $renewable,
                'DateOfRenewalFromDate' => $dateOfRenewalFromDate,
                'DateOfRenewalToDate' => $dateOfRenewalToDate,
                'PolicyType' => $policyType,
                'DirectAssumed' => $directAssumed,
                'CompanyPaper' => $companyPaper,
                'CompanyPaperNumber' => $companyPaperNumber,
                'PolicyNumber' => $policyNumber,
                'Suffix' => $suffix,
                'AdmittedNonAdmitted' => $admittedNonAdmitted,
                'Coverage' => $coverage
            );
            $this->getUser()->setAttribute('searchNiddle', $this->lastSearchCriteria);
        }

        //Saving this last search criteria
        $criteria = SubmissionDetails::getQcSearchCriteria($this->lastSearchCriteria, $column, $order);
        $this->numberofResults = QcSearchPeer::doCount($criteria);
        $this->arrData = new sfPropelPager('QcSearch', sfConfig::get('app_paginationlimit', 1));
        $this->arrData->setCriteria($criteria);
        $this->arrData->setPage($request->getParameter('page', 1));
        $this->arrData->init();
    }

    public function executeExportFile() {
        $niddle = $this->getUser()->getAttribute('searchNiddle');
        $objSubmission = new Export();
        $objSubmission->exportCSV($niddle);
        exit;
    }

    public function executeExportQCFile() {
        $niddle = $this->getUser()->getAttribute('searchNiddle');
        $objSubmission = new Export();
        $objSubmission->exportQCCSV($niddle);
        exit;
    }

    public function executeCreateSubmission(sfWebRequest $request) {
        $userId = $this->getUser()->getAttribute('id');
        $groupId = $this->getUser()->getAttribute('groupId');
        $this->userGroup = SubmissionDetails::getUserGroup($groupId);
        $postValues = $request->getPostParameters();

        $obj = new SubmissionDetails();
        $this->productLine = $obj->GetLobForMAster();
        $this->curerntStatus = $obj->GetStatusForMAster();
        $this->branch = $obj->GetBranchForMAster();
        $this->reasonCode = SubmissionDetails::getReasonCode();
        $this->countryName = $obj->getCountryName();
        $this->retailBrokerCountryName = $obj->getRetailBrokerCountryName();
        $this->occupancyCode = $obj->getOccupancyCode();
        $this->numberOfLocations = $obj->getLookUpTypeData('NubmerOfLocations');
        $this->newRenew = $obj->getLookUpTypeData('NewRenewal');
        $this->underwritterName = $obj->getUnderWriterName();
        $this->cabCompanies = $obj->getLookUpTypeData('CabCompanies');
        $this->bidSituation = $obj->getLookUpTypeData('Bidsituation');
        $this->currencyType = $obj->getLookUpTypeData('CurrencyType');
        $this->renewable = $obj->getLookUpTypeData('Renewable');
        $this->policyType = $obj->getLookUpTypeData('PolicyType');
        $this->directAssumed = $obj->getLookUpTypeData('DirectAssumed');
        $this->companyPaper = $obj->getLookUpTypeData('CompanyPaper');
        $this->admittedNotAdmitted = $obj->getLookUpTypeData('AdmittedNotAdmitted');
        $this->suffix = $obj->getLookUpTypeData('Suffix');
        $this->companyPaperNumber = $obj->getLookUpTypeData('CompanyPaperNumber');
        $this->ofrcReport = $obj->getLookUpTypeData('OFRCAdverseReport');
        $this->brokerDetails = $obj->getBroker();
        $this->submissionIdentifier = $obj->getSubmissionIdentifier();
        if ($request->getPostParameters()) {
            $validateSubmission = $obj->validateSubmission($postValues, $groupId);
            $emptyValues = '';
            if (count($validateSubmission) >= 1) {
                $emptyValues = implode(", ", $validateSubmission);
            }
            if (empty($emptyValues)) {
                $obj->submitData($postValues, $userId, $this->userGroup);
                $this->redirect('submission/List');
            } else {
                $this->emptyValues = $emptyValues;
                //$this->redirect('submission/createSubmission');
            }
        }
    }

    public function executeEditSubmission(sfWebRequest $request) {
        $userId = $this->getUser()->getAttribute('id');
        $groupId = $this->getUser()->getAttribute('groupId');
        $this->userGroup = SubmissionDetails::getUserGroup($groupId);
        $this->submissionId = 0;
        $postedValues = $request->getPostParameters();

        $editObj = new EditSubmissionDetails();
        $objSubmision = new SubmissionDetails();

        $this->occupancyCode = $objSubmision->getOccupancyCode();
        $this->productLine = $objSubmision->GetLobForMAster();
        $this->country = $objSubmision->getCountryName();
        $this->retailBrokerCountryName = $objSubmision->getRetailBrokerCountryName();
        $this->brokerCountry = $objSubmision->getBrokerCountryName();
        $this->branch = $objSubmision->GetBranchForMAster();
        $this->currencyType = $objSubmision->getLookUpTypeData('CurrencyType');
        $this->renewable = $objSubmision->getLookUpTypeData('Renewable');
        $this->policyType = $objSubmision->getLookUpTypeData('PolicyType');
        $this->directAssumed = $objSubmision->getLookUpTypeData('DirectAssumed');
        $this->companyPaper = $objSubmision->getLookUpTypeData('CompanyPaper');
        $this->admittedNotAdmitted = $objSubmision->getLookUpTypeData('AdmittedNotAdmitted');
        $this->suffix = $objSubmision->getLookUpTypeData('Suffix');
        $this->companyPaperNumber = $objSubmision->getLookUpTypeData('CompanyPaperNumber');
        $this->ofrcReport = $objSubmision->getLookUpTypeData('OFRCAdverseReport');
        $this->underwriters = $objSubmision->getUnderWriterName();
        $this->status = $editObj->FetchCurrentStatus();
        $this->submissionId = $request->getParameter('submission');
        $this->classname = $objSubmision->getLookUpTypeData('classname');

        $submissionId = $request->getParameter('submission');
        // Update submission details starts
        if ($request->hasParameter('submission') && $request->getPostParameters()) {
            $validateSubmission = $editObj->validateEditSubmission($postedValues, $groupId);
            $emptyValues = '';
            if (count($validateSubmission) >= 1) {
                $emptyValues = implode(", ", $validateSubmission);
            }

            if (!empty($emptyValues)) {
                $this->emptyValues = $emptyValues;
            } else {
                $oldSubmissionRow = $editObj->GetSubmissionDetails($submissionId);
                $oldSubmissionData = $oldSubmissionRow[0];
                $submissionHistoryId = History::SaveSubmissionHistory($oldSubmissionData, $postedValues, $userId, $submissionId, $this->userGroup);
                $updateSubmissionDetails = $editObj->UpdateSubmissionDetails($postedValues, $userId, $submissionId, $this->userGroup);
                $this->redirect('submission/List');
            }
        }
        // Fetch submission starts
        $submission = $request->getParameter('submission');
        if ($request->hasParameter('submission')) {
            $submissionRecord = $editObj->FetchSubmissionDetails($submission);
            $this->iscCode = $objSubmision->getISOCode($submissionRecord[0]['ProfitCodeId']);
            $submissionRow = array_change_key_case($submissionRecord);
            $this->brokerDetails = $objSubmision->getBroker();
            if (count($submissionRow) > 0) {
                $submissionRecord[0]['EffectiveDate'] = date('m/d/Y', strtotime($submissionRecord[0]['EffectiveDate']));
                $submissionRecord[0]['ExpiryDate'] = date('m/d/Y', strtotime($submissionRecord[0]['ExpiryDate']));
                if (!empty($submissionRecord[0]['BerkSIDateFromBroker'])) {
                    $submissionRecord[0]['byBerkSi'] = date('m/d/Y H:i', strtotime($submissionRecord[0]['BerkSIDateFromBroker']));
                } else {
                    $submissionRecord[0]['byBerkSi'] = '';
                }
                if (!empty($submissionRecord[0]['BerkSiDateFromIndia'])) {
                    $submissionRecord[0]['byIndia'] = date('m/d/Y', strtotime($submissionRecord[0]['BerkSiDateFromIndia']));
                } else {
                    $submissionRecord[0]['byIndia'] = '';
                }
                $this->submissionRow = $submissionRecord[0];
                $brokerDetailArr = explode('-', $submissionRecord[0]['BrokerCode']);
                $brokerCode = $brokerDetailArr[0];
                if ($brokerCode == '1') {
                    $this->brokerCode = '-1';
                } else if ($brokerCode == '2') {
                    $this->brokerCode = '-2';
                } else {
                    $this->brokerCode = $brokerDetailArr[0];
                }
                $this->brokerCountryCode1 = isset($brokerDetailArr[1]) && $brokerDetailArr[1] ? $brokerDetailArr[1] : '';
                $this->brokerCountryCode = $objSubmision->getCountryId($this->brokerCountryCode1);
                $this->brokerStateCode = $objSubmision->getStateId($brokerDetailArr[2], $this->brokerCountryCode);
                $this->brokerCityCode = $objSubmision->getCityId($brokerDetailArr[3], $this->brokerStateCode);
                $this->brokerId = $objSubmision->GetBrokerWiseId($brokerCode, $this->brokerCityCode, $this->brokerStateCode);
            }
            $submissionProductRow = $editObj->getLobName($submissionRecord[0]['LobId']);
            if (count($submissionProductRow) > 0) {
                $this->submissionProduct = $submissionProductRow[0];
            }
            $submissionAddressRow = $editObj->FetchAddressDetails($submissionRecord[0]['AlternativeAddressId']);
            if (count($submissionAddressRow) > 0) {
                $this->submissionAddressSubmission = $submissionAddressRow[0];
            }
            $brokerTypeRow = $editObj->FetchBrokerType($this->brokerCode);
            if (count($brokerTypeRow) > 0) {
                $this->brokerType = $brokerTypeRow[0];
            }
            $insuredRows = $editObj->FetchInsuredDetails();
            if (count($insuredRows) > 0) {
                $this->insuredDetails = $insuredRows;
                $insuredDetails = $editObj->FetchInsuredDetails($this->submissionRow['InsuredId']);
                $this->insuredName = trim($insuredDetails[0]['InsuredName']);
                $this->insuredaddress = $insuredDetails[0]['Address'];
                $this->insuredCountry = $insuredDetails[0]['InsuredCountry'];
                $this->insuredState = $insuredDetails[0]['StateName'];
                $this->insuredCity = $insuredDetails[0]['City'];
                $this->insuredZipcode = $insuredDetails[0]['Zip'];
                $this->insuredDBNumber = $insuredDetails[0]['DBNumber'];
            }
            if (!empty($this->submissionRow['InsuredId'])) {
                $insuredParty = 98;
                $this->insuredContactPersonRows = $objSubmision->ContactPerson($this->submissionRow['InsuredId'], $insuredParty);
            }
            if (!empty($this->submissionRow['InsuredContactPersonId'])) {
                $insuredContactPersonDetailsRows = $editObj->FetchInsuredContactPersonDetails($this->submissionRow['InsuredContactPersonId']);
                if (count($insuredContactPersonDetailsRows) > 0) {
                    $this->insuredContactPersonDetails = $insuredContactPersonDetailsRows[0];
                }
            }
            if (!empty($this->brokerId)) {
                $insuredParty = 97;
                $this->brokerContactPersonRows = $objSubmision->ContactPerson($this->brokerId, $insuredParty);
            }
            $brokerContactPersonDetailsRows = $editObj->FetchBrokerContactPersonDetails($this->submissionRow['BrokerContactPersonId']);
            if (count($brokerContactPersonDetailsRows) > 0) {
                $this->brokerContactPersonDetails = $brokerContactPersonDetailsRows[0];
            }
            $businessDependentRows = $editObj->FetchBusinessDependentDetails($this->submissionRow['BusinessDependentDetailId']);
            if (count($businessDependentRows) > 0) {
                $this->businessDetails = $businessDependentRows;
            }
            $bidSituationRow = $objSubmision->getLookUpTypeData('Bidsituation');
            if (count($bidSituationRow) > 0) {
                $this->bidSituation = $bidSituationRow;
            }
            $newRenewRow = $objSubmision->getLookUpTypeList('NewRenewal');
            if (count($newRenewRow > 0)) {
                $this->nerrenewal = $newRenewRow;
            }
            $cabCompaniesRow = $objSubmision->getLookUpTypeList('CabCompanies');
            if (count($cabCompaniesRow > 0)) {
                $this->cabCompanies = $cabCompaniesRow;
            }
            $numberOfLocationsRow = $objSubmision->getLookUpTypeList('NubmerOfLocations');
            if (count($numberOfLocationsRow > 0)) {
                $this->numberOfLocations = $numberOfLocationsRow;
            }
            $statusDependentRows = $editObj->FetchBusinessStatusDetails($submissionRecord[0]['StatusDependentDetailsId']);
            if (count($statusDependentRows) > 0) {
                $this->statusDetails = $statusDependentRows[0];
            }
            $submissionBranchRows = $editObj->FetchSubmissionBranch($submissionRow[0]['BranchId']);
            if (count($submissionBranchRows) > 0) {
                $this->branches = $submissionBranchRows[0]['Branch'];
            }

            $dataRecorderTypeRows = $editObj->FetchDataRecorderType($submissionRow[0]['DataRecorderMetaDataId']);
            if (count($dataRecorderTypeRows) > 0) {
                $this->DataRecorder = $dataRecorderTypeRows[0];
            }
            $submissionIdentifier = $editObj->FetchSubmissionIdentifier();
            if (count($submissionIdentifier) > 0) {
                $this->submissionIdetifier = $submissionIdentifier;
            }
            $remarkRow = $editObj->FetchHistoryDetails($submissionId);
            if (count($remarkRow) > 0) {
                $this->remarks = $remarkRow;
            }
            $boundData = $editObj->FetchSubmissionBoundDetails($submissionId);
            if ($boundData[0]['BindDate'] == 'Dec 31 1969 12:00:00:000AM') {
                $boundData[0]['BindDate'] = '';
            }
            if (count($boundData) > 0) {
                $this->boundData = $boundData[0];
            }
            $retailBrokerData = $editObj->FetchRetailBrokerDetails($submissionId);
            if (count($retailBrokerData) > 0) {
                $this->retailBrokerDetails = $retailBrokerData[0];
            }
        }
    }

    public function executeSubmissionHistory(sfWebRequest $request) {
        $obj = new SubmissionDetails();
        $historyObj = new History();
        $this->submissionId = 0;
        $this->submissionId = $request->getParameter('submission');
        if ($request->hasParameter('submission')) {
            $con = Propel::getConnection();
            $qry = "SELECT * FROM SubmissionHistory WHERE SubmissionId = '$this->submissionId' order by Id DESC";
            $stmt = $con->query($qry);
            $result = $stmt->fetchAll(PDO::FETCH_ASSOC);
            $this->finalResult = $historyObj->FormatHistoryData($result);
            foreach ($this->finalResult as $value) {
                foreach ($value as $data) {
                    $users[] = $obj->getUserName($data['ModifiedBy']);
                }
            }
            $this->user = $users;
            $dataqry = "SELECT DR.* FROM Submission AS S LEFT JOIN DataRecorderMetaData AS DR ON S.DataRecorderMetaDataId = DR.Id  WHERE S.Id = '$this->submissionId'";
            $stmt1 = $con->query($dataqry);
            $this->dataResult = $stmt1->fetchAll();
        }
    }

    public function executeViewHistory(sfWebRequest $request) {
        $obj = new SubmissionDetails();
        $historyObj = new History();
        $this->submissionId = 0;
        $this->submissionId = $request->getParameter('submission');
        if ($request->hasParameter('submission')) {
            $con = Propel::getConnection();
            $qry = "SELECT * FROM SubmissionHistory WHERE SubmissionId = '$this->submissionId' order by Id DESC";
            $stmt = $con->query($qry);
            $result = $stmt->fetchAll(PDO::FETCH_ASSOC);
            $this->finalResult = $historyObj->FormatHistoryData($result);
            foreach ($this->finalResult as $value) {
                foreach ($value as $data) {
                    $users[] = $obj->getUserName($data['ModifiedBy']);
                }
            }
            $this->user = $users;
            $dataqry = "SELECT DR.* FROM Submission AS S LEFT JOIN DataRecorderMetaData AS DR ON S.DataRecorderMetaDataId = DR.Id  WHERE S.Id = '$this->submissionId'";
            $stmt1 = $con->query($dataqry);
            $this->dataResult = $stmt1->fetchAll();
        }
    }

    public function executeGetState(sfWebRequest $request) {

        $groupId = $this->getUser()->getAttribute('groupId');
        $userGroup = SubmissionDetails::getUserGroup($groupId);
        $arrStateData = json_decode(SubmissionDetails::getPostContent());
        $countryId = $arrStateData->body->data;
        $objSubmission = new SubmissionDetails();
        if ($userGroup == 'master') {
            $data = $objSubmission->getStateName();
        } else {
            $data = $objSubmission->getStateName($countryId);
        }
        echo json_encode($data);
        exit;
    }

    public function executeGetCity(sfWebRequest $request) {
        $groupId = $this->getUser()->getAttribute('groupId');
        $userGroup = SubmissionDetails::getUserGroup($groupId);
        $arrCityData = json_decode(SubmissionDetails::getPostContent());
        $StateId = $arrCityData->body->data;
        $objSubmission = new SubmissionDetails();
        if ($userGroup == 'master') {
            $data = $objSubmission->getCityName();
        } else {
            $data = $objSubmission->getCityName($StateId);
        }
        echo json_encode($data);
        exit;
    }

    public function executeGetProjectState(sfWebRequest $request) {
        $groupId = $this->getUser()->getAttribute('groupId');
        $userGroup = SubmissionDetails::getUserGroup($groupId);
        $arrStateData = json_decode(SubmissionDetails::getPostContent());
        $countryId = $arrStateData->body->data;
        $objSubmission = new SubmissionDetails();
        if ($userGroup == 'master') {
            $data = $objSubmission->getProjectStateName();
        } else {
            $data = $objSubmission->getProjectStateName($countryId);
        }
        echo json_encode($data);
        exit;
    }

    public function executeGetSubmissionTypeData(sfWebRequest $request) {
        $jsonObj = json_decode(SubmissionDetails::getPostContent());
        $groupId = $this->getUser()->getAttribute('groupId');
        $userGroup = SubmissionDetails::getUserGroup($groupId);

        $submissionType = $jsonObj->body->data;
        $objSubmission = new SubmissionDetails();
        $brokerName = $objSubmission->getBroker();
        $productLineSubTypeName = $objSubmission->getProductLineSubTypeName($submissionType);
        $data = array('brokerDetail' => $brokerName, 'productlinesubtypeDetail' => $productLineSubTypeName);
        echo json_encode($data);
        exit;
    }

    public function executeGetSubmissionTypeDataDetails(sfWebRequest $request) {
        $jsonObj = json_decode(SubmissionDetails::getPostContent());
        $groupId = $this->getUser()->getAttribute('groupId');
        $userGroup = SubmissionDetails::getUserGroup($groupId);

        $underWriterId = $jsonObj->body->data;
        $objSubmission = new SubmissionDetails();
        $underWriterName = $objSubmission->getUnderWriterName($underWriterId);

        $lobData = $objSubmission->getLobData($underWriterName);
        $lobSubTypeData = $objSubmission->getLobSubTypeData($underWriterName);
        $data = array('lobDetail' => $lobData, 'lobsubtypeDetail' => $lobSubTypeData);
        echo json_encode($data);
        exit;
    }

    public function executeGetSectionCodeDetails(sfWebRequest $request) {
        $jsonObj = json_decode(SubmissionDetails::getPostContent());
        $productDetails = $jsonObj->body->data;
        $objSubmission = new SubmissionDetails();
        if (isset($jsonObj->body->data->sectionCodeHidden)) {
            $sectionCodeDetails = $objSubmission->getSectionCodeNameHidden($productDetails);
        } else {
            $sectionCodeDetails = $objSubmission->getSectionCodeName($productDetails);
        }
        echo json_encode($sectionCodeDetails);
        exit;
    }

    public function executeGetProfitCodeDetails(sfWebRequest $request) {
        $jsonObj = json_decode(SubmissionDetails::getPostContent());
        $sectionCodeId = $jsonObj->body->data->sectionCodeID;
        $subTypeId = $jsonObj->body->data->subTypeID;
        $lobId = $jsonObj->body->data->TypeID;
        $hiddenProfitCode = $jsonObj->body->data->hiddenProfitCode;
        $objSubmission = new SubmissionDetails();
        if (isset($hiddenProfitCode)) {
            $profitCodeDetails = $objSubmission->getProfitCodeIdHidden($sectionCodeId, $subTypeId, $hiddenProfitCode, $lobId);
        } else {
            $profitCodeDetails = $objSubmission->getProfitCodeId($sectionCodeId, $subTypeId, $lobId);
        }
        echo json_encode($profitCodeDetails);
        exit;
    }

    public function executeGetProfitCodeDetailsBySubType(sfWebRequest $request) {
        $jsonObj = json_decode(SubmissionDetails::getPostContent());
        $subTypeId = $jsonObj->body->data;
        $objSubmission = new SubmissionDetails();
        $profitCodeDetails = $objSubmission->getProfitCodeIdBySubType($subTypeId);
        echo json_encode($profitCodeDetails);
        exit;
    }

    public function executeGetIsoCode(sfWebRequest $request) {
        $arrStateData = json_decode(SubmissionDetails::getPostContent());
        $profitCodeId = $arrStateData->body->data->profirCodeId;
        $objSubmission = new SubmissionDetails();
        $data = $objSubmission->getISOCode($profitCodeId);
        echo json_encode($data);
        exit;
    }

    public function executeGetUnderWritersBranchOffice(sfWebRequest $request) {
        $jsonObj = json_decode(SubmissionDetails::getPostContent());
        $underwriterID = $jsonObj->body->data;
        $objSubmission = new SubmissionDetails();
        $underwriterBranch = $objSubmission->getUnderwriterBranchOffice($underwriterID);
        echo json_encode($underwriterBranch);
        exit;
    }

    public function executeGetBrokerBranchOfficeName(sfWebRequest $request) {
        $jsonObj = json_decode(SubmissionDetails::getPostContent());
        $StateCode = $jsonObj->body->data->stateId;
        $brokerType = $jsonObj->body->data->Brokertype;
        $objSubmission = new SubmissionDetails();
        $data = $objSubmission->BrokerBranchOffice($StateCode, $brokerType);
        echo json_encode($data);
        exit;
    }

    public function executeGetBrokerSubType(sfWebRequest $request) {
        $arrStateData = json_decode(SubmissionDetails::getPostContent());
        $brokerCode = $arrStateData->body->data;
        $objSubmission = new SubmissionDetails();
        $data = $objSubmission->getBroker($brokerCode);
        echo json_encode($data);
        exit;
    }

    Public function executeGetInsuredName(sfWebRequest $request) {
        if (isset($_REQUEST['queryString'])) {
            $queryString1 = $request->getGetParameter('queryString');
            $queryString = str_replace("'", "''", $queryString1);
            $objSubmision = new SubmissionDetails();
            $result = $objSubmision->getInsuredSuggestionList($queryString);
            return $result;
        }
    }

    Public function executeGetInsuredDetails(sfWebRequest $request) {
        if (isset($_REQUEST['queryString'])) {
            $queryString = $request->getGetParameter('queryString');
            $objSubmision = new SubmissionDetails();
            $result = $objSubmision->getInsuredDetails($queryString);
            echo json_encode($result);
            exit;
        }
    }

    Public function executeGetAmendmentInsuredName(sfWebRequest $request) {
        if (isset($_REQUEST['queryString'])) {
            $newString = explode('|', $request->getGetParameter('queryString'));
            $queryString = $newString[0];
            $insuredId = $newString[1];
            $objSubmision = new SubmissionDetails();
            $result = $objSubmision->getAmendmentInsuredSuggestionList($queryString, $insuredId);
            return $result;
        }
    }

    Public function executeSaveInsuredName(sfWebRequest $request) {
        $insuredName = $_REQUEST['insuredname'];
        $objSubmision = new SubmissionDetails();
        $result = $objSubmision->saveInsuredName($insuredName);
        echo $result;
        exit;
    }

    public function executeViewSubmission($request) {
        $this->submissionId = $request->getParameter('submission');
        $obj = new ViewSubmissionDetails();
        $this->result = $obj->ViewSubmissionDetail($this->submissionId);
    }

    public function executeQCView($request) {
        $this->submissionId = $request->getParameter('submission');
        $obj = new ViewSubmissionDetails();
        $this->result = $obj->ViewSubmissionDetail($this->submissionId);
    }

    public function executeQCUpdate($request) {
        $userId = $this->getUser()->getAttribute('id');
        $submissionId = $request->getParameter('submission');
        $postValues = $request->getPostParameters();
        $obj = new ViewSubmissionDetails();
        $this->result = $obj->UpdateSubmissionDetail($postValues, $submissionId, $userId);
        $this->redirect('submission/QCList');
    }

    public function executeGetProductLine($request) {
        
    }

    public function executeGetBrokerCountry($request) {
        $arrStateData = json_decode(SubmissionDetails::getPostContent());
        $groupId = $this->getUser()->getAttribute('groupId');
        $userGroup = SubmissionDetails::getUserGroup($groupId);

        $brokerCode = $arrStateData->body->data;
        $objSubmision = new SubmissionDetails();
        if ($userGroup == 'master') {
            $result = $objSubmision->getBrokerCountryName();
        } else {
            $result = $objSubmision->getBrokerCountry($brokerCode);
        }
        echo json_encode($result);
        exit;
    }

    public function executeGetBrokerState($request) {
        $arrStateData = json_decode(SubmissionDetails::getPostContent());
        $groupId = $this->getUser()->getAttribute('groupId');
        $userGroup = SubmissionDetails::getUserGroup($groupId);

        $brokerCode = $arrStateData->body->BrokerCode;
        $country = $arrStateData->body->countryId;
        $objSubmision = new SubmissionDetails();
        if ($userGroup == 'master') {
            $result = $objSubmision->getStateNameForMaster();
        } else {
            $result = $objSubmision->getBrokerState($brokerCode, $country);
        }
        echo json_encode($result);
        exit;
    }

    public function executeGetRetailBrokerState($request) {
        $arrStateData = json_decode(SubmissionDetails::getPostContent());
        $groupId = $this->getUser()->getAttribute('groupId');
        $userGroup = SubmissionDetails::getUserGroup($groupId);

        $country = $arrStateData->body->data;
        $objSubmision = new SubmissionDetails();
        if ($userGroup == 'master') {
            $result = $objSubmision->getStateNameForMaster();
        } else {
            $result = $objSubmision->GetRetailBrokerStateName($country);
        }
        echo json_encode($result);
        exit;
    }

    public function executeGetRetailBrokerCity(sfWebRequest $request) {
        $groupId = $this->getUser()->getAttribute('groupId');
        $userGroup = SubmissionDetails::getUserGroup($groupId);
        $arrCityData = json_decode(SubmissionDetails::getPostContent());
        $StateId = $arrCityData->body->data;
        $objSubmission = new SubmissionDetails();
        if ($userGroup == 'master') {
            $data = $objSubmission->getCityName();
        } else {
            $data = $objSubmission->getRetailBrokerCityName($StateId);
        }
        echo json_encode($data);
        exit;
    }

    public function executeGetBrokerCity($request) {
        $arrStateData = json_decode(SubmissionDetails::getPostContent());
        $groupId = $this->getUser()->getAttribute('groupId');
        $userGroup = SubmissionDetails::getUserGroup($groupId);

        $brokerCode = $arrStateData->body->BrokerCode;
        $stateId = $arrStateData->body->stateId;
        $objSubmision = new SubmissionDetails();
        if ($userGroup == 'master') {
            $result = $objSubmision->getCityNameForMaster();
        } else {
            $result = $objSubmision->getBrokerCity($brokerCode, $stateId);
        }
        echo json_encode($result);
        exit;
    }

    public function executeSubmission($request) {
        
    }

    public function executeGetReasonCode($request) {
        $arrStateData = json_decode(SubmissionDetails::getPostContent());
        $statusId = $arrStateData->body->data;
        $newRenewal = $arrStateData->body->newrenewal;
        $objSubmision = new EditSubmissionDetails();
        $result = $objSubmision->FetchReasonCode($statusId, $newRenewal);
        echo json_encode($result);
        exit;
    }

    public function executeGetSubmissionTypeForMaster(sfWebRequest $request) {
        $jsonObj = json_decode(SubmissionDetails::getPostContent());
        $submissionType = $jsonObj->body->data;
        $objSubmission = new SubmissionDetails();
        $productLineSubTypeName = $objSubmission->GetLobSubTypeForMAster($submissionType);
        echo json_encode($productLineSubTypeName);
        exit;
    }

    public function executeGetSectionCodeForMaster(sfWebRequest $request) {
        $jsonObj = json_decode(SubmissionDetails::getPostContent());
        $submissionSubType = $jsonObj->body->data->subTypeId;
        $submissionType = $jsonObj->body->data->productLineId;
        $objSubmission = new SubmissionDetails();
        $productLineSubTypeName = $objSubmission->GetSectionForMAster($submissionSubType, $submissionType);
        echo json_encode($productLineSubTypeName);
        exit;
    }

    public function executeGetProfitCodeForMaster(sfWebRequest $request) {
        $jsonObj = json_decode(SubmissionDetails::getPostContent());
        $sectionCode = $jsonObj->body->data->sectionCodeID;
        $submissionTypeId = $jsonObj->body->data->TypeID;
        $submissionSubTypeId = $jsonObj->body->data->subTypeID;
        $objSubmission = new SubmissionDetails();
        $productLineSubTypeName = $objSubmission->GetProfitForMAster($sectionCode, $submissionTypeId, $submissionSubTypeId);
        echo json_encode($productLineSubTypeName);
        exit;
    }

    public function executeGetInsureContactPerson(sfWebRequest $request) {
        $jsonObj = json_decode(SubmissionDetails::getPostContent());
        $insuredId = $jsonObj->body->data->insuredId;
        $partyType = 98;
        $objSubmission = new SubmissionDetails();
        $data = $objSubmission->ContactPerson($insuredId, $partyType);
        echo json_encode($data);
        exit;
    }

    public function executeGetInsureContactPersonInformation(sfWebRequest $request) {
        $jsonObj = json_decode(SubmissionDetails::getPostContent());
        $contactPersonId = $jsonObj->body->data;
        $objSubmission = new SubmissionDetails();
        $data = $objSubmission->InsuredContactPersonInformation($contactPersonId);
        echo json_encode($data);
        exit;
    }

    public function executeGetBrokerContactPerson(sfWebRequest $request) {
        $objSubmission = new SubmissionDetails();
        $jsonObj = json_decode(SubmissionDetails::getPostContent());
        $brokerCode = $jsonObj->body->data->brokerId;
        $countryId = $jsonObj->body->data->countryId;
        $stateId = $jsonObj->body->data->stateId;
        $cityId = $jsonObj->body->data->cityId;
        if (($brokerCode == '-2' || $brokerCode == '-1') && $countryId == 6) {
            $stateId = 72;
            $cityId = 388;
        } elseif ($countryId == 6 && ($brokerCode != '-2' || $brokerCode != '-1')) {
            $stateId = 90;
            $cityId = 778;
        }
        $brokerId = $objSubmission->GetBrokerId($brokerCode);
        $brokerIdCityWise = $objSubmission->GetBrokerIdCityWise($brokerId, $countryId, $stateId, $cityId);
        if (!empty($brokerIdCityWise)) {
            $partyType = 97;
            $data = $objSubmission->ContactPerson($brokerIdCityWise, $partyType);
        }
        echo json_encode($data);
        exit;
    }

    public function executeGetCoverage(sfWebRequest $request) {
        $arrStateData = json_decode(SubmissionDetails::getPostContent());
        $groupId = $this->getUser()->getAttribute('groupId');
        $userGroup = SubmissionDetails::getUserGroup($groupId);

        $status = $arrStateData->body->data->status;
        if ($userGroup == 'master') {
            $productLine = $arrStateData->body->data->lobvalue;
        } else {
            $editObj = new SubmissionDetails();
            $productLineData = $editObj->getLobList($arrStateData->body->data->userLob);
            $productLine = $productLineData[0]['Id'];
        }
        $productLineSubType = $arrStateData->body->data->Lobsub;
        $objSubmission = new SubmissionDetails();
        $data = $objSubmission->FetchCoverage($status, $productLine, $productLineSubType);
        echo json_encode($data);
        exit;
    }

    public function executeCheckDuplicatePolicyNumber(sfWebRequest $request) {
        $arrCityData = json_decode(SubmissionDetails::getPostContent());
        $PolicyNumber = $arrCityData->body->data->policyNumber;
        $objSubmission = new SubmissionDetails();
        $data = $objSubmission->CheckForDuplicatePolicyNumber($PolicyNumber);
        echo json_encode($data);
        exit;
    }

    /* Functionality For Endersoment starts */
    /* Create Amendment Start */

    public function executeEndersomentSubmission(sfWebRequest $request) {
        $userId = $this->getUser()->getAttribute('id');
        $groupId = $this->getUser()->getAttribute('groupId');
        $this->userGroup = SubmissionDetails::getUserGroup($groupId);
        if ($this->userGroup == 'master') {
            $flag = 1;
        } else {
            $flag = 0;
        }
        $this->submissionId = 0;
        $postedValues = $request->getPostParameters();
        $postedValues['Flag'] = $flag;
        $editObj = new EditSubmissionDetails();
        $emendentObj = new SubmissionAmendment();
        $viewObj = new ViewSubmissionDetails();

        $this->data = $this->executeGetEndersomentMasterData();
        $submissionId = $request->getParameter('amendment');
        $this->submissionId = $submissionId;
        $amenEditObj = new EditSubmissionAmendment();
        $this->originalEffectiveDate = $amenEditObj->getSubmissionEffectiveDateBySubId($submissionId);
        // Update submission details starts
        if ($request->hasParameter('amendment') && $request->getPostParameters()) {
            $validateSubmission = $emendentObj->validateAmendmentSubmission($postedValues, $groupId, $this->userGroup);
            $emptyValues = '';
            if (count($validateSubmission) >= 1) {
                $emptyValues = implode(", ", $validateSubmission);
            }
            if (!empty($emptyValues)) {
                $this->emptyValues = $emptyValues;
            } else {
                $emendentObj->CreateAmendmentDetails($postedValues, $userId, $this->submissionId, $this->userGroup);
                $this->redirect('submission/List');
            }
        }
        /* Fetch Submission Data Starts */
        if ($request->hasParameter('amendment')) {
            $amendmentCondition = AmendmentCondition::GetAmendmentCount($submissionId);
            if ($amendmentCondition > 0) {
                $amendmentcnObj = new AmendmentCondition();
                $amendmentChildinfo = $amendmentcnObj->GetAmendmentInformation($submissionId);
                $amenEditObj = new EditSubmissionAmendment();
                $amendmentRowData = $amenEditObj->FetchAmendmentSubmissionDetails($amendmentChildinfo[0]['Id']);
                $this->fetchData = $amendmentcnObj->formatArray($amendmentRowData);
                $boundData = $amendmentcnObj->getAmendmentBound($amendmentRowData);
                if (count($boundData) > 0) {
                    if (trim($boundData[0]['IsBindDate']) == 'Y') {
                        $boundData[0]['IsBindDate'] = '1';
                    } else {
                        $boundData[0]['IsBindDate'] = '0';
                    }
                    $this->boundData = $boundData[0];
                    $this->suffix = $viewObj->getLookUpdata($boundData[0]['SuffixLookupId']);
                }
            } else {
                $this->fetchData = $this->executeFetchEndersomentData($this->submissionId);
                $boundData = $editObj->FetchSubmissionBoundDetails($this->submissionId);
                if (count($boundData) > 0) {
                    if (trim($boundData[0]['IsBindDate']) == 'Y') {
                        $boundData[0]['IsBindDate'] = '1';
                    } else {
                        $boundData[0]['IsBindDate'] = '0';
                    }
                    $this->boundData = $boundData[0];
                }
            }
        }
        /* Fetch Submission Data End */
    }

    private function executeGetEndersomentMasterData() {
        $objSubmision = new SubmissionDetails();
        $editObj = new EditSubmissionDetails();
        $amendmentObj = new SubmissionAmendment();
        $underwriters = $objSubmision->getUnderWriterName();
        $occupancyCode = $objSubmision->getOccupancyCode();
        $productLine = $objSubmision->GetLobForMAster();
        $country = $objSubmision->getCountryName();
        $retailBrokerCountryName = $objSubmision->getRetailBrokerCountryName();
        $brokerCountry = $objSubmision->getBrokerCountryName();
        $branch = $objSubmision->GetBranchForMAster();
        $currencyType = $objSubmision->getLookUpTypeData('CurrencyType');
        $renewable = $objSubmision->getLookUpTypeData('Renewable');
        $policyType = $objSubmision->getLookUpTypeData('PolicyType');
        $directAssumed = $objSubmision->getLookUpTypeData('DirectAssumed');
        $companyPaper = $objSubmision->getLookUpTypeData('CompanyPaper');
        $admittedNotAdmitted = $objSubmision->getLookUpTypeData('AdmittedNotAdmitted');
        $suffix = $objSubmision->getLookUpTypeData('Suffix');
        $companyPaperNumber = $objSubmision->getLookUpTypeData('CompanyPaperNumber');
        $ofrcReport = $objSubmision->getLookUpTypeData('OFRCAdverseReport');
        $bidSituation = $objSubmision->getLookUpTypeData('Bidsituation');
        $nerrenewal = $objSubmision->getLookUpTypeList('NewRenewal');
        $cabCompanies = $objSubmision->getLookUpTypeList('CabCompanies');
        $numberOfLocations = $objSubmision->getLookUpTypeList('NubmerOfLocations');
        $status = $amendmentObj->FetchCurrentStatusForEndersment();
        $submissionIdetifier = $editObj->FetchSubmissionIdentifier();
        $brokerDetails = $objSubmision->getBroker();
        $classname = $objSubmision->getLookUpTypeData('classname');

        $data = array('occupancyCode' => $occupancyCode, 'productLine' => $productLine, 'country' => $country, 'retailBrokerCountryName' => $retailBrokerCountryName,
            'brokerCountry' => $brokerCountry, 'branch' => $branch, 'currencyType' => $currencyType, 'renewable' => $renewable, 'policyType' => $policyType,
            'directAssumed' => $directAssumed, 'companyPaper' => $companyPaper, 'admittedNotAdmitted' => $admittedNotAdmitted, 'suffix' => $suffix,
            'companyPaperNumber' => $companyPaperNumber, 'ofrcReport' => $ofrcReport, 'underwriters' => $underwriters, 'nerrenewal' => $nerrenewal, 'bidSituation' => $bidSituation,
            'cabCompanies' => $cabCompanies, 'numberOfLocations' => $numberOfLocations, 'status' => $status, 'submissionIdetifier' => $submissionIdetifier, 'brokerDetails' => $brokerDetails,
            'classname' => $classname
        );
        return $data;
    }

    private function executeFetchEndersomentData($submissionId) {
        $objSubmisionDetails = new SubmissionDetails();
        $editObj = new EditSubmissionDetails();
        $submissionRecord = $editObj->FetchSubmissionDetails($submissionId);
        $submissionRow = array_change_key_case($submissionRecord);

        if (count($submissionRow) > 0) {
            $submissionRecord[0]['EffectiveDate'] = date('m/d/Y', strtotime($submissionRecord[0]['EffectiveDate']));
            $submissionRecord[0]['ExpiryDate'] = date('m/d/Y', strtotime($submissionRecord[0]['ExpiryDate']));
            if (!empty($submissionRecord[0]['BerkSIDateFromBroker'])) {
                $submissionRecord[0]['byBerkSi'] = date('m/d/Y H:i', strtotime($submissionRecord[0]['BerkSIDateFromBroker']));
            } else {
                $submissionRecord[0]['byBerkSi'] = '';
            }
            if (!empty($submissionRecord[0]['BerkSiDateFromIndia'])) {
                $submissionRecord[0]['byIndia'] = date('m/d/Y', strtotime($submissionRecord[0]['BerkSiDateFromIndia']));
            } else {
                $submissionRecord[0]['byIndia'] = '';
            }
            $brokerDetailArr = explode('-', $submissionRecord[0]['BrokerCode']);
            $brokerCode = $brokerDetailArr[0];
            if ($brokerCode == '1') {
                $brokerCode = '-1';
            } else if ($brokerCode == '2') {
                $brokerCode = '-2';
            } else {
                $brokerCode = $brokerDetailArr[0];
            }
            $this->brokerCountryCode1 = isset($brokerDetailArr[1]) && $brokerDetailArr[1] ? $brokerDetailArr[1] : '';
            $brokerCountryCode = $objSubmisionDetails->getCountryId($this->brokerCountryCode1);
            $brokerStateCode = $objSubmisionDetails->getStateId($brokerDetailArr[2], $brokerCountryCode);
            $brokerCityCode = $objSubmisionDetails->getCityId($brokerDetailArr[3], $brokerStateCode);
            $this->brokerId = $objSubmisionDetails->GetBrokerWiseId($brokerCode, $brokerCityCode, $brokerStateCode);
        }
        $submissionProductRow = $editObj->getLobName($submissionRecord[0]['LobId']);
        if (count($submissionProductRow) > 0) {
            $submissionProduct = $submissionProductRow[0];
        }
        $brokerTypeRow = $editObj->FetchBrokerType($brokerCode);
        if (count($brokerTypeRow) > 0) {
            $brokerType = $brokerTypeRow[0];
        }
        $insuredRows = $editObj->FetchInsuredDetails();
        if (count($insuredRows) > 0) {
            $this->insuredDetails = $insuredRows;
            $insuredDetails = $editObj->FetchInsuredDetails($submissionRow[0]['InsuredId']);
            $insuredName = $insuredDetails[0]['InsuredName'];
            $insuredaddress = $insuredDetails[0]['Address'];
            $insuredCountry = $insuredDetails[0]['InsuredCountry'];
            $insuredState = $insuredDetails[0]['StateName'];
            $insuredCity = $insuredDetails[0]['City'];
            $insuredZipcode = $insuredDetails[0]['Zip'];
            $insuredDBNumber = $insuredDetails[0]['DBNumber'];
        }

        if (!empty($submissionRow[0]['InsuredId'])) {
            $insuredParty = 98;
            $insuredContactPersonRows = $objSubmisionDetails->ContactPerson($submissionRow[0]['InsuredId'], $insuredParty);
        }
        if (!empty($submissionRow[0]['InsuredContactPersonId'])) {
            $insuredContactPersonDetailsRows = $editObj->FetchInsuredContactPersonDetails($submissionRow[0]['InsuredContactPersonId']);
            if (count($insuredContactPersonDetailsRows) > 0) {
                $insuredContactPersonDetails = $insuredContactPersonDetailsRows[0];
            }
        }
        if (!empty($this->brokerId)) {
            $insuredParty = 97;
            $this->brokerContactPersonRows = $objSubmisionDetails->ContactPerson($this->brokerId, $insuredParty);
        }
        $brokerContactPersonDetailsRows = $editObj->FetchBrokerContactPersonDetails($submissionRow[0]['BrokerContactPersonId']);
        if (count($brokerContactPersonDetailsRows) > 0) {
            $this->brokerContactPersonDetails = $brokerContactPersonDetailsRows[0];
        }
        $businessDependentRows = $editObj->FetchBusinessDependentDetails($submissionRow[0]['BusinessDependentDetailId']);
        if (count($businessDependentRows) > 0) {
            $businessDetails = $businessDependentRows;
        }
        $statusDependentRows = $editObj->FetchBusinessStatusDetails($submissionRow[0]['StatusDependentDetailsId']);
        if (count($statusDependentRows) > 0) {
            $statusDetails = $statusDependentRows[0];
        }
        $submissionBranchRows = $editObj->FetchSubmissionBranch($submissionRow[0]['BranchId']);
        if (count($submissionBranchRows) > 0) {
            $branches = $submissionBranchRows[0]['Branch'];
        }
        $dataRecorderTypeRows = $editObj->FetchDataRecorderType($submissionRow[0]['DataRecorderMetaDataId']);
        if (count($dataRecorderTypeRows) > 0) {
            $DataRecorder = $dataRecorderTypeRows[0];
        }

        $remarkRow = $editObj->FetchHistoryDetails($submissionId);
        if (count($remarkRow) > 0) {
            $remarks = $remarkRow;
        }
        $retailBrokerData = $editObj->FetchRetailBrokerDetails($submissionId);
        if (count($retailBrokerData) > 0) {
            $retailBrokerDetails = $retailBrokerData[0];
        }

        $finalData = array('submissionRow' => $submissionRow, 'submissionProduct' => $submissionProduct, 'brokerType' => $brokerType, 'retailBrokerDetails' => $retailBrokerDetails,
            'remarks' => $remarks, 'statusDetails' => $statusDetails, 'insuredName' => $insuredName, 'insuredaddress' => $insuredaddress, 'insuredCountry' => $insuredCountry, 'insuredState' => $insuredState,
            'insuredCity' => $insuredCity, 'insuredZipcode' => $insuredZipcode, 'insuredDBNumber' => $insuredDBNumber, 'businessDetails' => $businessDetails, 'brokerCode' => $brokerCode,
            'brokerCountryCode' => $brokerCountryCode, 'brokerStateCode' => $brokerStateCode, 'brokerCityCode' => $brokerCityCode, 'branches' => $branches, 'DataRecorder' => $DataRecorder,
            'insuredContactPersonRows' => $insuredContactPersonRows, 'insuredContactPersonDetails' => $insuredContactPersonDetails
        );
        return $finalData;
    }

    /* Create Amendment End */

    /* View Amendment Start */

    public function executeViewEndersomentSubmission(sfWebRequest $request) {
        $this->amendmentId = $request->getParameter('amendmentId');
        $obj = new ViewSubmissionAmendment();
        $this->result = $obj->ViewEndersomentSubmissionDetail($this->amendmentId);
    }

    /* View Amendment End */

    /* QCView Amendment Start */

    public function executeQcViewEndersomentSubmission(sfWebRequest $request) {
        $this->amendmentId = $request->getParameter('amendmentId');
        $obj = new ViewSubmissionAmendment();
        $this->result = $obj->ViewEndersomentSubmissionDetail($this->amendmentId);
    }

    public function executeQCUpdateEndersomentSubmission(sfWebRequest $request) {
        $userId = $this->getUser()->getAttribute('id');
        $amendmentId = $request->getParameter('amendmentId');
        $postValues = $request->getPostParameters();
        $this->result = AmendmentQC::UpdateSubmissionAmendmentForQC($userId, $amendmentId, $postValues);
        $this->redirect('submission/QCAmendmentList');
    }

    /* QCView Amendment End */

    /* Edit Amendment Start */

    public function executeEditEndorsementSubmission(sfWebRequest $request) {
        $amenHistoryObj = new SubmissionAmendmentHistory();
        $amenEditObj = new EditSubmissionAmendment();
        $userId = $this->getUser()->getAttribute('id');
        $groupId = $this->getUser()->getAttribute('groupId');
        $this->userGroup = SubmissionDetails::getUserGroup($groupId);
        $this->amendmentId = 0;
        $postedValues = $request->getPostParameters();
        $this->data = $this->executeGetEndersomentMasterData();
        $amendmentId = $request->getParameter('amendmentId');
        $this->amendmentId = $amendmentId;
        $this->originalEffectiveDate = $amenEditObj->getSubmissionEffectiveDate($amendmentId);
        if ($request->hasParameter('amendmentId') && $request->getPostParameters()) {
            $validateSubmission = $amenEditObj->validateAmendmentEditSubmission($postedValues, $groupId);
            $emptyValues = '';
            if (count($validateSubmission) >= 1) {
                $emptyValues = implode(", ", $validateSubmission);
            }
            if (!empty($emptyValues)) {
                $this->emptyValues = $emptyValues;
            } else {
                $amenHistoryObj->SaveAmendmentHistory($postedValues, $userId, $amendmentId, $this->userGroup);
                $amenEditObj->UpdateAmendmentSubmissionDetails($postedValues, $userId, $amendmentId, $this->userGroup);
                $this->redirect('submission/List');
            }
        }
        if ($request->hasParameter('amendmentId')) {
            $this->fetchData = $this->executeEditFetchAmendmentDetails($amendmentId);
        }
    }

    public function executeEditEndorsementReversalChild(sfWebRequest $request) {
        $amenHistoryObj = new SubmissionAmendmentHistory();
        $amenEditObj = new EditSubmissionAmendment();
        $userId = $this->getUser()->getAttribute('id');
        $groupId = $this->getUser()->getAttribute('groupId');
        $this->userGroup = SubmissionDetails::getUserGroup($groupId);
        $this->amendmentId = 0;
        $postedValues = $request->getPostParameters();
        $this->data = $this->executeGetEndersomentMasterData();
        $amendmentId = $request->getParameter('amendmentId');
        $this->amendmentId = $amendmentId;
        $this->originalEffectiveDate = $amenEditObj->getSubmissionEffectiveDate($amendmentId);
        if ($request->hasParameter('amendmentId') && $request->getPostParameters()) {
            $amenEditObj->UpdateAmendmentReversalChildDetails($postedValues, $userId, $amendmentId, $this->userGroup);
            $this->redirect('submission/List');
        }
        if ($request->hasParameter('amendmentId')) {
            $this->fetchData = $this->executeEditFetchAmendmentDetails($amendmentId);
        }
    }

    private function executeEditFetchAmendmentDetails($amendmentId) {
        $editObj = new EditSubmissionDetails();
        $editAmendmentObj = new EditSubmissionAmendment();
        $objSubmisionDetails = new SubmissionDetails();
        $amendmentRecord = $editAmendmentObj->FetchAmendmentSubmissionDetails($amendmentId);
        $amendmentRow = array_change_key_case($amendmentRecord);
        if (count($amendmentRow) > 0) {
            $insuredRows = $editObj->FetchInsuredDetails();
            if (count($insuredRows) > 0) {
                $this->insuredDetails = $insuredRows;
                $insuredDetails = $editObj->FetchInsuredDetails($amendmentRecord[0]['InsuredId']);
                $insuredName = $insuredDetails[0]['InsuredName'];
                $insuredaddress = $insuredDetails[0]['Address'];
                $insuredCountry = $insuredDetails[0]['InsuredCountry'];
                $insuredState = $insuredDetails[0]['StateName'];
                $insuredCity = $insuredDetails[0]['City'];
                $insuredZipcode = $insuredDetails[0]['Zip'];
                $insuredDBNumber = $insuredDetails[0]['DBNumber'];
            }
            if (!empty($amendmentRecord[0]['InsuredId'])) {
                $insuredParty = 98;
                $insuredContactPersonRows = $objSubmisionDetails->ContactPerson($amendmentRecord[0]['InsuredId'], $insuredParty);
            }
            if (!empty($amendmentRow[0]['InsuredContactPersonId'])) {
                $insuredContactPersonDetailsRows = $editObj->FetchInsuredContactPersonDetails($amendmentRow[0]['InsuredContactPersonId']);
                if (count($insuredContactPersonDetailsRows) > 0) {
                    $insuredContactPersonDetails = $insuredContactPersonDetailsRows[0];
                }
            }
            if (!empty($amendmentRow[0]['BrokerId'])) {
                $insuredParty = 97;
                $brokerContactPersonRows = $objSubmisionDetails->ContactPerson($amendmentRow[0]['BrokerId'], $insuredParty);
            }
            if (!empty($amendmentRow[0]['BrokerWiceCityId'])) {
                $brokerDetails = $editAmendmentObj->GetAmendmentBrokerWiseCity($amendmentRow[0]['BrokerWiceCityId']);
                $brokerTypeRow = $editObj->FetchBrokerType($brokerDetails[0]['BrokerCode']);
                if (count($brokerTypeRow) > 0) {
                    $brokerType = $brokerTypeRow[0];
                }
            }
            $submissionProductRow = $editObj->getLobName($amendmentRow[0]['LobId']);
            if (count($submissionProductRow) > 0) {
                $submissionProduct = $submissionProductRow[0];
            }
            $dataRecorderTypeRows = $editObj->FetchDataRecorderType($amendmentRow[0]['DataRecorderMetaDataId']);
            if (count($dataRecorderTypeRows) > 0) {
                $DataRecorder = $dataRecorderTypeRows[0];
            }
            if (!empty($amendmentRow[0]['ProjectCountry'])) {
                $projectCountry = $objSubmisionDetails->getCountryId($amendmentRow[0]['ProjectCountry']);
                $amendmentRow[0]['ProjectCountry'] = $projectCountry;
            }
            if (!empty($amendmentRow[0]['ProjectState'])) {
                $projectState = $editObj->getProjectStateId($amendmentRow[0]['ProjectState']);
                $amendmentRow[0]['ProjectState'] = $projectState;
            }
            if (!empty($amendmentRow[0]['ProjectCity'])) {
                $projectcity = $editObj->getProjectCityId($amendmentRow[0]['ProjectCity']);
                $amendmentRow[0]['ProjectCity'] = $projectcity;
            }
        }
        $finalData = array('submissionRow' => $amendmentRow, 'insuredContactPersonRows' => $insuredContactPersonRows, 'insuredContactPersonDetails' => $insuredContactPersonDetails, 'brokerContactPersonRows' => $brokerContactPersonRows, 'brokerDetails' => $brokerDetails, 'brokerType' => $brokerType, 'insuredName' => $insuredName, 'insuredaddress' => $insuredaddress, 'insuredCountry' => $insuredCountry, 'insuredState' => $insuredState,
            'insuredCity' => $insuredCity, 'insuredZipcode' => $insuredZipcode, 'insuredDBNumber' => $insuredDBNumber, 'submissionProduct' => $submissionProduct, 'DataRecorder' => $DataRecorder
        );
        return $finalData;
    }

    /* Edit Amendment End */

    public function executeAmendmentList(sfWebRequest $request) {
        if (sfContext::getInstance()->getUser()->hasCredential('AMENDMENT_REVERSAL')) {
            $isReversal = 'Reversal';
        } else {
            $isReversal = 'NoReversal';
        }
        $groupId = $this->getUser()->getAttribute('groupId');
        $userGroup = SubmissionDetails::getUserGroup($groupId);
        if ($userGroup == 'master') {
            $flag = 'master';
        } else {
            $flag = '';
        }
        $jsonObj = json_decode(SubmissionDetails::getPostContent());
        $submissionId = $jsonObj->body->data;
        $cancelationCount = $jsonObj->body->cancelChild;
        $objSubmission = new EditSubmissionAmendment();
        $data = $objSubmission->FetchAmendmentSubmissionList($submissionId, $isReversal, $cancelationCount, $flag);
        echo json_encode($data);
        exit;
    }

    public function executeViewEndersomentSubmissionHistory($request) {
        $this->amendmentId = $request->getParameter('amendmentId');
        $obj = new ViewSubmissionAmendmentHistory();
        $this->recorderData = $obj->GetDatarecorderMetaData($this->amendmentId);
        $this->historyData = $obj->FetchSubmissionAmendmentHistory($this->amendmentId);
    }

    public function executeEndersomentHistory($request) {
        $this->amendmentId = $request->getParameter('amendmentId');
        $obj = new ViewSubmissionAmendmentHistory();
        $this->recorderData = $obj->GetDatarecorderMetaData($this->amendmentId);
        $this->historyData = $obj->FetchSubmissionAmendmentHistory($this->amendmentId);
    }

    public function executeQCAmendmentList($request) {
        $obj = new SubmissionDetails();
        $this->nerrenewal = $obj->getLookUpTypeList('NewRenewal');
        $this->branchOffice = SubmissionDetails::getBranchOffice();
        $this->status = $obj->getStatusForAmendmentQCList();
        $this->underWriter = SubmissionDetails::getUnderWriterName();
        $this->reasonCode = SubmissionDetails::getReasonCode();
        $this->lobData = $obj->getLobData();
        $this->lobSubTypeList = $obj->getLobSubTypeList();
        $this->sectionList = $obj->getSectionList();
        $this->profitCodeList = $obj->getProfitCodeList();
        $this->brokerList = $obj->getBrokerList();
        $this->brokerType = $obj->getLookUpTypeList('BrokerType');
        $this->brokerCity = $obj->getCityName();
        $this->cabCompanies = $obj->getLookUpTypeList('CabCompanies');
        $this->numberofLocations = $obj->getLookUpTypeList('NubmerOfLocations');
        $this->occupancycode = $obj->getOccupancyCode();
        $this->currency = $obj->getLookUpTypeList('CurrencyType');
        $this->renewable = $obj->getLookUpTypeData('Renewable');
        $this->policyType = $obj->getLookUpTypeData('PolicyType');
        $this->directAssumed = $obj->getLookUpTypeData('DirectAssumed');
        $this->companyPaper = $obj->getLookUpTypeData('CompanyPaper');
        $this->admittedNotAdmitted = $obj->getLookUpTypeData('AdmittedNotAdmitted');
        $this->suffix = $obj->getLookUpTypeData('Suffix');
        $this->companyPaperNumber = $obj->getLookUpTypeData('CompanyPaperNumber');
        $this->coverage = $obj->GetCoverage();
        if ($request->getParameter('niddle')) {
            $this->lastSearchCriteria = $this->getUser()->getAttribute('searchNiddle');
        } else {
            $this->getUser()->setAttribute('searchNiddle', '');
        }
        if ($request->isMethod('GET')) {
            if ($request->getParameter('sort')) {
                $column = $request->getParameter('sort');
                $order = $request->getParameter('order');
            }
        }

        if ($request->isMethod('POST')) {
            $this->getUser()->setAttribute('searchNiddle', '');
            $SubmissionNumber = $request->getParameter('submissionNo', '');
            $InsuredName = $request->getParameter('InsuredName', '');
            $newRenewal = $request->getParameter('newrenewal', '');
            $SubmissionFromDate = $request->getParameter('SubmissionFromDate', '');
            $SubmissionToDate = $request->getParameter('SubmissionToDate', '');
            $Underwriter = $request->getParameter('Underwriter', '');
            $Branch = $request->getParameter('Branch', '');
            $Status = $request->getParameter('Status', '');
            $ReasonCode = $request->getParameter('reasoncode', '');
            $ProductLine = $request->getParameter('productline', '');
            $ProductLineSubType = $request->getParameter('productsubtype', '');
            $Section = $request->getParameter('section', '');
            $ProfitCode = $request->getParameter('profitcode', '');
            $BrokerName = $request->getParameter('brokername', '');
            $BrokerType = $request->getParameter('brokertype', '');
            $BrokerCity = $request->getParameter('brokercity', '');
            $CabCompanies = $request->getParameter('cabcompanies', '');
            $EffectiveFromDate = $request->getParameter('EffectiveFromDate', '');
            $EffectiveToDate = $request->getParameter('EffectiveToDate', '');
            $ExpirationFromDate = $request->getParameter('ExpirationFromDate', '');
            $ExpirationToDate = $request->getParameter('ExpirationToDate', '');
            $ProcessFromDate = $request->getParameter('ProcessFromDate', '');
            $ProcessToDate = $request->getParameter('ProcessToDate', '');
            $EditFromDate = $request->getParameter('EditFromDate', '');
            $EditToDate = $request->getParameter('EditToDate', '');
            $EditDbaName = $request->getParameter('EditDbaName', '');
            $BrokerContactPerson = $request->getParameter('BrokerContactPerson', '');
            $NumberOfLocations = $request->getParameter('numberoflocations', '');
            $occupancyCode = $request->getParameter('occupancycode', '');
            $currency = $request->getParameter('currency', '');
            $renewable = $request->getParameter('renewable', '');
            $dateOfRenewalFromDate = $request->getParameter('DateofRenewalFromDate', '');
            $dateOfRenewalToDate = $request->getParameter('DateofRenewalToDate', '');
            $policyType = $request->getParameter('policyType', '');
            $directAssumed = $request->getParameter('directAssumed', '');
            $companyPaper = $request->getParameter('companyPaper', '');
            $companyPaperNumber = $request->getParameter('companyPaperNumber', '');
            $policyNumber = $request->getParameter('policyNumber', '');
            $suffix = $request->getParameter('suffix', '');
            $admittedNonAdmitted = $request->getParameter('admittedNonAdmitted', '');
            $coverage = $request->getParameter('coverage', '');

            $this->lastSearchCriteria = array(
                'SubmissionNo' => $SubmissionNumber,
                'InsuredName' => $InsuredName,
                'NewRenewal' => $newRenewal,
                'SubmissionFromDate' => $SubmissionFromDate,
                'SubmissionToDate' => $SubmissionToDate,
                'Underwriter' => $Underwriter,
                'Branch' => $Branch,
                'Status' => $Status,
                'ReasonCode' => $ReasonCode,
                'ProductLine' => $ProductLine,
                'ProductLineSubType' => $ProductLineSubType,
                'Section' => $Section,
                'ProfitCode' => $ProfitCode,
                'BrokerName' => $BrokerName,
                'BrokerType' => $BrokerType,
                'BrokerCity' => $BrokerCity,
                'CabCompanies' => $CabCompanies,
                'EffectiveFromDate' => $EffectiveFromDate,
                'EffectiveToDate' => $EffectiveToDate,
                'ExpirationFromDate' => $ExpirationFromDate,
                'ExpirationToDate' => $ExpirationToDate,
                'ProcessFromDate' => $ProcessFromDate,
                'ProcessToDate' => $ProcessToDate,
                'EditFromDate' => $EditFromDate,
                'EditToDate' => $EditToDate,
                'EditDbaName' => $EditDbaName,
                'BrokerContactPerson' => $BrokerContactPerson,
                'NumberOfLocations' => $NumberOfLocations,
                'OccupancyCode' => $occupancyCode,
                'Currency' => $currency,
                'Renewable' => $renewable,
                'DateOfRenewalFromDate' => $dateOfRenewalFromDate,
                'DateOfRenewalToDate' => $dateOfRenewalToDate,
                'PolicyType' => $policyType,
                'DirectAssumed' => $directAssumed,
                'CompanyPaper' => $companyPaper,
                'CompanyPaperNumber' => $companyPaperNumber,
                'PolicyNumber' => $policyNumber,
                'Suffix' => $suffix,
                'AdmittedNonAdmitted' => $admittedNonAdmitted,
                'Coverage' => $coverage
            );
            $this->getUser()->setAttribute('searchNiddle', $this->lastSearchCriteria);
        }

        //Saving this last search criteria
        $criteria = AmendmentQC::getAmendmentQcSearchCriteria($this->lastSearchCriteria, $column, $order);
        $this->numberofResults = AmendmentsubmissionqcSearchPeer::doCount($criteria);
        $this->arrData = new sfPropelPager('AmendmentSubmissionQcSearch', sfConfig::get('app_paginationlimit', 1));
        $this->arrData->setCriteria($criteria);
        $this->arrData->setPage($request->getParameter('page', 1));
        $this->arrData->init();
    }

    public function executeAmendmentReversal(sfWebRequest $request) {
        $jsonObj = json_decode(SubmissionDetails::getPostContent());
        $userId = $this->getUser()->getAttribute('id');
        $amendmentId = $jsonObj->body->data;
        $flag = 'Reversal';
        $objSubmission = new AmendmentReversal();
        $data = $objSubmission->FetchAmendmentDetails($amendmentId, $userId, $flag);
        echo $data;
        exit;
    }

    /* Functionality For Endersoment End */

    public function executeGetSubClass(sfWebRequest $request) {
        $classString = $request->getParameter('clss');
        $SubclassString = $request->getParameter('term');
        $classData = EditSubmissionDetails::GetClassInformation($classString,$SubclassString);
        $json_response = array();
        foreach ($classData as $value) {
            $copData['value'] = $value['ClassCode'];
            array_push($json_response, $copData);
        }
        echo json_encode($json_response);
        exit;
    }

    public function executeGetDescription(sfWebRequest $request) {
        $jsonObj = json_decode(SubmissionDetails::getPostContent());
        $dataArray = $jsonObj->body->data;
        $subclassString = $dataArray->subclass;
        $classDescription = EditSubmissionDetails::GetClassDescription($subclassString);
        $arra = array('desc' => $classDescription[0]['ClassDescription']);
        echo json_encode($arra);
        exit;
    }

}
