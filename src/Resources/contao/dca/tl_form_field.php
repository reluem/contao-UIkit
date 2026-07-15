<?php

/*
 * Contao UIkit Bundle
 * @copyright  Copyright (c) 2018-2020, reluem
 * @author     reluem
 * @license    http://opensource.org/licenses/lgpl-3.0.html LGPL
 * @link       http://github.com/reluem/contao-uikit
 */

use Contao\CoreBundle\DataContainer\PaletteManipulator;

if (isset($GLOBALS['TL_DCA']['tl_form_field']['palettes']['formcolstart'])) {
    $GLOBALS['TL_DCA']['tl_form_field']['fields']['fsc_type']['eval']['submitOnChange'] = true;

    PaletteManipulator::create()
        ->removeField('fsc_color', 'colsettings_legend')
        ->removeField('fsc_gapuse', 'colsettings_legend')
        ->removeField('fsc_equalize', 'colsettings_legend')
        ->applyToPalette('formcolstart', 'tl_form_field');
}
