<?php

declare(strict_types=1);
/**
 * TestIcecatBase
 *
 * @copyright Copyright © 2020 Rapid dive. All rights reserved.
 * @author    Rapid Dive <rapiddive1@gmail.com>
 */

namespace Rapiddive\Icecat\Tests;

use PHPUnit\Framework\TestCase;
use Rapiddive\Icecat\IcecatBase;

/**
 * Class TestIcecatBase
 * @package Rapiddive\Icecat\Tests
 * @coversDefaultClass \Rapiddive\Icecat\IcecatBase
 */
class IcecatBaseTest extends TestCase
{
    /**
     * @var IcecatBase
     */
    private $iceCatBase;

    /**
     * @return IcecatBase
     */
    public function getIceCatBase(): IcecatBase
    {
        return $this->iceCatBase;
    }

    protected function setUp(): void
    {
        parent::setUp();
        $this->iceCatBase = new IcecatBase('foo', 'bar', __DIR__);
    }

    public function testUsernameGetter()
    {
        $this->assertEquals('foo', $this->iceCatBase->getUsername());
    }

    public function testPasswordGetter()
    {
        $this->assertEquals('bar', $this->iceCatBase->getPassword());
    }
}

