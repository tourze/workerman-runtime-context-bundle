<?php

declare(strict_types=1);

namespace Tourze\WorkermanRuntimeContextBundle\Tests\Service;

use PHPUnit\Framework\Attributes\CoversClass;
use PHPUnit\Framework\Attributes\RunTestsInSeparateProcesses;
use Tourze\PHPUnitSymfonyKernelTest\AbstractIntegrationTestCase;
use Tourze\Symfony\RuntimeContextBundle\Service\ContextServiceInterface;
use Tourze\WorkermanRuntimeContextBundle\Service\WorkermanContextService;

#[CoversClass(WorkermanContextService::class)]
#[RunTestsInSeparateProcesses]
final class WorkermanContextServiceTest extends AbstractIntegrationTestCase
{
    protected function onSetUp(): void
    {
    }

    public function testServiceIsRegistered(): void
    {
        $service = self::getService(ContextServiceInterface::class);
        $this->assertInstanceOf(WorkermanContextService::class, $service);
    }

    public function testGetIdReturnsString(): void
    {
        $service = self::getService(ContextServiceInterface::class);
        $id = $service->getId();

        $this->assertIsString($id);
        $this->assertNotEmpty($id);
    }

    public function testGetIdReturnsConsistentValueWithinContext(): void
    {
        $service = self::getService(ContextServiceInterface::class);
        $id1 = $service->getId();
        $id2 = $service->getId();

        $this->assertSame($id1, $id2);
    }

    public function testDeferAcceptsCallable(): void
    {
        $service = self::getService(ContextServiceInterface::class);

        // 在非 Workerman 环境下，defer 会将回调添加到 DeferCallSubscriber
        // 不应该抛出异常
        $called = false;
        $callback = function () use (&$called): void {
            $called = true;
        };

        $service->defer($callback);

        // defer 不会立即执行回调
        $this->assertFalse($called);
    }

    public function testSupportCoroutineReturnsBool(): void
    {
        $service = self::getService(ContextServiceInterface::class);
        $result = $service->supportCoroutine();

        $this->assertIsBool($result);
        // 在非 Workerman 环境下，应该返回 false（因为委托给 DefaultContextService）
        $this->assertFalse($result);
    }

    public function testResetDoesNotThrowException(): void
    {
        $service = self::getService(ContextServiceInterface::class);

        // reset 不应该抛出异常
        $service->reset();

        $this->assertTrue(true);
    }
}
