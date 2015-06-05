<div class="breadcrumbs group"> 
    <ul id="breadcrumb">
        <li><a href="/">Home</a><span> >>&nbsp; </span></li>
        <li><a href="/admin/masterDataManagement">Master Data Management</a><span> >>&nbsp; </span></li>
        <li><a href="/admin/renewalreference">Manage Renewal Reference</a><span> >>&nbsp; </span></li>
        <li class="selected">Edit Renewal Reference Details</li>
    </ul>
    <a href="/admin/renewalreference" id="back"></a>
</div>
<div class="clear"></div>

<div class="container">
    <div class="box">
        <h1 class="section-header">Renewal Reference Details
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
            <form method="POST" action="" name="editReferalReferenceForm" id="editReferalReferenceForm">
                <table width="100%" border="0" cellspacing="0" cellpadding="0">
                    <tr>
                        <td width="12%">Submission Number<span style="color: red;"> *</span></td>
                        <td width="22%"><input type="text" name="editSubmissionNumber" id="editSubmissionNumber" class="txtbox-small" value="<?php echo trim($renewalReferenceInfo[0]['SubmissionNumber']); ?>" readonly/></td>
                        <td width="12%">Account Name<span style="color: red;"> *</span></td>
                        <td width="22%">
                            <select name="editAccountName" id="editAccountName" class="listbox-small" disabled>
                                <option value="0">--Select--</option>
                                <?php foreach ($accountName as $value){
                                        if ($renewalReferenceInfo[0]['InsuredId'] == $value['Id'])
                                            $select = 'selected="selected"';
                                        else
                                            $select = '';
                                        ?>
                                        <option value="<?php echo $value['Id']; ?>" <?php echo $select; ?> ><?php echo $value['InsuredName']; ?></option>                            
                                <?php } ?>
                            </select>
                        <td width="12%">Status<span style="color: red;"> *</span></td>
                        <td width="22%"> 
                            <select name="editStatus" id="editStatus" class="listbox-small" disabled>
                                <option value="0">--Select--</option>
                                    <?php foreach ($status as $value){
                                        if ($renewalReferenceInfo[0]['Status'] == $value['Id'])
                                            $select = 'selected="selected"';
                                        else
                                            $select = '';
                                        ?>
                                        <option value="<?php echo $value['Id']; ?>" <?php echo $select; ?> ><?php echo $value['StatusName']; ?></option>                            
                                    <?php } ?>
                            </select>
                        </td>
                    </tr>
                    <tr> 
                        <td>Renewable<span style="color: red;"> *</span></td>
                        <td> 
                           <select name="editRenewable" id="editRenewable" class="listbox-small">
                                <option value="0">--Select--</option>
                                    <?php foreach ($renewable as $value){
                                        if ($renewalReferenceInfo[0]['Renewable'] == $value['Id'])
                                            $select = 'selected="selected"';
                                        else
                                            $select = '';
                                        ?>
                                        <option value="<?php echo $value['Id']; ?>" <?php echo $select; ?> ><?php echo $value['Alias']; ?></option>                            
                                    <?php } ?>
                            </select>
                        </td>
                        <td>Date of Renewal<span style="color: red;"> *</span></td>
                        <td> 
                            <input type="text" name="editDateofRenewal" id="editDateofRenewal" class="txtbox-small" value="<?php echo date("m/d/Y", strtotime(trim($renewalReferenceInfo[0]['DateofRenewal']))) ; ?>" readonly />
                        </td>
                    </tr>
                    <tr>
                        <td colspan="6" align="center">
                            <input type="hidden" name="dataRecorderDataIdHidden" id="dataRecorderDataIdHidden" value="<?php echo $renewalReferenceInfo[0]['DataRecorderMetaDataId']; ?>">
                            <input type="submit" value="Submit" class="btn btn-blue" id="editRenewalSubmit" name="editRenewalSubmit" />
                            <input type="reset" value="Cancel" onclick="location.href = '<?php echo url_for('@reference_list') ?>';" class="btn btn-cyan" />
                        </td>
                    </tr>
                </table>
            </form>
        </div>
    </div>
</div>