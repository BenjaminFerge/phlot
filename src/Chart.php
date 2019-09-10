<?php

namespace XChart;

abstract class Chart
{
    protected $img;
    protected $width;
    protected $height;

    public function __construct(int $width = 200, int $height = 200)
    {
        $this->width = $width;
        $this->height = $height;
        $this->img = \imagecreate($width, $height);
        $this->draw();
    }

    abstract public function draw(): void;

    public function toBase64()
    {
        ob_start (); 
        \imagepng($this->img);
        $imgData = ob_get_clean();
        $imgBase64 = base64_encode($imgData);
        return $imgBase64;
    }

    public function toHTML(bool $return = false)
    {
        $img = "<img src='data:image/png;base64, {$this->toBase64()}' alt='picture' />";
        if ($return)
            return $img;
        echo $img;
    }

    public function imageContent()
    {
        \imagepng($this->img);
        header('Content-Type: image/png');
    }

    public function __toString(): string
    {
        return $this->toHTML(true);
    }
}