<?php

namespace DsignPatterns\Object\CH9;


abstract class Emplyee
{
    protected $name;
    private static $types = ['Minion', 'CluedUp', 'WellConnected'];
    
    public static function recruit(string $name)
    {
        $num = rand(1, count(static::$types) - 1);
        $class = __NAMESPACE__.'\\'.self::$types[$num];
        return new $class($name);
    }


    public function __construct(string $name)
    {
        $this->name = $name;
    }

    abstract public function fire();
}

class Minion extends Eemplyee
{
    public function fire()
    {
        print "{$this->name}: I'll clear my dad\n";
    }
}

class CluedUp extends Eemplyee
{
    public function fire()
    {
        print "{$this->name}: I'll clear my dad\n";
    }
}

class WellConnected extends Eemplyee
{
    public function fire()
    {
        print "{$this->name}: I'll clear my dad\n";
    }
}

class NastyBoss
{
    protected $employees = [];

    public function addEmployee(Eemplyee $employee)
    {
        $this->employees[] = $employee;
    }

    public function projectFails()
    {
        if (count($this->employees) > 0) {
            $emp = array_pop($this->employees);
            $emp->fire();
        }
    }
}

$boss = new NastyBoss();
$boss->addEmployee(Eemplyee::recruit('harry'));
$boss->addEmployee(Eemplyee::recruit('bob'));
$boss->addEmployee(Eemplyee::recruit('mary'));

/**
 * 我们可以使用"委托对象实例", 将Employee对象的生成委托给一个单独的类或方法
 */