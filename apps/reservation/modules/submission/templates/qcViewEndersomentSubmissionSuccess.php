<div id="content" class="view">
    <div class="breadcrumbs group"> 
        <ul id="breadcrumb">
            <li><a href="/">Home</a><span> >>&nbsp; </span></li>
            <li><a href="/submission/Submission">Submission</a><span> >>&nbsp; </span></li>
            <li><a href="/submission/QCAmendmentList">Amendment QC Queue list</a><span> >>&nbsp; </span></li>
            <li class="selected">View</li>
        </ul>
        <a href="/submission/List" id="back"> </a>
    </div>
    <div class="container">
        <ul class="tabbed-menu">
            <li class="active"><a href="/submission/viewamendment?amendmentId=<?php echo $amendmentId ?>">Amendment Submission Details</a></li>
            <li><a href="/submission/ViewEndersomentSubmissionHistory?amendmentId=<?php echo $amendmentId ?>">Amendment Submission History</a></li>
        </ul>	
        <div class="dates">
            <em>Created Date: <strong><?php
                    if (!empty($result[0]['CreatedOn'])) {
                        echo date("Y-m-d", strtotime($result[0]['CreatedOn']));
                    } else {
                        echo "";
                    }
                    ?></strong></em>
            <em>Updated Date: <strong><?php
                    if (!empty($result[0]['ModifiedOn'])) {
                        echo date("Y-m-d", strtotime($result[0]['ModifiedOn']));
                    } else {
                        echo "";
                    }
                    ?></strong></em>
        </div>
        <div class="clear"></div>
    </div>

    <div class="container">
        <div class="box">
            <h1 class="section-header">Duck Creek Details
                <div class="arrow"></div>
            </h1>
            <div class="content" style="display: block;">
                <table width="100%" border="0" cellspacing="0" cellpadding="0">
                    <tr>
                        <td width="12%">Submission Number:</td>
                        <td width="22%"><?php echo $result[0]['DuckSubmissionNumber']; ?></td>
                        <td width="12%"></td>
                        <td width="22%"></td>
                        <td width="12%"></td>
                        <td width="22%"></td>
                    </tr>
                </table>
            </div>
        </div>
    </div>

    <div class="container">
        <div class="box">
            <h1 class="section-header">Create Submission
                <div class="arrow"></div>
            </h1>
            <div class="content" style="display: block;">
                <table width="100%" border="0" cellspacing="0" cellpadding="0">
                    <tr>
                        <td width="12%">New Renewal:</td>
                        <td width="22%"><?php echo $result[0]['NewRenewal']; ?></td>
                        <td width="12%">Underwriter:</td>
                        <td width="22%"><?php echo $result[0]['Underwriter']; ?></td>
                        <td width="12%">Product Line:</td>
                        <td width="22%"><?php echo $result[0]['ProductLine']; ?></td>
                    </tr>
                    <tr>
                        <td>Product Line Subtype:</td>
                        <td><?php echo $result[0]['ProductLineSubType']; ?></td>
                        <td>Section:</td>
                        <td><?php echo $result[0]['Section']; ?></td>
                        <td>Profit Code:</td>
                        <td><?php echo $result[0]['ProfitCode']; ?></td>
                    </tr>
                    <tr>
                        <td>Current Status:</td>
                        <td><?php echo $result[0]['StatusName']; ?></td>
                        <td>Effective Date:</td>
                        <td>
                            <?php
                            if (!empty($result[0]['EffectiveDate'])) {
                                echo date("M-d-Y", strtotime($result[0]['EffectiveDate']));
                            } else {
                                echo "";
                            }
                            ?>
                        </td>
                        <td>Expiry Date:</td>
                        <td>
<?php
if (!empty($result[0]['ExpiryDate'])) {
    echo date("M-d-Y", strtotime($result[0]['ExpiryDate']));
} else {
    echo "";
}
?>
                        </td>
                    </tr>
                    <tr>
                        <td width="12%">Currency:</td>
                        <td width="22%"><?php echo $result[0]['Currency']; ?></td>
                        <td width="12%">Exchange Rate:</td>
                        <td><?php if (!empty($result[0]['ExchangeRate'])) {
                                echo $result[0]['ExchangeRate'];
                            } else {
                                echo "";
                            } ?></td>
                        <td width="12%">Exchange Rate as on:</td>
                        <td width= "22%">
