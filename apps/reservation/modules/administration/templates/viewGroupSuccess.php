<?php 
$groupData = $groupInfo->getRaw('groupInfo');
$rightData = $groupInfo->getRaw('RightArray');
?>

<div class="breadcrumbs group"> 
                    <ul id="breadcrumb">
                        <li><a href="/">Home</a><span> >>&nbsp; </span></li>
                        <li><a href="/admin/manageadmin">Admin</a><span> >>&nbsp; </span></li>
                        <li><a href="/admin/groups">Manage Group</a><span> >>&nbsp; </span></li>
                        <li>View Group</li>
                    </ul>
    <a href="/admin/groups" id="back"></a>
</div>
<div class="clear"></div>
<div class="container">
<div class="box">
    <h1 class="section-header">View Group
        <div class="arrow"></div>
    </h1>
    <!--content border start-->
    <div class="content adminview" style="display: block;">
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
                        <label for="groupName">Group Name:</label>
                    </td>
                    <td width="22%">
                        <?php echo $groupData['GROUP_NAME']?>
                    </td>
                    <td width="25%">&nbsp;</td>
                    <td width="12%">
                        <label for="password2">Group Status:</label>
                    </td>
                    <?php if($groupInfo['groupInfo']['STATUS'] == 'active') { ?>
                    <td width="22%" class="active">
                        <?php echo $groupInfo['groupInfo']['STATUS']; ?>
                    </td>
                    <?php } else { ?>
                    <td width="22%" class="inactive">
                        <?php echo $groupInfo['groupInfo']['STATUS']; ?>
                    </td>
                    <?php } ?>
                </tr>
                <tr>
                    <td colspan="4">&nbsp;</td>
                </tr>
                <tr>
                    <td>
                        <label for="group2">Right:</label>
                    </td>
                    <td colspan="4">
                        <ul class="rights-list">                            
                            <?php if($groupInfo['RightArray']):?>
                            <?php foreach($groupInfo['RightArray'] as $value):?>                            
                            <li> <?php echo $value['GROUP_RIGHTS_NAME'] ?> </li>                            
                            <?php endforeach;?>
                            <?php endif;?>
                        </ul>
                    </td>
                    <td>&nbsp;</td>
                    <td>&nbsp;</td>
                </tr>
            </table>
        <div class="margin-bottom-60 text-center">
            <input type="hidden" name="groupId" value="<?php echo $groupData['GROUP_ID'] ?>" />
            <input type="hidden" name="groupName" value="<?php echo $groupData['GROUP_NAME'] ?>" />
            <input type="reset" value="Back" onclick="location.href = '<?php echo url_for('@groups_list')?>';" class="btn btn-blue" />
        </div>
       </form>
      </div>
    </div>
    <!--content border end-->
</div>