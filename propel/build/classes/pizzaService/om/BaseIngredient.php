<?php


/**
 * Base class that represents a row from the 'ingredients' table.
 *
 *
 *
 * @package    propel.generator.pizzaService.om
 */
abstract class BaseIngredient extends BaseObject implements Persistent
{
    /**
     * Peer class name
     */
    const PEER = 'IngredientPeer';

    /**
     * The Peer class.
     * Instance provides a convenient way of calling static methods on a class
     * that calling code may not be able to identify.
     * @var        IngredientPeer
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
     * The value for the name field.
     * @var        string
     */
    protected $name;

    /**
     * @var        PropelObjectCollection|Ingredient_pizza[] Collection to store aggregation of Ingredient_pizza objects.
     */
    protected $collIngredient_pizzas;
    protected $collIngredient_pizzasPartial;

    /**
     * @var        PropelObjectCollection|Pizza[] Collection to store aggregation of Pizza objects.
     */
    protected $collPizzas;

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
    protected $pizzasScheduledForDeletion = null;

    /**
     * An array of objects scheduled for deletion.
     * @var		PropelObjectCollection
     */
    protected $ingredient_pizzasScheduledForDeletion = null;

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
     * Get the [name] column value.
     *
     * @return string
     */
    public function getName()
    {

        return $this->name;
    }

    /**
     * Set the value of [id] column.
     *
     * @param  int $v new value
     * @return Ingredient The current object (for fluent API support)
     */
    public function setId($v)
    {
        if ($v !== null && is_numeric($v)) {
            $v = (int) $v;
        }

        if ($this->id !== $v) {
            $this->id = $v;
            $this->modifiedColumns[] = IngredientPeer::ID;
        }


        return $this;
    } // setId()

    /**
     * Set the value of [name] column.
     *
     * @param  string $v new value
     * @return Ingredient The current object (for fluent API support)
     */
    public function setName($v)
    {
        if ($v !== null) {
            $v = (string) $v;
        }

        if ($this->name !== $v) {
            $this->name = $v;
            $this->modifiedColumns[] = IngredientPeer::NAME;
        }


        return $this;
    } // setName()

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
            $this->name = ($row[$startcol + 1] !== null) ? (string) $row[$startcol + 1] : null;
            $this->resetModified();

            $this->setNew(false);

            if ($rehydrate) {
                $this->ensureConsistency();
            }
            $this->postHydrate($row, $startcol, $rehydrate);

