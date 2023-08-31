<?php

namespace Pigment\Handlers;

class PigmentValidator
{

    private static PigmentValidator $instance;

    /**
     * @return PigmentValidator
     */
    public static function getInstance(): PigmentValidator
    {
        if (!isset(self::$instance)) {
            self::$instance = new PigmentValidator();
        }
        return self::$instance;
    }

    /**
     * @param string $color
     * @return bool|int
     */
    public function validateHexColor(string $color): bool|int
    {
        return preg_match("/^#[a-f0-9]{6}$/i", $color);
    }

}