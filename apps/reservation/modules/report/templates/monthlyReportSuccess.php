<?php $niddle = $sf_user->getAttribute('searchNiddle');
    foreach ($niddle['LineOfBusiness'] as $data){
        $lineofBusiness[] = $data;
    }
    foreach ($niddle['BranchOffice'] as $data){
        $branchOffice[] = $data;
    }
?>
<div class="breadcrumbs group"> 
    <ul id="breadcrumb">
        <li><a href="/">Home</a><span> >>&nbsp; </span></li>
        <li><a href="/report/report">KPI Reports</a><span> >>&nbsp; </span></li>
        <li class="selected">Monthly Report</li>
    </ul>
    <a href="/report/report" id="back"></a>
</div>
<div class="clear"></div>
<div class="container">
    <div class="box">
        <h1 class="section-header">Monthly Report Details
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
            <form method="POST" action="" name="MonthlyReportForm" id="MonthlyReportForm">
                <table width="100%" border="0" cellspacing="0" cellpadding="0">
                    <tr>
                        <td width="12%">Date Range<span style="color: red;"> *</span></td>
                        <td width="22%">
                            <select name="daterange" id="daterange" class="listbox-small">
                                <option value="0">--Select--</option>
                                <?php foreach ($parameter[0]['ValidValues'] as $value) { 
                                     if ($value->Label == $niddle['DateRange'])
                                        $select = 'selected="selected"';
                                    else
                                        $select = '';
                                ?>
                                    <option value="<?php echo $value->Value; ?>" <?php echo $select; ?>><?php echo $value->Label; ?></option>                            
                                <?php } ?>
                            </select>
                        </td>
                        <td width="12%">Date Type<span style="color: red;"> *</span></td>
                        <td width="22%">
                            <select name="datetype" id="datetype" class="listbox-small">
                                <option value="0">--Select--</option>
                                <?php foreach ($parameter[1]['ValidValues'] as $value) { 
                                    if ($value->Label == $niddle['DateType'])
                                        $select = 'selected="selected"';
                                    else
                                        $select = '';
                                ?> 
                                     <?php if($value->Value == 'All Process Date'){ ?>
                                         <option value="<?php echo $value->Value; ?>" selected="selected"><?php echo $value->Label; ?></option> 
                                     <?php } else { ?>
                                         <option value="<?php echo $value->Value; ?>" <?php echo $select; ?>><?php echo $value->Label; ?></option> 
                                     <?php } ?>
                                <?php } ?>
                            </select>
                        </td>
                        <td width="12%">Start Date<span style="color: red;"> *</span></td>
                        <td width="22%"><input type="text" name="startdate" id="startdate" class="txtbox-small" autocomplete="off" value="<?php echo $niddle['StartDate']; ?>"/></td>
                    </tr>
                    <tr>
                        <td width="12%">End Date</td>
                        <td width="22%"><input type="text" name="enddate" id="enddate" class="txtbox-small" autocomplete="off" value="<?php echo $niddle['EndDate']; ?>"/></td>
                        <td width="12%">Line of Business</td>
                        <td width="22%">
                            <div class="dropdown divdropdown" id="allvalues"><input readonly="readonly" type='text' name="lobVal" class='selectboxClass'  id="lobVal" value="" style="font-size:8pt; width:130px; padding-right: 20px;" />
                                <ul class="dropdown-list">
                                    <li>
                                        <label><?php if($niddle['selectAllLob'] == 'y') {$check = 'checked="checked"';} ?><input type="checkbox" value="y" id="selectAll" name="selectAll" <?php echo $check;?> />-Select All-</label>
                                    </li>
                                    <?php foreach ($parameter[6]['ValidValues'] as $value) {
                                        if (in_array($value->Value ,$lineofBusiness))
                                        $select = 'checked="checked"';
                                        else
                                        $select = '';    
                                    ?> 
                                    <li>
                                        <label><input class="checklob" type="checkbox" <?php echo $select; ?> value="<?php echo $value->Value; ?>" name="lineofbusiness[]" /><?php echo $value->Label; ?></label>
                                    </li>
                                    <?php } ?>
                                </ul>
                            </div>
                        </td>
                        <td width="12%">Branch Office</td>
                        <td width="22%">
                            <div class="dropdown divdropdown"><input readonly="readonly" type='text' name="branchVal" class='selectboxClass'  id="branchVal" value=""   style="font-size:8pt; width:130px; padding-right: 20px;" />
                                <ul class="dropdown-list">                                    
                                    <li>
                                        <label><?php if($niddle['selectAllBranch'] == 'y') {$check = 'checked="checked"';} ?><input type="checkbox" value="y" id="selectAllBranch" name="selectAllBranch" <?php echo $check;?> />-Select All-</label>
                                    </li>                                    
                                    <?php foreach ($parameter[7]['ValidValues'] as $value) { 
                                        if (in_array($value->Value ,$branchOffice))
                                        $select = 'checked="checked"';
                                        else
                                        $select = ''; 
                                    ?> 
                                    <li>
                                        <label><input class="checkbranchoffice" type="checkbox"  <?php echo $select; ?> value="<?php echo $value->Value; ?>" name="branchoffice[]" /><?php echo $value->Label; ?></label>
                                    </li>
                                    <?php } ?>
                                </ul>
                            </div>
                        </td>
                    </tr>
                    <tr>
                        <td width="12%">Report As of Date</td>
                        <td width="22%"><input type="text" name="reportasofdate" id="reportasofdate" class="txtbox-small" autocomplete="off" value="<?php echo $niddle['ReportAsOfDate']; ?>" /></td>
                    </tr>
                    <tr>
                        <td colspan="6" align="center">
                            <input type="submit" value="View Report" class="btn btn-blue" id="citySubmit" name="monthlySubmit" />
                            <input type="reset" value="Cancel" onclick="location.href = '#';" class="btn btn-cyan" />
                        </td>
                    </tr>
                </table>
            </form>
        </div>
    </div>
</div>
<?php if($result){ ?>
        <div class="container">
            <div class="content" style="display: block; border: 1px solid #aaa;">
            <form method="POST" action="/report/DownloadReport" name="MonthlyReportForm" id="MonthlyReportForm">
            <table width="100%" border="0" cellspacing="0" cellpadding="0">
                <tr>
                    <td width="12%">Report Format</td>
                    <td width="22%">
                        <select name="reportType" id="reportType" class="listbox-small">
                            <option value="0">--Select--</option>
                            <?php foreach ($renderingType as $value) { 
                                 if ($value['Name'] == $niddle['ReportType'])
                                    $select = 'selected="selected"';
                                else
                                    $select = '';
                            ?>
                                <option value="<?php echo $value['Name']; ?>" <?php echo $select; ?>><?php echo $value['Name']; ?></option>                            
                            <?php } ?>
                        </select>
                    </td>
                    <td width="12%"></td>
                    <td width="22%"></td>
                    <td width="12%"></td>
                    <td width="22%">
                        <input type="submit" value = "Download Report" id="downloadReport" class="btn btn-blue"/>
                    </td>
                </tr>
            </table>
          </form>
          </div>
        </div>
<?php }?>
<div class="container" style="zoom: 115%">
   <?php echo html_entity_decode($result); ?>
   <span style='height: 10px;'>&nbsp;</span>
</div>