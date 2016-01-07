<?php

namespace INSEEGeo\Model\Base;

use \DateTime;
use \Exception;
use \PDO;
use INSEEGeo\Model\InseeGeoDepartment as ChildInseeGeoDepartment;
use INSEEGeo\Model\InseeGeoDepartmentQuery as ChildInseeGeoDepartmentQuery;
use INSEEGeo\Model\InseeGeoMunicipality as ChildInseeGeoMunicipality;
use INSEEGeo\Model\InseeGeoMunicipalityI18n as ChildInseeGeoMunicipalityI18n;
use INSEEGeo\Model\InseeGeoMunicipalityI18nQuery as ChildInseeGeoMunicipalityI18nQuery;
use INSEEGeo\Model\InseeGeoMunicipalityQuery as ChildInseeGeoMunicipalityQuery;
use INSEEGeo\Model\InseeGeoRegion as ChildInseeGeoRegion;
use INSEEGeo\Model\InseeGeoRegionQuery as ChildInseeGeoRegionQuery;
use INSEEGeo\Model\Map\InseeGeoMunicipalityTableMap;
use Propel\Runtime\Propel;
use Propel\Runtime\ActiveQuery\Criteria;
use Propel\Runtime\ActiveQuery\ModelCriteria;
use Propel\Runtime\ActiveRecord\ActiveRecordInterface;
use Propel\Runtime\Collection\Collection;
use Propel\Runtime\Collection\ObjectCollection;
use Propel\Runtime\Connection\ConnectionInterface;
use Propel\Runtime\Exception\BadMethodCallException;
use Propel\Runtime\Exception\PropelException;
use Propel\Runtime\Map\TableMap;
use Propel\Runtime\Parser\AbstractParser;
use Propel\Runtime\Util\PropelDateTime;

abstract class InseeGeoMunicipality implements ActiveRecordInterface
{
    /**
     * TableMap class name
     */
    const TABLE_MAP = '\\INSEEGeo\\Model\\Map\\InseeGeoMunicipalityTableMap';


    /**
     * attribute to determine if this object has previously been saved.
     * @var boolean
     */
    protected $new = true;

    /**
     * attribute to determine whether this object has been deleted.
     * @var boolean
     */
    protected $deleted = false;

    /**
     * The columns that have been modified in current object.
     * Tracking modified columns allows us to only update modified columns.
     * @var array
     */
    protected $modifiedColumns = array();

    /**
     * The (virtual) columns that are added at runtime
     * The formatters can add supplementary columns based on a resultset
     * @var array
     */
    protected $virtualColumns = array();

    /**
     * The value for the id field.
     * @var        string
     */
    protected $id;

    /**
     * The value for the zip_code field.
     * @var        string
     */
    protected $zip_code;

    /**
     * The value for the geo_point2d_x field.
     * @var        double
     */
    protected $geo_point2d_x;

    /**
     * The value for the geo_point2d_y field.
     * @var        double
     */
    protected $geo_point2d_y;

    /**
     * The value for the geo_shape field.
     * @var        string
     */
    protected $geo_shape;

    /**
     * The value for the municipality_code field.
     * @var        int
     */
    protected $municipality_code;

    /**
     * The value for the district_code field.
     * @var        int
     */
    protected $district_code;

    /**
     * The value for the department_id field.
     * @var        int
     */
    protected $department_id;

    /**
     * The value for the region_id field.
     * @var        int
     */
    protected $region_id;

    /**
     * The value for the created_at field.
     * @var        string
     */
    protected $created_at;

    /**
     * The value for the updated_at field.
     * @var        string
     */
    protected $updated_at;

    /**
     * @var        InseeGeoDepartment
     */
    protected $aInseeGeoDepartment;

    /**
     * @var        InseeGeoRegion
     */
    protected $aInseeGeoRegion;

    /**
     * @var        ObjectCollection|ChildInseeGeoMunicipalityI18n[] Collection to store aggregation of ChildInseeGeoMunicipalityI18n objects.
     */
    protected $collInseeGeoMunicipalityI18ns;
    protected $collInseeGeoMunicipalityI18nsPartial;

    /**
     * Flag to prevent endless save loop, if this object is referenced
     * by another object which falls in this transaction.
     *
     * @var boolean
     */
    protected $alreadyInSave = false;

    // i18n behavior

    /**
     * Current locale
     * @var        string
     */
    protected $currentLocale = 'en_US';

    /**
     * Current translation objects
     * @var        array[ChildInseeGeoMunicipalityI18n]
     */
    protected $currentTranslations;

    /**
     * An array of objects scheduled for deletion.
     * @var ObjectCollection
     */
    protected $inseeGeoMunicipalityI18nsScheduledForDeletion = null;

    /**
     * Initializes internal state of INSEEGeo\Model\Base\InseeGeoMunicipality object.
     */
    public function __construct()
    {
    }

    /**
     * Returns whether the object has been modified.
     *
     * @return boolean True if the object has been modified.
     */
    public function isModified()
    {
        return !!$this->modifiedColumns;
    }

    /**
     * Has specified column been modified?
     *
     * @param  string  $col column fully qualified name (TableMap::TYPE_COLNAME), e.g. Book::AUTHOR_ID
     * @return boolean True if $col has been modified.
     */
    public function isColumnModified($col)
    {
        return $this->modifiedColumns && isset($this->modifiedColumns[$col]);
    }

    /**
     * Get the columns that have been modified in this object.
     * @return array A unique list of the modified column names for this object.
     */
    public function getModifiedColumns()
    {
        return $this->modifiedColumns ? array_keys($this->modifiedColumns) : [];
    }

    /**
     * Returns whether the object has ever been saved.  This will
     * be false, if the object was retrieved from storage or was created
     * and then saved.
     *
     * @return boolean true, if the object has never been persisted.
     */
    public function isNew()
    {
        return $this->new;
    }

    /**
     * Setter for the isNew attribute.  This method will be called
     * by Propel-generated children and objects.
     *
     * @param boolean $b the state of the object.
     */
    public function setNew($b)
    {
        $this->new = (Boolean) $b;
    }

    /**
     * Whether this object has been deleted.
     * @return boolean The deleted state of this object.
     */
    public function isDeleted()
    {
        return $this->deleted;
    }

    /**
     * Specify whether this object has been deleted.
     * @param  boolean $b The deleted state of this object.
     * @return void
     */
    public function setDeleted($b)
    {
        $this->deleted = (Boolean) $b;
    }

    /**
     * Sets the modified state for the object to be false.
     * @param  string $col If supplied, only the specified column is reset.
     * @return void
     */
    public function resetModified($col = null)
    {
        if (null !== $col) {
            if (isset($this->modifiedColumns[$col])) {
                unset($this->modifiedColumns[$col]);
            }
        } else {
            $this->modifiedColumns = array();
        }
    }

    /**
     * Compares this with another <code>InseeGeoMunicipality</code> instance.  If
     * <code>obj</code> is an instance of <code>InseeGeoMunicipality</code>, delegates to
     * <code>equals(InseeGeoMunicipality)</code>.  Otherwise, returns <code>false</code>.
     *
     * @param  mixed   $obj The object to compare to.
     * @return boolean Whether equal to the object specified.
     */
    public function equals($obj)
    {
        $thisclazz = get_class($this);
        if (!is_object($obj) || !($obj instanceof $thisclazz)) {
            return false;
        }

        if ($this === $obj) {
            return true;
        }

        if (null === $this->getPrimaryKey()
            || null === $obj->getPrimaryKey())  {
            return false;
        }

        return $this->getPrimaryKey() === $obj->getPrimaryKey();
    }

    /**
     * If the primary key is not null, return the hashcode of the
     * primary key. Otherwise, return the hash code of the object.
     *
     * @return int Hashcode
     */
    public function hashCode()
    {
        if (null !== $this->getPrimaryKey()) {
            return crc32(serialize($this->getPrimaryKey()));
        }

        return crc32(serialize(clone $this));
    }

    /**
     * Get the associative array of the virtual columns in this object
     *
     * @return array
     */
    public function getVirtualColumns()
    {
        return $this->virtualColumns;
    }

    /**
     * Checks the existence of a virtual column in this object
     *
     * @param  string  $name The virtual column name
     * @return boolean
     */
    public function hasVirtualColumn($name)
    {
        return array_key_exists($name, $this->virtualColumns);
    }

    /**
     * Get the value of a virtual column in this object
     *
     * @param  string $name The virtual column name
     * @return mixed
     *
     * @throws PropelException
     */
    public function getVirtualColumn($name)
    {
        if (!$this->hasVirtualColumn($name)) {
            throw new PropelException(sprintf('Cannot get value of inexistent virtual column %s.', $name));
        }

        return $this->virtualColumns[$name];
    }

    /**
     * Set the value of a virtual column in this object
     *
     * @param string $name  The virtual column name
     * @param mixed  $value The value to give to the virtual column
     *
     * @return InseeGeoMunicipality The current object, for fluid interface
     */
    public function setVirtualColumn($name, $value)
    {
        $this->virtualColumns[$name] = $value;

        return $this;
    }

    /**
     * Logs a message using Propel::log().
     *
     * @param  string  $msg
     * @param  int     $priority One of the Propel::LOG_* logging levels
     * @return boolean
     */
    protected function log($msg, $priority = Propel::LOG_INFO)
    {
        return Propel::log(get_class($this) . ': ' . $msg, $priority);
    }

