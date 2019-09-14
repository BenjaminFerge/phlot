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
    
    public function draw($img, Vector2 $startv, Vector2 $maxSize): void
    {
        $legendBg = imagecolor($img, new Color(200, 200, 200));
        $legendBorder = imagecolor($img, new Color(125, 125, 125));
        $end = Vector2::fromVector2($startv);
        $nodec = count($this->nodes);
        $nodeDiv = 15;
        $nodePadding = 10;
        $nMaxSize = Vector2::fromVector2($startv);
        $nMaxSize->divScalar($nodeDiv);
        $end->y += $nodec * ($nMaxSize->y + $nodePadding);
        $end->x += $nMaxSize->x / 3;
        
        imagefilledrectangle($img, $startv->x, $startv->y, $end->x, $end->y, $legendBg);
        imagerectangle($img, $startv->x, $startv->y, $end->x, $end->y, $legendBorder);
        $nStartv = Vector2::fromVector2($startv);
        $nStartv->y += $nodePadding / 2;
        $nStartv->x += 5;
        foreach ($this->nodes as $n) {
            $n->draw($img, $nStartv, $nMaxSize);
            $nStartv->y += $nMaxSize->y + $nodePadding;
        }
    }
}
