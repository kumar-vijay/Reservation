<?php

class SubmissionAmendment {

    public function __construct() {
        $this->connection = Propel::getConnection();
    }

    public function FetchCurrentStatusForEndersment() {
        $connection = $this->connection;
        $statusQuery = "SELECT * FROM  Status Where StatusName = 'Endorsement' OR StatusName = 'Cancellation'";
        $statusStatement = $connection->prepare($statusQuery);
        $statusStatement->execute();
        $statusData = $statusStatement->fetchAll(PDO::FETCH_ASSOC);
        return $statusData;
    }

    public function CreateAmendmentDetails($postedValues, $userId, $submissionId, $userGroup) {
        $subObj = new SubmissionDetails();
        $financialAmendmentId = $this->InsertintoAmendmentFinancial($postedValues);
        $financialNonAmendmentId = $this->InsertintoAmendmentNonFinancial($postedValues);
        $dataRecorderId = $subObj->insertDataRecorderMetaData($userId);
        $data = array('SubmissionId' => $submissionId, 'finalcialAmendmentId' => $financialAmendmentId, 'nonFinalcialAmendmentId' => $financialNonAmendmentId, 'dataRecorder' => $dataRecorderId);
        $result = $this->InsertintoAmendmentDetails($postedValues, $data);
        return $result;
    }

    private function InsertintoAmendmentDetails($postedValues, $data) {
        $editAdemdmentObj = new EditSubmissionAmendment();
        $qcStatus = $editAdemdmentObj->GetQcStatus();
        $endersodedSubmissionNumber = $this->CreateRenewalSubmissionNumber($postedValues['submissionNumber'], $data['SubmissionId']);
        if ($postedValues['flag'] == 'Reversal') {
            $isReversal = '1';
            $childReversal = '1';
        } else {
            $isReversal = '0';
            $childReversal = '0';
        }
        $con = Propel::getConnection();
        $query = "INSERT INTO SubmissionAmendment
              (SubmissionId, SubmissionNumber, NonFinancialAmendmentId, FinancialAmendmentId, QCStatus, Remarks,IsReversal,ReversalChild, DataRecorderMetaDataId) 
               VALUES 
               ('" . $data['SubmissionId'] . "','" . $endersodedSubmissionNumber . "','" . $data['nonFinalcialAmendmentId'] . "' ,'" . $data['finalcialAmendmentId'] . "','" . $qcStatus . "','" . $postedValues['editRemark'] . "', '" . $isReversal . "','" . $childReversal . "','" . $data['dataRecorder'] . "')";
        $insert = $con->prepare($query);
        if ($insert->execute()) {
            $result = true;
        } else {
            $result = false;
        }
        return $result;
    }

    private function CreateRenewalSubmissionNumber($submissionNumber, $submissionId) {
        $amendmentSubmissionNumber = $this->GetAmendmentInformation($submissionId);
        if (empty($amendmentSubmissionNumber)) {
            $finalSubmissionNumber = $this->perpareSubmissionNumber($submissionNumber);
        } else {
            $finalSubmissionNumber = $this->perpareSubmissionNumber($amendmentSubmissionNumber);
        }
        return $finalSubmissionNumber;
    }

    private function perpareSubmissionNumber($submissionNumber) {
        $data = explode("-", $submissionNumber);
        $number = $data[4] + 1;
        $data[4] = str_pad($number, 2, '0', STR_PAD_LEFT);
        $finalSubmissionNumber = $data[0] . '-' . $data[1] . '-' . $data[2] . '-' . $data[3] . '-' . $data[4];
        return $finalSubmissionNumber;
    }

    private function GetAmendmentInformation($submissionId) {
        $con = Propel::getConnection();
        $stmt = $con->query("SELECT TOP 1 SubmissionNumber FROM SubmissionAmendment Where SubmissionId = '$submissionId' ORDER BY Id DESC");
        $data = $stmt->fetch(PDO::FETCH_ASSOC);
        $lastAmendmentSubmissionNumber = $data['SubmissionNumber'];
        return $lastAmendmentSubmissionNumber;
    }

    /* Insert into AmendmentFinancial Table to store Financial Information Start */