    /**
     * Populate the current object from a string, using a given parser format
     * <code>
     * $book = new Book();
     * $book->importFrom('JSON', '{"Id":9012,"Title":"Don Juan","ISBN":"0140422161","Price":12.99,"PublisherId":1234,"AuthorId":5678}');
     * </code>
     *
     * @param mixed $parser A AbstractParser instance,
     *                       or a format name ('XML', 'YAML', 'JSON', 'CSV')
     * @param string $data The source data to import from
     *
     * @return InseeGeoMunicipality The current object, for fluid interface
     */
    public function importFrom($parser, $data)
    {
        if (!$parser instanceof AbstractParser) {
            $parser = AbstractParser::getParser($parser);
        }

        $this->fromArray($parser->toArray($data), TableMap::TYPE_PHPNAME);

        return $this;
    }

    /**
     * Export the current object properties to a string, using a given parser format
     * <code>
     * $book = BookQuery::create()->findPk(9012);
     * echo $book->exportTo('JSON');
     *  => {"Id":9012,"Title":"Don Juan","ISBN":"0140422161","Price":12.99,"PublisherId":1234,"AuthorId":5678}');
     * </code>
     *
     * @param  mixed   $parser                 A AbstractParser instance, or a format name ('XML', 'YAML', 'JSON', 'CSV')
     * @param  boolean $includeLazyLoadColumns (optional) Whether to include lazy load(ed) columns. Defaults to TRUE.
     * @return string  The exported data
     */
    public function exportTo($parser, $includeLazyLoadColumns = true)
    {
        if (!$parser instanceof AbstractParser) {
            $parser = AbstractParser::getParser($parser);
        }

        return $parser->fromArray($this->toArray(TableMap::TYPE_PHPNAME, $includeLazyLoadColumns, array(), true));
    }

    /**
     * Clean up internal collections prior to serializing
     * Avoids recursive loops that turn into segmentation faults when serializing
     */
    public function __sleep()
    {
        $this->clearAllReferences();

        return array_keys(get_object_vars($this));
    }

    /**
     * Get the [id] column value.
     *
     * @return   string
     */
    public function getId()
    {

        return $this->id;
    }

    /**
     * Get the [zip_code] column value.
     *
     * @return   string
     */
    public function getZipCode()
    {

        return $this->zip_code;
    }

    /**
     * Get the [geo_point2d_x] column value.
     *
     * @return   double
     */
    public function getGeoPoint2dX()
    {

        return $this->geo_point2d_x;
    }

    /**
     * Get the [geo_point2d_y] column value.
     *
     * @return   double
     */
    public function getGeoPoint2dY()
    {

        return $this->geo_point2d_y;
    }

    /**
     * Get the [geo_shape] column value.
     *
     * @return   string
     */
    public function getGeoShape()
    {

        return $this->geo_shape;
    }

    /**
     * Get the [municipality_code] column value.
     *
     * @return   int
     */
    public function getMunicipalityCode()
    {

        return $this->municipality_code;
    }

    /**
     * Get the [district_code] column value.
     *
     * @return   int
     */
    public function getDistrictCode()
    {

        return $this->district_code;
    }

    /**
     * Get the [department_id] column value.
     *
     * @return   int
     */
    public function getDepartmentId()
    {

        return $this->department_id;
    }

    /**
     * Get the [region_id] column value.
     *
     * @return   int
     */
    public function getRegionId()
    {

        return $this->region_id;
    }

    /**
     * Get the [optionally formatted] temporal [created_at] column value.
     *
     *
     * @param      string $format The date/time format string (either date()-style or strftime()-style).
     *                            If format is NULL, then the raw \DateTime object will be returned.
     *
     * @return mixed Formatted date/time value as string or \DateTime object (if format is NULL), NULL if column is NULL, and 0 if column value is 0000-00-00 00:00:00
     *
     * @throws PropelException - if unable to parse/validate the date/time value.
     */
    public function getCreatedAt($format = NULL)
    {
        if ($format === null) {
            return $this->created_at;
        } else {
            return $this->created_at instanceof \DateTime ? $this->created_at->format($format) : null;
        }
    }

    /**
     * Get the [optionally formatted] temporal [updated_at] column value.
     *
     *
     * @param      string $format The date/time format string (either date()-style or strftime()-style).
     *                            If format is NULL, then the raw \DateTime object will be returned.
     *
     * @return mixed Formatted date/time value as string or \DateTime object (if format is NULL), NULL if column is NULL, and 0 if column value is 0000-00-00 00:00:00
     *
     * @throws PropelException - if unable to parse/validate the date/time value.
     */
    public function getUpdatedAt($format = NULL)
    {
        if ($format === null) {
            return $this->updated_at;
        } else {
            return $this->updated_at instanceof \DateTime ? $this->updated_at->format($format) : null;
        }
    }

    /**
     * Set the value of [id] column.
     *
     * @param      string $v new value
     * @return   \INSEEGeo\Model\InseeGeoMunicipality The current object (for fluent API support)
     */
    public function setId($v)
    {
        if ($v !== null) {
            $v = (string) $v;
        }

        if ($this->id !== $v) {
            $this->id = $v;
            $this->modifiedColumns[InseeGeoMunicipalityTableMap::ID] = true;
        }


        return $this;
    } // setId()

    /**
     * Set the value of [zip_code] column.
     *
     * @param      string $v new value
     * @return   \INSEEGeo\Model\InseeGeoMunicipality The current object (for fluent API support)
     */
    public function setZipCode($v)
    {
        if ($v !== null) {
            $v = (string) $v;
        }

        if ($this->zip_code !== $v) {
            $this->zip_code = $v;
            $this->modifiedColumns[InseeGeoMunicipalityTableMap::ZIP_CODE] = true;
        }


        return $this;
    } // setZipCode()

    /**
     * Set the value of [geo_point2d_x] column.
     *
     * @param      double $v new value
     * @return   \INSEEGeo\Model\InseeGeoMunicipality The current object (for fluent API support)
     */
    public function setGeoPoint2dX($v)
    {
        if ($v !== null) {
            $v = (double) $v;
        }

        if ($this->geo_point2d_x !== $v) {
            $this->geo_point2d_x = $v;
            $this->modifiedColumns[InseeGeoMunicipalityTableMap::GEO_POINT2D_X] = true;
        }


        return $this;
    } // setGeoPoint2dX()

    /**
     * Set the value of [geo_point2d_y] column.
     *
     * @param      double $v new value
     * @return   \INSEEGeo\Model\InseeGeoMunicipality The current object (for fluent API support)
     */
    public function setGeoPoint2dY($v)
    {
        if ($v !== null) {
            $v = (double) $v;
        }

        if ($this->geo_point2d_y !== $v) {
            $this->geo_point2d_y = $v;
            $this->modifiedColumns[InseeGeoMunicipalityTableMap::GEO_POINT2D_Y] = true;
        }


        return $this;
    } // setGeoPoint2dY()

    /**
     * Set the value of [geo_shape] column.
     *
     * @param      string $v new value
     * @return   \INSEEGeo\Model\InseeGeoMunicipality The current object (for fluent API support)
     */
    public function setGeoShape($v)
    {
        if ($v !== null) {
            $v = (string) $v;
        }

        if ($this->geo_shape !== $v) {
            $this->geo_shape = $v;
            $this->modifiedColumns[InseeGeoMunicipalityTableMap::GEO_SHAPE] = true;
        }


        return $this;
    } // setGeoShape()

    /**
     * Set the value of [municipality_code] column.
     *
     * @param      int $v new value
     * @return   \INSEEGeo\Model\InseeGeoMunicipality The current object (for fluent API support)
     */
    public function setMunicipalityCode($v)
    {
        if ($v !== null) {
            $v = (int) $v;
        }

        if ($this->municipality_code !== $v) {
            $this->municipality_code = $v;
            $this->modifiedColumns[InseeGeoMunicipalityTableMap::MUNICIPALITY_CODE] = true;
        }


        return $this;
    } // setMunicipalityCode()

    /**
     * Set the value of [district_code] column.
     *
     * @param      int $v new value
     * @return   \INSEEGeo\Model\InseeGeoMunicipality The current object (for fluent API support)
     */
    public function setDistrictCode($v)
    {
        if ($v !== null) {
            $v = (int) $v;
        }

        if ($this->district_code !== $v) {
            $this->district_code = $v;
            $this->modifiedColumns[InseeGeoMunicipalityTableMap::DISTRICT_CODE] = true;
        }


        return $this;
    } // setDistrictCode()

    /**
     * Set the value of [department_id] column.
     *
     * @param      int $v new value
     * @return   \INSEEGeo\Model\InseeGeoMunicipality The current object (for fluent API support)
     */
    public function setDepartmentId($v)
    {
        if ($v !== null) {
            $v = (int) $v;
        }

        if ($this->department_id !== $v) {
            $this->department_id = $v;
            $this->modifiedColumns[InseeGeoMunicipalityTableMap::DEPARTMENT_ID] = true;
        }

        if ($this->aInseeGeoDepartment !== null && $this->aInseeGeoDepartment->getId() !== $v) {
            $this->aInseeGeoDepartment = null;
        }


        return $this;
    } // setDepartmentId()

    /**
     * Set the value of [region_id] column.
     *
     * @param      int $v new value
     * @return   \INSEEGeo\Model\InseeGeoMunicipality The current object (for fluent API support)
     */
    public function setRegionId($v)
    {
        if ($v !== null) {
            $v = (int) $v;
        }

        if ($this->region_id !== $v) {
            $this->region_id = $v;
            $this->modifiedColumns[InseeGeoMunicipalityTableMap::REGION_ID] = true;
        }

        if ($this->aInseeGeoRegion !== null && $this->aInseeGeoRegion->getId() !== $v) {
            $this->aInseeGeoRegion = null;
        }


        return $this;
    } // setRegionId()

