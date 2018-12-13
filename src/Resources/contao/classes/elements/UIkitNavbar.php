<?php
    /**
     * Contao Open Source CMS
     *
     * Copyright (c) 2005-2015 Leo Feyer
     *
     * @license LGPL-3.0+
     */
    declare(strict_types = 1);
    
    namespace reluem;
    
    
    use Contao\Module;
    use Contao\ModuleModel;
    use Contao\StringUtil;
    
    
    /**
     * Front end module "Navbar" for UIkit
     *
     * @author Leo Feyer <https://github.com/leofeyer>
     */
    class UIkitNavbar extends Module
    {
        /**
         * Template
         * @var string
         */
        protected $strTemplate = 'mod_UIkitnavbar';
        
        
        /**
         * Compile the navbar.
         *
         * @return void
         */
        protected function compile()
        {
            $config = StringUtil::deserialize($this->UIkit_navbarModules, true);
            $modules = [];
            $models = $this->prefetchModules($config);
            foreach ($config as $module) {
                $id = $module['module'];
                if ($id !== '' && !$module['inactive'] && array_key_exists($id, $models)) {
                    $modules[] = $this->generateModule($module, $models[$id]);
                }
            }
            $this->Template->modules = $modules;
        }
        //TODO group modules by floating. maybe in generatoreModule function
        /**
         * Generate a frontend module.
         *
         * @param array $module Module configuration.
         * @param \ModuleModel $model Module model.
         *
         * @return array
         */
        protected function generateModule($module, \ModuleModel $model)
        {
            $class = $module['cssClass'];
            if ($module['floating']) {
                if ($class !== '') {
                    $class .= ' ';
                }
                $class .= 'uk-navbar-' . $module['floating'];
            }
            
            return [
                'type' => 'module',
                'module' => $this->getFrontendModule($model),
                'id' => $module['module'],
                'class' => $class,
            ];
        }
        
        
        /**
         * Extract module ids from navbar config.
         *
         * @param array $config The navbar config.
         *
         * @return array
         */
        protected function extractModuleIds($config)
        {
            $ids = [];
            foreach ($config as $index => $module) {
                if ($module['inactive']) {
                    continue;
                }
                $ids[$index] = (int)$module['module'];
            }
            return $ids;
        }
        
        /**
         * Prefetch modules.
         *
         * @param array $config Navbar config.
         *
         * @return array
         */
        protected function prefetchModules($config)
        {
            $ids = $this->extractModuleIds($config);
            $models = [];
            if ($ids) {
                // prefetch modules, so only 1 query is required
                $ids = implode(',', $ids);
                $collection = ModuleModel::findBy(['tl_module.id IN(' . $ids . ')'], []);
                if ($collection) {
                    while ($collection->next()) {
                        $model = $collection->current();
                        $models[$model->id] = $model;
                    }
                }
            }
            return $models;
        }
    }