<?php
    
    
    /**
     *
     * UIKit Columnset Integration
     *
     **/
    
    $GLOBALS['TL_DCA']['tl_content']['config']['onload_callback'][] =
        array('reluem\Subcolumns', 'appendColumnsetIdToPalette');
    
    
    $GLOBALS['TL_DCA']['tl_content']['fields']['sc_type']['eval']['submitOnChange'] = true;
    
    
    /**
     *
     * UIKit Container Class Integration
     *
     **/
    
    $GLOBALS['TL_DCA']['tl_content']['config']['onload_callback'][] = function () {
        foreach ($GLOBALS['TL_DCA']['tl_content']['palettes'] as $key => $palette) {
            if (\is_string($palette) && strpos($key, "sc_") !== true) {
                \Contao\CoreBundle\DataContainer\PaletteManipulator::create()
                    ->addLegend('UIkit_legend', 'template_legend',
                        \Contao\CoreBundle\DataContainer\PaletteManipulator::POSITION_BEFORE)
                    ->addField(array('UIkit_background', 'UIkit_container'), 'UIkit_legend',
                        \Contao\CoreBundle\DataContainer\PaletteManipulator::POSITION_APPEND)
                    ->applyToPalette($key, 'tl_content');
            }
        
        }
    };
    
    $GLOBALS['TL_DCA']['tl_content']['fields']['UIkit_background'] = array
    (
        'label' => &$GLOBALS['TL_LANG']['tl_content']['UIkit_background'],
        'inputType' => 'select',
        'options' => array(
            'transparent',
            'default',
            'muted',
            'primary',
            'secondary',
        ),
        'eval' => array('tl_class' => 'w50 wizard clr', 'includeBlankOption' => true),
        'sql' => "varchar(64) NOT NULL default ''",
    );
    
    
    $GLOBALS['TL_DCA']['tl_content']['fields']['UIkit_container'] = array
    (
        'label' => &$GLOBALS['TL_LANG']['tl_content']['UIkit_container'],
        'inputType' => 'select',
        'options' => array(
            'uk-container',
            'uk-container uk-container-expand',
        ),
        'eval' => array('tl_class' => 'w50 wizard', 'includeBlankOption' => true),
        'sql' => "varchar(64) NOT NULL default ''",
    );
    
    /**
     *
     * UIKit IconPicker Integration
     *
     **/
    
    \Contao\CoreBundle\DataContainer\PaletteManipulator::create()
        ->addLegend('icon_legend', 'image_legend',
            \Contao\CoreBundle\DataContainer\PaletteManipulator::POSITION_AFTER)
        ->addField(array('fontAwesome_icon', 'fontAwesome_iconSize'), 'icon_legend',
            \Contao\CoreBundle\DataContainer\PaletteManipulator::POSITION_APPEND)
        ->applyToPalette('linkteaser', 'tl_content');
    
    /**
     * Contao Open Source CMS
     *
     * Copyright (C) 2005-2012 Leo Feyer
     *
     * @package Gallery Creator
     * @link    http://www.contao.org
     * @license http://www.gnu.org/licenses/lgpl-3.0.html LGPL
     */
    $GLOBALS['TL_DCA']['tl_content']['palettes']['heroimage'] = 'name,type,headline;{image_legend:hide},addImage;{text_legend},text;{hero_image_button_legend},heroImageButtonText,heroImageButtonClass,heroImageButtonJumpTo;{hero_content_box_legend},heroContentBoxContainer,heroContentBoxHeight,heroContentBoxBackground,heroContentBoxColor;{protected_legend:hide},protected;{expert_legend:hide},guests,cssID,space;{invisible_legend:hide},invisible,start,stop';
    
    /**
     * Add fields to tl_content
     */
    
    $GLOBALS['TL_DCA']['tl_content']['fields']['heroImageButtonClass'] = array(
        'label' => &$GLOBALS['TL_LANG']['tl_content']['heroImageButtonClass'],
        'exclude' => true,
        'search' => true,
        'inputType' => 'text',
        'eval' => array('maxlength' => 200, 'tl_class' => 'w50'),
        'sql' => "varchar(255) NOT NULL default ''",
    );
    $GLOBALS['TL_DCA']['tl_content']['fields']['heroImageButtonText'] = array(
        'label' => &$GLOBALS['TL_LANG']['tl_content']['heroImageButtonText'],
        'exclude' => true,
        'search' => true,
        'inputType' => 'text',
        'eval' => array('maxlength' => 200, 'tl_class' => 'w50'),
        'sql' => "varchar(255) NOT NULL default ''",
    );
    $GLOBALS['TL_DCA']['tl_content']['fields']['heroImageButtonJumpTo'] = array(
        'label' => &$GLOBALS['TL_LANG']['tl_content']['heroImageButtonJumpTo'],
        'exclude' => true,
        'search' => true,
        'inputType' => 'text',
        'eval' => array(
            'rgxp' => 'url',
            'decodeEntities' => true,
            'maxlength' => 255,
            'fieldType' => 'radio',
            'filesOnly' => true,
            'tl_class' => 'w50 wizard',
        ),
        'wizard' => array
        (
            array('tl_content', 'pagePicker'),
        ),
        'sql' => "varchar(255) NOT NULL default ''",
    );
    
    $GLOBALS['TL_DCA']['tl_content']['fields']['heroContentBoxContainer'] = array(
        'label' => &$GLOBALS['TL_LANG']['tl_content']['heroContentBoxContainer'],
        'exclude' => true,
        'search' => true,
        'inputType' => 'select',
        'options' => array('uk-container', 'uk-container-fluid'),
        'eval' => array('tl_class' => 'w50 wizard'),
        'sql' => "varchar(255) NOT NULL default ''",
    );
    $GLOBALS['TL_DCA']['tl_content']['fields']['heroContentBoxBackground'] = array(
        'label' => &$GLOBALS['TL_LANG']['tl_content']['heroContentBoxBackground'],
        'exclude' => true,
        'search' => true,
        'inputType' => 'select',
        'options' => array('uk-section-primary', 'uk-section-secondary', 'uk-section-default', 'uk-section-muted'),
        'eval' => array('tl_class' => 'w50 wizard'),
        'sql' => "varchar(255) NOT NULL default ''",
    );
    $GLOBALS['TL_DCA']['tl_content']['fields']['heroContentBoxHeight'] = array(
        'label' => &$GLOBALS['TL_LANG']['tl_content']['heroContentBoxHeight'],
        'exclude' => true,
        'search' => true,
        'inputType' => 'text',
        'eval' => array('tl_class' => 'w50'),
        'sql' => "varchar(255) NOT NULL default ''",
    );
    $GLOBALS['TL_DCA']['tl_content']['fields']['heroContentBoxColor'] = array(
        'label' => &$GLOBALS['TL_LANG']['tl_content']['heroContentBoxColor'],
        'exclude' => true,
        'search' => true,
        'inputType' => 'select',
        'options' => array('uk-light', 'uk-dark'),
        'eval' => array('tl_class' => 'w50 wizard'),
        'sql' => "varchar(255) NOT NULL default ''",
    );
    
    
    
    