<?php

declare(strict_types=1);
/**
 * FetchProduct
 *
 * @copyright Copyright © 2020 Rapid dive. All rights reserved.
 * @author    Rapid Dive <rapiddive1@gmail.com>
 */

namespace Rapiddive\Icecat;

use Rapiddive\Icecat\Helper\Languagelist;
use SimpleXMLElement;

/**
 * Class FetchProduct
 * @package Rapiddive\Icecat
 */
class FetchProduct
{
    /**
     * @var IcecatBase
     */
    protected $base;

    /**
     * @var array
     */
    protected $products = [];

    public function __construct(
        IcecatBase $base
    ) {
        $this->base = $base;
    }

    /**
     * @param  string $ean
     * @param  string $lang
     * @return SimpleXMLElement
     */
    public function getArticleByEAN(string $ean, string $lang = null)
    {
        if (!isset($this->products[$ean])) {
            if (!$lang) {
                $lang = Languagelist::getLanguageList($lang);
            }

            $params = array(
                'ean_upc' => $ean,
                'lang' => $lang
            );

            $this->products[$ean] = $this->base->request($this->base->xmlEndpoint, $params);
        }

        return new SimpleXMLElement($this->products[$ean]);
    }
}
