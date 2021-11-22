<?php declare(strict_types=1);

namespace DsignPatterns\Structural\Bridge;

class PingServer extends Service
{
    public function get(): string
    {
        return $this->implementation->format('pong');
    }
}