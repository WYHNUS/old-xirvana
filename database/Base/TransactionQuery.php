<?php

namespace Base;

use \Transaction as ChildTransaction;
use \TransactionQuery as ChildTransactionQuery;
use \Exception;
use \PDO;
use Map\TransactionTableMap;
use Propel\Runtime\Propel;
use Propel\Runtime\ActiveQuery\Criteria;
use Propel\Runtime\ActiveQuery\ModelCriteria;
use Propel\Runtime\ActiveQuery\ModelJoin;
use Propel\Runtime\Collection\ObjectCollection;
use Propel\Runtime\Connection\ConnectionInterface;
use Propel\Runtime\Exception\PropelException;

/**
 * Base class that represents a query for the 'Transaction' table.
 *
 *
 *
 * @method     ChildTransactionQuery orderById($order = Criteria::ASC) Order by the id column
 * @method     ChildTransactionQuery orderByName($order = Criteria::ASC) Order by the name column
 * @method     ChildTransactionQuery orderByCreditor($order = Criteria::ASC) Order by the creditor column
 * @method     ChildTransactionQuery orderByDebtor($order = Criteria::ASC) Order by the debtor column
 * @method     ChildTransactionQuery orderByAmount($order = Criteria::ASC) Order by the amount column
 * @method     ChildTransactionQuery orderByTime($order = Criteria::ASC) Order by the time column
 *
 * @method     ChildTransactionQuery groupById() Group by the id column
 * @method     ChildTransactionQuery groupByName() Group by the name column
 * @method     ChildTransactionQuery groupByCreditor() Group by the creditor column
 * @method     ChildTransactionQuery groupByDebtor() Group by the debtor column
 * @method     ChildTransactionQuery groupByAmount() Group by the amount column
 * @method     ChildTransactionQuery groupByTime() Group by the time column
 *
 * @method     ChildTransactionQuery leftJoin($relation) Adds a LEFT JOIN clause to the query
 * @method     ChildTransactionQuery rightJoin($relation) Adds a RIGHT JOIN clause to the query
 * @method     ChildTransactionQuery innerJoin($relation) Adds a INNER JOIN clause to the query
 *
 * @method     ChildTransactionQuery leftJoinWith($relation) Adds a LEFT JOIN clause and with to the query
 * @method     ChildTransactionQuery rightJoinWith($relation) Adds a RIGHT JOIN clause and with to the query
 * @method     ChildTransactionQuery innerJoinWith($relation) Adds a INNER JOIN clause and with to the query
 *
 * @method     ChildTransactionQuery leftJoinTransaction_Creditor($relationAlias = null) Adds a LEFT JOIN clause to the query using the Transaction_Creditor relation
 * @method     ChildTransactionQuery rightJoinTransaction_Creditor($relationAlias = null) Adds a RIGHT JOIN clause to the query using the Transaction_Creditor relation
 * @method     ChildTransactionQuery innerJoinTransaction_Creditor($relationAlias = null) Adds a INNER JOIN clause to the query using the Transaction_Creditor relation
 *
 * @method     ChildTransactionQuery joinWithTransaction_Creditor($joinType = Criteria::INNER_JOIN) Adds a join clause and with to the query using the Transaction_Creditor relation
 *
 * @method     ChildTransactionQuery leftJoinWithTransaction_Creditor() Adds a LEFT JOIN clause and with to the query using the Transaction_Creditor relation
 * @method     ChildTransactionQuery rightJoinWithTransaction_Creditor() Adds a RIGHT JOIN clause and with to the query using the Transaction_Creditor relation
 * @method     ChildTransactionQuery innerJoinWithTransaction_Creditor() Adds a INNER JOIN clause and with to the query using the Transaction_Creditor relation
 *
 * @method     ChildTransactionQuery leftJoinTransaction_Debtor($relationAlias = null) Adds a LEFT JOIN clause to the query using the Transaction_Debtor relation
 * @method     ChildTransactionQuery rightJoinTransaction_Debtor($relationAlias = null) Adds a RIGHT JOIN clause to the query using the Transaction_Debtor relation
 * @method     ChildTransactionQuery innerJoinTransaction_Debtor($relationAlias = null) Adds a INNER JOIN clause to the query using the Transaction_Debtor relation
 *
 * @method     ChildTransactionQuery joinWithTransaction_Debtor($joinType = Criteria::INNER_JOIN) Adds a join clause and with to the query using the Transaction_Debtor relation
 *
 * @method     ChildTransactionQuery leftJoinWithTransaction_Debtor() Adds a LEFT JOIN clause and with to the query using the Transaction_Debtor relation
 * @method     ChildTransactionQuery rightJoinWithTransaction_Debtor() Adds a RIGHT JOIN clause and with to the query using the Transaction_Debtor relation
 * @method     ChildTransactionQuery innerJoinWithTransaction_Debtor() Adds a INNER JOIN clause and with to the query using the Transaction_Debtor relation
 *
 * @method     \UsersQuery endUse() Finalizes a secondary criteria and merges it with its primary Criteria
 *
 * @method     ChildTransaction findOne(ConnectionInterface $con = null) Return the first ChildTransaction matching the query
 * @method     ChildTransaction findOneOrCreate(ConnectionInterface $con = null) Return the first ChildTransaction matching the query, or a new ChildTransaction object populated from the query conditions when no match is found
 *
 * @method     ChildTransaction findOneById(int $id) Return the first ChildTransaction filtered by the id column
 * @method     ChildTransaction findOneByName(string $name) Return the first ChildTransaction filtered by the name column
 * @method     ChildTransaction findOneByCreditor(string $creditor) Return the first ChildTransaction filtered by the creditor column
 * @method     ChildTransaction findOneByDebtor(string $debtor) Return the first ChildTransaction filtered by the debtor column
 * @method     ChildTransaction findOneByAmount(string $amount) Return the first ChildTransaction filtered by the amount column
 * @method     ChildTransaction findOneByTime(string $time) Return the first ChildTransaction filtered by the time column *

 * @method     ChildTransaction requirePk($key, ConnectionInterface $con = null) Return the ChildTransaction by primary key and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildTransaction requireOne(ConnectionInterface $con = null) Return the first ChildTransaction matching the query and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 *
 * @method     ChildTransaction requireOneById(int $id) Return the first ChildTransaction filtered by the id column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildTransaction requireOneByName(string $name) Return the first ChildTransaction filtered by the name column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildTransaction requireOneByCreditor(string $creditor) Return the first ChildTransaction filtered by the creditor column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildTransaction requireOneByDebtor(string $debtor) Return the first ChildTransaction filtered by the debtor column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildTransaction requireOneByAmount(string $amount) Return the first ChildTransaction filtered by the amount column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildTransaction requireOneByTime(string $time) Return the first ChildTransaction filtered by the time column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 *
 * @method     ChildTransaction[]|ObjectCollection find(ConnectionInterface $con = null) Return ChildTransaction objects based on current ModelCriteria
 * @method     ChildTransaction[]|ObjectCollection findById(int $id) Return ChildTransaction objects filtered by the id column
 * @method     ChildTransaction[]|ObjectCollection findByName(string $name) Return ChildTransaction objects filtered by the name column
 * @method     ChildTransaction[]|ObjectCollection findByCreditor(string $creditor) Return ChildTransaction objects filtered by the creditor column
 * @method     ChildTransaction[]|ObjectCollection findByDebtor(string $debtor) Return ChildTransaction objects filtered by the debtor column
 * @method     ChildTransaction[]|ObjectCollection findByAmount(string $amount) Return ChildTransaction objects filtered by the amount column
 * @method     ChildTransaction[]|ObjectCollection findByTime(string $time) Return ChildTransaction objects filtered by the time column
 * @method     ChildTransaction[]|\Propel\Runtime\Util\PropelModelPager paginate($page = 1, $maxPerPage = 10, ConnectionInterface $con = null) Issue a SELECT query based on the current ModelCriteria and uses a page and a maximum number of results per page to compute an offset and a limit
 *
 */
