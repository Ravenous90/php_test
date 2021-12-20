<?php


namespace App\Services\Interfaces;


interface LoggerInterface
{
    public function log(string $message = '');
}