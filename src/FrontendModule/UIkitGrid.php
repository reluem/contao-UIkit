<?php

declare(strict_types=1);

/*
 * Contao UIkit Bundle
 * @copyright  Copyright (c) 2018-2020, reluem
 * @author     reluem
 * @license    http://opensource.org/licenses/lgpl-3.0.html LGPL
 * @link       http://github.com/reluem/contao-uikit
 */

namespace Reluem\ContaoUIkitBundle\FrontendModule;

use Contao\Module;
use Contao\ModuleModel;
use Contao\StringUtil;

class UIkitGrid extends Module
{
    protected $strTemplate = 'mod_uikit_grid';

    private const COLUMN_MAP = [
        'first' => 0,
        'second' => 1,
        'third' => 2,
        'fourth' => 3,
        'fifth' => 4,
    ];

    protected function compile(): void
    {
        $gridSet = $GLOBALS['TL_CONFIG']['subcolumns'] ?: 'contao-UIkit';
        $sets = $GLOBALS['TL_SUBCL'][$gridSet]['sets'] ?? [];
        $layout = $this->sc_type && isset($sets[$this->sc_type]) ? $sets[$this->sc_type] : [['uk-width-1-1']];

        $columns = [];
        foreach ($layout as $index => $definition) {
            $columns[$index] = [
                'class' => implode(' ', $definition),
                'modules' => [],
            ];
        }

        $config = StringUtil::deserialize($this->sc_modules, true);
        if (!\is_array($config)) {
            $config = [];
        }

        $models = $this->prefetchModules($config);

        foreach ($config as $entry) {
            $moduleId = (int) ($entry['module'] ?? 0);
            $columnKey = $entry['column'] ?? 'first';

            if ($moduleId < 1 || !isset(self::COLUMN_MAP[$columnKey], $columns[self::COLUMN_MAP[$columnKey]])) {
                continue;
            }

            if (!isset($models[$moduleId])) {
                continue;
            }

            $columns[self::COLUMN_MAP[$columnKey]]['modules'][] = $this->getFrontendModule($models[$moduleId], $this->inColumn);
        }

        $this->Template->columns = array_values($columns);
        $this->Template->gridClass = $GLOBALS['TL_SUBCL'][$gridSet]['scclass'] ?? 'uk-grid uk-grid-small';
    }

    /**
     * @param array<int, array<string, mixed>> $config
     *
     * @return array<int, ModuleModel>
     */
    private function prefetchModules(array $config): array
    {
        $ids = [];

        foreach ($config as $entry) {
            $moduleId = (int) ($entry['module'] ?? 0);

            if ($moduleId > 0) {
                $ids[] = $moduleId;
            }
        }

        if (!$ids) {
            return [];
        }

        $models = [];
        $collection = ModuleModel::findMultipleByIds($ids);

        if ($collection) {
            while ($collection->next()) {
                $model = $collection->current();
                $models[$model->id] = $model;
            }
        }

        return $models;
    }
}
