<?php
require_once 'SSRSReport.php';

class ConsolidatedBrokerReport {




    public function __construct() {
        $settings = parse_ini_file("app.config", 1);
        $this->connection = new SSRSReport(new Credentials($settings["UID"], $settings["PASWD"]), $settings["SERVICE_URL"]);
    }

    public static function getPostContent() {
        return trim(file_get_contents("php://input"));
    }

    public function getReport($postArray) {
        define("REPORT", "/KPI Reports As Of Date/Consolidated Broker Report");
        $ssrs_report = $this->connection;
        
        try {
            $ssrs_report->LoadReport2(REPORT, NULL);
            $parameters = array();

            $parameters[0] = new ParameterValue();
            $parameters[0]->Name = "DateRange";
            $parameters[0]->Value = "" . $postArray['daterange'] . "";

            $parameters[1] = new ParameterValue();
            $parameters[1]->Name = "Date";
            $parameters[1]->Value = "" . $postArray['datetype'] . "";

            $parameters[2] = new ParameterValue();
            $parameters[2]->Name = "startdate";
            $parameters[2]->Value = "" . $postArray['startdate'] . "";

            $parameters[3] = new ParameterValue();
            $parameters[3]->Name = "enddate";
            $parameters[3]->Value = "" . $postArray['enddate'] . "";
            
            $parameters[4] = new ParameterValue();
            $parameters[4]->Name = "typeofbroker";
            $parameters[4]->Value = "" . $postArray['brokerType'] . "";

            $parameters[5] = new ParameterValue();
            $parameters[5]->Name = "lobname";
            $parameters[5]->Value = "" . $postArray['lineofbusiness'] . "";

            $parameters[6] = new ParameterValue();
            $parameters[6]->Name = "Branch";
            $parameters[6]->Value = "" . $postArray['branchoffice'] . "";

            $executionInfo = $ssrs_report->SetExecutionParameters2($parameters, "en-us");

            $htmlFormat = new RenderAsHTML();
            $htmlFormat->StreamRoot = '/././images/';
            $result_html .= '<div>';
            $result_html .= $ssrs_report->Render2($htmlFormat, PageCountModeEnum::$Estimate, $Extension, $MimeType, $Encoding, $Warnings, $StreamIds);
            $result_html .= '</div>';
            return $result_html;
        } catch (SSRSReportException $serviceException) {
            echo $serviceException->GetErrorMessage();
        }
    }

    public function GetParameter() {
        $ssrs_report = $this->connection;
        define("REPORT", "/KPI Reports As Of Date/Consolidated Broker Report");
        $reportParameters = $ssrs_report->GetReportParameters(REPORT, null, true, null, null);
        $parameters = array();
        foreach ($reportParameters as $reportParameter) {
            $parameters[] = array(
                "Name" => $reportParameter->Name,
                "ValidValues" => $reportParameter->ValidValues
            );
        }
        return $parameters;
    }

    public function getStartDateData($daterange) {
        $con = Propel::getConnection();
        $query = "SELECT StartDate FROM vw_ReportRange WHERE ReportRange = '$daterange'";
        $stmt = $con->query($query);
        $result = $stmt->fetchAll();
        return $result;
    }

    public function GetRenderingType() {
        $ssrs_report = $this->connection;
        $reportRenderingType = $ssrs_report->ListRenderingExtensions();
        $parameters = array();
        foreach ($reportRenderingType as $reportRendering) {
            $parameters[] = array(
                "Name" => $reportRendering->Name,
            );
            unset($parameters[1],$parameters[3],$parameters[5],$parameters[6],$parameters[7],$parameters[9],$parameters[10],$parameters[11],$parameters[13]);
        }
       
        return $parameters;
    }

