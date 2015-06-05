<?php

/**
 * submission actions.
 *
 * @package    reservation
 * @subpackage submission
 * @author     Your name here
 * @version    SVN: $Id: actions.class.php 23810 2009-11-12 11:07:44Z Kris.Wallsmith $
 */
class reportActions extends sfActions {

    /**
     * Executes index action
     *
     * @param sfRequest $request A request object
     */
    public function executeReport($request) {
        
    }
    /*Function Start For Accounts on Multiple Lines Report*/
    public function executeAccountMultipleLines($request) {
        $obj = new AccountMultipleLines();
        $this->parameter = $obj->GetParameter();
        $this->renderingType = $obj->GetRenderingType();
        if ($request->getParameter('niddle')) {
            $this->lastSearchCriteria = $this->getUser()->getAttribute('searchNiddle');
        } else {
            $this->getUser()->setAttribute('searchNiddle', '');
        }
        if ($request->getPostParameters()) {
            $this->getUser()->setAttribute('searchNiddle', '');
            $dateRange = $request->getParameter('daterange', '');
            $dateType = $request->getParameter('datetype', '');
            $startDate = $request->getParameter('startdate', '');
            $endDate = $request->getParameter('enddate', '');
            $lineOfBusiness = $request->getParameter('lineofbusiness', '');
            $branchOffice = $request->getParameter('branchoffice', '');
            $reportAsOfDate = $request->getParameter('reportasofdate', '');
            $selectAllBranch = $request->getParameter('selectAllBranch', '');
            $selectAllLob = $request->getParameter('selectAll', '');
          
            $this->lastSearchCriteria = array(
                'DateRange' =>$dateRange,
                'DateType' => $dateType,
                'StartDate' => $startDate,
                'EndDate' => $endDate,
                'LineOfBusiness' => $lineOfBusiness,
                'BranchOffice' => $branchOffice,
                'ReportAsOfDate' => $reportAsOfDate,
                'selectAllBranch' =>$selectAllBranch,
                'selectAllLob'=>$selectAllLob
            );
            $this->getUser()->setAttribute('searchNiddle', $this->lastSearchCriteria);

            $postArray = $request->getPostParameters();
            $postArray['lineofbusiness'] = implode(",", $postArray['lineofbusiness']);
            $postArray['branchoffice'] = implode(",", $postArray['branchoffice']);
            $this->result = $obj->getReport($postArray);
        }
    }
    
    public function executeDownloadAccountMultipleLinesReport($request) {
        $niddle = $this->getUser()->getAttribute('searchNiddle');
        $obj = new AccountMultipleLines();
        $reportType = $request->getParameter('reportType', '');
        $niddle['LineOfBusiness'] = implode(",", $niddle['LineOfBusiness']);
        $niddle['BranchOffice'] = implode(",", $niddle['BranchOffice']);
        if ($reportType != '0') {
            $obj->DownloadReport($niddle,$reportType);
        }
        exit;
    }
    /*Function End For Accounts on Multiple Lines Report*/
    /*Function Start For Account Summary Report*/
    public function executeAccountSummary($request) {
        $obj = new AccountReport();
        $this->parameter = $obj->GetParameter();
        $this->renderingType = $obj->GetRenderingType();
        if ($request->getParameter('niddle')) {
            $this->lastSearchCriteria = $this->getUser()->getAttribute('searchNiddle');
        } else {
            $this->getUser()->setAttribute('searchNiddle', '');
        }
        if ($request->getPostParameters()) {
            $this->getUser()->setAttribute('searchNiddle', '');
            $dateRange = $request->getParameter('daterange', '');
            $dateType = $request->getParameter('datetype', '');
            $startDate = $request->getParameter('startdate', '');
            $endDate = $request->getParameter('enddate', '');
            $lineOfBusiness = $request->getParameter('lineofbusiness', '');
            $branchOffice = $request->getParameter('branchoffice', '');
            $reportAsOfDate = $request->getParameter('reportasofdate', '');
            $selectAllBranch = $request->getParameter('selectAllBranch', '');
            $selectAllLob = $request->getParameter('selectAll', '');
          
            $this->lastSearchCriteria = array(
                'DateRange' =>$dateRange,
                'DateType' => $dateType,
                'StartDate' => $startDate,
                'EndDate' => $endDate,
                'LineOfBusiness' => $lineOfBusiness,
                'BranchOffice' => $branchOffice,
                'ReportAsOfDate' => $reportAsOfDate,
                'selectAllBranch' =>$selectAllBranch,
                'selectAllLob'=>$selectAllLob
            );
            $this->getUser()->setAttribute('searchNiddle', $this->lastSearchCriteria);

            $postArray = $request->getPostParameters();
            $postArray['lineofbusiness'] = implode(",", $postArray['lineofbusiness']);
            $postArray['branchoffice'] = implode(",", $postArray['branchoffice']);
            $this->result = $obj->getReport($postArray);
        }
    }
    
