<div class="breadcrumbs group"> 
    <ul id="breadcrumb">
        <li><a href="/">Home</a><span> >>&nbsp; </span></li>
        <li><a href="/admin/masterDataManagement">Master Data Management</a><span> >>&nbsp; </span></li>
        <li><a href="/admin/renewalreference">Manage Renewal Reference</a><span> >>&nbsp; </span></li>
        <li class="selected">Add Renewal Reference Details</li>
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
            <form method="POST" action="" name="referenceAddForm" id="referenceAddForm">
                <table width="100%" border="0" cellspacing="0" cellpadding="0">
                    <tr>
                        <td width="12%">Submission Number<span style="color: red;"> *</span></td>
                        <td width="22%">
                            <input type="text" name="submissionNumber" id="submissionNumber" class="txtbox-small"/>
                        </td>
                        <td width="12%">Account Name<span style="color: red;"> *</span></td>
                        <td width="22%">
                            <select name="accountName" id="accountName" class="listbox-small">
                                <option value="0">--Select--</option>
                            </select>
                        <td width="12%">Status<span style="color: red;"> *</span></td>
                        <td width="22%"> 
                            <select name="status" id="status" class="listbox-small">
                                <option value="0">--Select--</option>
                            </select>
                        </td>
                    </tr>
                    <tr> 
                        <td>Renewable<span style="color: red;"> *</span></td>
                        <td> 
                            <select name="renewable" id="renewable" class="listbox-small">
                                <option value="0">--Select--</option>
                                <?php foreach ($renewable as $value) { ?>                            
                                    <option value="<?php echo $value['Id']; ?>"><?php echo $value['Alias']; ?></option>                            
                                <?php } ?>
                            </select>
                        </td>
                        <td>Date of Renewal<span style="color: red;"> *</span></td> 
                        <td> 
                            <input type="text" name="dateofRenewal" id="dateofRenewal" class="txtbox-small" readonly />
                        </td>
                    </tr>
                    <tr>
                        <td colspan="6" align="center">
                            <input type="submit" value="Submit" class="btn btn-blue" id="contactpersonSubmit" name="contactpersonSubmit" />
                            <input type="reset" value="Cancel" onclick="location.href = '<?php echo url_for('@reference_list') ?>';" class="btn btn-cyan" />
                        </td>
                    </tr>
                </table>
            </form>
        </div>
    </div>
</div>