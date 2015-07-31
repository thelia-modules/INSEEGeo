<?php

namespace INSEEGeo\Model\Map;

use INSEEGeo\Model\InseeGeoMunicipality;
use INSEEGeo\Model\InseeGeoMunicipalityQuery;
use Propel\Runtime\Propel;
use Propel\Runtime\ActiveQuery\Criteria;
use Propel\Runtime\ActiveQuery\InstancePoolTrait;
use Propel\Runtime\Connection\ConnectionInterface;
use Propel\Runtime\DataFetcher\DataFetcherInterface;
use Propel\Runtime\Exception\PropelException;
use Propel\Runtime\Map\RelationMap;
use Propel\Runtime\Map\TableMap;
use Propel\Runtime\Map\TableMapTrait;


/**
 * This class defines the structure of the 'insee_geo_municipality' table.
 *
 *
 *
 * This map class is used by Propel to do runtime db structure discovery.
 * For example, the createSelectSql() method checks the type of a given column used in an
 * ORDER BY clause to know whether it needs to apply SQL to make the ORDER BY case-insensitive
 * (i.e. if it's a text column type).
 *
 */
class InseeGeoMunicipalityTableMap extends TableMap
{
    use InstancePoolTrait;
    use TableMapTrait;
    /**
     * The (dot-path) name of this class
     */
    const CLASS_NAME = 'INSEEGeo.Model.Map.InseeGeoMunicipalityTableMap';

    /**
     * The default database name for this class
     */
    const DATABASE_NAME = 'thelia';

    /**
     * The table name for this class
     */
    const TABLE_NAME = 'insee_geo_municipality';

    /**
     * The related Propel class for this table
     */
    const OM_CLASS = '\\INSEEGeo\\Model\\InseeGeoMunicipality';

    /**
     * A class that can be returned by this tableMap
     */
    const CLASS_DEFAULT = 'INSEEGeo.Model.InseeGeoMunicipality';

    /**
     * The total number of columns
     */
    const NUM_COLUMNS = 11;

    /**
     * The number of lazy-loaded columns
     */
    const NUM_LAZY_LOAD_COLUMNS = 0;

    /**
     * The number of columns to hydrate (NUM_COLUMNS - NUM_LAZY_LOAD_COLUMNS)
     */
    const NUM_HYDRATE_COLUMNS = 11;

    /**
     * the column name for the ID field
     */
    const ID = 'insee_geo_municipality.ID';

    /**
     * the column name for the ZIP_CODE field
     */
    const ZIP_CODE = 'insee_geo_municipality.ZIP_CODE';

    /**
     * the column name for the GEO_POINT2D_X field
     */
    const GEO_POINT2D_X = 'insee_geo_municipality.GEO_POINT2D_X';

    /**
     * the column name for the GEO_POINT2D_Y field
     */
    const GEO_POINT2D_Y = 'insee_geo_municipality.GEO_POINT2D_Y';

    /**
     * the column name for the GEO_SHAPE field
     */
    const GEO_SHAPE = 'insee_geo_municipality.GEO_SHAPE';

    /**
     * the column name for the MUNICIPALITY_CODE field
     */
    const MUNICIPALITY_CODE = 'insee_geo_municipality.MUNICIPALITY_CODE';

    /**
     * the column name for the DISTRICT_CODE field
     */
    const DISTRICT_CODE = 'insee_geo_municipality.DISTRICT_CODE';

    /**
     * the column name for the DEPARTMENT_ID field
     */
    const DEPARTMENT_ID = 'insee_geo_municipality.DEPARTMENT_ID';

    /**
     * the column name for the REGION_ID field
     */
    const REGION_ID = 'insee_geo_municipality.REGION_ID';

    /**
     * the column name for the CREATED_AT field
     */
    const CREATED_AT = 'insee_geo_municipality.CREATED_AT';

    /**
     * the column name for the UPDATED_AT field
     */
    const UPDATED_AT = 'insee_geo_municipality.UPDATED_AT';

    /**
     * The default string format for model objects of the related table
     */
    const DEFAULT_STRING_FORMAT = 'YAML';

    // i18n behavior

    /**
     * The default locale to use for translations.
     *
     * @var string
     */
    const DEFAULT_LOCALE = 'en_US';

