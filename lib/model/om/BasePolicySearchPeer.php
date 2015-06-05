<?php

/**
 * Base static class for performing query and update operations on the 'Policy_Search' table.
 *
 * 
 *
 * This class was autogenerated by Propel 1.4.2 on:
 *
 * Mon Feb  9 01:55:06 2015
 *
 * @package    lib.model.om
 */
abstract class BasePolicySearchPeer {

	/** the default database name for this class */
	const DATABASE_NAME = 'propel';

	/** the table name for this class */
	const TABLE_NAME = 'Policy_Search';

	/** the related Propel class for this table */
	const OM_CLASS = 'PolicySearch';

	/** A class that can be returned by this peer. */
	const CLASS_DEFAULT = 'lib.model.PolicySearch';

	/** the related TableMap class for this table */
	const TM_CLASS = 'PolicySearchTableMap';
	
	/** The total number of columns. */
	const NUM_COLUMNS = 31;

	/** The number of lazy-loaded columns. */
	const NUM_LAZY_LOAD_COLUMNS = 0;

	/** the column name for the POLICYID field */
	const POLICYID = '0';

	/** the column name for the MASTERPOLICYNUMBER field */
	const MASTERPOLICYNUMBER = 'Policy_Search.MASTERPOLICYNUMBER';

	/** the column name for the INSUREDNAME field */
	const INSUREDNAME = 'Policy_Search.INSUREDNAME';

	/** the column name for the PRODUCTLINE field */
	const PRODUCTLINE = 'Policy_Search.PRODUCTLINE';

	/** the column name for the PRODUCTLINESUBTYPE field */
	const PRODUCTLINESUBTYPE = 'Policy_Search.PRODUCTLINESUBTYPE';

	/** the column name for the UNDERWRITERNAME field */
	const UNDERWRITERNAME = 'Policy_Search.UNDERWRITERNAME';

	/** the column name for the REGIONNAME field */
	const REGIONNAME = 'Policy_Search.REGIONNAME';

	/** the column name for the BRANCHNAME field */
	const BRANCHNAME = 'Policy_Search.BRANCHNAME';

	/** the column name for the REINSUREDCOMPANY field */
	const REINSUREDCOMPANY = 'Policy_Search.REINSUREDCOMPANY';

	/** the column name for the REMARKS field */
	const REMARKS = 'Policy_Search.REMARKS';

	/** the column name for the DIRECTASSUMED field */
	const DIRECTASSUMED = 'Policy_Search.DIRECTASSUMED';

	/** the column name for the ADMITTEDNOTADMITTED field */
	const ADMITTEDNOTADMITTED = 'Policy_Search.ADMITTEDNOTADMITTED';

	/** the column name for the ADMITTEDDETAILS field */
	const ADMITTEDDETAILS = 'Policy_Search.ADMITTEDDETAILS';

	/** the column name for the COMPANY field */
	const COMPANY = 'Policy_Search.COMPANY';

	/** the column name for the COMPANYNUMBER field */
	const COMPANYNUMBER = 'Policy_Search.COMPANYNUMBER';

	/** the column name for the PREFIX field */
	const PREFIX = 'Policy_Search.PREFIX';

	/** the column name for the SUFFIX field */
	const SUFFIX = 'Policy_Search.SUFFIX';

	/** the column name for the NEWRENEWAL field */
	const NEWRENEWAL = 'Policy_Search.NEWRENEWAL';

	/** the column name for the POLICYEFFECTIVEDATE field */
	const POLICYEFFECTIVEDATE = 'Policy_Search.POLICYEFFECTIVEDATE';

	/** the column name for the POLICYEXPIRYDATE field */
	const POLICYEXPIRYDATE = 'Policy_Search.POLICYEXPIRYDATE';

	/** the column name for the POLICYCURRENCY field */
	const POLICYCURRENCY = 'Policy_Search.POLICYCURRENCY';

	/** the column name for the POLICYCURRENCYSYMBOL field */
	const POLICYCURRENCYSYMBOL = 'Policy_Search.POLICYCURRENCYSYMBOL';

	/** the column name for the INCEPTIONGROSSPREMIUM field */
	const INCEPTIONGROSSPREMIUM = 'Policy_Search.INCEPTIONGROSSPREMIUM';

	/** the column name for the COMMISSSIONPERCENTAGE field */
	const COMMISSSIONPERCENTAGE = 'Policy_Search.COMMISSSIONPERCENTAGE';

	/** the column name for the COMMISSSIONDOLLER field */
	const COMMISSSIONDOLLER = 'Policy_Search.COMMISSSIONDOLLER';

	/** the column name for the NETPREMIUM field */
	const NETPREMIUM = 'Policy_Search.NETPREMIUM';

	/** the column name for the CREATEDBY field */
	const CREATEDBY = 'Policy_Search.CREATEDBY';

	/** the column name for the CREATEDDATE field */
	const CREATEDDATE = 'Policy_Search.CREATEDDATE';

	/** the column name for the MODIFIEDBY field */
	const MODIFIEDBY = 'Policy_Search.MODIFIEDBY';

	/** the column name for the MODIFIEDDATE field */
	const MODIFIEDDATE = 'Policy_Search.MODIFIEDDATE';

	/** the column name for the ID field */
	const ID = 'Policy_Search.POLICYID';

