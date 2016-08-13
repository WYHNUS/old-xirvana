<?php

namespace Base;

use \Debt as ChildDebt;
use \DebtQuery as ChildDebtQuery;
use \Transaction as ChildTransaction;
use \TransactionQuery as ChildTransactionQuery;
use \Users as ChildUsers;
use \UsersQuery as ChildUsersQuery;
use \Exception;
use \PDO;
use Map\DebtTableMap;
use Map\TransactionTableMap;
use Map\UsersTableMap;
use Propel\Runtime\Propel;
use Propel\Runtime\ActiveQuery\Criteria;
use Propel\Runtime\ActiveQuery\ModelCriteria;
use Propel\Runtime\ActiveRecord\ActiveRecordInterface;
use Propel\Runtime\Collection\Collection;
use Propel\Runtime\Collection\ObjectCollection;
use Propel\Runtime\Connection\ConnectionInterface;
use Propel\Runtime\Exception\BadMethodCallException;
use Propel\Runtime\Exception\LogicException;
use Propel\Runtime\Exception\PropelException;
use Propel\Runtime\Map\TableMap;
use Propel\Runtime\Parser\AbstractParser;

/**
 * Base class that represents a row from the 'Users' table.
 *
 *
 *
* @package    propel.generator..Base
*/
abstract class Users implements ActiveRecordInterface
{
    /**
     * TableMap class name
     */
    const TABLE_MAP = '\\Map\\UsersTableMap';


    /**
     * attribute to determine if this object has previously been saved.
     * @var boolean
     */
    protected $new = true;

    /**
     * attribute to determine whether this object has been deleted.
     * @var boolean
     */
    protected $deleted = false;

    /**
     * The columns that have been modified in current object.
     * Tracking modified columns allows us to only update modified columns.
     * @var array
     */
    protected $modifiedColumns = array();

    /**
     * The (virtual) columns that are added at runtime
     * The formatters can add supplementary columns based on a resultset
     * @var array
     */
    protected $virtualColumns = array();

    /**
     * The value for the email field.
     *
     * @var        string
     */
    protected $email;

    /**
     * The value for the name field.
     *
     * @var        string
     */
    protected $name;

    /**
     * The value for the password field.
     *
     * @var        string
     */
    protected $password;

    /**
     * @var        ObjectCollection|ChildDebt[] Collection to store aggregation of ChildDebt objects.
     */
    protected $collDebtsRelatedByCreditor;
    protected $collDebtsRelatedByCreditorPartial;

    /**
     * @var        ObjectCollection|ChildDebt[] Collection to store aggregation of ChildDebt objects.
     */
    protected $collDebtsRelatedByDebtor;
    protected $collDebtsRelatedByDebtorPartial;

    /**
     * @var        ObjectCollection|ChildTransaction[] Collection to store aggregation of ChildTransaction objects.
     */
    protected $collTransactionsRelatedByCreditor;
    protected $collTransactionsRelatedByCreditorPartial;

    /**
     * @var        ObjectCollection|ChildTransaction[] Collection to store aggregation of ChildTransaction objects.
     */
    protected $collTransactionsRelatedByDebtor;
    protected $collTransactionsRelatedByDebtorPartial;

    /**
     * Flag to prevent endless save loop, if this object is referenced
     * by another object which falls in this transaction.
     *
     * @var boolean
     */
    protected $alreadyInSave = false;

    /**
     * An array of objects scheduled for deletion.
     * @var ObjectCollection|ChildDebt[]
     */
    protected $debtsRelatedByCreditorScheduledForDeletion = null;

    /**
     * An array of objects scheduled for deletion.
     * @var ObjectCollection|ChildDebt[]
     */
    protected $debtsRelatedByDebtorScheduledForDeletion = null;

    /**
     * An array of objects scheduled for deletion.
     * @var ObjectCollection|ChildTransaction[]
     */
    protected $transactionsRelatedByCreditorScheduledForDeletion = null;

    /**
     * An array of objects scheduled for deletion.
     * @var ObjectCollection|ChildTransaction[]
     */
    protected $transactionsRelatedByDebtorScheduledForDeletion = null;

    /**
     * Initializes internal state of Base\Users object.
     */
    public function __construct()
    {
    }

    /**
     * Returns whether the object has been modified.
     *
     * @return boolean True if the object has been modified.
     */
    public function isModified()
    {
        return !!$this->modifiedColumns;
    }

    /**
     * Has specified column been modified?
     *
     * @param  string  $col column fully qualified name (TableMap::TYPE_COLNAME), e.g. Book::AUTHOR_ID
     * @return boolean True if $col has been modified.
     */
    public function isColumnModified($col)
    {
        return $this->modifiedColumns && isset($this->modifiedColumns[$col]);
    }

    /**
     * Get the columns that have been modified in this object.
     * @return array A unique list of the modified column names for this object.
     */
    public function getModifiedColumns()
    {
        return $this->modifiedColumns ? array_keys($this->modifiedColumns) : [];
    }

    /**
     * Returns whether the object has ever been saved.  This will
     * be false, if the object was retrieved from storage or was created
     * and then saved.
     *
     * @return boolean true, if the object has never been persisted.
     */
    public function isNew()
    {
        return $this->new;
    }

    /**
     * Setter for the isNew attribute.  This method will be called
     * by Propel-generated children and objects.
     *
     * @param boolean $b the state of the object.
     */
    public function setNew($b)
    {
        $this->new = (boolean) $b;
    }

    /**
     * Whether this object has been deleted.
     * @return boolean The deleted state of this object.
     */
    public function isDeleted()
    {
        return $this->deleted;
    }

    /**
     * Specify whether this object has been deleted.
     * @param  boolean $b The deleted state of this object.
     * @return void
     */
    public function setDeleted($b)
    {
        $this->deleted = (boolean) $b;
    }

    /**
     * Sets the modified state for the object to be false.
     * @param  string $col If supplied, only the specified column is reset.
     * @return void
     */
    public function resetModified($col = null)
    {
        if (null !== $col) {
            if (isset($this->modifiedColumns[$col])) {
                unset($this->modifiedColumns[$col]);
            }
        } else {
            $this->modifiedColumns = array();
        }
    }

    /**
     * Compares this with another <code>Users</code> instance.  If
     * <code>obj</code> is an instance of <code>Users</code>, delegates to
     * <code>equals(Users)</code>.  Otherwise, returns <code>false</code>.
     *
     * @param  mixed   $obj The object to compare to.
     * @return boolean Whether equal to the object specified.
     */
    public function equals($obj)
    {
        if (!$obj instanceof static) {
            return false;
        }

        if ($this === $obj) {
            return true;
        }

        if (null === $this->getPrimaryKey() || null === $obj->getPrimaryKey()) {
            return false;
        }

        return $this->getPrimaryKey() === $obj->getPrimaryKey();
    }

    /**
     * Get the associative array of the virtual columns in this object
     *
     * @return array
     */
    public function getVirtualColumns()
    {
        return $this->virtualColumns;
    }

    /**
     * Checks the existence of a virtual column in this object
     *
     * @param  string  $name The virtual column name
     * @return boolean
     */
    public function hasVirtualColumn($name)
    {
        return array_key_exists($name, $this->virtualColumns);
    }

    /**
     * Get the value of a virtual column in this object
     *
     * @param  string $name The virtual column name
     * @return mixed
     *
     * @throws PropelException
     */
    public function getVirtualColumn($name)
    {
        if (!$this->hasVirtualColumn($name)) {
            throw new PropelException(sprintf('Cannot get value of inexistent virtual column %s.', $name));
        }

        return $this->virtualColumns[$name];
    }

    /**
     * Set the value of a virtual column in this object
     *
     * @param string $name  The virtual column name
     * @param mixed  $value The value to give to the virtual column
     *
     * @return $this|Users The current object, for fluid interface
     */
    public function setVirtualColumn($name, $value)
    {
        $this->virtualColumns[$name] = $value;

        return $this;
    }

    /**
     * Logs a message using Propel::log().
     *
     * @param  string  $msg
     * @param  int     $priority One of the Propel::LOG_* logging levels
     * @return boolean
     */
    protected function log($msg, $priority = Propel::LOG_INFO)
    {
        return Propel::log(get_class($this) . ': ' . $msg, $priority);
    }

    /**
     * Export the current object properties to a string, using a given parser format
     * <code>
     * $book = BookQuery::create()->findPk(9012);
     * echo $book->exportTo('JSON');
     *  => {"Id":9012,"Title":"Don Juan","ISBN":"0140422161","Price":12.99,"PublisherId":1234,"AuthorId":5678}');
     * </code>
     *
     * @param  mixed   $parser                 A AbstractParser instance, or a format name ('XML', 'YAML', 'JSON', 'CSV')
     * @param  boolean $includeLazyLoadColumns (optional) Whether to include lazy load(ed) columns. Defaults to TRUE.
     * @return string  The exported data
     */
    public function exportTo($parser, $includeLazyLoadColumns = true)
    {
        if (!$parser instanceof AbstractParser) {
            $parser = AbstractParser::getParser($parser);
        }

        return $parser->fromArray($this->toArray(TableMap::TYPE_PHPNAME, $includeLazyLoadColumns, array(), true));
    }

    /**
     * Clean up internal collections prior to serializing
     * Avoids recursive loops that turn into segmentation faults when serializing
     */
    public function __sleep()
    {
        $this->clearAllReferences();

        $cls = new \ReflectionClass($this);
        $propertyNames = [];
        $serializableProperties = array_diff($cls->getProperties(), $cls->getProperties(\ReflectionProperty::IS_STATIC));

        foreach($serializableProperties as $property) {
            $propertyNames[] = $property->getName();
        }

        return $propertyNames;
    }

