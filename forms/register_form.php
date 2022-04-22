<?php

if (isset($_POST['username'])) {
    include "../models/auth_user.php";

    $register_result = AuthUser::register(
        $_POST['username'],
        $_POST['first_name'],
        $_POST['last_name'],
        $_POST['password']
    );

    if (gettype($register_result) == 'string')
        $resp = ["status" => false, "msg" => $register_result];
    else
        $resp = ["status" => true];

    echo json_encode($resp);
}