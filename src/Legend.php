<?php

namespace Phlot;

use Phrism\Color;

class Legend
{
    private $nodes;
    private $font;

    public function __construct($nodes = [], Font $font = null)
    {
        $this->nodes = $nodes;
        $this->font = $font;
    }
    
    public function draw($img, int $startX, int $startY, int $width, int $height): void
    {
        $legendBg = imagecolor($img, new Color(200, 200, 200));
        $legendBorder = imagecolor($img, new Color(125, 125, 125));
        $endX = $startX + $width;
        $endY = $startY + $height;
        imagefilledrectangle($img, $startX, $startY, $endX, $endY, $legendBg);
        imagerectangle($img, $startX, $startY, $endX, $endY, $legendBorder);
        $nStartX = $startX;
        $nStartY = $startY;
        foreach ($this->nodes as $n) {
            $n->draw($img, $nStartX, $nStartY, 50, 20);
            $nStartY += 20;
        }
    }
}
