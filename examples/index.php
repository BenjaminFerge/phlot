<?php
require __DIR__.'/../vendor/autoload.php';

use XChart\ChartArea;
use XChart\PieChart;
use XChart\Series;

$series = new Series('A', [1, 2, 3, 4, 5]);
$chart = new PieChart($series, 100, 100);
$chartArea = new ChartArea();
$chartArea->addChart($chart, 0, 0);
echo $chartArea;