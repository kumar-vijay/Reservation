<div class="breadcrumbs group"> 
    <ul id="breadcrumb">
        <li><a href="/">Home</a><span> >>&nbsp; </span></li>
        <li><a href="/policy/Policy">Policy Block</a><span> >>&nbsp; </span></li>
        <li><a href="/policy/PolicyList">Policy Number Listing</a><span> >>&nbsp; </span></li>
        <li class="selected">Edit Policy Number</li>
    </ul>
    <a href="/policy/PolicyList" id="back"></a>
</div>
<div class="clear"></div>
<div style="text-align: center; font-weight: bold;">New Policy Number</div>
<div class="container">
    <ul class="tabbed-menu">
        <li class="active"><a href="/policy/EditPolicyNumber?policyId=<?php echo $policyId; ?>" id="policynumberdetails">Edit Policy Number Details</a></li>
        <li><a href="/policy/PolicyHistory?policyId=<?php echo $policyId; ?>" id="policynumberhistory">History</a></li>
    </ul>	
    <div class="dates">
        <em>Created Date: <strong><?php if(!empty($policyInfo[0]['CreatedOn'])) {echo date("m-d-Y", strtotime($policyInfo[0]['CreatedOn']));} else { echo "";} ?></strong></em>
        <em>Updated Date: <strong><?php
                if ($policyInfo[0]['ModifiedOn'] != '') {
                    echo date("m-d-Y", strtotime($policyInfo[0]['ModifiedOn']));
                } else {
                    echo '';
                }
                ?></strong>
        </em>
    </div>
    <div class="clear"></div>
</div>

