<div class="breadcrumbs group"> 
    <ul id="breadcrumb">
        <li><a href="/">Home</a><span> >>&nbsp; </span></li>
        <li><a href="/admin/masterDataManagement">Master Data Management</a><span> >>&nbsp; </span></li>
        <li><a href="/admin/contactperson">Manage Contact Person</a><span> >>&nbsp; </span></li>
        <li class="selected">View Contact Person Details</li>
    </ul>
    <a href="/admin/contactperson" id="back"></a>
</div>
<div class="clear"></div>

<div class="container">
    <div class="box">
        <h1 class="section-header">Contact Person Details
            <div class="arrow"></div>
        </h1>
        <div class="content adminview" style="display: block;">
            <form method="POST" action="" name="" id="">
                <table width="100%" border="0" cellspacing="0" cellpadding="0">
                    <tr>
                        <td width="12%">Party Type</td>
                        <td width="22%"><?php echo $partyType[0]['Alias']; ?></td>
                        <td width="12%">Company Name</td>
                        <td width="22%"><?php echo $company; ?></td>
                        <td width="12%">Title</td>
                        <td width="22%"><?php echo $contactPersonInfo->Title; ?></td> 
                    </tr>
                    <tr>
                        <td>First Name</td>
                        <td><?php echo $contactPersonInfo->FirstName; ?></td> 
                        <td>Last Name</td>
                        <td><?php echo $contactPersonInfo->LastName; ?></td> 
                        <td>Function</td>
                        <td><?php echo $contactPersonInfo->PartyFunction; ?></td>
                    </tr>
                    <tr>
                        <td>Email Address</td>
                        <td><?php echo $contactPersonInfo->Email; ?></td>
                        <td>Phone Number</td>
                        <td><?php if($contactPersonInfo->PhoneNumber != '0'){ echo $contactPersonInfo->PhoneNumber; } else { echo "";} ?></td>
                        <td>Mobile Number</td>
                        <td><?php if($contactPersonInfo->MobileNumber != '0'){ echo $contactPersonInfo->MobileNumber;} else { echo "";} ?></td>
                    </tr>
                    <tr>
                        <td>Fax</td>
                        <td><?php if($contactPersonInfo->Fax != '0'){ echo $contactPersonInfo->Fax;} else { echo "";} ?></td>
                    </tr>
                    <tr>
                        <td colspan="6" align="center">
                            <input type="reset" value="Back" onclick="location.href = '<?php echo url_for('@contactperson_list') ?>';" class="btn btn-blue" />
                        </td>
                    </tr>
                </table>
            </form>
        </div>
    </div>
</div>