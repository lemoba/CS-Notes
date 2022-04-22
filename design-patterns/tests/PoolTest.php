<?php

declare(strict_types=1);

namespace DsignPatterns\Testing;

use DsignPatterns\Creational\Pool\WorkerPool;
use PHPUnit\Framework\TestCase;

/**
 * PoolTest
 * @group pool
 */
class PoolTest extends TestCase
{
    /**
     * @covers
     * @test
     */
    public function testCanGetNewInstancesWithGet()
    {
        // Test
        $pool = new WorkerPool();
        $worker1 = $pool->get();
        $worker2 = $pool->get();

        $this->assertCount(2, $pool);
        $this->assertNotSame($worker1, $worker2);
    }

    /**
    * @covers
    * @test
    */
    public function testCanGetSameInstanceTwiceWhenDisposingItFirst()
    {
        // Test
        $pool = new WorkerPool();
        $worker1 = $pool->get();
        $worker2 = $pool->get();
        $pool->dispose($worker1);
        $worker3 = $pool->get();

        $this->assertCount(2, $pool);
        $this->assertSame($worker1, $worker3);
        $this->assertNotSame($worker2, $worker3);
        $this->assertNotSame($worker1, $worker2);
    }
}
