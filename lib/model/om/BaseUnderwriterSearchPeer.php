<?php

/**
 * Base static class for performing query and update operations on the 'Underwriter_Search' table.
 *
 * 
 *
 * This class was autogenerated by Propel 1.4.2 on:
 *
 * Tue Dec  9 13:04:56 2014
 *
 * @package    lib.model.om
 */
abstract class BaseUnderwriterSearchPeer {

	/** the default database name for this class */
	const DATABASE_NAME = 'propel';

	/** the table name for this class */
	const TABLE_NAME = 'Underwriter_Search';

	/** the related Propel class for this table */
	const OM_CLASS = 'UnderwriterSearch';

	/** A class that can be returned by this peer. */
	const CLASS_DEFAULT = 'lib.model.UnderwriterSearch';

	/** the related TableMap class for this table */
	const TM_CLASS = 'UnderwriterSearchTableMap';
	
	/** The total number of columns. */
	const NUM_COLUMNS = 9;

	/** The number of lazy-loaded columns. */
	const NUM_LAZY_LOAD_COLUMNS = 0;

	/** the column name for the UNDERWRITERID field */
	const UNDERWRITERID = '0';

	/** the column name for the UNDERWRITERNAME field */
	const UNDERWRITERNAME = 'Underwriter_Search.UNDERWRITERNAME';

	/** the column name for the BRANCHOFFICE field */
	const BRANCHOFFICE = 'Underwriter_Search.BRANCHOFFICE';

	/** the column name for the PRODUCTLINE field */
	const PRODUCTLINE = 'Underwriter_Search.PRODUCTLINE';

	/** the column name for the CREATEDBY field */
	const CREATEDBY = 'Underwriter_Search.CREATEDBY';

	/** the column name for the CREATEDON field */
	const CREATEDON = 'Underwriter_Search.CREATEDON';

	/** the column name for the MODIFIEDBY field */
	const MODIFIEDBY = 'Underwriter_Search.MODIFIEDBY';

	/** the column name for the MODIFIEDON field */
	const MODIFIEDON = 'Underwriter_Search.MODIFIEDON';

	/** the column name for the ID field */
	const ID = 'Underwriter_Search.UNDERWRITERID';

