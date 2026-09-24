<?php declare(strict_types=1);

namespace Repro\Tests;

use PHPUnit\Framework\Attributes\CoversClass;
use PHPUnit\Framework\TestCase;
use Repro\AbstractSample;
use Repro\ConcreteSample;

#[CoversClass(AbstractSample::class)]
#[CoversClass(ConcreteSample::class)]
final class ConcreteSampleTest extends TestCase
{
    public function testDescribe(): void
    {
        $this->assertSame('=', (new ConcreteSample())->describe());
    }
}
