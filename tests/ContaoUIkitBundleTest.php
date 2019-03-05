<?php

/*
 * This file is part of contao/uikit.
 * (c) Lucas Rech
 * @license LGPL-3.0-or-later
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
