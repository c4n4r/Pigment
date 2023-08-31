<?php

namespace Pigment\Traits;

use Pigment\Handlers\PigmentValidator;

trait CanValidate
{
    protected function validateColor(string $color): string
    {
        if (!PigmentValidator::getInstance()->validateHexColor($color)) {
            throw new \InvalidArgumentException("Invalid color");
        }
        return $color;
    }

}