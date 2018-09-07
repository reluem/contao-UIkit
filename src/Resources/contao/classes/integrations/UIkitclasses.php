<?php
    /**
     * Created by PhpStorm.
     * User: lucas
     * Date: 21.02.18
     * Time: 18:08
     */
    
    namespace reluem;
    
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
    class extendCssClassesHooks extends \Controller
    {
        /**
         * extends CSS classes for UIkit
         */
        public function extendCssClasses($objTemplate)
        {
            
            if (isset($objTemplate->UIkit_background) && $objTemplate->UIkit_background != '') {
                
                // add section with background for columnset
                if ($objTemplate->sc_type > 0) {
                    $objTemplate->UIkit_background = "uk-section uk-background-" . $objTemplate->UIkit_background;
                    
                } // add background to content elements
                else {
                    $objTemplate->class = "uk-tile uk-tile-" . $objTemplate->UIkit_background . ' uk-padding-small ' . $objTemplate->class;
                }
            };
            
        }
        
//        /**
//         * manipulate the given form to add advanced css to the existing css class
//         */
//        public function extendFormCssClasses(Widget $objWidget, $strForm, $arrForm)
//        {
//            if (isset($objTemplate->UIkit_background) && $objTemplate->UIkit_background != '') {
//                $objWidget->class .= "uk-tile uk-tile-" . $objWidget->UIkit_background . ' uk-tile-small ' . $objWidget->class;
//                return $objWidget;
//            }
//        }
        
    }
    