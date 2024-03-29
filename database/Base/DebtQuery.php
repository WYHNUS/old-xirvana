<?php

namespace Base;

use \Debt as ChildDebt;
use \DebtQuery as ChildDebtQuery;
use \Exception;
use \PDO;
use Map\DebtTableMap;
use Propel\Runtime\Propel;
use Propel\Runtime\ActiveQuery\Criteria;
use Propel\Runtime\ActiveQuery\ModelCriteria;
use Propel\Runtime\ActiveQuery\ModelJoin;
use Propel\Runtime\Collection\ObjectCollection;
use Propel\Runtime\Connection\ConnectionInterface;
use Propel\Runtime\Exception\PropelException;

/**
 * Base class that represents a query for the 'Debt' table.
 *
 *
 *
 * @method     ChildDebtQuery orderByCreditor($order = Criteria::ASC) Order by the creditor column
 * @method     ChildDebtQuery orderByDebtor($order = Criteria::ASC) Order by the debtor column
 * @method     ChildDebtQuery orderByAmount($order = Criteria::ASC) Order by the amount column
 *
 * @method     ChildDebtQuery groupByCreditor() Group by the creditor column
 * @method     ChildDebtQuery groupByDebtor() Group by the debtor column
 * @method     ChildDebtQuery groupByAmount() Group by the amount column
 *
 * @method     ChildDebtQuery leftJoin($relation) Adds a LEFT JOIN clause to the query
 * @method     ChildDebtQuery rightJoin($relation) Adds a RIGHT JOIN clause to the query
 * @method     ChildDebtQuery innerJoin($relation) Adds a INNER JOIN clause to the query
 *
 * @method     ChildDebtQuery leftJoinWith($relation) Adds a LEFT JOIN clause and with to the query
 * @method     ChildDebtQuery rightJoinWith($relation) Adds a RIGHT JOIN clause and with to the query
 * @method     ChildDebtQuery innerJoinWith($relation) Adds a INNER JOIN clause and with to the query
 *
 * @method     ChildDebtQuery leftJoinDebt_Creditor($relationAlias = null) Adds a LEFT JOIN clause to the query using the Debt_Creditor relation
 * @method     ChildDebtQuery rightJoinDebt_Creditor($relationAlias = null) Adds a RIGHT JOIN clause to the query using the Debt_Creditor relation
 * @method     ChildDebtQuery innerJoinDebt_Creditor($relationAlias = null) Adds a INNER JOIN clause to the query using the Debt_Creditor relation
 *
 * @method     ChildDebtQuery joinWithDebt_Creditor($joinType = Criteria::INNER_JOIN) Adds a join clause and with to the query using the Debt_Creditor relation
 *
 * @method     ChildDebtQuery leftJoinWithDebt_Creditor() Adds a LEFT JOIN clause and with to the query using the Debt_Creditor relation
 * @method     ChildDebtQuery rightJoinWithDebt_Creditor() Adds a RIGHT JOIN clause and with to the query using the Debt_Creditor relation
 * @method     ChildDebtQuery innerJoinWithDebt_Creditor() Adds a INNER JOIN clause and with to the query using the Debt_Creditor relation
 *
 * @method     ChildDebtQuery leftJoinDebt_Debtor($relationAlias = null) Adds a LEFT JOIN clause to the query using the Debt_Debtor relation
 * @method     ChildDebtQuery rightJoinDebt_Debtor($relationAlias = null) Adds a RIGHT JOIN clause to the query using the Debt_Debtor relation
 * @method     ChildDebtQuery innerJoinDebt_Debtor($relationAlias = null) Adds a INNER JOIN clause to the query using the Debt_Debtor relation
 *
 * @method     ChildDebtQuery joinWithDebt_Debtor($joinType = Criteria::INNER_JOIN) Adds a join clause and with to the query using the Debt_Debtor relation
 *
 * @method     ChildDebtQuery leftJoinWithDebt_Debtor() Adds a LEFT JOIN clause and with to the query using the Debt_Debtor relation
 * @method     ChildDebtQuery rightJoinWithDebt_Debtor() Adds a RIGHT JOIN clause and with to the query using the Debt_Debtor relation
 * @method     ChildDebtQuery innerJoinWithDebt_Debtor() Adds a INNER JOIN clause and with to the query using the Debt_Debtor relation
 *
 * @method     \UsersQuery endUse() Finalizes a secondary criteria and merges it with its primary Criteria
 *
 * @method     ChildDebt findOne(ConnectionInterface $con = null) Return the first ChildDebt matching the query
 * @method     ChildDebt findOneOrCreate(ConnectionInterface $con = null) Return the first ChildDebt matching the query, or a new ChildDebt object populated from the query conditions when no match is found
 *
 * @method     ChildDebt findOneByCreditor(string $creditor) Return the first ChildDebt filtered by the creditor column
 * @method     ChildDebt findOneByDebtor(string $debtor) Return the first ChildDebt filtered by the debtor column
 * @method     ChildDebt findOneByAmount(string $amount) Return the first ChildDebt filtered by the amount column *

 * @method     ChildDebt requirePk($key, ConnectionInterface $con = null) Return the ChildDebt by primary key and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildDebt requireOne(ConnectionInterface $con = null) Return the first ChildDebt matching the query and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 *
 * @method     ChildDebt requireOneByCreditor(string $creditor) Return the first ChildDebt filtered by the creditor column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildDebt requireOneByDebtor(string $debtor) Return the first ChildDebt filtered by the debtor column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildDebt requireOneByAmount(string $amount) Return the first ChildDebt filtered by the amount column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 *
 * @method     ChildDebt[]|ObjectCollection find(ConnectionInterface $con = null) Return ChildDebt objects based on current ModelCriteria
 * @method     ChildDebt[]|ObjectCollection findByCreditor(string $creditor) Return ChildDebt objects filtered by the creditor column
 * @method     ChildDebt[]|ObjectCollection findByDebtor(string $debtor) Return ChildDebt objects filtered by the debtor column
 * @method     ChildDebt[]|ObjectCollection findByAmount(string $amount) Return ChildDebt objects filtered by the amount column
 * @method     ChildDebt[]|\Propel\Runtime\Util\PropelModelPager paginate($page = 1, $maxPerPage = 10, ConnectionInterface $con = null) Issue a SELECT query based on the current ModelCriteria and uses a page and a maximum number of results per page to compute an offset and a limit
 *
 */
