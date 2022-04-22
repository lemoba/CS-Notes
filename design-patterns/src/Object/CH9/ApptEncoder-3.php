<?php

namespace DsignPatterns\Object\CH9;

interface Encoder
{
    public function encode(): string;
}

abstract class CommsManager
{
    const APPT    = 1;
    const TTD     = 2;
    const CONTACT = 3;
    abstract public function getHeaderText(): string;
    abstract public function make(int $flag): Encoder;
    abstract public function getFooterText(): string;
}

class BloggsApptEncoder implements Encoder
{
    public function encode(): string
    {
        return "Appointment data encoded in BloggsCal format\n";
    }
}

class BloggsTtdEncoder implements Encoder
{
    public function encode(): string
    {
        return "Appointment data encoded in BloggsCal format\n";
    }
}

class BloggsContactEncoder implements Encoder
{
    public function encode(): string
    {
        return "Appointment data encoded in BloggsCal format\n";
    }
}

class BloggsCommsManager extends CommsManager
{
    public function getHeaderText(): string
    {
        return "BloggsCal header\n";
    }

    public function make(int $flag): Encoder
    {
        switch ($flag) {
            case self::APPT:
                return new BloggsApptEncoder();
                break;
            case self::TTD:
                return new BloggsTtdEncoder();
                break;
            default:
                return new BloggsContactEncoder();
        }
    }

    public function getFooterText(): string
    {
        return "BloggsCal footer\n";
    }
}

$mgr = new BloggsCommsManager();
print $mgr->getHeaderText();
var_dump($mgr->make(BloggsCommsManager::TTD));
print $mgr->getFooterText();

/**
 * 缺点添加新品的时候不仅创建实现类还要修改抽象类
 */