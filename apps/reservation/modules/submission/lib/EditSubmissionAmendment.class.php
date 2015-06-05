<?php

class EditSubmissionAmendment {

    public function __construct() {
        $this->connection = Propel::getConnection();
    }

    public function FetchAmendmentSubmissionDetails($amendmentId) {
        $connection = $this->connection;
        $amendmentSubmissionQuery = "Select SA.Id As SubmissionAmendmentId,SA.SubmissionId,SA.SubmissionNumber,SA.NonFinancialAmendmentId,SA.FinancialAmendmentId,SA.QCStatus,SA.Remarks,SA.DataRecorderMetaDataId,
                                    AF.PremiunType,AF.IsPremium,AF.PremiumInLocalCurrency,AF.PremiumInUSD,AF.LayerofLimitInLocalCurrency,AF.LayerofLimitInUSD,AF.PercentageofLayer,AF.IsLimit,AF.LimitInLocalCurrency,AF.LimitInUSD,AF.IsAttachmentPoint,AF.AttachmentPointInLocalCurrency,AF.AttachmentPointInUSD,AF.SelfInsuredRetentionInLocalCurrency,AF.SelfInsuredRetentionInUSD,AF.PolicyCommPercentage,AF.PolicyCommInLocalCurrency,AF.PolicyCommInUSD,AF.PremiumNetofCommInLocalCurrency,AF.PremiumNetofCommInUSD,
                                    AN.AmendmentBusinessDependentDetailsId,AN.AmendmentBrokerDetailsId,AN.AmendmentPolicyDetailsId,AN.IsDuckSubmissionNumber,AN.DuckSubmissionNumber,AN.NewRenewalLookupId,AN.UnderwriterId,AN.LobId,AN.LobSubTypeId,AN.SectionId,AN.ProfitCodeId,AN.CurrentStatusId,AN.EffectiveDate,AN.ExpiryDate,AN.CurrencyTypeId,AN.ExchangeRate,AN.ExchangeDate,AN.InsuredId,AN.IsDifferentDba,AN.DbaName,AN.CABCompaniesLookupId,AN.ReinsuredCompany,AN.SubmissionIdentifier,AN.InsuredContactPersonId,AN.InsuredSubmissionDate,AN.InsuredQuoteDueDate,AN.IsTotalInsuredValue,AN.TotalInsuredValue,AN.TotalInsuredValueInUSD,AN.RiskProfile,AN.NumberOfLocationsId,AN.OccupancyCodeId,AN.ReasonCodeId,AN.ProcessDate,AN.IsBerksiBroker,AN.BerkSIDateFromBroker,AN.IsBerksiIndia,AN.BerkSiDateFromIndia,AN.BranchId,
                                    AB.ProjectName, AB.ProjectGeneralContractorName, AB.ProjectOwnerName, AB.ProjectAddress, AB.ProjectCity, AB.ProjectState, AB.ProjectCountry, AB.BidSituationId,
                                    AP.IsBindDate, AP.BindDate, AP.RenewableLookupId, AP.DateofRenewal, AP.PolicyTypeLookupId, AP.DirectAssumedLookupId, AP.AdimittedNonAdmittedLookupId, AP.CompanyPaperLookupId, AP.CompanyPaperNumberLookupId, AP.PolicyNumber, AP.CoverageId, AP.SuffixLookupId, AP.TransactionNumber, AP.NAICCode, AP.NAICTitle, AP.SICCode, AP.SICTitle, AP.OFRCAdverseReportLookupId, AP.FinalPolicyNumber,
                                    AP.ClassNameLookupId, AP.ClassCode,AP.ClassDescription,
                                    AR.RetailBrokerName, AR.RetailBrokerCountry, AR.RetailBrokerState, AR.RetailBrokerCity,
                                    ABD.AmendmentRetailBrokerDetailsId,ABD.BrokerId, ABD.BrokerWiceCityId, ABD.BrokerContactPersonId, ABD.BrokerCode, ABD.AmendmentRetailBrokerDetailsId 
                                    from dbo.SubmissionAmendment AS SA 
                                    Left Join AmendmentFinancial AS AF on AF.Id = SA.FinancialAmendmentId
                                    Left Join AmendmentNonFinancial AS AN on AN.Id = SA.NonFinancialAmendmentId
                                    Left Join AmendmentBusinessDependentDetails AS AB on AB.Id = AN.AmendmentBusinessDependentDetailsId
                                    Left Join AmendmentPolicyDetails AS AP on AP.Id = AN.AmendmentPolicyDetailsId
                                    Left Join AmendmentBrokerDetails AS ABD on ABD.Id = An.AmendmentBrokerDetailsId
                                    Left Join AmendmentRetailBrokerDetails AS AR on AR.Id = ABD.AmendmentRetailBrokerDetailsId
                                    Where SA.Id = '" . $amendmentId . "'";
        $amendmentSubmissionStatement = $connection->prepare($amendmentSubmissionQuery);
        $amendmentSubmissionStatement->execute();
        $amendmentSubmission = $amendmentSubmissionStatement->fetchAll(PDO::FETCH_ASSOC);
        return $amendmentSubmission;
    }

