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
 *
 * @method getId
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

        $ids = $this->getId();
        if ($ids !== null) {
            // test pour les id de 1 à 9
            foreach( $ids as &$id){
                $id = str_pad($id, 2, '0', STR_PAD_LEFT);
            }
            $search->filterById($ids);
        }
        $search->orderByPosition();

        return $search;
    }

    public function parseResults(LoopResult $loopResult)
    {
        /** @var \INSEEGeo\Model\InseeGeoDepartment $inseeGeoDep */
        foreach ($loopResult->getResultDataCollection() as $inseeGeoDep) {
            $loopResultRow = new LoopResultRow($inseeGeoDep);

            $loopResultRow
                ->set('ID', $inseeGeoDep->getId())
                ->set('INSEE_CODE', $inseeGeoDep->getInseeCode())
                ->set('NAME', $inseeGeoDep->getVirtualColumn('i18n_name'))
                ->set('CREATED_AT', $inseeGeoDep->getCreatedAt())
                ->set('UPDATED_AT', $inseeGeoDep->getUpdatedAt())
            ;

            $loopResult->addRow($loopResultRow);
        }

        return $loopResult;
    }
}