    /**
     * Sets the value of [created_at] column to a normalized version of the date/time value specified.
     *
     * @param      mixed $v string, integer (timestamp), or \DateTime value.
     *               Empty strings are treated as NULL.
     * @return   \INSEEGeo\Model\InseeGeoMunicipality The current object (for fluent API support)
     */
    public function setCreatedAt($v)
    {
        $dt = PropelDateTime::newInstance($v, null, '\DateTime');
        if ($this->created_at !== null || $dt !== null) {
            if ($dt !== $this->created_at) {
                $this->created_at = $dt;
                $this->modifiedColumns[InseeGeoMunicipalityTableMap::CREATED_AT] = true;
            }
        } // if either are not null


        return $this;
    } // setCreatedAt()

    /**
     * Sets the value of [updated_at] column to a normalized version of the date/time value specified.
     *
     * @param      mixed $v string, integer (timestamp), or \DateTime value.
     *               Empty strings are treated as NULL.
     * @return   \INSEEGeo\Model\InseeGeoMunicipality The current object (for fluent API support)
     */
    public function setUpdatedAt($v)
    {
        $dt = PropelDateTime::newInstance($v, null, '\DateTime');
        if ($this->updated_at !== null || $dt !== null) {
            if ($dt !== $this->updated_at) {
                $this->updated_at = $dt;
                $this->modifiedColumns[InseeGeoMunicipalityTableMap::UPDATED_AT] = true;
            }
        } // if either are not null


        return $this;
    } // setUpdatedAt()

    /**
     * Indicates whether the columns in this object are only set to default values.
     *
     * This method can be used in conjunction with isModified() to indicate whether an object is both
     * modified _and_ has some values set which are non-default.
     *
     * @return boolean Whether the columns in this object are only been set with default values.
     */
    public function hasOnlyDefaultValues()
    {
        // otherwise, everything was equal, so return TRUE
        return true;
    } // hasOnlyDefaultValues()

    /**
     * Hydrates (populates) the object variables with values from the database resultset.
     *
     * An offset (0-based "start column") is specified so that objects can be hydrated
     * with a subset of the columns in the resultset rows.  This is needed, for example,
     * for results of JOIN queries where the resultset row includes columns from two or
     * more tables.
     *
     * @param array   $row       The row returned by DataFetcher->fetch().
     * @param int     $startcol  0-based offset column which indicates which restultset column to start with.
     * @param boolean $rehydrate Whether this object is being re-hydrated from the database.
     * @param string  $indexType The index type of $row. Mostly DataFetcher->getIndexType().
                                  One of the class type constants TableMap::TYPE_PHPNAME, TableMap::TYPE_STUDLYPHPNAME
     *                            TableMap::TYPE_COLNAME, TableMap::TYPE_FIELDNAME, TableMap::TYPE_NUM.
     *
     * @return int             next starting column
     * @throws PropelException - Any caught Exception will be rewrapped as a PropelException.
     */
    public function hydrate($row, $startcol = 0, $rehydrate = false, $indexType = TableMap::TYPE_NUM)
    {
        try {


            $col = $row[TableMap::TYPE_NUM == $indexType ? 0 + $startcol : InseeGeoMunicipalityTableMap::translateFieldName('Id', TableMap::TYPE_PHPNAME, $indexType)];
            $this->id = (null !== $col) ? (string) $col : null;

            $col = $row[TableMap::TYPE_NUM == $indexType ? 1 + $startcol : InseeGeoMunicipalityTableMap::translateFieldName('ZipCode', TableMap::TYPE_PHPNAME, $indexType)];
            $this->zip_code = (null !== $col) ? (string) $col : null;

            $col = $row[TableMap::TYPE_NUM == $indexType ? 2 + $startcol : InseeGeoMunicipalityTableMap::translateFieldName('GeoPoint2dX', TableMap::TYPE_PHPNAME, $indexType)];
            $this->geo_point2d_x = (null !== $col) ? (double) $col : null;

            $col = $row[TableMap::TYPE_NUM == $indexType ? 3 + $startcol : InseeGeoMunicipalityTableMap::translateFieldName('GeoPoint2dY', TableMap::TYPE_PHPNAME, $indexType)];
            $this->geo_point2d_y = (null !== $col) ? (double) $col : null;

            $col = $row[TableMap::TYPE_NUM == $indexType ? 4 + $startcol : InseeGeoMunicipalityTableMap::translateFieldName('GeoShape', TableMap::TYPE_PHPNAME, $indexType)];
            $this->geo_shape = (null !== $col) ? (string) $col : null;

            $col = $row[TableMap::TYPE_NUM == $indexType ? 5 + $startcol : InseeGeoMunicipalityTableMap::translateFieldName('MunicipalityCode', TableMap::TYPE_PHPNAME, $indexType)];
            $this->municipality_code = (null !== $col) ? (int) $col : null;

            $col = $row[TableMap::TYPE_NUM == $indexType ? 6 + $startcol : InseeGeoMunicipalityTableMap::translateFieldName('DistrictCode', TableMap::TYPE_PHPNAME, $indexType)];
            $this->district_code = (null !== $col) ? (int) $col : null;

            $col = $row[TableMap::TYPE_NUM == $indexType ? 7 + $startcol : InseeGeoMunicipalityTableMap::translateFieldName('DepartmentId', TableMap::TYPE_PHPNAME, $indexType)];
            $this->department_id = (null !== $col) ? (int) $col : null;

            $col = $row[TableMap::TYPE_NUM == $indexType ? 8 + $startcol : InseeGeoMunicipalityTableMap::translateFieldName('RegionId', TableMap::TYPE_PHPNAME, $indexType)];
            $this->region_id = (null !== $col) ? (int) $col : null;

            $col = $row[TableMap::TYPE_NUM == $indexType ? 9 + $startcol : InseeGeoMunicipalityTableMap::translateFieldName('CreatedAt', TableMap::TYPE_PHPNAME, $indexType)];
            if ($col === '0000-00-00 00:00:00') {
                $col = null;
            }
            $this->created_at = (null !== $col) ? PropelDateTime::newInstance($col, null, '\DateTime') : null;

            $col = $row[TableMap::TYPE_NUM == $indexType ? 10 + $startcol : InseeGeoMunicipalityTableMap::translateFieldName('UpdatedAt', TableMap::TYPE_PHPNAME, $indexType)];
            if ($col === '0000-00-00 00:00:00') {
                $col = null;
            }
            $this->updated_at = (null !== $col) ? PropelDateTime::newInstance($col, null, '\DateTime') : null;
            $this->resetModified();

            $this->setNew(false);

            if ($rehydrate) {
                $this->ensureConsistency();
            }

            return $startcol + 11; // 11 = InseeGeoMunicipalityTableMap::NUM_HYDRATE_COLUMNS.

        } catch (Exception $e) {
            throw new PropelException("Error populating \INSEEGeo\Model\InseeGeoMunicipality object", 0, $e);
        }
    }

    /**
     * Checks and repairs the internal consistency of the object.
     *
     * This method is executed after an already-instantiated object is re-hydrated
     * from the database.  It exists to check any foreign keys to make sure that
     * the objects related to the current object are correct based on foreign key.
     *
     * You can override this method in the stub class, but you should always invoke
     * the base method from the overridden method (i.e. parent::ensureConsistency()),
     * in case your model changes.
     *
     * @throws PropelException
     */
    public function ensureConsistency()
    {
        if ($this->aInseeGeoDepartment !== null && $this->department_id !== $this->aInseeGeoDepartment->getId()) {
            $this->aInseeGeoDepartment = null;
        }
        if ($this->aInseeGeoRegion !== null && $this->region_id !== $this->aInseeGeoRegion->getId()) {
            $this->aInseeGeoRegion = null;
        }
    } // ensureConsistency

    /**
     * Reloads this object from datastore based on primary key and (optionally) resets all associated objects.
     *
     * This will only work if the object has been saved and has a valid primary key set.
     *
     * @param      boolean $deep (optional) Whether to also de-associated any related objects.
     * @param      ConnectionInterface $con (optional) The ConnectionInterface connection to use.
     * @return void
     * @throws PropelException - if this object is deleted, unsaved or doesn't have pk match in db
     */
    public function reload($deep = false, ConnectionInterface $con = null)
    {
        if ($this->isDeleted()) {
            throw new PropelException("Cannot reload a deleted object.");
        }

        if ($this->isNew()) {
            throw new PropelException("Cannot reload an unsaved object.");
        }

        if ($con === null) {
            $con = Propel::getServiceContainer()->getReadConnection(InseeGeoMunicipalityTableMap::DATABASE_NAME);
        }

        // We don't need to alter the object instance pool; we're just modifying this instance
        // already in the pool.

        $dataFetcher = ChildInseeGeoMunicipalityQuery::create(null, $this->buildPkeyCriteria())->setFormatter(ModelCriteria::FORMAT_STATEMENT)->find($con);
        $row = $dataFetcher->fetch();
        $dataFetcher->close();
        if (!$row) {
            throw new PropelException('Cannot find matching row in the database to reload object values.');
        }
        $this->hydrate($row, 0, true, $dataFetcher->getIndexType()); // rehydrate

        if ($deep) {  // also de-associate any related objects?

            $this->aInseeGeoDepartment = null;
            $this->aInseeGeoRegion = null;
            $this->collInseeGeoMunicipalityI18ns = null;

        } // if (deep)
    }

