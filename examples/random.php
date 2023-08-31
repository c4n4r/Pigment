<?php

//require autoload
require_once __DIR__ . '/../vendor/autoload.php';

//use Pigment
use Pigment\Model\Pigment;

$pigmentRandomOne = Pigment::random();
$pigmentRandomTwo = Pigment::random();

//generate a gradient from colors $pigmentRandomOne to $pigmentRandomTwo in 25 steps
$gradients = $pigmentRandomOne->generateGradient($pigmentRandomTwo, 25);

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Pigment</title>
    <style>
        body {
            background-color: <?= $pigmentRandomOne->getColorHex() ?>;
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


