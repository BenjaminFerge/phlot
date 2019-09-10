<?php

namespace XChart;

class PieChart extends Chart
{
    public function draw(): void
    {
        $white = \imagecolorallocate($this->img,0xFF,0xFF,0xFF);
        $black = \imagecolorallocate($this->img,0x00,0x00,0x00);
        \imagefilledrectangle($this->img,50,50,150,150,$black);
    }
}