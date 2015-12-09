<?php

namespace Base;

use \Booking as ChildBooking;
use \BookingQuery as ChildBookingQuery;
use \Exception;
use \PDO;
use Map\BookingTableMap;
use Propel\Runtime\Propel;
use Propel\Runtime\ActiveQuery\Criteria;
use Propel\Runtime\ActiveQuery\ModelCriteria;
use Propel\Runtime\ActiveQuery\ModelJoin;
use Propel\Runtime\Collection\ObjectCollection;
use Propel\Runtime\Connection\ConnectionInterface;
use Propel\Runtime\Exception\PropelException;

/**
 * Base class that represents a query for the 'Booking' table.
 *
 *
 *
 * @method     ChildBookingQuery orderById($order = Criteria::ASC) Order by the id column
 * @method     ChildBookingQuery orderByBookingtime($order = Criteria::ASC) Order by the bookingTime column
 * @method     ChildBookingQuery orderByName($order = Criteria::ASC) Order by the name column
 * @method     ChildBookingQuery orderByDescription($order = Criteria::ASC) Order by the description column
 *
 * @method     ChildBookingQuery groupById() Group by the id column
 * @method     ChildBookingQuery groupByBookingtime() Group by the bookingTime column
 * @method     ChildBookingQuery groupByName() Group by the name column
 * @method     ChildBookingQuery groupByDescription() Group by the description column
 *
 * @method     ChildBookingQuery leftJoin($relation) Adds a LEFT JOIN clause to the query
 * @method     ChildBookingQuery rightJoin($relation) Adds a RIGHT JOIN clause to the query
 * @method     ChildBookingQuery innerJoin($relation) Adds a INNER JOIN clause to the query
 *
 * @method     ChildBookingQuery leftJoinWith($relation) Adds a LEFT JOIN clause and with to the query
 * @method     ChildBookingQuery rightJoinWith($relation) Adds a RIGHT JOIN clause and with to the query
 * @method     ChildBookingQuery innerJoinWith($relation) Adds a INNER JOIN clause and with to the query
 *
 * @method     ChildBookingQuery leftJoinMakebooking($relationAlias = null) Adds a LEFT JOIN clause to the query using the Makebooking relation
 * @method     ChildBookingQuery rightJoinMakebooking($relationAlias = null) Adds a RIGHT JOIN clause to the query using the Makebooking relation
 * @method     ChildBookingQuery innerJoinMakebooking($relationAlias = null) Adds a INNER JOIN clause to the query using the Makebooking relation
 *
 * @method     ChildBookingQuery joinWithMakebooking($joinType = Criteria::INNER_JOIN) Adds a join clause and with to the query using the Makebooking relation
 *
 * @method     ChildBookingQuery leftJoinWithMakebooking() Adds a LEFT JOIN clause and with to the query using the Makebooking relation
 * @method     ChildBookingQuery rightJoinWithMakebooking() Adds a RIGHT JOIN clause and with to the query using the Makebooking relation
 * @method     ChildBookingQuery innerJoinWithMakebooking() Adds a INNER JOIN clause and with to the query using the Makebooking relation
 *
 * @method     \MakebookingQuery endUse() Finalizes a secondary criteria and merges it with its primary Criteria
 *
 * @method     ChildBooking findOne(ConnectionInterface $con = null) Return the first ChildBooking matching the query
 * @method     ChildBooking findOneOrCreate(ConnectionInterface $con = null) Return the first ChildBooking matching the query, or a new ChildBooking object populated from the query conditions when no match is found
 *
 * @method     ChildBooking findOneById(int $id) Return the first ChildBooking filtered by the id column
 * @method     ChildBooking findOneByBookingtime(string $bookingTime) Return the first ChildBooking filtered by the bookingTime column
 * @method     ChildBooking findOneByName(string $name) Return the first ChildBooking filtered by the name column
 * @method     ChildBooking findOneByDescription(string $description) Return the first ChildBooking filtered by the description column *

 * @method     ChildBooking requirePk($key, ConnectionInterface $con = null) Return the ChildBooking by primary key and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildBooking requireOne(ConnectionInterface $con = null) Return the first ChildBooking matching the query and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 *
 * @method     ChildBooking requireOneById(int $id) Return the first ChildBooking filtered by the id column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildBooking requireOneByBookingtime(string $bookingTime) Return the first ChildBooking filtered by the bookingTime column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildBooking requireOneByName(string $name) Return the first ChildBooking filtered by the name column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildBooking requireOneByDescription(string $description) Return the first ChildBooking filtered by the description column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 *
 * @method     ChildBooking[]|ObjectCollection find(ConnectionInterface $con = null) Return ChildBooking objects based on current ModelCriteria
 * @method     ChildBooking[]|ObjectCollection findById(int $id) Return ChildBooking objects filtered by the id column
 * @method     ChildBooking[]|ObjectCollection findByBookingtime(string $bookingTime) Return ChildBooking objects filtered by the bookingTime column
 * @method     ChildBooking[]|ObjectCollection findByName(string $name) Return ChildBooking objects filtered by the name column
 * @method     ChildBooking[]|ObjectCollection findByDescription(string $description) Return ChildBooking objects filtered by the description column
 * @method     ChildBooking[]|\Propel\Runtime\Util\PropelModelPager paginate($page = 1, $maxPerPage = 10, ConnectionInterface $con = null) Issue a SELECT query based on the current ModelCriteria and uses a page and a maximum number of results per page to compute an offset and a limit
 *
 */
