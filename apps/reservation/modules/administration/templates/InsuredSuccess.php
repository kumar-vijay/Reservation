<?php $niddle = $sf_user->getAttribute('searchNiddle'); ?>
<link  rel="stylesheet" href="//netdna.bootstrapcdn.com/font-awesome/3.2.1/css/font-awesome.css">
<div id="content">
<div class="breadcrumbs group"> 
    <ul id="breadcrumb">
        <li><a href="/">Home</a><span> >>&nbsp; </span></li>
        <li><a href="/admin/masterDataManagement">Master Data Management</a><span> >>&nbsp; </span></li>
        <li class="selected">Manage Insured</li>
    </ul>
    <a href="/admin/masterDataManagement" id="back"></a>
</div>

<div class="clear"></div>
<?php if ($sf_user->hasFlash('success')): ?>
    <div class="success"><?php echo $sf_user->getFlash('success'); ?> </div>    
<?php endif; ?>

<div class="container">
    <div class="box">
        <h1 class="section-header">Filter (<?php echo $numberofResults; ?> results found)
            <div class="arrow"></div>
        </h1>
        <div class="content">
            <form method="POST" action="/admin/insured" name="insuredSearchForm" id="insuredSearchForm">
                <table width="100%" border="0" cellspacing="0" cellpadding="0">
                    <tr>
                        <td width="12%">Insured Name</td>
                        <td width="22%">
                            <input type="text" name="insuredname" id="insuredname" value="<?php echo $niddle['insuredName']; ?>" class="txtbox-small"/>
                        </td>
                        <td width="12%">D&B Number</td>
                        <td width="22%">
                            <input type="text" name="insureddbnumber" id="insureddbnumber" value="<?php echo $niddle['insuredDBNumber']; ?>" class="txtbox-small"/>
                        </td>
                        <td width="12%">Address Line 1</td>
                        <td width="22%"><input type="text" name="insuredaddress" id="insuredaddress" value="<?php echo $niddle['insuredaddress']; ?>" class="txtbox-small"></td>
                        <td width="4%">&nbsp;</td>
                        <td width="30%">&nbsp;</td>
                    </tr>
                    <tr>
                        <td>Country</td>
                        <td> 
                            <select name="insuredcountry" id="insuredcountry" class="listbox-small">
                                <option value="">--Select--</option>
                                <?php
                                foreach ($country as $value) {
                                    if ($value['Country'] == $niddle['insuredCountry'])
                                        $select = 'selected="selected"';
                                    else
                                        $select = '';
                                    ?>
                                    <option value="<?php echo $value['Country'] ?>" <?php echo $select; ?>><?php echo $value['Country'] ?></option>
                                <?php } ?>
                            </select>
                        </td>
                        <td>State</td>
                        <td> 
                            <select name="insuredstate" id="insuredstate" class="listbox-small">
                                <option value="">--Select--</option>
                                <?php
                                foreach ($states as $state) {
                                    if ($state['State'] == $niddle['insuredState'])
                                        $select = 'selected="selected"';
                                    else
                                        $select = '';
                                ?>
                                    <option value="<?php echo $state['State']; ?>" <?php echo $select; ?>><?php echo $state['State']; ?></option>
                                <?php } ?>
                            </select>
                        </td>
                        <td>City</td>
                        <td> 
                            <select name="insuredcity" id="insuredcity" class="listbox-small">
                                <option value="">--Select--</option>
                                <?php
                                foreach ($city as $cityvalue) {
                                    if ($cityvalue['City'] == $niddle['insuredCity'])
                                        $select = 'selected="selected"';
                                    else
                                        $select = '';
                                ?>
                                    <option value="<?php echo $cityvalue['City']; ?>" <?php echo $select; ?>><?php echo $cityvalue['City']; ?></option>
                                <?php } ?>
                            </select>
                        </td>
                    </tr>
                    <tr>
                        <td width="12%">Advisen ID</td>
                        <td width="22%">
                            <input type="text" name="advisenid" id="advisenid" value="<?php echo $niddle['advisenID']; ?>" class="txtbox-small"/>
                        </td>
                        <td>Status</td>
                        <td> 
                            <select name="insuredstatus" id="insuredstatus" class="listbox-small">
                                <option value="">--Select--</option>
                                <?php
                                foreach ($status as $value) {
                                    if ($value['Alias'] == $niddle['insuredStatus'])
                                        $select = 'selected="selected"';
                                    else
                                        $select = '';
                                ?>
                                    <option value="<?php echo $value['Alias']; ?>" <?php echo $select; ?>><?php echo $value['Alias']; ?></option>
                                <?php } ?>
                            </select>
                        </td>
                    </tr>
                    <tr>
                        <td align="center" colspan="6" style="padding-top: 20px;">
                            <input type="submit" value="Search" class="btn btn-blue" />
                            <input type="reset" value="Clear" class="btn btn-cyan" id="resetInsuredValue" />
                        </td>
                    </tr>
                </table>
            </form>
        </div>
    </div>
</div>

<div class="container" style="float: right">
    <?php if($sf_user->hasCredential('VIEW_EDIT_INSURED')){ ?>
    <a href="/admin/addinsured"><input type="button" class="btn btn-blue fright" value="Add Insured" /></a>
    <?php } ?>
</div>

