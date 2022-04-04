<?php


/**
 * Base class that represents a query for the 'pizza_ingredients' table.
 *
 *
 *
 * @method Ingredient_pizzaQuery orderByIngredientsId($order = Criteria::ASC) Order by the ingredients_id column
 * @method Ingredient_pizzaQuery orderByPizzasId($order = Criteria::ASC) Order by the pizzas_id column
 *
 * @method Ingredient_pizzaQuery groupByIngredientsId() Group by the ingredients_id column
 * @method Ingredient_pizzaQuery groupByPizzasId() Group by the pizzas_id column
 *
 * @method Ingredient_pizzaQuery leftJoin($relation) Adds a LEFT JOIN clause to the query
 * @method Ingredient_pizzaQuery rightJoin($relation) Adds a RIGHT JOIN clause to the query
 * @method Ingredient_pizzaQuery innerJoin($relation) Adds a INNER JOIN clause to the query
 *
 * @method Ingredient_pizzaQuery leftJoinIngredient($relationAlias = null) Adds a LEFT JOIN clause to the query using the Ingredient relation
 * @method Ingredient_pizzaQuery rightJoinIngredient($relationAlias = null) Adds a RIGHT JOIN clause to the query using the Ingredient relation
 * @method Ingredient_pizzaQuery innerJoinIngredient($relationAlias = null) Adds a INNER JOIN clause to the query using the Ingredient relation
 *
 * @method Ingredient_pizzaQuery leftJoinPizza($relationAlias = null) Adds a LEFT JOIN clause to the query using the Pizza relation
 * @method Ingredient_pizzaQuery rightJoinPizza($relationAlias = null) Adds a RIGHT JOIN clause to the query using the Pizza relation
 * @method Ingredient_pizzaQuery innerJoinPizza($relationAlias = null) Adds a INNER JOIN clause to the query using the Pizza relation
 *
 * @method Ingredient_pizza findOne(PropelPDO $con = null) Return the first Ingredient_pizza matching the query
 * @method Ingredient_pizza findOneOrCreate(PropelPDO $con = null) Return the first Ingredient_pizza matching the query, or a new Ingredient_pizza object populated from the query conditions when no match is found
 *
 * @method Ingredient_pizza findOneByIngredientsId(int $ingredients_id) Return the first Ingredient_pizza filtered by the ingredients_id column
 * @method Ingredient_pizza findOneByPizzasId(int $pizzas_id) Return the first Ingredient_pizza filtered by the pizzas_id column
 *
 * @method array findByIngredientsId(int $ingredients_id) Return Ingredient_pizza objects filtered by the ingredients_id column
 * @method array findByPizzasId(int $pizzas_id) Return Ingredient_pizza objects filtered by the pizzas_id column
 *
 * @package    propel.generator.pizzaService.om
 */
