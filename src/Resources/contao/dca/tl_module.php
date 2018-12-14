<?php
    
    $GLOBALS ['TL_DCA'] ['tl_module'] ['palettes'] ['UIkit_navbar'] = '{title_legend},name,type;{UIkit_navbar},UIkit_navbarModules;{protected_legend:hide},protected;{expert_legend:hide},guests,cssID,space';
    
    Controller::loadDataContainer('tl_content');
    
    $GLOBALS['TL_DCA']['tl_module']['fields']['UIkit_navbarModules'] = array(
        'label' => &$GLOBALS['TL_LANG']['tl_module']['UIkit_navbarModules'],
        'exclude' => true,
        'inputType' => 'multiColumnWizard',
        'eval' => array(
            'tl_class' => 'clr ctb-mcw ctb-navbar-mcw',
            'columnFields' =>
                array(
                    'module' => array
                    (
                        'label' => &$GLOBALS['TL_LANG']['tl_content']['module'],
                        'exclude' => true,
                        'inputType' => 'select',
                        'options_callback' => array('tl_content', 'getModules'),
                        'eval' => array(
                            'mandatory' => true,
                            'chosen' => true,
                            'submitOnChange' => true,
                            'style' => 'width: 300px',
                        ),
                    ),
                    'floating' =>
                        array(
                            'label' => $GLOBALS['TL_LANG']['tl_module']['UIkit_navbarModules_floating'],
                            'inputType' => 'select',
                            'options' => array('left', 'right'),
                            'reference' => &$GLOBALS['TL_LANG']['MSC'],
                            'eval' => array('style' => 'width: 150px', 'chosen' => true),
                        ),
                    
                    'cssClass' => array(
                        'label' => $GLOBALS['TL_LANG']['tl_module']['UIkit_navbarModules_cssClass'],
                        'inputType' => 'text',
                        'eval' => array('style' => 'width: 100px', 'rgxp' => 'txt'),
                    ),
                ),
        ),
        'sql' => 'blob NULL',
    );