	/**
	 * An identiy map to hold any loaded instances of PolicySearch objects.
	 * This must be public so that other peer classes can access this when hydrating from JOIN
	 * queries.
	 * @var        array PolicySearch[]
	 */
	public static $instances = array();


	// symfony behavior
	
	/**
	 * Indicates whether the current model includes I18N.
	 */
	const IS_I18N = false;

	/**
	 * holds an array of fieldnames
	 *
	 * first dimension keys are the type constants
	 * e.g. self::$fieldNames[self::TYPE_PHPNAME][0] = 'Id'
	 */
	private static $fieldNames = array (
		BasePeer::TYPE_PHPNAME => array ('Policyid', 'Masterpolicynumber', 'Insuredname', 'Productline', 'Productlinesubtype', 'Underwritername', 'Regionname', 'Branchname', 'Reinsuredcompany', 'Remarks', 'Directassumed', 'Admittednotadmitted', 'Admitteddetails', 'Company', 'Companynumber', 'Prefix', 'Suffix', 'Newrenewal', 'Policyeffectivedate', 'Policyexpirydate', 'Policycurrency', 'Policycurrencysymbol', 'Inceptiongrosspremium', 'Commisssionpercentage', 'Commisssiondoller', 'Netpremium', 'Createdby', 'Createddate', 'Modifiedby', 'Modifieddate', 'Id', ),
		BasePeer::TYPE_STUDLYPHPNAME => array ('policyid', 'masterpolicynumber', 'insuredname', 'productline', 'productlinesubtype', 'underwritername', 'regionname', 'branchname', 'reinsuredcompany', 'remarks', 'directassumed', 'admittednotadmitted', 'admitteddetails', 'company', 'companynumber', 'prefix', 'suffix', 'newrenewal', 'policyeffectivedate', 'policyexpirydate', 'policycurrency', 'policycurrencysymbol', 'inceptiongrosspremium', 'commisssionpercentage', 'commisssiondoller', 'netpremium', 'createdby', 'createddate', 'modifiedby', 'modifieddate', 'id', ),
		BasePeer::TYPE_COLNAME => array (self::POLICYID, self::MASTERPOLICYNUMBER, self::INSUREDNAME, self::PRODUCTLINE, self::PRODUCTLINESUBTYPE, self::UNDERWRITERNAME, self::REGIONNAME, self::BRANCHNAME, self::REINSUREDCOMPANY, self::REMARKS, self::DIRECTASSUMED, self::ADMITTEDNOTADMITTED, self::ADMITTEDDETAILS, self::COMPANY, self::COMPANYNUMBER, self::PREFIX, self::SUFFIX, self::NEWRENEWAL, self::POLICYEFFECTIVEDATE, self::POLICYEXPIRYDATE, self::POLICYCURRENCY, self::POLICYCURRENCYSYMBOL, self::INCEPTIONGROSSPREMIUM, self::COMMISSSIONPERCENTAGE, self::COMMISSSIONDOLLER, self::NETPREMIUM, self::CREATEDBY, self::CREATEDDATE, self::MODIFIEDBY, self::MODIFIEDDATE, self::ID, ),
		BasePeer::TYPE_FIELDNAME => array ('PolicyId', 'MasterPolicyNumber', 'InsuredName', 'ProductLine', 'ProductLineSubType', 'UnderwriterName', 'RegionName', 'BranchName', 'ReinsuredCompany', 'Remarks', 'DirectAssumed', 'AdmittedNotAdmitted', 'AdmittedDetails', 'Company', 'CompanyNumber', 'Prefix', 'Suffix', 'NewRenewal', 'PolicyEffectiveDate', 'PolicyExpiryDate', 'PolicyCurrency', 'PolicyCurrencySymbol', 'InceptionGrossPremium', 'CommisssionPercentage', 'CommisssionDoller', 'NetPremium', 'CreatedBy', 'CreatedDate', 'ModifiedBy', 'modifiedDate', 'id', ),
		BasePeer::TYPE_NUM => array (0, 1, 2, 3, 4, 5, 6, 7, 8, 9, 10, 11, 12, 13, 14, 15, 16, 17, 18, 19, 20, 21, 22, 23, 24, 25, 26, 27, 28, 29, 30, )
	);

