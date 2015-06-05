<div class="breadcrumbs group"> 
                    <ul id="breadcrumb">
                        <li><a href="/">Home</a><span> >>&nbsp; </span</li>
                        <li><a href="/admin/manageadmin">Admin</a><span> >>&nbsp; </span</li>
                        <li><a href="/admin/users">Manage user</a><span> >>&nbsp; </span</li>
                        <li class="selected">Edit User</li>
                    </ul>
    <a href="/admin/users" id="back"></a>
</div>
<div class="container container-center" style="padding-top:60px;">
<div class="box">
<?php
        
if(count($userDetails)>0)
          { ?>

 <h1 class="section-header">Edit User
     <div class="arrow"></div>
 </h1>
    <!--content border start-->
    <div class="content" style="display: block;">
        <form method="post" id="editUserForm" action="/admin/edituser?userId=<?php echo $userId?>">
            <table width="100%" border="0" cellspacing="0" cellpadding="0">
                <tr>
                    <td width="12%"><label for="firstname">First Name <span class="mandatory">*</span></label></td>
                    <td width="22%"><input required type="text" class="input-lg" id="firstname" name="firstname" value="<?php echo $userDetails['0']['FIRSTNAME']?>" /></td>
                    <td width="3%">&nbsp;</td>
                    <td width="12%" ><label for="lastname">Last Name</label></td>
                    <td width="22%"><input type="text" class="input-lg" id="lastname" name="lastname"value="<?php echo trim($userDetails['0']['LASTNAME'])?>" /></td>
                </tr>
                <tr>
                    <td width="12%"><label for="email">Email <span class="mandatory">*</span></label></td>
                    <td width="22%"><input required type="text" class="input-lg" id="email" name="email" value="<?php echo $userDetails['0']['EMAIL_ID']?>" readonly/></td>
                    <td width="3%">&nbsp;</td>
                    <td width="12%"><label for="status">Status <span class="mandatory">*</span></label></td>
                    <td width="22%">
                        <select required name="status" class="select-lg">
                            <option value="Active" <?php echo $userDetails['0']['USER_STATUS']=='Active'?'selected="selected"':''?>>Active</option>
                            <option value="Inactive"  <?php echo $userDetails['0']['USER_STATUS']=='Inactive'?'selected="selected"':''?>>Inactive</option>
                        </select>
                    </td>
                </tr>
                <tr>
                    <td width="12%"><label for="group">Group <span class="mandatory">*</span></label></td>
                    <td colspan="3" width="22%"><select required name="groupName" class="select-lg" id="Group-name">
                            <?php
                           foreach ($groupDetails as $row) {
                               if($row->GROUP_ID==$userDetails['0']['GROUP_ID']){
                                echo '<option value="' . $row->GROUP_ID . '" selected="selected">' . $row->GROUP_NAME . '</option>';
                            }
                            else
                            {
                                echo '<option value="' . $row->GROUP_ID . '" >' . $row->GROUP_NAME . '</option>';
                            }
                            }
                            ?>
                        </select>
                        <br />
                        <div class="margin-top-10">
                            <span class="margin-left-15" id="reported-group"></span>
                        </div>
                    </td>
                    <td align="left">&nbsp;</td>
                </tr>
                <tr>
                    <td colspan="5">&nbsp;</td>
                </tr>
            </table>
            <div class="margin-top-20 text-center">
                <input type="submit" value="Submit"  class="btn btn-blue" style="margin-right:4px;" /><input type="reset" value="Cancel" onclick="location.href = '/admin/users';" class="btn btn-cyan" /></div>
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
