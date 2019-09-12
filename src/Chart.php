<?php

namespace Phlot;

use Phrism\Color;

abstract class Chart
{
    protected $series;
    protected $width;
    protected $height;
    protected $defaultElemColor;

    public function __construct(Series $series, $width, $height)
    {
        $this->series = $series;
        $this->width = $width;
        $this->height = $height;
        $this->defaultElemColor = new Color(200, 200, 200);
    }

    abstract public function draw($img, int $startX, int $startY): void;

    /**
     * Get the value of series
     */ 
    public function getSeries()
    {
        return $this->series;
    }
}
