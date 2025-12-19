<?php

namespace Tourze\WorkermanRuntimeContextBundle\DependencyInjection;

use Symfony\Component\DependencyInjection\Attribute\Autoconfigure;
use Tourze\SymfonyDependencyServiceLoader\AutoExtension;

#[Autoconfigure(public: true)]
final class WorkermanRuntimeContextExtension extends AutoExtension
{
    protected function getConfigDir(): string
    {
        return __DIR__ . '/../Resources/config';
    }
}
