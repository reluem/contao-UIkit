<?php
    
    use Contao\CoreBundle\DataContainer\PaletteManipulator;
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
                PaletteManipulator::create()
                    ->addLegend('UIkit_legend', array('template_legend', 'protected_legend'),
                        PaletteManipulator::POSITION_BEFORE)
                    ->addField('UIkit_background', 'UIkit_legend',
                        PaletteManipulator::POSITION_APPEND)
                    ->applyToPalette($key, 'tl_content');
                
                //  if palette contains sc_type (Subcolumns), add uk-container classes to DCA & remove default color field
                if ($key === 'colsetStart') {
                    PaletteManipulator::create()
                        ->addField(array('UIkit_container', 'UIkit_section', 'UIkit_valign'),
                            'UIkit_legend',
                            PaletteManipulator::POSITION_APPEND)
                        ->applyToPalette($key, 'tl_content');
                    
                    unset($GLOBALS['TL_DCA']['tl_content']['fields']['sc_color']);
                    
                    
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
    
    
    /**
     *  UIkit Button
     */
    
    $GLOBALS['TL_DCA']['tl_content']['subpalettes']['addUIkit_button'] = 'UIkit_button';
    $GLOBALS['TL_DCA']['tl_content']['palettes']['__selector__'][] = 'addUIkit_button';
    
    $GLOBALS['TL_DCA']['tl_content']['fields']['addUIkit_button'] = [
        'label' => &$GLOBALS['TL_LANG']['tl_content']['addUIkit_button'],
        'exclude' => true,
        'inputType' => 'checkbox',
        'eval' => ['submitOnChange' => true],
        'sql' => "char(1) NOT NULL default ''",
    ];
    
    $GLOBALS['TL_DCA']['tl_content']['fields']['UIkit_button'] = [
        'label' => &$GLOBALS['TL_LANG']['tl_content']['UIkit_button'],
        'exclude' => true,
        'inputType' => 'multiColumnWizard',
        'eval' => [
            'columnFields' => [
                'url' => [
                    'label' => &$GLOBALS['TL_LANG']['MSC']['url'],
                    'exclude' => true,
                    'search' => true,
                    'inputType' => 'text',
                    'eval' => [
                        'mandatory' => true,
                        'rgxp' => 'url',
                        'decodeEntities' => true,
                        'maxlength' => 255,
                        'dcaPicker' => true,
                        'addWizardClass' => false,
                        'tl_class' => 'w50',
                    ],
                
                ],
                'linkTitle' => [
                    'label' => &$GLOBALS['TL_LANG']['tl_content']['linkTitle'],
                    'exclude' => true,
                    'inputType' => 'text',
                    'eval' => ['tl_class' => 'w50'],
                ],
                'linkStyle' => [
                    'label' => &$GLOBALS['TL_LANG']['tl_content']['linkStyle'],
                    'exclude' => true,
                    'inputType' => 'select',
                    'options' => [
                        'uk-button-default',
                        'uk-button-primary',
                        'uk-button-secondary',
                        'uk-button-danger',
                        'uk-button-text',
                        'uk-button-link',
                    ],
                ],
                'tooltip' => [
                    'label' => &$GLOBALS['TL_LANG']['tl_content']['tooltip'],
                    'exclude' => true,
                    'inputType' => 'text',
                    'eval' => ['tl_class' => 'w50'],
                ],
                'target' =>
                    [
                        'label' => &$GLOBALS['TL_LANG']['MSC']['target'],
                        'exclude' => true,
                        'inputType' => 'checkbox',
                        'eval' => ['tl_class' => 'w50 m12'],
                    ],
            ],
            'maxCount' => 2,
        ],
        'sql' => 'blob NULL',
    ];
    
    /**
     *  UIkit HeroImage
     */
    
    $GLOBALS['TL_DCA']['tl_content']['palettes']['heroimage'] = 'name,type,headline;{image_legend:hide},addImage;{text_legend},text;{UIkit_button_legend},addUIkit_button;{hero_image_legend}, UIkit_viewportHeight,UIkit_inverse;{protected_legend:hide},protected;{expert_legend:hide},guests,cssID,space;{invisible_legend:hide},invisible,start,stop';
    
    
    $GLOBALS['TL_DCA']['tl_content']['fields']['UIkit_viewportHeight'] = array(
        'label' => &$GLOBALS['TL_LANG']['tl_content']['UIkit_viewportHeight'],
        'exclude' => true,
        'search' => true,
        'inputType' => 'text',
        'default' => 'offset-top: true; min-height: 400',
        'eval' => array('tl_class' => 'w50'),
        'sql' => "varchar(255) NOT NULL default ''",
    );
    $GLOBALS['TL_DCA']['tl_content']['fields']['UIkit_inverse'] = array(
        'label' => &$GLOBALS['TL_LANG']['tl_content']['UIkit_inverse'],
        'exclude' => true,
        'search' => true,
        'inputType' => 'select',
        'options' => array('uk-light', 'uk-dark'),
        'eval' => array('tl_class' => 'w50 wizard'),
        'sql' => "varchar(255) NOT NULL default ''",
    );
    
    
    
    