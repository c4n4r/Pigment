<?php

namespace Pigment\Handlers\Harmony;

use Pigment\Handlers\ColorTransformer;
use Pigment\Handlers\Harmony\Modules\ComplementaryColorHarmonizer;
use Pigment\Handlers\Harmony\Modules\SplitComplementaryColorHarmonizer;
use Pigment\Handlers\PigmentColorHandler;

class ColorHarmonyFactory {
    public static function getHarmonizer(Harmonizer $harmony): HarmonizerInterface {
        $handler = new PigmentColorHandler(ColorTransformer::getInstance());
        return match ($harmony) {
           Harmonizer::complementary => new ComplementaryColorHarmonizer($handler, ColorTransformer::getInstance()),
           Harmonizer::splitComplementary => new SplitComplementaryColorHarmonizer($handler, ColorTransformer::getInstance()),
           default => throw new \InvalidArgumentException("Invalid harmony"),
        };
    }


}