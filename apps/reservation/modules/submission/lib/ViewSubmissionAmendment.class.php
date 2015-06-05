<?php

class ViewSubmissionAmendment {

    public function __construct() {
        $this->connection = Propel::getConnection();
    }

    public function ViewEndersomentSubmissionDetail($amendmentId) {
        $connection = $this->connection;
        $amendmentSubmissionQuery = "Select AN.DuckSubmissionNumber, L.LookupName As NewRenewal,U.Name As Underwriter,Lb.LOBName As ProductLine, LS.ProductLineSubType AS ProductLineSubType,SCl.SectionCode As Section,
        PCL.ProfitCodeName As ProfitCode,PCL.ISOCGL as ISOCode, S.StatusName As StatusName, AN.EffectiveDate, AN.ExpiryDate, LK.LookupName As Currency,
        AN.ExchangeRate, AN.ExchangeDate,I.InsuredName,I.AddressLine1,I.Country, I.State As InsuredState,I.City, I.Zip,I.DBNumber,
        AN.DbaName,AN.CABCompaniesLookupId As CabCompanies,AN.ReinsuredCompany,STI.Name As SubmissionTypeIdentifier,(CP.FirstName+' '+CP.LastName) As InsuredContactPersonName,
        CP.Email As InsuredContactPersonEmail,CP.PhoneNumber As InsuredContactPersonNumber,CP.MobileNumber As InsuredContactPersonMobile,
        CASE  
		  WHEN AN.InsuredQuoteDueDate = '1900-01-01 00:00:00.000' THEN NULL 
		  WHEN AN.InsuredQuoteDueDate = '1970-01-01 00:00:00.000' THEN NULL 
		  ELSE AN.InsuredQuoteDueDate 
	END As InsuredQuoteDueDate,
        CASE  
		  WHEN AN.InsuredSubmissionDate = '1900-01-01 00:00:00.000' THEN NULL 
		  WHEN AN.InsuredSubmissionDate = '1970-01-01 00:00:00.000' THEN NULL 
		  ELSE AN.InsuredSubmissionDate 
	END As InsuredSubmissionDate,
        ABD.ProjectName, ABD.ProjectGeneralContractorName, ABD.ProjectOwnerName,ABD.ProjectCountry,
        ABD.ProjectState, ABD.ProjectCity, ABD.ProjectAddress,L2.LookupName As BidSituation,
        CASE  
		  WHEN AN.TotalInsuredValue = '-1' THEN 'Not Available' 
		  WHEN AN.TotalInsuredValue = '-2' THEN 'To Be Entered' 
		  ELSE AN.TotalInsuredValue 
	END As TotalInsuredValue,
        AN.TotalInsuredValueInUSD,
        AN.RiskProfile,L4.Alias As NumberOfLocations,OC.Name As OccupancyCode,B.BrokerName,L3.Alias As BrokerType,C.InsuredCountry As BrokerCountry,
        ST.FullCode As BrokerState,CT.CityFullCode As BrokerCity,BD.BrokerCode,AR.RetailBrokerName,C1.InsuredCountry As RetailBrokerCountry,
        ST1.FullCode As RetailBrokerState,CT1.CityFullCode As RetailBrokerCity,(CP1.FirstName +' '+CP1.LastName) As BrokerContactPerson,
        CP1.Email As BrokerContactPersonEmail,CP1.PhoneNumber As BrokerContactPersonNumber,CP1.MobileNumber As BrokerContactPersonMobile,
        (RC.ReasonCodeName +' '+RC.Meaning) As ReasonCode,
        CASE  
		  WHEN AP.BindDate = '1900-01-01 00:00:00.000' THEN NULL 
		  WHEN AP.BindDate = '1970-01-01 00:00:00.000' THEN NULL 
		  ELSE AP.BindDate 
	END As BindDate,
        L5.Alias As Renewable,
        CASE  
		  WHEN AP.DateofRenewal = '1900-01-01 00:00:00.000' THEN NULL 
		  WHEN AP.DateofRenewal = '1970-01-01 00:00:00.000' THEN NULL 
		  ELSE AP.DateofRenewal 
	END As DateofRenewal,
        L6.Alias As PolicyType,
        L7.Alias As DirectAssumed, L8.Alias As AdmittedNotAdmitted, L9.Alias As CompanyPaper, L10.Alias As CompanyPaperNumber,
        AP.PolicyNumber, CV.Name As Coverage,L11.Alias As Suffix,AP.TransactionNumber,AP.NAICCode,AP.NAICTitle,AP.SICCode, AP.SICTitle,
        L12.Alias As OFRCAdverseReport, Ap.FinalPolicyNumber,L13.Alias As ClassName, AP.ClassCode,AP.ClassDescription,
        AF.PremiunType As PremiunType, AF.PremiumInLocalCurrency, AF.PremiumInUSD,AF.LayerofLimitInLocalCurrency,AF.LayerofLimitInUSD,AF.PercentageofLayer,AF.LimitInLocalCurrency,
        AF.LimitInUSD,AF.AttachmentPointInLocalCurrency,AF.AttachmentPointInUSD,AF.SelfInsuredRetentionInLocalCurrency,AF.SelfInsuredRetentionInUSD,
        AF.PolicyCommPercentage,AF.PolicyCommInLocalCurrency,AF.PolicyCommInUSD,AF.PremiumNetofCommInLocalCurrency,AF.PremiumNetofCommInUSD,
        CASE  
		  WHEN AN.ProcessDate = '1900-01-01 00:00:00.000' THEN NULL 
		  WHEN AN.ProcessDate = '1970-01-01 00:00:00.000' THEN NULL 
		  ELSE AN.ProcessDate 
	END As ProcessDate,
        CASE  
		  WHEN AN.BerkSIDateFromBroker = '1900-01-01 00:00:00.000' THEN NULL 
		  WHEN AN.BerkSIDateFromBroker = '1970-01-01 00:00:00.000' THEN NULL 
		  ELSE AN.BerkSIDateFromBroker 
	END As BerkSIDateFromBroker, 
        CASE  
		  WHEN An.BerkSiDateFromIndia = '1900-01-01 00:00:00.000' THEN NULL 
		  WHEN An.BerkSiDateFromIndia = '1970-01-01 00:00:00.000' THEN NULL 
		  ELSE An.BerkSiDateFromIndia 
	END As BerkSiDateFromIndia, 
        B1.Branch As BranchName,DR.CreatedOn As CreatedOn, DR.ModifiedOn As ModifiedOn, SA.Remarks As Remark
        From SubmissionAmendment AS SA
        Left Join AmendmentNonFinancial AS AN on SA.NonFinancialAmendmentId = AN.Id
        Left Join Lookup AS L on An.NewRenewalLookupId = L.Id
        Left Join Underwriter AS U on AN.UnderwriterId = U.Id
        Left Join LOB AS LB on AN.LobId = LB.Id
        Left Join LOBSubType AS LS on AN.LobSubTypeId = LS.Id
        Left Join SectionCode AS SC on AN.SectionId = SC.Id
        Left Join SectionCodeLookup AS SCL on Sc.SectionCodeLookupId = SCL.Id
        Left Join ProfitCode AS P on AN.ProfitCodeId = P.Id
        Left Join ProfitCodeLookup AS PCL on PCL.Id = P.ProfitCodeLookupId
        Left Join Status AS S on AN.CurrentStatusId = S.Id
        Left Join Lookup AS LK on AN.CurrencyTypeId = LK.Id
        Left Join Insured AS I on AN.InsuredId = I.Id
        Left Join SubmissionTypeIndicator AS STI on AN.SubmissionIdentifier = STI.Id
        Left Join ContactPersonDetails AS CP on AN.InsuredContactPersonId = CP.Id
        Left Join AmendmentBusinessDependentDetails AS ABD on AN.AmendmentBusinessDependentDetailsId = ABD.Id
        Left Join Lookup AS L2 on ABD.BidSituationId = L2.Id
        Left Join OccupancyCode AS OC on OC.Id = AN.OccupancyCodeId
        Left Join AmendmentBrokerDetails AS BD on  BD.Id = AN.AmendmentBrokerDetailsId
        Left Join BrokerWiseCity AS BWS on BWS.Id = BD.BrokerWiceCityId
        Left Join Broker AS B on B.Id = BWS.BrokerId
        Left Join Lookup AS L3 on B.BrokerTypeId = L3.Id
        Left Join Country AS C on C.Id = BWS.CountryId
        Left Join State AS ST on ST.Id = BWS.StateId
        Left Join City AS CT on CT.Id = BWS.CityId
        Left Join AmendmentRetailBrokerDetails AS AR on AR.Id = Bd.AmendmentRetailBrokerDetailsId
        Left Join Country AS C1 on C1.Id = AR.RetailBrokerCountry
        Left Join State AS ST1 on ST1.Id = AR.RetailBrokerState
        Left Join City AS CT1 on CT1.Id = AR.RetailBrokerCity
        Left Join ContactPersonDetails AS CP1 on CP1.Id = BD.BrokerContactPersonId
        Left Join Lookup AS L4 on L4.Id = An.NumberOfLocationsId
        Left Join ReasonCode AS RC on RC.Id = AN.ReasonCodeId
        Left Join AmendmentPolicyDetails AS AP on AP.Id = AN.AmendmentPolicyDetailsId
        Left Join Lookup AS L5 on L5.Id = AP.RenewableLookupId
        Left Join Lookup AS L6 on L6.Id = AP.PolicyTypeLookupId
        Left Join Lookup AS L7 on L7.Id = AP.DirectAssumedLookupId
        Left Join Lookup AS L8 on L8.Id = AP.AdimittedNonAdmittedLookupId
        Left Join Lookup AS L9 on L9.Id = AP.CompanyPaperLookupId
        Left Join Lookup As L10 on L10.Id = AP.CompanyPaperNumberLookupId
        Left Join Coverage AS CV on CV.Id = AP.CoverageId
        Left Join Lookup AS L11 on L11.Id = AP.SuffixLookupId
        Left Join Lookup AS L12 on L12.Id = AP.OFRCAdverseReportLookupId
        Left Join Lookup AS L13 on L13.Id = AP.ClassNameLookupId
        Left Join AmendmentFinancial AS AF on AF.Id = SA.FinancialAmendmentId
        Left Join Branch AS B1 on AN.BranchId = B1.Id 
        Left join DataRecorderMetaData AS DR on DR.Id = SA.DataRecorderMetaDataId WHERE SA.Id = '" . $amendmentId . "'";
        $amendmentSubmissionStatement = $connection->prepare($amendmentSubmissionQuery);
        $amendmentSubmissionStatement->execute();
        $amendmentSubmission = $amendmentSubmissionStatement->fetchAll(PDO::FETCH_ASSOC);
        return $amendmentSubmission;
    }

}
