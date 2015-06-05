<?php

class PolicyManagement {

    public function __construct() {
        $this->connection = Propel::getConnection();
    }

    public function exportPolicyDetailsCSV($arrWhere) {
        ob_end_clean();
        ini_set("max_execution_time", 0);
        ini_set("upload_max_filesize", 0);
        ini_set("post_max_size", '200M');
        ini_set('memory_limit', -1);
        $where = "WHERE 1=1 ";
        if ($arrWhere['insuredname'])
            $where .= "AND PS.InsuredName LIKE '" . $arrWhere['insuredname'] . "'";

        if ($arrWhere['masterpolicynumber'])
            $where .= "AND PS.MasterPolicyNumber LIKE '" . $arrWhere['masterpolicynumber'] . "'";

        if ($arrWhere['policynumber'])
            $where .= "AND PS.PolicyId LIKE '%" . ltrim($arrWhere['policynumber'], "0") . "%' ";

        if ($arrWhere['underwriter']) {
            $where .= "AND (PS.UnderwriterName LIKE '" . $arrWhere['underwriter'] . "'
                        OR PS.UnderwriterName LIKE '%" . $arrWhere['underwriter'] . "%') ";
        }

        $con = Propel::getConnection();
        $stmt = $con->query("SELECT COUNT(*) AS COUNT FROM Policy_Search;");
        $count = $stmt->fetch(PDO::FETCH_OBJ);

        if (!empty($count->COUNT)) {
            $stmt = $con->query("SELECT PS.NewRenewal,PS.MasterPolicyNumber,PS.InsuredName,PS.ProductLine,PS.ProductLineSubType,PS.UnderwriterName,PS.RegionName,PS.BranchName,PS.ReinsuredCompany,PS.Remarks,PS.DirectAssumed,PS.AdmittedNotAdmitted,PS.AdmittedDetails,PS.Company,PS.CompanyNumber,PS.Prefix,PS.PolicyEffectiveDate,PS.PolicyExpiryDate,PS.PolicyCurrencySymbol,PS.InceptionGrossPremium,PS.CommisssionPercentage,PS.CommisssionDoller,PS.NetPremium from Policy_Search AS PS
                                " . $where . " order by PolicyId DESC ;");
            $result = $stmt->fetchAll(PDO::FETCH_ASSOC);
            $heading = array('New/Renewal','Master Policy Number','Insured','ProductLine','Product Line Subtype','Underwriter','Region','Branch Office','Reinsured Company','Remarks','Direct/Assumed','Admitted/Non-Admitted','Admitted Details','Company','Company Number','Prefix','Policy Effective Date','Policy Expiry Date','Premium Currency','Inception Gross Premium','Commission %','Commission $','Net Premium');
            $this->download_send_headers("PolicyNumberDetails_Export_" . date("Y-m-d") . ".csv");
            echo $this->array2csv($result, $heading);
            die();
        }
    }

    function array2csv(array &$array, $heading) {
        if (count($array) == 0) {
            return null;
        }
        ob_start();
        $df = fopen("php://output", 'w');
        fputcsv($df, $heading);
        foreach ($array as $value) {
            unset($value['Id']);
            If(!empty($value['PolicyEffectiveDate'])){
                $value['PolicyEffectiveDate'] = date("m-d-Y", strtotime($value['PolicyEffectiveDate']));
            }
            If(!empty($value['PolicyExpiryDate'])){
                $value['PolicyExpiryDate'] = date("m-d-Y", strtotime($value['PolicyExpiryDate']));
            }
            fputcsv($df, $value);
        }
        fclose($df);
        return ob_get_clean();
    }

    function download_send_headers($filename) {
        /*disable caching*/
        $now = gmdate("D, d M Y H:i:s");
        header("Expires: Tue, 03 Jul 2001 06:00:00 GMT");
        header("Cache-Control: max-age=0, no-cache, must-revalidate, proxy-revalidate");
        header("Last-Modified: {$now} GMT");
        /*force download*/  
        header("Content-Type: application/force-download");
        header("Content-Type: application/octet-stream");
        header("Content-Type: application/download");
        /*disposition encoding on response body*/
        header("Content-Disposition: attachment;filename={$filename}");
        header("Content-Transfer-Encoding: binary");
    }

}
