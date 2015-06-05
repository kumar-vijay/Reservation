<?php

class Export {

    public function __construct() {
        $this->_con = Propel::getConnection();
    }

    public function exportCSV($arrWhere) {
        $amenObj = new AmendmentExport();
        ob_end_clean();
        ini_set("max_execution_time", 0);
        ini_set("upload_max_filesize", 0);
        ini_set("post_max_size", '200M');
        ini_set('memory_limit', -1);
        $where = "WHERE 1=1 ";
        if ($arrWhere['SubmissionNo'])
            $where .= "AND SV.SubmissionNumber LIKE '" . substr(trim($arrWhere['SubmissionNo']), 0, -3). "%'";

        if ($arrWhere['NewRenewal'])
            $where .= "AND SV.NewRenewal LIKE '" . $arrWhere['NewRenewal'] . "'";

        if ($arrWhere['InsuredName'])
            $where .= "AND SV.InsuredName LIKE '%" . $arrWhere['InsuredName'] . "%' ";

        if ($arrWhere['UnderwriterName']) {
            $where .= "AND (SV.UnderWriterName LIKE '" . $arrWhere['UnderwriterName'] . "'
                        OR SV.UnderWriterName LIKE '%" . $arrWhere['UnderwriterName'] . "%') ";
        }
        if ($arrWhere['Status'])
            $where .= "AND SV.CurrentStatus LIKE '%" . $arrWhere['Status'] . "%' ";

        if ($arrWhere['Branch'])
            $where .= "AND SV.BranchOffice LIKE '%" . $arrWhere['Branch'] . "%' ";

        if ($arrWhere['ReasonCode'])
            $where .= "AND SV.ReasonCode LIKE '%" . $arrWhere['ReasonCode'] . "%' ";

        if ($arrWhere['ProductLine'])
            $where .= "AND SV.PropertyType LIKE '%" . $arrWhere['ProductLine'] . "%' ";

        if ($arrWhere['ProductLineSubType'])
            $where .= "AND SV.PropertyLineSubType LIKE '%" . $arrWhere['ProductLineSubType'] . "%' ";

        if ($arrWhere['Section'])
            $where .= "AND SV.SectionCode LIKE '%" . $arrWhere['Section'] . "%' ";

        if ($arrWhere['ProfitCode'])
            $where .= "AND SV.ProfitCode LIKE '%" . $arrWhere['ProfitCode'] . "%' ";

        if ($arrWhere['BrokerName'])
            $where .= "AND SV.BrokerName LIKE '%" . $arrWhere['BrokerName'] . "%' ";

        if ($arrWhere['BrokerType'])
            $where .= "AND SV.BrokerType LIKE '%" . $arrWhere['BrokerType'] . "%' ";

        if ($arrWhere['BrokerCity'])
            $where .= "AND SV.BrokerCity LIKE '%" . $arrWhere['BrokerCity'] . "%' ";

        if ($arrWhere['CabCompanies'])
            $where .= "AND SV.CabCompanies LIKE '%" . $arrWhere['CabCompanies'] . "%' ";

        if ($arrWhere['QcStatus'])
            $where .= "AND SV.QcStatus LIKE '%" . $arrWhere['QcStatus'] . "%' ";

        if ($arrWhere['EffectiveFromDate'])
            $where .= "AND SV.EffectiveDate >= '" . date("Y-m-d", strtotime($arrWhere['EffectiveFromDate'])) . "' ";

        if ($arrWhere['EffectiveToDate'])
            $where .= "AND EffectiveDate <= '" . date("Y-m-d", strtotime($arrWhere['EffectiveToDate'])) . "' ";

        if ($arrWhere['ExpirationFromDate'])
            $where .= "AND SV.ExpiryDate >= '" . date("Y-m-d", strtotime($arrWhere['ExpirationFromDate'])) . "' ";

        if ($arrWhere['ExpirationToDate'])
            $where .= "AND ExpiryDate <= '" . date("Y-m-d", strtotime($arrWhere['ExpirationToDate'] . ' + 1 day')) . "' ";

