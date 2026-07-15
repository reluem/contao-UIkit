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

use Contao\CoreBundle\Routing\ScopeMatcher;
use Symfony\Component\HttpFoundation\RequestStack;

class generatePageHook
{
    private RequestStack $requestStack;
    private ScopeMatcher $scopeMatcher;

    public function __construct(RequestStack $requestStack, ScopeMatcher $scopeMatcher)
    {
        $this->requestStack = $requestStack;
        $this->scopeMatcher = $scopeMatcher;
    }

    public function assetDelivery(\PageModel $objPage, \LayoutModel $objLayout, \PageRegular $objPageRegular): void
    {
        $request = $this->requestStack->getCurrentRequest();
        $isFrontend = $request && $this->scopeMatcher->isFrontendRequest($request);

        if (!$isFrontend) {
            return;
        }

        foreach ($GLOBALS['TL_JAVASCRIPT'] as $index => $javascript) {
            $javascript = preg_replace('/\|.*/', '', $javascript);
            header('Link: ' . $javascript . '; rel=preload; as=script', false);
            $GLOBALS['TL_BODY'][] = '<script type="text/javascript" src="' . $javascript . '"></script>';
            unset($GLOBALS['TL_JAVASCRIPT'][$index]);
        }
    }
}
