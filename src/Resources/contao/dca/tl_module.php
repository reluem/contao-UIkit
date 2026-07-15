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

    $GLOBALS['TL_DCA']['tl_module']['palettes']['uikit_grid'] = '{title_legend},name,headline,type;{uikit_grid_legend},sc_type,sc_modules;{protected_legend:hide},protected;{expert_legend:hide},guests,cssID,space';

    $GLOBALS['TL_DCA']['tl_module']['fields']['sc_type'] = [
        'label' => &$GLOBALS['TL_LANG']['tl_module']['sc_type'],
        'exclude' => true,
        'inputType' => 'select',
        'options_callback' => ['tl_module_uikit_grid', 'getAllTypes'],
        'eval' => ['submitOnChange' => true, 'tl_class' => 'w50'],
        'sql' => "varchar(255) NOT NULL default ''",
    ];

    $GLOBALS['TL_DCA']['tl_module']['fields']['sc_modules'] = [
        'label' => &$GLOBALS['TL_LANG']['tl_module']['sc_modules'],
        'exclude' => true,
        'inputType' => 'multiColumnWizard',
        'eval' => [
            'tl_class' => 'clr',
            'columnFields' => [
                'module' => [
                    'label' => &$GLOBALS['TL_LANG']['tl_module']['module'],
                    'exclude' => true,
                    'inputType' => 'select',
                    'options_callback' => ['tl_module_uikit_grid', 'getAllModules'],
                    'eval' => [
                        'mandatory' => true,
                        'chosen' => true,
                        'submitOnChange' => true,
                        'style' => 'width: 300px',
                    ],
                ],
                'column' => [
                    'label' => &$GLOBALS['TL_LANG']['tl_module']['column'],
                    'exclude' => true,
                    'inputType' => 'select',
                    'options_callback' => ['tl_module_uikit_grid', 'getColumns'],
                    'eval' => ['chosen' => true, 'style' => 'width: 150px'],
                ],
            ],
        ],
        'sql' => 'blob NULL',
    ];

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
                            'label' => &$GLOBALS['TL_LANG']['tl_module']['UIkit_navbarModules_floating'],
                            'inputType' => 'select',
                            'options' => ['left', 'right'],
                            'reference' => &$GLOBALS['TL_LANG']['MSC'],
                            'eval' => ['style' => 'width: 150px', 'chosen' => true],
                        ],

                    'cssClass' => [
                        'label' => &$GLOBALS['TL_LANG']['tl_module']['UIkit_navbarModules_cssClass'],
                        'inputType' => 'text',
                        'eval' => ['style' => 'width: 100px', 'rgxp' => 'txt'],
                    ],
                ],
        ],
        'sql' => 'blob NULL',
    ];

class tl_module_uikit_grid extends Backend
{
    public function getAllTypes(): array
    {
        $gridSet = $GLOBALS['TL_CONFIG']['subcolumns'] ?: 'contao-UIkit';

        return array_keys($GLOBALS['TL_SUBCL'][$gridSet]['sets'] ?? []);
    }

    public function getAllModules(): array
    {
        $modules = [];
        $id = (int) Input::get('id');
        $collection = Database::getInstance()
            ->prepare('SELECT id, name FROM tl_module WHERE pid=(SELECT pid FROM tl_module WHERE id=?) AND id!=? ORDER BY name')
            ->execute($id, $id);

        while ($collection->next()) {
            $modules[$collection->id] = $collection->name . ' (ID ' . $collection->id . ')';
        }

        return $modules;
    }

    public function getColumns(): array
    {
        $id = (int) Input::get('id');
        $type = Database::getInstance()
            ->prepare('SELECT sc_type FROM tl_module WHERE id=?')
            ->execute($id)
            ->sc_type;

        $count = \count(explode('x', (string) $type));
        $columns = [];

        if ($count >= 1) {
            $columns['first'] = $GLOBALS['TL_LANG']['MSC']['sc_first'];
        }
        if ($count >= 2) {
            $columns['second'] = $GLOBALS['TL_LANG']['MSC']['sc_second'];
        }
        if ($count >= 3) {
            $columns['third'] = $GLOBALS['TL_LANG']['MSC']['sc_third'];
        }
        if ($count >= 4) {
            $columns['fourth'] = $GLOBALS['TL_LANG']['MSC']['sc_fourth'];
        }
        if ($count >= 5) {
            $columns['fifth'] = $GLOBALS['TL_LANG']['MSC']['sc_fifth'];
        }

        return $columns;
    }
}
