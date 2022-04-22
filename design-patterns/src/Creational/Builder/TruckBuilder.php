<?php

declare(strict_types=1);

namespace DsignPatterns\Creational\Builder;

use DsignPatterns\Creational\Builder\Parts\Door;
use DsignPatterns\Creational\Builder\Parts\Truck;
use DsignPatterns\Creational\Builder\Parts\Wheel;
use DsignPatterns\Creational\Builder\Parts\Engine;
use DsignPatterns\Creational\Builder\Parts\Vehicle;

class TruckBuilder implements Builder
{
    private Truck $truck;

    public function addDoors()
    {
        $this->truck->setPart('rightDoor', new Door());
        $this->truck->setPart('leftDoor', new Door());
    }

    public function addWheel()
    {
        $this->truck->setPart('wheel1', new Wheel());
        $this->truck->setPart('wheel2', new Wheel());
        $this->truck->setPart('wheel3', new Wheel());
        $this->truck->setPart('wheel4', new Wheel());
        $this->truck->setPart('wheel5', new Wheel());
        $this->truck->setPart('wheel6', new Wheel());
    }

    public function addEngine()
    {
        $this->truck->setPart('truckEngine', new Engine());
    }

    public function createVehicle()
    {
        $this->truck = new Truck();
    }


    public function getVehicle(): Vehicle
    {
        return $this->truck;
    }
}
