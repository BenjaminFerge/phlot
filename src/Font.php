<?php

namespace Phlot;

use Phrism\Color;

class Font
{
    protected $fontFamily;
    protected $color;

    public function __construct($fontFamily, Color $color)
    {
        $this->fontFamily = $fontFamily;
        $this->color = $color;
    }

    /**
     * Get the value of fontFamily
     */
    public function getFontFamily()
    {
        return $this->fontFamily;
    }

    /**
     * Set the value of fontFamily
     *
     * @return  self
     */
    public function setFontFamily($fontFamily)
    {
        $this->fontFamily = $fontFamily;

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
}
