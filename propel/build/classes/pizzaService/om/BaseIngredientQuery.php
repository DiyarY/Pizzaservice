<?php


/**
 * Base class that represents a query for the 'ingredients' table.
 *
 *
 *
 * @method IngredientQuery orderById($order = Criteria::ASC) Order by the id column
 * @method IngredientQuery orderByName($order = Criteria::ASC) Order by the name column
 *
 * @method IngredientQuery groupById() Group by the id column
 * @method IngredientQuery groupByName() Group by the name column
 *
 * @method IngredientQuery leftJoin($relation) Adds a LEFT JOIN clause to the query
 * @method IngredientQuery rightJoin($relation) Adds a RIGHT JOIN clause to the query
 * @method IngredientQuery innerJoin($relation) Adds a INNER JOIN clause to the query
 *
 * @method IngredientQuery leftJoinIngredient_pizza($relationAlias = null) Adds a LEFT JOIN clause to the query using the Ingredient_pizza relation
 * @method IngredientQuery rightJoinIngredient_pizza($relationAlias = null) Adds a RIGHT JOIN clause to the query using the Ingredient_pizza relation
 * @method IngredientQuery innerJoinIngredient_pizza($relationAlias = null) Adds a INNER JOIN clause to the query using the Ingredient_pizza relation
 *
 * @method Ingredient findOne(PropelPDO $con = null) Return the first Ingredient matching the query
 * @method Ingredient findOneOrCreate(PropelPDO $con = null) Return the first Ingredient matching the query, or a new Ingredient object populated from the query conditions when no match is found
 *
 * @method Ingredient findOneByName(string $name) Return the first Ingredient filtered by the name column
 *
 * @method array findById(int $id) Return Ingredient objects filtered by the id column
 * @method array findByName(string $name) Return Ingredient objects filtered by the name column
 *
 * @package    propel.generator.pizzaService.om
 */
abstract class BaseIngredientQuery extends ModelCriteria
{
    /**
     * Initializes internal state of BaseIngredientQuery object.
     *
     * @param     string $dbName The dabase name
     * @param     string $modelName The phpName of a model, e.g. 'Book'
     * @param     string $modelAlias The alias for the model in this query, e.g. 'b'
     */
    public function __construct($dbName = null, $modelName = null, $modelAlias = null)
    {
        if (null === $dbName) {
            $dbName = 'pizzaService';
        }
        if (null === $modelName) {
            $modelName = 'Ingredient';
        }
        parent::__construct($dbName, $modelName, $modelAlias);
    }

    /**
     * Returns a new IngredientQuery object.
     *
     * @param     string $modelAlias The alias of a model in the query
     * @param   IngredientQuery|Criteria $criteria Optional Criteria to build the query from
     *
     * @return IngredientQuery
     */
    public static function create($modelAlias = null, $criteria = null)
    {
        if ($criteria instanceof IngredientQuery) {
            return $criteria;
        }
        $query = new IngredientQuery(null, null, $modelAlias);

        if ($criteria instanceof Criteria) {
            $query->mergeWith($criteria);
        }

        return $query;
    }

    /**
     * Find object by primary key.
     * Propel uses the instance pool to skip the database if the object exists.
     * Go fast if the query is untouched.
     *
     * <code>
     * $obj  = $c->findPk(12, $con);
     * </code>
     *
     * @param mixed $key Primary key to use for the query
     * @param     PropelPDO $con an optional connection object
     *
     * @return   Ingredient|Ingredient[]|mixed the result, formatted by the current formatter
     */
    public function findPk($key, $con = null)
    {
        if ($key === null) {
            return null;
        }
        if ((null !== ($obj = IngredientPeer::getInstanceFromPool((string) $key))) && !$this->formatter) {
            // the object is already in the instance pool
            return $obj;
        }
        if ($con === null) {
            $con = Propel::getConnection(IngredientPeer::DATABASE_NAME, Propel::CONNECTION_READ);
        }
        $this->basePreSelect($con);
        if ($this->formatter || $this->modelAlias || $this->with || $this->select
         || $this->selectColumns || $this->asColumns || $this->selectModifiers
         || $this->map || $this->having || $this->joins) {
            return $this->findPkComplex($key, $con);
        } else {
            return $this->findPkSimple($key, $con);
        }
    }

    /**
     * Alias of findPk to use instance pooling
     *
     * @param     mixed $key Primary key to use for the query
     * @param     PropelPDO $con A connection object
     *
     * @return                 Ingredient A model object, or null if the key is not found
     * @throws PropelException
     */
     public function findOneById($key, $con = null)
     {
        return $this->findPk($key, $con);
     }

