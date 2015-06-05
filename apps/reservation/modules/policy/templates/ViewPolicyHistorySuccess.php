<div id="content" class="view">
    <div class="breadcrumbs group"> 
        <ul id="breadcrumb">
            <li><a href="/">Home</a><span> >>&nbsp; </span></li>
            <li><a href="/policy/Policy">Policy Block</a><span> >>&nbsp; </span></li>
            <li><a href="/policy/PolicyList">Policy Number Listing</a><span> >>&nbsp; </span></li>
            <li class="selected">View History</li>
        </ul>
        <a href="/policy/PolicyList" id="back"></a>
    </div>
    <div class="container">
        <ul class="tabbed-menu">
            <li><a href="/policy/ViewPolicyNumber?policyId=<?php echo $policyId; ?>">View Policy Number Details</a></li>
            <li class="active"><a href="/policy/ViewPolicyHistory?policyId=<?php echo $policyId; ?>">History</a></li>
        </ul>   
        <div class="dates">
            <em>Created Date: <strong><?php if (!empty($recorderData[0]['CreatedOn'])) { echo date("m-d-Y", strtotime($recorderData[0]['CreatedOn'])); } else { echo "";} ?></strong></em>
            <em>Updated Date: <strong><?php if (!empty($recorderData[0]['ModifiedOn'])) {echo date("m-d-Y", strtotime($recorderData[0]['ModifiedOn']));} else { echo "";} ?></strong></em>
        </div>
        <div class="clear"></div>
    </div>

 <?php foreach ($historyData as $result) { ?>
        <div class="container">
            <div class="box">
                <h1 class="section-header">Updated By <?php echo $result['ModifiedBy']; ?> <em class="dateTime">Date & Time: <strong><?php if ($result['ModifiedOn'] != '') {
                echo date("m-d-Y h:i:s A", strtotime($result['ModifiedOn']));
                } else {
                 echo '';
                } ?></strong></em><div class="arrow"></div></h1>
                    <div class="content" style="display: block;">
                        <table cellpadding="0" cellspacing="0" width="100%">
                            <tr>
                                <td width="20%">&nbsp;</td>
                                <td width="30%">Old Value</td>
                                <td width="30%">New Value</td>
                            </tr>
                            <?php if(trim($result['InsuredName']) != trim($result['NewInsuredName'])){ ?>
                            <tr>
                                <td width="20%" height="35"><?php echo "InsuredName"; ?></td>
                                <td width="30%"><?php echo $result['InsuredName']; ?></td>
                                <td width="30%"><?php echo $result['NewInsuredName']; ?></td>
                            </tr>
                            <?php } ?>
                            <?php if(trim($result['ProductLineId']) != trim($result['New_ProductLineId'])){ ?>
                            <tr>
                                <td width="20%" height="35"><?php echo "Product Line"; ?></td>
                                <td width="30%"><?php echo $result['PolicyId']; ?></td>
                                <td width="30%"><?php echo $result['New_ProductLineId']; ?></td>
                            </tr>
                            <?php } ?>
                            <?php if(trim($result['Underwriter']) != trim($result['NewUnderwriter'])){ ?>
                            <tr>
                                <td width="20%" height="35"><?php echo "Underwriter"; ?></td>
                                <td width="30%"><?php echo $result['Underwriter']; ?></td>
                                <td width="30%"><?php echo $result['NewUnderwriter']; ?></td>
                            </tr>
                            <?php } ?>
                            <?php if(trim($result['Region']) != trim($result['NewRegion'])){ ?>
                            <tr>
                                <td width="20%" height="35"><?php echo "Region"; ?></td>
                                <td width="30%"><?php echo $result['Region']; ?></td>
                                <td width="30%"><?php echo $result['NewRegion']; ?></td>
                            </tr>
                            <?php } ?>
                            <?php if(trim($result['Branch']) != trim($result['NewBranch'])){ ?>
                            <tr>
                                <td width="20%" height="35"><?php echo "Branch"; ?></td>
                                <td width="30%"><?php echo $result['Branch']; ?></td>
                                <td width="30%"><?php echo $result['NewBranch']; ?></td>
                            </tr>
                            <?php } ?>
                            <?php if(trim($result['ReinsuredCompany']) != trim($result['NewReinsuredCompany'])){ ?>
                            <tr>
                                <td width="20%" height="35"><?php echo "Reinsured Company"; ?></td>
                                <td width="30%"><?php echo $result['ReinsuredCompany']; ?></td>
                                <td width="30%"><?php echo $result['NewReinsuredCompany']; ?></td>
                            </tr>
                            <?php } ?>
                            <?php if(trim($result['Remark']) != trim($result['NewRemark'])){ ?>
                            <tr>
                                <td width="20%" height="35"><?php echo "Remark"; ?></td>
                                <td width="30%" style="word-wrap: break-word; word-break: break-all;white-space: normal;"><?php echo $result['Remark']; ?></td>
                                <td width="30%" style="word-wrap: break-word; word-break: break-all;white-space: normal;"><?php echo $result['NewRemark']; ?></td>
                            </tr>
                            <?php } ?>
                            <?php if(trim($result['DirectAssumed']) != trim($result['NewDirectAssumed'])){ ?>
                            <tr>
                                <td width="20%" height="35"><?php echo "Direct Assumed"; ?></td>
                                <td width="30%"><?php echo $result['DirectAssumed']; ?></td>
                                <td width="30%"><?php echo $result['NewDirectAssumed']; ?></td>
                            </tr>
                            <?php } ?>
                            <?php if(trim($result['AdmittedNonAdmitted']) != trim($result['NewAdmittedNonAdmitted'])){ ?>
                            <tr>
                                <td width="20%" height="35"><?php echo "Admitted-NonAdmitted"; ?></td>
                                <td width="30%"><?php echo $result['AdmittedNonAdmitted']; ?></td>
                                <td width="30%"><?php echo $result['NewAdmittedNonAdmitted']; ?></td>
                            </tr>
                            <?php } ?>
                            <?php if(trim($result['AdmittedDetails']) != trim($result['NewAdmittedDetails'])){ ?>
                            <tr>
                                <td width="20%" height="35"><?php echo "Admitted Details"; ?></td>
                                <td width="30%"><?php echo $result['AdmittedDetails']; ?></td>
                                <td width="30%"><?php echo $result['NewAdmittedDetails']; ?></td>
                            </tr>
                            <?php } ?>
                            <?php if(trim($result['Company']) != trim($result['NewCompany'])){ ?>
                            <tr>
                                <td width="20%" height="35"><?php echo "Company"; ?></td>
                                <td width="30%"><?php echo $result['Company']; ?></td>
                                <td width="30%"><?php echo $result['NewCompany']; ?></td>
                            </tr>
                            <?php } ?>
                            <?php if(trim($result['CompanyNumber']) != trim($result['NewCompanyNumber'])){ ?>
                            <tr>
                                <td width="20%" height="35"><?php echo "Company Number"; ?></td>
                                <td width="30%"><?php echo $result['CompanyNumber']; ?></td>
                                <td width="30%"><?php echo $result['NewCompanyNumber']; ?></td>
                            </tr>
                            <?php } ?>
                            <?php if(trim($result['Prefix']) != trim($result['NewPrefix'])){ ?>
                            <tr>
                                <td width="20%" height="35"><?php echo "Prefix"; ?></td>
                                <td width="30%"><?php echo $result['Prefix']; ?></td>
                                <td width="30%"><?php echo $result['NewPrefix']; ?></td>
                            </tr>
                            <?php } ?>
                            <?php if(trim($result['Suffix']) != trim($result['NewSuffix'])){ ?>
                            <tr>
                                <td width="20%" height="35"><?php echo "Suffix"; ?></td>
                                <td width="30%"><?php echo $result['Suffix']; ?></td>
                                <td width="30%"><?php echo $result['NewSuffix']; ?></td>
                            </tr>
                            <?php } ?>
                            <?php if(trim($result['NewRenewal']) != trim($result['New_NewRenewal'])){ ?>
                            <tr>
                                <td width="20%" height="35"><?php echo "New-Renewal"; ?></td>
                                <td width="30%"><?php echo $result['NewRenewal']; ?></td>
                                <td width="30%"><?php echo $result['New_NewRenewal']; ?></td>
                            </tr>
                            <?php } ?>
                            <?php if(date("Y-m-d", strtotime($result['PolicyEffectiveDate'])) != date("Y-m-d", strtotime($result['NewPolicyEffectiveDate']))){ ?>
                            <tr>
                                <td width="20%" height="35"><?php echo "Policy Effective Date"; ?></td>
                                <td width="30%"><?php echo date("m/d/Y", strtotime($result['PolicyEffectiveDate'])); ?></td>
                                <td width="30%"><?php echo date("m/d/Y", strtotime($result['NewPolicyEffectiveDate'])); ?></td>
                            </tr>
                            <?php } ?>
                            <?php if(date("Y-m-d", strtotime($result['PolicyExpiryDate'])) != date("Y-m-d", strtotime($result['NewPolicyExpiryDate']))){ ?>
                            <tr>
                                <td width="20%" height="35"><?php echo "Policy Expiry Date"; ?></td>
                                <td width="30%"><?php echo date("m/d/Y", strtotime($result['PolicyExpiryDate'])); ?></td>
                                <td width="30%"><?php echo date("m/d/Y", strtotime($result['NewPolicyExpiryDate'])); ?></td>
                            </tr>
                            <?php } ?>
                            <?php if(trim($result['InceptionGrossPremium']) != trim($result['NewInceptionGrossPremium'])){ ?>
                            <tr>
                                <td width="20%" height="35"><?php echo "Inception Gross Premium"; ?></td>
                                <td width="30%"><?php echo $result['InceptionGrossPremium']; ?></td>
                                <td width="30%"><?php echo $result['NewInceptionGrossPremium']; ?></td>
                            </tr>
                            <?php } ?>
                            <?php if(trim($result['CommisssionPercentage']) != trim($result['NewCommisssionPercentage'])){ ?>
                            <tr>
                                <td width="20%" height="35"><?php echo "Commission Percentage"; ?></td>
                                <td width="30%"><?php echo $result['CommisssionPercentage']; ?></td>
                                <td width="30%"><?php echo $result['NewCommisssionPercentage']; ?></td>
                            </tr>
                            <?php } ?>
                            <?php if(trim($result['CommisssionDoller']) != trim($result['NewCommisssionDoller'])){ ?>
                            <tr>
                                <td width="20%" height="35"><?php echo "Commission Doller"; ?></td>
                                <td width="30%"><?php echo $result['CommisssionDoller']; ?></td>
                                <td width="30%"><?php echo $result['NewCommisssionDoller']; ?></td>
                            </tr>
                            <?php } ?>
                            <?php if(trim($result['NetPremium']) != trim($result['NewNetPremium'])){ ?>
                            <tr>
                                <td width="20%" height="35"><?php echo "Net Premium"; ?></td>
                                <td width="30%"><?php echo $result['NetPremium']; ?></td>
                                <td width="30%"><?php echo $result['NewNetPremium']; ?></td>
                            </tr>
                            <?php } ?>
                        </table>
                   </div>
            </div>
        </div>  
      <?php } ?>
</div>
  
