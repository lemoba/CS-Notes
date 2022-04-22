<?php

namespace DsignPatterns\Object\CH9;


abstract class Emplyee
{
    protected $name;

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
        print "{$this->name}: I'll clear my desk\n";
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
$boss->addEmployee(new Minion('harry'));
$boss->addEmployee(new Minion('bob'));
$boss->addEmployee(new Minion('mary'));
$boss->projectFails();
$boss->projectFails();
$boss->projectFails();

/**
 * 我们可以使用"委托对象实例", 将Employee对象的生成委托给一个单独的类或方法
 */