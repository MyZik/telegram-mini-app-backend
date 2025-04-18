<?php

declare(strict_types=1);

namespace App\Infrastructure\Cache;

use Symfony\Component\Cache\Adapter\AdapterInterface;
use Symfony\Contracts\Cache\ItemInterface;

readonly class CacheProvider
{
    public function __construct(
        private AdapterInterface $cache,
    ) {
    }

    /**
     * @template T
     * @param callable(): T $callback
     * @return T
     */
    public function get(string $key, int $expiry, callable $callback): mixed
    {
        return $this->cache->get($key, function (ItemInterface $item) use ($expiry, $callback) {
            $item->expiresAfter($expiry);
            return $callback();
        });
    }

    public function delete(string $key): bool
    {
        return $this->cache->delete($key);
    }

    public function clear(): bool
    {
        return $this->cache->clear();
    }
} 