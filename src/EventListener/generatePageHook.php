<?php

    declare(strict_types=1);

/*
 * This file is part of contao/uikit.
 * (c) Lucas Rech
 * @license LGPL-3.0-or-later
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
                header('Link: '.$javascript.'; rel=preload; as=script', false);
                $GLOBALS['TL_BODY'][] = '<script type="text/javascript" src="'.$javascript.'"></script>';
                unset($GLOBALS['TL_JAVASCRIPT'][$index]);
            }
        }
    }
}