    public function executeDownloadAccountSummaryReport($request) {
        $niddle = $this->getUser()->getAttribute('searchNiddle');
        $obj = new AccountReport();
        $reportType = $request->getParameter('reportType', '');
        $niddle['LineOfBusiness'] = implode(",", $niddle['LineOfBusiness']);
        $niddle['BranchOffice'] = implode(",", $niddle['BranchOffice']);
        if ($reportType != '0') {
            $obj->DownloadReport($niddle,$reportType);
        }
        exit;
    }
    /*Function End For Account Summary Report*/
    /*Function Start For Monthly Report*/
    public function executeMonthlyReport($request) {
        $obj = new AccountSummary();
        $this->parameter = $obj->GetParameter();
        $this->renderingType = $obj->GetRenderingType();
        if ($request->getParameter('niddle')) {
            $this->lastSearchCriteria = $this->getUser()->getAttribute('searchNiddle');
        } else {
            $this->getUser()->setAttribute('searchNiddle', '');
        }
        if ($request->getPostParameters()) {
            $this->getUser()->setAttribute('searchNiddle', '');
            $dateRange = $request->getParameter('daterange', '');
            $dateType = $request->getParameter('datetype', '');
            $startDate = $request->getParameter('startdate', '');
            $endDate = $request->getParameter('enddate', '');
            $lineOfBusiness = $request->getParameter('lineofbusiness', '');
            $branchOffice = $request->getParameter('branchoffice', '');
            $reportAsOfDate = $request->getParameter('reportasofdate', '');
            $reportType = $request->getParameter('reportType', '');
            $selectAllBranch = $request->getParameter('selectAllBranch', '');
            $selectAllLob = $request->getParameter('selectAll', '');
          
            $this->lastSearchCriteria = array(
                'DateRange' => $dateRange,
                'DateType' => $dateType,
                'StartDate' => $startDate,
                'EndDate' => $endDate,
                'LineOfBusiness' => $lineOfBusiness,
                'BranchOffice' => $branchOffice,
                'ReportAsOfDate' => $reportAsOfDate,
                'ReportType' => $reportType,
                'selectAllBranch' =>$selectAllBranch,
                'selectAllLob'=>$selectAllLob
            );
            $this->getUser()->setAttribute('searchNiddle', $this->lastSearchCriteria);

            $postArray = $request->getPostParameters();
            $postArray['lineofbusiness'] = implode(",", $postArray['lineofbusiness']);
            $postArray['branchoffice'] = implode(",", $postArray['branchoffice']);
            $this->result = $obj->getReport($postArray);
        }
    }
    

