<?php

declare(strict_types=1);

namespace DsignPatterns\Object;


/**
 * 负责管理课程数据
 */
abstract class Lesson
{
    private $duration;
   
    private $costStrategy;

    public function __construct(int $duration, CostStrategy $strategy)
    {
        $this->duration = $duration;
        $this->costStrategy = $strategy;
    }

    public function cost(): int
    {
        return $this->costStrategy->cost($this);
    }

    public function chargeType(): string
    {
        return $this->costStrategy->chargeType();
    }

    public function getDuration(): int
    {
        return $this->duration;
    }
    // Lesson的其他类
}

// 负责计算费用
abstract class CostStrategy
{
    abstract public function cost(Lesson $lesson): int;
    abstract public function chargeType(): string;
}

class Lecture extends Lesson
{

}


class Seminar extends Lesson
{

}

class TimedCostStrategy extends CostStrategy
{
    public function cost(Lesson $lesson): int
    {
        return ($lesson->getDuration() * 5);
    }

    public function chargeType(): string
    {
        return "hourly rate";
    }
}

class FixedCostStrategy extends CostStrategy
{
    public function cost(Lesson $lesson): int
    {
        return 30;
    }

    public function chargeType(): string
    {
        return "fixed rate";
    }
}


$lessons[] = new Seminar(4, new TimedCostStrategy());
$lessons[] = new Lecture(4, new FixedCostStrategy());

foreach ($lessons as $lesson) {
    print "lesson charge {$lesson->cost()}."; // 20. hourly rate  30.fixed rate
    print "Charge type {$lesson->chargeType()}\n";
}

/**
 * 相比继承，组合对象的方式使代码更灵活， 但是会降低代码的可读性
 */


 // 通知
abstract class Notifier
{
    public static function getNotifier(): Notifier
    {
        if (rand(1, 2) === 1) {
            return new MailNotifier();
        } else {
            return new TextNotifier();
        }
    }
    abstract public function inform($message);
}

class MailNotifier extends Notifier
{
    public function inform($message)
    {
        print "MAIL notifiction: {$message}\n"; 
    }
}

class TextNotifier extends Notifier
{
    public function inform($message)
    {
        print "TEXT notifiction: {$message}\n";  
    }
}

// 添加注册通知
class RegistrationMgr
{
    public function register(Lesson $lesson)
    {
        // 发送通知
        $notifier = Notifier::getNotifier();
        $notifier->inform("new lesson: cost ({$lesson->cost()})");
    }
}


$lessons1 = new Seminar(4, new TimedCostStrategy());
$lessons2 = new Lecture(4, new FixedCostStrategy());
$mgr = new RegistrationMgr();
$mgr->register($lessons1);
$mgr->register($lessons2);