    /**
     * Find object by primary key using raw SQL to go fast.
     * Bypass doSelect() and the object formatter by using generated code.
     *
     * @param     mixed $key Primary key to use for the query
     * @param     PropelPDO $con A connection object
     *
     * @return                 Ingredient A model object, or null if the key is not found
     * @throws PropelException
     */
    protected function findPkSimple($key, $con)
    {
        $sql = 'SELECT `id`, `name` FROM `ingredients` WHERE `id` = :p0';
        try {
            $stmt = $con->prepare($sql);
            $stmt->bindValue(':p0', $key, PDO::PARAM_INT);
            $stmt->execute();
        } catch (Exception $e) {
            Propel::log($e->getMessage(), Propel::LOG_ERR);
            throw new PropelException(sprintf('Unable to execute SELECT statement [%s]', $sql), $e);
        }
        $obj = null;
        if ($row = $stmt->fetch(PDO::FETCH_NUM)) {
            $obj = new Ingredient();
            $obj->hydrate($row);
            IngredientPeer::addInstanceToPool($obj, (string) $key);
        }
        $stmt->closeCursor();

        return $obj;
    }

    /**
     * Find object by primary key.
     *
     * @param     mixed $key Primary key to use for the query
     * @param     PropelPDO $con A connection object
     *
     * @return Ingredient|Ingredient[]|mixed the result, formatted by the current formatter
     */
    protected function findPkComplex($key, $con)
    {
        // As the query uses a PK condition, no limit(1) is necessary.
        $criteria = $this->isKeepQuery() ? clone $this : $this;
        $stmt = $criteria
            ->filterByPrimaryKey($key)
            ->doSelect($con);

        return $criteria->getFormatter()->init($criteria)->formatOne($stmt);
    }

    /**
     * Find objects by primary key
     * <code>
     * $objs = $c->findPks(array(12, 56, 832), $con);
     * </code>
     * @param     array $keys Primary keys to use for the query
     * @param     PropelPDO $con an optional connection object
     *
     * @return PropelObjectCollection|Ingredient[]|mixed the list of results, formatted by the current formatter
     */
    public function findPks($keys, $con = null)
    {
        if ($con === null) {
            $con = Propel::getConnection($this->getDbName(), Propel::CONNECTION_READ);
        }
        $this->basePreSelect($con);
        $criteria = $this->isKeepQuery() ? clone $this : $this;
        $stmt = $criteria
            ->filterByPrimaryKeys($keys)
            ->doSelect($con);

        return $criteria->getFormatter()->init($criteria)->format($stmt);
    }

    /**
     * Filter the query by primary key
     *
     * @param     mixed $key Primary key to use for the query
     *
     * @return IngredientQuery The current query, for fluid interface
     */
    public function filterByPrimaryKey($key)
    {

        return $this->addUsingAlias(IngredientPeer::ID, $key, Criteria::EQUAL);
    }

    /**
     * Filter the query by a list of primary keys
     *
     * @param     array $keys The list of primary key to use for the query
     *
     * @return IngredientQuery The current query, for fluid interface
     */
    public function filterByPrimaryKeys($keys)
    {

        return $this->addUsingAlias(IngredientPeer::ID, $keys, Criteria::IN);
    }

