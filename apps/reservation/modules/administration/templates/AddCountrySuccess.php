<div class="breadcrumbs group"> 
    <ul id="breadcrumb">
        <li><a href="/">Home</a><span> >>&nbsp; </span></li>
        <li><a href="/admin/masterDataManagement">Master Data Management</a><span> >>&nbsp; </span></li>
        <li><a href="/admin/country">Manage Country</a><span> >>&nbsp; </span></li>
        <li class="selected">Add Country Details</li>
    </ul>
    <a href="/admin/country" id="back"></a>
</div>
<div class="clear"></div>

<div class="container">
    <div class="box">
        <h1 class="section-header">Country Details
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
            <form method="POST" action="" name="countryAddForm" id="countryAddForm">
                <table width="100%" border="0" cellspacing="0" cellpadding="0">
                    <tr>
                        <td width="12%">Country Name<span style="color: red;"> *</span></td>
                        <td width="22%"><input type="text" name="countryname" id="countryname" class="txtbox-small" autocomplete="off"/></td>
                        <td width="12%">Country Code<span style="color: red;"> *</span></td>
                        <td width="22%"><input type="text" name="countrycode" id="countrycode" class="txtbox-small" autocomplete="off"/></td>
                        <td width="12%">Final Country Name</td>
                        <td width="22%"><input type="text" name="finalcountryname" id="finalcountryname" class="txtbox-small" autocomplete="off" readonly/></td>
                    </tr>
                    <tr>
                        <td colspan="6" align="center">
                            <input type="submit" value="Submit" class="btn btn-blue" id="countrySubmit" name="countrySubmit" />
                            <input type="reset" value="Cancel" onclick="location.href = '<?php echo url_for('@country_list') ?>';" class="btn btn-cyan" />
                        </td>
                    </tr>
                </table>
            </form>
        </div>
    </div>
</div>