	/**
	 * holds an array of keys for quick access to the fieldnames array
	 *
	 * first dimension keys are the type constants
	 * e.g. self::$fieldNames[BasePeer::TYPE_PHPNAME]['Id'] = 0
	 */
	private static $fieldKeys = array (
		BasePeer::TYPE_PHPNAME => array ('Policyid' => 0, 'Masterpolicynumber' => 1, 'Insuredname' => 2, 'Productline' => 3, 'Productlinesubtype' => 4, 'Underwritername' => 5, 'Regionname' => 6, 'Branchname' => 7, 'Reinsuredcompany' => 8, 'Remarks' => 9, 'Directassumed' => 10, 'Admittednotadmitted' => 11, 'Admitteddetails' => 12, 'Company' => 13, 'Companynumber' => 14, 'Prefix' => 15, 'Suffix' => 16, 'Newrenewal' => 17, 'Policyeffectivedate' => 18, 'Policyexpirydate' => 19, 'Policycurrency' => 20, 'Policycurrencysymbol' => 21, 'Inceptiongrosspremium' => 22, 'Commisssionpercentage' => 23, 'Commisssiondoller' => 24, 'Netpremium' => 25, 'Createdby' => 26, 'Createddate' => 27, 'Modifiedby' => 28, 'Modifieddate' => 29, 'Id' => 30, ),
		BasePeer::TYPE_STUDLYPHPNAME => array ('policyid' => 0, 'masterpolicynumber' => 1, 'insuredname' => 2, 'productline' => 3, 'productlinesubtype' => 4, 'underwritername' => 5, 'regionname' => 6, 'branchname' => 7, 'reinsuredcompany' => 8, 'remarks' => 9, 'directassumed' => 10, 'admittednotadmitted' => 11, 'admitteddetails' => 12, 'company' => 13, 'companynumber' => 14, 'prefix' => 15, 'suffix' => 16, 'newrenewal' => 17, 'policyeffectivedate' => 18, 'policyexpirydate' => 19, 'policycurrency' => 20, 'policycurrencysymbol' => 21, 'inceptiongrosspremium' => 22, 'commisssionpercentage' => 23, 'commisssiondoller' => 24, 'netpremium' => 25, 'createdby' => 26, 'createddate' => 27, 'modifiedby' => 28, 'modifieddate' => 29, 'id' => 30, ),
		BasePeer::TYPE_COLNAME => array (self::POLICYID => 0, self::MASTERPOLICYNUMBER => 1, self::INSUREDNAME => 2, self::PRODUCTLINE => 3, self::PRODUCTLINESUBTYPE => 4, self::UNDERWRITERNAME => 5, self::REGIONNAME => 6, self::BRANCHNAME => 7, self::REINSUREDCOMPANY => 8, self::REMARKS => 9, self::DIRECTASSUMED => 10, self::ADMITTEDNOTADMITTED => 11, self::ADMITTEDDETAILS => 12, self::COMPANY => 13, self::COMPANYNUMBER => 14, self::PREFIX => 15, self::SUFFIX => 16, self::NEWRENEWAL => 17, self::POLICYEFFECTIVEDATE => 18, self::POLICYEXPIRYDATE => 19, self::POLICYCURRENCY => 20, self::POLICYCURRENCYSYMBOL => 21, self::INCEPTIONGROSSPREMIUM => 22, self::COMMISSSIONPERCENTAGE => 23, self::COMMISSSIONDOLLER => 24, self::NETPREMIUM => 25, self::CREATEDBY => 26, self::CREATEDDATE => 27, self::MODIFIEDBY => 28, self::MODIFIEDDATE => 29, self::ID => 30, ),
		BasePeer::TYPE_FIELDNAME => array ('PolicyId' => 0, 'MasterPolicyNumber' => 1, 'InsuredName' => 2, 'ProductLine' => 3, 'ProductLineSubType' => 4, 'UnderwriterName' => 5, 'RegionName' => 6, 'BranchName' => 7, 'ReinsuredCompany' => 8, 'Remarks' => 9, 'DirectAssumed' => 10, 'AdmittedNotAdmitted' => 11, 'AdmittedDetails' => 12, 'Company' => 13, 'CompanyNumber' => 14, 'Prefix' => 15, 'Suffix' => 16, 'NewRenewal' => 17, 'PolicyEffectiveDate' => 18, 'PolicyExpiryDate' => 19, 'PolicyCurrency' => 20, 'PolicyCurrencySymbol' => 21, 'InceptionGrossPremium' => 22, 'CommisssionPercentage' => 23, 'CommisssionDoller' => 24, 'NetPremium' => 25, 'CreatedBy' => 26, 'CreatedDate' => 27, 'ModifiedBy' => 28, 'modifiedDate' => 29, 'id' => 30, ),
		BasePeer::TYPE_NUM => array (0, 1, 2, 3, 4, 5, 6, 7, 8, 9, 10, 11, 12, 13, 14, 15, 16, 17, 18, 19, 20, 21, 22, 23, 24, 25, 26, 27, 28, 29, 30, )
	);

	/**
	 * Translates a fieldname to another type
	 *
	 * @param      string $name field name
	 * @param      string $fromType One of the class type constants BasePeer::TYPE_PHPNAME, BasePeer::TYPE_STUDLYPHPNAME
	 *                         BasePeer::TYPE_COLNAME, BasePeer::TYPE_FIELDNAME, BasePeer::TYPE_NUM
	 * @param      string $toType   One of the class type constants
	 * @return     string translated name of the field.
	 * @throws     PropelException - if the specified name could not be found in the fieldname mappings.
	 */
	static public function translateFieldName($name, $fromType, $toType)
	{
		$toNames = self::getFieldNames($toType);
		$key = isset(self::$fieldKeys[$fromType][$name]) ? self::$fieldKeys[$fromType][$name] : null;
		if ($key === null) {
			throw new PropelException("'$name' could not be found in the field names of type '$fromType'. These are: " . print_r(self::$fieldKeys[$fromType], true));
		}
		return $toNames[$key];
	}

	/**
	 * Returns an array of field names.
	 *
	 * @param      string $type The type of fieldnames to return:
	 *                      One of the class type constants BasePeer::TYPE_PHPNAME, BasePeer::TYPE_STUDLYPHPNAME
	 *                      BasePeer::TYPE_COLNAME, BasePeer::TYPE_FIELDNAME, BasePeer::TYPE_NUM
	 * @return     array A list of field names
	 */

