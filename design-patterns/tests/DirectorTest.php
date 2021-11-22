<?php declare(strict_types=1);

namespace DsignPatterns\Testing;

use PHPUnit\Framework\TestCase;
use DsignPatterns\Creational\Builder\Director;
use DsignPatterns\Creational\Builder\Parts\Car;
use DsignPatterns\Creational\Builder\CarBuilder;
use DsignPatterns\Creational\Builder\Parts\Truck;
use DsignPatterns\Creational\Builder\TruckBuilder;

class DirectorTest extends TestCase
{
    /**
     * @covers
     */
    public function testCanBuildTruck()
    {
        $truckBuilder = new TruckBuilder();
        $newVehicle = (new Director())->build($truckBuilder);

        $this->assertInstanceOf(Truck::class, $newVehicle);
    }

    /**
     * @covers
     */
    public function testCanBuildCar()
    {
        $carBuilder = new CarBuilder();
        $newVehicle = (new Director())->build($carBuilder);

        $this->assertInstanceOf(Car::class, $newVehicle);   
    }
}