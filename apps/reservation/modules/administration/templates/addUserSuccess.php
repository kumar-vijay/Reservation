<div class="breadcrumbs group"> 
    <ul id="breadcrumb">
        <li><a href="/">Home</a><span> >>&nbsp; </span></li>
        <li><a href="/admin/manageadmin">Admin</a><span> >>&nbsp; </span></li>
        <li><a href="/admin/users">Manage user</a><span> >>&nbsp; </span></li>
        <li class="selected">Create new user</li>
    </ul>
    <a href="/admin/users" id="back"></a>
</div>
<div class="container container-center" style="padding-top:60px;">
    <div class="box">
        <h1 class="section-header">Create New User
            <div class="arrow"></div>
        </h1>
        <!--content border start-->
        <div class="content" style="display: block;">
            <?php if(isset($errorArr)){ ?>
                        <div class="grouperror"><?php echo $errorArr ?></div>
            <?php } ?>
            <form method="post" id="addUserForm" action="/admin/adduser">
                <table width="100%" border="0" cellspacing="0" cellpadding="0">
                    <tr>
                        <td width="12%"><label for="firstname">First Name <span class="mandatory">*</span></label></td>
                        <td width="22%">
                            <input required type="text" class="input-lg" id="firstname" name="firstname" />
                        </td>
                        <td width="25%">&nbsp;</td>
                        <td width="12%" ><label for="lastname">Last Name</label></td>
                        <td width="22%">
                            <input type="text" class="input-lg" id="lastname" name="lastname" />
                        </td>
                    </tr>
                    <tr>
                        <td><label for="email">Email <span class="mandatory">*</span></label></td>
                        <td>
                            <input type="text" class="input-lg" id="email" name="email" required autocomplete="off" value=" "/>
                        </td>
                        <td width="25%">&nbsp;</td>
                        <td><label for="status">Status <span class="mandatory">*</span></label></td>
                        <td>
                            <select required name="status" class="select-lg">
                                <option value="Active" >Active</option>
                                <option value="Inactive">Inactive</option>
                            </select>
                        </td>
                    </tr>
                    <tr>
                        <td><label for="group" class="display-block margin-top-3">Group <span class="mandatory">*</span></label></td>
                        <td colspan="3">
                                <select required name="groupName" class="select-lg" id="Group-name">
                                <?php
                                foreach ($groupDetails as $row) {
                                    echo '<option value="' . $row->GROUP_ID . '">' . $row->GROUP_NAME . '</option>';
                                }
                                ?>
                            </select>
                           <span class="margin-left-15" id="reported-group"></span></div>
                       </td>
                    </tr>
                    <tr>
                        <td>
                            <label for="password">Password <span class="mandatory">*</span></label>
                        </td>
                        <td colspan="3">
                            <input type="password" class="input-lg" id="password" name="password" /><br />
                            <span class="help-text">The password must be atleast 6 characters long</span>
                        </td>
                        <td align="left">&nbsp;</td>
                        <td width="15%" align="left" valign="top">&nbsp;</td>
                        <td width="35%" align="left">&nbsp;</td>
                    </tr>
                </table>


                <div class="margin-top-20 text-center">
                    <input type="submit" value="Submit"  class="btn btn-blue" style="margin-right:4px;" /><input type="reset" value="Cancel" onclick="location.href = '/admin/users';" class="btn btn-cyan" /></div>
            </form>
        </div> 
        <!--content border end-->
    </div>
</div>