            return $startcol + 2; // 2 = IngredientPeer::NUM_HYDRATE_COLUMNS.

        } catch (Exception $e) {
            throw new PropelException("Error populating Ingredient object", $e);
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
            $con = Propel::getConnection(IngredientPeer::DATABASE_NAME, Propel::CONNECTION_READ);
        }

        // We don't need to alter the object instance pool; we're just modifying this instance
        // already in the pool.

        $stmt = IngredientPeer::doSelectStmt($this->buildPkeyCriteria(), $con);
        $row = $stmt->fetch(PDO::FETCH_NUM);
        $stmt->closeCursor();
        if (!$row) {
            throw new PropelException('Cannot find matching row in the database to reload object values.');
        }
        $this->hydrate($row, 0, true); // rehydrate

        if ($deep) {  // also de-associate any related objects?

            $this->collIngredient_pizzas = null;

            $this->collPizzas = null;
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
            $con = Propel::getConnection(IngredientPeer::DATABASE_NAME, Propel::CONNECTION_WRITE);
        }

        $con->beginTransaction();
        try {
            $deleteQuery = IngredientQuery::create()
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
            $con = Propel::getConnection(IngredientPeer::DATABASE_NAME, Propel::CONNECTION_WRITE);
        }

        $con->beginTransaction();
        $isInsert = $this->isNew();
        try {
            $ret = $this->preSave($con);
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
                IngredientPeer::addInstanceToPool($this);
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

            if ($this->pizzasScheduledForDeletion !== null) {
                if (!$this->pizzasScheduledForDeletion->isEmpty()) {
                    $pks = array();
                    $pk = $this->getPrimaryKey();
                    foreach ($this->pizzasScheduledForDeletion->getPrimaryKeys(false) as $remotePk) {
                        $pks[] = array($pk, $remotePk);
                    }
                    Ingredient_pizzaQuery::create()
                        ->filterByPrimaryKeys($pks)
                        ->delete($con);
                    $this->pizzasScheduledForDeletion = null;
                }

                foreach ($this->getPizzas() as $pizza) {
                    if ($pizza->isModified()) {
                        $pizza->save($con);
                    }
                }
            } elseif ($this->collPizzas) {
                foreach ($this->collPizzas as $pizza) {
                    if ($pizza->isModified()) {
                        $pizza->save($con);
                    }
                }
            }

            if ($this->ingredient_pizzasScheduledForDeletion !== null) {
                if (!$this->ingredient_pizzasScheduledForDeletion->isEmpty()) {
                    Ingredient_pizzaQuery::create()
                        ->filterByPrimaryKeys($this->ingredient_pizzasScheduledForDeletion->getPrimaryKeys(false))
                        ->delete($con);
                    $this->ingredient_pizzasScheduledForDeletion = null;
                }
            }

            if ($this->collIngredient_pizzas !== null) {
                foreach ($this->collIngredient_pizzas as $referrerFK) {
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

        $this->modifiedColumns[] = IngredientPeer::ID;
        if (null !== $this->id) {
            throw new PropelException('Cannot insert a value for auto-increment primary key (' . IngredientPeer::ID . ')');
        }

         // check the columns in natural order for more readable SQL queries
        if ($this->isColumnModified(IngredientPeer::ID)) {
            $modifiedColumns[':p' . $index++]  = '`id`';
        }
        if ($this->isColumnModified(IngredientPeer::NAME)) {
            $modifiedColumns[':p' . $index++]  = '`name`';
        }

        $sql = sprintf(
            'INSERT INTO `ingredients` (%s) VALUES (%s)',
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
                    case '`name`':
                        $stmt->bindValue($identifier, $this->name, PDO::PARAM_STR);
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


            if (($retval = IngredientPeer::doValidate($this, $columns)) !== true) {
                $failureMap = array_merge($failureMap, $retval);
            }


                if ($this->collIngredient_pizzas !== null) {
                    foreach ($this->collIngredient_pizzas as $referrerFK) {
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
        $pos = IngredientPeer::translateFieldName($name, $type, BasePeer::TYPE_NUM);
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
                return $this->getName();
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
        if (isset($alreadyDumpedObjects['Ingredient'][$this->getPrimaryKey()])) {
            return '*RECURSION*';
        }
        $alreadyDumpedObjects['Ingredient'][$this->getPrimaryKey()] = true;
        $keys = IngredientPeer::getFieldNames($keyType);
        $result = array(
            $keys[0] => $this->getId(),
            $keys[1] => $this->getName(),
        );
        $virtualColumns = $this->virtualColumns;
        foreach ($virtualColumns as $key => $virtualColumn) {
            $result[$key] = $virtualColumn;
        }

        if ($includeForeignObjects) {
            if (null !== $this->collIngredient_pizzas) {
                $result['Ingredient_pizzas'] = $this->collIngredient_pizzas->toArray(null, true, $keyType, $includeLazyLoadColumns, $alreadyDumpedObjects);
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
        $pos = IngredientPeer::translateFieldName($name, $type, BasePeer::TYPE_NUM);

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
                $this->setName($value);
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
        $keys = IngredientPeer::getFieldNames($keyType);

        if (array_key_exists($keys[0], $arr)) $this->setId($arr[$keys[0]]);
        if (array_key_exists($keys[1], $arr)) $this->setName($arr[$keys[1]]);
    }

    /**
     * Build a Criteria object containing the values of all modified columns in this object.
     *
     * @return Criteria The Criteria object containing all modified values.
     */
    public function buildCriteria()
    {
        $criteria = new Criteria(IngredientPeer::DATABASE_NAME);

        if ($this->isColumnModified(IngredientPeer::ID)) $criteria->add(IngredientPeer::ID, $this->id);
        if ($this->isColumnModified(IngredientPeer::NAME)) $criteria->add(IngredientPeer::NAME, $this->name);

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
        $criteria = new Criteria(IngredientPeer::DATABASE_NAME);
        $criteria->add(IngredientPeer::ID, $this->id);

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
     * @param object $copyObj An object of Ingredient (or compatible) type.
     * @param boolean $deepCopy Whether to also copy all rows that refer (by fkey) to the current row.
     * @param boolean $makeNew Whether to reset autoincrement PKs and make the object new.
     * @throws PropelException
     */
    public function copyInto($copyObj, $deepCopy = false, $makeNew = true)
    {
        $copyObj->setName($this->getName());

        if ($deepCopy && !$this->startCopy) {
            // important: temporarily setNew(false) because this affects the behavior of
            // the getter/setter methods for fkey referrer objects.
            $copyObj->setNew(false);
            // store object hash to prevent cycle
            $this->startCopy = true;

            foreach ($this->getIngredient_pizzas() as $relObj) {
                if ($relObj !== $this) {  // ensure that we don't try to copy a reference to ourselves
                    $copyObj->addIngredient_pizza($relObj->copy($deepCopy));
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
     * @return Ingredient Clone of current object.
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
     * @return IngredientPeer
     */
    public function getPeer()
    {
        if (self::$peer === null) {
            self::$peer = new IngredientPeer();
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
        if ('Ingredient_pizza' == $relationName) {
            $this->initIngredient_pizzas();
        }
    }

    /**
     * Clears out the collIngredient_pizzas collection
     *
     * This does not modify the database; however, it will remove any associated objects, causing
     * them to be refetched by subsequent calls to accessor method.
     *
     * @return Ingredient The current object (for fluent API support)
     * @see        addIngredient_pizzas()
     */
    public function clearIngredient_pizzas()
    {
        $this->collIngredient_pizzas = null; // important to set this to null since that means it is uninitialized
        $this->collIngredient_pizzasPartial = null;

        return $this;
    }

    /**
     * reset is the collIngredient_pizzas collection loaded partially
     *
     * @return void
     */
    public function resetPartialIngredient_pizzas($v = true)
    {
        $this->collIngredient_pizzasPartial = $v;
    }

    /**
     * Initializes the collIngredient_pizzas collection.
     *
     * By default this just sets the collIngredient_pizzas collection to an empty array (like clearcollIngredient_pizzas());
     * however, you may wish to override this method in your stub class to provide setting appropriate
     * to your application -- for example, setting the initial array to the values stored in database.
     *
     * @param boolean $overrideExisting If set to true, the method call initializes
     *                                        the collection even if it is not empty
     *
     * @return void
     */
    public function initIngredient_pizzas($overrideExisting = true)
    {
        if (null !== $this->collIngredient_pizzas && !$overrideExisting) {
            return;
        }
        $this->collIngredient_pizzas = new PropelObjectCollection();
        $this->collIngredient_pizzas->setModel('Ingredient_pizza');
    }

    /**
     * Gets an array of Ingredient_pizza objects which contain a foreign key that references this object.
     *
     * If the $criteria is not null, it is used to always fetch the results from the database.
     * Otherwise the results are fetched from the database the first time, then cached.
     * Next time the same method is called without $criteria, the cached collection is returned.
     * If this Ingredient is new, it will return
     * an empty collection or the current collection; the criteria is ignored on a new object.
     *
     * @param Criteria $criteria optional Criteria object to narrow the query
     * @param PropelPDO $con optional connection object
     * @return PropelObjectCollection|Ingredient_pizza[] List of Ingredient_pizza objects
     * @throws PropelException
     */
    public function getIngredient_pizzas($criteria = null, PropelPDO $con = null)
    {
        $partial = $this->collIngredient_pizzasPartial && !$this->isNew();
        if (null === $this->collIngredient_pizzas || null !== $criteria  || $partial) {
            if ($this->isNew() && null === $this->collIngredient_pizzas) {
                // return empty collection
                $this->initIngredient_pizzas();
            } else {
                $collIngredient_pizzas = Ingredient_pizzaQuery::create(null, $criteria)
                    ->filterByIngredient($this)
                    ->find($con);
                if (null !== $criteria) {
                    if (false !== $this->collIngredient_pizzasPartial && count($collIngredient_pizzas)) {
                      $this->initIngredient_pizzas(false);

                      foreach ($collIngredient_pizzas as $obj) {
                        if (false == $this->collIngredient_pizzas->contains($obj)) {
                          $this->collIngredient_pizzas->append($obj);
                        }
                      }

                      $this->collIngredient_pizzasPartial = true;
                    }

                    $collIngredient_pizzas->getInternalIterator()->rewind();

                    return $collIngredient_pizzas;
                }

                if ($partial && $this->collIngredient_pizzas) {
                    foreach ($this->collIngredient_pizzas as $obj) {
                        if ($obj->isNew()) {
                            $collIngredient_pizzas[] = $obj;
                        }
                    }
                }

                $this->collIngredient_pizzas = $collIngredient_pizzas;
                $this->collIngredient_pizzasPartial = false;
            }
        }

        return $this->collIngredient_pizzas;
    }

    /**
     * Sets a collection of Ingredient_pizza objects related by a one-to-many relationship
     * to the current object.
     * It will also schedule objects for deletion based on a diff between old objects (aka persisted)
     * and new objects from the given Propel collection.
     *
     * @param PropelCollection $ingredient_pizzas A Propel collection.
     * @param PropelPDO $con Optional connection object
     * @return Ingredient The current object (for fluent API support)
     */
    public function setIngredient_pizzas(PropelCollection $ingredient_pizzas, PropelPDO $con = null)
    {
        $ingredient_pizzasToDelete = $this->getIngredient_pizzas(new Criteria(), $con)->diff($ingredient_pizzas);


        //since at least one column in the foreign key is at the same time a PK
        //we can not just set a PK to NULL in the lines below. We have to store
        //a backup of all values, so we are able to manipulate these items based on the onDelete value later.
        $this->ingredient_pizzasScheduledForDeletion = clone $ingredient_pizzasToDelete;

        foreach ($ingredient_pizzasToDelete as $ingredient_pizzaRemoved) {
            $ingredient_pizzaRemoved->setIngredient(null);
        }

        $this->collIngredient_pizzas = null;
        foreach ($ingredient_pizzas as $ingredient_pizza) {
            $this->addIngredient_pizza($ingredient_pizza);
        }

        $this->collIngredient_pizzas = $ingredient_pizzas;
        $this->collIngredient_pizzasPartial = false;

        return $this;
    }

    /**
     * Returns the number of related Ingredient_pizza objects.
     *
     * @param Criteria $criteria
     * @param boolean $distinct
     * @param PropelPDO $con
     * @return int             Count of related Ingredient_pizza objects.
     * @throws PropelException
     */
    public function countIngredient_pizzas(Criteria $criteria = null, $distinct = false, PropelPDO $con = null)
    {
        $partial = $this->collIngredient_pizzasPartial && !$this->isNew();
        if (null === $this->collIngredient_pizzas || null !== $criteria || $partial) {
            if ($this->isNew() && null === $this->collIngredient_pizzas) {
                return 0;
            }

            if ($partial && !$criteria) {
                return count($this->getIngredient_pizzas());
            }
            $query = Ingredient_pizzaQuery::create(null, $criteria);
            if ($distinct) {
                $query->distinct();
            }

            return $query
                ->filterByIngredient($this)
                ->count($con);
        }

        return count($this->collIngredient_pizzas);
    }

    /**
     * Method called to associate a Ingredient_pizza object to this object
     * through the Ingredient_pizza foreign key attribute.
     *
     * @param    Ingredient_pizza $l Ingredient_pizza
     * @return Ingredient The current object (for fluent API support)
     */
    public function addIngredient_pizza(Ingredient_pizza $l)
    {
        if ($this->collIngredient_pizzas === null) {
            $this->initIngredient_pizzas();
            $this->collIngredient_pizzasPartial = true;
        }

        if (!in_array($l, $this->collIngredient_pizzas->getArrayCopy(), true)) { // only add it if the **same** object is not already associated
            $this->doAddIngredient_pizza($l);

            if ($this->ingredient_pizzasScheduledForDeletion and $this->ingredient_pizzasScheduledForDeletion->contains($l)) {
                $this->ingredient_pizzasScheduledForDeletion->remove($this->ingredient_pizzasScheduledForDeletion->search($l));
            }
        }

        return $this;
    }

    /**
     * @param	Ingredient_pizza $ingredient_pizza The ingredient_pizza object to add.
     */
    protected function doAddIngredient_pizza($ingredient_pizza)
    {
        $this->collIngredient_pizzas[]= $ingredient_pizza;
        $ingredient_pizza->setIngredient($this);
    }

    /**
     * @param	Ingredient_pizza $ingredient_pizza The ingredient_pizza object to remove.
     * @return Ingredient The current object (for fluent API support)
     */
    public function removeIngredient_pizza($ingredient_pizza)
    {
        if ($this->getIngredient_pizzas()->contains($ingredient_pizza)) {
            $this->collIngredient_pizzas->remove($this->collIngredient_pizzas->search($ingredient_pizza));
            if (null === $this->ingredient_pizzasScheduledForDeletion) {
                $this->ingredient_pizzasScheduledForDeletion = clone $this->collIngredient_pizzas;
                $this->ingredient_pizzasScheduledForDeletion->clear();
            }
            $this->ingredient_pizzasScheduledForDeletion[]= clone $ingredient_pizza;
            $ingredient_pizza->setIngredient(null);
        }

        return $this;
    }


    /**
     * If this collection has already been initialized with
     * an identical criteria, it returns the collection.
     * Otherwise if this Ingredient is new, it will return
     * an empty collection; or if this Ingredient has previously
     * been saved, it will retrieve related Ingredient_pizzas from storage.
     *
     * This method is protected by default in order to keep the public
     * api reasonable.  You can provide public methods for those you
     * actually need in Ingredient.
     *
     * @param Criteria $criteria optional Criteria object to narrow the query
     * @param PropelPDO $con optional connection object
     * @param string $join_behavior optional join type to use (defaults to Criteria::LEFT_JOIN)
     * @return PropelObjectCollection|Ingredient_pizza[] List of Ingredient_pizza objects
     */
    public function getIngredient_pizzasJoinPizza($criteria = null, $con = null, $join_behavior = Criteria::LEFT_JOIN)
    {
        $query = Ingredient_pizzaQuery::create(null, $criteria);
        $query->joinWith('Pizza', $join_behavior);

        return $this->getIngredient_pizzas($query, $con);
    }

    /**
     * Clears out the collPizzas collection
     *
     * This does not modify the database; however, it will remove any associated objects, causing
     * them to be refetched by subsequent calls to accessor method.
     *
     * @return Ingredient The current object (for fluent API support)
     * @see        addPizzas()
     */
    public function clearPizzas()
    {
        $this->collPizzas = null; // important to set this to null since that means it is uninitialized
        $this->collPizzasPartial = null;

        return $this;
    }

    /**
     * Initializes the collPizzas collection.
     *
     * By default this just sets the collPizzas collection to an empty collection (like clearPizzas());
     * however, you may wish to override this method in your stub class to provide setting appropriate
     * to your application -- for example, setting the initial array to the values stored in database.
     *
     * @return void
     */
    public function initPizzas()
    {
        $this->collPizzas = new PropelObjectCollection();
        $this->collPizzas->setModel('Pizza');
    }

    /**
     * Gets a collection of Pizza objects related by a many-to-many relationship
     * to the current object by way of the pizza_ingredients cross-reference table.
     *
     * If the $criteria is not null, it is used to always fetch the results from the database.
     * Otherwise the results are fetched from the database the first time, then cached.
     * Next time the same method is called without $criteria, the cached collection is returned.
     * If this Ingredient is new, it will return
     * an empty collection or the current collection; the criteria is ignored on a new object.
     *
     * @param Criteria $criteria Optional query object to filter the query
     * @param PropelPDO $con Optional connection object
     *
     * @return PropelObjectCollection|Pizza[] List of Pizza objects
     */
    public function getPizzas($criteria = null, PropelPDO $con = null)
    {
        if (null === $this->collPizzas || null !== $criteria) {
            if ($this->isNew() && null === $this->collPizzas) {
                // return empty collection
                $this->initPizzas();
            } else {
                $collPizzas = PizzaQuery::create(null, $criteria)
                    ->filterByIngredient($this)
                    ->find($con);
                if (null !== $criteria) {
                    return $collPizzas;
                }
                $this->collPizzas = $collPizzas;
            }
        }

        return $this->collPizzas;
    }

    /**
     * Sets a collection of Pizza objects related by a many-to-many relationship
     * to the current object by way of the pizza_ingredients cross-reference table.
     * It will also schedule objects for deletion based on a diff between old objects (aka persisted)
     * and new objects from the given Propel collection.
     *
     * @param PropelCollection $pizzas A Propel collection.
     * @param PropelPDO $con Optional connection object
     * @return Ingredient The current object (for fluent API support)
     */
    public function setPizzas(PropelCollection $pizzas, PropelPDO $con = null)
    {
        $this->clearPizzas();
        $currentPizzas = $this->getPizzas(null, $con);

        $this->pizzasScheduledForDeletion = $currentPizzas->diff($pizzas);

        foreach ($pizzas as $pizza) {
            if (!$currentPizzas->contains($pizza)) {
                $this->doAddPizza($pizza);
            }
        }

        $this->collPizzas = $pizzas;

        return $this;
    }

    /**
     * Gets the number of Pizza objects related by a many-to-many relationship
     * to the current object by way of the pizza_ingredients cross-reference table.
     *
     * @param Criteria $criteria Optional query object to filter the query
     * @param boolean $distinct Set to true to force count distinct
     * @param PropelPDO $con Optional connection object
     *
     * @return int the number of related Pizza objects
     */
    public function countPizzas($criteria = null, $distinct = false, PropelPDO $con = null)
    {
        if (null === $this->collPizzas || null !== $criteria) {
            if ($this->isNew() && null === $this->collPizzas) {
                return 0;
            } else {
                $query = PizzaQuery::create(null, $criteria);
                if ($distinct) {
                    $query->distinct();
                }

                return $query
                    ->filterByIngredient($this)
                    ->count($con);
            }
        } else {
            return count($this->collPizzas);
        }
    }

    /**
     * Associate a Pizza object to this object
     * through the pizza_ingredients cross reference table.
     *
     * @param  Pizza $pizza The Ingredient_pizza object to relate
     * @return Ingredient The current object (for fluent API support)
     */
    public function addPizza(Pizza $pizza)
    {
        if ($this->collPizzas === null) {
            $this->initPizzas();
        }

        if (!$this->collPizzas->contains($pizza)) { // only add it if the **same** object is not already associated
            $this->doAddPizza($pizza);
            $this->collPizzas[] = $pizza;

            if ($this->pizzasScheduledForDeletion and $this->pizzasScheduledForDeletion->contains($pizza)) {
                $this->pizzasScheduledForDeletion->remove($this->pizzasScheduledForDeletion->search($pizza));
            }
        }

        return $this;
    }

    /**
     * @param	Pizza $pizza The pizza object to add.
     */
    protected function doAddPizza(Pizza $pizza)
    {
        // set the back reference to this object directly as using provided method either results
        // in endless loop or in multiple relations
        if (!$pizza->getIngredients()->contains($this)) { $ingredient_pizza = new Ingredient_pizza();
            $ingredient_pizza->setPizza($pizza);
            $this->addIngredient_pizza($ingredient_pizza);

            $foreignCollection = $pizza->getIngredients();
            $foreignCollection[] = $this;
        }
    }

    /**
     * Remove a Pizza object to this object
     * through the pizza_ingredients cross reference table.
     *
     * @param Pizza $pizza The Ingredient_pizza object to relate
     * @return Ingredient The current object (for fluent API support)
     */
    public function removePizza(Pizza $pizza)
    {
        if ($this->getPizzas()->contains($pizza)) {
            $this->collPizzas->remove($this->collPizzas->search($pizza));
            if (null === $this->pizzasScheduledForDeletion) {
                $this->pizzasScheduledForDeletion = clone $this->collPizzas;
                $this->pizzasScheduledForDeletion->clear();
            }
            $this->pizzasScheduledForDeletion[]= $pizza;
        }

        return $this;
    }

    /**
     * Clears the current object and sets all attributes to their default values
     */
    public function clear()
    {
        $this->id = null;
        $this->name = null;
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
            if ($this->collIngredient_pizzas) {
                foreach ($this->collIngredient_pizzas as $o) {
                    $o->clearAllReferences($deep);
                }
            }
            if ($this->collPizzas) {
                foreach ($this->collPizzas as $o) {
                    $o->clearAllReferences($deep);
                }
            }

            $this->alreadyInClearAllReferencesDeep = false;
        } // if ($deep)

        if ($this->collIngredient_pizzas instanceof PropelCollection) {
            $this->collIngredient_pizzas->clearIterator();
        }
        $this->collIngredient_pizzas = null;
        if ($this->collPizzas instanceof PropelCollection) {
            $this->collPizzas->clearIterator();
        }
        $this->collPizzas = null;
    }

    /**
     * return the string representation of this object
     *
     * @return string
     */
    public function __toString()
    {
        return (string) $this->exportTo(IngredientPeer::DEFAULT_STRING_FORMAT);
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

}
