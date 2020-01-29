<?php

include "Connection.php";

class Login extends Model {

    public function validate($username, $password) {

        $uname = $this->conn->real_escape_string($username);
        $pass =  $this->conn->real_escape_string($password);

        if ($result = $this->conn->query("Select uname from users where uname='$uname' and pass='$pass';")) {
            if(!empty($result->fetch_row())) {
                return true;
            }
        }
        return false;


    }

}