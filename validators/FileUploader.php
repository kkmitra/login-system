<?php

class FileUploader
{

    private $fileName;
    private $filePath;
    private $fileTempName;

    private $uploadDir = __DIR__ . "/uploads/";

    public $errors = "";
    public $image_path = "";

    public function __construct($file_info)
    {
        $this->fileName = basename($file_info["name"]);
        $this->filePath = $this->uploadDir . $this->fileName;
        $this->fileTempName = $file_info["tmp_name"];
    }

    private function getFilePath()
    {
        return "/validators/uploads/" . $this->fileName;
    }

    // Need to finish this....
    public function validateImage() {
        return true;
    }

    public function upload()
    {
        if (! $this->validateImage()) return false;

        if (move_uploaded_file($this->fileTempName, $this->filePath)) {
            $this->image_path = $this->getFilePath();
            return true;
        }

        $this->errors = "Problem uploading file.";
        return false;
    }
}
