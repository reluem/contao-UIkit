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

    use Contao\Frontend;

    class insertTag extends Frontend
    {
        public function iconInsertTag($strTag)
        {
            // Parameter abtrennen
            $arrSplit = explode('::', $strTag);

            if ('icon' !== $arrSplit[0] && 'cache_icon' !== $arrSplit[0]) {
                //nicht unser Insert-Tag
                return false;
            }
            // Parameter angegeben?
            if (isset($arrSplit[1]) && !empty($arrSplit[1])) {
                $icon = $arrSplit[1];
                $ratio = '1';
                if (null !== $arrSplit[2]) {
                    $ratio = $arrSplit[2] . ' ';
                }
                $classes = '';
                if (null !== $arrSplit[3]) {
                    $$classes = $arrSplit[3] . ' ';
                }

                return '<span uk-icon="icon:' . $icon . '; ratio: ' . $ratio . '" class="' . $classes . '"></span>';
            }
            \System::log('Invalid icon inserttag', __METHOD__, TL_ERROR);
        }
    }
