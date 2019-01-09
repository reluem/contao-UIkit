<?php
    
    use reluem\Subcolumns;
    
    
    /**
     *
     * UIKit Columnset Integration
     *
     **/
    
    $GLOBALS['TL_DCA']['tl_content']['config']['onload_callback'][] =
        array(Subcolumns::class, 'appendColumnsetIdToPalette');
    
    
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
                        ->addField(array('UIkit_container', 'UIkit_section', 'UIkit_valign'),
                            'UIkit_legend',
                            \Contao\CoreBundle\DataContainer\PaletteManipulator::POSITION_APPEND)
                        ->applyToPalette($key, 'tl_content');
                    \ContaoCommunityAlliance\MetaPalettes\MetaPalettes::removeFields('tl_content', 'colsetStart',
                        array('sc_color'));
                    
                }
            }
        }
    };
    
    $GLOBALS['TL_DCA']['tl_content']['fields']['UIkit_background'] = array
    (
        'label' => &$GLOBALS['TL_LANG']['tl_content']['UIkit_background'],
        'inputType' => 'select',
        'default' => 'default',
        'options' => array(
            'default',
            'muted',
            'primary',
            'secondary',
        ),
        'eval' => array('tl_class' => 'w50 wizard', 'includeBlankOption' => true),
        'sql' => "varchar(64) NOT NULL default ''",
    );
    
    
    $GLOBALS['TL_DCA']['tl_content']['fields']['UIkit_container'] = array
    (
        'label' => &$GLOBALS['TL_LANG']['tl_content']['UIkit_container'],
        'inputType' => 'select',
        'default' => 'uk-container uk-container-large',
        'options' => array(
            'uk-container',
            'uk-container uk-container-large',
            'uk-container uk-container-expand',
        ),
        'eval' => array('tl_class' => 'w50 wizard'),
        'sql' => "varchar(64) NOT NULL default ''",
    );
    
    
    $GLOBALS['TL_DCA']['tl_content']['fields']['UIkit_section'] = array
    (
        'label' => &$GLOBALS['TL_LANG']['tl_content']['UIkit_section'],
        'inputType' => 'select',
        'default' => 'uk-section',
        'options' => array(
            'uk-section',
            'uk-section uk-section-small',
            'uk-section uk-section-large',
            'uk-section uk-section-xlarge',
        ),
        'eval' => array('tl_class' => 'w50 wizard', 'includeBlankOption' => true),
        'sql' => "varchar(64) NOT NULL default ''",
    );
    
    $GLOBALS['TL_DCA']['tl_content']['fields']['UIkit_valign'] = array
    (
        'label' => &$GLOBALS['TL_LANG']['tl_content']['UIkit_valign'],
        'default' => 0,
        'exclude' => true,
        'inputType' => 'checkbox',
        'eval' => array('tl_class' => 'w50 m12'),
        'sql' => "char(1) NOT NULL default ''",
    );
   