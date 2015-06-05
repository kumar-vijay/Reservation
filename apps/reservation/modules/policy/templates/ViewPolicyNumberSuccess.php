<div id="content" class="view">
    <div class="breadcrumbs group"> 
        <ul id="breadcrumb">
            <li><a href="/">Home</a><span> >>&nbsp; </span></li>
            <li><a href="/policy/Policy">Policy Block</a><span> >>&nbsp; </span></li>
            <li><a href="/policy/PolicyList">Policy Number Listing</a><span> >>&nbsp; </span></li>
            <li class="selected">View Policy Number</li>
        </ul>
        <a href="/policy/PolicyList" id="back"></a>
    </div>
    <div class="clear"></div>
    <div style="text-align: center; font-weight: bold;">New Policy Number</div>  
    <div class="container">
        <ul class="tabbed-menu">
            <li class="active"><a href="/policy/ViewPolicyNumber?policyId=<?php echo $policyId; ?>">View Policy Number Details</a></li>
            <li><a href="/policy/ViewPolicyHistory?policyId=<?php echo $policyId; ?>">History</a></li>
        </ul>	
        <div class="dates">
            <em>Created Date: <strong><?php if (!empty($recorderData[0]['CreatedOn'])) {
                echo date("m-d-Y", strtotime($recorderData[0]['CreatedOn']));
            } else {
                echo "";
            } ?></strong></em>
                        <em>Updated Date: <strong><?php if (!empty($recorderData[0]['ModifiedOn'])) {
                echo date("m-d-Y", strtotime($recorderData[0]['ModifiedOn']));
            } else {
                echo "";
            } ?></strong></em>
        </div>
        <div class="clear"></div>
    </div>

    <div class="container">
        <div class="box">
            <h1 class="section-header">Basic Details
                <div class="arrow"></div>
            </h1>
            <div class="content" style="display: block;">
                <table width="100%" border="0" cellspacing="0" cellpadding="0">
                    <tr>
                        <td>Region:</td>
                        <td><?php echo $result['REGION']; ?></td>
                        <td>Branch Office:</td>
                        <td><?php echo $result['BRANCH']; ?></td>
                        <td width="12%">Product Line:</td>
                        <td width="22%"><?php echo $result['PRODUCT_LINE']; ?></td>
                    </tr>
                    <tr>
                        <td width="12%">Product Line Subtype:</td>
                        <td width="22%"><?php echo $result['PRODUCT_LINE_SUBTYPE']; ?></td>
                        <td width="12%">Underwriter:</td>
                        <td width="22%"><?php echo $result['UNDERWRITER']; ?></td>
                        <td width="12%">Insured Name:</td>
                        <td width="22%"><?php echo $result['INSURED_NAME']; ?></td>
                    </tr>
                    <tr>
                        <td>Reinsured Company:</td>
                        <td><?php echo $result['REINSURED_COMPANY']; ?></td>
                        <td>Remarks:</td>
                        <td style="word-wrap: break-word; word-break: break-all;white-space: normal;"><?php echo $result['REMARKS']; ?></td>
                    </tr>
                </table>
            </div>
        </div>
    </div>

    <div class="container" id="project_details">
        <div class="box">
            <h1 class="section-header">Policy Details
                <div class="arrow"></div>
            </h1>
            <div class="content" style="display: block;">
                <table width="100%" border="0" cellspacing="0" cellpadding="0">
                    <tr>
                        <td width="12%">Direct/Assumed:</td>
                        <td width="22%"><?php echo $result['DIRECT_ASSUMED']; ?></td>
                        <td width="12%">Admitted/Non-Admitted:</td>
                        <td width="22%"><?php echo $result['ADMITTED_NONADMITTED']; ?></td>
                        <td width="12%">Admitted Details:</td>
                        <td><?php echo $result['ADMITTED_DETAILS']; ?></td>
                    </tr>
                    <tr>
                        <td>Company:</td>
                        <td><?php echo $result['COMPANY']; ?></td>
                        <td>Company Number:</td>
                        <td><?php echo $result['COMPANY_NUMBER']; ?></td>
                        <td>Prefix:</td>
                        <td><?php echo $result['PREFIX']; ?></td>
                    </tr>
                    <tr>
                        <td>Policy Effective Date:</td>
                        <td>
                            <?php
                            if (!empty($result['POLICY_EFFECTIVE_DATE'])) {
                                echo date("m-d-Y", strtotime($result['POLICY_EFFECTIVE_DATE']));
                            } else {
                                echo "";
                            }
                            ?>
                            </td>
                            <td>Policy Expiry Date:</td>
                            <td>
                            <?php
                            if (!empty($result['POLICY_EXPIRY_DATE'])) {
                                echo date("m-d-Y", strtotime($result['POLICY_EXPIRY_DATE']));
                            } else {
                                echo "";
                            }
                            ?>
                        </td>
                    </tr>
                </table>
            </div>
        </div>
    </div>
    <div class="container">
        <div class="box">
            <h1 class="section-header">Premium Details
                <div class="arrow"></div>
            </h1>
            <div class="content" style="display: block;">
                <table width="100%" border="0" cellspacing="0" cellpadding="0">
                    <tr>
                        <td width="12%">Premium Currency:</td>
                        <td width="22%"><?php echo $result['PREMIUM_CURRENCY']; ?></td>
                        <td width="12%">Inception Gross Premium:</td>
                        <td width="22%"><?php echo $result['GROSS_PREMIUM']; ?></td>
                        <td width="15%">Commission %:</td>
                        <td width="22%"><?php echo $result['COMMISION_PERCENTAGE']; ?></td>
                    </tr>
                    <tr>
                        <td width="12%">Commission $</td>
                        <td width="22%"><?php echo $result['COMMISION_DOLLER']; ?></td>
                        <td>Net Premium:</td>
                        <td><?php echo $result['NET_PREMIUM']; ?></td>
                    </tr>
                </table>
            </div>
        </div>
    </div>
    <div class="container">
        <table width="100%" cellpadding="0" cellspacing="0">
            <tr>
                <td align="center">
                    <a href="/policy/PolicyList"><input type="button" class="btn btn-blue" value="Back" /></a>
                </td>
            </tr>
        </table>
    </div>
</div>

