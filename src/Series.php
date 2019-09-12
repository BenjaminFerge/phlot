<?php

namespace Phlot;

use Phrism\Color;

class Series
{
    private $name;
    private $data;
    private $colors = [];
    private $labels = [];

    public function __construct($name, $data, $labels = [], $colors = [])
    {
        $this->name = $name;
        $this->data = $data;
        $this->labels = $labels;
        $this->colors = $colors;
    }

    /**
     * Get the value of name
     */
    public function getName()
    {
        return $this->name;
    }

    /**
     * Get the value of data
     */
    public function getData()
    {
        return $this->data;
    }

    /**
     * Get the value of colors
     */
    public function getColors()
    {
        return $this->colors;
    }

    /**
     * Set the value of colors
     *
     * @return  self
     */
    public function setColors($colors)
    {
        assert($this->getLength() === count($colors));
        $this->colors = $colors;
        return $this;
    }

    public function hasColors()
    {
        return count($this->colors) > 0;
    }

    public function getLength()
    {
        return count($this->data);
    }

    public function useRandomColors(bool $withAlpha = false)
    {
        for ($i = 0; $i < $this->getLength(); $i++) {
            $this->colors[$i] = Color::random($withAlpha);
        }
    }

    public function useRandomColorsWithAlpha(int $alpha)
    {
        assert($alpha >= 0 && $alpha <= 127);
        for ($i = 0; $i < $this->getLength(); $i++) {
            $this->colors[$i] = Color::randomWithAlpha($alpha);
        }
    }

    /**
     * Get the value of labels
     */
    public function getLabels()
    {
        return $this->labels;
    }

    /**
     * Set the value of labels
     *
     * @return  self
     */
    public function setLabels($labels)
    {
        assert($this->getLength() === count($labels));
        $this->labels = $labels;
        return $this;
    }
}
