<?php
require __DIR__.'/../vendor/autoload.php';

use Phlot\ChartArea;
use Phlot\Font;
use Phlot\PieChart;
use Phlot\Series;
use Phlot\Title;
use Phrism\Color;

$series = new Series('A', [3, 3, 3, 3, 5]);
$series->setColors([
    Color::randomWithAlpha(50),
    Color::random(),
    Color::random(),
    Color::random(),
    Color::random(),
]);
$series->setLabels([
    'alma',
    'körte',
    'kompót',
    'befőtt',
    'nyikhaj'
]);
$chart = new PieChart($series, 300, 300);
$chartArea = new ChartArea(300, 300);
$chartArea->addChart($chart);
$color = new Color(100, 100, 240, 100);
$chartArea->setBackgroundColor($color);
$titleFont = new Font(5, new Color(0, 0, 0));
$title = new Title("Title\nnew line\ttab", $titleFont);
$chartArea->setTitle($title);
$chartArea->displayLegend(true);
echo $chartArea;
