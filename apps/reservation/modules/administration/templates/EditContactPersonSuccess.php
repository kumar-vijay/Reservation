<div class="breadcrumbs group"> 
    <ul id="breadcrumb">
        <li><a href="/">Home</a><span> >>&nbsp; </span></li>
        <li><a href="/admin/masterDataManagement">Master Data Management</a><span> >>&nbsp; </span></li>
        <li><a href="/admin/contactperson">Manage Contact Person</a><span> >>&nbsp; </span></li>
        <li class="selected">Edit Contact Person Details</li>
    </ul>
    <a href="/admin/contactperson" id="back"></a>
</div>
<div class="clear"></div>

<div class="container">
    <div class="box">
        <h1 class="section-header">Contact Person Details
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
            <form method="POST" action="" name="editcontactpersonAddForm" id="editcontactpersonAddForm">
                <table width="100%" border="0" cellspacing="0" cellpadding="0">
                    <tr>
                        <td width="12%">Party Type<span style="color: red;"> *</span></td>
                        <td width="22%">
                            <select name="editpertytype" id="editpertytype" class="listbox-small">
                                <option value="0">--Select--</option>
                                    <?php foreach ($partyType as $value){
                                        if ($contactPersonInfo->PartyTypeId == $value['Id'])
                                            $select = 'selected="selected"';
                                        else
                                            $select = '';
                                        ?>
                                        <option value="<?php echo $value['Id']; ?>" <?php echo $select; ?> ><?php echo $value['Alias']; ?></option>                            
                                    <?php } ?>
                            </select>
                        <td width="12%">Company Name<span style="color: red;"> *</span></td>
                        <td width="22%"><input type="text" name="editcompanyname" id="editcompanyname" class="txtbox-small" value="<?php echo $company ?>"/></td>
                        <td width="12%">Title</td>
                        <td width="22%"> 
                            <input type="text" name="edittitle" id="edittitle" class="txtbox-small" value="<?php echo trim($contactPersonInfo->Title); ?>" />
                        </td>
                    </tr>
                    <tr> 
                        <td>First Name<span style="color: red;"> *</span></td>
                        <td> 
                           <input type="text" name="editfirstname" id="editfirstname" class="txtbox-small" value="<?php echo trim($contactPersonInfo->FirstName); ?>" />
                        </td>
                        <td>Last Name<span style="color: red;"> *</span></td>
                        <td> 
                           <input type="text" name="editlastname" id="editlastname" class="txtbox-small" value="<?php echo trim($contactPersonInfo->LastName); ?>" />
                        </td>
                        <td>Function</td>
                        <td> 
                           <input type="text" name="editfunction" id="editfunction" class="txtbox-small" value="<?php echo trim($contactPersonInfo->PartyFunction); ?>" />
                        </td>
                    </tr>
                    <tr>
                        <td>Email Address<span style="color: red;"> *</span></td>
                        <td>
                            <input type="text" name="editemailaddress" id="editemailaddress" class="txtbox-small" value="<?php echo trim($contactPersonInfo->Email); ?>" />
                        </td>
                        <td>Phone Number<span style="color: red;"> *</span></td>
                        <td>
                            <input type="text" name="editphonenumber" id="editphonenumber" class="txtbox-small" value="<?php  echo trim($contactPersonInfo->PhoneNumber); ?>" />
                        </td>
                        <td>Mobile Number</td>
                        <td>
                            <input type="text" name="editmobilenumber" id="editmobilenumber" class="txtbox-small" value="<?php echo trim($contactPersonInfo->MobileNumber); ?>" />
                        </td>
                    </tr>
                    <tr>
                        <td>Fax</td>
                        <td>
                            <input type="text" name="editfax" id="editfax" class="txtbox-small" value="<?php echo trim($contactPersonInfo->Fax); ?>" />
                        </td>
                    </tr>
                    <tr>
                        <td colspan="6" align="center">
                            <input type="hidden" name="dataRecorderDataIdHidden" id="dataRecorderDataIdHidden" value="<?php echo $contactPersonInfo->DataRecorderMetaDataId ?>">
                            <input type="hidden" name="hiddenPartyType" id="hiddenPartyType" value="<?php echo $contactPersonInfo->PartyTypeId ?>">
                            <input type="submit" value="Submit" class="btn btn-blue" id="editcontactpersonSubmit" name="editcontactpersonSubmit" />
                            <input type="reset" value="Cancel" onclick="location.href = '<?php echo url_for('@contactperson_list') ?>';" class="btn btn-cyan" />
                        </td>
                    </tr>
                </table>
            </form>
        </div>
    </div>
</div>