    /**
     * Get the [email] column value.
     *
     * @return string
     */
    public function getEmail()
    {
        return $this->email;
    }

    /**
     * Get the [name] column value.
     *
     * @return string
     */
    public function getName()
    {
        return $this->name;
    }

    /**
     * Get the [password] column value.
     *
     * @return string
     */
    public function getPassword()
    {
        return $this->password;
    }

    /**
     * Set the value of [email] column.
     *
     * @param string $v new value
     * @return $this|\Users The current object (for fluent API support)
     */
    public function setEmail($v)
    {
        if ($v !== null) {
            $v = (string) $v;
        }

        if ($this->email !== $v) {
            $this->email = $v;
            $this->modifiedColumns[UsersTableMap::COL_EMAIL] = true;
        }

        return $this;
    } // setEmail()

    /**
     * Set the value of [name] column.
     *
     * @param string $v new value
     * @return $this|\Users The current object (for fluent API support)
     */
    public function setName($v)
    {
        if ($v !== null) {
            $v = (string) $v;
        }

        if ($this->name !== $v) {
            $this->name = $v;
            $this->modifiedColumns[UsersTableMap::COL_NAME] = true;
        }

        return $this;
    } // setName()

    /**
     * Set the value of [password] column.
     *
     * @param string $v new value
     * @return $this|\Users The current object (for fluent API support)
     */
    public function setPassword($v)
    {
        if ($v !== null) {
            $v = (string) $v;
        }

        if ($this->password !== $v) {
            $this->password = $v;
            $this->modifiedColumns[UsersTableMap::COL_PASSWORD] = true;
        }

        return $this;
    } // setPassword()

