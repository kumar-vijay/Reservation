<?php

require_once 'SSRSReport.php';

class SubmissionSummaryExhibit {

    public function __construct() {
        $settings = parse_ini_file("app.config", 1);
        $this->connection = new SSRSReport(new Credentials($settings["UID"], $settings["PASWD"]), $settings["SERVICE_URL"]);
    }

    public static function getPostContent() {
        return trim(file_get_contents("php://input"));
    }

    public function getReport($postArray) {
        define("REPORT", "/KPI Reports As Of Date/New Submission Activity Exhibit");
        $ssrs_report = $this->connection;

        try {
            $ssrs_report->LoadReport2(REPORT, NULL);
            $parameters = array();

            $parameters[0] = new ParameterValue();
            $parameters[0]->Name = "datetype";
            $parameters[0]->Value = "" . $postArray['datetype'] . "";

            $parameters[1] = new ParameterValue();
            $parameters[1]->Name = "startdate";
            $parameters[1]->Value = "" . $postArray['startdate'] . "";

            $parameters[2] = new ParameterValue();
            $parameters[2]->Name = "enddate";
            $parameters[2]->Value = "" . $postArray['enddate'] . "";

            $parameters[3] = new ParameterValue();
            $parameters[3]->Name = "lob";
            $parameters[3]->Value = "" . $postArray['lineofbusiness'] . "";

            $parameters[4] = new ParameterValue();
            $parameters[4]->Name = "branch";
            $parameters[4]->Value = "" . $postArray['branchoffice'] . "";

//            $parameters[5] = new ParameterValue();
//            $parameters[5]->Name = "RunDate";
//            $parameters[5]->Value = "" . $postArray['reportasofdate'] . "";

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
        define("REPORT", "/KPI Reports As Of Date/New Submission Activity Exhibit");
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

    public function getStartDate() {
        $con = Propel::getConnection();
        $query = "select CAST(DATEADD(DD,-1,getdate()) AS DATE) AS Startdate";
        $stmt = $con->query($query);
        $result = $stmt->fetchAll();
        return $result;
    }
    
    public function getEndDate() {
        $con = Propel::getConnection();
        $query = "select CAST(DATEADD(DD,-8,getdate()) AS DATE) AS EndDate";
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
        define("REPORT", "/KPI Reports As Of Date/New Submission Activity Exhibit");
        $ssrs_report = $this->connection;

        try {
            $ssrs_report->LoadReport2(REPORT, NULL);
            $parameters = array();

            $parameters[0] = new ParameterValue();
            $parameters[0]->Name = "datetype";
            $parameters[0]->Value = "" . $postArray['DateType'] . "";

            $parameters[1] = new ParameterValue();
            $parameters[1]->Name = "startdate";
            $parameters[1]->Value = "" . $postArray['StartDate'] . "";

            $parameters[2] = new ParameterValue();
            $parameters[2]->Name = "enddate";
            $parameters[2]->Value = "" . $postArray['EndDate'] . "";

            $parameters[3] = new ParameterValue();
            $parameters[3]->Name = "lob";
            $parameters[3]->Value = "" . $postArray['LineOfBusiness'] . "";

            $parameters[4] = new ParameterValue();
            $parameters[4]->Name = "branch";
            $parameters[4]->Value = "" . $postArray['BranchOffice'] . "";

//            $parameters[5] = new ParameterValue();
//            $parameters[5]->Name = "RunDate";
//            $parameters[5]->Value = "" . $postArray['ReportAsOfDate'] . "";

            $executionInfo = $ssrs_report->SetExecutionParameters2($parameters, "en-us");

            if ($reportType == 'PDF') {
                $renderAsPDF = new RenderAsPDF();
                $result = $ssrs_report->Render2($renderAsPDF, PageCountModeEnum::$Estimate, $Extension, $MimeType, $Encoding, $Warnings, $StreamIds);
                header("Content-type:application/pdf");
                header("Content-Disposition:attachment;filename='Submission-Summary-Exhibit.pdf'");
                header("Content-length: " . (string) (strlen($result)));
                header("Expires: " . gmdate("D, d M Y H:i:s", mktime(date("H") + 2, date("i"), date("s"), date("m"), date("d"), date("Y"))) . " GMT");
                header("Last-Modified: " . gmdate("D, d M Y H:i:s") . " GMT");
                header("Cache-Control: no-cache, must-revalidate");
                header("Pragma: no-cache");
                echo $result;
            } else if ($reportType == 'CSV') {
                $renderAsCSV = new RenderAsCSV();
                $result = $ssrs_report->Render2($renderAsCSV, PageCountModeEnum::$Estimate, $Extension, $MimeType, $Encoding, $Warnings, $StreamIds);
                header("Content-type: text/csv");
                header("Content-Disposition:attachment;filename='Submission-Summary-Exhibit.csv'");
                header("Content-length: " . (string) (strlen($result)));
                header("Expires: " . gmdate("D, d M Y H:i:s", mktime(date("H") + 2, date("i"), date("s"), date("m"), date("d"), date("Y"))) . " GMT");
                header("Last-Modified: " . gmdate("D, d M Y H:i:s") . " GMT");
                header("Cache-Control: no-cache, must-revalidate");
                header("Pragma: no-cache");
                echo $result;
            } else if ($reportType == 'EXCEL') {
                $renderAsEXCEL = new RenderAsEXCEL();
                $result = $ssrs_report->Render2($renderAsEXCEL, PageCountModeEnum::$Estimate, $Extension, $MimeType, $Encoding, $Warnings, $StreamIds);
                header("Content-type: application/vnd.ms-excel");
                header("Content-Disposition:attachment;filename=Submission-Summary-Exhibit.xls");
                header("Content-length: " . (string) (strlen($result)));
                header("Expires: " . gmdate("D, d M Y H:i:s", mktime(date("H") + 2, date("i"), date("s"), date("m"), date("d"), date("Y"))) . " GMT");
                header("Last-Modified: " . gmdate("D, d M Y H:i:s") . " GMT");
                header("Cache-Control: no-cache, must-revalidate");
                header("Pragma: no-cache");
                echo $result;
            } else if ($reportType == 'WORD') {
                $renderAsWord = new RenderAsWORD();
                $result = $ssrs_report->Render2($renderAsWord, PageCountModeEnum::$Estimate, $Extension, $MimeType, $Encoding, $Warnings, $StreamIds);
                header("Content-type: application/vnd.ms-word");
                header("Content-Disposition:attachment;filename='Submission-Summary-Exhibit.doc'");
                header("Content-length: " . (string) (strlen($result)));
                header("Expires: " . gmdate("D, d M Y H:i:s", mktime(date("H") + 2, date("i"), date("s"), date("m"), date("d"), date("Y"))) . " GMT");
                header("Last-Modified: " . gmdate("D, d M Y H:i:s") . " GMT");
                header("Cache-Control: no-cache, must-revalidate");
                header("Pragma: no-cache");
                echo $result;
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

}