    private function InsertintoAmendmentFinancial($postedValues) {
        $dataArray = $this->FormatAmendmentFinancialArray($postedValues);
        $con = Propel::getConnection();
        $query = "INSERT INTO AmendmentFinancial
              (PremiunType, IsPremium, PremiumInLocalCurrency, PremiumInUSD, LayerofLimitInLocalCurrency, LayerofLimitInUSD, PercentageofLayer, IsLimit, LimitInLocalCurrency, LimitInUSD, IsAttachmentPoint, AttachmentPointInLocalCurrency, AttachmentPointInUSD, SelfInsuredRetentionInLocalCurrency, SelfInsuredRetentionInUSD, PolicyCommPercentage, PolicyCommInLocalCurrency, PolicyCommInUSD, PremiumNetofCommInLocalCurrency, PremiumNetofCommInUSD) 
               VALUES 
               ('" . $dataArray['PremiumType'] . "','" . $dataArray['isPremium'] . "','" . $dataArray['PremiumInLocalCurrency'] . "' ,'" . $dataArray['PremiumInUSD'] . "', '" . $dataArray['LayerLimitLocalCurrency'] . "', '" . $dataArray['LayerLimitLocalUSD'] . "', '" . $dataArray['PrecentageLayer'] . "', '" . $dataArray['isLimit'] . "', '" . $dataArray['LimitLocalCurrency'] . "', '" . $dataArray['LimitUSD'] . "', '" . $dataArray['isAttachmentPoint'] . "', '" . $dataArray['AttachmentLocalCurrency'] . "', '" . $dataArray['AttachmentUSD'] . "', '" . $dataArray['SelfRetrntionLocalCurrency'] . "', '" . $dataArray['SelfRetrntionUSD'] . "', '" . $dataArray['PolicyCommision'] . "', '" . $dataArray['PolicyCommisionLocalCurrrency'] . "', '" . $dataArray['PolicyCommisionUSD'] . "', '" . $dataArray['PermiumNetofAllComissionLocalCurency'] . "', '" . $dataArray['PermiumUSD'] . "')";

        $insert = $con->prepare($query);
        if ($insert->execute()) {
            $STH = $con->query("SELECT CAST(COALESCE(SCOPE_IDENTITY(), @@IDENTITY) AS int)");
            $STH->execute();
            $result = $STH->fetch();
            $amendmentFinancialId = $result[0];
        }
        return $amendmentFinancialId;
    }

    private function FormatAmendmentFinancialArray($postedValues) {
        $amendmentArray = array();
        $amendmentArray['PremiumType'] = $postedValues['premiumType'];
        if ($postedValues['yesGross'] == 'Y') {
            $amendmentArray['isPremium'] = '1';
            $amendmentArray['PremiumInLocalCurrency'] = $postedValues['gross_premium_select'];
        } else {
            $amendmentArray['isPremium'] = '0';
            $amendmentArray['PremiumInLocalCurrency'] = $postedValues['gross_premium_text'];
        }
        $amendmentArray['PremiumInUSD'] = $postedValues['editlocalCurrency'];
        $amendmentArray['LayerLimitLocalCurrency'] = $postedValues['editLayerLimitLocalCurrency'];
        $amendmentArray['LayerLimitLocalUSD'] = $postedValues['editLayerLimitLocalUSD'];
        $amendmentArray['PrecentageLayer'] = $postedValues['editPrecentageLayer'];
        if ($postedValues['yesLimit'] == 'Y') {
            $amendmentArray['isLimit'] = '1';
            $amendmentArray['LimitLocalCurrency'] = $postedValues['limit_select'];
        } else {
            $amendmentArray['isLimit'] = '0';
            $amendmentArray['LimitLocalCurrency'] = $postedValues['limit_text'];
        }
        $amendmentArray['LimitUSD'] = $postedValues['editlimitlocalcurrency'];
        if ($postedValues['yesAttachment'] == 'Y') {
            $amendmentArray['isAttachmentPoint'] = '1';
            $amendmentArray['AttachmentLocalCurrency'] = $postedValues['attachment_point_select'];
        } else {
            $amendmentArray['isAttachmentPoint'] = '0';
            $amendmentArray['AttachmentLocalCurrency'] = $postedValues['attachment_point_text'];
        }
        $amendmentArray['AttachmentUSD'] = $postedValues['editattachmentlocalcurrency'];
        $amendmentArray['SelfRetrntionLocalCurrency'] = $postedValues['editselfRetrntionLocalCurrency'];
        $amendmentArray['SelfRetrntionUSD'] = $postedValues['editselfRetrntionUSD'];
        $amendmentArray['PolicyCommision'] = $postedValues['editpolicyCommision'];
        $amendmentArray['PolicyCommisionLocalCurrrency'] = $postedValues['editpolicyCommisionLocalCurrrency'];
        $amendmentArray['PolicyCommisionUSD'] = $postedValues['editpolicyCommisionUSD'];
        $amendmentArray['PermiumNetofAllComissionLocalCurency'] = $postedValues['editPermiumLocalCurency'];
        $amendmentArray['PermiumUSD'] = $postedValues['editPermiumUSD'];
        return $amendmentArray;
    }

