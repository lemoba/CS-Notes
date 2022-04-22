<?php

namespace DsignPatterns\Object\CH9;

abstract class ApptEncoder
{
    abstract public function encode(): string;
}

class BloggsApptEncoder extends ApptEncoder
{
    public function encode(): string
    {
        return "Appointment data encoded in BloggsCal format\n";
    }
}


class MegaApptEncoder extends ApptEncoder
{
    public function encode(): string
    {
        return "Appointment data encoded in MegaCal format\n";
    }
}


class CommsManager
{
    // public function getApptEncode(): ApptEncoder
    // {
    //     return new BloggsApptEncoder();
    // }
    const BLOGGS = 1;
    const MEGA = 2;
    
    public function __construct(int $mode)
    {
        $this->mode = $mode;
    }

    public function getApptEncode(): ApptEncoder
    {
        switch($this->mode) {
            case (self::MEGA):
                return new MegaApptEncoder();
                break;
            default:
                return new BloggsApptEncoder();
        }
    } 
}

$man = new CommsManager(CommsManager::MEGA);
print (get_class($man->getApptEncode())) . PHP_EOL;

$man = new CommsManager(CommsManager::BLOGGS);
print (get_class($man->getApptEncode())). PHP_EOL;

/**
 * 缺点 如果要添加提供页眉和页脚数据的方法 getHeaderText() getFooterText()时 代码中会有重复的条件判断语句， 可以使用多态替换
 */