    /**
     * Indicates whether the columns in this object are only set to default values.
     *
     * This method can be used in conjunction with isModified() to indicate whether an object is both
     * modified _and_ has some values set which are non-default.
     *
     * @return boolean Whether the columns in this object are only been set with default values.
     */
    public function hasOnlyDefaultValues()
    {
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
     * @param array   $row       The row returned by DataFetcher->fetch().
     * @param int     $startcol  0-based offset column which indicates which restultset column to start with.
     * @param boolean $rehydrate Whether this object is being re-hydrated from the database.
     * @param string  $indexType The index type of $row. Mostly DataFetcher->getIndexType().
                                  One of the class type constants TableMap::TYPE_PHPNAME, TableMap::TYPE_CAMELNAME
     *                            TableMap::TYPE_COLNAME, TableMap::TYPE_FIELDNAME, TableMap::TYPE_NUM.
     *
     * @return int             next starting column
     * @throws PropelException - Any caught Exception will be rewrapped as a PropelException.
     */
    public function hydrate($row, $startcol = 0, $rehydrate = false, $indexType = TableMap::TYPE_NUM)
    {
        try {

            $col = $row[TableMap::TYPE_NUM == $indexType ? 0 + $startcol : UsersTableMap::translateFieldName('Email', TableMap::TYPE_PHPNAME, $indexType)];
            $this->email = (null !== $col) ? (string) $col : null;

            $col = $row[TableMap::TYPE_NUM == $indexType ? 1 + $startcol : UsersTableMap::translateFieldName('Name', TableMap::TYPE_PHPNAME, $indexType)];
            $this->name = (null !== $col) ? (string) $col : null;

            $col = $row[TableMap::TYPE_NUM == $indexType ? 2 + $startcol : UsersTableMap::translateFieldName('Password', TableMap::TYPE_PHPNAME, $indexType)];
            $this->password = (null !== $col) ? (string) $col : null;
            $this->resetModified();

            $this->setNew(false);

            if ($rehydrate) {
                $this->ensureConsistency();
            }

            return $startcol + 3; // 3 = UsersTableMap::NUM_HYDRATE_COLUMNS.

        } catch (Exception $e) {
            throw new PropelException(sprintf('Error populating %s object', '\\Users'), 0, $e);
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
     * @throws PropelException
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
     * @param      ConnectionInterface $con (optional) The ConnectionInterface connection to use.
     * @return void
     * @throws PropelException - if this object is deleted, unsaved or doesn't have pk match in db
     */
    public function reload($deep = false, ConnectionInterface $con = null)
    {
        if ($this->isDeleted()) {
            throw new PropelException("Cannot reload a deleted object.");
        }

        if ($this->isNew()) {
            throw new PropelException("Cannot reload an unsaved object.");
        }

        if ($con === null) {
            $con = Propel::getServiceContainer()->getReadConnection(UsersTableMap::DATABASE_NAME);
        }

        // We don't need to alter the object instance pool; we're just modifying this instance
        // already in the pool.

        $dataFetcher = ChildUsersQuery::create(null, $this->buildPkeyCriteria())->setFormatter(ModelCriteria::FORMAT_STATEMENT)->find($con);
        $row = $dataFetcher->fetch();
        $dataFetcher->close();
        if (!$row) {
            throw new PropelException('Cannot find matching row in the database to reload object values.');
        }
        $this->hydrate($row, 0, true, $dataFetcher->getIndexType()); // rehydrate

        if ($deep) {  // also de-associate any related objects?

            $this->collDebtsRelatedByCreditor = null;

            $this->collDebtsRelatedByDebtor = null;

            $this->collTransactionsRelatedByCreditor = null;

            $this->collTransactionsRelatedByDebtor = null;

        } // if (deep)
    }

    /**
     * Removes this object from datastore and sets delete attribute.
     *
     * @param      ConnectionInterface $con
     * @return void
     * @throws PropelException
     * @see Users::setDeleted()
     * @see Users::isDeleted()
     */
    public function delete(ConnectionInterface $con = null)
    {
        if ($this->isDeleted()) {
            throw new PropelException("This object has already been deleted.");
        }

        if ($con === null) {
            $con = Propel::getServiceContainer()->getWriteConnection(UsersTableMap::DATABASE_NAME);
        }

        $con->transaction(function () use ($con) {
            $deleteQuery = ChildUsersQuery::create()
                ->filterByPrimaryKey($this->getPrimaryKey());
            $ret = $this->preDelete($con);
            if ($ret) {
                $deleteQuery->delete($con);
                $this->postDelete($con);
                $this->setDeleted(true);
            }
        });
    }

    /**
     * Persists this object to the database.
     *
     * If the object is new, it inserts it; otherwise an update is performed.
     * All modified related objects will also be persisted in the doSave()
     * method.  This method wraps all precipitate database operations in a
     * single transaction.
     *
     * @param      ConnectionInterface $con
     * @return int             The number of rows affected by this insert/update and any referring fk objects' save() operations.
     * @throws PropelException
     * @see doSave()
     */
    public function save(ConnectionInterface $con = null)
    {
        if ($this->isDeleted()) {
            throw new PropelException("You cannot save an object that has been deleted.");
        }

        if ($con === null) {
            $con = Propel::getServiceContainer()->getWriteConnection(UsersTableMap::DATABASE_NAME);
        }

        return $con->transaction(function () use ($con) {
            $ret = $this->preSave($con);
            $isInsert = $this->isNew();
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
                UsersTableMap::addInstanceToPool($this);
            } else {
                $affectedRows = 0;
            }

            return $affectedRows;
        });
    }

    /**
     * Performs the work of inserting or updating the row in the database.
     *
     * If the object is new, it inserts it; otherwise an update is performed.
     * All related objects are also updated in this method.
     *
     * @param      ConnectionInterface $con
     * @return int             The number of rows affected by this insert/update and any referring fk objects' save() operations.
     * @throws PropelException
     * @see save()
     */
    protected function doSave(ConnectionInterface $con)
    {
        $affectedRows = 0; // initialize var to track total num of affected rows
        if (!$this->alreadyInSave) {
            $this->alreadyInSave = true;

            if ($this->isNew() || $this->isModified()) {
                // persist changes
                if ($this->isNew()) {
                    $this->doInsert($con);
                    $affectedRows += 1;
                } else {
                    $affectedRows += $this->doUpdate($con);
                }
                $this->resetModified();
            }

            if ($this->debtsRelatedByCreditorScheduledForDeletion !== null) {
                if (!$this->debtsRelatedByCreditorScheduledForDeletion->isEmpty()) {
                    \DebtQuery::create()
                        ->filterByPrimaryKeys($this->debtsRelatedByCreditorScheduledForDeletion->getPrimaryKeys(false))
                        ->delete($con);
                    $this->debtsRelatedByCreditorScheduledForDeletion = null;
                }
            }

            if ($this->collDebtsRelatedByCreditor !== null) {
                foreach ($this->collDebtsRelatedByCreditor as $referrerFK) {
                    if (!$referrerFK->isDeleted() && ($referrerFK->isNew() || $referrerFK->isModified())) {
                        $affectedRows += $referrerFK->save($con);
                    }
                }
            }

            if ($this->debtsRelatedByDebtorScheduledForDeletion !== null) {
                if (!$this->debtsRelatedByDebtorScheduledForDeletion->isEmpty()) {
                    \DebtQuery::create()
                        ->filterByPrimaryKeys($this->debtsRelatedByDebtorScheduledForDeletion->getPrimaryKeys(false))
                        ->delete($con);
                    $this->debtsRelatedByDebtorScheduledForDeletion = null;
                }
            }

            if ($this->collDebtsRelatedByDebtor !== null) {
                foreach ($this->collDebtsRelatedByDebtor as $referrerFK) {
                    if (!$referrerFK->isDeleted() && ($referrerFK->isNew() || $referrerFK->isModified())) {
                        $affectedRows += $referrerFK->save($con);
                    }
                }
            }

            if ($this->transactionsRelatedByCreditorScheduledForDeletion !== null) {
                if (!$this->transactionsRelatedByCreditorScheduledForDeletion->isEmpty()) {
                    \TransactionQuery::create()
                        ->filterByPrimaryKeys($this->transactionsRelatedByCreditorScheduledForDeletion->getPrimaryKeys(false))
                        ->delete($con);
                    $this->transactionsRelatedByCreditorScheduledForDeletion = null;
                }
            }

            if ($this->collTransactionsRelatedByCreditor !== null) {
                foreach ($this->collTransactionsRelatedByCreditor as $referrerFK) {
                    if (!$referrerFK->isDeleted() && ($referrerFK->isNew() || $referrerFK->isModified())) {
                        $affectedRows += $referrerFK->save($con);
                    }
                }
            }

            if ($this->transactionsRelatedByDebtorScheduledForDeletion !== null) {
                if (!$this->transactionsRelatedByDebtorScheduledForDeletion->isEmpty()) {
                    \TransactionQuery::create()
                        ->filterByPrimaryKeys($this->transactionsRelatedByDebtorScheduledForDeletion->getPrimaryKeys(false))
                        ->delete($con);
                    $this->transactionsRelatedByDebtorScheduledForDeletion = null;
                }
            }

            if ($this->collTransactionsRelatedByDebtor !== null) {
                foreach ($this->collTransactionsRelatedByDebtor as $referrerFK) {
                    if (!$referrerFK->isDeleted() && ($referrerFK->isNew() || $referrerFK->isModified())) {
                        $affectedRows += $referrerFK->save($con);
                    }
                }
            }

            $this->alreadyInSave = false;

        }

        return $affectedRows;
    } // doSave()

    /**
     * Insert the row in the database.
     *
     * @param      ConnectionInterface $con
     *
     * @throws PropelException
     * @see doSave()
     */
    protected function doInsert(ConnectionInterface $con)
    {
        $modifiedColumns = array();
        $index = 0;


         // check the columns in natural order for more readable SQL queries
        if ($this->isColumnModified(UsersTableMap::COL_EMAIL)) {
            $modifiedColumns[':p' . $index++]  = 'email';
        }
        if ($this->isColumnModified(UsersTableMap::COL_NAME)) {
            $modifiedColumns[':p' . $index++]  = 'name';
        }
        if ($this->isColumnModified(UsersTableMap::COL_PASSWORD)) {
            $modifiedColumns[':p' . $index++]  = 'password';
        }

        $sql = sprintf(
            'INSERT INTO Users (%s) VALUES (%s)',
            implode(', ', $modifiedColumns),
            implode(', ', array_keys($modifiedColumns))
        );

        try {
            $stmt = $con->prepare($sql);
            foreach ($modifiedColumns as $identifier => $columnName) {
                switch ($columnName) {
                    case 'email':
                        $stmt->bindValue($identifier, $this->email, PDO::PARAM_STR);
                        break;
                    case 'name':
                        $stmt->bindValue($identifier, $this->name, PDO::PARAM_STR);
                        break;
                    case 'password':
                        $stmt->bindValue($identifier, $this->password, PDO::PARAM_STR);
                        break;
                }
            }
            $stmt->execute();
        } catch (Exception $e) {
            Propel::log($e->getMessage(), Propel::LOG_ERR);
            throw new PropelException(sprintf('Unable to execute INSERT statement [%s]', $sql), 0, $e);
        }

        $this->setNew(false);
    }

    /**
     * Update the row in the database.
     *
     * @param      ConnectionInterface $con
     *
     * @return Integer Number of updated rows
     * @see doSave()
     */
    protected function doUpdate(ConnectionInterface $con)
    {
        $selectCriteria = $this->buildPkeyCriteria();
        $valuesCriteria = $this->buildCriteria();

        return $selectCriteria->doUpdate($valuesCriteria, $con);
    }

    /**
     * Retrieves a field from the object by name passed in as a string.
     *
     * @param      string $name name
     * @param      string $type The type of fieldname the $name is of:
     *                     one of the class type constants TableMap::TYPE_PHPNAME, TableMap::TYPE_CAMELNAME
     *                     TableMap::TYPE_COLNAME, TableMap::TYPE_FIELDNAME, TableMap::TYPE_NUM.
     *                     Defaults to TableMap::TYPE_PHPNAME.
     * @return mixed Value of field.
     */
    public function getByName($name, $type = TableMap::TYPE_PHPNAME)
    {
        $pos = UsersTableMap::translateFieldName($name, $type, TableMap::TYPE_NUM);
        $field = $this->getByPosition($pos);

        return $field;
    }

    /**
     * Retrieves a field from the object by Position as specified in the xml schema.
     * Zero-based.
     *
     * @param      int $pos position in xml schema
     * @return mixed Value of field at $pos
     */
    public function getByPosition($pos)
    {
        switch ($pos) {
            case 0:
                return $this->getEmail();
                break;
            case 1:
                return $this->getName();
                break;
            case 2:
                return $this->getPassword();
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
     * @param     string  $keyType (optional) One of the class type constants TableMap::TYPE_PHPNAME, TableMap::TYPE_CAMELNAME,
     *                    TableMap::TYPE_COLNAME, TableMap::TYPE_FIELDNAME, TableMap::TYPE_NUM.
     *                    Defaults to TableMap::TYPE_PHPNAME.
     * @param     boolean $includeLazyLoadColumns (optional) Whether to include lazy loaded columns. Defaults to TRUE.
     * @param     array $alreadyDumpedObjects List of objects to skip to avoid recursion
     * @param     boolean $includeForeignObjects (optional) Whether to include hydrated related objects. Default to FALSE.
     *
     * @return array an associative array containing the field names (as keys) and field values
     */
    public function toArray($keyType = TableMap::TYPE_PHPNAME, $includeLazyLoadColumns = true, $alreadyDumpedObjects = array(), $includeForeignObjects = false)
    {

        if (isset($alreadyDumpedObjects['Users'][$this->hashCode()])) {
            return '*RECURSION*';
        }
        $alreadyDumpedObjects['Users'][$this->hashCode()] = true;
        $keys = UsersTableMap::getFieldNames($keyType);
        $result = array(
            $keys[0] => $this->getEmail(),
            $keys[1] => $this->getName(),
            $keys[2] => $this->getPassword(),
        );
        $virtualColumns = $this->virtualColumns;
        foreach ($virtualColumns as $key => $virtualColumn) {
            $result[$key] = $virtualColumn;
        }

        if ($includeForeignObjects) {
            if (null !== $this->collDebtsRelatedByCreditor) {

                switch ($keyType) {
                    case TableMap::TYPE_CAMELNAME:
                        $key = 'debts';
                        break;
                    case TableMap::TYPE_FIELDNAME:
                        $key = 'Debts';
                        break;
                    default:
                        $key = 'Debts';
                }

                $result[$key] = $this->collDebtsRelatedByCreditor->toArray(null, false, $keyType, $includeLazyLoadColumns, $alreadyDumpedObjects);
            }
            if (null !== $this->collDebtsRelatedByDebtor) {

                switch ($keyType) {
                    case TableMap::TYPE_CAMELNAME:
                        $key = 'debts';
                        break;
                    case TableMap::TYPE_FIELDNAME:
                        $key = 'Debts';
                        break;
                    default:
                        $key = 'Debts';
                }

                $result[$key] = $this->collDebtsRelatedByDebtor->toArray(null, false, $keyType, $includeLazyLoadColumns, $alreadyDumpedObjects);
            }
            if (null !== $this->collTransactionsRelatedByCreditor) {

                switch ($keyType) {
                    case TableMap::TYPE_CAMELNAME:
                        $key = 'transactions';
                        break;
                    case TableMap::TYPE_FIELDNAME:
                        $key = 'Transactions';
                        break;
                    default:
                        $key = 'Transactions';
                }

                $result[$key] = $this->collTransactionsRelatedByCreditor->toArray(null, false, $keyType, $includeLazyLoadColumns, $alreadyDumpedObjects);
            }
            if (null !== $this->collTransactionsRelatedByDebtor) {

                switch ($keyType) {
                    case TableMap::TYPE_CAMELNAME:
                        $key = 'transactions';
                        break;
                    case TableMap::TYPE_FIELDNAME:
                        $key = 'Transactions';
                        break;
                    default:
                        $key = 'Transactions';
                }

                $result[$key] = $this->collTransactionsRelatedByDebtor->toArray(null, false, $keyType, $includeLazyLoadColumns, $alreadyDumpedObjects);
            }
        }

        return $result;
    }

    /**
     * Sets a field from the object by name passed in as a string.
     *
     * @param  string $name
     * @param  mixed  $value field value
     * @param  string $type The type of fieldname the $name is of:
     *                one of the class type constants TableMap::TYPE_PHPNAME, TableMap::TYPE_CAMELNAME
     *                TableMap::TYPE_COLNAME, TableMap::TYPE_FIELDNAME, TableMap::TYPE_NUM.
     *                Defaults to TableMap::TYPE_PHPNAME.
     * @return $this|\Users
     */
    public function setByName($name, $value, $type = TableMap::TYPE_PHPNAME)
    {
        $pos = UsersTableMap::translateFieldName($name, $type, TableMap::TYPE_NUM);

        return $this->setByPosition($pos, $value);
    }

    /**
     * Sets a field from the object by Position as specified in the xml schema.
     * Zero-based.
     *
     * @param  int $pos position in xml schema
     * @param  mixed $value field value
     * @return $this|\Users
     */
    public function setByPosition($pos, $value)
    {
        switch ($pos) {
            case 0:
                $this->setEmail($value);
                break;
            case 1:
                $this->setName($value);
                break;
            case 2:
                $this->setPassword($value);
                break;
        } // switch()

        return $this;
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
     * of the class type constants TableMap::TYPE_PHPNAME, TableMap::TYPE_CAMELNAME,
     * TableMap::TYPE_COLNAME, TableMap::TYPE_FIELDNAME, TableMap::TYPE_NUM.
     * The default key type is the column's TableMap::TYPE_PHPNAME.
     *
     * @param      array  $arr     An array to populate the object from.
     * @param      string $keyType The type of keys the array uses.
     * @return void
     */
    public function fromArray($arr, $keyType = TableMap::TYPE_PHPNAME)
    {
        $keys = UsersTableMap::getFieldNames($keyType);

        if (array_key_exists($keys[0], $arr)) {
            $this->setEmail($arr[$keys[0]]);
        }
        if (array_key_exists($keys[1], $arr)) {
            $this->setName($arr[$keys[1]]);
        }
        if (array_key_exists($keys[2], $arr)) {
            $this->setPassword($arr[$keys[2]]);
        }
    }

     /**
     * Populate the current object from a string, using a given parser format
     * <code>
     * $book = new Book();
     * $book->importFrom('JSON', '{"Id":9012,"Title":"Don Juan","ISBN":"0140422161","Price":12.99,"PublisherId":1234,"AuthorId":5678}');
     * </code>
     *
     * You can specify the key type of the array by additionally passing one
     * of the class type constants TableMap::TYPE_PHPNAME, TableMap::TYPE_CAMELNAME,
     * TableMap::TYPE_COLNAME, TableMap::TYPE_FIELDNAME, TableMap::TYPE_NUM.
     * The default key type is the column's TableMap::TYPE_PHPNAME.
     *
     * @param mixed $parser A AbstractParser instance,
     *                       or a format name ('XML', 'YAML', 'JSON', 'CSV')
     * @param string $data The source data to import from
     * @param string $keyType The type of keys the array uses.
     *
     * @return $this|\Users The current object, for fluid interface
     */
    public function importFrom($parser, $data, $keyType = TableMap::TYPE_PHPNAME)
    {
        if (!$parser instanceof AbstractParser) {
            $parser = AbstractParser::getParser($parser);
        }

        $this->fromArray($parser->toArray($data), $keyType);

        return $this;
    }

    /**
     * Build a Criteria object containing the values of all modified columns in this object.
     *
     * @return Criteria The Criteria object containing all modified values.
     */
    public function buildCriteria()
    {
        $criteria = new Criteria(UsersTableMap::DATABASE_NAME);

        if ($this->isColumnModified(UsersTableMap::COL_EMAIL)) {
            $criteria->add(UsersTableMap::COL_EMAIL, $this->email);
        }
        if ($this->isColumnModified(UsersTableMap::COL_NAME)) {
            $criteria->add(UsersTableMap::COL_NAME, $this->name);
        }
        if ($this->isColumnModified(UsersTableMap::COL_PASSWORD)) {
            $criteria->add(UsersTableMap::COL_PASSWORD, $this->password);
        }

        return $criteria;
    }

    /**
     * Builds a Criteria object containing the primary key for this object.
     *
     * Unlike buildCriteria() this method includes the primary key values regardless
     * of whether or not they have been modified.
     *
     * @throws LogicException if no primary key is defined
     *
     * @return Criteria The Criteria object containing value(s) for primary key(s).
     */
    public function buildPkeyCriteria()
    {
        $criteria = ChildUsersQuery::create();
        $criteria->add(UsersTableMap::COL_EMAIL, $this->email);

        return $criteria;
    }

    /**
     * If the primary key is not null, return the hashcode of the
     * primary key. Otherwise, return the hash code of the object.
     *
     * @return int Hashcode
     */
    public function hashCode()
    {
        $validPk = null !== $this->getEmail();

        $validPrimaryKeyFKs = 0;
        $primaryKeyFKs = [];

        if ($validPk) {
            return crc32(json_encode($this->getPrimaryKey(), JSON_UNESCAPED_UNICODE));
        } elseif ($validPrimaryKeyFKs) {
            return crc32(json_encode($primaryKeyFKs, JSON_UNESCAPED_UNICODE));
        }

        return spl_object_hash($this);
    }

    /**
     * Returns the primary key for this object (row).
     * @return string
     */
    public function getPrimaryKey()
    {
        return $this->getEmail();
    }

    /**
     * Generic method to set the primary key (email column).
     *
     * @param       string $key Primary key.
     * @return void
     */
    public function setPrimaryKey($key)
    {
        $this->setEmail($key);
    }

    /**
     * Returns true if the primary key for this object is null.
     * @return boolean
     */
    public function isPrimaryKeyNull()
    {
        return null === $this->getEmail();
    }

    /**
     * Sets contents of passed object to values from current object.
     *
     * If desired, this method can also make copies of all associated (fkey referrers)
     * objects.
     *
     * @param      object $copyObj An object of \Users (or compatible) type.
     * @param      boolean $deepCopy Whether to also copy all rows that refer (by fkey) to the current row.
     * @param      boolean $makeNew Whether to reset autoincrement PKs and make the object new.
     * @throws PropelException
     */
    public function copyInto($copyObj, $deepCopy = false, $makeNew = true)
    {
        $copyObj->setEmail($this->getEmail());
        $copyObj->setName($this->getName());
        $copyObj->setPassword($this->getPassword());

        if ($deepCopy) {
            // important: temporarily setNew(false) because this affects the behavior of
            // the getter/setter methods for fkey referrer objects.
            $copyObj->setNew(false);

            foreach ($this->getDebtsRelatedByCreditor() as $relObj) {
                if ($relObj !== $this) {  // ensure that we don't try to copy a reference to ourselves
                    $copyObj->addDebtRelatedByCreditor($relObj->copy($deepCopy));
                }
            }

            foreach ($this->getDebtsRelatedByDebtor() as $relObj) {
                if ($relObj !== $this) {  // ensure that we don't try to copy a reference to ourselves
                    $copyObj->addDebtRelatedByDebtor($relObj->copy($deepCopy));
                }
            }

            foreach ($this->getTransactionsRelatedByCreditor() as $relObj) {
                if ($relObj !== $this) {  // ensure that we don't try to copy a reference to ourselves
                    $copyObj->addTransactionRelatedByCreditor($relObj->copy($deepCopy));
                }
            }

            foreach ($this->getTransactionsRelatedByDebtor() as $relObj) {
                if ($relObj !== $this) {  // ensure that we don't try to copy a reference to ourselves
                    $copyObj->addTransactionRelatedByDebtor($relObj->copy($deepCopy));
                }
            }

        } // if ($deepCopy)

        if ($makeNew) {
            $copyObj->setNew(true);
        }
    }

    /**
     * Makes a copy of this object that will be inserted as a new row in table when saved.
     * It creates a new object filling in the simple attributes, but skipping any primary
     * keys that are defined for the table.
     *
     * If desired, this method can also make copies of all associated (fkey referrers)
     * objects.
     *
     * @param  boolean $deepCopy Whether to also copy all rows that refer (by fkey) to the current row.
     * @return \Users Clone of current object.
     * @throws PropelException
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
     * Initializes a collection based on the name of a relation.
     * Avoids crafting an 'init[$relationName]s' method name
     * that wouldn't work when StandardEnglishPluralizer is used.
     *
     * @param      string $relationName The name of the relation to initialize
     * @return void
     */
    public function initRelation($relationName)
    {
        if ('DebtRelatedByCreditor' == $relationName) {
            return $this->initDebtsRelatedByCreditor();
        }
        if ('DebtRelatedByDebtor' == $relationName) {
            return $this->initDebtsRelatedByDebtor();
        }
        if ('TransactionRelatedByCreditor' == $relationName) {
            return $this->initTransactionsRelatedByCreditor();
        }
        if ('TransactionRelatedByDebtor' == $relationName) {
            return $this->initTransactionsRelatedByDebtor();
        }
    }

    /**
     * Clears out the collDebtsRelatedByCreditor collection
     *
     * This does not modify the database; however, it will remove any associated objects, causing
     * them to be refetched by subsequent calls to accessor method.
     *
     * @return void
     * @see        addDebtsRelatedByCreditor()
     */
    public function clearDebtsRelatedByCreditor()
    {
        $this->collDebtsRelatedByCreditor = null; // important to set this to NULL since that means it is uninitialized
    }

    /**
     * Reset is the collDebtsRelatedByCreditor collection loaded partially.
     */
    public function resetPartialDebtsRelatedByCreditor($v = true)
    {
        $this->collDebtsRelatedByCreditorPartial = $v;
    }

    /**
     * Initializes the collDebtsRelatedByCreditor collection.
     *
     * By default this just sets the collDebtsRelatedByCreditor collection to an empty array (like clearcollDebtsRelatedByCreditor());
     * however, you may wish to override this method in your stub class to provide setting appropriate
     * to your application -- for example, setting the initial array to the values stored in database.
     *
     * @param      boolean $overrideExisting If set to true, the method call initializes
     *                                        the collection even if it is not empty
     *
     * @return void
     */
    public function initDebtsRelatedByCreditor($overrideExisting = true)
    {
        if (null !== $this->collDebtsRelatedByCreditor && !$overrideExisting) {
            return;
        }

        $collectionClassName = DebtTableMap::getTableMap()->getCollectionClassName();

        $this->collDebtsRelatedByCreditor = new $collectionClassName;
        $this->collDebtsRelatedByCreditor->setModel('\Debt');
    }

    /**
     * Gets an array of ChildDebt objects which contain a foreign key that references this object.
     *
     * If the $criteria is not null, it is used to always fetch the results from the database.
     * Otherwise the results are fetched from the database the first time, then cached.
     * Next time the same method is called without $criteria, the cached collection is returned.
     * If this ChildUsers is new, it will return
     * an empty collection or the current collection; the criteria is ignored on a new object.
     *
     * @param      Criteria $criteria optional Criteria object to narrow the query
     * @param      ConnectionInterface $con optional connection object
     * @return ObjectCollection|ChildDebt[] List of ChildDebt objects
     * @throws PropelException
     */
    public function getDebtsRelatedByCreditor(Criteria $criteria = null, ConnectionInterface $con = null)
    {
        $partial = $this->collDebtsRelatedByCreditorPartial && !$this->isNew();
        if (null === $this->collDebtsRelatedByCreditor || null !== $criteria  || $partial) {
            if ($this->isNew() && null === $this->collDebtsRelatedByCreditor) {
                // return empty collection
                $this->initDebtsRelatedByCreditor();
            } else {
                $collDebtsRelatedByCreditor = ChildDebtQuery::create(null, $criteria)
                    ->filterByDebt_Creditor($this)
                    ->find($con);

                if (null !== $criteria) {
                    if (false !== $this->collDebtsRelatedByCreditorPartial && count($collDebtsRelatedByCreditor)) {
                        $this->initDebtsRelatedByCreditor(false);

                        foreach ($collDebtsRelatedByCreditor as $obj) {
                            if (false == $this->collDebtsRelatedByCreditor->contains($obj)) {
                                $this->collDebtsRelatedByCreditor->append($obj);
                            }
                        }

                        $this->collDebtsRelatedByCreditorPartial = true;
                    }

                    return $collDebtsRelatedByCreditor;
                }

                if ($partial && $this->collDebtsRelatedByCreditor) {
                    foreach ($this->collDebtsRelatedByCreditor as $obj) {
                        if ($obj->isNew()) {
                            $collDebtsRelatedByCreditor[] = $obj;
                        }
                    }
                }

                $this->collDebtsRelatedByCreditor = $collDebtsRelatedByCreditor;
                $this->collDebtsRelatedByCreditorPartial = false;
            }
        }

        return $this->collDebtsRelatedByCreditor;
    }

    /**
     * Sets a collection of ChildDebt objects related by a one-to-many relationship
     * to the current object.
     * It will also schedule objects for deletion based on a diff between old objects (aka persisted)
     * and new objects from the given Propel collection.
     *
     * @param      Collection $debtsRelatedByCreditor A Propel collection.
     * @param      ConnectionInterface $con Optional connection object
     * @return $this|ChildUsers The current object (for fluent API support)
     */
    public function setDebtsRelatedByCreditor(Collection $debtsRelatedByCreditor, ConnectionInterface $con = null)
    {
        /** @var ChildDebt[] $debtsRelatedByCreditorToDelete */
        $debtsRelatedByCreditorToDelete = $this->getDebtsRelatedByCreditor(new Criteria(), $con)->diff($debtsRelatedByCreditor);


        //since at least one column in the foreign key is at the same time a PK
        //we can not just set a PK to NULL in the lines below. We have to store
        //a backup of all values, so we are able to manipulate these items based on the onDelete value later.
        $this->debtsRelatedByCreditorScheduledForDeletion = clone $debtsRelatedByCreditorToDelete;

        foreach ($debtsRelatedByCreditorToDelete as $debtRelatedByCreditorRemoved) {
            $debtRelatedByCreditorRemoved->setDebt_Creditor(null);
        }

        $this->collDebtsRelatedByCreditor = null;
        foreach ($debtsRelatedByCreditor as $debtRelatedByCreditor) {
            $this->addDebtRelatedByCreditor($debtRelatedByCreditor);
        }

        $this->collDebtsRelatedByCreditor = $debtsRelatedByCreditor;
        $this->collDebtsRelatedByCreditorPartial = false;

        return $this;
    }

    /**
     * Returns the number of related Debt objects.
     *
     * @param      Criteria $criteria
     * @param      boolean $distinct
     * @param      ConnectionInterface $con
     * @return int             Count of related Debt objects.
     * @throws PropelException
     */
    public function countDebtsRelatedByCreditor(Criteria $criteria = null, $distinct = false, ConnectionInterface $con = null)
    {
        $partial = $this->collDebtsRelatedByCreditorPartial && !$this->isNew();
        if (null === $this->collDebtsRelatedByCreditor || null !== $criteria || $partial) {
            if ($this->isNew() && null === $this->collDebtsRelatedByCreditor) {
                return 0;
            }

            if ($partial && !$criteria) {
                return count($this->getDebtsRelatedByCreditor());
            }

            $query = ChildDebtQuery::create(null, $criteria);
            if ($distinct) {
                $query->distinct();
            }

            return $query
                ->filterByDebt_Creditor($this)
                ->count($con);
        }

        return count($this->collDebtsRelatedByCreditor);
    }

    /**
     * Method called to associate a ChildDebt object to this object
     * through the ChildDebt foreign key attribute.
     *
     * @param  ChildDebt $l ChildDebt
     * @return $this|\Users The current object (for fluent API support)
     */
    public function addDebtRelatedByCreditor(ChildDebt $l)
    {
        if ($this->collDebtsRelatedByCreditor === null) {
            $this->initDebtsRelatedByCreditor();
            $this->collDebtsRelatedByCreditorPartial = true;
        }

        if (!$this->collDebtsRelatedByCreditor->contains($l)) {
            $this->doAddDebtRelatedByCreditor($l);

            if ($this->debtsRelatedByCreditorScheduledForDeletion and $this->debtsRelatedByCreditorScheduledForDeletion->contains($l)) {
                $this->debtsRelatedByCreditorScheduledForDeletion->remove($this->debtsRelatedByCreditorScheduledForDeletion->search($l));
            }
        }

        return $this;
    }

    /**
     * @param ChildDebt $debtRelatedByCreditor The ChildDebt object to add.
     */
    protected function doAddDebtRelatedByCreditor(ChildDebt $debtRelatedByCreditor)
    {
        $this->collDebtsRelatedByCreditor[]= $debtRelatedByCreditor;
        $debtRelatedByCreditor->setDebt_Creditor($this);
    }

    /**
     * @param  ChildDebt $debtRelatedByCreditor The ChildDebt object to remove.
     * @return $this|ChildUsers The current object (for fluent API support)
     */
    public function removeDebtRelatedByCreditor(ChildDebt $debtRelatedByCreditor)
    {
        if ($this->getDebtsRelatedByCreditor()->contains($debtRelatedByCreditor)) {
            $pos = $this->collDebtsRelatedByCreditor->search($debtRelatedByCreditor);
            $this->collDebtsRelatedByCreditor->remove($pos);
            if (null === $this->debtsRelatedByCreditorScheduledForDeletion) {
                $this->debtsRelatedByCreditorScheduledForDeletion = clone $this->collDebtsRelatedByCreditor;
                $this->debtsRelatedByCreditorScheduledForDeletion->clear();
            }
            $this->debtsRelatedByCreditorScheduledForDeletion[]= clone $debtRelatedByCreditor;
            $debtRelatedByCreditor->setDebt_Creditor(null);
        }

        return $this;
    }

    /**
     * Clears out the collDebtsRelatedByDebtor collection
     *
     * This does not modify the database; however, it will remove any associated objects, causing
     * them to be refetched by subsequent calls to accessor method.
     *
     * @return void
     * @see        addDebtsRelatedByDebtor()
     */
    public function clearDebtsRelatedByDebtor()
    {
        $this->collDebtsRelatedByDebtor = null; // important to set this to NULL since that means it is uninitialized
    }

    /**
     * Reset is the collDebtsRelatedByDebtor collection loaded partially.
     */
    public function resetPartialDebtsRelatedByDebtor($v = true)
    {
        $this->collDebtsRelatedByDebtorPartial = $v;
    }

    /**
     * Initializes the collDebtsRelatedByDebtor collection.
     *
     * By default this just sets the collDebtsRelatedByDebtor collection to an empty array (like clearcollDebtsRelatedByDebtor());
     * however, you may wish to override this method in your stub class to provide setting appropriate
     * to your application -- for example, setting the initial array to the values stored in database.
     *
     * @param      boolean $overrideExisting If set to true, the method call initializes
     *                                        the collection even if it is not empty
     *
     * @return void
     */
    public function initDebtsRelatedByDebtor($overrideExisting = true)
    {
        if (null !== $this->collDebtsRelatedByDebtor && !$overrideExisting) {
            return;
        }

        $collectionClassName = DebtTableMap::getTableMap()->getCollectionClassName();

        $this->collDebtsRelatedByDebtor = new $collectionClassName;
        $this->collDebtsRelatedByDebtor->setModel('\Debt');
    }

    /**
     * Gets an array of ChildDebt objects which contain a foreign key that references this object.
     *
     * If the $criteria is not null, it is used to always fetch the results from the database.
     * Otherwise the results are fetched from the database the first time, then cached.
     * Next time the same method is called without $criteria, the cached collection is returned.
     * If this ChildUsers is new, it will return
     * an empty collection or the current collection; the criteria is ignored on a new object.
     *
     * @param      Criteria $criteria optional Criteria object to narrow the query
     * @param      ConnectionInterface $con optional connection object
     * @return ObjectCollection|ChildDebt[] List of ChildDebt objects
     * @throws PropelException
     */
    public function getDebtsRelatedByDebtor(Criteria $criteria = null, ConnectionInterface $con = null)
    {
        $partial = $this->collDebtsRelatedByDebtorPartial && !$this->isNew();
        if (null === $this->collDebtsRelatedByDebtor || null !== $criteria  || $partial) {
            if ($this->isNew() && null === $this->collDebtsRelatedByDebtor) {
                // return empty collection
                $this->initDebtsRelatedByDebtor();
            } else {
                $collDebtsRelatedByDebtor = ChildDebtQuery::create(null, $criteria)
                    ->filterByDebt_Debtor($this)
                    ->find($con);

                if (null !== $criteria) {
                    if (false !== $this->collDebtsRelatedByDebtorPartial && count($collDebtsRelatedByDebtor)) {
                        $this->initDebtsRelatedByDebtor(false);

                        foreach ($collDebtsRelatedByDebtor as $obj) {
                            if (false == $this->collDebtsRelatedByDebtor->contains($obj)) {
                                $this->collDebtsRelatedByDebtor->append($obj);
                            }
                        }

                        $this->collDebtsRelatedByDebtorPartial = true;
                    }

                    return $collDebtsRelatedByDebtor;
                }

                if ($partial && $this->collDebtsRelatedByDebtor) {
                    foreach ($this->collDebtsRelatedByDebtor as $obj) {
                        if ($obj->isNew()) {
                            $collDebtsRelatedByDebtor[] = $obj;
                        }
                    }
                }

                $this->collDebtsRelatedByDebtor = $collDebtsRelatedByDebtor;
                $this->collDebtsRelatedByDebtorPartial = false;
            }
        }

        return $this->collDebtsRelatedByDebtor;
    }

    /**
     * Sets a collection of ChildDebt objects related by a one-to-many relationship
     * to the current object.
     * It will also schedule objects for deletion based on a diff between old objects (aka persisted)
     * and new objects from the given Propel collection.
     *
     * @param      Collection $debtsRelatedByDebtor A Propel collection.
     * @param      ConnectionInterface $con Optional connection object
     * @return $this|ChildUsers The current object (for fluent API support)
     */
    public function setDebtsRelatedByDebtor(Collection $debtsRelatedByDebtor, ConnectionInterface $con = null)
    {
        /** @var ChildDebt[] $debtsRelatedByDebtorToDelete */
        $debtsRelatedByDebtorToDelete = $this->getDebtsRelatedByDebtor(new Criteria(), $con)->diff($debtsRelatedByDebtor);


        //since at least one column in the foreign key is at the same time a PK
        //we can not just set a PK to NULL in the lines below. We have to store
        //a backup of all values, so we are able to manipulate these items based on the onDelete value later.
        $this->debtsRelatedByDebtorScheduledForDeletion = clone $debtsRelatedByDebtorToDelete;

        foreach ($debtsRelatedByDebtorToDelete as $debtRelatedByDebtorRemoved) {
            $debtRelatedByDebtorRemoved->setDebt_Debtor(null);
        }

        $this->collDebtsRelatedByDebtor = null;
        foreach ($debtsRelatedByDebtor as $debtRelatedByDebtor) {
            $this->addDebtRelatedByDebtor($debtRelatedByDebtor);
        }

        $this->collDebtsRelatedByDebtor = $debtsRelatedByDebtor;
        $this->collDebtsRelatedByDebtorPartial = false;

        return $this;
    }

    /**
     * Returns the number of related Debt objects.
     *
     * @param      Criteria $criteria
     * @param      boolean $distinct
     * @param      ConnectionInterface $con
     * @return int             Count of related Debt objects.
     * @throws PropelException
     */
    public function countDebtsRelatedByDebtor(Criteria $criteria = null, $distinct = false, ConnectionInterface $con = null)
    {
        $partial = $this->collDebtsRelatedByDebtorPartial && !$this->isNew();
        if (null === $this->collDebtsRelatedByDebtor || null !== $criteria || $partial) {
            if ($this->isNew() && null === $this->collDebtsRelatedByDebtor) {
                return 0;
            }

            if ($partial && !$criteria) {
                return count($this->getDebtsRelatedByDebtor());
            }

            $query = ChildDebtQuery::create(null, $criteria);
            if ($distinct) {
                $query->distinct();
            }

            return $query
                ->filterByDebt_Debtor($this)
                ->count($con);
        }

        return count($this->collDebtsRelatedByDebtor);
    }

    /**
     * Method called to associate a ChildDebt object to this object
     * through the ChildDebt foreign key attribute.
     *
     * @param  ChildDebt $l ChildDebt
     * @return $this|\Users The current object (for fluent API support)
     */
    public function addDebtRelatedByDebtor(ChildDebt $l)
    {
        if ($this->collDebtsRelatedByDebtor === null) {
            $this->initDebtsRelatedByDebtor();
            $this->collDebtsRelatedByDebtorPartial = true;
        }

        if (!$this->collDebtsRelatedByDebtor->contains($l)) {
            $this->doAddDebtRelatedByDebtor($l);

            if ($this->debtsRelatedByDebtorScheduledForDeletion and $this->debtsRelatedByDebtorScheduledForDeletion->contains($l)) {
                $this->debtsRelatedByDebtorScheduledForDeletion->remove($this->debtsRelatedByDebtorScheduledForDeletion->search($l));
            }
        }

        return $this;
    }

    /**
     * @param ChildDebt $debtRelatedByDebtor The ChildDebt object to add.
     */
    protected function doAddDebtRelatedByDebtor(ChildDebt $debtRelatedByDebtor)
    {
        $this->collDebtsRelatedByDebtor[]= $debtRelatedByDebtor;
        $debtRelatedByDebtor->setDebt_Debtor($this);
    }

    /**
     * @param  ChildDebt $debtRelatedByDebtor The ChildDebt object to remove.
     * @return $this|ChildUsers The current object (for fluent API support)
     */
    public function removeDebtRelatedByDebtor(ChildDebt $debtRelatedByDebtor)
    {
        if ($this->getDebtsRelatedByDebtor()->contains($debtRelatedByDebtor)) {
            $pos = $this->collDebtsRelatedByDebtor->search($debtRelatedByDebtor);
            $this->collDebtsRelatedByDebtor->remove($pos);
            if (null === $this->debtsRelatedByDebtorScheduledForDeletion) {
                $this->debtsRelatedByDebtorScheduledForDeletion = clone $this->collDebtsRelatedByDebtor;
                $this->debtsRelatedByDebtorScheduledForDeletion->clear();
            }
            $this->debtsRelatedByDebtorScheduledForDeletion[]= clone $debtRelatedByDebtor;
            $debtRelatedByDebtor->setDebt_Debtor(null);
        }

        return $this;
    }

    /**
     * Clears out the collTransactionsRelatedByCreditor collection
     *
     * This does not modify the database; however, it will remove any associated objects, causing
     * them to be refetched by subsequent calls to accessor method.
     *
     * @return void
     * @see        addTransactionsRelatedByCreditor()
     */
    public function clearTransactionsRelatedByCreditor()
    {
        $this->collTransactionsRelatedByCreditor = null; // important to set this to NULL since that means it is uninitialized
    }

    /**
     * Reset is the collTransactionsRelatedByCreditor collection loaded partially.
     */
    public function resetPartialTransactionsRelatedByCreditor($v = true)
    {
        $this->collTransactionsRelatedByCreditorPartial = $v;
    }

    /**
     * Initializes the collTransactionsRelatedByCreditor collection.
     *
     * By default this just sets the collTransactionsRelatedByCreditor collection to an empty array (like clearcollTransactionsRelatedByCreditor());
     * however, you may wish to override this method in your stub class to provide setting appropriate
     * to your application -- for example, setting the initial array to the values stored in database.
     *
     * @param      boolean $overrideExisting If set to true, the method call initializes
     *                                        the collection even if it is not empty
     *
     * @return void
     */
    public function initTransactionsRelatedByCreditor($overrideExisting = true)
    {
        if (null !== $this->collTransactionsRelatedByCreditor && !$overrideExisting) {
            return;
        }

        $collectionClassName = TransactionTableMap::getTableMap()->getCollectionClassName();

        $this->collTransactionsRelatedByCreditor = new $collectionClassName;
        $this->collTransactionsRelatedByCreditor->setModel('\Transaction');
    }

    /**
     * Gets an array of ChildTransaction objects which contain a foreign key that references this object.
     *
     * If the $criteria is not null, it is used to always fetch the results from the database.
     * Otherwise the results are fetched from the database the first time, then cached.
     * Next time the same method is called without $criteria, the cached collection is returned.
     * If this ChildUsers is new, it will return
     * an empty collection or the current collection; the criteria is ignored on a new object.
     *
     * @param      Criteria $criteria optional Criteria object to narrow the query
     * @param      ConnectionInterface $con optional connection object
     * @return ObjectCollection|ChildTransaction[] List of ChildTransaction objects
     * @throws PropelException
     */
    public function getTransactionsRelatedByCreditor(Criteria $criteria = null, ConnectionInterface $con = null)
    {
        $partial = $this->collTransactionsRelatedByCreditorPartial && !$this->isNew();
        if (null === $this->collTransactionsRelatedByCreditor || null !== $criteria  || $partial) {
            if ($this->isNew() && null === $this->collTransactionsRelatedByCreditor) {
                // return empty collection
                $this->initTransactionsRelatedByCreditor();
            } else {
                $collTransactionsRelatedByCreditor = ChildTransactionQuery::create(null, $criteria)
                    ->filterByTransaction_Creditor($this)
                    ->find($con);

                if (null !== $criteria) {
                    if (false !== $this->collTransactionsRelatedByCreditorPartial && count($collTransactionsRelatedByCreditor)) {
                        $this->initTransactionsRelatedByCreditor(false);

                        foreach ($collTransactionsRelatedByCreditor as $obj) {
                            if (false == $this->collTransactionsRelatedByCreditor->contains($obj)) {
                                $this->collTransactionsRelatedByCreditor->append($obj);
                            }
                        }

                        $this->collTransactionsRelatedByCreditorPartial = true;
                    }

                    return $collTransactionsRelatedByCreditor;
                }

                if ($partial && $this->collTransactionsRelatedByCreditor) {
                    foreach ($this->collTransactionsRelatedByCreditor as $obj) {
                        if ($obj->isNew()) {
                            $collTransactionsRelatedByCreditor[] = $obj;
                        }
                    }
                }

                $this->collTransactionsRelatedByCreditor = $collTransactionsRelatedByCreditor;
                $this->collTransactionsRelatedByCreditorPartial = false;
            }
        }

        return $this->collTransactionsRelatedByCreditor;
    }

    /**
     * Sets a collection of ChildTransaction objects related by a one-to-many relationship
     * to the current object.
     * It will also schedule objects for deletion based on a diff between old objects (aka persisted)
     * and new objects from the given Propel collection.
     *
     * @param      Collection $transactionsRelatedByCreditor A Propel collection.
     * @param      ConnectionInterface $con Optional connection object
     * @return $this|ChildUsers The current object (for fluent API support)
     */
    public function setTransactionsRelatedByCreditor(Collection $transactionsRelatedByCreditor, ConnectionInterface $con = null)
    {
        /** @var ChildTransaction[] $transactionsRelatedByCreditorToDelete */
        $transactionsRelatedByCreditorToDelete = $this->getTransactionsRelatedByCreditor(new Criteria(), $con)->diff($transactionsRelatedByCreditor);


        $this->transactionsRelatedByCreditorScheduledForDeletion = $transactionsRelatedByCreditorToDelete;

        foreach ($transactionsRelatedByCreditorToDelete as $transactionRelatedByCreditorRemoved) {
            $transactionRelatedByCreditorRemoved->setTransaction_Creditor(null);
        }

        $this->collTransactionsRelatedByCreditor = null;
        foreach ($transactionsRelatedByCreditor as $transactionRelatedByCreditor) {
            $this->addTransactionRelatedByCreditor($transactionRelatedByCreditor);
        }

        $this->collTransactionsRelatedByCreditor = $transactionsRelatedByCreditor;
        $this->collTransactionsRelatedByCreditorPartial = false;

        return $this;
    }

    /**
     * Returns the number of related Transaction objects.
     *
     * @param      Criteria $criteria
     * @param      boolean $distinct
     * @param      ConnectionInterface $con
     * @return int             Count of related Transaction objects.
     * @throws PropelException
     */
    public function countTransactionsRelatedByCreditor(Criteria $criteria = null, $distinct = false, ConnectionInterface $con = null)
    {
        $partial = $this->collTransactionsRelatedByCreditorPartial && !$this->isNew();
        if (null === $this->collTransactionsRelatedByCreditor || null !== $criteria || $partial) {
            if ($this->isNew() && null === $this->collTransactionsRelatedByCreditor) {
                return 0;
            }

            if ($partial && !$criteria) {
                return count($this->getTransactionsRelatedByCreditor());
            }

            $query = ChildTransactionQuery::create(null, $criteria);
            if ($distinct) {
                $query->distinct();
            }

            return $query
                ->filterByTransaction_Creditor($this)
                ->count($con);
        }

        return count($this->collTransactionsRelatedByCreditor);
    }

    /**
     * Method called to associate a ChildTransaction object to this object
     * through the ChildTransaction foreign key attribute.
     *
     * @param  ChildTransaction $l ChildTransaction
     * @return $this|\Users The current object (for fluent API support)
     */
    public function addTransactionRelatedByCreditor(ChildTransaction $l)
    {
        if ($this->collTransactionsRelatedByCreditor === null) {
            $this->initTransactionsRelatedByCreditor();
            $this->collTransactionsRelatedByCreditorPartial = true;
        }

        if (!$this->collTransactionsRelatedByCreditor->contains($l)) {
            $this->doAddTransactionRelatedByCreditor($l);

            if ($this->transactionsRelatedByCreditorScheduledForDeletion and $this->transactionsRelatedByCreditorScheduledForDeletion->contains($l)) {
                $this->transactionsRelatedByCreditorScheduledForDeletion->remove($this->transactionsRelatedByCreditorScheduledForDeletion->search($l));
            }
        }

        return $this;
    }

    /**
     * @param ChildTransaction $transactionRelatedByCreditor The ChildTransaction object to add.
     */
    protected function doAddTransactionRelatedByCreditor(ChildTransaction $transactionRelatedByCreditor)
    {
        $this->collTransactionsRelatedByCreditor[]= $transactionRelatedByCreditor;
        $transactionRelatedByCreditor->setTransaction_Creditor($this);
    }

    /**
     * @param  ChildTransaction $transactionRelatedByCreditor The ChildTransaction object to remove.
     * @return $this|ChildUsers The current object (for fluent API support)
     */
    public function removeTransactionRelatedByCreditor(ChildTransaction $transactionRelatedByCreditor)
    {
        if ($this->getTransactionsRelatedByCreditor()->contains($transactionRelatedByCreditor)) {
            $pos = $this->collTransactionsRelatedByCreditor->search($transactionRelatedByCreditor);
            $this->collTransactionsRelatedByCreditor->remove($pos);
            if (null === $this->transactionsRelatedByCreditorScheduledForDeletion) {
                $this->transactionsRelatedByCreditorScheduledForDeletion = clone $this->collTransactionsRelatedByCreditor;
                $this->transactionsRelatedByCreditorScheduledForDeletion->clear();
            }
            $this->transactionsRelatedByCreditorScheduledForDeletion[]= clone $transactionRelatedByCreditor;
            $transactionRelatedByCreditor->setTransaction_Creditor(null);
        }

        return $this;
    }

    /**
     * Clears out the collTransactionsRelatedByDebtor collection
     *
     * This does not modify the database; however, it will remove any associated objects, causing
     * them to be refetched by subsequent calls to accessor method.
     *
     * @return void
     * @see        addTransactionsRelatedByDebtor()
     */
    public function clearTransactionsRelatedByDebtor()
    {
        $this->collTransactionsRelatedByDebtor = null; // important to set this to NULL since that means it is uninitialized
    }

    /**
     * Reset is the collTransactionsRelatedByDebtor collection loaded partially.
     */
    public function resetPartialTransactionsRelatedByDebtor($v = true)
    {
        $this->collTransactionsRelatedByDebtorPartial = $v;
    }

    /**
     * Initializes the collTransactionsRelatedByDebtor collection.
     *
     * By default this just sets the collTransactionsRelatedByDebtor collection to an empty array (like clearcollTransactionsRelatedByDebtor());
     * however, you may wish to override this method in your stub class to provide setting appropriate
     * to your application -- for example, setting the initial array to the values stored in database.
     *
     * @param      boolean $overrideExisting If set to true, the method call initializes
     *                                        the collection even if it is not empty
     *
     * @return void
     */
    public function initTransactionsRelatedByDebtor($overrideExisting = true)
    {
        if (null !== $this->collTransactionsRelatedByDebtor && !$overrideExisting) {
            return;
        }

        $collectionClassName = TransactionTableMap::getTableMap()->getCollectionClassName();

        $this->collTransactionsRelatedByDebtor = new $collectionClassName;
        $this->collTransactionsRelatedByDebtor->setModel('\Transaction');
    }

    /**
     * Gets an array of ChildTransaction objects which contain a foreign key that references this object.
     *
     * If the $criteria is not null, it is used to always fetch the results from the database.
     * Otherwise the results are fetched from the database the first time, then cached.
     * Next time the same method is called without $criteria, the cached collection is returned.
     * If this ChildUsers is new, it will return
     * an empty collection or the current collection; the criteria is ignored on a new object.
     *
     * @param      Criteria $criteria optional Criteria object to narrow the query
     * @param      ConnectionInterface $con optional connection object
     * @return ObjectCollection|ChildTransaction[] List of ChildTransaction objects
     * @throws PropelException
     */
    public function getTransactionsRelatedByDebtor(Criteria $criteria = null, ConnectionInterface $con = null)
    {
        $partial = $this->collTransactionsRelatedByDebtorPartial && !$this->isNew();
        if (null === $this->collTransactionsRelatedByDebtor || null !== $criteria  || $partial) {
            if ($this->isNew() && null === $this->collTransactionsRelatedByDebtor) {
                // return empty collection
                $this->initTransactionsRelatedByDebtor();
            } else {
                $collTransactionsRelatedByDebtor = ChildTransactionQuery::create(null, $criteria)
                    ->filterByTransaction_Debtor($this)
                    ->find($con);

                if (null !== $criteria) {
                    if (false !== $this->collTransactionsRelatedByDebtorPartial && count($collTransactionsRelatedByDebtor)) {
                        $this->initTransactionsRelatedByDebtor(false);

                        foreach ($collTransactionsRelatedByDebtor as $obj) {
                            if (false == $this->collTransactionsRelatedByDebtor->contains($obj)) {
                                $this->collTransactionsRelatedByDebtor->append($obj);
                            }
                        }

                        $this->collTransactionsRelatedByDebtorPartial = true;
                    }

                    return $collTransactionsRelatedByDebtor;
                }

                if ($partial && $this->collTransactionsRelatedByDebtor) {
                    foreach ($this->collTransactionsRelatedByDebtor as $obj) {
                        if ($obj->isNew()) {
                            $collTransactionsRelatedByDebtor[] = $obj;
                        }
                    }
                }

                $this->collTransactionsRelatedByDebtor = $collTransactionsRelatedByDebtor;
                $this->collTransactionsRelatedByDebtorPartial = false;
            }
        }

        return $this->collTransactionsRelatedByDebtor;
    }

    /**
     * Sets a collection of ChildTransaction objects related by a one-to-many relationship
     * to the current object.
     * It will also schedule objects for deletion based on a diff between old objects (aka persisted)
     * and new objects from the given Propel collection.
     *
     * @param      Collection $transactionsRelatedByDebtor A Propel collection.
     * @param      ConnectionInterface $con Optional connection object
     * @return $this|ChildUsers The current object (for fluent API support)
     */
    public function setTransactionsRelatedByDebtor(Collection $transactionsRelatedByDebtor, ConnectionInterface $con = null)
    {
        /** @var ChildTransaction[] $transactionsRelatedByDebtorToDelete */
        $transactionsRelatedByDebtorToDelete = $this->getTransactionsRelatedByDebtor(new Criteria(), $con)->diff($transactionsRelatedByDebtor);


        $this->transactionsRelatedByDebtorScheduledForDeletion = $transactionsRelatedByDebtorToDelete;

        foreach ($transactionsRelatedByDebtorToDelete as $transactionRelatedByDebtorRemoved) {
            $transactionRelatedByDebtorRemoved->setTransaction_Debtor(null);
        }

        $this->collTransactionsRelatedByDebtor = null;
        foreach ($transactionsRelatedByDebtor as $transactionRelatedByDebtor) {
            $this->addTransactionRelatedByDebtor($transactionRelatedByDebtor);
        }

        $this->collTransactionsRelatedByDebtor = $transactionsRelatedByDebtor;
        $this->collTransactionsRelatedByDebtorPartial = false;

        return $this;
    }

    /**
     * Returns the number of related Transaction objects.
     *
     * @param      Criteria $criteria
     * @param      boolean $distinct
     * @param      ConnectionInterface $con
     * @return int             Count of related Transaction objects.
     * @throws PropelException
     */
    public function countTransactionsRelatedByDebtor(Criteria $criteria = null, $distinct = false, ConnectionInterface $con = null)
    {
        $partial = $this->collTransactionsRelatedByDebtorPartial && !$this->isNew();
        if (null === $this->collTransactionsRelatedByDebtor || null !== $criteria || $partial) {
            if ($this->isNew() && null === $this->collTransactionsRelatedByDebtor) {
                return 0;
            }

            if ($partial && !$criteria) {
                return count($this->getTransactionsRelatedByDebtor());
            }

            $query = ChildTransactionQuery::create(null, $criteria);
            if ($distinct) {
                $query->distinct();
            }

            return $query
                ->filterByTransaction_Debtor($this)
                ->count($con);
        }

        return count($this->collTransactionsRelatedByDebtor);
    }

    /**
     * Method called to associate a ChildTransaction object to this object
     * through the ChildTransaction foreign key attribute.
     *
     * @param  ChildTransaction $l ChildTransaction
     * @return $this|\Users The current object (for fluent API support)
     */
    public function addTransactionRelatedByDebtor(ChildTransaction $l)
    {
        if ($this->collTransactionsRelatedByDebtor === null) {
            $this->initTransactionsRelatedByDebtor();
            $this->collTransactionsRelatedByDebtorPartial = true;
        }

        if (!$this->collTransactionsRelatedByDebtor->contains($l)) {
            $this->doAddTransactionRelatedByDebtor($l);

            if ($this->transactionsRelatedByDebtorScheduledForDeletion and $this->transactionsRelatedByDebtorScheduledForDeletion->contains($l)) {
                $this->transactionsRelatedByDebtorScheduledForDeletion->remove($this->transactionsRelatedByDebtorScheduledForDeletion->search($l));
            }
        }

        return $this;
    }

    /**
     * @param ChildTransaction $transactionRelatedByDebtor The ChildTransaction object to add.
     */
    protected function doAddTransactionRelatedByDebtor(ChildTransaction $transactionRelatedByDebtor)
    {
        $this->collTransactionsRelatedByDebtor[]= $transactionRelatedByDebtor;
        $transactionRelatedByDebtor->setTransaction_Debtor($this);
    }

    /**
     * @param  ChildTransaction $transactionRelatedByDebtor The ChildTransaction object to remove.
     * @return $this|ChildUsers The current object (for fluent API support)
     */
    public function removeTransactionRelatedByDebtor(ChildTransaction $transactionRelatedByDebtor)
    {
        if ($this->getTransactionsRelatedByDebtor()->contains($transactionRelatedByDebtor)) {
            $pos = $this->collTransactionsRelatedByDebtor->search($transactionRelatedByDebtor);
            $this->collTransactionsRelatedByDebtor->remove($pos);
            if (null === $this->transactionsRelatedByDebtorScheduledForDeletion) {
                $this->transactionsRelatedByDebtorScheduledForDeletion = clone $this->collTransactionsRelatedByDebtor;
                $this->transactionsRelatedByDebtorScheduledForDeletion->clear();
            }
            $this->transactionsRelatedByDebtorScheduledForDeletion[]= clone $transactionRelatedByDebtor;
            $transactionRelatedByDebtor->setTransaction_Debtor(null);
        }

        return $this;
    }

    /**
     * Clears the current object, sets all attributes to their default values and removes
     * outgoing references as well as back-references (from other objects to this one. Results probably in a database
     * change of those foreign objects when you call `save` there).
     */
    public function clear()
    {
        $this->email = null;
        $this->name = null;
        $this->password = null;
        $this->alreadyInSave = false;
        $this->clearAllReferences();
        $this->resetModified();
        $this->setNew(true);
        $this->setDeleted(false);
    }

    /**
     * Resets all references and back-references to other model objects or collections of model objects.
     *
     * This method is used to reset all php object references (not the actual reference in the database).
     * Necessary for object serialisation.
     *
     * @param      boolean $deep Whether to also clear the references on all referrer objects.
     */
    public function clearAllReferences($deep = false)
    {
        if ($deep) {
            if ($this->collDebtsRelatedByCreditor) {
                foreach ($this->collDebtsRelatedByCreditor as $o) {
                    $o->clearAllReferences($deep);
                }
            }
            if ($this->collDebtsRelatedByDebtor) {
                foreach ($this->collDebtsRelatedByDebtor as $o) {
                    $o->clearAllReferences($deep);
                }
            }
            if ($this->collTransactionsRelatedByCreditor) {
                foreach ($this->collTransactionsRelatedByCreditor as $o) {
                    $o->clearAllReferences($deep);
                }
            }
            if ($this->collTransactionsRelatedByDebtor) {
                foreach ($this->collTransactionsRelatedByDebtor as $o) {
                    $o->clearAllReferences($deep);
                }
            }
        } // if ($deep)

        $this->collDebtsRelatedByCreditor = null;
        $this->collDebtsRelatedByDebtor = null;
        $this->collTransactionsRelatedByCreditor = null;
        $this->collTransactionsRelatedByDebtor = null;
    }

    /**
     * Return the string representation of this object
     *
     * @return string
     */
    public function __toString()
    {
        return (string) $this->exportTo(UsersTableMap::DEFAULT_STRING_FORMAT);
    }

    /**
     * Code to be run before persisting the object
     * @param  ConnectionInterface $con
     * @return boolean
     */
    public function preSave(ConnectionInterface $con = null)
    {
        if (is_callable('parent::preSave')) {
            return parent::preSave($con);
        }
        return true;
    }

    /**
     * Code to be run after persisting the object
     * @param ConnectionInterface $con
     */
    public function postSave(ConnectionInterface $con = null)
    {
        if (is_callable('parent::postSave')) {
            parent::postSave($con);
        }
    }

    /**
     * Code to be run before inserting to database
     * @param  ConnectionInterface $con
     * @return boolean
     */
    public function preInsert(ConnectionInterface $con = null)
    {
        if (is_callable('parent::preInsert')) {
            return parent::preInsert($con);
        }
        return true;
    }

    /**
     * Code to be run after inserting to database
     * @param ConnectionInterface $con
     */
    public function postInsert(ConnectionInterface $con = null)
    {
        if (is_callable('parent::postInsert')) {
            parent::postInsert($con);
        }
    }

    /**
     * Code to be run before updating the object in database
     * @param  ConnectionInterface $con
     * @return boolean
     */
    public function preUpdate(ConnectionInterface $con = null)
    {
        if (is_callable('parent::preUpdate')) {
            return parent::preUpdate($con);
        }
        return true;
    }

    /**
     * Code to be run after updating the object in database
     * @param ConnectionInterface $con
     */
    public function postUpdate(ConnectionInterface $con = null)
    {
        if (is_callable('parent::postUpdate')) {
            parent::postUpdate($con);
        }
    }

    /**
     * Code to be run before deleting the object in database
     * @param  ConnectionInterface $con
     * @return boolean
     */
    public function preDelete(ConnectionInterface $con = null)
    {
        if (is_callable('parent::preDelete')) {
            return parent::preDelete($con);
        }
        return true;
    }

    /**
     * Code to be run after deleting the object in database
     * @param ConnectionInterface $con
     */
    public function postDelete(ConnectionInterface $con = null)
    {
        if (is_callable('parent::postDelete')) {
            parent::postDelete($con);
        }
    }


    /**
     * Derived method to catches calls to undefined methods.
     *
     * Provides magic import/export method support (fromXML()/toXML(), fromYAML()/toYAML(), etc.).
     * Allows to define default __call() behavior if you overwrite __call()
     *
     * @param string $name
     * @param mixed  $params
     *
     * @return array|string
     */
    public function __call($name, $params)
    {
        if (0 === strpos($name, 'get')) {
            $virtualColumn = substr($name, 3);
            if ($this->hasVirtualColumn($virtualColumn)) {
                return $this->getVirtualColumn($virtualColumn);
            }

            $virtualColumn = lcfirst($virtualColumn);
            if ($this->hasVirtualColumn($virtualColumn)) {
                return $this->getVirtualColumn($virtualColumn);
            }
        }

        if (0 === strpos($name, 'from')) {
            $format = substr($name, 4);

            return $this->importFrom($format, reset($params));
        }

        if (0 === strpos($name, 'to')) {
            $format = substr($name, 2);
            $includeLazyLoadColumns = isset($params[0]) ? $params[0] : true;

            return $this->exportTo($format, $includeLazyLoadColumns);
        }

        throw new BadMethodCallException(sprintf('Call to undefined method: %s.', $name));
    }

}