	/**
	 * An identiy map to hold any loaded instances of UnderwriterSearch objects.
	 * This must be public so that other peer classes can access this when hydrating from JOIN
	 * queries.
	 * @var        array UnderwriterSearch[]
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
		BasePeer::TYPE_PHPNAME => array ('Underwriterid', 'Underwritername', 'Branchoffice', 'Productline', 'Createdby', 'Createdon', 'Modifiedby', 'Modifiedon', 'Id', ),
		BasePeer::TYPE_STUDLYPHPNAME => array ('underwriterid', 'underwritername', 'branchoffice', 'productline', 'createdby', 'createdon', 'modifiedby', 'modifiedon', 'id', ),
		BasePeer::TYPE_COLNAME => array (self::UNDERWRITERID, self::UNDERWRITERNAME, self::BRANCHOFFICE, self::PRODUCTLINE, self::CREATEDBY, self::CREATEDON, self::MODIFIEDBY, self::MODIFIEDON, self::ID, ),
		BasePeer::TYPE_FIELDNAME => array ('UnderwriterId', 'UnderwriterName', 'BranchOffice', 'ProductLine', 'CreatedBy', 'CreatedOn', 'ModifiedBy', 'ModifiedOn', 'id', ),
		BasePeer::TYPE_NUM => array (0, 1, 2, 3, 4, 5, 6, 7, 8, )
	);

	/**
	 * holds an array of keys for quick access to the fieldnames array
	 *
	 * first dimension keys are the type constants
	 * e.g. self::$fieldNames[BasePeer::TYPE_PHPNAME]['Id'] = 0
	 */
	private static $fieldKeys = array (
		BasePeer::TYPE_PHPNAME => array ('Underwriterid' => 0, 'Underwritername' => 1, 'Branchoffice' => 2, 'Productline' => 3, 'Createdby' => 4, 'Createdon' => 5, 'Modifiedby' => 6, 'Modifiedon' => 7, 'Id' => 8, ),
		BasePeer::TYPE_STUDLYPHPNAME => array ('underwriterid' => 0, 'underwritername' => 1, 'branchoffice' => 2, 'productline' => 3, 'createdby' => 4, 'createdon' => 5, 'modifiedby' => 6, 'modifiedon' => 7, 'id' => 8, ),
		BasePeer::TYPE_COLNAME => array (self::UNDERWRITERID => 0, self::UNDERWRITERNAME => 1, self::BRANCHOFFICE => 2, self::PRODUCTLINE => 3, self::CREATEDBY => 4, self::CREATEDON => 5, self::MODIFIEDBY => 6, self::MODIFIEDON => 7, self::ID => 8, ),
		BasePeer::TYPE_FIELDNAME => array ('UnderwriterId' => 0, 'UnderwriterName' => 1, 'BranchOffice' => 2, 'ProductLine' => 3, 'CreatedBy' => 4, 'CreatedOn' => 5, 'ModifiedBy' => 6, 'ModifiedOn' => 7, 'id' => 8, ),
		BasePeer::TYPE_NUM => array (0, 1, 2, 3, 4, 5, 6, 7, 8, )
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
	 * @param      string $column The column name for current table. (i.e. UnderwriterSearchPeer::COLUMN_NAME).
	 * @return     string
	 */
	public static function alias($alias, $column)
	{
		return str_replace(UnderwriterSearchPeer::TABLE_NAME.'.', $alias.'.', $column);
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
		$criteria->addSelectColumn(UnderwriterSearchPeer::UNDERWRITERID);
		$criteria->addSelectColumn(UnderwriterSearchPeer::UNDERWRITERNAME);
		$criteria->addSelectColumn(UnderwriterSearchPeer::BRANCHOFFICE);
		$criteria->addSelectColumn(UnderwriterSearchPeer::PRODUCTLINE);
		$criteria->addSelectColumn(UnderwriterSearchPeer::CREATEDBY);
		$criteria->addSelectColumn(UnderwriterSearchPeer::CREATEDON);
		$criteria->addSelectColumn(UnderwriterSearchPeer::MODIFIEDBY);
		$criteria->addSelectColumn(UnderwriterSearchPeer::MODIFIEDON);
		$criteria->addSelectColumn(UnderwriterSearchPeer::ID);
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
		$criteria->setPrimaryTableName(UnderwriterSearchPeer::TABLE_NAME);

		if ($distinct && !in_array(Criteria::DISTINCT, $criteria->getSelectModifiers())) {
			$criteria->setDistinct();
		}

		if (!$criteria->hasSelectClause()) {
			UnderwriterSearchPeer::addSelectColumns($criteria);
		}

		$criteria->clearOrderByColumns(); // ORDER BY won't ever affect the count
		$criteria->setDbName(self::DATABASE_NAME); // Set the correct dbName

		if ($con === null) {
			$con = Propel::getConnection(UnderwriterSearchPeer::DATABASE_NAME, Propel::CONNECTION_READ);
		}
		// symfony_behaviors behavior
		foreach (sfMixer::getCallables(self::getMixerPreSelectHook(__FUNCTION__)) as $sf_hook)
		{
		  call_user_func($sf_hook, 'BaseUnderwriterSearchPeer', $criteria, $con);
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
	 * @return     UnderwriterSearch
	 * @throws     PropelException Any exceptions caught during processing will be
	 *		 rethrown wrapped into a PropelException.
	 */
	public static function doSelectOne(Criteria $criteria, PropelPDO $con = null)
	{
		$critcopy = clone $criteria;
		$critcopy->setLimit(1);
		$objects = UnderwriterSearchPeer::doSelect($critcopy, $con);
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
		return UnderwriterSearchPeer::populateObjects(UnderwriterSearchPeer::doSelectStmt($criteria, $con));
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
			$con = Propel::getConnection(UnderwriterSearchPeer::DATABASE_NAME, Propel::CONNECTION_READ);
		}

		if (!$criteria->hasSelectClause()) {
			$criteria = clone $criteria;
			UnderwriterSearchPeer::addSelectColumns($criteria);
		}

		// Set the correct dbName
		$criteria->setDbName(self::DATABASE_NAME);
		// symfony_behaviors behavior
		foreach (sfMixer::getCallables(self::getMixerPreSelectHook(__FUNCTION__)) as $sf_hook)
		{
		  call_user_func($sf_hook, 'BaseUnderwriterSearchPeer', $criteria, $con);
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
	 * @param      UnderwriterSearch $value A UnderwriterSearch object.
	 * @param      string $key (optional) key to use for instance map (for performance boost if key was already calculated externally).
	 */
	public static function addInstanceToPool(UnderwriterSearch $obj, $key = null)
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
	 * @param      mixed $value A UnderwriterSearch object or a primary key value.
	 */
	public static function removeInstanceFromPool($value)
	{
		if (Propel::isInstancePoolingEnabled() && $value !== null) {
			if (is_object($value) && $value instanceof UnderwriterSearch) {
				$key = (string) $value->getId();
			} elseif (is_scalar($value)) {
				// assume we've been passed a primary key
				$key = (string) $value;
			} else {
				$e = new PropelException("Invalid value passed to removeInstanceFromPool().  Expected primary key or UnderwriterSearch object; got " . (is_object($value) ? get_class($value) . ' object.' : var_export($value,true)));
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
	 * @return     UnderwriterSearch Found object or NULL if 1) no instance exists for specified key or 2) instance pooling has been disabled.
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
	 * Method to invalidate the instance pool of all tables related to Underwriter_Search
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
		if ($row[$startcol + 8] === null) {
			return null;
		}
		return (string) $row[$startcol + 8];
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
		$cls = UnderwriterSearchPeer::getOMClass(false);
		// populate the object(s)
		while ($row = $stmt->fetch(PDO::FETCH_NUM)) {
			$key = UnderwriterSearchPeer::getPrimaryKeyHashFromRow($row, 0);
			if (null !== ($obj = UnderwriterSearchPeer::getInstanceFromPool($key))) {
				// We no longer rehydrate the object, since this can cause data loss.
				// See http://propel.phpdb.org/trac/ticket/509
				// $obj->hydrate($row, 0, true); // rehydrate
				$results[] = $obj;
			} else {
				$obj = new $cls();
				$obj->hydrate($row);
				$results[] = $obj;
				UnderwriterSearchPeer::addInstanceToPool($obj, $key);
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
	  $dbMap = Propel::getDatabaseMap(BaseUnderwriterSearchPeer::DATABASE_NAME);
	  if (!$dbMap->hasTable(BaseUnderwriterSearchPeer::TABLE_NAME))
	  {
	    $dbMap->addTableObject(new UnderwriterSearchTableMap());
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
		return $withPrefix ? UnderwriterSearchPeer::CLASS_DEFAULT : UnderwriterSearchPeer::OM_CLASS;
	}

	/**
	 * Method perform an INSERT on the database, given a UnderwriterSearch or Criteria object.
	 *
	 * @param      mixed $values Criteria or UnderwriterSearch object containing data that is used to create the INSERT statement.
	 * @param      PropelPDO $con the PropelPDO connection to use
	 * @return     mixed The new primary key.
	 * @throws     PropelException Any exceptions caught during processing will be
	 *		 rethrown wrapped into a PropelException.
	 */
	public static function doInsert($values, PropelPDO $con = null)
	{
    // symfony_behaviors behavior
    foreach (sfMixer::getCallables('BaseUnderwriterSearchPeer:doInsert:pre') as $sf_hook)
    {
      if (false !== $sf_hook_retval = call_user_func($sf_hook, 'BaseUnderwriterSearchPeer', $values, $con))
      {
        return $sf_hook_retval;
      }
    }

		if ($con === null) {
			$con = Propel::getConnection(UnderwriterSearchPeer::DATABASE_NAME, Propel::CONNECTION_WRITE);
		}

		if ($values instanceof Criteria) {
			$criteria = clone $values; // rename for clarity
		} else {
			$criteria = $values->buildCriteria(); // build Criteria from UnderwriterSearch object
		}

		if ($criteria->containsKey(UnderwriterSearchPeer::ID) && $criteria->keyContainsValue(UnderwriterSearchPeer::ID) ) {
			throw new PropelException('Cannot insert a value for auto-increment primary key ('.UnderwriterSearchPeer::ID.')');
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
    foreach (sfMixer::getCallables('BaseUnderwriterSearchPeer:doInsert:post') as $sf_hook)
    {
      call_user_func($sf_hook, 'BaseUnderwriterSearchPeer', $values, $con, $pk);
    }

		return $pk;
	}

	/**
	 * Method perform an UPDATE on the database, given a UnderwriterSearch or Criteria object.
	 *
	 * @param      mixed $values Criteria or UnderwriterSearch object containing data that is used to create the UPDATE statement.
	 * @param      PropelPDO $con The connection to use (specify PropelPDO connection object to exert more control over transactions).
	 * @return     int The number of affected rows (if supported by underlying database driver).
	 * @throws     PropelException Any exceptions caught during processing will be
	 *		 rethrown wrapped into a PropelException.
	 */
	public static function doUpdate($values, PropelPDO $con = null)
	{
    // symfony_behaviors behavior
    foreach (sfMixer::getCallables('BaseUnderwriterSearchPeer:doUpdate:pre') as $sf_hook)
    {
      if (false !== $sf_hook_retval = call_user_func($sf_hook, 'BaseUnderwriterSearchPeer', $values, $con))
      {
        return $sf_hook_retval;
      }
    }

		if ($con === null) {
			$con = Propel::getConnection(UnderwriterSearchPeer::DATABASE_NAME, Propel::CONNECTION_WRITE);
		}

		$selectCriteria = new Criteria(self::DATABASE_NAME);

		if ($values instanceof Criteria) {
			$criteria = clone $values; // rename for clarity

			$comparison = $criteria->getComparison(UnderwriterSearchPeer::ID);
			$selectCriteria->add(UnderwriterSearchPeer::ID, $criteria->remove(UnderwriterSearchPeer::ID), $comparison);

		} else { // $values is UnderwriterSearch object
			$criteria = $values->buildCriteria(); // gets full criteria
			$selectCriteria = $values->buildPkeyCriteria(); // gets criteria w/ primary key(s)
		}

		// set the correct dbName
		$criteria->setDbName(self::DATABASE_NAME);

		$ret = BasePeer::doUpdate($selectCriteria, $criteria, $con);

    // symfony_behaviors behavior
    foreach (sfMixer::getCallables('BaseUnderwriterSearchPeer:doUpdate:post') as $sf_hook)
    {
      call_user_func($sf_hook, 'BaseUnderwriterSearchPeer', $values, $con, $ret);
    }

    return $ret;
	}

	/**
	 * Method to DELETE all rows from the Underwriter_Search table.
	 *
	 * @return     int The number of affected rows (if supported by underlying database driver).
	 */
	public static function doDeleteAll($con = null)
	{
		if ($con === null) {
			$con = Propel::getConnection(UnderwriterSearchPeer::DATABASE_NAME, Propel::CONNECTION_WRITE);
		}
		$affectedRows = 0; // initialize var to track total num of affected rows
		try {
			// use transaction because $criteria could contain info
			// for more than one table or we could emulating ON DELETE CASCADE, etc.
			$con->beginTransaction();
			$affectedRows += BasePeer::doDeleteAll(UnderwriterSearchPeer::TABLE_NAME, $con);
			// Because this db requires some delete cascade/set null emulation, we have to
			// clear the cached instance *after* the emulation has happened (since
			// instances get re-added by the select statement contained therein).
			UnderwriterSearchPeer::clearInstancePool();
			UnderwriterSearchPeer::clearRelatedInstancePool();
			$con->commit();
			return $affectedRows;
		} catch (PropelException $e) {
			$con->rollBack();
			throw $e;
		}
	}

	/**
	 * Method perform a DELETE on the database, given a UnderwriterSearch or Criteria object OR a primary key value.
	 *
	 * @param      mixed $values Criteria or UnderwriterSearch object or primary key or array of primary keys
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
			$con = Propel::getConnection(UnderwriterSearchPeer::DATABASE_NAME, Propel::CONNECTION_WRITE);
		}

		if ($values instanceof Criteria) {
			// invalidate the cache for all objects of this type, since we have no
			// way of knowing (without running a query) what objects should be invalidated
			// from the cache based on this Criteria.
			UnderwriterSearchPeer::clearInstancePool();
			// rename for clarity
			$criteria = clone $values;
		} elseif ($values instanceof UnderwriterSearch) { // it's a model object
			// invalidate the cache for this single object
			UnderwriterSearchPeer::removeInstanceFromPool($values);
			// create criteria based on pk values
			$criteria = $values->buildPkeyCriteria();
		} else { // it's a primary key, or an array of pks
			$criteria = new Criteria(self::DATABASE_NAME);
			$criteria->add(UnderwriterSearchPeer::ID, (array) $values, Criteria::IN);
			// invalidate the cache for this object(s)
			foreach ((array) $values as $singleval) {
				UnderwriterSearchPeer::removeInstanceFromPool($singleval);
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
			UnderwriterSearchPeer::clearRelatedInstancePool();
			$con->commit();
			return $affectedRows;
		} catch (PropelException $e) {
			$con->rollBack();
			throw $e;
		}
	}

	/**
	 * Validates all modified columns of given UnderwriterSearch object.
	 * If parameter $columns is either a single column name or an array of column names
	 * than only those columns are validated.
	 *
	 * NOTICE: This does not apply to primary or foreign keys for now.
	 *
	 * @param      UnderwriterSearch $obj The object to validate.
	 * @param      mixed $cols Column name or array of column names.
	 *
	 * @return     mixed TRUE if all columns are valid or the error message of the first invalid column.
	 */
	public static function doValidate(UnderwriterSearch $obj, $cols = null)
	{
		$columns = array();

		if ($cols) {
			$dbMap = Propel::getDatabaseMap(UnderwriterSearchPeer::DATABASE_NAME);
			$tableMap = $dbMap->getTable(UnderwriterSearchPeer::TABLE_NAME);

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

		return BasePeer::doValidate(UnderwriterSearchPeer::DATABASE_NAME, UnderwriterSearchPeer::TABLE_NAME, $columns);
	}

	/**
	 * Retrieve a single object by pkey.
	 *
	 * @param      int $pk the primary key.
	 * @param      PropelPDO $con the connection to use
	 * @return     UnderwriterSearch
	 */
	public static function retrieveByPK($pk, PropelPDO $con = null)
	{

		if (null !== ($obj = UnderwriterSearchPeer::getInstanceFromPool((string) $pk))) {
			return $obj;
		}

		if ($con === null) {
			$con = Propel::getConnection(UnderwriterSearchPeer::DATABASE_NAME, Propel::CONNECTION_READ);
		}

		$criteria = new Criteria(UnderwriterSearchPeer::DATABASE_NAME);
		$criteria->add(UnderwriterSearchPeer::ID, $pk);

		$v = UnderwriterSearchPeer::doSelect($criteria, $con);

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
			$con = Propel::getConnection(UnderwriterSearchPeer::DATABASE_NAME, Propel::CONNECTION_READ);
		}

		$objs = null;
		if (empty($pks)) {
			$objs = array();
		} else {
			$criteria = new Criteria(UnderwriterSearchPeer::DATABASE_NAME);
			$criteria->add(UnderwriterSearchPeer::ID, $pks, Criteria::IN);
			$objs = UnderwriterSearchPeer::doSelect($criteria, $con);
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
	    return sprintf('BaseUnderwriterSearchPeer:%s:%1$s', 'Count' == $match[1] ? 'doCount' : $match[0]);
	  }
	
	  throw new LogicException(sprintf('Unrecognized function "%s"', $method));
	}

} // BaseUnderwriterSearchPeer

// This is the static code needed to register the TableMap for this table with the main Propel class.
//
BaseUnderwriterSearchPeer::buildTableMap();

