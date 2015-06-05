<?php
    $docTypeArray = array("Schedule","SOV in Excel format","Loss Runs – 3 years including current year","Summary of Risk/Description of Operations","History of Operations","Application");
?>
<?php ///echo "<pre>"; print_r($submissionDocs);exit;?>
<div  id="Filter-content">
    <div class="filter-section-quote">
        <!--<div class="font13 bold padding-top-bottom-3">Attached by Username on MM/DD/YYYY HH:MM:SS</div>-->
        <table width="100%" border="0" cellpadding="0" cellspacing="0" class="grid">
        <tr>
            <th width="32%">File Type</th>
            <th width="16%">File Name</th>
            <th width="16%">Date &amp; Time</th>
            <th width="10%">Action</th>
        </tr>
        <?php foreach($submissionDocs as $submissionDoc){ if(file_exists(sfConfig::get('app_uploaddir').'/'.$submissionDoc['FILE_PATH'])){?>
        <tr>
            <td><?php echo $docTypeArray[($submissionDoc['DOCUMENT_TYPE'])-1];?></td>
            <td><?php echo $submissionDoc['FILE_NAME'];?></td>
            <td><?php echo $submissionDoc['CREATED_ON'];?></td>
            <td><a target="_blank" href="/reservation_dev.php/submission/DownloadSubmission?doc=<?php echo $submissionDoc['DOCUMENT_ID'];?>">Download Link</a></td>
        </tr>
        <?php }}?>
        </table>
    </div>
    </div>