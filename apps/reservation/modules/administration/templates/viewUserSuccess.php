<div class="breadcrumbs group"> 
                    <ul id="breadcrumb">
                        <li><a href="/">Home</a><span> >>&nbsp; </span></li>
                        <li><a href="/admin/manageadmin">Admin</a><span> >>&nbsp; </span></li>
                        <li><a href="/admin/users">Manage user</a><span> >>&nbsp; </span></li>
                        <li class="selected">View User</li>
                    </ul>
    <a href="/admin/users" id="back"></a>
</div>
<div class="container container-center" style="padding-top:60px;">
<div class="box">
<?php
        
if(count($userDetails)>0)
          { ?>

 <h1 class="section-header">View User
     <div class="arrow"></div>
 </h1>
    <!--content border start-->
    <div class="content adminview" style="display: block;">
        <form method="post" id="editUserForm" action="/admin/edituser?userId=<?php echo $userId?>">
            <table width="100%" border="0" cellspacing="0" cellpadding="0">
                <tr>
                    <td width="12%"><label for="firstname">First Name:</label></td>
                    <td width="22%"><?php echo $userDetails['0']['FIRSTNAME']?></td>
                    <td width="12%" ><label for="lastname">Last Name:</label></td>
                    <td width="22%"><?php echo $userDetails['0']['LASTNAME']?></td>
                </tr>
                <tr>
                    <td width="12%"><label for="email">Email:</label></td>
                    <td width="22%"><?php echo $userDetails['0']['EMAIL_ID']?></td>
                    <td width="12%"><label for="status">Status:</label></td>
                    <?php if ($userDetails['0']['USER_STATUS'] == 'Active') { ?>
                    <td width="22%" class="active">
                           <?php echo $userDetails['0']['USER_STATUS'] ?>
                    </td>
                    <?php } else { ?>
                    <td width="22%" class="inactive">
                           <?php echo $userDetails['0']['USER_STATUS'] ?>
                    </td>
                    <?php } ?>
                </tr>
                <tr>
                    <td width="12%"><label for="group">Group:</label></td>
                    <td colspan="3" width="22%"> <?php echo $groupDetails['0']->GROUP_NAME ?> </td>
                    <td align="left">&nbsp;</td>
                </tr>
                <tr>
                    <td colspan="5">&nbsp;</td>
                </tr>
            </table>
            <div class="margin-top-20 text-center">
                <input type="reset" value="Back" onclick="location.href = '/admin/users';" class="btn btn-blue" /></div>
        </form>
    </div> 
    </div>
    </div>
         <?php } else { ?>
<table>
   <tr>
          <td colspan="5"><?php echo $errMsg?></td>
   </tr>
</table>
<?php } ?>
    <!--content border end-->

</div>
    