	static public function getFieldNames($type = BasePeer::TYPE_PHPNAME)
	{
		if (!array_key_exists($type, self::$fieldNames)) {
			throw new PropelException('Method getFieldNames() expects the parameter $type to be one of the class constants BasePeer::TYPE_PHPNAME, BasePeer::TYPE_STUDLYPHPNAME, BasePeer::TYPE_COLNAME, BasePeer::TYPE_FIELDNAME, BasePeer::TYPE_NUM. ' . $type . ' was given.');
		}
		return self::$fieldNames[$type];
	}

	/**
	 * Convenience method which changes table.column to alias.column.
	 *
	 * Using this method you can maintain SQL abstraction while using column aliases.
	 * <code>
	 *		$c->addAlias("alias1", TablePeer::TABLE_NAME);
	 *		$c->addJoin(TablePeer::alias("alias1", TablePeer::PRIMARY_KEY_COLUMN), TablePeer::PRIMARY_KEY_COLUMN);
	 * </code>
	 * @param      string $alias The alias for the current table.
	 * @param      string $column The column name for current table. (i.e. PolicySearchPeer::COLUMN_NAME).
	 * @return     string
	 */
	public static function alias($alias, $column)
	{
		return str_replace(PolicySearchPeer::TABLE_NAME.'.', $alias.'.', $column);
	}

	/**
	 * Add all the columns needed to create a new object.
	 *
	 * Note: any columns that were marked with lazyLoad="true" in the
	 * XML schema will not be added to the select list and only loaded
	 * on demand.
	 *
	 * @param      criteria object containing the columns to add.
	 * @throws     PropelException Any exceptions caught during processing will be
	 *		 rethrown wrapped into a PropelException.
	 */
	public static function addSelectColumns(Criteria $criteria)
	{
		$criteria->addSelectColumn(PolicySearchPeer::POLICYID);
		$criteria->addSelectColumn(PolicySearchPeer::MASTERPOLICYNUMBER);
		$criteria->addSelectColumn(PolicySearchPeer::INSUREDNAME);
		$criteria->addSelectColumn(PolicySearchPeer::PRODUCTLINE);
		$criteria->addSelectColumn(PolicySearchPeer::PRODUCTLINESUBTYPE);
		$criteria->addSelectColumn(PolicySearchPeer::UNDERWRITERNAME);
		$criteria->addSelectColumn(PolicySearchPeer::REGIONNAME);
		$criteria->addSelectColumn(PolicySearchPeer::BRANCHNAME);
		$criteria->addSelectColumn(PolicySearchPeer::REINSUREDCOMPANY);
		$criteria->addSelectColumn(PolicySearchPeer::REMARKS);
		$criteria->addSelectColumn(PolicySearchPeer::DIRECTASSUMED);
		$criteria->addSelectColumn(PolicySearchPeer::ADMITTEDNOTADMITTED);
		$criteria->addSelectColumn(PolicySearchPeer::ADMITTEDDETAILS);
		$criteria->addSelectColumn(PolicySearchPeer::COMPANY);
		$criteria->addSelectColumn(PolicySearchPeer::COMPANYNUMBER);
		$criteria->addSelectColumn(PolicySearchPeer::PREFIX);
		$criteria->addSelectColumn(PolicySearchPeer::SUFFIX);
		$criteria->addSelectColumn(PolicySearchPeer::NEWRENEWAL);
		$criteria->addSelectColumn(PolicySearchPeer::POLICYEFFECTIVEDATE);
		$criteria->addSelectColumn(PolicySearchPeer::POLICYEXPIRYDATE);
		$criteria->addSelectColumn(PolicySearchPeer::POLICYCURRENCY);
		$criteria->addSelectColumn(PolicySearchPeer::POLICYCURRENCYSYMBOL);
		$criteria->addSelectColumn(PolicySearchPeer::INCEPTIONGROSSPREMIUM);
		$criteria->addSelectColumn(PolicySearchPeer::COMMISSSIONPERCENTAGE);
		$criteria->addSelectColumn(PolicySearchPeer::COMMISSSIONDOLLER);
		$criteria->addSelectColumn(PolicySearchPeer::NETPREMIUM);
		$criteria->addSelectColumn(PolicySearchPeer::CREATEDBY);
		$criteria->addSelectColumn(PolicySearchPeer::CREATEDDATE);
		$criteria->addSelectColumn(PolicySearchPeer::MODIFIEDBY);
		$criteria->addSelectColumn(PolicySearchPeer::MODIFIEDDATE);
		$criteria->addSelectColumn(PolicySearchPeer::ID);
	}

