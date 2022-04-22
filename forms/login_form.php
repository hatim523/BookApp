<?php

session_start();
if (isset($_POST['submit'])) {
    $username = $_POST['username'];
    $pass = $_POST["pass"];

    include "../models/auth_user.php";
    include "../utils.php";

    $login_result = AuthUser::login($username, $pass);

    if ($login_result == null) {
        echo "Incorrect credentials";
        redirect_to_login_page();
    }
    else if (gettype($login_result) != 'string') {
        redirect_to_home();
    }
    else {
        redirect_to_login_page();
    }
}

?>