abstract class BookingQuery extends ModelCriteria
{
    protected $entityNotFoundExceptionClass = '\\Propel\\Runtime\\Exception\\EntityNotFoundException';

    /**
     * Initializes internal state of \Base\BookingQuery object.
     *
     * @param     string $dbName The database name
     * @param     string $modelName The phpName of a model, e.g. 'Book'
     * @param     string $modelAlias The alias for the model in this query, e.g. 'b'
     */
    public function __construct($dbName = 'default', $modelName = '\\Booking', $modelAlias = null)
    {
        parent::__construct($dbName, $modelName, $modelAlias);
    }

    /**
     * Returns a new ChildBookingQuery object.
     *
     * @param     string $modelAlias The alias of a model in the query
     * @param     Criteria $criteria Optional Criteria to build the query from
     *
     * @return ChildBookingQuery
     */
    public static function create($modelAlias = null, Criteria $criteria = null)
    {
        if ($criteria instanceof ChildBookingQuery) {
            return $criteria;
        }
        $query = new ChildBookingQuery();
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
     * @return ChildBooking|array|mixed the result, formatted by the current formatter
     */
    public function findPk($key, ConnectionInterface $con = null)
    {
        if ($key === null) {
            return null;
        }
        if ((null !== ($obj = BookingTableMap::getInstanceFromPool((string) $key))) && !$this->formatter) {
            // the object is already in the instance pool
            return $obj;
        }
        if ($con === null) {
            $con = Propel::getServiceContainer()->getReadConnection(BookingTableMap::DATABASE_NAME);
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
     * @param     ConnectionInterface $con A connection object
     *
     * @throws \Propel\Runtime\Exception\PropelException
     *
     * @return ChildBooking A model object, or null if the key is not found
     */
    protected function findPkSimple($key, ConnectionInterface $con)
    {
        $sql = 'SELECT id, bookingTime, name, description FROM Booking WHERE id = :p0';
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
            /** @var ChildBooking $obj */
            $obj = new ChildBooking();
            $obj->hydrate($row);
            BookingTableMap::addInstanceToPool($obj, (string) $key);
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
     * @return ChildBooking|array|mixed the result, formatted by the current formatter
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
     * @return $this|ChildBookingQuery The current query, for fluid interface
     */
    public function filterByPrimaryKey($key)
    {

        return $this->addUsingAlias(BookingTableMap::COL_ID, $key, Criteria::EQUAL);
    }

    /**
     * Filter the query by a list of primary keys
     *
     * @param     array $keys The list of primary key to use for the query
     *
     * @return $this|ChildBookingQuery The current query, for fluid interface
     */
    public function filterByPrimaryKeys($keys)
    {

        return $this->addUsingAlias(BookingTableMap::COL_ID, $keys, Criteria::IN);
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
     * @return $this|ChildBookingQuery The current query, for fluid interface
     */
    public function filterById($id = null, $comparison = null)
    {
        if (is_array($id)) {
            $useMinMax = false;
            if (isset($id['min'])) {
                $this->addUsingAlias(BookingTableMap::COL_ID, $id['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($id['max'])) {
                $this->addUsingAlias(BookingTableMap::COL_ID, $id['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        return $this->addUsingAlias(BookingTableMap::COL_ID, $id, $comparison);
    }

    /**
     * Filter the query on the bookingTime column
     *
     * Example usage:
     * <code>
     * $query->filterByBookingtime('2011-03-14'); // WHERE bookingTime = '2011-03-14'
     * $query->filterByBookingtime('now'); // WHERE bookingTime = '2011-03-14'
     * $query->filterByBookingtime(array('max' => 'yesterday')); // WHERE bookingTime > '2011-03-13'
     * </code>
     *
     * @param     mixed $bookingtime The value to use as filter.
     *              Values can be integers (unix timestamps), DateTime objects, or strings.
     *              Empty strings are treated as NULL.
     *              Use scalar values for equality.
     *              Use array values for in_array() equivalent.
     *              Use associative array('min' => $minValue, 'max' => $maxValue) for intervals.
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this|ChildBookingQuery The current query, for fluid interface
     */
    public function filterByBookingtime($bookingtime = null, $comparison = null)
    {
        if (is_array($bookingtime)) {
            $useMinMax = false;
            if (isset($bookingtime['min'])) {
                $this->addUsingAlias(BookingTableMap::COL_BOOKINGTIME, $bookingtime['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($bookingtime['max'])) {
                $this->addUsingAlias(BookingTableMap::COL_BOOKINGTIME, $bookingtime['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        return $this->addUsingAlias(BookingTableMap::COL_BOOKINGTIME, $bookingtime, $comparison);
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
     * @return $this|ChildBookingQuery The current query, for fluid interface
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

        return $this->addUsingAlias(BookingTableMap::COL_NAME, $name, $comparison);
    }

    /**
     * Filter the query on the description column
     *
     * Example usage:
     * <code>
     * $query->filterByDescription('fooValue');   // WHERE description = 'fooValue'
     * $query->filterByDescription('%fooValue%'); // WHERE description LIKE '%fooValue%'
     * </code>
     *
     * @param     string $description The value to use as filter.
     *              Accepts wildcards (* and % trigger a LIKE)
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this|ChildBookingQuery The current query, for fluid interface
     */
    public function filterByDescription($description = null, $comparison = null)
    {
        if (null === $comparison) {
            if (is_array($description)) {
                $comparison = Criteria::IN;
            } elseif (preg_match('/[\%\*]/', $description)) {
                $description = str_replace('*', '%', $description);
                $comparison = Criteria::LIKE;
            }
        }

        return $this->addUsingAlias(BookingTableMap::COL_DESCRIPTION, $description, $comparison);
    }

    /**
     * Filter the query by a related \Makebooking object
     *
     * @param \Makebooking|ObjectCollection $makebooking the related object to use as filter
     * @param string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return ChildBookingQuery The current query, for fluid interface
     */
    public function filterByMakebooking($makebooking, $comparison = null)
    {
        if ($makebooking instanceof \Makebooking) {
            return $this
                ->addUsingAlias(BookingTableMap::COL_ID, $makebooking->getId(), $comparison);
        } elseif ($makebooking instanceof ObjectCollection) {
            return $this
                ->useMakebookingQuery()
                ->filterByPrimaryKeys($makebooking->getPrimaryKeys())
                ->endUse();
        } else {
            throw new PropelException('filterByMakebooking() only accepts arguments of type \Makebooking or Collection');
        }
    }

    /**
     * Adds a JOIN clause to the query using the Makebooking relation
     *
     * @param     string $relationAlias optional alias for the relation
     * @param     string $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return $this|ChildBookingQuery The current query, for fluid interface
     */
    public function joinMakebooking($relationAlias = null, $joinType = Criteria::INNER_JOIN)
    {
        $tableMap = $this->getTableMap();
        $relationMap = $tableMap->getRelation('Makebooking');

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
            $this->addJoinObject($join, 'Makebooking');
        }

        return $this;
    }

    /**
     * Use the Makebooking relation Makebooking object
     *
     * @see useQuery()
     *
     * @param     string $relationAlias optional alias for the relation,
     *                                   to be used as main alias in the secondary query
     * @param     string $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return \MakebookingQuery A secondary query class using the current class as primary query
     */
    public function useMakebookingQuery($relationAlias = null, $joinType = Criteria::INNER_JOIN)
    {
        return $this
            ->joinMakebooking($relationAlias, $joinType)
            ->useQuery($relationAlias ? $relationAlias : 'Makebooking', '\MakebookingQuery');
    }

    /**
     * Exclude object from result
     *
     * @param   ChildBooking $booking Object to remove from the list of results
     *
     * @return $this|ChildBookingQuery The current query, for fluid interface
     */
    public function prune($booking = null)
    {
        if ($booking) {
            $this->addUsingAlias(BookingTableMap::COL_ID, $booking->getId(), Criteria::NOT_EQUAL);
        }

        return $this;
    }

    /**
     * Deletes all rows from the Booking table.
     *
     * @param ConnectionInterface $con the connection to use
     * @return int The number of affected rows (if supported by underlying database driver).
     */
    public function doDeleteAll(ConnectionInterface $con = null)
    {
        if (null === $con) {
            $con = Propel::getServiceContainer()->getWriteConnection(BookingTableMap::DATABASE_NAME);
        }

        // use transaction because $criteria could contain info
        // for more than one table or we could emulating ON DELETE CASCADE, etc.
        return $con->transaction(function () use ($con) {
            $affectedRows = 0; // initialize var to track total num of affected rows
            $affectedRows += parent::doDeleteAll($con);
            // Because this db requires some delete cascade/set null emulation, we have to
            // clear the cached instance *after* the emulation has happened (since
            // instances get re-added by the select statement contained therein).
            BookingTableMap::clearInstancePool();
            BookingTableMap::clearRelatedInstancePool();

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
            $con = Propel::getServiceContainer()->getWriteConnection(BookingTableMap::DATABASE_NAME);
        }

        $criteria = $this;

        // Set the correct dbName
        $criteria->setDbName(BookingTableMap::DATABASE_NAME);

        // use transaction because $criteria could contain info
        // for more than one table or we could emulating ON DELETE CASCADE, etc.
        return $con->transaction(function () use ($con, $criteria) {
            $affectedRows = 0; // initialize var to track total num of affected rows

            BookingTableMap::removeInstanceFromPool($criteria);

            $affectedRows += ModelCriteria::delete($con);
            BookingTableMap::clearRelatedInstancePool();

            return $affectedRows;
        });
    }

} // BookingQuery
