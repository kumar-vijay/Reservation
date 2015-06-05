<div id="content">
    <div class="breadcrumbs group"> 
        <ul id="breadcrumb">
            <li><a href="/">Home</a><span> >>&nbsp; </span></li>
            <li><a href="/admin/masterDataManagement">Master Data Management</a><span> >>&nbsp; </span></li>
            <li><a href="/admin/insured">Manage Insured</a><span> >>&nbsp; </span></li>
            <li class="selected">View Insured Details</li>
        </ul>
        <a href="/admin/insured" id="back"></a>
    </div>
    <div class="clear"></div>

    <div class="container">
        <div class="box">
            <h1 class="section-header">Insured Details
                <div class="arrow"></div>
            </h1>
            <div class="content adminview" style="display: block;">
                <table width="100%" border="0" cellspacing="0" cellpadding="0">
                    <tr>
                        <td width="12%">Parent Insured Name</td>
                        <td width="22%"><?php echo $Parent; ?></td>
                        <td width="12%"></td>
                        <td width="22%"></td>
                        <td width="12%"></td>
                        <td width="22%"></td> 
                    </tr>
                    <tr>
                        <td width="12%">Insured Name</td>
                        <td width="22%"><?php echo $induredInfo->InsuredName; ?></td>
                        <td width="12%">Address Line 1</td>
                        <td width="22%"><?php echo $induredInfo->AddressLine1; ?></td>
                        <td width="12%">Country</td>
                        <td width="22%"><?php echo $induredInfo->Country; ?></td> 
                    </tr>
                    <tr>
                        <td>State</td>
                        <td><?php echo $induredInfo->State; ?></td> 
                        <td>City</td>
                        <td><?php echo $induredInfo->City; ?></td> 
                        <td>Zipcode</td>
                        <td>
                            <?php echo $induredInfo->Zip; ?>
                        </td>
                    </tr>
                    <tr>
                        <td>Advisen ID</td>
                        <td>
                            <?php echo $induredInfo->AdvisenId; ?>
                        </td>
                        <td>D&B Number</td>
                        <td>
                            <?php echo $induredInfo->DBNumber; ?>
                        </td>
                        <td>Status </td>
                        <td>
                            <?php echo $induredInfo->InsuredStatus; ?>
                        </td>
                    </tr>
                </table>
            </div>
        </div>
    </div>
    
    <div class="container">
        <div class="box">
            <h1 class="section-header">Global Ultimate Parent (GUP) Details
                <div class="arrow"></div>
            </h1>
            <div class="content adminview" style="display: block;">
                <table width="100%" border="0" cellspacing="0" cellpadding="0">
                    <tr>
                        <td width="12%">GUP  Advisen ID</td>
                        <td width="22%"><?php if($induredInfo->ReferenceId != '0'){ echo $induredInfo->ReferenceId;} else {echo "";} ?></td>
                        <td width="12%" style="word-wrap: break-word; word-break: break-all;white-space: normal;">GUP Name</td>
                        <td width="22%" style="word-wrap: break-word; word-break: break-all;white-space: normal;"><?php echo $induredInfo->AdvisenUltimateParentCompanyNa; ?></td>
                        <td width="12%" style="word-wrap: break-word; word-break: break-all;white-space: normal;">GUP Address Line 1</td>
                        <td width="22%"><?php echo $induredInfo->UltimateParentStreetAddress1; ?></td> 
                    </tr>
                    <tr>
                        <td>GUP Country</td>
                        <td><?php if($induredInfo->UltimateParentCountry != '0'){ echo $induredInfo->UltimateParentCountry;} else {echo "";} ?></td> 
                        <td>GUP State</td>
                        <td><?php if($induredInfo->UltimateParentState != '0'){ echo $induredInfo->UltimateParentState;} else {echo "";} ?></td> 
                        <td>GUP City</td>
                        <td>
                            <?php if($induredInfo->UltimateParentCity != '0'){ echo $induredInfo->UltimateParentCity;} else {echo "";} ?>
                        </td>
                    </tr>
                    <tr>
                        <td>GUP Zipcode</td>
                        <td>
                            <?php echo $induredInfo->UltimateParentZip; ?>
                        </td>
                        <td>GUP Phone Number</td>
                        <td>
                            <?php echo $induredInfo->UltimateParentPhone; ?>
                        </td>
                    </tr>
                </table>
            </div>
        </div>
    </div>
    
    <div class="container">
        <table width="100%" cellpadding="0" cellspacing="0">
            <tr>
                <td colspan="6" align="center">
                    <input type="reset" value="Back" onclick="location.href = '<?php echo url_for('@insured_list') ?>';" class="btn btn-blue" />
                </td>
            </tr>
        </table>
    </div>
</div>