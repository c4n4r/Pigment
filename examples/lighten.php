<?php
require_once __DIR__ . '/../vendor/autoload.php';

//use Pigment
use Pigment\Model\Pigment;

$pigment = new Pigment("#007D64");
$lightenedTen = $pigment->lighten(10);
$lightenedTwenty = $pigment->lighten(20);
$lightenedThirty = $pigment->lighten(30);
$lightenedForty = $pigment->lighten(40);
$lightenedFifty = $pigment->lighten(50);
$lightenedSixty = $pigment->lighten(60);

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
        .lighten-10 {
            background-color: <?= $lightenedTen->getColorHex() ?>;
        }
        .lighten-20 {
            background-color: <?= $lightenedTwenty->getColorHex() ?>;
        }
        .lighten-30 {
            background-color: <?= $lightenedThirty->getColorHex() ?>;
        }
        .lighten-40 {
            background-color: <?= $lightenedForty->getColorHex() ?>;
        }
        .lighten-50 {
            background-color: <?= $lightenedFifty->getColorHex() ?>;
        }
        .lighten-60 {
            background-color: <?= $lightenedSixty->getColorHex() ?>;
        }
    </style>
</head>
<body>
    <div class="lighten-10">Lighten 10</div>
    <div class="lighten-20">Lighten 20</div>
    <div class="lighten-30">Lighten 30</div>
    <div class="lighten-40">Lighten 40</div>
    <div class="lighten-50">Lighten 50</div>
    <div class="lighten-60">Lighten 60</div>
</body>
</html>