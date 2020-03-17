<?php
    
    declare(strict_types = 1);
    
    /*
     * Contao UIkit Bundle
     * @copyright  Copyright (c) 2018-2020, reluem
     * @author     reluem
     * @license    http://opensource.org/licenses/lgpl-3.0.html LGPL
     * @link       http://github.com/reluem/contao-uikit
     */
    
    namespace Reluem\ContaoUIkitBundle\EventListener;
    
    use Contao\Frontend;
    use Psr\Log\LogLevel;
    use Contao\CoreBundle\Monolog\ContaoContext;
    
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
            \System::getContainer()
                ->get('monolog.logger.contao')
                ->log(LogLevel::WARNING, 'Invalid icon inserttag: ' . $strTag . 'on page ID', array(
                    'contao' => new ContaoContext(__CLASS__ . '::' . __FUNCTION__, TL_GENERAL
                    ),
                ));
        }
    }
