<?php

namespace INSEEGeo\Model\Base;

use \Exception;
use \PDO;
use INSEEGeo\Model\InseeGeoMunicipality as ChildInseeGeoMunicipality;
use INSEEGeo\Model\InseeGeoMunicipalityI18nQuery as ChildInseeGeoMunicipalityI18nQuery;
use INSEEGeo\Model\InseeGeoMunicipalityQuery as ChildInseeGeoMunicipalityQuery;
use INSEEGeo\Model\Map\InseeGeoMunicipalityTableMap;
use Propel\Runtime\Propel;
use Propel\Runtime\ActiveQuery\Criteria;
use Propel\Runtime\ActiveQuery\ModelCriteria;
use Propel\Runtime\ActiveQuery\ModelJoin;
use Propel\Runtime\Collection\Collection;
use Propel\Runtime\Collection\ObjectCollection;
use Propel\Runtime\Connection\ConnectionInterface;
use Propel\Runtime\Exception\PropelException;

/**
 * Base class that represents a query for the 'insee_geo_municipality' table.
 *
 *
 *
 * @method     ChildInseeGeoMunicipalityQuery orderById($order = Criteria::ASC) Order by the id column
 * @method     ChildInseeGeoMunicipalityQuery orderByInseeCode($order = Criteria::ASC) Order by the insee_code column
 * @method     ChildInseeGeoMunicipalityQuery orderByZipCode($order = Criteria::ASC) Order by the zip_code column
 * @method     ChildInseeGeoMunicipalityQuery orderByGeoPoint2dX($order = Criteria::ASC) Order by the geo_point2d_x column
 * @method     ChildInseeGeoMunicipalityQuery orderByGeoPoint2dY($order = Criteria::ASC) Order by the geo_point2d_y column
 * @method     ChildInseeGeoMunicipalityQuery orderByGeoShape($order = Criteria::ASC) Order by the geo_shape column
 * @method     ChildInseeGeoMunicipalityQuery orderByMunicipalityCode($order = Criteria::ASC) Order by the municipality_code column
 * @method     ChildInseeGeoMunicipalityQuery orderByDistrictCode($order = Criteria::ASC) Order by the district_code column
 * @method     ChildInseeGeoMunicipalityQuery orderByDepartmentId($order = Criteria::ASC) Order by the department_id column
 * @method     ChildInseeGeoMunicipalityQuery orderByRegionId($order = Criteria::ASC) Order by the region_id column
 * @method     ChildInseeGeoMunicipalityQuery orderByCreatedAt($order = Criteria::ASC) Order by the created_at column
 * @method     ChildInseeGeoMunicipalityQuery orderByUpdatedAt($order = Criteria::ASC) Order by the updated_at column
 *
 * @method     ChildInseeGeoMunicipalityQuery groupById() Group by the id column
 * @method     ChildInseeGeoMunicipalityQuery groupByInseeCode() Group by the insee_code column
 * @method     ChildInseeGeoMunicipalityQuery groupByZipCode() Group by the zip_code column
 * @method     ChildInseeGeoMunicipalityQuery groupByGeoPoint2dX() Group by the geo_point2d_x column
 * @method     ChildInseeGeoMunicipalityQuery groupByGeoPoint2dY() Group by the geo_point2d_y column
 * @method     ChildInseeGeoMunicipalityQuery groupByGeoShape() Group by the geo_shape column
 * @method     ChildInseeGeoMunicipalityQuery groupByMunicipalityCode() Group by the municipality_code column
 * @method     ChildInseeGeoMunicipalityQuery groupByDistrictCode() Group by the district_code column
 * @method     ChildInseeGeoMunicipalityQuery groupByDepartmentId() Group by the department_id column
 * @method     ChildInseeGeoMunicipalityQuery groupByRegionId() Group by the region_id column
 * @method     ChildInseeGeoMunicipalityQuery groupByCreatedAt() Group by the created_at column
 * @method     ChildInseeGeoMunicipalityQuery groupByUpdatedAt() Group by the updated_at column
 *
 * @method     ChildInseeGeoMunicipalityQuery leftJoin($relation) Adds a LEFT JOIN clause to the query
 * @method     ChildInseeGeoMunicipalityQuery rightJoin($relation) Adds a RIGHT JOIN clause to the query
 * @method     ChildInseeGeoMunicipalityQuery innerJoin($relation) Adds a INNER JOIN clause to the query
 *
 * @method     ChildInseeGeoMunicipalityQuery leftJoinInseeGeoDepartment($relationAlias = null) Adds a LEFT JOIN clause to the query using the InseeGeoDepartment relation
 * @method     ChildInseeGeoMunicipalityQuery rightJoinInseeGeoDepartment($relationAlias = null) Adds a RIGHT JOIN clause to the query using the InseeGeoDepartment relation
 * @method     ChildInseeGeoMunicipalityQuery innerJoinInseeGeoDepartment($relationAlias = null) Adds a INNER JOIN clause to the query using the InseeGeoDepartment relation
 *
 * @method     ChildInseeGeoMunicipalityQuery leftJoinInseeGeoRegion($relationAlias = null) Adds a LEFT JOIN clause to the query using the InseeGeoRegion relation
 * @method     ChildInseeGeoMunicipalityQuery rightJoinInseeGeoRegion($relationAlias = null) Adds a RIGHT JOIN clause to the query using the InseeGeoRegion relation
 * @method     ChildInseeGeoMunicipalityQuery innerJoinInseeGeoRegion($relationAlias = null) Adds a INNER JOIN clause to the query using the InseeGeoRegion relation
 *
 * @method     ChildInseeGeoMunicipalityQuery leftJoinInseeGeoMunicipalityI18n($relationAlias = null) Adds a LEFT JOIN clause to the query using the InseeGeoMunicipalityI18n relation
 * @method     ChildInseeGeoMunicipalityQuery rightJoinInseeGeoMunicipalityI18n($relationAlias = null) Adds a RIGHT JOIN clause to the query using the InseeGeoMunicipalityI18n relation
 * @method     ChildInseeGeoMunicipalityQuery innerJoinInseeGeoMunicipalityI18n($relationAlias = null) Adds a INNER JOIN clause to the query using the InseeGeoMunicipalityI18n relation
 *
 * @method     ChildInseeGeoMunicipality findOne(ConnectionInterface $con = null) Return the first ChildInseeGeoMunicipality matching the query
 * @method     ChildInseeGeoMunicipality findOneOrCreate(ConnectionInterface $con = null) Return the first ChildInseeGeoMunicipality matching the query, or a new ChildInseeGeoMunicipality object populated from the query conditions when no match is found
 *
 * @method     ChildInseeGeoMunicipality findOneById(int $id) Return the first ChildInseeGeoMunicipality filtered by the id column
 * @method     ChildInseeGeoMunicipality findOneByInseeCode(string $insee_code) Return the first ChildInseeGeoMunicipality filtered by the insee_code column
 * @method     ChildInseeGeoMunicipality findOneByZipCode(string $zip_code) Return the first ChildInseeGeoMunicipality filtered by the zip_code column
 * @method     ChildInseeGeoMunicipality findOneByGeoPoint2dX(double $geo_point2d_x) Return the first ChildInseeGeoMunicipality filtered by the geo_point2d_x column
 * @method     ChildInseeGeoMunicipality findOneByGeoPoint2dY(double $geo_point2d_y) Return the first ChildInseeGeoMunicipality filtered by the geo_point2d_y column
 * @method     ChildInseeGeoMunicipality findOneByGeoShape(string $geo_shape) Return the first ChildInseeGeoMunicipality filtered by the geo_shape column
 * @method     ChildInseeGeoMunicipality findOneByMunicipalityCode(int $municipality_code) Return the first ChildInseeGeoMunicipality filtered by the municipality_code column
 * @method     ChildInseeGeoMunicipality findOneByDistrictCode(int $district_code) Return the first ChildInseeGeoMunicipality filtered by the district_code column
 * @method     ChildInseeGeoMunicipality findOneByDepartmentId(int $department_id) Return the first ChildInseeGeoMunicipality filtered by the department_id column
 * @method     ChildInseeGeoMunicipality findOneByRegionId(int $region_id) Return the first ChildInseeGeoMunicipality filtered by the region_id column
 * @method     ChildInseeGeoMunicipality findOneByCreatedAt(string $created_at) Return the first ChildInseeGeoMunicipality filtered by the created_at column
 * @method     ChildInseeGeoMunicipality findOneByUpdatedAt(string $updated_at) Return the first ChildInseeGeoMunicipality filtered by the updated_at column
 *
 * @method     array findById(int $id) Return ChildInseeGeoMunicipality objects filtered by the id column
 * @method     array findByInseeCode(string $insee_code) Return ChildInseeGeoMunicipality objects filtered by the insee_code column
 * @method     array findByZipCode(string $zip_code) Return ChildInseeGeoMunicipality objects filtered by the zip_code column
 * @method     array findByGeoPoint2dX(double $geo_point2d_x) Return ChildInseeGeoMunicipality objects filtered by the geo_point2d_x column
 * @method     array findByGeoPoint2dY(double $geo_point2d_y) Return ChildInseeGeoMunicipality objects filtered by the geo_point2d_y column
 * @method     array findByGeoShape(string $geo_shape) Return ChildInseeGeoMunicipality objects filtered by the geo_shape column
 * @method     array findByMunicipalityCode(int $municipality_code) Return ChildInseeGeoMunicipality objects filtered by the municipality_code column
 * @method     array findByDistrictCode(int $district_code) Return ChildInseeGeoMunicipality objects filtered by the district_code column
 * @method     array findByDepartmentId(int $department_id) Return ChildInseeGeoMunicipality objects filtered by the department_id column
 * @method     array findByRegionId(int $region_id) Return ChildInseeGeoMunicipality objects filtered by the region_id column
 * @method     array findByCreatedAt(string $created_at) Return ChildInseeGeoMunicipality objects filtered by the created_at column
 * @method     array findByUpdatedAt(string $updated_at) Return ChildInseeGeoMunicipality objects filtered by the updated_at column
 *
 */
