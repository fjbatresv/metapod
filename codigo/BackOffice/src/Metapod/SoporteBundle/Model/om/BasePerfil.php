<?php

namespace Metapod\SoporteBundle\Model\om;

use \BaseObject;
use \BasePeer;
use \Criteria;
use \DateTime;
use \Exception;
use \PDO;
use \Persistent;
use \Propel;
use \PropelCollection;
use \PropelDateTime;
use \PropelException;
use \PropelObjectCollection;
use \PropelPDO;
use Metapod\SoporteBundle\Model\Perfil;
use Metapod\SoporteBundle\Model\PerfilMenu;
use Metapod\SoporteBundle\Model\PerfilMenuQuery;
use Metapod\SoporteBundle\Model\PerfilPeer;
use Metapod\SoporteBundle\Model\PerfilQuery;
use Metapod\SoporteBundle\Model\UsuarioPerfil;
use Metapod\SoporteBundle\Model\UsuarioPerfilQuery;

abstract class BasePerfil extends BaseObject implements Persistent
{
    /**
     * Peer class name
     */
    const PEER = 'Metapod\\SoporteBundle\\Model\\PerfilPeer';

    /**
     * The Peer class.
     * Instance provides a convenient way of calling static methods on a class
     * that calling code may not be able to identify.
     * @var        PerfilPeer
     */
    protected static $peer;

    /**
     * The flag var to prevent infinite loop in deep copy
     * @var       boolean
     */
    protected $startCopy = false;

    /**
     * The value for the id field.
     * @var        int
     */
    protected $id;

    /**
     * The value for the nombre field.
     * @var        string
     */
    protected $nombre;

    /**
     * The value for the descripcion field.
     * @var        string
     */
    protected $descripcion;

    /**
     * The value for the created_by field.
     * @var        string
     */
    protected $created_by;

    /**
     * The value for the updated_by field.
     * @var        string
     */
    protected $updated_by;

    /**
     * The value for the created_at field.
     * @var        string
     */
    protected $created_at;

    /**
     * The value for the updated_at field.
     * @var        string
     */
    protected $updated_at;

    /**
     * @var        PropelObjectCollection|PerfilMenu[] Collection to store aggregation of PerfilMenu objects.
     */
    protected $collPerfilMenus;
    protected $collPerfilMenusPartial;

    /**
     * @var        PropelObjectCollection|UsuarioPerfil[] Collection to store aggregation of UsuarioPerfil objects.
     */
    protected $collUsuarioPerfils;
    protected $collUsuarioPerfilsPartial;

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

    /**
     * Flag to prevent endless clearAllReferences($deep=true) loop, if this object is referenced
     * @var        boolean
     */
    protected $alreadyInClearAllReferencesDeep = false;

    /**
     * An array of objects scheduled for deletion.
     * @var		PropelObjectCollection
     */
    protected $perfilMenusScheduledForDeletion = null;

    /**
     * An array of objects scheduled for deletion.
     * @var		PropelObjectCollection
     */
    protected $usuarioPerfilsScheduledForDeletion = null;

    /**
     * Get the [id] column value.
     *
     * @return int
     */
    public function getId()
    {

        return $this->id;
    }

    /**
     * Get the [nombre] column value.
     *
     * @return string
     */
    public function getNombre()
    {

        return $this->nombre;
    }

    /**
     * Get the [descripcion] column value.
     *
     * @return string
     */
    public function getDescripcion()
    {

        return $this->descripcion;
    }

    /**
     * Get the [created_by] column value.
     *
     * @return string
     */
    public function getCreatedBy()
    {

        return $this->created_by;
    }

    /**
     * Get the [updated_by] column value.
     *
     * @return string
     */
    public function getUpdatedBy()
    {

        return $this->updated_by;
    }

    /**
     * Get the [optionally formatted] temporal [created_at] column value.
     *
     *
     * @param string $format The date/time format string (either date()-style or strftime()-style).
     *				 If format is null, then the raw DateTime object will be returned.
     * @return mixed Formatted date/time value as string or DateTime object (if format is null), null if column is null, and 0 if column value is 0000-00-00 00:00:00
     * @throws PropelException - if unable to parse/validate the date/time value.
     */
    public function getCreatedAt($format = null)
    {
        if ($this->created_at === null) {
            return null;
        }

        if ($this->created_at === '0000-00-00 00:00:00') {
            // while technically this is not a default value of null,
            // this seems to be closest in meaning.
            return null;
        }

        try {
            $dt = new DateTime($this->created_at);
        } catch (Exception $x) {
            throw new PropelException("Internally stored date/time/timestamp value could not be converted to DateTime: " . var_export($this->created_at, true), $x);
        }

        if ($format === null) {
            // Because propel.useDateTimeClass is true, we return a DateTime object.
            return $dt;
        }

        if (strpos($format, '%') !== false) {
            return strftime($format, $dt->format('U'));
        }

        return $dt->format($format);

    }

    /**
     * Get the [optionally formatted] temporal [updated_at] column value.
     *
     *
     * @param string $format The date/time format string (either date()-style or strftime()-style).
     *				 If format is null, then the raw DateTime object will be returned.
     * @return mixed Formatted date/time value as string or DateTime object (if format is null), null if column is null, and 0 if column value is 0000-00-00 00:00:00
     * @throws PropelException - if unable to parse/validate the date/time value.
     */
    public function getUpdatedAt($format = null)
    {
        if ($this->updated_at === null) {
            return null;
        }

        if ($this->updated_at === '0000-00-00 00:00:00') {
            // while technically this is not a default value of null,
            // this seems to be closest in meaning.
            return null;
        }

        try {
            $dt = new DateTime($this->updated_at);
        } catch (Exception $x) {
            throw new PropelException("Internally stored date/time/timestamp value could not be converted to DateTime: " . var_export($this->updated_at, true), $x);
        }

        if ($format === null) {
            // Because propel.useDateTimeClass is true, we return a DateTime object.
            return $dt;
        }

        if (strpos($format, '%') !== false) {
            return strftime($format, $dt->format('U'));
        }

        return $dt->format($format);

    }

    /**
     * Set the value of [id] column.
     *
     * @param  int $v new value
     * @return Perfil The current object (for fluent API support)
     */
    public function setId($v)
    {
        if ($v !== null && is_numeric($v)) {
            $v = (int) $v;
        }

        if ($this->id !== $v) {
            $this->id = $v;
            $this->modifiedColumns[] = PerfilPeer::ID;
        }


        return $this;
    } // setId()

    /**
     * Set the value of [nombre] column.
     *
     * @param  string $v new value
     * @return Perfil The current object (for fluent API support)
     */
    public function setNombre($v)
    {
        if ($v !== null) {
            $v = (string) $v;
        }

        if ($this->nombre !== $v) {
            $this->nombre = $v;
            $this->modifiedColumns[] = PerfilPeer::NOMBRE;
        }


        return $this;
    } // setNombre()

