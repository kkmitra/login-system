<?php

require "Parser.php";
require "FileUploader.php";
require "EmailVerifier.php";

class FormHandler
{

    private $fullName;

    private $fileUploader;
    private $parser;

    public $errors;
    public $filePath;
    public $marks;
    public $phoneNumber;
    public $emailVerifier;
    public $email;

    public function __construct($form_info, $file_info)
    {
        $this->fullName = trim($form_info["firstName"]) . " " . trim($form_info["lastName"]);
        $this->phoneNumber = trim($form_info["phoneNumber"]);
        $this->email = trim($form_info["email"]);
        $this->emailVerifier = new EmailVerifier(trim($form_info["email"]));
        $this->fileUploader = new FileUploader($file_info["name"], $file_info["tmp_name"]);
        $this->parser = new Parser($form_info["marks"]);
    }

    public function getFullName()
    {
        return $this->fullName;
    }

    private function validateFullName()
    {
        return (preg_match("/[a-z]+ [a-z]+/", $this->fullName));
    }

    private function validatePhoneNumber()
    {
        return (preg_match("/\+91\d{10}/", $this->phoneNumber));
    }

    private function validateEmail()
    {
        // Regex Link: http://regexlib.com/REDetails.aspx?regexp_id=35
        // return (preg_match("/[a-zA-Z0-9_\-\.]+@[a-zA-Z0-9_\-\.]+\.[a-zA-Z]{2,3}/", $this->email));
        return $this->emailVerifier->verify();
    }

    public function validateForm()
    {
        if (!$this->validateEmail()) {
            $this->errors = "Email must be valid";
            return false;
        }

        if (!$this->validateFullName()) {
            $this->errors = "Full name should not contain any digits";
            return false;
        }

        if (!$this->validatePhoneNumber()) {
            $this->errors = "Phone number must be valid and start with +91";
            return false;
        }

        if (!$this->validateEmail()) {
            $this->errors = "Email must be valid";
            return false;
        }


        $fP = $this->fileUploader->upload();

        if ($fP === null) {
            $this->errors = "Error uploading failed";
            return false;
        }

        $this->filePath = $fP;
        $this->marks = $this->parser->parse();
        return true;
    }
}
