<?php

namespace Pigment\Handlers;

use function abs;
use function array_map;
use function dechex;
use function fmod;
use function hexdec;
use function implode;
use function max;
use function min;
use function round;
use function str_replace;
use function str_split;
use function strlen;

class ColorTransformer
{

    private static ColorTransformer $instance;

    public static function getInstance(): ColorTransformer
    {
        if (!isset(self::$instance)) {
            self::$instance = new ColorTransformer();
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
     * @param $color
     * @return array{h: float, s: float, l: float}
     */
    public function rgbToHsl($color): array{
        $r = $color['red'];
        $g = $color['green'];
        $b = $color['blue'];
        $r /= 255;
        $g /= 255;
        $b /= 255;
        $max = max($r, $g, $b);
        $min = min($r, $g, $b);
        $h = 0;
        $s = 0;
        $l = ($max + $min) / 2;
        $d = $max - $min;
        if($d == 0){
            $h = $s = 0;
        }else{
            $s = $d / (1 - abs(2 * $l - 1));
            switch($max){
                case $r:
                    $h = 60 * fmod((($g - $b) / $d), 6);
                    if($b > $g){
                        $h += 360;
                    }
                    break;
                case $g:
                    $h = 60 * (($b - $r) / $d + 2);
                    break;
                case $b:
                    $h = 60 * (($r - $g) / $d + 4);
                    break;
            }
        }
        return array('h' => round($h, 2), 's' => round($s, 2), 'l' => round($l, 2));
    }

    /**
     * @param array $hslColor
     * @return array{red: int, green: int, blue: int}
     */
    public function hslToRgb(array $hslColor): array
    {

        $h = $hslColor['h'];
        $s = $hslColor['s'];
        $l = $hslColor['l'];

        $h /= 360;
        $s /= 100;
        $l /= 100;

        $r = 0;
        $g = 0;
        $b = 0;

        if($s == 0){
            $r = $g = $b = $l;
        }else{
            $function = function($p, $q, $t){
                if($t < 0) $t += 1;
                if($t > 1) $t -= 1;
                if($t < 1/6) return $p + ($q - $p) * 6 * $t;
                if($t < 1/2) return $q;
                if($t < 2/3) return $p + ($q - $p) * (2/3 - $t) * 6;
                return $p;
            };

            $q = $l < 0.5 ? $l * (1 + $s) : $l + $s - $l * $s;
            $p = 2 * $l - $q;

            $r = $function($p, $q, $h + 1/3);
            $g = $function($p, $q, $h);
            $b = $function($p, $q, $h - 1/3);
        }
        return array('red' => round($r * 255), 'green' => round($g * 255), 'blue' => round($b * 255));
    }

}