	/**
	 * Returns the number of rows matching criteria.
	 *
	 * @param      Criteria $criteria
	 * @param      boolean $distinct Whether to select only distinct columns; deprecated: use Criteria->setDistinct() instead.
	 * @param      PropelPDO $con
	 * @return     int Number of matching rows.
	 */
	public static function doCount(Criteria $criteria, $distinct = false, PropelPDO $con = null)
	{
		// we may modify criteria, so copy it first
		$criteria = clone $criteria;

		// We need to set the primary table name, since in the case that there are no WHERE columns
		// it will be impossible for the BasePeer::createSelectSql() method to determine which
		// tables go into the FROM clause.
		$criteria->setPrimaryTableName(PolicySearchPeer::TABLE_NAME);

		if ($distinct && !in_array(Criteria::DISTINCT, $criteria->getSelectModifiers())) {
			$criteria->setDistinct();
		}

		if (!$criteria->hasSelectClause()) {
			PolicySearchPeer::addSelectColumns($criteria);
		}

		$criteria->clearOrderByColumns(); // ORDER BY won't ever affect the count
		$criteria->setDbName(self::DATABASE_NAME); // Set the correct dbName

		if ($con === null) {
			$con = Propel::getConnection(PolicySearchPeer::DATABASE_NAME, Propel::CONNECTION_READ);
		}
		// symfony_behaviors behavior
		foreach (sfMixer::getCallables(self::getMixerPreSelectHook(__FUNCTION__)) as $sf_hook)
		{
		  call_user_func($sf_hook, 'BasePolicySearchPeer', $criteria, $con);
		}

		// BasePeer returns a PDOStatement
		$stmt = BasePeer::doCount($criteria, $con);

		if ($row = $stmt->fetch(PDO::FETCH_NUM)) {
			$count = (int) $row[0];
		} else {
			$count = 0; // no rows returned; we infer that means 0 matches.
		}
		$stmt->closeCursor();
		return $count;
	}
	/**
	 * Method to select one object from the DB.
	 *
	 * @param      Criteria $criteria object used to create the SELECT statement.
	 * @param      PropelPDO $con
	 * @return     PolicySearch
	 * @throws     PropelException Any exceptions caught during processing will be
	 *		 rethrown wrapped into a PropelException.
	 */
	public static function doSelectOne(Criteria $criteria, PropelPDO $con = null)
	{
		$critcopy = clone $criteria;
		$critcopy->setLimit(1);
		$objects = PolicySearchPeer::doSelect($critcopy, $con);
		if ($objects) {
			return $objects[0];
		}
		return null;
	}
	/**
	 * Method to do selects.
	 *
	 * @param      Criteria $criteria The Criteria object used to build the SELECT statement.
	 * @param      PropelPDO $con
	 * @return     array Array of selected Objects
	 * @throws     PropelException Any exceptions caught during processing will be
	 *		 rethrown wrapped into a PropelException.
	 */
	public static function doSelect(Criteria $criteria, PropelPDO $con = null)
	{
		return PolicySearchPeer::populateObjects(PolicySearchPeer::doSelectStmt($criteria, $con));
	}
	/**
	 * Prepares the Criteria object and uses the parent doSelect() method to execute a PDOStatement.
	 *
	 * Use this method directly if you want to work with an executed statement durirectly (for example
	 * to perform your own object hydration).
	 *
	 * @param      Criteria $criteria The Criteria object used to build the SELECT statement.
	 * @param      PropelPDO $con The connection to use
	 * @throws     PropelException Any exceptions caught during processing will be
	 *		 rethrown wrapped into a PropelException.
	 * @return     PDOStatement The executed PDOStatement object.
	 * @see        BasePeer::doSelect()
	 */
	public static function doSelectStmt(Criteria $criteria, PropelPDO $con = null)
	{
		if ($con === null) {
			$con = Propel::getConnection(PolicySearchPeer::DATABASE_NAME, Propel::CONNECTION_READ);
		}

		if (!$criteria->hasSelectClause()) {
			$criteria = clone $criteria;
			PolicySearchPeer::addSelectColumns($criteria);
		}

		// Set the correct dbName
		$criteria->setDbName(self::DATABASE_NAME);
		// symfony_behaviors behavior
		foreach (sfMixer::getCallables(self::getMixerPreSelectHook(__FUNCTION__)) as $sf_hook)
		{
		  call_user_func($sf_hook, 'BasePolicySearchPeer', $criteria, $con);
		}


		// BasePeer returns a PDOStatement
		return BasePeer::doSelect($criteria, $con);
	}
	/**
	 * Adds an object to the instance pool.
	 *
	 * Propel keeps cached copies of objects in an instance pool when they are retrieved
	 * from the database.  In some cases -- especially when you override doSelect*()
	 * methods in your stub classes -- you may need to explicitly add objects
	 * to the cache in order to ensure that the same objects are always returned by doSelect*()
	 * and retrieveByPK*() calls.
	 *
	 * @param      PolicySearch $value A PolicySearch object.
	 * @param      string $key (optional) key to use for instance map (for performance boost if key was already calculated externally).
	 */
	public static function addInstanceToPool(PolicySearch $obj, $key = null)
	{
		if (Propel::isInstancePoolingEnabled()) {
			if ($key === null) {
				$key = (string) $obj->getId();
			} // if key === null
			self::$instances[$key] = $obj;
		}
	}

	/**
	 * Removes an object from the instance pool.
	 *
	 * Propel keeps cached copies of objects in an instance pool when they are retrieved
	 * from the database.  In some cases -- especially when you override doDelete
	 * methods in your stub classes -- you may need to explicitly remove objects
	 * from the cache in order to prevent returning objects that no longer exist.
	 *
	 * @param      mixed $value A PolicySearch object or a primary key value.
	 */
	public static function removeInstanceFromPool($value)
	{
		if (Propel::isInstancePoolingEnabled() && $value !== null) {
			if (is_object($value) && $value instanceof PolicySearch) {
				$key = (string) $value->getId();
			} elseif (is_scalar($value)) {
				// assume we've been passed a primary key
				$key = (string) $value;
			} else {
				$e = new PropelException("Invalid value passed to removeInstanceFromPool().  Expected primary key or PolicySearch object; got " . (is_object($value) ? get_class($value) . ' object.' : var_export($value,true)));
				throw $e;
			}

			unset(self::$instances[$key]);
		}
	} // removeInstanceFromPool()