    /* Insert into AmendmentFinancial Table to store Financial Information End */
    /* Insert into AmendmentFinancial Table to store Non Financial Information Start */

    private function InsertintoAmendmentNonFinancial($postedValues) {
        $subObj = new SubmissionDetails();
        if ($postedValues['Flag'] == 1) {
            if (isset($postedValues['productline_master']) && !empty($postedValues['productline_master'])) {
                $postedValues['editproductline'] = $postedValues['productline_master'];
            }
            $postedValues['editproductlinesubtype'] = $postedValues['editproductlinesubtype_master'];
            $postedValues['editsection'] = $postedValues['editsection_master'];
            $postedValues['editprofitcode'] = $postedValues['editprofitcode_master'];
        } else {
            $lobdata = $subObj->getLobList($postedValues['editproductline']);
            $postedValues['editproductline'] = $lobdata[0]['Id'];
            $postedValues['editproductlinesubtype'] = $postedValues['editproductlinesubtype'];
            $postedValues['editsection'] = $postedValues['editsection'];
            $postedValues['editprofitcode'] = $postedValues['editprofitcode'];
        }
        if (isset($postedValues['project_name']) && isset($postedValues['project_country'])) {
            $amendmentBusinessDetailId = $this->InsertIntoAmendmentBusinessDependentDetails($postedValues);
        } else {
            $amendmentBusinessDetailId = null;
        }
        $amendmentBrokerDetailId = $this->InsertIntoAmendmentBrokerDetails($postedValues);
        $amendmentPolicyDetailId = $this->InsertIntoAmendmentPolicyDetails($postedValues);
        if ($postedValues['yesDuckSubmissionNumber'] == 'Y' || $postedValues['yesDuckSubmissionNumber'] == '1') {
            $postedValues['yesDuckSubmissionNumber'] = '1';
            $duckCreakNumber = null;
        } else {
            $postedValues['yesDuckSubmissionNumber'] = '0';
            $duckCreakNumber = $postedValues['editDuckSubmissionNumber'];
        }
        if ($postedValues['insured_name_status'] == 'Y' || $postedValues['insured_name_status'] == '1') {
            $postedValues['insured_name_status'] = '1';
            $dbaName = $postedValues['DbaName'];
        } else {
            $postedValues['insured_name_status'] = '0';
            $$dbaName = null;
        }
        if (isset($postedValues['yesTrue'])) {
            $isTrue = '1';
            $totalInsuredValue = $postedValues['total_insured_value_select'];
        } else {
            $isTrue = '0';
            $totalInsuredValue = $postedValues['edittotalinsuredvalue'];
        }
        if (isset($postedValues['yesBroker']) && $postedValues['yesBroker'] =='N') {
            $isDateFromBerksi = '0';
            $DateOfBerksiFromBroker = $postedValues['received_date_by_berkshire'];
        } else {
            $isDateFromBerksi = '1';
            $DateOfBerksiFromBroker = null;
        }
        if (isset($postedValues['yesIndia']) && $postedValues['yesIndia'] =='N') {
            $isDateFromIndia = '0';
            $DateOfIndiaFromBroker = $postedValues['received_date_by_india'];
        } else {
            $isDateFromIndia = '1';
            $DateOfIndiaFromBroker = null;
        }
        if (isset($postedValues['expityDate'])) {
            $postedValues['expityDate'] = $postedValues['expityDate'];
        } else {
            $postedValues['expityDate'] = $postedValues['hiddenexpityDate'];
        }
        $con = Propel::getConnection();
        $query = "INSERT INTO AmendmentNonFinancial
              (IsDuckSubmissionNumber, DuckSubmissionNumber, NewRenewalLookupId, UnderwriterId, LobId, LobSubTypeId, SectionId, ProfitCodeId, CurrentStatusId, EffectiveDate, ExpiryDate, CurrencyTypeId, ExchangeRate, ExchangeDate, InsuredId, IsDifferentDba, DbaName, CABCompaniesLookupId, ReinsuredCompany, SubmissionIdentifier, InsuredContactPersonId, InsuredSubmissionDate, InsuredQuoteDueDate, AmendmentBusinessDependentDetailsId, IsTotalInsuredValue, TotalInsuredValue, TotalInsuredValueInUSD, RiskProfile, NumberOfLocationsId, OccupancyCodeId, AmendmentBrokerDetailsId, ReasonCodeId, ProcessDate, AmendmentPolicyDetailsId, IsBerksiBroker, BerkSIDateFromBroker, IsBerksiIndia, BerkSiDateFromIndia, BranchId) 
               VALUES 
               ('" . $postedValues['yesDuckSubmissionNumber'] . "','" . $duckCreakNumber . "','" . $postedValues['newrenewal'] . "' ,'" . $postedValues['editunderwriter'] . "', '" . $postedValues['editproductline'] . "', '" . $postedValues['editproductlinesubtype'] . "', '" . $postedValues['editsection'] . "', '" . $postedValues['editprofitcode'] . "', '" . $postedValues['editprimarystatus'] . "', '" . $postedValues['effectiveDate'] . "', '" . $postedValues['expityDate'] . "', '" . $postedValues['editcurrency'] . "', '" . $postedValues['editexchangeRate'] . "', '" . $postedValues['editexchangeRateDate'] . "', '" . $postedValues['insuredId'] . "', '" . $postedValues['insured_name_status'] . "', '" . $postedValues['dbaName'] . "', '" . $postedValues['editcabcompanies'] . "', '" . $postedValues['reinsured_company'] . "', '" . $postedValues['editsubmissiontypeidrntifier'] . "','" . $postedValues['editinsuredContactPerson'] . "','" . $postedValues['editinsuredSubmissionDate'] . "','" . $postedValues['editinsuredQuoteDueDate'] . "','" . $amendmentBusinessDetailId . "','" . $isTrue . "','" . $totalInsuredValue . "','" . $postedValues['edittotalinsuredvalueinusd'] . "','" . $postedValues['editriskProfile'] . "','" . $postedValues['EditNumberOfLocations'] . "','" . $postedValues['EditOccupancyCode'] . "','" . $amendmentBrokerDetailId . "','" . $postedValues['reason_code'] . "','" . $postedValues['processdate'] . "','" . $amendmentPolicyDetailId . "','" . $isDateFromBerksi . "','" . $DateOfBerksiFromBroker . "','" . $isDateFromIndia . "','" . $DateOfIndiaFromBroker . "','" . $postedValues['branch_office'] . "')";
        $insert = $con->prepare($query);
        if ($insert->execute()) {
            $STH = $con->query("SELECT CAST(COALESCE(SCOPE_IDENTITY(), @@IDENTITY) AS int)");
            $STH->execute();
            $result = $STH->fetch();
            $amendmentNonFinancialId = $result[0];
        }
        return $amendmentNonFinancialId;
    }

