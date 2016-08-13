<?php

namespace Base;

use \Users as ChildUsers;
use \UsersQuery as ChildUsersQuery;
use \Exception;
use \PDO;
use Map\UsersTableMap;
use Propel\Runtime\Propel;
use Propel\Runtime\ActiveQuery\Criteria;
use Propel\Runtime\ActiveQuery\ModelCriteria;
use Propel\Runtime\ActiveQuery\ModelJoin;
use Propel\Runtime\Collection\ObjectCollection;
use Propel\Runtime\Connection\ConnectionInterface;
use Propel\Runtime\Exception\PropelException;

/**
 * Base class that represents a query for the 'Users' table.
 *
 *
 *
 * @method     ChildUsersQuery orderByEmail($order = Criteria::ASC) Order by the email column
 * @method     ChildUsersQuery orderByName($order = Criteria::ASC) Order by the name column
 * @method     ChildUsersQuery orderByPassword($order = Criteria::ASC) Order by the password column
 *
 * @method     ChildUsersQuery groupByEmail() Group by the email column
 * @method     ChildUsersQuery groupByName() Group by the name column
 * @method     ChildUsersQuery groupByPassword() Group by the password column
 *
 * @method     ChildUsersQuery leftJoin($relation) Adds a LEFT JOIN clause to the query
 * @method     ChildUsersQuery rightJoin($relation) Adds a RIGHT JOIN clause to the query
 * @method     ChildUsersQuery innerJoin($relation) Adds a INNER JOIN clause to the query
 *
 * @method     ChildUsersQuery leftJoinWith($relation) Adds a LEFT JOIN clause and with to the query
 * @method     ChildUsersQuery rightJoinWith($relation) Adds a RIGHT JOIN clause and with to the query
 * @method     ChildUsersQuery innerJoinWith($relation) Adds a INNER JOIN clause and with to the query
 *
 * @method     ChildUsersQuery leftJoinDebtRelatedByCreditor($relationAlias = null) Adds a LEFT JOIN clause to the query using the DebtRelatedByCreditor relation
 * @method     ChildUsersQuery rightJoinDebtRelatedByCreditor($relationAlias = null) Adds a RIGHT JOIN clause to the query using the DebtRelatedByCreditor relation
 * @method     ChildUsersQuery innerJoinDebtRelatedByCreditor($relationAlias = null) Adds a INNER JOIN clause to the query using the DebtRelatedByCreditor relation
 *
 * @method     ChildUsersQuery joinWithDebtRelatedByCreditor($joinType = Criteria::INNER_JOIN) Adds a join clause and with to the query using the DebtRelatedByCreditor relation
 *
 * @method     ChildUsersQuery leftJoinWithDebtRelatedByCreditor() Adds a LEFT JOIN clause and with to the query using the DebtRelatedByCreditor relation
 * @method     ChildUsersQuery rightJoinWithDebtRelatedByCreditor() Adds a RIGHT JOIN clause and with to the query using the DebtRelatedByCreditor relation
 * @method     ChildUsersQuery innerJoinWithDebtRelatedByCreditor() Adds a INNER JOIN clause and with to the query using the DebtRelatedByCreditor relation
 *
 * @method     ChildUsersQuery leftJoinDebtRelatedByDebtor($relationAlias = null) Adds a LEFT JOIN clause to the query using the DebtRelatedByDebtor relation
 * @method     ChildUsersQuery rightJoinDebtRelatedByDebtor($relationAlias = null) Adds a RIGHT JOIN clause to the query using the DebtRelatedByDebtor relation
 * @method     ChildUsersQuery innerJoinDebtRelatedByDebtor($relationAlias = null) Adds a INNER JOIN clause to the query using the DebtRelatedByDebtor relation
 *
 * @method     ChildUsersQuery joinWithDebtRelatedByDebtor($joinType = Criteria::INNER_JOIN) Adds a join clause and with to the query using the DebtRelatedByDebtor relation
 *
 * @method     ChildUsersQuery leftJoinWithDebtRelatedByDebtor() Adds a LEFT JOIN clause and with to the query using the DebtRelatedByDebtor relation
 * @method     ChildUsersQuery rightJoinWithDebtRelatedByDebtor() Adds a RIGHT JOIN clause and with to the query using the DebtRelatedByDebtor relation
 * @method     ChildUsersQuery innerJoinWithDebtRelatedByDebtor() Adds a INNER JOIN clause and with to the query using the DebtRelatedByDebtor relation
 *
 * @method     ChildUsersQuery leftJoinTransactionRelatedByCreditor($relationAlias = null) Adds a LEFT JOIN clause to the query using the TransactionRelatedByCreditor relation
 * @method     ChildUsersQuery rightJoinTransactionRelatedByCreditor($relationAlias = null) Adds a RIGHT JOIN clause to the query using the TransactionRelatedByCreditor relation
 * @method     ChildUsersQuery innerJoinTransactionRelatedByCreditor($relationAlias = null) Adds a INNER JOIN clause to the query using the TransactionRelatedByCreditor relation
 *
 * @method     ChildUsersQuery joinWithTransactionRelatedByCreditor($joinType = Criteria::INNER_JOIN) Adds a join clause and with to the query using the TransactionRelatedByCreditor relation
 *
 * @method     ChildUsersQuery leftJoinWithTransactionRelatedByCreditor() Adds a LEFT JOIN clause and with to the query using the TransactionRelatedByCreditor relation
 * @method     ChildUsersQuery rightJoinWithTransactionRelatedByCreditor() Adds a RIGHT JOIN clause and with to the query using the TransactionRelatedByCreditor relation
 * @method     ChildUsersQuery innerJoinWithTransactionRelatedByCreditor() Adds a INNER JOIN clause and with to the query using the TransactionRelatedByCreditor relation
 *
 * @method     ChildUsersQuery leftJoinTransactionRelatedByDebtor($relationAlias = null) Adds a LEFT JOIN clause to the query using the TransactionRelatedByDebtor relation
 * @method     ChildUsersQuery rightJoinTransactionRelatedByDebtor($relationAlias = null) Adds a RIGHT JOIN clause to the query using the TransactionRelatedByDebtor relation
 * @method     ChildUsersQuery innerJoinTransactionRelatedByDebtor($relationAlias = null) Adds a INNER JOIN clause to the query using the TransactionRelatedByDebtor relation
 *
 * @method     ChildUsersQuery joinWithTransactionRelatedByDebtor($joinType = Criteria::INNER_JOIN) Adds a join clause and with to the query using the TransactionRelatedByDebtor relation
 *
 * @method     ChildUsersQuery leftJoinWithTransactionRelatedByDebtor() Adds a LEFT JOIN clause and with to the query using the TransactionRelatedByDebtor relation
 * @method     ChildUsersQuery rightJoinWithTransactionRelatedByDebtor() Adds a RIGHT JOIN clause and with to the query using the TransactionRelatedByDebtor relation
 * @method     ChildUsersQuery innerJoinWithTransactionRelatedByDebtor() Adds a INNER JOIN clause and with to the query using the TransactionRelatedByDebtor relation
 *
 * @method     \DebtQuery|\TransactionQuery endUse() Finalizes a secondary criteria and merges it with its primary Criteria
 *
 * @method     ChildUsers findOne(ConnectionInterface $con = null) Return the first ChildUsers matching the query
 * @method     ChildUsers findOneOrCreate(ConnectionInterface $con = null) Return the first ChildUsers matching the query, or a new ChildUsers object populated from the query conditions when no match is found
 *
 * @method     ChildUsers findOneByEmail(string $email) Return the first ChildUsers filtered by the email column
 * @method     ChildUsers findOneByName(string $name) Return the first ChildUsers filtered by the name column
 * @method     ChildUsers findOneByPassword(string $password) Return the first ChildUsers filtered by the password column *

 * @method     ChildUsers requirePk($key, ConnectionInterface $con = null) Return the ChildUsers by primary key and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildUsers requireOne(ConnectionInterface $con = null) Return the first ChildUsers matching the query and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 *
 * @method     ChildUsers requireOneByEmail(string $email) Return the first ChildUsers filtered by the email column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildUsers requireOneByName(string $name) Return the first ChildUsers filtered by the name column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildUsers requireOneByPassword(string $password) Return the first ChildUsers filtered by the password column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 *
 * @method     ChildUsers[]|ObjectCollection find(ConnectionInterface $con = null) Return ChildUsers objects based on current ModelCriteria
 * @method     ChildUsers[]|ObjectCollection findByEmail(string $email) Return ChildUsers objects filtered by the email column
 * @method     ChildUsers[]|ObjectCollection findByName(string $name) Return ChildUsers objects filtered by the name column
 * @method     ChildUsers[]|ObjectCollection findByPassword(string $password) Return ChildUsers objects filtered by the password column
 * @method     ChildUsers[]|\Propel\Runtime\Util\PropelModelPager paginate($page = 1, $maxPerPage = 10, ConnectionInterface $con = null) Issue a SELECT query based on the current ModelCriteria and uses a page and a maximum number of results per page to compute an offset and a limit
 *
 */
