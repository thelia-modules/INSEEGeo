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
/*************************************************************************************/

namespace INSEEGeo\Loop;

use INSEEGeo\Model\InseeGeoDepartmentQuery;
use Thelia\Core\Template\Element\BaseI18nLoop;
use Thelia\Core\Template\Element\LoopResult;
use Thelia\Core\Template\Element\LoopResultRow;
use Thelia\Core\Template\Element\PropelSearchLoopInterface;
use Thelia\Core\Template\Loop\Argument\Argument;
use Thelia\Core\Template\Loop\Argument\ArgumentCollection;

/**
 * Class DepLoop
 * @package INSEEGeo\Loop
 */
class DepLoop extends BaseI18nLoop implements PropelSearchLoopInterface
{
    protected function getArgDefinitions()
    {
        return new ArgumentCollection(
            Argument::createIntListTypeArgument('id')
        );
    }

    public function buildModelCriteria()
    {
        $search = new InseeGeoDepartmentQuery();

        $this->configureI18nProcessing($search, ['name']);

        $id = $this->getId();
        if ($id !== null) {
            $search->filterById($id);
        }

        return $search;
    }

    public function parseResults(LoopResult $loopResult)
    {
        /** @var \INSEEGeo\Model\InseeGeoRegion $inseeGeoRegion */
        foreach ($loopResult->getResultDataCollection() as $inseeGeoRegion) {
            $loopResultRow = new LoopResultRow($inseeGeoRegion);

            $loopResultRow
                ->set('ID', $inseeGeoRegion->getId())
                ->set('NAME', $inseeGeoRegion->getVirtualColumn('i18n_name'))
                ->set('CREATED_AT', $inseeGeoRegion->getCreatedAt())
                ->set('UPDATED_AT', $inseeGeoRegion->getUpdatedAt())
            ;

            $loopResult->addRow($loopResultRow);
        }

        return $loopResult;
    }
}