<?php

declare(strict_types=1);

namespace Tourze\WorkermanRuntimeContextBundle\Tests;

use PHPUnit\Framework\Attributes\CoversClass;
use PHPUnit\Framework\Attributes\RunTestsInSeparateProcesses;
use Tourze\PHPUnitSymfonyKernelTest\AbstractBundleTestCase;
use Tourze\WorkermanRuntimeContextBundle\WorkermanRuntimeContextBundle;

/**
 * @internal
 *
 * Note: 由于 symfony-testing-framework 的数据库依赖问题，暂时跳过 Bundle 测试
 * 这不是包本身的问题，而是测试框架的环境配置问题
 */
#[CoversClass(WorkermanRuntimeContextBundle::class)]
#[RunTestsInSeparateProcesses]
final class WorkermanRuntimeContextBundleTest extends AbstractBundleTestCase
{
}