    /**
     * Removes this object from datastore and sets delete attribute.
     *
     * @param      ConnectionInterface $con
     * @return void
     * @throws PropelException
     * @see InseeGeoMunicipality::setDeleted()
     * @see InseeGeoMunicipality::isDeleted()
     */
    public function delete(ConnectionInterface $con = null)
    {
        if ($this->isDeleted()) {
            throw new PropelException("This object has already been deleted.");
        }

        if ($con === null) {
            $con = Propel::getServiceContainer()->getWriteConnection(InseeGeoMunicipalityTableMap::DATABASE_NAME);
        }

        $con->beginTransaction();
        try {
            $deleteQuery = ChildInseeGeoMunicipalityQuery::create()
                ->filterByPrimaryKey($this->getPrimaryKey());
            $ret = $this->preDelete($con);
            if ($ret) {
                $deleteQuery->delete($con);
                $this->postDelete($con);
                $con->commit();
                $this->setDeleted(true);
            } else {
                $con->commit();
            }
        } catch (Exception $e) {
            $con->rollBack();
            throw $e;
        }
    }

    /**
     * Persists this object to the database.
     *
     * If the object is new, it inserts it; otherwise an update is performed.
     * All modified related objects will also be persisted in the doSave()
     * method.  This method wraps all precipitate database operations in a
     * single transaction.
     *
     * @param      ConnectionInterface $con
     * @return int             The number of rows affected by this insert/update and any referring fk objects' save() operations.
     * @throws PropelException
     * @see doSave()
     */
    public function save(ConnectionInterface $con = null)
    {
        if ($this->isDeleted()) {
            throw new PropelException("You cannot save an object that has been deleted.");
        }

        if ($con === null) {
            $con = Propel::getServiceContainer()->getWriteConnection(InseeGeoMunicipalityTableMap::DATABASE_NAME);
        }

        $con->beginTransaction();
        $isInsert = $this->isNew();
        try {
            $ret = $this->preSave($con);
            if ($isInsert) {
                $ret = $ret && $this->preInsert($con);
                // timestampable behavior
                if (!$this->isColumnModified(InseeGeoMunicipalityTableMap::CREATED_AT)) {
                    $this->setCreatedAt(time());
                }
                if (!$this->isColumnModified(InseeGeoMunicipalityTableMap::UPDATED_AT)) {
                    $this->setUpdatedAt(time());
                }
            } else {
                $ret = $ret && $this->preUpdate($con);
                // timestampable behavior
                if ($this->isModified() && !$this->isColumnModified(InseeGeoMunicipalityTableMap::UPDATED_AT)) {
                    $this->setUpdatedAt(time());
                }
            }
            if ($ret) {
                $affectedRows = $this->doSave($con);
                if ($isInsert) {
                    $this->postInsert($con);
                } else {
                    $this->postUpdate($con);
                }
                $this->postSave($con);
                InseeGeoMunicipalityTableMap::addInstanceToPool($this);
            } else {
                $affectedRows = 0;
            }
            $con->commit();

            return $affectedRows;
        } catch (Exception $e) {
            $con->rollBack();
            throw $e;
        }
    }

    /**
     * Performs the work of inserting or updating the row in the database.
     *
     * If the object is new, it inserts it; otherwise an update is performed.
     * All related objects are also updated in this method.
     *
     * @param      ConnectionInterface $con
     * @return int             The number of rows affected by this insert/update and any referring fk objects' save() operations.
     * @throws PropelException
     * @see save()
     */
    protected function doSave(ConnectionInterface $con)
    {
        $affectedRows = 0; // initialize var to track total num of affected rows
        if (!$this->alreadyInSave) {
            $this->alreadyInSave = true;

            // We call the save method on the following object(s) if they
            // were passed to this object by their corresponding set
            // method.  This object relates to these object(s) by a
            // foreign key reference.

            if ($this->aInseeGeoDepartment !== null) {
                if ($this->aInseeGeoDepartment->isModified() || $this->aInseeGeoDepartment->isNew()) {
                    $affectedRows += $this->aInseeGeoDepartment->save($con);
                }
                $this->setInseeGeoDepartment($this->aInseeGeoDepartment);
            }

            if ($this->aInseeGeoRegion !== null) {
                if ($this->aInseeGeoRegion->isModified() || $this->aInseeGeoRegion->isNew()) {
                    $affectedRows += $this->aInseeGeoRegion->save($con);
                }
                $this->setInseeGeoRegion($this->aInseeGeoRegion);
            }

            if ($this->isNew() || $this->isModified()) {
                // persist changes
                if ($this->isNew()) {
                    $this->doInsert($con);
                } else {
                    $this->doUpdate($con);
                }
                $affectedRows += 1;
                $this->resetModified();
            }

            if ($this->inseeGeoMunicipalityI18nsScheduledForDeletion !== null) {
                if (!$this->inseeGeoMunicipalityI18nsScheduledForDeletion->isEmpty()) {
                    \INSEEGeo\Model\InseeGeoMunicipalityI18nQuery::create()
                        ->filterByPrimaryKeys($this->inseeGeoMunicipalityI18nsScheduledForDeletion->getPrimaryKeys(false))
                        ->delete($con);
                    $this->inseeGeoMunicipalityI18nsScheduledForDeletion = null;
                }
            }

                if ($this->collInseeGeoMunicipalityI18ns !== null) {
            foreach ($this->collInseeGeoMunicipalityI18ns as $referrerFK) {
                    if (!$referrerFK->isDeleted() && ($referrerFK->isNew() || $referrerFK->isModified())) {
                        $affectedRows += $referrerFK->save($con);
                    }
                }
            }

            $this->alreadyInSave = false;

        }

        return $affectedRows;
    } // doSave()

    /**
     * Insert the row in the database.
     *
     * @param      ConnectionInterface $con
     *
     * @throws PropelException
     * @see doSave()
     */
    protected function doInsert(ConnectionInterface $con)
    {
        $modifiedColumns = array();
        $index = 0;


         // check the columns in natural order for more readable SQL queries
        if ($this->isColumnModified(InseeGeoMunicipalityTableMap::ID)) {
            $modifiedColumns[':p' . $index++]  = 'ID';
        }
        if ($this->isColumnModified(InseeGeoMunicipalityTableMap::ZIP_CODE)) {
            $modifiedColumns[':p' . $index++]  = 'ZIP_CODE';
        }
        if ($this->isColumnModified(InseeGeoMunicipalityTableMap::GEO_POINT2D_X)) {
            $modifiedColumns[':p' . $index++]  = 'GEO_POINT2D_X';
        }
        if ($this->isColumnModified(InseeGeoMunicipalityTableMap::GEO_POINT2D_Y)) {
            $modifiedColumns[':p' . $index++]  = 'GEO_POINT2D_Y';
        }
        if ($this->isColumnModified(InseeGeoMunicipalityTableMap::GEO_SHAPE)) {
            $modifiedColumns[':p' . $index++]  = 'GEO_SHAPE';
        }
        if ($this->isColumnModified(InseeGeoMunicipalityTableMap::MUNICIPALITY_CODE)) {
            $modifiedColumns[':p' . $index++]  = 'MUNICIPALITY_CODE';
        }
        if ($this->isColumnModified(InseeGeoMunicipalityTableMap::DISTRICT_CODE)) {
            $modifiedColumns[':p' . $index++]  = 'DISTRICT_CODE';
        }
        if ($this->isColumnModified(InseeGeoMunicipalityTableMap::DEPARTMENT_ID)) {
            $modifiedColumns[':p' . $index++]  = 'DEPARTMENT_ID';
        }
        if ($this->isColumnModified(InseeGeoMunicipalityTableMap::REGION_ID)) {
            $modifiedColumns[':p' . $index++]  = 'REGION_ID';
        }
        if ($this->isColumnModified(InseeGeoMunicipalityTableMap::CREATED_AT)) {
            $modifiedColumns[':p' . $index++]  = 'CREATED_AT';
        }
        if ($this->isColumnModified(InseeGeoMunicipalityTableMap::UPDATED_AT)) {
            $modifiedColumns[':p' . $index++]  = 'UPDATED_AT';
        }

        $sql = sprintf(
            'INSERT INTO insee_geo_municipality (%s) VALUES (%s)',
            implode(', ', $modifiedColumns),
            implode(', ', array_keys($modifiedColumns))
        );

        try {
            $stmt = $con->prepare($sql);
            foreach ($modifiedColumns as $identifier => $columnName) {
                switch ($columnName) {
                    case 'ID':
                        $stmt->bindValue($identifier, $this->id, PDO::PARAM_STR);
                        break;
                    case 'ZIP_CODE':
                        $stmt->bindValue($identifier, $this->zip_code, PDO::PARAM_STR);
                        break;
                    case 'GEO_POINT2D_X':
                        $stmt->bindValue($identifier, $this->geo_point2d_x, PDO::PARAM_STR);
                        break;
                    case 'GEO_POINT2D_Y':
                        $stmt->bindValue($identifier, $this->geo_point2d_y, PDO::PARAM_STR);
                        break;
                    case 'GEO_SHAPE':
                        $stmt->bindValue($identifier, $this->geo_shape, PDO::PARAM_STR);
                        break;
                    case 'MUNICIPALITY_CODE':
                        $stmt->bindValue($identifier, $this->municipality_code, PDO::PARAM_INT);
                        break;
                    case 'DISTRICT_CODE':
                        $stmt->bindValue($identifier, $this->district_code, PDO::PARAM_INT);
                        break;
                    case 'DEPARTMENT_ID':
                        $stmt->bindValue($identifier, $this->department_id, PDO::PARAM_INT);
                        break;
                    case 'REGION_ID':
                        $stmt->bindValue($identifier, $this->region_id, PDO::PARAM_INT);
                        break;
                    case 'CREATED_AT':
                        $stmt->bindValue($identifier, $this->created_at ? $this->created_at->format("Y-m-d H:i:s") : null, PDO::PARAM_STR);
                        break;
                    case 'UPDATED_AT':
                        $stmt->bindValue($identifier, $this->updated_at ? $this->updated_at->format("Y-m-d H:i:s") : null, PDO::PARAM_STR);
                        break;
                }
            }
            $stmt->execute();
        } catch (Exception $e) {
            Propel::log($e->getMessage(), Propel::LOG_ERR);
            throw new PropelException(sprintf('Unable to execute INSERT statement [%s]', $sql), 0, $e);
        }

        $this->setNew(false);
    }

