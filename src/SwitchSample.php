<?php declare(strict_types=1);

namespace Repro;

final class SwitchSample
{
    public function kind(string $class): string
    {
        switch ($class) {
            case \stdClass::class:
                return 'std';
            default:
                return 'other';
        }
    }
}
