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

namespace INSEEGeo\Controller;

use Symfony\Component\HttpFoundation\JsonResponse;
use Thelia\Controller\Front\BaseFrontController;
use Thelia\Core\Translation\Translator;

/**
 * Class INSEEGeoController
 * @package INSEEGeo\Controller
 * @author David Gros <dgros@openstudio.fr>
 */
class INSEEGeoController extends BaseFrontController
{

    public function getCityByZip($zipCode)
    {
        // vérification ajax

        // récupération des données
        $result = $this->getINSEEGeoHandler()->getCityByZipCode($zipCode);

        $response = array();
        /** @var \INSEEGeo\Model\INSEEGeoMunicipality $res */
        foreach($result as $res){
            $res->setLocale(Translator::getInstance()->getLocale());
            $response[$res->getId()] = $res->getName();
        }

        // retour format JSON
        return new JsonResponse($response);

    }

    /** @var  \INSEEGeo\Handler\INSEEGeoHandler */
    protected $inseeGeoHandler;

    protected function getINSEEGeoHandler()
    {
        if( !isset($this->inseeGeoHandler) ){
            $this->inseeGeoHandler = $this->container->get('insee_geo.handler.insee_geo');
        }
        return $this->inseeGeoHandler;
    }

}