    /**
     * Update the row in the database.
     *
     * @param      ConnectionInterface $con
     *
     * @return Integer Number of updated rows
     * @see doSave()
     */
    protected function doUpdate(ConnectionInterface $con)
    {
        $selectCriteria = $this->buildPkeyCriteria();
        $valuesCriteria = $this->buildCriteria();

        return $selectCriteria->doUpdate($valuesCriteria, $con);
    }

    /**
     * Retrieves a field from the object by name passed in as a string.
     *
     * @param      string $name name
     * @param      string $type The type of fieldname the $name is of:
     *                     one of the class type constants TableMap::TYPE_PHPNAME, TableMap::TYPE_STUDLYPHPNAME
     *                     TableMap::TYPE_COLNAME, TableMap::TYPE_FIELDNAME, TableMap::TYPE_NUM.
     *                     Defaults to TableMap::TYPE_PHPNAME.
     * @return mixed Value of field.
     */
    public function getByName($name, $type = TableMap::TYPE_PHPNAME)
    {
        $pos = InseeGeoMunicipalityTableMap::translateFieldName($name, $type, TableMap::TYPE_NUM);
        $field = $this->getByPosition($pos);

        return $field;
    }

    /**
     * Retrieves a field from the object by Position as specified in the xml schema.
     * Zero-based.
     *
     * @param      int $pos position in xml schema
     * @return mixed Value of field at $pos
     */
    public function getByPosition($pos)
    {
        switch ($pos) {
            case 0:
                return $this->getId();
                break;
            case 1:
                return $this->getZipCode();
                break;
            case 2:
                return $this->getGeoPoint2dX();
                break;
            case 3:
                return $this->getGeoPoint2dY();
                break;
            case 4:
                return $this->getGeoShape();
                break;
            case 5:
                return $this->getMunicipalityCode();
                break;
            case 6:
                return $this->getDistrictCode();
                break;
            case 7:
                return $this->getDepartmentId();
                break;
            case 8:
                return $this->getRegionId();
                break;
            case 9:
                return $this->getCreatedAt();
                break;
            case 10:
                return $this->getUpdatedAt();
                break;
            default:
                return null;
                break;
        } // switch()
    }

    /**
     * Exports the object as an array.
     *
     * You can specify the key type of the array by passing one of the class
     * type constants.
     *
     * @param     string  $keyType (optional) One of the class type constants TableMap::TYPE_PHPNAME, TableMap::TYPE_STUDLYPHPNAME,
     *                    TableMap::TYPE_COLNAME, TableMap::TYPE_FIELDNAME, TableMap::TYPE_NUM.
     *                    Defaults to TableMap::TYPE_PHPNAME.
     * @param     boolean $includeLazyLoadColumns (optional) Whether to include lazy loaded columns. Defaults to TRUE.
     * @param     array $alreadyDumpedObjects List of objects to skip to avoid recursion
     * @param     boolean $includeForeignObjects (optional) Whether to include hydrated related objects. Default to FALSE.
     *
     * @return array an associative array containing the field names (as keys) and field values
     */
    public function toArray($keyType = TableMap::TYPE_PHPNAME, $includeLazyLoadColumns = true, $alreadyDumpedObjects = array(), $includeForeignObjects = false)
    {
        if (isset($alreadyDumpedObjects['InseeGeoMunicipality'][$this->getPrimaryKey()])) {
            return '*RECURSION*';
        }
        $alreadyDumpedObjects['InseeGeoMunicipality'][$this->getPrimaryKey()] = true;
        $keys = InseeGeoMunicipalityTableMap::getFieldNames($keyType);
        $result = array(
            $keys[0] => $this->getId(),
            $keys[1] => $this->getZipCode(),
            $keys[2] => $this->getGeoPoint2dX(),
            $keys[3] => $this->getGeoPoint2dY(),
            $keys[4] => $this->getGeoShape(),
            $keys[5] => $this->getMunicipalityCode(),
            $keys[6] => $this->getDistrictCode(),
            $keys[7] => $this->getDepartmentId(),
            $keys[8] => $this->getRegionId(),
            $keys[9] => $this->getCreatedAt(),
            $keys[10] => $this->getUpdatedAt(),
        );
        $virtualColumns = $this->virtualColumns;
        foreach ($virtualColumns as $key => $virtualColumn) {
            $result[$key] = $virtualColumn;
        }

        if ($includeForeignObjects) {
            if (null !== $this->aInseeGeoDepartment) {
                $result['InseeGeoDepartment'] = $this->aInseeGeoDepartment->toArray($keyType, $includeLazyLoadColumns,  $alreadyDumpedObjects, true);
            }
            if (null !== $this->aInseeGeoRegion) {
                $result['InseeGeoRegion'] = $this->aInseeGeoRegion->toArray($keyType, $includeLazyLoadColumns,  $alreadyDumpedObjects, true);
            }
            if (null !== $this->collInseeGeoMunicipalityI18ns) {
                $result['InseeGeoMunicipalityI18ns'] = $this->collInseeGeoMunicipalityI18ns->toArray(null, true, $keyType, $includeLazyLoadColumns, $alreadyDumpedObjects);
            }
        }

        return $result;
    }

    /**
     * Sets a field from the object by name passed in as a string.
     *
     * @param      string $name
     * @param      mixed  $value field value
     * @param      string $type The type of fieldname the $name is of:
     *                     one of the class type constants TableMap::TYPE_PHPNAME, TableMap::TYPE_STUDLYPHPNAME
     *                     TableMap::TYPE_COLNAME, TableMap::TYPE_FIELDNAME, TableMap::TYPE_NUM.
     *                     Defaults to TableMap::TYPE_PHPNAME.
     * @return void
     */
    public function setByName($name, $value, $type = TableMap::TYPE_PHPNAME)
    {
        $pos = InseeGeoMunicipalityTableMap::translateFieldName($name, $type, TableMap::TYPE_NUM);

        return $this->setByPosition($pos, $value);
    }

    /**
     * Sets a field from the object by Position as specified in the xml schema.
     * Zero-based.
     *
     * @param      int $pos position in xml schema
     * @param      mixed $value field value
     * @return void
     */
    public function setByPosition($pos, $value)
    {
        switch ($pos) {
            case 0:
                $this->setId($value);
                break;
            case 1:
                $this->setZipCode($value);
                break;
            case 2:
                $this->setGeoPoint2dX($value);
                break;
            case 3:
                $this->setGeoPoint2dY($value);
                break;
            case 4:
                $this->setGeoShape($value);
                break;
            case 5:
                $this->setMunicipalityCode($value);
                break;
            case 6:
                $this->setDistrictCode($value);
                break;
            case 7:
                $this->setDepartmentId($value);
                break;
            case 8:
                $this->setRegionId($value);
                break;
            case 9:
                $this->setCreatedAt($value);
                break;
            case 10:
                $this->setUpdatedAt($value);
                break;
        } // switch()
    }

    /**
     * Populates the object using an array.
     *
     * This is particularly useful when populating an object from one of the
     * request arrays (e.g. $_POST).  This method goes through the column
     * names, checking to see whether a matching key exists in populated
     * array. If so the setByName() method is called for that column.
     *
     * You can specify the key type of the array by additionally passing one
     * of the class type constants TableMap::TYPE_PHPNAME, TableMap::TYPE_STUDLYPHPNAME,
     * TableMap::TYPE_COLNAME, TableMap::TYPE_FIELDNAME, TableMap::TYPE_NUM.
     * The default key type is the column's TableMap::TYPE_PHPNAME.
     *
     * @param      array  $arr     An array to populate the object from.
     * @param      string $keyType The type of keys the array uses.
     * @return void
     */
    public function fromArray($arr, $keyType = TableMap::TYPE_PHPNAME)
    {
        $keys = InseeGeoMunicipalityTableMap::getFieldNames($keyType);

        if (array_key_exists($keys[0], $arr)) $this->setId($arr[$keys[0]]);
        if (array_key_exists($keys[1], $arr)) $this->setZipCode($arr[$keys[1]]);
        if (array_key_exists($keys[2], $arr)) $this->setGeoPoint2dX($arr[$keys[2]]);
        if (array_key_exists($keys[3], $arr)) $this->setGeoPoint2dY($arr[$keys[3]]);
        if (array_key_exists($keys[4], $arr)) $this->setGeoShape($arr[$keys[4]]);
        if (array_key_exists($keys[5], $arr)) $this->setMunicipalityCode($arr[$keys[5]]);
        if (array_key_exists($keys[6], $arr)) $this->setDistrictCode($arr[$keys[6]]);
        if (array_key_exists($keys[7], $arr)) $this->setDepartmentId($arr[$keys[7]]);
        if (array_key_exists($keys[8], $arr)) $this->setRegionId($arr[$keys[8]]);
        if (array_key_exists($keys[9], $arr)) $this->setCreatedAt($arr[$keys[9]]);
        if (array_key_exists($keys[10], $arr)) $this->setUpdatedAt($arr[$keys[10]]);
    }

