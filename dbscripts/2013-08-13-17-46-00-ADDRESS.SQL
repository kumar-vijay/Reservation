/*
* IMPORTING DATA INTO ADD `reservation`.`ADDRESS`
*/

TRUNCATE TABLE `reservation`.`ADDRESS`;

INSERT INTO `reservation`.`ADDRESS`( `SUBMISSION_ID`, `ADDRESS_LINE1`, `ADDRESS_LINE2`, `CITY`, `STATE_ID`, `ZIP_CODE`, `COUNTRY`, `ADDRESS_TYPE`, `CREATED_ON`, `MODIFIED_ON`)

(SELECT `reservation`.`SUBMISSION`.`SUBMISSION_ID`, `migration`.`SUBMISSION`.`InsuredMailingAddressline1`, NULL, `migration`.`SUBMISSION`.`Scity`, `migration`.`SUBMISSION`.`Sstate`, `migration`.`SUBMISSION`.`Szipcode`, '001 - USA', 'submission',
IF(`migration`.`SUBMISSION`.`Date 1` IS NULL,'0000-00-00' , DATE_FORMAT(STR_TO_DATE(TRIM(`migration`.`SUBMISSION`.`Date 1`), "%M-%d-%Y" ), "%Y-%m-%d")),
IF(`migration`.`SUBMISSION`.`Date 2` IS NULL,'0000-00-00' , DATE_FORMAT(STR_TO_DATE(TRIM(`migration`.`SUBMISSION`.`Date 2`), "%M-%d-%Y" ), "%Y-%m-%d"))
FROM `migration`.`SUBMISSION` LEFT JOIN `reservation`.`SUBMISSION` ON `reservation`.`SUBMISSION`.`SUBMISSION_NO` = `migration`.`SUBMISSION`.`SubmissionNo`)
UNION 
(SELECT `reservation`.`SUBMISSION`.`SUBMISSION_ID`, IF(`migration`.`SUBMISSION`.`City` IS NOT NULL,`migration`.`SUBMISSION`.`Alternate Add line 1`, `migration`.`SUBMISSION`.`InsuredMailingAddressline1`), NULL, IF(`migration`.`SUBMISSION`.`City` IS NOT NULL, `migration`.`SUBMISSION`.`City`,`migration`.`SUBMISSION`.`Scity`), IF(`migration`.`SUBMISSION`.`City` IS NOT NULL, `migration`.`SUBMISSION`.`State`, `migration`.`SUBMISSION`.`Sstate`), IF(`migration`.`SUBMISSION`.`City` IS NOT NULL, `migration`.`SUBMISSION`.`Zipcode`,`migration`.`SUBMISSION`.`Szipcode`),
'001 - USA', 'mailing', IF(`migration`.`SUBMISSION`.`Date 1` IS NULL,'0000-00-00' , DATE_FORMAT(STR_TO_DATE(TRIM(`migration`.`SUBMISSION`.`Date 1`), "%M-%d-%Y" ), "%Y-%m-%d")), IF(`migration`.`SUBMISSION`.`Date 2` IS NULL,'0000-00-00' , DATE_FORMAT(STR_TO_DATE(TRIM(`migration`.`SUBMISSION`.`Date 2`), "%M-%d-%Y" ), "%Y-%m-%d"))
FROM `migration`.`SUBMISSION` LEFT JOIN `reservation`.`SUBMISSION` ON `reservation`.`SUBMISSION`.`SUBMISSION_NO` = `migration`.`SUBMISSION`.`SubmissionNo`) ORDER BY `SUBMISSION_ID` ASC;