    public function executeDownloadReport($request) {
        $niddle = $this->getUser()->getAttribute('searchNiddle');
        $obj = new AccountSummary();
        $reportType = $request->getParameter('reportType', '');
        $niddle['LineOfBusiness'] = implode(",", $niddle['LineOfBusiness']);
        $niddle['BranchOffice'] = implode(",", $niddle['BranchOffice']);
        if ($reportType != '0') {
            $obj->DownloadReport($niddle,$reportType);
        }
        exit;
    }
    /*Function End For Monthly Report*/
    public function executeGetStartDate(sfWebRequest $request) {
        $arrData = json_decode(AccountSummary::getPostContent());
        $daterange = $arrData->body->data;
        $obj = new AccountSummary ();
        $data = $obj->getStartDateData($daterange);
        echo json_encode($data);
        exit;
    }
    /*Function Starts For Consolidate Broker Report*/
    public function executeConsolidatedBrokerReport($request) {
        $obj = new ConsolidatedBrokerReport();
        $this->parameter = $obj->GetParameter();
        $this->brokerType = $obj->GetBrokerType();
        $this->renderingType = $obj->GetRenderingType();
        
        if ($request->getParameter('niddle')) {
            $this->lastSearchCriteria = $this->getUser()->getAttribute('searchNiddle');
        } else {
            $this->getUser()->setAttribute('searchNiddle', '');
        }
        if ($request->getPostParameters()) {
            $this->getUser()->setAttribute('searchNiddle', '');
            $dateRange = $request->getParameter('daterange', '');
            $dateType = $request->getParameter('datetype', '');
            $startDate = $request->getParameter('startdate', '');
            $endDate = $request->getParameter('enddate', '');
            $lineOfBusiness = $request->getParameter('lineofbusiness', '');
            $branchOffice = $request->getParameter('branchoffice', '');
            $reportAsOfDate = $request->getParameter('reportasofdate', '');
            $reportType = $request->getParameter('reportType', '');
            $selectAllBranch = $request->getParameter('selectAllBranch', '');
            $brokerType = $request->getParameter('brokerType', '');
            $selectAllBroker = $request->getParameter('selectAllBroker', '');
            
            $this->lastSearchCriteria = array(
                'DateRange' => $dateRange,
                'DateType' => $dateType,
                'StartDate' => $startDate,
                'EndDate' => $endDate,
                'LineOfBusiness' => $lineOfBusiness,
                'BranchOffice' => $branchOffice,
                'ReportAsOfDate' => $reportAsOfDate,
                'brokerType' => $brokerType,
                'ReportType' => $reportType,
                'selectAllBranch' =>$selectAllBranch, 
                'selectAllBroker' =>$selectAllBroker
            );
            $this->getUser()->setAttribute('searchNiddle', $this->lastSearchCriteria);

            $postArray = $request->getPostParameters();
            $postArray['lineofbusiness'] = $postArray['lineofbusiness'];
            $postArray['branchoffice'] = implode(",", $postArray['branchoffice']);
            $postArray['brokerType'] = implode(",", $postArray['brokerType']);
            $this->result = $obj->getReport($postArray);
        }
    }
    