abstract class DebtQuery extends ModelCriteria
{
    protected $entityNotFoundExceptionClass = '\\Propel\\Runtime\\Exception\\EntityNotFoundException';

    /**
     * Initializes internal state of \Base\DebtQuery object.
     *
     * @param     string $dbName The database name
     * @param     string $modelName The phpName of a model, e.g. 'Book'
     * @param     string $modelAlias The alias for the model in this query, e.g. 'b'
     */
    public function __construct($dbName = 'xirvana', $modelName = '\\Debt', $modelAlias = null)
    {
        parent::__construct($dbName, $modelName, $modelAlias);
    }

    /**
     * Returns a new ChildDebtQuery object.
     *
     * @param     string $modelAlias The alias of a model in the query
     * @param     Criteria $criteria Optional Criteria to build the query from
     *
     * @return ChildDebtQuery
     */
    public static function create($modelAlias = null, Criteria $criteria = null)
    {
        if ($criteria instanceof ChildDebtQuery) {
            return $criteria;
        }
        $query = new ChildDebtQuery();
        if (null !== $modelAlias) {
            $query->setModelAlias($modelAlias);
        }
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
     * @param array[$creditor, $debtor] $key Primary key to use for the query
     * @param ConnectionInterface $con an optional connection object
     *
     * @return ChildDebt|array|mixed the result, formatted by the current formatter
     */
    public function findPk($key, ConnectionInterface $con = null)
    {
        if ($key === null) {
            return null;
        }

        if ($con === null) {
            $con = Propel::getServiceContainer()->getReadConnection(DebtTableMap::DATABASE_NAME);
        }

        $this->basePreSelect($con);

        if (
            $this->formatter || $this->modelAlias || $this->with || $this->select
            || $this->selectColumns || $this->asColumns || $this->selectModifiers
            || $this->map || $this->having || $this->joins
        ) {
            return $this->findPkComplex($key, $con);
        }

        if ((null !== ($obj = DebtTableMap::getInstanceFromPool(serialize([(null === $key[0] || is_scalar($key[0]) || is_callable([$key[0], '__toString']) ? (string) $key[0] : $key[0]), (null === $key[1] || is_scalar($key[1]) || is_callable([$key[1], '__toString']) ? (string) $key[1] : $key[1])]))))) {
            // the object is already in the instance pool
            return $obj;
        }

        return $this->findPkSimple($key, $con);
    }

    /**
     * Find object by primary key using raw SQL to go fast.
     * Bypass doSelect() and the object formatter by using generated code.
     *
     * @param     mixed $key Primary key to use for the query
     * @param     ConnectionInterface $con A connection object
     *
     * @throws \Propel\Runtime\Exception\PropelException
     *
     * @return ChildDebt A model object, or null if the key is not found
     */
    protected function findPkSimple($key, ConnectionInterface $con)
    {
        $sql = 'SELECT creditor, debtor, amount FROM Debt WHERE creditor = :p0 AND debtor = :p1';
        try {
            $stmt = $con->prepare($sql);
            $stmt->bindValue(':p0', $key[0], PDO::PARAM_STR);
            $stmt->bindValue(':p1', $key[1], PDO::PARAM_STR);
            $stmt->execute();
        } catch (Exception $e) {
            Propel::log($e->getMessage(), Propel::LOG_ERR);
            throw new PropelException(sprintf('Unable to execute SELECT statement [%s]', $sql), 0, $e);
        }
        $obj = null;
        if ($row = $stmt->fetch(\PDO::FETCH_NUM)) {
            /** @var ChildDebt $obj */
            $obj = new ChildDebt();
            $obj->hydrate($row);
            DebtTableMap::addInstanceToPool($obj, serialize([(null === $key[0] || is_scalar($key[0]) || is_callable([$key[0], '__toString']) ? (string) $key[0] : $key[0]), (null === $key[1] || is_scalar($key[1]) || is_callable([$key[1], '__toString']) ? (string) $key[1] : $key[1])]));
        }
        $stmt->closeCursor();

        return $obj;
    }

    /**
     * Find object by primary key.
     *
     * @param     mixed $key Primary key to use for the query
     * @param     ConnectionInterface $con A connection object
     *
     * @return ChildDebt|array|mixed the result, formatted by the current formatter
     */
    protected function findPkComplex($key, ConnectionInterface $con)
    {
        // As the query uses a PK condition, no limit(1) is necessary.
        $criteria = $this->isKeepQuery() ? clone $this : $this;
        $dataFetcher = $criteria
            ->filterByPrimaryKey($key)
            ->doSelect($con);

        return $criteria->getFormatter()->init($criteria)->formatOne($dataFetcher);
    }

    /**
     * Find objects by primary key
     * <code>
     * $objs = $c->findPks(array(array(12, 56), array(832, 123), array(123, 456)), $con);
     * </code>
     * @param     array $keys Primary keys to use for the query
     * @param     ConnectionInterface $con an optional connection object
     *
     * @return ObjectCollection|array|mixed the list of results, formatted by the current formatter
     */
    public function findPks($keys, ConnectionInterface $con = null)
    {
        if (null === $con) {
            $con = Propel::getServiceContainer()->getReadConnection($this->getDbName());
        }
        $this->basePreSelect($con);
        $criteria = $this->isKeepQuery() ? clone $this : $this;
        $dataFetcher = $criteria
            ->filterByPrimaryKeys($keys)
            ->doSelect($con);

        return $criteria->getFormatter()->init($criteria)->format($dataFetcher);
    }

    /**
     * Filter the query by primary key
     *
     * @param     mixed $key Primary key to use for the query
     *
     * @return $this|ChildDebtQuery The current query, for fluid interface
     */
    public function filterByPrimaryKey($key)
    {
        $this->addUsingAlias(DebtTableMap::COL_CREDITOR, $key[0], Criteria::EQUAL);
        $this->addUsingAlias(DebtTableMap::COL_DEBTOR, $key[1], Criteria::EQUAL);

        return $this;
    }

    /**
     * Filter the query by a list of primary keys
     *
     * @param     array $keys The list of primary key to use for the query
     *
     * @return $this|ChildDebtQuery The current query, for fluid interface
     */
    public function filterByPrimaryKeys($keys)
    {
        if (empty($keys)) {
            return $this->add(null, '1<>1', Criteria::CUSTOM);
        }
        foreach ($keys as $key) {
            $cton0 = $this->getNewCriterion(DebtTableMap::COL_CREDITOR, $key[0], Criteria::EQUAL);
            $cton1 = $this->getNewCriterion(DebtTableMap::COL_DEBTOR, $key[1], Criteria::EQUAL);
            $cton0->addAnd($cton1);
            $this->addOr($cton0);
        }

        return $this;
    }

    /**
     * Filter the query on the creditor column
     *
     * Example usage:
     * <code>
     * $query->filterByCreditor('fooValue');   // WHERE creditor = 'fooValue'
     * $query->filterByCreditor('%fooValue%'); // WHERE creditor LIKE '%fooValue%'
     * </code>
     *
     * @param     string $creditor The value to use as filter.
     *              Accepts wildcards (* and % trigger a LIKE)
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this|ChildDebtQuery The current query, for fluid interface
     */
    public function filterByCreditor($creditor = null, $comparison = null)
    {
        if (null === $comparison) {
            if (is_array($creditor)) {
                $comparison = Criteria::IN;
            } elseif (preg_match('/[\%\*]/', $creditor)) {
                $creditor = str_replace('*', '%', $creditor);
                $comparison = Criteria::LIKE;
            }
        }

        return $this->addUsingAlias(DebtTableMap::COL_CREDITOR, $creditor, $comparison);
    }

    /**
     * Filter the query on the debtor column
     *
     * Example usage:
     * <code>
     * $query->filterByDebtor('fooValue');   // WHERE debtor = 'fooValue'
     * $query->filterByDebtor('%fooValue%'); // WHERE debtor LIKE '%fooValue%'
     * </code>
     *
     * @param     string $debtor The value to use as filter.
     *              Accepts wildcards (* and % trigger a LIKE)
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this|ChildDebtQuery The current query, for fluid interface
     */
    public function filterByDebtor($debtor = null, $comparison = null)
    {
        if (null === $comparison) {
            if (is_array($debtor)) {
                $comparison = Criteria::IN;
            } elseif (preg_match('/[\%\*]/', $debtor)) {
                $debtor = str_replace('*', '%', $debtor);
                $comparison = Criteria::LIKE;
            }
        }

        return $this->addUsingAlias(DebtTableMap::COL_DEBTOR, $debtor, $comparison);
    }

    /**
     * Filter the query on the amount column
     *
     * Example usage:
     * <code>
     * $query->filterByAmount(1234); // WHERE amount = 1234
     * $query->filterByAmount(array(12, 34)); // WHERE amount IN (12, 34)
     * $query->filterByAmount(array('min' => 12)); // WHERE amount > 12
     * </code>
     *
     * @param     mixed $amount The value to use as filter.
     *              Use scalar values for equality.
     *              Use array values for in_array() equivalent.
     *              Use associative array('min' => $minValue, 'max' => $maxValue) for intervals.
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this|ChildDebtQuery The current query, for fluid interface
     */
    public function filterByAmount($amount = null, $comparison = null)
    {
        if (is_array($amount)) {
            $useMinMax = false;
            if (isset($amount['min'])) {
                $this->addUsingAlias(DebtTableMap::COL_AMOUNT, $amount['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($amount['max'])) {
                $this->addUsingAlias(DebtTableMap::COL_AMOUNT, $amount['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        return $this->addUsingAlias(DebtTableMap::COL_AMOUNT, $amount, $comparison);
    }

    /**
     * Filter the query by a related \Users object
     *
     * @param \Users|ObjectCollection $users The related object(s) to use as filter
     * @param string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @throws \Propel\Runtime\Exception\PropelException
     *
     * @return ChildDebtQuery The current query, for fluid interface
     */
    public function filterByDebt_Creditor($users, $comparison = null)
    {
        if ($users instanceof \Users) {
            return $this
                ->addUsingAlias(DebtTableMap::COL_CREDITOR, $users->getEmail(), $comparison);
        } elseif ($users instanceof ObjectCollection) {
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }

            return $this
                ->addUsingAlias(DebtTableMap::COL_CREDITOR, $users->toKeyValue('PrimaryKey', 'Email'), $comparison);
        } else {
            throw new PropelException('filterByDebt_Creditor() only accepts arguments of type \Users or Collection');
        }
    }

    /**
     * Adds a JOIN clause to the query using the Debt_Creditor relation
     *
     * @param     string $relationAlias optional alias for the relation
     * @param     string $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return $this|ChildDebtQuery The current query, for fluid interface
     */
    public function joinDebt_Creditor($relationAlias = null, $joinType = Criteria::INNER_JOIN)
    {
        $tableMap = $this->getTableMap();
        $relationMap = $tableMap->getRelation('Debt_Creditor');

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
            $this->addJoinObject($join, 'Debt_Creditor');
        }

        return $this;
    }

    /**
     * Use the Debt_Creditor relation Users object
     *
     * @see useQuery()
     *
     * @param     string $relationAlias optional alias for the relation,
     *                                   to be used as main alias in the secondary query
     * @param     string $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return \UsersQuery A secondary query class using the current class as primary query
     */
    public function useDebt_CreditorQuery($relationAlias = null, $joinType = Criteria::INNER_JOIN)
    {
        return $this
            ->joinDebt_Creditor($relationAlias, $joinType)
            ->useQuery($relationAlias ? $relationAlias : 'Debt_Creditor', '\UsersQuery');
    }

    /**
     * Filter the query by a related \Users object
     *
     * @param \Users|ObjectCollection $users The related object(s) to use as filter
     * @param string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @throws \Propel\Runtime\Exception\PropelException
     *
     * @return ChildDebtQuery The current query, for fluid interface
     */
    public function filterByDebt_Debtor($users, $comparison = null)
    {
        if ($users instanceof \Users) {
            return $this
                ->addUsingAlias(DebtTableMap::COL_DEBTOR, $users->getEmail(), $comparison);
        } elseif ($users instanceof ObjectCollection) {
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }

            return $this
                ->addUsingAlias(DebtTableMap::COL_DEBTOR, $users->toKeyValue('PrimaryKey', 'Email'), $comparison);
        } else {
            throw new PropelException('filterByDebt_Debtor() only accepts arguments of type \Users or Collection');
        }
    }

    /**
     * Adds a JOIN clause to the query using the Debt_Debtor relation
     *
     * @param     string $relationAlias optional alias for the relation
     * @param     string $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return $this|ChildDebtQuery The current query, for fluid interface
     */
    public function joinDebt_Debtor($relationAlias = null, $joinType = Criteria::INNER_JOIN)
    {
        $tableMap = $this->getTableMap();
        $relationMap = $tableMap->getRelation('Debt_Debtor');

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
            $this->addJoinObject($join, 'Debt_Debtor');
        }

        return $this;
    }

    /**
     * Use the Debt_Debtor relation Users object
     *
     * @see useQuery()
     *
     * @param     string $relationAlias optional alias for the relation,
     *                                   to be used as main alias in the secondary query
     * @param     string $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return \UsersQuery A secondary query class using the current class as primary query
     */
    public function useDebt_DebtorQuery($relationAlias = null, $joinType = Criteria::INNER_JOIN)
    {
        return $this
            ->joinDebt_Debtor($relationAlias, $joinType)
            ->useQuery($relationAlias ? $relationAlias : 'Debt_Debtor', '\UsersQuery');
    }

    /**
     * Exclude object from result
     *
     * @param   ChildDebt $debt Object to remove from the list of results
     *
     * @return $this|ChildDebtQuery The current query, for fluid interface
     */
    public function prune($debt = null)
    {
        if ($debt) {
            $this->addCond('pruneCond0', $this->getAliasedColName(DebtTableMap::COL_CREDITOR), $debt->getCreditor(), Criteria::NOT_EQUAL);
            $this->addCond('pruneCond1', $this->getAliasedColName(DebtTableMap::COL_DEBTOR), $debt->getDebtor(), Criteria::NOT_EQUAL);
            $this->combine(array('pruneCond0', 'pruneCond1'), Criteria::LOGICAL_OR);
        }

        return $this;
    }

    /**
     * Deletes all rows from the Debt table.
     *
     * @param ConnectionInterface $con the connection to use
     * @return int The number of affected rows (if supported by underlying database driver).
     */
    public function doDeleteAll(ConnectionInterface $con = null)
    {
        if (null === $con) {
            $con = Propel::getServiceContainer()->getWriteConnection(DebtTableMap::DATABASE_NAME);
        }

        // use transaction because $criteria could contain info
        // for more than one table or we could emulating ON DELETE CASCADE, etc.
        return $con->transaction(function () use ($con) {
            $affectedRows = 0; // initialize var to track total num of affected rows
            $affectedRows += parent::doDeleteAll($con);
            // Because this db requires some delete cascade/set null emulation, we have to
            // clear the cached instance *after* the emulation has happened (since
            // instances get re-added by the select statement contained therein).
            DebtTableMap::clearInstancePool();
            DebtTableMap::clearRelatedInstancePool();

            return $affectedRows;
        });
    }

    /**
     * Performs a DELETE on the database based on the current ModelCriteria
     *
     * @param ConnectionInterface $con the connection to use
     * @return int             The number of affected rows (if supported by underlying database driver).  This includes CASCADE-related rows
     *                         if supported by native driver or if emulated using Propel.
     * @throws PropelException Any exceptions caught during processing will be
     *                         rethrown wrapped into a PropelException.
     */
    public function delete(ConnectionInterface $con = null)
    {
        if (null === $con) {
            $con = Propel::getServiceContainer()->getWriteConnection(DebtTableMap::DATABASE_NAME);
        }

        $criteria = $this;

        // Set the correct dbName
        $criteria->setDbName(DebtTableMap::DATABASE_NAME);

        // use transaction because $criteria could contain info
        // for more than one table or we could emulating ON DELETE CASCADE, etc.
        return $con->transaction(function () use ($con, $criteria) {
            $affectedRows = 0; // initialize var to track total num of affected rows

            DebtTableMap::removeInstanceFromPool($criteria);

            $affectedRows += ModelCriteria::delete($con);
            DebtTableMap::clearRelatedInstancePool();

            return $affectedRows;
        });
    }

} // DebtQuery
