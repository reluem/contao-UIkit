<?php
    /**
     * Contao Open Source CMS
     *
     * Copyright (c) 2005-2015 Leo Feyer
     *
     * @license LGPL-3.0+
     */
    
    namespace reluem;

    use Contao\ModuleNavigation;

    /**
     * Front end module "Navbar" for UIkit
     *
     * @author Leo Feyer <https://github.com/leofeyer>
     */
    
    class ModuleNavbar extends ModuleNavigation
    {
        /**
         * Template
         * @var string
         */
        protected $strTemplate = 'mod_navigation';
        
        
            /**
         * Compile the navbar.
         *
         * @return array
         */
        protected function compile()
        {
            $buffer = parent::compile();
    
            $config = \StringUtil::deserialize($this->UIkit_navbarModules, true);
            $modules = array();
            $models = $this->prefetchModules($config);
            foreach ($config as $module) {
                $id = $module['module'];
                if ($id != '' && !$module['inactive'] && array_key_exists($id, $models)) {
                    $modules[] = $this->generateModule($module, $models[$id]);
                }
            }
            $this->Template->modules = $modules;
            return $buffer;
        }
        
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
                if ($class != '') {
                    $class .= ' ';
                }
                $class .= 'uk-navbar-' . $module['floating'];
            }
            
            $rendered = $this->getFrontendModule($model);
            return array(
                'type' => 'module',
                'module' => $rendered,
                'id' => $module['module'],
                'class' => $class,
            );
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
            $ids = array();
            foreach ($config as $index => $module) {
                if ($module['inactive']) {
                    continue;
                }
                $ids[$index] = intval($module['module']);
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
            $models = array();
            if ($ids) {
                // prefetch modules, so only 1 query is required
                $ids = implode(',', $ids);
                $collection = \ModuleModel::findBy(array('tl_module.id IN(' . $ids . ')'), array());
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