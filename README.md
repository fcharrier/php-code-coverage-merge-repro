# Merged coverage reports lines that no driver can ever cover

Minimal reproduction: merging code coverage from several PHPUnit runs reports lines as
*executable but not covered* although a single run over the same tests reports 100 %.

```sh
docker build -t pcc-repro .
docker run --rm -v "$PWD":/app pcc-repro composer install
docker run --rm -v "$PWD":/app pcc-repro ./repro.sh
```

| | Lines |
|---|---|
| single `phpunit` run | 100.00 % (6/6) |
| one run per test class + `phpcov merge` | 66.66 % (6/9) |
| `paratest -p3` | 66.66 % (6/9) |

Same result with Xdebug (`php -n -d zend_extension=xdebug -d xdebug.mode=coverage`).

Not reproducible with php-code-coverage 12.5.7 (PHPUnit 12.5.35, phpcov 11.0.4). Reproducible
with every 14.x tested: 14.0.0 and 14.1.0 give 60.00 % (6/10), 14.2.0 to 14.3.3 give 66.66 % (6/9).

Lines reported as not covered after the merge:

- `src/MatchSample.php:9` — `return match ($value) {`
- `src/SwitchSample.php:10` — `case \stdClass::class:`
- `src/AbstractSample.php:9` — `abstract public function filter(string $operator = self::EQ): string;`

## Why

Neither driver reports those lines: they carry no opcode of their own. In a run that executes
the file, the line is therefore absent from the data and not counted. In a run that does *not*
execute the file, the file is added as uncovered and its lines are seeded from static
analysis, which classifies them as executable. Merging takes the union of the lines, so the
seeded line enters the merged data with no test, and no run can ever cover it.

Hence the non-determinism seen with ParaTest: the denominator depends on which worker ran
which test class, and grows with the number of workers.

Versions: PHP 8.5.10, phpunit/php-code-coverage 14.3.3, PHPUnit 13.3.4, phpcov 13.1.0,
ParaTest 7.24.1, PCOV 1.0.12, Xdebug 3.5.3.
