<?php

    declare(strict_types=1);

/*
 * Contao UIkit Bundle
 * @copyright  Copyright (c) 2018-2019, reluem
 * @author     reluem
 * @license    http://opensource.org/licenses/lgpl-3.0.html LGPL
 * @link       http://github.com/reluem/contao-uikit
 */

namespace Reluem\ContaoUIkitBundle\ContentElement;

/**
     * Front end content element "ce_countdown".
     *
     * @author Leo Feyer <https://github.com/leofeyer>
     */
    class UIkitcountdown extends \ContentElement
    {
        /**
         * Template.
         *
         * @var string
         */
        protected $strTemplate = 'ce_countdown';

        /**
         * Compile the content element.
         */
        protected function compile()
        {
            $this->Template->countdownDate = $this->parseDate('c', $this->countdownDate);
        }
    }
