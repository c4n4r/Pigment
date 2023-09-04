<?php

namespace Pigment\Handlers\Harmony\Modules;

use Pigment\Handlers\ColorTransformer;
use Pigment\Handlers\Harmony\HarmonizerInterface;
use Pigment\Handlers\PigmentColorHandler;
use Pigment\Model\Pigment;
use function round;

class SplitComplementaryColorHarmonizer implements HarmonizerInterface
{
    public function __construct(
        private readonly PigmentColorHandler $colorHandler,
        private readonly ColorTransformer $colorTransformer
    ){}

    public function execute(Pigment $color): Pigment
    {
        $splitComplementaryColor = $this->colorHandler->findSplitComplementaryColor($color->getColorRgb());
        return new Pigment( $this->colorTransformer->implodeToHex($splitComplementaryColor));
    }




}