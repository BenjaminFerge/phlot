<?php
require __DIR__.'/../vendor/autoload.php';

use Phlot\ChartArea;
use Phlot\PieChart;
use Phlot\Series;
use Phrism\Color;

$series = new Series('A', [3, 3, 3, 3]);
$chart = new PieChart($series, 300, 300);
$chartArea = new ChartArea(300, 300);
$chartArea->addChart($chart, 0, 0);
$color = new Color(255, 255, 255);
echo $chartArea;