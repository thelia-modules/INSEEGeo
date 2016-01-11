<?php

namespace INSEEGeo\Model\Base;

use \Exception;
use \PDO;
use INSEEGeo\Model\InseeGeoDepartment as ChildInseeGeoDepartment;
use INSEEGeo\Model\InseeGeoDepartmentI18nQuery as ChildInseeGeoDepartmentI18nQuery;
use INSEEGeo\Model\InseeGeoDepartmentQuery as ChildInseeGeoDepartmentQuery;
use INSEEGeo\Model\Map\InseeGeoDepartmentTableMap;
use Propel\Runtime\Propel;
use Propel\Runtime\ActiveQuery\Criteria;
use Propel\Runtime\ActiveQuery\ModelCriteria;
use Propel\Runtime\ActiveQuery\ModelJoin;
use Propel\Runtime\Collection\Collection;
use Propel\Runtime\Collection\ObjectCollection;
use Propel\Runtime\Connection\ConnectionInterface;
use Propel\Runtime\Exception\PropelException;

/**
 * Base class that represents a query for the 'insee_geo_department' table.
 *
 *
 *
 * @method     ChildInseeGeoDepartmentQuery orderById($order = Criteria::ASC) Order by the id column
 * @method     ChildInseeGeoDepartmentQuery orderByInseeCode($order = Criteria::ASC) Order by the insee_code column
 * @method     ChildInseeGeoDepartmentQuery orderByPosition($order = Criteria::ASC) Order by the position column
 * @method     ChildInseeGeoDepartmentQuery orderByMainMunicipalityId($order = Criteria::ASC) Order by the main_municipality_id column
 * @method     ChildInseeGeoDepartmentQuery orderByRegionId($order = Criteria::ASC) Order by the region_id column
 * @method     ChildInseeGeoDepartmentQuery orderByGeoPoint2dX($order = Criteria::ASC) Order by the geo_point2d_x column
 * @method     ChildInseeGeoDepartmentQuery orderByGeoPoint2dY($order = Criteria::ASC) Order by the geo_point2d_y column
 * @method     ChildInseeGeoDepartmentQuery orderByGeoShape($order = Criteria::ASC) Order by the geo_shape column
 * @method     ChildInseeGeoDepartmentQuery orderByCreatedAt($order = Criteria::ASC) Order by the created_at column
 * @method     ChildInseeGeoDepartmentQuery orderByUpdatedAt($order = Criteria::ASC) Order by the updated_at column
 *
 * @method     ChildInseeGeoDepartmentQuery groupById() Group by the id column
 * @method     ChildInseeGeoDepartmentQuery groupByInseeCode() Group by the insee_code column
 * @method     ChildInseeGeoDepartmentQuery groupByPosition() Group by the position column
 * @method     ChildInseeGeoDepartmentQuery groupByMainMunicipalityId() Group by the main_municipality_id column
 * @method     ChildInseeGeoDepartmentQuery groupByRegionId() Group by the region_id column
 * @method     ChildInseeGeoDepartmentQuery groupByGeoPoint2dX() Group by the geo_point2d_x column
 * @method     ChildInseeGeoDepartmentQuery groupByGeoPoint2dY() Group by the geo_point2d_y column
 * @method     ChildInseeGeoDepartmentQuery groupByGeoShape() Group by the geo_shape column
 * @method     ChildInseeGeoDepartmentQuery groupByCreatedAt() Group by the created_at column
 * @method     ChildInseeGeoDepartmentQuery groupByUpdatedAt() Group by the updated_at column
 *
 * @method     ChildInseeGeoDepartmentQuery leftJoin($relation) Adds a LEFT JOIN clause to the query
 * @method     ChildInseeGeoDepartmentQuery rightJoin($relation) Adds a RIGHT JOIN clause to the query
 * @method     ChildInseeGeoDepartmentQuery innerJoin($relation) Adds a INNER JOIN clause to the query
 *
 * @method     ChildInseeGeoDepartmentQuery leftJoinInseeGeoRegion($relationAlias = null) Adds a LEFT JOIN clause to the query using the InseeGeoRegion relation
 * @method     ChildInseeGeoDepartmentQuery rightJoinInseeGeoRegion($relationAlias = null) Adds a RIGHT JOIN clause to the query using the InseeGeoRegion relation
 * @method     ChildInseeGeoDepartmentQuery innerJoinInseeGeoRegion($relationAlias = null) Adds a INNER JOIN clause to the query using the InseeGeoRegion relation
 *
 * @method     ChildInseeGeoDepartmentQuery leftJoinInseeGeoMunicipality($relationAlias = null) Adds a LEFT JOIN clause to the query using the InseeGeoMunicipality relation
 * @method     ChildInseeGeoDepartmentQuery rightJoinInseeGeoMunicipality($relationAlias = null) Adds a RIGHT JOIN clause to the query using the InseeGeoMunicipality relation
 * @method     ChildInseeGeoDepartmentQuery innerJoinInseeGeoMunicipality($relationAlias = null) Adds a INNER JOIN clause to the query using the InseeGeoMunicipality relation
 *
 * @method     ChildInseeGeoDepartmentQuery leftJoinInseeGeoDepartmentI18n($relationAlias = null) Adds a LEFT JOIN clause to the query using the InseeGeoDepartmentI18n relation
 * @method     ChildInseeGeoDepartmentQuery rightJoinInseeGeoDepartmentI18n($relationAlias = null) Adds a RIGHT JOIN clause to the query using the InseeGeoDepartmentI18n relation
 * @method     ChildInseeGeoDepartmentQuery innerJoinInseeGeoDepartmentI18n($relationAlias = null) Adds a INNER JOIN clause to the query using the InseeGeoDepartmentI18n relation
 *
 * @method     ChildInseeGeoDepartment findOne(ConnectionInterface $con = null) Return the first ChildInseeGeoDepartment matching the query
 * @method     ChildInseeGeoDepartment findOneOrCreate(ConnectionInterface $con = null) Return the first ChildInseeGeoDepartment matching the query, or a new ChildInseeGeoDepartment object populated from the query conditions when no match is found
 *
 * @method     ChildInseeGeoDepartment findOneById(int $id) Return the first ChildInseeGeoDepartment filtered by the id column
 * @method     ChildInseeGeoDepartment findOneByInseeCode(string $insee_code) Return the first ChildInseeGeoDepartment filtered by the insee_code column
 * @method     ChildInseeGeoDepartment findOneByPosition(int $position) Return the first ChildInseeGeoDepartment filtered by the position column
 * @method     ChildInseeGeoDepartment findOneByMainMunicipalityId(string $main_municipality_id) Return the first ChildInseeGeoDepartment filtered by the main_municipality_id column
 * @method     ChildInseeGeoDepartment findOneByRegionId(int $region_id) Return the first ChildInseeGeoDepartment filtered by the region_id column
 * @method     ChildInseeGeoDepartment findOneByGeoPoint2dX(double $geo_point2d_x) Return the first ChildInseeGeoDepartment filtered by the geo_point2d_x column
 * @method     ChildInseeGeoDepartment findOneByGeoPoint2dY(double $geo_point2d_y) Return the first ChildInseeGeoDepartment filtered by the geo_point2d_y column
 * @method     ChildInseeGeoDepartment findOneByGeoShape(string $geo_shape) Return the first ChildInseeGeoDepartment filtered by the geo_shape column
 * @method     ChildInseeGeoDepartment findOneByCreatedAt(string $created_at) Return the first ChildInseeGeoDepartment filtered by the created_at column
 * @method     ChildInseeGeoDepartment findOneByUpdatedAt(string $updated_at) Return the first ChildInseeGeoDepartment filtered by the updated_at column
 *
 * @method     array findById(int $id) Return ChildInseeGeoDepartment objects filtered by the id column
 * @method     array findByInseeCode(string $insee_code) Return ChildInseeGeoDepartment objects filtered by the insee_code column
 * @method     array findByPosition(int $position) Return ChildInseeGeoDepartment objects filtered by the position column
 * @method     array findByMainMunicipalityId(string $main_municipality_id) Return ChildInseeGeoDepartment objects filtered by the main_municipality_id column
 * @method     array findByRegionId(int $region_id) Return ChildInseeGeoDepartment objects filtered by the region_id column
 * @method     array findByGeoPoint2dX(double $geo_point2d_x) Return ChildInseeGeoDepartment objects filtered by the geo_point2d_x column
 * @method     array findByGeoPoint2dY(double $geo_point2d_y) Return ChildInseeGeoDepartment objects filtered by the geo_point2d_y column
 * @method     array findByGeoShape(string $geo_shape) Return ChildInseeGeoDepartment objects filtered by the geo_shape column
 * @method     array findByCreatedAt(string $created_at) Return ChildInseeGeoDepartment objects filtered by the created_at column
 * @method     array findByUpdatedAt(string $updated_at) Return ChildInseeGeoDepartment objects filtered by the updated_at column
 *
 */