    public function GetAmendmentBrokerWiseCity($brokerwisecityId) {
        $connection = $this->connection;
        $amendmentbrokerquery = "select BW.BrokerId,BW.CityId,BW.StateId,BW.CountryId,BR.BrokerCode from dbo.BrokerWiseCity AS BW Left Join Broker AS BR on BR.Id=BW.BrokerId where BW.Id=" . $brokerwisecityId;
        $amendmentbrokerStatement = $connection->prepare($amendmentbrokerquery);
        $amendmentbrokerStatement->execute();
        $amendmentbrokerData = $amendmentbrokerStatement->fetchAll(PDO::FETCH_ASSOC);
        return $amendmentbrokerData;
    }

    public function GetQcStatus($statusName = null) {
        $connection = $this->connection;
        if (empty($statusName)) {
            $amendmentstatusquery = "Select Id from Lookup where LookupName = 'Pending'";
        } else {
            $amendmentstatusquery = "Select Id from Lookup where LookupName = '$statusName'";
        }
        $amendmentstatusStatement = $connection->prepare($amendmentstatusquery);
        $amendmentstatusStatement->execute();
        $amendmentStatusData = $amendmentstatusStatement->fetchAll(PDO::FETCH_ASSOC);
        return $amendmentStatusData[0]['Id'];
    }

    public function UpdateAmendmentSubmissionDetails($postedValues, $userId, $amendmentId, $userGroup) {
        $editSubObj = new EditSubmissionDetails();
        $editSubObj->UpdateDataRecorderMetaData($postedValues['dataRecorderId'], $userId);
        $this->UpdateAmendmentFinancialDetails($postedValues);
        $this->UpdateAmendmentNonFinancialDetails($postedValues);
        $qcStatusId = $this->GetQcStatus();
        $con = $this->connection;
        $query = "UPDATE SubmissionAmendment SET QCStatus = '" . $qcStatusId . "',  Remarks = '" . $postedValues['editamendmentRemark'] . "' WHERE Id = '" . $amendmentId . "'";
        $insert = $con->prepare($query);
        $insert->execute();
    }

    private function UpdateAmendmentFinancialDetails($postedValues) {
        if (!isset($postedValues['yesGross'])) {
            $isPremium = '0';
            $premiumLocalCurrency = $postedValues['gross_premium_text'];
        } else {
            $isPremium = '1';
            $premiumLocalCurrency = $postedValues['gross_premium_select'];
        }
        if (!isset($postedValues['yesLimit'])) {
            $isLimit = '0';
            $limitLocalCurrency = $postedValues['limit_text'];
        } else {
            $isLimit = '1';
            $limitLocalCurrency = $postedValues['limit_select'];
        }
        if (!isset($postedValues['yesAttachment'])) {
            $isAttachment = '0';
            $attachmentLocalCurrency = $postedValues['attachment_point_text'];
        } else {
            $isAttachment = '1';
            $attachmentLocalCurrency = $postedValues['attachment_point_select'];
        }
        $con = $this->connection;
        $query = "UPDATE AmendmentFinancial SET PremiunType = '" . $postedValues['premiumType'] . "',  IsPremium = '" . $isPremium . "', PremiumInLocalCurrency = '" . $premiumLocalCurrency . "', PremiumInUSD = '" . $postedValues['editamendmentlocalCurrency'] . "', LayerofLimitInLocalCurrency = '" . $postedValues['editamendmentLayerLimitLocalCurrency'] . "', LayerofLimitInUSD = '" . $postedValues['editamendmentLayerLimitLocalUSD'] . "',PercentageofLayer = '" . $postedValues['editamendmentPrecentageLayer'] . "', IsLimit = '" . $isLimit . "', LimitInLocalCurrency = '" . $limitLocalCurrency . "', LimitInUSD = '" . $postedValues['editamendmentlimitlocalcurrency'] . "',IsAttachmentPoint = '" . $isAttachment . "', AttachmentPointInLocalCurrency = '" . $attachmentLocalCurrency . "',AttachmentPointInUSD = '" . $postedValues['editamendmentattachmentlocalcurrency'] . "', SelfInsuredRetentionInLocalCurrency = '" . $postedValues['editamendmentselfRetrntionLocalCurrency'] . "', SelfInsuredRetentionInUSD = '" . $postedValues['editamendmentselfRetrntionUSD'] . "', PolicyCommPercentage = '" . $postedValues['editamendmentpolicyCommision'] . "',PolicyCommInLocalCurrency = '" . $postedValues['editamendmentpolicyCommisionLocalCurrrency'] . "', PolicyCommInUSD = '" . $postedValues['editamendmentpolicyCommisionUSD'] . "', 
                    PremiumNetofCommInLocalCurrency = '" . $postedValues['editamendmentPermiumLocalCurency'] . "', 
                    PremiumNetofCommInUSD = '" . $postedValues['editamendmentPermiumUSD'] . "' WHERE Id = '" . $postedValues['hiddenFinancialDetailsId'] . "'";
        $insert = $con->prepare($query);
        $insert->execute();
    }

