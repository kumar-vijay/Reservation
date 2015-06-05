<?php

class ViewSubmissionAmendmentHistory {

    public function __construct() {
        $this->connection = Propel::getConnection();
    }

    public function FetchSubmissionAmendmentHistory($amendmentId) {
        $connection = $this->connection;
        $HistoryQuery = "Select * from AmendmentSubmissionHistory_Search Where SubmissionAmendentId = $amendmentId order by AmendmentId DESC";
        $HistoryStatement = $connection->prepare($HistoryQuery);
        $HistoryStatement->execute();
        $HistoryData = $HistoryStatement->fetchAll(PDO::FETCH_ASSOC);
        return $HistoryData;
    }

    public function GetDatarecorderMetaData($amendmentId) {
        $con = Propel::getConnection();
        $query = "SELECT D.* FROM SubmissionAmendment AS P INNER JOIN DataRecorderMetaData AS D on P.DataRecorderMetaDataId = D.Id  WHERE P.Id = '" . $amendmentId . "'";
        $stmt = $con->query($query);
        $result = $stmt->fetchAll(PDO::FETCH_ASSOC);
        return $result;
    }

}
