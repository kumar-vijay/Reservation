<?php

/**
 * Base class that represents a row from the 'State' table.
 *
 * 
 *
 * This class was autogenerated by Propel 1.4.2 on:
 *
 * Tue Apr  1 12:06:51 2014
 *
 * @package    lib.model.om
 */
abstract class BaseState extends BaseObject  implements Persistent {


	/**
	 * The Peer class.
	 * Instance provides a convenient way of calling static methods on a class
	 * that calling code may not be able to identify.
	 * @var        StatePeer
	 */
	protected static $peer;

	/**
	 * The value for the id field.
	 * @var        int
	 */
	protected $id;

	/**
	 * The value for the countryid field.
	 * Note: this column has a database default value of: 0
	 * @var        int
	 */
	protected $countryid;

	/**
	 * The value for the statename field.
	 * @var        string
	 */
	protected $statename;

	/**
	 * The value for the code field.
	 * @var        string
	 */
	protected $code;

	/**
	 * The value for the abreviation field.
	 * @var        string
	 */
	protected $abreviation;

	/**
	 * The value for the statecode field.
	 * @var        string
	 */
	protected $statecode;

	/**
	 * @var        Country
	 */
	protected $aCountry;

	/**
	 * @var        array City[] Collection to store aggregation of City objects.
	 */
	protected $collCitys;

	/**
	 * @var        Criteria The criteria used to select the current contents of collCitys.
	 */
	private $lastCityCriteria = null;

	/**
	 * Flag to prevent endless save loop, if this object is referenced
	 * by another object which falls in this transaction.
	 * @var        boolean
	 */
	protected $alreadyInSave = false;

	/**
	 * Flag to prevent endless validation loop, if this object is referenced
	 * by another object which falls in this transaction.
	 * @var        boolean
	 */
	protected $alreadyInValidation = false;

	// symfony behavior
	
	const PEER = 'StatePeer';

	/**
	 * Applies default values to this object.
	 * This method should be called from the object's constructor (or
	 * equivalent initialization method).
	 * @see        __construct()
	 */
	public function applyDefaultValues()
	{
		$this->countryid = 0;
	}

	/**
	 * Initializes internal state of BaseState object.
	 * @see        applyDefaults()
	 */
	public function __construct()
	{
		parent::__construct();
		$this->applyDefaultValues();
	}

	/**
	 * Get the [id] column value.
	 * 
	 * @return     int
	 */
	public function getId()
	{
		return $this->id;
	}

	/**
	 * Get the [countryid] column value.
	 * 
	 * @return     int
	 */
	public function getCountryid()
	{
		return $this->countryid;
	}

	/**
	 * Get the [statename] column value.
	 * 
	 * @return     string
	 */
	public function getStatename()
	{
		return $this->statename;
	}

	/**
	 * Get the [code] column value.
	 * 
	 * @return     string
	 */
	public function getCode()
	{
		return $this->code;
	}

	/**
	 * Get the [abreviation] column value.
	 * 
	 * @return     string
	 */
	public function getAbreviation()
	{
		return $this->abreviation;
	}

	/**
	 * Get the [statecode] column value.
	 * 
	 * @return     string
	 */
	public function getStatecode()
	{
		return $this->statecode;
	}

	/**
	 * Set the value of [id] column.
	 * 
	 * @param      int $v new value
	 * @return     State The current object (for fluent API support)
	 */
	public function setId($v)
	{
		if ($v !== null) {
			$v = (int) $v;
		}

		if ($this->id !== $v) {
			$this->id = $v;
			$this->modifiedColumns[] = StatePeer::ID;
		}

		return $this;
	} // setId()

	/**
	 * Set the value of [countryid] column.
	 * 
	 * @param      int $v new value
	 * @return     State The current object (for fluent API support)
	 */
	public function setCountryid($v)
	{
		if ($v !== null) {
			$v = (int) $v;
		}

		if ($this->countryid !== $v || $this->isNew()) {
			$this->countryid = $v;
			$this->modifiedColumns[] = StatePeer::COUNTRYID;
		}

		if ($this->aCountry !== null && $this->aCountry->getId() !== $v) {
			$this->aCountry = null;
		}

		return $this;
	} // setCountryid()

