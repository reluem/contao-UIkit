<?php
    
    namespace reluem;
    
    /**
     * Extension version
     */
    class contaoUIkit extends \Frontend
    {
        
        public function addScripts()
        {
            $GLOBALS['TL_BODY'][] = '<script type="text/javascript" src="/files/theme/UIkit/dist/js/uikit.min.js" defer async />';
        }
    }