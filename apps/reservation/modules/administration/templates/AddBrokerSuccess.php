<div class="breadcrumbs group"> 
    <ul id="breadcrumb">
        <li><a href="/">Home</a><span> >>&nbsp; </span></li>
        <li><a href="/admin/masterDataManagement">Master Data Management</a><span> >>&nbsp; </span></li>
        <li><a href="/admin/broker">Manage Broker</a><span> >>&nbsp; </span></li>
        <li class="selected">Add Broker Details</li>
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
            <form method="POST" action="" name="brokerAddForm" id="brokerAddForm">
                <table width="100%" border="0" cellspacing="0" cellpadding="0">
                    <tr>
                        <td width="12%">Broker Name<span style="color: red;"> *</span></td>
                        <td width="22%"><input type="text" name="brokername" id="brokername" class="txtbox-small" autocomplete="off"/></td>
                        <td width="12%">Wholesaler/Retailer<span style="color: red;"> *</span></td>
                        <td width="22%">
                            <select name="brokertype" id="brokertype" class="listbox-small">
                                <option value="0">--Select--</option>
                                    <?php foreach ($brokerType as $value){ ?>                            
                                        <option value="<?php echo $value['Id']; ?>"><?php echo $value['Alias']; ?></option>                            
                                    <?php } ?>
                            </select>
                        </td>
                        <td width="12%">Broker Sub-Type<span style="color: red;"> *</span></td>
                        <td width="22%"> 
                            <select name="brokersubtype" id="brokersubtype" class="listbox-small">
                                <option value="0">--Select--</option>
                                    <?php foreach ($brokerSubType as $value){ ?>                            
                                        <option value="<?php echo $value['Id']; ?>"><?php echo $value['Alias']; ?></option>                            
                                    <?php } ?>
                            </select>
                        </td>
                    </tr>
                    <tr> 
                        <td>Broker Country<span style="color: red;"> *</span></td>
                        <td> 
                            <select name="brokercountry" id="brokercountry" class="listbox-small">
                                    <option value="0">--Select--</option>
                                    <?php foreach ($country as $value){ ?>                            
                                        <option value="<?php echo $value['Id']; ?>"><?php echo $value['InsuredCountry']; ?></option>                            
                                    <?php } ?>
                            </select>
                        </td>
                        <td>Broker State<span style="color: red;"> *</span></td>
                        <td> 
                            <select name="brokerstate" id="brokerstate" class="listbox-small">
                                <option value="0">--Select--</option>
                            </select>
                        </td>
                        <td>Broker City<span style="color: red;"> *</span></td>
                        <td> 
                            <select name="brokercity" id="brokercity" class="listbox-small">
                                <option value="0">--Select--</option>
                            </select>
                        </td>
                    </tr>
                    <tr>
                        <td>Address Line1</td>
                        <td>
                            <input type="text" name="addressline1" id="addressline1" class="txtbox-small" />
                        </td>
                        <td>Address Line2</td>
                        <td>
                            <input type="text" name="addressline2" id="addressline2" class="txtbox-small" />
                        </td>
                        <td>Zipcode</td>
                        <td>
                            <input type="text" name="brokerzipcode" id="brokerzipcode" class="txtbox-small" />
                        </td>
                    </tr>
                    <tr>
                        <td>5-digit Broker Code<span style="color: red;"> *</span></td>
                        <td>
                            <input type="text" name="brokercode" id="brokercode" class="txtbox-small" />
                        </td>
                    </tr>
                    <tr>
                        <td colspan="6" align="center">
                            <input type="submit" value="Submit" class="btn btn-blue" id="brokerSubmit" name="brokerSubmit" />
                            <input type="reset" value="Cancel" onclick="location.href = '<?php echo url_for('@broker_list') ?>';" class="btn btn-cyan" />
                        </td>
                    </tr>
                </table>
            </form>
        </div>
    </div>
</div>