    private function InsertIntoAmendmentBusinessDependentDetails($postedValues) {
        $subObj = new SubmissionDetails();
        if (!isset($postedValues['flag'])) {
            if (!empty($postedValues['project_country'])) {
                $postedValues['project_country'] = $subObj->GetCountryById($postedValues['project_country']);
            } else {
                $postedValues['project_country'] = null;
            }
            if (!empty($postedValues['project_state'])) {
                $postedValues['project_state'] = $subObj->GetProjectStateById($postedValues['project_state']);
            } else {
                $postedValues['project_state'] = null;
            }
            if (!empty($postedValues['project_city'])) {
                $postedValues['project_city'] = $subObj->GetProjectCityById($postedValues['project_city']);
            } else {
                $postedValues['project_city'] = null;
            }
        }
        $con = Propel::getConnection();
        $query = "INSERT INTO AmendmentBusinessDependentDetails
              (ProjectName, ProjectGeneralContractorName, ProjectOwnerName, ProjectAddress, ProjectCity, ProjectState, ProjectCountry, BidSituationId) 
               VALUES 
                ('" . $postedValues['project_name'] . "','" . $postedValues['general_contrator_name'] . "','" . $postedValues['project_owner_name'] . "' ,'" . $postedValues['project_street_address'] . "', '" . $postedValues['project_city'] . "', '" . $postedValues['project_state'] . "', '" . $postedValues['project_country'] . "', '" . $postedValues['bid_situation'] . "')";

        $insert = $con->prepare($query);
        if ($insert->execute()) {
            $STH = $con->query("SELECT CAST(COALESCE(SCOPE_IDENTITY(), @@IDENTITY) AS int)");
            $STH->execute();
            $result = $STH->fetch();
            $amendmentBusinessDependentDetailsId = $result[0];
        }
        return $amendmentBusinessDependentDetailsId;
    }

