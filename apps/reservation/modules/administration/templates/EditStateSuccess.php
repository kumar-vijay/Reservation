<div class="breadcrumbs group"> 
    <ul id="breadcrumb">
        <li><a href="/">Home</a><span> >>&nbsp; </span></li>
        <li><a href="/admin/masterDataManagement">Master Data Management</a><span> >>&nbsp; </span></li>
        <li><a href="/admin/state">Manage State</a><span> >>&nbsp; </span></li>
        <li class="selected">Edit State Details</li>
    </ul>
    <a href="/admin/state" id="back"></a>
</div>
<div class="clear"></div>

<div class="container">
    <div class="box">
        <h1 class="section-header">State Details
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
            <form method="POST" action="" name="stateEditForm" id="stateEditForm">
                <table width="100%" border="0" cellspacing="0" cellpadding="0">
                    <tr>
                        <td width="12%">Country Name</td>
                        <td width="22%">
                            <select name="editcountryname" id="editcountryname" class="listbox-small" disabled>
                                <option value="">--Select--</option>
                                <?php
                                    foreach ($country as $value) {
                                        if ($stateInfo[0]['CountryId'] == $value['Id'])
                                            $select = 'selected="selected"';
                                        else
                                            $select = '';
                                        ?>
                                        <option value="<?php echo $value['Id'] ?>" <?php echo $select; ?> ><?php echo $value['InsuredCountry'] ?></option>
                                 <?php } ?>
                            </select>
                        </td>
                        <td width="12%">State Name</td>
                        <td width="22%"><input type="text" name="editstatename" id="editstatename" class="txtbox-small" autocomplete="off" value="<?Php echo trim($stateInfo[0]['StateName']);?>" readonly/></td>
                        <td width="12%">Broker State Code<span style="color: red;"> *</span></td>
                        <td width="22%"><input type="text" name="editbrokerstatecode" id="editbrokerstatecode" class="txtbox-small" autocomplete="off" value="<?Php echo trim($stateInfo[0]['Code']);?>" /></td>
                    </tr>
                    <tr>
                        <td width="12%">Broker State Name</td>
                        <td width="22%"><input type="text" name="editbrokerstatename" id="editbrokerstatename" class="txtbox-small" autocomplete="off" readonly value="<?Php echo trim($stateInfo[0]['FullCode']);?>"/></td>
                        <td width="12%">Retail Broker State Name</td>
                        <td width="22%"><input type="text" name="editretailbrokerstatename" id="editretailbrokerstatename" class="txtbox-small" autocomplete="off" readonly value="<?Php echo trim($stateInfo[0]['RetailBrokerState']);?>"/></td>
                        <td width="12%">State Abbreviation</td>
                        <td width="22%"><input type="text" name="editabbreviation" id="editabbreviation" class="txtbox-small" autocomplete="off" maxlength="2" value="<?Php echo trim($stateInfo[0]['Abreviation']);?>" readonly/></td>
                    </tr>
                    <tr>
                        <td width="12%">Abbreviated Broker State Name</td>
                        <td width="22%"><input type="text" name="editabbreviatedbrokerstatename" id="editabbreviatedbrokerstatename" class="txtbox-small" autocomplete="off" readonly value="<?Php echo trim($stateInfo[0]['StateCode']);?>"/></td>
                        <td width="12%">Project State Code<span style="color: red;"> *</span></td>
                        <td width="22%"><input type="text" name="editprojectstatecode" id="editprojectstatecode" class="txtbox-small" autocomplete="off" value="<?Php echo trim($stateInfo[0]['ProjectStateCode']);?>"/></td>
                        <td width="12%">Project State Name</td>
                        <td width="22%"><input type="text" name="editprojectstatename" id="editprojectstatename" class="txtbox-small" autocomplete="off" readonly value="<?Php echo trim($stateInfo[0]['ProjectCode']);?>"/></td>
                    </tr>
                    <tr>
                    <input type="hidden" id="editDataRecorderIdHidden" name="editDataRecorderIdHidden" value="<?php echo trim($stateInfo[0]['DataRecorderMetaDataId']); ?>">
                    <input type="hidden" id="editcountryNameHidden" name="editcountryNameHidden" value="<?php echo trim($stateInfo[0]['CountryId']); ?>">
                    <input type="hidden" id="editstateCodeHidden" name="editstateCodeHidden" value="<?php echo trim($stateInfo[0]['Code']); ?>">
                    <input type="hidden" id="editprojectCodeHidden" name="editprojectCodeHidden" value="<?php echo trim($stateInfo[0]['ProjectStateCode']); ?>">
                    <td colspan="6" align="center">
                        <input type="submit" value="Submit" class="btn btn-blue" id="editstateSubmit" name="editstateSubmit" />
                        <input type="reset" value="Cancel" onclick="location.href = '<?php echo url_for('@state_list') ?>';" class="btn btn-cyan" />
                    </td>
                    </tr>
                </table>
            </form>
        </div>
    </div>
</div>