	/**
	 * Retrieves a string version of the primary key from the DB resultset row that can be used to uniquely identify a row in this table.
	 *
	 * For tables with a single-column primary key, that simple pkey value will be returned.  For tables with
	 * a multi-column primary key, a serialize()d version of the primary key will be returned.
	 *
	 * @param      string $key The key (@see getPrimaryKeyHash()) for this instance.
	 * @return     PolicySearch Found object or NULL if 1) no instance exists for specified key or 2) instance pooling has been disabled.
	 * @see        getPrimaryKeyHash()
	 */
	public static function getInstanceFromPool($key)
	{
		if (Propel::isInstancePoolingEnabled()) {
			if (isset(self::$instances[$key])) {
				return self::$instances[$key];
			}
		}
		return null; // just to be explicit
	}
	
	/**
	 * Clear the instance pool.
	 *
	 * @return     void
	 */
	public static function clearInstancePool()
	{
		self::$instances = array();
	}
	
	/**
	 * Method to invalidate the instance pool of all tables related to Policy_Search
	 * by a foreign key with ON DELETE CASCADE
	 */
	public static function clearRelatedInstancePool()
	{
	}

	/**
	 * Retrieves a string version of the primary key from the DB resultset row that can be used to uniquely identify a row in this table.
	 *
	 * For tables with a single-column primary key, that simple pkey value will be returned.  For tables with
	 * a multi-column primary key, a serialize()d version of the primary key will be returned.
	 *
	 * @param      array $row PropelPDO resultset row.
	 * @param      int $startcol The 0-based offset for reading from the resultset row.
	 * @return     string A string version of PK or NULL if the components of primary key in result array are all null.
	 */
	public static function getPrimaryKeyHashFromRow($row, $startcol = 0)
	{
		// If the PK cannot be derived from the row, return NULL.
		if ($row[$startcol + 30] === null) {
			return null;
		}
		return (string) $row[$startcol + 30];
	}

	/**
	 * The returned array will contain objects of the default type or
	 * objects that inherit from the default.
	 *
	 * @throws     PropelException Any exceptions caught during processing will be
	 *		 rethrown wrapped into a PropelException.
	 */
	public static function populateObjects(PDOStatement $stmt)
	{
		$results = array();
	
		// set the class once to avoid overhead in the loop
		$cls = PolicySearchPeer::getOMClass(false);
		// populate the object(s)
		while ($row = $stmt->fetch(PDO::FETCH_NUM)) {
			$key = PolicySearchPeer::getPrimaryKeyHashFromRow($row, 0);
			if (null !== ($obj = PolicySearchPeer::getInstanceFromPool($key))) {
				// We no longer rehydrate the object, since this can cause data loss.
				// See http://propel.phpdb.org/trac/ticket/509
				// $obj->hydrate($row, 0, true); // rehydrate
				$results[] = $obj;
			} else {
				$obj = new $cls();
				$obj->hydrate($row);
				$results[] = $obj;
				PolicySearchPeer::addInstanceToPool($obj, $key);
			} // if key exists
		}
		$stmt->closeCursor();
		return $results;
	}
	/**
	 * Returns the TableMap related to this peer.
	 * This method is not needed for general use but a specific application could have a need.
	 * @return     TableMap
	 * @throws     PropelException Any exceptions caught during processing will be
	 *		 rethrown wrapped into a PropelException.
	 */
	public static function getTableMap()
	{
		return Propel::getDatabaseMap(self::DATABASE_NAME)->getTable(self::TABLE_NAME);
	}

	/**
	 * Add a TableMap instance to the database for this peer class.
	 */
	public static function buildTableMap()
	{
	  $dbMap = Propel::getDatabaseMap(BasePolicySearchPeer::DATABASE_NAME);
	  if (!$dbMap->hasTable(BasePolicySearchPeer::TABLE_NAME))
	  {
	    $dbMap->addTableObject(new PolicySearchTableMap());
	  }
	}

	/**
	 * The class that the Peer will make instances of.
	 *
	 * If $withPrefix is true, the returned path
	 * uses a dot-path notation which is tranalted into a path
	 * relative to a location on the PHP include_path.
	 * (e.g. path.to.MyClass -> 'path/to/MyClass.php')
	 *
	 * @param      boolean  Whether or not to return the path wit hthe class name 
	 * @return     string path.to.ClassName
	 */
	public static function getOMClass($withPrefix = true)
	{
		return $withPrefix ? PolicySearchPeer::CLASS_DEFAULT : PolicySearchPeer::OM_CLASS;
	}

