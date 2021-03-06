<?php

/**
 * Base class that represents a row from the 'Broker_Search' table.
 *
 * 
 *
 * This class was autogenerated by Propel 1.4.2 on:
 *
 * Mon Jul 28 11:12:28 2014
 *
 * @package    lib.model.om
 */
abstract class BaseBrokerSearch extends BaseObject  implements Persistent {


	/**
	 * The Peer class.
	 * Instance provides a convenient way of calling static methods on a class
	 * that calling code may not be able to identify.
	 * @var        BrokerSearchPeer
	 */
	protected static $peer;

	/**
	 * The value for the brokerid field.
	 * Note: this column has a database default value of: 0
	 * @var        int
	 */
	protected $brokerid;

	/**
	 * The value for the brokername field.
	 * @var        string
	 */
	protected $brokername;

	/**
	 * The value for the brokercode field.
	 * @var        string
	 */
	protected $brokercode;

	/**
	 * The value for the brokertype field.
	 * @var        string
	 */
	protected $brokertype;

	/**
	 * The value for the brokersubtype field.
	 * @var        string
	 */
	protected $brokersubtype;

	/**
	 * The value for the brokercity field.
	 * @var        string
	 */
	protected $brokercity;

	/**
	 * The value for the brokerstate field.
	 * @var        string
	 */
	protected $brokerstate;

	/**
	 * The value for the brokercountry field.
	 * @var        string
	 */
	protected $brokercountry;

	/**
	 * The value for the createdby field.
	 * @var        double
	 */
	protected $createdby;

	/**
	 * The value for the createdon field.
	 * @var        string
	 */
	protected $createdon;

	/**
	 * The value for the modifiedby field.
	 * @var        double
	 */
	protected $modifiedby;

	/**
	 * The value for the modifiedon field.
	 * @var        string
	 */
	protected $modifiedon;

	/**
	 * The value for the id field.
	 * @var        int
	 */
	protected $id;

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
	
	const PEER = 'BrokerSearchPeer';

	/**
	 * Applies default values to this object.
	 * This method should be called from the object's constructor (or
	 * equivalent initialization method).
	 * @see        __construct()
	 */
	public function applyDefaultValues()
	{
		$this->brokerid = 0;
	}

	/**
	 * Initializes internal state of BaseBrokerSearch object.
	 * @see        applyDefaults()
	 */
	public function __construct()
	{
		parent::__construct();
		$this->applyDefaultValues();
	}

	/**
	 * Get the [brokerid] column value.
	 * 
	 * @return     int
	 */
	public function getBrokerid()
	{
		return $this->brokerid;
	}

	/**
	 * Get the [brokername] column value.
	 * 
	 * @return     string
	 */
	public function getBrokername()
	{
		return $this->brokername;
	}

	/**
	 * Get the [brokercode] column value.
	 * 
	 * @return     string
	 */
	public function getBrokercode()
	{
		return $this->brokercode;
	}

	/**
	 * Get the [brokertype] column value.
	 * 
	 * @return     string
	 */
	public function getBrokertype()
	{
		return $this->brokertype;
	}

	/**
	 * Get the [brokersubtype] column value.
	 * 
	 * @return     string
	 */
	public function getBrokersubtype()
	{
		return $this->brokersubtype;
	}

	/**
	 * Get the [brokercity] column value.
	 * 
	 * @return     string
	 */
	public function getBrokercity()
	{
		return $this->brokercity;
	}

	/**
	 * Get the [brokerstate] column value.
	 * 
	 * @return     string
	 */
	public function getBrokerstate()
	{
		return $this->brokerstate;
	}

	/**
	 * Get the [brokercountry] column value.
	 * 
	 * @return     string
	 */
	public function getBrokercountry()
	{
		return $this->brokercountry;
	}

	/**
	 * Get the [createdby] column value.
	 * 
	 * @return     double
	 */
	public function getCreatedby()
	{
		return $this->createdby;
	}

