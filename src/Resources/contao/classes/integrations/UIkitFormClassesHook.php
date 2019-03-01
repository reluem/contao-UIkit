<?php
    /**
     * Contao Open Source CMS
     *
     * Copyright (c) 2005-2019 Leo Feyer
     *
     * @author    reluem
     * @license   GNU/LGPL
     * @copyright reluem 2019
     */
    
    /**
     * Created by PhpStorm.
     * User: lucas
     * Date: 21.02.18
     * Time: 18:08
     */
    
    namespace reluem\ContaoUIkitBundle;
    
    

    /**
     * Add css fields to form elements.
     *
     *
     * @param \DataContainer $dataContainer The data container driver.
     *
     * @return void
     *
     * @SuppressWarnings(PHPMD.Superglobals)
     */
    class UIkitFormClassesHook extends FormColStart
    {
        /**
         * extends CSS classes for UIkit
         */
        
        public function generate()
        
        {
            $this->strSet = $GLOBALS['TL_CONFIG']['subcolumns'] ?: 'yaml3';
            
            if (TL_MODE === 'BE') {
                if (!$GLOBALS['TL_SUBCL'][$this->strSet]['files']['css']) {
                    $this->Template = new \BackendTemplate('be_subcolumns');
                    $this->Template->colsetTitle = '### COLUMNSET START ' . $this->fsc_type . ' <strong>' . $this->fsc_name . '</strong> ###';
                    $this->Template->hint = sprintf($GLOBALS['TL_LANG']['MSC']['contentAfter'],
                        $GLOBALS['TL_LANG']['MSC']['sc_first']);
                    return $this->Template->parse();
                }
                $GLOBALS['TL_CSS']['subcolumns'] = 'system/modules/Subcolumns/assets/be_style.css';
                $arrColset = $GLOBALS['TL_SUBCL'][$this->strSet]['sets'][$this->fsc_type];
                $strSCClass = $GLOBALS['TL_SUBCL'][$this->strSet]['scclass'];
                $blnInside = $GLOBALS['TL_SUBCL'][$this->strSet]['inside'];
                $strMiniset = '';
                if ($GLOBALS['TL_CSS']['subcolumns_set']) {
                    $strMiniset = '<div class="colsetexample ' . $strSCClass . '">';
                    foreach ($arrColset as $i => $value) {
                        $arrPresentColset = $value;
                        $strMiniset .= '<div class="' . $arrPresentColset[0] . ($i === 0 ? ' active' : '') . '">' . ($blnInside ? '<div class="' . $arrPresentColset[1] . '">' : '') . ($i + 1) . ($blnInside ? '</div>' : '') . '</div>';
                    }
                    $strMiniset .= '</div>';
                }
                $this->Template = new \BackendTemplate('be_subcolumns');
                $this->Template->colsetTitle = '### COLUMNSET START ' . $this->fsc_type . ' <strong>' . $this->fsc_name . '</strong> ###';
                $this->Template->visualSet = $strMiniset;
                $this->Template->hint = sprintf($GLOBALS['TL_LANG']['MSC']['contentAfter'],
                    $GLOBALS['TL_LANG']['MSC']['sc_first']);
                return $this->Template->parse();
            }
            
            
            $container = $GLOBALS['TL_SUBCL'][$this->strSet]['sets'][$this->fsc_type];
            $objTemplate = new \FrontendTemplate($this->strColTemplate);
            
            
            // columns valign
            $scclass = ($this->UIkit_valign ? ' uk-flex uk-flex-middle' : '');
            
            $equalize = $GLOBALS['TL_SUBCL'][$this->strSet]['equalize'] && $this->fsc_equalize ? $GLOBALS['TL_SUBCL'][$this->strSet]['equalize'] . ' ' : '';
            
            #$container = unserialize($this->sc_container);
            $objTemplate->column = $container[0][0] . ' col_1' . ' first';
            $objTemplate->inside = $container[0][1];
            $objTemplate->useInside = $GLOBALS['TL_SUBCL'][$this->strSet]['inside'];
            $objTemplate->scclass = $equalize . $GLOBALS['TL_SUBCL'][$this->strSet]['scclass'] . ' colcount_' . \count($container) . ' ' . $this->strSet . ' col-' . $this->fsc_type . ' ' . $scclass;
            $objTemplate->class = $this->UIkit_section . ($this->UIkit_background ? ' uk-background-' . $this->UIkit_background : '');
            return $objTemplate->parse();
        }
        
        
    }

