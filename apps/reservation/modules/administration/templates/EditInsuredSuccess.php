<div id="content">
    <div class="breadcrumbs group"> 
        <ul id="breadcrumb">
            <li><a href="/">Home</a><span> >>&nbsp; </span></li>
            <li><a href="/admin/masterDataManagement">Master Data Management</a><span> >>&nbsp; </span></li>
            <li><a href="/admin/insured">Manage Insured</a><span> >>&nbsp; </span></li>
            <li class="selected">Edit Insured Details</li>
        </ul>
        <a href="/admin/insured" id="back"></a>
    </div>
    <div class="clear"></div>
    <form method="POST" action="" name="insuredEditForm" id="insuredEditForm" autocomplete="off">
        <div class="container">
            <div class="box">
                <h1 class="section-header">Insured Details
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
                            ?></div>
                        <?php
                    }
                    ?>
                    <?php if (isset($emptyValues) && !empty($emptyValues)): ?>
                        <span style="font-size:12pt; color: red;"> 
                           Please fill following fields before submit: <?php echo $emptyValues; ?>
                        </span>
                        <p>&nbsp;</p>
                     <?php endif; ?>
                    <table width="100%" border="0" cellspacing="0" cellpadding="0">
                        <tr>
                            <td width="12%">Parent Insured Name<span style="color: red;"> *</span></td>
                            <td width="22%"><input type="text" class="txtbox-small" value="<?php echo trim($Parent); ?>" readonly="readonly" /></td>
                            <td width="12%"></td>
                            <td width="22%"></td>
                            <td width="12%"></td>
                            <td width="22%"></td>
                        </tr>
                        <tr>
                            <td width="12%">Insured Name<span style="color: red;"> *</span></td>
                            <td width="22%"><input type="text" name="editinsuredname" id="editinsuredname" class="txtbox-small" value="<?php echo trim($induredInfo->InsuredName); ?>" /></td>
                            <td width="12%">Address Line 1<span style="color: red;"> *</span></td>
                            <td width="22%"><input type="text" name="editinsuredaddress" id="editinsuredaddress" class="txtbox-small" value="<?php echo trim($induredInfo->AddressLine1); ?>" maxlength="70" /></td>
                            <td width="12%">Country<span style="color: red;"> *</span></td>
                            <td width="22%">
                                <input type="text" name="editinsuredcountry" id="editinsuredcountry" class="listbox-small" value="<?php echo trim($induredInfo->Country); ?>" maxlength="30" />
                            </td>
                        </tr>
                        <tr>
                            <td>State<span style="color: red;"> *</span></td>
                            <td> 
                                <input type="text" name="editinsuredstate" id="editinsuredstate" class="listbox-small" value="<?php echo trim($induredInfo->State); ?>" maxlength="30" />
                            </td>
                            <td>City<span style="color: red;"> *</span></td>
                            <td> 
                                <input type="text" name="editinsuredcity" id="editinsuredcity" class="listbox-small" value="<?php echo trim($induredInfo->City); ?>" maxlength="30" />
                            </td>
                            <td>Zipcode</td>
                            <td>
                                <input type="text" name="editinsuredzipcode" id="editinsuredzipcode" class="txtbox-small" value="<?php echo trim($induredInfo->Zip); ?>" />
                            </td>
                        </tr>
                        <tr>
                            <td>Advisen ID</td>
                            <td>
                                <input type="text" name="editadvisenId" id="editadvisenId" class="txtbox-small" value="<?php if($induredInfo->AdvisenId != 0){ echo trim($induredInfo->AdvisenId);} else { echo "";} ?>" />
                            </td>
                            <td>D&B Number<span style="color: red;"> *</span></td>
                            <td>
                                <input type="text" name="editdbNumber" id="editdbNumber" class="txtbox-small" value="<?php echo trim($induredInfo->DBNumber); ?>" />
                            </td>
                            <td>Status<span style="color: red;"> *</span></td>
                            <td>
                                <select name="editstatus" id="editstatus" class="listbox-small">
                                    <?php
                                    foreach ($status as $value) {
                                        if ($induredInfo->InsuredStatus == $value['LookupName'])
                                            $select = 'selected="selected"';
                                        else
                                            $select = '';
                                    ?>
                                    <option value="<?php echo $value['LookupName'] ?>" <?php echo $select; ?> ><?php echo $value['LookupName'] ?></option>
                                    <?php } ?>
                                </select>
                            </td>
                        </tr>
                        <span style="color:blue;margin-left:20px;">*Country should be filled as "Code - Country Name" example "001 - USA"</span><br/>
                        <span style="color:blue;margin-left:20px;">*State should be entered as "Code-Acronym for state". Example: "29-NJ" </span><br/>
                        <span style="color:blue;margin-left:20px;">*City should be entered without any code "New York".</span><br/>
                        <span style="color:red;margin-left:20px;">*Ensure you are entering correct spelling</span>  
                    </table>
                </div>
            </div>
        </div>
        <div class="container">
            <div class="box">
                <h1 class="section-header">Global Ultimate Parent (GUP) Details
                    <div class="arrow"></div>
                </h1>
                <div class="content" style="display: block;">
                    <table width="100%" border="0" cellspacing="0" cellpadding="0">
                        <tr>
                            <td width="12%">GUP  Advisen ID</td>
                            <td width="22%"><input type="text" name="editgupadvisenid" id="editgupadvisenid" class="txtbox-small" maxlength="10" value="<?php if($induredInfo->ReferenceId != 0){ echo trim($induredInfo->ReferenceId);}else {echo "";} ?>"/></td>
                            <td width="12%">GUP Name</td>
                            <td width="22%"><input type="text" name="editgupname" id="editgupname" class="txtbox-small" maxlength="50" value="<?php echo trim($induredInfo->AdvisenUltimateParentCompanyNa); ?>" /></td>
                            <td width="12%">GUP Address Line 1</td>
                            <td width="22%"> 
                                <input type="text" name="editgupaddressline1" id="editgupaddressline1" class="listbox-small" maxlength="50" value="<?php echo trim($induredInfo->UltimateParentStreetAddress1); ?>" />
                            </td>
                        </tr>
                        <tr> 
                            <td>GUP Country</td>
                            <td> 
                                <select name="editgupcountry" id="editgupcountry" class="listbox-small">
                                    <option value="0">--Select--</option>
                                    <?php
                                    foreach ($country as $value) {
                                        if ($induredInfo->UltimateParentCountry == $value['UltimateParentCountry'])
                                            $select = 'selected="selected"';
                                        else
                                            $select = '';
                                        ?>
                                        <option value="<?php echo $value['UltimateParentCountry'] ?>" <?php echo $select; ?> ><?php echo $value['UltimateParentCountry'] ?></option>
                                    <?php } ?>
                                </select>
                            </td>
                            <td>GUP State</td>
                            <td> 
                                <select name="editgupstate" id="editgupstate" class="listbox-small">
                                    <option value="0">--Select--</option>
                                    <?php
                                    foreach ($states as $value) {
                                        if ($induredInfo->UltimateParentState == $value['UltimateParentState'])
                                            $select = 'selected="selected"';
                                        else
                                            $select = '';
                                        ?>
                                        <option value="<?php echo $value['UltimateParentState'] ?>" <?php echo $select; ?> ><?php echo $value['UltimateParentState'] ?></option>
                                    <?php } ?>
                                </select>
                            </td>
                            <td>GUP City</td>
                            <td>
                                <select name="editgupcity" id="editgupcity" class="listbox-small">
                                    <option value="0">--Select--</option>
                                    <?php
                                    foreach ($city as $value) {
                                        if ($induredInfo->UltimateParentCity == $value['UltimateParentCity'])
                                            $select = 'selected="selected"';
                                        else
                                            $select = '';
                                        ?>
                                        <option value="<?php echo $value['UltimateParentCity'] ?>" <?php echo $select; ?> ><?php echo $value['UltimateParentCity'] ?></option>
                                    <?php } ?>
                                </select>
                            </td>
                        </tr>
                        <tr>
                            <td>GUP Zipcode</td>
                            <td>
                                <input type="text" name="editgupzipcode" id="editgupzipcode" class="txtbox-small" maxlength="10" value="<?php echo trim($induredInfo->UltimateParentZip); ?>" />
                            </td>
                            <td>GUP Phone Number</td>
                            <td>
                                <input type="text" name="editgupphonenumber" id="editgupphonenumber" class="txtbox-small" maxlength="11" value="<?php echo trim($induredInfo->UltimateParentPhone); ?>" />
                            </td>
                        </tr>
                    </table>
                </div>
            </div>
        </div>
        <div class="container">
            <p class="btn-warning">Please ensure that you have filled up all the mandatory fields on the page. Please check the sections you have minimized as well.</p>
            <table width="100%" cellpadding="0" cellspacing="0">
                <tr>
                    <td colspan="6" align="center">
                        <input type="submit" value="Submit" class="btn btn-blue" id="editFormSubmit" />
                        <input type="hidden" name="insuredId" value="<?php echo $induredInfo->Id; ?>" />
                        <input type="hidden" name="recorderId" value="<?php echo $induredInfo->DataRecorderMetaDataId; ?>" />
                        <input type="reset" value="Back" onclick="location.href = '<?php echo url_for('@insured_list') ?>';" class="btn btn-cyan" />
                    </td>
                </tr>
            </table>
        </div>
    </form>
</div>