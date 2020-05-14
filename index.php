<?php

declare(strict_types=1);

use Rapiddive\Icecat\FetchProduct;
use Rapiddive\Icecat\Model\ResultProduct;

require 'vendor/autoload.php';

$username = '';
$password = '';

$iceCat = new Rapiddive\Icecat\IcecatBase($username, $password, __DIR__);

/** @var FetchProduct $iceCatProduct */
$iceCatProduct = new FetchProduct($iceCat);
$p = ['088698857212'];

foreach ($p as $value) {
    /** @var  $product */
    var_dump($value);
    $product = $iceCatProduct->getArticleByEAN($value);
    $resultProduct = new ResultProduct($product);
    var_dump($resultProduct->getShortSummaryDescription());
}
