<?php

class EmailVerifier
{
    private $email;
    private $access_key = '06f2a95e402d6212a0cac5738c9fb260';

    public $errors = "";


    public function __construct($email)
    {
        $this->email = $email;
    }

    public function getEmail()
    {
        return $this->email;
    }

    public function verify()
    {
        $ch = curl_init('http://apilayer.net/api/check?access_key=' . $this->access_key . '&email=' . $this->email);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        $json = curl_exec($ch);
        curl_close($ch);

        // Decode JSON response:
        $validationResult = json_decode($json, true);
        if ($validationResult['smtp_check']) {
            return true;
        } else {
            $this->errors = "Please provide a proper email...";
            return false;
        }
    }
}
