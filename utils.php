<?php

session_start();

function redirect_to_home() {
    if (is_user_logged_in())
        header("Location: /trainingApp/pages/home.php", true);
    else
        redirect_to_login_page();
}

function redirect_to_login_page() {
    if (is_user_logged_in())
        redirect_to_home();
    else
        header("Location: /trainingApp/pages/index.php", true);
}

function redirect_to_register_page() {
    if (is_user_logged_in())
        redirect_to_home();
    else
        header("Location: /trainingApp/pages/register.php", true);
}

function is_user_logged_in() : bool {
    return isset($_SESSION['login_status']) && $_SESSION['login_status'];
}

?>