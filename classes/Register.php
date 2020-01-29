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
            $this->error_msg = "username should not be empty";
            return false;
        }

        if (!$this->insertData(
            "insert into users values(?, ?)",
            "ss",
            array($username, $password)
        )) {
            $this->error_msg = "User already exists....";
            return false;
        }

        return true;
    }
}
