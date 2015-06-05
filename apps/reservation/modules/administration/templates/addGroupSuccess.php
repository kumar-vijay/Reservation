<div class="breadcrumbs group"> 
    <ul id="breadcrumb">
        <li><a href="/">Home</a><span> >>&nbsp; </span></li>
        <li><a href="/admin/manageadmin">Admin</a><span> >>&nbsp; </span></li>
        <li><a href="/admin/groups">Manage Group</a><span> >>&nbsp; </span></li>
        <li class="selected">Create New Group</li>
    </ul>
    <a href="/submission/Submission" id="back"></a>
</div>
<div class="clear"></div>
<div class="container">
    <div class="box">
        <h1 class="section-header">Create New Group
            <div class="arrow"></div>
        </h1>
        <!--content border start-->
        <div class="content" style="display: block;">
            <?php
            if (isset($errorArr)) {
                ?>
                <div class="grouperror">
                    <ul>
                        <?php
                        foreach ($errorArr as $err => $val) {
                            echo "<li>$val</li>";
                        }
                        ?>
                    </ul>
                </div>
                <?php
            }
            ?>
            <form method="POST" action="/admin/addgroup" id="addGroupFrm">
                <table width="100%" border="0" cellspacing="0" cellpadding="0">
                    <tr>
                        <td width="12%">
                            <label for="groupName">Group Name <span class="mandatory">*</span></label>
                        </td>
                        <td width="22%">
                            <input type="text" class="input-lg" id="groupName" name="groupName" maxlength="30"/>
                        </td>
                        <td width="3%">&nbsp;</td>
                        <td width="12%">
                            <label for="password2">Group Status <span class="mandatory">*</span></label>
                        </td>
                        <td width="22%"><select name="groupStatus" id="groupStatus" class="input-lg">
                                <option value="">--Select--</option>
                                <option value="active">Active</option>
                                <option value="inactive">Inactive</option>
                            </select>
                        </td>
                    </tr>
                    <tr>
                        <td colspan="4">&nbsp;</td>
                    </tr>
                    <tr>
                        <td>
                            <label for="group2">Right <span class="mandatory">*</span></label>
                        </td>
                        <td>
                            <select name="groupRights[]" id="groupRights" class="miltipleText select-lg" multiple="multiple" size="7">                            
                                <?php if ($groupRights): ?>
                                    <?php foreach ($groupRights as $value): ?>                            
                                        <option value="<?php echo $value['GROUP_RIGHTS_ID']; ?>"><?php echo Right::createHtmlView($value['GROUP_RIGHTS_NAME'], '_'); ?></option>                            
                                    <?php endforeach; ?>
                                <?php endif; ?>
                            </select>
                        </td>
                        <td>&nbsp;</td>
                        <td>&nbsp;</td>
                    </tr>
                </table>
                <div class="margin-bottom-20 text-center">
                    <input type="submit" value="Submit" class="btn btn-blue" />
                    <input type="reset" value="Cancel" onclick="location.href = '<?php echo url_for('@groups_list') ?>';" class="btn btn-cyan" />            
                </div>
            </form>
        </div>
    </div>
    <!--content border end-->
</div>