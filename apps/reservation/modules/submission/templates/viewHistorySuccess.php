<div id="content" class="view">
    <div class="breadcrumbs group"> 
        <ul id="breadcrumb">
            <li><a href="/">Home</a><span> >>&nbsp; </span></li>
            <li><a href="/submission/Submission">Submission</a><span> >>&nbsp; </span></li>
            <li><a href="/submission/List">Submission Listing</a><span> >>&nbsp; </span></li>
            <li class="selected">History</li>
        </ul>
        <a href="/submission/List" id="back"></a>
   </div>
    <div class="container">
        <ul class="tabbed-menu">
            <li><a href="/submission/viewSubmission?submission=<?php echo $submissionId; ?>">Submission Details</a></li>
            <li class="active"><a href="/submission/viewHistory?submission=<?php echo $submissionId; ?>">Submission History</a></li>
        </ul>   
        <div class="dates">
            <em>Created Date: <strong><?php if(!empty($dataResult[0]['CreatedOn'])){ echo date("Y-m-d", strtotime($dataResult[0]['CreatedOn']));} else { echo "";} ?></strong></em>
            <em>Updated Date: <strong><?php if(!empty($dataResult[0]['ModifiedOn'])){ echo date("Y-m-d", strtotime($dataResult[0]['ModifiedOn'])); } else { echo "";} ?></strong></em>
        </div>
        <div class="clear"></div>
    </div>

    <?php foreach($finalResult as $result) { ?>
        <div class="container">
            <div class="box">
                <?php for($i=0,$j=0;$i<1,$j<1;$i++,$j++){?>
                <h1 class="section-header">Updated By <?php echo $result[$i]['ModifiedBy']  ?> <em class="dateTime">Date & Time: <strong><?php if($result[$i]['ModifiedOn'] != '') { echo date("M-d-Y h:i:s A", strtotime($result[$i]['ModifiedOn']));}else{echo '';} ?></strong></em><div class="arrow"></div></h1>
                <?php }?>
                <div class="content" style="display: block;">
                    <table cellpadding="0" cellspacing="0" width="100%">
                        <tr>
                            <td width="20%">&nbsp;</td>
                            <td width="40%">Old Value</td>
                            <td width="20%"></td>
                            <td width="20%">New Value</td>
                        </tr>
                        <?php foreach($result as $data){ ?>
                        <tr>
                            <td width="20%" height="35"><?php echo $data['Field']; ?></td>
                            <td width="40%">
                                <?php $validDate = date('Y-m-d', strtotime('-10 years'));
                                if($data['Field'] == 'Insured Quote Due Date'|| $data['Field'] =='Insured Submission Date' || $data['Field'] =='Expiry Date' || $data['Field'] =='Exchange Rate as on' || $data['Field'] =='Bind Date' || $data['Field'] == 'Date of Renewal' || $data['Field'] == 'Effective Date' || $data['Field'] == 'Process Date' || $data['Field'] == 'Date of Receiving-By India From Berk SI'){ 
                                    if(date('Y-m-d',strtotime($data['OldValue']))>$validDate) {
                                         echo date('m-d-Y', strtotime($data['OldValue']));
                                    } else {
                                        echo "";
                                    }
                                }else if($data['Field'] == 'Date of Receiving-By Berk SI From Broker'){
                                         echo date('m-d-Y h:i:s', strtotime($data['OldValue']));
                                }else {
                                   echo $data['OldValue'];
                                } ?>
                            </td>
                            <td width="20%"></td>
                            <td width="20%"><?php $validDate = date('Y-m-d', strtotime('-10 years'));
                             if($data['Field'] == 'Insured Quote Due Date'|| $data['Field'] =='Insured Submission Date' || $data['Field'] =='Expiry Date' || $data['Field'] =='Exchange Rate as on' || $data['Field'] =='Bind Date' || $data['Field'] == 'Date of Renewal' || $data['Field'] == 'Effective Date' || $data['Field'] == 'Process Date' || $data['Field'] == 'Date of Receiving-By India From Berk SI'){ 
                                if(date('Y-m-d',strtotime($data['NewValue'])) > $validDate) {
                                   echo date('m-d-Y', strtotime($data['NewValue']));
                                } else {
                                      echo "";
                                }
                             } else if($data['Field'] == 'Date of Receiving-By Berk SI From Broker'){
                                   echo date('m-d-Y h:i:s', strtotime($data['NewValue']));
                             } else {
                                 echo $data['NewValue'];
                             }?>
                            </td>
                        </tr>
                        <?php } ?>
                    </table>
                        <div class="container">
                            <div class="content" style="display: block; border: 1px solid #aaa;">
                               <table width="100%" border="0" cellspacing="0" cellpadding="0">
                                <tr>
                                    <?php for($i=0;$i<1;$i++){?>
                                    <td width="12%">Remarks:</td>
                                    <td width="22%"><?php echo $result[$i]['Remarks'];?></td>
                                    <td width="12%"></td>
                                    <td width="22%"></td>
                                    <td width="12%"></td>
                                    <td width="22%"></td>
                                    <?php }?>
                                </tr>
                               </table>
                            </div>
                        </div>
                </div>
            </div>
        </div>
    <?php } ?>
  