        if ($arrWhere['SubmissionFromDate'])
            $where .= "AND SV.CreatedDate >= '" . date("Y-m-d H:i:s", strtotime($arrWhere['SubmissionFromDate'])) . "' ";

        if ($arrWhere['SubmissionToDate'])
            $where .= "AND SV.CreatedDate <= '" . date("Y-m-d H:i:s", strtotime($arrWhere['SubmissionToDate'])) . "' ";

        if ($arrWhere['ProcessFromDate'])
            $where .= "AND SV.ProcessDate >= '" . date("Y-m-d H:i:s", strtotime($arrWhere['ProcessFromDate'])) . "' ";

        if ($arrWhere['ProcessToDate'])
            $where .= "AND SV.ProcessDate <= '" . date("Y-m-d H:i:s", strtotime($arrWhere['ProcessToDate'])) . "' ";

        if ($arrWhere['NumberOfLocations'])
            $where .= "AND SV.AlternativeState LIKE '%" . $arrWhere['NumberOfLocations'] . "%' ";

        if ($arrWhere['OccupancyCode'])
            $where .= "AND SV.AlternativeZipCode LIKE '%" . $arrWhere['OccupancyCode'] . "%' ";

        $con = Propel::getConnection();
        $stmt = $con->query("SELECT COUNT(*) AS COUNT FROM Submission_Search;");
        $count = $stmt->fetch(PDO::FETCH_OBJ);

        $myArray['brokerEmail'] = "Broker Contact Person's Email";
        $myArray['brokerNumber'] = "Broker Contact Person's Phone No.";
        $myArray['brokerMobile'] = "Broker Contact Person's Mobile No.";
        $myArray['insuredCountry'] = "Insured's Country";
        $myArray['insuredState'] = "Insured's State/ Territory Code";
        $myArray['insuredCity'] = "Insured's City";
        $myArray['insuredZip'] = "Insured's Zip code";
        $myArray['insuredContactPersonEmail'] = "Insured Contact Person's Email";
        $myArray['insuredContactPersonPhone'] = "Insured Contact Person's Phone No.";
        $myArray['insuredContactPersonMobile'] = "Insured Contact Person's Mobile No.";

