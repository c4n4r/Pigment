<?php

//require autoload
require_once __DIR__ . '/../vendor/autoload.php';

//use Pigment
use Pigment\Handlers\Harmony\Harmonizer;
use Pigment\Model\Pigment;

$pigmentRandomOne = Pigment::random();
$harmonized = $pigmentRandomOne->findColorHarmonized(Harmonizer::complementary);

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


    <div class="square" style="background: <?= $pigmentRandomOne->getColorHex() ?>;">

        <span>
            <?= $pigmentRandomOne->getColorHex() ?>
        </span>

    </div>
    <div class="square" style="background: <?= $harmonized->getColorHex() ?>;">
                <span>
            <?= $harmonized->getColorHex() ?>
        </span>
    </div>


</body>

</html>