	/**
	 * Method perform an INSERT on the database, given a PolicySearch or Criteria object.
	 *
	 * @param      mixed $values Criteria or PolicySearch object containing data that is used to create the INSERT statement.
	 * @param      PropelPDO $con the PropelPDO connection to use
	 * @return     mixed The new primary key.
	 * @throws     PropelException Any exceptions caught during processing will be
	 *		 rethrown wrapped into a PropelException.
	 */
	public static function doInsert($values, PropelPDO $con = null)
	{
    // symfony_behaviors behavior
    foreach (sfMixer::getCallables('BasePolicySearchPeer:doInsert:pre') as $sf_hook)
    {
      if (false !== $sf_hook_retval = call_user_func($sf_hook, 'BasePolicySearchPeer', $values, $con))
      {
        return $sf_hook_retval;
      }
    }

		if ($con === null) {
			$con = Propel::getConnection(PolicySearchPeer::DATABASE_NAME, Propel::CONNECTION_WRITE);
		}

		if ($values instanceof Criteria) {
			$criteria = clone $values; // rename for clarity
		} else {
			$criteria = $values->buildCriteria(); // build Criteria from PolicySearch object
		}

		if ($criteria->containsKey(PolicySearchPeer::ID) && $criteria->keyContainsValue(PolicySearchPeer::ID) ) {
			throw new PropelException('Cannot insert a value for auto-increment primary key ('.PolicySearchPeer::ID.')');
		}


		// Set the correct dbName
		$criteria->setDbName(self::DATABASE_NAME);

		try {
			// use transaction because $criteria could contain info
			// for more than one table (I guess, conceivably)
			$con->beginTransaction();
			$pk = BasePeer::doInsert($criteria, $con);
			$con->commit();
		} catch(PropelException $e) {
			$con->rollBack();
			throw $e;
		}

    // symfony_behaviors behavior
    foreach (sfMixer::getCallables('BasePolicySearchPeer:doInsert:post') as $sf_hook)
    {
      call_user_func($sf_hook, 'BasePolicySearchPeer', $values, $con, $pk);
    }

		return $pk;
	}

	/**
	 * Method perform an UPDATE on the database, given a PolicySearch or Criteria object.
	 *
	 * @param      mixed $values Criteria or PolicySearch object containing data that is used to create the UPDATE statement.
	 * @param      PropelPDO $con The connection to use (specify PropelPDO connection object to exert more control over transactions).
	 * @return     int The number of affected rows (if supported by underlying database driver).
	 * @throws     PropelException Any exceptions caught during processing will be
	 *		 rethrown wrapped into a PropelException.
	 */
	public static function doUpdate($values, PropelPDO $con = null)
	{
    // symfony_behaviors behavior
    foreach (sfMixer::getCallables('BasePolicySearchPeer:doUpdate:pre') as $sf_hook)
    {
      if (false !== $sf_hook_retval = call_user_func($sf_hook, 'BasePolicySearchPeer', $values, $con))
      {
        return $sf_hook_retval;
      }
    }

		if ($con === null) {
			$con = Propel::getConnection(PolicySearchPeer::DATABASE_NAME, Propel::CONNECTION_WRITE);
		}

		$selectCriteria = new Criteria(self::DATABASE_NAME);

		if ($values instanceof Criteria) {
			$criteria = clone $values; // rename for clarity

			$comparison = $criteria->getComparison(PolicySearchPeer::ID);
			$selectCriteria->add(PolicySearchPeer::ID, $criteria->remove(PolicySearchPeer::ID), $comparison);

		} else { // $values is PolicySearch object
			$criteria = $values->buildCriteria(); // gets full criteria
			$selectCriteria = $values->buildPkeyCriteria(); // gets criteria w/ primary key(s)
		}

		// set the correct dbName
		$criteria->setDbName(self::DATABASE_NAME);

		$ret = BasePeer::doUpdate($selectCriteria, $criteria, $con);

    // symfony_behaviors behavior
    foreach (sfMixer::getCallables('BasePolicySearchPeer:doUpdate:post') as $sf_hook)
    {
      call_user_func($sf_hook, 'BasePolicySearchPeer', $values, $con, $ret);
    }

    return $ret;
	}

	/**
	 * Method to DELETE all rows from the Policy_Search table.
	 *
	 * @return     int The number of affected rows (if supported by underlying database driver).
	 */
	public static function doDeleteAll($con = null)
	{
		if ($con === null) {
			$con = Propel::getConnection(PolicySearchPeer::DATABASE_NAME, Propel::CONNECTION_WRITE);
		}
		$affectedRows = 0; // initialize var to track total num of affected rows
		try {
			// use transaction because $criteria could contain info
			// for more than one table or we could emulating ON DELETE CASCADE, etc.
			$con->beginTransaction();
			$affectedRows += BasePeer::doDeleteAll(PolicySearchPeer::TABLE_NAME, $con);
			// Because this db requires some delete cascade/set null emulation, we have to
			// clear the cached instance *after* the emulation has happened (since
			// instances get re-added by the select statement contained therein).
			PolicySearchPeer::clearInstancePool();
			PolicySearchPeer::clearRelatedInstancePool();
			$con->commit();
			return $affectedRows;
		} catch (PropelException $e) {
			$con->rollBack();
			throw $e;
		}
	}

