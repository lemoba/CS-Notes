<?php

declare(strict_types=1);

namespace DsignPatterns\Object;

abstract class Lesson
{
    protected $duration;
    public const FIXED = 1;
    public const TIMED = 2;
    private $costtype;

    public function __construct(int $duration, $costtype)
    {
        $this->duration = $duration;
        $this->costtype = $costtype;
    }

    public function cost(): int
    {
        switch ($this->costtype) {
            case self::FIXED:
                return (5 * $this->duration);
                break;
            case self::TIMED:
                return 30;
                break;
            default:
                $this->costtype = self::FIXED;
                return 30;
        }
    }

    public function chargeType(): string
    {
        switch ($this->costtype) {
            case self::TIMED:
                return "hourly rate";
                break;
            case self::FIXED:
                return "fixed rate";
                break;
            default:
                $this->costtype = self::FIXED;
                return "fixed rate";
        }
    }

    // Lesson的其他类
}

class Lecture extends Lesson
{

}


class Seminar extends Lesson
{

}

$lecture = new Lecture(5, Lesson::FIXED);
print "{$lecture->cost()} ({$lecture->chargeType()})\n";

$seminar = new Seminar(3, Lesson::TIMED);
print "{$seminar->cost()} ({$seminar->chargeType()})\n";

/**
 * 缺点：cost chargeType里面有重复代码 
 * 通常使用多态来代替条件语句
 */