	/**
	 * Get the [optionally formatted] temporal [createdon] column value.
	 * 
	 *
	 * @param      string $format The date/time format string (either date()-style or strftime()-style).
	 *							If format is NULL, then the raw DateTime object will be returned.
	 * @return     mixed Formatted date/time value as string or DateTime object (if format is NULL), NULL if column is NULL, and 0 if column value is 0000-00-00 00:00:00
	 * @throws     PropelException - if unable to parse/validate the date/time value.
	 */
	public function getCreatedon($format = 'Y-m-d H:i:s')
	{
		if ($this->createdon === null) {
			return null;
		}


		if ($this->createdon === '0000-00-00 00:00:00') {
			// while technically this is not a default value of NULL,
			// this seems to be closest in meaning.
			return null;
		} else {
			try {
				$dt = new DateTime($this->createdon);
			} catch (Exception $x) {
				throw new PropelException("Internally stored date/time/timestamp value could not be converted to DateTime: " . var_export($this->createdon, true), $x);
			}
		}

		if ($format === null) {
			// Because propel.useDateTimeClass is TRUE, we return a DateTime object.
			return $dt;
		} elseif (strpos($format, '%') !== false) {
			return strftime($format, $dt->format('U'));
		} else {
			return $dt->format($format);
		}
	}

	/**
	 * Get the [modifiedby] column value.
	 * 
	 * @return     double
	 */
	public function getModifiedby()
	{
		return $this->modifiedby;
	}

