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
    private $title;
    private $displayLegend = true;
    private $legendPadding = 50;
    private $legendPosition = self::LEGEND_POSITION_RIGHT;
    private $pre_gdfontpath;
    const LEGEND_POSITION_LEFT = 0;
    const LEGEND_POSITION_RIGHT = 1;
    const LEGEND_POSITION_UP = 2;
    const LEGEND_POSITION_DOWN = 3;

    public function __construct($width = 200, $height = 200)
    {
        $this->pre_gdfontpath = getenv('GDFONTPATH');
        putenv('GDFONTPATH=' . realpath(__DIR__.'/../assets/fonts'));
        $this->img = \imagecreate($width, $height);
        $this->width = $width;
        $this->height = $height;
        $this->bgColor = new Color(255, 255, 255);
    }

    public function __destruct()
    {
        putenv('GDFONTPATH=' . $this->pre_gdfontpath);
    }

    public function displayLegend(bool $show)
    {
        $this->displayLegend = $show;
    }
    
    public function addChart(Chart $chart)
    {
        $this->charts[] = $chart;
    }

    public function draw(): void
    {
        $imgW = imagesx($this->img);
        $imgH = imagesy($this->img);
        $imgWCenter = $imgW / 2;
        $imgHCenter = $imgH / 2;
        $bg = imagecolor($this->img, $this->bgColor);
        imagefill($this->img, 0, 0, $bg);

        if ($this->title) {
            $this->title->draw($this->img);
        }
        for ($i = 0; $i < count($this->charts); $i++) {
            $chart = $this->charts[$i];
            $startX = 0;
            $startY = 0;
            if ($this->displayLegend) {
                $legendStartX = $startX;
                $legendStartY = $startY;
                $legendW = 100;
                $legendH = 100;
                switch ($this->legendPosition) {
                    case self::LEGEND_POSITION_RIGHT:
                        default_legend_position:
                        $startX -= $this->legendPadding;
                        $legendStartX += $this->legendPadding + $imgWCenter;
                        break;
                    case self::LEGEND_POSITION_LEFT:
                        $startX += $this->legendPadding;
                        $legendStartX -= ($this->legendPadding - $imgWCenter + $legendW);
                        break;
                    case self::LEGEND_POSITION_UP:
                        // TODO
                        $startY += $this->legendPadding;
                        $legendStartY -= $this->legendPadding;
                        break;
                    case self::LEGEND_POSITION_DOWN:
                        // TODO
                        $startY -= $this->legendPadding;
                        $legendStartY += $this->legendPadding;
                        break;
                    default:
                        trigger_error(
                            "Invalid legendPosition parameter ({$this->legendPosition}). 
                            Using LEGEND_POSITION_RIGHT\n",
                            E_USER_WARNING
                        );
                        goto default_legend_position;
                }
                $legendFont = new Font('OpenSans', 8, 'Regular', new Color(0, 0, 0));
                $series = $chart->getSeries();
                $legendNodes = array_map(function ($label, $color) use ($legendFont) {
                    return new LegendNode($label, $legendFont, $color, new Color(0, 0, 0));
                }, $series->getLabels(), $series->getColors());

                $legend = new Legend($legendNodes, $legendFont);
                $legend->draw($this->img, $legendStartX, $legendStartY, $legendW, $legendH);
            }
            $chartWidth = 100;
            $chartHeight = 100;
            $chart->draw($this->img, $startX, $startY, $chartWidth, $chartHeight);
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

    /**
     * Get the value of title
     */
    public function getTitle()
    {
        return $this->title;
    }

    /**
     * Set the value of title
     *
     * @return  self
     */
    public function setTitle(Title $title)
    {
        $this->title = $title;
        return $this;
    }
}
