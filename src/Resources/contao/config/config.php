<?php
    
    use reluem\generatePageHook;
    use reluem\UIkitFormClassesHook;
    use reluem\UIkitheroImage;
    use Haste\Util\Debug;
    use reluem\UIkitlinkTeaser;
    use reluem\UIkitNavbar;
    use reluem\UIkitclassesHook;
    
    $GLOBALS['FE_MOD']['navigationMenu']['UIkit_navbar'] = UIkitNavbar::class;
    $GLOBALS['TL_CTE']['media']['heroimage'] = UIkitheroImage::class;
    $GLOBALS['TL_CTE']['links']['linkteaser'] = UIkitlinkTeaser::class;
    $GLOBALS['TL_FFL']['formcolstart'] = UIkitFormClassesHook::class;
    
    
    /**
     * Grid definition
     */
    $GLOBALS['TL_SUBCL']['contao-UIkit'] = [
        'label' => 'Contao UIkit', // Label for the selectmenu
        'scclass' => 'uk-grid uk-grid-small', // Class for the wrapping container
        'equalize' => 'uk-grid-match', // Is a equalize heights class included and what is it's name?
        'gap' => false,
        'inside' => false, // Are inside containers used?
        /*
         * Define the sets that can be used as an array.
         * Each array contains two or more arrays with the definition for the single columns.
         * The key is used as the label in the select menu.
         * Example: '50x50' => array(array([class(es) for the first column],[optional classes for the inside container]),array([class(es) for the second column],[optional classes for the inside container]))
         */
        'sets' => [
            '25x25x25x25 (mobil)' => [
                ['uk-width-1-4'],
                ['uk-width-1-4'],
                ['uk-width-1-4'],
                ['uk-width-1-4'],
            ],
            '25x25x25x25' => [['uk-width-1-4@s'], ['uk-width-1-4@s'], ['uk-width-1-4@s'], ['uk-width-1-4@s']],
            '33x33x33 (mobil)' => [['uk-width-1-3'], ['uk-width-1-3'], ['uk-width-1-3']],
            '33x33x33' => [['uk-width-1-3@m'], ['uk-width-1-3@m'], ['uk-width-1-3@m']],
            '50x50 (mobil)' => [['uk-width-1-2'], ['uk-width-1-2']],
            '50x50' => [['uk-width-1-2@m'], ['uk-width-1-2@m']],
            '33x66 (mobil)' => [['uk-width-1-3'], ['uk-width-2-3']],
            '33x66' => [['uk-width-1-3@m'], ['uk-width-2-3@m'],],
            '66x33' => [['uk-width-2-3@m'], ['uk-width-1-3@m'],],
            '100%' => [['uk-width-1-1'],],
        
        ],
    ];
    
    
    /**
     * Hooks
     */
    
    $GLOBALS['TL_HOOKS']['parseTemplate'][] = array(UIkitclassesHook::class, 'extendCssClasses');
    $GLOBALS['TL_HOOKS']['generatePage'][] = array(generatePageHook::class, 'assetDelivery');
    
    /**
     * JS Inclusion
     */
    
    $GLOBALS['TL_JAVASCRIPT'][] = Debug::uncompressedFile('assets/uikit/dist/js/uikit.min.js');
    $GLOBALS['TL_JAVASCRIPT'][] = Debug::uncompressedFile('assets/uikit/dist/js/uikit-icons.min.js');
    $GLOBALS['TL_JAVASCRIPT'][] = Debug::uncompressedFile('files/theme/js/ajaxReload.min.js');
    $GLOBALS['TL_JAVASCRIPT'][] = Debug::uncompressedFile('bundles/contaouikit/js/width-viewport.min.js');

    