    /**
     * holds an array of fieldnames
     *
     * first dimension keys are the type constants
     * e.g. self::$fieldNames[self::TYPE_PHPNAME][0] = 'Id'
     */
    protected static $fieldNames = array (
        self::TYPE_PHPNAME       => array('Id', 'ZipCode', 'GeoPoint2dX', 'GeoPoint2dY', 'GeoShape', 'MunicipalityCode', 'DistrictCode', 'DepartmentId', 'RegionId', 'CreatedAt', 'UpdatedAt', ),
        self::TYPE_STUDLYPHPNAME => array('id', 'zipCode', 'geoPoint2dX', 'geoPoint2dY', 'geoShape', 'municipalityCode', 'districtCode', 'departmentId', 'regionId', 'createdAt', 'updatedAt', ),
        self::TYPE_COLNAME       => array(InseeGeoMunicipalityTableMap::ID, InseeGeoMunicipalityTableMap::ZIP_CODE, InseeGeoMunicipalityTableMap::GEO_POINT2D_X, InseeGeoMunicipalityTableMap::GEO_POINT2D_Y, InseeGeoMunicipalityTableMap::GEO_SHAPE, InseeGeoMunicipalityTableMap::MUNICIPALITY_CODE, InseeGeoMunicipalityTableMap::DISTRICT_CODE, InseeGeoMunicipalityTableMap::DEPARTMENT_ID, InseeGeoMunicipalityTableMap::REGION_ID, InseeGeoMunicipalityTableMap::CREATED_AT, InseeGeoMunicipalityTableMap::UPDATED_AT, ),
        self::TYPE_RAW_COLNAME   => array('ID', 'ZIP_CODE', 'GEO_POINT2D_X', 'GEO_POINT2D_Y', 'GEO_SHAPE', 'MUNICIPALITY_CODE', 'DISTRICT_CODE', 'DEPARTMENT_ID', 'REGION_ID', 'CREATED_AT', 'UPDATED_AT', ),
        self::TYPE_FIELDNAME     => array('id', 'zip_code', 'geo_point2d_x', 'geo_point2d_y', 'geo_shape', 'municipality_code', 'district_code', 'department_id', 'region_id', 'created_at', 'updated_at', ),
        self::TYPE_NUM           => array(0, 1, 2, 3, 4, 5, 6, 7, 8, 9, 10, )
    );

    /**
     * holds an array of keys for quick access to the fieldnames array
     *
     * first dimension keys are the type constants
     * e.g. self::$fieldKeys[self::TYPE_PHPNAME]['Id'] = 0
     */
    protected static $fieldKeys = array (
        self::TYPE_PHPNAME       => array('Id' => 0, 'ZipCode' => 1, 'GeoPoint2dX' => 2, 'GeoPoint2dY' => 3, 'GeoShape' => 4, 'MunicipalityCode' => 5, 'DistrictCode' => 6, 'DepartmentId' => 7, 'RegionId' => 8, 'CreatedAt' => 9, 'UpdatedAt' => 10, ),
        self::TYPE_STUDLYPHPNAME => array('id' => 0, 'zipCode' => 1, 'geoPoint2dX' => 2, 'geoPoint2dY' => 3, 'geoShape' => 4, 'municipalityCode' => 5, 'districtCode' => 6, 'departmentId' => 7, 'regionId' => 8, 'createdAt' => 9, 'updatedAt' => 10, ),
        self::TYPE_COLNAME       => array(InseeGeoMunicipalityTableMap::ID => 0, InseeGeoMunicipalityTableMap::ZIP_CODE => 1, InseeGeoMunicipalityTableMap::GEO_POINT2D_X => 2, InseeGeoMunicipalityTableMap::GEO_POINT2D_Y => 3, InseeGeoMunicipalityTableMap::GEO_SHAPE => 4, InseeGeoMunicipalityTableMap::MUNICIPALITY_CODE => 5, InseeGeoMunicipalityTableMap::DISTRICT_CODE => 6, InseeGeoMunicipalityTableMap::DEPARTMENT_ID => 7, InseeGeoMunicipalityTableMap::REGION_ID => 8, InseeGeoMunicipalityTableMap::CREATED_AT => 9, InseeGeoMunicipalityTableMap::UPDATED_AT => 10, ),
        self::TYPE_RAW_COLNAME   => array('ID' => 0, 'ZIP_CODE' => 1, 'GEO_POINT2D_X' => 2, 'GEO_POINT2D_Y' => 3, 'GEO_SHAPE' => 4, 'MUNICIPALITY_CODE' => 5, 'DISTRICT_CODE' => 6, 'DEPARTMENT_ID' => 7, 'REGION_ID' => 8, 'CREATED_AT' => 9, 'UPDATED_AT' => 10, ),
        self::TYPE_FIELDNAME     => array('id' => 0, 'zip_code' => 1, 'geo_point2d_x' => 2, 'geo_point2d_y' => 3, 'geo_shape' => 4, 'municipality_code' => 5, 'district_code' => 6, 'department_id' => 7, 'region_id' => 8, 'created_at' => 9, 'updated_at' => 10, ),
        self::TYPE_NUM           => array(0, 1, 2, 3, 4, 5, 6, 7, 8, 9, 10, )
    );