    private function UpdateAmendmentNonFinancialDetails($postedValues) {
        $viewObj = new ViewSubmissionDetails();
        $getStatus = $viewObj->getStatus($postedValues['editamendmentprimarystatus']);
        $status = $getStatus[0]['StatusName'];
        if ($status == 'Cancellation') {
            $postedValues['expityDate'] = $postedValues['hiddenexpirydate'];
        } else {
            $postedValues['expityDate'] = $postedValues['expityDate'];
        }
        if ($postedValues['hiddenBusinessDetailsId'] !== '0') {
            $this->UpdateBusinessDependentDetails($postedValues);
        }
        $this->UpdatePolicyDetails($postedValues);
        $this->UpdateBrokerDetails($postedValues);

        if (!isset($postedValues['yesDuckSubmissionNumber'])) {
            $isDuckCreek = '0';
            $duckCreekNumber = $postedValues['editamendmentDuckSubmissionNumber'];
        } else {
            $isDuckCreek = '1';
            $duckCreekNumber = null;
        }
        if ($postedValues['insured_name_status'] == 'Y') {
            $isDba = '1';
            $dbaName = $postedValues['dbaName'];
        } else {
            $isDba = '0';
            $dbaName = null;
        }
        if (!isset($postedValues['yesTrue'])) {
            $isTrue = '0';
            $totalInsuredValueInLocalCurrency = $postedValues['editamendmenttotalinsuredvalue'];
        } else {
            $isTrue = '1';
            $totalInsuredValueInLocalCurrency = $postedValues['total_insured_value_select'];
        }
        if (isset($postedValues['received_date_by_berkshire'])) {
            $isBroker = '0';
            $dateByBerkshire = $postedValues['received_date_by_berkshire'];
        } else {
            $isBroker = '1';
            $dateByBerkshire = NULL;
        }
        if (isset($postedValues['received_date_by_india'])) {
            $isIndia = '0';
            $dateByIndia = $postedValues['received_date_by_india'];
        } else {
            $isIndia = '1';
            $dateByIndia = NULL;
        }

        $con = $this->connection;
        $query = "UPDATE AmendmentNonFinancial SET IsDuckSubmissionNumber = '" . $isDuckCreek . "',  DuckSubmissionNumber = '" . $duckCreekNumber . "', CurrentStatusId = '" . $postedValues['editamendmentprimarystatus'] . "', EffectiveDate = '" . $postedValues['effectiveDate'] . "', ExpiryDate = '" . $postedValues['expityDate'] . "', ExchangeRate = '" . $postedValues['editamendmentexchangeRate'] . "',ExchangeDate = '" . $postedValues['editamendmentexchangeRateDate'] . "', InsuredId = '" . $postedValues['insuredId'] . "', IsDifferentDba = '" . $isDba . "', DbaName = '" . $dbaName . "',SubmissionIdentifier = '" . $postedValues['editamendmentsubmissiontypeidrntifier'] . "', InsuredContactPersonId = '" . $postedValues['editamendmentinsuredContactPerson'] . "',InsuredSubmissionDate = '" . $postedValues['editamendmentinsuredSubmissionDate'] . "', InsuredQuoteDueDate = '" . $postedValues['editamendmentinsuredQuoteDueDate'] . "', IsTotalInsuredValue = '" . $isTrue . "', TotalInsuredValue = '" . $totalInsuredValueInLocalCurrency . "',TotalInsuredValueInUSD = '" . $postedValues['editamendmenttotalinsuredvalueinusd'] . "', RiskProfile = '" . $postedValues['editamendmentriskProfile'] . "', 
                    ProcessDate = '" . $postedValues['processdate'] . "', IsBerksiBroker = '" . $isBroker . "',BerkSIDateFromBroker = '" . $dateByBerkshire . "',IsBerksiIndia = '" . $isIndia . "', BerkSiDateFromIndia = '" . $dateByIndia . "',BranchId = '" . $postedValues['branch_office'] . "' WHERE Id = '" . $postedValues['hiddenNonFinancialDetailsId'] . "'";
        $insert = $con->prepare($query);
        $insert->execute();
    }