        if (!empty($count->COUNT)) {
            $amenObj->CreateTempraryCode();
            $amenObj->InsertSubmissionDataIntoTempTable($where);
            $result = $amenObj->GetExportData();
            $heading = array('Work item /Submission no.', 'Duckcreek Submission Number', 'Master Policy Number', 'New/Renewal', 'Insured Name', 'Advisen ID', 'Submission Type Identifier', 'Underwriter', 'Product Line', 'Product Line Subtype', 'Section', 'Profit Code', 'Current Status', 'Effective Date', 'Expiry Date', 'Process Date', 'Bind Date', 'Renewable (Y/N)', 'Date of Renewal', 'Policy Type', 'Direct/Assumed', 'Company Paper', 'Company Paper Number', 'Coverage', 'Policy Number', 'Suffix', 'Transaction Number', 'Admitted/Non-Admitted', 'Broker Name', 'Type of Broker', 'Sub-type of Broker', 'Broker Contact Person', 'Broker Country', 'Broker State', 'Broker City', 'Broker Street Address', 'Broker Zipcode', 'Broker Code', $myArray['brokerEmail'], $myArray['brokerNumber'], $myArray['brokerMobile'], 'Retail Broker', 'Retail Broker Country', 'Retail Broker State', 'Retail Broker City', 'Branch Office', 'Currency', 'Exchange Rate', 'Exchange Rate as on', 'Layer of Limit in Local Currency', 'Layer of Limit(in USD)', '% of Layer', 'Limit in Local Currency', 'Limit(in USD)', 'Attachment Point in Local Currency', 'Attachment Point(in USD)', 'Self Insured Retention in Local Currency', 'Self Insured Retention(in USD)', 'Premium in Local Currency', 'Premium(in USD)', 'Policy Comm %', 'Policy Comm in Local Currency', 'Policy Comm(in USD)', 'Premium(Net of Commission)', 'Premium(Net of Commission) in USD', 'Reason Code', 'Priority Companies', 'Total Insured Value (TIV) in Local Currency', 'Total Insured Value (TIV) in USD', 'Occupancy Code', 'Number Of Locations(greater than 3)', 'Risk Profile', 'Project Name', 'Name of General Contractor', 'Project Owner Name', 'Project Street Address', 'Project Country', 'Project State', 'Project City', 'Bid Situation', 'Reinsured Company', 'D&B Number', 'NAIC Code', 'NAIC Title', 'OFRC Adverse report', 'DBA Name', $myArray['insuredCountry'], $myArray['insuredState'], $myArray['insuredCity'], 'Insured Mailing Address line 1', $myArray['insuredZip'], 'Insured Contact Person', $myArray['insuredContactPersonEmail'], $myArray['insuredContactPersonPhone'], $myArray['insuredContactPersonMobile'], 'Insured Submission Date', 'Insured Quote Due Date', 'By Berk SI FROM Broker', 'By India FROM Berk SI', 'Date 1', 'Status 1', 'Remarks 1', 'Date 2', 'Status 2', 'Remarks 2', 'Date 3', 'Status 3', 'Remarks 3', 'Date 4', 'Status 4', 'Remarks 4', 'Date 5', 'Status 5', 'Remarks 5');
            $this->download_send_headers("SubmissionSystem_Export_" . date("Y-m-d") . ".csv");
            echo $this->arraycsv($result, $heading);
            die();
        }
    }

    public function exportQCCSV($arrWhere) {
        ob_end_clean();
        ini_set("max_execution_time", 0);
        ini_set("upload_max_filesize", 0);
        ini_set("post_max_size", '200M');
        ini_set('memory_limit', -1);
        $where = "WHERE 1=1 ";
        if ($arrWhere['SubmissionNo'])
            $where .= "AND SV.SubmissionNumber LIKE '" . $arrWhere['SubmissionNo'] . "'";

        if ($arrWhere['NewRenewal'])
            $where .= "AND SV.NewRenewal LIKE '" . $arrWhere['NewRenewal'] . "'";

        if ($arrWhere['InsuredName'])
            $where .= "AND SV.InsuredName LIKE '%" . $arrWhere['InsuredName'] . "%' ";

        if ($arrWhere['Underwriter']) {
            $where .= "AND (SV.UnderWriterName LIKE '" . $arrWhere['Underwriter'] . "'
                        OR SV.UnderWriterName LIKE '%" . $arrWhere['Underwriter'] . "%') ";
        }
        if ($arrWhere['Status'])
            $where .= "AND SV.CurrentStatus LIKE '%" . $arrWhere['Status'] . "%' ";

        if ($arrWhere['Branch'])
            $where .= "AND SV.BranchOffice LIKE '%" . $arrWhere['Branch'] . "%' ";

        if ($arrWhere['ReasonCode'])
            $where .= "AND SV.ReasonCode LIKE '%" . $arrWhere['ReasonCode'] . "%' ";

        if ($arrWhere['ProductLine'])
            $where .= "AND SV.PropertyType LIKE '%" . $arrWhere['ProductLine'] . "%' ";

        if ($arrWhere['ProductLineSubType'])
            $where .= "AND SV.PropertyLineSubType LIKE '%" . $arrWhere['ProductLineSubType'] . "%' ";

        if ($arrWhere['Section'])
            $where .= "AND SV.SectionCode LIKE '%" . $arrWhere['Section'] . "%' ";

        if ($arrWhere['ProfitCode'])
            $where .= "AND SV.ProfitCode LIKE '%" . $arrWhere['ProfitCode'] . "%' ";

        if ($arrWhere['BrokerName'])
            $where .= "AND SV.BrokerName LIKE '%" . $arrWhere['BrokerName'] . "%' ";

        if ($arrWhere['BrokerType'])
            $where .= "AND SV.BrokerType LIKE '%" . $arrWhere['BrokerType'] . "%' ";

        if ($arrWhere['BrokerCity'])
            $where .= "AND SV.BrokerCity LIKE '%" . $arrWhere['BrokerCity'] . "%' ";

        if ($arrWhere['CabCompanies'])
            $where .= "AND SV.CabCompanies LIKE '%" . $arrWhere['CabCompanies'] . "%' ";

        if ($arrWhere['QcStatus'])
            $where .= "AND SV.QcStatus LIKE '%" . $arrWhere['QcStatus'] . "%' ";

        if ($arrWhere['EffectiveFromDate'])
            $where .= "AND SV.EffectiveDate >= '" . date("Y-m-d", strtotime($arrWhere['EffectiveFromDate'])) . "' ";

        if ($arrWhere['EffectiveToDate'])
            $where .= "AND EffectiveDate <= '" . date("Y-m-d", strtotime($arrWhere['EffectiveToDate'])) . "' ";

        if ($arrWhere['ExpirationFromDate'])
            $where .= "AND SV.ExpiryDate >= '" . date("Y-m-d", strtotime($arrWhere['ExpirationFromDate'])) . "' ";

        if ($arrWhere['ExpirationToDate'])
            $where .= "AND ExpiryDate <= '" . date("Y-m-d", strtotime($arrWhere['ExpirationToDate'])) . "' ";

        if ($arrWhere['SubmissionFromDate'])
            $where .= "AND SV.CreatedDate >= '" . date("Y-m-d H:i:s", strtotime($arrWhere['SubmissionFromDate'])) . "' ";

        if ($arrWhere['SubmissionToDate'])
            $where .= "AND SV.CreatedDate <= '" . date("Y-m-d H:i:s", strtotime($arrWhere['SubmissionToDate'])) . "' ";

        if ($arrWhere['ProcessFromDate'])
            $where .= "AND SV.ProcessDate >= '" . date("Y-m-d H:i:s", strtotime($arrWhere['ProcessFromDate'])) . "' ";

        if ($arrWhere['ProcessToDate'])
            $where .= "AND SV.ProcessDate <= '" . date("Y-m-d H:i:s", strtotime($arrWhere['ProcessToDate'])) . "' ";

        if ($arrWhere['NumberOfLocations'])
            $where .= "AND SV.AlternativeState LIKE '%" . $arrWhere['NumberOfLocations'] . "%' ";

        if ($arrWhere['OccupancyCode'])
            $where .= "AND SV.AlternativeZipCode LIKE '%" . $arrWhere['OccupancyCode'] . "%' ";

        $con = $this->_con;
        $stmt = $con->query("SELECT COUNT(*) AS COUNT FROM Qc_Search;");
        $count = $stmt->fetch(PDO::FETCH_OBJ);

        $myArray['brokerEmail'] = "Broker Contact Person's Email";
        $myArray['brokerNumber'] = "Broker Contact Person's Phone No.";
        $myArray['brokerMobile'] = "Broker Contact Person's Mobile No.";
        $myArray['insuredCountry'] = "Insured's Country";
        $myArray['insuredState'] = "Insured's State/ Territory Code";
        $myArray['insuredCity'] = "Insured's City";
        $myArray['insuredZip'] = "Insured's Zip code";
        $myArray['insuredContactPersonEmail'] = "Insured Contact Person's Email";
        $myArray['insuredContactPersonPhone'] = "Insured Contact Person's Phone No.";
        $myArray['insuredContactPersonMobile'] = "Insured Contact Person's Mobile No.";

        if (!empty($count->COUNT)) {
            $stmt = $con->query("SELECT SV.SubmissionId AS Id, SV.SubmissionNumber AS SubmissionNumber,SV.DuckCreekSubmissionNumber AS DuckCreekSubmissionNumber,SV.MasterPolicyNumber AS MasterPolicyNumber, SV.NewRenewal AS NewRenewal, SV.InsuredName AS InsuredName, SV.AdvisenId AS AdvisenId, SV.ReasonCodeMeaning AS ReasonCodeMeaning, SV.UnderWriterName AS Underwriter, SV.PropertyType AS ProductLine, SV.PropertyLineSubType AS ProductLineSubType, SV.SectionCode AS Section, SV.ProfitCode AS ProfitCode, 
                                SV.CurrentStatus AS CurrentStatus, CONVERT(INT, CONVERT(DATETIME,SV.EffectiveDate))+2 AS EffectiveDate, CONVERT(INT, CONVERT(DATETIME,SV.ExpiryDate))+2 AS ExpiryDate, CONVERT(INT, CONVERT(DATETIME,SV.ProcessDate))+2 AS ProcessDate, CONVERT(INT, CONVERT(DATETIME,SV.BindDate))+2 AS BindDate, SV.Renewable AS Renewable, CONVERT(INT, CONVERT(DATETIME,SV.DateOfRenewal))+2 AS DateOfRenewal,
                                SV.PolicyType AS PolicyType, SV.DirectAssumed AS DirectAssumed, SV.CompanyPaper AS CompanyPaper, SV.CompanyPaperNumber AS CompanyPaperNumber, SV.Coverage AS Coverage, SV.PolicyNumber AS PolicyNumber, SV.Suffix AS Suffix, SV.TransactionNumber AS TransactionNumber, SV.AdmittedNonAdmitted AS AdmittedNonAdmitted,
                                SV.BrokerName AS BrokerName, SV.BrokerType AS BrokerType, SV.AlternativeAddress1 AS AlternativeAddress1, SV.BrokerContactPerson AS BrokerContactPerson,SV.BrokerCountry AS BrokerCountry, SV.BrokerState AS BrokerState, SV.BrokerCity AS BrokerCity, SV.BrokerContactPersonStreetAddress AS BrokerContactPersonStreetAddress, SV.BrokerContactPersonZipCode AS BrokerContactPersonZipCode,
                                SV.BrokerCode AS BrokerCode,SV.BrokerContactPersonEmail AS BrokerContactPersonEmail, SV.BrokerContactPersonNumber AS BrokerContactPersonNumber, SV.BrokerContactPersonMobile AS BrokerContactPersonMobile, SV.RetailBrokerName AS RetailBroker, SV.RetailBrokerCountry AS RetailBrokerCountry, SV.RetailBrokerState AS RetailBrokerState, SV.RetailBrokerCity AS RetailBrokerCity, SV.BranchOffice AS BrancOffice,
                                SV.Currency AS Currency,SV.ExchangeRate AS ExchangeRate, CONVERT(INT, CONVERT(DATETIME,SV.ExchangeDate))+2 AS ExchangeDate, SV.LayerofLimitInLocalCurrency AS LayerofLimitInLocalCurrency, SV.LayerofLimitInUSD AS LayerofLimitInUSD, SV.PercentageofLayer AS PercentageofLayer, SV.StatusLimit AS Limit, SV.LimitInUSD AS LimitUSD, SV.AttachmentPoint AS AttachmentPoint,SV.AttachmentPointInUSD AS AttachmentPointUSD,
                                SV.SelfInsuredRetentionInLocalCurrency AS SelfInsuredRetentionInLocalCurrency, SV.SelfInsuredRetentionInUSD AS SelfInsuredRetentionInUSD, SV.GrossPremium AS OriginalPremium,SV.GrossPremiumInUSD AS GrossPremiumUSD, SV.PolicyCommPercentage AS PolicyCommPercentage, SV.PolicyCommInLocalCurrency AS PolicyCommInLocalCurrency, SV.PolicyCommInUSD AS PolicyCommInUSD, SV.PermiumNetofCommInLocalCurrency AS PermiumNetofCommInLocalCurrency,
                                SV.PermiumNetofCommInUSD AS PermiumNetofCommInUSD,SV.ReasonCode AS ReasonCode, SV.CabCompanies AS CabCompanies, SV.TotalInsuredValue AS TotalInsuredValue, SV.TotalInsuredValueInUSD AS TotalInsuredValueInUSD, SV.AlternativeZipCode AS AlternativeZipCode, SV.AlternativeState AS AlternativeState, SV.RiskProfile,
                                SV.ProjectName AS ProjectName, SV.ProjectContractorName AS GeneralContractor, SV.ProjectOwnerName AS ProjectOwnerName, SV.ProjectAddressLine1 AS ProjectStreetAddress, SV.ProjectCountry AS ProjectCountry, SV.ProjectState AS ProjectState, SV.ProjectCity AS ProjectCity, SV.BidSituation AS BidSituation,
                                SV.ReinsuredCompany AS ReinsuredCompany, SV.DbNumber AS DBNumber, SV.NAICCode AS NAICCode, SV.NAICTitle AS NAICTitle, SV.OfrcReport AS OfrcReport, SV.DbaName AS DBAName, SV.InsuredCountry AS InsuredCountry, SV.InsuredState AS InsuredState, SV.InsuredCity AS InsuredCity, 
                                SV.InsuredAddress1 AS InsuredMailingAddress1, SV.InsuredZipCode AS InsuredZipcode, SV.InsuredContactPerson AS InsuredContactPerson, SV.InsuredContactPersonEmail As InsuredContactPersonEmail, SV.InsuredContactPersonPhoneNumber AS InsuredContactPersonPhone, SV.InsuredContactPersonMobileNumber AS InsuredContactPersonMobile,
                                CONVERT(INT, CONVERT(DATETIME,SV.InsuredSubmissionDate))+2 AS InsuredSubmissionDate, CONVERT(INT, CONVERT(DATETIME,SV.InsuredQuoteDueDate))+2 AS insuredQuoteDueDate ,CONVERT(float, CONVERT(DATETIME,SV.DateOfRecievingByBroker))+2 AS ByBerksiFromBroker, CONVERT(INT, CONVERT(DATETIME,SV.DateOfrecievingByIndia))+2 AS ByIndiaFromBerksi,
                                CONVERT(INT, CONVERT(DATETIME,Date1))+2 AS Date1,Status1, Remark1,CONVERT(INT, CONVERT(DATETIME,Date2))+2 AS Date2, Status2, Remark2,CONVERT(INT, CONVERT(DATETIME,Date3))+2 AS Date3, Status3, Remark3,CONVERT(INT, CONVERT(DATETIME,Date4))+2 AS Date4, Status4, Remark4,CONVERT(INT, CONVERT(DATETIME,Date5))+2 AS Date5, Status5, Remark5 from Qc_Search AS SV
                                left join
                               (select s.id sid, 
                                min(case when [rank] = 1 then kmodifiedon else null end) as 'Date1',
                                min(case when [rank] = 1 then knewvalue else null end) as 'Status1',
                                min(case when [rank] = 1 then kremarks else null end) as 'Remark1',

                                min(case when [rank] = 2 then kmodifiedon else null end) as 'Date2',
                                min(case when [rank] = 2 then knewvalue else null end) as 'Status2',
                                min(case when [rank] = 2 then kremarks else null end) as 'Remark2',

                                min(case when [rank] = 3 then kmodifiedon else null end) as 'Date3',
                                min(case when [rank] = 3 then knewvalue else null end) as 'Status3',
                                min(case when [rank] = 3 then kremarks else null end) as 'Remark3',

                                min(case when [rank] = 4 then kmodifiedon else null end) as 'Date4',
                                min(case when [rank] = 4 then knewvalue else null end) as 'Status4',
                                min(case when [rank] = 4 then kremarks else null end) as 'Remark4',

                                min(case when [rank] = 5 then kmodifiedon else null end) as 'Date5',
                                min(case when [rank] = 5 then knewvalue else null end) as 'Status5',
                                min(case when [rank] = 5 then kremarks else null end) as 'Remark5'
                                from submission s left join 
                                (SELECT k.Rank AS rank, k.id AS kid, k.submissionid AS ksubmissionid, k.oldvalue AS koldvalue, k.newvalue AS knewvalue, k.remarks AS kremarks,  k.modifiedby AS kmodifiedby, k.modifiedon AS kmodifiedon FROM (SELECT ROW_NUMBER() OVER (PARTITION BY SubmissionId
                                ORDER BY SubmissionId, ModifiedOn) AS RANK, Id, SubmissionId, Field, OldValue, NewValue, Remarks, ModifiedBy, ModifiedOn
                                FROM SubmissionHistory Where Field = 'Status') k
                                ) r
                                on s.id=r.ksubmissionid group by s.id) b on SV.SubmissionId = b.sid
                                " . $where . " order by AlternativeCity DESC ;");
            $result = $stmt->fetchAll(PDO::FETCH_ASSOC);
            $heading = array('Work item /Submission no.', 'Duckcreek Submission Number', 'Master Policy Number', 'New/Renewal', 'Insured Name', 'Advisen ID', 'Submission Type Identifier', 'Underwriter', 'Product Line', 'Product Line Subtype', 'Section', 'Profit Code', 'Current Status', 'Effective Date', 'Expiry Date', 'Process Date', 'Bind Date', 'Renewable (Y/N)', 'Date of Renewal', 'Policy Type', 'Direct/Assumed', 'Company Paper', 'Company Paper Number', 'Coverage', 'Policy Number', 'Suffix', 'Transaction Number', 'Admitted/Non-Admitted', 'Broker Name', 'Type of Broker', 'Sub-type of Broker', 'Broker Contact Person', 'Broker Country', 'Broker State', 'Broker City', 'Broker Street Address', 'Broker Zipcode', 'Broker Code', $myArray['brokerEmail'], $myArray['brokerNumber'], $myArray['brokerMobile'], 'Retail Broker', 'Retail Broker Country', 'Retail Broker State', 'Retail Broker City', 'Branch Office', 'Currency', 'Exchange Rate', 'Exchange Rate as on', 'Layer of Limit in Local Currency', 'Layer of Limit(in USD)', '% of Layer', 'Limit in Local Currency', 'Limit(in USD)', 'Attachment Point in Local Currency', 'Attachment Point(in USD)', 'Self Insured Retention in Local Currency', 'Self Insured Retention(in USD)', 'Premium in Local Currency', 'Premium(in USD)', 'Policy Comm %', 'Policy Comm in Local Currency', 'Policy Comm(in USD)', 'Premium(Net of Commission)', 'Premium(Net of Commission) in USD', 'Reason Code', 'Priority Companies', 'Total Insured Value (TIV) in Local Currency', 'Total Insured Value (TIV) in USD', 'Occupancy Code', 'Number Of Locations(greater than 3)', 'Risk Profile', 'Project Name', 'Name of General Contractor', 'Project Owner Name', 'Project Street Address', 'Project Country', 'Project State', 'Project City', 'Bid Situation', 'Reinsured Company', 'D&B Number', 'NAIC Code', 'NAIC Title', 'OFRC Adverse report', 'DBA Name', $myArray['insuredCountry'], $myArray['insuredState'], $myArray['insuredCity'], 'Insured Mailing Address line 1', $myArray['insuredZip'], 'Insured Contact Person', $myArray['insuredContactPersonEmail'], $myArray['insuredContactPersonPhone'], $myArray['insuredContactPersonMobile'], 'Insured Submission Date', 'Insured Quote Due Date', 'By Berk SI FROM Broker', 'By India FROM Berk SI', 'Date 1', 'Status 1', 'Remarks 1', 'Date 2', 'Status 2', 'Remarks 2', 'Date 3', 'Status 3', 'Remarks 3', 'Date 4', 'Status 4', 'Remarks 4', 'Date 5', 'Status 5', 'Remarks 5');
            $this->download_send_headers("SubmissionSystem_QCExport_" . date("Y-m-d") . ".csv");
            echo $this->arraycsv($result, $heading);
            die();
        }
    }

    function arraycsv(array &$array, $heading) {
        $amenObj = new AmendmentExport();
        if (count($array) == 0) {
            return null;
        }
        ob_start();
        $df = fopen("php://output", 'w');
        fputcsv($df, $heading);
        foreach ($array as $value) {
            unset($value['RNO']);
            unset($value['Sort_Order']);
            unset($value['Id']);
            unset($value['AmendmentCreatedOn']);
            $DBNumber = $value['DBNumber'];
            if (!empty($value['DBNumber'])) {
                $value['DBNumber'] = "=\"$DBNumber\"";
            } else {
                $value['DBNumber'] = "";
            }
            $Insured = $value['InsuredName'];
            if (!empty($value['InsuredName'])) {
                $value['InsuredName'] = "=\"$Insured\"";
            } else {
                $value['InsuredName'] = "";
            }
            $policyNumber = $value['PolicyNumber'];
            if (!empty($value['PolicyNumber'])) {
                $value['PolicyNumber'] = "=\"$policyNumber\"";
            } else {
                $value['PolicyNumber'] = "";
            }
            $suffix = $value['Suffix'];
            if (!empty($value['Suffix'])) {
                $value['Suffix'] = "=\"$suffix\"";
            } else {
                $value['Suffix'] = "";
            }
            $dba = $value['DBAName'];
            if (!empty($value['DBAName'])) {
                $value['DBAName'] = "=\"$dba\"";
            } else {
                $value['DBAName'] = "";
            }
            $BcontactPhone = $value['BrokerContactPersonNumber'];
            if (!empty($value['BrokerContactPersonNumber'])) {
                $value['BrokerContactPersonNumber'] = "=\"$BcontactPhone\"";
            } else {
                $value['BrokerContactPersonNumber'] = "";
            }
            $BcontactMobile = $value['BrokerContactPersonMobile'];
            if (!empty($value['BrokerContactPersonMobile'])) {
                $value['BrokerContactPersonMobile'] = "=\"$BcontactMobile\"";
            } else {
                $value['BrokerContactPersonMobile'] = "";
            }
            $IcontactPhane = $value['InsuredContactPersonPhone'];
            if (!empty($value['InsuredContactPersonPhone'])) {
                $value['InsuredContactPersonPhone'] = "=\"$IcontactPhane\"";
            } else {
                $value['InsuredContactPersonPhone'] = "";
            }
            $IcontactMobile = $value['InsuredContactPersonMobile'];
            if (!empty($value['InsuredContactPersonMobile'])) {
                $value['InsuredContactPersonMobile'] = "=\"$IcontactMobile\"";
            } else {
                $value['InsuredContactPersonMobile'] = "";
            }
            $insuredZipCode = $value['InsuredZipcode'];
            if (!empty($value['InsuredZipcode'])) {
                $value['InsuredZipcode'] = "=\"$insuredZipCode\"";
            } else {
                $value['InsuredZipcode'] = "";
            }
            $policyCommissionPercentage = $value['PolicyCommPercentage'];
            if (!empty($value['PolicyCommPercentage'])) {
                $value['PolicyCommPercentage'] = "=\"$policyCommissionPercentage%\"";
            } else {
                $value['PolicyCommPercentage'] = "";
            }
            $percentageOfLayer = $value['PercentageofLayer'];
            if (!empty($value['PercentageofLayer'])) {
                $value['PercentageofLayer'] = "=\"$percentageOfLayer%\"";
            } else {
                $value['PercentageofLayer'] = "";
            }
            fputcsv($df, $value);
        }
        fclose($df);
        return ob_get_clean();
    }

    function download_send_headers($filename) {
        $now = gmdate("D, d M Y H:i:s");
        header("Expires: Tue, 03 Jul 2001 06:00:00 GMT");
        header("Cache-Control: max-age=0, no-cache, must-revalidate, proxy-revalidate");
        header("Last-Modified: {$now} GMT");
        header("Content-Type: application/force-download");
        header("Content-Type: application/octet-stream");
        header("Content-Type: application/download");
        header("Content-Disposition: attachment;filename={$filename}");
        header("Content-Transfer-Encoding: binary");
    }

}