    /**
     * Initialize the table attributes and columns
     * Relations are not initialized by this method since they are lazy loaded
     *
     * @return void
     * @throws PropelException
     */
    public function initialize()
    {
        // attributes
        $this->setName('insee_geo_municipality');
        $this->setPhpName('InseeGeoMunicipality');
        $this->setClassName('\\INSEEGeo\\Model\\InseeGeoMunicipality');
        $this->setPackage('INSEEGeo.Model');
        $this->setUseIdGenerator(false);
        // columns
        $this->addPrimaryKey('ID', 'Id', 'VARCHAR', true, 5, null);
        $this->addColumn('ZIP_CODE', 'ZipCode', 'VARCHAR', false, 5, null);
        $this->addColumn('GEO_POINT2D_X', 'GeoPoint2dX', 'DOUBLE', false, null, null);
        $this->addColumn('GEO_POINT2D_Y', 'GeoPoint2dY', 'DOUBLE', false, null, null);
        $this->addColumn('GEO_SHAPE', 'GeoShape', 'LONGVARCHAR', false, null, null);
        $this->addColumn('MUNICIPALITY_CODE', 'MunicipalityCode', 'INTEGER', false, null, null);
        $this->addColumn('DISTRICT_CODE', 'DistrictCode', 'INTEGER', false, null, null);
        $this->addForeignKey('DEPARTMENT_ID', 'DepartmentId', 'VARCHAR', 'insee_geo_department', 'ID', false, 2, null);
        $this->addForeignKey('REGION_ID', 'RegionId', 'INTEGER', 'insee_geo_region', 'ID', false, null, null);
        $this->addColumn('CREATED_AT', 'CreatedAt', 'TIMESTAMP', false, null, null);
        $this->addColumn('UPDATED_AT', 'UpdatedAt', 'TIMESTAMP', false, null, null);
    } // initialize()

    /**
     * Build the RelationMap objects for this table relationships
     */
    public function buildRelations()
    {
        $this->addRelation('InseeGeoDepartment', '\\INSEEGeo\\Model\\InseeGeoDepartment', RelationMap::MANY_TO_ONE, array('department_id' => 'id', ), 'CASCADE', 'RESTRICT');
        $this->addRelation('InseeGeoRegion', '\\INSEEGeo\\Model\\InseeGeoRegion', RelationMap::MANY_TO_ONE, array('region_id' => 'id', ), 'CASCADE', 'RESTRICT');
        $this->addRelation('InseeGeoMunicipalityI18n', '\\INSEEGeo\\Model\\InseeGeoMunicipalityI18n', RelationMap::ONE_TO_MANY, array('id' => 'id', ), 'CASCADE', null, 'InseeGeoMunicipalityI18ns');
    } // buildRelations()

    /**
     *
     * Gets the list of behaviors registered for this table
     *
     * @return array Associative array (name => parameters) of behaviors
     */
    public function getBehaviors()
    {
        return array(
            'timestampable' => array('create_column' => 'created_at', 'update_column' => 'updated_at', ),
            'i18n' => array('i18n_table' => '%TABLE%_i18n', 'i18n_phpname' => '%PHPNAME%I18n', 'i18n_columns' => 'name', 'locale_column' => 'locale', 'locale_length' => '5', 'default_locale' => '', 'locale_alias' => '', ),
        );
    } // getBehaviors()
    /**
     * Method to invalidate the instance pool of all tables related to insee_geo_municipality     * by a foreign key with ON DELETE CASCADE
     */
    public static function clearRelatedInstancePool()
    {
        // Invalidate objects in ".$this->getClassNameFromBuilder($joinedTableTableMapBuilder)." instance pool,
        // since one or more of them may be deleted by ON DELETE CASCADE/SETNULL rule.
                InseeGeoMunicipalityI18nTableMap::clearInstancePool();
            }