	/**
	 * Set the value of [statename] column.
	 * 
	 * @param      string $v new value
	 * @return     State The current object (for fluent API support)
	 */
	public function setStatename($v)
	{
		if ($v !== null) {
			$v = (string) $v;
		}

		if ($this->statename !== $v) {
			$this->statename = $v;
			$this->modifiedColumns[] = StatePeer::STATENAME;
		}

		return $this;
	} // setStatename()

	/**
	 * Set the value of [code] column.
	 * 
	 * @param      string $v new value
	 * @return     State The current object (for fluent API support)
	 */
	public function setCode($v)
	{
		if ($v !== null) {
			$v = (string) $v;
		}

		if ($this->code !== $v) {
			$this->code = $v;
			$this->modifiedColumns[] = StatePeer::CODE;
		}

		return $this;
	} // setCode()

	/**
	 * Set the value of [abreviation] column.
	 * 
	 * @param      string $v new value
	 * @return     State The current object (for fluent API support)
	 */
	public function setAbreviation($v)
	{
		if ($v !== null) {
			$v = (string) $v;
		}

		if ($this->abreviation !== $v) {
			$this->abreviation = $v;
			$this->modifiedColumns[] = StatePeer::ABREVIATION;
		}

		return $this;
	} // setAbreviation()

	/**
	 * Set the value of [statecode] column.
	 * 
	 * @param      string $v new value
	 * @return     State The current object (for fluent API support)
	 */
	public function setStatecode($v)
	{
		if ($v !== null) {
			$v = (string) $v;
		}

		if ($this->statecode !== $v) {
			$this->statecode = $v;
			$this->modifiedColumns[] = StatePeer::STATECODE;
		}

		return $this;
	} // setStatecode()

	/**
	 * Indicates whether the columns in this object are only set to default values.
	 *
	 * This method can be used in conjunction with isModified() to indicate whether an object is both
	 * modified _and_ has some values set which are non-default.
	 *
	 * @return     boolean Whether the columns in this object are only been set with default values.
	 */
	public function hasOnlyDefaultValues()
	{
			if ($this->countryid !== 0) {
				return false;
			}

		// otherwise, everything was equal, so return TRUE
		return true;
	} // hasOnlyDefaultValues()

	/**
	 * Hydrates (populates) the object variables with values from the database resultset.
	 *
	 * An offset (0-based "start column") is specified so that objects can be hydrated
	 * with a subset of the columns in the resultset rows.  This is needed, for example,
	 * for results of JOIN queries where the resultset row includes columns from two or
	 * more tables.
	 *
	 * @param      array $row The row returned by PDOStatement->fetch(PDO::FETCH_NUM)
	 * @param      int $startcol 0-based offset column which indicates which restultset column to start with.
	 * @param      boolean $rehydrate Whether this object is being re-hydrated from the database.
	 * @return     int next starting column
	 * @throws     PropelException  - Any caught Exception will be rewrapped as a PropelException.
	 */
	public function hydrate($row, $startcol = 0, $rehydrate = false)
	{
		try {

			$this->id = ($row[$startcol + 0] !== null) ? (int) $row[$startcol + 0] : null;
			$this->countryid = ($row[$startcol + 1] !== null) ? (int) $row[$startcol + 1] : null;
			$this->statename = ($row[$startcol + 2] !== null) ? (string) $row[$startcol + 2] : null;
			$this->code = ($row[$startcol + 3] !== null) ? (string) $row[$startcol + 3] : null;
			$this->abreviation = ($row[$startcol + 4] !== null) ? (string) $row[$startcol + 4] : null;
			$this->statecode = ($row[$startcol + 5] !== null) ? (string) $row[$startcol + 5] : null;
			$this->resetModified();

			$this->setNew(false);

			if ($rehydrate) {
				$this->ensureConsistency();
			}

			// FIXME - using NUM_COLUMNS may be clearer.
			return $startcol + 6; // 6 = StatePeer::NUM_COLUMNS - StatePeer::NUM_LAZY_LOAD_COLUMNS).

		} catch (Exception $e) {
			throw new PropelException("Error populating State object", $e);
		}
	}

	/**
	 * Checks and repairs the internal consistency of the object.
	 *
	 * This method is executed after an already-instantiated object is re-hydrated
	 * from the database.  It exists to check any foreign keys to make sure that
	 * the objects related to the current object are correct based on foreign key.
	 *
	 * You can override this method in the stub class, but you should always invoke
	 * the base method from the overridden method (i.e. parent::ensureConsistency()),
	 * in case your model changes.
	 *
	 * @throws     PropelException
	 */
	public function ensureConsistency()
	{

		if ($this->aCountry !== null && $this->countryid !== $this->aCountry->getId()) {
			$this->aCountry = null;
		}
	} // ensureConsistency

