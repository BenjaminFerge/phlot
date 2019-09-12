<?php

namespace Phlot;

use Phlot\Math\Vector2;
use Phrism\Color;

class LegendNode implements Drawable
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

    public function draw($img, Vector2 $startv, Vector2 $sizev): void
    {
        $endv = Vector2::fromVector2($startv);
        $endv->add($sizev);
        imagefilledrectangle($img, $startv->x, $startv->y, $endv->x, $endv->y, imagecolor($img, $this->bgColor));
        imagerectangle($img, $startv->x, $startv->y, $endv->x, $endv->y, imagecolor($img, $this->borderColor));
        $fontColor = imagecolor($img, $this->font->getColor());
        $fontSize = $this->font->getSize();
        imagettftext($img, $fontSize, 0, $startv->x, $startv->y + $fontSize, $fontColor, $this->font->getFontFile(), $this->text);
    }
}
