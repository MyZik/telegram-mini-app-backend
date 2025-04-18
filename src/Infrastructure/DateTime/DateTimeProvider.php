<?php

declare(strict_types=1);

namespace App\Infrastructure\DateTime;

use DateTimeImmutable;
use DateTimeInterface;

readonly class DateTimeProvider
{
    public function now(): DateTimeInterface
    {
        return new DateTimeImmutable();
    }

    public function createFromFormat(string $format, string $datetime): ?DateTimeInterface
    {
        return DateTimeImmutable::createFromFormat($format, $datetime);
    }
} 