	/**
	 * Reloads this object from datastore based on primary key and (optionally) resets all associated objects.
	 *
	 * This will only work if the object has been saved and has a valid primary key set.
	 *
	 * @param      boolean $deep (optional) Whether to also de-associated any related objects.
	 * @param      PropelPDO $con (optional) The PropelPDO connection to use.
	 * @return     void
	 * @throws     PropelException - if this object is deleted, unsaved or doesn't have pk match in db
	 */
	public function reload($deep = false, PropelPDO $con = null)
	{
		if ($this->isDeleted()) {
			throw new PropelException("Cannot reload a deleted object.");
		}

		if ($this->isNew()) {
			throw new PropelException("Cannot reload an unsaved object.");
		}

		if ($con === null) {
			$con = Propel::getConnection(StatePeer::DATABASE_NAME, Propel::CONNECTION_READ);
		}

		// We don't need to alter the object instance pool; we're just modifying this instance
		// already in the pool.

		$stmt = StatePeer::doSelectStmt($this->buildPkeyCriteria(), $con);
		$row = $stmt->fetch(PDO::FETCH_NUM);
		$stmt->closeCursor();
		if (!$row) {
			throw new PropelException('Cannot find matching row in the database to reload object values.');
		}
		$this->hydrate($row, 0, true); // rehydrate

		if ($deep) {  // also de-associate any related objects?

			$this->aCountry = null;
			$this->collCitys = null;
			$this->lastCityCriteria = null;

		} // if (deep)
	}

	/**
	 * Removes this object from datastore and sets delete attribute.
	 *
	 * @param      PropelPDO $con
	 * @return     void
	 * @throws     PropelException
	 * @see        BaseObject::setDeleted()
	 * @see        BaseObject::isDeleted()
	 */
	public function delete(PropelPDO $con = null)
	{
		if ($this->isDeleted()) {
			throw new PropelException("This object has already been deleted.");
		}

		if ($con === null) {
			$con = Propel::getConnection(StatePeer::DATABASE_NAME, Propel::CONNECTION_WRITE);
		}
		
		$con->beginTransaction();
		try {
			$ret = $this->preDelete($con);
			// symfony_behaviors behavior
			foreach (sfMixer::getCallables('BaseState:delete:pre') as $callable)
			{
			  if (call_user_func($callable, $this, $con))
			  {
			    $con->commit();
			
			    return;
			  }
			}

			if ($ret) {
				StatePeer::doDelete($this, $con);
				$this->postDelete($con);
				// symfony_behaviors behavior
				foreach (sfMixer::getCallables('BaseState:delete:post') as $callable)
				{
				  call_user_func($callable, $this, $con);
				}

				$this->setDeleted(true);
				$con->commit();
			} else {
				$con->commit();
			}
		} catch (PropelException $e) {
			$con->rollBack();
			throw $e;
		}
	}

	/**
	 * Persists this object to the database.
	 *
	 * If the object is new, it inserts it; otherwise an update is performed.
	 * All modified related objects will also be persisted in the doSave()
	 * method.  This method wraps all precipitate database operations in a
	 * single transaction.
	 *
	 * @param      PropelPDO $con
	 * @return     int The number of rows affected by this insert/update and any referring fk objects' save() operations.
	 * @throws     PropelException
	 * @see        doSave()
	 */
	public function save(PropelPDO $con = null)
	{
		if ($this->isDeleted()) {
			throw new PropelException("You cannot save an object that has been deleted.");
		}

		if ($con === null) {
			$con = Propel::getConnection(StatePeer::DATABASE_NAME, Propel::CONNECTION_WRITE);
		}
		
		$con->beginTransaction();
		$isInsert = $this->isNew();
		try {
			$ret = $this->preSave($con);
			// symfony_behaviors behavior
			foreach (sfMixer::getCallables('BaseState:save:pre') as $callable)
			{
			  if (is_integer($affectedRows = call_user_func($callable, $this, $con)))
			  {
			    $con->commit();
			
			    return $affectedRows;
			  }
			}

			if ($isInsert) {
				$ret = $ret && $this->preInsert($con);
			} else {
				$ret = $ret && $this->preUpdate($con);
			}
			if ($ret) {
				$affectedRows = $this->doSave($con);
				if ($isInsert) {
					$this->postInsert($con);
				} else {
					$this->postUpdate($con);
				}
				$this->postSave($con);
				// symfony_behaviors behavior
				foreach (sfMixer::getCallables('BaseState:save:post') as $callable)
				{
				  call_user_func($callable, $this, $con, $affectedRows);
				}

				StatePeer::addInstanceToPool($this);
			} else {
				$affectedRows = 0;
			}
			$con->commit();
			return $affectedRows;
		} catch (PropelException $e) {
			$con->rollBack();
			throw $e;
		}
	}

