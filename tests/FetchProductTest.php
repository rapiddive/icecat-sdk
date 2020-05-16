<?php

declare(strict_types=1);
/**
 * FetchProductTest
 *
 * @copyright Copyright © 2020 Rapid dive. All rights reserved.
 * @author    Rapid Dive <rapiddive1@gmail.com>
 */

namespace Rapiddive\Icecat\Tests;

use SimpleXMLElement;

/**
 * Class FetchProductTest
 * @package Rapiddive\Icecat\Tests
 * @coversDefaultClass \Rapiddive\Icecat\FetchProduct
 */
class FetchProductTest extends IcecatBaseTest
{
    /**
     * @var string
     */
    private $testDir;
    /**
     * @var SimpleXMLElement
     */
    private $xml;
    /**
     * @var false|string
     */
    private $rawXmlData;
    /**
     * @var false|string
     */
    private $rawNotFoundXml;

    /**
     * @return SimpleXMLElement
     */
    public function getXml(): SimpleXMLElement
    {
        return $this->xml;
    }

    protected function setUp(): void
    {
        parent::setUp();
        $this->testDir = __DIR__;
        $this->initializeDummyData();
    }

    /**
     * Initializes dummy data.
     */
    private function initializeDummyData()
    {
        $this->rawNotFoundXml = file_get_contents($this->getTestDir() . '/sampledata/productnotfound.xml');
        $this->rawXmlData = file_get_contents($this->getTestDir() . '/sampledata/product.xml');
        $this->xml = simplexml_load_string($this->rawXmlData, 'SimpleXMLElement', LIBXML_NOCDATA);
    }

    /**
     * @return string
     */
    public function getTestDir(): string
    {
        return $this->testDir;
    }

}