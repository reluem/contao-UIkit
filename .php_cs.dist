<?php
    /**
     * Contao Open Source CMS
     *
     * Copyright (c) 2005-2019 Leo Feyer
     *
     * @author    reluem
     * @license   GNU/LGPL
     * @copyright reluem 2019
     */
    
    $header = <<<EOF
This file is part of contao/uikit.
(c) Lucas Rech
@license LGPL-3.0-or-later
EOF;
    $finder = PhpCsFixer\Finder::create()
        ->exclude('Resources')
        ->in([__DIR__ . '/src', __DIR__ . '/tests']);
    return PhpCsFixer\Config::create()
        ->setRules(
            array(
                '@Symfony' => true,
                '@Symfony:risky' => true,
                'array_syntax' => array('syntax' => 'short'),
                'combine_consecutive_unsets' => true,
                'general_phpdoc_annotation_remove' => array(
                    'expectedException',
                    'expectedExceptionMessage',
                    'expectedExceptionMessageRegExp',
                ),
                'header_comment' => array('header' => $header),
                'heredoc_to_nowdoc' => true,
                'native_function_invocation' => true,
                'no_extra_consecutive_blank_lines' => array(
                    'break',
                    'continue',
                    'extra',
                    'return',
                    'throw',
                    'use',
                    'parenthesis_brace_block',
                    'square_brace_block',
                    'curly_brace_block',
                ),
                'no_unreachable_default_argument_value' => true,
                'no_useless_else' => true,
                'no_useless_return' => true,
                'ordered_class_elements' => true,
                'ordered_imports' => true,
                'phpdoc_add_missing_param_annotation' => true,
                'phpdoc_order' => true,
                'psr4' => true,
                'strict_comparison' => true,
                'strict_param' => true,
            )
        )
        ->setFinder($finder)
        ->setRiskyAllowed(true)
        ->setUsingCache(false);
