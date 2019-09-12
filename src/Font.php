<?php

namespace Phlot;

use Phrism\Color;

class Font
{
    protected $family;
    protected $size;
    protected $style;
    protected $color;

    public function __construct($family, $size, $style, Color $color)
    {
        $this->family = $family;
        $this->size = $size;
        $this->style = $style;
        $this->color = $color;
    }

    public function getFontFile()
    {
        return $this->family . '-' . $this->style;
    }

    /**
     * Get the value of family
     */
    public function getFamily()
    {
        return $this->family;
    }

    /**
     * Set the value of family
     *
     * @return  self
     */
    public function setFamily($family)
    {
        $this->family = $family;

        return $this;
    }

    /**
     * Get the value of color
     */
    public function getColor()
    {
        return $this->color;
    }

    /**
     * Set the value of color
     *
     * @return  self
     */
    public function setColor(Color $color)
    {
        $this->color = $color;

        return $this;
    }

    /**
     * Get the value of style
     */
    public function getStyle()
    {
        return $this->style;
    }

    /**
     * Set the value of style
     *
     * @return  self
     */
    public function setStyle($style)
    {
        $this->style = $style;

        return $this;
    }

    /**
     * Get the value of size
     */
    public function getSize()
    {
        return $this->size;
    }

    /**
     * Set the value of size
     *
     * @return  self
     */
    public function setSize($size)
    {
        $this->size = $size;

        return $this;
    }
}