    /**
     * Build a Criteria object containing the values of all modified columns in this object.
     *
     * @return Criteria The Criteria object containing all modified values.
     */
    public function buildCriteria()
    {
        $criteria = new Criteria(InseeGeoMunicipalityTableMap::DATABASE_NAME);

        if ($this->isColumnModified(InseeGeoMunicipalityTableMap::ID)) $criteria->add(InseeGeoMunicipalityTableMap::ID, $this->id);
        if ($this->isColumnModified(InseeGeoMunicipalityTableMap::ZIP_CODE)) $criteria->add(InseeGeoMunicipalityTableMap::ZIP_CODE, $this->zip_code);
        if ($this->isColumnModified(InseeGeoMunicipalityTableMap::GEO_POINT2D_X)) $criteria->add(InseeGeoMunicipalityTableMap::GEO_POINT2D_X, $this->geo_point2d_x);
        if ($this->isColumnModified(InseeGeoMunicipalityTableMap::GEO_POINT2D_Y)) $criteria->add(InseeGeoMunicipalityTableMap::GEO_POINT2D_Y, $this->geo_point2d_y);
        if ($this->isColumnModified(InseeGeoMunicipalityTableMap::GEO_SHAPE)) $criteria->add(InseeGeoMunicipalityTableMap::GEO_SHAPE, $this->geo_shape);
        if ($this->isColumnModified(InseeGeoMunicipalityTableMap::MUNICIPALITY_CODE)) $criteria->add(InseeGeoMunicipalityTableMap::MUNICIPALITY_CODE, $this->municipality_code);
        if ($this->isColumnModified(InseeGeoMunicipalityTableMap::DISTRICT_CODE)) $criteria->add(InseeGeoMunicipalityTableMap::DISTRICT_CODE, $this->district_code);
        if ($this->isColumnModified(InseeGeoMunicipalityTableMap::DEPARTMENT_ID)) $criteria->add(InseeGeoMunicipalityTableMap::DEPARTMENT_ID, $this->department_id);
        if ($this->isColumnModified(InseeGeoMunicipalityTableMap::REGION_ID)) $criteria->add(InseeGeoMunicipalityTableMap::REGION_ID, $this->region_id);
        if ($this->isColumnModified(InseeGeoMunicipalityTableMap::CREATED_AT)) $criteria->add(InseeGeoMunicipalityTableMap::CREATED_AT, $this->created_at);
        if ($this->isColumnModified(InseeGeoMunicipalityTableMap::UPDATED_AT)) $criteria->add(InseeGeoMunicipalityTableMap::UPDATED_AT, $this->updated_at);

        return $criteria;
    }

    /**
     * Builds a Criteria object containing the primary key for this object.
     *
     * Unlike buildCriteria() this method includes the primary key values regardless
     * of whether or not they have been modified.
     *
     * @return Criteria The Criteria object containing value(s) for primary key(s).
     */
    public function buildPkeyCriteria()
    {
        $criteria = new Criteria(InseeGeoMunicipalityTableMap::DATABASE_NAME);
        $criteria->add(InseeGeoMunicipalityTableMap::ID, $this->id);

        return $criteria;
    }

    /**
     * Returns the primary key for this object (row).
     * @return   string
     */
    public function getPrimaryKey()
    {
        return $this->getId();
    }

    /**
     * Generic method to set the primary key (id column).
     *
     * @param       string $key Primary key.
     * @return void
     */
    public function setPrimaryKey($key)
    {
        $this->setId($key);
    }

    /**
     * Returns true if the primary key for this object is null.
     * @return boolean
     */
    public function isPrimaryKeyNull()
    {

        return null === $this->getId();
    }

    /**
     * Sets contents of passed object to values from current object.
     *
     * If desired, this method can also make copies of all associated (fkey referrers)
     * objects.
     *
     * @param      object $copyObj An object of \INSEEGeo\Model\InseeGeoMunicipality (or compatible) type.
     * @param      boolean $deepCopy Whether to also copy all rows that refer (by fkey) to the current row.
     * @param      boolean $makeNew Whether to reset autoincrement PKs and make the object new.
     * @throws PropelException
     */
    public function copyInto($copyObj, $deepCopy = false, $makeNew = true)
    {
        $copyObj->setId($this->getId());
        $copyObj->setZipCode($this->getZipCode());
        $copyObj->setGeoPoint2dX($this->getGeoPoint2dX());
        $copyObj->setGeoPoint2dY($this->getGeoPoint2dY());
        $copyObj->setGeoShape($this->getGeoShape());
        $copyObj->setMunicipalityCode($this->getMunicipalityCode());
        $copyObj->setDistrictCode($this->getDistrictCode());
        $copyObj->setDepartmentId($this->getDepartmentId());
        $copyObj->setRegionId($this->getRegionId());
        $copyObj->setCreatedAt($this->getCreatedAt());
        $copyObj->setUpdatedAt($this->getUpdatedAt());

        if ($deepCopy) {
            // important: temporarily setNew(false) because this affects the behavior of
            // the getter/setter methods for fkey referrer objects.
            $copyObj->setNew(false);

            foreach ($this->getInseeGeoMunicipalityI18ns() as $relObj) {
                if ($relObj !== $this) {  // ensure that we don't try to copy a reference to ourselves
                    $copyObj->addInseeGeoMunicipalityI18n($relObj->copy($deepCopy));
                }
            }

        } // if ($deepCopy)

        if ($makeNew) {
            $copyObj->setNew(true);
        }
    }

    /**
     * Makes a copy of this object that will be inserted as a new row in table when saved.
     * It creates a new object filling in the simple attributes, but skipping any primary
     * keys that are defined for the table.
     *
     * If desired, this method can also make copies of all associated (fkey referrers)
     * objects.
     *
     * @param      boolean $deepCopy Whether to also copy all rows that refer (by fkey) to the current row.
     * @return                 \INSEEGeo\Model\InseeGeoMunicipality Clone of current object.
     * @throws PropelException
     */
    public function copy($deepCopy = false)
    {
        // we use get_class(), because this might be a subclass
        $clazz = get_class($this);
        $copyObj = new $clazz();
        $this->copyInto($copyObj, $deepCopy);

        return $copyObj;
    }

    /**
     * Declares an association between this object and a ChildInseeGeoDepartment object.
     *
     * @param                  ChildInseeGeoDepartment $v
     * @return                 \INSEEGeo\Model\InseeGeoMunicipality The current object (for fluent API support)
     * @throws PropelException
     */
    public function setInseeGeoDepartment(ChildInseeGeoDepartment $v = null)
    {
        if ($v === null) {
            $this->setDepartmentId(NULL);
        } else {
            $this->setDepartmentId($v->getId());
        }

        $this->aInseeGeoDepartment = $v;

        // Add binding for other direction of this n:n relationship.
        // If this object has already been added to the ChildInseeGeoDepartment object, it will not be re-added.
        if ($v !== null) {
            $v->addInseeGeoMunicipality($this);
        }


        return $this;
    }


    /**
     * Get the associated ChildInseeGeoDepartment object
     *
     * @param      ConnectionInterface $con Optional Connection object.
     * @return                 ChildInseeGeoDepartment The associated ChildInseeGeoDepartment object.
     * @throws PropelException
     */
    public function getInseeGeoDepartment(ConnectionInterface $con = null)
    {
        if ($this->aInseeGeoDepartment === null && ($this->department_id !== null)) {
            $this->aInseeGeoDepartment = ChildInseeGeoDepartmentQuery::create()->findPk($this->department_id, $con);
            /* The following can be used additionally to
                guarantee the related object contains a reference
                to this object.  This level of coupling may, however, be
                undesirable since it could result in an only partially populated collection
                in the referenced object.
                $this->aInseeGeoDepartment->addInseeGeoMunicipalities($this);
             */
        }

        return $this->aInseeGeoDepartment;
    }

    /**
     * Declares an association between this object and a ChildInseeGeoRegion object.
     *
     * @param                  ChildInseeGeoRegion $v
     * @return                 \INSEEGeo\Model\InseeGeoMunicipality The current object (for fluent API support)
     * @throws PropelException
     */
    public function setInseeGeoRegion(ChildInseeGeoRegion $v = null)
    {
        if ($v === null) {
            $this->setRegionId(NULL);
        } else {
            $this->setRegionId($v->getId());
        }

        $this->aInseeGeoRegion = $v;

        // Add binding for other direction of this n:n relationship.
        // If this object has already been added to the ChildInseeGeoRegion object, it will not be re-added.
        if ($v !== null) {
            $v->addInseeGeoMunicipality($this);
        }


        return $this;
    }


    /**
     * Get the associated ChildInseeGeoRegion object
     *
     * @param      ConnectionInterface $con Optional Connection object.
     * @return                 ChildInseeGeoRegion The associated ChildInseeGeoRegion object.
     * @throws PropelException
     */
    public function getInseeGeoRegion(ConnectionInterface $con = null)
    {
        if ($this->aInseeGeoRegion === null && ($this->region_id !== null)) {
            $this->aInseeGeoRegion = ChildInseeGeoRegionQuery::create()->findPk($this->region_id, $con);
            /* The following can be used additionally to
                guarantee the related object contains a reference
                to this object.  This level of coupling may, however, be
                undesirable since it could result in an only partially populated collection
                in the referenced object.
                $this->aInseeGeoRegion->addInseeGeoMunicipalities($this);
             */
        }

        return $this->aInseeGeoRegion;
    }


