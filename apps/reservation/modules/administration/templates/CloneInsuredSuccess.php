<div id="content">
    <div class="breadcrumbs group"> 
        <ul id="breadcrumb">
            <li><a href="/">Home</a><span> >>&nbsp; </span></li>
            <li><a href="/admin/masterDataManagement">Master Data Management</a><span> >>&nbsp; </span></li>
            <li><a href="/admin/insured">Manage Insured</a><span> >>&nbsp; </span></li>
            <li class="selected">Clone Insured Details</li>
        </ul>
        <a href="/admin/insured" id="back"></a>
    </div>
    <div class="clear"></div>
    <form method="POST" action="" name="insuredAddForm" id="insuredAddForm" autocomplete="off">
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
                    <table width="100%" border="0" cellspacing="0" cellpadding="0">
                        <tr>
                            <td width="12%">Parent Insured Name<span style="color: red;"> *</span></td>
                            <td width="22%"><input type="text" name="parentinsuredname" id="parentinsuredname" class="txtbox-small" readonly="readonly" value="<?php echo $induredInfo->InsuredName ?>"/></td>
                            <td width="12%"</td>
                            <td width="22%"></td>
                            <td width="12%"></td>
                            <td width="22%"></td>
                        </tr>
                        <tr>
                            <td width="12%">Insured Name<span style="color: red;"> *</span></td>
                            <td width="22%"><input type="text" name="insuredname" id="insuredname" class="txtbox-small" /></td>
                            <td width="12%">Address Line 1<span style="color: red;"> *</span></td>
                            <td width="22%"><input type="text" name="insuredaddress" id="insuredaddress" class="txtbox-small"  maxlength="70" /></td>
                            <td width="12%">Country<span style="color: red;"> *</span></td>
                            <td width="22%">
                                <input type="text" name="insuredcountry" id="insuredcountry" class="listbox-small"  maxlength="30" />
                            </td>
                        </tr>
                        <tr>
                            <td>State<span style="color: red;"> *</span></td>
                            <td> 
                                <input type="text" name="insuredstate" id="insuredstate" class="listbox-small"  maxlength="30" />
                            </td>
                            <td>City<span style="color: red;"> *</span></td>
                            <td> 
                                <input type="text" name="insuredcity" id="insuredcity" class="listbox-small"  maxlength="30" />
                            </td>
                            <td>Zipcode</td>
                            <td>
                                <input type="text" name="insuredzipcode" id="insuredzipcode" class="txtbox-small" />
                            </td>
                        </tr>
                        <tr>
                            <td>Advisen ID</td>
                            <td>
                                <input type="text" name="advisenId" id="advisenId" class="txtbox-small" />
                            </td>
                            <td>D&B Number<span style="color: red;"> *</span></td>
                            <td>
                                <input type="text" name="dbNumber" id="dbNumber" class="txtbox-small" />
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
                            <td width="22%"><input type="text" name="gupadvisenid" id="gupadvisenid" class="txtbox-small" maxlength="10" /></td>
                            <td width="12%">GUP Name</td>
                            <td width="22%"><input type="text" name="gupname" id="gupname" class="txtbox-small" maxlength="50" /></td>
                            <td width="12%">GUP Address Line 1</td>
                            <td width="22%"> 
                                <input type="text" name="gupaddressline1" id="gupaddressline1" class="listbox-small" maxlength="50" />
                            </td>
                        </tr>
                        <tr> 
                            <td>GUP Country</td>
                            <td> 
                                <select name="gupcountry" id="gupcountry" class="listbox-small">
                                    <option value="0">--Select--</option>
                                    <?php
                                    foreach ($country as $value) { ?>
                                        <option value="<?php echo $value['UltimateParentCountry'] ?>" ><?php echo $value['UltimateParentCountry'] ?></option>
                                    <?php } ?>
                                </select>
                            </td>
                            <td>GUP State</td>
                            <td> 
                                <select name="gupstate" id="gupstate" class="listbox-small">
                                    <option value="0">--Select--</option>
                                    <?php
                                    foreach ($states as $value) { ?>
                                        <option value="<?php echo $value['UltimateParentState'] ?>" ><?php echo $value['UltimateParentState'] ?></option>
                                    <?php } ?>
                                </select>
                            </td>
                            <td>GUP City</td>
                            <td>
                                <select name="gupcity" id="gupcity" class="listbox-small">
                                    <option value="0">--Select--</option>
                                    <?php
                                    foreach ($city as $value) { ?>
                                        <option value="<?php echo $value['UltimateParentCity'] ?>"><?php echo $value['UltimateParentCity'] ?></option>
                                    <?php } ?>
                                </select>
                            </td>
                        </tr>
                        <tr>
                            <td>GUP Zipcode</td>
                            <td>
                                <input type="text" name="gupzipcode" id="gupzipcode" class="txtbox-small" maxlength="10" />
                            </td>
                            <td>GUP Phone Number</td>
                            <td>
                                <input type="text" name="gupphonenumber" id="gupphonenumber" class="txtbox-small" maxlength="11" />
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
                        <input type="hidden" name="parentinsuredId" value="<?php echo $induredInfo->Id; ?>" />
                        <input type="reset" value="Back" onclick="location.href = '<?php echo url_for('@insured_list') ?>';" class="btn btn-cyan" />
                    </td>
                </tr>
            </table>
        </div>
    </form>
</div>