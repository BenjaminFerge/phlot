<?php

namespace Phlot;

use Phrism\Color;

class LegendNode
{
    private $color;
    private $text;

    public function __construct(Color $color, $text)
    {
        $this->color = $color;
        $this->text = $text;
    }
}
