<?php declare(strict_types=1);

namespace Repro;

final class MatchSample
{
    public function label(int $value): string
    {
        return match ($value) {
            1 => 'one',
            default => 'other',
        };
    }
}
