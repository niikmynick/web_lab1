<?php
// getting values from page
$x = floatval($_GET['x-value']);
$y = floatval($_GET['y-value']);
$r = $_GET['r-value'];

// script starting time
$start_time = microtime(true);

if ($_SERVER["REQUEST_METHOD"] === "GET") {
    $error_message = '';

//    checking values to prevent errors
    if (!is_numeric($r) || $r < 1 || $r > 3) {
        $error_message .= "Некорректное значение R\n";
    }

    if (!is_numeric($x) || $x < -5 || $x > 3) {
        $error_message .= "Некорректные координаты X\n";
    }

    if (!is_numeric($y) || $y < -3 || $y > 3) {
        $error_message .= "Некорректные координаты Y";
    }

    if ($error_message != '') {
        echo $error_message;
        exit;
    }

//    hit check
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

//    save results of test
    if ($flag) {
        $status = "In";
    } else {
        $status = "Out";
    }

//    form the response to client
    $response = '<tr>';
    $response .= '<td>' . $x . '</td>';
    $response .= '<td>' . $y . '</td>';
    $response .= '<td>' . $r . '</td>';
    $response .= '<td>' . $status . '</td>';
    $response .= '<td>' . date("Y-m-d H:i:s") . '</td>';
    $response .= '<td>' . (microtime(true) - $start_time) * 1000 . " ms" . '</td>';
    $response .= '</tr>';

//    send response
    echo $response;

} else {
//    according to the task - script only answers for requests w/ GET method
    die("This script only accepts GET requests.");
}
