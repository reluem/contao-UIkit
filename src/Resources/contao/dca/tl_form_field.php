<?php

/*
 * Contao UIkit Bundle
 * @copyright  Copyright (c) 2018-2019, reluem
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
    $GLOBALS['TL_DCA']['tl_form_field']['fields']['fsc_type']['eval']['submitOnChange'] = true;
    $GLOBALS['TL_DCA']['tl_form_field']['fields']['fsc_equalize']['eval']['submitOnChange'] = true;

    /*
     *
     * UIKit Container Class Integrations
     *
     **/

     PaletteManipulator::create()
                    ->addLegend('UIkit_legend', ['template_legend', 'expert_legend'],
                        PaletteManipulator::POSITION_BEFORE)
                    ->addField(['UIkit_background', 'UIkit_section'],
                        'UIkit_legend',
                        PaletteManipulator::POSITION_APPEND)
                    ->applyToPalette('formcolstart', 'tl_form_field');
                unset($GLOBALS['TL_DCA']['tl_form_field']['fields']['fsc_color'], $GLOBALS['TL_DCA']['tl_form_field']['fields']['fsc_gapuse']);

    $GLOBALS['TL_DCA']['tl_form_field']['subpalettes']['fsc_equalize'] = 'UIkit_valign';
    $GLOBALS['TL_DCA']['tl_form_field']['palettes']['__selector__'][] = 'fsc_equalize';

    $GLOBALS['TL_DCA']['tl_form_field']['fields']['UIkit_background'] =
        [
            'label' => &$GLOBALS['TL_LANG']['tl_form_field']['UIkit_background'],
            'inputType' => 'select',
            'default' => 'default',
            'options' => [
                'default',
                'muted',
                'primary',
                'secondary',
            ],
            'eval' => ['tl_class' => 'w50 wizard'],
            'sql' => "varchar(64) NOT NULL default ''",
        ];

    $GLOBALS['TL_DCA']['tl_form_field']['fields']['UIkit_section'] =
        [
            'label' => &$GLOBALS['TL_LANG']['tl_form_field']['UIkit_section'],
            'inputType' => 'select',
            'options' => [
                'uk-padding',
                'uk-padding-small',
                'uk-padding-large',
            ],
            'eval' => ['tl_class' => 'w50 wizard', 'includeBlankOption' => true],
            'sql' => "varchar(64) NOT NULL default ''",
        ];

    $GLOBALS['TL_DCA']['tl_form_field']['fields']['UIkit_valign'] =
        [
            'label' => &$GLOBALS['TL_LANG']['tl_form_field']['UIkit_valign'],
            'default' => 0,
            'exclude' => true,
            'inputType' => 'checkbox',
            'eval' => ['tl_class' => 'w50'],
            'sql' => "char(1) NOT NULL default ''",
        ];
