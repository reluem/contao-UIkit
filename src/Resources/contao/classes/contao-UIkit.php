<?php
    
    namespace reluem;
    
    /**
     * Extension version
     */
    class contaoUIkit extends \Frontend
    {
        
        public function addScripts()
        {
            $GLOBALS['TL_JAVASCRIPT'][] = '/files/theme/UIkit/dist/js/uikit.min.js|static';
        }
    }