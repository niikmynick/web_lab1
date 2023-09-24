<?php
session_set_cookie_params(0);

session_start();

if(isset($_SESSION['data'])){
    echo json_encode($_SESSION['data']);
}
