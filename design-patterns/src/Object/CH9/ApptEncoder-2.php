<?php

namespace DsignPatterns\Object\CH9;

abstract class ApptEncoder
{
    abstract public function encode(): string;
}

abstract class TtdEncoder
{
    abstract public function encode(): string;
}

abstract class ContactEncoder
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

class BloggsTtdEncoder extends TtdEncoder
{
    public function encode(): string
    {
        return "Appointment data encoded in BloggsCal format\n";
    }
}

class BloggsContactEncoder extends ContactEncoder
{
    public function encode(): string
    {
        return "Appointment data encoded in BloggsCal format\n";
    }
}

abstract class CommsManager
{
   abstract public function getHeaderText(): string;
   abstract public function getApptEncoder(): ApptEncoder;
   abstract public function getTtdEncoder(): TtdEncoder;
   abstract public function getContactEncoder(): ContactEncoder;
   abstract public function getFooterText(): string;
}

class BloggsCommsManager extends CommsManager
{
    public function getHeaderText(): string
    {
        return "BloggsCal header\n";
    }

    public function getApptEncoder(): ApptEncoder
    {
        return new BloggsApptEncoder();
    } 
    public function getTtdEncoder(): TtdEncoder
    {
        return new BloggsTtdEncoder();
    }
    public function getContactEncoder(): ContactEncoder
    {
        return new BloggsContactEncoder();
    }
    public function getFooterText(): string
    {
        return "BloggsCal footer\n";
    }
}

$mgr = new BloggsCommsManager();
print $mgr->getHeaderText();
print $mgr->getApptEncoder()->encode();
print $mgr->getFooterText();

/**
 * 缺点添加新品的时候不仅创建实现类还要修改抽象类
 */