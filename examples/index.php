<pre><?php
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
$pieChartArea = new ChartArea(300, 300);
$pieChartArea->addChart($chart);
$color = new Color(100, 100, 240, 100);
$pieChartArea->setBackgroundColor($color);
$titleFont = new Font('OpenSans', 16, 'Regular', new Color(0, 0, 0));
$title = new Title("Title long long long long long long text", $titleFont);
$pieChartArea->setTitle($title);
$pieChartArea->displayLegend(true);
$pieChartArea->toHTML();
