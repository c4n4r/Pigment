<?php

namespace Pigment\Handlers\Harmony;

use Pigment\Model\Pigment;

interface HarmonizerInterface
{
    public function execute(Pigment $color): Pigment;
}