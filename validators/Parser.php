<?php

class Parser
{

    private $str;

    public $parsed_str = array();
    public $error = "";

    public function __construct($str)
    {
        $this->str = trim($str);
    }

    private function get_lines()
    {
        return (explode("\n", $this->str));
    }

    public function parse()
    {
        $parsed_data = array();
        foreach ($this->get_lines() as $line) {
            preg_match("/^([A-Za-z]+)\|(\d+)$/", trim($line), $matches);
            if (!empty($matches)) {
                array_push($parsed_data, array(
                    "subject" => $matches[1],
                    "marks" => $matches[2]
                ));
            }
        }

        if(empty($parsed_data)) {
            $this->error = "Please put your marks in the correct format...";
            return false;
        }

        $this->parsed_str = $parsed_data;
        return true;
    }
}
