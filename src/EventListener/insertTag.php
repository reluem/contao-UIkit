<?php

declare(strict_types=1);

/*
 * Contao UIkit Bundle
 * @copyright  Copyright (c) 2018-2020, reluem
 * @author     reluem
 * @license    http://opensource.org/licenses/lgpl-3.0.html LGPL
 * @link       http://github.com/reluem/contao-uikit
 */

namespace Reluem\ContaoUIkitBundle\EventListener;

use Contao\CoreBundle\Monolog\ContaoContext;
use Psr\Log\LoggerInterface;
use Psr\Log\LogLevel;

class insertTag
{
    private LoggerInterface $logger;

    public function __construct(LoggerInterface $logger)
    {
        $this->logger = $logger;
    }

    /**
     * @return string|false
     */
    public function iconInsertTag(string $strTag)
    {
        $arrSplit = explode('::', $strTag);

        if ('icon' !== $arrSplit[0] && 'cache_icon' !== $arrSplit[0]) {
            return false;
        }

        if (isset($arrSplit[1]) && !empty($arrSplit[1])) {
            $icon = $arrSplit[1];
            $ratio = '1';

            if (isset($arrSplit[2]) && null !== $arrSplit[2]) {
                $ratio = $arrSplit[2];
            }

            $classes = '';

            if (isset($arrSplit[3]) && null !== $arrSplit[3]) {
                $classes = $arrSplit[3];
            }

            return '<span uk-icon="icon:' . $icon . '; ratio: ' . $ratio . '" class="' . $classes . '"></span>';
        }

        $this->logger->log(
            LogLevel::WARNING,
            'Invalid icon inserttag: ' . $strTag,
            ['contao' => new ContaoContext(__CLASS__ . '::' . __FUNCTION__, ContaoContext::GENERAL)]
        );

        return false;
    }
}
