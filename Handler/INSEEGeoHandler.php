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

use INSEEGeo\Model\InseeGeoDepartmentQuery;
use INSEEGeo\Model\InseeGeoMunicipalityQuery;

/**
 * Class INSEEGeoHandler
 * @package INSEEGeo\Handler
 * @author David Gros <dgros@openstudio.fr>
 */
class INSEEGeoHandler
{

    /**
     * @param $zipCode
     *
     * @return array
     */
    public function getCityByZipCode($zipCode)
    {
        $query = InseeGeoMunicipalityQuery::create();
        return $query->findByZipCode($zipCode);
    }

    /**
     * @param $id       String  City id, this is insee code.
     * @param $locale
     *
     * @return \INSEEGeo\Model\InseeGeoMunicipality
     */
    public function getOneCityById($id, $locale)
    {
        $query = InseeGeoMunicipalityQuery::create();
        $query->useI18nQuery($locale)->endUse();
        return $query->findOneById($id)->setLocale($locale);
    }

    /**
     * @param $zipcode
     * @param $name
     *
     * @return array
     */
    public function getCities($zipcode, $name)
    {
        $query = InseeGeoMunicipalityQuery::create();
        $query->useInseeGeoMunicipalityI18nQuery()
            ->filterByName("*".$name."*")
            ->endUse();
        return $query->findByZipCode($zipcode);
    }

    public function getDepartmentForZipCode($zipCode)
    {
        $query = InseeGeoDepartmentQuery::create();
        $query->useInseeGeoMunicipalityQuery()
            ->filterByZipCode($zipCode)
            ->endUse();

        return $query->findOne();
    }

}
