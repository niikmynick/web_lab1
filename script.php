<?php
$x = floatval($_GET['x-value']);
$y = floatval($_GET['y-value']);
$r = $_GET['r-value'];

$start_time = microtime();
$out = "";
$maximum = 17;

$response = "";

// Check if the point is inside the area
$inside = ($x >= 0 && $y <= 0 && $x <= $r && $y >= -$r) ||
    ($x <= 0 && $y <= 0 && ($x * $x + $y * $y <= $r * $r)) ||
    ($x <= 0 && $y >= 0 && $y <= $x + $r);

//провека на присутсвие данных
if ($_SERVER['REQUEST_METHOD'] === 'GET') {

    //провекра на вхождение в область
    if ((($x * $x + $y * $y) <= $r * $r / 4 && $x >= 0 && $y <= 0) ||
        ($y + 2 * $x <= $r && $x >= 0 && $y >= 0) ||
        ($x <= 0 && $y <= 0 && $x >= (-1) * $r / 2 && $y >= (-1) * $r)) {
        $out = "Входит";
    } else {
        $out = "Не входит";
    }

    $response .= $x;
    $response .= ";";
    $response .= $y;
    $response .= ";";
    $response .= $r;
    $response .= ";";
    $response .= $out;
    $response .= ";";
    $response .= date("Y-m-d H:i:s");
    $response .= ";";
    $response .= microtime() - $start_time;
    $response .= "/";
    echo $response;

} else {
    echo "Ошибка";
}
