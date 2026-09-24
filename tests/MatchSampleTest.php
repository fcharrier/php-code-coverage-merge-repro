<?php declare(strict_types=1);

namespace Repro\Tests;

use PHPUnit\Framework\Attributes\CoversClass;
use PHPUnit\Framework\TestCase;
use Repro\MatchSample;

#[CoversClass(MatchSample::class)]
final class MatchSampleTest extends TestCase
{
    public function testLabel(): void
    {
        $this->assertSame('one', (new MatchSample())->label(1));
        $this->assertSame('other', (new MatchSample())->label(2));
    }
}
