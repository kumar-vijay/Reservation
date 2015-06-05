<?php $niddle = $sf_user->getAttribute('searchNiddle'); ?>
<div id="content">
    <div class="breadcrumbs group"> 
        <ul id="breadcrumb">
            <li><a href="/">Home</a><span> >>&nbsp; </span></li>
            <li><a href="/policy/Policy">Policy Block</a><span> >>&nbsp; </span></li>
            <li class="selected">Policy Number Listing</li>
        </ul>
        <a href="/policy/Policy" id="back"></a>
    </div>

    <div class="clear"></div>
    <?php if ($sf_user->hasFlash('success')): ?>
        <div class="success"><?php echo $sf_user->getFlash('success'); ?> </div>    
    <?php endif; ?>

    <div class="container">
        <div class="box">
            <h1 class="section-header">Filter (<?php echo $numberofResults;  ?> results found)
                <div class="arrow"></div>
            </h1>
            <div class="content">
                <form method="POST" action="/policy/PolicyList" name="policyNumberListForm" id="policyNumberListForm">
                    <table width="100%" border="0" cellspacing="0" cellpadding="0">
                        <tr>
                            <td width="12%">Insured Name</td>
                            <td width="22%">
                                <input type="text" name="insuredname" id="insuredname" value="<?php echo $niddle['insuredName'];   ?>" class="txtbox-small" maxlength="50"/>
                            </td>
                            <td width="12%">Master Policy Number</td>
                            <td width="22%">
                                <input type="text" name="masterpolicynumber" id="masterpolicynumber" value="<?php echo $niddle['masterpolicynumber'];   ?>" class="txtbox-small" maxlength="20"/>
                            </td>
                            <td width="12%">Policy Number</td>
                            <td width="22%"><input type="text" name="policynumber" id="policynumber" value="<?php echo $niddle['policynumber'];   ?>" class="txtbox-small" maxlength="20"></td>
                            <td width="4%">&nbsp;</td>
                            <td width="30%">&nbsp;</td>
                        </tr>
                        <tr>
                            <td width="12%">Underwriter</td>
                            <td width="22%">
                                <select name="underwriter" id="underwriter" class="listbox-small">
                                    <option value="">--Select--</option>
                                    <?php
                                    foreach ($underwriter as $value) {
                                        if ($value['UnderwriterName'] == $niddle['underwriter'])
                                            $select = 'selected="selected"';
                                        else
                                            $select = '';
                                        ?>
                                        <option value="<?php echo $value['UnderwriterName'] ?>" <?php echo $select; ?>><?php echo $value['UnderwriterName'] ?></option>
                                    <?php } ?>
                                </select>
                            </td>
                        </tr>
                        <td align="center" colspan="6" style="padding-top: 20px;">
                            <input type="submit" value="Search" class="btn btn-blue" />
                            <input type="reset" value="Clear" class="btn btn-cyan" id="resetpolicyNumberValue" />
                        </td>
                        </tr>
                    </table>
                </form>
            </div>
        </div>
    </div>
 
    <div class="container" style="float: right">
        <?php if ($sf_user->hasCredential('VIEW_EDIT_POLICY_BLOCK')) { ?>
            <a href="/policy/CreatePolicyNumber"><input type="button" class="btn btn-blue fright" value="Generate New Policy Number" /></a>
        <?php } ?>
    </div>
    <?php if ($numberofResults) { ?>
    <div class="container" style="float: right; padding-right: inherit"><input type="button" class="btn btn-blue btn-medium export" value="Export Policy Number Details" onclick="window.location = '/policy/ExportPolicyDetails'"></div>
    <?php } ?>
    <div class="container">
        <h2>Policy Number Details List</h2>
        <div class="insured-details-list">
            <div id="policy-list-wrapper">
            <table class="dataTable">
                <thead>
                    <tr>
                        <th>Edit/View Details</th>
                        <th>Master Policy Number</th>
                        <th>Insured Name</th>
                        <th>Underwriter</th>
                        <th>Policy Effective Date</th>
                        <th>Policy Expiry Date</th>
                        <th>Product Line</th>
                        <th>Product Line Subtype</th>
                        <th>Region</th>
                        <th>Branch Office</th>
                        <th>Premium Currency</th>
                        <th>Inception Gross Premium</th>
                        <th>Commission %</th>
                        <th>Commission $</th>
                        <th>Net Premium</th>
                        <th>New/Renewal</th>
                        <th>Direct/Assumed</th>
                        <th>Company</th>
                        <th>Company Number</th>
                        <th>Admitted/Non Admitted</th>
                        <th>Admitted Details</th>
                        <th>Reinsured Company Name</th>
                        <th>Remarks</th>
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
                            <?php if ($sf_user->hasCredential('VIEW_EDIT_POLICY_BLOCK')) { ?>
                            <a href="<?php echo url_for('@edit_policy_number'). '?policyId=' . $result->getId();   ?>" style="margin-right:4px;" class="btn btn-orange btn-small" title="Edit"><i class="fa fa-pencil"></i></a>
                            <?php } ?>
                            <a href="<?php echo url_for('@view_policy_number'). '?policyId=' . $result->getId();   ?>" class="btn btn-green btn-small" title="View"><i class="fa fa-eye"></i></a>
                        </td>
                        <td><?php echo $result->getMasterpolicynumber();   ?></td>
                        <td><?php echo $result->getInsuredname();   ?></td>
                        <td><?php echo $result->getUnderwritername();   ?></td>
                        <td><?php echo date('m-d-Y', strtotime($result->getPolicyeffectivedate())); ?></td>
                        <td><?php echo date('m-d-Y', strtotime($result->getPolicyexpirydate()));   ?></td>
                        <td><?php echo $result->getProductline();   ?></td>
                        <td><?php echo $result->getProductlinesubtype();   ?></td>
                        <td><?php echo $result->getRegionname();   ?></td>
                        <td><?php echo $result->getBranchname();   ?></td>
                        <td><?php echo $result->getPolicyCurrency(); ?></td>
                        <td><?php echo $result->getInceptiongrosspremium(); ?></td>
                        <td><?php echo $result->getCommisssionpercentage(); ?></td>
                        <td><?php echo $result->getCommisssiondoller();   ?></td>
                        <td><?php echo $result->getNetpremium();   ?></td>
                        <td><?php echo $result->getNewrenewal();   ?></td>
                        <td><?php echo $result->getDirectassumed();   ?></td>
                        <td><?php echo $result->getCompany();   ?></td>
                        <td><?php echo $result->getCompanynumber();   ?></td>
                        <td><?php echo $result->getAdmittednotadmitted();   ?></td>
                        <td><?php echo $result->getAdmitteddetails();   ?></td>
                        <td><?php echo $result->getReinsuredcompany();   ?></td>
                        <td><?php echo $result->getRemarks();   ?></td>
                        <td><?php echo $result->getCreatedby();   ?></td>
                        <td><?php $crDate = $result->getCreateddate(); if(!empty($crDate)) { echo date('m-d-Y h:i', strtotime($result->getCreateddate()));} else { echo "";} ?></td>
                        <td><?php echo $result->getModifiedby();   ?></td>
                        <td><?php $moDate = $result->getModifieddate(); if(!empty($moDate)){ echo date('m-d-Y h:i', strtotime($result->getModifieddate()));} else { echo "";}?></td>
                        <?php } ?>
                    </tr>          
                    <?php
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
                <li class="first"><a href="<?php echo url_for('@policy_list') . '?page=' . $pager->getFirstPage() . '&niddle=true';  ?>" class="pagination-link" id="page-<?php echo $pager->getFirstPage();  ?>">First</a></li>
                <li class="prev"><a href="<?php echo url_for('@policy_list') . '?page=' . $pager->getPreviousPage() . '&niddle=true';  ?>" class="pagination-link" id="page-<?php echo $pager->getPreviousPage();  ?>">Previous</a></li>
                <?php foreach ($pager->getLinks() as $page): ?>
                <?php if ($page == $pager->getPage()): ?>
                <?php echo '<li class="selected">' . $page . '</li>' ?>
                <?php else: ?>
                <?php echo '<li><a href="' . url_for('@policy_list') . '?page=' . $page . '&niddle=true" class="pagination-link" id="page-' . $page . '">' . $page . '</a></li>'; ?>
                <?php endif; ?> 
                <?php endforeach; ?>
                <li class="next"><a href="<?php echo url_for('@policy_list') . '?page=' . $pager->getNextPage() . '&niddle=true';  ?>" id="page-<?php echo $pager->getNextPage();  ?>">Next</a></li>
                <li class="last"><a href="<?php echo url_for('@policy_list') . '?page=' . $pager->getLastPage() . '&niddle=true';  ?>" id="page-<?php echo $pager->getLastPage();  ?>">Last</a></li>
            </ul>
        </nav>
        <?php endif; ?>
    </div>
    <!--Pagination end--> 
    <!-- Quotes -->
</div>


