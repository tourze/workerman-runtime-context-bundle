<?php

namespace Tourze\WorkermanRuntimeContextBundle\Tests\Unit;

use PHPUnit\Framework\TestCase;
use Tourze\WorkermanRuntimeContextBundle\WorkermanRuntimeContextBundle;

class WorkermanRuntimeContextBundleTest extends TestCase
{
    private WorkermanRuntimeContextBundle $bundle;

    protected function setUp(): void
    {
        $this->bundle = new WorkermanRuntimeContextBundle();
    }

    public function testInstantiation(): void
    {
        $this->assertInstanceOf(WorkermanRuntimeContextBundle::class, $this->bundle);
    }

    public function testGetPath(): void
    {
        $expectedPath = dirname(__DIR__, 2) . '/src';
        $this->assertEquals($expectedPath, $this->bundle->getPath());
    }
}