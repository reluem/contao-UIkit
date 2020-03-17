<?php

/*
 * Contao UIkit Bundle
 * @copyright  Copyright (c) 2018-2020, reluem
 * @author     reluem
 * @license    http://opensource.org/licenses/lgpl-3.0.html LGPL
 * @link       http://github.com/reluem/contao-uikit
 */

use Contao\CoreBundle\DataContainer\PaletteManipulator;

/*
     *
     * UIKit Columnset Integration
     *
     **/

    $GLOBALS['TL_DCA']['tl_content']['fields']['sc_type']['eval']['submitOnChange'] = true;
    $GLOBALS['TL_DCA']['tl_content']['fields']['sc_equalize']['eval']['submitOnChange'] = true;

    /*
     *
     * UIKit Container Class Integration
     *
     **/

    $GLOBALS['TL_DCA']['tl_content']['config']['onload_callback'][] = function () {
        foreach ($GLOBALS['TL_DCA']['tl_content']['palettes'] as $key => $palette) {
            // if valid palette string
            if (is_string($palette)) {
                //  add uk-background classes to DCA
                PaletteManipulator::create()
                    ->addLegend('UIkit_legend', ['template_legend', 'protected_legend'],
                        PaletteManipulator::POSITION_BEFORE)
                    ->addField('UIkit_background', 'UIkit_legend',
                        PaletteManipulator::POSITION_APPEND)
                    ->applyToPalette($key, 'tl_content');

                //  if palette contains sc_type (Subcolumns), add uk-container classes to DCA & remove default color field
                if ('colsetStart' === $key) {
                    PaletteManipulator::create()
                        ->addField(['UIkit_section', 'expand_UIkit_container'],
                            'UIkit_legend',
                            PaletteManipulator::POSITION_APPEND)
                        ->applyToPalette($key, 'tl_content');
                    unset($GLOBALS['TL_DCA']['tl_content']['fields']['sc_color']);
                }
            }
        }
    };
    $GLOBALS['TL_DCA']['tl_content']['subpalettes']['sc_equalize'] = 'UIkit_valign';
    $GLOBALS['TL_DCA']['tl_content']['subpalettes']['expand_UIkit_container'] = 'UIkit_container';
    $GLOBALS['TL_DCA']['tl_content']['palettes']['__selector__'][] = 'expand_UIkit_container';
    $GLOBALS['TL_DCA']['tl_content']['palettes']['__selector__'][] = 'sc_equalize';
    $GLOBALS['TL_DCA']['tl_content']['fields']['UIkit_background'] =
        [
            'label' => &$GLOBALS['TL_LANG']['tl_content']['UIkit_background'],
            'inputType' => 'select',
            'default' => 'default',
            'options' => [
                'default',
                'muted',
                'primary',
                'secondary',
            ],
            'eval' => ['tl_class' => 'w50 wizard', 'includeBlankOption' => true],
            'sql' => "varchar(64) NOT NULL default ''",
        ];

    $GLOBALS['TL_DCA']['tl_content']['fields']['expand_UIkit_container'] = [
        'label' => &$GLOBALS['TL_LANG']['tl_content']['expand_UIkit_container'],
        'exclude' => true,
        'inputType' => 'checkbox',
        'eval' => ['submitOnChange' => true, 'tl_class' => 'w50 m12 clr'],
        'sql' => "char(1) NOT NULL default ''",
    ];

    $GLOBALS['TL_DCA']['tl_content']['fields']['UIkit_container'] =
        [
            'label' => &$GLOBALS['TL_LANG']['tl_content']['UIkit_container'],
            'inputType' => 'select',
            'default' => 'uk-container',
            'options' => [
                'uk-container',
                'uk-container uk-container-large',
                'uk-container uk-container-expand',
            ],
            'eval' => ['tl_class' => 'w50', 'includeBlankOption' => true],
            'sql' => "varchar(64) NOT NULL default ''",
        ];

    $GLOBALS['TL_DCA']['tl_content']['fields']['UIkit_section'] =
        [
            'label' => &$GLOBALS['TL_LANG']['tl_content']['UIkit_section'],
            'inputType' => 'select',
            'default' => 'uk-section',
            'options' => [
                'uk-section',
                'uk-section uk-section-small',
                'uk-section uk-section-large',
                'uk-section uk-section-xlarge',
            ],
            'eval' => ['tl_class' => 'w50 wizard', 'includeBlankOption' => true],
            'sql' => "varchar(64) NOT NULL default ''",
        ];

    $GLOBALS['TL_DCA']['tl_content']['fields']['UIkit_valign'] =
        [
            'label' => &$GLOBALS['TL_LANG']['tl_content']['UIkit_valign'],
            'default' => 0,
            'exclude' => true,
            'inputType' => 'checkbox',
            'eval' => ['tl_class' => 'w50 m12'],
            'sql' => "char(1) NOT NULL default ''",
        ];

    /*
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
                        'tl_class' => 'w50 wizard',
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
                'target' => [
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

    /*
     *
     * UIkit HeroImage
     *
     */

    $GLOBALS['TL_DCA']['tl_content']['subpalettes']['UIkit_height_uk-height-viewport'] = 'UIkit_viewportHeight';
    $GLOBALS['TL_DCA']['tl_content']['palettes']['__selector__'][] = 'UIkit_height';

    $GLOBALS['TL_DCA']['tl_content']['palettes']['heroimage'] = 'name,type,headline;{image_legend:hide},addImage;{text_legend},text;{UIkit_button_legend},addUIkit_button;{hero_image_legend}, UIkit_height,UIkit_inverse;{protected_legend:hide},protected;{expert_legend:hide},guests,cssID,space;{invisible_legend:hide},invisible,start,stop';

    $GLOBALS['TL_DCA']['tl_content']['fields']['UIkit_height'] = [
        'label' => &$GLOBALS['TL_LANG']['tl_content']['UIkit_height'],
        'exclude' => true,
        'inputType' => 'select',
        'options' => ['uk-height-small', 'uk-height-medium', 'uk-height-large', 'uk-height-viewport'],
        'eval' => ['submitOnChange' => true, 'tl_class' => 'w50', 'includeBlankOption' => true],
        'sql' => "varchar(255) NOT NULL default ''",
    ];

    $GLOBALS['TL_DCA']['tl_content']['fields']['UIkit_viewportHeight'] = [
        'label' => &$GLOBALS['TL_LANG']['tl_content']['UIkit_viewportHeight'],
        'exclude' => true,
        'search' => true,
        'inputType' => 'text',
        'default' => 'offset-top: true; min-height: 400',
        'eval' => ['tl_class' => 'w50'],
        'sql' => "varchar(255) NOT NULL default ''",
    ];
    $GLOBALS['TL_DCA']['tl_content']['fields']['UIkit_inverse'] = [
        'label' => &$GLOBALS['TL_LANG']['tl_content']['UIkit_inverse'],
        'exclude' => true,
        'search' => true,
        'inputType' => 'select',
        'options' => ['uk-light', 'uk-dark'],
        'eval' => ['tl_class' => 'w50 wizard'],
        'sql' => "varchar(255) NOT NULL default ''",
    ];

    /*
     *
     * LinkTeaser
     *
     */

    $GLOBALS['TL_DCA']['tl_content']['palettes']['linkteaser'] = '{type_legend},type,headline;{text_legend},text;{link_legend},url,target,linkTitle,titleText;{protected_legend:hide},protected;{expert_legend:hide},guests,cssID;{invisible_legend:hide},invisible,start,stop';

    /*
     *
     * Countdown
     *
     */
    $GLOBALS['TL_DCA']['tl_content']['palettes']['countdown'] = '{type_legend},type,headline;{countdown_legend},countdownDate, showLabels;{protected_legend:hide},protected;{expert_legend:hide},guests,cssID;{invisible_legend:hide},invisible,start,stop';

    $GLOBALS['TL_DCA']['tl_content']['fields']['countdownDate'] = [
        'label' => &$GLOBALS['TL_LANG']['tl_content']['countdownDate'],
        'exclude' => true,
        'inputType' => 'text',
        'eval' => ['rgxp' => 'datim', 'datepicker' => true, 'tl_class' => 'w50 wizard'],
        'sql' => "varchar(10) NOT NULL default ''",
    ];

    $GLOBALS['TL_DCA']['tl_content']['fields']['showLabels'] = [
        'label' => &$GLOBALS['TL_LANG']['tl_content']['showLabels'],
        'exclude' => true,
        'inputType' => 'checkbox',
        'eval' => ['tl_class' => 'w50 m12'],
        'sql' => "char(1) NOT NULL default ''",
    ];
