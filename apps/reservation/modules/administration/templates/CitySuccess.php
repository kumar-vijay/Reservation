<?php $niddle = $sf_user->getAttribute('searchNiddle'); ?>
<link  rel="stylesheet" href="//netdna.bootstrapcdn.com/font-awesome/3.2.1/css/font-awesome.css">
<div id="content">
    <div class="breadcrumbs group"> 
        <ul id="breadcrumb">
            <li><a href="/">Home</a><span> >>&nbsp; </span></li>
            <li><a href="/admin/masterDataManagement">Master Data Management</a><span> >>&nbsp; </span></li>
            <li class="selected">Manage City</li>
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
                <form method="POST" action="/admin/city" name="citySearchForm" id="citySearchForm">
                    <table width="100%" border="0" cellspacing="0" cellpadding="0">
                        <tr>
                            <td width="12%">State Name</td>
                            <td width="22%">
                                <select name="liststatename" id="liststatename" class="listbox-small">
                                    <option value="">--Select--</option>
                                    <?php
                                    foreach ($state as $stateValue) {
                                        if ($stateValue['FullCode'] == $niddle['stateName'])
                                            $select = 'selected="selected"';
                                        else
                                            $select = '';
                                        ?>
                                        <option value="<?php echo $stateValue['FullCode']; ?>" <?php echo $select; ?>><?php echo $stateValue['FullCode']; ?></option>
                                    <?php } ?>
                                </select>   
                            </td>
                            <td width="12%"></td>
                            <td width="22%"></td>
                            <td width="12%">City Name</td>
                            <td width="22%"><input type="text" name="listcityname" id="listcityname" value="<?php echo $niddle['cityName']; ?>" class="txtbox-small"/></td>
                        </tr>
                        <tr>
                            <td align="center" colspan="6" style="padding-top: 20px;">
                                <input type="submit" value="Search" class="btn btn-blue" />
                                <input type="reset" value="Clear" class="btn btn-cyan" id="resetCityValue" /> 
                            </td>
                        </tr>
                    </table>
                </form>
            </div>
        </div>
    </div>

        <div class="container" style="float: right">
        <?php if ($sf_user->hasCredential('VIEW_EDIT_CITY')) { ?>
            <a href="/admin/addcity"><input type="button" class="btn btn-blue fright" value="Add City" /></a>
        <?php } ?>
    </div>

    <div class="container">
        <h2>City Details List</h2>
        <div class="insured-details-list">
            <div id="city-list-wrapper">
            <table class="dataTable">
                <thead>
                    <tr>
                        <th>Edit/View Details</th>
                        <th>State Name</th>
                        <th>City Name</th>
                        <th>Broker City Name</th>
                        <th>Retail Broker City Name</th>
                        <th>Created By</th>
                        <th>Created On</th>
                        <th>Modified By</th>
                        <th>Modified On</th>
                    </tr>
                </thead> 
                <tbody>
                    <?php
                    if ($numberofResults != 0) {
                        foreach ($pager->getResults() as $result) {
                            ?>
                            <tr> 
                                <td>
                                    <?php if ($sf_user->hasCredential('VIEW_EDIT_CITY')) { ?>
                                        <a href="<?php echo url_for('@edit_city') . '?cityId=' . $result->getId(); ?>" style="margin-right:4px;" class="btn btn-orange btn-small"><i class="fa fa-pencil"></i></a>
                                    <?php } ?>
                                    <a href="<?php echo url_for('@view_city') . '?cityId=' . $result->getId(); ?>" class="btn btn-green btn-small"><i class="fa fa-eye"></i></a>
                                </td>
                                <td><?php echo $result->getStatename(); ?></td>
                                <td><?php echo $result->getCityname(); ?></td>
                                <td><?php echo $result->getBrokercityname(); ?></td>
                                <td><?php echo $result->getRetailbrokercity(); ?></td>
                                <td><?php echo $result->getCreatedby(); ?></td>
                                <td><?php $crdate = $result->getCreatedon(); if (!empty($crdate)) {echo date('m-d-Y h:i', strtotime($result->getCreatedon()));}else {echo "";} ?></td>
                                <td><?php echo $result->getModifiedby(); ?></td>
                                <?php $modate = $result->getModifiedon(); if (empty($modate)) { ?>
                                    <td></td>
                                <?php } else { ?>
                                    <td><?php echo date('m-d-Y h:i', strtotime($result->getModifiedon())); ?></td>
                                <?php } ?>
                            </tr>          
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
                    <li class="first"><a href="<?php echo url_for('@city_list') . '?page=' . $pager->getFirstPage() . '&niddle=true'; ?>" class="pagination-link" id="page-<?php echo $pager->getFirstPage(); ?>">First</a></li>
                    <li class="prev"><a href="<?php echo url_for('@city_list') . '?page=' . $pager->getPreviousPage() . '&niddle=true'; ?>" class="pagination-link" id="page-<?php echo $pager->getPreviousPage(); ?>">Previous</a></li>
                    <?php foreach ($pager->getLinks() as $page): ?>
                        <?php if ($page == $pager->getPage()): ?>
                            <?php echo '<li class="selected">' . $page . '</li>' ?>
                        <?php else: ?>
                            <?php echo '<li><a href="' . url_for('@city_list') . '?page=' . $page . '&niddle=true" class="pagination-link" id="page-' . $page . '">' . $page . '</a></li>'; ?>
                        <?php endif; ?> 
                    <?php endforeach; ?>
                    <li class="next"><a href="<?php echo url_for('@city_list') . '?page=' . $pager->getNextPage() . '&niddle=true'; ?>" id="page-<?php echo $pager->getNextPage(); ?>">Next</a></li>
                    <li class="last"><a href="<?php echo url_for('@city_list') . '?page=' . $pager->getLastPage() . '&niddle=true'; ?>" id="page-<?php echo $pager->getLastPage(); ?>">Last</a></li>
                </ul>
            </nav>
        <?php endif; ?>
    </div>
    <!--Pagination end--> 
    <!-- Quotes -->
</div>>


