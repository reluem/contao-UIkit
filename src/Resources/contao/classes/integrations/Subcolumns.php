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
    class Subcolumns extends \Backend
    {
        
        public function appendColumnsetIdToPalette($dataContainer)
        {
            if ($dataContainer->table === 'tl_form_field') {
                
                //TODO move to DCA as well
                
                $model = \FormFieldModel::findByPk($dataContainer->id);
                if ($model->fsc_type > 0) {
                    $GLOBALS['TL_DCA']['tl_form_field']['palettes']['formcolstart'] = str_replace(
                        'fsc_color,',
                        'UIkit_background, UIkit_container',
                        $GLOBALS['TL_DCA']['tl_form_field']['palettes']['formcolstart']
                    );
                }
            } else {
                //TODO move to DCA as well
                
                $model = \ModuleModel::findByPk($dataContainer->id);
                if ($model->sc_type > 0) {
                    $GLOBALS['TL_DCA']['tl_module']['palettes']['subcolumns'] = str_replace(
                        'sc_type,',
                        'sc_type,columnset_id,',
                        $GLOBALS['TL_DCA']['tl_module']['palettes']['subcolumns']
                    );
                }
            }
        }
    }