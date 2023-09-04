<?php

namespace Pigment\Handlers\Harmony\Modules;

use Pigment\Handlers\Harmony\HarmonizerInterface;
use Pigment\Handlers\PigmentColorHandler;
use Pigment\Model\Pigment;
use function round;

class SplitComplementaryColorHarmonizer implements HarmonizerInterface
{
    public function __construct(
        private readonly PigmentColorHandler $colorHandler
    ){}

    public function execute(Pigment $color): Pigment
    {
        $splitComplementaryColor = $this->findSplitComplementaryColor($color->getColorRgb());
        return new Pigment( $this->colorHandler->implodeToHex($splitComplementaryColor));
    }


    private function findSplitComplementaryColor($color): array
    {
        $hsl = $this->colorHandler->rgbToHsl($color);
        $hsl['h'] = round($hsl['h'] + 180 % 360, 0);
        $hsl['s'] = round($hsl['s'] * 100, 0);
        $hsl['l'] = round($hsl['l'] * 100, 0);
        return $this->colorHandler->hslToRgb($hsl);
    }

}