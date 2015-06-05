<div class="breadcrumbs group"> 
    <ul id="breadcrumb">
        <li><a href="/">Home</a><span> >>&nbsp; </span></li>
        <li><a href="/admin/masterDataManagement">Master Data Management</a><span> >>&nbsp; </span></li>
        <li><a href="/admin/renewalreference">Manage Renewal Reference</a><span> >>&nbsp; </span></li>
        <li class="selected">View Renewal Reference Details</li>
    </ul>
    <a href="/admin/renewalreference" id="back"></a>
</div>
<div class="clear"></div>

<div class="container">
    <div class="box">
        <h1 class="section-header">Renewal Reference Details
            <div class="arrow"></div>
        </h1>
        <div class="content adminview" style="display: block;">
            <form method="POST" action="" name="" id="">
                <table width="100%" border="0" cellspacing="0" cellpadding="0">
                    <tr>
                        <td width="12%">Submission Number</td>
                        <td width="22%"><?php echo $renewalReferenceInfo[0]['SubmissionNumber']; ?></td>
                        <td width="12%">Account Name</td>
                        <td width="22%"><?php echo $accountName[0]['InsuredName']; ?></td>
                        <td width="12%">Status</td>
                        <td width="22%"><?php echo "Bound"; ?></td> 
                    </tr>
                    <tr>
                        <td>Renewable</td>
                        <td><?php echo $renewable[0]['LookupName']; ?></td> 
                        <td>Date of Renewal</td>
                        <td><?php echo date('m-d-Y', strtotime($renewalReferenceInfo[0]['DateofRenewal'])); ?></td> 
                    </tr>
                    <tr>
                        <td colspan="6" align="center">
                            <input type="reset" value="Back" onclick="location.href = '<?php echo url_for('@reference_list') ?>';" class="btn btn-blue" />
                        </td>
                    </tr>
                </table>
            </form>
        </div>
    </div>
</div>