	/**
	 * Performs the work of inserting or updating the row in the database.
	 *
	 * If the object is new, it inserts it; otherwise an update is performed.
	 * All related objects are also updated in this method.
	 *
	 * @param      PropelPDO $con
	 * @return     int The number of rows affected by this insert/update and any referring fk objects' save() operations.
	 * @throws     PropelException
	 * @see        save()
	 */
	protected function doSave(PropelPDO $con)
	{
		$affectedRows = 0; // initialize var to track total num of affected rows
		if (!$this->alreadyInSave) {
			$this->alreadyInSave = true;

			// We call the save method on the following object(s) if they
			// were passed to this object by their coresponding set
			// method.  This object relates to these object(s) by a
			// foreign key reference.

			if ($this->aCountry !== null) {
				if ($this->aCountry->isModified() || $this->aCountry->isNew()) {
					$affectedRows += $this->aCountry->save($con);
				}
				$this->setCountry($this->aCountry);
			}

			if ($this->isNew() ) {
				$this->modifiedColumns[] = StatePeer::ID;
			}

			// If this object has been modified, then save it to the database.
			if ($this->isModified()) {
				if ($this->isNew()) {
					$pk = StatePeer::doInsert($this, $con);
					$affectedRows += 1; // we are assuming that there is only 1 row per doInsert() which
										 // should always be true here (even though technically
										 // BasePeer::doInsert() can insert multiple rows).

					$this->setId($pk);  //[IMV] update autoincrement primary key

					$this->setNew(false);
				} else {
					$affectedRows += StatePeer::doUpdate($this, $con);
				}

				$this->resetModified(); // [HL] After being saved an object is no longer 'modified'
			}

			if ($this->collCitys !== null) {
				foreach ($this->collCitys as $referrerFK) {
					if (!$referrerFK->isDeleted()) {
						$affectedRows += $referrerFK->save($con);
					}
				}
			}

			$this->alreadyInSave = false;

		}
		return $affectedRows;
	} // doSave()

	/**
	 * Array of ValidationFailed objects.
	 * @var        array ValidationFailed[]
	 */
	protected $validationFailures = array();

	/**
	 * Gets any ValidationFailed objects that resulted from last call to validate().
	 *
	 *
	 * @return     array ValidationFailed[]
	 * @see        validate()
	 */
	public function getValidationFailures()
	{
		return $this->validationFailures;
	}

	/**
	 * Validates the objects modified field values and all objects related to this table.
	 *
	 * If $columns is either a column name or an array of column names
	 * only those columns are validated.
	 *
	 * @param      mixed $columns Column name or an array of column names.
	 * @return     boolean Whether all columns pass validation.
	 * @see        doValidate()
	 * @see        getValidationFailures()
	 */
	public function validate($columns = null)
	{
		$res = $this->doValidate($columns);
		if ($res === true) {
			$this->validationFailures = array();
			return true;
		} else {
			$this->validationFailures = $res;
			return false;
		}
	}

