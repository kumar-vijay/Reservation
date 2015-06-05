<div class="breadcrumbs group"> 
    <ul id="breadcrumb">
        <li><a href="/">Home</a><span> >>&nbsp; </span></li>
        <li><a href="/admin/masterDataManagement">Master Data Management</a><span> >>&nbsp; </span></li>
        <li><a href="/admin/broker">Manage Broker</a><span> >>&nbsp; </span></li>
        <li class="selected">Edit Broker Details</li>
    </ul>
    <a href="/admin/broker" id="back"></a>
</div>
<div class="clear"></div>

<div class="container">
    <div class="box">
        <h1 class="section-header">Broker Details
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
            <form method="POST" action="" name="brokerEditForm" id="brokerEditForm">
                <table width="100%" border="0" cellspacing="0" cellpadding="0">
                    <tr>
                        <td width="12%">Broker Name<span style="color: red;"> *</span></td>
                        <td width="22%"><input type="text" name="editbrokername" id="editbrokername" class="txtbox-small" value="<?php echo $brokerInfo->BrokerName; ?>"/></td>
                        <td width="12%">Wholesaler/Retailer<span style="color: red;"> *</span></td>
                        <td width="22%">
                            <select name="editbrokertype" id="editbrokertype" class="listbox-small">
                                <option value="">--Select--</option>
                                <?php
                                    foreach ($brokerType as $value) {
                                        if ($brokerInfo->BrokerType == $value['Id'])
                                            $select = 'selected="selected"';
                                        else
                                            $select = '';
                                        ?>
                                        <option value="<?php echo $value['Id'] ?>" <?php echo $select; ?> ><?php echo $value['Alias'] ?></option>
                                 <?php } ?>
                            </select>
                        </td>
                        <td width="12%">Broker Sub-Type<span style="color: red;"> *</span></td>
                        <td width="22%"> 
                            <select name="editbrokersubtype" id="editbrokersubtype" class="listbox-small">
                                <option value="">--Select--</option>
                                 <?php
                                    foreach ($brokerSubType as $value) {
                                        if ($brokerInfo->BrokerSubType == $value['Id'])
                                            $select = 'selected="selected"';
                                        else
                                            $select = '';
                                        ?>
                                        <option value="<?php echo $value['Id'] ?>" <?php echo $select; ?> ><?php echo $value['Alias'] ?></option>
                                <?php } ?>
                            </select>
                        </td>
                    </tr>
                    <tr> 
                        <td>Broker Country<span style="color: red;"> *</span></td>
                        <td> 
                            <select name="editbrokercountry" id="editbrokercountry" class="listbox-small">
                                <option value="">--Select--</option>
                                    <?php
                                    foreach ($country as $value) {
                                        if ($brokerInfo->Country == $value['Id'])
                                            $select = 'selected="selected"';
                                        else
                                            $select = '';
                                        ?>
                                        <option value="<?php echo $value['Id'] ?>" <?php echo $select; ?> ><?php echo $value['InsuredCountry'] ?></option>
                                    <?php } ?>
                           </select>
                        </td>
                        <td>Broker State<span style="color: red;"> *</span></td>
                        <td> 
                            <select name="editbrokerstate" id="editbrokerstate" class="listbox-small">
                                <option value="0">--Select--</option>
                            </select>
                            <input type="hidden" id="editStateHidden" value="<?php echo $brokerInfo->State; ?>">
                        </td>
                        <td>Broker City<span style="color: red;"> *</span></td>
                        <td> 
                            <select name="editbrokercity" id="editbrokercity" class="listbox-small">
                                <option value="0">--Select--</option>
                            </select>
                            <input type="hidden" id="editCityHidden" value="<?php echo $brokerInfo->City; ?>">
                        </td>
                    </tr>
                    <tr>
                        <td>Address Line1</td>
                        <td>
                            <input type="text" name="editaddressline1" id="editaddressline1" class="txtbox-small" value="<?php echo trim($brokerInfo->AddressLine1); ?>" />
                        </td>
                        <td>Address Line2</td>
                        <td>
                            <input type="text" name="editaddressline2" id="editaddressline2" class="txtbox-small" value="<?php echo trim($brokerInfo->AddressLine2); ?>" />
                        </td>
                        <td>Zipcode</td>
                        <td>
                            <input type="text" name="editbrokerzipcode" id="editbrokerzipcode" class="txtbox-small" value="<?php echo trim($brokerInfo->ZipCode); ?>" />
                        </td>
                    </tr>
                    <tr>
                        <td>5-digit Broker Code<span style="color: red;"> *</span></td>
                        <td>
                            <input type="text" name="editbrokercode" id="editbrokercode" class="txtbox-small" value="<?php echo trim($brokerInfo->BrokerCode); ?>"/>
                        </td>
                    </tr>
                    <tr>
                        <input type="hidden" id="editDataRecorderIdHidden" name="editDataRecorderIdHidden" value="<?php echo $brokerInfo->DataId; ?>">
                        <input type="hidden" id="editBrokerWiseIdHidden" name="editBrokerWiseIdHidden" value="<?php echo $brokerInfo->BrokerWiseId; ?>">
                        <td colspan="6" align="center">
                            <input type="submit" value="Submit" class="btn btn-blue" id="editbrokerSubmit" name="editbrokerSubmit" />
                            <input type="reset" value="Cancel" onclick="location.href = '<?php echo url_for('@broker_list') ?>';" class="btn btn-cyan" />
                        </td>
                    </tr>
                </table>
            </form>
        </div>
    </div>
</div>