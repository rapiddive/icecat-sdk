<?php
/**
 * FetchProduct
 *
 * @copyright Copyright © 2020 Firebear Studio. All rights reserved.
 * @author    fbeardev@gmail.com
 */

namespace Rapiddive\Icecat;


use Rapiddive\Icecat\Helper\Languagelist;

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
     * @param $ean
     * @param string $lang
     * @return \SimpleXMLElement
     */
    public function getArticleByEAN($ean, $lang = null)
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

        return new \SimpleXMLElement($this->products[$ean]);
    }
}