	/**
	 * This function performs the validation work for complex object models.
	 *
	 * In addition to checking the current object, all related objects will
	 * also be validated.  If all pass then <code>true</code> is returned; otherwise
	 * an aggreagated array of ValidationFailed objects will be returned.
	 *
	 * @param      array $columns Array of column names to validate.
	 * @return     mixed <code>true</code> if all validations pass; array of <code>ValidationFailed</code> objets otherwise.
	 */
	protected function doValidate($columns = null)
	{
		if (!$this->alreadyInValidation) {
			$this->alreadyInValidation = true;
			$retval = null;

			$failureMap = array();


			// We call the validate method on the following object(s) if they
			// were passed to this object by their coresponding set
			// method.  This object relates to these object(s) by a
			// foreign key reference.

			if ($this->aCountry !== null) {
				if (!$this->aCountry->validate($columns)) {
					$failureMap = array_merge($failureMap, $this->aCountry->getValidationFailures());
				}
			}


			if (($retval = StatePeer::doValidate($this, $columns)) !== true) {
				$failureMap = array_merge($failureMap, $retval);
			}


				if ($this->collCitys !== null) {
					foreach ($this->collCitys as $referrerFK) {
						if (!$referrerFK->validate($columns)) {
							$failureMap = array_merge($failureMap, $referrerFK->getValidationFailures());
						}
					}
				}


			$this->alreadyInValidation = false;
		}

		return (!empty($failureMap) ? $failureMap : true);
	}

	/**
	 * Retrieves a field from the object by name passed in as a string.
	 *
	 * @param      string $name name
	 * @param      string $type The type of fieldname the $name is of:
	 *                     one of the class type constants BasePeer::TYPE_PHPNAME, BasePeer::TYPE_STUDLYPHPNAME
	 *                     BasePeer::TYPE_COLNAME, BasePeer::TYPE_FIELDNAME, BasePeer::TYPE_NUM
	 * @return     mixed Value of field.
	 */
	public function getByName($name, $type = BasePeer::TYPE_PHPNAME)
	{
		$pos = StatePeer::translateFieldName($name, $type, BasePeer::TYPE_NUM);
		$field = $this->getByPosition($pos);
		return $field;
	}

	/**
	 * Retrieves a field from the object by Position as specified in the xml schema.
	 * Zero-based.
	 *
	 * @param      int $pos position in xml schema
	 * @return     mixed Value of field at $pos
	 */
	public function getByPosition($pos)
	{
		switch($pos) {
			case 0:
				return $this->getId();
				break;
			case 1:
				return $this->getCountryid();
				break;
			case 2:
				return $this->getStatename();
				break;
			case 3:
				return $this->getCode();
				break;
			case 4:
				return $this->getAbreviation();
				break;
			case 5:
				return $this->getStatecode();
				break;
			default:
				return null;
				break;
		} // switch()
	}

	/**
	 * Exports the object as an array.
	 *
	 * You can specify the key type of the array by passing one of the class
	 * type constants.
	 *
	 * @param      string $keyType (optional) One of the class type constants BasePeer::TYPE_PHPNAME, BasePeer::TYPE_STUDLYPHPNAME
	 *                        BasePeer::TYPE_COLNAME, BasePeer::TYPE_FIELDNAME, BasePeer::TYPE_NUM. Defaults to BasePeer::TYPE_PHPNAME.
	 * @param      boolean $includeLazyLoadColumns (optional) Whether to include lazy loaded columns.  Defaults to TRUE.
	 * @return     an associative array containing the field names (as keys) and field values
	 */
	public function toArray($keyType = BasePeer::TYPE_PHPNAME, $includeLazyLoadColumns = true)
	{
		$keys = StatePeer::getFieldNames($keyType);
		$result = array(
			$keys[0] => $this->getId(),
			$keys[1] => $this->getCountryid(),
			$keys[2] => $this->getStatename(),
			$keys[3] => $this->getCode(),
			$keys[4] => $this->getAbreviation(),
			$keys[5] => $this->getStatecode(),
		);
		return $result;
	}

	/**
	 * Sets a field from the object by name passed in as a string.
	 *
	 * @param      string $name peer name
	 * @param      mixed $value field value
	 * @param      string $type The type of fieldname the $name is of:
	 *                     one of the class type constants BasePeer::TYPE_PHPNAME, BasePeer::TYPE_STUDLYPHPNAME
	 *                     BasePeer::TYPE_COLNAME, BasePeer::TYPE_FIELDNAME, BasePeer::TYPE_NUM
	 * @return     void
	 */
	public function setByName($name, $value, $type = BasePeer::TYPE_PHPNAME)
	{
		$pos = StatePeer::translateFieldName($name, $type, BasePeer::TYPE_NUM);
		return $this->setByPosition($pos, $value);
	}

