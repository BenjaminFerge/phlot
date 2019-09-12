<?php
require __DIR__.'/../vendor/autoload.php';

use Phlot\ChartArea;
use Phlot\PieChart;
use Phlot\Series;

$series = new Series('A', [3, 3, 3, 3]);
$chart = new PieChart($series, 300, 300);
$chartArea = new ChartArea(300, 300);
$chartArea->addChart($chart, 0, 0);
echo $chartArea;