    /**
     * Initializes a collection based on the name of a relation.
     * Avoids crafting an 'init[$relationName]s' method name
     * that wouldn't work when StandardEnglishPluralizer is used.
     *
     * @param      string $relationName The name of the relation to initialize
     * @return void
     */
    public function initRelation($relationName)
    {
        if ('InseeGeoMunicipalityI18n' == $relationName) {
            return $this->initInseeGeoMunicipalityI18ns();
        }
    }

    /**
     * Clears out the collInseeGeoMunicipalityI18ns collection
     *
     * This does not modify the database; however, it will remove any associated objects, causing
     * them to be refetched by subsequent calls to accessor method.
     *
     * @return void
     * @see        addInseeGeoMunicipalityI18ns()
     */
    public function clearInseeGeoMunicipalityI18ns()
    {
        $this->collInseeGeoMunicipalityI18ns = null; // important to set this to NULL since that means it is uninitialized
    }

    /**
     * Reset is the collInseeGeoMunicipalityI18ns collection loaded partially.
     */
    public function resetPartialInseeGeoMunicipalityI18ns($v = true)
    {
        $this->collInseeGeoMunicipalityI18nsPartial = $v;
    }

    /**
     * Initializes the collInseeGeoMunicipalityI18ns collection.
     *
     * By default this just sets the collInseeGeoMunicipalityI18ns collection to an empty array (like clearcollInseeGeoMunicipalityI18ns());
     * however, you may wish to override this method in your stub class to provide setting appropriate
     * to your application -- for example, setting the initial array to the values stored in database.
     *
     * @param      boolean $overrideExisting If set to true, the method call initializes
     *                                        the collection even if it is not empty
     *
     * @return void
     */
    public function initInseeGeoMunicipalityI18ns($overrideExisting = true)
    {
        if (null !== $this->collInseeGeoMunicipalityI18ns && !$overrideExisting) {
            return;
        }
        $this->collInseeGeoMunicipalityI18ns = new ObjectCollection();
        $this->collInseeGeoMunicipalityI18ns->setModel('\INSEEGeo\Model\InseeGeoMunicipalityI18n');
    }

    /**
     * Gets an array of ChildInseeGeoMunicipalityI18n objects which contain a foreign key that references this object.
     *
     * If the $criteria is not null, it is used to always fetch the results from the database.
     * Otherwise the results are fetched from the database the first time, then cached.
     * Next time the same method is called without $criteria, the cached collection is returned.
     * If this ChildInseeGeoMunicipality is new, it will return
     * an empty collection or the current collection; the criteria is ignored on a new object.
     *
     * @param      Criteria $criteria optional Criteria object to narrow the query
     * @param      ConnectionInterface $con optional connection object
     * @return Collection|ChildInseeGeoMunicipalityI18n[] List of ChildInseeGeoMunicipalityI18n objects
     * @throws PropelException
     */
    public function getInseeGeoMunicipalityI18ns($criteria = null, ConnectionInterface $con = null)
    {
        $partial = $this->collInseeGeoMunicipalityI18nsPartial && !$this->isNew();
        if (null === $this->collInseeGeoMunicipalityI18ns || null !== $criteria  || $partial) {
            if ($this->isNew() && null === $this->collInseeGeoMunicipalityI18ns) {
                // return empty collection
                $this->initInseeGeoMunicipalityI18ns();
            } else {
                $collInseeGeoMunicipalityI18ns = ChildInseeGeoMunicipalityI18nQuery::create(null, $criteria)
                    ->filterByInseeGeoMunicipality($this)
                    ->find($con);

                if (null !== $criteria) {
                    if (false !== $this->collInseeGeoMunicipalityI18nsPartial && count($collInseeGeoMunicipalityI18ns)) {
                        $this->initInseeGeoMunicipalityI18ns(false);

                        foreach ($collInseeGeoMunicipalityI18ns as $obj) {
                            if (false == $this->collInseeGeoMunicipalityI18ns->contains($obj)) {
                                $this->collInseeGeoMunicipalityI18ns->append($obj);
                            }
                        }

                        $this->collInseeGeoMunicipalityI18nsPartial = true;
                    }

                    reset($collInseeGeoMunicipalityI18ns);

                    return $collInseeGeoMunicipalityI18ns;
                }

                if ($partial && $this->collInseeGeoMunicipalityI18ns) {
                    foreach ($this->collInseeGeoMunicipalityI18ns as $obj) {
                        if ($obj->isNew()) {
                            $collInseeGeoMunicipalityI18ns[] = $obj;
                        }
                    }
                }

                $this->collInseeGeoMunicipalityI18ns = $collInseeGeoMunicipalityI18ns;
                $this->collInseeGeoMunicipalityI18nsPartial = false;
            }
        }

        return $this->collInseeGeoMunicipalityI18ns;
    }

    /**
     * Sets a collection of InseeGeoMunicipalityI18n objects related by a one-to-many relationship
     * to the current object.
     * It will also schedule objects for deletion based on a diff between old objects (aka persisted)
     * and new objects from the given Propel collection.
     *
     * @param      Collection $inseeGeoMunicipalityI18ns A Propel collection.
     * @param      ConnectionInterface $con Optional connection object
     * @return   ChildInseeGeoMunicipality The current object (for fluent API support)
     */
    public function setInseeGeoMunicipalityI18ns(Collection $inseeGeoMunicipalityI18ns, ConnectionInterface $con = null)
    {
        $inseeGeoMunicipalityI18nsToDelete = $this->getInseeGeoMunicipalityI18ns(new Criteria(), $con)->diff($inseeGeoMunicipalityI18ns);


        //since at least one column in the foreign key is at the same time a PK
        //we can not just set a PK to NULL in the lines below. We have to store
        //a backup of all values, so we are able to manipulate these items based on the onDelete value later.
        $this->inseeGeoMunicipalityI18nsScheduledForDeletion = clone $inseeGeoMunicipalityI18nsToDelete;

        foreach ($inseeGeoMunicipalityI18nsToDelete as $inseeGeoMunicipalityI18nRemoved) {
            $inseeGeoMunicipalityI18nRemoved->setInseeGeoMunicipality(null);
        }

        $this->collInseeGeoMunicipalityI18ns = null;
        foreach ($inseeGeoMunicipalityI18ns as $inseeGeoMunicipalityI18n) {
            $this->addInseeGeoMunicipalityI18n($inseeGeoMunicipalityI18n);
        }

        $this->collInseeGeoMunicipalityI18ns = $inseeGeoMunicipalityI18ns;
        $this->collInseeGeoMunicipalityI18nsPartial = false;

        return $this;
    }

    /**
     * Returns the number of related InseeGeoMunicipalityI18n objects.
     *
     * @param      Criteria $criteria
     * @param      boolean $distinct
     * @param      ConnectionInterface $con
     * @return int             Count of related InseeGeoMunicipalityI18n objects.
     * @throws PropelException
     */
    public function countInseeGeoMunicipalityI18ns(Criteria $criteria = null, $distinct = false, ConnectionInterface $con = null)
    {
        $partial = $this->collInseeGeoMunicipalityI18nsPartial && !$this->isNew();
        if (null === $this->collInseeGeoMunicipalityI18ns || null !== $criteria || $partial) {
            if ($this->isNew() && null === $this->collInseeGeoMunicipalityI18ns) {
                return 0;
            }

            if ($partial && !$criteria) {
                return count($this->getInseeGeoMunicipalityI18ns());
            }

            $query = ChildInseeGeoMunicipalityI18nQuery::create(null, $criteria);
            if ($distinct) {
                $query->distinct();
            }

            return $query
                ->filterByInseeGeoMunicipality($this)
                ->count($con);
        }

        return count($this->collInseeGeoMunicipalityI18ns);
    }

    /**
     * Method called to associate a ChildInseeGeoMunicipalityI18n object to this object
     * through the ChildInseeGeoMunicipalityI18n foreign key attribute.
     *
     * @param    ChildInseeGeoMunicipalityI18n $l ChildInseeGeoMunicipalityI18n
     * @return   \INSEEGeo\Model\InseeGeoMunicipality The current object (for fluent API support)
     */
    public function addInseeGeoMunicipalityI18n(ChildInseeGeoMunicipalityI18n $l)
    {
        if ($l && $locale = $l->getLocale()) {
            $this->setLocale($locale);
            $this->currentTranslations[$locale] = $l;
        }
        if ($this->collInseeGeoMunicipalityI18ns === null) {
            $this->initInseeGeoMunicipalityI18ns();
            $this->collInseeGeoMunicipalityI18nsPartial = true;
        }

        if (!in_array($l, $this->collInseeGeoMunicipalityI18ns->getArrayCopy(), true)) { // only add it if the **same** object is not already associated
            $this->doAddInseeGeoMunicipalityI18n($l);
        }

        return $this;
    }

    /**
     * @param InseeGeoMunicipalityI18n $inseeGeoMunicipalityI18n The inseeGeoMunicipalityI18n object to add.
     */
    protected function doAddInseeGeoMunicipalityI18n($inseeGeoMunicipalityI18n)
    {
        $this->collInseeGeoMunicipalityI18ns[]= $inseeGeoMunicipalityI18n;
        $inseeGeoMunicipalityI18n->setInseeGeoMunicipality($this);
    }

