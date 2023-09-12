<?php

//require autoload
require_once __DIR__ . '/../vendor/autoload.php';

//use Pigment
use Pigment\Model\Pigment;

//generate a random color
$pigment = Pigment::random();

//generate mono-chromatic gradient
$monochromatic = $pigment->findMonoChromaticColorsGradient(12);
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
    <?php foreach ($monochromatic as $gradient): ?>
        <div class="gradient">
            <div style="background-color: <?= $gradient->getColorHex() ?>"></div>
        </div>
    <?php endforeach; ?>
</body>

</html>

