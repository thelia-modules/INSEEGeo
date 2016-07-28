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
use Thelia\Core\Template\TemplateDefinition;
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

    public function getHooks()
    {
        return [
            [
                'type' => TemplateDefinition::FRONT_OFFICE,
                'code' => 'insee_geo.front.insert_select_city',
                'title' => "Insert form type SelectCity, to select city and zip code",
                'active' => true,
                'block' => false,
                'module' => false
            ],
            [
                'type' => TemplateDefinition::FRONT_OFFICE,
                'code' => 'insee_geo.javascript_initialization_front.insert_select_city',
                'title' => "Insert javascript form type SelectCity.",
                'active' => true,
                'block' => false,
                'module' => false,
            ]
        ];
    }

    /**
     * @inheritdoc
     */
    public function update($currentVersion, $newVersion, ConnectionInterface $con = null)
    {
        $logger = Tlog::getInstance();
        /** @var string $moduleDir Need for include_once php file */
        $moduleDir = __DIR__;
        $setupDir = __DIR__ . DS . 'Setup' . DS . 'Update';
        $finder = (new Finder)
            ->files()
            ->name('#.*?\.*#')
            ->in($setupDir);

        $database = new Database($con);

        /** @var \Symfony\Component\Finder\SplFileInfo $updateFile */
        foreach ($finder as $updateFile) {
            try {
                $extension = $updateFile->getExtension();
                if (version_compare($currentVersion, str_replace('.' . $extension, '', $updateFile->getFilename()),
                    '<')) {
                    switch ($extension) {
                        case 'php':
                            $logger->info('executing file ' . $newVersion . '.php');
                            include_once($updateFile->getPathname());
                            $logger->info('end executing file ' . $newVersion . '.php');
                            break;
                        case 'sql':
                            $logger->info('executing file ' . $currentVersion . '.sql');
                            $database->insertSql(
                                null,
                                [
                                    $updateFile->getPathname()
                                ]
                            );
                            $logger->info('end executing file ' . $currentVersion . '.sql');
                            break;
                        default:
                            $logger->error('Unknown file type : ' . $extension);
                            break;
                    }
                }
            } catch (\Exception $e) {
                $logger->error('Error while executing file ' . $updateFile->getPathname() . ': ' . $e->getMessage());
                throw $e;
            }
        }
    }

}
