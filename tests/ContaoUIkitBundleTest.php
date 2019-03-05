<?php

/*
 * Contao UIkit Bundle
 * @copyright  Copyright (c) 2018-2019, reluem
 * @author     reluem
 * @license    http://opensource.org/licenses/lgpl-3.0.html LGPL
 * @link       http://github.com/reluem/contao-uikit
 */

namespace Reluem\ContaoUIkitBundle\Tests;

use PHPUnit\Framework\TestCase;
use Reluem\ContaoUIkitBundle\ContaoUIkitBundle;

class ContaoUIkitBundleTest extends TestCase
{
    public function testCanBeInstantiated()
    {
        $bundle = new ContaoUIkitBundle();
        $this->assertInstanceOf(ContaoUIkitBundle::class, $bundle);
    }
}
