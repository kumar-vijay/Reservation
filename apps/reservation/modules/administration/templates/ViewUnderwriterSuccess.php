<div class="breadcrumbs group"> 
    <ul id="breadcrumb">
        <li><a href="/">Home</a><span> >>&nbsp; </span></li>
        <li><a href="/admin/masterDataManagement">Master Data Management</a><span> >>&nbsp; </span></li>
        <li><a href="/admin/underwriter">Manage Underwriter</a><span> >>&nbsp; </span></li>
        <li class="selected">View Underwriter Details</li>
    </ul>
    <a href="/admin/underwriter" id="back"></a>
</div>
<div class="clear"></div>

<div class="container">
    <div class="box">
        <h1 class="section-header">Underwriter Details
            <div class="arrow"></div>
        </h1>
        <div class="content adminview" style="display: block;">
            <form method="POST" action="" name="" id="">
                <table width="100%" border="0" cellspacing="0" cellpadding="0">
                    <tr>
                        <td width="12%">Underwriter Name</td>
                        <td width="22%"><?php echo $UnderwriterInfo[0]['Name']; ?></td>
                        <td width="12%"></td>
                        <td width="22%"></td>
                        <td width="12%">Product Line</td>
                        <td width="22%"><?php echo $porductLine[0]['LOBName']; ?></td> 
                    </tr>
                    <tr>
                        <td width="12%">Product Line Subtype</td>
                        <td width="22%"><?php echo $displaylobsubtype; ?></td>
                        <td width="12%"></td>
                        <td width="22%"></td>
                        <td width="12%"></td>
                        <td width="22%"></td> 
                    </tr>
                    <tr>
                        <td colspan="6" align="center">
                            <input type="reset" value="Back" onclick="location.href = '<?php echo url_for('@underwriter_list') ?>';" class="btn btn-blue" />
                        </td>
                    </tr>
                </table>
            </form>
        </div>
    </div>
</div>