<?php

namespace XChart;

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
            $endAngle = 360 * $val + $startAngle;
            imagefilledarc($img, $centerX, $centerY, $rx, $ry, $startAngle, $endAngle, $color, IMG_ARC_PIE);
            $startAngle = $endAngle;
        }
    }
}
