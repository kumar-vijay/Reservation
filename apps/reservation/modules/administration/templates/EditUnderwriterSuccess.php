<?php
    foreach ($underwriterInfo[0]['LOBSubTypeId'] as $data) {
        $lobsubType[] = $data;
    }
?>

<div class="breadcrumbs group"> 
    <ul id="breadcrumb">
        <li><a href="/">Home</a><span> >>&nbsp; </span></li>
        <li><a href="/admin/masterDataManagement">Master Data Management</a><span> >>&nbsp; </span></li>
        <li><a href="/admin/underwriter">Manage Underwriter</a><span> >>&nbsp; </span></li>
        <li class="selected">Edit Underwriter Details</li>
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
            <form method="POST" action="" name="underwriterEditForm" id="underwriterEditForm">
                <table width="100%" border="0" cellspacing="0" cellpadding="0">
                    <tr>
                        <td width="12%">Underwriter Name</td>
                        <td width="22%"><input type="text" name="editunderwritername" id="editunderwritername" class="txtbox-small" value="<?php echo $underwriterInfo[0]['Name']; ?>" maxlength="50" readonly/></td>
                        <td width="12%"></td>
                        <td width="22%"></td>
                        <td width="12%">Product Line<span style="color: red;"> *</span></td>
                        <td width="22%"> 
                            <select name="editproductline" id="editproductline" class="listbox-small">
                                <option value="">--Select--</option>
                                <?php
                                foreach ($productLine as $value) {
                                    if ($underwriterInfo[0]['LOBId'] == $value['Id'])
                                        $select = 'selected="selected"';
                                    else
                                        $select = '';
                                    ?>
                                    <option value="<?php echo $value['Id'] ?>" <?php echo $select; ?> ><?php echo $value['LOBName'] ?></option>
                                <?php } ?>
                            </select>
                        </td>
                        <td width="12%"></td>
                        <td width="22%"></td>
                    </tr>
                    <tr>
                        <td width="20%">Product Line Subtype</td>
                        <td width="15%">
                            <div class="dropdown divdropdown" style="width:5px;">
                                <input readonly="readonly" type='text' name="productLineSubType" class='selectboxClass' id="productLineSubType" value="<?php echo $displaylobsubtype; ?>"  style="font-size:8pt;padding-right: 20px; width:130px;"/>
                                <ul class="dropdown-list">                                    
                                    <li>
                                        <label><input type="checkbox" value="y" id="selectAllCompany" name="selectAllCompany" />Select All</label>
                                    </li>                                    
                                    <?php foreach ($productLineSubType as $value) {
                                        if (in_array($value['Id'] ,$lobsubType)){
                                        $select = 'checked="checked"';
                                        }else{
                                        $select = ''; 
                                        }
                                    ?> 
                                    <li>
                                        <label><input class="checkProductLineSubType" type="checkbox" <?php echo $select; ?> value="<?php echo $value['ProductLineSubType']; ?>" name="editlobsubtype[]" /><?php echo $value['ProductLineSubType']; ?></label>
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
                    <input type="hidden" id="editDataRecorderIdHidden" name="editDataRecorderIdHidden" value="<?php echo $underwriterInfo[0]['DataRecorderMetaDataId']; ?>">
                    <td colspan="6" align="center">
                        <input type="submit" value="Submit" class="btn btn-blue" id="editunderwriterSubmit" name="editunderwriterSubmit" />
                        <input type="reset" value="Cancel" onclick="location.href = '<?php echo url_for('@underwriter_list') ?>';" class="btn btn-cyan" />
                    </td>
                    </tr>
                </table>
            </form>
        </div>
    </div>
</div>