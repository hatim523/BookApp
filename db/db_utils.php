<?php

class DB {
    protected string $hostname;
    protected string $username;
    protected string $password;
    protected string $database;
    protected $connection;

    function __construct() {
        $this->hostname = "localhost";
        $this->username = "root";
        $this->password = "root";
        $this->database = "trainingApp";
        $this->connection = null;
    }

    public function establish_connection() {
        if ($this->connection && $this->connection->connect_errno == 0)
            return $this->connection;

        $this->connection = mysqli_connect($this->hostname, $this->username, $this->password, $this->database);
        if ($this->connection->connect_errno > 0) {
            die("Error establishing connection");
        }
        return $this->connection;
    }

    public function get_prepared_statement(string $query) {
        $this->establish_connection();
        return $this->connection->prepare($query);
    }
}

$db_connection = new DB();
