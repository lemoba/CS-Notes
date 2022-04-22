<?php

declare(strict_types=1);

namespace DsignPatterns\Creational\Builder;

use DsignPatterns\Creational\Builder\Parts\Car;
use DsignPatterns\Creational\Builder\Parts\Door;
use DsignPatterns\Creational\Builder\Parts\Wheel;
use DsignPatterns\Creational\Builder\Parts\Engine;
use DsignPatterns\Creational\Builder\Parts\Vehicle;

class CarBuilder implements Builder
{
    private Car $car;

    public function addDoors()
    {
        $this->car->setPart('rightDoor', new Door());
        $this->car->setPart('leftDoor', new Door());
        $this->car->setPart('trunkDoor', new Door());
    }

    public function addEngine()
    {
        $this->car->setPart('engine', new Engine());
    }

    public function addWheel()
    {
        $this->car->setPart('wheelLF', new Wheel());
        $this->car->setPart('wheelRF', new Wheel());
        $this->car->setPart('wheelLR', new Wheel());
        $this->car->setPart('wheelRR', new Wheel());
    }

    public function createVehicle()
    {
        $this->car = new Car();
    }

    public function getVehicle(): Vehicle
    {
        return $this->car;
    }
}
