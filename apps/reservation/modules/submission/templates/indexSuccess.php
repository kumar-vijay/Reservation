<?php $niddle = $sf_user->getAttribute('searchNiddle');?>
<div id="content">
            <div class="Quotes padding-15">
                	<!-- Quotes -->
                    <h1 class="filter p-relative">Filter (<?php echo $numberofResults;?> results found)<div class="vertical-arrow p-absolute cursor toggle-position" onclick="toggleContent('Filter')"></div></h1>
                    <!--Filter Section-->
                    <div  id="Filter-content">
                    	<div class="filter-section-quote">
                        <form method="POST" action="/submission/index" name="submissionFrm" id="submissionFrm">	
                        <table width="100%" border="0" cellpadding="0" cellspacing="0">
                          <tr>
                            <td width="13%" align="left">D&amp;B No.</td>
                            <td width="20%" align="left" class="padding-top-bottom-3">
                                <input name="dnb" value="<?php echo $niddle['dnb']; ?>" id="dnb" type="text" class="txtbox-small width-73per" /></td>
                            <td width="13%" align="left">Insured Name</td>
                            <td width="20%" align="left">
                                <input name="InsuredName" value="<?php echo $niddle['InsuredName']; ?>" id="InsuredName" type="text" class="txtbox-small  width-73per" />
                            </td>
                            <td width="14%" align="left" >Underwriter Name</td>
                            <td width="20%" align="left">
                            <select name="Underwriter" id="Underwriter" class="listbox-small width-73per">
                                <option value="">--Select--</option>
                                <?php foreach($underWriter as $value) {
                                    if($value->FIRSTNAME == $niddle['Underwriter'])
                                        $select  = 'selected="selected"';
                                    else
                                        $select  = '';
                                    ?>
                                <option value="<?php echo $value->FIRSTNAME;?>" <?php echo $select;?> ><?php echo $value->FIRSTNAME;?> </option>
                                <?php }?>
                              </select>
                            </td>
                          </tr>
                          <tr>
                            <td align="left">Brocker Code</td>
                            <td align="left"  class="padding-top-bottom-3">
                                <input id="BrockerCode" name="BrockerCode" value="<?php echo $niddle['BrockerCode']; ?>" type="text" class="txtbox-small width-73per" />
                            </td>
                            <td align="left" >Branch Office </td>
                            <td align="left">
                            <select name="Branch" id="Branch" class="listbox-small width-73per">
                                <option value="">--Select--</option>
                                <?php foreach($branchOffice as $value) {
                                    if($value->BRANCH_ID == $niddle['Branch'])
                                        $select  = 'selected="selected"';
                                    else
                                        $select  = '';
                                    ?>
                                <option value="<?php echo $value->BRANCH_ID;?>" <?php echo $select;?> ><?php echo $value->BRANCH_CODE;?> </option>
                                <?php }?>
                              </select>
                            </td>
                            <td align="left">Status</td>
                            <td align="left">
                            <select name="Status" id="Status" class="listbox-small width-73per">
                                <option value="">--Select--</option>
                                <option value="working" <?php if($niddle['Status'] == 'working'){ echo 'selected="selected"';}?> >working</option>
                                <option value="blocked" <?php if($niddle['Status'] == 'blocked'){ echo 'selected="selected"';}?> >blocked</option>
                                <option value="declined" <?php if($niddle['Status'] == 'declined'){ echo 'selected="selected"';}?> >declined</option>
                                <option value="quoted" <?php if($niddle['Status'] == 'quoted'){ echo 'selected="selected"';}?> >quoted</option>
                                <option value="bound" <?php if($niddle['Status'] == 'bound'){ echo 'selected="selected"';}?> >bound</option>
                                <option value="lost" <?php if($niddle['Status'] == 'lost'){ echo 'selected="selected"';}?> >lost</option>
                                <option value="closed" <?php if($niddle['Status'] == 'closed'){ echo 'selected="selected"';}?> >closed</option>
                              </select>
                            </td>
                          </tr>
                          <tr>
                            <td align="left">Effective Date</td>
                            <td colspan="5" align="left" valign="top">
                             <table width="57%" border="0" cellspacing="0" cellpadding="0">
                              <tr>
                                <td width="20%"><span class="margin-right-50">From Date</span></td>
                                <td width="30%"  class="padding-top-bottom-3">
                                    <input type="text" id="EffectiveFromDate" value="<?php echo $niddle['EffectiveFromDate']; ?>" name="EffectiveFromDate" class="txtbox-small  width-73per" />
                                </td>
                                <td width="20%"><span class="margin-right-50">To Date</span></td>
                                <td width="30%">
                                    <input type="text" value="<?php echo $niddle['EffectiveToDate']; ?>" id="EffectiveToDate" name="EffectiveToDate" class="txtbox-small  width-73per" />
                                </td>
                              </tr>
                            </table>
                            </td>
                          </tr>
                          <tr>
                            <td align="left">Expiration Date</td>
                            <td colspan="5" align="left" valign="top">
                             <table width="57%" border="0" cellspacing="0" cellpadding="0">
                              <tr>
                                <td width="20%"><span class="margin-right-50">From Date</span></td>
                                <td width="30%"  class="padding-top-bottom-3">
                                    <input type="text" id="ExpirationFromDate" value="<?php echo $niddle['ExpirationFromDate']; ?>" name="ExpirationFromDate" class="txtbox-small  width-73per" />
                                </td>
                                <td width="20%"><span class="margin-right-50">To Date</span></td>
                                <td width="30%">
                                    <input type="text" value="<?php echo $niddle['ExpirationToDate']; ?>" id="ExpirationToDate" name="ExpirationToDate" class="txtbox-small  width-73per" />
                                </td>
                              </tr>
                            </table></td>
                          </tr>
                          <tr>
                            <td align="left">Created Submission</td>
                            <td colspan="5" align="left" valign="top"><table width="57%" border="0" cellspacing="0" cellpadding="0">
                              <tr>
                                <td width="20%"><span class="margin-right-50">From Date</span></td>
                                <td width="30%" class="padding-top-bottom-3">
                                    <input type="text" id="SubmissionFromDate" value="<?php echo $niddle['SubmissionFromDate']; ?>" name="SubmissionFromDate" class="txtbox-small  width-73per" />
                                </td>
                                <td width="20%"><span class="margin-right-50">To Date</span></td>
                                <td width="30%">
                                    <input type="text" id="SubmissionToDate" name="SubmissionToDate" value="<?php echo $niddle['SubmissionToDate']; ?>" class="txtbox-small  width-73per" />
                                </td>
                              </tr>
                            </table></td>
                          </tr>
                          <tr>
                            <td height="35" colspan="6" align="center">
                                <input type="submit" name="filterSubmit" id="filterSubmit" value="Search" class="width-80" />
                           </td>
                          </tr>
                          </table>
                        </form>
                        </div>
                    </div>
                    <!--Filter Section-->
                    <div class="margin-top-20">
                    <h2 class="fleft">Submissions List</h2>
                    <div class="height-25 fright" >
                            <input type="button" value="Create New Submission" onclick="window.location='/submission/createSubmission'" />
                            <?php if($numberofResults) {?>
                                <input type="button" value="Export" onclick="window.location='/submission/ExportFile'"/>
                            <?php } ?>
                    </div>
                    </div>
                    <table width="100%" border="0" cellspacing="0" cellpadding="0" class="lead-table">
                      <thead>
                        <tr>
                          <th>D&B No.</th>
                          <th>Insured Name</th>
                          <th>Effective Date</th>
                          <th>Expiration Date</th>
                          <th>Underwriter Name</th>
                          <th>Brocker Code</th>
                          <th>Branch Office</th>
                          <th>Creation Date</th>
                          <th>Modified Date</th>
                          <th>Status</th>
                          <th class="no-right-border">Edit/View Details</th>
                        </tr>
                      </thead>
                      <tbody>
                        <?php if($numberofResults) {
                        foreach($arrData->getResults() as $value) { ?>
                          <tr>
                        <td><?php echo $value->getDbNumber();?></td>
                        <td><?php echo $value->getInsuredName();?></td>
                        <td><?php echo $value->getEffectiveDate();?></td>
                        <td><?php echo $value->getExpirationDate();?></td>
                        <td><?php echo $value->getFirstname();?></td>
                        <td><?php echo $value->getBrokerCode();?></td>
                        <td><?php echo $value->getBranchCode();?></td>
                        <td><?php echo $value->getCreationDate();?></td>
                       <td><?php echo $value->getModifyDate();?></td>
                        <td><?php echo $value->getPrimaryStatus();?></td>
                        <td><a href=<?php echo "/submission/edit?submission=".$value->getSubmissionId();?>>Edit/View</a></td></tr>
                            
                        <?php }
                        } else {
                            ?>
                            <tr>
                        <td colspan="11" align="center">No Record Found.</td></tr>
                          <?php
                        }
                        ?>
                      </tbody>
                    </table>
                    
                    <!--Pagination start-->
<?php if ($arrData->haveToPaginate()): ?>
    <!--Pagination start-->
    <ul class="pagination">
      <li class="prev">
          <a href="<?php echo '?page=' . $arrData->getPreviousPage().'&niddle=true'; ?>" class="pagination-link" id="page-<?php echo $arrData->getPreviousPage(); ?>">&lt;&lt;Previous</a></li>
      
      
        <?php foreach ($arrData->getLinks() as $page): ?>
        <?php if ($page == $arrData->getPage()): ?>
          <?php echo '<li class="number active">'.$page.'</li>'?>
        <?php else: ?>
            <?php echo '<li class="number"><a href="?page='.$page.'&niddle=true" class="pagination-link" id="page-'.$page.'">'.$page.'</a></li>' ;?>
        <?php endif; ?> 
      <?php endforeach; ?>
      <li class="next"><a href="<?php echo '?page=' . $arrData->getNextPage().'&niddle=true'; ?>" class="pagination-link" id="page-<?php echo $arrData->getNextPage();?>">Next &gt;&gt;</a></li>
      
    </ul>
    <?php endif; ?>
                    <!--Pagination end-->
                    <!-- Quotes -->
                </div>
      	</div>






