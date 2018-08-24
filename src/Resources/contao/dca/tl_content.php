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
            
            // if valid palette string
            if (\is_string($palette)) {
                
                //  add uk-background classes to DCA
                \Contao\CoreBundle\DataContainer\PaletteManipulator::create()
                    ->addLegend('UIkit_legend', array('template_legend', 'protected_legend'),
                        \Contao\CoreBundle\DataContainer\PaletteManipulator::POSITION_BEFORE)
                    ->addField('UIkit_background', 'UIkit_legend',
                        \Contao\CoreBundle\DataContainer\PaletteManipulator::POSITION_APPEND)
                    ->applyToPalette($key, 'tl_content');
                
                //  if palette contains sc_type (Subcolumns), add uk-container classes to DCA & remove default color field
                if ($key === 'colsetStart') {
                    \Contao\CoreBundle\DataContainer\PaletteManipulator::create()
                        ->addField('UIkit_container', 'UIkit_legend',
                            \Contao\CoreBundle\DataContainer\PaletteManipulator::POSITION_APPEND)
                        ->applyToPalette($key, 'tl_content');
                    \ContaoCommunityAlliance\MetaPalettes\MetaPalettes::removeFields('tl_content', 'colsetStart', array('sc_color'));
                    
                }
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
            'uk-container uk-container-xsmall',
            'uk-container uk-container-small',
            'uk-container uk-container-large'
        ),
        'eval' => array('tl_class' => 'w50 wizard', 'includeBlankOption' => true),
        'sql' => "varchar(64) NOT NULL default ''",
    );
    
   