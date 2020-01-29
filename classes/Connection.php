<?php

class Model
{
    private $host = "localhost";
    private $password = "admin";
    private $user = "kau";
    private $dbname = "login_system";

    public $error_msg = "";

    protected $conn;

    public function __construct()
    {
        $this->conn = new mysqli($this->host, $this->user, $this->password, $this->dbname);
    }

    protected function getData($sql)
    {
        $data = array();
        if ($result = $this->conn->query($sql)) {
            // while ($row = $result->fetch_object()) {
            //     array_push($data, array(
            //         $row->Firstname,
            //         $row->Lastname,
            //         $row->Salary,
            //         $row->Domain
            //     ));
            // }
            return $result->fetch_all(MYSQLI_ASSOC);
        }
        $this->error_msg = $this->conn->error;
        return false;
    }

    protected function insertData($sql, $types, $data)
    {

        $stmt = $this->conn->prepare($sql);
        if (!$stmt) {
            $this->error_msg = $this->conn->error;
            return false;
        }

        if(!$stmt->bind_param($types, ...$data)) {
            $this->error_msg = "Error binding data";
            return false;
        }

        if(!$stmt->execute()) {
            $this->error_msg = $this->conn->error;
            return false;
        }

        $stmt->close();
        return true;
    }
}
