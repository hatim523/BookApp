<?php

if (isset($_GET['fetch'])) {
    include "../models/book.php";
    session_start();
    $books = Book::get_bought_books($_SESSION['login_user']);
    $serialized_books = [];
    foreach ($books as $book) {
        $serialized_books[] = $book->serialize_object();
    }

    $data = ["status" => true, "books" => $serialized_books];
    echo json_encode($data);
}
