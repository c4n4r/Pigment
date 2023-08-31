<?php

//require autoload
require_once __DIR__ . '/../vendor/autoload.php';
//use Pigment\Model\Pigment
use Pigment\Model\Pigment;
//create new pigment
$pigment = new Pigment("#007D64");
//another pigment with another color
$pigmentTwo = new Pigment("#9C4F29");
//generate gradient
$gradients = $pigment->generateGradient($pigmentTwo, 12);
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
        .gradient {
            width: 100%;
            height: 100px;
            display: flex;
            justify-content: space-between;
        }
        .gradient div {
            width: 100%;
        }
    </style>
</head>
<body>
    <?php foreach ($gradients as $gradient): ?>
        <div class="gradient">
            <div style="background-color: <?= $gradient->getColorHex() ?>"></div>
        </div>
    <?php endforeach; ?>
</body>
</html>

