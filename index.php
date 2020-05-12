<?php
require 'vendor/autoload.php';

$iceCat = new Rapiddive\Icecat\IcecatBase('crunchersweb', '85xGqb8hQ!');

$iceCatProduct = new \Rapiddive\Icecat\FetchProduct($iceCat);

/** @var  $product */
$product = $iceCatProduct->getArticleByEAN('0193015166462');

$resultProduct = new \Rapiddive\Icecat\Model\ResultProduct($product);

//$my_std_class = json_decode(json_encode($product));
//$my_assoc_array = json_decode(json_encode($product), true);
echo '<pre>';
//var_dump($resultProduct->getProduct()->CategoryFeatureGroup);
var_dump($resultProduct->getProduct());
//var_dump($resultProduct->__callProductAttr('Code'));
echo '</pre>';