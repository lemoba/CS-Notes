<?php
namespace DsignPatterns\Object\CH9;

class Sea
{

}

class EarthSea extends Sea
{

}

class MarsSea extends Sea 
{

}

class Plains
{

}

class EarthPlains extends Plains
{

}

class MarsPlains extends Plains
{

}

class Forest
{

}

class EarthForest extends Forest
{

}

class MarsForest extends Forest
{

}


class TerrainFactory
{
    private $sea;
    private $forest;
    private $plains;

    public function __construct(Sea $sea, Forest $forest, Plains $plains)
    {
        $this->sea = $sea;
        $this->forest = $forest;
        $this->plains = $plains;
    }

    public function getSea()
    {
        return clone $this->sea;
    }

    public function getForest()
    {
        return clone $this->forest;
    }

    public function getPlains()
    {
        return clone $this->plains;
    }
}

$factory = new TerrainFactory(
    new EarthSea(),
    new EarthForest(),
    new EarthPlains(),
);

print_r($factory->getSea());
print_r($factory->getPlains());
print_r($factory->getForest());