<?php


/**
 * This class defines the structure of the 'BrokerWiseCity' table.
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
class BrokerwisecityTableMap extends TableMap {

	/**
	 * The (dot-path) name of this class
	 */
	const CLASS_NAME = 'lib.model.map.BrokerwisecityTableMap';

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
		$this->setName('BrokerWiseCity');
		$this->setPhpName('Brokerwisecity');
		$this->setClassname('Brokerwisecity');
		$this->setPackage('lib.model');
		$this->setUseIdGenerator(true);
		// columns
		$this->addPrimaryKey('ID', 'Id', 'INTEGER', true, 11, null);
		$this->addForeignKey('BROKERID', 'Brokerid', 'INTEGER', 'Broker', 'ID', false, 11, 0);
		$this->addForeignKey('CITYID', 'Cityid', 'INTEGER', 'City', 'ID', false, 11, 0);
		// validators
	} // initialize()

	/**
	 * Build the RelationMap objects for this table relationships
	 */
	public function buildRelations()
	{
    $this->addRelation('Broker', 'Broker', RelationMap::MANY_TO_ONE, array('BrokerId' => 'Id', ), 'CASCADE', 'CASCADE');
    $this->addRelation('City', 'City', RelationMap::MANY_TO_ONE, array('CityId' => 'Id', ), 'CASCADE', 'CASCADE');
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

} // BrokerwisecityTableMap