abstract class InseeGeoMunicipalityQuery extends ModelCriteria
{

    /**
     * Initializes internal state of \INSEEGeo\Model\Base\InseeGeoMunicipalityQuery object.
     *
     * @param     string $dbName The database name
     * @param     string $modelName The phpName of a model, e.g. 'Book'
     * @param     string $modelAlias The alias for the model in this query, e.g. 'b'
     */
    public function __construct($dbName = 'thelia', $modelName = '\\INSEEGeo\\Model\\InseeGeoMunicipality', $modelAlias = null)
    {
        parent::__construct($dbName, $modelName, $modelAlias);
    }

    /**
     * Returns a new ChildInseeGeoMunicipalityQuery object.
     *
     * @param     string $modelAlias The alias of a model in the query
     * @param     Criteria $criteria Optional Criteria to build the query from
     *
     * @return ChildInseeGeoMunicipalityQuery
     */
    public static function create($modelAlias = null, $criteria = null)
    {
        if ($criteria instanceof \INSEEGeo\Model\InseeGeoMunicipalityQuery) {
            return $criteria;
        }
        $query = new \INSEEGeo\Model\InseeGeoMunicipalityQuery();
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
     * @return ChildInseeGeoMunicipality|array|mixed the result, formatted by the current formatter
     */
    public function findPk($key, $con = null)
    {
        if ($key === null) {
            return null;
        }
        if ((null !== ($obj = InseeGeoMunicipalityTableMap::getInstanceFromPool((string) $key))) && !$this->formatter) {
            // the object is already in the instance pool
            return $obj;
        }
        if ($con === null) {
            $con = Propel::getServiceContainer()->getReadConnection(InseeGeoMunicipalityTableMap::DATABASE_NAME);
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
     * @return   ChildInseeGeoMunicipality A model object, or null if the key is not found
     */
    protected function findPkSimple($key, $con)
    {
        $sql = 'SELECT ID, INSEE_CODE, ZIP_CODE, GEO_POINT2D_X, GEO_POINT2D_Y, GEO_SHAPE, MUNICIPALITY_CODE, DISTRICT_CODE, DEPARTMENT_ID, REGION_ID, CREATED_AT, UPDATED_AT FROM insee_geo_municipality WHERE ID = :p0';
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
            $obj = new ChildInseeGeoMunicipality();
            $obj->hydrate($row);
            InseeGeoMunicipalityTableMap::addInstanceToPool($obj, (string) $key);
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
     * @return ChildInseeGeoMunicipality|array|mixed the result, formatted by the current formatter
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
     * @return ChildInseeGeoMunicipalityQuery The current query, for fluid interface
     */
    public function filterByPrimaryKey($key)
    {

        return $this->addUsingAlias(InseeGeoMunicipalityTableMap::ID, $key, Criteria::EQUAL);
    }

    /**
     * Filter the query by a list of primary keys
     *
     * @param     array $keys The list of primary key to use for the query
     *
     * @return ChildInseeGeoMunicipalityQuery The current query, for fluid interface
     */
    public function filterByPrimaryKeys($keys)
    {

        return $this->addUsingAlias(InseeGeoMunicipalityTableMap::ID, $keys, Criteria::IN);
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
     * @return ChildInseeGeoMunicipalityQuery The current query, for fluid interface
     */
    public function filterById($id = null, $comparison = null)
    {
        if (is_array($id)) {
            $useMinMax = false;
            if (isset($id['min'])) {
                $this->addUsingAlias(InseeGeoMunicipalityTableMap::ID, $id['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($id['max'])) {
                $this->addUsingAlias(InseeGeoMunicipalityTableMap::ID, $id['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        return $this->addUsingAlias(InseeGeoMunicipalityTableMap::ID, $id, $comparison);
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
     * @return ChildInseeGeoMunicipalityQuery The current query, for fluid interface
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

        return $this->addUsingAlias(InseeGeoMunicipalityTableMap::INSEE_CODE, $inseeCode, $comparison);
    }

    /**
     * Filter the query on the zip_code column
     *
     * Example usage:
     * <code>
     * $query->filterByZipCode('fooValue');   // WHERE zip_code = 'fooValue'
     * $query->filterByZipCode('%fooValue%'); // WHERE zip_code LIKE '%fooValue%'
     * </code>
     *
     * @param     string $zipCode The value to use as filter.
     *              Accepts wildcards (* and % trigger a LIKE)
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return ChildInseeGeoMunicipalityQuery The current query, for fluid interface
     */
    public function filterByZipCode($zipCode = null, $comparison = null)
    {
        if (null === $comparison) {
            if (is_array($zipCode)) {
                $comparison = Criteria::IN;
            } elseif (preg_match('/[\%\*]/', $zipCode)) {
                $zipCode = str_replace('*', '%', $zipCode);
                $comparison = Criteria::LIKE;
            }
        }

        return $this->addUsingAlias(InseeGeoMunicipalityTableMap::ZIP_CODE, $zipCode, $comparison);
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
     * @return ChildInseeGeoMunicipalityQuery The current query, for fluid interface
     */
    public function filterByGeoPoint2dX($geoPoint2dX = null, $comparison = null)
    {
        if (is_array($geoPoint2dX)) {
            $useMinMax = false;
            if (isset($geoPoint2dX['min'])) {
                $this->addUsingAlias(InseeGeoMunicipalityTableMap::GEO_POINT2D_X, $geoPoint2dX['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($geoPoint2dX['max'])) {
                $this->addUsingAlias(InseeGeoMunicipalityTableMap::GEO_POINT2D_X, $geoPoint2dX['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        return $this->addUsingAlias(InseeGeoMunicipalityTableMap::GEO_POINT2D_X, $geoPoint2dX, $comparison);
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
     * @return ChildInseeGeoMunicipalityQuery The current query, for fluid interface
     */
    public function filterByGeoPoint2dY($geoPoint2dY = null, $comparison = null)
    {
        if (is_array($geoPoint2dY)) {
            $useMinMax = false;
            if (isset($geoPoint2dY['min'])) {
                $this->addUsingAlias(InseeGeoMunicipalityTableMap::GEO_POINT2D_Y, $geoPoint2dY['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($geoPoint2dY['max'])) {
                $this->addUsingAlias(InseeGeoMunicipalityTableMap::GEO_POINT2D_Y, $geoPoint2dY['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        return $this->addUsingAlias(InseeGeoMunicipalityTableMap::GEO_POINT2D_Y, $geoPoint2dY, $comparison);
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
     * @return ChildInseeGeoMunicipalityQuery The current query, for fluid interface
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

        return $this->addUsingAlias(InseeGeoMunicipalityTableMap::GEO_SHAPE, $geoShape, $comparison);
    }

    /**
     * Filter the query on the municipality_code column
     *
     * Example usage:
     * <code>
     * $query->filterByMunicipalityCode(1234); // WHERE municipality_code = 1234
     * $query->filterByMunicipalityCode(array(12, 34)); // WHERE municipality_code IN (12, 34)
     * $query->filterByMunicipalityCode(array('min' => 12)); // WHERE municipality_code > 12
     * </code>
     *
     * @param     mixed $municipalityCode The value to use as filter.
     *              Use scalar values for equality.
     *              Use array values for in_array() equivalent.
     *              Use associative array('min' => $minValue, 'max' => $maxValue) for intervals.
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return ChildInseeGeoMunicipalityQuery The current query, for fluid interface
     */
    public function filterByMunicipalityCode($municipalityCode = null, $comparison = null)
    {
        if (is_array($municipalityCode)) {
            $useMinMax = false;
            if (isset($municipalityCode['min'])) {
                $this->addUsingAlias(InseeGeoMunicipalityTableMap::MUNICIPALITY_CODE, $municipalityCode['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($municipalityCode['max'])) {
                $this->addUsingAlias(InseeGeoMunicipalityTableMap::MUNICIPALITY_CODE, $municipalityCode['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        return $this->addUsingAlias(InseeGeoMunicipalityTableMap::MUNICIPALITY_CODE, $municipalityCode, $comparison);
    }

    /**
     * Filter the query on the district_code column
     *
     * Example usage:
     * <code>
     * $query->filterByDistrictCode(1234); // WHERE district_code = 1234
     * $query->filterByDistrictCode(array(12, 34)); // WHERE district_code IN (12, 34)
     * $query->filterByDistrictCode(array('min' => 12)); // WHERE district_code > 12
     * </code>
     *
     * @param     mixed $districtCode The value to use as filter.
     *              Use scalar values for equality.
     *              Use array values for in_array() equivalent.
     *              Use associative array('min' => $minValue, 'max' => $maxValue) for intervals.
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return ChildInseeGeoMunicipalityQuery The current query, for fluid interface
     */
    public function filterByDistrictCode($districtCode = null, $comparison = null)
    {
        if (is_array($districtCode)) {
            $useMinMax = false;
            if (isset($districtCode['min'])) {
                $this->addUsingAlias(InseeGeoMunicipalityTableMap::DISTRICT_CODE, $districtCode['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($districtCode['max'])) {
                $this->addUsingAlias(InseeGeoMunicipalityTableMap::DISTRICT_CODE, $districtCode['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        return $this->addUsingAlias(InseeGeoMunicipalityTableMap::DISTRICT_CODE, $districtCode, $comparison);
    }

    /**
     * Filter the query on the department_id column
     *
     * Example usage:
     * <code>
     * $query->filterByDepartmentId(1234); // WHERE department_id = 1234
     * $query->filterByDepartmentId(array(12, 34)); // WHERE department_id IN (12, 34)
     * $query->filterByDepartmentId(array('min' => 12)); // WHERE department_id > 12
     * </code>
     *
     * @see       filterByInseeGeoDepartment()
     *
     * @param     mixed $departmentId The value to use as filter.
     *              Use scalar values for equality.
     *              Use array values for in_array() equivalent.
     *              Use associative array('min' => $minValue, 'max' => $maxValue) for intervals.
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return ChildInseeGeoMunicipalityQuery The current query, for fluid interface
     */
    public function filterByDepartmentId($departmentId = null, $comparison = null)
    {
        if (is_array($departmentId)) {
            $useMinMax = false;
            if (isset($departmentId['min'])) {
                $this->addUsingAlias(InseeGeoMunicipalityTableMap::DEPARTMENT_ID, $departmentId['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($departmentId['max'])) {
                $this->addUsingAlias(InseeGeoMunicipalityTableMap::DEPARTMENT_ID, $departmentId['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        return $this->addUsingAlias(InseeGeoMunicipalityTableMap::DEPARTMENT_ID, $departmentId, $comparison);
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
     * @return ChildInseeGeoMunicipalityQuery The current query, for fluid interface
     */
    public function filterByRegionId($regionId = null, $comparison = null)
    {
        if (is_array($regionId)) {
            $useMinMax = false;
            if (isset($regionId['min'])) {
                $this->addUsingAlias(InseeGeoMunicipalityTableMap::REGION_ID, $regionId['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($regionId['max'])) {
                $this->addUsingAlias(InseeGeoMunicipalityTableMap::REGION_ID, $regionId['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        return $this->addUsingAlias(InseeGeoMunicipalityTableMap::REGION_ID, $regionId, $comparison);
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
     * @return ChildInseeGeoMunicipalityQuery The current query, for fluid interface
     */
    public function filterByCreatedAt($createdAt = null, $comparison = null)
    {
        if (is_array($createdAt)) {
            $useMinMax = false;
            if (isset($createdAt['min'])) {
                $this->addUsingAlias(InseeGeoMunicipalityTableMap::CREATED_AT, $createdAt['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($createdAt['max'])) {
                $this->addUsingAlias(InseeGeoMunicipalityTableMap::CREATED_AT, $createdAt['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        return $this->addUsingAlias(InseeGeoMunicipalityTableMap::CREATED_AT, $createdAt, $comparison);
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
     * @return ChildInseeGeoMunicipalityQuery The current query, for fluid interface
     */
    public function filterByUpdatedAt($updatedAt = null, $comparison = null)
    {
        if (is_array($updatedAt)) {
            $useMinMax = false;
            if (isset($updatedAt['min'])) {
                $this->addUsingAlias(InseeGeoMunicipalityTableMap::UPDATED_AT, $updatedAt['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($updatedAt['max'])) {
                $this->addUsingAlias(InseeGeoMunicipalityTableMap::UPDATED_AT, $updatedAt['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        return $this->addUsingAlias(InseeGeoMunicipalityTableMap::UPDATED_AT, $updatedAt, $comparison);
    }

    /**
     * Filter the query by a related \INSEEGeo\Model\InseeGeoDepartment object
     *
     * @param \INSEEGeo\Model\InseeGeoDepartment|ObjectCollection $inseeGeoDepartment The related object(s) to use as filter
     * @param string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return ChildInseeGeoMunicipalityQuery The current query, for fluid interface
     */
    public function filterByInseeGeoDepartment($inseeGeoDepartment, $comparison = null)
    {
        if ($inseeGeoDepartment instanceof \INSEEGeo\Model\InseeGeoDepartment) {
            return $this
                ->addUsingAlias(InseeGeoMunicipalityTableMap::DEPARTMENT_ID, $inseeGeoDepartment->getId(), $comparison);
        } elseif ($inseeGeoDepartment instanceof ObjectCollection) {
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }

            return $this
                ->addUsingAlias(InseeGeoMunicipalityTableMap::DEPARTMENT_ID, $inseeGeoDepartment->toKeyValue('PrimaryKey', 'Id'), $comparison);
        } else {
            throw new PropelException('filterByInseeGeoDepartment() only accepts arguments of type \INSEEGeo\Model\InseeGeoDepartment or Collection');
        }
    }

    /**
     * Adds a JOIN clause to the query using the InseeGeoDepartment relation
     *
     * @param     string $relationAlias optional alias for the relation
     * @param     string $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return ChildInseeGeoMunicipalityQuery The current query, for fluid interface
     */
    public function joinInseeGeoDepartment($relationAlias = null, $joinType = Criteria::LEFT_JOIN)
    {
        $tableMap = $this->getTableMap();
        $relationMap = $tableMap->getRelation('InseeGeoDepartment');

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
            $this->addJoinObject($join, 'InseeGeoDepartment');
        }

        return $this;
    }

    /**
     * Use the InseeGeoDepartment relation InseeGeoDepartment object
     *
     * @see useQuery()
     *
     * @param     string $relationAlias optional alias for the relation,
     *                                   to be used as main alias in the secondary query
     * @param     string $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return   \INSEEGeo\Model\InseeGeoDepartmentQuery A secondary query class using the current class as primary query
     */
    public function useInseeGeoDepartmentQuery($relationAlias = null, $joinType = Criteria::LEFT_JOIN)
    {
        return $this
            ->joinInseeGeoDepartment($relationAlias, $joinType)
            ->useQuery($relationAlias ? $relationAlias : 'InseeGeoDepartment', '\INSEEGeo\Model\InseeGeoDepartmentQuery');
    }

    /**
     * Filter the query by a related \INSEEGeo\Model\InseeGeoRegion object
     *
     * @param \INSEEGeo\Model\InseeGeoRegion|ObjectCollection $inseeGeoRegion The related object(s) to use as filter
     * @param string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return ChildInseeGeoMunicipalityQuery The current query, for fluid interface
     */
    public function filterByInseeGeoRegion($inseeGeoRegion, $comparison = null)
    {
        if ($inseeGeoRegion instanceof \INSEEGeo\Model\InseeGeoRegion) {
            return $this
                ->addUsingAlias(InseeGeoMunicipalityTableMap::REGION_ID, $inseeGeoRegion->getId(), $comparison);
        } elseif ($inseeGeoRegion instanceof ObjectCollection) {
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }

            return $this
                ->addUsingAlias(InseeGeoMunicipalityTableMap::REGION_ID, $inseeGeoRegion->toKeyValue('PrimaryKey', 'Id'), $comparison);
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
     * @return ChildInseeGeoMunicipalityQuery The current query, for fluid interface
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
     * Filter the query by a related \INSEEGeo\Model\InseeGeoMunicipalityI18n object
     *
     * @param \INSEEGeo\Model\InseeGeoMunicipalityI18n|ObjectCollection $inseeGeoMunicipalityI18n  the related object to use as filter
     * @param string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return ChildInseeGeoMunicipalityQuery The current query, for fluid interface
     */
    public function filterByInseeGeoMunicipalityI18n($inseeGeoMunicipalityI18n, $comparison = null)
    {
        if ($inseeGeoMunicipalityI18n instanceof \INSEEGeo\Model\InseeGeoMunicipalityI18n) {
            return $this
                ->addUsingAlias(InseeGeoMunicipalityTableMap::ID, $inseeGeoMunicipalityI18n->getId(), $comparison);
        } elseif ($inseeGeoMunicipalityI18n instanceof ObjectCollection) {
            return $this
                ->useInseeGeoMunicipalityI18nQuery()
                ->filterByPrimaryKeys($inseeGeoMunicipalityI18n->getPrimaryKeys())
                ->endUse();
        } else {
            throw new PropelException('filterByInseeGeoMunicipalityI18n() only accepts arguments of type \INSEEGeo\Model\InseeGeoMunicipalityI18n or Collection');
        }
    }

    /**
     * Adds a JOIN clause to the query using the InseeGeoMunicipalityI18n relation
     *
     * @param     string $relationAlias optional alias for the relation
     * @param     string $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return ChildInseeGeoMunicipalityQuery The current query, for fluid interface
     */
    public function joinInseeGeoMunicipalityI18n($relationAlias = null, $joinType = 'LEFT JOIN')
    {
        $tableMap = $this->getTableMap();
        $relationMap = $tableMap->getRelation('InseeGeoMunicipalityI18n');

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
            $this->addJoinObject($join, 'InseeGeoMunicipalityI18n');
        }

        return $this;
    }

    /**
     * Use the InseeGeoMunicipalityI18n relation InseeGeoMunicipalityI18n object
     *
     * @see useQuery()
     *
     * @param     string $relationAlias optional alias for the relation,
     *                                   to be used as main alias in the secondary query
     * @param     string $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return   \INSEEGeo\Model\InseeGeoMunicipalityI18nQuery A secondary query class using the current class as primary query
     */
    public function useInseeGeoMunicipalityI18nQuery($relationAlias = null, $joinType = 'LEFT JOIN')
    {
        return $this
            ->joinInseeGeoMunicipalityI18n($relationAlias, $joinType)
            ->useQuery($relationAlias ? $relationAlias : 'InseeGeoMunicipalityI18n', '\INSEEGeo\Model\InseeGeoMunicipalityI18nQuery');
    }

    /**
     * Exclude object from result
     *
     * @param   ChildInseeGeoMunicipality $inseeGeoMunicipality Object to remove from the list of results
     *
     * @return ChildInseeGeoMunicipalityQuery The current query, for fluid interface
     */
    public function prune($inseeGeoMunicipality = null)
    {
        if ($inseeGeoMunicipality) {
            $this->addUsingAlias(InseeGeoMunicipalityTableMap::ID, $inseeGeoMunicipality->getId(), Criteria::NOT_EQUAL);
        }

        return $this;
    }

    /**
     * Deletes all rows from the insee_geo_municipality table.
     *
     * @param ConnectionInterface $con the connection to use
     * @return int The number of affected rows (if supported by underlying database driver).
     */
    public function doDeleteAll(ConnectionInterface $con = null)
    {
        if (null === $con) {
            $con = Propel::getServiceContainer()->getWriteConnection(InseeGeoMunicipalityTableMap::DATABASE_NAME);
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
            InseeGeoMunicipalityTableMap::clearInstancePool();
            InseeGeoMunicipalityTableMap::clearRelatedInstancePool();

            $con->commit();
        } catch (PropelException $e) {
            $con->rollBack();
            throw $e;
        }

        return $affectedRows;
    }

    /**
     * Performs a DELETE on the database, given a ChildInseeGeoMunicipality or Criteria object OR a primary key value.
     *
     * @param mixed               $values Criteria or ChildInseeGeoMunicipality object or primary key or array of primary keys
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
            $con = Propel::getServiceContainer()->getWriteConnection(InseeGeoMunicipalityTableMap::DATABASE_NAME);
        }

        $criteria = $this;

        // Set the correct dbName
        $criteria->setDbName(InseeGeoMunicipalityTableMap::DATABASE_NAME);

        $affectedRows = 0; // initialize var to track total num of affected rows

        try {
            // use transaction because $criteria could contain info
            // for more than one table or we could emulating ON DELETE CASCADE, etc.
            $con->beginTransaction();


        InseeGeoMunicipalityTableMap::removeInstanceFromPool($criteria);

            $affectedRows += ModelCriteria::delete($con);
            InseeGeoMunicipalityTableMap::clearRelatedInstancePool();
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
     * @return     ChildInseeGeoMunicipalityQuery The current query, for fluid interface
     */
    public function recentlyUpdated($nbDays = 7)
    {
        return $this->addUsingAlias(InseeGeoMunicipalityTableMap::UPDATED_AT, time() - $nbDays * 24 * 60 * 60, Criteria::GREATER_EQUAL);
    }

    /**
     * Filter by the latest created
     *
     * @param      int $nbDays Maximum age of in days
     *
     * @return     ChildInseeGeoMunicipalityQuery The current query, for fluid interface
     */
    public function recentlyCreated($nbDays = 7)
    {
        return $this->addUsingAlias(InseeGeoMunicipalityTableMap::CREATED_AT, time() - $nbDays * 24 * 60 * 60, Criteria::GREATER_EQUAL);
    }

    /**
     * Order by update date desc
     *
     * @return     ChildInseeGeoMunicipalityQuery The current query, for fluid interface
     */
    public function lastUpdatedFirst()
    {
        return $this->addDescendingOrderByColumn(InseeGeoMunicipalityTableMap::UPDATED_AT);
    }

    /**
     * Order by update date asc
     *
     * @return     ChildInseeGeoMunicipalityQuery The current query, for fluid interface
     */
    public function firstUpdatedFirst()
    {
        return $this->addAscendingOrderByColumn(InseeGeoMunicipalityTableMap::UPDATED_AT);
    }

    /**
     * Order by create date desc
     *
     * @return     ChildInseeGeoMunicipalityQuery The current query, for fluid interface
     */
    public function lastCreatedFirst()
    {
        return $this->addDescendingOrderByColumn(InseeGeoMunicipalityTableMap::CREATED_AT);
    }

    /**
     * Order by create date asc
     *
     * @return     ChildInseeGeoMunicipalityQuery The current query, for fluid interface
     */
    public function firstCreatedFirst()
    {
        return $this->addAscendingOrderByColumn(InseeGeoMunicipalityTableMap::CREATED_AT);
    }

    // i18n behavior

    /**
     * Adds a JOIN clause to the query using the i18n relation
     *
     * @param     string $locale Locale to use for the join condition, e.g. 'fr_FR'
     * @param     string $relationAlias optional alias for the relation
     * @param     string $joinType Accepted values are null, 'left join', 'right join', 'inner join'. Defaults to left join.
     *
     * @return    ChildInseeGeoMunicipalityQuery The current query, for fluid interface
     */
    public function joinI18n($locale = 'en_US', $relationAlias = null, $joinType = Criteria::LEFT_JOIN)
    {
        $relationName = $relationAlias ? $relationAlias : 'InseeGeoMunicipalityI18n';

        return $this
            ->joinInseeGeoMunicipalityI18n($relationAlias, $joinType)
            ->addJoinCondition($relationName, $relationName . '.Locale = ?', $locale);
    }

    /**
     * Adds a JOIN clause to the query and hydrates the related I18n object.
     * Shortcut for $c->joinI18n($locale)->with()
     *
     * @param     string $locale Locale to use for the join condition, e.g. 'fr_FR'
     * @param     string $joinType Accepted values are null, 'left join', 'right join', 'inner join'. Defaults to left join.
     *
     * @return    ChildInseeGeoMunicipalityQuery The current query, for fluid interface
     */
    public function joinWithI18n($locale = 'en_US', $joinType = Criteria::LEFT_JOIN)
    {
        $this
            ->joinI18n($locale, null, $joinType)
            ->with('InseeGeoMunicipalityI18n');
        $this->with['InseeGeoMunicipalityI18n']->setIsWithOneToMany(false);

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
     * @return    ChildInseeGeoMunicipalityI18nQuery A secondary query class using the current class as primary query
     */
    public function useI18nQuery($locale = 'en_US', $relationAlias = null, $joinType = Criteria::LEFT_JOIN)
    {
        return $this
            ->joinI18n($locale, $relationAlias, $joinType)
            ->useQuery($relationAlias ? $relationAlias : 'InseeGeoMunicipalityI18n', '\INSEEGeo\Model\InseeGeoMunicipalityI18nQuery');
    }

} // InseeGeoMunicipalityQuery