    private function UpdateBusinessDependentDetails($postedValues) {
        $con = $this->connection;
        $query = "UPDATE AmendmentBusinessDependentDetails SET ProjectName = '" . $postedValues['project_name'] . "',  ProjectGeneralContractorName = '" . $postedValues['general_contrator_name'] . "', ProjectOwnerName = '" . $postedValues['project_owner_name'] . "', ProjectAddress = '" . $postedValues['project_street_address'] . "'   WHERE Id = '" . $postedValues['hiddenBusinessDetailsId'] . "'";
        $insert = $con->prepare($query);
        $insert->execute();
    }

    private function UpdatePolicyDetails($postedValues) {
        $con = $this->connection;
        $query = "UPDATE AmendmentPolicyDetails SET RenewableLookupId = '" . $postedValues['editamendmentrenewable'] . "',  DateofRenewal = '" . $postedValues['editamendmentdateofrenewal'] . "', SICCode = '" . $postedValues['editamendmentsicCode'] . "', SICTitle = '" . $postedValues['editamendmentsicTitle'] . "' WHERE Id = '" . $postedValues['hiddenPolicyDetailsId'] . "'";
        $insert = $con->prepare($query);
        $insert->execute();
    }

    private function UpdateBrokerDetails($postedValues) {
        if ($postedValues['hiddenRetailBrokerDetailsId'] !== '0') {
            $this->UpdateRetailBrokerDetails($postedValues);
        }
        $subObj = new SubmissionDetails();
        $brokerId = $subObj->GetBrokerId($postedValues['brokerCode']);
        $brokerWiseCityId = $subObj->GetBrokerWiseId($postedValues['brokerCode'], $postedValues['brokerCityCode'], $postedValues['brokerStateCode']);
        $con = $this->connection;
        $query = "UPDATE AmendmentBrokerDetails SET BrokerId = '" . $brokerId . "',  BrokerWiceCityId = '" . $brokerWiseCityId . "', BrokerContactPersonId = '" . $postedValues['broker_contact_person'] . "', BrokerCode = '" . $postedValues['broker_code'] . "' WHERE Id = '" . $postedValues['hiddenBrokerDetailsId'] . "'";
        $insert = $con->prepare($query);
        $insert->execute();
    }

    private function UpdateRetailBrokerDetails($postedValues) {
        $con = $this->connection;
        $query = "UPDATE AmendmentRetailBrokerDetails SET RetailBrokerName = '" . $postedValues['retailBrokerName'] . "',  RetailBrokerCountry = '" . $postedValues['retailbrokerCountryCode'] . "', RetailBrokerState = '" . $postedValues['retailbrokerStateCode'] . "', RetailBrokerCity = '" . $postedValues['retailbrokerCityCode'] . "' WHERE Id = '" . $postedValues['hiddenRetailBrokerDetailsId'] . "'";
        $insert = $con->prepare($query);
        $insert->execute();
    }

