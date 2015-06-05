<?php


/**
 * This class defines the structure of the 'StatusDependentDetails' table.
 *
 *
 * This class was autogenerated by Propel 1.4.2 on:
 *
 * Tue Apr  1 12:06:51 2014
 *
 *
 * This map class is used by Propel to do runtime db structure discovery.
 * For example, the createSelectSql() method checks the type of a given column used in an
 * ORDER BY clause to know whether it needs to apply SQL to make the ORDER BY case-insensitive
 * (i.e. if it's a text column type).
 *
 * @package    lib.model.map
 */
class StatusdependentdetailsTableMap extends TableMap {

	/**
	 * The (dot-path) name of this class
	 */
	const CLASS_NAME = 'lib.model.map.StatusdependentdetailsTableMap';

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
		$this->setName('StatusDependentDetails');
		$this->setPhpName('Statusdependentdetails');
		$this->setClassname('Statusdependentdetails');
		$this->setPackage('lib.model');
		$this->setUseIdGenerator(true);
		// columns
		$this->addPrimaryKey('ID', 'Id', 'INTEGER', true, 11, null);
		$this->addForeignKey('REASONCODEID', 'Reasoncodeid', 'INTEGER', 'ReasonCode', 'ID', false, 11, null);
		$this->addColumn('PROCESSDATE', 'Processdate', 'TIMESTAMP', false, null, null);
		$this->addColumn('GROSSPREMIUM', 'Grosspremium', 'DECIMAL', false, 18, null);
		$this->addColumn('LIMIT', 'Limit', 'INTEGER', false, 11, null);
		$this->addColumn('ATTACHMENTPOINT', 'Attachmentpoint', 'INTEGER', false, 11, null);
		// validators
	} // initialize()

	/**
	 * Build the RelationMap objects for this table relationships
	 */
	public function buildRelations()
	{
    $this->addRelation('Reasoncode', 'Reasoncode', RelationMap::MANY_TO_ONE, array('ReasonCodeId' => 'Id', ), 'RESTRICT', 'RESTRICT');
    $this->addRelation('Submission', 'Submission', RelationMap::ONE_TO_MANY, array('Id' => 'StatusDependentDetailsId', ), 'RESTRICT', 'RESTRICT');
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

} // StatusdependentdetailsTableMap
