<?php
/*************************************************************************************/
/*      This file is part of the Thelia package.                                     */
/*                                                                                   */
/*      Copyright (c) OpenStudio                                                     */
/*      email : dev@thelia.net                                                       */
/*      web : http://www.thelia.net                                                  */
/*                                                                                   */
/*      For the full copyright and license information, please view the LICENSE.txt  */
/*      file that was distributed with this source code.                             */
/*************************************************************************************/

namespace INSEEGeo;

use INSEEGeo\Model\Base\InseeGeoMunicipalityQuery;
use Propel\Runtime\Connection\ConnectionInterface;
use Propel\Runtime\Exception\PropelException;
use Symfony\Component\Finder\Finder;
use Thelia\Install\Database;
use Thelia\Log\Tlog;
use Thelia\Module\BaseModule;

/**
 * Class INSEEGeo
 * @package INSEEGeo
 */
class INSEEGeo extends BaseModule
{
    /** @var string */
    const DOMAIN_NAME = 'inseegeo';

    /**
     * {@inheritdoc}
     * @param ConnectionInterface|null $con
     */
    public function postActivation(ConnectionInterface $con = null)
    {
        $database = new Database($con);


        // Create tables and insert data it not exist
        try {
            InseeGeoMunicipalityQuery::create()->findOne();
        } catch (PropelException $e) {
            $database->insertSql(
                null,
                [
                    __DIR__ . DS . 'Config' . DS . 'thelia.sql',
                    __DIR__ . DS . 'Config' . DS . 'insert.sql',
                    __DIR__ . DS . 'Config' . DS . 'insert_city_0.sql',
                    __DIR__ . DS . 'Config' . DS . 'insert_city_1.sql',
                    __DIR__ . DS . 'Config' . DS . 'insert_city_2.sql',
                    __DIR__ . DS . 'Config' . DS . 'insert_city_3.sql',
                    __DIR__ . DS . 'Config' . DS . 'insert_city_18_0.sql',
                    __DIR__ . DS . 'Config' . DS . 'insert_city_18_1.sql',
                    __DIR__ . DS . 'Config' . DS . 'insert_city_18_2.sql',
                    __DIR__ . DS . 'Config' . DS . 'insert_city_18_3.sql'
                ]
            );
        }
    }

    const PHP_DIR = 'Setup/Update/';

    /**
     * Update method to execute sql script. Script must be in Config\Update
     *
     * @param string              $currentVersion
     * @param string              $newVersion
     * @param ConnectionInterface $con
     */
    public function update($currentVersion, $newVersion, ConnectionInterface $con)
    {
        $logger = Tlog::getInstance();
        /** @var string $moduleDir Need for include_once php file*/
        $moduleDir = __DIR__;
        $setupDir = __DIR__ . DS . 'Setup' . DS . 'Update';
        $finder = (new Finder)
            ->files()
            ->name('#.*?\.sql#')
            ->in($setupDir);

        $database = new Database($con);

        /** @var \Symfony\Component\Finder\SplFileInfo $updateSQLFile */
        foreach ($finder as $updateSQLFile) {
            if (version_compare($currentVersion, str_replace('.sql', '', $updateSQLFile->getFilename()), '<')) {
                $logger->info('executing file '.$currentVersion . '.sql');
                $database->insertSql(
                    null,
                    [
                        $updateSQLFile->getPathname()
                    ]
                );
                $logger->info('end executing file '.$currentVersion . '.sql');
            }
        }

        // php update
        $filename = $setupDir . DS . $newVersion . '.php';

        if (file_exists($filename)) {
            $logger->info('executing file '.$newVersion . '.php');
            include_once($filename);
            $logger->info('end executing file '.$newVersion . '.php');
        }
    }

}
