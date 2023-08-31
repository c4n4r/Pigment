# Pigment - A simple PHP library for color generation and manipulation

Pigment is a simple PHP library for color generation and manipulation. It can be used to generate gradients from two hexadecimal sources. It can also be used to manipulate colors (e.g. to make them lighter or darker).

## Installation

You can install this library via [Composer](https://getcomposer.org/):

```bash
composer require c4n4r/pigment
```

## Usage

### Create a pigment instance

```php
use Pigment\Pigment;
$pigment = new Pigment('#ff0000');

$pigment->getHex(); // #ff0000
$pigment->getRgb(); // ["red" => 255, "green" => 0, "blue" => 0]
```

### Darken or lighten a color

```php
use Pigment\Pigment;

//darken by 10%
$pigment = new Pigment('#007D64');
$pigment->darken(10); //#00715a

//lighten by 10%
$pigment = new Pigment('#007D64');
$pigment->lighten(10); //#008a6e
```

### You can also generate a gradient between two colors

```php

use Pigment\Pigment;
$colorOne = new Pigment('#007D64');
$colorTwo = new Pigment('#ff0000');

//create a gradient with 10 steps
$gradient = $colorOne->gradient($colorTwo, 10);
```
Every method that manipulates a color returns a new instance of the Pigment class.

### Use methods without creating an instance

```php

use Pigment\Handlers\PigmentColorHandler;

$colorHandler = new PigmentColorHandler();

//darken by 10%
$darkenedColor = $colorHandler->darken('#007D64', 25);
$lightenedColor = $colorHandler->lighten('#007D64', 25);

//create a gradient with 10 steps
$gradient = $colorHandler->createGradientBetweenToColors('#007D64', '#ff0000', 10);
```

Those methods does not return a new instance of the Pigment class, you can use them if you don't need to manipulate the color further.

### Examples

you can refer to the examples folder for more examples.


## License

This library is licensed under the MIT license.

## Credits

This library is developed by Hadrien Delphin, feel free to contact me if you have any question.
