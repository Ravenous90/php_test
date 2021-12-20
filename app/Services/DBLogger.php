<?php


namespace App\Services;


use App\Services\Interfaces\LoggerInterface;

class DBLogger implements LoggerInterface
{
    public function log(string $message= '')
    {
        $this->saveToDB();
    }

    private function saveToDB()
    {
        // save to db function
    }
}