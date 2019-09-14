<?php

namespace Phlot;

use Phlot\Math\Vector2;
use Phrism\Color;

class CoordinateSystem2D implements Drawable
{
    private $xAxis;
    private $yAxis;

    public function __construct($xAxis, $yAxis)
    {
        $this->xAxis = $xAxis;
        $this->yAxis = $yAxis;
    }

    public function draw($img, Vector2 $startv, Vector2 $maxSize): void
    {
        $imgW = imagesx($img);
        $imgH = imagesy($img);
        
        $this->xAxis->draw($img, $startv, $maxSize);
        $this->yAxis->draw($img, $startv, $maxSize);
    }
}
