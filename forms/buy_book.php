<?php

if (isset($_POST['book_id'])) {
    include "../models/book.php";
    session_start();

    $book_id = $_POST['book_id'];

    $resp = Book::buy_book($_SESSION['login_user'], $book_id);
    if (gettype($resp) == 'string')
        $data = ["status" => false, "msg" => $resp];
    else
        $data = ["status" => true];
    echo json_encode($data);
}