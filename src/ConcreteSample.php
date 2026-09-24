<?php declare(strict_types=1);

namespace Repro;

final class ConcreteSample extends AbstractSample
{
    public function filter(string $operator = self::EQ): string
    {
        return $operator;
    }
}
