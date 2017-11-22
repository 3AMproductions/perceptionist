<?php
require_once('pie_chart.class.php');
// create chart
$chart = new Pie_Chart;
// set properties
$chart->ChartRadius = 150;
$chart->ChartFontHeight = 10;
//$chart->ChartData = array('Unresolved'=>25, 'Service'=>40, 'Complaint'=>78,'Information'=>20);
$chart->ChartData = array('Unresolved'=>array(100,'#FF0000','report.php?view=unresolved'), 'Service'=>array(100,'#00FF00','report.php?view=service'), 'Complaint'=>array(100,'#0000FF','report.php?view=complaint'), 'Information'=>array(100,'#FFFF00','report.php?view=information'));
// allocate colors
$chart->colorBody = 'white';
$chart->colorBorder = 'black';
$chart->colorText = 'black';
//$chart->colorSlice = array('#FF0000','#00FF00','#0000FF','#FFFF00','#FF00FF','#00FFFF','#990000','#009900','#000099','#999900','#990099','#009999');
// allocate widths
$chart->widthBorder = 7;
$chart->widthPieSliceBorder = 1;
$chart->widthLegendColorBorder = 1;

// light source
$chart->lightHeight = 30;//in degrees
$chart->lightSource = 225;//degrees from 3:00

// create Pie Chart
$chart->print_pie_chart();

exit;
?>