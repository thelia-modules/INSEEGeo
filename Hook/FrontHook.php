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

namespace INSEEGeo\Hook;

use Thelia\Core\Event\Hook\HookRenderEvent;
use Thelia\Core\Hook\BaseHook;

/**
 * Class FrontHool
 * @package INSEEGeo\Hook
 * @author David Gros <dgros@openstudio.fr>
 */
class FrontHook extends BaseHook
{

    public function insertSelectCity(HookRenderEvent $event)
    {
        $argument = $event->getArguments();
        $event->add($this->render("form/select-city.html", $argument));
    }

}
