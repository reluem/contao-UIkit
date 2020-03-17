<?php

/*
 * Contao UIkit Bundle
 * @copyright  Copyright (c) 2018-2020, reluem
 * @author     reluem
 * @license    http://opensource.org/licenses/lgpl-3.0.html LGPL
 * @link       http://github.com/reluem/contao-uikit
 */

use Contao\Controller;

    $GLOBALS['TL_DCA']['tl_module']['palettes']['UIkit_navbar'] = '{title_legend},name,type;{UIkit_navbar},UIkit_navbarModules;{protected_legend:hide},protected;{expert_legend:hide},guests,cssID,space';

    Controller::loadDataContainer('tl_content');

    $GLOBALS['TL_DCA']['tl_module']['fields']['UIkit_navbarModules'] = [
        'label' => &$GLOBALS['TL_LANG']['tl_module']['UIkit_navbarModules'],
        'exclude' => true,
        'inputType' => 'multiColumnWizard',
        'eval' => [
            'tl_class' => 'clr ctb-mcw ctb-navbar-mcw',
            'columnFields' => [
                    'module' => [
                        'label' => &$GLOBALS['TL_LANG']['tl_content']['module'],
                        'exclude' => true,
                        'inputType' => 'select',
                        'options_callback' => ['tl_content', 'getModules'],
                        'eval' => [
                            'mandatory' => true,
                            'chosen' => true,
                            'submitOnChange' => true,
                            'style' => 'width: 300px',
                        ],
                    ],
                    'floating' => [
                            'label' => $GLOBALS['TL_LANG']['tl_module']['UIkit_navbarModules_floating'],
                            'inputType' => 'select',
                            'options' => ['left', 'right'],
                            'reference' => &$GLOBALS['TL_LANG']['MSC'],
                            'eval' => ['style' => 'width: 150px', 'chosen' => true],
                        ],

                    'cssClass' => [
                        'label' => $GLOBALS['TL_LANG']['tl_module']['UIkit_navbarModules_cssClass'],
                        'inputType' => 'text',
                        'eval' => ['style' => 'width: 100px', 'rgxp' => 'txt'],
                    ],
                ],
        ],
        'sql' => 'blob NULL',
    ];
