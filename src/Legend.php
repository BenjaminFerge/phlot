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
        $maxSize->x -= 1;
        $legendBg = imagecolor($img, new Color(200, 200, 200));
        $legendBorder = imagecolor($img, new Color(125, 125, 125));
        $nodec = count($this->nodes);
        $nPaddingX = 5;
        $nodeSize = Vector2::fromVector2($maxSize);
        $nodeSize->y = $maxSize->y / $nodec;
        $nodeSize->x -= $nPaddingX * 2;
        $nPaddingY = 10;

        $endLegend = Vector2::fromVector2($startv);
        $endLegend->add($maxSize);
        
        imagefilledrectangle($img, $startv->x, $startv->y, $endLegend->x, $endLegend->y, $legendBg);
        imagerectangle($img, $startv->x, $startv->y, $endLegend->x, $endLegend->y, $legendBorder);
        $nStartv = Vector2::fromVector2($startv);
        $nStartv->y += $nPaddingY / 2;
        $nStartv->x += $nPaddingX;
        foreach ($this->nodes as $n) {
            $n->draw($img, $nStartv, $nodeSize);
            $nStartv->y += $nodeSize->y + $nPaddingY;
        }
    }
}
