<?php

namespace Pigment\Handlers\Harmony;

use Pigment\Handlers\Harmony\Modules\ComplementaryColorHarmonizer;
use Pigment\Handlers\PigmentColorHandler;

class ColorHarmonyFactory {
    public static function getHarmonizer(Harmonizer $harmony): HarmonizerInterface {
        $handler = new PigmentColorHandler();
        return match ($harmony) {
           Harmonizer::complementary => new ComplementaryColorHarmonizer($handler),
           default => throw new \InvalidArgumentException("Invalid harmony"),
        };
    }


}