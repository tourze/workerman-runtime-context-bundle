<?php

namespace Tourze\WorkermanRuntimeContextBundle;

use Symfony\Component\HttpKernel\Bundle\Bundle;
use Tourze\BundleDependency\BundleDependencyInterface;
use Tourze\Symfony\RuntimeContextBundle\RuntimeContextBundle;

class WorkermanRuntimeContextBundle extends Bundle implements BundleDependencyInterface
{
    public static function getBundleDependencies(): array
    {
        return [
            RuntimeContextBundle::class => ['all' => true],
        ];
    }
}