abstract class UsersQuery extends ModelCriteria
{
    protected $entityNotFoundExceptionClass = '\\Propel\\Runtime\\Exception\\EntityNotFoundException';

    /**
     * Initializes internal state of \Base\UsersQuery object.
     *
     * @param     string $dbName The database name
     * @param     string $modelName The phpName of a model, e.g. 'Book'
     * @param     string $modelAlias The alias for the model in this query, e.g. 'b'
     */
    public function __construct($dbName = 'xirvana', $modelName = '\\Users', $modelAlias = null)
    {
        parent::__construct($dbName, $modelName, $modelAlias);
    }

    /**
     * Returns a new ChildUsersQuery object.
     *
     * @param     string $modelAlias The alias of a model in the query
     * @param     Criteria $criteria Optional Criteria to build the query from
     *
     * @return ChildUsersQuery
     */
    public static function create($modelAlias = null, Criteria $criteria = null)
    {
        if ($criteria instanceof ChildUsersQuery) {
            return $criteria;
        }
        $query = new ChildUsersQuery();
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
     * @return ChildUsers|array|mixed the result, formatted by the current formatter
     */
    public function findPk($key, ConnectionInterface $con = null)
    {
        if ($key === null) {
            return null;
        }

        if ($con === null) {
            $con = Propel::getServiceContainer()->getReadConnection(UsersTableMap::DATABASE_NAME);
        }

        $this->basePreSelect($con);

        if (
            $this->formatter || $this->modelAlias || $this->with || $this->select
            || $this->selectColumns || $this->asColumns || $this->selectModifiers
            || $this->map || $this->having || $this->joins
        ) {
            return $this->findPkComplex($key, $con);
        }

        if ((null !== ($obj = UsersTableMap::getInstanceFromPool(null === $key || is_scalar($key) || is_callable([$key, '__toString']) ? (string) $key : $key)))) {
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
     * @return ChildUsers A model object, or null if the key is not found
     */
    protected function findPkSimple($key, ConnectionInterface $con)
    {
        $sql = 'SELECT email, name, password FROM Users WHERE email = :p0';
        try {
            $stmt = $con->prepare($sql);
            $stmt->bindValue(':p0', $key, PDO::PARAM_STR);
            $stmt->execute();
        } catch (Exception $e) {
            Propel::log($e->getMessage(), Propel::LOG_ERR);
            throw new PropelException(sprintf('Unable to execute SELECT statement [%s]', $sql), 0, $e);
        }
        $obj = null;
        if ($row = $stmt->fetch(\PDO::FETCH_NUM)) {
            /** @var ChildUsers $obj */
            $obj = new ChildUsers();
            $obj->hydrate($row);
            UsersTableMap::addInstanceToPool($obj, null === $key || is_scalar($key) || is_callable([$key, '__toString']) ? (string) $key : $key);
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
     * @return ChildUsers|array|mixed the result, formatted by the current formatter
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
     * @return $this|ChildUsersQuery The current query, for fluid interface
     */
    public function filterByPrimaryKey($key)
    {

        return $this->addUsingAlias(UsersTableMap::COL_EMAIL, $key, Criteria::EQUAL);
    }

    /**
     * Filter the query by a list of primary keys
     *
     * @param     array $keys The list of primary key to use for the query
     *
     * @return $this|ChildUsersQuery The current query, for fluid interface
     */
    public function filterByPrimaryKeys($keys)
    {

        return $this->addUsingAlias(UsersTableMap::COL_EMAIL, $keys, Criteria::IN);
    }

    /**
     * Filter the query on the email column
     *
     * Example usage:
     * <code>
     * $query->filterByEmail('fooValue');   // WHERE email = 'fooValue'
     * $query->filterByEmail('%fooValue%'); // WHERE email LIKE '%fooValue%'
     * </code>
     *
     * @param     string $email The value to use as filter.
     *              Accepts wildcards (* and % trigger a LIKE)
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this|ChildUsersQuery The current query, for fluid interface
     */
    public function filterByEmail($email = null, $comparison = null)
    {
        if (null === $comparison) {
            if (is_array($email)) {
                $comparison = Criteria::IN;
            } elseif (preg_match('/[\%\*]/', $email)) {
                $email = str_replace('*', '%', $email);
                $comparison = Criteria::LIKE;
            }
        }

        return $this->addUsingAlias(UsersTableMap::COL_EMAIL, $email, $comparison);
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
     * @return $this|ChildUsersQuery The current query, for fluid interface
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

        return $this->addUsingAlias(UsersTableMap::COL_NAME, $name, $comparison);
    }

    /**
     * Filter the query on the password column
     *
     * Example usage:
     * <code>
     * $query->filterByPassword('fooValue');   // WHERE password = 'fooValue'
     * $query->filterByPassword('%fooValue%'); // WHERE password LIKE '%fooValue%'
     * </code>
     *
     * @param     string $password The value to use as filter.
     *              Accepts wildcards (* and % trigger a LIKE)
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this|ChildUsersQuery The current query, for fluid interface
     */
    public function filterByPassword($password = null, $comparison = null)
    {
        if (null === $comparison) {
            if (is_array($password)) {
                $comparison = Criteria::IN;
            } elseif (preg_match('/[\%\*]/', $password)) {
                $password = str_replace('*', '%', $password);
                $comparison = Criteria::LIKE;
            }
        }

        return $this->addUsingAlias(UsersTableMap::COL_PASSWORD, $password, $comparison);
    }

    /**
     * Filter the query by a related \Debt object
     *
     * @param \Debt|ObjectCollection $debt the related object to use as filter
     * @param string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return ChildUsersQuery The current query, for fluid interface
     */
    public function filterByDebtRelatedByCreditor($debt, $comparison = null)
    {
        if ($debt instanceof \Debt) {
            return $this
                ->addUsingAlias(UsersTableMap::COL_EMAIL, $debt->getCreditor(), $comparison);
        } elseif ($debt instanceof ObjectCollection) {
            return $this
                ->useDebtRelatedByCreditorQuery()
                ->filterByPrimaryKeys($debt->getPrimaryKeys())
                ->endUse();
        } else {
            throw new PropelException('filterByDebtRelatedByCreditor() only accepts arguments of type \Debt or Collection');
        }
    }

    /**
     * Adds a JOIN clause to the query using the DebtRelatedByCreditor relation
     *
     * @param     string $relationAlias optional alias for the relation
     * @param     string $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return $this|ChildUsersQuery The current query, for fluid interface
     */
    public function joinDebtRelatedByCreditor($relationAlias = null, $joinType = Criteria::INNER_JOIN)
    {
        $tableMap = $this->getTableMap();
        $relationMap = $tableMap->getRelation('DebtRelatedByCreditor');

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
            $this->addJoinObject($join, 'DebtRelatedByCreditor');
        }

        return $this;
    }

    /**
     * Use the DebtRelatedByCreditor relation Debt object
     *
     * @see useQuery()
     *
     * @param     string $relationAlias optional alias for the relation,
     *                                   to be used as main alias in the secondary query
     * @param     string $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return \DebtQuery A secondary query class using the current class as primary query
     */
    public function useDebtRelatedByCreditorQuery($relationAlias = null, $joinType = Criteria::INNER_JOIN)
    {
        return $this
            ->joinDebtRelatedByCreditor($relationAlias, $joinType)
            ->useQuery($relationAlias ? $relationAlias : 'DebtRelatedByCreditor', '\DebtQuery');
    }

    /**
     * Filter the query by a related \Debt object
     *
     * @param \Debt|ObjectCollection $debt the related object to use as filter
     * @param string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return ChildUsersQuery The current query, for fluid interface
     */
    public function filterByDebtRelatedByDebtor($debt, $comparison = null)
    {
        if ($debt instanceof \Debt) {
            return $this
                ->addUsingAlias(UsersTableMap::COL_EMAIL, $debt->getDebtor(), $comparison);
        } elseif ($debt instanceof ObjectCollection) {
            return $this
                ->useDebtRelatedByDebtorQuery()
                ->filterByPrimaryKeys($debt->getPrimaryKeys())
                ->endUse();
        } else {
            throw new PropelException('filterByDebtRelatedByDebtor() only accepts arguments of type \Debt or Collection');
        }
    }

    /**
     * Adds a JOIN clause to the query using the DebtRelatedByDebtor relation
     *
     * @param     string $relationAlias optional alias for the relation
     * @param     string $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return $this|ChildUsersQuery The current query, for fluid interface
     */
    public function joinDebtRelatedByDebtor($relationAlias = null, $joinType = Criteria::INNER_JOIN)
    {
        $tableMap = $this->getTableMap();
        $relationMap = $tableMap->getRelation('DebtRelatedByDebtor');

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
            $this->addJoinObject($join, 'DebtRelatedByDebtor');
        }

        return $this;
    }

    /**
     * Use the DebtRelatedByDebtor relation Debt object
     *
     * @see useQuery()
     *
     * @param     string $relationAlias optional alias for the relation,
     *                                   to be used as main alias in the secondary query
     * @param     string $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return \DebtQuery A secondary query class using the current class as primary query
     */
    public function useDebtRelatedByDebtorQuery($relationAlias = null, $joinType = Criteria::INNER_JOIN)
    {
        return $this
            ->joinDebtRelatedByDebtor($relationAlias, $joinType)
            ->useQuery($relationAlias ? $relationAlias : 'DebtRelatedByDebtor', '\DebtQuery');
    }

    /**
     * Filter the query by a related \Transaction object
     *
     * @param \Transaction|ObjectCollection $transaction the related object to use as filter
     * @param string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return ChildUsersQuery The current query, for fluid interface
     */
    public function filterByTransactionRelatedByCreditor($transaction, $comparison = null)
    {
        if ($transaction instanceof \Transaction) {
            return $this
                ->addUsingAlias(UsersTableMap::COL_EMAIL, $transaction->getCreditor(), $comparison);
        } elseif ($transaction instanceof ObjectCollection) {
            return $this
                ->useTransactionRelatedByCreditorQuery()
                ->filterByPrimaryKeys($transaction->getPrimaryKeys())
                ->endUse();
        } else {
            throw new PropelException('filterByTransactionRelatedByCreditor() only accepts arguments of type \Transaction or Collection');
        }
    }

    /**
     * Adds a JOIN clause to the query using the TransactionRelatedByCreditor relation
     *
     * @param     string $relationAlias optional alias for the relation
     * @param     string $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return $this|ChildUsersQuery The current query, for fluid interface
     */
    public function joinTransactionRelatedByCreditor($relationAlias = null, $joinType = Criteria::INNER_JOIN)
    {
        $tableMap = $this->getTableMap();
        $relationMap = $tableMap->getRelation('TransactionRelatedByCreditor');

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
            $this->addJoinObject($join, 'TransactionRelatedByCreditor');
        }

        return $this;
    }

    /**
     * Use the TransactionRelatedByCreditor relation Transaction object
     *
     * @see useQuery()
     *
     * @param     string $relationAlias optional alias for the relation,
     *                                   to be used as main alias in the secondary query
     * @param     string $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return \TransactionQuery A secondary query class using the current class as primary query
     */
    public function useTransactionRelatedByCreditorQuery($relationAlias = null, $joinType = Criteria::INNER_JOIN)
    {
        return $this
            ->joinTransactionRelatedByCreditor($relationAlias, $joinType)
            ->useQuery($relationAlias ? $relationAlias : 'TransactionRelatedByCreditor', '\TransactionQuery');
    }

    /**
     * Filter the query by a related \Transaction object
     *
     * @param \Transaction|ObjectCollection $transaction the related object to use as filter
     * @param string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return ChildUsersQuery The current query, for fluid interface
     */
    public function filterByTransactionRelatedByDebtor($transaction, $comparison = null)
    {
        if ($transaction instanceof \Transaction) {
            return $this
                ->addUsingAlias(UsersTableMap::COL_EMAIL, $transaction->getDebtor(), $comparison);
        } elseif ($transaction instanceof ObjectCollection) {
            return $this
                ->useTransactionRelatedByDebtorQuery()
                ->filterByPrimaryKeys($transaction->getPrimaryKeys())
                ->endUse();
        } else {
            throw new PropelException('filterByTransactionRelatedByDebtor() only accepts arguments of type \Transaction or Collection');
        }
    }

    /**
     * Adds a JOIN clause to the query using the TransactionRelatedByDebtor relation
     *
     * @param     string $relationAlias optional alias for the relation
     * @param     string $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return $this|ChildUsersQuery The current query, for fluid interface
     */
    public function joinTransactionRelatedByDebtor($relationAlias = null, $joinType = Criteria::INNER_JOIN)
    {
        $tableMap = $this->getTableMap();
        $relationMap = $tableMap->getRelation('TransactionRelatedByDebtor');

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
            $this->addJoinObject($join, 'TransactionRelatedByDebtor');
        }

        return $this;
    }

    /**
     * Use the TransactionRelatedByDebtor relation Transaction object
     *
     * @see useQuery()
     *
     * @param     string $relationAlias optional alias for the relation,
     *                                   to be used as main alias in the secondary query
     * @param     string $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return \TransactionQuery A secondary query class using the current class as primary query
     */
    public function useTransactionRelatedByDebtorQuery($relationAlias = null, $joinType = Criteria::INNER_JOIN)
    {
        return $this
            ->joinTransactionRelatedByDebtor($relationAlias, $joinType)
            ->useQuery($relationAlias ? $relationAlias : 'TransactionRelatedByDebtor', '\TransactionQuery');
    }

    /**
     * Exclude object from result
     *
     * @param   ChildUsers $users Object to remove from the list of results
     *
     * @return $this|ChildUsersQuery The current query, for fluid interface
     */
    public function prune($users = null)
    {
        if ($users) {
            $this->addUsingAlias(UsersTableMap::COL_EMAIL, $users->getEmail(), Criteria::NOT_EQUAL);
        }

        return $this;
    }

    /**
     * Deletes all rows from the Users table.
     *
     * @param ConnectionInterface $con the connection to use
     * @return int The number of affected rows (if supported by underlying database driver).
     */
    public function doDeleteAll(ConnectionInterface $con = null)
    {
        if (null === $con) {
            $con = Propel::getServiceContainer()->getWriteConnection(UsersTableMap::DATABASE_NAME);
        }

        // use transaction because $criteria could contain info
        // for more than one table or we could emulating ON DELETE CASCADE, etc.
        return $con->transaction(function () use ($con) {
            $affectedRows = 0; // initialize var to track total num of affected rows
            $affectedRows += parent::doDeleteAll($con);
            // Because this db requires some delete cascade/set null emulation, we have to
            // clear the cached instance *after* the emulation has happened (since
            // instances get re-added by the select statement contained therein).
            UsersTableMap::clearInstancePool();
            UsersTableMap::clearRelatedInstancePool();

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
            $con = Propel::getServiceContainer()->getWriteConnection(UsersTableMap::DATABASE_NAME);
        }

        $criteria = $this;

        // Set the correct dbName
        $criteria->setDbName(UsersTableMap::DATABASE_NAME);

        // use transaction because $criteria could contain info
        // for more than one table or we could emulating ON DELETE CASCADE, etc.
        return $con->transaction(function () use ($con, $criteria) {
            $affectedRows = 0; // initialize var to track total num of affected rows

            UsersTableMap::removeInstanceFromPool($criteria);

            $affectedRows += ModelCriteria::delete($con);
            UsersTableMap::clearRelatedInstancePool();

            return $affectedRows;
        });
    }

} // UsersQuery