    /**
     * Filter the query on the id column
     *
     * Example usage:
     * <code>
     * $query->filterById(1234); // WHERE id = 1234
     * $query->filterById(array(12, 34)); // WHERE id IN (12, 34)
     * $query->filterById(array('min' => 12)); // WHERE id >= 12
     * $query->filterById(array('max' => 12)); // WHERE id <= 12
     * </code>
     *
     * @param     mixed $id The value to use as filter.
     *              Use scalar values for equality.
     *              Use array values for in_array() equivalent.
     *              Use associative array('min' => $minValue, 'max' => $maxValue) for intervals.
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return IngredientQuery The current query, for fluid interface
     */
    public function filterById($id = null, $comparison = null)
    {
        if (is_array($id)) {
            $useMinMax = false;
            if (isset($id['min'])) {
                $this->addUsingAlias(IngredientPeer::ID, $id['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($id['max'])) {
                $this->addUsingAlias(IngredientPeer::ID, $id['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        return $this->addUsingAlias(IngredientPeer::ID, $id, $comparison);
    }

    /**
     * Filter the query on the name column
     *
     * Example usage:
     * <code>
     * $query->filterByName('fooValue');   // WHERE name = 'fooValue'
     * $query->filterByName('%fooValue%'); // WHERE name LIKE '%fooValue%'
     * </code>
     *
     * @param     string $name The value to use as filter.
     *              Accepts wildcards (* and % trigger a LIKE)
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return IngredientQuery The current query, for fluid interface
     */
    public function filterByName($name = null, $comparison = null)
    {
        if (null === $comparison) {
            if (is_array($name)) {
                $comparison = Criteria::IN;
            } elseif (preg_match('/[\%\*]/', $name)) {
                $name = str_replace('*', '%', $name);
                $comparison = Criteria::LIKE;
            }
        }

        return $this->addUsingAlias(IngredientPeer::NAME, $name, $comparison);
    }

    /**
     * Filter the query by a related Ingredient_pizza object
     *
     * @param   Ingredient_pizza|PropelObjectCollection $ingredient_pizza  the related object to use as filter
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return                 IngredientQuery The current query, for fluid interface
     * @throws PropelException - if the provided filter is invalid.
     */
    public function filterByIngredient_pizza($ingredient_pizza, $comparison = null)
    {
        if ($ingredient_pizza instanceof Ingredient_pizza) {
            return $this
                ->addUsingAlias(IngredientPeer::ID, $ingredient_pizza->getIngredientsId(), $comparison);
        } elseif ($ingredient_pizza instanceof PropelObjectCollection) {
            return $this
                ->useIngredient_pizzaQuery()
                ->filterByPrimaryKeys($ingredient_pizza->getPrimaryKeys())
                ->endUse();
        } else {
            throw new PropelException('filterByIngredient_pizza() only accepts arguments of type Ingredient_pizza or PropelCollection');
        }
    }

    /**
     * Adds a JOIN clause to the query using the Ingredient_pizza relation
     *
     * @param     string $relationAlias optional alias for the relation
     * @param     string $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return IngredientQuery The current query, for fluid interface
     */
    public function joinIngredient_pizza($relationAlias = null, $joinType = Criteria::INNER_JOIN)
    {
        $tableMap = $this->getTableMap();
        $relationMap = $tableMap->getRelation('Ingredient_pizza');

        // create a ModelJoin object for this join
        $join = new ModelJoin();
        $join->setJoinType($joinType);
        $join->setRelationMap($relationMap, $this->useAliasInSQL ? $this->getModelAlias() : null, $relationAlias);
        if ($previousJoin = $this->getPreviousJoin()) {
            $join->setPreviousJoin($previousJoin);
        }

        // add the ModelJoin to the current object
        if ($relationAlias) {
            $this->addAlias($relationAlias, $relationMap->getRightTable()->getName());
            $this->addJoinObject($join, $relationAlias);
        } else {
            $this->addJoinObject($join, 'Ingredient_pizza');
        }

        return $this;
    }

    /**
     * Use the Ingredient_pizza relation Ingredient_pizza object
     *
     * @see       useQuery()
     *
     * @param     string $relationAlias optional alias for the relation,
     *                                   to be used as main alias in the secondary query
     * @param     string $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return   Ingredient_pizzaQuery A secondary query class using the current class as primary query
     */
    public function useIngredient_pizzaQuery($relationAlias = null, $joinType = Criteria::INNER_JOIN)
    {
        return $this
            ->joinIngredient_pizza($relationAlias, $joinType)
            ->useQuery($relationAlias ? $relationAlias : 'Ingredient_pizza', 'Ingredient_pizzaQuery');
    }

    /**
     * Filter the query by a related Pizza object
     * using the pizza_ingredients table as cross reference
     *
     * @param   Pizza $pizza the related object to use as filter
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return   IngredientQuery The current query, for fluid interface
     */
    public function filterByPizza($pizza, $comparison = Criteria::EQUAL)
    {
        return $this
            ->useIngredient_pizzaQuery()
            ->filterByPizza($pizza, $comparison)
            ->endUse();
    }

    /**
     * Exclude object from result
     *
     * @param   Ingredient $ingredient Object to remove from the list of results
     *
     * @return IngredientQuery The current query, for fluid interface
     */
    public function prune($ingredient = null)
    {
        if ($ingredient) {
            $this->addUsingAlias(IngredientPeer::ID, $ingredient->getId(), Criteria::NOT_EQUAL);
        }

        return $this;
    }

}
