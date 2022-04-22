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

    public function addEmployee(string $employeeName)
    {
        $this->employees[] = new Minion($employeeName);
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
$boss->addEmployee('harry');
$boss->addEmployee('bob');
$boss->addEmployee('mary');
$boss->projectFails();

/**
 * 缺点：直接在NastyBoss类中实例化Minion对象限制了程序的灵活性, 可以使用多态来改变这一问题
 */