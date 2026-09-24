<?php declare(strict_types=1);

namespace Repro\Tests;

use PHPUnit\Framework\Attributes\CoversClass;
use PHPUnit\Framework\TestCase;
use Repro\SwitchSample;

#[CoversClass(SwitchSample::class)]
final class SwitchSampleTest extends TestCase
{
    public function testKind(): void
    {
        $this->assertSame('std', (new SwitchSample())->kind(\stdClass::class));
        $this->assertSame('other', (new SwitchSample())->kind(self::class));
    }
}
