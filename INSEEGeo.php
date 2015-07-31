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
use Thelia\Install\Database;
use Thelia\Module\BaseModule;

class INSEEGeo extends BaseModule
{
    /** @var string */
    const DOMAIN_NAME = 'inseegeo';


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

}
