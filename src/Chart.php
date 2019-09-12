<?php

namespace Phlot;

abstract class Chart
{
    protected $series;
    protected $width;
    protected $height;

    public function __construct(Series $series, $width, $height)
    {
        $this->series = $series;
        $this->width = $width;
        $this->height = $height;
    }

    abstract public function draw(int $idx, $img, int $startX, int $startY): void;
}
