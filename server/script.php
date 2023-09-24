<?php

function validate_number($val, $start, $end){
    return isset($val) && is_numeric($val) && ($val>$start) && ($val<$end);
}

function validate_mark($val, $start, $end){
    return isset($val) && is_numeric($val) && ($val>=$start) && ($val<=$end);
}


// start / continue user session
session_start();

if (!isset($_SESSION['data']))
    $_SESSION['data'] = array();


// check request method
if ($_SERVER["REQUEST_METHOD"] === "GET") {

    // get values from page
    $x = $_GET['x-value'];
    $y = $_GET['y-value'];
    $r = $_GET['r-value'];
    $timezone = $_GET['timezone'];

    // script start time
    $start_time = microtime(true);

    // input check
    $error_message = 'Invalid input. Check this variables:';
    $error_flag = false;
    if (!validate_number($x, -5, 3)) {
        $error_message .= ' X';
        $error_flag = true;
    }

    if (!validate_number($y, -3, 3)) {
        $error_message .= ' Y';
        $error_flag = true;
    }

    if (!validate_mark($r, 1, 3)) {
        $error_message .= ' R';
        $error_flag = true;
    }

    // answer with error 400
    if ($error_flag) {
        http_response_code(400);
        die($error_message);
    }

    // format values from page to numeric types
    $x = floatval($x);
    $y = floatval($y);
    $r = floatval($r);

    // hit check
    $hit_flag = false;
    if ($x >= 0) {
        if ($y >= 0) {
            $hit_flag = ($x + $y <= $r);
        } else {
            $hit_flag = ($x <= ($r / 2) and $y >= -$r);
        }
    } else {
        if ($y >= 0) {
            $hit_flag = ($x**2 + $y**2 <= $r/2**2);
        }
    }

    $answer = array(
        "x"=>$x,
        "y"=>$y,
        "r"=>$r,
        "status"=>$hit_flag ? "In": "Out",
        "current_time"=>date("Y-m-d H:i:s", time()-$timezone*60),
        "script_time"=>round((microtime(true) - $start_time) * 1000, 2),
    );

    $_SESSION['data'][] = $answer;

    echo json_encode($_SESSION['data']);

} else {
//    according to the task - script only answers for requests w/ GET method
    http_response_code(405);
    die("This script only accepts GET requests.");
}
