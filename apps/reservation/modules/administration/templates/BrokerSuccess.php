<?php $niddle = $sf_user->getAttribute('searchNiddle'); ?>
<link  rel="stylesheet" href="//netdna.bootstrapcdn.com/font-awesome/3.2.1/css/font-awesome.css">
<div id="content">
    <div class="breadcrumbs group"> 
        <ul id="breadcrumb">
            <li><a href="/">Home</a><span> >>&nbsp; </span></li>
            <li><a href="/admin/masterDataManagement">Master Data Management</a><span> >>&nbsp; </span></li>
            <li class="selected">Manage Broker</li>
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
                <form method="POST" action="/admin/broker" name="brokerSearchForm" id="brokerSearchForm">
                    <table width="100%" border="0" cellspacing="0" cellpadding="0">
                        <tr>
                            <td width="12%">Broker Name</td>
                            <td width="22%">
                                <input type="text" name="brokername" id="brokername" value="<?php echo $niddle['brokerName']; ?>" class="txtbox-small"/>
                            </td>
                            <td width="12%">Wholesaler/Retailer</td>
                            <td width="22%">
                                <select name="brokertype" id="brokertype" class="listbox-small">
                                    <option value="">--Select--</option>
                                    <?php
                                    foreach ($brokerType as $brokerValue) {
                                        if ($brokerValue['Alias'] == $niddle['brokerType'])
                                            $select = 'selected="selected"';
                                        else
                                            $select = '';
                                        ?>
                                        <option value="<?php echo $brokerValue['Alias']; ?>" <?php echo $select; ?>><?php echo $brokerValue['Alias']; ?></option>
                                    <?php } ?>
                                </select>          
                            </td>
                            <td width="12%">5-digit Broker Code</td>
                            <td width="22%"><input type="text" name="brokercode" id="brokercodelist" value="<?php echo $niddle['brokerCode']; ?>" class="txtbox-small"></td>
                        </tr>
                        <tr>
                            <td>Broker Country</td>
                            <td> 
                                <select name="brokercountry" id="listbrokercountry" class="listbox-small">
                                    <option value="">--Select--</option>
                                    <?php
                                    foreach ($country as $value) {
                                        if ($value['InsuredCountry'] == $niddle['brokerCountry'])
                                            $select = 'selected="selected"';
                                        else
                                            $select = '';
                                        ?>
                                        <option value="<?php echo $value['InsuredCountry'] ?>" <?php echo $select; ?>><?php echo $value['InsuredCountry'] ?></option>
                                    <?php } ?>
                                </select>
                            </td>
                            <td>Broker State</td>
                            <td> 
                                <select name="brokerstate" id="listbrokerstate" class="listbox-small">
                                    <option value="">--Select--</option>
                                    <?php
                                    foreach ($states as $state) {
                                        if ($state['FullCode'] == $niddle['brokerState'])
                                            $select = 'selected="selected"';
                                        else
                                            $select = '';
                                        ?>
                                        <option value="<?php echo $state['FullCode']; ?>" <?php echo $select; ?>><?php echo $state['FullCode']; ?></option>
                                    <?php } ?>
                                </select>
                            </td>
                            <td>Broker City</td>
                            <td> 
                                <select name="brokercity" id="listbrokercity" class="listbox-small">
                                    <option value="">--Select--</option>
                                    <?php
                                    foreach ($city as $cityvalue) {
                                        if ($cityvalue['CityFullCode'] == $niddle['brokerCity'])
                                            $select = 'selected="selected"';
                                        else
                                            $select = '';
                                        ?>
                                        <option value="<?php echo $cityvalue['CityFullCode']; ?>" <?php echo $select; ?>><?php echo $cityvalue['CityFullCode']; ?></option>
                                    <?php } ?>
                                </select>
                            </td>
                        </tr>
                        <tr>
                            <td align="center" colspan="6" style="padding-top: 20px;">
                                <input type="submit" value="Search" class="btn btn-blue" />
                                <input type="reset" value="Clear" class="btn btn-cyan" id="resetBrokerValue" /> 
                            </td>
                        </tr>
                    </table>
                </form>
            </div>
        </div>
    </div>

    <div class="container" style="float: right">
        <?php if ($sf_user->hasCredential('VIEW_EDIT_BROKER')) { ?>
            <a href="/admin/addbroker"><input type="button" class="btn btn-blue fright" value="Add Broker" /></a>
        <?php } ?>
    </div>

    <div class="container">
        <h2>Broker Details List</h2>
        <div class="insured-details-list">
            <div id="broker-list-wrapper">
                <table class="dataTable">
                    <thead>
                        <tr>
                            <th>Edit/View Details</th>
                            <th>Broker Name</th>
                            <th>5-digit Broker Code</th>
                            <th>Wholesaler/Retailer</th>
                            <th>Broker Sub-Type</th>
                            <th>Broker Country</th>
                            <th>Broker State</th>
                            <th>Broker City</th>
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
                                        <?php if ($sf_user->hasCredential('VIEW_EDIT_BROKER')) { ?>
                                            <a href="<?php echo url_for('@edit_broker') . '?brokerId=' . $result->getId(); ?>" style="margin-right:4px;" class="btn btn-orange btn-small"><i class="fa fa-pencil"></i></a>
                                        <?php } ?>
                                        <a href="<?php echo url_for('@view_broker') . '?brokerId=' . $result->getId(); ?>"class="btn btn-green btn-small"><i class="fa fa-eye"></i></a>
                                    </td>
                                    <td><?php echo $result->getBrokername(); ?></td>
                                    <td><?php echo $result->getBrokercode(); ?></td>
                                    <td><?php echo $result->getBrokertype(); ?></td>
                                    <td><?php echo $result->getBrokersubtype(); ?></td>
                                    <td><?php echo $result->getBrokercountry(); ?></td>
                                    <td><?php echo $result->getBrokerstate(); ?></td>
                                    <td><?php echo $result->getBrokercity(); ?></td>
                                    <td><?php echo $result->getCreatedby(); ?></td>
                                    <td><?php echo date('m-d-Y h:i:s', strtotime($result->getCreatedon())); ?></td>
                                    <td><?php echo $result->getModifiedby(); ?></td>
                                    <?php if ($result->getModifiedon() == '') { ?>
                                        <td></td>
                                    <?php } else { ?>
                                        <td><?php echo date('m-d-Y h:i:s', strtotime($result->getModifiedon())); ?></td>
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
                    <li class="first"><a href="<?php echo url_for('@broker_list') . '?page=' . $pager->getFirstPage() . '&niddle=true'; ?>" class="pagination-link" id="page-<?php echo $pager->getFirstPage(); ?>">First</a></li>
                    <li class="prev"><a href="<?php echo url_for('@broker_list') . '?page=' . $pager->getPreviousPage() . '&niddle=true'; ?>" class="pagination-link" id="page-<?php echo $pager->getPreviousPage(); ?>">Previous</a></li>
                    <?php foreach ($pager->getLinks() as $page): ?>
                        <?php if ($page == $pager->getPage()): ?>
                            <?php echo '<li class="selected">' . $page . '</li>' ?>
                        <?php else: ?>
                            <?php echo '<li><a href="' . url_for('@broker_list') . '?page=' . $page . '&niddle=true" class="pagination-link" id="page-' . $page . '">' . $page . '</a></li>'; ?>
                        <?php endif; ?> 
                    <?php endforeach; ?>
                    <li class="next"><a href="<?php echo url_for('@broker_list') . '?page=' . $pager->getNextPage() . '&niddle=true'; ?>" id="page-<?php echo $pager->getNextPage(); ?>">Next</a></li>
                    <li class="last"><a href="<?php echo url_for('@broker_list') . '?page=' . $pager->getLastPage() . '&niddle=true'; ?>" id="page-<?php echo $pager->getLastPage(); ?>">Last</a></li>
                </ul>
            </nav>
        <?php endif; ?>
    </div>
    <!--Pagination end--> 
    <!-- Quotes -->
</div>>


