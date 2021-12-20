<?php


namespace App\Services;


use App\Services\Interfaces\LoggerInterface;

class FileLogger implements LoggerInterface
{
    public function log(string $message = '')
    {
        $this->saveToFile($message);
    }

    private function saveToFile(string $message = '')
    {
        // save to file function
    }
}