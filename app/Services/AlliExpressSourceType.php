<?php


namespace App\Services;


use App\Services\Interfaces\ClientSourceTypeInterface;
use Nubs\RandomNameGenerator\Alliteration;

class AlliExpressSourceType implements ClientSourceTypeInterface
{
    public function getName()
    {
        $generator = new Alliteration();

        return $generator->getName();
    }
}