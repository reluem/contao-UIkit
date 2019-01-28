<?php
    /**
     * Created by PhpStorm.
     * User: lucas
     * Date: 21.02.18
     * Time: 18:08
     */
    
    namespace reluem;
    
    use Contao\Controller;
    
    /**
     * Add css fields to content elements.
     *
     *
     * @param \DataContainer $dataContainer The data container driver.
     *
     * @return void
     *
     * @SuppressWarnings(PHPMD.Superglobals)
     */
    class UIkitclassesHook extends Controller
    {
        /**
         * extends CSS classes for UIkit
         */
        public function extendCssClasses($objTemplate)
        {
            // Columnset
            if ($objTemplate->sc_type > 0) {
                
                if (!empty($objTemplate->UIkit_section)) {
                    $objTemplate->class .= ' ' . $objTemplate->UIkit_section;
                }
                
                // columnset section padding (size)
                if (!empty($objTemplate->UIkit_section)) {
                    $objTemplate->class .= ' ' . $objTemplate->UIkit_section;
                }
                
                // columnset container breakout
                if ($objTemplate->expand_UIkit_container) {
                    $objTemplate->class .= ' uk-width-viewport';
                    $objTemplate->container = $objTemplate->UIkit_container;
                }
                
                // columns valign
                if ($objTemplate->UIkit_valign === '1') {
                    $objTemplate->scclass .= ' uk-flex uk-flex-middle';
                }
                
            }
            
            // background
            if (!empty($objTemplate->UIkit_background)) {
                
                // add section with background for columnset if container expand
                if ($objTemplate->sc_type > 0) {
                    $objTemplate->class .= ' uk-background-' . $objTemplate->UIkit_background;
                    
                } // add background to content elements
                else {
                    $objTemplate->class .= ' uk-tile uk-tile-' . $objTemplate->UIkit_background . ' uk-padding-small';
                }
            }
            
            // remove tabcontrol JS
            $needle = 'system/modules/tabcontrol/assets/js/moo_tabcontrol.js';
            if (TL_MODE === 'FE' && $objTemplate->titles && ($key = array_search($needle,
                    $GLOBALS['TL_JAVASCRIPT'], true)) !== false) {
                unset($GLOBALS['TL_JAVASCRIPT'][$key]);
            }
        }
    }

    