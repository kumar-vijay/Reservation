<div class="breadcrumbs group"> 
    <ul id="breadcrumb">
        <li><a href="/">Home</a><span> >>&nbsp; </span></li>
        <li><a href="/admin/masterDataManagement">Master Data Management</a><span> >>&nbsp; </span></li>
        <li><a href="/admin/underwriter">Manage Underwriter</a><span> >>&nbsp; </span></li>
        <li class="selected">Add Underwriter</li>
    </ul>
    <a href="/admin/underwriter" id="back"></a>
</div>
<div class="clear"></div>

<div class="container">
    <div class="box">
        <h1 class="section-header">Underwriter Details
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
            <form method="POST" action="" name="underwriterAddForm" id="underwriterAddForm">
                <table width="100%" border="0" cellspacing="0" cellpadding="0">
                    <tr>
                        <td width="12%">Underwriter Name<span style="color: red;"> *</span></td>
                        <td width="22%"><input type="text" name="underwriter" id="underwriter" class="txtbox-small" autocomplete="off" maxlength="50"/></td>
                        <td width="12%"></td>
                        <td width="22%"> </td>
                        <td width="12%">Product Line<span style="color: red;"> *</span></td>
                        <td width="22%">
                            <select name="productline" id="productline" class="listbox-small">
                                <option value="0">--Select--</option>
                                <?php foreach ($productLine as $value) { ?>                            
                                    <option value="<?php echo $value['Id']; ?>"><?php echo $value['LOBName']; ?></option>                            
                                <?php } ?>
                            </select>
                        </td>
                    </tr>
                    <tr>
                        <td width="20%">Product Line Subtype</td>
                        <td width="15%">
                            <div class="dropdown divdropdown" style="width:5px;">
                                <input readonly="readonly" type='text' name="productLineSubType" class='selectboxClass' id="productLineSubType" value=""  style="font-size:8pt;padding-right: 20px; width:130px;" />
                                <ul class="dropdown-list">                                    
                                    <li>
                                        <label><input type="checkbox" value="y" id="selectAllCompany" name="selectAllCompany" />Select All</label>
                                    </li>
                                    <?php
                                        foreach ($productLineSubType as $value) {?> 
                                            <li>
                                                <label><input class="checkProductLineSubType" type="checkbox" <?php echo $select; ?> value="<?php echo $value['ProductLineSubType']; ?>" name="product_line_sub[]" /><?php echo $value['ProductLineSubType']; ?></label>
                                            </li>
                                    <?php } ?>
                                </ul>
                            </div></td>
                        <td width="12%"></td>
                        <td width="17%"> </td>
                        <td width="12%"></td>
                        <td width="22%"> </td>
                    </tr>
                    <tr>
                        <td colspan="6" align="center">
                            <input type="submit" value="Submit" class="btn btn-blue" id="underwriterSubmit" name="underwriterSubmit" />
                            <input type="reset" value="Cancel" onclick="location.href = '<?php echo url_for('@underwriter_list') ?>';" class="btn btn-cyan" />
                        </td>
                    </tr>
                </table>
            </form>
        </div>
    </div>
</div>