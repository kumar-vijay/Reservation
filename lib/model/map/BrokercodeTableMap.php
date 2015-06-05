<?php


/**
 * This class defines the structure of the 'BrokerCode' table.
 *
 *
 * This class was autogenerated by Propel 1.4.2 on:
 *
 * Tue Apr  1 12:06:50 2014
 *
 *
 * This map class is used by Propel to do runtime db structure discovery.
 * For example, the createSelectSql() method checks the type of a given column used in an
 * ORDER BY clause to know whether it needs to apply SQL to make the ORDER BY case-insensitive
 * (i.e. if it's a text column type).
 *
 * @package    lib.model.map
 */
class BrokercodeTableMap extends TableMap {

	/**
	 * The (dot-path) name of this class
	 */
	const CLASS_NAME = 'lib.model.map.BrokercodeTableMap';

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
		$this->setName('BrokerCode');
		$this->setPhpName('Brokercode');
		$this->setClassname('Brokercode');
		$this->setPackage('lib.model');
		$this->setUseIdGenerator(true);
		// columns
		$this->addPrimaryKey('ID', 'Id', 'INTEGER', true, 11, null);
		$this->addColumn('BROKERNAME', 'Brokername', 'CLOB', false, null, null);
		$this->addColumn('COUNTRY3DIGIT', 'Country3digit', 'VARCHAR', false, 255, null);
		$this->addColumn('STATETERRITORY3DIGIT', 'Stateterritory3digit', 'VARCHAR', false, 255, null);
		$this->addColumn('CITY4DIGIT', 'City4digit', 'VARCHAR', false, 255, null);
		$this->addColumn('BROKERCODE', 'Brokercode', 'CLOB', false, null, null);
		$this->addColumn('SSMA_TIMESTAMP', 'SsmaTimestamp', 'VARCHAR', true, 8, null);
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

} // BrokercodeTableMap