<div id="content" class="view">
    <div class="breadcrumbs group"> 
        <ul id="breadcrumb">
            <li><a href="/">Home</a><span> >>&nbsp; </span></li>
            <li><a href="/submission/Submission">Submission</a><span> >>&nbsp; </span></li>
            <li><a href="/submission/List">Submission Listing</a><span> >>&nbsp; </span></li>
            <li class="selected">Amendment Submission History</li>
        </ul>
        <a href="/submission/List" id="back"></a>
    </div>
    <div class="container">
        <ul class="tabbed-menu">
             <li><a href="/submission/viewamendment?amendmentId=<?php echo $amendmentId ?>">Amendment Submission Details</a></li>
            <li class="active"><a href="/submission/ViewEndersomentSubmissionHistory?amendmentId=<?php echo $amendmentId ?>">Amendment Submission History</a></li>
        </ul>   
        <div class="dates">
            <em>Created Date: <strong><?php if (!empty($recorderData[0]['CreatedOn'])) { echo date("m-d-Y", strtotime($recorderData[0]['CreatedOn'])); } else { echo "";} ?></strong></em>
            <em>Updated Date: <strong><?php if (!empty($recorderData[0]['ModifiedOn'])) {echo date("m-d-Y", strtotime($recorderData[0]['ModifiedOn']));} else { echo "";} ?></strong></em>
        </div>
        <div class="clear"></div>
    </div>

 <?php foreach ($historyData as $result) { ?>
        <div class="container">
            <div class="box">
                <h1 class="section-header">Updated By <?php echo $result['ModifiedBy']; ?> <em class="dateTime">Date & Time: <strong><?php if ($result['ModifiedOn'] != '') {
                echo date("m-d-Y h:i:s A", strtotime($result['ModifiedOn']));
                } else {
                 echo '';
                } ?></strong></em><div class="arrow"></div>
                </h1>
                    <div class="content" style="display: block;">
                        <table cellpadding="0" cellspacing="0" width="100%">
                            <tr>
                                <td width="20%">&nbsp;</td>
                                <td width="30%">Old Value</td>
                                <td width="30%">New Value</td>
                            </tr>
                            <?php if(trim($result['QcStatus']) != trim($result['NewQcStatus'])){ ?>
                            <tr>
                                <td width="20%" height="35"><?php echo "Qc Status"; ?></td>
                                <td width="30%"><?php echo $result['QcStatus']; ?></td>
                                <td width="30%"><?php echo $result['NewQcStatus']; ?></td>
                            </tr>
                            <?php } ?>
                            <?php if(trim($result['InusredName']) != trim($result['NewInusredName'])){ ?>
                            <tr>
                                <td width="20%" height="35"><?php echo "Insured Name"; ?></td>
                                <td width="30%"><?php echo $result['InusredName']; ?></td>
                                <td width="30%"><?php echo $result['NewInusredName']; ?></td>
                            </tr>
                            <?php } ?>
                            <?php if(trim($result['NewInsuredAddressLine1']) != trim($result['NewInsuredAddressLine1'])){ ?>
                            <tr>
                                <td width="20%" height="35"><?php echo "Address Line 1"; ?></td>
                                <td width="30%"><?php echo $result['NewInsuredAddressLine1']; ?></td>
                                <td width="30%"><?php echo $result['NewInsuredAddressLine1']; ?></td>
                            </tr>
                            <?php } ?>
                            <?php if(trim($result['InsuredCountry']) != trim($result['NewInsuredCountry'])){ ?>
                            <tr>
                                <td width="20%" height="35"><?php echo "Insured Country"; ?></td>
                                <td width="30%"><?php echo $result['InsuredCountry']; ?></td>
                                <td width="30%"><?php echo $result['NewInsuredCountry']; ?></td>
                            </tr>
                            <?php } ?>
                            <?php if(trim($result['InsuredState']) != trim($result['NewInsuredState'])){ ?>
                            <tr>
                                <td width="20%" height="35"><?php echo "Insured State"; ?></td>
                                <td width="30%"><?php echo $result['InsuredState']; ?></td>
                                <td width="30%"><?php echo $result['NewInsuredState']; ?></td>
                            </tr>
                            <?php } ?>
                            <?php if(trim($result['InsuredCity']) != trim($result['NewInsuredCity'])){ ?>
                            <tr>
                                <td width="20%" height="35"><?php echo "Insured City"; ?></td>
                                <td width="30%"><?php echo $result['InsuredCity']; ?></td>
                                <td width="30%"><?php echo $result['NewInsuredCity']; ?></td>
                            </tr>
                            <?php } ?>
                            <?php if(trim($result['InsuredZipCode']) != trim($result['NewInsuredZipCode'])){ ?>
                            <tr>
                                <td width="20%" height="35"><?php echo "Insured Zip"; ?></td>
                                <td width="30%"><?php echo $result['InsuredZipCode']; ?></td>
                                <td width="30%"><?php echo $result['NewInsuredZipCode']; ?></td>
                            </tr>
                            <?php } ?>
                            <?php if(trim($result['DbaName']) != trim($result['NewDbaName'])){ ?>
                            <tr>
                                <td width="20%" height="35"><?php echo "DBA Name"; ?></td>
                                <td width="30%"><?php echo $result['DbaName']; ?></td>
                                <td width="30%"><?php echo $result['NewDbaName']; ?></td>
                            </tr>
                            <?php } ?>
                            <?php if(trim($result['DbNumber']) != trim($result['NewDbNumber'])){ ?>
                            <tr>
                                <td width="20%" height="35"><?php echo "D&B Number"; ?></td>
                                <td width="30%"><?php echo $result['DbNumber']; ?></td>
                                <td width="30%"><?php echo $result['NewDbNumber']; ?></td>
                            </tr>
                            <?php } ?>
                            <?php if(trim($result['CabCompanies']) != trim($result['NewCABCompanies'])){ ?>
                            <tr>
                                <td width="20%" height="35"><?php echo "Priority Companies"; ?></td>
                                <td width="30%"><?php echo $result['CabCompanies']; ?></td>
                                <td width="30%"><?php echo $result['NewCABCompanies']; ?></td>
                            </tr>
                            <?php } ?>
                            <?php if(trim($result['ReinsuredCompany']) != trim($result['NewReinsuredCompany'])){ ?>
                            <tr>
                                <td width="20%" height="35"><?php echo "Reinsured Company"; ?></td>
                                <td width="30%"><?php echo $result['ReinsuredCompany']; ?></td>
                                <td width="30%"><?php echo $result['NewReinsuredCompany']; ?></td>
                            </tr>
                            <?php } ?>
                            <?php if(trim($result['SubmissionIdentifier']) != trim($result['NewSubmissionIdentifier'])){ ?>
                            <tr>
                                <td width="20%" height="35"><?php echo "Submission Identifier"; ?></td>
                                <td width="30%"><?php echo $result['SubmissionIdentifier']; ?></td>
                                <td width="30%"><?php echo $result['NewSubmissionIdentifier']; ?></td>
                            </tr>
                            <?php } ?>
                            <?php if(trim($result['InsuredContactPersonName']) != trim($result['NewInsuredContactPersonName'])){ ?>
                            <tr>
                                <td width="20%" height="35"><?php echo "Insured Contact Person"; ?></td>
                                <td width="30%"><?php echo $result['InsuredContactPersonName']; ?></td>
                                <td width="30%"><?php echo $result['NewInsuredContactPersonName']; ?></td>
                            </tr>
                            <?php } ?>
                            <?php if(trim($result['InsuredContactPersonEmail']) != trim($result['NewInsuredContactPersonEmail'])){ ?>
                            <tr>
                                <td width="20%" height="35"><?php echo "Insured Contact Person Email"; ?></td>
                                <td width="30%"><?php echo $result['InsuredContactPersonEmail']; ?></td>
                                <td width="30%"><?php echo $result['NewInsuredContactPersonEmail']; ?></td>
                            </tr>
                            <?php } ?>
                            <?php if(trim($result['InsuredContactPersonPhone']) != trim($result['NewInsuredContactPersonPhone'])){ ?>
                            <tr>
                                <td width="20%" height="35"><?php echo "Insured Contact Person's Number(O)"; ?></td>
                                <td width="30%"><?php echo $result['InsuredContactPersonPhone']; ?></td>
                                <td width="30%"><?php echo $result['NewInsuredContactPersonPhone']; ?></td>
                            </tr>
                            <?php } ?>
                            <?php if(trim($result['InsuredContactPersonMobile']) != trim($result['NewInsuredContactPersonMobile'])){ ?>
                            <tr>
                                <td width="20%" height="35"><?php echo "Insured Contact Person's Mobile"; ?></td>
                                <td width="30%"><?php echo $result['InsuredContactPersonMobile']; ?></td>
                                <td width="30%"><?php echo $result['NewInsuredContactPersonMobile']; ?></td>
                            </tr>
                            <?php } ?>
                            <?php if(date("Y-m-d", strtotime($result['InsuredSubmissionDate'])) != date("Y-m-d", strtotime($result['NewIsuredSubmissionDate']))){ ?>
                            <tr>
                                <td width="20%" height="35"><?php echo "Insured Submission Date"; ?></td>
                                <td width="30%"><?php if(!empty($result['InsuredSubmissionDate'])) { echo date("m/d/Y", strtotime($result['InsuredSubmissionDate']));} else {echo "";} ?></td>
                                <td width="30%"><?php if(!empty($result['NewIsuredSubmissionDate'])){ echo date("m/d/Y", strtotime($result['NewIsuredSubmissionDate']));}else {echo "";} ?></td>
                            </tr>
                            <?php } ?>
                            <?php if(date("Y-m-d", strtotime($result['InsuredQuoteDueDate'])) != date("Y-m-d", strtotime($result['NewInsuredQuoteDueDate']))){ ?>
                            <tr>
                                <td width="20%" height="35"><?php echo "Insured Quote Due Date"; ?></td>
                                <td width="30%"><?php if(!empty($result['InsuredQuoteDueDate'])){ echo date("m/d/Y", strtotime($result['InsuredQuoteDueDate']));} else {echo "";} ?></td>
                                <td width="30%"><?php if(!empty($result['NewInsuredQuoteDueDate'])) { echo date("m/d/Y", strtotime($result['NewInsuredQuoteDueDate']));} else {echo "";} ?></td>
                            </tr>
                            <?php } ?>
                            <?php if(trim($result['DuckSubmissionNumber']) != trim($result['NewDuckSubmissionNumber'])){ ?>
                            <tr>
                                <td width="20%" height="35"><?php echo "Duck Creek Submission Number"; ?></td>
                                <td width="30%"><?php echo $result['DuckSubmissionNumber']; ?></td>
                                <td width="30%"><?php echo $result['NewDuckSubmissionNumber']; ?></td>
                            </tr>
                            <?php } ?>
                            
                            <?php if(trim($result['NewRenewal']) != trim($result['New_newRenewal'])){ ?>
                            <tr>
                                <td width="20%" height="35"><?php echo "New Renewal"; ?></td>
                                <td width="30%"><?php echo $result['NewRenewal']; ?></td>
                                <td width="30%"><?php echo $result['New_newRenewal']; ?></td>
                            </tr>
                            <?php } ?>
                            <?php if(trim($result['Underwriter']) != trim($result['NewUnderwriter'])){ ?>
                            <tr>
                                <td width="20%" height="35"><?php echo "Underwriter"; ?></td>
                                <td width="30%"><?php echo $result['Underwriter']; ?></td>
                                <td width="30%"><?php echo $result['NewUnderwriter']; ?></td>
                            </tr>
                            <?php } ?>
                            <?php if(trim($result['ProductLine']) != trim($result['NewProductLine'])){ ?>
                            <tr>
                                <td width="20%" height="35"><?php echo "Product Line"; ?></td>
                                <td width="30%"><?php echo $result['ProductLine']; ?></td>
                                <td width="30%"><?php echo $result['NewProductLine']; ?></td>
                            </tr>
                            <?php } ?>
                            <?php if(trim($result['ProductLineSubType']) != trim($result['NewProductLineSubType'])){ ?>
                            <tr>
                                <td width="20%" height="35"><?php echo "Product Line Subtype"; ?></td>
                                <td width="30%"><?php echo $result['ProductLineSubType']; ?></td>
                                <td width="30%"><?php echo $result['NewProductLineSubType']; ?></td>
                            </tr>
                            <?php } ?>
                            <?php if(trim($result['SectionCode']) != trim($result['NewSectionCode'])){ ?>
                            <tr>
                                <td width="20%" height="35"><?php echo "Section"; ?></td>
                                <td width="30%"><?php echo $result['SectionCode']; ?></td>
                                <td width="30%"><?php echo $result['NewSectionCode']; ?></td>
                            </tr>
                            <?php } ?>
                            <?php if(trim($result['ProfitCode']) != trim($result['NewProfitCode'])){ ?>
                            <tr>
                                <td width="20%" height="35"><?php echo "Profit Code"; ?></td>
                                <td width="30%"><?php echo $result['ProfitCode']; ?></td>
                                <td width="30%"><?php echo $result['NewProfitCode']; ?></td>
                            </tr>
                            <?php } ?>
                            <?php if(trim($result['Status']) != trim($result['NewStatus'])){ ?>
                            <tr>
                                <td width="20%" height="35"><?php echo "Current Status"; ?></td>
                                <td width="30%"><?php echo $result['Status']; ?></td>
                                <td width="30%"><?php echo $result['NewStatus']; ?></td>
                            </tr>
                            <?php } ?>
                            <?php if(date("Y-m-d", strtotime($result['EffectiveDate'])) != date("Y-m-d", strtotime($result['NewEffectiveDate']))){ ?>
                            <tr>
                                <td width="20%" height="35"><?php echo "Effective Date"; ?></td>
                                <td width="30%"><?php if(!empty($result['EffectiveDate'])){ echo date("m/d/Y", strtotime($result['EffectiveDate']));}else {echo "";} ?></td>
                                <td width="30%"><?php if(!empty($result['NewEffectiveDate'])){ echo date("m/d/Y", strtotime($result['NewEffectiveDate']));} else {echo "";} ?></td>
                            </tr>
                            <?php } ?>
                            <?php if(date("Y-m-d", strtotime($result['ExpiryDate'])) != date("Y-m-d", strtotime($result['NewExpiryDate']))){ ?>
                            <tr>
                                <td width="20%" height="35"><?php echo "Expiry Date"; ?></td>
                                <td width="30%"><?php if(!empty($result['ExpiryDate'])){ echo date("m/d/Y", strtotime($result['ExpiryDate']));} else{echo "";} ?></td>
                                <td width="30%"><?php if(!empty($result['NewExpiryDate'])){ echo date("m/d/Y", strtotime($result['NewExpiryDate']));}else {echo "";} ?></td>
                            </tr>
                            <?php } ?>
                            <?php if(trim($result['Currency']) != trim($result['NewCurrency'])){ ?>
                            <tr>
                                <td width="20%" height="35"><?php echo "Currency"; ?></td>
                                <td width="30%"><?php echo $result['Currency']; ?></td>
                                <td width="30%"><?php echo $result['NewCurrency']; ?></td>
                            </tr>
                            <?php } ?>
                            <?php if(trim($result['ExchangeRate']) != trim($result['NewExchangeRate'])){ ?>
                            <tr>
                                <td width="20%" height="35"><?php echo "Exchange Rate"; ?></td>
                                <td width="30%"><?php echo $result['ExchangeRate']; ?></td>
                                <td width="30%"><?php echo $result['NewExchangeRate']; ?></td>
                            </tr>
                            <?php } ?>
                            <?php if(date("Y-m-d", strtotime($result['ExchangeDate'])) != date("Y-m-d", strtotime($result['NewExchangeDate']))){ ?>
                            <tr>
                                 <td width="20%" height="35"><?php echo "Exchange Rate as on"; ?></td>
                                <td width="30%"><?php echo date("m/d/Y", strtotime($result['ExchangeDate'])); ?></td>
                                <td width="30%"><?php echo date("m/d/Y", strtotime($result['NewExchangeDate'])); ?></td>
                            </tr>
                            <?php } ?>
                            
                            <?php if(trim($result['ProjectName']) != trim($result['NewProjectName'])){ ?>
                            <tr>
                                <td width="20%" height="35"><?php echo "Project Name"; ?></td>
                                <td width="30%"><?php echo $result['ProjectName']; ?></td>
                                <td width="30%"><?php echo $result['NewProjectName']; ?></td>
                            </tr>
                            <?php } ?>
                            <?php if(trim($result['ProjectGeneralContractorName']) != trim($result['NewProjectGeneralContractorNam'])){ ?>
                            <tr>
                                <td width="20%" height="35"><?php echo "Name of General Contractor"; ?></td>
                                <td width="30%"><?php echo $result['ProjectGeneralContractorName']; ?></td>
                                <td width="30%"><?php echo $result['NewProjectGeneralContractorNam']; ?></td>
                            </tr>
                            <?php } ?>
                            <?php if(trim($result['ProjectOwnerName']) != trim($result['NewProjectOwnerName'])){ ?>
                            <tr>
                                <td width="20%" height="35"><?php echo "Project Owner Name"; ?></td>
                                <td width="30%"><?php echo $result['ProjectOwnerName']; ?></td>
                                <td width="30%"><?php echo $result['NewProjectOwnerName']; ?></td>
                            </tr>
                            <?php } ?>
                            <?php if(trim($result['ProjectCountry']) != trim($result['NewProjectCountry'])){ ?>
                            <tr>
                                <td width="20%" height="35"><?php echo "Project Country"; ?></td>
                                <td width="30%"><?php echo $result['ProjectCountry']; ?></td>
                                <td width="30%"><?php echo $result['NewProjectCountry']; ?></td>
                            </tr>
                            <?php } ?>
                            <?php if(trim($result['ProjectState']) != trim($result['NewProjectState'])){ ?>
                            <tr>
                                <td width="20%" height="35"><?php echo "Project State"; ?></td>
                                <td width="30%"><?php echo $result['ProjectState']; ?></td>
                                <td width="30%"><?php echo $result['NewProjectState']; ?></td>
                            </tr>
                            <?php } ?>
                            <?php if(trim($result['ProjectCity']) != trim($result['NewProjectCity'])){ ?>
                            <tr>
                                <td width="20%" height="35"><?php echo "Project City"; ?></td>
                                <td width="30%"><?php echo $result['ProjectCity']; ?></td>
                                <td width="30%"><?php echo $result['NewProjectCity']; ?></td>
                            </tr>
                            <?php } ?>
                            <?php if(trim($result['ProjectAddress']) != trim($result['NewProjectAddress'])){ ?>
                            <tr>
                                <td width="20%" height="35"><?php echo "Project Street Address"; ?></td>
                                <td width="30%"><?php echo $result['ProjectAddress']; ?></td>
                                <td width="30%"><?php echo $result['NewProjectAddress']; ?></td>
                            </tr>
                            <?php } ?>
                            <?php if(trim($result['BisSituation']) != trim($result['NewBidSituation'])){ ?>
                            <tr>
                                <td width="20%" height="35"><?php echo "Bid Situation"; ?></td>
                                <td width="30%"><?php echo $result['BisSituation']; ?></td>
                                <td width="30%"><?php echo $result['NewBidSituation']; ?></td>
                            </tr>
                            <?php } ?>
                            <?php if(trim($result['TotalInsuredValue']) != trim($result['NewTotalInsuredValue'])){ ?>
                            <tr>
                                <td width="20%" height="35"><?php echo "Total Insured Value"; ?></td>
                                <td width="30%"><?php echo $result['TotalInsuredValue']; ?></td>
                                <td width="30%"><?php echo $result['NewTotalInsuredValue']; ?></td>
                            </tr>
                            <?php } ?>
                            <?php if(trim($result['TotalInsuredValueInUSD']) != trim($result['NewTotalInsuredValueInUSD'])){ ?>
                            <tr>
                                <td width="20%" height="35"><?php echo "Total Insured Value in USD"; ?></td>
                                <td width="30%"><?php echo $result['TotalInsuredValueInUSD']; ?></td>
                                <td width="30%"><?php echo $result['NewTotalInsuredValueInUSD']; ?></td>
                            </tr>
                            <?php } ?>
                            <?php if(trim($result['NumberOfLocations']) != trim($result['NewNumberOfLocations'])){ ?>
                            <tr>
                                <td width="20%" height="35"><?php echo "Number Of Locations (greater than 3)"; ?></td>
                                <td width="30%"><?php echo $result['NumberOfLocations']; ?></td>
                                <td width="30%"><?php echo $result['NewNumberOfLocations']; ?></td>
                            </tr>
                            <?php } ?>
                            <?php if(trim($result['RiskProfile']) != trim($result['NewRiskProfile'])){ ?>
                            <tr>
                                <td width="20%" height="35"><?php echo "Risk Profile"; ?></td>
                                <td width="30%"><?php echo $result['RiskProfile']; ?></td>
                                <td width="30%"><?php echo $result['NewRiskProfile']; ?></td>
                            </tr>
                            <?php } ?>
                            <?php if(trim($result['OccupancyCode']) != trim($result['NewOccupancyCode'])){ ?>
                            <tr>
                                <td width="20%" height="35"><?php echo "Occupancy Code"; ?></td>
                                <td width="30%"><?php echo $result['OccupancyCode']; ?></td>
                                <td width="30%"><?php echo $result['NewOccupancyCode']; ?></td>
                            </tr>
                            <?php } ?>
                            
                            <?php if(date("Y-m-d", strtotime($result['BerkSIDateFromBroker'])) != date("Y-m-d", strtotime($result['NewBerkSIDateFromBroker']))){ ?>
                            <tr>
                                <td width="20%" height="35"><?php echo "Date of Receiving-By Berk SI From Broker"; ?></td>
                                <td width="30%"><?php echo date("m/d/Y", strtotime($result['BerkSIDateFromBroker'])); ?></td>
                                <td width="30%"><?php echo date("m/d/Y", strtotime($result['NewBerkSIDateFromBroker'])); ?></td>
                            </tr>
                            <?php } ?>
                            <?php if(date("Y-m-d", strtotime($result['BerkSiDateFromIndia'])) != date("Y-m-d", strtotime($result['NewBerkSiDateFromIndia']))){ ?>
                            <tr>
                                <td width="20%" height="35"><?php echo "Date of Receiving-By India From Berk SI"; ?></td>
                                <td width="30%"><?php echo date("m/d/Y", strtotime($result['BerkSiDateFromIndia'])); ?></td>
                                <td width="30%"><?php echo date("m/d/Y", strtotime($result['NewBerkSiDateFromIndia'])); ?></td>
                            </tr>
                            <?php } ?>
                            <?php if(trim($result['BranchName']) != trim($result['NewBranchName'])){ ?>
                            <tr>
                                <td width="20%" height="35"><?php echo "Branch Office"; ?></td>
                                <td width="30%"><?php echo $result['BranchName']; ?></td>
                                <td width="30%"><?php echo $result['NewBranchName']; ?></td>
                            </tr>
                            <?php } ?>
                            
                            <?php if(trim($result['BrokerName']) != trim($result['NewBrokerName'])){ ?>
                            <tr>
                                <td width="20%" height="35"><?php echo "Broker Name"; ?></td>
                                <td width="30%"><?php echo $result['BrokerName']; ?></td>
                                <td width="30%"><?php echo $result['NewBrokerName']; ?></td>
                            </tr>
                            <?php } ?>
                            <?php if(trim($result['BrokerType']) != trim($result['NewBrokerType'])){ ?>
                            <tr>
                                <td width="20%" height="35"><?php echo "Wholesaler or Retailer"; ?></td>
                                <td width="30%"><?php echo $result['BrokerType']; ?></td>
                                <td width="30%"><?php echo $result['NewBrokerType']; ?></td>
                            </tr>
                            <?php } ?>
                            <?php if(trim($result['RetailBrokerName']) != trim($result['NewRetailBrokerName'])){ ?>
                            <tr>
                                <td width="20%" height="35"><?php echo "Retail Broker Name"; ?></td>
                                <td width="30%"><?php echo $result['RetailBrokerName']; ?></td>
                                <td width="30%"><?php echo $result['NewRetailBrokerName']; ?></td>
                            </tr>
                            <?php } ?>
                            <?php if(trim($result['BrokerCountry']) != trim($result['NewBrokerCountry'])){ ?>
                            <tr>
                                <td width="20%" height="35"><?php echo "Broker Country"; ?></td>
                                <td width="30%"><?php echo $result['BrokerCountry']; ?></td>
                                <td width="30%"><?php echo $result['NewBrokerCountry']; ?></td>
                            </tr>
                            <?php } ?>
                            <?php if(trim($result['BrokerState']) != trim($result['NewBrokerState'])){ ?>
                            <tr>
                                <td width="20%" height="35"><?php echo "Broker State"; ?></td>
                                <td width="30%"><?php echo $result['BrokerState']; ?></td>
                                <td width="30%"><?php echo $result['NewBrokerState']; ?></td>
                            </tr>
                            <?php } ?>
                            <?php if(trim($result['BrokerCity']) != trim($result['NewBrokerCity'])){ ?>
                            <tr>
                                <td width="20%" height="35"><?php echo "Broker City"; ?></td>
                                <td width="30%"><?php echo $result['BrokerCity']; ?></td>
                                <td width="30%"><?php echo $result['NewBrokerCity']; ?></td>
                            </tr>
                            <?php } ?>
                            <?php if(trim($result['RetailBrokerCountry']) != trim($result['NewRetailBrokerCountry'])){ ?>
                            <tr>
                                <td width="20%" height="35"><?php echo "Retail Broker Country"; ?></td>
                                <td width="30%"><?php echo $result['RetailBrokerCountry']; ?></td>
                                <td width="30%"><?php echo $result['NewRetailBrokerCountry']; ?></td>
                            </tr>
                            <?php } ?>
                            <?php if(trim($result['RetailBrokerState']) != trim($result['NewRetailBrokerState'])){ ?>
                            <tr>
                                <td width="20%" height="35"><?php echo "Retail Broker State"; ?></td>
                                <td width="30%"><?php echo $result['RetailBrokerState']; ?></td>
                                <td width="30%"><?php echo $result['NewRetailBrokerState']; ?></td>
                            </tr>
                            <?php } ?>
                            <?php if(trim($result['RetailBrokerCity']) != trim($result['NewRetailBrokerCity'])){ ?>
                            <tr>
                                <td width="20%" height="35"><?php echo "Retail Broker City"; ?></td>
                                <td width="30%"><?php echo $result['RetailBrokerCity']; ?></td>
                                <td width="30%"><?php echo $result['NewRetailBrokerCity']; ?></td>
                            </tr>
                            <?php } ?>
                            <?php if(trim($result['BrokerContactPersonName']) != trim($result['NewBrokerContactPersonName'])){ ?>
                            <tr>
                                <td width="20%" height="35"><?php echo "Broker Contact Person"; ?></td>
                                <td width="30%"><?php echo $result['BrokerContactPersonName']; ?></td>
                                <td width="30%"><?php echo $result['NewBrokerContactPersonName']; ?></td>
                            </tr>
                            <?php } ?>
                            <?php if(trim($result['BrokerContactPersonEmail']) != trim($result['NewBrokerContactPersonEmail'])){ ?>
                            <tr>
                                <td width="20%" height="35"><?php echo "Broker Contact Person's Email"; ?></td>
                                <td width="30%"><?php echo $result['BrokerContactPersonEmail']; ?></td>
                                <td width="30%"><?php echo $result['NewBrokerContactPersonEmail']; ?></td>
                            </tr>
                            <?php } ?>
                            <?php if(trim($result['BrokerContactPersonPhone']) != trim($result['NewBrokerContactPersonPhone'])){ ?>
                            <tr>
                                <td width="20%" height="35"><?php echo "Broker Contact Person's Number (O)"; ?></td>
                                <td width="30%"><?php echo $result['BrokerContactPersonPhone']; ?></td>
                                <td width="30%"><?php echo $result['NewBrokerContactPersonPhone']; ?></td>
                            </tr>
                            <?php } ?>
                            <?php if(trim($result['BrokerContactPersonMobile']) != trim($result['NewBrokerContactPersonMobile'])){ ?>
                            <tr>
                                <td width="20%" height="35"><?php echo "Broker Contact Person Mobile"; ?></td>
                                <td width="30%"><?php echo $result['BrokerContactPersonMobile']; ?></td>
                                <td width="30%"><?php echo $result['NewBrokerContactPersonMobile']; ?></td>
                            </tr>
                            <?php } ?>
                            <?php if(trim($result['BrokerCode']) != trim($result['NewBrokerCode'])){ ?>
                            <tr>
                                <td width="20%" height="35"><?php echo "Broker Code"; ?></td>
                                <td width="30%"><?php echo $result['BrokerCode']; ?></td>
                                <td width="30%"><?php echo $result['NewBrokerCode']; ?></td>
                            </tr>
                            <?php } ?>
                            
                            <?php if(trim($result['ReasonCode']) != trim($result['NewReasonCode'])){ ?>
                            <tr>
                                <td width="20%" height="35"><?php echo "Reason Code"; ?></td>
                                <td width="30%"><?php echo $result['ReasonCode']; ?></td>
                                <td width="30%"><?php echo $result['NewReasonCode']; ?></td>
                            </tr>
                            <?php } ?>
                            <?php if(date("Y-m-d", strtotime($result['ProcessDate'])) != date("Y-m-d", strtotime($result['NewProcessDate']))){ ?>
                            <tr>
                                <td width="20%" height="35"><?php echo "Process Date"; ?></td>
                                <td width="30%"><?php echo date("m/d/Y", strtotime($result['ProcessDate'])); ?></td>
                                <td width="30%"><?php echo date("m/d/Y", strtotime($result['NewProcessDate'])); ?></td>
                            </tr>
                            <?php } ?>
                            
                            <?php if(trim($result['PremiumInLocalCurrency']) != trim($result['NewPremiumInLocalCurrency'])){ ?>
                            <tr>
                                <td width="20%" height="35"><?php echo "Premium in Local Currency"; ?></td>
                                <td width="30%"><?php echo $result['PremiumInLocalCurrency']; ?></td>
                                <td width="30%"><?php echo $result['NewPremiumInLocalCurrency']; ?></td>
                            </tr>
                            <?php } ?>
                            <?php if(trim($result['PremiumInUSD']) != trim($result['NewPremiumInUSD'])){ ?>
                            <tr>
                                <td width="20%" height="35"><?php echo "Premium (in USD)"; ?></td>
                                <td width="30%"><?php echo $result['PremiumInUSD']; ?></td>
                                <td width="30%"><?php echo $result['NewPremiumInUSD']; ?></td>
                            </tr>
                            <?php } ?>
                            <?php if(trim($result['LayerofLimitInLocalCurrency']) != trim($result['NewLayerofLimitInLocalCurrency'])){ ?>
                            <tr>
                                <td width="20%" height="35"><?php echo "Layer of Limit in Local Currency"; ?></td>
                                <td width="30%"><?php echo $result['LayerofLimitInLocalCurrency']; ?></td>
                                <td width="30%"><?php echo $result['NewLayerofLimitInLocalCurrency']; ?></td>
                            </tr>
                            <?php } ?>
                            <?php if(trim($result['LayerofLimitInUSD']) != trim($result['NewLayerofLimitInUSD'])){ ?>
                            <tr>
                                <td width="20%" height="35"><?php echo "Layer of Limit (in USD)"; ?></td>
                                <td width="30%"><?php echo $result['LayerofLimitInUSD']; ?></td>
                                <td width="30%"><?php echo $result['NewLayerofLimitInUSD']; ?></td>
                            </tr>
                            <?php } ?>
                            <?php if(trim($result['PercentageofLayer']) != trim($result['NewPercentageofLayer'])){ ?>
                            <tr>
                                <td width="20%" height="35"><?php echo "% of Layer"; ?></td>
                                <td width="30%"><?php echo $result['PercentageofLayer']; ?></td>
                                <td width="30%"><?php echo $result['NewPercentageofLayer']; ?></td>
                            </tr>
                            <?php } ?>
                            <?php if(trim($result['LimitInLocalCurrency']) != trim($result['NewLimitInLocalCurrency'])){ ?>
                            <tr>
                                <td width="20%" height="35"><?php echo "Limit in Local Currency"; ?></td>
                                <td width="30%"><?php echo $result['LimitInLocalCurrency']; ?></td>
                                <td width="30%"><?php echo $result['NewLimitInLocalCurrency']; ?></td>
                            </tr>
                            <?php } ?>
                            <?php if(trim($result['LimitInLocalCurrency']) != trim($result['NewLimitInLocalCurrency'])){ ?>
                            <tr>
                                <td width="20%" height="35"><?php echo "Limit (in USD)"; ?></td>
                                <td width="30%"><?php echo $result['LimitInLocalCurrency']; ?></td>
                                <td width="30%"><?php echo $result['NewLimitInLocalCurrency']; ?></td>
                            </tr>
                            <?php } ?>
                            <?php if(trim($result['AttachmentPointInLocalCurrency']) != trim($result['NewAttachmentPointInLocalCurre'])){ ?>
                            <tr>
                                <td width="20%" height="35"><?php echo "Attachment Point in Local Currency"; ?></td>
                                <td width="30%"><?php echo $result['AttachmentPointInLocalCurrency']; ?></td>
                                <td width="30%"><?php echo $result['NewAttachmentPointInLocalCurre']; ?></td>
                            </tr>
                            <?php } ?>
                            <?php if(trim($result['AttachmentPointInUSD']) != trim($result['NewAttachmentPointInUSD'])){ ?>
                            <tr>
                                <td width="20%" height="35"><?php echo "Attachment Point (in USD)"; ?></td>
                                <td width="30%"><?php echo $result['AttachmentPointInUSD']; ?></td>
                                <td width="30%"><?php echo $result['NewAttachmentPointInUSD']; ?></td>
                            </tr>
                            <?php } ?>
                            <?php if(trim($result['SelfInsuredRetentionInLocalCur']) != trim($result['NewSelfInsuredRetentionInLocal'])){ ?>
                            <tr>
                                <td width="20%" height="35"><?php echo "Self Insured Retention in Local Currency"; ?></td>
                                <td width="30%"><?php echo $result['SelfInsuredRetentionInLocalCur']; ?></td>
                                <td width="30%"><?php echo $result['NewSelfInsuredRetentionInLocal']; ?></td>
                            </tr>
                            <?php } ?>
                            <?php if(trim($result['SelfInsuredRetentionInUSD']) != trim($result['NewSelfInsuredRetentionInUSD'])){ ?>
                            <tr>
                                <td width="20%" height="35"><?php echo "Self Insured Retention(in USD)"; ?></td>
                                <td width="30%"><?php echo $result['SelfInsuredRetentionInUSD']; ?></td>
                                <td width="30%"><?php echo $result['NewSelfInsuredRetentionInUSD']; ?></td>
                            </tr>
                            <?php } ?>
                            <?php if(trim($result['PolicyCommPercentage']) != trim($result['NewPolicyCommPercentage'])){ ?>
                            <tr>
                                <td width="20%" height="35"><?php echo "Policy Comm. %"; ?></td>
                                <td width="30%"><?php echo $result['PolicyCommPercentage']; ?></td>
                                <td width="30%"><?php echo $result['NewPolicyCommPercentage']; ?></td>
                            </tr>
                            <?php } ?>
                            <?php if(trim($result['PolicyCommInLocalCurrency']) != trim($result['NewPolicyCommInLocalCurrency'])){ ?>
                            <tr>
                                <td width="20%" height="35"><?php echo "Policy Comm. in Local Currency"; ?></td>
                                <td width="30%"><?php echo $result['PolicyCommInLocalCurrency']; ?></td>
                                <td width="30%"><?php echo $result['NewPolicyCommInLocalCurrency']; ?></td>
                            </tr>
                            <?php } ?>
                            <?php if(trim($result['PolicyCommInUSD']) != trim($result['NewPolicyCommInUSD'])){ ?>
                            <tr>
                                <td width="20%" height="35"><?php echo "Policy Comm.(in USD)"; ?></td>
                                <td width="30%"><?php echo $result['PolicyCommInUSD']; ?></td>
                                <td width="30%"><?php echo $result['NewPolicyCommInUSD']; ?></td>
                            </tr>
                            <?php } ?>
                            <?php if(trim($result['PremiumNetofCommInLocalCurrenc']) != trim($result['NewPremiumNetofCommInLocalCurr'])){ ?>
                            <tr>
                                <td width="20%" height="35"><?php echo "Premium (Net of All Commission) in Local Currency"; ?></td>
                                <td width="30%"><?php echo $result['PremiumNetofCommInLocalCurrenc']; ?></td>
                                <td width="30%"><?php echo $result['NewPremiumNetofCommInLocalCurr']; ?></td>
                            </tr>
                            <?php } ?>
                            <?php if(trim($result['PremiumNetofCommInUSD']) != trim($result['NewPremiumNetofCommInUSD'])){ ?>
                            <tr>
                                <td width="20%" height="35"><?php echo "Premium (Net of All Commission)(in USD)"; ?></td>
                                <td width="30%"><?php echo $result['PremiumNetofCommInUSD']; ?></td>
                                <td width="30%"><?php echo $result['NewPremiumNetofCommInUSD']; ?></td>
                            </tr>
                            <?php } ?>
                            
                            <?php if(date("Y-m-d", strtotime($result['BindDate'])) != date("Y-m-d", strtotime($result['NewBindDate']))){ ?>
                            <tr>
                                <?php  $validDate = date('Y-m-d', strtotime('-10 years')); ?>
                                <td width="20%" height="35"><?php echo "Bind Date"; ?></td>
                                <td width="30%"><?php if(date("Y-m-d", strtotime($result['BindDate'])) > $validDate){echo date("m/d/Y", strtotime($result['BindDate']));}else {echo "";} ?></td>
                                <td width="30%"><?php if(date("Y-m-d", strtotime($result['NewBindDate'])) > $validDate){ echo date("m/d/Y", strtotime($result['NewBindDate']));} else {echo "";} ?></td>
                            </tr>
                            <?php } ?>
                            <?php if(trim($result['Renewable']) != trim($result['NewRenewable'])){ ?>
                            <tr>
                                <td width="20%" height="35"><?php echo "Renewable(Y/N)"; ?></td>
                                <td width="30%"><?php echo $result['Renewable']; ?></td>
                                <td width="30%"><?php echo $result['NewRenewable']; ?></td>
                            </tr>
                            <?php } ?>
                            <?php if(date("Y-m-d", strtotime($result['DateofRenewal'])) != date("Y-m-d", strtotime($result['NewDateofRenewal']))){ ?>
                            <tr>
                                <td width="20%" height="35"><?php echo "Date of Renewal"; ?></td>
                                <td width="30%"><?php if(!empty($result['DateofRenewal'])){ echo date("m/d/Y", strtotime($result['DateofRenewal']));}else{echo "";} ?></td>
                                <td width="30%"><?php if(!empty($result['NewDateofRenewal'])){ echo date("m/d/Y", strtotime($result['NewDateofRenewal']));} else{echo "";} ?></td>
                            </tr>
                            <?php } ?>
                            <?php if(trim($result['PolicyType']) != trim($result['NewPolicyType'])){ ?>
                            <tr>
                                <td width="20%" height="35"><?php echo "Policy Type"; ?></td>
                                <td width="30%"><?php echo $result['PolicyType']; ?></td>
                                <td width="30%"><?php echo $result['NewPolicyType']; ?></td>
                            </tr>
                            <?php } ?>
                            <?php if(trim($result['DirectAssumed']) != trim($result['NewDirectAssumed'])){ ?>
                            <tr>
                                <td width="20%" height="35"><?php echo "Direct/Assumed"; ?></td>
                                <td width="30%"><?php echo $result['DirectAssumed']; ?></td>
                                <td width="30%"><?php echo $result['NewDirectAssumed']; ?></td>
                            </tr>
                            <?php } ?>
                            <?php if(trim($result['AdmittedNotAdmitted']) != trim($result['NewAdimittedNonAdmitted'])){ ?>
                            <tr>
                                <td width="20%" height="35"><?php echo "Admitted/ Non-Admitted"; ?></td>
                                <td width="30%"><?php echo $result['AdmittedNotAdmitted']; ?></td>
                                <td width="30%"><?php echo $result['NewAdimittedNonAdmitted']; ?></td>
                            </tr>
                            <?php } ?>
                            <?php if(trim($result['CompanyPaper']) != trim($result['NewCompanyPaper'])){ ?>
                            <tr>
                                <td width="20%" height="35"><?php echo "Company Paper"; ?></td>
                                <td width="30%"><?php echo $result['CompanyPaper']; ?></td>
                                <td width="30%"><?php echo $result['NewCompanyPaper']; ?></td>
                            </tr>
                            <?php } ?>
                            <?php if(trim($result['CompanyPaperNumber']) != trim($result['NewCompanyPaperNumber'])){ ?>
                            <tr>
                                <td width="20%" height="35"><?php echo "Company Paper Number"; ?></td>
                                <td width="30%"><?php echo $result['CompanyPaperNumber']; ?></td>
                                <td width="30%"><?php echo $result['NewCompanyPaperNumber']; ?></td>
                            </tr>
                            <?php } ?>
                            <?php if(trim($result['PolicyNumber']) != trim($result['NewPolicyNumber'])){ ?>
                            <tr>
                                <td width="20%" height="35"><?php echo "Policy Number"; ?></td>
                                <td width="30%"><?php echo $result['PolicyNumber']; ?></td>
                                <td width="30%"><?php echo $result['NewPolicyNumber']; ?></td>
                            </tr>
                            <?php } ?>
                            <?php if(trim($result['Coverage']) != trim($result['NewCoverage'])){ ?>
                            <tr>
                                <td width="20%" height="35"><?php echo "Coverage"; ?></td>
                                <td width="30%"><?php echo $result['Coverage']; ?></td>
                                <td width="30%"><?php echo $result['NewCoverage']; ?></td>
                            </tr>
                            <?php } ?>
                            <?php if(trim($result['Suffix']) != trim($result['NewSuffix'])){ ?>
                            <tr>
                                <td width="20%" height="35"><?php echo "Suffix"; ?></td>
                                <td width="30%"><?php echo $result['Suffix']; ?></td>
                                <td width="30%"><?php echo $result['NewSuffix']; ?></td>
                            </tr>
                            <?php } ?>
                            <?php if(trim($result['TransactionNumber']) != trim($result['NewTransactionNumber'])){ ?>
                            <tr>
                                <td width="20%" height="35"><?php echo "Transaction Number"; ?></td>
                                <td width="30%"><?php echo $result['TransactionNumber']; ?></td>
                                <td width="30%"><?php echo $result['NewTransactionNumber']; ?></td>
                            </tr>
                            <?php } ?>
                            <?php if(trim($result['NAICCode']) != trim($result['NewNAICCode'])){ ?>
                            <tr>
                                <td width="20%" height="35"><?php echo "NAIC Code"; ?></td>
                                <td width="30%"><?php echo $result['NAICCode']; ?></td>
                                <td width="30%"><?php echo $result['NewNAICCode']; ?></td>
                            </tr>
                            <?php } ?>
                            <?php if(trim($result['NAICTitle']) != trim($result['NewNAICTitle'])){ ?>
                            <tr>
                                <td width="20%" height="35"><?php echo "NAIC Title"; ?></td>
                                <td width="30%"><?php echo $result['NAICTitle']; ?></td>
                                <td width="30%"><?php echo $result['NewNAICTitle']; ?></td>
                            </tr>
                            <?php } ?>
                            <?php if(trim($result['SICCode']) != trim($result['NewSICCode'])){ ?>
                            <tr>
                                <td width="20%" height="35"><?php echo "SIC Code"; ?></td>
                                <td width="30%"><?php echo $result['SICCode']; ?></td>
                                <td width="30%"><?php echo $result['NewSICCode']; ?></td>
                            </tr>
                            <?php } ?>
                            <?php if(trim($result['SICTitle']) != trim($result['NewSICTitle'])){ ?>
                            <tr>
                                <td width="20%" height="35"><?php echo "SIC Title"; ?></td>
                                <td width="30%"><?php echo $result['SICTitle']; ?></td>
                                <td width="30%"><?php echo $result['NewSICTitle']; ?></td>
                            </tr>
                            <?php } ?>
                            <?php if(trim($result['OFRCAdverseReport']) != trim($result['NewOFRCAdverseReport'])){ ?>
                            <tr>
                                <td width="20%" height="35"><?php echo "OFRC Adverse Report"; ?></td>
                                <td width="30%"><?php echo $result['OFRCAdverseReport']; ?></td>
                                <td width="30%"><?php echo $result['NewOFRCAdverseReport']; ?></td>
                            </tr>
                            <?php } ?>
                        </table>
                         <div class="container">
                            <div class="content" style="display: block; border: 1px solid #aaa;">
                               <table width="100%" border="0" cellspacing="0" cellpadding="0">
                                <tr>
                                <td width="20%" height="35"><?php echo "Remarks"; ?></td>
                                <td width="30%"><?php echo $result['Remarks']; ?></td>
                                <td width="30%"></td>
                                </tr>
                               </table>
                            </div>
                        </div>
                   </div>
            </div>
        </div>  
      <?php } ?>
</div>
  
