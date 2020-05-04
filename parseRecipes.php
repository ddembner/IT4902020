#!/usr/bin/php
<?php

$jsonStuff = json_encode(
  ["meals"]=>
  array(3) {
    [0]=>
    array(6) {
      ["id"]=>
      int(650377)
      ["title"]=>
      string(22) "Low Carb Brunch Burger"
      ["readyInMinutes"]=>
      int(30)
      ["servings"]=>
      int(2)
      ["image"]=>
      string(33) "Low-Carb-Brunch-Burger-650377.jpg"
      ["imageUrls"]=>
      array(1) {
        [0]=>
        string(33) "Low-Carb-Brunch-Burger-650377.jpg"
      }
    }
    [1]=>
    array(6) {
      ["id"]=>
      int(257333)
      ["title"]=>
      string(20) "Honey-Soy Pork Chops"
      ["readyInMinutes"]=>
      int(25)
      ["servings"]=>
      int(4)
      ["image"]=>
      string(31) "honey-soy-pork-chops-257333.jpg"
      ["imageUrls"]=>
      array(1) {
        [0]=>
        string(31) "honey-soy-pork-chops-257333.jpg"
      }
    }
    [2]=>
    array(6) {
      ["id"]=>
      int(975810)
      ["title"]=>
      string(80) "Fear of Frying – Crispy Cod Po’ Boy with Janes ultimates Tavern Battered Cod"
      ["readyInMinutes"]=>
      int(40)
      ["servings"]=>
      int(4)
      ["image"]=>
      string(84) "fear-of-frying-crispy-cod-po-boy-with-janes-ultimates-tavern-battered-cod-975810.jpg"
      ["imageUrls"]=>
      array(1) {
        [0]=>
        string(84) "fear-of-frying-crispy-cod-po-boy-with-janes-ultimates-tavern-battered-cod-975810.jpg"
      }
    }
  }
  ["nutrients"]=>
  array(4) {
    ["calories"]=>
    float(2000.06)
    ["protein"]=>
    float(120.18)
    ["fat"]=>
    float(133.65)
    ["carbohydrates"]=>
    float(80.9)
  }
);

var_dump($jsonStuff);


?>
