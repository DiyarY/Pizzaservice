<?php


/**
 * Base class that represents a query for the 'order_pizzas' table.
 *
 *
 *
 * @method Order_PizzaQuery orderByOrdersId($order = Criteria::ASC) Order by the orders_id column
 * @method Order_PizzaQuery orderByPizzasId($order = Criteria::ASC) Order by the pizzas_id column
 * @method Order_PizzaQuery orderByAmount($order = Criteria::ASC) Order by the amount column
 *
 * @method Order_PizzaQuery groupByOrdersId() Group by the orders_id column
 * @method Order_PizzaQuery groupByPizzasId() Group by the pizzas_id column
 * @method Order_PizzaQuery groupByAmount() Group by the amount column
 *
 * @method Order_PizzaQuery leftJoin($relation) Adds a LEFT JOIN clause to the query
 * @method Order_PizzaQuery rightJoin($relation) Adds a RIGHT JOIN clause to the query
 * @method Order_PizzaQuery innerJoin($relation) Adds a INNER JOIN clause to the query
 *
 * @method Order_PizzaQuery leftJoinOrder($relationAlias = null) Adds a LEFT JOIN clause to the query using the Order relation
 * @method Order_PizzaQuery rightJoinOrder($relationAlias = null) Adds a RIGHT JOIN clause to the query using the Order relation
 * @method Order_PizzaQuery innerJoinOrder($relationAlias = null) Adds a INNER JOIN clause to the query using the Order relation
 *
 * @method Order_PizzaQuery leftJoinPizza($relationAlias = null) Adds a LEFT JOIN clause to the query using the Pizza relation
 * @method Order_PizzaQuery rightJoinPizza($relationAlias = null) Adds a RIGHT JOIN clause to the query using the Pizza relation
 * @method Order_PizzaQuery innerJoinPizza($relationAlias = null) Adds a INNER JOIN clause to the query using the Pizza relation
 *
 * @method Order_Pizza findOne(PropelPDO $con = null) Return the first Order_Pizza matching the query
 * @method Order_Pizza findOneOrCreate(PropelPDO $con = null) Return the first Order_Pizza matching the query, or a new Order_Pizza object populated from the query conditions when no match is found
 *
 * @method Order_Pizza findOneByOrdersId(int $orders_id) Return the first Order_Pizza filtered by the orders_id column
 * @method Order_Pizza findOneByPizzasId(int $pizzas_id) Return the first Order_Pizza filtered by the pizzas_id column
 * @method Order_Pizza findOneByAmount(double $amount) Return the first Order_Pizza filtered by the amount column
 *
 * @method array findByOrdersId(int $orders_id) Return Order_Pizza objects filtered by the orders_id column
 * @method array findByPizzasId(int $pizzas_id) Return Order_Pizza objects filtered by the pizzas_id column
 * @method array findByAmount(double $amount) Return Order_Pizza objects filtered by the amount column
 *
 * @package    propel.generator.pizzaService.om
 */
