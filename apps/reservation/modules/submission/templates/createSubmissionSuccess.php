<!-- Content -->
<div id="content">
    <div class="breadcrumbs group"> 
        <ul id="breadcrumb">
            <li><a href="/">Home</a><span> >>&nbsp; </span></li>
            <li><a href="/submission/Submission">Submission</a><span> >>&nbsp; </span></li>
            <li class="selected">Create Submission</li>
        </ul>
        <a href="/submission/Submission" id="back"> </a>
    </div>
    <form method="POST" action="/submission/createSubmission" id="SubmissiondataFrm" name="SubmissiondataFrm" autocomplete="off">
        <div class="container">
            <div class="box">
                <?php if (isset($emptyValues) && !empty($emptyValues)): ?>
                    <span style="font-size:12pt; color: red;"> 
                        Please fill following fields before submit: <?php echo $emptyValues; ?>
                    </span>
                    <p>&nbsp;</p>
                <?php endif; ?>
                <h1 class="section-header">Create Submission<div class="arrow"></div></h1>
                <div class="content" style="display: block;">
                    <table width="100%" border="0" cellspacing="0" cellpadding="0">
                        <tr>
                            <td width="12%">New/Renewal<span style="color: red;"> *</span></td>
                            <td width="22%">
                                <select name="new_renewal" class="listbox-small" id="new_renewal">
                                    <option value="0">--Select--</option>
                                    <?php foreach ($newRenew as $newRenewValue) { ?>
                                        <option value="<?php echo $newRenewValue['Id']; ?>"><?php echo $newRenewValue['LookupName']; ?></option>
                                    <?php } ?>
                                </select>
                            </td>
                            </td>
                            <td width="12%">Underwriter<span style="color: red;"> *</span></td>
                            <td width="22%">
                                <?php if ($userGroup == 'master') { ?>
                                    <select name="underwriter_master" class="listbox-small" id="underwriter_master">
                                        <option value="0">-- Select --</option>
                                        <?php foreach ($underwritterName as $value) { ?>
                                            <option value="<?php echo $value->Id; ?>"><?php echo $value->Name; ?></option>
                                        <?php } ?>
                                    </select>
                                <?php } else { ?>
                                    <select name="underwriter" class="listbox-small" id="underwriter">
                                        <option value="0">-- Select --</option>
                                        <?php foreach ($underwritterName as $value) { ?>
                                            <option value="<?php echo $value->Id; ?>"><?php echo $value->Name; ?></option>
                                        <?php } ?>
                                    </select>
                                <?php } ?>
                            </td>
                            <td width="12%">Product Line</td>
                            <td width="22%">
                                <?php if ($userGroup == 'master') { ?>
                                    <select name="product_line_master" class="listbox-small" id="product_line_master">
                                        <option value="0">--Select--</option>
                                        <?php foreach ($productLine as $value) { ?>
                                            <option value="<?php echo $value['Id']; ?>"><?php echo $value['LOBName']; ?></option>
                                        <?php } ?>
                                    </select>
                                <?php } else { ?>
                                    <input type="text" name="product_line" id="product_line" class="txtbox-small" readonly/>
                                <?php } ?>
                                <input type="hidden" id="productLinePrefix" name="productLinePrefix">
                            </td>
                        </tr>
                        <tr>
                            <td width="12%">Product Line Subtype<span style="color: red;"> *</span></td>
                            <td width="22%">
                                <?php if ($userGroup == 'master') { ?>
                                    <select name="product_line_subtype_master" class="listbox-small" id="product_line_subtype_master">
                                        <option value="0">--Select--</option>
                                    </select>
                                <?php } else { ?>
                                    <select name="product_line_subtype" class="listbox-small" id="product_line_subtype">
                                        <option value="0">--Select--</option>
                                    </select>
                                <?php } ?>
                            </td>
                            <td>Section<span style="color: red;"> *</span></td>
                            <td>
                                <?php if ($userGroup == 'master') { ?>
                                    <select name="section_master" class="listbox-small" id="section_master">
                                        <option value="0">--Select--</option>
                                    </select>
                                <?php } else { ?>
                                    <select name="section" class="listbox-small" id="section">
                                        <option value="0">--Select--</option>
                                    </select>
                                <?php } ?>
                            </td>
                            <td width="12%">Profit Code<span style="color: red;"> *</span></td>
                            <td width="22%">
                                <?php if ($userGroup == 'master') { ?>
                                    <select name="profitcode_master" class="listbox-small" id="profitcode_master">
                                        <option value="0">--Select--</option>
                                    </select>
                                <?php } else { ?>
                                    <select name="profitcode" class="listbox-small" id="profitcode">
                                        <option value="0">--Select--</option>
                                    </select>
                                <?php } ?>
                            </td>
                        </tr>
                        <tr>
                            <td>Current Status<span style="color: red;"> *</span></td>
                            <td>
                                <?php if ($userGroup == 'master') { ?>
                                    <select name="primarystatus_master" class="listbox-small" id="primarystatus_master">
                                        <option value="0">--Select--</option>
                                        <?php foreach ($curerntStatus as $value) { ?>
                                            <option value="<?php echo $value['Id']; ?>"><?php echo $value['StatusName']; ?></option>
                                        <?php } ?>
                                    </select>
                                <?php } else { ?>
                                    <select name="primarystatus" id="primarystatus" class="listbox-small">
                                        <option value="0">-- Select --</option>
                                    </select>
                                <?php } ?>
                            </td>
                            <td>Effective Date<span style="color: red;"> *</span></td>
                            <td>
                                <input type="text" class="txtbox-small tcal" name="effectivedate" id='effectivedate' readonly="true" />
                                <div id="dateAlert" class="error display-none">The date selected is more than 120 days from today</div>
                            </td>
                            <td>Expiry Date</td>
                            <td><input type="text" readonly="true" class="txtbox-small tcal" name="expirydate" id="expirydate" readonly="readonly" /></td>
                        </tr>
                        <tr>
                            <td width="12%">Currency<span style="color: red;"> *</span></td>
                            <td>
                                <select name="currency" id="currency" class="listbox-small">
                                    <option value="0">-- Select --</option>
                                    <?php foreach ($currencyType as $value) { ?>
                                            <option value="<?php echo $value['Id']; ?>"><?php echo $value['LookupName']; ?></option>
                                    <?php } ?>
                                </select>  
                            </td>
                            <td width="12%">Exchange Rate<span style="color: red;"> *</span></td>
                            <td>
                                <input type="text" name="exchangeRate" id="exchangeRate" />
                            </td>
                            <td width="12%">Exchange Rate as on<span style="color: red;"> *</span></td>
                            <td width="22%">
                                <input type="text" name="exchangeRateDate" id="exchangeRateDate" readonly="true" />
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
                                    <input type="text"id="insuredName" name="insuredName" class="txtbox-small"/>
                                    <input type="hidden"id="insuredId" name="insuredId" class="txtbox-small"/>
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
                                                <tbody></tbody>
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
                                        <td width="60%" style="padding-left:5px;">Is DBA name different than insured name ?</td>
                                        <td width="1%"><input type="radio" id="insured_name_yes" name="insured_name" value="Y" /></td>
                                        <td style="padding-top:8px;">Yes</td>
                                        <td width="1%"><input type="radio" id="insured_name_no" name="insured_name" checked="checked" value="N" /></td>
                                        <td style="padding-top:8px;">No</td>
                                        <td width=""><span class="arrow-col"></span></td>
                                    </tr>
                                </table>
                            </td>
                            <td colspan="2" rowspan="6">
                                <table width="100%" border="0" cellspacing="0" cellpadding="0" class="dba_table_data">
                                    <tr>
                                        <td>Insured Contact Person<span style="color: red;"> *</span></td>
                                        <td>
                                            <select name="insuredContactPerson" id="insuredContactPerson" class="listbox-small mailingaddress" disabled>
                                                <option value="0">-- Select --</option>
                                                <?php foreach ($countryName as $value) { ?>
                                                    <option value="<?php echo $value['Id']; ?>"><?php echo $value['InsuredCountry']; ?></option>
                                                <?php } ?>
                                            </select>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>Insured Contact Person Email</td>
                                        <td>
                                            <input type="text" name="insuredContactPersonEmail" id="insuredContactPersonEmail" class="txtbox-small mailingaddress" readonly="readonly" />
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>Insured Contact Person's Number(O)</td>
                                        <td> 
                                            <input type="text" name="insuredContactPersonNumber" id='insuredContactPersonNumber' class="txtbox-small mailingaddress" readonly="readonly" />
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>Insured Contact Person's Mobile</td>
                                        <td>
                                            <input type="text" name="insuredContactPersonMobile"  class="txtbox-small mailingaddress" id="insuredContactPersonMobile" readonly="readonly" />
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>Insured Submission Date</td>
                                        <td> 
                                            <input type="text"  name="insuredSubmissionDate" id='insuredSubmissionDate' class=" txtbox-small mailingaddress" readonly />
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>Insured Quote Due Date</td>
                                        <td> 
                                            <input type="text" name="insuredQuoteDueDate" id='insuredQuoteDueDate' class=" txtbox-small mailingaddress" readonly/>
                                        </td>
                                    </tr>
                                </table>
                            </td>
                        </tr>
                        <tr>
                            <td>Address Line 1</td>
                            <td><input type="text" name="insured_address" id="insured_address" class="txtbox-small" readonly="readonly"></td>
                            <td>DBA Name</td>
                            <td><input type="text" name="dbaname" id="dbaname" disabled class="txtbox-small"/></td>
                        </tr>
                        <tr>
                            <td>Country</td>
                            <td> 
                                <input type="text" name="insured_country" id= "insured_country" class="txtbox-small" readonly="readonly">
                            </td>
                            <td width="12%">D&amp;B Number</td>
                            <td width="22%"><input type="text" name="dbnumber" id="dbnumber" class="txtbox-small" autocomplete="off" readonly="readonly"/></td>
                        </tr>
                        <tr>
                            <td>State</td>
                            <td> 
                                <input type="text" name="insured_state" id="insured_state" class="txtbox-small" readonly="readonly">
                            </td>
                            <td>Priority Companies<span style="color: red;"> *</span></td>
                            <td> 
                                <div class="dropdown divdropdown" style="width:5px;">
                                    <input readonly="readonly" type='text' name="cabValue" class='selectboxClass' id="cabValue" value=""  style="font-size:8pt;padding-right: 20px; width:130px;"/>
                                    <ul class="dropdown-list">                                    
                                        <li>
                                            <label><?php if ($niddle['selectAllCompany'] == 'y') { $check = 'checked="checked"'; } ?>
                                                <input type="checkbox" value="y" id="selectAllCompany" name="selectAllCompany" <?php echo $check; ?> />-Select All-</label>
                                        </li>                                    
                                        <?php
                                        foreach ($cabCompanies as $cabValue) {?> 
                                            <li>
                                                <label><input class="checkCabVal" type="checkbox"  <?php echo $select; ?> value="<?php echo $cabValue['LookupName']; ?>" name="cab_companies[]" /><?php echo $cabValue['LookupName']; ?></label>
                                            </li>
                                         <?php } ?>
                                    </ul>
                                </div>
                            </td>
                        </tr>
                        <tr>
                            <td>City</td>
                            <td> 
                                <input type="text" name="insured_city" id="insured_city" class="txtbox-small" readonly="readonly">
                            </td>
                            <td>Reinsured Company</td>
                            <td><input type="text" name="reinsured_company" id="reinsured_company" class="listbox-small"></td>
                        </tr>
                        <tr>
                            <td>Zipcode</td>
                            <td><input type="text" name="insured_zipcode" id="insured_zipcode" class="txtbox-small" readonly="readonly"></td>
                            <td>Submission Type Identifier</td>
                            <td>
                                <select type="text" name="submission_type_idrntifier" id="submission_type_idrntifier" class="listbox-small">
                                    <option value="0">--Select--</option>
                                    <?php foreach ($submissionIdentifier as $value) { ?>
                                        <option value="<?php echo $value['Id']; ?>"><?php echo $value['Name']; ?></option>
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
                            <td width="22%"><input type="text" name="projectname" id="projectname" class="txtbox-small project" disabled/></td>
                            <td width="12%">Name of General Contractor</td>
                            <td width="22%">
                                <input type="text" name="generalcontratorname" id="generalcontratorname" class="txtbox-small project" disabled/>
                            </td>
                            <td width="12%">Project Owner Name</td>
                            <td width="22%"><input type="text" name="projectownername" id="projectownername" class="txtbox-small project" disabled/></td>
                        </tr>
                        <tr>
                            <td>Project Country</td>
                            <td>
                                <select name="projectcountry" id="projectcountry" disabled class="listbox-small project">
                                    <option value="0">-- Select --</option>
                                    <?php foreach ($countryName as $value) { ?>
                                        <option value="<?php echo $value['Id']; ?>"><?php echo $value['InsuredCountry']; ?></option>
                                    <?php } ?>
                                </select>
                            </td>
                            <td>Project State</td>
                            <td>
                                <select name="projectstate" id="projectstate" disabled class="listbox-small project">
                                    <option value="0">-- Select --</option>
                                </select>
                            </td>
                            <td>Project City</td>
                            <td colspan="3">
                                <select name="projectcity" id="projectcity" disabled class="listbox-small project">
                                    <option value="0">-- Select --</option>
                                </select>
                            </td>
                        </tr>
                        <tr>
                            <td>Project Street Address</td>
                            <td>
                                <input type="text" name="projectstreetaddress" id="projectstreetaddress" class="listbox-small project" disabled>
                            </td>
                            <td>Bid Situation</td>
                            <td>
                                <select name="bidsituation" id="bidsituation" disabled class="listbox-small project">
                                    <option value="0">--Select--</option>
                                    <?php foreach ($bidSituation as $bidValue) { ?>
                                        <option value="<?php echo $bidValue['Id']; ?>"><?php echo $bidValue['Alias']; ?></option>
                                    <?php } ?>
                                </select>
                            </td>
                            <td>Total Insured Value in Local Currency <input type="checkbox" name= "yesTrue" id="yesTrue" value="Y" class="ct4" disabled/></td>
                            <td id="total_insured">
                                <input type="text" name="total_insured_value_text" id="total_insured_value" class="txtbox-small" disabled/>
                            </td>
                            <td style="display:none;" id="total_insured_values">
                                <select name="total_insured_value_select" id="total_insured_value_select" class="listbox-small">
                                    <option value="0">-- Select --</option>
                                    <option value="-1">Not Available</option>
                                    <option value="-2">To Be Entered</option>
                                </select>  
                            </td>
                        </tr>
                        <tr>
                            <td>Total Insured Value(in USD)</td>
                            <td>
                                <input type="text" name="total_insured_value_usd" id="total_insured_value_usd" class="txtbox-small" disabled readonly/>
                            </td>
                            <td>Number Of Locations (greater than 3)</td>
                            <td>
                                <select name="NumberOfLocations" id="NumberOfLocations" class="listbox-small" disabled >
                                    <option value="">-- Select --</option>
                                    <?php foreach ($numberOfLocations as $value) { ?>
                                        <option value="<?php echo $value['Id'] ?>" ><?php echo $value['LookupName'] ?></option>
                                    <?php } ?>
                                </select>
                            </td>
                            <td>Risk Profile</td>
                            <td>
                                <textarea name="riskProfile" id="riskProfile" class="listbox-small" maxlength="150" disabled></textarea>
                            </td>
                        </tr>
                        <tr>
                            <td>Occupancy Code</td>
                            <td>
                                <select name="OccupancyCode" id="OccupancyCode" class="listbox-small" disabled >
                                    <option value="">-- Select --</option>
                                    <?php foreach ($occupancyCode as $value) { ?>
                                        <option value="<?php echo $value['Id'] ?>" ><?php echo $value['Name'] ?></option>
                                    <?php } ?>
                                </select>
                            </td>
                            <td>ISO Code</td>
                            <td>
                                <input type="text" name="isccode" id="isccode" class="txtbox-small" disabled readonly/>
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
                            <td width="12%">Broker Name<span style="color: red;">*</span></td>
                            <td width="22%"> 
                                <select name="brokercode" id="brokercode" class="listbox-small">
                                    <option value="0">-- Select --</option>
                                    <?php foreach ($brokerDetails as $value) { ?>
                                        <option value="<?php echo $value['code']; ?>" class="<?php echo $value['cat']; ?>"><?php echo $value['name']; ?></option>
                                    <?php } ?>
                                </select>
                            </td>
                            <td width="12%">Wholesaler or Retailer</td>
                            <td width="22%">
                                <input type="text" id="isWholesaler" name="isWholesaler" class="listbox-small" readonly/><input type="hidden" id="brokerId" name="brokerId">
                            </td>
                            <td width="12%">Retail Broker Name</td>
                            <td width="22%">
                                <input type="text" id="retailBrokerName" name="retailBrokerName" class="listbox-small" disabled/>
                            </td>
                        </tr>
                        <tr>
                            <td>Broker Country<span style="color: red;">*</span></td>
                            <td> 
                                <select name="countrycode" id="countrycode" class="listbox-small">
                                    <option value="0">-- Select --</option>
                                </select>
                            </td>
                            <td>Broker State<span style="color: red;">*</span></td>
                            <td> 
                                <select name="statecode"  class="listbox-small" id="statecode">
                                    <option value="0">-- Select --</option>
                                </select>
                            </td>
                            <td>Broker City<span style="color: red;">*</span></td>
                            <td> 
                                <select name="citycode"  class="listbox-small" id="citycode">
                                    <option value="0">-- Select --</option>
                                </select>
                            </td>
                        </tr>
                        <tr>
                            <td>Retail Broker Country</td>
                            <td> 
                                <select name="retailcountrycode" id="retailcountrycode" class="listbox-small" disabled>
                                    <option value="0">-- Select --</option>
                                    <?php foreach ($retailBrokerCountryName as $value) { ?>
                                        <option value="<?php echo $value['Id'];?>"> <?php echo $value['InsuredCountry']; ?></option>
                                    <?php } ?>
                                </select>
                            </td>
                            <td>Retail Broker State</td>
                            <td> 
                                <select name="retailstatecode"  class="listbox-small" id="retailstatecode" disabled>
                                    <option value="0">-- Select --</option>
                                </select>
                            </td>
                            <td>Retail Broker City</td>
                            <td> 
                                <select name="retailcitycode"  class="listbox-small" id="retailcitycode" disabled>
                                    <option value="0">-- Select --</option>
                                </select>
                            </td>
                        </tr>
                        <tr>
                            <td>Broker Contact Person<span style="color: red;">*</span></td>
                            <td>
                                <select name="brokercontactperson" id="brokercontactperson" maxlength="50" class="listbox-small" autocomplete="off" disabled>
                                    <option value="0">-- Select --</option>
                                </select>
                            </td>
                            <td>Broker Contact Person’s Email</td>
                            <td><input type="text" name="broker_contact_person_email" id="broker_contact_person_email" class="listbox-small" readonly="readonly"/></td>
                            <td width="12%">Broker Contact Person’s Number(O)</td>
                            <td colspan="3"><input type="text" name="borker_contact_peson_number" id="borker_contact_peson_number" class="listbox-small" readonly="readonly"></td>
                        </tr>
                        <tr>
                            <td>Broker Contact Person Mobile</td>
                            <td> 
                                <input type="text" name="borker_contact_peson_mobile" id="borker_contact_peson_mobile" class="listbox-small" readonly="readonly">
                            </td>
                            <td>Broker Code</td>
                            <td><input type="text" id="brokerCodegenerate" name="brokerCodegenerate" class="txtbox-small" readonly/></td>
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
                                <select name="reason_code" id="reason_code" disabled class="listbox-small">
                                    <option value="0">--Select--</option>
                                    <?php foreach ($reasonCode as $value) { ?>
                                        <option value="<?php echo $value['Id']; ?>"><?php echo $value['ReasonCodeName'] . '-' . $value['Meaning']; ?></option>
                                    <?php } ?>
                                </select>
                            </td>
                            <td width="12%"></td>
                            <td width="22%"></td>
                            <td width="12%">Process Date</td>
                            <td width="22%">
                                <input type="text" class="date" name="processdate" id="processdate" disabled readonly="readonly"/>
                            </td>
                        </tr>
                    </table>
                </div>
            </div>
        </div>
        <div class="container">
            <div class="box">
                <h1 class="section-header">Premium Details
                    <div class="arrow"></div>
                </h1>
                <div class="content" style="display: block;">
                    <table width="100%" border="0" cellspacing="0" cellpadding="0">
                        <tr>
                            <td width="12%">Premium in Local Currency <?php if ($userGroup == 'master') { ?><input type="checkbox" name= "yesGross" id="yesGross" class="ct4 statusDetails" value="Y" disabled/> <?php } ?></td>
                            <td width="22%" id="gross_premium_value"> 
                                <input type="text" name="gross_premium_text" id="gross_premium"  class="statusDetails" disabled>
                            </td>
                            <td style="display:none;" id="gross_premium_values">
                                <select name="gross_premium_select" id="gross_premium_select" disabled class="listbox-small statusDetails">
                                    <option value="0">-- Select --</option>
                                    <option value="-1">Not Available</option>
                                    <option value="-2">To Be Entered</option>
                                </select>  
                            </td>
                            <td width="12%">Premium(in USD)</td>
                            <td width="22%"> 
                                <input type="text" name="premiumUsdCurrency" id="premiumUsdCurrency"  class="listbox-small statusDetails" disabled readonly />
                            </td>
                            <td width="12%">Layer of Limit in Local Currency</td>
                            <td width="22%"> 
                                <input type="text" name="layerLimitLocalCurrency" id="layerLimitLocalCurrency"  class="listbox-small" disabled />
                            </td>
                        </tr>
                        <tr>
                            <td width="12%">Layer of Limit(in USD)</td>
                            <td width="22%"> 
                                <input type="text" name="layerLimitUSD" id="layerLimitUSD"  class="listbox-small" disabled readonly/>
                            </td>
                            <td width="12%">% of Layer</td>
                            <td width="22%"> 
                                <input type="text" name="PercentageLayer" id="PercentageLayer"  class="listbox-small" disabled />
                            </td>
                            <td width="12%">Limit in Local Currency <?php if ($userGroup == 'master') { ?><input type="checkbox" name= "yesLimit" id="yesLimit" class="ct4 statusDetails" value="Y" disabled/> <?php } ?></td>
                            <td width="22%" id="limit_value">
                                <input type="text" name="limit_text" id="limit" class="statusDetails" disabled>
                            </td>
                            <td style="display:none;" id="limit_values">
                                <select name="limit_select" id="limit_select" disabled class="listbox-small statusDetails">
                                    <option value="0">-- Select --</option>
                                    <option value="-1">Not Available</option>
                                    <option value="-2">To Be Entered</option>
                                </select>  
                            </td>
                        </tr>
                        <tr>
                            <td width="12%">Limit(in USD)</td>
                            <td width="22%">
                                <input type="text" name="limit_usd_text" id="limit_usd_text" class="statusDetails" disabled readonly>
                            </td>
                            <td width="12%">Attachment Point in Local Currency <?php if ($userGroup == 'master') { ?><input type="checkbox" name= "yesAttachment" id="yesAttachment" class="ct4 statusDetails" value="Y" disabled/> <?php } ?></td>
                            <td id="attachment_value">
                                <input type="text" name="attachment_point" id="attachment_point" class="statusDetails" disabled/>
                            </td>
                            <td style="display:none;" id="attachment_values">
                                <select name="attachment_point_select" id="attachment_point_select" disabled class="listbox-small statusDetails">
                                    <option value="0">-- Select --</option>
                                    <option value="-1">Not Available</option>
                                    <option value="-2">To Be Entered</option>
                                </select>  
                            </td>
                            <td width="12%">Attachment Point(in USD)</td>
                            <td>
                                <input type="text" name="attachment_point_usd" id="attachment_point_usd" class="statusDetails" disabled readonly/>
                            </td>
                        </tr>
                        <tr>
                            <td width="12%">Self Insured Retention in Local Currency</td>
                            <td width="22%">
                                <input type="text" name="selfInsuredRetention" id="selfInsuredRetention" class="txtbox-small" disabled />
                            </td>
                            <td width="12%">Self Insured Retention(in USD)</td>
                            <td width="22%">
                                <input type="text" name="selfInsuredRetentionUSD" id="selfInsuredRetentionUSD" class="txtbox-small" disabled readonly/>
                            </td>
                            <td width="12%">Policy Comm. %</td>
                            <td>
                                <input type="text" name="policyCommission" id="policyCommission" class="txtbox-small" disabled />
                            </td>
                        </tr>
                        <tr>
                            <td width="12%">Policy Comm. in Local Currency</td>
                            <td width="22%">
                                <input type="text" name="policyComissionInLocalCurrency" id="policyComissionInLocalCurrency" class="txtbox-small" disabled readonly="readonly"/>
                            </td>
                            <td width="12%">Policy Comm.(in USD)</td>
                            <td width="22%">
                                <input type="text" name="policyComissionInUSD" id="policyComissionInUSD" class="txtbox-small" disabled readonly/>
                            </td>
                            <td width="12%">Premium (Net of All Commission) in Local Currency</td>
                            <td>
                                <input type="text" name="netpremiumCommissionInLocalCurrency" id="netpremiumCommissionInLocalCurrency" class="txtbox-small" disabled readonly="readonly"/>
                            </td>
                        </tr>
                        <tr>
                            <td>Premium (Net of All Commission)(in USD)</td>
                            <td>
                                <input type="text" name="netpremiumCommissionInUSD" id="netpremiumCommissionInUSD" class="txtbox-small" readonly disabled readonly/>
                            </td>
                        </tr>
                    </table>
                </div>
            </div>
        </div>

        <div class="container">
            <div class="box">
                <h1 class="section-header">Policy Details
                    <div class="arrow"></div>
                </h1>
                <div class="content" style="display: block;">
                    <table width="100%" border="0" cellspacing="0" cellpadding="0">
                        <tr>
                            <td width="12%">Bind Date<input class="ct4 statusDetails" type="checkbox" name= "yesBinddate" id="yesBinddate" value="Y" disabled/></td>
                            <td width="22%">
                                <input type="text" class="txtbox-small" name="binddate" id="binddate" disabled  readonly="readonly"/>
                            </td>
                            <td width="12%">Renewable(Y/N)</td>
                            <td width="22%"> 
                                <select name="renewable" id="renewable" class="listbox-small" disabled>
                                    <option value="0">--Select--</option>
                                    <?php foreach ($renewable as $value) { ?>
                                        <option value="<?php echo $value['Id']; ?>"><?php echo $value['LookupName']; ?></option>
                                    <?php } ?>
                                </select>
                            </td>
                            <td width="12%">Date of Renewal</td>
                            <td width="22%">
                                <input type="text" class="txtbox-small" name="dateofrenewal" id="dateofrenewal" disabled readonly="readonly"/>
                            </td>
                        </tr>
                        <tr>
                            <td width="12%">Policy Type</td>
                            <td width="22%"> 
                                <select name="policyName" id="policyName" class="listbox-small" disabled>
                                    <option value="0">--Select--</option>
                                    <?php foreach ($policyType as $value) { ?>
                                        <option value="<?php echo $value['Id']; ?>"><?php echo $value['LookupName']; ?></option>
                                    <?php } ?>
                                </select>
                            </td>
                            <td width="12%">Direct/Assumed</td>
                            <td width="22%"> 
                                <select name="directAssumed" id="directAssumed"  class="listbox-small" disabled>
                                    <option value="0">--Select--</option>
                                    <?php foreach ($directAssumed as $value) { ?>
                                        <option value="<?php echo $value['Id']; ?>"><?php echo $value['LookupName']; ?></option>
                                    <?php } ?>
                                </select>
                            </td>
                            <td width="12%">Admitted/ Non-Admitted</td>
                            <td width="22%"> 
                                <select name="admitted" id="admitted" class="listbox-small" disabled>
                                    <option value="0">--Select--</option>
                                    <?php foreach ($admittedNotAdmitted as $value) { ?>
                                        <option value="<?php echo $value['Id']; ?>"><?php echo $value['LookupName']; ?></option>
                                    <?php } ?>
                                </select>
                            </td>
                        </tr>
                        <tr>
                        <tr>
                            <td width="12%">Class Name</td>
                            <td width="22%"> 
                                <select name="className" id="className" class="listbox-small" disabled>
                                    <option value="0">--Select--</option>
                                    <option value="1">1</option>
                                    <option value="2">2</option>
                                    <option value="3">3</option>
                                    <option value="4">4</option>
                                </select>
                            </td>
                            <td width="12%">Class Code</td>
                            <td width="22%"> 
                                <input type="text" class="txtbox-small ui-autocomplete-input" value="" id="subClass" name="subClass" disabled="disabled" autocomplete="off">
                            </td>
                            <td width="12%">Description</td>
                            <td width="22%"> 
                                <input type="text" readonly="readonly" name="description" id="description" disabled="disabled" />
                            </td>
                        </tr>
                            <td width="12%">Company Paper</td>
                            <td width="22%"> 
                                <select name="companyPaper" id="companyPaper" class="listbox-small" disabled>
                                    <option value="0">--Select--</option>
                                    <?php foreach ($companyPaper as $value) { ?>
                                        <option value="<?php echo $value['Id']; ?>"><?php echo $value['LookupName']; ?></option>
                                    <?php } ?>
                                </select>
                            </td>
                            <td width="12%">Company Paper Number</td>
                            <td width="22%"> 
                                <select name="companyPaperNumber" id="companyPaperNumber" class="listbox-small" disabled>
                                    <option value="0">--Select--</option>
                                    <?php foreach ($companyPaperNumber as $value) { ?>
                                        <option value="<?php echo $value['Id']; ?>"><?php echo $value['LookupName']; ?></option>
                                    <?php } ?>
                                </select>
                            </td>
                            <td width="12%">Policy Number</td>
                            <td width="22%">
                                <input type="text" class="txtbox-small" name="policyNumber" id="policyNumber" disabled/>
                            </td>
                        </tr>
                        <tr>
                            <td width="12%">Coverage</td>
                            <td width="22%"> 
                                <select name="coverage" id="coverage" class="listbox-small" disabled>
                                    <option value="0">--Select--</option>
                                </select>
                            </td>
                            <td width="12%">Suffix</td>
                            <td width="22%"> 
                                <select name="suffix" id="suffix" class="listbox-small" disabled>
                                    <option value="0">--Select--</option>
                                    <?php foreach ($suffix as $value) { ?>
                                        <option value="<?php echo $value['Id']; ?>"><?php echo $value['LookupName']; ?></option>
                                    <?php } ?>
                                </select>
                            </td>
                            <td width="12%">Transaction Number</td>
                            <td width="22%">
                                <input type="text" class="txtbox-small" name="transactionNumber" id="transactionNumber" disabled readonly/>
                            </td>
                        </tr>
                        <tr>
                            <td width="12%">NAIC Code</td>
                            <td width="22%">
                                <input type="text" class="txtbox-small" name="naicCode" id="naicCode" disabled/>
                            </td>
                            <td width="12%">NAIC Title</td>
                            <td width="22%">
                                <input type="text" class="txtbox-small" name="naicTitle" id="naicTitle" disabled />
                            </td>
                            <td width="12%">SIC Code</td>
                            <td width="22%">
                                <input type="text" class="txtbox-small" name="sicCode" id="sicCode" disabled maxlength="4" />
                            </td>
                        </tr>
                        <tr>
                            <td width="12%">SIC Title</td>
                            <td width="22%">
                                <input type="text" class="txtbox-small" name="sicTitle" id="sicTitle" disabled/>
                            </td>
                            <td width="12%">OFRC Adverse Report</td>
                            <td width="22%"> 
                                <select name="ofrcReport" id="ofrcReport" class="listbox-small" disabled>
                                    <option value="0">--Select--</option>
                                    <?php foreach ($ofrcReport as $value) { ?>
                                        <option value="<?php echo $value['Id']; ?>"><?php echo $value['LookupName']; ?></option>
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
                            <td width="14%">Date of Receiving-By Berk SI From Broker<span style="color: red;"> *</span></td>
                            <td width="3%"><input type="checkbox" name= "yesBroker" id="yesBroker" value="Y"/></td>
                            <td width="20%"><input type="text" class="txtbox-small date" name="byBerkSi" id="byBerkSi" required="true" readonly/></td>
                            <td width="14%">Date of Receiving-By India From Berk SI<span style="color: red;"> *</span></td>
                            <td width="3%"><input type="checkbox" name= "yesIndia" id="yesIndia" value="Y"></td>
                            <td width="20%"><input type="text" class="txtbox-small date" name="byIndia" id="byIndia" required="true" readonly/></td>
                            <td width="12%">Branch Office<span style="color: red;"> *</span></td>
                            <td width="16%">
                                    <select name="branch_office" id="branch_office" class="listbox-small">
                                        <option value="0">-- Select --</option>
                                        <?php foreach ($branch as $value) { ?>
                                            <option value="<?php echo $value['Id']; ?>"><?php echo $value['Branch']; ?></option>
                                        <?php } ?>
                                    </select>
                            </td>
                        </tr>           
                    </table>
                </div>
            </div>
        </div>

        <!-- Action Buttons Start -->
        <div class="container">
            <p class="btn-warning">Please ensure that you have filled up all the mandatory fields on the page. Please check the sections you have minimized as well.</p>
            <table width="100%" cellpadding="0" cellspacing="0">
                <tr>
                    <td align="center">
                        <input type="submit" id="Submitdata" name="Submitdata" class="btn btn-blue" value="Submit" onclick="javascript:void(0);" />
                        <input type="button" class="btn btn-cyan" value="Cancel" onclick="window.location = '/submission/List'"  />
                    </td>
                </tr>
            </table>
        </div>
        <input type="hidden" id="brokerCodeGen1" name="brokerCodeGen1" value="<?php if ($_POST['brokerCodeGen1']) { echo $_POST['brokerCodeGen1']; } ?>" />
    </form>
    <!-- Action Buttons End -->                
</div>
<!-- Content Ends -->
