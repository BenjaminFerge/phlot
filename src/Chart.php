<?php

namespace Phlot;

use Phlot\Math\Vector2;
use Phrism\Color;

abstract class Chart implements Drawable
{
    protected $series;
    protected $defaultElemColor;

    public function __construct(Series $series)
    {
        $this->series = $series;
        $this->defaultElemColor = new Color(200, 200, 200);
    }

    abstract public function draw($img, Vector2 $startv, Vector2 $maxSize): void;

    /**
     * Get the value of series
     */ 
    public function getSeries()
    {
        return $this->series;
    }
}
