<?php

namespace DsignPatterns\Object\CH9;


class SimpleFactory
{
    public function createBicycle(): Bicycle
    {
        return new Bicycle();
    }
}

class Bicycle
{
    public function driveTo(string $destination)
    {
    }
}