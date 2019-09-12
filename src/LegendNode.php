<?php

namespace Phlot;

use Phrism\Color;

class LegendNode
{
    private $text;
    private $font;
    private $bgColor;
    private $borderColor;

    public function __construct($text, Font $font, Color $bgColor, Color $borderColor)
    {
        $this->text = $text;
        $this->font = $font;
        $this->bgColor = $bgColor;
        $this->borderColor = $borderColor;
    }

    public function draw($img, $startX, $startY, $width, $height)
    {
        $endX = $startX + $width;
        $endY = $startY + $height;
        imagefilledrectangle($img, $startX, $startY, $endX, $endY, imagecolor($img, $this->bgColor));
        imagerectangle($img, $startX, $startY, $endX, $endY, imagecolor($img, $this->borderColor));
        $fontColor = imagecolor($img, $this->font->getColor());
        \imagestring($img, $this->font->getFontFamily(), $startX, $startY, $this->text, $fontColor);
    }
}