    public function executeDownloadConsolBrokerReport($request) {
        $niddle = $this->getUser()->getAttribute('searchNiddle');
       
        $obj = new ConsolidatedBrokerReport();
        $reportType = $request->getParameter('reportType', '');
        $niddle['brokerType'] = implode(",", $niddle['brokerType']);
        $niddle['BranchOffice'] = implode(",", $niddle['BranchOffice']);
        if ($reportType != '0') {
            $obj->DownloadReport($niddle,$reportType);
        }
        exit;
    }
    /*Function End For Consolidate Broker Report*/
    /*Function Start For Individual Broker Report*/
     public function executeIndividualBrokerReport($request) {
        $obj = new IndividualBrokerReport();
        $this->parameter = $obj->GetParameter();
        $this->renderingType = $obj->GetRenderingType();
        if ($request->getParameter('niddle')) {
            $this->lastSearchCriteria = $this->getUser()->getAttribute('searchNiddle');
        } else {
            $this->getUser()->setAttribute('searchNiddle', '');
        }
        if ($request->getPostParameters()) {
            $this->getUser()->setAttribute('searchNiddle', '');
            $dateRange = $request->getParameter('daterange', '');
            $dateType = $request->getParameter('datetype', '');
            $startDate = $request->getParameter('startdate', '');
            $endDate = $request->getParameter('enddate', '');
            $lineOfBusiness = $request->getParameter('lineofbusiness', '');
            $branchOffice = $request->getParameter('branchoffice', '');
            $brokerName = $request->getParameter('brokername', '');
            $reportAsOfDate = $request->getParameter('reportasofdate', '');
            $reportType = $request->getParameter('reportType', '');
            $selectAllBranch = $request->getParameter('selectAllBranch', '');
            $selectAllLob = $request->getParameter('selectAll', '');
          
            $this->lastSearchCriteria = array(
                'DateRange' => $dateRange,
                'DateType' => $dateType,
                'StartDate' => $startDate,
                'EndDate' => $endDate,
                'LineOfBusiness' => $lineOfBusiness,
                'BranchOffice' => $branchOffice,
                'BrokerName' => $brokerName,
                'ReportAsOfDate' => $reportAsOfDate,
                'ReportType' => $reportType,
                'selectAllBranch' =>$selectAllBranch,
                'selectAllLob'=>$selectAllLob
            );
            $this->getUser()->setAttribute('searchNiddle', $this->lastSearchCriteria);

            $postArray = $request->getPostParameters();
            $postArray['lineofbusiness'] = implode(",", $postArray['lineofbusiness']);
            $postArray['branchoffice'] = implode(",", $postArray['branchoffice']);
            $this->result = $obj->getReport($postArray);
        }
    }
    

    public function executeDownloadIndividualBrokerReport($request) {
        $niddle = $this->getUser()->getAttribute('searchNiddle');
        $obj = new IndividualBrokerReport();
        $reportType = $request->getParameter('reportType', '');
        $niddle['LineOfBusiness'] = implode(",", $niddle['LineOfBusiness']);
        $niddle['BranchOffice'] = implode(",", $niddle['BranchOffice']);
        if ($reportType != '0') {
            $obj->DownloadReport($niddle,$reportType);
        }
        exit;
    }
    /*Function End For Individual Broker Report*/
    /*Function Start For Underwriter Performancce*/
     public function executeUnderwriterPerformanceReport($request) {
        $obj = new UnderwriterPerformance();
        $this->parameter = $obj->GetParameter();
        $this->renderingType = $obj->GetRenderingType();
        if ($request->getParameter('niddle')) {
            $this->lastSearchCriteria = $this->getUser()->getAttribute('searchNiddle');
        } else {
            $this->getUser()->setAttribute('searchNiddle', '');
        }
        if ($request->getPostParameters()) {
            $this->getUser()->setAttribute('searchNiddle', '');
            $dateRange = $request->getParameter('daterange', '');
            $dateType = $request->getParameter('datetype', '');
            $startDate = $request->getParameter('startdate', '');
            $endDate = $request->getParameter('enddate', '');
            $lineOfBusiness = $request->getParameter('lineofbusiness', '');
            $branchOffice = $request->getParameter('branchoffice', '');
            $reportAsOfDate = $request->getParameter('reportasofdate', '');
            $reportType = $request->getParameter('reportType', '');
            $selectAllBranch = $request->getParameter('selectAllBranch', '');
            $selectAllLob = $request->getParameter('selectAll', '');
          
            $this->lastSearchCriteria = array(
                'DateRange' => $dateRange,
                'DateType' => $dateType,
                'StartDate' => $startDate,
                'EndDate' => $endDate,
                'LineOfBusiness' => $lineOfBusiness,
                'BranchOffice' => $branchOffice,
                'ReportAsOfDate' => $reportAsOfDate,
                'ReportType' => $reportType,
                'selectAllBranch' =>$selectAllBranch,
                'selectAllLob'=>$selectAllLob
            );
            $this->getUser()->setAttribute('searchNiddle', $this->lastSearchCriteria);

            $postArray = $request->getPostParameters();
            $postArray['lineofbusiness'] = implode(",", $postArray['lineofbusiness']);
            $postArray['branchoffice'] = implode(",", $postArray['branchoffice']);
            $this->result = $obj->getReport($postArray);
        }
    }
    