    public function FetchAmendmentSubmissionList($submissionId, $isReversal, $cancelationCount, $flag) {
        $connection = $this->connection;
        $amendmentstatusquery = "Select * from AmendmentSubmission_Search where SubmissionId = '$submissionId'";
        $amendmentstatusStatement = $connection->prepare($amendmentstatusquery);
        $amendmentstatusStatement->execute();
        $amendmentStatus = $amendmentstatusStatement->fetchAll(PDO::FETCH_ASSOC);
        $amendmentStatusData = AmendmentList::FormateAmendmentList($amendmentStatus, $isReversal, $cancelationCount, $flag);
        return $amendmentStatusData;
    }

    public function UpdateAmendmentReversalChildDetails($postedValues, $userId, $amendmentId, $userGroup) {
        $editSubObj = new EditSubmissionDetails();
        $editSubObj->UpdateDataRecorderMetaData($postedValues['dataRecorderId'], $userId);
        $this->UpdateAmendmentNonFinancialReversalChildDetails($postedValues);
        $qcStatusId = $this->GetQcStatus();
        $con = $this->connection;
        $query = "UPDATE SubmissionAmendment SET QCStatus = '" . $qcStatusId . "',  Remarks = '" . $postedValues['editamendmentRemark'] . "' WHERE Id = '" . $amendmentId . "'";
        $insert = $con->prepare($query);
        $insert->execute();
    }

    private function UpdateAmendmentNonFinancialReversalChildDetails($postedValues) {
        $con = $this->connection;
        $query = "UPDATE AmendmentNonFinancial SET ProcessDate = '" . $postedValues['processdate'] . "' WHERE Id = '" . $postedValues['hiddenNonFinancialDetailsId'] . "'";
        $insert = $con->prepare($query);
        $insert->execute();
    }

