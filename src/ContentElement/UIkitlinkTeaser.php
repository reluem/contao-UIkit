<?php

    declare(strict_types=1);

/*
 * Contao UIkit Bundle
 * @copyright  Copyright (c) 2018-2020, reluem
 * @author     reluem
 * @license    http://opensource.org/licenses/lgpl-3.0.html LGPL
 * @link       http://github.com/reluem/contao-uikit
 */

namespace Reluem\ContaoUIkitBundle\ContentElement;

    /**
     * Front end content element "ce_linkteaser".
     *
     * @author Leo Feyer <https://github.com/leofeyer>
     */
    class UIkitlinkTeaser extends \ContentElement
    {
        /**
         * Template.
         *
         * @var string
         */
        protected $strTemplate = 'ce_linkteaser';

        /**
         * Generate the content element.
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
            if ($this->addImage && '' !== $this->singleSRC) {
                $objModel = \FilesModel::findByUuid($this->singleSRC);
                if (null !== $objModel && is_file(TL_ROOT . '/' . $objModel->path)) {
                    $this->singleSRC = $objModel->path;
                    $this->addImageToTemplate($this->Template, $this->arrData, null, null, $objModel);
                }
            }

            if (0 === strpos($this->url, 'mailto:')) {
                $this->url = \StringUtil::encodeEmail($this->url);
            } else {
                $this->url = ampersand($this->url);
            }

            if ($this->rel) {
                $this->Template->attribute = ' data-lightbox="' . $this->rel . '"';
            }
            if ('' === $this->linkTitle) {
                if (strpos($this->url, 'link_url')) {
                    $this->linkTitle = str_replace('link_url::', 'link_name::', $this->url);
                } else {
                    $this->linkTitle = $this->url;
                }
            }
            $this->Template->href = $this->url;
            $this->Template->link = $this->linkTitle;
            $this->Template->target = '';
            $this->Template->rel = '';
            if ($this->titleText) {
                $this->Template->linkTitle = \StringUtil::specialchars($this->titleText);
            }

            // Override the link target
            if ($this->target) {
                $this->Template->target = ' target="_blank"';
                $this->Template->rel = ' rel="noreferrer noopener"';
            }
            // Unset the title attributes in the back end (see #6258)
            if (TL_MODE === 'BE') {
                $this->Template->title = '';
                $this->Template->linkTitle = '';
            }
        }
    }
