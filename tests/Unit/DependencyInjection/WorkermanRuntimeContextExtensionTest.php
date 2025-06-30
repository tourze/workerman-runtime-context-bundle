<?php

namespace Tourze\WorkermanRuntimeContextBundle\Tests\Unit\DependencyInjection;

use PHPUnit\Framework\TestCase;
use Symfony\Component\DependencyInjection\ContainerBuilder;
use Tourze\WorkermanRuntimeContextBundle\DependencyInjection\WorkermanRuntimeContextExtension;

class WorkermanRuntimeContextExtensionTest extends TestCase
{
    private WorkermanRuntimeContextExtension $extension;
    private ContainerBuilder $container;

    protected function setUp(): void
    {
        $this->extension = new WorkermanRuntimeContextExtension();
        $this->container = new ContainerBuilder();
    }

    public function testLoad(): void
    {
        $this->extension->load([], $this->container);
        
        // 验证服务配置是否加载成功 - 检查是否有相关的服务定义
        $definitions = $this->container->getDefinitions();
        $this->assertNotEmpty($definitions);
    }

    public function testGetAlias(): void
    {
        $this->assertEquals('workerman_runtime_context', $this->extension->getAlias());
    }
}