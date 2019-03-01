<?php
    /**
     * Created by PhpStorm.
     * User: lucas
     * Date: 21.02.18
     * Time: 18:08
     */
    
    namespace reluem\ContaoUIkitBundle;
    
    
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