    /**
     * Retrieves a string version of the primary key from the DB resultset row that can be used to uniquely identify a row in this table.
     *
     * For tables with a single-column primary key, that simple pkey value will be returned.  For tables with
     * a multi-column primary key, a serialize()d version of the primary key will be returned.
     *
     * @param array  $row       resultset row.
     * @param int    $offset    The 0-based offset for reading from the resultset row.
     * @param string $indexType One of the class type constants TableMap::TYPE_PHPNAME, TableMap::TYPE_STUDLYPHPNAME
     *                           TableMap::TYPE_COLNAME, TableMap::TYPE_FIELDNAME, TableMap::TYPE_NUM
     */
    public static function getPrimaryKeyHashFromRow($row, $offset = 0, $indexType = TableMap::TYPE_NUM)
    {
        // If the PK cannot be derived from the row, return NULL.
        if ($row[TableMap::TYPE_NUM == $indexType ? 0 + $offset : static::translateFieldName('Id', TableMap::TYPE_PHPNAME, $indexType)] === null) {
            return null;
        }

        return (string) $row[TableMap::TYPE_NUM == $indexType ? 0 + $offset : static::translateFieldName('Id', TableMap::TYPE_PHPNAME, $indexType)];
    }

    /**
     * Retrieves the primary key from the DB resultset row
     * For tables with a single-column primary key, that simple pkey value will be returned.  For tables with
     * a multi-column primary key, an array of the primary key columns will be returned.
     *
     * @param array  $row       resultset row.
     * @param int    $offset    The 0-based offset for reading from the resultset row.
     * @param string $indexType One of the class type constants TableMap::TYPE_PHPNAME, TableMap::TYPE_STUDLYPHPNAME
     *                           TableMap::TYPE_COLNAME, TableMap::TYPE_FIELDNAME, TableMap::TYPE_NUM
     *
     * @return mixed The primary key of the row
     */
    public static function getPrimaryKeyFromRow($row, $offset = 0, $indexType = TableMap::TYPE_NUM)
    {

            return (string) $row[
                            $indexType == TableMap::TYPE_NUM
                            ? 0 + $offset
                            : self::translateFieldName('Id', TableMap::TYPE_PHPNAME, $indexType)
                        ];
    }

    /**
     * The class that the tableMap will make instances of.
     *
     * If $withPrefix is true, the returned path
     * uses a dot-path notation which is translated into a path
     * relative to a location on the PHP include_path.
     * (e.g. path.to.MyClass -> 'path/to/MyClass.php')
     *
     * @param boolean $withPrefix Whether or not to return the path with the class name
     * @return string path.to.ClassName
     */
    public static function getOMClass($withPrefix = true)
    {
        return $withPrefix ? InseeGeoMunicipalityTableMap::CLASS_DEFAULT : InseeGeoMunicipalityTableMap::OM_CLASS;
    }

    /**
     * Populates an object of the default type or an object that inherit from the default.
     *
     * @param array  $row       row returned by DataFetcher->fetch().
     * @param int    $offset    The 0-based offset for reading from the resultset row.
     * @param string $indexType The index type of $row. Mostly DataFetcher->getIndexType().
                                 One of the class type constants TableMap::TYPE_PHPNAME, TableMap::TYPE_STUDLYPHPNAME
     *                           TableMap::TYPE_COLNAME, TableMap::TYPE_FIELDNAME, TableMap::TYPE_NUM.
     *
     * @throws PropelException Any exceptions caught during processing will be
     *         rethrown wrapped into a PropelException.
     * @return array (InseeGeoMunicipality object, last column rank)
     */
    public static function populateObject($row, $offset = 0, $indexType = TableMap::TYPE_NUM)
    {
        $key = InseeGeoMunicipalityTableMap::getPrimaryKeyHashFromRow($row, $offset, $indexType);
        if (null !== ($obj = InseeGeoMunicipalityTableMap::getInstanceFromPool($key))) {
            // We no longer rehydrate the object, since this can cause data loss.
            // See http://www.propelorm.org/ticket/509
            // $obj->hydrate($row, $offset, true); // rehydrate
            $col = $offset + InseeGeoMunicipalityTableMap::NUM_HYDRATE_COLUMNS;
        } else {
            $cls = InseeGeoMunicipalityTableMap::OM_CLASS;
            $obj = new $cls();
            $col = $obj->hydrate($row, $offset, false, $indexType);
            InseeGeoMunicipalityTableMap::addInstanceToPool($obj, $key);
        }

        return array($obj, $col);
    }

