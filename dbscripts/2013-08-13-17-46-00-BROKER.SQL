/*
* Importing data into `reservation`.`BROKERS`
*/

TRUNCATE TABLE `reservation`.`BROKERS`;

INSERT INTO `reservation`.`BROKERS` ( `BROKERS`.`BROKER_CODE`, `BROKERS`.`SUBMISSION_ID`) 
SELECT `migration`.`SUBMISSION`.`BrokerCode`, `reservation`.`SUBMISSION`.`SUBMISSION_ID`
FROM `migration`.`SUBMISSION` LEFT JOIN `reservation`.`SUBMISSION` ON `reservation`.`SUBMISSION`.`SUBMISSION_NO` = `migration`.`SUBMISSION`.`SubmissionNo`;
