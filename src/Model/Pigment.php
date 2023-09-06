<?php

namespace Pigment\Model;

use Pigment\Handlers\ColorTransformer;
use Pigment\Handlers\Harmony\ColorHarmonyFactory;
use Pigment\Handlers\Harmony\Harmonizer;
use Pigment\Handlers\PigmentColorHandler;
use Pigment\Traits\CanValidate;

class Pigment
{
    use CanValidate;

    private PigmentColorHandler $colorHandler;
    private ColorTransformer $colorTransformer;

    public function __construct(private string $color)
    {
        try {
            $this->color = $this->validateColor($color);
        } catch (\InvalidArgumentException $e) {
            throw new \InvalidArgumentException("Invalid color");
        }

        $this->colorHandler = PigmentColorHandler::getInstance();
        $this->colorTransformer = ColorTransformer::getInstance();
    }

    /**
     * @return Pigment
     * generate a new instance of Pigment with a random color
     */
    public static function random(): Pigment
    {
        $colorHandler = PigmentColorHandler::getInstance();
        return new Pigment($colorHandler->generateRandomColor());
    }

    /**
     * @return string
     */
    public function getColorHex(): string
    {
        return $this->color;
    }

    /**
     * @return array{red: int, green: int, blue: int}
     */
    public function getColorRgb(): array
    {
        return $this->colorTransformer->explodeToRgb($this->color);
    }

    /**
     * @return array{hue: int, saturation: int, lightness: int}
     */
    public function getColorHsl(): array
    {
        return $this->colorTransformer->rgbToHsl(
            $this->getColorRgb()
        );
    }

    /**
     * @param Pigment $pigment
     * @param int $steps
     * @return Pigment[]
     */
    public function generateGradient(Pigment $pigment, int $steps): array
    {
        $gradients = $this->colorHandler->createGradientBetweenToColors($this->color, $pigment->getColorHex(), $steps);
        return array_map(function ($gradient) {
            return new Pigment($gradient);
        }, $gradients);
    }

    /**
     * @param int $percentage
     * @return Pigment
     */
    public function lighten(int $percentage): Pigment
    {
        return new Pigment($this->colorHandler->lighten($this->color, $percentage));
    }

    /**
     * @param int $percentage
     * @return Pigment
     */
    public function darken(int $percentage): Pigment
    {
        return new Pigment($this->colorHandler->darken($this->color, $percentage));
    }

    /**
     * @param Harmonizer $harmonizer
     * @return Pigment
     */
    public function findColorHarmonized(Harmonizer $harmonizer = Harmonizer::complementary): Pigment
    {
        return ColorHarmonyFactory::getHarmonizer($harmonizer)->execute($this);
    }

    /**
     * @return array{hex: string, rgb: array{red: int, green: int, blue: int}, hsl: array{hue: int, saturation: int, lightness: int}}
     */
    public function __toArray(): array
    {
        return [
            "hex" => $this->getColorHex(),
            "rgb" => $this->getColorRgb(),
            "hsl" => $this->getColorHsl(),
        ];
    }




}