<?php
if (!empty($result[0]['ExchangeDate'])) {
    echo date("M-d-Y", strtotime($result[0]['ExchangeDate']));
} else {
    echo "";
}
?>
                        </td>
                    </tr>
                </table>
            </div>
        </div>
    </div>

    <div class="container">
        <div class="box">
            <h1 class="section-header">Insured Details
                <div class="arrow"></div>
            </h1>
            <div class="content" style="display: block;">
                <table width="100%" border="0" cellspacing="0" cellpadding="0">
                    <tr>
                        <td width="12%">Insured Name:</td>
                        <td width="22%"><?php echo $result[0]['InsuredName']; ?></td>
                        <td colspan="2"></td>
                        <td colspan="2" rowspan="6" style="padding:5px;">
                            <table width="75%" border="0" cellspacing="0" cellpadding="0">
                                <tr>
                                    <td>Insured Contact Person:</td>
                                    <td><?php echo $result[0]['InsuredContactPersonName']; ?></td>
                                </tr>
                                <tr>
                                    <td>Insured Contact Person Email:</td>
                                    <td><?php echo $result[0]['InsuredContactPersonEmail']; ?></td>
                                </tr>
                                <tr>
                                    <td>Insured Contact Person's Number(O):</td>
                                    <td><?php echo $result[0]['InsuredContactPersonNumber']; ?></td>
                                </tr>
                                <tr>
                                    <td>Insured Contact Person's Mobile:</td>
                                    <td><?php echo $result[0]['InsuredContactPersonMobile']; ?></td>
                                </tr>
                                <tr>
                                    <td>Insured Submission Date:</td>
                                    <td><?php if (!empty($result[0]['InsuredSubmissionDate']) && $result[0]['InsuredSubmissionDate'] != 'Jan  1 1900 12:00:00:000AM') {
    echo date("M-d-Y", strtotime($result[0]['InsuredSubmissionDate']));
} elseif ($result[0]['InsuredSubmissionDate'] == 'Jan  1 1900 12:00:00:000AM') {
    echo "";
} else {
    echo "";
} ?></td>
                                </tr>
                                <tr>
                                    <td>Insured Quote Due Date:</td>
                                    <td><?php if (!empty($result[0]['InsuredQuoteDueDate']) && $result[0]['InsuredQuoteDueDate'] != 'Jan  1 1900 12:00:00:000AM') {
    echo date("M-d-Y", strtotime($result[0]['InsuredQuoteDueDate']));
} elseif ($result[0]['InsuredQuoteDueDate'] == 'Jan  1 1900 12:00:00:000AM') {
    echo "";
} else {
    echo "";
} ?></td>
                                </tr>
                            </table>
                        </td>
                    </tr>
                    <tr>
                        <td>Address Line 1:</td>
                        <td><?php echo $result[0]['AddressLine1']; ?></td>
                        <td>DBA Name:</td>
                        <td><?php echo $result[0]['DbaName']; ?></td>
                    </tr>
                    <tr>
                        <td>Country:</td>
                        <td><?php echo $result[0]['Country']; ?></td>
                        <td width="12%">D&amp;B Number :</td>
                        <td width="22%"><?php echo $result[0]['DBNumber']; ?></td>
                    </tr>
                    <tr>
                        <td>State:</td>
                        <td><?php echo $result[0]['InsuredState']; ?></td>
                        <td>Priority Companies:</td>
                        <td><?php echo $result[0]['CabCompanies']; ?></td>
                    </tr>
                    <tr>
                        <td>City:</td>
                        <td><?php echo $result[0]['City']; ?></td>
                        <td>Reinsured Company:</td>
                        <td><?php echo $result[0]['ReinsuredCompany']; ?></td>
                    </tr>
                    <tr>
                        <td>Zipcode:</td>
                        <td><?php echo $result[0]['Zip']; ?></td>
                        <td>Submission Identifier:</td>
                        <td><?php echo $result[0]['SubmissionTypeIdentifier']; ?></td>
                    </tr> 
                    </tr>
                </table>
            </div>
        </div>
    </div>
    <div class="container" id="project_details">
        <div class="box">
            <h1 class="section-header">
                Line of Business Dependent Details
                <div class="arrow"></div>
            </h1>
            <div class="content" style="display: block;">
                <table width="100%" border="0" cellspacing="0" cellpadding="0">
                    <tr>
                        <td width="12%">Project Name:</td>
                        <td width="22%"><?php echo $result[0]['ProjectName']; ?></td>
                        <td width="12%">Name of General Contractor:</td>
                        <td width="22%"><?php echo $result[0]['ProjectGeneralContractorName']; ?></td>
                        <td width="12%">Project Owner Name:</td>
                        <td><?php echo $result[0]['ProjectOwnerName']; ?></td>
                    </tr>
                    <tr>
                        <td>Project Country:</td>
                        <td><?php echo $result[0]['ProjectCountry']; ?></td>
                        <td>Project State:</td>
                        <td><?php echo $result[0]['ProjectState']; ?></td>
                        <td>Project City:</td>
                        <td><?php echo $result[0]['ProjectCity']; ?></td>
                    </tr>
                    <tr>
                        <td>Project Street Address:</td>
                        <td><?php echo $result[0]['ProjectAddress']; ?></td>
                        <td>Bid Situation:</td>
                        <td><?php echo $result[0]['BidSituation']; ?></td>
                        <td>Total Insured Value:</td>
                        <td><?php if (!empty($result[0]['TotalInsuredValue'])) {
    echo $result[0]['TotalInsuredValue'];
} else {
    echo "";
} ?></td>
                    </tr>
                    <tr>
                        <td>Total Insured Value in USD:</td>
                        <td><?php echo $result[0]['TotalInsuredValueInUSD']; ?></td>
                        <td>Number Of Locations (greater than 3):</td>
                        <td><?php echo $result[0]['NumberOfLocations']; ?></td>
                        <td> Risk Profile:</td>
                        <td><?php echo $result[0]['RiskProfile']; ?></td>
                    </tr>
                    <tr>
                        <td>Occupancy Code:</td>
                        <td><?php echo $result[0]['OccupancyCode']; ?></td>
                        <td>ISO Code:</td>
                       <td><?php if($result[0]['ISOCode'] == 'NULL'){echo "";}else{ echo $result[0]['ISOCode'];} ?></td>
                    </tr>
                </table>
            </div>
        </div>
    </div>
    <div class="container">
        <div class="box">
            <h1 class="section-header">Broker Details
                <div class="arrow"></div>
            </h1>
            <div class="content" style="display: block;">
                <table width="100%" border="0" cellspacing="0" cellpadding="0">

                    <td width="12%">Broker Name:</td>
                    <td width="22%"><?php echo $result[0]['BrokerName']; ?></td>
                    <td width="12%">Wholesaler or Retailer:</td>
                    <td width="22%"><?php echo $result[0]['BrokerType']; ?></td>
                    <td width="12%">Retail Broker Name</td>
                    <td width="22%"><?php echo $result[0]['RetailBrokerName']; ?></td>
                    </tr>
                    <tr>
                        <td>Broker Country:</td>
                        <td><?php echo $result[0]['BrokerCountry']; ?></td>
                        <td>Broker State:</td>
                        <td><?php echo $result[0]['BrokerState']; ?></td>
                        <td>Broker City:</td>
                        <td><?php echo $result[0]['BrokerCity']; ?></td>
                    </tr>
                    <tr>
                        <td>Retail Broker Country:</td>
                        <td><?php echo $result[0]['RetailBrokerCountry']; ?></td>
                        <td>Retail Broker State:</td>
                        <td><?php echo $result[0]['RetailBrokerState']; ?></td>
                        <td>Retail Broker City:</td>
                        <td><?php echo $result[0]['RetailBrokerCity']; ?></td>
                    </tr>
                    <tr>
                        <td>Broker Contact Person:</td>
                        <td><?php echo $result[0]['BrokerContactPerson']; ?></td>
                        <td>Broker Contact Person's Email:</td>
                        <td><?php echo $result[0]['BrokerContactPersonEmail']; ?></td>
                        <td>Broker Contact Person's Number (O):</td>
                        <td><?php echo $result[0]['BrokerContactPersonNumber']; ?></td>
                    </tr>
                    <tr>
                        <td>Broker Contact Person Mobile:</td>
                        <td><?php echo $result[0]['BrokerContactPersonMobile']; ?></td>
                        <td>Broker Code:</td>
                        <td><?php echo $result[0]['BrokerCode']; ?></td>
                    </tr>

                </table>
            </div>
        </div>
    </div>

    <div class="container">
        <div class="box">
            <h1 class="section-header">Status Dependent Details
                <div class="arrow"></div>
            </h1>
            <div class="content" style="display: block;">
                <table width="100%" border="0" cellspacing="0" cellpadding="0">
                    <tr>
                        <td width="12%">Reason Code:</td>
                        <td width="22%"><?php echo $result[0]['ReasonCode']; ?></td>
                        <td width="12%"></td>
                        <td width="22%"></td>
                        <td width="12%">Process Date:</td>
                        <td width= "22%">
                            <?php
                            if (!empty($result[0]['ProcessDate'])) {
                                echo date("M-d-Y", strtotime($result[0]['ProcessDate']));
                            } else {
                                echo "";
                            }
                            ?>
                        </td>
                    </tr>
                </table>
            </div>
        </div>
    </div><!--status dependacy-->

    <div class="container">
        <div class="box">
            <h1 class="section-header">Premium Details
                <div class="arrow"></div>
            </h1>
            <div class="content" style="display: block;">
                <table width="100%" border="0" cellspacing="0" cellpadding="0">
                    <tr>
                        <td>Premium Type:</td>
                        <td><?php echo $result[0]['PremiunType']; ?></td>
                        <td></td>
                        <td></td>
                        <td></td>
                        <td></td>
                    </tr>
                    <tr>
                        <td>Premium in Local Currency:</td>
                        <td><?php
                            if (!empty($result[0]['PremiumInLocalCurrency'])) {
                                if ($result[0]['PremiumInLocalCurrency'] == '-1') {
                                    echo "Not Available";
                                } else if ($result[0]['PremiumInLocalCurrency'] == '-2') {
                                    echo "To Be Entered";
                                } else {
                                    echo $result[0]['PremiumInLocalCurrency'];
                                }
                            } else {
                                echo "";
                            }
                            ?></td>
                        <td>Premium (in USD):</td>
                        <td><?php if (!empty($result[0]['PremiumInUSD'])) {
                                echo $result[0]['PremiumInUSD'];
                            } else {
                                echo "";
                            } ?></td>
                        <td>Layer of Limit in Local Currency:</td>
                        <td><?php echo $result[0]['LayerofLimitInLocalCurrency']; ?></td>
                    </tr>
                    <tr>
                        <td>Layer of Limit (in USD):</td>
                        <td><?php echo $result[0]['LayerofLimitInUSD']; ?></td> 
                        <td>% of Layer:</td>
                        <td><?php echo $result[0]['PercentageofLayer']; ?></td> 
                        <td width="12%">Limit in Local Currency:</td>
                        <td width="22%"><?php if(!empty($result[0]['LimitInLocalCurrency'])) { 
                                if ($result[0]['LimitInLocalCurrency'] == '-1') {
                                    echo "Not Available";
                                }  else if ($result[0]['LimitInLocalCurrency'] == '-2') {
                                    echo "To Be Entered";
                                }  else {
                                   echo $result[0]['LimitInLocalCurrency'];    
                                }
                            } else { echo "";} ?>
                        </td>
                    </tr>
                    <tr>
                        <td width="12%">Limit (in USD):</td>
                        <td width="22%"><?php if (!empty($result[0]['LimitInUSD'])) {
                                echo $result[0]['LimitInUSD'];
                            } else {
                                echo "";
                            } ?></td>
                        <td width="12%">Attachment Point in Local Currency:</td>
                        <td><?php if(!empty($result[0]['AttachmentPointInLocalCurrency'])) { 
                                if ($result[0]['AttachmentPointInLocalCurrency'] == '-1') {
                                    echo "Not Available";
                                }  else if ($result[0]['AttachmentPointInLocalCurrency'] == '-2') {
                                    echo "To Be Entered";
                                }else {
                                    echo $result[0]['AttachmentPointInLocalCurrency'];
                                }
                            } else { echo "";} ?>
                        </td>
                        <td width="12%">Attachment Point (in USD):</td>
                        <td><?php if (!empty($result[0]['AttachmentPointInUSD'])) {
                                echo $result[0]['AttachmentPointInUSD'];
                            } else {
                                echo "";
                            } ?></td>
                    </tr>
                    <tr>
                        <td width="12%">Self Insured Retention in Local Currency:</td>
                        <td width="22%"><?php echo $result[0]['SelfInsuredRetentionInLocalCur']; ?></td>
                        <td width="12%">Self Insured Retention(in USD):</td>
                        <td><?php echo $result[0]['SelfInsuredRetentionInUSD']; ?></td>
                        <td width="12%">Policy Comm. %:</td>
                        <td><?php echo $result[0]['PolicyCommPercentage']; ?></td>
                    </tr>
                    <tr>
                        <td width="12%">Policy Comm. in Local Currency:</td>
                        <td width="22%"><?php echo $result[0]['PolicyCommInLocalCurrency']; ?></td>
                        <td width="12%">Policy Comm.(in USD):</td>
                        <td><?php echo $result[0]['PolicyCommInUSD']; ?></td>
                        <td width="12%">Premium (Net of All Commission) in Local Currency:</td>
                        <td><?php echo $result[0]['PremiumNetofCommInLocalCurrenc']; ?></td>
                    </tr>
                    <tr>
                        <td width="12%">Premium (Net of All Commission)(in USD):</td>
                        <td width="22%"><?php echo $result[0]['PremiumNetofCommInUSD']; ?></td>
                    </tr>
                </table>
            </div>
        </div>
    </div><!--Premium dependacy-->

    <div class="container">
        <div class="box">
            <h1 class="section-header">Policy Details
                <div class="arrow"></div>
            </h1>
            <div class="content" style="display: block;">
                <table width="100%" border="0" cellspacing="0" cellpadding="0">
                    <tr>
                        <td>Bind Date:</td>
                        <td><?php
                            $validDate = date('Y-m-d', strtotime('-10 years'));
                            if (!empty($result[0]['BindDate']) && date('Y-m-d', strtotime($result[0]['BindDate']) > $validDate)) {
                                echo date("M-d-Y", strtotime($result[0]['BindDate']));
                            } else {
                                echo "";
                            }
                            ?></td>
                        <td>Renewable(Y/N):</td>
                        <td><?php echo $result[0]['Renewable']; ?></td>
                        <td>Date of Renewal:</td>
                        <td><?php
                            if (!empty($result[0]['DateofRenewal'])) {
                                echo date("M-d-Y", strtotime($result[0]['DateofRenewal']));
                            } else {
                                echo "";
                            }
                            ?></td>
                    </tr>
                    <tr>
                        <td>Policy Type:</td>
                        <td><?php echo $result[0]['PolicyType']; ?></td> 
                        <td>Direct/Assumed:</td>
                        <td><?php echo $result[0]['DirectAssumed']; ?></td> 
                        <td width="12%">Admitted/ Non-Admitted:</td>
                        <td width="22%"><?php echo $result[0]['AdmittedNotAdmitted']; ?></td>
                    </tr>
                    <tr>
                        <td width="12%">Class Name:</td>
                        <td width="22%"><?php echo $result[0]['ClassName']; ?></td>
                        <td width="12%">Class code:</td>
                        <td><?php echo $result[0]['ClassCode']; ?></td>
                        <td width="12%">Description:</td>
                        <td><?php echo $result[0]['ClassDescription']; ?></td>
                    </tr>
                    <tr>
                        <td width="12%">Company Paper:</td>
                        <td width="22%"><?php echo $result[0]['CompanyPaper']; ?></td>
                        <td width="12%">Company Paper Number:</td>
                        <td><?php echo $result[0]['CompanyPaperNumber']; ?></td>
                        <td width="12%">Policy Number:</td>
                        <td><?php echo $result[0]['PolicyNumber']; ?></td>
                    </tr>
                    <tr>
                        <td width="12%">Coverage:</td>
                        <td width="22%"><?php echo $result[0]['Coverage']; ?></td>
                        <td width="12%">Suffix:</td>
                        <td><?php echo $result[0]['Suffix']; ?></td>
                        <td width="12%">Transaction Number:</td>
                        <td><?php echo $result[0]['TransactionNumber']; ?></td>
                    </tr>
                    <tr>
                        <td width="12%">NAIC Code:</td>
                        <td width="22%"><?php echo $result[0]['NAICCode']; ?></td> 
                        <td width="12%">NAIC Title:</td>
                        <td><?php echo $result[0]['NAICTitle']; ?></td>
                        <td width="12%">SIC Code:</td>
                        <td><?php echo $result[0]['SICCode']; ?></td>
                    </tr>
                    <tr>
                        <td width="12%">SIC Title:</td>
                        <td width="22%"><?php echo $result[0]['SICTitle']; ?></td>
                        <td width="12%">OFRC Adverse Report:</td>
                        <td width="22%"><?php echo $result[0]['OFRCAdverseReport']; ?></td>
                    </tr>
                </table>
            </div>
        </div>
    </div><!--status dependacy-->

    <div class="container">
        <div class="box">
            <h1 class="section-header">Other Details
                <div class="arrow"></div>
            </h1>
            <div class="content" style="display: block;">
                <table>
                    <tr>
                        <td width="12%">Date of Receiving-By Berk SI From Broker:</td>
                        <td width="22%">
