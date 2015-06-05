<?php 
$groupData = $groupInfo->getRaw('groupInfo');
$rightData = $groupInfo->getRaw('RightArray');
?>
<div class="breadcrumbs group"> 
                    <ul id="breadcrumb">
                        <li><a href="/">Home</a><span> >>&nbsp; </span</li>
                        <li><a href="/admin/manageadmin">Admin</a><span> >>&nbsp; </span</li>
                        <li><a href="/admin/groups">Manage Group</a><span> >>&nbsp; </span</li>
                        <li class="selected">Edit Group</li>
                    </ul>
    <a href="/admin/groups" id="back"></a>
</div>
<div class="clear"></div>
<div class="container">
<div class="box">
    <h1 class="section-header">Edit Group
        <div class="arrow"></div>
    </h1>
    <!--content border start-->
    <div class="content" style="display: block;">
        <?php
                if(isset($errorArr)){
                ?>
                <div class="grouperror">
                <?php 
                    foreach($errorArr as $err=>$val){
                        echo "<li>$val</li>";
                    }
                ?></div>
                <?php
                }
            ?>
        <form method="POST" action="" id="editGroupFrm">
            <table width="100%" border="0" cellspacing="0" cellpadding="0">
                <tr>
                    <td width="12%">
                        <label for="groupName">Group Name <span class="mandatory">*</span></label>
                    </td>
                    <td width="22%">
                        <input type="text" class="input-lg" id="groupName" name="groupName" disabled="disabled" value="<?php echo $groupData['GROUP_NAME']?>"/>
                    </td>
                    <td width="3%">&nbsp;</td>
                    <td width="12%">
                        <label for="password2">Group Status <span class="mandatory">*</span></label>
                    </td>
                    <td width="22%">
                        <select name="groupStatus" id="groupStatus" class="input-lg">
                            <option value="">--Select--</option>
                            <option value="active" <?php echo $groupData['STATUS']=='active'?'selected':'' ?>>Active</option>
                            <option value="inactive" <?php echo $groupData['STATUS']=='inactive'?'selected':'' ?>>Inactive</option>
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
                    <td colspan="4">
                        <select name="groupRights[]" id="groupRights" class="miltipleText select-lg" multiple="multiple" size="7">                            
                            <?php if($groupRights):?>
                            <?php foreach($groupRights as $value):?>                            
                            <option value="<?php echo $value['GROUP_RIGHTS_ID'];?>" <?php echo Utilities::inRightArray($value['GROUP_RIGHTS_ID'], $rightData, 'GROUP_RIGHTS_ID')==TRUE ? 'selected':'' ?>><?php echo Right::createHtmlView($value['GROUP_RIGHTS_NAME'], '_');?></option>                            
                            <?php endforeach;?>
                            <?php endif;?>
                        </select>
                    </td>
                    <td>&nbsp;</td>
                    <td>&nbsp;</td>
                </tr>
            </table>
        <div class="margin-bottom-20 text-center">
            <input type="submit" value="Submit" class="btn btn-blue" />
            <input type="hidden" name="groupId" value="<?php echo $groupData['GROUP_ID'] ?>" />
            <input type="hidden" name="groupName" value="<?php echo $groupData['GROUP_NAME'] ?>" />
            <input type="reset" value="Cancel" onclick="location.href = '<?php echo url_for('@groups_list')?>';" class="btn btn-cyan" />
        </div>
       </form>
      </div>
    </div>
    <!--content border end-->
</div>