<div class="breadcrumbs group"> 
    <ul id="breadcrumb">
        <li><a href="/">Home</a><span> >>&nbsp; </span></li>
        <li><a href="/policy/Policy">Policy Block</a><span> >>&nbsp; </span></li>
        <li class="selected">Generate New Policy Number</li>
    </ul>
    <a href="/policy/Policy" id="back"></a>
</div>
<div class="clear"></div>
<div style="text-align: center; font-weight: bold;">New Policy Number</div>
<form method="POST" action="" name="policyNumberAddForm" id="policyNumberAddForm" autocomplete="off">
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
                            <select name="region" id="region" class="listbox-small">
                                <option value="0">--Select--</option>
                                <?php foreach ($region as $value) { ?>                            
                                    <option value="<?php echo $value['Id']; ?>"><?php echo $value['RegionName']; ?></option>                            
                                <?php } ?>
                            </select>
                        </td>
                        <td>Branch Office<span style="color: red;"> *</span></td>
                        <td> 
                            <select name="branchOffice" id="branchOffice" class="listbox-small">
                                <option value="0">--Select--</option>
                            </select>
                        </td>
                        <td width="12%">Product Line<span style="color: red;"> *</span></td>
                        <td width="22%"> 
                            <select name="producttype" id="producttype" class="listbox-small">
                                <option value="0">--Select--</option>
                            </select>
                        </td>
                    </tr>
                    <tr> 
                        <td width="12%">Product Line Subtype<span style="color: red;"> *</span></td>
                        <td width="22%"> 
                            <select name="productsubtype" id="productsubtype" class="listbox-small">
                                <option value="0">--Select--</option>
                            </select>
                        </td>
                        <td>Underwriter<span style="color: red;"> *</span></td>
                        <td> 
                            <select name="underwriter" id="underwriter" class="listbox-small">
                                <option value="0">--Select--</option>
                            </select>
                        </td>
                        <td>Insured Name<span style="color: red;"> *</span></td>
                        <td> 
                            <input type="text" name="insuredName" id="insuredName" class="txtbox-small" maxlength="50"/>
                        </td>
                    </tr>
                    <tr>
                        <td>Reinsured Company</td>
                        <td>
                            <input type="text" name="reinsuranceCompany" id="reinsuranceCompany" class="txtbox-small" maxlength="50" />
                        </td>
                        <td>Remarks</td>
                        <td>
                            <textarea name="remarks" id="remarks" rows="4" cols="30" maxlength="150"></textarea>
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
                            <select name="directassumed" id="directassumed" class="listbox-small">
                                <option value="0">--Select--</option>
                                <?php foreach ($directAssumed as $value) { ?>                            
                                    <option value="<?php echo $value['Id']; ?>"><?php echo $value['Alias']; ?></option>                            
                                <?php } ?>
                            </select>
                        </td>
                        <td width="12%">Admitted/Non-Admitted</td>
                        <td width="22%"> 
                            <select name="admittedNonAdmitted" id="admittedNonAdmitted" class="listbox-small">
                                <option value="0">--Select--</option>
                                <?php foreach ($admitted as $value) { ?>                            
                                    <option value="<?php echo $value['Id']; ?>"><?php echo $value['Alias']; ?></option>                            
                                <?php } ?>
                            </select>
                        </td>
                        <td width="12%">Admitted Details</td>
                        <td width="22%"> 
                            <select name="admittedDetails" id="admittedDetails" class="listbox-small">
                                <option value="0">--Select--</option>
                            </select>
                        </td>
                    </tr>
                    <tr> 
                        <td>Company<span style="color: red;"> *</span></td>
                        <td> 
                            <select name="compnay" id="compnay" class="listbox-small">
                                <option value="0">--Select--</option>
                                <?php foreach ($company as $value) { ?>                            
                                    <option value="<?php echo $value['Id']; ?>"><?php echo $value['Alias']; ?></option>                            
                                <?php } ?>
                            </select>
                        </td>
                        <td>Company Number</td>
                        <td>
                            <input type="text" name="compnaynumber" id="compnaynumber" class="txtbox-small" readonly />
                        </td>
                        <td>Prefix<span style="color: red;"> *</span></td>
                        <td> 
                            <select name="prefix" id="prefix" class="listbox-small">
                                <option value="0">--Select--</option>
                            </select>
                        </td>
                    </tr>
                    <tr>
                        <td>Policy Effective Date<span style="color: red;"> *</span></td>
                        <td>
                            <input type="text" name="policyEffectiveDate" id="policyEffectiveDate" class="txtbox-small" readonly />
                        </td>
                        <td>Policy Expiry Date</td>
                        <td>
                            <input type="text" name="policyExpiryDate" id="policyExpiryDate" class="txtbox-small" readonly />
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
                            <select name="premiumcurrency" id="premiumcurrency" class="listbox-small">
                                <option value="0">--Select--</option>
                                <?php foreach ($premiumCurrency as $value) { ?>                            
                                    <option value="<?php echo $value['Id']; ?>"><?php echo $value['LookupTypeName']; ?></option>                            
                                <?php } ?>
                            </select>
                        </td>
                        <td width="12%">Inception Gross Premium<span style="color: red;"> *</span></td>
                        <td width="22%">
                            <input type="text" name="inceptiongrosspremium" id="inceptiongrosspremium" class="txtbox-small" />
                        </td>
                        <td width="12%">Commission %<span style="color: red;"> *</span></td>
                        <td width="22%">
                            <input type="text" name="comissionpercentage" id="comissionpercentage" class="txtbox-small" />
                        </td>
                    </tr>
                    <tr>
                        <td width="12%">Commission $</td>
                        <td width="22%">
                            <input type="text" name="comissiondoller" id="comissiondoller" class="txtbox-small" readonly />
                        </td>
                        <td>Net Premium</td>
                        <td>
                            <input type="text" name="netpremium" id="netpremium" class="txtbox-small" readonly />
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
                    <input type="submit" value="Submit" class="btn btn-blue" id="policySubmit" name="policySubmit" />
                    <input type="reset" value="Cancel" onclick="location.href = '<?php echo url_for('@policy_list') ?>';" class="btn btn-cyan" />
                </td>
            </tr>
        </table>
    </div>
</form>