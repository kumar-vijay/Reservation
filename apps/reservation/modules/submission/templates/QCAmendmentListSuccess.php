<?php $niddle = $sf_user->getAttribute('searchNiddle'); 
  $cabcomps = explode(" &amp; ",$niddle['CabCompanies']); 
?>
<link  rel="stylesheet" href="//netdna.bootstrapcdn.com/font-awesome/3.2.1/css/font-awesome.css">
<div id="content">
    <div class="breadcrumbs group"> 
        <ul id="breadcrumb">
            <li><a href="/">Home</a><span> >>&nbsp; </span></li>
            <li><a href="/submission/Submission">Submission</a><span> >>&nbsp; </span></li>
            <li class="selected">Amendment QC Queue List</li>
        </ul>
        <a href="/submission/Submission" id="back"></a>
        </div>
    
    <div class="container">
        <div class="box">
            <!-- Quotes -->
            <h1 class="section-header">Filter (<?php echo $numberofResults; ?> results found)<div class="arrow"></div></h1>
            <!--Filter Section-->
            <div class="content">
                <form method="POST" action="/submission/QCAmendmentList" name="qcSubmissionFrm" id="qcSubmissionFrm">	
                    <table width="100%" border="0" cellspacing="0" cellpadding="0">
                        <tr>
                            <td width="10%">Submission No.</td>
                            <td width="15%"><input type="text" name="submissionNo" id="submissionNo"  class="txtbox-small" value="<?php echo $niddle['SubmissionNo']; ?>" /></td>
                            <td width="10%">Insured Name</td>
                            <td width="15%">
                                <input name="InsuredName" value="<?php echo $niddle['InsuredName']; ?>" id="InsuredName" type="text" class="txtbox-small" />
                            </td>
                            <td width="10%">New/Renewal</td>
                            <td width="15%">
                                <select name="newrenewal" class="listbox-small">
                                    <option value="">--Select--</option>
                                    <?php
                                    foreach ($nerrenewal as $newRenewalvalue) {
                                        if ($newRenewalvalue['LookupName'] == $niddle['NewRenewal'])
                                            $select = 'selected="selected"';
                                        else
                                            $select = '';
                                        ?>
                                        <option value="<?php echo $newRenewalvalue['LookupName']; ?>" <?php echo $select; ?> ><?php echo $newRenewalvalue['Alias']; ?> </option>
                                    <?php } ?>
                                </select>
                            </td>
                            <td width="10%">Create Date Range</td>
                            <td width="15%">
                                <input type="text" autocomplete="off" readonly="true" id="SubmissionFromDate" value="<?php echo $niddle['SubmissionFromDate']; ?>" name="SubmissionFromDate" class="txtbox-small  width69 from" placeholder="From Date" />
                                <input type="text" autocomplete="off" readonly="true" id="SubmissionToDate" name="SubmissionToDate" value="<?php echo $niddle['SubmissionToDate']; ?>" class="txtbox-small  width69 to" placeholder="To Date" />
                            </td>
                        </tr>
                        <tr>
                            <td>Underwriter Name</td>
                            <td>
                                <select name="Underwriter" id="Underwriter" class="listbox-small">
                                    <option value="">--Select--</option>
                                    <?php
                                    foreach ($underWriter as $value) {
                                        if ($value->Name == $niddle['Underwriter'])
                                            $select = 'selected="selected"';
                                        else
                                            $select = '';
                                        ?>
                                        <option value="<?php echo $value->Name; ?>" <?php echo $select; ?> ><?php echo $value->Name; ?> </option>
                                    <?php } ?>
                                </select>
                            </td>
                            <td>Branch Office </td>
                            <td>
                                <select name="Branch" id="Branch" class="listbox-small">
                                    <option value="">--Select--</option>
                                    <?php
                                    foreach ($branchOffice as $value) {
                                        if ($value->Branch == $niddle['Branch'])
                                            $select = 'selected="selected"';
                                        else
                                            $select = '';
                                        ?>
                                        <option value="<?php echo $value->Branch; ?>" <?php echo $select; ?> ><?php echo $value->Branch; ?> </option>
                                    <?php } ?>
                                    <option value="NA">Not Availlable</option>
                                </select>
                            </td>
                            <td>Current Status</td>
                            <td>
                                <select name="Status" id="Status" class="listbox-small">
                                    <option value="">--Select--</option>
                                    <?php
                                    foreach ($status as $statusvalue) {
                                        if ($statusvalue['StatusName'] == $niddle['Status'])
                                            $select = 'selected="selected"';
                                        else
                                            $select = '';
                                        ?>
                                        <option value="<?php echo $statusvalue['StatusName']; ?>" <?php echo $select; ?> ><?php echo $statusvalue['StatusName']; ?> </option>
                                    <?php } ?>
                                </select>
                            </td>
                            <td>Reason Code</td>
                            <td>
                                <select name="reasoncode" class="listbox-small">
                                    <option value="">--Select--</option>
                                    <?php
                                    foreach ($reasonCode as $reasonvalue) {
                                        if ($reasonvalue['ReasonCodeName'] == $niddle['ReasonCode'])
                                            $select = 'selected="selected"';
                                        else
                                            $select = '';
                                    ?><?php if(empty($reasonvalue['Meaning'])) { ?>
                                         <option value="<?php echo $reasonvalue['ReasonCodeName']; ?>" <?php echo $select; ?> ><?php echo $reasonvalue['ReasonCodeName'] ?> </option>
                                    <?php } else { ?>
                                        <option value="<?php echo $reasonvalue['ReasonCodeName']; ?>" <?php echo $select; ?> ><?php echo $reasonvalue['ReasonCodeName'] . '-' . $reasonvalue['Meaning']; ?> </option>
                                    <?php } ?>
                                    <?php } ?>
                                </select>
                            </td>
                        </tr>
                        <tr>
                            <td>Product Line</td>
                            <td>
                                <select name="productline" id="productline" class="listbox-small">
                                    <option value="">--Select--</option>
                                    <?php
                                    foreach ($lobData as $lobvalue) {
                                        if ($lobvalue['LOBName'] == $niddle['ProductLine'])
                                            $select = 'selected="selected"';
                                        else
                                            $select = '';
                                        ?>
                                        <option value="<?php echo $lobvalue['LOBName']; ?>" <?php echo $select; ?> ><?php echo $lobvalue['LOBName']; ?> </option>
                                    <?php } ?>
                                </select>
                            </td>
                            <td>Product Line Subtype</td>
                            <td>
                                <select name="productsubtype" id="productsubtype" class="listbox-small">
                                    <option value="">--Select--</option>
                                    <?php
                                    foreach ($lobSubTypeList as $lobSubvalue) {
                                        if ($lobSubvalue['ProductLineSubType'] == $niddle['ProductLineSubType'])
                                            $select = 'selected="selected"';
                                        else
                                            $select = '';
                                        ?>
                                        <option value="<?php echo $lobSubvalue['ProductLineSubType']; ?>" <?php echo $select; ?> ><?php echo $lobSubvalue['ProductLineSubType']; ?> </option>
                                    <?php } ?>
                                      <option value="Not Applicable">Not Applicable</option>
                                      <option value="Not Available">Not Available</option>
                                </select>
                            </td>
                            <td>Section</td>
                            <td>
                                <select name="section" id="section" class="listbox-small">
                                    <option value="">--Select--</option>
                                    <?php
                                    foreach ($sectionList as $sectionvalue) {
                                        if ($sectionvalue['SectionCode'] == $niddle['Section'])
                                            $select = 'selected="selected"';
                                        else
                                            $select = '';
                                        ?>
                                        <option value="<?php echo $sectionvalue['SectionCode']; ?>" <?php echo $select; ?> ><?php echo $sectionvalue['SectionCode']; ?> </option>
                                    <?php } ?>
                                </select>
                            </td>
                            <td>Profit Code</td>
                            <td>
                                <select name="profitcode" id="profitcode" class="listbox-small">
                                    <option value="">--Select--</option>
                                    <?php
                                    foreach ($profitCodeList as $profitvalue) {
                                        if ($profitvalue['ProfitCodeName'] == $niddle['ProfitCode'])
                                            $select = 'selected="selected"';
                                        else
                                            $select = '';
                                        ?>
                                        <option value="<?php echo $profitvalue['ProfitCodeName']; ?>" <?php echo $select; ?> ><?php echo $profitvalue['ProfitCodeName']; ?> </option>
                                    <?php } ?>
                                </select>
                            </td>
                        </tr>
                        <tr>
                            <td>Broker Name</td>
                            <td>
                                <select name="brokername" id="brokername" class="listbox-small">
                                    <option value="">--Select--</option>
                                    <?php
                                    foreach ($brokerList as $brokervalue) {
                                        if ($brokervalue['BrokerName'] == $niddle['BrokerName'])
                                            $select = 'selected="selected"';
                                        else
                                            $select = '';
                                        ?>
                                        <option value="<?php echo $brokervalue['BrokerName']; ?>" <?php echo $select; ?> ><?php echo $brokervalue['BrokerName']; ?> </option>
                                    <?php } ?>
                                </select>
                            </td>
                            <td>Wholesaler or Retailer</td>
                            <td>
                                <select name="brokertype" id="brokertype" class="listbox-small">
                                    <option value="">--Select--</option>
                                    <?php
                                    foreach ($brokerType as $brokertypevalue) {
                                        if ($brokertypevalue['LookupName'] == $niddle['BrokerType'])
                                            $select = 'selected="selected"';
                                        else
                                            $select = '';
                                        ?>
                                        <option value="<?php echo $brokertypevalue['LookupName']; ?>" <?php echo $select; ?> ><?php echo $brokertypevalue['Alias']; ?> </option>
                                    <?php } ?>
                                </select>
                            </td>
                            <td>Broker City</td>
                            <td>
                                <select name="brokercity" id="brokercity" class="listbox-small">
                                    <option value="">--Select--</option>
                                    <?php
                                    foreach ($brokerCity as $brokerCityvalue) {
                                        if ($brokerCityvalue['CityFullCode'] == $niddle['BrokerCity'])
                                            $select = 'selected="selected"';
                                        else
                                            $select = '';
                                        ?>
                                        <option value="<?php echo $brokerCityvalue['CityFullCode']; ?>" <?php echo $select; ?> ><?php echo $brokerCityvalue['CityFullCode']; ?> </option>
                                    <?php } ?>
                                </select>
                            </td>
                            <td>Priority Companies</td>
                            <td>
                                <div class="dropdown divdropdown">
                                    <input readonly="readonly" type='text' name="cabcompanies" class='selectboxClass' id="cabValue" value="<?php echo $niddle['CabCompanies']; ?>"  style="font-size:8pt; width:130px; padding-right: 20px;"/>
                                    <ul class="dropdown-list">                                    
                                        <li>
                                            <label><?php if ($niddle['selectAllCompany'] == 'y') { $check = 'checked="checked"'; } ?>
                                                <input type="checkbox" value="y" id="selectAllCompany" name="selectAllCompany" <?php echo $check; ?> />-Select All-</label>
                                        </li>                                    
                                        <?php
                                        foreach ($cabCompanies as $cabValue) {
                                            if (in_array($cabValue['Alias'] ,$cabcomps))
                                                    $select = 'checked="checked"';
                                            else
                                                    $select = '';
                                            ?> 
                                            <li>
                                                <label><input class="checkCabVal" type="checkbox"  <?php echo $select; ?> value="<?php echo $cabValue['LookupName']; ?>" name="cab_companies[]" /><?php echo $cabValue['LookupName']; ?></label>
                                            </li>
                                         <?php } ?>
                                    </ul>
                                </div>
                            </td>
                        </tr>
                        <tr>
                            <td>Effective Date Range</td>
                            <td>
                                <input type="text" autocomplete="off" readonly="true" id="EffectiveFromDate" value="<?php echo $niddle['EffectiveFromDate']; ?>" name="EffectiveFromDate" class="txtbox-small  width69 from" placeholder="From Date" />
                                <input type="text" autocomplete="off" readonly="true" value="<?php echo $niddle['EffectiveToDate']; ?>" id="EffectiveToDate" name="EffectiveToDate" class="txtbox-small  width69 to" placeholder="To Date" />
                            </td>
                            <td>Expiry Date Range</td>
                            <td>
                                <input type="text" autocomplete="off" readonly="true" id="ExpirationFromDate" value="<?php echo $niddle['ExpirationFromDate']; ?>" name="ExpirationFromDate" class="txtbox-small  width69 from" placeholder="From Date" />
                                <input type="text" autocomplete="off" readonly="true" value="<?php echo $niddle['ExpirationToDate']; ?>" id="ExpirationToDate" name="ExpirationToDate" class="txtbox-small  width69 to" placeholder="To Date" />
                            </td>
                            <td>Process Date Range</td>
                            <td>
                                <input type="text" autocomplete="off" readonly="true" id="ProcessFromDate" value="<?php echo $niddle['ProcessFromDate']; ?>" name="ProcessFromDate" class="txtbox-small  width69 from" placeholder="From Date" />
                                <input type="text" autocomplete="off" readonly="true" id="ProcessToDate" name="ProcessToDate" value="<?php echo $niddle['ProcessToDate']; ?>" class="txtbox-small  width69 to" placeholder="To Date" />
                            </td>
                            <td>Edit Date Range</td>
                            <td>
                                <input type="text" autocomplete="off" readonly="true" id="EditFromDate" value="<?php echo $niddle['EditFromDate']; ?>" name="EditFromDate" class="txtbox-small  width69 from" placeholder="From Date" />
                                <input type="text" autocomplete="off" readonly="true" id="EditToDate" name="EditToDate" value="<?php echo $niddle['EditToDate']; ?>" class="txtbox-small  width69 to" placeholder="To Date" />
                            </td>
                        </tr>
                         <tr>
                            <td>DBA Name</td>
                            <td>
                                <input name="EditDbaName" value="<?php echo $niddle['EditDbaName']; ?>" id="EditDbaName" type="text" class="txtbox-small" />
                            </td>
                            <td>Broker Contact Person</td>
                            <td>
                                <input name="BrokerContactPerson" value="<?php echo $niddle['BrokerContactPerson']; ?>" id="BrokerContactPerson" type="text" class="txtbox-small" />
                            </td>
                            <td>Occupancy Code</td>  
                          <td>
                          <select name="occupancycode" class="listbox-small">
                                   <option value="">--Select--</option>
                                    <?php
                                    foreach ($occupancycode as $occupancycodesvalue) {
                                        if ($occupancycodesvalue['Name'] == $niddle['OccupancyCode'])
                                            $select = 'selected="selected"';
                                        else
                                            $select = '';
                                        ?>
                                        <option value="<?php echo $occupancycodesvalue['Name']; ?>" <?php echo $select; ?> ><?php echo $occupancycodesvalue['Name']; ?> </option>
                                    <?php } ?>
                           </select>
                           </td>
                            <td>Number Of Locations</td> 
                          <td>
                          <select name="numberoflocations" class="listbox-small">
                                   <option value="">--Select--</option>
                                    <?php
                                    foreach ($numberofLocations as $numberofLocationsvalue) {
                                        if ($numberofLocationsvalue['LookupName'] == $niddle['NumberOfLocations'])
                                            $select = 'selected="selected"';
                                        else
                                            $select = '';
                                        ?>
                                        <option value="<?php echo $numberofLocationsvalue['Alias']; ?>" <?php echo $select; ?> ><?php echo $numberofLocationsvalue['Alias']; ?> </option>
                                    <?php } ?>
                           </select>
                           </td>
                        </tr>
                        <tr>
                          <td>Currency</td> 
                          <td>
                          <select name="currency" class="listbox-small">
                                   <option value="">--Select--</option>
                                    <?php
                                    foreach ($currency as $currencyvalue) {
                                        if ($currencyvalue['LookupName'] == $niddle['Currency'])
                                            $select = 'selected="selected"';
                                        else
                                            $select = '';
                                        ?>
                                        <option value="<?php echo $currencyvalue['Alias']; ?>" <?php echo $select; ?> ><?php echo $currencyvalue['Alias']; ?> </option>
                                    <?php } ?>
                           </select>
                           </td>
                            <td>Renewable(Y/N)</td> 
                          <td>
                          <select name="renewable" class="listbox-small">
                                   <option value="">--Select--</option>
                                    <?php
                                    foreach ($renewable as $renewablevalue) {
                                        if ($renewablevalue['LookupName'] == $niddle['Renewable'])
                                            $select = 'selected="selected"';
                                        else
                                            $select = '';
                                        ?>
                                        <option value="<?php echo $renewablevalue['LookupName']; ?>" <?php echo $select; ?> ><?php echo $renewablevalue['LookupName']; ?> </option>
                                    <?php } ?>
                           </select>
                           </td>
                            <td>Date of Renewal</td>
                            <td>
                                <input type="text" autocomplete="off" readonly="true" value="<?php echo $niddle['DateofRenewalFromDate']; ?>" id="DateofRenewalFromDate" name="DateofRenewalFromDate" class="txtbox-small  width69 from" placeholder="From Date" />
                                <input type="text" autocomplete="off" readonly="true" value="<?php echo $niddle['DateofRenewalToDate']; ?>" id="DateofRenewalToDate" name="DateofRenewalToDate" class="txtbox-small  width69 to" placeholder="To Date" />
                            </td>
                          <td>Policy Type</td> 
                          <td>
                          <select name="policyType" class="listbox-small">
                                   <option value="">--Select--</option>
                                    <?php
                                    foreach ($policyType as $policyTypevalue) {
                                        if ($policyTypevalue['LookupName'] == $niddle['PolicyType'])
                                            $select = 'selected="selected"';
                                        else
                                            $select = '';
                                        ?>
                                        <option value="<?php echo $policyTypevalue['LookupName']; ?>" <?php echo $select; ?> ><?php echo $policyTypevalue['LookupName']; ?> </option>
                                    <?php } ?>
                           </select>
                           </td> 
                        </tr>
                        <tr>
                          <td>Direct/Assumed</td> 
                          <td>
                          <select name="directAssumed" class="listbox-small">
                                   <option value="">--Select--</option>
                                    <?php
                                    foreach ($directAssumed as $directAssumedvalue) {
                                        if ($directAssumedvalue['LookupName'] == $niddle['DirectAssumed'])
                                            $select = 'selected="selected"';
                                        else
                                            $select = '';
                                        ?>
                                        <option value="<?php echo $directAssumedvalue['LookupName']; ?>" <?php echo $select; ?> ><?php echo $directAssumedvalue['LookupName']; ?> </option>
                                    <?php } ?>
                           </select>
                           </td>  
                          <td>Company Paper</td> 
                          <td>
                          <select name="companyPaper" class="listbox-small">
                                   <option value="">--Select--</option>
                                    <?php
                                    foreach ($companyPaper as $companyPapervalue) {
                                        if ($companyPapervalue['LookupName'] == $niddle['CompanyPaper'])
                                            $select = 'selected="selected"';
                                        else
                                            $select = '';
                                        ?>
                                        <option value="<?php echo $companyPapervalue['LookupName']; ?>" <?php echo $select; ?> ><?php echo $companyPapervalue['LookupName']; ?> </option>
                                    <?php } ?>
                           </select>
                           </td> 
                          <td>Company Paper Number</td> 
                          <td>
                          <select name="companyPaperNumber" class="listbox-small">
                                   <option value="">--Select--</option>
                                    <?php
                                    foreach ($companyPaperNumber as $companyPaperNumbervalue) {
                                        if ($companyPaperNumbervalue['LookupName'] == $niddle['CompanyPaperNumber'])
                                            $select = 'selected="selected"';
                                        else
                                            $select = '';
                                        ?>
                                        <option value="<?php echo $companyPaperNumbervalue['LookupName']; ?>" <?php echo $select; ?> ><?php echo $companyPaperNumbervalue['LookupName']; ?> </option>
                                    <?php } ?>
                           </select>
                           </td>
                           <td>Policy Number</td>
                            <td>
                                <input name="policyNumber" value="<?php echo $niddle['PolicyNumber']; ?>" id="policyNumber" type="text" class="txtbox-small" />
                            </td> 
                        <tr>
                            
                          <td>Suffix</td> 
                          <td>
                          <select name="suffix" class="listbox-small">
                                   <option value="">--Select--</option>
                                    <?php
                                    foreach ($suffix as $suffixvalue) {
                                        if ($suffixvalue['LookupName'] == $niddle['Suffix'])
                                            $select = 'selected="selected"';
                                        else
                                            $select = '';
                                        ?>
                                        <option value="<?php echo $suffixvalue['LookupName']; ?>" <?php echo $select; ?> ><?php echo $suffixvalue['LookupName']; ?> </option>
                                    <?php } ?>
                           </select>
                           </td>
                           <td>Admitted/ Non-Admitted</td> 
                          <td>
                          <select name="admittedNonAdmitted" class="listbox-small">
                                   <option value="">--Select--</option>
                                    <?php
                                    foreach ($admittedNotAdmitted as $admittedNotAdmittedvalue) {
                                        if ($admittedNotAdmittedvalue['LookupName'] == $niddle['AdmittedNonAdmitted'])
                                            $select = 'selected="selected"';
                                        else
                                            $select = '';
                                        ?>
                                        <option value="<?php echo $admittedNotAdmittedvalue['LookupName']; ?>" <?php echo $select; ?> ><?php echo $admittedNotAdmittedvalue['LookupName']; ?> </option>
                                    <?php } ?>
                           </select>
                           </td>
                           <td>Coverage</td> 
                          <td>
                          <select name="coverage" class="listbox-small">
                                   <option value="">--Select--</option>
                                    <?php
                                    foreach ($coverage as $coveragevalue) {
                                        if ($coveragevalue['Name'] == $niddle['Coverage'])
                                            $select = 'selected="selected"';
                                        else
                                            $select = '';
                                        ?>
                                        <option value="<?php echo $coveragevalue['Name']; ?>" <?php echo $select; ?> ><?php echo $coveragevalue['Name']; ?> </option>
                                    <?php } ?>
                           </select>
                           </td>
                        </tr>
                        <tr>
                            <td colspan="8" align="center">
                                <input type="submit" value="Search" class="btn btn-blue"  name="filterSubmit" id="filterSubmit" />
                                <input type="reset" value="Clear" id="reserQcValue" class="btn btn-cyan" />
                            </td>
                        </tr>
                    </table>
                </form>
            </div>
        </div>
    </div>
    <div class="container">
        <h2 class="dataTable-title">Amendment QC Queue List</h2>
        <div class="actn-btns">
            <div class="g1">
            </div>
            <div class="g2">
                <button class="btn btn-blue btn-medium collapseAll">Collapse All <i class="fa fa-minus"></i></button>
                <button class="btn btn-blue btn-medium expandAll">Expand All <i class="fa fa-plus"></i></button>
            </div>
        </div>
        <div  id="submission-list-wrapper">
            <table class="dataTable sort">
                <thead>
                <tr>
                        <th>Action</th>
                        <th>QC Status</th>
                        <th>Mail Status</th>
                        <th>Submission Number</th>
                        <th>Master Policy Number</th>
                        <th>New/Renewal</th>
                        <th><div>Insured Name<span class="plus-icon"></span></div></th>
                        <th class="insured-name-expand hidden">D&amp;B Number</th>
                        <th class="insured-name-expand hidden">Country</th>
                        <th class="insured-name-expand hidden">State</th>
                        <th class="insured-name-expand hidden">City</th>
                        <th class="insured-name-expand hidden">Address Line1</th>
                        <th class="insured-name-expand hidden">Zip Code</th>
                        <th class="insured-name-expand hidden">Reinsurance Company</th>
                        <th class="insured-name-expand hidden">DBA Name</th>
                        <th class="insured-name-expand hidden"><div>Insured Contact Person<span class="plus-icon"></span></div></th>
                        <th class="contact-person-expand hidden">Insured Contact person's Email</th>
                        <th class="contact-person-expand hidden">Insured Contact person's Phone Number</th>
                        <th class="contact-person-expand hidden">Insured Contact person's Mobile Number</th>
                        <th class="insured-name-expand hidden">Insured Submission Date</th>
                        <th class="insured-name-expand hidden">Insured Quote Due Date</th>
                        <th>Underwriter</th>
                        <th><div>Product Line<span class="plus-icon"></span></div></th>
                        <th class="product-line-expand hidden">Product Line Subtype</th>
                        <th class="product-line-expand hidden">Section</th>
                        <th class="product-line-expand hidden">Profit Code</th>
                        <th><div>Current Status<span class="plus-icon"></span></div></th>
                        <th class="current-status-expand hidden">Reason Code</th>
                        <th><div>Effective Date<span class="plus-icon"></div></span></th>
                        <th class="effective-date-expand hidden">Expiry Date</th>
                        <th>Branch Office</th>
                        <th><div>Broker Name<span class="plus-icon"></span></div></th>
                        <th class="broker-name-expand hidden">Broker Country</th>
                        <th class="broker-name-expand hidden">Broker State</th>
                        <th class="broker-name-expand hidden">Broker City</th>
                        <th class="broker-name-expand hidden">Broker Code</th>
                        <th class="broker-name-expand hidden"><div>Wholesaler or Retailer<span class="plus-icon"></span></div></th>
                        <th class="wholesaler-expand hidden">Retail Broker Name</th>
                        <th class="wholesaler-expand hidden">Retail Broker Country</th>
                        <th class="wholesaler-expand hidden">Retail Broker State</th>
                        <th class="wholesaler-expand hidden">Retail Broker City</th>
                        <th class="broker-name-expand hidden"><div>Broker Contact Person<span class="plus-icon"></span></div></th>
                        <th class="broker-contactperson-expand hidden">Broker Contact Person's Email</th>
                        <th class="broker-contactperson-expand hidden">Broker Contact Person's Phone Number</th>
                        <th class="broker-contactperson-expand hidden">Broker Contact Person's Mobile Number</th>
                        <th>Priority Companies</th>
                        <th><div>Premium (in USD)<span class="plus-icon"></span></div></th>
                        <th class="gross-premium-expand hidden">Exchange Rate as on</th>
                        <th class="gross-premium-expand hidden">Exchange Rate</th>
                        <th class="gross-premium-expand hidden">Currency</th>
                        <th class="gross-premium-expand hidden">Premium in Local Currency</th>
                        <th class="gross-premium-expand hidden">Limit (in USD)</th>
                        <th class="gross-premium-expand hidden">Limit in Local Currency</th>
                        <th class="gross-premium-expand hidden">Attachment Point (in USD)</th>
                        <th class="gross-premium-expand hidden"><div>Attachment Point in Local Currency<span class="plus-icon"></span></div></th> 
                        <th class="attachmentPointLocalCurrency-expand hidden"><div>Policy Comm %<span class="plus-icon"></span></div></th>
                        <th class="policyCommissionPercentage-expand hidden">Policy Comm(in USD)</th>
                        <th class="policyCommissionPercentage-expand hidden">Policy Comm in Local Currency</th>
                        <th class="policyCommissionPercentage-expand hidden">Premium (Net of All Commission)(in USD)</th>
                        <th class="policyCommissionPercentage-expand hidden">Premium (Net of All Commission) in Local Currency</th>
                        <th class="policyCommissionPercentage-expand hidden"><div>Layer of Limit(in USD)<span class="plus-icon"></span></div></th>
                        <th class="layeroflimit-expand hidden">Layer of Limit in Local Currency</th>
                        <th class="policyCommissionPercentage-expand hidden">% of Layer</th>
                        <th class="policyCommissionPercentage-expand hidden">Self Insured Retention(in USD)</th>
                        <th class="policyCommissionPercentage-expand hidden">Self Insured Retention in Local Currency</th>
                        <th><div>Project Name<span class="plus-icon"></span></div></th>
                        <th class="project-name-expand hidden">Name of General Contractor</th>
                        <th class="project-name-expand hidden">Project Owner Name</th>
                        <th class="project-name-expand hidden">Project Country</th>
                        <th class="project-name-expand hidden">Project State</th>
                        <th class="project-name-expand hidden">Project City</th>
                        <th class="project-name-expand hidden">Project Street Address</th>
                        <th class="project-name-expand hidden">Bid Situation</th>
                        <th><div>Total Insured Value(TIV)<span class="plus-icon"></span></div></th>
                        <th class="TIV-expand hidden">Total Insured Value(TIV) in(USD)</th>
                        <th class="TIV-expand hidden">Occupancy Code</th>
                        <th class="TIV-expand hidden">Number Of Locations</th>
                        <th class="TIV-expand hidden">Risk Profile</th>       
                        <th><div>Process Date<span class="plus-icon"></span></div></th>
                        <th class="ProcessDate-expand hidden">Bind Date</th>
                        <th class="ProcessDate-expand hidden"><div>NAIC Title<span class="plus-icon"></span></div></th>
                        <th class="NAICTitle-expand hidden">NAIC Code</th>
                        <th class="NAICTitle-expand hidden">SIC Title</th>
                        <th class="NAICTitle-expand hidden">SIC Code</th>
                        <th><div>Company Paper<span class="plus-icon"></span></div></th>
                        <th class="companypaper-expand hidden">Company Paper Number</th>
                        <th class="companypaper-expand hidden">Coverage</th>
                        <th class="companypaper-expand hidden"><div>Policy Number<span class="plus-icon"></span></div></th>
                        <th class="policyNumber-expand hidden">Suffix</th>
                        <th class="companypaper-expand hidden">Renewable(Y/N)</th>
                        <th class="companypaper-expand hidden">Date of Renewal</th>
                        <th class="companypaper-expand hidden"><div>Policy Type<span class="plus-icon"></span></div></th>
                        <th class="policyType-expand hidden">Direct/Assumed</th>
                        <th class="policyType-expand hidden">Admitted/Non-Admitted</th>
                        <th class="policyType-expand hidden">OFRC Adverse Report</th>
                        <th class="policyType-expand hidden">Transaction Number</th>
                        <th><div>Date of Receiving -By India From Berk SI<span class="plus-icon"></span></div></th>
                        <th class="received-date-by-india-expand hidden">Date of Receiving - By Berk Si From Broker</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    if ($numberofResults) {
                        foreach ($arrData->getResults() as $value) {
                            ?>
                            <tr>
                                <td><a class="btn btn-green btn-small" href=<?php echo "/submission/qcviewamendment?amendmentId=" . $value->getId(); ?>><i class="fa fa-eye"></i></a></td>
                                <td class="pending"><?php echo $value->getQcstatus(); ?></td>
                                <td><?php //echo $value->getMailsendingstatus(); ?></td>
                                <td><?php echo $value->getSubmissionnumber(); ?></td>
                                <td><?php echo $value->getFinalpolicynumber(); ?></td>
                                <td><?php echo $value->getNewrenewal(); ?></td>
                                <td><?php echo $value->getInsuredname(); ?></td>
                                <td class="insured-name-expand hidden"><?php echo $value->getDbnumber(); ?></td>
                                <td class="insured-name-expand hidden"><?php echo $value->getInsuredcountry(); ?></td>
                                <td class="insured-name-expand hidden"><?php echo $value->getInsuredstate(); ?></td>
                                <td class="insured-name-expand hidden"><?php echo $value->getInsuredcity(); ?></td>
                                <td class="insured-name-expand hidden"><?php echo $value->getInsuredaddress1(); ?></td>
                                <td class="insured-name-expand hidden"><?php echo $value->getInsuredzipcode(); ?></td>
                                <td class="insured-name-expand hidden"><?php echo $value->getReinsuredcompany(); ?></td>
                                <td class="insured-name-expand hidden"><?php echo $value->getDbaname(); ?></td>
                                <td class="insured-name-expand hidden"><?php echo $value->getInsuredcontactpersonname(); ?></td>
                                <td class="contact-person-expand hidden"><?php echo $value->getInsuredcontactpersonemail(); ?></td>
                                <td class="contact-person-expand hidden"><?php echo $value->getInsuredcontactpersonphonenumber(); ?></td>
                                <td class="contact-person-expand hidden"><?php echo $value->getInsuredcontactpersonmobilenumber(); ?></td>
                                <td class="insured-name-expand hidden"><?php $subDate = $value->getInsuredsubmissiondate(); if(!empty($subDate)){ echo date('M-d-Y', strtotime($value->getInsuredsubmissiondate()));} else {echo "";} ?></td>
                                <td class="insured-name-expand hidden"><?php $quoDate = $value->getInsuredquoteduedate(); if(!empty($quoDate)){ echo date('M-d-Y', strtotime($value->getInsuredquoteduedate()));} else { echo "";} ?></td>
                                <td><?php echo $value->getUnderwritername(); ?></td>
                                <td><?php echo $value->getProductline(); ?></td>
                                <td class="product-line-expand hidden"><?php echo $value->getProductlinesubtype(); ?></td>
                                <td class="product-line-expand hidden"><?php echo $value->getSectioncode(); ?></td>
                                <td class="product-line-expand hidden"><?php echo $value->getProfitcode(); ?></td>
                                <td><?php echo $value->getStatus(); ?></td>
                                <td class="current-status-expand hidden"><?php $reasonCode = $value->getReasoncode();if(!empty($reasonCode)){ echo $value->getReasoncode();} else { echo "";} ?></td>
                                <td><?php $effeDate = $value->getEffectivedate(); if(!empty($effeDate)){ echo date("M-d-Y", strtotime($value->getEffectivedate()));} else { echo "";} ?></td>
                                <td class="effective-date-expand hidden"><?php $expDate = $value->getExpirydate(); if(!empty($expDate)) {echo date("M-d-Y", strtotime($value->getExpirydate()));} else { echo "";} ?></td>
                                <td><?php echo $value->getBranchname(); ?></td>
                                <td><?php echo $value->getBrokername(); ?></td>
                                <td class="broker-name-expand hidden"><?php echo $value->getBrokercountry(); ?></td>
                                <td class="broker-name-expand hidden"><?php echo $value->getBrokerstate(); ?></td>
                                <td class="broker-name-expand hidden"><?php echo $value->getBrokercity(); ?></td> 
                                <td class="broker-name-expand hidden"><?php echo $value->getBrokercode(); ?></td>
                                <td class="broker-name-expand hidden"><?php echo $value->getBrokertype(); ?></td>
                                <td class="wholesaler-expand hidden"><?php echo $value->getRetailbrokername();?></td>
                                <td class="wholesaler-expand hidden"><?php echo $value->getRetailbrokercountry();?></td>
                                <td class="wholesaler-expand hidden"><?php echo $value->getRetailbrokerstate();?></td>
                                <td class="wholesaler-expand hidden"><?php echo $value->getRetailbrokercity();?></td>
                                <td class="broker-name-expand hidden"><?php echo $value->getBrokercontactperson(); ?></td>
                                <td class="broker-contactperson-expand hidden"><?php echo $value->getBrokercontactpersonemail(); ?></td>
                                <td class="broker-contactperson-expand hidden"><?php echo $value->getBrokercontactpersonnumber(); ?></td>
                                <td class="broker-contactperson-expand hidden"><?php echo $value->getBrokercontactpersonmobile(); ?></td>
                                <td><?php echo $value->getCabcompanies(); ?></td>
                                <td><?php echo $value->getPremiuminusd(); ?></td>
                                <td class="gross-premium-expand hidden"><?php $exchangeDate = $value->getExchangedate(); if(!empty($exchangeDate)){ echo date("M-d-Y", strtotime( $value->getExchangedate()));} else { echo "";} ?></td>
                                <td class="gross-premium-expand hidden"><?php echo $value->getExchangerate(); ?></td>
                                <td class="gross-premium-expand hidden"><?php echo $value->getCurrency(); ?></td>
                                <td class="gross-premium-expand hidden"><?php echo $value->getPremiuminlocalcurrency(); ?></td>
                                <td class="gross-premium-expand hidden"><?php echo $value->getLimitinusd(); ?></td>
                                <td class="gross-premium-expand hidden"><?php echo $value->getLimitinlocalcurrency(); ?></td>
                                <td class="gross-premium-expand hidden"><?php echo $value->getAttachmentpointinusd(); ?></td>
                                <td class="gross-premium-expand hidden"><?php echo $value->getAttachmentpointinlocalcurrency(); ?></td>
                                <td class="attachmentPointLocalCurrency-expand hidden"><?php echo $value->getPolicycommpercentage(); ?></td>
                                <td class="policyCommissionPercentage-expand hidden"><?php echo $value->getPolicycomminusd(); ?></td>
                                <td class="policyCommissionPercentage-expand hidden"><?php echo $value->getPolicycomminlocalcurrency(); ?></td> 
                                <td class="policyCommissionPercentage-expand hidden"><?php echo $value->getPremiumnetofcomminusd(); ?></td> 
                                <td class="policyCommissionPercentage-expand hidden"><?php echo $value->getPremiumnetofcomminlocalcurrency(); ?></td> 
                                <td class="policyCommissionPercentage-expand hidden"><?php echo $value->getLayeroflimitinusd(); ?></td>
                                <td class="layeroflimit-expand hidden"><?php echo $value->getLayeroflimitinlocalcurrency(); ?></td>
                                <td class="policyCommissionPercentage-expand hidden"><?php echo $value->getPercentageoflayer(); ?></td>
                                <td class="policyCommissionPercentage-expand hidden"><?php echo $value->getSelfinsuredretentioninusd(); ?></td>
                                <td class="policyCommissionPercentage-expand hidden"><?php echo $value->getSelfinsuredretentioninlocalcurrency(); ?></td>
                                <td><?php echo $value->getProjectname(); ?></td>
                                <td class="project-name-expand hidden"><?php echo $value->getProjectcontractorname(); ?></td>
                                <td class="project-name-expand hidden"><?php echo $value->getProjectownername(); ?></td>
                                <td class="project-name-expand hidden"><?php echo $value->getProjectcountry(); ?></td>
                                <td class="project-name-expand hidden"><?php echo $value->getProjectstate(); ?></td>
                                <td class="project-name-expand hidden"><?php echo $value->getProjectcity(); ?></td>
                                <td class="project-name-expand hidden"><?php echo $value->getProjectaddressline1(); ?></td>
                                <td class="project-name-expand hidden"><?php echo $value->getBidsituation();?></td>
                                <td><?php echo $value->getTotalinsuredvalueinlocalcurrency(); ?></td>
                                <td class="TIV-expand hidden"><?php echo $value->getTotalinsuredvalueinusd();?></td>
                                <td class="TIV-expand hidden"><?php echo $value->getOccupancycode();?></td>
                                <td class="TIV-expand hidden"><?php echo $value->getNumberoflocations();?></td>
                                <td class="TIV-expand hidden"><?php echo $value->getRiskprofile();?></td>
                                <td><?php $Process = $value->getProcessdate(); if(!empty($Process)){ echo date('M-d-Y', strtotime($value->getProcessdate()));} else {echo '';} ?></td>
                                <td class="ProcessDate-expand hidden"><?php $expDate = $value->getBinddate(); if(!empty($expDate)) {echo date("M-d-Y", strtotime($value->getBinddate()));} else { echo "";} ?></td>
                                <td class="ProcessDate-expand hidden"><?php echo $value->getNaictitle();?></td>
                                <td class="NAICTitle-expand hidden"><?php echo $value->getNaiccode();?></td>
                                <td class="NAICTitle-expand hidden"><?php echo $value->getSictitle();?></td>
                                <td class="NAICTitle-expand hidden"><?php echo $value->getSiccode();?></td>
                                <td><?php echo $value->getCompanypaper();?></td>
                                <td class="companypaper-expand hidden"><?php echo $value->getCompanypapernumber();?></td>
                                <td class="companypaper-expand hidden"><?php echo $value->getCoverage();?></td>
                                <td class="companypaper-expand hidden"><?php echo $value->getPolicynumber();?></td>
                                <td class="policyNumber-expand hidden"><?php echo $value->getSuffix();?></td>
                                <td class="companypaper-expand hidden"><?php echo $value->getRenewable();?></td>
                                <td class="companypaper-expand hidden"><?php echo $value->getDateofrenewal();?></td>
                                <td class="companypaper-expand hidden"><?php echo $value->getPolicytype();?></td>
                                <td class="policyType-expand hidden"><?php echo $value->getDirectassumed();?></td>
                                <td class="policyType-expand hidden"><?php echo $value->getAdmittednonadmitted();?></td>
                                <td class="policyType-expand hidden"><?php echo $value->getOfrcadversereport();?></td>
                                <td class="policyType-expand hidden"><?php echo $value->getTransactionnumber();?></td>
                                <td><?php $brokerDate= $value->getBerksidatefromindia();if(!empty($brokerDate)){ echo date('M-d-Y', strtotime($value->getBerksidatefromindia()));} else { echo "";} ?></td>
                                <td class="received-date-by-india-expand hidden"><?php $indiaDate = $value->getBerksidatefrombroker(); if(!empty($indiaDate)){ echo date('M-d-Y h:i:s', strtotime($value->getBerksidatefrombroker()));} else { echo "";} ?></td>
                            </tr>
                            <?php
                        }
                    } else {
                        ?>
                        <tr>
                            <td colspan="11" align="center" class="login-error">Sorry, No Record Found.</td>
                        </tr>
                        <?php
                    }
                    ?>
            </table>
        </div>
    </div>
    <!--Pagination start-->
    <div class="container">
    <?php if ($arrData->haveToPaginate()): ?>
        <!--Pagination start-->
        <nav class="pagination-wrapper">
        <ul class="pagination">
            <li class="first"><a href="<?php echo '?page=' . $arrData->getFirstPage() . '&niddle=true'; ?>" class="pagination-link" id="page-<?php echo $arrData->getFirstPage(); ?>">First</a></li>
               <li class="prev"><a href="<?php echo '?page=' . $arrData->getPreviousPage() . '&niddle=true'; ?>" class="pagination-link" id="page-<?php echo $arrData->getPreviousPage(); ?>">Previous</a></li>
            <?php foreach ($arrData->getLinks() as $page): ?>
                <?php if ($page == $arrData->getPage()): ?>
                    <?php echo '<li class="selected">' . $page . '</li>' ?>
                <?php else: ?>
                    <?php echo '<li><a href="?page=' . $page . '&niddle=true" id="page-' . $page . '">' . $page . '</a></li>'; ?>
                <?php endif; ?>
            <?php endforeach; ?>
            <li class="next"><a href="<?php echo '?page=' . $arrData->getNextPage() . '&niddle=true'; ?>" id="page-<?php echo $arrData->getNextPage(); ?>">Next</a></li>
            <li class="last"><a href="<?php echo '?page=' . $arrData->getLastPage() . '&niddle=true'; ?>" id="page-<?php echo $arrData->getLastPage(); ?>">Last</a></li>
        </ul>
        </nav>
    <?php endif; ?>
   </div>
     <!--Pagination end-->
</div>