    private function InsertIntoAmendmentBrokerDetails($postedValues) {
        $subObj = new SubmissionDetails();
        if (isset($postedValues['retailBrokerName']) && $postedValues['wholesaler_retailer'] == 'Wholesaler') {
            $anendmentRetailBrokerDetailsId = $this->InsertIntoAmendmentRetailBrokerDetails($postedValues);
        } else {
            $anendmentRetailBrokerDetailsId = null;
        }
        if (!isset($postedValues['BrokerId'])) {
            $brokerId = $subObj->GetBrokerId($postedValues['brokerCode']);
            $brokerWiseCityId = $subObj->GetBrokerWiseId($postedValues['brokerCode'], $postedValues['brokerCityCode'], $postedValues['brokerStateCode']);
        } elseif (isset($postedValues['BrokerId']) && !empty($postedValues['BrokerId'])) {
            $brokerId = $postedValues['BrokerId'];
            $brokerWiseCityId = $postedValues['BrokerWiceCityId'];
        }
        $con = Propel::getConnection();
        $query = "INSERT INTO AmendmentBrokerDetails
              (BrokerId, BrokerWiceCityId, BrokerContactPersonId, BrokerCode, AmendmentRetailBrokerDetailsId) 
               VALUES 
               ('" . $brokerId . "','" . $brokerWiseCityId . "' ,'" . $postedValues['broker_contact_person'] . "', '" . $postedValues['broker_code'] . "', '" . $anendmentRetailBrokerDetailsId . "')";
        $insert = $con->prepare($query);
        if ($insert->execute()) {
            $STH = $con->query("SELECT CAST(COALESCE(SCOPE_IDENTITY(), @@IDENTITY) AS int)");
            $STH->execute();
            $result = $STH->fetch();
            $amendmentBrokerDetailsId = $result[0];
        }
        return $amendmentBrokerDetailsId;
    }

    private function InsertIntoAmendmentRetailBrokerDetails($postedValues) {
        $con = Propel::getConnection();
        $query = "INSERT INTO AmendmentRetailBrokerDetails
              (RetailBrokerName, RetailBrokerCountry, RetailBrokerState, RetailBrokerCity) 
               VALUES 
               ('" . $postedValues['retailBrokerName'] . "','" . $postedValues['retailbrokerCountryCode'] . "','" . $postedValues['retailbrokerStateCode'] . "' ,'" . $postedValues['retailbrokerCityCode'] . "')";
        $insert = $con->prepare($query);
        if ($insert->execute()) {
            $STH = $con->query("SELECT CAST(COALESCE(SCOPE_IDENTITY(), @@IDENTITY) AS int)");
            $STH->execute();
            $result = $STH->fetch();
            $amendmentRetailBrokerDetailsId = $result[0];
        }
        return $amendmentRetailBrokerDetailsId;
    }

