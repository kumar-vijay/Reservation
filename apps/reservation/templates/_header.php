<div class="wrapper-outer">
<div id="header" class="group">
        <div id="logo" class="fleft">
                <a href="/"><?php echo image_tag('logo.png', array("alt" => "Berkshire Hathaway Specialty Insurance", "title" => "Berkshire Hathaway Specialty Insurance")) ?></a>
        </div>
    <?php
    $actions = array("signIn","SignIn","ForgotPassword", "forgotPassword");
    $headers=$sf_params->get('action');
    if (!in_array($headers,$actions)) {
    ?>
    <div class="navigation">
    <ul id="login-menu">
        <li><a> Welcome <?php echo $sf_user->getAttribute('name') ?></a>
            <ul id="sub-menu">
                <li><a href="/user/changePassword">Change Password</a></li>
                <li><a href="/user/signOut">Logout</a></li>
            </ul> 
       </li>
    </ul>
    <!-- Navigation -->
    <ul id="nav">
        <?php if($sf_user->hasCredential('VIEW_SUBMISSION') || $sf_user->hasCredential('VIEW_EDIT_SUBMISSION') || $sf_user->hasCredential('VIEW_QCSUBMISSION')): ?>
        <?php if(in_array( $headers, array('Submission', 'List', 'createSubmission', 'editSubmission', 'viewSubmission', 'QCList', 'QCView', 'submissionHistory'))){$class="class='active'";} ?>
        <li>
            <?php if($sf_user->hasCredential('VIEW_SUBMISSION') || $sf_user->hasCredential('VIEW_EDIT_SUBMISSION') || $sf_user->hasCredential('VIEW_QCSUBMISSION')): ?>
            <a href="/submission/Submission" title="Submission" <?php echo $class ?> id="subnav">Submission</a>
            <?php else: ?>
            <a href="javascript:void(0)" title="Submission" <?php echo $class ?> id="subnav">Submission</a>
            <?php endif ?>
            <ul class="menu display-none">
                <?php if($sf_user->hasCredential('VIEW_SUBMISSION') || $sf_user->hasCredential('VIEW_EDIT_SUBMISSION')): ?>
                <li><a class="submissionLink" href="/submission/List">Submission Listing</a></li>
                <?php endif ?>
                <?php if($sf_user->hasCredential('VIEW_EDIT_SUBMISSION')): ?>
                <li><a href="/submission/createSubmission">Create Submission</a></li>
                <?php endif ?>
                <?php if($sf_user->hasCredential('VIEW_QCSUBMISSION')): ?>
                 <li><a href="/submission/QCList">Submission QC Queue List</a></li>
                <?php endif ?>
                <?php if($sf_user->hasCredential('QC_AMENDMENT_LIST')): ?>
                 <li><a href="/submission/QCAmendmentList">Amendment QC Queue List</a></li>
                <?php endif ?>
            </ul>
        </li>
        <?php endif ?>
        
        <?php if($sf_user->hasCredential('VIEW_GROUP_LIST') || $sf_user->hasCredential('VIEW_USER_LIST') || $sf_user->hasCredential('VIEW_EDIT_GROUP') || $sf_user->hasCredential('VIEW_EDIT_USER')): ?>
        <?php if(in_array( $headers, array('admin','users', 'editUser', 'addUser', 'viewUser','groups','addGroup','editGroup', 'viewGroup'))){$classes="class='active'";} ?>
        <li>
            <?php if($sf_user->hasCredential('VIEW_GROUP_LIST') || $sf_user->hasCredential('VIEW_USER_LIST') || $sf_user->hasCredential('VIEW_BROKER_LIST') || $sf_user->hasCredential('VIEW_CONTACTPERSON_LIST') || $sf_user->hasCredential('VIEW_INSURED_LIST') || $sf_user->hasCredential('VIEW_RENEWAL_REFERENCE_LIST') || $sf_user->hasCredential('VIEW_EDIT_GROUP') || $sf_user->hasCredential('VIEW_EDIT_USER')|| $sf_user->hasCredential('VIEW_EDIT_INSURED') || $sf_user->hasCredential('VIEW_EDIT_BROKER') || $sf_user->hasCredential('VIEW__EDIT_CONTACTPERSON')|| $sf_user->hasCredential('VIEW_EDIT_RENEWAL_REFERENCE')): ?>
            <a href="/admin/manageadmin" title="Admin" id="usernav" <?php echo $classes ?> >Admin</a>
            <?php else: ?>
            <a href="javascript:void(0)" title="Admin" id="usernav"  <?php echo $classes ?>>Admin</a>
            <?php endif ?>
            <ul class="menu display-none admin-dropdown">
                <?php if($sf_user->hasCredential('VIEW_GROUP_LIST')|| $sf_user->hasCredential('VIEW_EDIT_GROUP')): ?>
                <li><a href="/admin/groups">Manage Groups</a></li>
                <?php endif ?>
                <?php if($sf_user->hasCredential('VIEW_USER_LIST') || $sf_user->hasCredential('VIEW_EDIT_USER')): ?>
                <li><a href="/admin/users">Manage Users</a></li>
                <?php endif ?>
            </ul>
        </li>
        <?php endif ?>
        
        <?php if($sf_user->hasCredential('VIEW_INSURED_LIST') || $sf_user->hasCredential('VIEW_BROKER_LIST') || $sf_user->hasCredential('VIEW_CONTACTPERSON_LIST') || $sf_user->hasCredential('VIEW_RENEWAL_REFERENCE_LIST') || $sf_user->hasCredential('VIEW_EDIT_INSURED') || $sf_user->hasCredential('VIEW_EDIT_BROKER') || $sf_user->hasCredential('VIEW__EDIT_CONTACTPERSON')|| $sf_user->hasCredential('VIEW_EDIT_RENEWAL_REFERENCE') || $sf_user->hasCredential('VIEW_UNDERWRITER_LIST') || $sf_user->hasCredential('VIEW_EDIT_UNDERWRITER') || $sf_user->hasCredential('VIEW_COUNTRY_LIST') || $sf_user->hasCredential('VIEW_EDIT_COUNTRY') || $sf_user->hasCredential('VIEW_STATE_LIST') || $sf_user->hasCredential('VIEW_EDIT_STATE') || $sf_user->hasCredential('VIEW_CITY_LIST') || $sf_user->hasCredential('VIEW_EDIT_CITY')): ?>
        <?php if(in_array( $headers, array('Insured', 'AddInsured','EditInsured','ViewInsured', 'Broker','AddBroker','EditBroker','ViewBroker','ContactPerson','AddContactPerson','EditContactPerson','ViewContactPerson','RenewalReference','AddRenewalReference','EditRenewalReference','ViewRenewalReference','Underwriter','AddUnderwriter','EditUnderwriter','ViewUnderwriter','MasterDataManagement','Country','AddCountry','EditCountry','ViewCountry','State','AddState','EditState','ViewState','City','AddCity','EditCity','ViewCity'))){$classess="class='active'";} ?>
        <li>
            <?php if($sf_user->hasCredential('VIEW_INSURED_LIST') || $sf_user->hasCredential('VIEW_BROKER_LIST') || $sf_user->hasCredential('VIEW_CONTACTPERSON_LIST') || $sf_user->hasCredential('VIEW_RENEWAL_REFERENCE_LIST') || $sf_user->hasCredential('VIEW_EDIT_INSURED') || $sf_user->hasCredential('VIEW_EDIT_BROKER') || $sf_user->hasCredential('VIEW__EDIT_CONTACTPERSON')|| $sf_user->hasCredential('VIEW_EDIT_RENEWAL_REFERENCE') || $sf_user->hasCredential('VIEW_UNDERWRITER_LIST') || $sf_user->hasCredential('VIEW_EDIT_UNDERWRITER')|| $sf_user->hasCredential('VIEW_COUNTRY_LIST') || $sf_user->hasCredential('VIEW_EDIT_COUNTRY') || $sf_user->hasCredential('VIEW_STATE_LIST') || $sf_user->hasCredential('VIEW_EDIT_STATE') || $sf_user->hasCredential('VIEW_CITY_LIST') || $sf_user->hasCredential('VIEW_EDIT_CITY')): ?>
            <a href="/admin/masterDataManagement" title="Master Data Management" id="usernav" <?php echo $classess ?> >Master Data Management</a>
            <?php else: ?>
            <a href="javascript:void(0)" title="Master Data Management" id="usernav"  <?php echo $classess ?>>Master Data Management</a>
            <?php endif ?>
            <ul class="menu display-none admin-dropdown">
                <?php if($sf_user->hasCredential('VIEW_COUNTRY_LIST')|| $sf_user->hasCredential('VIEW_EDIT_COUNTRY')): ?>
                <li><a href="/admin/country">Manage Country</a></li>
                <?php endif ?>
                <?php if($sf_user->hasCredential('VIEW_STATE_LIST')|| $sf_user->hasCredential('VIEW_EDIT_STATE')): ?>
                <li><a href="/admin/state">Manage State</a></li>
                <?php endif ?>
                <?php if($sf_user->hasCredential('VIEW_CITY_LIST')|| $sf_user->hasCredential('VIEW_EDIT_CITY')): ?>
                <li><a href="/admin/city">Manage City</a></li>
                <?php endif ?>
                <?php if($sf_user->hasCredential('VIEW_UNDERWRITER_LIST')|| $sf_user->hasCredential('VIEW_EDIT_UNDERWRITER')): ?>
                <li><a href="/admin/underwriter">Manage Underwriter</a></li>
                <?php endif ?>
                <?php if($sf_user->hasCredential('VIEW_BROKER_LIST')|| $sf_user->hasCredential('VIEW_EDIT_BROKER')): ?>
                <li><a href="/admin/broker">Manage Broker</a></li>
                <?php endif ?>
                <?php if($sf_user->hasCredential('VIEW_INSURED_LIST')|| $sf_user->hasCredential('VIEW_EDIT_INSURED')): ?>
                <li><a href="/admin/insured">Manage Insured</a></li>
                <?php endif ?>
                 <?php if($sf_user->hasCredential('VIEW_CONTACTPERSON_LIST')|| $sf_user->hasCredential('VIEW__EDIT_CONTACTPERSON')): ?>
                <li><a href="/admin/contactperson">Manage Contact Person</a></li>
                <?php endif ?>
                <?php if($sf_user->hasCredential('VIEW_RENEWAL_REFERENCE_LIST')|| $sf_user->hasCredential('VIEW_EDIT_RENEWAL_REFERENCE')): ?>
                <li><a href="/admin/renewalreference">Manage Renewal Reference</a></li>
                <?php endif ?>
            </ul>
        </li>
        <?php endif ?>
        
        <?php if($sf_user->hasCredential('VIEW_POLICY_BLOCK_LIST') || $sf_user->hasCredential('VIEW_EDIT_POLICY_BLOCK')): ?>
        <?php if(in_array( $headers, array('Policy', 'CreatePolicyNumber', 'PolicyList','EditPolicyNumber','ViewPolicyNumber','ViewPolicyHistory','PolicyHistory'))){$classe="class='active'";} ?>
        <li>
            <?php if($sf_user->hasCredential('VIEW_POLICY_BLOCK_LIST') || $sf_user->hasCredential('VIEW_EDIT_POLICY_BLOCK')): ?>
            <a href="/policy/Policy" title="PolicyBlockManagement" <?php echo $classe ?>>Policy Block</a>
            <?php else: ?>
            <a href="javascript:void(0)" title="PolicyBlockManagement" <?php echo $classe ?> >Policy Block</a>
            <?php endif ?>
            <ul class="menu display-none">
                <?php if($sf_user->hasCredential('VIEW_POLICY_BLOCK_LIST') || $sf_user->hasCredential('VIEW_EDIT_POLICY_BLOCK')): ?>
                <li><a class="submissionLink" href="/policy/PolicyList">Policy Number Listing</a></li>
                <?php endif ?>
                <?php if($sf_user->hasCredential('VIEW_EDIT_POLICY_BLOCK')): ?>
                <li><a href="/policy/CreatePolicyNumber">Generate New Policy Number</a></li>
                <?php endif ?>
            </ul>
        </li> 
        <?php endif ?>
        
        <?php if($sf_user->hasCredential('VIEW_REPORT') || $sf_user->hasCredential('VIEW_EDIT_REPORT')): ?>
        <?php if(in_array( $headers, array('report','accountMultipleLines', 'accountSummary','consolidatedBrokerReport','individualBrokerReport','monthlyReport','submissionSummaryExhibitReport','underwriterPerformanceReport'))){$reportclass="class='active'";} ?>
        <li>
            <?php if($sf_user->hasCredential('VIEW_REPORT') || $sf_user->hasCredential('VIEW_EDIT_REPORT')): ?>
            <a href="/report/report" title="KPI Reports" <?php echo $reportclass ?>>KPI Reports</a>
            <?php else: ?>
            <a href="javascript:void(0)" title="KPI Reports" <?php echo $reportclass ?> >KPI Reports</a>
            <?php endif ?>
            <ul class="menu display-none">
                <?php if($sf_user->hasCredential('VIEW_REPORT') || $sf_user->hasCredential('VIEW_EDIT_REPORT')): ?>
                <li><a class="submissionLink" href="/report/accountMultipleLines">Accounts on Multiple Lines</a></li>
                <?php endif ?>
                <?php if($sf_user->hasCredential('VIEW_REPORT') || $sf_user->hasCredential('VIEW_EDIT_REPORT')): ?>
                <li><a class="submissionLink" href="/report/accountSummary">Accounts Summary</a></li>
                <?php endif ?>
                <?php if($sf_user->hasCredential('VIEW_REPORT') || $sf_user->hasCredential('VIEW_EDIT_REPORT')): ?>
                <li><a class="submissionLink" href="/report/consolidatedBrokerReport">Consolidate Broker Report</a></li>
                <?php endif ?>
                <?php if($sf_user->hasCredential('VIEW_REPORT') || $sf_user->hasCredential('VIEW_EDIT_REPORT')): ?>
                <li><a class="submissionLink" href="/report/individualBrokerReport">Individual Broker Report</a></li>
                <?php endif ?>
                <?php if($sf_user->hasCredential('VIEW_REPORT') || $sf_user->hasCredential('VIEW_EDIT_REPORT')): ?>
                <li><a class="submissionLink" href="/report/monthlyReport">Monthly Report</a></li>
                <?php endif ?>
                <?php if($sf_user->hasCredential('VIEW_REPORT') || $sf_user->hasCredential('VIEW_EDIT_REPORT')): ?>
                <li><a class="submissionLink" href="/report/submissionSummaryExhibitReport">Submission Summary Exhibit</a></li>
                <?php endif ?>
                <?php if($sf_user->hasCredential('VIEW_REPORT') || $sf_user->hasCredential('VIEW_EDIT_REPORT')): ?>
                <li><a class="submissionLink" href="/report/underwriterPerformanceReport">Underwriter Performance</a></li>
                <?php endif ?>
            </ul>
        </li>
        <?php endif ?> 
    </ul>
    <!-- Navigation Ends -->
    </div>
    <?php
    }
    ?>
    </div>