	/**
	 * Sets a field from the object by Position as specified in the xml schema.
	 * Zero-based.
	 *
	 * @param      int $pos position in xml schema
	 * @param      mixed $value field value
	 * @return     void
	 */
	public function setByPosition($pos, $value)
	{
		switch($pos) {
			case 0:
				$this->setId($value);
				break;
			case 1:
				$this->setCountryid($value);
				break;
			case 2:
				$this->setStatename($value);
				break;
			case 3:
				$this->setCode($value);
				break;
			case 4:
				$this->setAbreviation($value);
				break;
			case 5:
				$this->setStatecode($value);
				break;
		} // switch()
	}

	/**
	 * Populates the object using an array.
	 *
	 * This is particularly useful when populating an object from one of the
	 * request arrays (e.g. $_POST).  This method goes through the column
	 * names, checking to see whether a matching key exists in populated
	 * array. If so the setByName() method is called for that column.
	 *
	 * You can specify the key type of the array by additionally passing one
	 * of the class type constants BasePeer::TYPE_PHPNAME, BasePeer::TYPE_STUDLYPHPNAME,
	 * BasePeer::TYPE_COLNAME, BasePeer::TYPE_FIELDNAME, BasePeer::TYPE_NUM.
	 * The default key type is the column's phpname (e.g. 'AuthorId')
	 *
	 * @param      array  $arr     An array to populate the object from.
	 * @param      string $keyType The type of keys the array uses.
	 * @return     void
	 */
	public function fromArray($arr, $keyType = BasePeer::TYPE_PHPNAME)
	{
		$keys = StatePeer::getFieldNames($keyType);

		if (array_key_exists($keys[0], $arr)) $this->setId($arr[$keys[0]]);
		if (array_key_exists($keys[1], $arr)) $this->setCountryid($arr[$keys[1]]);
		if (array_key_exists($keys[2], $arr)) $this->setStatename($arr[$keys[2]]);
		if (array_key_exists($keys[3], $arr)) $this->setCode($arr[$keys[3]]);
		if (array_key_exists($keys[4], $arr)) $this->setAbreviation($arr[$keys[4]]);
		if (array_key_exists($keys[5], $arr)) $this->setStatecode($arr[$keys[5]]);
	}

	/**
	 * Build a Criteria object containing the values of all modified columns in this object.
	 *
	 * @return     Criteria The Criteria object containing all modified values.
	 */
	public function buildCriteria()
	{
		$criteria = new Criteria(StatePeer::DATABASE_NAME);

		if ($this->isColumnModified(StatePeer::ID)) $criteria->add(StatePeer::ID, $this->id);
		if ($this->isColumnModified(StatePeer::COUNTRYID)) $criteria->add(StatePeer::COUNTRYID, $this->countryid);
		if ($this->isColumnModified(StatePeer::STATENAME)) $criteria->add(StatePeer::STATENAME, $this->statename);
		if ($this->isColumnModified(StatePeer::CODE)) $criteria->add(StatePeer::CODE, $this->code);
		if ($this->isColumnModified(StatePeer::ABREVIATION)) $criteria->add(StatePeer::ABREVIATION, $this->abreviation);
		if ($this->isColumnModified(StatePeer::STATECODE)) $criteria->add(StatePeer::STATECODE, $this->statecode);

		return $criteria;
	}

	/**
	 * Builds a Criteria object containing the primary key for this object.
	 *
	 * Unlike buildCriteria() this method includes the primary key values regardless
	 * of whether or not they have been modified.
	 *
	 * @return     Criteria The Criteria object containing value(s) for primary key(s).
	 */
	public function buildPkeyCriteria()
	{
		$criteria = new Criteria(StatePeer::DATABASE_NAME);

		$criteria->add(StatePeer::ID, $this->id);

		return $criteria;
	}

	/**
	 * Returns the primary key for this object (row).
	 * @return     int
	 */
	public function getPrimaryKey()
	{
		return $this->getId();
	}

	/**
	 * Generic method to set the primary key (id column).
	 *
	 * @param      int $key Primary key.
	 * @return     void
	 */
	public function setPrimaryKey($key)
	{
		$this->setId($key);
	}

