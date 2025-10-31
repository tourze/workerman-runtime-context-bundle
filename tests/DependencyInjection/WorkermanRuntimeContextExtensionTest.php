<?php

namespace Tourze\WorkermanRuntimeContextBundle\Tests\DependencyInjection;

use PHPUnit\Framework\Attributes\CoversClass;
use Symfony\Component\DependencyInjection\ContainerBuilder;
use Tourze\PHPUnitSymfonyUnitTest\AbstractDependencyInjectionExtensionTestCase;
use Tourze\WorkermanRuntimeContextBundle\DependencyInjection\WorkermanRuntimeContextExtension;

/**
 * @internal
 */
#[CoversClass(WorkermanRuntimeContextExtension::class)]
final class WorkermanRuntimeContextExtensionTest extends AbstractDependencyInjectionExtensionTestCase
{
    private WorkermanRuntimeContextExtension $extension;

    private ContainerBuilder $container;

    protected function setUp(): void
    {
        parent::setUp();
        $this->container = new ContainerBuilder();
        $this->container->setParameter('kernel.environment', 'test');
        $this->extension = new WorkermanRuntimeContextExtension();
    }

    public function testGetAlias(): void
    {
        $this->assertEquals('workerman_runtime_context', $this->extension->getAlias());
    }
}
