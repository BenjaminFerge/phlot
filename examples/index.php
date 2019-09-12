<?php
require __DIR__.'/../vendor/autoload.php';

use Phlot\ChartArea;
use Phlot\PieChart;
use Phlot\Series;
use Phrism\Color;

$series = new Series('A', [3, 3, 3, 3, 5]);
$series->setColors([
    new Color(rand(0, 255), rand(0, 255), rand(0, 255)),
    new Color(rand(0, 255), rand(0, 255), rand(0, 255)),
    new Color(rand(0, 255), rand(0, 255), rand(0, 255)),
    new Color(rand(0, 255), rand(0, 255), rand(0, 255)),
    new Color(rand(0, 255), rand(0, 255), rand(0, 255)),
]);
$chart = new PieChart($series, 300, 300);
$chartArea = new ChartArea(300, 300);
$chartArea->addChart($chart, 0, 0);
$color = new Color(100, 100, 240);
$chartArea->setBackgroundColor($color);
echo $chartArea;
