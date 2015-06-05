<div id="content" class="view">
    <div class="breadcrumbs group"> 
        <ul id="breadcrumb">
            <li><a href="/">Home</a><span> >>&nbsp; </span></li>
            <li><a href="/submission/Submission">Submission</a><span> >>&nbsp; </span></li>
            <li><a href="/submission/List">Submission Listing</a><span> >>&nbsp; </span></li>
            <li class="selected">View</li>
        </ul>
        <a href="/submission/List" id="back"> </a>
    </div>
    <div class="container">
        <ul class="tabbed-menu">
            <li class="active"><a href="/submission/viewSubmission?submission=<?php echo $submissionId ?>">Submission Details</a></li>
            <li><a href="/submission/viewHistory?submission=<?php echo $submissionId ?>">Submission History</a></li>
        </ul>	
        <div class="dates">
            <em>Created Date: <strong><?php if (!empty($result['CREATION_DATE'])) {
              echo date("M-d-Y", strtotime($result['CREATION_DATE']));
                } else {
                    echo "";
                } ?></strong></em>
            <em>Updated Date: <strong><?php if (!empty($result['MODIFY_DATE'])) {
            echo date("M-d-Y", strtotime($result['MODIFY_DATE']));
            } else {
                echo "";
            } ?></strong></em>
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
                        <td width="22%"><?php echo $result['DUCK_SUBMISSION_NUMBER']; ?></td>
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
                        <td width="22%"><?php echo $result['SUBMISSION_TYPE']; ?></td>
                        <td width="12%">Underwriter:</td>
                        <td width="22%"><?php echo $result['UNDERWRITER_NAME']; ?></td>
                        <td width="12%">Product Line:</td>
                        <td width="22%"><?php echo $result['PRODUCT_LINE']; ?></td>
                    </tr>
                    <tr>
                        <td>Product Line Subtype:</td>
                        <td><?php echo $result['SUBMISSION_SUB_TYPE']; ?></td>
                        <td>Section:</td>
                        <td><?php echo $result['SECTION_CODE']; ?></td>
                        <td>Profit Code:</td>
                        <td><?php echo $result['PROFIT_CODE']; ?></td>
                    </tr>
                    <tr>
                        <td>Current Status:</td>
                        <td><?php echo $result['PRIMARY_STATUS']; ?></td>
                        <td>Effective Date:</td>
                        <td>
                            <?php if (!empty($result['EFFECTIVE_DATE'])) {
                                echo date("M-d-Y", strtotime($result['EFFECTIVE_DATE']));
                            } else {
                                echo "";
                            } ?>
                        </td>
                        <td>Expiry Date:</td>
                        <td>
                            <?php if (!empty($result['EXPIRATION_DATE'])) {
                                echo date("M-d-Y", strtotime($result['EXPIRATION_DATE']));
                            } else {
                                echo "";
                            } ?>
                        </td>
                    </tr>
                    <tr>
                        <td width="12%">Currency:</td>
                        <td width="22%"><?php echo $result['CURRENCY'][0]['LookupName']; ?></td>
                        <td width="12%">Exchange Rate:</td>
                        <td><?php if(!empty($result['EXCHANGE_RATE'])) { echo $result['EXCHANGE_RATE'];} else { echo "";} ?></td>
                        <td width="12%">Exchange Rate as on:</td>
                        <td width= "22%">
                            <?php if (!empty($result['EXCHANGE_DATE'])) {
                                echo date("M-d-Y", strtotime($result['EXCHANGE_DATE']));
                            } else {
                                echo "";
                            } ?>
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
                        <td width="22%"><?php echo $result['INSURED_NAME']; ?></td>
                        <td colspan="2"></td>
                        <td colspan="2" rowspan="6" style="padding:5px;">
                            <table width="75%" border="0" cellspacing="0" cellpadding="0">
                                <tr>
                                    <td>Insured Contact Person:</td>
                                    <td><?php echo $result['CONTACT_PERSON']; ?></td>
                                </tr>
                                <tr>
                                    <td>Insured Contact Person Email:</td>
                                    <td><?php echo $result['CONTACT_PERSON_EMAIL']; ?></td>
                                </tr>
                                <tr>
                                    <td>Insured Contact Person's Number(O):</td>
                                    <td><?php echo $result['CONTACT_PERSON_PHONE']; ?></td>
                                </tr>
                                <tr>
                                    <td>Insured Contact Person's Mobile:</td>
                                    <td><?php echo $result['CONTACT_PERSON_MOBILE']; ?></td>
                                </tr>
                                <tr>
                                    <td>Insured Submission Date:</td>
                                    <td><?php if(!empty($result['INSURED_SUBMISSION_DATE']) && $result['INSURED_SUBMISSION_DATE'] != 'Jan  1 1900 12:00:00:000AM'){ echo date("M-d-Y", strtotime($result['INSURED_SUBMISSION_DATE']));} elseif($result['INSURED_SUBMISSION_DATE'] == 'Jan  1 1900 12:00:00:000AM') { echo "";} else { echo "";} ?></td>
                                </tr>
                                <tr>
                                    <td>Insured Quote Due Date:</td>
                                    <td><?php if(!empty($result['INSURED_QUOTE_DUE_DATE']) && $result['INSURED_QUOTE_DUE_DATE'] != 'Jan  1 1900 12:00:00:000AM'){ echo date("M-d-Y", strtotime($result['INSURED_QUOTE_DUE_DATE']));} elseif($result['INSURED_QUOTE_DUE_DATE'] == 'Jan  1 1900 12:00:00:000AM') { echo "";} else {echo "";} ?></td>
                                </tr>
                            </table>
                        </td>
                    </tr>
                    <tr>
                        <td>Address Line 1:</td>
                        <td><?php echo $result['INSURED_ADDRESS']; ?></td>
                        <td>DBA Name:</td>
                        <td><?php echo $result['DBA_NAME']; ?></td>
                    </tr>
                    <tr>
                        <td>Country:</td>
                        <td><?php echo $result['INSURED_COUNTRY']; ?></td>
                        <td width="12%">D&amp;B Number :</td>
                        <td width="22%"><?php echo $result['DB_NUMBER']; ?></td>
                    </tr>
                    <tr>
                        <td>State:</td>
                        <td><?php echo $result['INSURED_STATE']; ?></td>
                        <td>Priority Companies:</td>
                        <td><?php echo $result['CAB_COMPANIES']; ?></td>
                    </tr>
                    <tr>
                        <td>City:</td>
                        <td><?php echo $result['INSURED_CITY']; ?></td>
                        <td>Reinsured Company:</td>
                        <td><?php echo $result['REINSURED_COMPANY']; ?></td>
                    </tr>
                    <tr>
                        <td>Zipcode:</td>
                        <td><?php echo $result['INSURED_ZIPCODE']; ?></td>
                        <td>Submission Identifier:</td>
                        <td><?php echo $result['SUBMISSION_IDENTIFIER']; ?></td>
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
                        <td width="22%"><?php echo $result['PROJECT_NAME']; ?></td>
                        <td width="12%">Name of General Contractor:</td>
                        <td width="22%"><?php echo $result['GENERAL_CONTRACTOR_NAME']; ?></td>
                        <td width="12%">Project Owner Name:</td>
                        <td><?php echo $result['PROJECT_OWNER_NAME']; ?></td>
                    </tr>
                    <tr>
                        <td>Project Country:</td>
                        <td><?php echo $result['PROJECT_COUNTRY_NAME']; ?></td>
                        <td>Project State:</td>
                        <td><?php echo $result['PROJECT_STATE_NAME']; ?></td>
                        <td>Project City:</td>
                        <td><?php echo $result['PROJECT_CITY_NAME']; ?></td>
                    </tr>
                    <tr>
                        <td>Project Street Address:</td>
                        <td><?php echo $result['PROJECT_STREET']; ?></td>
                        <td>Bid Situation:</td>
                        <td><?php echo $result['BID_SITATION']; ?></td>
                        <td>Total Insured Value:</td>
                        <td><?php if(!empty($result['TOTAL_INSURED_VALUE'])) { echo $result['TOTAL_INSURED_VALUE'];} else { echo "";} ?></td>
                    </tr>
                    <tr>
                        <td>Total Insured Value in USD:</td>
                        <td><?php echo $result['TOTAL_INSURED_VALUE_USD']; ?></td>
                        <td>Number Of Locations (greater than 3):</td>
                        <td><?php echo $result['NUMBER_OF_LOCATIONS']; ?></td>
                        <td> Risk Profile:</td>
                        <td><?php echo $result['RISK_PROFILE']; ?></td>
                    </tr>
                    <tr>
                        <td>Occupancy Code:</td>
                        <td><?php echo $result['OCCUPANCY_CODE']; ?></td>
                        <td>ISO Code:</td>
                        <td><?php if($result['ISC_CODE'] == 'NULL'){echo "";}else{ echo $result['ISC_CODE'];} ?></td>
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
                    <td width="22%"><?php echo $result['BROKER_NAME']; ?></td>
                    <td width="15%">Wholesaler or Retailer:</td>
                        <?php if (trim($result['BROKER_TYPE']) == 'R') { ?>
                        <td width="19%">Retailer</td>
                        <?php } else if (trim($result['BROKER_TYPE']) == 'W') { ?>
                        <td width="19%">Wholesaler</td>
                        <?php } ?>
                    <td width="12%">Retail Broker Name</td>
                    <td width="22%"><?php echo $result['RetailBrokerName']; ?></td>
                    </tr>
                    <tr>
                        <td>Broker Country:</td>
                        <td><?php echo $result['BROKER_COUNTRY']; ?></td>
                        <td>Broker State:</td>
                        <td><?php echo $result['BROKER_STATE']; ?></td>
                        <td>Broker City:</td>
                        <td><?php echo $result['BROKER_CITY']; ?></td>
                    </tr>
                    <tr>
                        <td>Retail Broker Country:</td>
                        <td><?php echo $result['retailBrokerCountryData']; ?></td>
                        <td>Retail Broker State:</td>
                        <td><?php echo $result['retailBrokerStateData']; ?></td>
                        <td>Retail Broker City:</td>
                        <td><?php echo $result['retailBrokerCityData']; ?></td>
                    </tr>
                    <tr>
                        <td>Broker Contact Person:</td>
                        <td><?php echo $result['BROKER_CONTACT_PERSON']; ?></td>
                        <td>Broker Contact Person's Email:</td>
                        <td><?php echo $result['BROKER_CONTACT_PERSON_EMAIL']; ?></td>
                        <td>Broker Contact Person's Number (O):</td>
                        <td><?php echo $result['BROKER_CONTACT_PERSON_NUMBER']; ?></td>
                    </tr>
                    <tr>
                        <td>Broker Contact Person Mobile:</td>
                        <td><?php echo $result['BROKER_CONTACT_PERSON_MOBILE']; ?></td>
                        <td>Broker Code:</td>
                        <td><?php echo $result['BROKER_CODE']; ?></td>
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
                        <td width="22%"><?php echo $result['REASON_CODE']; ?></td>
                        <td width="12%"></td>
                        <td width="22%"></td>
                        <td width="12%">Process Date:</td>
                        <td width= "22%">
                            <?php if (!empty($result['PROCESS_DATE'])) {
                                echo date("M-d-Y", strtotime($result['PROCESS_DATE']));
                            } else {
                                echo "";
                            } ?>
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
                        <td>Premium in Local Currency:</td>
                        <td><?php if(!empty($result['GROSS_PREMIUM'])) { echo $result['GROSS_PREMIUM'];} else { echo "";} ?></td>
                        <td>Premium (in USD):</td>
                        <td><?php if(!empty($result['GROSS_PREMIUM_USD'])) { echo $result['GROSS_PREMIUM_USD'];} else { echo "";} ?></td>
                        <td>Layer of Limit in Local Currency:</td>
                        <td><?php  echo $result['LAYER_OF_LIMIT_IN_LOCALCURRENCY']; ?></td>
                    </tr>
                    <tr>
                        <td>Layer of Limit (in USD):</td>
                        <td><?php  echo $result['LAYER_OF_LIMIT_IN_USD']; ?></td> 
                        <td>% of Layer:</td>
                        <td><?php  echo $result['PERCENTAGE_OF_LAYER']; ?></td> 
                        <td width="12%">Limit in Local Currency:</td>
                        <td width="22%"><?php if(!empty($result['LIMIT'])) { echo $result['LIMIT'];} else { echo "";} ?></td>
                    </tr>
                    <tr>
                        <td width="12%">Limit (in USD):</td>
                        <td width="22%"><?php if(!empty($result['LIMIT_USD'])) { echo $result['LIMIT_USD'];} else { echo "";} ?></td>
                        <td width="12%">Attachment Point in Local Currency:</td>
                        <td><?php if(!empty($result['ATTACHMENT_POINT'])) { echo $result['ATTACHMENT_POINT'];} else { echo "";} ?></td>
                        <td width="12%">Attachment Point (in USD):</td>
                        <td><?php if(!empty($result['ATTACHMENT_POINT_USD'])) { echo $result['ATTACHMENT_POINT_USD'];} else { echo "";} ?></td>
                    </tr>
                    <tr>
                        <td width="12%">Self Insured Retention in Local Currency:</td>
                        <td width="22%"><?php  echo $result['SELF_RETENTION_IN_LOCAL_CURRENCY']; ?></td>
                        <td width="12%">Self Insured Retention(in USD):</td>
                        <td><?php  echo $result['SELF_RETENTION_IN_USD'];?></td>
                        <td width="12%">Policy Comm. %:</td>
                        <td><?php echo $result['POLICY_COMM_PERCENTAGE']; ?></td>
                    </tr>
                    <tr>
                        <td width="12%">Policy Comm. in Local Currency:</td>
                        <td width="22%"><?php  echo $result['POLICY_COMM_IN_LOCAL_CURRENCY']; ?></td>
                        <td width="12%">Policy Comm.(in USD):</td>
                        <td><?php  echo $result['POLICY_COMM_IN_USD'];?></td>
                        <td width="12%">Premium (Net of All Commission) in Local Currency:</td>
                        <td><?php echo $result['PREMIUM_NET_COMM_LOCAL']; ?></td>
                    </tr>
                    <tr>
                        <td width="12%">Premium (Net of All Commission)(in USD):</td>
                        <td width="22%"><?php  echo $result['PREMIUM_NET_COMM_USD']; ?></td>
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
                        <td><?php if (!empty($result['BINDDATE']) && date("M-d-Y", strtotime($result['BINDDATE']))!='Jan-01-1970') {
                                echo date("M-d-Y", strtotime($result['BINDDATE']));
                            } else {
                                echo "";
                            } ?></td>
                        <td>Renewable(Y/N):</td>
                        <td><?php echo $result['RENEWAL']; ?></td>
                        <td>Date of Renewal:</td>
                        <td><?php if (!empty($result['DATE_OF_RENEWAL'])) {
                                echo date("M-d-Y", strtotime($result['DATE_OF_RENEWAL']));
                            } else {
                                echo "";
                            } ?></td>
                    </tr>
                    <tr>
                        <td>Policy Type:</td>
                        <td><?php  echo $result['POLICY_TYPE']; ?></td> 
                        <td>Direct/Assumed:</td>
                        <td><?php  echo $result['DIRECTASSUMED']; ?></td> 
                        <td width="12%">Admitted/ Non-Admitted:</td>
                        <td width="22%"><?php  echo $result['ADMITTED_NONADMITTED']; ?></td>
                    </tr>
                    <tr>
                        <td width="12%">Class Name:</td>
                        <td width="22%"><?php  echo $result['CLASSNAME']; ?></td>
                        <td width="12%">Class code:</td>
                        <td><?php echo $result['CLASSCODE']; ?></td>
                        <td width="12%">Description:</td>
                        <td><?php  echo $result['CLASSDESCRIPTION']; ?></td>
                    </tr>
                    <tr>
                        <td width="12%">Company Paper:</td>
                        <td width="22%"><?php  echo $result['COMPANYPAPER']; ?></td>
                        <td width="12%">Company Paper Number:</td>
                        <td><?php echo $result['COMPANYPAPERNUMBER']; ?></td>
                        <td width="12%">Policy Number:</td>
                        <td><?php  echo $result['POLICYNUMBER']; ?></td>
                    </tr>
                    <tr>
                        <td width="12%">Coverage:</td>
                        <td width="22%"><?php  echo $result['COVERAGE']; ?></td>
                        <td width="12%">Suffix:</td>
                        <td><?php  echo $result['SUFFIX'];?></td>
                        <td width="12%">Transaction Number:</td>
                        <td><?php echo $result['TRANSACTIONUMBER']; ?></td>
                    </tr>
                    <tr>
                        <td width="12%">NAIC Code:</td>
                        <td width="22%"><?php  echo $result['NAICCode']; ?></td> 
                        <td width="12%">NAIC Title:</td>
                        <td><?php  echo $result['NAICTitle'];?></td>
                        <td width="12%">SIC Code:</td>
                        <td><?php echo $result['SICCode']; ?></td>
                    </tr>
                    <tr>
                        <td width="12%">SIC Title:</td>
                        <td width="22%"><?php  echo $result['SICTitle']; ?></td>
                        <td width="12%">OFRC Adverse Report:</td>
                        <td width="22%"><?php  echo $result['OFRCAdverseReport']; ?></td>
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
                            <?php if (!empty($result['BERK_FROM_BROKER'])) {
                                echo date('M-d-Y H:i', strtotime($result['BERK_FROM_BROKER']));
                            } else {
                                echo "";
                            } ?>
                        </td>
                        <td width="12%">Date of Receiving-By India From Berk SI:</td>
                        <td width="22%">
                            <?php if (!empty($result['BERKSI_BY_INDIA'])) {
                                echo date("M-d-Y", strtotime($result['BERKSI_BY_INDIA']));
                            } else {
                                echo "";
                            } ?>
                        </td>
                        <td width="12%">Branch Office:</td>
                        <td><?php echo $result['BRANCH']; ?></td>
                    </tr> 
                    <tr>
                       <td width="12%">Remarks:</td>
                        <td><?php echo $result['REMARK']; ?></td> 
                    </tr>
                </table>
            </div>
        </div>
    </div>
    <div class="container">
        <table width="100%" cellpadding="0" cellspacing="0">
            <tr>
                <td align="center">
                    <a href="/submission/List"><input type="button" class="btn btn-blue" value="Back" /></a>
                </td>
            </tr>
        </table>
    </div>
</div>