<form method="POST" action="" name="editpolicyNumberAddForm" id="editpolicyNumberAddForm" autocomplete="off">
    <div class="container">
        <div class="box">
            <h1 class="section-header">Basic Details
                <div class="arrow"></div>
            </h1>
            <div class="content" style="display: block;">
                <?php
                if (isset($errorArr)) {
                    ?>
                    <div class="grouperror">
                        <?php
                        foreach ($errorArr as $err => $val) {
                            echo "<li>$val</li>";
                        }
                        ?>
                    </div>
                    <?php
                }
                ?>
                <table width="100%" border="0" cellspacing="0" cellpadding="0">
                    <tr>
                        <td width="12%">Region</td>
                        <td width="22%"> 
                            <select name="editregion" id="editregion" class="listbox-small" disabled>
                                <option value="0">--Select--</option>
                                <?php foreach ($region as $value) { 
                                    if ($policyInfo[0]['RegionId'] == $value['Id']) $select = 'selected="selected"'; else $select = ''; 
                                ?>                            
                                    <option value="<?php echo $value['Id']; ?>" <?php echo $select; ?>><?php echo $value['RegionName']; ?></option>                            
                                <?php } ?>
                            </select>
                        </td>
                        <td>Branch Office<span style="color: red;"> *</span></td>
                        <td> 
                            <select name="editbranchOffice" id="editbranchOffice" class="listbox-small">
                                <option value="0">--Select--</option>
                            </select>
                        </td>
                        <td width="12%">Product Line<span style="color: red;"> *</span></td>
                        <td width="22%"> 
                            <select name="editproducttype" id="editproducttype" class="listbox-small" disabled>
                                <option value="0">--Select--</option>
                                <?php foreach ($productLine as $value) { 
                                    if ($policyInfo[0]['ProductLineId'] == $value['Id']) $select = 'selected="selected"'; else $select = ''; 
                                ?>                            
                                    <option value="<?php echo $value['Id']; ?>" <?php echo $select; ?>><?php echo $value['ProductLine']; ?></option>                            
                                <?php } ?>
                            </select>
                        </td>
                    </tr>
                    <tr> 
                        <td width="12%">Product Line Subtype<span style="color: red;"> *</span></td>
                        <td width="22%"> 
                            <select name="editproductsubtype" id="editproductsubtype" class="listbox-small" disabled>
                                <option value="0">--Select--</option>
                                <?php foreach ($productLineSubType as $value) { 
                                    if ($policyInfo[0]['ProductLineSubTypeId'] == $value['Id']) $select = 'selected="selected"'; else $select = ''; 
                                ?>                            
                                    <option value="<?php echo $value['Id']; ?>" <?php echo $select; ?>><?php echo $value['ProductLineSubTypeName']; ?></option>                            
                                <?php } ?>
                            </select>
                        </td>
                        <td>Underwriter<span style="color: red;"> *</span></td>
                        <td> 
                            <select name="editunderwriter" id="editunderwriter" class="listbox-small" disabled>
                                <option value="0">--Select--</option>
                                <?php foreach ($underwriter as $value) { 
                                    if ($policyInfo[0]['UnderwriterId'] == $value['Id']) $select = 'selected="selected"'; else $select = ''; 
                                ?>                            
                                    <option value="<?php echo $value['Id']; ?>" <?php echo $select; ?>><?php echo $value['UnderwriterName']; ?></option>                            
                                <?php } ?>
                            </select>
                        </td>
                        <td>Insured Name<span style="color: red;"> *</span></td>
                        <td> 
                            <input type="text" name="editinsuredName" id="editinsuredName" class="txtbox-small" value="<?php echo $policyInfo[0]['InsuredName'];?>" maxlength="50"/>
                        </td>
                    </tr>
                    <tr>
                        <td>Reinsured Company</td>
                        <td>
                            <input type="text" name="editreinsuranceCompany" id="editreinsuranceCompany" class="txtbox-small" value="<?php echo $policyInfo[0]['ReinsuredCompany']; ?>" maxlength="50" />
                        </td>
                        <td>Remarks</td>
                        <td>
                            <textarea name="editremarks" id="editremarks" rows="4" cols="30" maxlength="150"><?php echo $policyInfo[0]['Remarks'];?></textarea>
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
                        <td width="12%">Direct/Assumed</td>
                        <td width="22%">
                            <select name="editdirectassumed" id="editdirectassumed" class="listbox-small">
                                <option value="0">--Select--</option>
                                <?php foreach ($directAssumed as $value) {
                                    if ($policyInfo[0]['DirectAssumedLookupId'] == $value['Id']) $select = 'selected="selected"'; else $select = ''; 
                                ?>                            
                                    <option value="<?php echo $value['Id']; ?>" <?php echo $select; ?>><?php echo $value['Alias']; ?></option>                            
                                <?php } ?>
                            </select>
                        </td>
                        <td width="12%">Admitted/Non-Admitte</td>
                        <td width="22%"> 
                            <select name="editadmittedNonAdmitted" id="editadmittedNonAdmitted" class="listbox-small">
                                <option value="0">--Select--</option>
                                <?php foreach ($admitted as $value) {
                                    if ($policyInfo[0]['AdmittedNonAdmittedLookupId'] == $value['Id']) $select = 'selected="selected"'; else $select = ''; 
                                ?>                            
                                    <option value="<?php echo $value['Id']; ?>" <?php echo $select; ?>><?php echo $value['Alias']; ?></option>                            
                                <?php } ?>
                            </select>
                        </td>
                        <td width="12%">Admitted Details</td>
                        <td width="22%"> 
                            <select name="editadmittedDetails" id="editadmittedDetails" class="listbox-small">
                                <option value="0">--Select--</option>
                            </select>
                        </td>
                    </tr>
                    <tr> 
                        <td>Company<span style="color: red;"> *</span></td>
                        <td> 
                            <select name="editcompnay" id="editcompnay" class="listbox-small">
                                <option value="0">--Select--</option>
                                <?php foreach ($company as $value) { 
                                    if ($policyInfo[0]['CompanyLookupId'] == $value['Id']) $select = 'selected="selected"'; else $select = ''; 
                                ?>                            
                                    <option value="<?php echo $value['Id']; ?>" <?php echo $select; ?>><?php echo $value['Alias']; ?></option>                            
                                <?php } ?>
                            </select>
                        </td>
                        <td>Company Number</td>
                        <td>
                            <input type="text" name="editcompnaynumber" id="editcompnaynumber" class="txtbox-small" value="<?php echo $policyInfo[0]['CompanyNumber'];?>" readonly/>
                        </td>
                        <td>Prefix<span style="color: red;"> *</span></td>
                        <td> 
                            <select name="editprefix" id="editprefix" class="listbox-small" disabled>
                                <option value="0">--Select--</option>
                                <?php foreach ($prefix as $value) { 
                                    if ($policyInfo[0]['PrefixId'] == $value['Id']) $select = 'selected="selected"'; else $select = ''; 
                                ?>                            
                                    <option value="<?php echo $value['Id']; ?>" <?php echo $select; ?>><?php echo $value['Name']; ?></option>                            
                                <?php } ?>
                            </select>
                        </td>
                    </tr>
                    <tr>
                        <td>Policy Effective Date<span style="color: red;"> *</span></td>
                        <td>
                            <input type="text" name="editpolicyEffectiveDate" id="editpolicyEffectiveDate" class="txtbox-small" value="<?php echo date("m/d/Y", strtotime($policyInfo[0]['PolicyEffectiveDate']));?>" readonly/>
                        </td>
                        <td>Policy Expiry Date</td>
                        <td>
                            <input type="text" name="editpolicyExpiryDate" id="editpolicyExpiryDate" class="txtbox-small" value="<?php echo date("m/d/Y", strtotime($policyInfo[0]['PolicyExpiryDate']));?>" readonly />
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
                        <td width="12%">Premium Currency<span style="color: red;"> *</span></td>
                        <td width="22%">
                            <select name="editpremiumcurrency" id="editpremiumcurrency" class="listbox-small">
                                <option value="0">--Select--</option>
                                <?php foreach ($premiumCurrency as $value) { 
                                    if ($policyInfo[0]['PolicyCurrency'] == $value['Id']) $select = 'selected="selected"'; else $select = ''; 
                                ?>                            
                                    <option value="<?php echo $value['Id']; ?>" <?php echo $select; ?>><?php echo $value['LookupTypeName']; ?></option>                            
                                <?php } ?>
                            </select>
                        </td>
                        <td width="12%">Inception Gross Premium<span style="color: red;"> *</span></td>
                        <td width="22%">
                            <input type="text" name="editinceptiongrosspremium" id="editinceptiongrosspremium" class="txtbox-small" value="<?php echo $policyInfo[0]['InceptionGrossPremium'];?>" />
                        </td>
                        <td width="12%">Commission %<span style="color: red;"> *</span></td>
                        <td width="22%">
                            <input type="text" name="editcomissionpercentage" id="editcomissionpercentage" class="txtbox-small" value="<?php echo $policyInfo[0]['CommisssionPercentage'];?>" />
                        </td>
                    </tr>
                    <tr>
                        <td width="12%">Commission $</td>
                        <td width="22%">
                            <input type="text" name="editcomissiondoller" id="editcomissiondoller" class="txtbox-small" value="<?php echo $policyInfo[0]['CommisssionDoller'];?>" readonly />
                        </td>
                        <td>Net Premium</td>
                        <td>
                            <input type="text" name="editnetpremium" id="editnetpremium" class="txtbox-small" value="<?php echo $policyInfo[0]['NetPremium'];?>" readonly />
                        </td>
                    </tr>
                </table>
            </div>
        </div>
    </div>
    <!-- Action Buttons Start -->
    <div class="container-btn">
        <p class="btn-warning">Please ensure that you have filled up all the mandatory fields on the page. Please check the sections you have minimized as well.</p>
        <table width="100%" cellpadding="0" cellspacing="0">
            <tr>
                <td colspan="6" align="center">
                    <input type="submit" value="Submit" class="btn btn-blue" id="editpolicySubmit" name="editpolicySubmit" />
                    <input type="reset" value="Cancel" onclick="location.href = '<?php echo url_for('@policy_list') ?>';" class="btn btn-cyan" />
                    <input type="hidden" name="hiddenBranchId" id="hiddenBranchId" value="<?php echo $policyInfo[0]['BranchId']; ?>" />
                    <input type="hidden" name="hiddenAdmittedDetailsId" id="hiddenAdmittedDetailsId" value="<?php echo $policyInfo[0]['AdmittedDetailsId']; ?>" />
                    <input type="hidden" name="hiddenDataRecorderMetaId" id="hiddenDataRecorderMetaId" value="<?php echo $policyInfo[0]['DataRecorderMetaDataId']; ?>" />
                    <input type="hidden" name="hiddenMasterPolicyNumber" id="hiddenMasterPolicyNumber" value="<?php echo $policyInfo[0]['MasterPolicyNumber']; ?>" />
                    <input type="hidden" name="hiddennewRenewal" id="hiddennewRenewal" value="<?php echo $policyInfo[0]['NewRenewalLookupId']; ?>" />
                    <input type="hidden" name="hiddenRegion" id="hiddenRegion" value="<?php echo $policyInfo[0]['RegionId']; ?>" />
                    <input type="hidden" name="hiddenProductLine" id="hiddenProductLine" value="<?php echo $policyInfo[0]['ProductLineId']; ?>" />
                    <input type="hidden" name="hiddenProductLineSubType" id="hiddenProductLineSubType" value="<?php echo $policyInfo[0]['ProductLineSubTypeId']; ?>" />
                    <input type="hidden" name="hiddenUnderwriter" id="hiddenUnderwriter" value="<?php echo $policyInfo[0]['UnderwriterId']; ?>" />
                    <input type="hidden" name="hiddennewPrefix" id="hiddennewPrefix" value="<?php echo $policyInfo[0]['PrefixId']; ?>" />
                    <input type="hidden" name="hiddennewSuffix" id="hiddennewSuffix" value="<?php echo $policyInfo[0]['Suffix']; ?>" />
                </td>
            </tr>
        </table>
    </div>
</form>