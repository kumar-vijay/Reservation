<?php


/**
 * This class defines the structure of the 'InsuredSearch' table.
 *
 *
 * This class was autogenerated by Propel 1.4.2 on:
 *
 * Tue Sep  2 12:24:19 2014
 *
 *
 * This map class is used by Propel to do runtime db structure discovery.
 * For example, the createSelectSql() method checks the type of a given column used in an
 * ORDER BY clause to know whether it needs to apply SQL to make the ORDER BY case-insensitive
 * (i.e. if it's a text column type).
 *
 * @package    lib.model.map
 */
class InsuredsearchTableMap extends TableMap {

	/**
	 * The (dot-path) name of this class
	 */
	const CLASS_NAME = 'lib.model.map.InsuredsearchTableMap';

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
		$this->setName('InsuredSearch');
		$this->setPhpName('Insuredsearch');
		$this->setClassname('Insuredsearch');
		$this->setPackage('lib.model');
		$this->setUseIdGenerator(true);
		// columns
		$this->addColumn('INSUREDID', 'Insuredid', 'INTEGER', true, 11, null);
		$this->addColumn('INSUREDNAME', 'Insuredname', 'VARCHAR', false, 500, null);
		$this->addColumn('ADDRESS', 'Address', 'VARCHAR', false, 500, null);
		$this->addColumn('INSUREDZIP', 'Insuredzip', 'VARCHAR', false, 500, null);
		$this->addColumn('INSUREDCITY', 'Insuredcity', 'VARCHAR', false, 500, null);
		$this->addColumn('INSUREDSTATE', 'Insuredstate', 'VARCHAR', false, 500, null);
		$this->addColumn('INSUREDCOUNTRY', 'Insuredcountry', 'VARCHAR', false, 500, null);
		$this->addColumn('DBNUMBER', 'Dbnumber', 'VARCHAR', false, 50, null);
		$this->addColumn('ADVISENID', 'Advisenid', 'INTEGER', false, 11, null);
                $this->addColumn('INSUREDPARENTID', 'Insuredparentid', 'INTEGER', false, 11, null);
		$this->addColumn('INSUREDSTATUS', 'Insuredstatus', 'VARCHAR', true, 10, null);
		$this->addColumn('CREATEDBY', 'Createdby', 'INTEGER', false, 11, null);
		$this->addColumn('MODIFIEDBY', 'Modifiedby', 'INTEGER', false, 11, null);
		$this->addColumn('CREATEDON', 'Createdon', 'TIMESTAMP', false, null, null);
		$this->addColumn('MODIFIEDON', 'Modifiedon', 'TIMESTAMP', false, null, null);
		$this->addPrimaryKey('ID', 'Id', 'INTEGER', true, null, null);
                $this->addColumn('INSUREDCOUNT', 'InsuredCount', 'VARCHAR', true, 10, null);
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

} // InsuredsearchTableMap