abstract class TransactionQuery extends ModelCriteria
{
    protected $entityNotFoundExceptionClass = '\\Propel\\Runtime\\Exception\\EntityNotFoundException';

    /**
     * Initializes internal state of \Base\TransactionQuery object.
     *
     * @param     string $dbName The database name
     * @param     string $modelName The phpName of a model, e.g. 'Book'
     * @param     string $modelAlias The alias for the model in this query, e.g. 'b'
     */
    public function __construct($dbName = 'xirvana', $modelName = '\\Transaction', $modelAlias = null)
    {
        parent::__construct($dbName, $modelName, $modelAlias);
    }

    /**
     * Returns a new ChildTransactionQuery object.
     *
     * @param     string $modelAlias The alias of a model in the query
     * @param     Criteria $criteria Optional Criteria to build the query from
     *
     * @return ChildTransactionQuery
     */
    public static function create($modelAlias = null, Criteria $criteria = null)
    {
        if ($criteria instanceof ChildTransactionQuery) {
            return $criteria;
        }
        $query = new ChildTransactionQuery();
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
     * $obj  = $c->findPk(12, $con);
     * </code>
     *
     * @param mixed $key Primary key to use for the query
     * @param ConnectionInterface $con an optional connection object
     *
     * @return ChildTransaction|array|mixed the result, formatted by the current formatter
     */
    public function findPk($key, ConnectionInterface $con = null)
    {
        if ($key === null) {
            return null;
        }

        if ($con === null) {
            $con = Propel::getServiceContainer()->getReadConnection(TransactionTableMap::DATABASE_NAME);
        }

        $this->basePreSelect($con);

        if (
            $this->formatter || $this->modelAlias || $this->with || $this->select
            || $this->selectColumns || $this->asColumns || $this->selectModifiers
            || $this->map || $this->having || $this->joins
        ) {
            return $this->findPkComplex($key, $con);
        }

        if ((null !== ($obj = TransactionTableMap::getInstanceFromPool(null === $key || is_scalar($key) || is_callable([$key, '__toString']) ? (string) $key : $key)))) {
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
     * @return ChildTransaction A model object, or null if the key is not found
     */
    protected function findPkSimple($key, ConnectionInterface $con)
    {
        $sql = 'SELECT id, name, creditor, debtor, amount, time FROM Transaction WHERE id = :p0';
        try {
            $stmt = $con->prepare($sql);
            $stmt->bindValue(':p0', $key, PDO::PARAM_INT);
            $stmt->execute();
        } catch (Exception $e) {
            Propel::log($e->getMessage(), Propel::LOG_ERR);
            throw new PropelException(sprintf('Unable to execute SELECT statement [%s]', $sql), 0, $e);
        }
        $obj = null;
        if ($row = $stmt->fetch(\PDO::FETCH_NUM)) {
            /** @var ChildTransaction $obj */
            $obj = new ChildTransaction();
            $obj->hydrate($row);
            TransactionTableMap::addInstanceToPool($obj, null === $key || is_scalar($key) || is_callable([$key, '__toString']) ? (string) $key : $key);
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
     * @return ChildTransaction|array|mixed the result, formatted by the current formatter
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
     * $objs = $c->findPks(array(12, 56, 832), $con);
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
     * @return $this|ChildTransactionQuery The current query, for fluid interface
     */
    public function filterByPrimaryKey($key)
    {

        return $this->addUsingAlias(TransactionTableMap::COL_ID, $key, Criteria::EQUAL);
    }

    /**
     * Filter the query by a list of primary keys
     *
     * @param     array $keys The list of primary key to use for the query
     *
     * @return $this|ChildTransactionQuery The current query, for fluid interface
     */
    public function filterByPrimaryKeys($keys)
    {

        return $this->addUsingAlias(TransactionTableMap::COL_ID, $keys, Criteria::IN);
    }

    /**
     * Filter the query on the id column
     *
     * Example usage:
     * <code>
     * $query->filterById(1234); // WHERE id = 1234
     * $query->filterById(array(12, 34)); // WHERE id IN (12, 34)
     * $query->filterById(array('min' => 12)); // WHERE id > 12
     * </code>
     *
     * @param     mixed $id The value to use as filter.
     *              Use scalar values for equality.
     *              Use array values for in_array() equivalent.
     *              Use associative array('min' => $minValue, 'max' => $maxValue) for intervals.
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this|ChildTransactionQuery The current query, for fluid interface
     */
    public function filterById($id = null, $comparison = null)
    {
        if (is_array($id)) {
            $useMinMax = false;
            if (isset($id['min'])) {
                $this->addUsingAlias(TransactionTableMap::COL_ID, $id['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($id['max'])) {
                $this->addUsingAlias(TransactionTableMap::COL_ID, $id['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        return $this->addUsingAlias(TransactionTableMap::COL_ID, $id, $comparison);
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
     * @return $this|ChildTransactionQuery The current query, for fluid interface
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

        return $this->addUsingAlias(TransactionTableMap::COL_NAME, $name, $comparison);
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
     * @return $this|ChildTransactionQuery The current query, for fluid interface
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

        return $this->addUsingAlias(TransactionTableMap::COL_CREDITOR, $creditor, $comparison);
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
     * @return $this|ChildTransactionQuery The current query, for fluid interface
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

        return $this->addUsingAlias(TransactionTableMap::COL_DEBTOR, $debtor, $comparison);
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
     * @return $this|ChildTransactionQuery The current query, for fluid interface
     */
    public function filterByAmount($amount = null, $comparison = null)
    {
        if (is_array($amount)) {
            $useMinMax = false;
            if (isset($amount['min'])) {
                $this->addUsingAlias(TransactionTableMap::COL_AMOUNT, $amount['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($amount['max'])) {
                $this->addUsingAlias(TransactionTableMap::COL_AMOUNT, $amount['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        return $this->addUsingAlias(TransactionTableMap::COL_AMOUNT, $amount, $comparison);
    }

    /**
     * Filter the query on the time column
     *
     * Example usage:
     * <code>
     * $query->filterByTime('2011-03-14'); // WHERE time = '2011-03-14'
     * $query->filterByTime('now'); // WHERE time = '2011-03-14'
     * $query->filterByTime(array('max' => 'yesterday')); // WHERE time > '2011-03-13'
     * </code>
     *
     * @param     mixed $time The value to use as filter.
     *              Values can be integers (unix timestamps), DateTime objects, or strings.
     *              Empty strings are treated as NULL.
     *              Use scalar values for equality.
     *              Use array values for in_array() equivalent.
     *              Use associative array('min' => $minValue, 'max' => $maxValue) for intervals.
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this|ChildTransactionQuery The current query, for fluid interface
     */
    public function filterByTime($time = null, $comparison = null)
    {
        if (is_array($time)) {
            $useMinMax = false;
            if (isset($time['min'])) {
                $this->addUsingAlias(TransactionTableMap::COL_TIME, $time['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($time['max'])) {
                $this->addUsingAlias(TransactionTableMap::COL_TIME, $time['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        return $this->addUsingAlias(TransactionTableMap::COL_TIME, $time, $comparison);
    }

    /**
     * Filter the query by a related \Users object
     *
     * @param \Users|ObjectCollection $users The related object(s) to use as filter
     * @param string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @throws \Propel\Runtime\Exception\PropelException
     *
     * @return ChildTransactionQuery The current query, for fluid interface
     */
    public function filterByTransaction_Creditor($users, $comparison = null)
    {
        if ($users instanceof \Users) {
            return $this
                ->addUsingAlias(TransactionTableMap::COL_CREDITOR, $users->getEmail(), $comparison);
        } elseif ($users instanceof ObjectCollection) {
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }

            return $this
                ->addUsingAlias(TransactionTableMap::COL_CREDITOR, $users->toKeyValue('PrimaryKey', 'Email'), $comparison);
        } else {
            throw new PropelException('filterByTransaction_Creditor() only accepts arguments of type \Users or Collection');
        }
    }

    /**
     * Adds a JOIN clause to the query using the Transaction_Creditor relation
     *
     * @param     string $relationAlias optional alias for the relation
     * @param     string $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return $this|ChildTransactionQuery The current query, for fluid interface
     */
    public function joinTransaction_Creditor($relationAlias = null, $joinType = Criteria::INNER_JOIN)
    {
        $tableMap = $this->getTableMap();
        $relationMap = $tableMap->getRelation('Transaction_Creditor');

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
            $this->addJoinObject($join, 'Transaction_Creditor');
        }

        return $this;
    }

    /**
     * Use the Transaction_Creditor relation Users object
     *
     * @see useQuery()
     *
     * @param     string $relationAlias optional alias for the relation,
     *                                   to be used as main alias in the secondary query
     * @param     string $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return \UsersQuery A secondary query class using the current class as primary query
     */
    public function useTransaction_CreditorQuery($relationAlias = null, $joinType = Criteria::INNER_JOIN)
    {
        return $this
            ->joinTransaction_Creditor($relationAlias, $joinType)
            ->useQuery($relationAlias ? $relationAlias : 'Transaction_Creditor', '\UsersQuery');
    }

    /**
     * Filter the query by a related \Users object
     *
     * @param \Users|ObjectCollection $users The related object(s) to use as filter
     * @param string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @throws \Propel\Runtime\Exception\PropelException
     *
     * @return ChildTransactionQuery The current query, for fluid interface
     */
    public function filterByTransaction_Debtor($users, $comparison = null)
    {
        if ($users instanceof \Users) {
            return $this
                ->addUsingAlias(TransactionTableMap::COL_DEBTOR, $users->getEmail(), $comparison);
        } elseif ($users instanceof ObjectCollection) {
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }

            return $this
                ->addUsingAlias(TransactionTableMap::COL_DEBTOR, $users->toKeyValue('PrimaryKey', 'Email'), $comparison);
        } else {
            throw new PropelException('filterByTransaction_Debtor() only accepts arguments of type \Users or Collection');
        }
    }

    /**
     * Adds a JOIN clause to the query using the Transaction_Debtor relation
     *
     * @param     string $relationAlias optional alias for the relation
     * @param     string $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return $this|ChildTransactionQuery The current query, for fluid interface
     */
    public function joinTransaction_Debtor($relationAlias = null, $joinType = Criteria::INNER_JOIN)
    {
        $tableMap = $this->getTableMap();
        $relationMap = $tableMap->getRelation('Transaction_Debtor');

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
            $this->addJoinObject($join, 'Transaction_Debtor');
        }

        return $this;
    }

    /**
     * Use the Transaction_Debtor relation Users object
     *
     * @see useQuery()
     *
     * @param     string $relationAlias optional alias for the relation,
     *                                   to be used as main alias in the secondary query
     * @param     string $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return \UsersQuery A secondary query class using the current class as primary query
     */
    public function useTransaction_DebtorQuery($relationAlias = null, $joinType = Criteria::INNER_JOIN)
    {
        return $this
            ->joinTransaction_Debtor($relationAlias, $joinType)
            ->useQuery($relationAlias ? $relationAlias : 'Transaction_Debtor', '\UsersQuery');
    }

    /**
     * Exclude object from result
     *
     * @param   ChildTransaction $transaction Object to remove from the list of results
     *
     * @return $this|ChildTransactionQuery The current query, for fluid interface
     */
    public function prune($transaction = null)
    {
        if ($transaction) {
            $this->addUsingAlias(TransactionTableMap::COL_ID, $transaction->getId(), Criteria::NOT_EQUAL);
        }

        return $this;
    }

    /**
     * Deletes all rows from the Transaction table.
     *
     * @param ConnectionInterface $con the connection to use
     * @return int The number of affected rows (if supported by underlying database driver).
     */
    public function doDeleteAll(ConnectionInterface $con = null)
    {
        if (null === $con) {
            $con = Propel::getServiceContainer()->getWriteConnection(TransactionTableMap::DATABASE_NAME);
        }

        // use transaction because $criteria could contain info
        // for more than one table or we could emulating ON DELETE CASCADE, etc.
        return $con->transaction(function () use ($con) {
            $affectedRows = 0; // initialize var to track total num of affected rows
            $affectedRows += parent::doDeleteAll($con);
            // Because this db requires some delete cascade/set null emulation, we have to
            // clear the cached instance *after* the emulation has happened (since
            // instances get re-added by the select statement contained therein).
            TransactionTableMap::clearInstancePool();
            TransactionTableMap::clearRelatedInstancePool();

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
            $con = Propel::getServiceContainer()->getWriteConnection(TransactionTableMap::DATABASE_NAME);
        }

        $criteria = $this;

        // Set the correct dbName
        $criteria->setDbName(TransactionTableMap::DATABASE_NAME);

        // use transaction because $criteria could contain info
        // for more than one table or we could emulating ON DELETE CASCADE, etc.
        return $con->transaction(function () use ($con, $criteria) {
            $affectedRows = 0; // initialize var to track total num of affected rows

            TransactionTableMap::removeInstanceFromPool($criteria);

            $affectedRows += ModelCriteria::delete($con);
            TransactionTableMap::clearRelatedInstancePool();

            return $affectedRows;
        });
    }

} // TransactionQuery
