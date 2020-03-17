<?php

    declare(strict_types=1);

/*
 * Contao UIkit Bundle
 * @copyright  Copyright (c) 2018-2020, reluem
 * @author     reluem
 * @license    http://opensource.org/licenses/lgpl-3.0.html LGPL
 * @link       http://github.com/reluem/contao-uikit
 */

namespace Reluem\ContaoUIkitBundle\EventListener;

class generatePageHook
{
    public function assetDelivery(\PageModel $objPage, \LayoutModel $objLayout, \PageRegular $objPageRegular)
    {
        if ('FE' === TL_MODE) {
            foreach ($GLOBALS['TL_JAVASCRIPT'] as $index => $javascript) {
                $javascript = preg_replace('/\|.*/', '', $javascript);
                // $GLOBALS['TL_HEAD'][] = '<link href="' . $javascript . '" rel="preload" as="script">';
                header('Link: ' . $javascript . '; rel=preload; as=script', false);
                $GLOBALS['TL_BODY'][] = '<script type="text/javascript" src="' . $javascript . '"></script>';
                unset($GLOBALS['TL_JAVASCRIPT'][$index]);
            }
        }
    }
}
