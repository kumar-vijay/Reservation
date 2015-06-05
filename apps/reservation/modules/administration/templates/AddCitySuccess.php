<div class="breadcrumbs group"> 
    <ul id="breadcrumb">
        <li><a href="/">Home</a><span> >>&nbsp; </span></li>
        <li><a href="/admin/masterDataManagement">Master Data Management</a><span> >>&nbsp; </span></li>
        <li><a href="/admin/city">Manage City</a><span> >>&nbsp; </span></li>
        <li class="selected">Add City Details</li>
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
            <form method="POST" action="" name="cityAddForm" id="cityAddForm">
                <table width="100%" border="0" cellspacing="0" cellpadding="0">
                    <tr>
                        <td width="12%">State Name<span style="color: red;"> *</span></td>
                        <td width="22%">
                            <select name="statename" id="statename" class="listbox-small">
                                <option value="0">--Select--</option>
                                <?php foreach ($state as $value) { ?>                            
                                    <option value="<?php echo $value['Id']; ?>"><?php echo $value['FullCode']; ?></option>                            
                                <?php } ?>
                            </select>
                        </td>
                        <td width="12%">City Name<span style="color: red;"> *</span></td>
                        <td width="22%"><input type="text" name="cityname" id="cityname" class="txtbox-small" autocomplete="off"/></td>
                        <td width="12%">City Code<span style="color: red;"> *</span></td>
                        <td width="22%"><input type="text" name="citycode" id="citycode" class="txtbox-small" autocomplete="off"/></td>
                    </tr>
                    <tr>
                        <td width="12%">Broker City Name</td>
                        <td width="22%"><input type="text" name="brokercityname" id="brokercityname" class="txtbox-small" autocomplete="off" readonly/></td>
                        <td width="12%">Retail Broker City Name</td>
                        <td width="22%"><input type="text" name="retailbrokercityname" id="retailbrokercityname" class="txtbox-small" autocomplete="off" readonly/></td>
                    </tr>
                    <tr>
                        <td colspan="6" align="center">
                            <input type="submit" value="Submit" class="btn btn-blue" id="citySubmit" name="citySubmit" />
                            <input type="reset" value="Cancel" onclick="location.href = '<?php echo url_for('@city_list') ?>';" class="btn btn-cyan" />
                        </td>
                    </tr>
                </table>
            </form>
        </div>
    </div>
</div>