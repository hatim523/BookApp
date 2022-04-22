<?php
include "../db/db_utils.php";
include "../db/constants.php";

class Book {
    private int $id;
    private string $name;
    private string $description;

    function __construct(int $book_id, string $book_name, string $book_desc) {
        $this->id = $book_id;
        $this->name = $book_name;
        $this->description = $book_desc;
    }

    public function get_id() {
        return $this->id;
    }

    public function get_name() {
        return $this->name;
    }

    public function get_description() {
        return $this->description;
    }

    public static function get_books_to_buy(string $username) {
        global $BOOKS_TO_BUY_QUERY;
        global $db_connection;

        $stmt = $db_connection->get_prepared_statement($BOOKS_TO_BUY_QUERY);
        $stmt->execute();

        $result = $stmt->get_result();

        $books = [];
        print_r($result->fetch_assoc());
    }

    public static function get_bought_books(string $username) {

    }

    private static function create_book_instance_from_result($result) {

    }
}