    public function validateAmendmentEditSubmission($postValues, $groupId) {
        $emptyColumn = array();

        if (!empty($postValues['newrenewal']) && $postValues['newrenewal'] != 0) {
            
        } else {
            $emptyColumn[] = 'NewRenewal';
        }
        $productlineVal = '';
        $editSubObj = new EditSubmissionDetails();
        if (!empty($groupId) && $groupId == 58) {
            if (isset($postValues['editamendmentunderwriter']) && !empty($postValues['editamendmentunderwriter']) && $postValues['editamendmentunderwriter'] != 0) {
                $underwriter = $postValues['editamendmentunderwriter'];
            } else {
                $emptyColumn[] = 'Underwriter';
            }
            if (isset($postValues['productline_master']) && !empty($postValues['productline_master'])) {
                $productlineVal = $editSubObj->getLobName($postValues['productline_master']);
                $productline = trim($productlineVal[0]['LOBName']);
            } else {
                $emptyColumn[] = 'Product line';
            }
            if (isset($postValues['editamendmentproductlinesubtype_master']) && !empty($postValues['editamendmentproductlinesubtype_master']) && $postValues['editamendmentproductlinesubtype_master'] != 0) {
                $productlinesubtype = $postValues['editamendmentproductlinesubtype_master'];
            } else {
                $emptyColumn[] = 'product line subtype';
            }
            if (isset($postValues['editamendmentsection_master']) && !empty($postValues['editamendmentsection_master']) && $postValues['editamendmentsection_master'] != 0) {
                $section = $postValues['editamendmentsection_master'];
            } else {
                $emptyColumn[] = 'Section';
            }
            if (isset($postValues['editamendmentprofitcode_master']) && !empty($postValues['editamendmentprofitcode_master']) && $postValues['editamendmentprofitcode_master'] != 0) {
                $profitcode = $postValues['editamendmentprofitcode_master'];
            } else {
                $emptyColumn[] = 'Profitcode';
            }
            if (isset($postValues['editamendmentprimarystatus']) && !empty($postValues['editamendmentprimarystatus']) && $postValues['editamendmentprimarystatus'] != 0) {
                $primary_status = $postValues['editamendmentprimarystatus'];
            } else {
                $emptyColumn[] = 'Primary status';
            }
        } else {
            if (isset($postValues['editamendmentunderwriter']) && !empty($postValues['editamendmentunderwriter']) && $postValues['editamendmentunderwriter'] != 0) {
                $underwriter = $postValues['editamendmentunderwriter'];
            } else {
                $emptyColumn[] = 'Underwriter';
            }
            if (isset($postValues['editamendmentproductline']) && !empty($postValues['editamendmentproductline'])) {
                $productline = $postValues['editamendmentproductline'];
            } else {
                $emptyColumn[] = 'Product line';
            }
            if (isset($postValues['editamendmentproductlinesubtype']) && !empty($postValues['editamendmentproductlinesubtype']) && $postValues['editamendmentproductlinesubtype'] != 0) {
                $productlinesubtype = $postValues['editamendmentproductlinesubtype'];
            } else {
                $emptyColumn[] = 'product line subtype';
            }
            if (isset($postValues['editamendmentsection']) && !empty($postValues['editamendmentsection']) && $postValues['editamendmentsection'] != 0) {
                $section = $postValues['editamendmentsection'];
            } else {
                $emptyColumn[] = 'Section';
            }
            if (isset($postValues['editamendmentprofitcode']) && !empty($postValues['editamendmentprofitcode']) && $postValues['editamendmentprofitcode'] != 0) {
                $profitcode = $postValues['editamendmentprofitcode'];
            } else {
                $emptyColumn[] = 'Profitcode';
            }
            if (isset($postValues['editamendmentprimarystatus']) && !empty($postValues['editamendmentprimarystatus']) && $postValues['editamendmentprimarystatus'] != 0) {
                $primary_status = $postValues['editamendmentprimarystatus'];
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
        if (isset($postValues['editamendmentcurrency']) && !empty($postValues['editamendmentcurrency']) && $postValues['editamendmentcurrency'] != 0) {
            
        } else {
            $emptyColumn[] = 'Currency';
        }
        if (isset($postValues['editamendmentexchangeRate']) && !empty($postValues['editamendmentexchangeRate'])) {
            
        } else {
            $emptyColumn[] = 'Exchange Rate';
        }
        if (isset($postValues['editamendmentexchangeRateDate']) && !empty($postValues['editamendmentexchangeRateDate'])) {
            
        } else {
            $emptyColumn[] = 'Exchange Rate Date';
        }
        if (isset($postValues['editamendmentinsuredname']) && !empty($postValues['editamendmentinsuredname'])) {
            
        } else {
            $emptyColumn[] = 'Insured Name';
        }
        if (isset($postValues['insured_name_status']) && $postValues['insured_name_status'] == 'Y') {
            if (!empty($postValues['dbaName'])) {
                
            } else {
                $emptyColumn[] = 'DBA Name';
            }
        }
        if (isset($postValues['editamendmentinsuredContactPerson']) && !empty($postValues['editamendmentinsuredContactPerson'])) {
            
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
        if (isset($postValues['editamendmentcabcompanies']) && !empty($postValues['editamendmentcabcompanies'])) {
            
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
            if (isset($postValues['editamendmentLayerLimitLocalCurrency']) && !empty($postValues['editamendmentLayerLimitLocalCurrency'])) {
                
            } else {
                $emptyColumn[] = 'Layer of limit in Local Currency';
            }

            if (isset($postValues['editamendmentselfRetrntionLocalCurrency']) && !empty($postValues['editamendmentselfRetrntionLocalCurrency'])) {
                
            } else {
                $emptyColumn[] = 'Self Retention in Local currency';
            }
        }
        if (!empty($productline) && ($productline == 'Exec & Prof')) {
            if (isset($postValues['editamendmentPrecentageLayer']) && !empty($postValues['editamendmentPrecentageLayer'])) {
                
            } else {
                $emptyColumn[] = '% of layer';
            }
        }

        if (isset($postValues['attachment_point_text']) && !empty($postValues['attachment_point_text'])) {
            
        } else if (isset($postValues['attachment_point_select']) && !empty($postValues['attachment_point_select'])) {
            
        } else {
            $emptyColumn[] = 'Attachment point in Local Currency';
        }
        if (isset($postValues['editamendmentpolicyCommision']) && !empty($postValues['editamendmentpolicyCommision'])) {
            
        } else {
            $emptyColumn[] = 'Policy Commission';
        }
//        if (isset($postValues['editamendmentPermiumLocalCurency']) && !empty($postValues['editamendmentPermiumLocalCurency'])) {
//            
//        } else {
//            $emptyColumn[] = 'Net Premium in Local currency';
//        }
        if (isset($postValues['editamendmentrenewable']) && !empty($postValues['editamendmentrenewable'])) {
            
        } else {
            $emptyColumn[] = 'Renewable';
        }
        if (isset($postValues['editamendmentdateofrenewal']) && !empty($postValues['editamendmentdateofrenewal'])) {
            
        } else {
            $emptyColumn[] = 'Date of Renewal';
        }
//        if (!empty($productline) && ($productline == 'Casualty')) {
//            if (isset($postValues['editamendmentpolicyName']) && !empty($postValues['editamendmentpolicyName'])) {
//                
//            } else {
//                $emptyColumn[] = 'Policy Name';
//            }
//        }
        if (isset($postValues['editamendmentdirectAssumed']) && !empty($postValues['editamendmentdirectAssumed'])) {
            
        } else {
            $emptyColumn[] = 'Direct/Assumed';
        }
        if (isset($postValues['editamendmentadmitted']) && !empty($postValues['editamendmentadmitted'])) {
            
        } else {
            $emptyColumn[] = 'Admitted/Not-admitted';
        }
        if (isset($postValues['editamendmentcompanyPaper']) && !empty($postValues['editamendmentcompanyPaper'])) {
            
        } else {
            $emptyColumn[] = 'Company paper';
        }
        if (isset($postValues['editamendmentcompanyPaperNumber']) && !empty($postValues['editamendmentcompanyPaperNumber'])) {
            
        } else {
            $emptyColumn[] = 'Company paper number';
        }
        if (isset($postValues['editamendmentpolicyNumber']) && !empty($postValues['editamendmentpolicyNumber'])) {
            
        } else {
            $emptyColumn[] = 'Policy number';
        }
        if (isset($postValues['editamendmentcoverage']) && !empty($postValues['editamendmentcoverage'])) {
            
        } else {
            $emptyColumn[] = 'Coverage';
        }
        if (isset($postValues['editamendmentsuffix']) && !empty($postValues['editamendmentsuffix'])) {
            
        } else {
            $emptyColumn[] = 'Suffix';
        }
        if (isset($postValues['editamendmenttransactionNumber']) && !empty($postValues['editamendmenttransactionNumber'])) {
            
        } else {
            $emptyColumn[] = 'Transaction Number';
        }
        if (isset($postValues['editamendmentnaicCode']) && !empty($postValues['editamendmentnaicCode'])) {
            
        } else {
            $emptyColumn[] = 'NAIC Code';
        }
        if (isset($postValues['editamendmentnaicTitle']) && !empty($postValues['editamendmentnaicTitle'])) {
            
        } else {
            $emptyColumn[] = 'NAIC Title';
        }

        if (isset($postValues['editamendmentsicCode']) && !empty($postValues['editamendmentsicCode'])) {
            
        } else {
            $emptyColumn[] = 'SIC Code';
        }
        if (isset($postValues['editamendmentsicTitle']) && !empty($postValues['editamendmentsicTitle'])) {
            
        } else {
            $emptyColumn[] = 'SIC Title';
        }
        if (isset($postValues['editamendmentofrcReport']) && !empty($postValues['editamendmentofrcReport'])) {
            
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

    public function getSubmissionEffectiveDate($amendmentId) {
        $con = $this->connection;
        $query = 'SELECT SubmissionId from SubmissionAmendment where Id =' . $amendmentId;
        $amendmentPrepare = $con->prepare($query);
        $amendmentPrepare->execute();
        $amendmentSubmission = $amendmentPrepare->fetchAll(PDO::FETCH_ASSOC);
        $submissionId = $amendmentSubmission[0]['SubmissionId'];
        //getting original submission effective date from submission table
        $query = 'SELECT EffectiveDate from Submission where Id =' . $submissionId;
        $EffectiveDatePrepare = $con->prepare($query);
        $EffectiveDatePrepare->execute();
        $originalEffectiveDate = $EffectiveDatePrepare->fetchAll(PDO::FETCH_ASSOC);
        $submissionEffectivedate = date('Y-m-d', strtotime($originalEffectiveDate[0]['EffectiveDate']));
        return $submissionEffectivedate;
    }

    public function getSubmissionEffectiveDateBySubId($submissionId) {
        $con = $this->connection;
        $query = 'SELECT EffectiveDate from Submission where Id =' . $submissionId;
        $EffectiveDatePrepare = $con->prepare($query);
        $EffectiveDatePrepare->execute();
        $originalEffectiveDate = $EffectiveDatePrepare->fetchAll(PDO::FETCH_ASSOC);
        $submissionEffectivedate = date('Y-m-d', strtotime($originalEffectiveDate[0]['EffectiveDate']));
        return $submissionEffectivedate;
    }

}
