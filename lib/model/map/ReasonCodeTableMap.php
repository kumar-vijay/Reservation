<?php


/**
 * This class defines the structure of the 'REASON_CODE' table.
 *
 *
 * This class was autogenerated by Propel 1.4.2 on:
 *
 * Wed Mar 19 17:19:31 2014
 *
 *
 * This map class is used by Propel to do runtime db structure discovery.
 * For example, the createSelectSql() method checks the type of a given column used in an
 * ORDER BY clause to know whether it needs to apply SQL to make the ORDER BY case-insensitive
 * (i.e. if it's a text column type).
 *
 * @package    lib.model.map
 */
class ReasonCodeTableMap extends TableMap {

	/**
	 * The (dot-path) name of this class
	 */
	const CLASS_NAME = 'lib.model.map.ReasonCodeTableMap';

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
		$this->setName('REASON_CODE');
		$this->setPhpName('ReasonCode');
		$this->setClassname('ReasonCode');
		$this->setPackage('lib.model');
		$this->setUseIdGenerator(true);
		// columns
		$this->addPrimaryKey('REASON_CODE_ID', 'ReasonCodeId', 'INTEGER', true, 11, null);
		$this->addColumn('REASON_CODES', 'ReasonCodes', 'VARCHAR', true, 30, null);
		$this->addColumn('REASON', 'Reason', 'VARCHAR', true, 164, null);
		$this->addColumn('STATUS', 'Status', 'CHAR', true, null, null);
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

} // ReasonCodeTableMap