	/**
	 * Method perform a DELETE on the database, given a PolicySearch or Criteria object OR a primary key value.
	 *
	 * @param      mixed $values Criteria or PolicySearch object or primary key or array of primary keys
	 *              which is used to create the DELETE statement
	 * @param      PropelPDO $con the connection to use
	 * @return     int 	The number of affected rows (if supported by underlying database driver).  This includes CASCADE-related rows
	 *				if supported by native driver or if emulated using Propel.
	 * @throws     PropelException Any exceptions caught during processing will be
	 *		 rethrown wrapped into a PropelException.
	 */
	 public static function doDelete($values, PropelPDO $con = null)
	 {
		if ($con === null) {
			$con = Propel::getConnection(PolicySearchPeer::DATABASE_NAME, Propel::CONNECTION_WRITE);
		}

		if ($values instanceof Criteria) {
			// invalidate the cache for all objects of this type, since we have no
			// way of knowing (without running a query) what objects should be invalidated
			// from the cache based on this Criteria.
			PolicySearchPeer::clearInstancePool();
			// rename for clarity
			$criteria = clone $values;
		} elseif ($values instanceof PolicySearch) { // it's a model object
			// invalidate the cache for this single object
			PolicySearchPeer::removeInstanceFromPool($values);
			// create criteria based on pk values
			$criteria = $values->buildPkeyCriteria();
		} else { // it's a primary key, or an array of pks
			$criteria = new Criteria(self::DATABASE_NAME);
			$criteria->add(PolicySearchPeer::ID, (array) $values, Criteria::IN);
			// invalidate the cache for this object(s)
			foreach ((array) $values as $singleval) {
				PolicySearchPeer::removeInstanceFromPool($singleval);
			}
		}

		// Set the correct dbName
		$criteria->setDbName(self::DATABASE_NAME);

		$affectedRows = 0; // initialize var to track total num of affected rows

		try {
			// use transaction because $criteria could contain info
			// for more than one table or we could emulating ON DELETE CASCADE, etc.
			$con->beginTransaction();
			
			$affectedRows += BasePeer::doDelete($criteria, $con);
			PolicySearchPeer::clearRelatedInstancePool();
			$con->commit();
			return $affectedRows;
		} catch (PropelException $e) {
			$con->rollBack();
			throw $e;
		}
	}

	/**
	 * Validates all modified columns of given PolicySearch object.
	 * If parameter $columns is either a single column name or an array of column names
	 * than only those columns are validated.
	 *
	 * NOTICE: This does not apply to primary or foreign keys for now.
	 *
	 * @param      PolicySearch $obj The object to validate.
	 * @param      mixed $cols Column name or array of column names.
	 *
	 * @return     mixed TRUE if all columns are valid or the error message of the first invalid column.
	 */
	public static function doValidate(PolicySearch $obj, $cols = null)
	{
		$columns = array();

		if ($cols) {
			$dbMap = Propel::getDatabaseMap(PolicySearchPeer::DATABASE_NAME);
			$tableMap = $dbMap->getTable(PolicySearchPeer::TABLE_NAME);

			if (! is_array($cols)) {
				$cols = array($cols);
			}

			foreach ($cols as $colName) {
				if ($tableMap->containsColumn($colName)) {
					$get = 'get' . $tableMap->getColumn($colName)->getPhpName();
					$columns[$colName] = $obj->$get();
				}
			}
		} else {

		}

		return BasePeer::doValidate(PolicySearchPeer::DATABASE_NAME, PolicySearchPeer::TABLE_NAME, $columns);
	}

	/**
	 * Retrieve a single object by pkey.
	 *
	 * @param      int $pk the primary key.
	 * @param      PropelPDO $con the connection to use
	 * @return     PolicySearch
	 */
	public static function retrieveByPK($pk, PropelPDO $con = null)
	{

		if (null !== ($obj = PolicySearchPeer::getInstanceFromPool((string) $pk))) {
			return $obj;
		}

		if ($con === null) {
			$con = Propel::getConnection(PolicySearchPeer::DATABASE_NAME, Propel::CONNECTION_READ);
		}

		$criteria = new Criteria(PolicySearchPeer::DATABASE_NAME);
		$criteria->add(PolicySearchPeer::ID, $pk);

		$v = PolicySearchPeer::doSelect($criteria, $con);

		return !empty($v) > 0 ? $v[0] : null;
	}

	/**
	 * Retrieve multiple objects by pkey.
	 *
	 * @param      array $pks List of primary keys
	 * @param      PropelPDO $con the connection to use
	 * @throws     PropelException Any exceptions caught during processing will be
	 *		 rethrown wrapped into a PropelException.
	 */
	public static function retrieveByPKs($pks, PropelPDO $con = null)
	{
		if ($con === null) {
			$con = Propel::getConnection(PolicySearchPeer::DATABASE_NAME, Propel::CONNECTION_READ);
		}

		$objs = null;
		if (empty($pks)) {
			$objs = array();
		} else {
			$criteria = new Criteria(PolicySearchPeer::DATABASE_NAME);
			$criteria->add(PolicySearchPeer::ID, $pks, Criteria::IN);
			$objs = PolicySearchPeer::doSelect($criteria, $con);
		}
		return $objs;
	}

	// symfony behavior
	
	/**
	 * Returns an array of arrays that contain columns in each unique index.
	 *
	 * @return array
	 */
	static public function getUniqueColumnNames()
	{
	  return array();
	}

	// symfony_behaviors behavior
	
	/**
	 * Returns the name of the hook to call from inside the supplied method.
	 *
	 * @param string $method The calling method
	 *
	 * @return string A hook name for {@link sfMixer}
	 *
	 * @throws LogicException If the method name is not recognized
	 */
	static private function getMixerPreSelectHook($method)
	{
	  if (preg_match('/^do(Select|Count)(Join(All(Except)?)?|Stmt)?/', $method, $match))
	  {
	    return sprintf('BasePolicySearchPeer:%s:%1$s', 'Count' == $match[1] ? 'doCount' : $match[0]);
	  }
	
	  throw new LogicException(sprintf('Unrecognized function "%s"', $method));
	}

} // BasePolicySearchPeer

// This is the static code needed to register the TableMap for this table with the main Propel class.
//
BasePolicySearchPeer::buildTableMap();

