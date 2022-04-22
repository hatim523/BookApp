<?php
include "../db/db_utils.php";
include "../db/constants.php";
session_start();
class AuthUser {
    private string $username;
    private string $first_name;
    private string $last_name;

    public function __construct($username, $first_name, $last_name) {
        $this->username = $username;
        $this->first_name = $first_name;
        $this->last_name = $last_name;
    }

    public static function login(string $_username, string $pass) {
        global $LOGIN_QUERY;
        global $db_connection;

        $stmt = $db_connection->get_prepared_statement($LOGIN_QUERY);

        $stmt->bind_param("ss", $_username, $pass);
        $stmt->execute();
        $result = $stmt->get_result();
        if ($result->num_rows < 1)
            return null;

        # ASSUMPTION: usernames will be unique in db therefore max 1 result will be returned
        $user = $result->fetch_assoc();
        $_SESSION['login_status'] = true;
        $_SESSION['login_user'] = $user["username"];
        return new AuthUser($user["username"], $user["first_name"], $user["last_name"]);
    }

    public static function register(string $username, string $first_name, string $last_name, string $password) {
        sleep(1);
        if (!AuthUser::check_if_username_is_available($username)) {
            return "Username already in use";
        }

        global $REGISTER_QUERY;
        global $db_connection;

        $stmt = $db_connection->get_prepared_statement($REGISTER_QUERY);

        $stmt->bind_param("ssss", $username, $first_name, $last_name, $password);
        $stmt->execute();

        return AuthUser::login($username, $password);
    }

    private static function check_if_username_is_available(string $username): bool {
        global $USERNAME_DUPLICATE_CHECK_QUERY;
        global $db_connection;

        $stmt = $db_connection->get_prepared_statement($USERNAME_DUPLICATE_CHECK_QUERY);

        $stmt->bind_param("s", $username);
        $stmt->execute();

        $result = $stmt->get_result();
        return $result->num_rows < 1;
    }

    public function get_username(): string
    {
        return $this->username;
    }

    public function get_first_name(): string
    {
        return $this->first_name;
    }

    public function get_last_name(): string
    {
        return $this->last_name;
    }

    public function get_full_name(): string
    {
        return $this->first_name . " " . $this->last_name;
    }
}