    /**
     * @param  InseeGeoMunicipalityI18n $inseeGeoMunicipalityI18n The inseeGeoMunicipalityI18n object to remove.
     * @return ChildInseeGeoMunicipality The current object (for fluent API support)
     */
    public function removeInseeGeoMunicipalityI18n($inseeGeoMunicipalityI18n)
    {
        if ($this->getInseeGeoMunicipalityI18ns()->contains($inseeGeoMunicipalityI18n)) {
            $this->collInseeGeoMunicipalityI18ns->remove($this->collInseeGeoMunicipalityI18ns->search($inseeGeoMunicipalityI18n));
            if (null === $this->inseeGeoMunicipalityI18nsScheduledForDeletion) {
                $this->inseeGeoMunicipalityI18nsScheduledForDeletion = clone $this->collInseeGeoMunicipalityI18ns;
                $this->inseeGeoMunicipalityI18nsScheduledForDeletion->clear();
            }
            $this->inseeGeoMunicipalityI18nsScheduledForDeletion[]= clone $inseeGeoMunicipalityI18n;
            $inseeGeoMunicipalityI18n->setInseeGeoMunicipality(null);
        }

        return $this;
    }

    /**
     * Clears the current object and sets all attributes to their default values
     */
    public function clear()
    {
        $this->id = null;
        $this->zip_code = null;
        $this->geo_point2d_x = null;
        $this->geo_point2d_y = null;
        $this->geo_shape = null;
        $this->municipality_code = null;
        $this->district_code = null;
        $this->department_id = null;
        $this->region_id = null;
        $this->created_at = null;
        $this->updated_at = null;
        $this->alreadyInSave = false;
        $this->clearAllReferences();
        $this->resetModified();
        $this->setNew(true);
        $this->setDeleted(false);
    }

    /**
     * Resets all references to other model objects or collections of model objects.
     *
     * This method is a user-space workaround for PHP's inability to garbage collect
     * objects with circular references (even in PHP 5.3). This is currently necessary
     * when using Propel in certain daemon or large-volume/high-memory operations.
     *
     * @param      boolean $deep Whether to also clear the references on all referrer objects.
     */
    public function clearAllReferences($deep = false)
    {
        if ($deep) {
            if ($this->collInseeGeoMunicipalityI18ns) {
                foreach ($this->collInseeGeoMunicipalityI18ns as $o) {
                    $o->clearAllReferences($deep);
                }
            }
        } // if ($deep)

        // i18n behavior
        $this->currentLocale = 'en_US';
        $this->currentTranslations = null;

        $this->collInseeGeoMunicipalityI18ns = null;
        $this->aInseeGeoDepartment = null;
        $this->aInseeGeoRegion = null;
    }

    /**
     * Return the string representation of this object
     *
     * @return string
     */
    public function __toString()
    {
        return (string) $this->exportTo(InseeGeoMunicipalityTableMap::DEFAULT_STRING_FORMAT);
    }

    // timestampable behavior

    /**
     * Mark the current object so that the update date doesn't get updated during next save
     *
     * @return     ChildInseeGeoMunicipality The current object (for fluent API support)
     */
    public function keepUpdateDateUnchanged()
    {
        $this->modifiedColumns[InseeGeoMunicipalityTableMap::UPDATED_AT] = true;

        return $this;
    }

    // i18n behavior

    /**
     * Sets the locale for translations
     *
     * @param     string $locale Locale to use for the translation, e.g. 'fr_FR'
     *
     * @return    ChildInseeGeoMunicipality The current object (for fluent API support)
     */
    public function setLocale($locale = 'en_US')
    {
        $this->currentLocale = $locale;

        return $this;
    }

    /**
     * Gets the locale for translations
     *
     * @return    string $locale Locale to use for the translation, e.g. 'fr_FR'
     */
    public function getLocale()
    {
        return $this->currentLocale;
    }

    /**
     * Returns the current translation for a given locale
     *
     * @param     string $locale Locale to use for the translation, e.g. 'fr_FR'
     * @param     ConnectionInterface $con an optional connection object
     *
     * @return ChildInseeGeoMunicipalityI18n */
    public function getTranslation($locale = 'en_US', ConnectionInterface $con = null)
    {
        if (!isset($this->currentTranslations[$locale])) {
            if (null !== $this->collInseeGeoMunicipalityI18ns) {
                foreach ($this->collInseeGeoMunicipalityI18ns as $translation) {
                    if ($translation->getLocale() == $locale) {
                        $this->currentTranslations[$locale] = $translation;

                        return $translation;
                    }
                }
            }
            if ($this->isNew()) {
                $translation = new ChildInseeGeoMunicipalityI18n();
                $translation->setLocale($locale);
            } else {
                $translation = ChildInseeGeoMunicipalityI18nQuery::create()
                    ->filterByPrimaryKey(array($this->getPrimaryKey(), $locale))
                    ->findOneOrCreate($con);
                $this->currentTranslations[$locale] = $translation;
            }
            $this->addInseeGeoMunicipalityI18n($translation);
        }

        return $this->currentTranslations[$locale];
    }

    /**
     * Remove the translation for a given locale
     *
     * @param     string $locale Locale to use for the translation, e.g. 'fr_FR'
     * @param     ConnectionInterface $con an optional connection object
     *
     * @return    ChildInseeGeoMunicipality The current object (for fluent API support)
     */
    public function removeTranslation($locale = 'en_US', ConnectionInterface $con = null)
    {
        if (!$this->isNew()) {
            ChildInseeGeoMunicipalityI18nQuery::create()
                ->filterByPrimaryKey(array($this->getPrimaryKey(), $locale))
                ->delete($con);
        }
        if (isset($this->currentTranslations[$locale])) {
            unset($this->currentTranslations[$locale]);
        }
        foreach ($this->collInseeGeoMunicipalityI18ns as $key => $translation) {
            if ($translation->getLocale() == $locale) {
                unset($this->collInseeGeoMunicipalityI18ns[$key]);
                break;
            }
        }

        return $this;
    }

    /**
     * Returns the current translation
     *
     * @param     ConnectionInterface $con an optional connection object
     *
     * @return ChildInseeGeoMunicipalityI18n */
    public function getCurrentTranslation(ConnectionInterface $con = null)
    {
        return $this->getTranslation($this->getLocale(), $con);
    }


        /**
         * Get the [name] column value.
         *
         * @return   string
         */
        public function getName()
        {
        return $this->getCurrentTranslation()->getName();
    }


        /**
         * Set the value of [name] column.
         *
         * @param      string $v new value
         * @return   \INSEEGeo\Model\InseeGeoMunicipalityI18n The current object (for fluent API support)
         */
        public function setName($v)
        {    $this->getCurrentTranslation()->setName($v);

        return $this;
    }

    /**
     * Code to be run before persisting the object
     * @param  ConnectionInterface $con
     * @return boolean
     */
    public function preSave(ConnectionInterface $con = null)
    {
        return true;
    }

    /**
     * Code to be run after persisting the object
     * @param ConnectionInterface $con
     */
    public function postSave(ConnectionInterface $con = null)
    {

    }

    /**
     * Code to be run before inserting to database
     * @param  ConnectionInterface $con
     * @return boolean
     */
    public function preInsert(ConnectionInterface $con = null)
    {
        return true;
    }

    /**
     * Code to be run after inserting to database
     * @param ConnectionInterface $con
     */
    public function postInsert(ConnectionInterface $con = null)
    {

    }

    /**
     * Code to be run before updating the object in database
     * @param  ConnectionInterface $con
     * @return boolean
     */
    public function preUpdate(ConnectionInterface $con = null)
    {
        return true;
    }

    /**
     * Code to be run after updating the object in database
     * @param ConnectionInterface $con
     */
    public function postUpdate(ConnectionInterface $con = null)
    {

    }

    /**
     * Code to be run before deleting the object in database
     * @param  ConnectionInterface $con
     * @return boolean
     */
    public function preDelete(ConnectionInterface $con = null)
    {
        return true;
    }

    /**
     * Code to be run after deleting the object in database
     * @param ConnectionInterface $con
     */
    public function postDelete(ConnectionInterface $con = null)
    {

    }


    /**
     * Derived method to catches calls to undefined methods.
     *
     * Provides magic import/export method support (fromXML()/toXML(), fromYAML()/toYAML(), etc.).
     * Allows to define default __call() behavior if you overwrite __call()
     *
     * @param string $name
     * @param mixed  $params
     *
     * @return array|string
     */
    public function __call($name, $params)
    {
        if (0 === strpos($name, 'get')) {
            $virtualColumn = substr($name, 3);
            if ($this->hasVirtualColumn($virtualColumn)) {
                return $this->getVirtualColumn($virtualColumn);
            }

            $virtualColumn = lcfirst($virtualColumn);
            if ($this->hasVirtualColumn($virtualColumn)) {
                return $this->getVirtualColumn($virtualColumn);
            }
        }

        if (0 === strpos($name, 'from')) {
            $format = substr($name, 4);

            return $this->importFrom($format, reset($params));
        }

        if (0 === strpos($name, 'to')) {
            $format = substr($name, 2);
            $includeLazyLoadColumns = isset($params[0]) ? $params[0] : true;

            return $this->exportTo($format, $includeLazyLoadColumns);
        }

        throw new BadMethodCallException(sprintf('Call to undefined method: %s.', $name));
    }

}