	/**
	 * Sets contents of passed object to values from current object.
	 *
	 * If desired, this method can also make copies of all associated (fkey referrers)
	 * objects.
	 *
	 * @param      object $copyObj An object of State (or compatible) type.
	 * @param      boolean $deepCopy Whether to also copy all rows that refer (by fkey) to the current row.
	 * @throws     PropelException
	 */
	public function copyInto($copyObj, $deepCopy = false)
	{

		$copyObj->setCountryid($this->countryid);

		$copyObj->setStatename($this->statename);

		$copyObj->setCode($this->code);

		$copyObj->setAbreviation($this->abreviation);

		$copyObj->setStatecode($this->statecode);


		if ($deepCopy) {
			// important: temporarily setNew(false) because this affects the behavior of
			// the getter/setter methods for fkey referrer objects.
			$copyObj->setNew(false);

			foreach ($this->getCitys() as $relObj) {
				if ($relObj !== $this) {  // ensure that we don't try to copy a reference to ourselves
					$copyObj->addCity($relObj->copy($deepCopy));
				}
			}

		} // if ($deepCopy)


		$copyObj->setNew(true);

		$copyObj->setId(NULL); // this is a auto-increment column, so set to default value

	}

	/**
	 * Makes a copy of this object that will be inserted as a new row in table when saved.
	 * It creates a new object filling in the simple attributes, but skipping any primary
	 * keys that are defined for the table.
	 *
	 * If desired, this method can also make copies of all associated (fkey referrers)
	 * objects.
	 *
	 * @param      boolean $deepCopy Whether to also copy all rows that refer (by fkey) to the current row.
	 * @return     State Clone of current object.
	 * @throws     PropelException
	 */
	public function copy($deepCopy = false)
	{
		// we use get_class(), because this might be a subclass
		$clazz = get_class($this);
		$copyObj = new $clazz();
		$this->copyInto($copyObj, $deepCopy);
		return $copyObj;
	}

	/**
	 * Returns a peer instance associated with this om.
	 *
	 * Since Peer classes are not to have any instance attributes, this method returns the
	 * same instance for all member of this class. The method could therefore
	 * be static, but this would prevent one from overriding the behavior.
	 *
	 * @return     StatePeer
	 */
	public function getPeer()
	{
		if (self::$peer === null) {
			self::$peer = new StatePeer();
		}
		return self::$peer;
	}

	/**
	 * Declares an association between this object and a Country object.
	 *
	 * @param      Country $v
	 * @return     State The current object (for fluent API support)
	 * @throws     PropelException
	 */
	public function setCountry(Country $v = null)
	{
		if ($v === null) {
			$this->setCountryid(0);
		} else {
			$this->setCountryid($v->getId());
		}

		$this->aCountry = $v;

		// Add binding for other direction of this n:n relationship.
		// If this object has already been added to the Country object, it will not be re-added.
		if ($v !== null) {
			$v->addState($this);
		}

		return $this;
	}


	/**
	 * Get the associated Country object
	 *
	 * @param      PropelPDO Optional Connection object.
	 * @return     Country The associated Country object.
	 * @throws     PropelException
	 */
	public function getCountry(PropelPDO $con = null)
	{
		if ($this->aCountry === null && ($this->countryid !== null)) {
			$this->aCountry = CountryPeer::retrieveByPk($this->countryid);
			/* The following can be used additionally to
			   guarantee the related object contains a reference
			   to this object.  This level of coupling may, however, be
			   undesirable since it could result in an only partially populated collection
			   in the referenced object.
			   $this->aCountry->addStates($this);
			 */
		}
		return $this->aCountry;
	}

	/**
	 * Clears out the collCitys collection (array).
	 *
	 * This does not modify the database; however, it will remove any associated objects, causing
	 * them to be refetched by subsequent calls to accessor method.
	 *
	 * @return     void
	 * @see        addCitys()
	 */
	public function clearCitys()
	{
		$this->collCitys = null; // important to set this to NULL since that means it is uninitialized
	}

	/**
	 * Initializes the collCitys collection (array).
	 *
	 * By default this just sets the collCitys collection to an empty array (like clearcollCitys());
	 * however, you may wish to override this method in your stub class to provide setting appropriate
	 * to your application -- for example, setting the initial array to the values stored in database.
	 *
	 * @return     void
	 */
	public function initCitys()
	{
		$this->collCitys = array();
	}

