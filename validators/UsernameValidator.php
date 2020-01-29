<?php

class UsernameValidator {

    private $fullName;

    public $errors = "";

    public function __construct($form_info)
    {
        $this->fullName = trim($form_info["firstName"]) . " " . trim($form_info["lastName"]);
    }

    public function getFullName()
    {
        return $this->fullName;
    }

    public function validate()
    {
        
        if (preg_match("/[a-zA-Z]+ [A-Za-z]+/", $this->fullName)) return true;

        $this->errors = "Full name should not contain any digits";
        return false;
    }

}