    /**
     * Set the value of [descripcion] column.
     *
     * @param  string $v new value
     * @return Perfil The current object (for fluent API support)
     */
    public function setDescripcion($v)
    {
        if ($v !== null) {
            $v = (string) $v;
        }

        if ($this->descripcion !== $v) {
            $this->descripcion = $v;
            $this->modifiedColumns[] = PerfilPeer::DESCRIPCION;
        }


        return $this;
    } // setDescripcion()

    /**
     * Set the value of [created_by] column.
     *
     * @param  string $v new value
     * @return Perfil The current object (for fluent API support)
     */
    public function setCreatedBy($v)
    {
        if ($v !== null) {
            $v = (string) $v;
        }

        if ($this->created_by !== $v) {
            $this->created_by = $v;
            $this->modifiedColumns[] = PerfilPeer::CREATED_BY;
        }


        return $this;
    } // setCreatedBy()

    /**
     * Set the value of [updated_by] column.
     *
     * @param  string $v new value
     * @return Perfil The current object (for fluent API support)
     */
    public function setUpdatedBy($v)
    {
        if ($v !== null) {
            $v = (string) $v;
        }

        if ($this->updated_by !== $v) {
            $this->updated_by = $v;
            $this->modifiedColumns[] = PerfilPeer::UPDATED_BY;
        }


        return $this;
    } // setUpdatedBy()

    /**
     * Sets the value of [created_at] column to a normalized version of the date/time value specified.
     *
     * @param mixed $v string, integer (timestamp), or DateTime value.
     *               Empty strings are treated as null.
     * @return Perfil The current object (for fluent API support)
     */
    public function setCreatedAt($v)
    {
        $dt = PropelDateTime::newInstance($v, null, 'DateTime');
        if ($this->created_at !== null || $dt !== null) {
            $currentDateAsString = ($this->created_at !== null && $tmpDt = new DateTime($this->created_at)) ? $tmpDt->format('Y-m-d H:i:s') : null;
            $newDateAsString = $dt ? $dt->format('Y-m-d H:i:s') : null;
            if ($currentDateAsString !== $newDateAsString) {
                $this->created_at = $newDateAsString;
                $this->modifiedColumns[] = PerfilPeer::CREATED_AT;
            }
        } // if either are not null


        return $this;
    } // setCreatedAt()

    /**
     * Sets the value of [updated_at] column to a normalized version of the date/time value specified.
     *
     * @param mixed $v string, integer (timestamp), or DateTime value.
     *               Empty strings are treated as null.
     * @return Perfil The current object (for fluent API support)
     */
    public function setUpdatedAt($v)
    {
        $dt = PropelDateTime::newInstance($v, null, 'DateTime');
        if ($this->updated_at !== null || $dt !== null) {
            $currentDateAsString = ($this->updated_at !== null && $tmpDt = new DateTime($this->updated_at)) ? $tmpDt->format('Y-m-d H:i:s') : null;
            $newDateAsString = $dt ? $dt->format('Y-m-d H:i:s') : null;
            if ($currentDateAsString !== $newDateAsString) {
                $this->updated_at = $newDateAsString;
                $this->modifiedColumns[] = PerfilPeer::UPDATED_AT;
            }
        } // if either are not null


        return $this;
    } // setUpdatedAt()

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
        // otherwise, everything was equal, so return true
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
     * @param array $row The row returned by PDOStatement->fetch(PDO::FETCH_NUM)
     * @param int $startcol 0-based offset column which indicates which resultset column to start with.
     * @param boolean $rehydrate Whether this object is being re-hydrated from the database.
     * @return int             next starting column
     * @throws PropelException - Any caught Exception will be rewrapped as a PropelException.
     */
    public function hydrate($row, $startcol = 0, $rehydrate = false)
    {
        try {

            $this->id = ($row[$startcol + 0] !== null) ? (int) $row[$startcol + 0] : null;
            $this->nombre = ($row[$startcol + 1] !== null) ? (string) $row[$startcol + 1] : null;
            $this->descripcion = ($row[$startcol + 2] !== null) ? (string) $row[$startcol + 2] : null;
            $this->created_by = ($row[$startcol + 3] !== null) ? (string) $row[$startcol + 3] : null;
            $this->updated_by = ($row[$startcol + 4] !== null) ? (string) $row[$startcol + 4] : null;
            $this->created_at = ($row[$startcol + 5] !== null) ? (string) $row[$startcol + 5] : null;
            $this->updated_at = ($row[$startcol + 6] !== null) ? (string) $row[$startcol + 6] : null;
            $this->resetModified();

            $this->setNew(false);

            if ($rehydrate) {
                $this->ensureConsistency();
            }
            $this->postHydrate($row, $startcol, $rehydrate);

            return $startcol + 7; // 7 = PerfilPeer::NUM_HYDRATE_COLUMNS.

        } catch (Exception $e) {
            throw new PropelException("Error populating Perfil object", $e);
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
     * @param boolean $deep (optional) Whether to also de-associated any related objects.
     * @param PropelPDO $con (optional) The PropelPDO connection to use.
     * @return void
     * @throws PropelException - if this object is deleted, unsaved or doesn't have pk match in db
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
            $con = Propel::getConnection(PerfilPeer::DATABASE_NAME, Propel::CONNECTION_READ);
        }

        // We don't need to alter the object instance pool; we're just modifying this instance
        // already in the pool.

        $stmt = PerfilPeer::doSelectStmt($this->buildPkeyCriteria(), $con);
        $row = $stmt->fetch(PDO::FETCH_NUM);
        $stmt->closeCursor();
        if (!$row) {
            throw new PropelException('Cannot find matching row in the database to reload object values.');
        }
        $this->hydrate($row, 0, true); // rehydrate

        if ($deep) {  // also de-associate any related objects?

            $this->collPerfilMenus = null;

            $this->collUsuarioPerfils = null;

        } // if (deep)
    }