	/**
	 * Gets an array of City objects which contain a foreign key that references this object.
	 *
	 * If this collection has already been initialized with an identical Criteria, it returns the collection.
	 * Otherwise if this State has previously been saved, it will retrieve
	 * related Citys from storage. If this State is new, it will return
	 * an empty collection or the current collection, the criteria is ignored on a new object.
	 *
	 * @param      PropelPDO $con
	 * @param      Criteria $criteria
	 * @return     array City[]
	 * @throws     PropelException
	 */
	public function getCitys($criteria = null, PropelPDO $con = null)
	{
		if ($criteria === null) {
			$criteria = new Criteria(StatePeer::DATABASE_NAME);
		}
		elseif ($criteria instanceof Criteria)
		{
			$criteria = clone $criteria;
		}

		if ($this->collCitys === null) {
			if ($this->isNew()) {
			   $this->collCitys = array();
			} else {

				$criteria->add(CityPeer::STATEID, $this->id);

				CityPeer::addSelectColumns($criteria);
				$this->collCitys = CityPeer::doSelect($criteria, $con);
			}
		} else {
			// criteria has no effect for a new object
			if (!$this->isNew()) {
				// the following code is to determine if a new query is
				// called for.  If the criteria is the same as the last
				// one, just return the collection.


				$criteria->add(CityPeer::STATEID, $this->id);

				CityPeer::addSelectColumns($criteria);
				if (!isset($this->lastCityCriteria) || !$this->lastCityCriteria->equals($criteria)) {
					$this->collCitys = CityPeer::doSelect($criteria, $con);
				}
			}
		}
		$this->lastCityCriteria = $criteria;
		return $this->collCitys;
	}

	/**
	 * Returns the number of related City objects.
	 *
	 * @param      Criteria $criteria
	 * @param      boolean $distinct
	 * @param      PropelPDO $con
	 * @return     int Count of related City objects.
	 * @throws     PropelException
	 */
	public function countCitys(Criteria $criteria = null, $distinct = false, PropelPDO $con = null)
	{
		if ($criteria === null) {
			$criteria = new Criteria(StatePeer::DATABASE_NAME);
		} else {
			$criteria = clone $criteria;
		}

		if ($distinct) {
			$criteria->setDistinct();
		}

		$count = null;

		if ($this->collCitys === null) {
			if ($this->isNew()) {
				$count = 0;
			} else {

				$criteria->add(CityPeer::STATEID, $this->id);

				$count = CityPeer::doCount($criteria, false, $con);
			}
		} else {
			// criteria has no effect for a new object
			if (!$this->isNew()) {
				// the following code is to determine if a new query is
				// called for.  If the criteria is the same as the last
				// one, just return count of the collection.


				$criteria->add(CityPeer::STATEID, $this->id);

				if (!isset($this->lastCityCriteria) || !$this->lastCityCriteria->equals($criteria)) {
					$count = CityPeer::doCount($criteria, false, $con);
				} else {
					$count = count($this->collCitys);
				}
			} else {
				$count = count($this->collCitys);
			}
		}
		return $count;
	}

	/**
	 * Method called to associate a City object to this object
	 * through the City foreign key attribute.
	 *
	 * @param      City $l City
	 * @return     void
	 * @throws     PropelException
	 */
	public function addCity(City $l)
	{
		if ($this->collCitys === null) {
			$this->initCitys();
		}
		if (!in_array($l, $this->collCitys, true)) { // only add it if the **same** object is not already associated
			array_push($this->collCitys, $l);
			$l->setStateRelatedByStateid($this);
		}
	}

	/**
	 * Resets all collections of referencing foreign keys.
	 *
	 * This method is a user-space workaround for PHP's inability to garbage collect objects
	 * with circular references.  This is currently necessary when using Propel in certain
	 * daemon or large-volumne/high-memory operations.
	 *
	 * @param      boolean $deep Whether to also clear the references on all associated objects.
	 */
	public function clearAllReferences($deep = false)
	{
		if ($deep) {
			if ($this->collCitys) {
				foreach ((array) $this->collCitys as $o) {
					$o->clearAllReferences($deep);
				}
			}
		} // if ($deep)

		$this->collCitys = null;
			$this->aCountry = null;
	}

	// symfony_behaviors behavior
	
	/**
	 * Calls methods defined via {@link sfMixer}.
	 */
	public function __call($method, $arguments)
	{
	  if (!$callable = sfMixer::getCallable('BaseState:'.$method))
	  {
	    throw new sfException(sprintf('Call to undefined method BaseState::%s', $method));
	  }
	
	  array_unshift($arguments, $this);
	
	  return call_user_func_array($callable, $arguments);
	}

} // BaseState