<?php

session_start();

if (isset($_GET['logout'])) {
    unset($_SESSION['login_status']);
    unset($_SESSION['login_user']);
    $data = ["logout" => true];
    echo json_encode($data);
}
