<div class="breadcrumbs group"> 
    <ul id="breadcrumb">
        <li><a href="/">Home</a><span> >>&nbsp; </span></li>
        <li><a href="/admin/masterDataManagement">Master Data Management</a><span> >>&nbsp; </span></li>
        <li><a href="/admin/city">Manage City</a><span> >>&nbsp; </span></li>
        <li class="selected">Edit City Details</li>
    </ul>
    <a href="/admin/city" id="back"></a>
</div>
<div class="clear"></div>

<div class="container">
    <div class="box">
        <h1 class="section-header">City Details
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
            <form method="POST" action="" name="cityEditForm" id="cityEditForm">
                <table width="100%" border="0" cellspacing="0" cellpadding="0">
                    <tr>
                        <td width="12%">State Name</td>
                        <td width="22%">
                            <select name="editstatename" id="editstatename" class="listbox-small" disabled>
                                <option value="">--Select--</option>
                                <?php
                                    foreach ($state as $value) {
                                        if ($cityInfo[0]['StateId'] == $value['Id'])
                                            $select = 'selected="selected"';
                                        else
                                            $select = '';
                                        ?>
                                        <option value="<?php echo $value['Id'] ?>" <?php echo $select; ?> ><?php echo $value['FullCode'] ?></option>
                                 <?php } ?>
                            </select>
                        </td>
                        <td width="12%">City Name</td>
                        <td width="22%"><input type="text" name="editcityname" id="editcityname" class="txtbox-small" autocomplete="off" value="<?Php echo trim($cityInfo[0]['City']);?>" readonly/></td>
                        <td width="12%">City Code<span style="color: red;"> *</span></td>
                        <td width="22%"><input type="text" name="editcitycode" id="editcitycode" class="txtbox-small" autocomplete="off" value="<?Php echo trim($cityInfo[0]['CityCode']);?>" /></td>
                    </tr>
                    <tr>
                        <td width="12%">Broker City Name</td>
                        <td width="22%"><input type="text" name="editbrokerstatename" id="editbrokerstatename" class="txtbox-small" autocomplete="off" readonly value="<?Php echo trim($cityInfo[0]['CityFullCode']);?>"/></td>
                        <td width="12%">Retail Broker City Name</td>
                        <td width="22%"><input type="text" name="editretailbrokerstatename" id="editretailbrokerstatename" class="txtbox-small" autocomplete="off" readonly value="<?Php echo trim($cityInfo[0]['RetailBrokerCity']);?>"/></td>
                    </tr>
                    <tr>
                    <input type="hidden" id="editDataRecorderIdHidden" name="editDataRecorderIdHidden" value="<?php echo trim($cityInfo[0]['DataRecorderMetaDataId']); ?>">
                    <input type="hidden" id="editCityCodeHidden" name="editCityCodeHidden" value="<?php echo trim($cityInfo[0]['CityCode']); ?>">
                    <td colspan="6" align="center">
                        <input type="submit" value="Submit" class="btn btn-blue" id="editcitySubmit" name="editcitySubmit" />
                        <input type="reset" value="Cancel" onclick="location.href = '<?php echo url_for('@city_list') ?>';" class="btn btn-cyan" />
                    </td>
                    </tr>
                </table>
            </form>
        </div>
    </div>
</div>