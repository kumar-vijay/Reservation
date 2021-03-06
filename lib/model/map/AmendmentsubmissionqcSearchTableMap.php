<?php


/**
 * This class defines the structure of the 'AmendmentSubmissionQC_Search' table.
 *
 *
 * This class was autogenerated by Propel 1.4.2 on:
 *
 * Wed Mar 11 18:02:26 2015
 *
 *
 * This map class is used by Propel to do runtime db structure discovery.
 * For example, the createSelectSql() method checks the type of a given column used in an
 * ORDER BY clause to know whether it needs to apply SQL to make the ORDER BY case-insensitive
 * (i.e. if it's a text column type).
 *
 * @package    lib.model.map
 */
class AmendmentsubmissionqcSearchTableMap extends TableMap {

	/**
	 * The (dot-path) name of this class
	 */
	const CLASS_NAME = 'lib.model.map.AmendmentsubmissionqcSearchTableMap';

	/**
	 * Initialize the table attributes, columns and validators
	 * Relations are not initialized by this method since they are lazy loaded
	 *
	 * @return     void
	 * @throws     PropelException
	 */
	public function initialize()
	{
	  // attributes
		$this->setName('AmendmentSubmissionQC_Search');
		$this->setPhpName('AmendmentsubmissionqcSearch');
		$this->setClassname('AmendmentsubmissionqcSearch');
		$this->setPackage('lib.model');
		$this->setUseIdGenerator(true);
		// columns
		$this->addColumn('AMENDMENTID', 'Amendmentid', 'INTEGER', true, 11, null);
		$this->addColumn('SUBMISSIONID', 'Submissionid', 'INTEGER', true, 11, null);
		$this->addColumn('SUBMISSIONNUMBER', 'Submissionnumber', 'VARCHAR', false, 50, null);
		$this->addColumn('QCSTATUS', 'Qcstatus', 'VARCHAR', false, 255, null);
		$this->addColumn('PREMIUNTYPE', 'Premiuntype', 'CHAR', false, 3, null);
		$this->addColumn('PREMIUMINLOCALCURRENCY', 'Premiuminlocalcurrency', 'VARCHAR', false, 50, null);
		$this->addColumn('PREMIUMINUSD', 'Premiuminusd', 'VARCHAR', false, 50, null);
		$this->addColumn('LAYEROFLIMITINLOCALCURRENCY', 'Layeroflimitinlocalcurrency', 'VARCHAR', false, 50, null);
		$this->addColumn('LAYEROFLIMITINUSD', 'Layeroflimitinusd', 'VARCHAR', false, 50, null);
		$this->addColumn('PERCENTAGEOFLAYER', 'Percentageoflayer', 'VARCHAR', false, 50, null);
		$this->addColumn('LIMITINLOCALCURRENCY', 'Limitinlocalcurrency', 'VARCHAR', false, 50, null);
		$this->addColumn('LIMITINUSD', 'Limitinusd', 'VARCHAR', false, 50, null);
		$this->addColumn('ATTACHMENTPOINTINLOCALCURRENCY', 'Attachmentpointinlocalcurrency', 'VARCHAR', false, 50, null);
		$this->addColumn('ATTACHMENTPOINTINUSD', 'Attachmentpointinusd', 'VARCHAR', false, 50, null);
		$this->addColumn('SELFINSUREDRETENTIONINLOCALCURRENCY', 'Selfinsuredretentioninlocalcurrency', 'VARCHAR', false, 50, null);
		$this->addColumn('SELFINSUREDRETENTIONINUSD', 'Selfinsuredretentioninusd', 'VARCHAR', false, 50, null);
		$this->addColumn('POLICYCOMMPERCENTAGE', 'Policycommpercentage', 'VARCHAR', false, 50, null);
		$this->addColumn('POLICYCOMMINLOCALCURRENCY', 'Policycomminlocalcurrency', 'VARCHAR', false, 50, null);
		$this->addColumn('POLICYCOMMINUSD', 'Policycomminusd', 'VARCHAR', false, 50, null);
		$this->addColumn('PREMIUMNETOFCOMMINLOCALCURRENCY', 'Premiumnetofcomminlocalcurrency', 'VARCHAR', false, 50, null);
		$this->addColumn('PREMIUMNETOFCOMMINUSD', 'Premiumnetofcomminusd', 'VARCHAR', false, 50, null);
		$this->addColumn('DUCKSUBMISSIONNUMBER', 'Ducksubmissionnumber', 'VARCHAR', false, 50, null);
		$this->addColumn('NEWRENEWAL', 'Newrenewal', 'VARCHAR', false, 255, null);
		$this->addColumn('UNDERWRITERNAME', 'Underwritername', 'CLOB', false, null, null);
		$this->addColumn('PRODUCTLINE', 'Productline', 'VARCHAR', false, 255, null);
		$this->addColumn('PRODUCTLINESUBTYPE', 'Productlinesubtype', 'VARCHAR', false, 255, null);
		$this->addColumn('SECTIONCODE', 'Sectioncode', 'VARCHAR', false, 250, null);
		$this->addColumn('PROFITCODE', 'Profitcode', 'VARCHAR', false, 255, null);
		$this->addColumn('STATUS', 'Status', 'VARCHAR', false, 50, null);
		$this->addColumn('EFFECTIVEDATE', 'Effectivedate', 'TIMESTAMP', false, null, null);
		$this->addColumn('EXPIRYDATE', 'Expirydate', 'TIMESTAMP', false, null, null);
		$this->addColumn('CURRENCY', 'Currency', 'VARCHAR', false, 255, null);
		$this->addColumn('EXCHANGERATE', 'Exchangerate', 'VARCHAR', false, 50, null);
		$this->addColumn('EXCHANGEDATE', 'Exchangedate', 'TIMESTAMP', false, null, null);
		$this->addColumn('INSUREDNAME', 'Insuredname', 'VARCHAR', false, 500, null);
		$this->addColumn('INSUREDADDRESS1', 'Insuredaddress1', 'VARCHAR', false, 500, null);
		$this->addColumn('INSUREDCITY', 'Insuredcity', 'VARCHAR', false, 500, null);
		$this->addColumn('INSUREDSTATE', 'Insuredstate', 'VARCHAR', false, 500, null);
		$this->addColumn('INSUREDCOUNTRY', 'Insuredcountry', 'VARCHAR', false, 500, null);
		$this->addColumn('INSUREDZIPCODE', 'Insuredzipcode', 'VARCHAR', false, 500, null);
		$this->addColumn('ADVISENID', 'Advisenid', 'INTEGER', false, 11, null);
		$this->addColumn('DBNUMBER', 'Dbnumber', 'VARCHAR', false, 50, null);
		$this->addColumn('DBANAME', 'Dbaname', 'VARCHAR', false, 250, null);
		$this->addColumn('CABCOMPANIES', 'Cabcompanies', 'VARCHAR', false, 255, null);
		$this->addColumn('REINSUREDCOMPANY', 'Reinsuredcompany', 'VARCHAR', false, 250, null);
		$this->addColumn('SUBMISSIONIDENTIFIER', 'Submissionidentifier', 'VARCHAR', false, 500, null);
		$this->addColumn('INSUREDCONTACTPERSONNAME', 'Insuredcontactpersonname', 'VARCHAR', false, null, null);
		$this->addColumn('INSUREDCONTACTPERSONEMAIL', 'Insuredcontactpersonemail', 'VARCHAR', false, 50, null);
		$this->addColumn('INSUREDCONTACTPERSONPHONENUMBER', 'Insuredcontactpersonphonenumber', 'VARCHAR', false, 11, null);
		$this->addColumn('INSUREDCONTACTPERSONMOBILENUMBER', 'Insuredcontactpersonmobilenumber', 'VARCHAR', false, 11, null);
		$this->addColumn('INSUREDQUOTEDUEDATE', 'Insuredquoteduedate', 'TIMESTAMP', false, null, null);
		$this->addColumn('INSUREDSUBMISSIONDATE', 'Insuredsubmissiondate', 'TIMESTAMP', false, null, null);
		$this->addColumn('TOTALINSUREDVALUEINLOCALCURRENCY', 'Totalinsuredvalueinlocalcurrency', 'VARCHAR', false, 100, null);
		$this->addColumn('TOTALINSUREDVALUEINUSD', 'Totalinsuredvalueinusd', 'VARCHAR', false, 100, null);
		$this->addColumn('RISKPROFILE', 'Riskprofile', 'VARCHAR', false, 250, null);
		$this->addColumn('NUMBEROFLOCATIONS', 'Numberoflocations', 'VARCHAR', false, 255, null);
		$this->addColumn('OCCUPANCYCODE', 'Occupancycode', 'VARCHAR', false, 100, null);
		$this->addColumn('REASONCODE', 'Reasoncode', 'CLOB', false, null, null);
		$this->addColumn('PROCESSDATE', 'Processdate', 'TIMESTAMP', false, null, null);
		$this->addColumn('BERKSIDATEFROMBROKER', 'Berksidatefrombroker', 'TIMESTAMP', false, null, null);
		$this->addColumn('BERKSIDATEFROMINDIA', 'Berksidatefromindia', 'TIMESTAMP', false, null, null);
		$this->addColumn('BRANCHNAME', 'Branchname', 'VARCHAR', false, 50, null);
		$this->addColumn('PROJECTNAME', 'Projectname', 'VARCHAR', false, 250, null);
		$this->addColumn('PROJECTCONTRACTORNAME', 'Projectcontractorname', 'VARCHAR', false, 250, null);
		$this->addColumn('PROJECTOWNERNAME', 'Projectownername', 'VARCHAR', false, 250, null);
		$this->addColumn('PROJECTADDRESSLINE1', 'Projectaddressline1', 'VARCHAR', false, 250, null);
		$this->addColumn('PROJECTCITY', 'Projectcity', 'VARCHAR', false, 250, null);
		$this->addColumn('PROJECTSTATE', 'Projectstate', 'VARCHAR', false, 250, null);
		$this->addColumn('PROJECTCOUNTRY', 'Projectcountry', 'VARCHAR', false, 250, null);
		$this->addColumn('BIDSITUATION', 'Bidsituation', 'VARCHAR', false, 255, null);
		$this->addColumn('BROKERCODE', 'Brokercode', 'VARCHAR', false, 50, null);
		$this->addColumn('BROKERNAME', 'Brokername', 'VARCHAR', false, 50, null);
		$this->addColumn('BROKERTYPE', 'Brokertype', 'VARCHAR', false, 255, null);
		$this->addColumn('BROKERCOUNTRY', 'Brokercountry', 'VARCHAR', false, 255, null);
		$this->addColumn('BROKERSTATE', 'Brokerstate', 'VARCHAR', false, 101, null);
		$this->addColumn('BROKERCITY', 'Brokercity', 'VARCHAR', false, 50, null);
		$this->addColumn('BROKERCONTACTPERSON', 'Brokercontactperson', 'VARCHAR', false, null, null);
		$this->addColumn('BROKERCONTACTPERSONEMAIL', 'Brokercontactpersonemail', 'VARCHAR', false, 50, null);
		$this->addColumn('BROKERCONTACTPERSONNUMBER', 'Brokercontactpersonnumber', 'VARCHAR', false, 11, null);
		$this->addColumn('BROKERCONTACTPERSONMOBILE', 'Brokercontactpersonmobile', 'VARCHAR', false, 11, null);
		$this->addColumn('RETAILBROKERNAME', 'Retailbrokername', 'VARCHAR', false, 50, null);
		$this->addColumn('RETAILBROKERCOUNTRY', 'Retailbrokercountry', 'VARCHAR', false, 255, null);
		$this->addColumn('RETAILBROKERSTATE', 'Retailbrokerstate', 'VARCHAR', false, 101, null);
		$this->addColumn('RETAILBROKERCITY', 'Retailbrokercity', 'VARCHAR', false, 50, null);
		$this->addColumn('BINDDATE', 'Binddate', 'TIMESTAMP', false, null, null);
		$this->addColumn('RENEWABLE', 'Renewable', 'VARCHAR', false, 255, null);
		$this->addColumn('DATEOFRENEWAL', 'Dateofrenewal', 'TIMESTAMP', false, null, null);
		$this->addColumn('POLICYTYPE', 'Policytype', 'VARCHAR', false, 255, null);
		$this->addColumn('DIRECTASSUMED', 'Directassumed', 'VARCHAR', false, 255, null);
		$this->addColumn('ADMITTEDNONADMITTED', 'Admittednonadmitted', 'VARCHAR', false, 255, null);
		$this->addColumn('COMPANYPAPER', 'Companypaper', 'VARCHAR', false, 255, null);
		$this->addColumn('COMPANYPAPERNUMBER', 'Companypapernumber', 'VARCHAR', false, 255, null);
		$this->addColumn('POLICYNUMBER', 'Policynumber', 'VARCHAR', false, 50, null);
		$this->addColumn('COVERAGE', 'Coverage', 'VARCHAR', false, 250, null);
		$this->addColumn('SUFFIX', 'Suffix', 'VARCHAR', false, 255, null);
		$this->addColumn('TRANSACTIONNUMBER', 'Transactionnumber', 'VARCHAR', false, 50, null);
		$this->addColumn('NAICCODE', 'Naiccode', 'VARCHAR', false, 50, null);
		$this->addColumn('NAICTITLE', 'Naictitle', 'VARCHAR', false, 50, null);
		$this->addColumn('SICCODE', 'Siccode', 'VARCHAR', false, 50, null);
		$this->addColumn('SICTITLE', 'Sictitle', 'VARCHAR', false, 50, null);
		$this->addColumn('OFRCADVERSEREPORT', 'Ofrcadversereport', 'VARCHAR', false, 255, null);
		$this->addColumn('FINALPOLICYNUMBER', 'Finalpolicynumber', 'VARCHAR', false, 50, null);
		$this->addPrimaryKey('ID', 'Id', 'INTEGER', true, null, null); 
		// validators
	} // initialize()

	/**
	 * Build the RelationMap objects for this table relationships
	 */
	public function buildRelations()
	{
	} // buildRelations()

	/**
	 * 
	 * Gets the list of behaviors registered for this table
	 * 
	 * @return array Associative array (name => parameters) of behaviors
	 */
	public function getBehaviors()
	{
		return array(
			'symfony' => array('form' => 'true', 'filter' => 'true', ),
			'symfony_behaviors' => array(),
		);
	} // getBehaviors()

} // AmendmentsubmissionqcSearchTableMap
