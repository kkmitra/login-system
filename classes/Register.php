<?php

include "Connection.php";

class Register extends Model
{

    private function validate($user, $pass)
    {

        if ($user == "" || $pass == "") {
            return false;
        }

        return true;
    }

    public function addUser($username, $password)
    {

        if (!$this->validate($username, $password)) {
            $this->error_msg = "username or password should not be empty";
            return false;
        }

        // $uname = $this->conn->real_escape_string($username);
        // $pass =  $this->conn->real_escape_string($password);

        $uname = htmlspecialchars($username);
        $pass = htmlspecialchars($password);

        if (!$this->insertData(
            "insert into users values(?, ?)",
            "ss",
            array($uname, $pass)
        )) {
            $this->error_msg = "User already exists....";
            return false;
        }

        return true;
    }
}
