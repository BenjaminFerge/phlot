<?php

namespace Phlot;

use Phrism\Color;

class ChartArea
{
    private $charts = [];
    private $width;
    private $height;
    private $img;
    private $bgColor;

    public function __construct($width = 200, $height = 200)
    {
        $this->img = \imagecreate($width, $height);
        $this->width = $width;
        $this->height = $height;
        $this->bgColor = new Color(255, 255, 255);
    }
    
    public function addChart(Chart $chart, int $startX, int $startY)
    {
        $this->charts[] = compact('chart', 'startX', 'startY');
    }

    public function draw(): void
    {
        $bg = imagecolorallocate($this->img,
            $this->bgColor->getRed(),
            $this->bgColor->getGreen(),
            $this->bgColor->getBlue()
        );
        imagefill($this->img, 0, 0, $bg);
        for ($i = 0; $i < count($this->charts); $i++) {
            extract($this->charts[$i]);
            $chart->draw($i, $this->img, $startX, $startY);
        }
    }

    public function toBase64()
    {
        $this->draw();
        ob_start();
        \imagepng($this->img);
        $imgData = ob_get_clean();
        $imgBase64 = base64_encode($imgData);
        return $imgBase64;
    }

    public function toHTML(bool $return = false)
    {
        $img = "<img src='data:image/png;base64, {$this->toBase64()}' alt='picture' />";
        if ($return) {
            return $img;
        }
        echo $img;
    }

    public function imageContent()
    {
        $this->draw();
        \imagepng($this->img);
        header('Content-Type: image/png');
    }

    public function __toString(): string
    {
        return $this->toHTML(true);
    }

    public function getImage()
    {
        return $this->img;
    }

    /**
     * Get the value of bgColor
     */
    public function getBackgroundColor()
    {
        return $this->bgColor;
    }

    /**
     * Set the value of bgColor
     *
     * @return  self
     */
    public function setBackgroundColor(Color $bgColor)
    {
        $this->bgColor = $bgColor;
        return $this;
    }
}
