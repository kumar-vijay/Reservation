<div class="breadcrumbs group"> 
    <ul id="breadcrumb">
        <li><a href="/">Home</a><span> >>&nbsp; </span></li>
        <li><a href="/admin/manageadmin">Admin</a><span> >>&nbsp; </span></li>
        <li class="selected">Manage Group</li>
    </ul>
    <a href="/admin/manageadmin" id="back"></a>
</div>
<div class="clear"></div>
<?php if ($sf_user->hasFlash('success')): ?>
    <div class="success"><?php echo $sf_user->getFlash('success'); ?>    
    </div>
<?php endif; ?>


<!-- Quotes -->
<div class="container">
    <div class="box">
        <h1 class="section-header">Filter (<?php echo $numberofResults; ?> results found)
            <div class="arrow"></div>
        </h1>
        <?php include_partial('groupSearchFilter'); ?>
    </div>
</div>

<div class="container" style="float: right">
    <?php if($sf_user->hasCredential('VIEW_EDIT_GROUP')) { ?>
    <input type="button" value="Create New Group" class="btn btn-blue fright" onclick="window.location = '<?php echo url_for('@add_group') ?>'" />
    <?php } ?>
</div>

<div class="container">
    <h2>Group Details List</h2>
    <table class="dataTable">
        <thead>
            <tr>
                <th class="no-right-border">Edit/View Details</th>
                <th>Group Name</th>
                <th>Status</th>
                <th>Created By</th>
                <th>Created On</th>
                <th>Modified By </th>
                <th><span class="no-right-border">Modified On</span></th>
            </tr>
        </thead>
        <tbody>
            <?php
            if ($numberofResults != 0) {
                foreach ($pager->getResults() as $result) {
                    ?>
                    <tr> 
                        <td>
                            <?php if($sf_user->hasCredential('VIEW_EDIT_GROUP')) { ?>
                            <a href="<?php echo url_for('@edit_group') . '?groupId=' . $result->getGroupId(); ?>" style="margin-right:4px;" class="btn btn-orange btn-small"><i class="fa fa-pencil"></i></a>
                            <?php } ?>
                            <a href="<?php echo url_for('@view_group') . '?groupId=' . $result->getGroupId(); ?>" class="btn btn-green btn-small"><i class="fa fa-eye"></i></a>
                        </td>
                        <td><?php echo $result->getGroupName(); ?></td>
                        <td><?php echo $result->getStatus(); ?></td>
                        <td><?php echo MyReservationUser::getUserNameFromID($result->getCreatedById()); ?></td>
                        <td><?php echo date('m-d-Y h:i:s', strtotime($result->getCreatedOn())); ?></td>
                        <td><?php echo MyReservationUser::getUserNameFromID($result->getModifiedById()); ?></td>
                        <?php if ($result->getModifiedOn() == '') { ?>
                        <td></td>
                       <?php } else { ?>
                            <td><?php echo date('m-d-Y h:i:s', strtotime($result->getModifiedOn()));?></td>
                       <?php } ?>
                   </tr>          
                   <?php
                    }
                } else {
                    ?>
                    <tr>
                        <td colspan="6" align="center" class="login-error">Sorry, No Record Found.</td>
                    </tr>
                <?php
                }
                ?>
            </tbody>
        </table>
    </div>
    <div class="container">
    <?php if ($pager->haveToPaginate()): ?>
        <!--Pagination start-->
        <nav class="pagination-wrapper">
        <ul class="pagination">
            <li class="first"><a href="<?php echo url_for('@groups_list') . '?page=' . $pager->getFirstPage(); ?>" id="page-<?php echo $pager->getFirstPage(); ?>">First</a></li>
            <li class="prev"><a href="<?php echo url_for('@groups_list') . '?page=' . $pager->getPreviousPage(); ?>" id="page-<?php echo $pager->getPreviousPage(); ?>">Previous</a></li>
            <?php foreach ($pager->getLinks() as $page): ?>
                <?php if ($page == $pager->getPage()): ?>
                    <?php echo '<li class="selected">' . $page . '</li>' ?>
                <?php else: ?>
                    <?php echo '<li><a href="' . url_for('@groups_list') . '?page=' . $page . '" id="page-' . $page . '">' . $page . '</a></li>'; ?>
            <?php endif; ?> 
        <?php endforeach; ?>
            <li class="next"><a href="<?php echo url_for('@groups_list') . '?page=' . $pager->getNextPage(); ?>" id="page-<?php echo $pager->getNextPage(); ?>">Next</a></li>
            <li class="last"><a href="<?php echo url_for('@groups_list') . '?page=' . $pager->getLastPage(); ?>" id="page-<?php echo $pager->getLastPage(); ?>">Last</a></li>
        </ul>
        </nav>
    <?php endif; ?>
    </div>
     <!--Pagination end--> 
    <!-- Quotes -->
    <div style="display:none;" id="lastSearchCriteria"><?php echo $lastSearchCriteria; ?></div>    
    <input type="hidden" id="currentPage" value="<?php echo $pager->getPage(); ?>"/>