<?php
if (!empty($result[0]['BerkSIDateFromBroker'])) {
    echo date('M-d-Y H:i', strtotime($result[0]['BerkSIDateFromBroker']));
} else {
    echo "";
}
?>
                        </td>
                        <td width="12%">Date of Receiving-By India From Berk SI:</td>
                        <td width="22%">
<?php
if (!empty($result[0]['BerkSiDateFromIndia'])) {
    echo date("M-d-Y", strtotime($result[0]['BerkSiDateFromIndia']));
} else {
    echo "";
}
?>
                        </td>
                        <td width="12%">Branch Office:</td>
                        <td><?php echo $result[0]['BranchName']; ?></td>
                    </tr>           
                </table>
            </div>
        </div>
    </div>
    <form action="<?php echo "/submission/QCUpdateEndersomentSubmission?amendmentId=" . $amendmentId; ?>" name="qcSubmitForm" id="qcSubmitForm" method="POST">
        <div class="container">
            <div class="box">
                <h1 class="section-header">QC Remarks
                    <div class="arrow"></div>
                </h1>
                <div class="content" style="display: block;">
                    <table>
                        <tr>
                            <td width="8%">QC Approved</td>
                            <td width="18%"><input type="radio" name="qcstatus" id="qcstatus" value="Approved" required></td>
                            <td width="8%">QC Rejected</td>
                            <td width="18%"><input type="radio" name="qcstatus" id="qcstatus" value="Rejected" required></td>
                            <td width="8%">QC Uncleared</td>
                            <td width="18%"><input type="radio" name="qcstatus" id="qcstatus" value="Uncleared" required></td>
                            <td width="8%">Uncleared Advisen</td>
                            <td width="18%"><input type="radio" name="qcstatus" id="qcstatus" value="Uncleared Advisen" required></td>
                            <td width="8%">Remark</td>
                            <td width="18%"><textarea name="qcremarks"><?php echo $result[0]['Remark']; ?></textarea></td>
                        </tr>           
                    </table>
                </div>
            </div>
        </div>
        <div class="container">
            <table width="100%" cellpadding="0" cellspacing="0">
                <tr>
                    <td align="center">
                        <input type="submit" class="btn btn-blue" name="qcsubmit" id="qcsubmit" value="Submit"> <a href="/submission/QCList"><input type="button" class="btn btn-cyan" value="Back" /></a>
                    </td>
                </tr>
            </table>
        </div>
    </form>
</div>

