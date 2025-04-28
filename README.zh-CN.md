# Workerman Runtime Context Bundle

[English](README.md) | [中文](README.zh-CN.md)

[![Latest Version](https://img.shields.io/packagist/v/tourze/workerman-runtime-context-bundle.svg?style=flat-square)](https://packagist.org/packages/tourze/workerman-runtime-context-bundle)
[![Build Status](https://img.shields.io/travis/tourze/workerman-runtime-context-bundle/master.svg?style=flat-square)](https://travis-ci.org/tourze/workerman-runtime-context-bundle)
[![Quality Score](https://img.shields.io/scrutinizer/g/tourze/workerman-runtime-context-bundle.svg?style=flat-square)](https://scrutinizer-ci.com/g/tourze/workerman-runtime-context-bundle)
[![Total Downloads](https://img.shields.io/packagist/dt/tourze/workerman-runtime-context-bundle.svg?style=flat-square)](https://packagist.org/packages/tourze/workerman-runtime-context-bundle)

一个为 Workerman v5 事件循环提供高效协程上下文管理的 Symfony Bundle，实现了协程隔离与兼容的服务注入，几乎无需修改现有代码。

## 功能特性

- 无缝集成 Workerman 协程上下文到 Symfony 应用
- 自动为每个协程（Fiber、Swoole、Swow）隔离上下文
- 支持连接池等资源的上下文感知与复用
- 兼容 Symfony 6.4 及以上版本
- 现有业务代码几乎无需改动

## 安装说明

- PHP >= 8.1
- Symfony 6.4 及以上
- Workerman >= 5.1

通过 Composer 安装：

```bash
composer require tourze/workerman-runtime-context-bundle
```

## 快速开始

1. 在 Symfony 应用中启用 Bundle（通常通过 Flex 自动注册）：

```php
// config/bundles.php
return [
    // ...
    Tourze\WorkermanRuntimeContextBundle\WorkermanRuntimeContextBundle::class => ['all' => true],
];
```

2. 在代码中使用上下文感知服务。例如在协程中延迟执行回调：

```php
use Tourze\Symfony\RuntimeContextBundle\Service\ContextServiceInterface;

public function someMethod(ContextServiceInterface $contextService)
{
    $contextService->defer(function () {
        // 该回调将在协程结束时自动执行
    });
}
```

3. 更多高级协程与上下文隔离用法，详见 [examples/](./examples/)，包括 Fiber、连接池、并发模型等测试。

## 详细文档

- [协程上下文隔离](./examples/coroutine/README.zh-CN.md)：不同协程间上下文如何隔离
- [连接池用法](./examples/coroutine/README.zh-CN.md)：资源共享与复用
- [并发模型对比](./examples/coroutine/README.zh-CN.md)：串行、Parallel、Barrier、Channel 模型

## 高级配置

本 Bundle 会自动装饰默认的 `ContextServiceInterface`，为 Workerman 协程提供支持。大部分场景无需手动配置。

## 贡献指南

- 欢迎通过 GitHub 提交 Issue 和 PR
- 遵循 PSR 规范与 Symfony 最佳实践
- 提交 PR 前请使用 PHPUnit 进行测试

## 版权和许可

MIT 协议，详见 [LICENSE](./LICENSE)

## 作者信息

tourze <https://github.com/tourze>

## 更新日志

版本历史和升级说明详见 [Releases](https://github.com/tourze/workerman-runtime-context-bundle/releases)
