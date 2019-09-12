<?php
require __DIR__.'/../vendor/autoload.php';

use Phlot\ChartArea;
use Phlot\PieChart;
use Phlot\Series;
use Phrism\Color;

$series = new Series('A', [3, 3, 3, 3, 5]);
$series->setColors([
    Color::randomWithAlpha(50),
    Color::random(),
    Color::random(),
    Color::random(),
    Color::random(),
]);
$chart = new PieChart($series, 300, 300);
$chartArea = new ChartArea(300, 300);
$chartArea->addChart($chart, 0, 0);
$color = new Color(100, 100, 240);
$chartArea->setBackgroundColor($color);
echo $chartArea;
