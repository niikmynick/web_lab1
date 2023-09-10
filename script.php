<?php
$x = floatval($_GET['x-value']);
$y = floatval($_GET['y-value']);
$r = $_GET['r-value'];

$start_time = microtime(true);

if ($_SERVER["REQUEST_METHOD"] === "GET") {

    $flag = false;
    if ($x >= 0) {
        if ($y >= 0) {
            $flag = ($x <= $r and $y <= $r);
        } else {
            $flag = ($x <= ($r / 2) and $y >= -$r);
        }
    } else {
        if ($y >= 0) {
            $flag = ($x >= -($r / 2) and $y <= ($r / 2));
        }
    }

    if ($flag) {
        $status = "In";
    } else {
        $status = "Out";
    }

    $response = '<tr>';
    $response .= '<td>' . $x . '</td>';
    $response .= '<td>' . $y . '</td>';
    $response .= '<td>' . $r . '</td>';
    $response .= '<td>' . $status . '</td>';
    $response .= '<td>' . date("Y-m-d H:i:s") . '</td>';
    $response .= '<td>' . (microtime(true) - $start_time) * 1000 . " ms" . '</td>';
    $response .= '</tr>';

    echo $response;

} else {
    die("This script only accepts GET requests.");
}
