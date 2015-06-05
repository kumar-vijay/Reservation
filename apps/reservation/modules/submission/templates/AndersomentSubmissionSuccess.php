<div id="content">
    <div class="breadcrumbs group"> 
        <ul id="breadcrumb">
            <li><a href="/">Home</a><span> >>&nbsp; </span></li>
            <li><a href="/submission/Submission">Submission</a><span> >>&nbsp; </span></li>
            <li><a href="/submission/List">Submission Listing</a><span> >>&nbsp; </span></li>
            <li class="selected">Edit</li>
        </ul>
        <a href="/submission/List" id="back"></a>
    </div>
    <div class="container">
        <ul class="tabbed-menu">
            <li class="active"><a href="/submission/edit?submission=<?php echo $submissionId; ?>" id="submissiondetails">Submission Details</a></li>
            <li><a href="/submission/history?submission=<?php echo $submissionId; ?>" id="submissionhistory">Submission History</a></li>
        </ul>	
        <div class="dates">
            <em>Created Date: <strong><?php echo date("Y-m-d", strtotime($DataRecorder['CreatedOn'])); ?></strong></em>
            <em>Updated Date: <strong><?php
                    if ($DataRecorder['ModifiedOn'] != '') {
                        echo date("Y-m-d", strtotime($DataRecorder['ModifiedOn']));
                    } else {
                        echo '';
                    }
                    ?></strong></em>
        </div>
        <div class="clear"></div>
    </div>
    <form name="editSubmissionForm" id="editSubmissionForm" method="POST" action="" autocomplete="off">
        <div class="container">
            <div class="box">
                <h1 class="section-header">Duck Creek Details
                    <div class="arrow"></div>
                </h1>
                <div class="content" style="display: block;">
                     <table width="100%" border="0" cellspacing="0" cellpadding="0">
                        <tr>
                            <td width="12%">Submission Number<input type="checkbox" name= "yesDuckSubmissionNumber" id="yesDuckSubmissionNumber" value="Y" <?php
                                    if (trim($submissionRow['IsDuckSubmissionNumber']) == 'Y') {
                                        echo "checked";
                                    }
                                    ?>/>
                            </td>
                            <td width="22%">
                               <input type="text" name="editDuckSubmissionNumber" id="editDuckSubmissionNumber" class="listbox-small" value="<?php echo $submissionRow['DuckSubmissionNumber']; ?>" />
                            </td>
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
                            <td width="12%">New/Renewal<span style="color: red;"> *</span></td>
                            <td width="22%">
                                <select class="listbox-small" name="newrenewal" id="submissiontype">
                                    <option value="">-- Select --</option>
                                    <?php
                                    foreach ($nerrenewal as $value) {
                                        if ($submissionRow['NewRenewalLookupId'] == $value['Id'])
                                            $select = 'selected="selected"';
                                        else
                                            $select = '';
                                        ?>
                                        <option value="<?php echo $value['Id'] ?>" <?php echo $select; ?> ><?php echo $value['Alias'] ?></option>
                                    <?php } ?>
                                </select>
                            </td>
                            </td>
                            <td width="12%">Underwriter<span style="color: red;"> *</span></td>
                            <td width="22%">
                                <select name="editunderwriter" id="underwriter_id" class="listbox-small">
                                    <option value="0">-- Select --</option>
                                    <?php foreach ($underwriters as $underwriter) { ?>
                                        <option value="<?php echo $underwriter->Id; ?>" 
                                        <?php
                                        if ($underwriter->Id == $submissionRow['UnderwriterId']) {
                                            echo "selected = selected";
                                        }
                                        ?>><?php echo $underwriter->Name; ?></option>
                                    <?php } ?>
                                </select>
                            </td>
                            <td width="12%">Product Line</td>
                            <td width="22%">
                                <?php if ($userGroup == 'master') { ?>
                                    <select name="productline_master" id="productline_master" class="listbox-small">
                                        <option value="">-- Select --</option>
                                        <?php foreach ($productLine as $productLineValue) { ?>
                                            <option value="<?php echo $productLineValue['Id']; ?>" 
                                            <?php
                                            if ($productLineValue['Id'] == $submissionRow['LobId']) {
                                                echo "selected = selected";
                                            }
                                            ?>><?php echo $productLineValue['LOBName']; ?></option>
                                    <?php } ?>
                                    </select>
                                <?php } else { ?>
                                    <input type="text" name="editproductline" id="productline" class="listbox-small" readonly/>
                                    <input type="hidden" id="productLinePrefix1" name="productLinePrefix">
                                <?php } ?>
                                <input type="hidden" id="productLineHidden" name="productLineHidden" value="<?php echo trim($submissionProduct['LOBName']); ?>">
                            </td>
                        </tr>
                        <tr>
                            <td width="12%">Product Line Subtype<span style="color: red;"> *</span></td>
                            <td width="22%">
                                <?php if ($userGroup == 'master') { ?>
                                    <select name="editproductlinesubtype_master" id="editproductlinesubtype_master" class="listbox-small">
                                        <option value="0">-- Select --</option>
                                    </select>
                                <?php } else { ?>
                                    <select name="editproductlinesubtype" id="productlinesubtype" class="listbox-small">
                                        <option value="0">-- Select --</option>
                                    </select>
                                <?php } ?>
                                <input type="hidden" name="productLineSubTypeHidden" id="productLineSubTypeHidden" value="<?php echo $submissionRow['LobSubTypeId']; ?>">
                                <input type="hidden" name="productLineSubTypeHiddenForMaster" id="productLineSubTypeHiddenForMaster" value="<?php echo $submissionRow['LobSubTypeId']; ?>">
                            </td>
                            <td>Section<span style="color: red;"> *</span></td>
                            <td>
                                <?php if ($userGroup == 'master') { ?>
                                    <select name="editsection_master" id="editsection_master" class="listbox-small">
                                        <option value="0">-- Select --</option>
                                    </select>
                                <?php } else { ?>
                                    <select name="editsection" id="sectionCode" class="listbox-small">
                                        <option value="0">-- Select --</option>
                                    </select>
                                <?php } ?>
                                <input type="hidden" id="sectionCodeHidden" value="<?php echo $submissionRow['SectionId']; ?>">
                                <input type="hidden" id="sectionCodeHiddenForMaster" value="<?php echo $submissionRow['SectionId']; ?>">
                            </td>
                            <td width="12%">Profit Code<span style="color: red;"> *</span></td>
                            <td width="22%">
                                <?php if ($userGroup == 'master') { ?>
                                    <select name="editprofitcode_master" id="editprofitcode_master" class="listbox-small">
                                        <option value="0">-- Select --</option>
                                        <option value="844">To Be Entered</option>
                                    </select>
                                <?php } else { ?>
                                    <select name="editprofitcode" id="profitCode" class="listbox-small">
                                        <option value="0">-- Select --</option>
                                        <option value="844">To Be Entered</option>
                                    </select>
                                <?php } ?>
                                <input type="hidden" id="profitCodeHidden" value="<?php echo $submissionRow['ProfitCodeId']; ?>">
                                <input type="hidden" id="profitCodeHiddenForMaster" value="<?php echo $submissionRow['ProfitCodeId']; ?>">
                            </td>
                        </tr>
                        <tr>
                            <td>Current Status<span style="color: red;"> *</span></td>
                            <td>
                                <select name="editprimarystatus"  id="primary_status" class="listbox-small">
                                    <option value="0">-- Select --</option>
                                    <?php if($submissionRow['CurrentStatusId'] == 9){ ?>
                                        <option value="9" selected="selected">Bound</option>  
                                    <?php } else { ?>
                                    <?php
                                    foreach ($status as $value) {
                                        if ($submissionRow['CurrentStatusId'] == $value['Id'])
                                            $select = 'selected="selected"';
                                        else
                                            $select = '';
                                        ?>
                                        
                                        <option value="<?php echo $value['Id'] ?>" <?php echo $select; ?> ><?php echo $value['StatusName'] ?></option>
                                    <?php } ?>
                                    <?php } ?>
                                </select>
                            </td>
                            <td>Effective Date<span style="color: red;"> *</span></td>
                            <td>
                                <input type="text" name="effectiveDate" id="effective_date" class="txtbox-small tcal" value="<?php echo $submissionRow['EffectiveDate']; ?>" readonly/>
                                <div id="dateAlert" class="genericmsg display-none">The date selected is more than 120 days from today</div>
                            </td>
                            <td>Expiry Date</td>
                            <td><input type="text" name="expityDate" id="expiration_date" class="txtbox-small tcal" value="<?php echo $submissionRow['ExpiryDate']; ?>" readonly/></td>
                        </tr>
                        <tr>
                            <td width="12%">Currency<span style="color: red;"> *</span></td>
                            <td>
                                <select name="editcurrency" id="editcurrency" class="listbox-small">
                                    <option value="0">-- Select --</option>
                                    <?php
                                            foreach ($currencyType as $value) {
                                                if ($statusDetails['CurrencyTypeId'] == $value['Id'])
                                                    $select = 'selected="selected"';
                                                else
                                                $select = '';
                                                ?>
                                            <option value="<?php echo $value['Id'] ?>" <?php echo $select; ?> ><?php echo $value['LookupName'] ?></option>
                                    <?php } ?>
                                </select>  
                            </td>
                            <td width="12%">Exchange Rate<span style="color: red;"> *</span></td>
                            <td>
                                <input type="text" name="editexchangeRate" id="editexchangeRate" value="<?php echo trim($statusDetails['ExchangeRate']); ?>" class="txtbox-small"/>
                            </td>
                            <td width="12%">Exchange Rate as on<span style="color: red;"> *</span></td>
                            <td width="22%">
                                <input type="text" name="editexchangeRateDate" id="editexchangeRateDate" value="<?php if(!empty($statusDetails['ExchangeDate'])){ echo date("m/d/Y", strtotime($statusDetails['ExchangeDate']));} else { echo "";} ?>" class="txtbox-small" readonly />
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
                            <td width="12%">Insured Name</td>
                            <td width="22%">
                                <div style="position: relative;">
                                    <input type="text" name="editinsuredname" id="editinsuredname"  value="<?php echo $insuredName; ?> " class="txtbox-small"/>
                                    <input type="hidden"id="insuredId" name="insuredId" class="txtbox-small" value="<?php echo $submissionRow['InsuredId']; ?>"/>
                                    <input type="button" id="insured_name_submit" class="open-modal" value="" name="insured_name_submit"/>
                                    <a href="/admin/insured" target="_blank" class="btn btn-blue btn-small manage">Manage</a>
                                </div>
                                <div class="modal-container">
                                    <div class="modal"> 
                                        <div class="container">
                                            <h2>Insured Details List</h2>
                                            <table class="insuredTable">
                                                <thead>
                                                    <tr>
                                                        <th>Choose</th>
                                                        <th>Insured Name</th>
                                                        <th>Address Line 1</th>
                                                        <th>Country</th>
                                                        <th>State</th>
                                                        <th>City</th>
                                                        <th>Zipcode</th>
                                                        <th>D&B Number</th>
                                                    </tr>
                                                </thead>
                                                <tbody> </tbody>
                                            </table>
                                            <input type="button" class="button" style="display: block; margin: auto;" value="submit" id="insuredsubmit"/>
                                        </div>
                                        <button class="close-modal">x</button>
                                    </div>
                                </div>
                            </td>
                            <td colspan="2">
                                <table width="98%" border="0" cellspacing="0" cellpadding="0">
                                    <tr style="border:1px solid;">
                                        <td width="60%" style="padding-left:5px;">Is DBA name different then insured name ?</td>
                                        <td width="1%">
                                            <input type="radio" value="Y" id="insured_name_yes" name="insured_name_status" class="insurednamestatus" <?php
                                            if (trim($submissionRow['IsDifferentDba']) == 'Y') {
                                                echo "checked";
                                            }
                                            ?> />
                                        </td>
                                        <td style="padding-top:8px;">Yes</td>
                                        <td width="1%">
                                            <input type="radio" id="insured_name_no" value="N" name="insured_name_status" class="insurednamestatus" <?php
                                            if (trim($submissionRow['IsDifferentDba']) == 'N') {
                                                echo "checked";
                                            }
                                            ?> />
                                        </td>
                                        <td style="padding-top:8px;">No</td>
                                        <td width=""><span class="arrow-col"></span></td>
                                    </tr>
                                </table>
                            </td>
                            <td colspan="2" rowspan="6" style="padding:5px;">
                                <table width="100%" border="0" cellspacing="0" cellpadding="0" class="dba_table_data">
                                    <tr>
                                        <td>Insured Contact Person<span style="color: red;"> *</span></td>
                                        <td>
                                            <select id="editinsuredContactPerson" name="editinsuredContactPerson"  class="listbox-small mailingaddress" disabled>
                                                <option value="">-- Select --</option>
                                                <?php
                                                    foreach ($insuredContactPersonRows as $value) {
                                                    if ($submissionRow['InsuredContactPersonId'] == $value['Id'])
                                                        $select = 'selected="selected"';
                                                    else
                                                        $select = '';
                                                ?>
                                                <option value="<?php echo $value['Id'] ?>" <?php echo $select; ?> ><?php echo $value['ContactPerson'] ?></option>
                                                <?php } ?>
                                            </select>
                                            <input type="hidden" id="hiddenInsuredContactPerson" value="<?php echo $submissionRow['InsuredContactPersonId']; ?>">
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>Insured Contact Person Email</td>
                                        <td>
                                            <input type="text" id="editinsuredContactPersonEmail" name="editinsuredContactPersonEmail" value="<?php echo $insuredContactPersonDetails['Email']; ?>" class="listbox-small mailingaddress" disabled />
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>Insured Contact Person's Number(O)</td>
                                        <td> 
                                            <input type="text" id="editinsuredContactPersonNumber" name="editinsuredContactPersonNumber" value="<?php echo $insuredContactPersonDetails['PhoneNumber']; ?>" class="listbox-small mailingaddress" disabled />
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>Insured Contact Person's Mobile</td>
                                        <td> 
                                            <input type="text" id="editinsuredContactPersonMobile" name="editinsuredContactPersonMobile" value="<?php echo $insuredContactPersonDetails['MobileNumber']; ?>" class="listbox-small mailingaddress" disabled />
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>Insured Submission Date</td>
                                        <td> <input type="text" name="editinsuredSubmissionDate" id='editinsuredSubmissionDate' value="<?php if(!empty($submissionRow['InsuredSubmissionDate']) && $submissionRow['InsuredSubmissionDate'] != 'Jan  1 1900 12:00:00:000AM'){ echo date("m/d/Y", strtotime($submissionRow['InsuredSubmissionDate']));} elseif($submissionRow['InsuredSubmissionDate'] == 'Jan  1 1900 12:00:00:000AM') { echo "";} else {echo "";} ?>" class="txtbox-small mailingaddress" />
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>Insured Quote Due Date</td>
                                        <td> 
                                            <input type="text" name="editinsuredQuoteDueDate" id="editinsuredQuoteDueDate" value="<?php if(!empty($submissionRow['InsuredQuoteDueDate']) && $submissionRow['InsuredQuoteDueDate'] != 'Jan  1 1900 12:00:00:000AM'){ echo date("m/d/Y", strtotime($submissionRow['InsuredQuoteDueDate']));} elseif($submissionRow['InsuredQuoteDueDate'] == 'Jan  1 1900 12:00:00:000AM') { echo "";}else {echo "";}  ?>" class="txtbox-small mailingaddress" />
                                        </td>
                                    </tr>
                                </table>
                            </td>
                        </tr>
                        <tr>
                            <td>Address Line 1</td>
                            <td>
                                <input type="text" name="insured_address" id="insured_address" value="<?php echo $insuredaddress; ?>" class="txtbox-small" disabled/>
                            </td>
                            <td>DBA Name</td>
                            <td><input type="text" name="dbaName" id="insured_name_dnb"  value="<?php echo trim($submissionRow['DbaName']); ?>" class="txtbox-small" disabled/></td>
                        </tr>
                        <tr>
                            <td>Country</td>
                            <td> 
                                <input type="text" name="insured_country" id="insured_country" class="txtbox-small" value="<?php echo $insuredCountry; ?>" disabled/>
                            </td>
                            <td width="12%">D&amp;B Number</td>
                            <td width="22%"><input type="text" name="db_number" id="db_number" value="<?php echo $insuredDBNumber; ?>" class="txtbox-small" disabled/></td>
                        </tr>
                        <tr>
                            <td>State</td>
                            <td> 
                                <input type="text" name="insured_state" id="insured_state" class="txtbox-small" value="<?php echo $insuredState; ?>" disabled />
                            </td>
                            <td>Priority Companies<span style="color: red;"> *</span></td>
                            <td> <select name="editcabcompanies" class="listbox-small" id="editcabcompanies">
                                    <option value="0">--Select--</option>
                                    <?php
                                    foreach ($cabCompanies as $value) {
                                        if ($submissionRow['CABCompaniesLookupId'] == $value['Id'])
                                            $select = 'selected="selected"';
                                        else
                                            $select = '';
                                        ?>
                                        <option value="<?php echo $value['Id'] ?>" <?php echo $select; ?> ><?php echo $value['Alias'] ?></option>
                                    <?php } ?>
                                </select>
                            </td>
                        </tr>
                        <tr>
                            <td>City</td>
                            <td> 
                                <input type="text" name="insured_city" id="insured_city" class="listbox-small" value="<?php echo $insuredCity; ?>" disabled />
                            </td>
                            <td>Reinsured Company</td>
                            <td><input type="text" name="reinsured_company" id="reinsured_company" value="<?php echo trim($submissionRow['ReinsuredCompany']); ?>" class="listbox-small"/></td>
                        </tr>
                        <tr>
                            <td>Zipcode</td>
                            <td><input type="text" name="insured_zipcode" id="insured_zipcode" class="listbox-small" value="<?php echo $insuredZipcode; ?>" disabled/></td>
                            <td>Submission Type Identifier</td>
                            <td><select name="editsubmissiontypeidrntifier" class="listbox-small">
                                    <option value="0">--Select--</option>
                                    <?php
                                    foreach ($submissionIdetifier as $value) {
                                        if ($submissionRow['SubmissionIdentifier'] == $value['Id'])
                                            $select = 'selected="selected"';
                                        else
                                            $select = '';
                                        ?>
                                        <option value="<?php echo $value['Id'] ?>" <?php echo $select; ?> ><?php echo $value['Name'] ?></option>
                                    <?php } ?>
                                </select>
                            </td>
                        </tr>
                    </table>
                </div>
            </div>
        </div>
        <div class="container" id="business_dependent_details">
            <div class="box">
                <h1 class="section-header">Line of Business Dependent Details
                    <div class="arrow"></div>
                </h1>
                <div class="content" style="display: block;">
                    <table width="100%" border="0" cellspacing="0" cellpadding="0">
                        <tr>
                            <td width="12%">Project Name</td>
                            <td width="22%">
                                <input type="text" name="project_name" id="project_name" value="<?php echo trim($businessDetails['ProjectName']); ?>" class="txtbox-small project" disabled/>
                            </td>
                            <td width="12%">Name of General Contractor</td>
                            <td width="22%">
                                <input type="text" name="general_contrator_name" id="general_contrator_name" value="<?php echo trim($businessDetails['ProjectGeneralContractorName']); ?>" class="txtbox-small project" disabled/>
                            </td>
                            <td width="12%">Project Owner Name</td>
                            <td width="22%"><input type="text" name="project_owner_name" id="project_owner_name" value="<?php echo trim($businessDetails['ProjectOwnerName']); ?>" class="txtbox-small project" disabled/></td>
                        </tr>
                        <tr>
                            <td>Project Country</td>
                            <td>
                                <select name="project_country" id="sub_country"class="listbox-small project" disabled>
                                    <option value="">-- Select --</option>
                                    <?php
                                    foreach ($country as $value) {
                                        if ($businessDetails['ProjectCountry'] == $value['Id'])
                                            $select = 'selected="selected"';
                                        else
                                            $select = '';
                                        ?>
                                        <option value="<?php echo $value['Id'] ?>" <?php echo $select; ?> ><?php echo $value['InsuredCountry'] ?></option>
                                    <?php } ?>
                                </select>
                            </td>
                            <td>Project State</td>
                            <td>
                                <select name="project_state" id="sub_state" class="listbox-small project" disabled>
                                    <option>-- Select --</option>
                                </select>
                                <input type="hidden" id="newMailStateHidden" value="<?php echo $businessDetails['ProjectState']; ?>">
                            </td>
                            <td>Project City</td>
                            <td colspan="3">
                                <select name="project_city" id="sub_city" class="listbox-small project" disabled>
                                    <option>-- Select --</option>
                                </select>
                                <input type="hidden" id="newMailCityHidden" value="<?php echo $businessDetails['ProjectCity']; ?>">
                            </td>
                        </tr>
                        <tr>
                            <td>Project Street Address</td>
                            <td>
                                <input type="text" name="project_street_address" id="project_street_address" value="<?php echo trim($businessDetails['ProjectAddress']); ?>" class="listbox-small project" disabled>
                            </td>
                            <td>Bid Situation</td>
                            <td>
                                <select name="bid_situation" id="bid_situation" class="listbox-small project" disabled>
                                    <option value="">-- Select --</option>
                                    <?php
                                    foreach ($bidSituation as $value) {
                                        if ($businessDetails['BidSituation'] == $value['Id'])
                                            $select = 'selected="selected"';
                                        else
                                            $select = '';
                                        ?>
                                        <option value="<?php echo $value['Id'] ?>" <?php echo $select; ?> ><?php echo $value['Alias'] ?></option>
                                    <?php } ?>
                                </select>
                            </td>
                            <td>Total Insured Value in Local Currency <input type="checkbox" name= "yesTrue" id="yesTrue" class="ct4" value="Y" <?php
                                if (trim($submissionRow['IsTotalInsuredValue']) == 'Y') {
                                    echo "checked";
                                }
                                ?> disabled/>
                            </td>
                            <td id="total_insured">
                                <input type="text" name="edittotalinsuredvalue" id="edittotalinsuredvalue" class="txtbox-small" value="<?php if (trim($submissionRow['TotalInsuredValue']) == '-1' || trim($submissionRow['TotalInsuredValue']) == '-2') {
                                    echo "";
                                } else {
                                    echo trim($submissionRow['TotalInsuredValue']);
                                } ?>"/>
                            </td>
                            <td style="display: none;" id="total_insured_values">
                                <select name="total_insured_value_select" id="total_insured_value_select" class="listbox-small">
                                    <option value="0" <?php
                                    if ($submissionRow['TotalInsuredValue'] == '') {
                                        echo "selected";
                                    }
                                    ?>>-- Select --</option>
                                    <option value="-1" <?php
                                    if (trim($submissionRow['TotalInsuredValue']) == '-1') {
                                        echo "selected";
                                    }
                                    ?>>Not Available</option>
                                    <option value="-2" <?php
                                    if (trim($submissionRow['TotalInsuredValue']) == '-2') {
                                        echo "selected";
                                    }
                                    ?>>To Be Entered</option>
                                </select>  
                            </td>
                        </tr>
                        <tr>
                            <td>Total Insured Value in USD</td>
                            <td>
                                <input type="text" name="edittotalinsuredvalueinusd" id="edittotalinsuredvalueinusd" class="txtbox-small" value="<?php echo trim($submissionRow['TotalInsuredValueInUSD']); ?>" disabled readonly/>
                            </td>
                            <td>Number Of Locations (greater than 3)</td>
                            <td>
                                <select name="EditNumberOfLocations" id="EditNumberOfLocations" class="listbox-small" disabled>
                                    <option value="">-- Select --</option>
                                    <?php
                                    foreach ($numberOfLocations as $value) {
                                        if ($submissionRow['NumberOfLocationsId'] == $value['Id'])
                                            $select = 'selected="selected"';
                                        else
                                            $select = '';
                                        ?>
                                        <option value="<?php echo $value['Id'] ?>" <?php echo $select; ?> ><?php echo $value['Alias'] ?></option>
                                    <?php } ?>
                                </select>
                            </td>
                            <td>Risk Profile</td>
                            <td>
                                <textarea name="editriskProfile" id="editriskProfile" maxlength="150" class="listbox-small"><?php echo trim($submissionRow['RiskProfile']);?></textarea>
                            </td>
                        </tr>
                        <tr>
                            <td>Occupancy Code</td>
                            <td>
                                <select name="EditOccupancyCode" id="EditOccupancyCode" class="listbox-small" disabled>
                                    <option value="">-- Select --</option>
                                    <?php
                                    foreach ($occupancyCode as $value) {
                                        if ($submissionRow['OccupancyCodeId'] == $value['Id'])
                                            $select = 'selected="selected"';
                                        else
                                            $select = '';
                                        ?>
                                        <option value="<?php echo $value['Id'] ?>" <?php echo $select; ?> ><?php echo $value['Name'] ?></option>
                                    <?php } ?>
                                </select>
                            </td>
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
                      <tr>
                        <td width="12%">Broker Name<span style="color: red;"> *</span></td>
                        <td width="22%"> 
                            <select name="brokerCode" id="brokerCode" class="listbox-small">
                                <option value="">-- Select --</option>
                                <?php
                                foreach ($brokerDetails as $value) {
                                    if ($brokerCode == $value['code'])
                                        $select = 'selected="selected"';
                                    else
                                        $select = '';
                                    ?>
                                    <option value="<?php echo $value['code']; ?>" class="<?php echo $value['cat']; ?>" <?php echo $select; ?>><?php echo $value['name']; ?></option>
                                <?php } ?>
                            </select>
                        </td>
                        <td width="12%">Wholesaler or Retailer</td>
                        <td width="22%">
                            <input type="text" id="isWholesaler" name="wholesaler_retailer" value="<?php echo $brokerType['Alias']; ?>"  class="listbox-small" readonly />
                        </td>
                        <td width="12%">Retail Broker Name</td>
                        <td width="22%">
                            <input type="text" id="retailBrokerName" name="retailBrokerName" value="<?php echo $retailBrokerDetails['RetailBrokerName']; ?>"  class="listbox-small" />
                        </td>
                        </tr>
                        <tr>
                            <td>Broker Country<span style="color: red;"> *</span></td>
                            <td> 
                                <select name="brokerCountryCode" id="brokerCountryCode" size="1" class="listbox-small">
                                    <option value="0">-- Select --</option>
                                    <?php
                                    foreach ($brokerCountry as $value) {
                                        if ($brokerCountryCode == $value['Id'])
                                            $select = 'selected="selected"';
                                        else
                                            $select = '';
                                        ?>
                                        <option value="<?php echo $value['Id']; ?>" <?php echo $select; ?> ><?php echo $value['InsuredCountry']; ?></option>
                                    <?php } ?>
                                </select>
                            </td>
                            <td>Broker State<span style="color: red;"> *</span></td>
                            <td> 
                                <select name="brokerStateCode" id="brokerStateCode"  class="listbox-small">
                                    <option value="">-- Select --</option>
                                </select>
                                <input type="hidden" name="brokerStateCodeHidden" id="brokerStateCodeHidden" value="<?php echo $brokerStateCode; ?>" >
                            </td>
                            <td>Broker City<span style="color: red;"> *</span></td>
                            <td> 
                                <select name="brokerCityCode" id="brokerCityCode"  class="listbox-small">
                                    <option value="0">-- Select --</option>
                                </select>
                                <input type="hidden" name="brokerCityCodeHidden" id="brokerCityCodeHidden" value="<?php echo $brokerCityCode; ?>" >
                            </td>
                        </tr>
                                                <tr>
                            <td>Retail Broker Country</td>
                            <td> 
                                <select name="retailbrokerCountryCode" id="retailbrokerCountryCode" size="1" class="listbox-small">
                                    <option value="0">-- Select --</option>
                                    <?php
                                    foreach ($retailBrokerCountryName as $value) {
                                        if ($retailBrokerDetails['RetailBrokerCountry'] == $value['Id'])
                                            $select = 'selected="selected"';
                                        else
                                            $select = '';
                                        ?>
                                        <option value="<?php echo $value['Id']; ?>" <?php echo $select; ?> ><?php echo $value['InsuredCountry']; ?></option>
                                    <?php } ?>
                                </select>
                            </td>
                            <td>Retail Broker State</td>
                            <td> 
                                <select name="retailbrokerStateCode" id="retailbrokerStateCode"  class="listbox-small">
                                    <option value="">-- Select --</option>
                                </select>
                                <input type="hidden" name="retailsbrokerStateCodeHidden" id="retailsbrokerStateCodeHidden" value="<?php echo $retailBrokerDetails['RetailBrokerState']; ?>" >
                            </td>
                            <td>Retail Broker City</td>
                            <td> 
                                <select name="retailbrokerCityCode" id="retailbrokerCityCode"  class="listbox-small">
                                    <option value="0">-- Select --</option>
                                </select>
                                <input type="hidden" name="retailbrokerCityCodeHidden" id="retailbrokerCityCodeHidden" value="<?php echo $retailBrokerDetails['RetailBrokerCity']; ?>" >
                            </td>
                        </tr>
                        <tr>
                            <td>Broker Contact Person<span style="color: red;"> *</span></td>
                            <td>
                                <select name="broker_contact_person" id="broker_contact_person" class="listbox-small">
                                    <option value="0">-- Select --</option>
                                </select>
                                <input type="hidden" id="hiddenBrokerContactPerson" name="hiddenBrokerContactPerson" value="<?php echo $submissionRow['BrokerContactPersonId']; ?>">
                            </td>
                            <td>Broker Contact Person’s Email</td>
                            <td>
                                <input type="text" name="edit_broker_contact_person_email" id="edit_broker_contact_person_email"  class="listbox-small" disabled/>
                            </td>
                            <td width="12%">Broker Contact Person’s Number(O)</td>
                            <td colspan="3">
                                <input type="text" name="edit_borker_contact_peson_number" id="edit_borker_contact_peson_number"  class="listbox-small" disabled/>
                            </td>
                        </tr>
                        <tr>
                            <td>Broker Contact Person Mobile</td>
                            <td> 
                                <input type="text" name="edit_borker_contact_peson_mobile" id="edit_borker_contact_peson_mobile"  class="listbox-small" disabled />
                            </td>
                            <td>Broker Code</td>
                            <td><input type="text" name="broker_code" id="brokerCodeGen" value="<?php echo $submissionRow['BrokerCode']; ?>" class="txtbox-small" readonly/></td>
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
                            <td width="12%">Reason Code</td>
                            <td width="22%"> 
                                <select name="reason_code" id="reason_code" class="listbox-small" disabled>
                                    <option value="0">-- Select --</option>
                                </select>
                                <input type="hidden" id="hiddenReasonCode" name="hiddenReasonCode" value="<?php echo $statusDetails['ReasonCodeId']; ?>"  />
                            </td>
                            <td width="12%"></td>
                            <td width="22%"></td>
                            <td width="12%">Process Date</td>
                            <td width="22%">
                                <input type="text" name="processdate" id="processdate" class="date txtbox-small" value="<?php if (!empty($statusDetails['ProcessDate'])) { echo date("m/d/Y", strtotime($statusDetails['ProcessDate']));} else { echo "";} ?>"  disabled readonly />
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
                            <td width="12%">Premium in Local Currency<input type="checkbox" name= "yesGross" id="yesGross" class="ct4 statusDetails" value="Y" <?php
                                    if (trim($submissionRow['IsGrossPremium']) == 'Y') {
                                        echo "checked";
                                    }
                                    ?>/>
                            </td>
                            <td width="22%" id="gross_premium_value"> 
                                <input type="text" name="gross_premium_text" id="gross_premium" class="txtbox-small statusDetails" value="<?php if (trim($statusDetails['GrossPremium']) == '-1' || trim($statusDetails['GrossPremium']) == '-2') {
                                                echo '';
                                            } else {
                                                echo trim($statusDetails['GrossPremium']);
                                            } ?>" disabled />
                            </td>
                            <td style="display:none;" id="gross_premium_values">
                                <select name="gross_premium_select" id="gross_premium_select" disabled class="listbox-small statusDetails">
                                    <option value="0" <?php
                                            if ($statusDetails['GrossPremium'] == '') {
                                                echo "selected";
                                            }
                                    ?>>-- Select --</option>
                                    <option value="-1" <?php
                                if (trim($statusDetails['GrossPremium']) == '-1') {
                                    echo "selected";
                                }
                                ?>>Not Available</option>
                                    <option value="-2" <?php
                                if (trim($statusDetails['GrossPremium']) == '-2') {
                                    echo "selected";
                                }
                                ?>>To Be Entered</option>
                                </select>  
                            </td>
                            <td width="12%">Premium (in USD)</td>
                            <td width="22%"> 
                                <input type="text" name="editlocalCurrency" id="editlocalCurrency" value="<?php echo trim($statusDetails['GrossPremiumInUSD']); ?>" class="statusDetails" disabled readonly />
                            </td>
                            <td width="12%">Layer of Limit in Local Currency</td>
                            <td width="22%"> 
                                <input type="text" name="editLayerLimitLocalCurrency" id="editLayerLimitLocalCurrency" value="<?php echo trim($boundData['LayerofLimitInLocalCurrency']); ?>" disabled />
                            </td>
                        </tr>
                        <tr>
                            <td width="12%">Layer of Limit(in USD)</td>
                            <td width="22%"> 
                                <input type="text" name="editLayerLimitLocalUSD" id="editLayerLimitLocalUSD" value="<?php echo trim($boundData['LayerofLimitInUSD']); ?>" disabled readonly />
                            </td>
                            <td width="12%">% of Layer</td>
                            <td width="22%"> 
                                <input type="text" name="editPrecentageLayer" id="editPrecentageLayer" value="<?php echo trim($boundData['PercentageofLayer']); ?>"  min="0" max="100" disabled />
                            </td>
                            <td width="12%">Limit in Local Currency <input type="checkbox" name= "yesLimit" id="yesLimit" class="ct4 statusDetails" value="Y" <?php
                                if (trim($submissionRow['IsLimit']) == 'Y') {
                                    echo "checked";
                                }
                                ?>/></td>
                            <td width="22%" id="limit_value">
                                <input type="text" name="limit_text" id="limit" class="txtbox-small statusDetails" value="<?php if (trim($statusDetails['Limit']) == '-1' || trim($statusDetails['Limit']) == '-2') {
                                        echo "";
                                    } else {
                                        echo trim($statusDetails['Limit']);
                                    } ?>" disabled>
                            </td>
                            <td style="display:none;" id="limit_values">
                                <select name="limit_select" id="limit_select" disabled class="listbox-small statusDetails">
                                    <option value="0" <?php
                                if ($statusDetails['IsAttachmentPoint'] == '') {
                                    echo "selected";
                                }
                                ?>>-- Select --</option>
                                    <option value="-1" <?php
                                if (trim($statusDetails['Limit']) == '-1') {
                                    echo "selected";
                                }
                                ?>>Not Available</option>
                                    <option value="-2" <?php
                                            if (trim($statusDetails['Limit']) == '-2') {
                                                echo "selected";
                                            }
                                            ?>>To Be Entered</option>
                                </select>  
                            </td>
                        </tr>
                        <tr>
                            <td width="12%">Limit (in USD)</td>
                            <td>
                                <input type="text" name="editlimitlocalcurrency" id="editlimitlocalcurrency" value="<?php echo trim($statusDetails['LimitInUSD']); ?>" class="statusDetails" disabled readonly/>
                            </td>
                           <td width="12%">Attachment Point in Local Currency<input type="checkbox" name= "yesAttachment" id="yesAttachment" class="ct4 statusDetails" value="Y" <?php
                                    if (trim($submissionRow['IsAttachmentPoint']) == 'Y') {
                                        echo "checked";
                                    }
                                    ?>/></td>
                            <td id="attachment_value"><input type="text" name="attachment_point_text" id="attachment_point" class="txtbox-small statusDetails" value="<?php if (trim($statusDetails['AttachmentPoint']) == '-1' || trim($statusDetails['AttachmentPoint']) == '-2') {
                                                echo "";
                                            } else {
                                                echo trim($statusDetails['AttachmentPoint']);
                                            } ?>" disabled/></td>
                            <td style="display:none;" id="attachment_values">
                                <select name="attachment_point_select" id="attachment_point_select" disabled class="listbox-small statusDetails">
                                    <option value="0" <?php
                                            if ($statusDetails['AttachmentPoint'] == '') {
                                                echo "selected";
                                            }
                                    ?>>-- Select --</option>
                                    <option value="-1" <?php
                                            if (trim($statusDetails['AttachmentPoint']) == '-1') {
                                                echo "selected";
                                            }
                                    ?>>Not Available</option>
                                    <option value="-2" <?php
                                            if (trim($statusDetails['AttachmentPoint']) == '-2') {
                                                echo "selected";
                                            }
                                    ?>>To Be Entered</option>
                                </select>  
                            </td>
                             <td width="12%">Attachment Point (in USD)</td>
                            <td>
                                <input type="text" name="editattachmentlocalcurrency" id="editattachmentlocalcurrency" value="<?php echo trim($statusDetails['AttachmentPointInUSD']); ?>" class="statusDetails" disabled readonly/>
                            </td>
                        </tr>
                        <tr>
                            <td width="12%">Self Insured Retention in Local Currency</td>
                            <td>
                                <input type="text" name="editselfRetrntionLocalCurrency" id="editselfRetrntionLocalCurrency" value="<?php echo trim($boundData['SelfInsuredRetentionInLocalCur']); ?>" disabled/>
                            </td> 
                            <td width="12%">Self Insured Retention(in USD)</td>
                            <td>
                                <input type="text" name="editselfRetrntionUSD" id="editselfRetrntionUSD" value="<?php echo trim($boundData['SelfInsuredRetentionInUSD']); ?>" disabled readonly/>
                            </td> 
                            <td width="12%">Policy Comm. %</td>
                            <td>
                                <input type="text" name="editpolicyCommision" id="editpolicyCommision" value="<?php echo trim($boundData['PolicyCommPercentage']); ?>"  disabled min="0" max="100"/>
                            </td> 
                        </tr>
                        <tr>
                            <td width="12%">Policy Comm. in Local Currency</td>
                            <td>
                                <input type="text" name="editpolicyCommisionLocalCurrrency" id="editpolicyCommisionLocalCurrrency" value="<?php echo trim($boundData['PolicyCommInLocalCurrency']); ?>"  disabled readonly />
                            </td> 
                            <td width="12%">Policy Comm.(in USD)</td>
                            <td>
                                <input type="text" name="editpolicyCommisionUSD" id="editpolicyCommisionUSD" value="<?php echo trim($boundData['PolicyCommInUSD']); ?>"  disabled readonly/>
                            </td> 
                            <td width="12%">Premium (Net of All Commission) in Local Currency</td>
                            <td>
                                <input type="text" name="editPermiumLocalCurency" id="editPermiumLocalCurency" value="<?php echo trim($boundData['PermiumNetofCommInLocalCurrenc']); ?>"  disabled readonly />
                            </td> 
                        </tr>
                        <tr>
                            <td width="12%">Premium (Net of All Commission)(in USD)</td>
                            <td>
                                <input type="text" name="editPermiumUSD" id="editPermiumUSD" value="<?php echo trim($boundData['PermiumNetofCommInUSD']); ?>" disabled readonly/>
                            </td>   
                        </tr>
                    </table>
                </div>
            </div>
        </div><!--status dependacy-->

        <div class="container">
            <div class="box">
                <h1 class="section-header">Policy Details
                    <div class="arrow"></div>
                </h1>
                <div class="content" style="display: block;">
                    <table width="100%" border="0" cellspacing="0" cellpadding="0">
                        <tr>
                            <td width="12%">Bind Date<input class="ct4 statusDetails" type="checkbox" name= "yesBinddate" id="yesBinddate" value="Y" disabled <?php
                                    if (trim($boundData['IsBindDate']) == 'Y') {
                                        echo "checked";
                                    }
                                    ?> />
                            </td>
                            <td width="22%">
                                <input type="text" class="txtbox-small" name="editbinddate" id="editbinddate" value="<?php if (!empty($boundData['BindDate'])) { echo date("m/d/Y", strtotime($boundData['BindDate']));} else { echo "";} ?>" disabled readonly/>
                            </td>
                            <td width="12%">Renewable(Y/N)</td>
                            <td width="22%"> 
                                <select name="editrenewable" id="editrenewable" class="listbox-small" readonly>
                                    <option value="0">--Select--</option>
                                </select>
                            </td>
                            <td width="12%">Date of Renewal</td>
                            <td width="22%">
                                <input type="text" class="txtbox-small" name="editdateofrenewal" id="editdateofrenewal" value="<?php if (!empty($boundData['DateofRenewal']) && $boundData['DateofRenewal'] !='1970-01-01') { echo date("m/d/Y", strtotime($boundData['DateofRenewal']));} else { echo "";} ?>" readonly />
                            </td>
                        </tr>
                        <tr>
                            <td width="12%">Policy Type</td>
                            <td width="22%"> 
                                <select name="editpolicyName" id="editpolicyName" class="listbox-small">
                                    <option value="0">--Select--</option>
                                    <?php foreach ($policyType as $value) { ?>
                                    <?php if ($boundData['PolicyTypeLookupId'] == $value['Id'])
                                            $select = 'selected="selected"';
                                           else
                                            $select = '';
                                    ?>
                                    <option value="<?php echo $value['Id']; ?>" <?php echo $select; ?>><?php echo $value['LookupName']; ?></option>
                                    <?php } ?>
                                </select>
                            </td>
                            <td width="12%">Direct/Assumed</td>
                            <td width="22%"> 
                                <select name="editdirectAssumed" id="editdirectAssumed"  class="listbox-small">
                                    <option value="0">--Select--</option>
                                    <?php foreach ($directAssumed as $value) { ?>
                                    <?php if ($boundData['DirectAssumedLookupId'] == $value['Id'])
                                            $select = 'selected="selected"';
                                           else
                                            $select = '';
                                    ?>
                                    <option value="<?php echo $value['Id']; ?>" <?php echo $select; ?>><?php echo $value['LookupName']; ?></option>
                                    <?php } ?>
                                </select>
                            </td>
                            <td width="12%">Admitted/ Non-Admitted</td>
                            <td width="22%"> 
                                <select name="editadmitted" id="editadmitted" class="listbox-small">
                                    <option value="0">--Select--</option>
                                    <?php foreach ($admittedNotAdmitted as $value) { ?>
                                    <?php if ($boundData['AdimittedNonAdmittedLookupId'] == $value['Id'])
                                            $select = 'selected="selected"';
                                           else
                                            $select = '';
                                    ?>
                                    <option value="<?php echo $value['Id']; ?>" <?php echo $select; ?>><?php echo $value['LookupName']; ?></option>
                                    <?php } ?>
                                </select>
                            </td>
                        </tr>
                        <tr>
                            <td width="12%">Company Paper</td>
                            <td width="22%"> 
                                <select name="editcompanyPaper" id="editcompanyPaper" class="listbox-small">
                                    <option value="0">--Select--</option>
                                    <?php foreach ($companyPaper as $value) { ?>
                                    <?php if ($boundData['CompanyPaperLookupId'] == $value['Id'])
                                            $select = 'selected="selected"';
                                           else
                                            $select = '';
                                    ?>
                                    <option value="<?php echo $value['Id']; ?>" <?php echo $select; ?>><?php echo $value['LookupName']; ?></option>
                                    <?php } ?>
                                </select>
                            </td>
                            <td width="12%">Company Paper Number</td>
                            <td width="22%"> 
                                <select name="editcompanyPaperNumber" id="editcompanyPaperNumber" class="listbox-small">
                                    <option value="0">--Select--</option>
                                    <?php foreach ($companyPaperNumber as $value) { ?>
                                    <?php if ($boundData['CompanyPaperNumberLookupId'] == $value['Id'])
                                            $select = 'selected="selected"';
                                           else
                                            $select = '';
                                    ?>
                                    <option value="<?php echo $value['Id']; ?>" <?php echo $select; ?>><?php echo $value['LookupName']; ?></option>
                                    <?php } ?>
                                </select>
                            </td>
                            <td width="12%">Policy Number</td>
                            <td width="22%">
                                <input type="text" class="txtbox-small" name="editpolicyNumber" id="editpolicyNumber" value="<?php echo trim($boundData['PolicyNumber']);?>"/>
                                <label class="genericmsg" style="display: none;" id="editduplicatePolicyNumber"><br>This Policy Number already exists</label>
                            </td>
                        </tr>
                        <tr>
                            <td width="12%">Coverage</td>
                            <td width="22%"> 
                                <select name="editcoverage" id="editcoverage" class="listbox-small">
                                    <option value="0">--Select--</option>
                                </select>
                                <input type="hidden" id="hiddenCoverage" name="hiddenCoverage" value="<?php echo $boundData['CoverageId']; ?>"  />
                            </td>
                            <td width="12%">Suffix</td>
                            <td width="22%"> 
                                <select name="editsuffix" id="editsuffix" class="listbox-small">
                                    <option value="0">--Select--</option>
                                    <?php foreach ($suffix as $value) { ?>
                                    <?php if ($boundData['SuffixLookupId'] == $value['Id'])
                                            $select = 'selected="selected"';
                                           else
                                            $select = '';
                                    ?>
                                    <option value="<?php echo $value['Id']; ?>" <?php echo $select; ?>><?php echo $value['LookupName']; ?></option>
                                    <?php } ?>
                                </select>
                            </td>
                            <td width="12%">Transaction Number</td>
                            <td width="22%">
                                <input type="text" class="txtbox-small" name="edittransactionNumber" id="edittransactionNumber"  value="<?php echo trim($boundData['TransactionNumber']);?>" readonly/>
                            </td>
                        </tr>
                        <tr>
                            <td width="12%">NAIC Code</td>
                            <td width="22%">
                                <input type="text" class="txtbox-small" name="editnaicCode" id="editnaicCode" value="<?php echo trim($boundData['NAICCode']);?>" />
                            </td>
                            <td width="12%">NAIC Title</td>
                            <td width="22%">
                                <input type="text" class="txtbox-small" name="editnaicTitle" id="editnaicTitle" value="<?php echo trim($boundData['NAICTitle']);?>"/>
                            </td>
                            <td width="12%">SIC Code</td>
                            <td width="22%">
                                <input type="text" class="txtbox-small" name="editsicCode" id="editsicCode" value="<?php echo trim($boundData['SICCode']);?>" />
                            </td>
                        </tr>
                        <tr>
                            <td width="12%">SIC Title</td>
                            <td width="22%">
                                <input type="text" class="txtbox-small" name="editsicTitle" id="editsicTitle" value="<?php echo trim($boundData['SICTitle']);?>"/>
                            </td>
                            <td width="12%">OFRC Adverse Report</td>
                            <td width="22%"> 
                                <select name="editofrcReport" id="editofrcReport" class="listbox-small">
                                    <option value="0">--Select--</option>
                                    <?php foreach ($ofrcReport as $value) { ?>
                                    <?php if ($boundData['OFRCAdverseReportLookupId'] == $value['Id'])
                                            $select = 'selected="selected"';
                                           else
                                            $select = '';
                                    ?>
                                    <option value="<?php echo $value['Id']; ?>" <?php echo $select; ?>><?php echo $value['LookupName']; ?></option>
                                    <?php } ?>
                                </select>
                            </td> 
                        </tr>
                    </table>
                </div>
            </div>
        </div>


        <div class="container">
            <div class="box">
                <h1 class="section-header">Other Details
                    <div class="arrow"></div>
                </h1>
                <div class="content" style="display: block;">
                    <table>
                        <tr>
                            <td width="12%">Date of Receiving-By Berk SI From Broker<span style="color: red;"> *</span></td>
                            <td width="3%"><input type="checkbox" name= "yesBroker" id="yesBroker" value="Y" <?php
                                    if (trim($submissionRow['IsBerksiBroker']) == 'Y') {
                                        echo "checked";
                                    }
                                    ?>/></td>
                            <td width="18%"><input type="text" name="received_date_by_berkshire" class="date listbox-small" value="<?php if (!empty($submissionRow['byBerkSi']) && date('Y-m-d', strtotime($submissionRow['byBerkSi'])) != '1970-01-01') {
                                        echo $submissionRow['byBerkSi'];
                                    } else {
                                        echo "";
                                    } ?>" id="byBerkSi" required="true" readonly disabled /></td>
                            <td width="12%">Date of Receiving-By India From Berk SI<span style="color: red;"> *</span></td>
                            <td width="3%"><input type="checkbox" name= "yesIndia" id="yesIndia" value="Y" <?php
                                    if (trim($submissionRow['IsBerksiIndia']) == 'Y') {
                                        echo "checked";
                                    }
                                    ?>></td>
                            <td width="18%"><input type="text" name="received_date_by_india" class="date listbox-small" value="<?php if (!empty($submissionRow['byIndia']) && date('Y-m-d', strtotime($submissionRow['byIndia'])) != '1970-01-01') {
                                        echo date('m/d/Y', strtotime($submissionRow['byIndia']));
                                    } else {
                                        echo "";
                                    } ?>" id="byIndia" required="true" readonly disabled/></td>
                            <td width="12%">Branch Office</td>
                            <td width="12%">
                                <?php if ($userGroup == 'master') { ?>
                                    <select name="branchoffice_master" id="branchoffice_master" class="listbox-small">
                                        <option value="">-- Select --</option>
                                           <?php foreach ($branch as $branchValue) { ?>
                                            <option value="<?php echo $branchValue['Id']; ?>" 
                                            <?php
                                            if ($branchValue['Id'] == $submissionRow['BranchId']) {
                                                echo "selected = selected";
                                            }
                                            ?>><?php echo $branchValue['Branch']; ?></option>
                                            <?php } ?>
                                    </select>
                                <?php } else { ?>
                                    <input type="text" name="branch_office" id="branchid" class="listbox-small" value="<?php echo $branches; ?>" readonly/>
                                <?php } ?>
                            </td>
                        </tr> 
                        <tr> 
                            <td colspan="2">Remarks</td>
                            <td width="12%"><input type="text" name="editRemark" id="editRemark" value="<?php echo trim($remarks[0]['Remarks']); ?>" class="txtbox-small"/></td>
                        </tr>
                    </table>
                </div>
            </div>
        </div>
        <div class="container">
            <p class="btn-warning">Please ensure that you have filled up all the mandatory fields on the page. Please check the sections you have minimized as well.</p>
            <table width="100%" cellpadding="0" cellspacing="0">
                <tr>
                    <td align="center">
                        <input type="submit" class="btn btn-blue" value="Submit" id="editSubmissionFormSubmit" />
                        <input type="button" class="btn btn-cyan" value="Cancel" id="editSubmissionFormCancel" />
                        <input type="hidden" name="businessDependentDetailsId" id="businessDependentDetailsId" value="<?php echo $submissionRow['BusinessDependentDetailId']; ?>" />
                        <input type="hidden" name="statusDependentDetailsId" id="statusDependentDetailsId" value="<?php echo $submissionRow['StatusDependentDetailsId']; ?>" />
                        <input type="hidden" name="alternativeAddressId" value="<?php echo $submissionRow['AlternativeAddressId']; ?>" />
                        <input type="hidden" name="dataRecorderId" id="dataRecorderId" value="<?php echo $submissionRow['DataRecorderMetaDataId']; ?>" />
                        <input type="hidden" name="submissionNumber" id="submissionNumber" value="<?php echo $submissionRow['SubmissionNumber']; ?>" />
                        <input type="hidden" name="hiddenPolicyNumber" id="hiddenPolicyNumber" value="<?php echo $boundData['FinalPolicyNumber']; ?>" />
                    </td>
                </tr>
            </table>
        </div>
        <input type="hidden" id="brokerCodeGen1" name="brokerCodeGen1" value="<?php if ($_POST['brokerCodeGen1']) { echo $_POST['brokerCodeGen1'];} ?>" />
    </form>
</div>