<div class="container">
    <h2>Insured Details List</h2>
    <div class="insured-details-list">
        <div id="insured-list-wrapper">
        <table class="dataTable">
            <thead>
                <tr>
                    <th>Edit/View Details</th>
                    <th>Insured name</th>
                    <th>Address Line 1</th>
                    <th>Country</th>
                    <th>State</th>
                    <th>City</th>
                    <th>D&B Number</th>
                    <th>Advisen Id</th>
                    <th>Status</th>
                    <th>Created By</th>
                    <th>Created On</th>
                    <th>Modified By</th>
                    <th>Modified On</th>
                </tr>
            </thead> 
            <tbody>
                <?php
                if ($numberofResults != 0) {
                    foreach ($pager->getResults() as $result) { ?>
                     <?php  //$id = $result->getInsuredparentid();if($id == 0){ ?>
                        <tr> 
                            <td>
                                <?php if($sf_user->hasCredential('VIEW_EDIT_INSURED')){ ?>
                                   <a href="<?php echo url_for('@edit_insured') . '?insuredId=' . $result->getId(); ?>" style="margin-right:4px;" class="btn btn-orange btn-small"><i class="fa fa-pencil"></i></a>
                                <?php } ?>
                                 <a href="<?php echo url_for('@view_insured') . '?insuredId=' . $result->getId(); ?>" class="btn btn-green btn-small"><i class="fa fa-eye"></i></a>
                                <?php if($sf_user->hasCredential('VIEW_EDIT_INSURED')){ ?>
                                  <?php $parentId = $result->getInsuredparentid(); if($parentId == 0){ ?>
                                   <a href="<?php echo url_for('@clone_insured') . '?insuredId=' . $result->getId(); ?>" class="btn btn-endorsement btn-small"><i class="fa fa-user-plus"></i></a> 
                                  <?php }?>
                                  <?php $insuredparentCount = $result->getInsuredCount(); if($insuredparentCount > 0){ ?>
                                  <button class="btn btn-small btn-gray open fa fa-plus" id="<?php echo $result->getId(); ?>"></button>
                                  <?php }?>
                                <?php } ?>
                            </td>
                            <td><?php echo $result->getInsuredName(); ?></td>
                            <td><?php echo $result->getAddress(); ?></td>
                            <td><?php echo $result->getInsuredcountry(); ?></td>
                            <td><?php echo $result->getInsuredstate(); ?></td>
                            <td><?php echo $result->getInsuredcity(); ?></td>
                            <td><?php echo $result->getDBNumber(); ?></td>
                            <td><?php echo $result->getAdvisenId(); ?></td>
                            <td><?php echo $result->getInsuredstatus(); ?></td>
                            <td><?php echo MyReservationUser::getUserNameFromID($result->getCreatedBy()); ?></td>
                            <td><?php echo date('m-d-Y h:i:s', strtotime($result->getCreatedOn())); ?></td>
                            <td><?php echo MyReservationUser::getUserNameFromID($result->getModifiedBy()); ?></td>
                            <?php if ($result->getModifiedOn() == '') { ?>
                                <td></td>
                            <?php } else { ?>
                                <td><?php echo date('m-d-Y h:i:s', strtotime($result->getModifiedOn())); ?></td>
                            <?php } ?>
                        </tr>
                      <?php// } ?>
                        <?php
                    }
                } else {
                    ?>
                    <tr>
                        <td colspan="11" align="center" class="login-error">Sorry, No Record Found.</td>
                    </tr>
                    <?php
                }
                ?>
            </tbody>
        </table>
    </div>
    </div>
</div>
 <div class="container">
<?php if ($pager->haveToPaginate()): ?>
    <!--Pagination start-->
    <nav class="pagination-wrapper">
    <ul class="pagination">
        <li class="first"><a href="<?php echo url_for('@insured_list') . '?page=' . $pager->getFirstPage() . '&niddle=true'; ?>" class="pagination-link" id="page-<?php echo $pager->getFirstPage(); ?>">First</a></li>
         <li class="prev"><a href="<?php echo url_for('@insured_list') . '?page=' . $pager->getPreviousPage() . '&niddle=true'; ?>" class="pagination-link" id="page-<?php echo $pager->getPreviousPage(); ?>">Previous</a></li>
        <?php foreach ($pager->getLinks() as $page): ?>
            <?php if ($page == $pager->getPage()): ?>
                <?php echo '<li class="selected">' . $page . '</li>' ?>
            <?php else: ?>
                <?php echo '<li><a href="' . url_for('@insured_list') . '?page=' . $page . '&niddle=true" class="pagination-link" id="page-' . $page . '">' . $page . '</a></li>'; ?>
            <?php endif; ?> 
        <?php endforeach; ?>
        <li class="next"><a href="<?php echo url_for('@insured_list') . '?page=' . $pager->getNextPage() . '&niddle=true'; ?>" id="page-<?php echo $pager->getNextPage(); ?>">Next</a></li>
        <li class="last"><a href="<?php echo url_for('@insured_list') . '?page=' . $pager->getLastPage() . '&niddle=true'; ?>" id="page-<?php echo $pager->getLastPage(); ?>">Last</a></li>
    </ul>
    </nav>
<?php endif; ?>
</div>
<!--Pagination end--> 
<!-- Quotes -->
</div>