	/**
	 * Get the [optionally formatted] temporal [modifiedon] column value.
	 * 
	 *
	 * @param      string $format The date/time format string (either date()-style or strftime()-style).
	 *							If format is NULL, then the raw DateTime object will be returned.
	 * @return     mixed Formatted date/time value as string or DateTime object (if format is NULL), NULL if column is NULL, and 0 if column value is 0000-00-00 00:00:00
	 * @throws     PropelException - if unable to parse/validate the date/time value.
	 */
	public function getModifiedon($format = 'Y-m-d H:i:s')
	{
		if ($this->modifiedon === null) {
			return null;
		}


		if ($this->modifiedon === '0000-00-00 00:00:00') {
			// while technically this is not a default value of NULL,
			// this seems to be closest in meaning.
			return null;
		} else {
			try {
				$dt = new DateTime($this->modifiedon);
			} catch (Exception $x) {
				throw new PropelException("Internally stored date/time/timestamp value could not be converted to DateTime: " . var_export($this->modifiedon, true), $x);
			}
		}

		if ($format === null) {
			// Because propel.useDateTimeClass is TRUE, we return a DateTime object.
			return $dt;
		} elseif (strpos($format, '%') !== false) {
			return strftime($format, $dt->format('U'));
		} else {
			return $dt->format($format);
		}
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
	 * Set the value of [brokerid] column.
	 * 
	 * @param      int $v new value
	 * @return     BrokerSearch The current object (for fluent API support)
	 */
	public function setBrokerid($v)
	{
		if ($v !== null) {
			$v = (int) $v;
		}

		if ($this->brokerid !== $v || $this->isNew()) {
			$this->brokerid = $v;
			$this->modifiedColumns[] = BrokerSearchPeer::BROKERID;
		}

		return $this;
	} // setBrokerid()

	/**
	 * Set the value of [brokername] column.
	 * 
	 * @param      string $v new value
	 * @return     BrokerSearch The current object (for fluent API support)
	 */
	public function setBrokername($v)
	{
		if ($v !== null) {
			$v = (string) $v;
		}

		if ($this->brokername !== $v) {
			$this->brokername = $v;
			$this->modifiedColumns[] = BrokerSearchPeer::BROKERNAME;
		}

		return $this;
	} // setBrokername()

	/**
	 * Set the value of [brokercode] column.
	 * 
	 * @param      string $v new value
	 * @return     BrokerSearch The current object (for fluent API support)
	 */
	public function setBrokercode($v)
	{
		if ($v !== null) {
			$v = (string) $v;
		}

		if ($this->brokercode !== $v) {
			$this->brokercode = $v;
			$this->modifiedColumns[] = BrokerSearchPeer::BROKERCODE;
		}

		return $this;
	} // setBrokercode()

	/**
	 * Set the value of [brokertype] column.
	 * 
	 * @param      string $v new value
	 * @return     BrokerSearch The current object (for fluent API support)
	 */
	public function setBrokertype($v)
	{
		if ($v !== null) {
			$v = (string) $v;
		}

		if ($this->brokertype !== $v) {
			$this->brokertype = $v;
			$this->modifiedColumns[] = BrokerSearchPeer::BROKERTYPE;
		}

		return $this;
	} // setBrokertype()

	/**
	 * Set the value of [brokersubtype] column.
	 * 
	 * @param      string $v new value
	 * @return     BrokerSearch The current object (for fluent API support)
	 */
	public function setBrokersubtype($v)
	{
		if ($v !== null) {
			$v = (string) $v;
		}

		if ($this->brokersubtype !== $v) {
			$this->brokersubtype = $v;
			$this->modifiedColumns[] = BrokerSearchPeer::BROKERSUBTYPE;
		}

		return $this;
	} // setBrokersubtype()

	/**
	 * Set the value of [brokercity] column.
	 * 
	 * @param      string $v new value
	 * @return     BrokerSearch The current object (for fluent API support)
	 */
	public function setBrokercity($v)
	{
		if ($v !== null) {
			$v = (string) $v;
		}

		if ($this->brokercity !== $v) {
			$this->brokercity = $v;
			$this->modifiedColumns[] = BrokerSearchPeer::BROKERCITY;
		}

		return $this;
	} // setBrokercity()

	/**
	 * Set the value of [brokerstate] column.
	 * 
	 * @param      string $v new value
	 * @return     BrokerSearch The current object (for fluent API support)
	 */
	public function setBrokerstate($v)
	{
		if ($v !== null) {
			$v = (string) $v;
		}

		if ($this->brokerstate !== $v) {
			$this->brokerstate = $v;
			$this->modifiedColumns[] = BrokerSearchPeer::BROKERSTATE;
		}

		return $this;
	} // setBrokerstate()

	/**
	 * Set the value of [brokercountry] column.
	 * 
	 * @param      string $v new value
	 * @return     BrokerSearch The current object (for fluent API support)
	 */
	public function setBrokercountry($v)
	{
		if ($v !== null) {
			$v = (string) $v;
		}

		if ($this->brokercountry !== $v) {
			$this->brokercountry = $v;
			$this->modifiedColumns[] = BrokerSearchPeer::BROKERCOUNTRY;
		}

		return $this;
	} // setBrokercountry()

	/**
	 * Set the value of [createdby] column.
	 * 
	 * @param      double $v new value
	 * @return     BrokerSearch The current object (for fluent API support)
	 */
	public function setCreatedby($v)
	{
		if ($v !== null) {
			$v = (string) $v;
		}

		if ($this->createdby !== $v) {
			$this->createdby = $v;
			$this->modifiedColumns[] = BrokerSearchPeer::CREATEDBY;
		}

		return $this;
	} // setCreatedby()

	/**
	 * Sets the value of [createdon] column to a normalized version of the date/time value specified.
	 * 
	 * @param      mixed $v string, integer (timestamp), or DateTime value.  Empty string will
	 *						be treated as NULL for temporal objects.
	 * @return     BrokerSearch The current object (for fluent API support)
	 */
	public function setCreatedon($v)
	{
		// we treat '' as NULL for temporal objects because DateTime('') == DateTime('now')
		// -- which is unexpected, to say the least.
		if ($v === null || $v === '') {
			$dt = null;
		} elseif ($v instanceof DateTime) {
			$dt = $v;
		} else {
			// some string/numeric value passed; we normalize that so that we can
			// validate it.
			try {
				if (is_numeric($v)) { // if it's a unix timestamp
					$dt = new DateTime('@'.$v, new DateTimeZone('UTC'));
					// We have to explicitly specify and then change the time zone because of a
					// DateTime bug: http://bugs.php.net/bug.php?id=43003
					$dt->setTimeZone(new DateTimeZone(date_default_timezone_get()));
				} else {
					$dt = new DateTime($v);
				}
			} catch (Exception $x) {
				throw new PropelException('Error parsing date/time value: ' . var_export($v, true), $x);
			}
		}

		if ( $this->createdon !== null || $dt !== null ) {
			// (nested ifs are a little easier to read in this case)

			$currNorm = ($this->createdon !== null && $tmpDt = new DateTime($this->createdon)) ? $tmpDt->format('Y-m-d H:i:s') : null;
			$newNorm = ($dt !== null) ? $dt->format('Y-m-d H:i:s') : null;

			if ( ($currNorm !== $newNorm) // normalized values don't match 
					)
			{
				$this->createdon = ($dt ? $dt->format('Y-m-d H:i:s') : null);
				$this->modifiedColumns[] = BrokerSearchPeer::CREATEDON;
			}
		} // if either are not null

		return $this;
	} // setCreatedon()

	/**
	 * Set the value of [modifiedby] column.
	 * 
	 * @param      double $v new value
	 * @return     BrokerSearch The current object (for fluent API support)
	 */
	public function setModifiedby($v)
	{
		if ($v !== null) {
			$v = (string) $v;
		}

		if ($this->modifiedby !== $v) {
			$this->modifiedby = $v;
			$this->modifiedColumns[] = BrokerSearchPeer::MODIFIEDBY;
		}

		return $this;
	} // setModifiedby()

	/**
	 * Sets the value of [modifiedon] column to a normalized version of the date/time value specified.
	 * 
	 * @param      mixed $v string, integer (timestamp), or DateTime value.  Empty string will
	 *						be treated as NULL for temporal objects.
	 * @return     BrokerSearch The current object (for fluent API support)
	 */
	public function setModifiedon($v)
	{
		// we treat '' as NULL for temporal objects because DateTime('') == DateTime('now')
		// -- which is unexpected, to say the least.
		if ($v === null || $v === '') {
			$dt = null;
		} elseif ($v instanceof DateTime) {
			$dt = $v;
		} else {
			// some string/numeric value passed; we normalize that so that we can
			// validate it.
			try {
				if (is_numeric($v)) { // if it's a unix timestamp
					$dt = new DateTime('@'.$v, new DateTimeZone('UTC'));
					// We have to explicitly specify and then change the time zone because of a
					// DateTime bug: http://bugs.php.net/bug.php?id=43003
					$dt->setTimeZone(new DateTimeZone(date_default_timezone_get()));
				} else {
					$dt = new DateTime($v);
				}
			} catch (Exception $x) {
				throw new PropelException('Error parsing date/time value: ' . var_export($v, true), $x);
			}
		}

		if ( $this->modifiedon !== null || $dt !== null ) {
			// (nested ifs are a little easier to read in this case)

			$currNorm = ($this->modifiedon !== null && $tmpDt = new DateTime($this->modifiedon)) ? $tmpDt->format('Y-m-d H:i:s') : null;
			$newNorm = ($dt !== null) ? $dt->format('Y-m-d H:i:s') : null;

			if ( ($currNorm !== $newNorm) // normalized values don't match 
					)
			{
				$this->modifiedon = ($dt ? $dt->format('Y-m-d H:i:s') : null);
				$this->modifiedColumns[] = BrokerSearchPeer::MODIFIEDON;
			}
		} // if either are not null

		return $this;
	} // setModifiedon()

	/**
	 * Set the value of [id] column.
	 * 
	 * @param      int $v new value
	 * @return     BrokerSearch The current object (for fluent API support)
	 */
	public function setId($v)
	{
		if ($v !== null) {
			$v = (int) $v;
		}

		if ($this->id !== $v) {
			$this->id = $v;
			$this->modifiedColumns[] = BrokerSearchPeer::ID;
		}

		return $this;
	} // setId()

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
			if ($this->brokerid !== 0) {
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

			$this->brokerid = ($row[$startcol + 0] !== null) ? (int) $row[$startcol + 0] : null;
			$this->brokername = ($row[$startcol + 1] !== null) ? (string) $row[$startcol + 1] : null;
			$this->brokercode = ($row[$startcol + 2] !== null) ? (string) $row[$startcol + 2] : null;
			$this->brokertype = ($row[$startcol + 3] !== null) ? (string) $row[$startcol + 3] : null;
			$this->brokersubtype = ($row[$startcol + 4] !== null) ? (string) $row[$startcol + 4] : null;
			$this->brokercity = ($row[$startcol + 5] !== null) ? (string) $row[$startcol + 5] : null;
			$this->brokerstate = ($row[$startcol + 6] !== null) ? (string) $row[$startcol + 6] : null;
			$this->brokercountry = ($row[$startcol + 7] !== null) ? (string) $row[$startcol + 7] : null;
			$this->createdby = ($row[$startcol + 8] !== null) ? (string) $row[$startcol + 8] : null;
			$this->createdon = ($row[$startcol + 9] !== null) ? (string) $row[$startcol + 9] : null;
			$this->modifiedby = ($row[$startcol + 10] !== null) ? (string) $row[$startcol + 10] : null;
			$this->modifiedon = ($row[$startcol + 11] !== null) ? (string) $row[$startcol + 11] : null;
			$this->id = ($row[$startcol + 12] !== null) ? (int) $row[$startcol + 12] : null;
			$this->resetModified();

			$this->setNew(false);

			if ($rehydrate) {
				$this->ensureConsistency();
			}

			// FIXME - using NUM_COLUMNS may be clearer.
			return $startcol + 13; // 13 = BrokerSearchPeer::NUM_COLUMNS - BrokerSearchPeer::NUM_LAZY_LOAD_COLUMNS).

		} catch (Exception $e) {
			throw new PropelException("Error populating BrokerSearch object", $e);
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
			$con = Propel::getConnection(BrokerSearchPeer::DATABASE_NAME, Propel::CONNECTION_READ);
		}

		// We don't need to alter the object instance pool; we're just modifying this instance
		// already in the pool.

		$stmt = BrokerSearchPeer::doSelectStmt($this->buildPkeyCriteria(), $con);
		$row = $stmt->fetch(PDO::FETCH_NUM);
		$stmt->closeCursor();
		if (!$row) {
			throw new PropelException('Cannot find matching row in the database to reload object values.');
		}
		$this->hydrate($row, 0, true); // rehydrate

		if ($deep) {  // also de-associate any related objects?

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
			$con = Propel::getConnection(BrokerSearchPeer::DATABASE_NAME, Propel::CONNECTION_WRITE);
		}
		
		$con->beginTransaction();
		try {
			$ret = $this->preDelete($con);
			// symfony_behaviors behavior
			foreach (sfMixer::getCallables('BaseBrokerSearch:delete:pre') as $callable)
			{
			  if (call_user_func($callable, $this, $con))
			  {
			    $con->commit();
			
			    return;
			  }
			}

			if ($ret) {
				BrokerSearchPeer::doDelete($this, $con);
				$this->postDelete($con);
				// symfony_behaviors behavior
				foreach (sfMixer::getCallables('BaseBrokerSearch:delete:post') as $callable)
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
			$con = Propel::getConnection(BrokerSearchPeer::DATABASE_NAME, Propel::CONNECTION_WRITE);
		}
		
		$con->beginTransaction();
		$isInsert = $this->isNew();
		try {
			$ret = $this->preSave($con);
			// symfony_behaviors behavior
			foreach (sfMixer::getCallables('BaseBrokerSearch:save:pre') as $callable)
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
				foreach (sfMixer::getCallables('BaseBrokerSearch:save:post') as $callable)
				{
				  call_user_func($callable, $this, $con, $affectedRows);
				}

				BrokerSearchPeer::addInstanceToPool($this);
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

			if ($this->isNew() ) {
				$this->modifiedColumns[] = BrokerSearchPeer::ID;
			}

			// If this object has been modified, then save it to the database.
			if ($this->isModified()) {
				if ($this->isNew()) {
					$pk = BrokerSearchPeer::doInsert($this, $con);
					$affectedRows += 1; // we are assuming that there is only 1 row per doInsert() which
										 // should always be true here (even though technically
										 // BasePeer::doInsert() can insert multiple rows).

					$this->setId($pk);  //[IMV] update autoincrement primary key

					$this->setNew(false);
				} else {
					$affectedRows += BrokerSearchPeer::doUpdate($this, $con);
				}

				$this->resetModified(); // [HL] After being saved an object is no longer 'modified'
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


			if (($retval = BrokerSearchPeer::doValidate($this, $columns)) !== true) {
				$failureMap = array_merge($failureMap, $retval);
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
		$pos = BrokerSearchPeer::translateFieldName($name, $type, BasePeer::TYPE_NUM);
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
				return $this->getBrokerid();
				break;
			case 1:
				return $this->getBrokername();
				break;
			case 2:
				return $this->getBrokercode();
				break;
			case 3:
				return $this->getBrokertype();
				break;
			case 4:
				return $this->getBrokersubtype();
				break;
			case 5:
				return $this->getBrokercity();
				break;
			case 6:
				return $this->getBrokerstate();
				break;
			case 7:
				return $this->getBrokercountry();
				break;
			case 8:
				return $this->getCreatedby();
				break;
			case 9:
				return $this->getCreatedon();
				break;
			case 10:
				return $this->getModifiedby();
				break;
			case 11:
				return $this->getModifiedon();
				break;
			case 12:
				return $this->getId();
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
		$keys = BrokerSearchPeer::getFieldNames($keyType);
		$result = array(
			$keys[0] => $this->getBrokerid(),
			$keys[1] => $this->getBrokername(),
			$keys[2] => $this->getBrokercode(),
			$keys[3] => $this->getBrokertype(),
			$keys[4] => $this->getBrokersubtype(),
			$keys[5] => $this->getBrokercity(),
			$keys[6] => $this->getBrokerstate(),
			$keys[7] => $this->getBrokercountry(),
			$keys[8] => $this->getCreatedby(),
			$keys[9] => $this->getCreatedon(),
			$keys[10] => $this->getModifiedby(),
			$keys[11] => $this->getModifiedon(),
			$keys[12] => $this->getId(),
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
		$pos = BrokerSearchPeer::translateFieldName($name, $type, BasePeer::TYPE_NUM);
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
				$this->setBrokerid($value);
				break;
			case 1:
				$this->setBrokername($value);
				break;
			case 2:
				$this->setBrokercode($value);
				break;
			case 3:
				$this->setBrokertype($value);
				break;
			case 4:
				$this->setBrokersubtype($value);
				break;
			case 5:
				$this->setBrokercity($value);
				break;
			case 6:
				$this->setBrokerstate($value);
				break;
			case 7:
				$this->setBrokercountry($value);
				break;
			case 8:
				$this->setCreatedby($value);
				break;
			case 9:
				$this->setCreatedon($value);
				break;
			case 10:
				$this->setModifiedby($value);
				break;
			case 11:
				$this->setModifiedon($value);
				break;
			case 12:
				$this->setId($value);
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
		$keys = BrokerSearchPeer::getFieldNames($keyType);

		if (array_key_exists($keys[0], $arr)) $this->setBrokerid($arr[$keys[0]]);
		if (array_key_exists($keys[1], $arr)) $this->setBrokername($arr[$keys[1]]);
		if (array_key_exists($keys[2], $arr)) $this->setBrokercode($arr[$keys[2]]);
		if (array_key_exists($keys[3], $arr)) $this->setBrokertype($arr[$keys[3]]);
		if (array_key_exists($keys[4], $arr)) $this->setBrokersubtype($arr[$keys[4]]);
		if (array_key_exists($keys[5], $arr)) $this->setBrokercity($arr[$keys[5]]);
		if (array_key_exists($keys[6], $arr)) $this->setBrokerstate($arr[$keys[6]]);
		if (array_key_exists($keys[7], $arr)) $this->setBrokercountry($arr[$keys[7]]);
		if (array_key_exists($keys[8], $arr)) $this->setCreatedby($arr[$keys[8]]);
		if (array_key_exists($keys[9], $arr)) $this->setCreatedon($arr[$keys[9]]);
		if (array_key_exists($keys[10], $arr)) $this->setModifiedby($arr[$keys[10]]);
		if (array_key_exists($keys[11], $arr)) $this->setModifiedon($arr[$keys[11]]);
		if (array_key_exists($keys[12], $arr)) $this->setId($arr[$keys[12]]);
	}

	/**
	 * Build a Criteria object containing the values of all modified columns in this object.
	 *
	 * @return     Criteria The Criteria object containing all modified values.
	 */
	public function buildCriteria()
	{
		$criteria = new Criteria(BrokerSearchPeer::DATABASE_NAME);

		if ($this->isColumnModified(BrokerSearchPeer::BROKERID)) $criteria->add(BrokerSearchPeer::BROKERID, $this->brokerid);
		if ($this->isColumnModified(BrokerSearchPeer::BROKERNAME)) $criteria->add(BrokerSearchPeer::BROKERNAME, $this->brokername);
		if ($this->isColumnModified(BrokerSearchPeer::BROKERCODE)) $criteria->add(BrokerSearchPeer::BROKERCODE, $this->brokercode);
		if ($this->isColumnModified(BrokerSearchPeer::BROKERTYPE)) $criteria->add(BrokerSearchPeer::BROKERTYPE, $this->brokertype);
		if ($this->isColumnModified(BrokerSearchPeer::BROKERSUBTYPE)) $criteria->add(BrokerSearchPeer::BROKERSUBTYPE, $this->brokersubtype);
		if ($this->isColumnModified(BrokerSearchPeer::BROKERCITY)) $criteria->add(BrokerSearchPeer::BROKERCITY, $this->brokercity);
		if ($this->isColumnModified(BrokerSearchPeer::BROKERSTATE)) $criteria->add(BrokerSearchPeer::BROKERSTATE, $this->brokerstate);
		if ($this->isColumnModified(BrokerSearchPeer::BROKERCOUNTRY)) $criteria->add(BrokerSearchPeer::BROKERCOUNTRY, $this->brokercountry);
		if ($this->isColumnModified(BrokerSearchPeer::CREATEDBY)) $criteria->add(BrokerSearchPeer::CREATEDBY, $this->createdby);
		if ($this->isColumnModified(BrokerSearchPeer::CREATEDON)) $criteria->add(BrokerSearchPeer::CREATEDON, $this->createdon);
		if ($this->isColumnModified(BrokerSearchPeer::MODIFIEDBY)) $criteria->add(BrokerSearchPeer::MODIFIEDBY, $this->modifiedby);
		if ($this->isColumnModified(BrokerSearchPeer::MODIFIEDON)) $criteria->add(BrokerSearchPeer::MODIFIEDON, $this->modifiedon);
		if ($this->isColumnModified(BrokerSearchPeer::ID)) $criteria->add(BrokerSearchPeer::ID, $this->id);

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
		$criteria = new Criteria(BrokerSearchPeer::DATABASE_NAME);

		$criteria->add(BrokerSearchPeer::ID, $this->id);

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
	 * @param      object $copyObj An object of BrokerSearch (or compatible) type.
	 * @param      boolean $deepCopy Whether to also copy all rows that refer (by fkey) to the current row.
	 * @throws     PropelException
	 */
	public function copyInto($copyObj, $deepCopy = false)
	{

		$copyObj->setBrokerid($this->brokerid);

		$copyObj->setBrokername($this->brokername);

		$copyObj->setBrokercode($this->brokercode);

		$copyObj->setBrokertype($this->brokertype);

		$copyObj->setBrokersubtype($this->brokersubtype);

		$copyObj->setBrokercity($this->brokercity);

		$copyObj->setBrokerstate($this->brokerstate);

		$copyObj->setBrokercountry($this->brokercountry);

		$copyObj->setCreatedby($this->createdby);

		$copyObj->setCreatedon($this->createdon);

		$copyObj->setModifiedby($this->modifiedby);

		$copyObj->setModifiedon($this->modifiedon);


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
	 * @return     BrokerSearch Clone of current object.
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
	 * @return     BrokerSearchPeer
	 */
	public function getPeer()
	{
		if (self::$peer === null) {
			self::$peer = new BrokerSearchPeer();
		}
		return self::$peer;
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
		} // if ($deep)

	}

	// symfony_behaviors behavior
	
	/**
	 * Calls methods defined via {@link sfMixer}.
	 */
	public function __call($method, $arguments)
	{
	  if (!$callable = sfMixer::getCallable('BaseBrokerSearch:'.$method))
	  {
	    throw new sfException(sprintf('Call to undefined method BaseBrokerSearch::%s', $method));
	  }
	
	  array_unshift($arguments, $this);
	
	  return call_user_func_array($callable, $arguments);
	}

} // BaseBrokerSearch