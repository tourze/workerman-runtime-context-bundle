<?php

namespace Tourze\WorkermanRuntimeContextBundle\Service;

use Symfony\Component\DependencyInjection\Attribute\AsDecorator;
use Symfony\Component\DependencyInjection\Attribute\Autoconfigure;
use Symfony\Component\DependencyInjection\Attribute\AutowireDecorated;
use Tourze\Symfony\RuntimeContextBundle\Service\ContextServiceInterface;
use Workerman\Coroutine;
use Workerman\Events\Fiber;
use Workerman\Events\Swoole;
use Workerman\Events\Swow;
use Workerman\Worker;

#[Autoconfigure(public: true)]
#[AsDecorator(decorates: ContextServiceInterface::class)]
class WorkermanContextService implements ContextServiceInterface
{
    public function __construct(
        #[AutowireDecorated] private readonly ContextServiceInterface $inner,
    )
    {
    }

    private function isCoroutineEventLoop(): bool
    {
        $loop = Worker::getEventLoop();
        return in_array($loop::class, [
            Swoole::class,
            Swow::class,
            Fiber::class,
        ]);
    }

    public function getId(): string
    {
        if (!Worker::isRunning() || !$this->isCoroutineEventLoop()) {
            return $this->inner->getId();
        }

        $current = Coroutine::getCurrent();
        $prefix = match ($current::class) {
            Fiber::class => 'fiber',
            Swoole::class => 'swoole',
            Swow::class => 'swow',
            default => 'default',
        };
        return "{$prefix}-{$current->id()}";
    }

    public function defer(callable $callback): void
    {
        if (!Worker::isRunning() || !$this->isCoroutineEventLoop()) {
            $this->inner->defer($callback);
            return;
        }
        Coroutine::defer($callback);
    }

    public function supportCoroutine(): bool
    {
        if (!Worker::isRunning() || !$this->isCoroutineEventLoop()) {
            return $this->inner->supportCoroutine();
        }
        return $this->isCoroutineEventLoop();
    }

    public function reset(): void
    {
        $this->inner->reset();
    }
}