    public function DownloadReport($postArray, $reportType) {
        define("REPORT", "/KPI Reports As Of Date/Consolidated Broker Report");
        $ssrs_report = $this->connection;
        
        try {
            $ssrs_report->LoadReport2(REPORT, NULL);
            $parameters = array();

            $parameters[0] = new ParameterValue();
            $parameters[0]->Name = "DateRange";
            $parameters[0]->Value = "" . $postArray['DateRange'] . "";

            $parameters[1] = new ParameterValue();
            $parameters[1]->Name = "Date";
            $parameters[1]->Value = "" . $postArray['DateType'] . "";

            $parameters[2] = new ParameterValue();
            $parameters[2]->Name = "startdate";
            $parameters[2]->Value = "" . $postArray['StartDate'] . "";

            $parameters[3] = new ParameterValue();
            $parameters[3]->Name = "enddate";
            $parameters[3]->Value = "" . $postArray['EndDate'] . "";
            
            $parameters[4] = new ParameterValue();
            $parameters[4]->Name = "typeofbroker";
            $parameters[4]->Value = "" . $postArray['brokerType'] . "";

            $parameters[5] = new ParameterValue();
            $parameters[5]->Name = "lobname";
            $parameters[5]->Value = "" . $postArray['LineOfBusiness'] . "";

            $parameters[6] = new ParameterValue();
            $parameters[6]->Name = "Branch";
            $parameters[6]->Value = "" . $postArray['BranchOffice'] . "";

            $executionInfo = $ssrs_report->SetExecutionParameters2($parameters, "en-us");

            if ($reportType == 'PDF') {
                $renderAsPDF = new RenderAsPDF();
                $result = $ssrs_report->Render2($renderAsPDF, PageCountModeEnum::$Estimate, $Extension, $MimeType, $Encoding, $Warnings, $StreamIds);
                header("Content-type:application/pdf");
                header("Content-Disposition:attachment;filename=Consolidated-Broker-Report.pdf");
                header("Content-length: " . (string) (strlen($result)));
                header("Expires: " . gmdate("D, d M Y H:i:s", mktime(date("H") + 2, date("i"), date("s"), date("m"), date("d"), date("Y"))) . " GMT");
                header("Last-Modified: " . gmdate("D, d M Y H:i:s") . " GMT");
                header("Cache-Control: no-cache, must-revalidate");
                header("Pragma: no-cache");
                echo $result;
                exit;
            }else if($reportType == 'CSV'){
                $renderAsCSV = new RenderAsCSV();
                $result = $ssrs_report->Render2($renderAsCSV, PageCountModeEnum::$Estimate, $Extension, $MimeType, $Encoding, $Warnings, $StreamIds);
                header("Content-type: text/csv");
                header("Content-Disposition:attachment;filename=Consolidated-Broker-Report.csv");
                header("Content-length: " . (string) (strlen($result)));
                header("Expires: " . gmdate("D, d M Y H:i:s", mktime(date("H") + 2, date("i"), date("s"), date("m"), date("d"), date("Y"))) . " GMT");
                header("Last-Modified: " . gmdate("D, d M Y H:i:s") . " GMT");
                header("Cache-Control: no-cache, must-revalidate");
                header("Pragma: no-cache");
                echo $result;
                exit;
            }else if($reportType == 'EXCEL'){
                $renderAsEXCEL = new RenderAsEXCEL();
                $result = $ssrs_report->Render2($renderAsEXCEL, PageCountModeEnum::$Estimate, $Extension, $MimeType, $Encoding, $Warnings, $StreamIds);
                header("Content-type: application/vnd.ms-excel");
                header("Content-Disposition:attachment;filename=Consolidated-Broker-Report.xls");
                header("Content-length: " . (string) (strlen($result)));
                header("Expires: " . gmdate("D, d M Y H:i:s", mktime(date("H") + 2, date("i"), date("s"), date("m"), date("d"), date("Y"))) . " GMT");
                header("Last-Modified: " . gmdate("D, d M Y H:i:s") . " GMT");
                header("Cache-Control: no-cache, must-revalidate");
                header("Pragma: no-cache");
                echo $result;
                exit;
            }else if($reportType == 'WORD'){
                $renderAsWord = new RenderAsWORD();
                $result = $ssrs_report->Render2($renderAsWord, PageCountModeEnum::$Estimate, $Extension, $MimeType, $Encoding, $Warnings, $StreamIds);
                header("Content-type: application/vnd.ms-word");
                header("Content-Disposition:attachment;filename='Consolidated-Broker-Report.doc'");
                header("Content-length: " . (string) (strlen($result)));
                header("Expires: " . gmdate("D, d M Y H:i:s", mktime(date("H") + 2, date("i"), date("s"), date("m"), date("d"), date("Y"))) . " GMT");
                header("Last-Modified: " . gmdate("D, d M Y H:i:s") . " GMT");
                header("Cache-Control: no-cache, must-revalidate");
                header("Pragma: no-cache");
                echo $result;
                exit;
            }else if($reportType == 'XML'){
                $renderAsWord = new RenderAsWORD();
                $result = $ssrs_report->Render2($renderAsWord, PageCountModeEnum::$Estimate, $Extension, $MimeType, $Encoding, $Warnings, $StreamIds);
                header('Content-type: text/xml');
                header("Content-Disposition:attachment;filename='Monthly-Report.xml'");
                header("Content-length: " . (string) (strlen($result)));
                header("Expires: " . gmdate("D, d M Y H:i:s", mktime(date("H") + 2, date("i"), date("s"), date("m"), date("d"), date("Y"))) . " GMT");
                header("Last-Modified: " . gmdate("D, d M Y H:i:s") . " GMT");
                header("Cache-Control: no-cache, must-revalidate");
                header("Pragma: no-cache");
                echo $result;
            }
        } catch (SSRSReportException $serviceException) {
            echo $serviceException->GetErrorMessage();
        }
    }
    
    public function GetBrokerType(){
        $brokerType = array('Retailer','Wholesaler');
        return $brokerType;
    }

}
