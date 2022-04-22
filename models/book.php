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
        $stmt->bind_param("s", $username);
        $stmt->execute();

        $result = $stmt->get_result();

        $books = [];
        while ($row = $result->fetch_assoc()) {
            $books[] = Book::create_book_instance_from_result($row);
        }
        sleep(1);
        return $books;
    }

    public static function get_bought_books(string $username) {
        global $BOUGHT_BOOKS_QUERY;
        global $db_connection;

        $stmt = $db_connection->get_prepared_statement($BOUGHT_BOOKS_QUERY);
        $stmt->bind_param("s", $username);
        $stmt->execute();

        $result = $stmt->get_result();

        $books = [];
        while ($row = $result->fetch_assoc()) {
            $books[] = Book::create_book_instance_from_result($row);
        }
        sleep(0.5);
        return $books;
    }

    public function serialize_object() {
        return ["id" => $this->id, "name" => $this->name, "description" => $this->description];
    }

    private static function create_book_instance_from_result($result): Book {
        return new Book($result['id'], $result['name'], $result['description']);
    }

    public static function buy_book(string $username, int $book_id) {
        if (!$username) {
            return "Please login to continue";
        }

        global $BUY_BOOK_QUERY;
        global $db_connection;

        $stmt = $db_connection->get_prepared_statement($BUY_BOOK_QUERY);
        $stmt->bind_param("si", $username, $book_id);
        $stmt->execute();

        return true;
    }
}