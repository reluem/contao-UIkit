<?php

/*
 * Contao UIkit Bundle
 * @copyright  Copyright (c) 2018-2020, reluem
 * @author     reluem
 * @license    http://opensource.org/licenses/lgpl-3.0.html LGPL
 * @link       http://github.com/reluem/contao-uikit
 */

namespace Reluem\ContaoUIkitBundle\Tests;

use PHPUnit\Framework\TestCase;
use Psr\Log\LoggerInterface;
use Reluem\ContaoUIkitBundle\EventListener\insertTag;

class InsertTagListenerTest extends TestCase
{
    public function testReturnsFalseForUnknownTag(): void
    {
        $listener = new insertTag($this->createMock(LoggerInterface::class));

        $this->assertFalse($listener->iconInsertTag('unknown::foo'));
    }

    public function testRendersIconInsertTag(): void
    {
        $listener = new insertTag($this->createMock(LoggerInterface::class));

        $this->assertSame(
            '<span uk-icon="icon:home; ratio: 1" class=""></span>',
            $listener->iconInsertTag('icon::home')
        );
    }

    public function testRendersIconInsertTagWithParameters(): void
    {
        $listener = new insertTag($this->createMock(LoggerInterface::class));

        $this->assertSame(
            '<span uk-icon="icon:star; ratio: 2" class="uk-text-warning"></span>',
            $listener->iconInsertTag('icon::star::2::uk-text-warning')
        );
    }

    public function testLogsInvalidIconInsertTag(): void
    {
        $logger = $this->createMock(LoggerInterface::class);
        $logger->expects($this->once())->method('log');

        $listener = new insertTag($logger);

        $this->assertFalse($listener->iconInsertTag('icon'));
    }
}