    private function InsertIntoAmendmentPolicyDetails($postedValues) {
        if (isset($postedValues['flag']) && $postedValues['flag']=='Reversal') {
            $isBindDate = '1';
            $binddate = null;
        } else {
            $isBindDate = '0';
            $binddate = $postedValues['editbinddate'];
        }
        $con = Propel::getConnection();
        $query = "INSERT INTO AmendmentPolicyDetails
              (IsBindDate, BindDate, RenewableLookupId, DateofRenewal, PolicyTypeLookupId, DirectAssumedLookupId, AdimittedNonAdmittedLookupId, CompanyPaperLookupId, CompanyPaperNumberLookupId, PolicyNumber, CoverageId, SuffixLookupId, TransactionNumber, NAICCode, NAICTitle, SICCode, SICTitle, OFRCAdverseReportLookupId, FinalPolicyNumber,ClassNameLookupId,ClassCode,ClassDescription) 
               VALUES 
               ('" . $isBindDate . "','" . $binddate . "','" . $postedValues['editrenewable'] . "' ,'" . $postedValues['editdateofrenewal'] . "','" . $postedValues['editpolicyName'] . "','" . $postedValues['editdirectAssumed'] . "','" . $postedValues['editadmitted'] . "','" . $postedValues['editcompanyPaper'] . "','" . $postedValues['editcompanyPaperNumber'] . "','" . $postedValues['editpolicyNumber'] . "','" . $postedValues['editcoverage'] . "','" . $postedValues['editsuffix'] . "','" . $postedValues['edittransactionNumber'] . "','" . $postedValues['editnaicCode'] . "','" . $postedValues['editnaicTitle'] . "','" . $postedValues['editsicCode'] . "','" . $postedValues['editsicTitle'] . "','" . $postedValues['editofrcReport'] . "','" . $postedValues['hiddenPolicyNumber'] . "', '" . $postedValues['editamendmentclassName'] . "','" . $postedValues['editamendmentsubClass'] . "','" . $postedValues['editamendmentdescription'] . "')";
        $insert = $con->prepare($query);
        if ($insert->execute()) {
            $STH = $con->query("SELECT CAST(COALESCE(SCOPE_IDENTITY(), @@IDENTITY) AS int)");
            $STH->execute();
            $result = $STH->fetch();
            $amendmentPolicyDetailsId = $result[0];
        }
        return $amendmentPolicyDetailsId;
    }

    /* Insert into AmendmentFinancial Table to store Non Financial Information End */

    public function validateAmendmentSubmission($postValues, $groupId, $userGroup) {
        $emptyColumn = array();
        if (!empty($postValues['newrenewal']) && $postValues['newrenewal'] != 0) {
            
        } else {
            $emptyColumn[] = 'NewRenewal';
        }
        $productlineVal = '';
        $editSubObj = new EditSubmissionDetails();
        if (!empty($groupId) && $userGroup == 'master') {
            if (isset($postValues['editunderwriter']) && !empty($postValues['editunderwriter']) && $postValues['editunderwriter'] != 0) {
                $underwriter = $postValues['editunderwriter'];
            } else {
                $emptyColumn[] = 'Underwriter';
            }
            if (isset($postValues['productline_master']) && !empty($postValues['productline_master'])) {
                $productlineVal = $editSubObj->getLobName($postValues['productline_master']);
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
        if (!empty($primary_status) && $primary_status == '15') {
            if (isset($postValues['expityDate']) && !empty($postValues['expityDate'])) {
                
            } else {
                $emptyColumn[] = 'Expiry date';
            }
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
            if (!empty($postValues['dbaName'])) {
                
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

        if (isset($postValues['editcabcompanies']) && !empty($postValues['editcabcompanies'])) {
            
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
        if (isset($postValues['processdate']) && !empty($postValues['processdate'])) {
            
        } else {
            $emptyColumn[] = 'Process Date';
        }
        if (isset($postValues['premiumType']) && !empty($postValues['premiumType'])) {
            
        } else {
            $emptyColumn[] = 'Premium Type';
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
//        if (isset($postValues['editPermiumLocalCurency']) && !empty($postValues['editPermiumLocalCurency'])) {
//            
//        } else {
//            $emptyColumn[] = 'Net Premium in Local currency';
//        }
        if (isset($postValues['editrenewable']) && !empty($postValues['editrenewable'])) {
            
        } else {
            $emptyColumn[] = 'Renewable';
        }
        if (isset($postValues['editdateofrenewal']) && !empty($postValues['editdateofrenewal'])) {
            
        } else {
            $emptyColumn[] = 'Date of Renewal';
        }
//        if (!empty($productline) && ($productline == 'Casualty')) {
//            if (isset($postValues['editpolicyName']) && !empty($postValues['editpolicyName'])) {
//                
//            } else {
//                $emptyColumn[] = 'Policy Name';
//            }
//        }
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
//        echo "<pre>";
//        print_r($postValues);exit;
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

}