abstract class BaseIngredient_pizzaQuery extends ModelCriteria
{
    /**
     * Initializes internal state of BaseIngredient_pizzaQuery object.
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
            $modelName = 'Ingredient_pizza';
        }
        parent::__construct($dbName, $modelName, $modelAlias);
    }

    /**
     * Returns a new Ingredient_pizzaQuery object.
     *
     * @param     string $modelAlias The alias of a model in the query
     * @param   Ingredient_pizzaQuery|Criteria $criteria Optional Criteria to build the query from
     *
     * @return Ingredient_pizzaQuery
     */
    public static function create($modelAlias = null, $criteria = null)
    {
        if ($criteria instanceof Ingredient_pizzaQuery) {
            return $criteria;
        }
        $query = new Ingredient_pizzaQuery(null, null, $modelAlias);

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
     * $obj = $c->findPk(array(12, 34), $con);
     * </code>
     *
     * @param array $key Primary key to use for the query
                         A Primary key composition: [$ingredients_id, $pizzas_id]
     * @param     PropelPDO $con an optional connection object
     *
     * @return   Ingredient_pizza|Ingredient_pizza[]|mixed the result, formatted by the current formatter
     */
    public function findPk($key, $con = null)
    {
        if ($key === null) {
            return null;
        }
        if ((null !== ($obj = Ingredient_pizzaPeer::getInstanceFromPool(serialize(array((string) $key[0], (string) $key[1]))))) && !$this->formatter) {
            // the object is already in the instance pool
            return $obj;
        }
        if ($con === null) {
            $con = Propel::getConnection(Ingredient_pizzaPeer::DATABASE_NAME, Propel::CONNECTION_READ);
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
     * Find object by primary key using raw SQL to go fast.
     * Bypass doSelect() and the object formatter by using generated code.
     *
     * @param     mixed $key Primary key to use for the query
     * @param     PropelPDO $con A connection object
     *
     * @return                 Ingredient_pizza A model object, or null if the key is not found
     * @throws PropelException
     */
    protected function findPkSimple($key, $con)
    {
        $sql = 'SELECT `ingredients_id`, `pizzas_id` FROM `pizza_ingredients` WHERE `ingredients_id` = :p0 AND `pizzas_id` = :p1';
        try {
            $stmt = $con->prepare($sql);
            $stmt->bindValue(':p0', $key[0], PDO::PARAM_INT);
            $stmt->bindValue(':p1', $key[1], PDO::PARAM_INT);
            $stmt->execute();
        } catch (Exception $e) {
            Propel::log($e->getMessage(), Propel::LOG_ERR);
            throw new PropelException(sprintf('Unable to execute SELECT statement [%s]', $sql), $e);
        }
        $obj = null;
        if ($row = $stmt->fetch(PDO::FETCH_NUM)) {
            $obj = new Ingredient_pizza();
            $obj->hydrate($row);
            Ingredient_pizzaPeer::addInstanceToPool($obj, serialize(array((string) $key[0], (string) $key[1])));
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
     * @return Ingredient_pizza|Ingredient_pizza[]|mixed the result, formatted by the current formatter
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
     * $objs = $c->findPks(array(array(12, 56), array(832, 123), array(123, 456)), $con);
     * </code>
     * @param     array $keys Primary keys to use for the query
     * @param     PropelPDO $con an optional connection object
     *
     * @return PropelObjectCollection|Ingredient_pizza[]|mixed the list of results, formatted by the current formatter
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
     * @return Ingredient_pizzaQuery The current query, for fluid interface
     */
    public function filterByPrimaryKey($key)
    {
        $this->addUsingAlias(Ingredient_pizzaPeer::INGREDIENTS_ID, $key[0], Criteria::EQUAL);
        $this->addUsingAlias(Ingredient_pizzaPeer::PIZZAS_ID, $key[1], Criteria::EQUAL);

        return $this;
    }

    /**
     * Filter the query by a list of primary keys
     *
     * @param     array $keys The list of primary key to use for the query
     *
     * @return Ingredient_pizzaQuery The current query, for fluid interface
     */
    public function filterByPrimaryKeys($keys)
    {
        if (empty($keys)) {
            return $this->add(null, '1<>1', Criteria::CUSTOM);
        }
        foreach ($keys as $key) {
            $cton0 = $this->getNewCriterion(Ingredient_pizzaPeer::INGREDIENTS_ID, $key[0], Criteria::EQUAL);
            $cton1 = $this->getNewCriterion(Ingredient_pizzaPeer::PIZZAS_ID, $key[1], Criteria::EQUAL);
            $cton0->addAnd($cton1);
            $this->addOr($cton0);
        }

        return $this;
    }

    /**
     * Filter the query on the ingredients_id column
     *
     * Example usage:
     * <code>
     * $query->filterByIngredientsId(1234); // WHERE ingredients_id = 1234
     * $query->filterByIngredientsId(array(12, 34)); // WHERE ingredients_id IN (12, 34)
     * $query->filterByIngredientsId(array('min' => 12)); // WHERE ingredients_id >= 12
     * $query->filterByIngredientsId(array('max' => 12)); // WHERE ingredients_id <= 12
     * </code>
     *
     * @see       filterByIngredient()
     *
     * @param     mixed $ingredientsId The value to use as filter.
     *              Use scalar values for equality.
     *              Use array values for in_array() equivalent.
     *              Use associative array('min' => $minValue, 'max' => $maxValue) for intervals.
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return Ingredient_pizzaQuery The current query, for fluid interface
     */
    public function filterByIngredientsId($ingredientsId = null, $comparison = null)
    {
        if (is_array($ingredientsId)) {
            $useMinMax = false;
            if (isset($ingredientsId['min'])) {
                $this->addUsingAlias(Ingredient_pizzaPeer::INGREDIENTS_ID, $ingredientsId['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($ingredientsId['max'])) {
                $this->addUsingAlias(Ingredient_pizzaPeer::INGREDIENTS_ID, $ingredientsId['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        return $this->addUsingAlias(Ingredient_pizzaPeer::INGREDIENTS_ID, $ingredientsId, $comparison);
    }

    /**
     * Filter the query on the pizzas_id column
     *
     * Example usage:
     * <code>
     * $query->filterByPizzasId(1234); // WHERE pizzas_id = 1234
     * $query->filterByPizzasId(array(12, 34)); // WHERE pizzas_id IN (12, 34)
     * $query->filterByPizzasId(array('min' => 12)); // WHERE pizzas_id >= 12
     * $query->filterByPizzasId(array('max' => 12)); // WHERE pizzas_id <= 12
     * </code>
     *
     * @see       filterByPizza()
     *
     * @param     mixed $pizzasId The value to use as filter.
     *              Use scalar values for equality.
     *              Use array values for in_array() equivalent.
     *              Use associative array('min' => $minValue, 'max' => $maxValue) for intervals.
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return Ingredient_pizzaQuery The current query, for fluid interface
     */
    public function filterByPizzasId($pizzasId = null, $comparison = null)
    {
        if (is_array($pizzasId)) {
            $useMinMax = false;
            if (isset($pizzasId['min'])) {
                $this->addUsingAlias(Ingredient_pizzaPeer::PIZZAS_ID, $pizzasId['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($pizzasId['max'])) {
                $this->addUsingAlias(Ingredient_pizzaPeer::PIZZAS_ID, $pizzasId['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        return $this->addUsingAlias(Ingredient_pizzaPeer::PIZZAS_ID, $pizzasId, $comparison);
    }

    /**
     * Filter the query by a related Ingredient object
     *
     * @param   Ingredient|PropelObjectCollection $ingredient The related object(s) to use as filter
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return                 Ingredient_pizzaQuery The current query, for fluid interface
     * @throws PropelException - if the provided filter is invalid.
     */
    public function filterByIngredient($ingredient, $comparison = null)
    {
        if ($ingredient instanceof Ingredient) {
            return $this
                ->addUsingAlias(Ingredient_pizzaPeer::INGREDIENTS_ID, $ingredient->getId(), $comparison);
        } elseif ($ingredient instanceof PropelObjectCollection) {
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }

            return $this
                ->addUsingAlias(Ingredient_pizzaPeer::INGREDIENTS_ID, $ingredient->toKeyValue('PrimaryKey', 'Id'), $comparison);
        } else {
            throw new PropelException('filterByIngredient() only accepts arguments of type Ingredient or PropelCollection');
        }
    }

    /**
     * Adds a JOIN clause to the query using the Ingredient relation
     *
     * @param     string $relationAlias optional alias for the relation
     * @param     string $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return Ingredient_pizzaQuery The current query, for fluid interface
     */
    public function joinIngredient($relationAlias = null, $joinType = Criteria::INNER_JOIN)
    {
        $tableMap = $this->getTableMap();
        $relationMap = $tableMap->getRelation('Ingredient');

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
            $this->addJoinObject($join, 'Ingredient');
        }

        return $this;
    }

    /**
     * Use the Ingredient relation Ingredient object
     *
     * @see       useQuery()
     *
     * @param     string $relationAlias optional alias for the relation,
     *                                   to be used as main alias in the secondary query
     * @param     string $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return   IngredientQuery A secondary query class using the current class as primary query
     */
    public function useIngredientQuery($relationAlias = null, $joinType = Criteria::INNER_JOIN)
    {
        return $this
            ->joinIngredient($relationAlias, $joinType)
            ->useQuery($relationAlias ? $relationAlias : 'Ingredient', 'IngredientQuery');
    }

    /**
     * Filter the query by a related Pizza object
     *
     * @param   Pizza|PropelObjectCollection $pizza The related object(s) to use as filter
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return                 Ingredient_pizzaQuery The current query, for fluid interface
     * @throws PropelException - if the provided filter is invalid.
     */
    public function filterByPizza($pizza, $comparison = null)
    {
        if ($pizza instanceof Pizza) {
            return $this
                ->addUsingAlias(Ingredient_pizzaPeer::PIZZAS_ID, $pizza->getId(), $comparison);
        } elseif ($pizza instanceof PropelObjectCollection) {
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }

            return $this
                ->addUsingAlias(Ingredient_pizzaPeer::PIZZAS_ID, $pizza->toKeyValue('PrimaryKey', 'Id'), $comparison);
        } else {
            throw new PropelException('filterByPizza() only accepts arguments of type Pizza or PropelCollection');
        }
    }

    /**
     * Adds a JOIN clause to the query using the Pizza relation
     *
     * @param     string $relationAlias optional alias for the relation
     * @param     string $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return Ingredient_pizzaQuery The current query, for fluid interface
     */
    public function joinPizza($relationAlias = null, $joinType = Criteria::INNER_JOIN)
    {
        $tableMap = $this->getTableMap();
        $relationMap = $tableMap->getRelation('Pizza');

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
            $this->addJoinObject($join, 'Pizza');
        }

        return $this;
    }

    /**
     * Use the Pizza relation Pizza object
     *
     * @see       useQuery()
     *
     * @param     string $relationAlias optional alias for the relation,
     *                                   to be used as main alias in the secondary query
     * @param     string $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return   PizzaQuery A secondary query class using the current class as primary query
     */
    public function usePizzaQuery($relationAlias = null, $joinType = Criteria::INNER_JOIN)
    {
        return $this
            ->joinPizza($relationAlias, $joinType)
            ->useQuery($relationAlias ? $relationAlias : 'Pizza', 'PizzaQuery');
    }

    /**
     * Exclude object from result
     *
     * @param   Ingredient_pizza $ingredient_pizza Object to remove from the list of results
     *
     * @return Ingredient_pizzaQuery The current query, for fluid interface
     */
    public function prune($ingredient_pizza = null)
    {
        if ($ingredient_pizza) {
            $this->addCond('pruneCond0', $this->getAliasedColName(Ingredient_pizzaPeer::INGREDIENTS_ID), $ingredient_pizza->getIngredientsId(), Criteria::NOT_EQUAL);
            $this->addCond('pruneCond1', $this->getAliasedColName(Ingredient_pizzaPeer::PIZZAS_ID), $ingredient_pizza->getPizzasId(), Criteria::NOT_EQUAL);
            $this->combine(array('pruneCond0', 'pruneCond1'), Criteria::LOGICAL_OR);
        }

        return $this;
    }

}
