<div class="breadcrumbs group"> 
    <ul id="breadcrumb">
        <li><a href="/">Home</a><span> >>&nbsp; </span></li>
        <li><a href="/admin/masterDataManagement">Master Data Management</a><span> >>&nbsp; </span></li>
        <li><a href="/admin/state">Manage State</a><span> >>&nbsp; </span></li>
        <li class="selected">Add State Details</li>
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
            <form method="POST" action="" name="stateAddForm" id="stateAddForm">
                <table width="100%" border="0" cellspacing="0" cellpadding="0">
                    <tr>
                        <td width="12%">Country Name<span style="color: red;"> *</span></td>
                        <td width="22%">
                            <select name="countryname" id="countryname" class="listbox-small">
                                <option value="0">--Select--</option>
                                <?php foreach ($country as $value) { ?>                            
                                    <option value="<?php echo $value['Id']; ?>"><?php echo $value['InsuredCountry']; ?></option>                            
                                <?php } ?>
                            </select>
                        </td>
                        <td width="12%">State Name<span style="color: red;"> *</span></td>
                        <td width="22%"><input type="text" name="statename" id="statename" class="txtbox-small" autocomplete="off"/></td>
                        <td width="12%">Broker State Code<span style="color: red;"> *</span></td>
                        <td width="22%"><input type="text" name="brokerstatecode" id="brokerstatecode" class="txtbox-small" autocomplete="off"/></td>
                    </tr>
                    <tr>
                        <td width="12%">Broker State Name</td>
                        <td width="22%"><input type="text" name="brokerstatename" id="brokerstatename" class="txtbox-small" autocomplete="off" readonly/></td>
                        <td width="12%">Retail Broker State Name</td>
                        <td width="22%"><input type="text" name="retailbrokerstatename" id="retailbrokerstatename" class="txtbox-small" autocomplete="off" readonly/></td>
                        <td width="12%">State Abbreviation<span style="color: red;"> *</span></td>
                        <td width="22%"><input type="text" name="abbreviation" id="abbreviation" class="txtbox-small" autocomplete="off" maxlength="2"/></td>
                    </tr>
                    <tr>
                        <td width="12%">Abbreviated Broker State Name</td>
                        <td width="22%"><input type="text" name="abbreviatedbrokerstatename" id="abbreviatedbrokerstatename" class="txtbox-small" autocomplete="off" readonly/></td>
                        <td width="12%">Project State Code<span style="color: red;"> *</span></td>
                        <td width="22%"><input type="text" name="projectstatecode" id="projectstatecode" class="txtbox-small" autocomplete="off"/></td>
                        <td width="12%">Project State Name</td>
                        <td width="22%"><input type="text" name="projectstatename" id="projectstatename" class="txtbox-small" autocomplete="off" readonly/></td>
                    </tr>
                    <tr>
                        <td colspan="6" align="center">
                            <input type="submit" value="Submit" class="btn btn-blue" id="stateSubmit" name="stateSubmit" />
                            <input type="reset" value="Cancel" onclick="location.href = '<?php echo url_for('@state_list') ?>';" class="btn btn-cyan" />
                        </td>
                    </tr>
                </table>
            </form>
        </div>
    </div>
</div>