abstract class InseeGeoDepartmentQuery extends ModelCriteria
{

    /**
     * Initializes internal state of \INSEEGeo\Model\Base\InseeGeoDepartmentQuery object.
     *
     * @param     string $dbName The database name
     * @param     string $modelName The phpName of a model, e.g. 'Book'
     * @param     string $modelAlias The alias for the model in this query, e.g. 'b'
     */
    public function __construct($dbName = 'thelia', $modelName = '\\INSEEGeo\\Model\\InseeGeoDepartment', $modelAlias = null)
    {
        parent::__construct($dbName, $modelName, $modelAlias);
    }

    /**
     * Returns a new ChildInseeGeoDepartmentQuery object.
     *
     * @param     string $modelAlias The alias of a model in the query
     * @param     Criteria $criteria Optional Criteria to build the query from
     *
     * @return ChildInseeGeoDepartmentQuery
     */
    public static function create($modelAlias = null, $criteria = null)
    {
        if ($criteria instanceof \INSEEGeo\Model\InseeGeoDepartmentQuery) {
            return $criteria;
        }
        $query = new \INSEEGeo\Model\InseeGeoDepartmentQuery();
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
     * @return ChildInseeGeoDepartment|array|mixed the result, formatted by the current formatter
     */
    public function findPk($key, $con = null)
    {
        if ($key === null) {
            return null;
        }
        if ((null !== ($obj = InseeGeoDepartmentTableMap::getInstanceFromPool((string) $key))) && !$this->formatter) {
            // the object is already in the instance pool
            return $obj;
        }
        if ($con === null) {
            $con = Propel::getServiceContainer()->getReadConnection(InseeGeoDepartmentTableMap::DATABASE_NAME);
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
     * @return   ChildInseeGeoDepartment A model object, or null if the key is not found
     */
    protected function findPkSimple($key, $con)
    {
        $sql = 'SELECT ID, INSEE_CODE, POSITION, MAIN_MUNICIPALITY_ID, REGION_ID, GEO_POINT2D_X, GEO_POINT2D_Y, GEO_SHAPE, CREATED_AT, UPDATED_AT FROM insee_geo_department WHERE ID = :p0';
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
            $obj = new ChildInseeGeoDepartment();
            $obj->hydrate($row);
            InseeGeoDepartmentTableMap::addInstanceToPool($obj, (string) $key);
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
     * @return ChildInseeGeoDepartment|array|mixed the result, formatted by the current formatter
     */
    protected function findPkComplex($key, $con)
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
    public function findPks($keys, $con = null)
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
     * @return ChildInseeGeoDepartmentQuery The current query, for fluid interface
     */
    public function filterByPrimaryKey($key)
    {

        return $this->addUsingAlias(InseeGeoDepartmentTableMap::ID, $key, Criteria::EQUAL);
    }

    /**
     * Filter the query by a list of primary keys
     *
     * @param     array $keys The list of primary key to use for the query
     *
     * @return ChildInseeGeoDepartmentQuery The current query, for fluid interface
     */
    public function filterByPrimaryKeys($keys)
    {

        return $this->addUsingAlias(InseeGeoDepartmentTableMap::ID, $keys, Criteria::IN);
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
     * @return ChildInseeGeoDepartmentQuery The current query, for fluid interface
     */
    public function filterById($id = null, $comparison = null)
    {
        if (is_array($id)) {
            $useMinMax = false;
            if (isset($id['min'])) {
                $this->addUsingAlias(InseeGeoDepartmentTableMap::ID, $id['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($id['max'])) {
                $this->addUsingAlias(InseeGeoDepartmentTableMap::ID, $id['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        return $this->addUsingAlias(InseeGeoDepartmentTableMap::ID, $id, $comparison);
    }

    /**
     * Filter the query on the insee_code column
     *
     * Example usage:
     * <code>
     * $query->filterByInseeCode('fooValue');   // WHERE insee_code = 'fooValue'
     * $query->filterByInseeCode('%fooValue%'); // WHERE insee_code LIKE '%fooValue%'
     * </code>
     *
     * @param     string $inseeCode The value to use as filter.
     *              Accepts wildcards (* and % trigger a LIKE)
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return ChildInseeGeoDepartmentQuery The current query, for fluid interface
     */
    public function filterByInseeCode($inseeCode = null, $comparison = null)
    {
        if (null === $comparison) {
            if (is_array($inseeCode)) {
                $comparison = Criteria::IN;
            } elseif (preg_match('/[\%\*]/', $inseeCode)) {
                $inseeCode = str_replace('*', '%', $inseeCode);
                $comparison = Criteria::LIKE;
            }
        }

        return $this->addUsingAlias(InseeGeoDepartmentTableMap::INSEE_CODE, $inseeCode, $comparison);
    }

    /**
     * Filter the query on the position column
     *
     * Example usage:
     * <code>
     * $query->filterByPosition(1234); // WHERE position = 1234
     * $query->filterByPosition(array(12, 34)); // WHERE position IN (12, 34)
     * $query->filterByPosition(array('min' => 12)); // WHERE position > 12
     * </code>
     *
     * @param     mixed $position The value to use as filter.
     *              Use scalar values for equality.
     *              Use array values for in_array() equivalent.
     *              Use associative array('min' => $minValue, 'max' => $maxValue) for intervals.
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return ChildInseeGeoDepartmentQuery The current query, for fluid interface
     */
    public function filterByPosition($position = null, $comparison = null)
    {
        if (is_array($position)) {
            $useMinMax = false;
            if (isset($position['min'])) {
                $this->addUsingAlias(InseeGeoDepartmentTableMap::POSITION, $position['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($position['max'])) {
                $this->addUsingAlias(InseeGeoDepartmentTableMap::POSITION, $position['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        return $this->addUsingAlias(InseeGeoDepartmentTableMap::POSITION, $position, $comparison);
    }

    /**
     * Filter the query on the main_municipality_id column
     *
     * Example usage:
     * <code>
     * $query->filterByMainMunicipalityId('fooValue');   // WHERE main_municipality_id = 'fooValue'
     * $query->filterByMainMunicipalityId('%fooValue%'); // WHERE main_municipality_id LIKE '%fooValue%'
     * </code>
     *
     * @param     string $mainMunicipalityId The value to use as filter.
     *              Accepts wildcards (* and % trigger a LIKE)
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return ChildInseeGeoDepartmentQuery The current query, for fluid interface
     */
    public function filterByMainMunicipalityId($mainMunicipalityId = null, $comparison = null)
    {
        if (null === $comparison) {
            if (is_array($mainMunicipalityId)) {
                $comparison = Criteria::IN;
            } elseif (preg_match('/[\%\*]/', $mainMunicipalityId)) {
                $mainMunicipalityId = str_replace('*', '%', $mainMunicipalityId);
                $comparison = Criteria::LIKE;
            }
        }

        return $this->addUsingAlias(InseeGeoDepartmentTableMap::MAIN_MUNICIPALITY_ID, $mainMunicipalityId, $comparison);
    }

    /**
     * Filter the query on the region_id column
     *
     * Example usage:
     * <code>
     * $query->filterByRegionId(1234); // WHERE region_id = 1234
     * $query->filterByRegionId(array(12, 34)); // WHERE region_id IN (12, 34)
     * $query->filterByRegionId(array('min' => 12)); // WHERE region_id > 12
     * </code>
     *
     * @see       filterByInseeGeoRegion()
     *
     * @param     mixed $regionId The value to use as filter.
     *              Use scalar values for equality.
     *              Use array values for in_array() equivalent.
     *              Use associative array('min' => $minValue, 'max' => $maxValue) for intervals.
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return ChildInseeGeoDepartmentQuery The current query, for fluid interface
     */
    public function filterByRegionId($regionId = null, $comparison = null)
    {
        if (is_array($regionId)) {
            $useMinMax = false;
            if (isset($regionId['min'])) {
                $this->addUsingAlias(InseeGeoDepartmentTableMap::REGION_ID, $regionId['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($regionId['max'])) {
                $this->addUsingAlias(InseeGeoDepartmentTableMap::REGION_ID, $regionId['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        return $this->addUsingAlias(InseeGeoDepartmentTableMap::REGION_ID, $regionId, $comparison);
    }

    /**
     * Filter the query on the geo_point2d_x column
     *
     * Example usage:
     * <code>
     * $query->filterByGeoPoint2dX(1234); // WHERE geo_point2d_x = 1234
     * $query->filterByGeoPoint2dX(array(12, 34)); // WHERE geo_point2d_x IN (12, 34)
     * $query->filterByGeoPoint2dX(array('min' => 12)); // WHERE geo_point2d_x > 12
     * </code>
     *
     * @param     mixed $geoPoint2dX The value to use as filter.
     *              Use scalar values for equality.
     *              Use array values for in_array() equivalent.
     *              Use associative array('min' => $minValue, 'max' => $maxValue) for intervals.
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return ChildInseeGeoDepartmentQuery The current query, for fluid interface
     */
    public function filterByGeoPoint2dX($geoPoint2dX = null, $comparison = null)
    {
        if (is_array($geoPoint2dX)) {
            $useMinMax = false;
            if (isset($geoPoint2dX['min'])) {
                $this->addUsingAlias(InseeGeoDepartmentTableMap::GEO_POINT2D_X, $geoPoint2dX['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($geoPoint2dX['max'])) {
                $this->addUsingAlias(InseeGeoDepartmentTableMap::GEO_POINT2D_X, $geoPoint2dX['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        return $this->addUsingAlias(InseeGeoDepartmentTableMap::GEO_POINT2D_X, $geoPoint2dX, $comparison);
    }

    /**
     * Filter the query on the geo_point2d_y column
     *
     * Example usage:
     * <code>
     * $query->filterByGeoPoint2dY(1234); // WHERE geo_point2d_y = 1234
     * $query->filterByGeoPoint2dY(array(12, 34)); // WHERE geo_point2d_y IN (12, 34)
     * $query->filterByGeoPoint2dY(array('min' => 12)); // WHERE geo_point2d_y > 12
     * </code>
     *
     * @param     mixed $geoPoint2dY The value to use as filter.
     *              Use scalar values for equality.
     *              Use array values for in_array() equivalent.
     *              Use associative array('min' => $minValue, 'max' => $maxValue) for intervals.
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return ChildInseeGeoDepartmentQuery The current query, for fluid interface
     */
    public function filterByGeoPoint2dY($geoPoint2dY = null, $comparison = null)
    {
        if (is_array($geoPoint2dY)) {
            $useMinMax = false;
            if (isset($geoPoint2dY['min'])) {
                $this->addUsingAlias(InseeGeoDepartmentTableMap::GEO_POINT2D_Y, $geoPoint2dY['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($geoPoint2dY['max'])) {
                $this->addUsingAlias(InseeGeoDepartmentTableMap::GEO_POINT2D_Y, $geoPoint2dY['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        return $this->addUsingAlias(InseeGeoDepartmentTableMap::GEO_POINT2D_Y, $geoPoint2dY, $comparison);
    }

    /**
     * Filter the query on the geo_shape column
     *
     * Example usage:
     * <code>
     * $query->filterByGeoShape('fooValue');   // WHERE geo_shape = 'fooValue'
     * $query->filterByGeoShape('%fooValue%'); // WHERE geo_shape LIKE '%fooValue%'
     * </code>
     *
     * @param     string $geoShape The value to use as filter.
     *              Accepts wildcards (* and % trigger a LIKE)
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return ChildInseeGeoDepartmentQuery The current query, for fluid interface
     */
    public function filterByGeoShape($geoShape = null, $comparison = null)
    {
        if (null === $comparison) {
            if (is_array($geoShape)) {
                $comparison = Criteria::IN;
            } elseif (preg_match('/[\%\*]/', $geoShape)) {
                $geoShape = str_replace('*', '%', $geoShape);
                $comparison = Criteria::LIKE;
            }
        }

        return $this->addUsingAlias(InseeGeoDepartmentTableMap::GEO_SHAPE, $geoShape, $comparison);
    }

    /**
     * Filter the query on the created_at column
     *
     * Example usage:
     * <code>
     * $query->filterByCreatedAt('2011-03-14'); // WHERE created_at = '2011-03-14'
     * $query->filterByCreatedAt('now'); // WHERE created_at = '2011-03-14'
     * $query->filterByCreatedAt(array('max' => 'yesterday')); // WHERE created_at > '2011-03-13'
     * </code>
     *
     * @param     mixed $createdAt The value to use as filter.
     *              Values can be integers (unix timestamps), DateTime objects, or strings.
     *              Empty strings are treated as NULL.
     *              Use scalar values for equality.
     *              Use array values for in_array() equivalent.
     *              Use associative array('min' => $minValue, 'max' => $maxValue) for intervals.
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return ChildInseeGeoDepartmentQuery The current query, for fluid interface
     */
    public function filterByCreatedAt($createdAt = null, $comparison = null)
    {
        if (is_array($createdAt)) {
            $useMinMax = false;
            if (isset($createdAt['min'])) {
                $this->addUsingAlias(InseeGeoDepartmentTableMap::CREATED_AT, $createdAt['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($createdAt['max'])) {
                $this->addUsingAlias(InseeGeoDepartmentTableMap::CREATED_AT, $createdAt['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        return $this->addUsingAlias(InseeGeoDepartmentTableMap::CREATED_AT, $createdAt, $comparison);
    }

    /**
     * Filter the query on the updated_at column
     *
     * Example usage:
     * <code>
     * $query->filterByUpdatedAt('2011-03-14'); // WHERE updated_at = '2011-03-14'
     * $query->filterByUpdatedAt('now'); // WHERE updated_at = '2011-03-14'
     * $query->filterByUpdatedAt(array('max' => 'yesterday')); // WHERE updated_at > '2011-03-13'
     * </code>
     *
     * @param     mixed $updatedAt The value to use as filter.
     *              Values can be integers (unix timestamps), DateTime objects, or strings.
     *              Empty strings are treated as NULL.
     *              Use scalar values for equality.
     *              Use array values for in_array() equivalent.
     *              Use associative array('min' => $minValue, 'max' => $maxValue) for intervals.
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return ChildInseeGeoDepartmentQuery The current query, for fluid interface
     */
    public function filterByUpdatedAt($updatedAt = null, $comparison = null)
    {
        if (is_array($updatedAt)) {
            $useMinMax = false;
            if (isset($updatedAt['min'])) {
                $this->addUsingAlias(InseeGeoDepartmentTableMap::UPDATED_AT, $updatedAt['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($updatedAt['max'])) {
                $this->addUsingAlias(InseeGeoDepartmentTableMap::UPDATED_AT, $updatedAt['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        return $this->addUsingAlias(InseeGeoDepartmentTableMap::UPDATED_AT, $updatedAt, $comparison);
    }

    /**
     * Filter the query by a related \INSEEGeo\Model\InseeGeoRegion object
     *
     * @param \INSEEGeo\Model\InseeGeoRegion|ObjectCollection $inseeGeoRegion The related object(s) to use as filter
     * @param string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return ChildInseeGeoDepartmentQuery The current query, for fluid interface
     */
    public function filterByInseeGeoRegion($inseeGeoRegion, $comparison = null)
    {
        if ($inseeGeoRegion instanceof \INSEEGeo\Model\InseeGeoRegion) {
            return $this
                ->addUsingAlias(InseeGeoDepartmentTableMap::REGION_ID, $inseeGeoRegion->getId(), $comparison);
        } elseif ($inseeGeoRegion instanceof ObjectCollection) {
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }

            return $this
                ->addUsingAlias(InseeGeoDepartmentTableMap::REGION_ID, $inseeGeoRegion->toKeyValue('PrimaryKey', 'Id'), $comparison);
        } else {
            throw new PropelException('filterByInseeGeoRegion() only accepts arguments of type \INSEEGeo\Model\InseeGeoRegion or Collection');
        }
    }

    /**
     * Adds a JOIN clause to the query using the InseeGeoRegion relation
     *
     * @param     string $relationAlias optional alias for the relation
     * @param     string $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return ChildInseeGeoDepartmentQuery The current query, for fluid interface
     */
    public function joinInseeGeoRegion($relationAlias = null, $joinType = Criteria::LEFT_JOIN)
    {
        $tableMap = $this->getTableMap();
        $relationMap = $tableMap->getRelation('InseeGeoRegion');

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
            $this->addJoinObject($join, 'InseeGeoRegion');
        }

        return $this;
    }

    /**
     * Use the InseeGeoRegion relation InseeGeoRegion object
     *
     * @see useQuery()
     *
     * @param     string $relationAlias optional alias for the relation,
     *                                   to be used as main alias in the secondary query
     * @param     string $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return   \INSEEGeo\Model\InseeGeoRegionQuery A secondary query class using the current class as primary query
     */
    public function useInseeGeoRegionQuery($relationAlias = null, $joinType = Criteria::LEFT_JOIN)
    {
        return $this
            ->joinInseeGeoRegion($relationAlias, $joinType)
            ->useQuery($relationAlias ? $relationAlias : 'InseeGeoRegion', '\INSEEGeo\Model\InseeGeoRegionQuery');
    }

    /**
     * Filter the query by a related \INSEEGeo\Model\InseeGeoMunicipality object
     *
     * @param \INSEEGeo\Model\InseeGeoMunicipality|ObjectCollection $inseeGeoMunicipality  the related object to use as filter
     * @param string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return ChildInseeGeoDepartmentQuery The current query, for fluid interface
     */
    public function filterByInseeGeoMunicipality($inseeGeoMunicipality, $comparison = null)
    {
        if ($inseeGeoMunicipality instanceof \INSEEGeo\Model\InseeGeoMunicipality) {
            return $this
                ->addUsingAlias(InseeGeoDepartmentTableMap::ID, $inseeGeoMunicipality->getDepartmentId(), $comparison);
        } elseif ($inseeGeoMunicipality instanceof ObjectCollection) {
            return $this
                ->useInseeGeoMunicipalityQuery()
                ->filterByPrimaryKeys($inseeGeoMunicipality->getPrimaryKeys())
                ->endUse();
        } else {
            throw new PropelException('filterByInseeGeoMunicipality() only accepts arguments of type \INSEEGeo\Model\InseeGeoMunicipality or Collection');
        }
    }

    /**
     * Adds a JOIN clause to the query using the InseeGeoMunicipality relation
     *
     * @param     string $relationAlias optional alias for the relation
     * @param     string $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return ChildInseeGeoDepartmentQuery The current query, for fluid interface
     */
    public function joinInseeGeoMunicipality($relationAlias = null, $joinType = Criteria::LEFT_JOIN)
    {
        $tableMap = $this->getTableMap();
        $relationMap = $tableMap->getRelation('InseeGeoMunicipality');

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
            $this->addJoinObject($join, 'InseeGeoMunicipality');
        }

        return $this;
    }

    /**
     * Use the InseeGeoMunicipality relation InseeGeoMunicipality object
     *
     * @see useQuery()
     *
     * @param     string $relationAlias optional alias for the relation,
     *                                   to be used as main alias in the secondary query
     * @param     string $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return   \INSEEGeo\Model\InseeGeoMunicipalityQuery A secondary query class using the current class as primary query
     */
    public function useInseeGeoMunicipalityQuery($relationAlias = null, $joinType = Criteria::LEFT_JOIN)
    {
        return $this
            ->joinInseeGeoMunicipality($relationAlias, $joinType)
            ->useQuery($relationAlias ? $relationAlias : 'InseeGeoMunicipality', '\INSEEGeo\Model\InseeGeoMunicipalityQuery');
    }

    /**
     * Filter the query by a related \INSEEGeo\Model\InseeGeoDepartmentI18n object
     *
     * @param \INSEEGeo\Model\InseeGeoDepartmentI18n|ObjectCollection $inseeGeoDepartmentI18n  the related object to use as filter
     * @param string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return ChildInseeGeoDepartmentQuery The current query, for fluid interface
     */
    public function filterByInseeGeoDepartmentI18n($inseeGeoDepartmentI18n, $comparison = null)
    {
        if ($inseeGeoDepartmentI18n instanceof \INSEEGeo\Model\InseeGeoDepartmentI18n) {
            return $this
                ->addUsingAlias(InseeGeoDepartmentTableMap::ID, $inseeGeoDepartmentI18n->getId(), $comparison);
        } elseif ($inseeGeoDepartmentI18n instanceof ObjectCollection) {
            return $this
                ->useInseeGeoDepartmentI18nQuery()
                ->filterByPrimaryKeys($inseeGeoDepartmentI18n->getPrimaryKeys())
                ->endUse();
        } else {
            throw new PropelException('filterByInseeGeoDepartmentI18n() only accepts arguments of type \INSEEGeo\Model\InseeGeoDepartmentI18n or Collection');
        }
    }

    /**
     * Adds a JOIN clause to the query using the InseeGeoDepartmentI18n relation
     *
     * @param     string $relationAlias optional alias for the relation
     * @param     string $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return ChildInseeGeoDepartmentQuery The current query, for fluid interface
     */
    public function joinInseeGeoDepartmentI18n($relationAlias = null, $joinType = 'LEFT JOIN')
    {
        $tableMap = $this->getTableMap();
        $relationMap = $tableMap->getRelation('InseeGeoDepartmentI18n');

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
            $this->addJoinObject($join, 'InseeGeoDepartmentI18n');
        }

        return $this;
    }

    /**
     * Use the InseeGeoDepartmentI18n relation InseeGeoDepartmentI18n object
     *
     * @see useQuery()
     *
     * @param     string $relationAlias optional alias for the relation,
     *                                   to be used as main alias in the secondary query
     * @param     string $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return   \INSEEGeo\Model\InseeGeoDepartmentI18nQuery A secondary query class using the current class as primary query
     */
    public function useInseeGeoDepartmentI18nQuery($relationAlias = null, $joinType = 'LEFT JOIN')
    {
        return $this
            ->joinInseeGeoDepartmentI18n($relationAlias, $joinType)
            ->useQuery($relationAlias ? $relationAlias : 'InseeGeoDepartmentI18n', '\INSEEGeo\Model\InseeGeoDepartmentI18nQuery');
    }

    /**
     * Exclude object from result
     *
     * @param   ChildInseeGeoDepartment $inseeGeoDepartment Object to remove from the list of results
     *
     * @return ChildInseeGeoDepartmentQuery The current query, for fluid interface
     */
    public function prune($inseeGeoDepartment = null)
    {
        if ($inseeGeoDepartment) {
            $this->addUsingAlias(InseeGeoDepartmentTableMap::ID, $inseeGeoDepartment->getId(), Criteria::NOT_EQUAL);
        }

        return $this;
    }

    /**
     * Deletes all rows from the insee_geo_department table.
     *
     * @param ConnectionInterface $con the connection to use
     * @return int The number of affected rows (if supported by underlying database driver).
     */
    public function doDeleteAll(ConnectionInterface $con = null)
    {
        if (null === $con) {
            $con = Propel::getServiceContainer()->getWriteConnection(InseeGeoDepartmentTableMap::DATABASE_NAME);
        }
        $affectedRows = 0; // initialize var to track total num of affected rows
        try {
            // use transaction because $criteria could contain info
            // for more than one table or we could emulating ON DELETE CASCADE, etc.
            $con->beginTransaction();
            $affectedRows += parent::doDeleteAll($con);
            // Because this db requires some delete cascade/set null emulation, we have to
            // clear the cached instance *after* the emulation has happened (since
            // instances get re-added by the select statement contained therein).
            InseeGeoDepartmentTableMap::clearInstancePool();
            InseeGeoDepartmentTableMap::clearRelatedInstancePool();

            $con->commit();
        } catch (PropelException $e) {
            $con->rollBack();
            throw $e;
        }

        return $affectedRows;
    }

    /**
     * Performs a DELETE on the database, given a ChildInseeGeoDepartment or Criteria object OR a primary key value.
     *
     * @param mixed               $values Criteria or ChildInseeGeoDepartment object or primary key or array of primary keys
     *              which is used to create the DELETE statement
     * @param ConnectionInterface $con the connection to use
     * @return int The number of affected rows (if supported by underlying database driver).  This includes CASCADE-related rows
     *                if supported by native driver or if emulated using Propel.
     * @throws PropelException Any exceptions caught during processing will be
     *         rethrown wrapped into a PropelException.
     */
     public function delete(ConnectionInterface $con = null)
     {
        if (null === $con) {
            $con = Propel::getServiceContainer()->getWriteConnection(InseeGeoDepartmentTableMap::DATABASE_NAME);
        }

        $criteria = $this;

        // Set the correct dbName
        $criteria->setDbName(InseeGeoDepartmentTableMap::DATABASE_NAME);

        $affectedRows = 0; // initialize var to track total num of affected rows

        try {
            // use transaction because $criteria could contain info
            // for more than one table or we could emulating ON DELETE CASCADE, etc.
            $con->beginTransaction();


        InseeGeoDepartmentTableMap::removeInstanceFromPool($criteria);

            $affectedRows += ModelCriteria::delete($con);
            InseeGeoDepartmentTableMap::clearRelatedInstancePool();
            $con->commit();

            return $affectedRows;
        } catch (PropelException $e) {
            $con->rollBack();
            throw $e;
        }
    }

    // timestampable behavior

    /**
     * Filter by the latest updated
     *
     * @param      int $nbDays Maximum age of the latest update in days
     *
     * @return     ChildInseeGeoDepartmentQuery The current query, for fluid interface
     */
    public function recentlyUpdated($nbDays = 7)
    {
        return $this->addUsingAlias(InseeGeoDepartmentTableMap::UPDATED_AT, time() - $nbDays * 24 * 60 * 60, Criteria::GREATER_EQUAL);
    }

    /**
     * Filter by the latest created
     *
     * @param      int $nbDays Maximum age of in days
     *
     * @return     ChildInseeGeoDepartmentQuery The current query, for fluid interface
     */
    public function recentlyCreated($nbDays = 7)
    {
        return $this->addUsingAlias(InseeGeoDepartmentTableMap::CREATED_AT, time() - $nbDays * 24 * 60 * 60, Criteria::GREATER_EQUAL);
    }

    /**
     * Order by update date desc
     *
     * @return     ChildInseeGeoDepartmentQuery The current query, for fluid interface
     */
    public function lastUpdatedFirst()
    {
        return $this->addDescendingOrderByColumn(InseeGeoDepartmentTableMap::UPDATED_AT);
    }

    /**
     * Order by update date asc
     *
     * @return     ChildInseeGeoDepartmentQuery The current query, for fluid interface
     */
    public function firstUpdatedFirst()
    {
        return $this->addAscendingOrderByColumn(InseeGeoDepartmentTableMap::UPDATED_AT);
    }

    /**
     * Order by create date desc
     *
     * @return     ChildInseeGeoDepartmentQuery The current query, for fluid interface
     */
    public function lastCreatedFirst()
    {
        return $this->addDescendingOrderByColumn(InseeGeoDepartmentTableMap::CREATED_AT);
    }

    /**
     * Order by create date asc
     *
     * @return     ChildInseeGeoDepartmentQuery The current query, for fluid interface
     */
    public function firstCreatedFirst()
    {
        return $this->addAscendingOrderByColumn(InseeGeoDepartmentTableMap::CREATED_AT);
    }

    // i18n behavior

    /**
     * Adds a JOIN clause to the query using the i18n relation
     *
     * @param     string $locale Locale to use for the join condition, e.g. 'fr_FR'
     * @param     string $relationAlias optional alias for the relation
     * @param     string $joinType Accepted values are null, 'left join', 'right join', 'inner join'. Defaults to left join.
     *
     * @return    ChildInseeGeoDepartmentQuery The current query, for fluid interface
     */
    public function joinI18n($locale = 'en_US', $relationAlias = null, $joinType = Criteria::LEFT_JOIN)
    {
        $relationName = $relationAlias ? $relationAlias : 'InseeGeoDepartmentI18n';

        return $this
            ->joinInseeGeoDepartmentI18n($relationAlias, $joinType)
            ->addJoinCondition($relationName, $relationName . '.Locale = ?', $locale);
    }

    /**
     * Adds a JOIN clause to the query and hydrates the related I18n object.
     * Shortcut for $c->joinI18n($locale)->with()
     *
     * @param     string $locale Locale to use for the join condition, e.g. 'fr_FR'
     * @param     string $joinType Accepted values are null, 'left join', 'right join', 'inner join'. Defaults to left join.
     *
     * @return    ChildInseeGeoDepartmentQuery The current query, for fluid interface
     */
    public function joinWithI18n($locale = 'en_US', $joinType = Criteria::LEFT_JOIN)
    {
        $this
            ->joinI18n($locale, null, $joinType)
            ->with('InseeGeoDepartmentI18n');
        $this->with['InseeGeoDepartmentI18n']->setIsWithOneToMany(false);

        return $this;
    }

    /**
     * Use the I18n relation query object
     *
     * @see       useQuery()
     *
     * @param     string $locale Locale to use for the join condition, e.g. 'fr_FR'
     * @param     string $relationAlias optional alias for the relation
     * @param     string $joinType Accepted values are null, 'left join', 'right join', 'inner join'. Defaults to left join.
     *
     * @return    ChildInseeGeoDepartmentI18nQuery A secondary query class using the current class as primary query
     */
    public function useI18nQuery($locale = 'en_US', $relationAlias = null, $joinType = Criteria::LEFT_JOIN)
    {
        return $this
            ->joinI18n($locale, $relationAlias, $joinType)
            ->useQuery($relationAlias ? $relationAlias : 'InseeGeoDepartmentI18n', '\INSEEGeo\Model\InseeGeoDepartmentI18nQuery');
    }

} // InseeGeoDepartmentQuery