    public function executeDownloadUnderwriterPerformanceReport($request) {
        $niddle = $this->getUser()->getAttribute('searchNiddle');
        $obj = new UnderwriterPerformance();
        $reportType = $request->getParameter('reportType', '');
        $niddle['LineOfBusiness'] = implode(",", $niddle['LineOfBusiness']);
        $niddle['BranchOffice'] = implode(",", $niddle['BranchOffice']);
        if ($reportType != '0') {
            $obj->DownloadReport($niddle,$reportType);
        }
        exit;
    }
    /*Function End For Underwriter Performancce*/
    /*Function Start For Submission Summary Exhibit*/
     public function executeSubmissionSummaryExhibitReport($request) {
        $obj = new SubmissionSummaryExhibit();
        $this->parameter = $obj->GetParameter();
        $this->startDate = $obj->getStartDate();
        $this->endDate = $obj->getEndDate();
        $this->renderingType = $obj->GetRenderingType();
        if ($request->getParameter('niddle')) {
            $this->lastSearchCriteria = $this->getUser()->getAttribute('searchNiddle');
        } else {
            $this->getUser()->setAttribute('searchNiddle', '');
        }
        if ($request->getPostParameters()) {
            $this->getUser()->setAttribute('searchNiddle', '');
            $dateRange = $request->getParameter('daterange', '');
            $dateType = $request->getParameter('datetype', '');
            $startDate = $request->getParameter('startdate', '');
            $endDate = $request->getParameter('enddate', '');
            $lineOfBusiness = $request->getParameter('lineofbusiness', '');
            $branchOffice = $request->getParameter('branchoffice', '');
            $reportAsOfDate = $request->getParameter('reportasofdate', '');
            $reportType = $request->getParameter('reportType', '');
            $selectAllBranch = $request->getParameter('selectAllBranch', '');
            $selectAllLob = $request->getParameter('selectAll', '');
          
            $this->lastSearchCriteria = array(
                'DateRange' => $dateRange,
                'DateType' => $dateType,
                'StartDate' => $startDate,
                'EndDate' => $endDate,
                'LineOfBusiness' => $lineOfBusiness,
                'BranchOffice' => $branchOffice,
                'ReportAsOfDate' => $reportAsOfDate,
                'ReportType' => $reportType,
                'selectAllBranch' =>$selectAllBranch,
                'selectAllLob'=>$selectAllLob
            );
            $this->getUser()->setAttribute('searchNiddle', $this->lastSearchCriteria);

            $postArray = $request->getPostParameters();
            $postArray['lineofbusiness'] = implode(",", $postArray['lineofbusiness']);
            $postArray['branchoffice'] = implode(",", $postArray['branchoffice']);
            $this->result = $obj->getReport($postArray);
        }
    }
    

    public function executeDownloadSubmissionSummaryExhibitReport($request) {
        $niddle = $this->getUser()->getAttribute('searchNiddle');
        $obj = new SubmissionSummaryExhibit();
        $reportType = $request->getParameter('reportType', '');
        $niddle['LineOfBusiness'] = implode(",", $niddle['LineOfBusiness']);
        $niddle['BranchOffice'] = implode(",", $niddle['BranchOffice']);
        if ($reportType != '0') {
            $obj->DownloadReport($niddle,$reportType);
        }
        exit;
    }
    /*Function End For Submission Summary Exhibit*/
    
}
