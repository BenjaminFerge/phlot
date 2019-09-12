<?php

namespace Phlot;

use Phlot\Math\Vector2;
use Phrism\Color;

class Legend implements Drawable
{
    private $nodes;
    private $font;

    public function __construct($nodes = [], Font $font = null)
    {
        $this->font = $font;
        $this->nodes = $nodes;
    }
    
    public function draw($img, Vector2 $startv, Vector2 $sizev): void
    {
        $legendBg = imagecolor($img, new Color(200, 200, 200));
        $legendBorder = imagecolor($img, new Color(125, 125, 125));
        $endX = $startv->x + $sizev->x;
        $endY = $startv->y + $sizev->y;
        imagefilledrectangle($img, $startv->x, $startv->y, $endX, $endY, $legendBg);
        imagerectangle($img, $startv->x, $startv->y, $endX, $endY, $legendBorder);
        $nStartv = Vector2::fromVector2($startv);
        $nSizev = new Vector2(50, 20);
        foreach ($this->nodes as $n) {
            $n->draw($img, $nStartv, $nSizev);
            $nStartv->y += 20;
        }
    }
}
