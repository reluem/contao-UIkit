<?php
    
    
    /**
     *
     * UIKit Columnset Integration
     *
     **/
    
    $GLOBALS['TL_DCA']['tl_content']['config']['onload_callback'][] =
        array('reluem\Subcolumns', 'appendColumnsetIdToPalette');
    
    
    $GLOBALS['TL_DCA']['tl_content']['fields']['sc_type']['eval']['submitOnChange'] = true;
    
    
    /**
     *
     * UIKit Container Class Integration
     *
     **/
    
    $GLOBALS['TL_DCA']['tl_content']['config']['onload_callback'][] = function () {
        foreach ($GLOBALS['TL_DCA']['tl_content']['palettes'] as $key => $palette) {
            if (\is_string($palette) && strpos($key, "sc_") !== true) {
                \Contao\CoreBundle\DataContainer\PaletteManipulator::create()
                    ->addLegend('UIkit_legend', 'template_legend',
                        \Contao\CoreBundle\DataContainer\PaletteManipulator::POSITION_BEFORE)
                    ->addField(array('UIkit_background', 'UIkit_container'), 'UIkit_legend',
                        \Contao\CoreBundle\DataContainer\PaletteManipulator::POSITION_APPEND)
                    ->applyToPalette($key, 'tl_content');
            }
        
        }
    };
    
    $GLOBALS['TL_DCA']['tl_content']['fields']['UIkit_background'] = array
    (
        'label' => &$GLOBALS['TL_LANG']['tl_content']['UIkit_background'],
        'inputType' => 'select',
        'options' => array(
            'transparent',
            'default',
            'muted',
            'primary',
            'secondary',
        ),
        'eval' => array('tl_class' => 'w50 wizard clr', 'includeBlankOption' => true),
        'sql' => "varchar(64) NOT NULL default ''",
    );
    
    
    $GLOBALS['TL_DCA']['tl_content']['fields']['UIkit_container'] = array
    (
        'label' => &$GLOBALS['TL_LANG']['tl_content']['UIkit_container'],
        'inputType' => 'select',
        'options' => array(
            'uk-container',
            'uk-container uk-container-expand',
        ),
        'eval' => array('tl_class' => 'w50 wizard', 'includeBlankOption' => true),
        'sql' => "varchar(64) NOT NULL default ''",
    );
    
    /**
     *
     * UIKit IconPicker Integration
     *
     **/
    
    \Contao\CoreBundle\DataContainer\PaletteManipulator::create()
        ->addLegend('icon_legend', 'image_legend',
            \Contao\CoreBundle\DataContainer\PaletteManipulator::POSITION_AFTER)
        ->addField(array('fontAwesome_icon', 'fontAwesome_iconSize'), 'icon_legend',
            \Contao\CoreBundle\DataContainer\PaletteManipulator::POSITION_APPEND)
        ->applyToPalette('linkteaser', 'tl_content');
    
   