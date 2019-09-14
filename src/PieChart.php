<?php

namespace Phlot;

use Phlot\Math\Vector2;
use Phrism\Color;

class PieChart extends Chart
{
    public function draw($img, Vector2 $startv, Vector2 $maxSize): void
    {
        $imgW = imagesx($img);
        $imgH = imagesy($img);
        $white = imagecolor($img, new Color(255, 255, 255));
        $halfW = $imgW / 2;
        $halfH = $imgH / 2;
        $center = new Vector2($halfW + $startv->x, $halfH + $startv->y);

        $data = $this->series->getData();
        $total = array_sum($data);
        $startAngle = 0;
        for ($i = 0; $i < count($data); $i++) {
            $p = $data[$i];
            $val = $p / $total;
            if ($this->series->hasColors()) {
                $_color = $this->series->getColors()[$i];
                $color = imagecolor($img, $_color);
            } else {
                $color = imagecolor($img, $this->defaultElemColor);
            }
            $endAngle = 360 * $val + $startAngle;
            imagefilledarc(
                $img,
                $center->x,
                $center->y,
                $halfW,
                $halfH,
                $startAngle,
                $endAngle,
                $color,
                IMG_ARC_PIE
            );

            // Border of element
            imagearc($img, $center->x, $center->y, $halfW, $halfH, $startAngle, $endAngle, $white);
            $startRad = deg2rad($startAngle);
            $endRad = deg2rad($endAngle);
            $r = $halfW / 2;
            $x1 = $r * cos($startRad) + $center->x;
            $y1 = $r * sin($startRad) + $center->y;
            $x2 = $r * cos($endRad) + $center->x;
            $y2 = $r * sin($endRad) + $center->y;
            imageline($img, $center->x, $center->y, $x1, $y1, $white);
            imageline($img, $center->x, $center->y, $x2, $y2, $white);
            //---------------------------—---------------------------—---------
            
            $startAngle = $endAngle;
        }
    }
}
