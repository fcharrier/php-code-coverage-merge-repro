<?php declare(strict_types=1);

namespace Repro;

abstract class AbstractSample
{
    public const EQ = '=';

    abstract public function filter(string $operator = self::EQ): string;

    public function describe(): string
    {
        return $this->filter();
    }
}
