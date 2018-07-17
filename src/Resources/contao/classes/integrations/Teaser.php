<?php
    /**
     * Created by PhpStorm.
     * User: lucas
     * Date: 21.02.18
     * Time: 18:08
     */
    
    namespace reluem;
    
    /**
     * Add column set field to the colsetStart content element.
     *
     * We need to do it dynamically because subcolumns creates its palette dynamically.
     *
     * @param \DataContainer $dataContainer The data container driver.
     *
     * @return void
     *
     * @SuppressWarnings(PHPMD.Superglobals)
     */
    
    
    class Teaser extends \Backend
    {
        
        public function appendIconToPalette($dataContainer)
        {
            if ($dataContainer->table == 'tl_content') {
                \ContaoCommunityAlliance\MetaPalettes\MetaPalettes::appendFields('tl_content',
                    'text',
                    'title', array('fontAwesomeIcon'));
            }
            
        }
    }