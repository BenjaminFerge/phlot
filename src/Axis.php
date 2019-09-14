<?php

namespace Phlot;

use Phlot\Math\Vector2;
use Phrism\Color;

class Axis implements Drawable
{
    private $length;
    private $direction;

    public function __construct(int $length, Vector2 $direction)
    {
        $this->length = $length;
        $this->direction = $direction;
    }

    public function draw($img, Vector2 $startv, Vector2 $maxSize): void
    {
        $imgW = imagesx($img);
        $imgH = imagesy($img);

        $endv = Vector2::fromVector2($startv);
        $endv->mul($maxSize);
        
        imageline($img, $startv->x, $startv->y, $endv->x, $endv->y, imagecolor($img, new Color(0, 0, 0)));
    }

    /**
     * Get the value of length
     */
    public function getLength()
    {
        return $this->length;
    }

    /**
     * Set the value of length
     *
     * @return  self
     */
    public function setLength($length)
    {
        $this->length = $length;

        return $this;
    }

    /**
     * Get the value of direction
     */
    public function getDirection()
    {
        return $this->direction;
    }

    /**
     * Set the value of direction
     *
     * @return  self
     */
    public function setDirection($direction)
    {
        $this->direction = $direction;

        return $this;
    }
}