    /**
     * The returned array will contain objects of the default type or
     * objects that inherit from the default.
     *
     * @param DataFetcherInterface $dataFetcher
     * @return array
     * @throws PropelException Any exceptions caught during processing will be
     *         rethrown wrapped into a PropelException.
     */
    public static function populateObjects(DataFetcherInterface $dataFetcher)
    {
        $results = array();

        // set the class once to avoid overhead in the loop
        $cls = static::getOMClass(false);
        // populate the object(s)
        while ($row = $dataFetcher->fetch()) {
            $key = InseeGeoMunicipalityTableMap::getPrimaryKeyHashFromRow($row, 0, $dataFetcher->getIndexType());
            if (null !== ($obj = InseeGeoMunicipalityTableMap::getInstanceFromPool($key))) {
                // We no longer rehydrate the object, since this can cause data loss.
                // See http://www.propelorm.org/ticket/509
                // $obj->hydrate($row, 0, true); // rehydrate
                $results[] = $obj;
            } else {
                $obj = new $cls();
                $obj->hydrate($row);
                $results[] = $obj;
                InseeGeoMunicipalityTableMap::addInstanceToPool($obj, $key);
            } // if key exists
        }

        return $results;
    }
    /**
     * Add all the columns needed to create a new object.
     *
     * Note: any columns that were marked with lazyLoad="true" in the
     * XML schema will not be added to the select list and only loaded
     * on demand.
     *
     * @param Criteria $criteria object containing the columns to add.
     * @param string   $alias    optional table alias
     * @throws PropelException Any exceptions caught during processing will be
     *         rethrown wrapped into a PropelException.
     */
    public static function addSelectColumns(Criteria $criteria, $alias = null)
    {
        if (null === $alias) {
            $criteria->addSelectColumn(InseeGeoMunicipalityTableMap::ID);
            $criteria->addSelectColumn(InseeGeoMunicipalityTableMap::ZIP_CODE);
            $criteria->addSelectColumn(InseeGeoMunicipalityTableMap::GEO_POINT2D_X);
            $criteria->addSelectColumn(InseeGeoMunicipalityTableMap::GEO_POINT2D_Y);
            $criteria->addSelectColumn(InseeGeoMunicipalityTableMap::GEO_SHAPE);
            $criteria->addSelectColumn(InseeGeoMunicipalityTableMap::MUNICIPALITY_CODE);
            $criteria->addSelectColumn(InseeGeoMunicipalityTableMap::DISTRICT_CODE);
            $criteria->addSelectColumn(InseeGeoMunicipalityTableMap::DEPARTMENT_ID);
            $criteria->addSelectColumn(InseeGeoMunicipalityTableMap::REGION_ID);
            $criteria->addSelectColumn(InseeGeoMunicipalityTableMap::CREATED_AT);
            $criteria->addSelectColumn(InseeGeoMunicipalityTableMap::UPDATED_AT);
        } else {
            $criteria->addSelectColumn($alias . '.ID');
            $criteria->addSelectColumn($alias . '.ZIP_CODE');
            $criteria->addSelectColumn($alias . '.GEO_POINT2D_X');
            $criteria->addSelectColumn($alias . '.GEO_POINT2D_Y');
            $criteria->addSelectColumn($alias . '.GEO_SHAPE');
            $criteria->addSelectColumn($alias . '.MUNICIPALITY_CODE');
            $criteria->addSelectColumn($alias . '.DISTRICT_CODE');
            $criteria->addSelectColumn($alias . '.DEPARTMENT_ID');
            $criteria->addSelectColumn($alias . '.REGION_ID');
            $criteria->addSelectColumn($alias . '.CREATED_AT');
            $criteria->addSelectColumn($alias . '.UPDATED_AT');
        }
    }

