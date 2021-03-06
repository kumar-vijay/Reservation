<?php


/**
 * This class defines the structure of the 'City' table.
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
class CityTableMap extends TableMap {

	/**
	 * The (dot-path) name of this class
	 */
	const CLASS_NAME = 'lib.model.map.CityTableMap';

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
		$this->setName('City');
		$this->setPhpName('City');
		$this->setClassname('City');
		$this->setPackage('lib.model');
		$this->setUseIdGenerator(true);
		// columns
		$this->addPrimaryKey('ID', 'Id', 'INTEGER', true, 11, null);
		$this->addColumn('CITY', 'City', 'VARCHAR', false, 50, null);
		$this->addColumn('STATE', 'State', 'VARCHAR', false, 50, null);
		$this->addColumn('CITYCODE', 'Citycode', 'VARCHAR', false, 50, null);
		$this->addColumn('CITYFULLCODE', 'Cityfullcode', 'VARCHAR', false, 50, null);
		$this->addColumn('STATECODE', 'Statecode', 'VARCHAR', false, 50, null);
		$this->addForeignKey('STATEID', 'Stateid', 'INTEGER', 'State', 'ID', false, 11, 0);
		// validators
	} // initialize()

	/**
	 * Build the RelationMap objects for this table relationships
	 */
	public function buildRelations()
	{
    $this->addRelation('StateRelatedByStateid', 'State', RelationMap::MANY_TO_ONE, array('StateId' => 'Id', ), 'CASCADE', 'CASCADE');
    $this->addRelation('Address', 'Address', RelationMap::ONE_TO_MANY, array('Id' => 'CityId', ), 'RESTRICT', 'RESTRICT');
    $this->addRelation('Branch', 'Branch', RelationMap::ONE_TO_MANY, array('Id' => 'CityCodeId', ), 'CASCADE', 'CASCADE');
    $this->addRelation('Brokerwisecity', 'Brokerwisecity', RelationMap::ONE_TO_MANY, array('Id' => 'CityId', ), 'CASCADE', 'CASCADE');
    $this->addRelation('Insured', 'Insured', RelationMap::ONE_TO_MANY, array('Id' => 'CityId', ), 'CASCADE', 'CASCADE');
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

} // CityTableMap
