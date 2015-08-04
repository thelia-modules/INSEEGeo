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

namespace INSEEGeo\Handler;

use INSEEGeo\Model\InseeGeoMunicipalityQuery;

/**
 * Class INSEEGeoHandler
 * @package INSEEGeo\Handler
 * @author David Gros <dgros@openstudio.fr>
 */
class INSEEGeoHandler
{

    public function getCityByZipCode($zipCode)
    {
        $query = InseeGeoMunicipalityQuery::create();
        return $query->findByZipCode($zipCode);
    }

}
