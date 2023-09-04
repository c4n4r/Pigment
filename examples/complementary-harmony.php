<?php

//require autoload
require_once __DIR__ . '/../vendor/autoload.php';

//use Pigment
use Pigment\Handlers\Harmony\Harmonizer;
use Pigment\Model\Pigment;

//generate a random color
$color = Pigment::random();
//harmonize with a complementary color
$complementary = $color->findColorHarmonized(Harmonizer::splitComplementary);

?>


<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <title>Pigment</title>
    <style>

        body {
            display: flex;
            height: 100vh;
            width: 100vw;
            justify-content: center;
            align-items: center;
            gap: 10px;

        }

        .square {
            width: 100px;
            height: 100px;
            align-items: center;
            justify-content: center;
            color: white;
            font-weight: bold;
            display: flex;
            border-radius: 20px;
            box-shadow: 0 0 5px rgba(0, 0, 0, 0.5);
        }
    </style>
</head>

<body>


<div class="square" style="background: <?= $color->getColorHex() ?>;">

        <span>
            <?= $color->getColorHex() ?>
        </span>

</div>
<div class="square" style="background: <?= $complementary->getColorHex() ?>;">
                <span>
            <?= $complementary->getColorHex() ?>
        </span>
</div>


</body>

</html>