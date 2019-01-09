<?php
    /**
     * Contao Open Source CMS
     *
     * Copyright (c) 2005-2015 Leo Feyer
     *
     * @license LGPL-3.0+
     */
    
    namespace reluem;
    
    /**
     * Front end content element "ce_heroimage".
     *
     * @author Leo Feyer <https://github.com/leofeyer>
     */
    class UIkitheroImage extends \ContentElement
    {
        /**
         * Template
         * @var string
         */
        protected $strTemplate = 'ce_heroimage';
        
        /**
         * Compile the content element
         */
        protected function compile()
        {
            $this->text = \StringUtil::toHtml5($this->text);
            // Add the static files URL to images
            if ($staticUrl = \System::getContainer()->get('contao.assets.files_context')->getStaticUrl()) {
                $path = \Config::get('uploadPath') . '/';
                $this->text = str_replace(' src="' . $path, ' src="' . $staticUrl . $path, $this->text);
            }
            $this->Template->text = \StringUtil::encodeEmail($this->text);
            $this->Template->addImage = false;
            // Add an image
            if ($this->addImage && $this->singleSRC != '') {
                $objModel = \FilesModel::findByUuid($this->singleSRC);
                if ($objModel !== null && is_file(TL_ROOT . '/' . $objModel->path)) {
                    $this->singleSRC = $objModel->path;
                    $this->addImageToTemplate($this->Template, $this->arrData, null, null, $objModel);
                }
            }
        }
    }