<?php

namespace Pigment\Handlers\Harmony\Modules;

use Pigment\Handlers\Harmony\HarmonizerInterface;
use Pigment\Handlers\PigmentColorHandler;
use Pigment\Model\Pigment;

class ComplementaryColorHarmonizer implements HarmonizerInterface{

    /**
     * @param PigmentColorHandler $colorHandler
     */
    public function __construct(
        private readonly PigmentColorHandler $colorHandler
    ){}

    /**
     * @param Pigment $color
     * @return Pigment
     */
    public function execute(Pigment $color): Pigment {
        $complementaryColor = $this->colorHandler->findComplementaryColor($color->getColorRgb());
        return new Pigment( $this->colorHandler->implodeToHex($complementaryColor));
    }

}