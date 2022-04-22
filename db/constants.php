<?php

$LOGIN_QUERY = "Select * from auth_user where username = ? and password = ?";
$USERNAME_DUPLICATE_CHECK_QUERY = "Select * from auth_user where username = ?";
$REGISTER_QUERY = "INSERT INTO auth_user (username, first_name, last_name, password) VALUES (?, ?, ?, ?)";

$BOUGHT_BOOKS_QUERY = "SELECT * FROM book where book.id IN (SELECT book_id from user_book where user_book.user_id = ?);";
$BOOKS_TO_BUY_QUERY = "SELECT * FROM book where book.id NOT IN (SELECT book_id from user_book where user_book.user_id = ?);";
$BUY_BOOK_QUERY = "INSERT INTO user_book (user_id, book_id) VALUES (?, ?)";
