/*
* Importing Submission Log
*/

TRUNCATE TABLE `reservation`.`SUBMISSION`;

INSERT INTO `reservation`.`SUBMISSION` (`SUBMISSION_NO`, `SUBMISSION_TYPE`, `SUBMISSION_BRANCH_ID`, `DB_NUMBER`, `INSURED_NAME`, `USER_ID`, `UNDERWRITER_ID`, `PRODUCT_ID`, `PRIMARY_STATUS`, `BLOCK_REASON`, `SECONDARY_STATUS`, `LIMIT`, `ATTACHMENT_POINT`, `PREMIUM`, `BY_BERKSI_FROM_BROKER`, `BY_INDIA_BY_BERKSI`, `COMMISSION`, `TOTAL_INSURED_VALUE`, `RELATIVITY`, `REMARKS`, `INSURED_NAME_DNB`, `IS_NAME_DIFFERENT`, `IS_ADDRESS_DIFFERENT`, `EFFECTIVE_DATE`, `EXPIRATION_DATE`, `CREATION_DATE`, `MODIFY_DATE`)

SELECT `migration`.`SUBMISSION`.`SubmissionNo`, `migration`.`SUBMISSION`.`ProductLine`, `reservation`.`SUBMISSION_BRANCH`.`BRANCH_ID`, `migration`.`SUBMISSION`.`DnBNumber`, 
`migration`.`SUBMISSION`.`InsuredName`, 1, `reservation`.`UNDERWRITER`.`UNDERWRITER_ID`, `reservation`.`PRODUCTS`.`PRODUCT_ID`,  LCASE(`migration`.`SUBMISSION`.`Status 1`), NULL, LCASE(`migration`.`SUBMISSION`.`Status 2`), 0, 0, 0, IF((`migration`.`SUBMISSION`.`By_Berk_SI_FROM_Broker` = 'Not Available') || (`migration`.`SUBMISSION`.`By_Berk_SI_FROM_Broker` IS NULL), '0000-00-00 00:00:00',  DATE_FORMAT(STR_TO_DATE(TRIM(`migration`.`SUBMISSION`.`By_Berk_SI_FROM_Broker`), "%M/%d/%Y %H:%i:%s" ) , "%Y-%m-%d %H:%i:%s")), IF(`migration`.`SUBMISSION`.`By_India_FROM_Berk_SI` = NULL, '0000:00:00 00:00:00', DATE_FORMAT(STR_TO_DATE(TRIM(`migration`.`SUBMISSION`.`By_India_FROM_Berk_SI`), "%M-%d-%Y" ), "%Y-%m-%d %H:%i:%s")), 0, 0, 0, `migration`.`SUBMISSION`.`Remarks 1`, `migration`.`SUBMISSION`.`DBAName`, IF(`migration`.`SUBMISSION`.`DBAName` IS NULL, 'N', 'Y'), IF(`migration`.`SUBMISSION`.`City` IS NULL, 'N', 'Y'), IF(`migration`.`SUBMISSION`.`EffectiveDate` IS NULL, '0000-00-00', IF(STR_TO_DATE(TRIM(`migration`.`SUBMISSION`.`EffectiveDate`), "%M-%d-%Y" ) IS NOT NULL, DATE_FORMAT(STR_TO_DATE(TRIM(`migration`.`SUBMISSION`.`EffectiveDate`), "%M-%d-%Y" ), "%Y-%m-%d"), DATE_FORMAT( STR_TO_DATE(  `migration`.`SUBMISSION`.`EffectiveDate`,  "%d/%m/%Y" ) ,  "%Y-%m-%d"))), IF(`migration`.`SUBMISSION`.`ExpiryDate` IS NULL, '0000-00-00', IF(STR_TO_DATE(TRIM(`migration`.`SUBMISSION`.`ExpiryDate`), "%M-%d-%Y" ) IS NOT NULL, DATE_FORMAT(STR_TO_DATE(TRIM(`migration`.`SUBMISSION`.`ExpiryDate`), "%M-%d-%Y" ), "%Y-%m-%d"), DATE_FORMAT( STR_TO_DATE(`migration`.`SUBMISSION`.`ExpiryDate`,  "%d/%m/%Y" ) ,  "%Y-%m-%d"))), IF(`migration`.`SUBMISSION`.`Date 1` IS NULL,'0000-00-00' , DATE_FORMAT(STR_TO_DATE(TRIM(`migration`.`SUBMISSION`.`Date 1`), "%M-%d-%Y" ), "%Y-%m-%d")), IF(`migration`.`SUBMISSION`.`Date 2` IS NULL,'0000-00-00' , DATE_FORMAT(STR_TO_DATE(TRIM(`migration`.`SUBMISSION`.`Date 2`), "%M-%d-%Y" ), "%Y-%m-%d"))
FROM `migration`.`SUBMISSION`
LEFT JOIN `reservation`.`SUBMISSION_BRANCH` ON `reservation`.`SUBMISSION_BRANCH`.`BRANCH_CODE` = `migration`.`SUBMISSION`.`Branchoffice`
LEFT JOIN `reservation`.`UNDERWRITER` ON `reservation`.`UNDERWRITER`.`UNDERWRITER_NAME` = `migration`.`SUBMISSION`.`Underwriter`
LEFT JOIN `reservation`.`PRODUCTS` ON `reservation`.`PRODUCTS`.`PRODUCT_NAME` = `migration`.`SUBMISSION`.`ProductLineSubtype`;


