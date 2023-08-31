<?php

//require autoload
require_once __DIR__ . '/../vendor/autoload.php';

//use Pigment\Model\Pigment
use Pigment\Model\Pigment;

//create new pigment
$pigment = new Pigment("#007D64");

//darken by 10%
$darkenedTen = $pigment->darken(10);

//darken by 20%
$darkenedTwenty = $pigment->darken(20);

//darken by 30%

$darkenedThirty = $pigment->darken(30);

//darken by 40%
$darkenedForty = $pigment->darken(40);

//darken by 50%
$darkenedFifty = $pigment->darken(50);

//darken by 60%
$darkenedSixty = $pigment->darken(60);

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Pigment</title>
    <style>
        body {
            background-color: <?= $pigment->getColorHex() ?>;
        }
        .darken-10 {
            background-color: <?= $darkenedTen->getColorHex() ?>;
        }
        .darken-20 {
            background-color: <?= $darkenedTwenty->getColorHex() ?>;
        }
        .darken-30 {
            background-color: <?= $darkenedThirty->getColorHex() ?>;
        }
        .darken-40 {
            background-color: <?= $darkenedForty->getColorHex() ?>;
        }
        .darken-50 {
            background-color: <?= $darkenedFifty->getColorHex() ?>;
        }
        .darken-60 {
            background-color: <?= $darkenedSixty->getColorHex() ?>;
        }
    </style>
</head>
<body>
    <div class="darken-10">Darken 10</div>
    <div class="darken-20">Darken 20</div>
    <div class="darken-30">Darken 30</div>
    <div class="darken-40">Darken 40</div>
    <div class="darken-50">Darken 50</div>
    <div class="darken-60">Darken 60</div>
</body>
</html>
