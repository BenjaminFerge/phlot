<?php

namespace Phlot;

use Phrism\Color;

class Series
{
    private $name;
    private $data;
    private $colors = [];

    public function __construct($name, $data, $colors = [])
    {
        $this->name = $name;
        $this->data = $data;
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
}