    /**
     * Removes this object from datastore and sets delete attribute.
     *
     * @param PropelPDO $con
     * @return void
     * @throws PropelException
     * @throws Exception
     * @see        BaseObject::setDeleted()
     * @see        BaseObject::isDeleted()
     */
    public function delete(PropelPDO $con = null)
    {
        if ($this->isDeleted()) {
            throw new PropelException("This object has already been deleted.");
        }

        if ($con === null) {
            $con = Propel::getConnection(PerfilPeer::DATABASE_NAME, Propel::CONNECTION_WRITE);
        }

        $con->beginTransaction();
        try {
            $deleteQuery = PerfilQuery::create()
                ->filterByPrimaryKey($this->getPrimaryKey());
            $ret = $this->preDelete($con);
            if ($ret) {
                $deleteQuery->delete($con);
                $this->postDelete($con);
                $con->commit();
                $this->setDeleted(true);
            } else {
                $con->commit();
            }
        } catch (Exception $e) {
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
     * @param PropelPDO $con
     * @return int             The number of rows affected by this insert/update and any referring fk objects' save() operations.
     * @throws PropelException
     * @throws Exception
     * @see        doSave()
     */
    public function save(PropelPDO $con = null)
    {
        if ($this->isDeleted()) {
            throw new PropelException("You cannot save an object that has been deleted.");
        }

        if ($con === null) {
            $con = Propel::getConnection(PerfilPeer::DATABASE_NAME, Propel::CONNECTION_WRITE);
        }

        $con->beginTransaction();
        $isInsert = $this->isNew();
        try {
            $ret = $this->preSave($con);
            if ($isInsert) {
                $ret = $ret && $this->preInsert($con);
                // timestampable behavior
                if (!$this->isColumnModified(PerfilPeer::CREATED_AT)) {
                    $this->setCreatedAt(time());
                }
                if (!$this->isColumnModified(PerfilPeer::UPDATED_AT)) {
                    $this->setUpdatedAt(time());
                }
            } else {
                $ret = $ret && $this->preUpdate($con);
                // timestampable behavior
                if ($this->isModified() && !$this->isColumnModified(PerfilPeer::UPDATED_AT)) {
                    $this->setUpdatedAt(time());
                }
            }
            if ($ret) {
                $affectedRows = $this->doSave($con);
                if ($isInsert) {
                    $this->postInsert($con);
                } else {
                    $this->postUpdate($con);
                }
                $this->postSave($con);
                PerfilPeer::addInstanceToPool($this);
            } else {
                $affectedRows = 0;
            }
            $con->commit();

            return $affectedRows;
        } catch (Exception $e) {
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
     * @param PropelPDO $con
     * @return int             The number of rows affected by this insert/update and any referring fk objects' save() operations.
     * @throws PropelException
     * @see        save()
     */
    protected function doSave(PropelPDO $con)
    {
        $affectedRows = 0; // initialize var to track total num of affected rows
        if (!$this->alreadyInSave) {
            $this->alreadyInSave = true;

            if ($this->isNew() || $this->isModified()) {
                // persist changes
                if ($this->isNew()) {
                    $this->doInsert($con);
                } else {
                    $this->doUpdate($con);
                }
                $affectedRows += 1;
                $this->resetModified();
            }

            if ($this->perfilMenusScheduledForDeletion !== null) {
                if (!$this->perfilMenusScheduledForDeletion->isEmpty()) {
                    PerfilMenuQuery::create()
                        ->filterByPrimaryKeys($this->perfilMenusScheduledForDeletion->getPrimaryKeys(false))
                        ->delete($con);
                    $this->perfilMenusScheduledForDeletion = null;
                }
            }

            if ($this->collPerfilMenus !== null) {
                foreach ($this->collPerfilMenus as $referrerFK) {
                    if (!$referrerFK->isDeleted() && ($referrerFK->isNew() || $referrerFK->isModified())) {
                        $affectedRows += $referrerFK->save($con);
                    }
                }
            }

            if ($this->usuarioPerfilsScheduledForDeletion !== null) {
                if (!$this->usuarioPerfilsScheduledForDeletion->isEmpty()) {
                    UsuarioPerfilQuery::create()
                        ->filterByPrimaryKeys($this->usuarioPerfilsScheduledForDeletion->getPrimaryKeys(false))
                        ->delete($con);
                    $this->usuarioPerfilsScheduledForDeletion = null;
                }
            }

            if ($this->collUsuarioPerfils !== null) {
                foreach ($this->collUsuarioPerfils as $referrerFK) {
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
     * @param PropelPDO $con
     *
     * @throws PropelException
     * @see        doSave()
     */
    protected function doInsert(PropelPDO $con)
    {
        $modifiedColumns = array();
        $index = 0;

        $this->modifiedColumns[] = PerfilPeer::ID;
        if (null !== $this->id) {
            throw new PropelException('Cannot insert a value for auto-increment primary key (' . PerfilPeer::ID . ')');
        }

         // check the columns in natural order for more readable SQL queries
        if ($this->isColumnModified(PerfilPeer::ID)) {
            $modifiedColumns[':p' . $index++]  = '`id`';
        }
        if ($this->isColumnModified(PerfilPeer::NOMBRE)) {
            $modifiedColumns[':p' . $index++]  = '`nombre`';
        }
        if ($this->isColumnModified(PerfilPeer::DESCRIPCION)) {
            $modifiedColumns[':p' . $index++]  = '`descripcion`';
        }
        if ($this->isColumnModified(PerfilPeer::CREATED_BY)) {
            $modifiedColumns[':p' . $index++]  = '`created_by`';
        }
        if ($this->isColumnModified(PerfilPeer::UPDATED_BY)) {
            $modifiedColumns[':p' . $index++]  = '`updated_by`';
        }
        if ($this->isColumnModified(PerfilPeer::CREATED_AT)) {
            $modifiedColumns[':p' . $index++]  = '`created_at`';
        }
        if ($this->isColumnModified(PerfilPeer::UPDATED_AT)) {
            $modifiedColumns[':p' . $index++]  = '`updated_at`';
        }

        $sql = sprintf(
            'INSERT INTO `perfil` (%s) VALUES (%s)',
            implode(', ', $modifiedColumns),
            implode(', ', array_keys($modifiedColumns))
        );

        try {
            $stmt = $con->prepare($sql);
            foreach ($modifiedColumns as $identifier => $columnName) {
                switch ($columnName) {
                    case '`id`':
                        $stmt->bindValue($identifier, $this->id, PDO::PARAM_INT);
                        break;
                    case '`nombre`':
                        $stmt->bindValue($identifier, $this->nombre, PDO::PARAM_STR);
                        break;
                    case '`descripcion`':
                        $stmt->bindValue($identifier, $this->descripcion, PDO::PARAM_STR);
                        break;
                    case '`created_by`':
                        $stmt->bindValue($identifier, $this->created_by, PDO::PARAM_STR);
                        break;
                    case '`updated_by`':
                        $stmt->bindValue($identifier, $this->updated_by, PDO::PARAM_STR);
                        break;
                    case '`created_at`':
                        $stmt->bindValue($identifier, $this->created_at, PDO::PARAM_STR);
                        break;
                    case '`updated_at`':
                        $stmt->bindValue($identifier, $this->updated_at, PDO::PARAM_STR);
                        break;
                }
            }
            $stmt->execute();
        } catch (Exception $e) {
            Propel::log($e->getMessage(), Propel::LOG_ERR);
            throw new PropelException(sprintf('Unable to execute INSERT statement [%s]', $sql), $e);
        }

        try {
            $pk = $con->lastInsertId();
        } catch (Exception $e) {
            throw new PropelException('Unable to get autoincrement id.', $e);
        }
        $this->setId($pk);

        $this->setNew(false);
    }

    /**
     * Update the row in the database.
     *
     * @param PropelPDO $con
     *
     * @see        doSave()
     */
    protected function doUpdate(PropelPDO $con)
    {
        $selectCriteria = $this->buildPkeyCriteria();
        $valuesCriteria = $this->buildCriteria();
        BasePeer::doUpdate($selectCriteria, $valuesCriteria, $con);
    }

    /**
     * Array of ValidationFailed objects.
     * @var        array ValidationFailed[]
     */
    protected $validationFailures = array();

    /**
     * Gets any ValidationFailed objects that resulted from last call to validate().
     *
     *
     * @return array ValidationFailed[]
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
     * @param mixed $columns Column name or an array of column names.
     * @return boolean Whether all columns pass validation.
     * @see        doValidate()
     * @see        getValidationFailures()
     */
    public function validate($columns = null)
    {
        $res = $this->doValidate($columns);
        if ($res === true) {
            $this->validationFailures = array();

            return true;
        }

        $this->validationFailures = $res;

        return false;
    }

    /**
     * This function performs the validation work for complex object models.
     *
     * In addition to checking the current object, all related objects will
     * also be validated.  If all pass then <code>true</code> is returned; otherwise
     * an aggregated array of ValidationFailed objects will be returned.
     *
     * @param array $columns Array of column names to validate.
     * @return mixed <code>true</code> if all validations pass; array of <code>ValidationFailed</code> objects otherwise.
     */
    protected function doValidate($columns = null)
    {
        if (!$this->alreadyInValidation) {
            $this->alreadyInValidation = true;
            $retval = null;

            $failureMap = array();


            if (($retval = PerfilPeer::doValidate($this, $columns)) !== true) {
                $failureMap = array_merge($failureMap, $retval);
            }


                if ($this->collPerfilMenus !== null) {
                    foreach ($this->collPerfilMenus as $referrerFK) {
                        if (!$referrerFK->validate($columns)) {
                            $failureMap = array_merge($failureMap, $referrerFK->getValidationFailures());
                        }
                    }
                }

                if ($this->collUsuarioPerfils !== null) {
                    foreach ($this->collUsuarioPerfils as $referrerFK) {
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
     * @param string $name name
     * @param string $type The type of fieldname the $name is of:
     *               one of the class type constants BasePeer::TYPE_PHPNAME, BasePeer::TYPE_STUDLYPHPNAME
     *               BasePeer::TYPE_COLNAME, BasePeer::TYPE_FIELDNAME, BasePeer::TYPE_NUM.
     *               Defaults to BasePeer::TYPE_PHPNAME
     * @return mixed Value of field.
     */
    public function getByName($name, $type = BasePeer::TYPE_PHPNAME)
    {
        $pos = PerfilPeer::translateFieldName($name, $type, BasePeer::TYPE_NUM);
        $field = $this->getByPosition($pos);

        return $field;
    }

    /**
     * Retrieves a field from the object by Position as specified in the xml schema.
     * Zero-based.
     *
     * @param int $pos position in xml schema
     * @return mixed Value of field at $pos
     */
    public function getByPosition($pos)
    {
        switch ($pos) {
            case 0:
                return $this->getId();
                break;
            case 1:
                return $this->getNombre();
                break;
            case 2:
                return $this->getDescripcion();
                break;
            case 3:
                return $this->getCreatedBy();
                break;
            case 4:
                return $this->getUpdatedBy();
                break;
            case 5:
                return $this->getCreatedAt();
                break;
            case 6:
                return $this->getUpdatedAt();
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
     * @param     string  $keyType (optional) One of the class type constants BasePeer::TYPE_PHPNAME, BasePeer::TYPE_STUDLYPHPNAME,
     *                    BasePeer::TYPE_COLNAME, BasePeer::TYPE_FIELDNAME, BasePeer::TYPE_NUM.
     *                    Defaults to BasePeer::TYPE_PHPNAME.
     * @param     boolean $includeLazyLoadColumns (optional) Whether to include lazy loaded columns. Defaults to true.
     * @param     array $alreadyDumpedObjects List of objects to skip to avoid recursion
     * @param     boolean $includeForeignObjects (optional) Whether to include hydrated related objects. Default to FALSE.
     *
     * @return array an associative array containing the field names (as keys) and field values
     */
    public function toArray($keyType = BasePeer::TYPE_PHPNAME, $includeLazyLoadColumns = true, $alreadyDumpedObjects = array(), $includeForeignObjects = false)
    {
        if (isset($alreadyDumpedObjects['Perfil'][$this->getPrimaryKey()])) {
            return '*RECURSION*';
        }
        $alreadyDumpedObjects['Perfil'][$this->getPrimaryKey()] = true;
        $keys = PerfilPeer::getFieldNames($keyType);
        $result = array(
            $keys[0] => $this->getId(),
            $keys[1] => $this->getNombre(),
            $keys[2] => $this->getDescripcion(),
            $keys[3] => $this->getCreatedBy(),
            $keys[4] => $this->getUpdatedBy(),
            $keys[5] => $this->getCreatedAt(),
            $keys[6] => $this->getUpdatedAt(),
        );
        $virtualColumns = $this->virtualColumns;
        foreach ($virtualColumns as $key => $virtualColumn) {
            $result[$key] = $virtualColumn;
        }

        if ($includeForeignObjects) {
            if (null !== $this->collPerfilMenus) {
                $result['PerfilMenus'] = $this->collPerfilMenus->toArray(null, true, $keyType, $includeLazyLoadColumns, $alreadyDumpedObjects);
            }
            if (null !== $this->collUsuarioPerfils) {
                $result['UsuarioPerfils'] = $this->collUsuarioPerfils->toArray(null, true, $keyType, $includeLazyLoadColumns, $alreadyDumpedObjects);
            }
        }

        return $result;
    }

    /**
     * Sets a field from the object by name passed in as a string.
     *
     * @param string $name peer name
     * @param mixed $value field value
     * @param string $type The type of fieldname the $name is of:
     *                     one of the class type constants BasePeer::TYPE_PHPNAME, BasePeer::TYPE_STUDLYPHPNAME
     *                     BasePeer::TYPE_COLNAME, BasePeer::TYPE_FIELDNAME, BasePeer::TYPE_NUM.
     *                     Defaults to BasePeer::TYPE_PHPNAME
     * @return void
     */
    public function setByName($name, $value, $type = BasePeer::TYPE_PHPNAME)
    {
        $pos = PerfilPeer::translateFieldName($name, $type, BasePeer::TYPE_NUM);

        $this->setByPosition($pos, $value);
    }

    /**
     * Sets a field from the object by Position as specified in the xml schema.
     * Zero-based.
     *
     * @param int $pos position in xml schema
     * @param mixed $value field value
     * @return void
     */
    public function setByPosition($pos, $value)
    {
        switch ($pos) {
            case 0:
                $this->setId($value);
                break;
            case 1:
                $this->setNombre($value);
                break;
            case 2:
                $this->setDescripcion($value);
                break;
            case 3:
                $this->setCreatedBy($value);
                break;
            case 4:
                $this->setUpdatedBy($value);
                break;
            case 5:
                $this->setCreatedAt($value);
                break;
            case 6:
                $this->setUpdatedAt($value);
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
     * The default key type is the column's BasePeer::TYPE_PHPNAME
     *
     * @param array  $arr     An array to populate the object from.
     * @param string $keyType The type of keys the array uses.
     * @return void
     */
    public function fromArray($arr, $keyType = BasePeer::TYPE_PHPNAME)
    {
        $keys = PerfilPeer::getFieldNames($keyType);

        if (array_key_exists($keys[0], $arr)) $this->setId($arr[$keys[0]]);
        if (array_key_exists($keys[1], $arr)) $this->setNombre($arr[$keys[1]]);
        if (array_key_exists($keys[2], $arr)) $this->setDescripcion($arr[$keys[2]]);
        if (array_key_exists($keys[3], $arr)) $this->setCreatedBy($arr[$keys[3]]);
        if (array_key_exists($keys[4], $arr)) $this->setUpdatedBy($arr[$keys[4]]);
        if (array_key_exists($keys[5], $arr)) $this->setCreatedAt($arr[$keys[5]]);
        if (array_key_exists($keys[6], $arr)) $this->setUpdatedAt($arr[$keys[6]]);
    }

    /**
     * Build a Criteria object containing the values of all modified columns in this object.
     *
     * @return Criteria The Criteria object containing all modified values.
     */
    public function buildCriteria()
    {
        $criteria = new Criteria(PerfilPeer::DATABASE_NAME);

        if ($this->isColumnModified(PerfilPeer::ID)) $criteria->add(PerfilPeer::ID, $this->id);
        if ($this->isColumnModified(PerfilPeer::NOMBRE)) $criteria->add(PerfilPeer::NOMBRE, $this->nombre);
        if ($this->isColumnModified(PerfilPeer::DESCRIPCION)) $criteria->add(PerfilPeer::DESCRIPCION, $this->descripcion);
        if ($this->isColumnModified(PerfilPeer::CREATED_BY)) $criteria->add(PerfilPeer::CREATED_BY, $this->created_by);
        if ($this->isColumnModified(PerfilPeer::UPDATED_BY)) $criteria->add(PerfilPeer::UPDATED_BY, $this->updated_by);
        if ($this->isColumnModified(PerfilPeer::CREATED_AT)) $criteria->add(PerfilPeer::CREATED_AT, $this->created_at);
        if ($this->isColumnModified(PerfilPeer::UPDATED_AT)) $criteria->add(PerfilPeer::UPDATED_AT, $this->updated_at);

        return $criteria;
    }

    /**
     * Builds a Criteria object containing the primary key for this object.
     *
     * Unlike buildCriteria() this method includes the primary key values regardless
     * of whether or not they have been modified.
     *
     * @return Criteria The Criteria object containing value(s) for primary key(s).
     */
    public function buildPkeyCriteria()
    {
        $criteria = new Criteria(PerfilPeer::DATABASE_NAME);
        $criteria->add(PerfilPeer::ID, $this->id);

        return $criteria;
    }

    /**
     * Returns the primary key for this object (row).
     * @return int
     */
    public function getPrimaryKey()
    {
        return $this->getId();
    }

    /**
     * Generic method to set the primary key (id column).
     *
     * @param  int $key Primary key.
     * @return void
     */
    public function setPrimaryKey($key)
    {
        $this->setId($key);
    }

    /**
     * Returns true if the primary key for this object is null.
     * @return boolean
     */
    public function isPrimaryKeyNull()
    {

        return null === $this->getId();
    }

    /**
     * Sets contents of passed object to values from current object.
     *
     * If desired, this method can also make copies of all associated (fkey referrers)
     * objects.
     *
     * @param object $copyObj An object of Perfil (or compatible) type.
     * @param boolean $deepCopy Whether to also copy all rows that refer (by fkey) to the current row.
     * @param boolean $makeNew Whether to reset autoincrement PKs and make the object new.
     * @throws PropelException
     */
    public function copyInto($copyObj, $deepCopy = false, $makeNew = true)
    {
        $copyObj->setNombre($this->getNombre());
        $copyObj->setDescripcion($this->getDescripcion());
        $copyObj->setCreatedBy($this->getCreatedBy());
        $copyObj->setUpdatedBy($this->getUpdatedBy());
        $copyObj->setCreatedAt($this->getCreatedAt());
        $copyObj->setUpdatedAt($this->getUpdatedAt());

        if ($deepCopy && !$this->startCopy) {
            // important: temporarily setNew(false) because this affects the behavior of
            // the getter/setter methods for fkey referrer objects.
            $copyObj->setNew(false);
            // store object hash to prevent cycle
            $this->startCopy = true;

            foreach ($this->getPerfilMenus() as $relObj) {
                if ($relObj !== $this) {  // ensure that we don't try to copy a reference to ourselves
                    $copyObj->addPerfilMenu($relObj->copy($deepCopy));
                }
            }

            foreach ($this->getUsuarioPerfils() as $relObj) {
                if ($relObj !== $this) {  // ensure that we don't try to copy a reference to ourselves
                    $copyObj->addUsuarioPerfil($relObj->copy($deepCopy));
                }
            }

            //unflag object copy
            $this->startCopy = false;
        } // if ($deepCopy)

        if ($makeNew) {
            $copyObj->setNew(true);
            $copyObj->setId(NULL); // this is a auto-increment column, so set to default value
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
     * @param boolean $deepCopy Whether to also copy all rows that refer (by fkey) to the current row.
     * @return Perfil Clone of current object.
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
     * Returns a peer instance associated with this om.
     *
     * Since Peer classes are not to have any instance attributes, this method returns the
     * same instance for all member of this class. The method could therefore
     * be static, but this would prevent one from overriding the behavior.
     *
     * @return PerfilPeer
     */
    public function getPeer()
    {
        if (self::$peer === null) {
            self::$peer = new PerfilPeer();
        }

        return self::$peer;
    }


    /**
     * Initializes a collection based on the name of a relation.
     * Avoids crafting an 'init[$relationName]s' method name
     * that wouldn't work when StandardEnglishPluralizer is used.
     *
     * @param string $relationName The name of the relation to initialize
     * @return void
     */
    public function initRelation($relationName)
    {
        if ('PerfilMenu' == $relationName) {
            $this->initPerfilMenus();
        }
        if ('UsuarioPerfil' == $relationName) {
            $this->initUsuarioPerfils();
        }
    }

    /**
     * Clears out the collPerfilMenus collection
     *
     * This does not modify the database; however, it will remove any associated objects, causing
     * them to be refetched by subsequent calls to accessor method.
     *
     * @return Perfil The current object (for fluent API support)
     * @see        addPerfilMenus()
     */
    public function clearPerfilMenus()
    {
        $this->collPerfilMenus = null; // important to set this to null since that means it is uninitialized
        $this->collPerfilMenusPartial = null;

        return $this;
    }

    /**
     * reset is the collPerfilMenus collection loaded partially
     *
     * @return void
     */
    public function resetPartialPerfilMenus($v = true)
    {
        $this->collPerfilMenusPartial = $v;
    }

    /**
     * Initializes the collPerfilMenus collection.
     *
     * By default this just sets the collPerfilMenus collection to an empty array (like clearcollPerfilMenus());
     * however, you may wish to override this method in your stub class to provide setting appropriate
     * to your application -- for example, setting the initial array to the values stored in database.
     *
     * @param boolean $overrideExisting If set to true, the method call initializes
     *                                        the collection even if it is not empty
     *
     * @return void
     */
    public function initPerfilMenus($overrideExisting = true)
    {
        if (null !== $this->collPerfilMenus && !$overrideExisting) {
            return;
        }
        $this->collPerfilMenus = new PropelObjectCollection();
        $this->collPerfilMenus->setModel('PerfilMenu');
    }

    /**
     * Gets an array of PerfilMenu objects which contain a foreign key that references this object.
     *
     * If the $criteria is not null, it is used to always fetch the results from the database.
     * Otherwise the results are fetched from the database the first time, then cached.
     * Next time the same method is called without $criteria, the cached collection is returned.
     * If this Perfil is new, it will return
     * an empty collection or the current collection; the criteria is ignored on a new object.
     *
     * @param Criteria $criteria optional Criteria object to narrow the query
     * @param PropelPDO $con optional connection object
     * @return PropelObjectCollection|PerfilMenu[] List of PerfilMenu objects
     * @throws PropelException
     */
    public function getPerfilMenus($criteria = null, PropelPDO $con = null)
    {
        $partial = $this->collPerfilMenusPartial && !$this->isNew();
        if (null === $this->collPerfilMenus || null !== $criteria  || $partial) {
            if ($this->isNew() && null === $this->collPerfilMenus) {
                // return empty collection
                $this->initPerfilMenus();
            } else {
                $collPerfilMenus = PerfilMenuQuery::create(null, $criteria)
                    ->filterByPerfil($this)
                    ->find($con);
                if (null !== $criteria) {
                    if (false !== $this->collPerfilMenusPartial && count($collPerfilMenus)) {
                      $this->initPerfilMenus(false);

                      foreach ($collPerfilMenus as $obj) {
                        if (false == $this->collPerfilMenus->contains($obj)) {
                          $this->collPerfilMenus->append($obj);
                        }
                      }

                      $this->collPerfilMenusPartial = true;
                    }

                    $collPerfilMenus->getInternalIterator()->rewind();

                    return $collPerfilMenus;
                }

                if ($partial && $this->collPerfilMenus) {
                    foreach ($this->collPerfilMenus as $obj) {
                        if ($obj->isNew()) {
                            $collPerfilMenus[] = $obj;
                        }
                    }
                }

                $this->collPerfilMenus = $collPerfilMenus;
                $this->collPerfilMenusPartial = false;
            }
        }

        return $this->collPerfilMenus;
    }

    /**
     * Sets a collection of PerfilMenu objects related by a one-to-many relationship
     * to the current object.
     * It will also schedule objects for deletion based on a diff between old objects (aka persisted)
     * and new objects from the given Propel collection.
     *
     * @param PropelCollection $perfilMenus A Propel collection.
     * @param PropelPDO $con Optional connection object
     * @return Perfil The current object (for fluent API support)
     */
    public function setPerfilMenus(PropelCollection $perfilMenus, PropelPDO $con = null)
    {
        $perfilMenusToDelete = $this->getPerfilMenus(new Criteria(), $con)->diff($perfilMenus);


        $this->perfilMenusScheduledForDeletion = $perfilMenusToDelete;

        foreach ($perfilMenusToDelete as $perfilMenuRemoved) {
            $perfilMenuRemoved->setPerfil(null);
        }

        $this->collPerfilMenus = null;
        foreach ($perfilMenus as $perfilMenu) {
            $this->addPerfilMenu($perfilMenu);
        }

        $this->collPerfilMenus = $perfilMenus;
        $this->collPerfilMenusPartial = false;

        return $this;
    }

    /**
     * Returns the number of related PerfilMenu objects.
     *
     * @param Criteria $criteria
     * @param boolean $distinct
     * @param PropelPDO $con
     * @return int             Count of related PerfilMenu objects.
     * @throws PropelException
     */
    public function countPerfilMenus(Criteria $criteria = null, $distinct = false, PropelPDO $con = null)
    {
        $partial = $this->collPerfilMenusPartial && !$this->isNew();
        if (null === $this->collPerfilMenus || null !== $criteria || $partial) {
            if ($this->isNew() && null === $this->collPerfilMenus) {
                return 0;
            }

            if ($partial && !$criteria) {
                return count($this->getPerfilMenus());
            }
            $query = PerfilMenuQuery::create(null, $criteria);
            if ($distinct) {
                $query->distinct();
            }

            return $query
                ->filterByPerfil($this)
                ->count($con);
        }

        return count($this->collPerfilMenus);
    }

    /**
     * Method called to associate a PerfilMenu object to this object
     * through the PerfilMenu foreign key attribute.
     *
     * @param    PerfilMenu $l PerfilMenu
     * @return Perfil The current object (for fluent API support)
     */
    public function addPerfilMenu(PerfilMenu $l)
    {
        if ($this->collPerfilMenus === null) {
            $this->initPerfilMenus();
            $this->collPerfilMenusPartial = true;
        }

        if (!in_array($l, $this->collPerfilMenus->getArrayCopy(), true)) { // only add it if the **same** object is not already associated
            $this->doAddPerfilMenu($l);

            if ($this->perfilMenusScheduledForDeletion and $this->perfilMenusScheduledForDeletion->contains($l)) {
                $this->perfilMenusScheduledForDeletion->remove($this->perfilMenusScheduledForDeletion->search($l));
            }
        }

        return $this;
    }

    /**
     * @param	PerfilMenu $perfilMenu The perfilMenu object to add.
     */
    protected function doAddPerfilMenu($perfilMenu)
    {
        $this->collPerfilMenus[]= $perfilMenu;
        $perfilMenu->setPerfil($this);
    }

    /**
     * @param	PerfilMenu $perfilMenu The perfilMenu object to remove.
     * @return Perfil The current object (for fluent API support)
     */
    public function removePerfilMenu($perfilMenu)
    {
        if ($this->getPerfilMenus()->contains($perfilMenu)) {
            $this->collPerfilMenus->remove($this->collPerfilMenus->search($perfilMenu));
            if (null === $this->perfilMenusScheduledForDeletion) {
                $this->perfilMenusScheduledForDeletion = clone $this->collPerfilMenus;
                $this->perfilMenusScheduledForDeletion->clear();
            }
            $this->perfilMenusScheduledForDeletion[]= clone $perfilMenu;
            $perfilMenu->setPerfil(null);
        }

        return $this;
    }


    /**
     * If this collection has already been initialized with
     * an identical criteria, it returns the collection.
     * Otherwise if this Perfil is new, it will return
     * an empty collection; or if this Perfil has previously
     * been saved, it will retrieve related PerfilMenus from storage.
     *
     * This method is protected by default in order to keep the public
     * api reasonable.  You can provide public methods for those you
     * actually need in Perfil.
     *
     * @param Criteria $criteria optional Criteria object to narrow the query
     * @param PropelPDO $con optional connection object
     * @param string $join_behavior optional join type to use (defaults to Criteria::LEFT_JOIN)
     * @return PropelObjectCollection|PerfilMenu[] List of PerfilMenu objects
     */
    public function getPerfilMenusJoinMenu($criteria = null, $con = null, $join_behavior = Criteria::LEFT_JOIN)
    {
        $query = PerfilMenuQuery::create(null, $criteria);
        $query->joinWith('Menu', $join_behavior);

        return $this->getPerfilMenus($query, $con);
    }

    /**
     * Clears out the collUsuarioPerfils collection
     *
     * This does not modify the database; however, it will remove any associated objects, causing
     * them to be refetched by subsequent calls to accessor method.
     *
     * @return Perfil The current object (for fluent API support)
     * @see        addUsuarioPerfils()
     */
    public function clearUsuarioPerfils()
    {
        $this->collUsuarioPerfils = null; // important to set this to null since that means it is uninitialized
        $this->collUsuarioPerfilsPartial = null;

        return $this;
    }

    /**
     * reset is the collUsuarioPerfils collection loaded partially
     *
     * @return void
     */
    public function resetPartialUsuarioPerfils($v = true)
    {
        $this->collUsuarioPerfilsPartial = $v;
    }

    /**
     * Initializes the collUsuarioPerfils collection.
     *
     * By default this just sets the collUsuarioPerfils collection to an empty array (like clearcollUsuarioPerfils());
     * however, you may wish to override this method in your stub class to provide setting appropriate
     * to your application -- for example, setting the initial array to the values stored in database.
     *
     * @param boolean $overrideExisting If set to true, the method call initializes
     *                                        the collection even if it is not empty
     *
     * @return void
     */
    public function initUsuarioPerfils($overrideExisting = true)
    {
        if (null !== $this->collUsuarioPerfils && !$overrideExisting) {
            return;
        }
        $this->collUsuarioPerfils = new PropelObjectCollection();
        $this->collUsuarioPerfils->setModel('UsuarioPerfil');
    }

    /**
     * Gets an array of UsuarioPerfil objects which contain a foreign key that references this object.
     *
     * If the $criteria is not null, it is used to always fetch the results from the database.
     * Otherwise the results are fetched from the database the first time, then cached.
     * Next time the same method is called without $criteria, the cached collection is returned.
     * If this Perfil is new, it will return
     * an empty collection or the current collection; the criteria is ignored on a new object.
     *
     * @param Criteria $criteria optional Criteria object to narrow the query
     * @param PropelPDO $con optional connection object
     * @return PropelObjectCollection|UsuarioPerfil[] List of UsuarioPerfil objects
     * @throws PropelException
     */
    public function getUsuarioPerfils($criteria = null, PropelPDO $con = null)
    {
        $partial = $this->collUsuarioPerfilsPartial && !$this->isNew();
        if (null === $this->collUsuarioPerfils || null !== $criteria  || $partial) {
            if ($this->isNew() && null === $this->collUsuarioPerfils) {
                // return empty collection
                $this->initUsuarioPerfils();
            } else {
                $collUsuarioPerfils = UsuarioPerfilQuery::create(null, $criteria)
                    ->filterByPerfil($this)
                    ->find($con);
                if (null !== $criteria) {
                    if (false !== $this->collUsuarioPerfilsPartial && count($collUsuarioPerfils)) {
                      $this->initUsuarioPerfils(false);

                      foreach ($collUsuarioPerfils as $obj) {
                        if (false == $this->collUsuarioPerfils->contains($obj)) {
                          $this->collUsuarioPerfils->append($obj);
                        }
                      }

                      $this->collUsuarioPerfilsPartial = true;
                    }

                    $collUsuarioPerfils->getInternalIterator()->rewind();

                    return $collUsuarioPerfils;
                }

                if ($partial && $this->collUsuarioPerfils) {
                    foreach ($this->collUsuarioPerfils as $obj) {
                        if ($obj->isNew()) {
                            $collUsuarioPerfils[] = $obj;
                        }
                    }
                }

                $this->collUsuarioPerfils = $collUsuarioPerfils;
                $this->collUsuarioPerfilsPartial = false;
            }
        }

        return $this->collUsuarioPerfils;
    }

    /**
     * Sets a collection of UsuarioPerfil objects related by a one-to-many relationship
     * to the current object.
     * It will also schedule objects for deletion based on a diff between old objects (aka persisted)
     * and new objects from the given Propel collection.
     *
     * @param PropelCollection $usuarioPerfils A Propel collection.
     * @param PropelPDO $con Optional connection object
     * @return Perfil The current object (for fluent API support)
     */
    public function setUsuarioPerfils(PropelCollection $usuarioPerfils, PropelPDO $con = null)
    {
        $usuarioPerfilsToDelete = $this->getUsuarioPerfils(new Criteria(), $con)->diff($usuarioPerfils);


        $this->usuarioPerfilsScheduledForDeletion = $usuarioPerfilsToDelete;

        foreach ($usuarioPerfilsToDelete as $usuarioPerfilRemoved) {
            $usuarioPerfilRemoved->setPerfil(null);
        }

        $this->collUsuarioPerfils = null;
        foreach ($usuarioPerfils as $usuarioPerfil) {
            $this->addUsuarioPerfil($usuarioPerfil);
        }

        $this->collUsuarioPerfils = $usuarioPerfils;
        $this->collUsuarioPerfilsPartial = false;

        return $this;
    }

    /**
     * Returns the number of related UsuarioPerfil objects.
     *
     * @param Criteria $criteria
     * @param boolean $distinct
     * @param PropelPDO $con
     * @return int             Count of related UsuarioPerfil objects.
     * @throws PropelException
     */
    public function countUsuarioPerfils(Criteria $criteria = null, $distinct = false, PropelPDO $con = null)
    {
        $partial = $this->collUsuarioPerfilsPartial && !$this->isNew();
        if (null === $this->collUsuarioPerfils || null !== $criteria || $partial) {
            if ($this->isNew() && null === $this->collUsuarioPerfils) {
                return 0;
            }

            if ($partial && !$criteria) {
                return count($this->getUsuarioPerfils());
            }
            $query = UsuarioPerfilQuery::create(null, $criteria);
            if ($distinct) {
                $query->distinct();
            }

            return $query
                ->filterByPerfil($this)
                ->count($con);
        }

        return count($this->collUsuarioPerfils);
    }

    /**
     * Method called to associate a UsuarioPerfil object to this object
     * through the UsuarioPerfil foreign key attribute.
     *
     * @param    UsuarioPerfil $l UsuarioPerfil
     * @return Perfil The current object (for fluent API support)
     */
    public function addUsuarioPerfil(UsuarioPerfil $l)
    {
        if ($this->collUsuarioPerfils === null) {
            $this->initUsuarioPerfils();
            $this->collUsuarioPerfilsPartial = true;
        }

        if (!in_array($l, $this->collUsuarioPerfils->getArrayCopy(), true)) { // only add it if the **same** object is not already associated
            $this->doAddUsuarioPerfil($l);

            if ($this->usuarioPerfilsScheduledForDeletion and $this->usuarioPerfilsScheduledForDeletion->contains($l)) {
                $this->usuarioPerfilsScheduledForDeletion->remove($this->usuarioPerfilsScheduledForDeletion->search($l));
            }
        }

        return $this;
    }

    /**
     * @param	UsuarioPerfil $usuarioPerfil The usuarioPerfil object to add.
     */
    protected function doAddUsuarioPerfil($usuarioPerfil)
    {
        $this->collUsuarioPerfils[]= $usuarioPerfil;
        $usuarioPerfil->setPerfil($this);
    }

    /**
     * @param	UsuarioPerfil $usuarioPerfil The usuarioPerfil object to remove.
     * @return Perfil The current object (for fluent API support)
     */
    public function removeUsuarioPerfil($usuarioPerfil)
    {
        if ($this->getUsuarioPerfils()->contains($usuarioPerfil)) {
            $this->collUsuarioPerfils->remove($this->collUsuarioPerfils->search($usuarioPerfil));
            if (null === $this->usuarioPerfilsScheduledForDeletion) {
                $this->usuarioPerfilsScheduledForDeletion = clone $this->collUsuarioPerfils;
                $this->usuarioPerfilsScheduledForDeletion->clear();
            }
            $this->usuarioPerfilsScheduledForDeletion[]= clone $usuarioPerfil;
            $usuarioPerfil->setPerfil(null);
        }

        return $this;
    }


    /**
     * If this collection has already been initialized with
     * an identical criteria, it returns the collection.
     * Otherwise if this Perfil is new, it will return
     * an empty collection; or if this Perfil has previously
     * been saved, it will retrieve related UsuarioPerfils from storage.
     *
     * This method is protected by default in order to keep the public
     * api reasonable.  You can provide public methods for those you
     * actually need in Perfil.
     *
     * @param Criteria $criteria optional Criteria object to narrow the query
     * @param PropelPDO $con optional connection object
     * @param string $join_behavior optional join type to use (defaults to Criteria::LEFT_JOIN)
     * @return PropelObjectCollection|UsuarioPerfil[] List of UsuarioPerfil objects
     */
    public function getUsuarioPerfilsJoinUsuario($criteria = null, $con = null, $join_behavior = Criteria::LEFT_JOIN)
    {
        $query = UsuarioPerfilQuery::create(null, $criteria);
        $query->joinWith('Usuario', $join_behavior);

        return $this->getUsuarioPerfils($query, $con);
    }

    /**
     * Clears the current object and sets all attributes to their default values
     */
    public function clear()
    {
        $this->id = null;
        $this->nombre = null;
        $this->descripcion = null;
        $this->created_by = null;
        $this->updated_by = null;
        $this->created_at = null;
        $this->updated_at = null;
        $this->alreadyInSave = false;
        $this->alreadyInValidation = false;
        $this->alreadyInClearAllReferencesDeep = false;
        $this->clearAllReferences();
        $this->resetModified();
        $this->setNew(true);
        $this->setDeleted(false);
    }

    /**
     * Resets all references to other model objects or collections of model objects.
     *
     * This method is a user-space workaround for PHP's inability to garbage collect
     * objects with circular references (even in PHP 5.3). This is currently necessary
     * when using Propel in certain daemon or large-volume/high-memory operations.
     *
     * @param boolean $deep Whether to also clear the references on all referrer objects.
     */
    public function clearAllReferences($deep = false)
    {
        if ($deep && !$this->alreadyInClearAllReferencesDeep) {
            $this->alreadyInClearAllReferencesDeep = true;
            if ($this->collPerfilMenus) {
                foreach ($this->collPerfilMenus as $o) {
                    $o->clearAllReferences($deep);
                }
            }
            if ($this->collUsuarioPerfils) {
                foreach ($this->collUsuarioPerfils as $o) {
                    $o->clearAllReferences($deep);
                }
            }

            $this->alreadyInClearAllReferencesDeep = false;
        } // if ($deep)

        if ($this->collPerfilMenus instanceof PropelCollection) {
            $this->collPerfilMenus->clearIterator();
        }
        $this->collPerfilMenus = null;
        if ($this->collUsuarioPerfils instanceof PropelCollection) {
            $this->collUsuarioPerfils->clearIterator();
        }
        $this->collUsuarioPerfils = null;
    }

    /**
     * return the string representation of this object
     *
     * @return string The value of the 'nombre' column
     */
    public function __toString()
    {
        return (string) $this->getNombre();
    }

    /**
     * return true is the object is in saving state
     *
     * @return boolean
     */
    public function isAlreadyInSave()
    {
        return $this->alreadyInSave;
    }

    // timestampable behavior

    /**
     * Mark the current object so that the update date doesn't get updated during next save
     *
     * @return     Perfil The current object (for fluent API support)
     */
    public function keepUpdateDateUnchanged()
    {
        $this->modifiedColumns[] = PerfilPeer::UPDATED_AT;

        return $this;
    }

}
