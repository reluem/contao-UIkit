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
    $GLOBALS['TL_DCA']['tl_form_field']['fields']['fsc_type']['eval']['submitOnChange'] = true;

    PaletteManipulator::create()
        // remove the field "custom_field" from the "name_legend"
        ->removeField('fsc_color', 'colsettings_legend')
        ->removeField('fsc_gapuse', 'colsettings_legend')
        ->removeField('fsc_equalize', 'colsettings_legend')

        // again, the change is registered in the PaletteManipulator
        // but it still has to be applied to the globals:
        ->applyToPalette('formcolstart', 'tl_form_field');
