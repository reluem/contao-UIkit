<?php

    declare(strict_types=1);

/*
 * Contao UIkit Bundle
 * @copyright  Copyright (c) 2018-2019, reluem
 * @author     reluem
 * @license    http://opensource.org/licenses/lgpl-3.0.html LGPL
 * @link       http://github.com/reluem/contao-uikit
 */

namespace Reluem\ContaoUIkitBundle\EventListener;

/**
     * Add css fields to content elements.
     *
     *
     * @param \DataContainer $dataContainer the data container driver
     *
     *
     * @SuppressWarnings(PHPMD.Superglobals)
     */
    class UIkitClassesHook extends \Controller
    {
        /**
         * extends CSS classes for UIkit.
         *
         * @param mixed $objTemplate
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
                if ('1' === $objTemplate->UIkit_valign) {
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
            if (TL_MODE === 'FE' && $objTemplate->titles && false !== ($key = array_search($needle,
                    $GLOBALS['TL_JAVASCRIPT'], true))) {
                unset($GLOBALS['TL_JAVASCRIPT'][$key]);
            }
        }
    }
