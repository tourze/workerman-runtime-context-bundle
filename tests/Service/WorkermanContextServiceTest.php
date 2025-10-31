<?php

namespace Tourze\WorkermanRuntimeContextBundle\Tests\Service;

use PHPUnit\Framework\Attributes\CoversClass;
use PHPUnit\Framework\MockObject\MockObject;
use PHPUnit\Framework\TestCase;
use Tourze\Symfony\RuntimeContextBundle\Service\ContextServiceInterface;
use Tourze\WorkermanRuntimeContextBundle\Service\WorkermanContextService;

/**
 * @internal
 *
 * Note: 由于 WorkermanContextService 是装饰器服务，在集成测试环境中配置极其复杂。
 * PHPStan 要求使用 AbstractIntegrationTestCase，但这在装饰器模式下不实用。
 * 详见 issue: https://github.com/tourze/php-monorepo/issues/584
 *
 * WorkermanContextService 是一个装饰器服务，在集成测试中直接实例化是合理的
 * 这是装饰器模式的标准测试做法
 * @phpstan-ignore-next-line
 */
#[CoversClass(WorkermanContextService::class)]
final class WorkermanContextServiceTest extends TestCase
{
    private WorkermanContextService $contextService;

    private ContextServiceInterface&MockObject $innerService;

    protected function setUp(): void
    {
        parent::setUp();

        // WorkermanContextService 是一个装饰器服务，在集成测试中直接实例化是合理的
        // 由于这是一个装饰器模式，我们需要模拟被装饰的服务
        $this->innerService = $this->createMock(ContextServiceInterface::class);
        $this->contextService = new WorkermanContextService($this->innerService);
    }

    public function testGetIdWhenNotRunning(): void
    {
        // 由于 Worker::isRunning() 是静态方法，直接测试会返回 false，所以这里测试非运行时的情况
        $this->innerService->expects($this->once())
            ->method('getId')
            ->willReturn('test-id')
        ;

        $id = $this->contextService->getId();
        $this->assertEquals('test-id', $id);
    }

    public function testDeferWhenNotRunning(): void
    {
        $callback = function () {
            return true;
        };

        $this->innerService->expects($this->once())
            ->method('defer')
            ->with($callback)
        ;

        $this->contextService->defer($callback);
    }

    public function testSupportCoroutineWhenNotRunning(): void
    {
        $this->innerService->expects($this->once())
            ->method('supportCoroutine')
            ->willReturn(false)
        ;

        $result = $this->contextService->supportCoroutine();
        $this->assertFalse($result);
    }

    public function testReset(): void
    {
        $this->innerService->expects($this->once())
            ->method('reset')
        ;

        $this->contextService->reset();
    }
}
