# Workerman Runtime Context Bundle

[English](README.md) | [中文](README.zh-CN.md)

[![Latest Version](https://img.shields.io/packagist/v/tourze/workerman-runtime-context-bundle.svg?style=flat-square)](https://packagist.org/packages/tourze/workerman-runtime-context-bundle)
[![Build Status](https://img.shields.io/travis/tourze/workerman-runtime-context-bundle/master.svg?style=flat-square)](https://travis-ci.org/tourze/workerman-runtime-context-bundle)
[![Quality Score](https://img.shields.io/scrutinizer/g/tourze/workerman-runtime-context-bundle.svg?style=flat-square)](https://scrutinizer-ci.com/g/tourze/workerman-runtime-context-bundle)
[![Total Downloads](https://img.shields.io/packagist/dt/tourze/workerman-runtime-context-bundle.svg?style=flat-square)](https://packagist.org/packages/tourze/workerman-runtime-context-bundle)

A Symfony bundle that enables efficient coroutine context management for Workerman v5 event loop, providing context isolation and coroutine-friendly service integration with minimal code changes.

## Features

- Seamless integration of Workerman coroutine context into Symfony applications
- Automatic context isolation for each coroutine (Fiber, Swoole, Swow)
- Support for context-aware connection pools and resource management
- Compatible with Symfony 6.4+
- Minimal or zero code modification needed in your existing Symfony app

## Installation

- PHP >= 8.1
- Symfony 6.4 or higher
- Workerman >= 5.1

Install via Composer:

```bash
composer require tourze/workerman-runtime-context-bundle
```

## Quick Start

1. Enable the bundle in your Symfony application (usually auto-registered via Flex):

```php
// config/bundles.php
return [
    // ...
    Tourze\WorkermanRuntimeContextBundle\WorkermanRuntimeContextBundle::class => ['all' => true],
];
```

2. Use context-aware services in your code. For example, to defer a callback in coroutine:

```php
use Tourze\Symfony\RuntimeContextBundle\Service\ContextServiceInterface;

public function someMethod(ContextServiceInterface $contextService)
{
    $contextService->defer(function () {
        // This will be executed at the end of the coroutine
    });
}
```

3. See [examples/](./examples/) for advanced coroutine and context isolation usage, including Fiber, connection pool, and concurrency model tests.

## Documentation

- [Coroutine Context Isolation](./examples/coroutine/README.md): How context is isolated between coroutines
- [Connection Pool Usage](./examples/coroutine/README.md): Resource sharing and reuse
- [Concurrency Model Comparison](./examples/coroutine/README.md): Serial, Parallel, Barrier, Channel models

## Advanced Configuration

This bundle automatically decorates the default `ContextServiceInterface` to provide Workerman coroutine support. No manual configuration is required for most use cases.

## Contributing

- Please submit issues and pull requests via GitHub
- Follow PSR coding standards and Symfony best practices
- Run tests via PHPUnit before submitting PRs

## License

MIT License. See [LICENSE](./LICENSE) for details.

## Authors

tourze <https://github.com/tourze>

## Changelog

See [Releases](https://github.com/tourze/workerman-runtime-context-bundle/releases) for version history and upgrade notes.
