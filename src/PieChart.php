<?php

namespace Phlot;

class PieChart extends Chart
{
    public function draw(int $idx, $img, int $startX, int $startY): void
    {
        $imgW = imagesx($img);
        $imgH = imagesy($img);
        $white = imagecolorallocate($img, 0xFF, 0xFF, 0xFF);
        $black = imagecolorallocate($img, 0x00, 0x00, 0x00);
        $rx = $this->width / 2;
        $ry = $this->height / 2;
        $centerX = $rx + $startX;
        $centerY = $ry + $startY;

        $data = $this->series->getData();
        $total = array_sum($data);
        $startAngle = 0;
        for ($i = 0; $i < count($data); $i++) {
            $p = $data[$i];
            $val = $p / $total;
            $color = (($i % 2 == 0) ? $black : $white);
            $color = imagecolorallocate(
                $img,
                $this->defaultElemColor->getRed(),
                $this->defaultElemColor->getGreen(),
                $this->defaultElemColor->getBlue()
            );
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
            $x1 = $rx * cos($startRad) + $centerX;
            $y1 = $ry * sin($startRad) + $centerY;
            $x2 = $rx * cos($endRad) + $centerX;
            $y2 = $ry * sin($endRad) + $centerY;
            imageline($img, $centerX, $centerY, $x1, $y1, $white);
            imageline($img, $centerX, $centerY, $x2, $y2, $white);
            //---------------------------—---------------------------—---------
            
            $startAngle = $endAngle;
        }
    }
}
