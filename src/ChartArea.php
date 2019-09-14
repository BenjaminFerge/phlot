<?php

namespace Phlot;

use Phlot\Math\Vector2;
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

    public function draw($img, Vector2 $startv, Vector2 $maxSize): void
    {
        $imgW = imagesx($img);
        $imgH = imagesy($img);
        $imgWCenter = $imgW / 2;
        $imgHCenter = $imgH / 2;
        $bg = imagecolor($img, $this->bgColor);
        imagefill($img, 0, 0, $bg);

        if ($this->title) {
            $this->title->draw($img);
        }
        for ($i = 0; $i < count($this->charts); $i++) {
            $chart = $this->charts[$i];
            $chartStartv = new Vector2(0, 0);
            if ($this->displayLegend) {
                $legendStartv = Vector2::fromVector2($startv);
                $legendMaxSize = Vector2::fromVector2($legendStartv);
                $legendMaxSize->y += $imgH;
                $legendMaxSize->x += $imgW;
                switch ($this->legendPosition) {
                    case self::LEGEND_POSITION_RIGHT:
                        default_legend_position:
                        $chartStartv->x -= $this->legendPadding;
                        $legendStartv->x += $this->legendPadding + $imgWCenter;
                        break;
                    case self::LEGEND_POSITION_LEFT:
                        $chartStartv->x += $this->legendPadding;
                        $legendStartv->x -= ($this->legendPadding - $imgWCenter + $legendSizev->x);
                        break;
                    case self::LEGEND_POSITION_UP:
                        // TODO
                        $chartStartv->y += $this->legendPadding;
                        $legendStartv->y -= $this->legendPadding;
                        break;
                    case self::LEGEND_POSITION_DOWN:
                        // TODO
                        $chartStartv->y -= $this->legendPadding;
                        $legendStartv->y += $this->legendPadding;
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
                $legend->draw($img, $legendStartv, $legendMaxSize);
            }
            $chart->draw($img, $chartStartv, $maxSize);
        }
    }

    public function toBase64()
    {
        $startv = new Vector2(0, 0);
        // $sizev = new Vector2($this->width, $this->height);
        $maxSize = new Vector2($this->width, $this->height);
        $this->draw($this->img, $startv, $maxSize);
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