abstract class BaseOrder_PizzaQuery extends ModelCriteria
{
    /**
     * Initializes internal state of BaseOrder_PizzaQuery object.
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
            $modelName = 'Order_Pizza';
        }
        parent::__construct($dbName, $modelName, $modelAlias);
    }

    /**
     * Returns a new Order_PizzaQuery object.
     *
     * @param     string $modelAlias The alias of a model in the query
     * @param   Order_PizzaQuery|Criteria $criteria Optional Criteria to build the query from
     *
     * @return Order_PizzaQuery
     */
    public static function create($modelAlias = null, $criteria = null)
    {
        if ($criteria instanceof Order_PizzaQuery) {
            return $criteria;
        }
        $query = new Order_PizzaQuery(null, null, $modelAlias);

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
                         A Primary key composition: [$orders_id, $pizzas_id]
     * @param     PropelPDO $con an optional connection object
     *
     * @return   Order_Pizza|Order_Pizza[]|mixed the result, formatted by the current formatter
     */
    public function findPk($key, $con = null)
    {
        if ($key === null) {
            return null;
        }
        if ((null !== ($obj = Order_PizzaPeer::getInstanceFromPool(serialize(array((string) $key[0], (string) $key[1]))))) && !$this->formatter) {
            // the object is already in the instance pool
            return $obj;
        }
        if ($con === null) {
            $con = Propel::getConnection(Order_PizzaPeer::DATABASE_NAME, Propel::CONNECTION_READ);
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
     * @return                 Order_Pizza A model object, or null if the key is not found
     * @throws PropelException
     */
    protected function findPkSimple($key, $con)
    {
        $sql = 'SELECT `orders_id`, `pizzas_id`, `amount` FROM `order_pizzas` WHERE `orders_id` = :p0 AND `pizzas_id` = :p1';
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
            $obj = new Order_Pizza();
            $obj->hydrate($row);
            Order_PizzaPeer::addInstanceToPool($obj, serialize(array((string) $key[0], (string) $key[1])));
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
     * @return Order_Pizza|Order_Pizza[]|mixed the result, formatted by the current formatter
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
     * @return PropelObjectCollection|Order_Pizza[]|mixed the list of results, formatted by the current formatter
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
     * @return Order_PizzaQuery The current query, for fluid interface
     */
    public function filterByPrimaryKey($key)
    {
        $this->addUsingAlias(Order_PizzaPeer::ORDERS_ID, $key[0], Criteria::EQUAL);
        $this->addUsingAlias(Order_PizzaPeer::PIZZAS_ID, $key[1], Criteria::EQUAL);

        return $this;
    }

    /**
     * Filter the query by a list of primary keys
     *
     * @param     array $keys The list of primary key to use for the query
     *
     * @return Order_PizzaQuery The current query, for fluid interface
     */
    public function filterByPrimaryKeys($keys)
    {
        if (empty($keys)) {
            return $this->add(null, '1<>1', Criteria::CUSTOM);
        }
        foreach ($keys as $key) {
            $cton0 = $this->getNewCriterion(Order_PizzaPeer::ORDERS_ID, $key[0], Criteria::EQUAL);
            $cton1 = $this->getNewCriterion(Order_PizzaPeer::PIZZAS_ID, $key[1], Criteria::EQUAL);
            $cton0->addAnd($cton1);
            $this->addOr($cton0);
        }

        return $this;
    }

    /**
     * Filter the query on the orders_id column
     *
     * Example usage:
     * <code>
     * $query->filterByOrdersId(1234); // WHERE orders_id = 1234
     * $query->filterByOrdersId(array(12, 34)); // WHERE orders_id IN (12, 34)
     * $query->filterByOrdersId(array('min' => 12)); // WHERE orders_id >= 12
     * $query->filterByOrdersId(array('max' => 12)); // WHERE orders_id <= 12
     * </code>
     *
     * @see       filterByOrder()
     *
     * @param     mixed $ordersId The value to use as filter.
     *              Use scalar values for equality.
     *              Use array values for in_array() equivalent.
     *              Use associative array('min' => $minValue, 'max' => $maxValue) for intervals.
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return Order_PizzaQuery The current query, for fluid interface
     */
    public function filterByOrdersId($ordersId = null, $comparison = null)
    {
        if (is_array($ordersId)) {
            $useMinMax = false;
            if (isset($ordersId['min'])) {
                $this->addUsingAlias(Order_PizzaPeer::ORDERS_ID, $ordersId['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($ordersId['max'])) {
                $this->addUsingAlias(Order_PizzaPeer::ORDERS_ID, $ordersId['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        return $this->addUsingAlias(Order_PizzaPeer::ORDERS_ID, $ordersId, $comparison);
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
     * @return Order_PizzaQuery The current query, for fluid interface
     */
    public function filterByPizzasId($pizzasId = null, $comparison = null)
    {
        if (is_array($pizzasId)) {
            $useMinMax = false;
            if (isset($pizzasId['min'])) {
                $this->addUsingAlias(Order_PizzaPeer::PIZZAS_ID, $pizzasId['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($pizzasId['max'])) {
                $this->addUsingAlias(Order_PizzaPeer::PIZZAS_ID, $pizzasId['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        return $this->addUsingAlias(Order_PizzaPeer::PIZZAS_ID, $pizzasId, $comparison);
    }

    /**
     * Filter the query on the amount column
     *
     * Example usage:
     * <code>
     * $query->filterByAmount(1234); // WHERE amount = 1234
     * $query->filterByAmount(array(12, 34)); // WHERE amount IN (12, 34)
     * $query->filterByAmount(array('min' => 12)); // WHERE amount >= 12
     * $query->filterByAmount(array('max' => 12)); // WHERE amount <= 12
     * </code>
     *
     * @param     mixed $amount The value to use as filter.
     *              Use scalar values for equality.
     *              Use array values for in_array() equivalent.
     *              Use associative array('min' => $minValue, 'max' => $maxValue) for intervals.
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return Order_PizzaQuery The current query, for fluid interface
     */
    public function filterByAmount($amount = null, $comparison = null)
    {
        if (is_array($amount)) {
            $useMinMax = false;
            if (isset($amount['min'])) {
                $this->addUsingAlias(Order_PizzaPeer::AMOUNT, $amount['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($amount['max'])) {
                $this->addUsingAlias(Order_PizzaPeer::AMOUNT, $amount['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        return $this->addUsingAlias(Order_PizzaPeer::AMOUNT, $amount, $comparison);
    }

    /**
     * Filter the query by a related Order object
     *
     * @param   Order|PropelObjectCollection $order The related object(s) to use as filter
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return                 Order_PizzaQuery The current query, for fluid interface
     * @throws PropelException - if the provided filter is invalid.
     */
    public function filterByOrder($order, $comparison = null)
    {
        if ($order instanceof Order) {
            return $this
                ->addUsingAlias(Order_PizzaPeer::ORDERS_ID, $order->getId(), $comparison);
        } elseif ($order instanceof PropelObjectCollection) {
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }

            return $this
                ->addUsingAlias(Order_PizzaPeer::ORDERS_ID, $order->toKeyValue('PrimaryKey', 'Id'), $comparison);
        } else {
            throw new PropelException('filterByOrder() only accepts arguments of type Order or PropelCollection');
        }
    }

    /**
     * Adds a JOIN clause to the query using the Order relation
     *
     * @param     string $relationAlias optional alias for the relation
     * @param     string $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return Order_PizzaQuery The current query, for fluid interface
     */
    public function joinOrder($relationAlias = null, $joinType = Criteria::INNER_JOIN)
    {
        $tableMap = $this->getTableMap();
        $relationMap = $tableMap->getRelation('Order');

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
            $this->addJoinObject($join, 'Order');
        }

        return $this;
    }

    /**
     * Use the Order relation Order object
     *
     * @see       useQuery()
     *
     * @param     string $relationAlias optional alias for the relation,
     *                                   to be used as main alias in the secondary query
     * @param     string $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return   OrderQuery A secondary query class using the current class as primary query
     */
    public function useOrderQuery($relationAlias = null, $joinType = Criteria::INNER_JOIN)
    {
        return $this
            ->joinOrder($relationAlias, $joinType)
            ->useQuery($relationAlias ? $relationAlias : 'Order', 'OrderQuery');
    }

    /**
     * Filter the query by a related Pizza object
     *
     * @param   Pizza|PropelObjectCollection $pizza The related object(s) to use as filter
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return                 Order_PizzaQuery The current query, for fluid interface
     * @throws PropelException - if the provided filter is invalid.
     */
    public function filterByPizza($pizza, $comparison = null)
    {
        if ($pizza instanceof Pizza) {
            return $this
                ->addUsingAlias(Order_PizzaPeer::PIZZAS_ID, $pizza->getId(), $comparison);
        } elseif ($pizza instanceof PropelObjectCollection) {
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }

            return $this
                ->addUsingAlias(Order_PizzaPeer::PIZZAS_ID, $pizza->toKeyValue('PrimaryKey', 'Id'), $comparison);
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
     * @return Order_PizzaQuery The current query, for fluid interface
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
     * @param   Order_Pizza $order_Pizza Object to remove from the list of results
     *
     * @return Order_PizzaQuery The current query, for fluid interface
     */
    public function prune($order_Pizza = null)
    {
        if ($order_Pizza) {
            $this->addCond('pruneCond0', $this->getAliasedColName(Order_PizzaPeer::ORDERS_ID), $order_Pizza->getOrdersId(), Criteria::NOT_EQUAL);
            $this->addCond('pruneCond1', $this->getAliasedColName(Order_PizzaPeer::PIZZAS_ID), $order_Pizza->getPizzasId(), Criteria::NOT_EQUAL);
            $this->combine(array('pruneCond0', 'pruneCond1'), Criteria::LOGICAL_OR);
        }

        return $this;
    }

}
