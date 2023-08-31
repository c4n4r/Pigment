<?php

namespace Pigment\Model;

use Pigment\Handlers\PigmentColorHandler;
use Pigment\Traits\CanValidate;

class Pigment
{
    use CanValidate;

    private PigmentColorHandler $colorHandler;

    public function __construct(private string $color)
    {
        try {
            $this->color = $this->validateColor($color);
        } catch (\InvalidArgumentException $e) {
            throw new \InvalidArgumentException("Invalid color");
        }

        $this->colorHandler = PigmentColorHandler::getInstance();
    }

    public static function random(): Pigment
    {
        $colorHandler = PigmentColorHandler::getInstance();
        return new Pigment($colorHandler->generateRandomColor());
    }

    public function getColorHex(): string
    {
        return $this->color;
    }

    /**
     * @return array{red: int, green: int, blue: int}
     */
    public function getColorRgb(): array
    {
        return $this->colorHandler->explodeToRgb($this->color);
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

    public function findComplemetary(): Pigment
    {
        $rgb = $this->getColorRgb();
        return new Pigment(
            $this->colorHandler->implodeToHex($this->colorHandler->findComplementaryColor($rgb))
        );
    }

}