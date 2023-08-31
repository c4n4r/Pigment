<?php

namespace Pigment\Handlers;

class PigmentColorHandler
{

    private static PigmentColorHandler $instance;

    public static function getInstance(): PigmentColorHandler
    {
        if (!isset(self::$instance)) {
            self::$instance = new PigmentColorHandler();
        }
        return self::$instance;
    }


    /**
     * @param string $color
     * @return array{red: int, green: int, blue: int}
     */
    public function explodeToRgb(string $color): array
    {
        $color = str_replace('#', '', $color);
        $color = str_split($color, 2);
        $explode = array_map(function ($color) {
            return hexdec($color);
        }, $color);

        return [
            'red' => $explode[0],
            'green' => $explode[1],
            'blue' => $explode[2]
        ];

    }

    /**
     * @param string $color
     * @param int $percentage
     * @return string
     */
    public function lighten(string $color, int $percentage): string
    {
        $color = $this->explodeToRgb($color);
        $color = $this->lightenRGBColors($color, $percentage);
        return $this->implodeToHex($color);
    }

    /**
     * @param string $color
     * @param int $percentage
     * @return string
     */
    public function darken(string $color, int $percentage): string
    {
        $color = $this->explodeToRgb($color);
        $color = $this->darkenRGBColors($color, $percentage);
        return $this->implodeToHex($color);
    }

    /**
     * @param string $color1
     * @param string $color2
     * @param int $steps
     * @return array{string}
     */
    public function createGradientBetweenToColors(string $color1, string $color2, int $steps): array
    {
        $color1 = $this->explodeToRgb($color1);
        $color2 = $this->explodeToRgb($color2);
        $gradient = [];
        $gradient[] = $color1;
        $step = 1;
        while ($step < $steps) {
            $gradient[] = $this->calculateGradientStep($color1, $color2, $step, $steps);
            $step++;
        }
        $gradient[] = $color2;
        return array_map(function ($color) {
            return $this->implodeToHex($color);
        }, $gradient);
    }

    /**
     * @param array $color
     * @return string
     */
    public function implodeToHex(array $color): string
    {
        $color = array_map(function ($color) {
            $hex = dechex($color);
            if (strlen($hex) === 1) {
                $hex = "0" . $hex;
            }
            return $hex;
        }, $color);
        return '#' . implode('', $color);
    }

    /**
     * @return string
     */
    public function generateRandomColor(): string {
        $color = [];
        $color['red'] = rand(0, 255);
        $color['green'] = rand(0, 255);
        $color['blue'] = rand(0, 255);
        return $this->implodeToHex($color);
    }

    /**
     * @param array $color
     * @param int $percentage
     * @return array{red: int, green: int, blue: int}
     */
    private function lightenRGBColors(array $color, int $percentage): array
    {
        return array_map(function ($color) use ($percentage) {
            return $this->lightenColor($color, $percentage);
        }, $color);
    }

    /**
     * @param array $color
     * @param int $percentage
     * @return array{red: int, green: int, blue: int}
     */
    private function darkenRGBColors(array $color, int $percentage): array
    {
        return array_map(function ($color) use ($percentage) {
            return $this->darkenColor($color, $percentage);
        }, $color);
    }

    /**
     * @param int $color
     * @param int $percentage
     * @return int
     */
    private function lightenColor(int $color, int $percentage): int
    {
        $color = $color + ($color * ($percentage / 100));
        $color = round($color);
        if ($color > 255) {
            $color = 255;
        }
        return $color;
    }

    /**
     * @param int $color
     * @param int $percentage
     * @return int
     */
    private function darkenColor(int $color, int $percentage): int
    {
        $color = $color - ($color * ($percentage / 100));
        $color = round($color);
        if ($color < 0) {
            $color = 0;
        }
        return $color;
    }

    /**
     * @param array $color1
     * @param array $color2
     * @param int $step
     * @param int $steps
     * @return array{red: float, green: float, blue: float}
     */
    private function calculateGradientStep(array $color1, array $color2, int $step, int $steps): array
    {
        $gradient = [];
        $gradient['red'] = $this->calculateGradientStepForColor($color1['red'], $color2['red'], $step, $steps);
        $gradient['green'] = $this->calculateGradientStepForColor($color1['green'], $color2['green'], $step, $steps);
        $gradient['blue'] = $this->calculateGradientStepForColor($color1['blue'], $color2['blue'], $step, $steps);
        return $gradient;
    }

    /**
     * @param int $color1
     * @param int $color2
     * @param int $step
     * @param int $steps
     * @return float
     */
    private function calculateGradientStepForColor(int $color1, int $color2, int $step, int $steps): float
    {
        $step = $step / $steps;
        $color = $color1 + ($step * ($color2 - $color1));
        return round($color);
    }
    public function findComplementaryColor(array $color): array
    {
        $complementaryColor = [];
        $complementaryColor['red'] = 255 - $color['red'];
        $complementaryColor['green'] = 255 - $color['green'];
        $complementaryColor['blue'] = 255 - $color['blue'];
        return $complementaryColor;
    }

}