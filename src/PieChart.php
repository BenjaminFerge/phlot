<?php

namespace Phlot;

use Phlot\Math\Vector2;

class PieChart extends Chart
{
    public function draw($img, Vector2 $startv, Vector2 $sizev): void
    {
        $imgW = imagesx($img);
        $imgH = imagesy($img);
        $white = imagecolorallocate($img, 0xFF, 0xFF, 0xFF);
        $black = imagecolorallocate($img, 0x00, 0x00, 0x00);
        $rx = $sizev->x / 2;
        $ry = $sizev->y / 2;
        $centerX = $rx + $startv->x;
        $centerY = $ry + $startv->y;

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
                $centerX,
                $centerY,
                $rx,
                $ry,
                $startAngle,
                $endAngle,
                $color,
                IMG_ARC_PIE
            );

            // Border of element
            imagearc($img, $centerX, $centerY, $rx, $ry, $startAngle, $endAngle, $white);
            $startRad = deg2rad($startAngle);
            $endRad = deg2rad($endAngle);
            $r = $rx / 2;
            $x1 = $r * cos($startRad) + $centerX;
            $y1 = $r * sin($startRad) + $centerY;
            $x2 = $r * cos($endRad) + $centerX;
            $y2 = $r * sin($endRad) + $centerY;
            imageline($img, $centerX, $centerY, $x1, $y1, $white);
            imageline($img, $centerX, $centerY, $x2, $y2, $white);
            //---------------------------—---------------------------—---------
            
            $startAngle = $endAngle;
        }
    }
}
