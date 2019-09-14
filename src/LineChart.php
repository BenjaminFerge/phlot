<?php

namespace Phlot;

use Phlot\Math\Vector2;

class LineChart extends Chart
{
    public function draw($img, Vector2 $startv, Vector2 $maxSize): void
    {
        $imgW = imagesx($img);
        $imgH = imagesy($img);
        
        $xDir = new Vector2(0, 1);
        $yDir = new Vector2(1, 0);
        $xAxis = new Axis(10, $xDir);
        $yAxis = new Axis(10, $yDir);
        $coordSys = new CoordinateSystem2D($xAxis, $yAxis);
        $coordSys->draw($img, $startv, $maxSize);
    }
}