    /**
     * Returns the TableMap related to this object.
     * This method is not needed for general use but a specific application could have a need.
     * @return TableMap
     * @throws PropelException Any exceptions caught during processing will be
     *         rethrown wrapped into a PropelException.
     */
    public static function getTableMap()
    {
        return Propel::getServiceContainer()->getDatabaseMap(InseeGeoMunicipalityTableMap::DATABASE_NAME)->getTable(InseeGeoMunicipalityTableMap::TABLE_NAME);
    }

    /**
     * Add a TableMap instance to the database for this tableMap class.
     */
    public static function buildTableMap()
    {
      $dbMap = Propel::getServiceContainer()->getDatabaseMap(InseeGeoMunicipalityTableMap::DATABASE_NAME);
      if (!$dbMap->hasTable(InseeGeoMunicipalityTableMap::TABLE_NAME)) {
        $dbMap->addTableObject(new InseeGeoMunicipalityTableMap());
      }
    }

    /**
     * Performs a DELETE on the database, given a InseeGeoMunicipality or Criteria object OR a primary key value.
     *
     * @param mixed               $values Criteria or InseeGeoMunicipality object or primary key or array of primary keys
     *              which is used to create the DELETE statement
     * @param ConnectionInterface $con the connection to use
     * @return int The number of affected rows (if supported by underlying database driver).  This includes CASCADE-related rows
     *                if supported by native driver or if emulated using Propel.
     * @throws PropelException Any exceptions caught during processing will be
     *         rethrown wrapped into a PropelException.
     */
     public static function doDelete($values, ConnectionInterface $con = null)
     {
        if (null === $con) {
            $con = Propel::getServiceContainer()->getWriteConnection(InseeGeoMunicipalityTableMap::DATABASE_NAME);
        }

        if ($values instanceof Criteria) {
            // rename for clarity
            $criteria = $values;
        } elseif ($values instanceof \INSEEGeo\Model\InseeGeoMunicipality) { // it's a model object
            // create criteria based on pk values
            $criteria = $values->buildPkeyCriteria();
        } else { // it's a primary key, or an array of pks
            $criteria = new Criteria(InseeGeoMunicipalityTableMap::DATABASE_NAME);
            $criteria->add(InseeGeoMunicipalityTableMap::ID, (array) $values, Criteria::IN);
        }

        $query = InseeGeoMunicipalityQuery::create()->mergeWith($criteria);

        if ($values instanceof Criteria) { InseeGeoMunicipalityTableMap::clearInstancePool();
        } elseif (!is_object($values)) { // it's a primary key, or an array of pks
            foreach ((array) $values as $singleval) { InseeGeoMunicipalityTableMap::removeInstanceFromPool($singleval);
            }
        }

        return $query->delete($con);
    }

    /**
     * Deletes all rows from the insee_geo_municipality table.
     *
     * @param ConnectionInterface $con the connection to use
     * @return int The number of affected rows (if supported by underlying database driver).
     */
    public static function doDeleteAll(ConnectionInterface $con = null)
    {
        return InseeGeoMunicipalityQuery::create()->doDeleteAll($con);
    }

    /**
     * Performs an INSERT on the database, given a InseeGeoMunicipality or Criteria object.
     *
     * @param mixed               $criteria Criteria or InseeGeoMunicipality object containing data that is used to create the INSERT statement.
     * @param ConnectionInterface $con the ConnectionInterface connection to use
     * @return mixed           The new primary key.
     * @throws PropelException Any exceptions caught during processing will be
     *         rethrown wrapped into a PropelException.
     */
    public static function doInsert($criteria, ConnectionInterface $con = null)
    {
        if (null === $con) {
            $con = Propel::getServiceContainer()->getWriteConnection(InseeGeoMunicipalityTableMap::DATABASE_NAME);
        }

        if ($criteria instanceof Criteria) {
            $criteria = clone $criteria; // rename for clarity
        } else {
            $criteria = $criteria->buildCriteria(); // build Criteria from InseeGeoMunicipality object
        }


        // Set the correct dbName
        $query = InseeGeoMunicipalityQuery::create()->mergeWith($criteria);

        try {
            // use transaction because $criteria could contain info
            // for more than one table (I guess, conceivably)
            $con->beginTransaction();
            $pk = $query->doInsert($con);
            $con->commit();
        } catch (PropelException $e) {
            $con->rollBack();
            throw $e;
        }

        return $pk;
    }

} // InseeGeoMunicipalityTableMap
// This is the static code needed to register the TableMap for this table with the main Propel class.
//
InseeGeoMunicipalityTableMap::buildTableMap();
