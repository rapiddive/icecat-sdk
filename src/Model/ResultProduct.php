<?php
/**
 * ResultProduct
 *
 * @copyright Copyright © 2020 Firebear Studio. All rights reserved.
 * @author    fbeardev@gmail.com
 */

namespace Rapiddive\Icecat\Model;


use SimpleXMLElement;

class ResultProduct
{
    /**
     * @var SimpleXMLElement
     */
    private $XMLElement;

    /**
     * @var mixed
     */
    private $baseData;

    /**
     * ResultProduct constructor.
     * @param SimpleXMLElement $XMLElement
     */
    public function __construct(
        SimpleXMLElement $XMLElement = null
    ) {
        $this->XMLElement = $XMLElement;
        $this->setBaseProductData($XMLElement);
    }

    /**
     * @param $xml
     */
    public function setBaseProductData($xml)
    {
        $this->baseData = json_decode(json_encode($xml));
    }

    /**
     * @return mixed
     */
    public function getBaseData()
    {
        return $this->baseData;
    }

    public function getProductName()
    {
        return $this->getProductAttributes()->Name;
    }

    /**
     * @param string $attr
     * @return mixed
     */
    public function __callProductAttr(string $attr)
    {
        return $this->getProductAttributes()->{$attr};
    }

    /**
     * @return mixed
     */
    public function getProductAttributes()
    {
        return $this->getProduct()->{'@attributes'};
    }

    /**
     * @return mixed
     */
    public function getProduct()
    {
        return $this->getBaseData()->Product;
    }
}