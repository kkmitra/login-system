<?php

class PHValidator {

    private $phone_no;

    public $errors;

    public function __construct($form_info)
    {
        $this->phone_no = trim($form_info["phone_no"]);
    }

    public function getPhoneNumber()
    {
        return $this->phone_no;
    }

    public function validate()
    {
        
        if (preg_match("/\+91\d{10}/", $this->phone_no)) return true;

        $this->errors = "Please enter a valid phone number...";
        return false;
    }

}