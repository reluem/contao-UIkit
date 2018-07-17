<?php
    
    
    \ContaoCommunityAlliance\MetaPalettes\MetaPalettes::appendFields('tl_module', 'navigation', 'template', array('UIkit_navbarModules'));
    
    Controller::loadDataContainer('tl_content');
    
    $GLOBALS['TL_DCA']['tl_module']['fields']['UIkit_navbarModules'] = [
        'label' => &$GLOBALS['TL_LANG']['tl_module']['UIkit_navbarModules'],
        'exclude' => true,
        'inputType' => 'multiColumnWizard',
        'eval' => [
            'tl_class' => 'clr ctb-mcw ctb-navbar-mcw',
            'columnFields' =>
                [
                    'module' =>
                        [
                            'label' => &$GLOBALS['TL_LANG']['tl_module']['module'],
                            'exclude' => true,
                            'inputType' => 'select',
                            'options_callback' => ['tl_content', 'getModules'],
                            'eval' => [
                                'mandatory' => false,
                                'style' => 'width: 300px',
                                'chosen' => true,
                                'submitOnChange' => true,
                            ],
                            'wizard' =>
                                [
                                    ['tl_content', 'editModule'],
                                ],
                        ],
                    'floating' =>
                        [
                            'label' => $GLOBALS['TL_LANG']['tl_module']['UIkit_navbarModules_floating'],
                            'inputType' => 'select',
                            'options' => ['left', 'right'],
                            'reference' => &$GLOBALS['TL_LANG']['MSC'],
                            'eval' => ['style' => 'width: 150px', 'includeBlankOption' => true, 'chosen' => true],
                        ],
                    
                    'cssClass' => [
                        'label' => $GLOBALS['TL_LANG']['tl_module']['UIkit_navbarModules_cssClass'],
                        'inputType' => 'text',
                        'eval' => ['style' => 'width: 100px','rgxp' => 'txt'],
                    ],
                ],
        ],
        'sql' => 'blob NULL',
    ];
