<?php


use Pigment\Model\Pigment;

test("it can be created", function () {
    $pigment = new Pigment("#00ffcc");
    expect($pigment)->toBeInstanceOf(Pigment::class)
        ->and($pigment->getColorHex())->toBe("#00ffcc");
});

test('it can lighten a color based on a percentage', function () {
    $pigment = new Pigment("#007D64");
    $lightened = $pigment->lighten(10);
    expect($lightened->getColorHex())->toBe("#008a6e");
});

test('it can darken a color based on a percentage', function () {
    $pigment = new Pigment("#007D64");
    $darkened = $pigment->darken(10);
    expect($darkened->getColorHex())->toBe("#00715a");
});

test('it can get the rgb color of a Pigment', function () {
    $pigment = new Pigment("#007D64");
    $rgb = $pigment->getColorRgb();
    expect($rgb)->toBeArray()->and($rgb)->toBe(
        [
            'red' => 0,
            'green' => 125,
            'blue' => 100
        ]
    );
});

test('it can generate a gradient between 2 colors', function () {
   $pigmentOne = new Pigment("#007D64");
   $pigmentTwo = new Pigment("#9C4F29");
   $gradients = $pigmentOne->generateGradient($pigmentTwo, 5);
   foreach ($gradients as $gradient) {
       expect($gradient)->toBeInstanceOf(Pigment::class);
       dump($gradient->getColorHex());
   }
});

test("it throws an exception if the color is invalid", function () {
    $pigment = new Pigment("#00ffcsdsc");
})->throws(InvalidArgumentException::class, "Invalid color");