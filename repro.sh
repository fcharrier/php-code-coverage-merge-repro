#!/bin/sh
# Runs inside the container: compares one PHPUnit run with the merge of per-test-class runs.
set -eu
rm -rf build && mkdir -p build/cov
echo '### 1. Single PHPUnit run (expected: 100 %)'
vendor/bin/phpunit --no-progress --coverage-text --colors=never | sed -n '/Summary/,$p'
echo '### 2. One PHPUnit run per test class, merged with phpcov'
for t in MatchSample SwitchSample ConcreteSample; do
    vendor/bin/phpunit --no-progress --coverage-php "build/cov/$t.cov" "tests/${t}Test.php" > /dev/null
done
vendor/bin/phpcov merge --text php://stdout build/cov | sed -n '/Summary/,$p'
echo '### 3. Same thing through ParaTest'
vendor/bin/paratest -p3 --coverage-text --colors=never | sed -n '/Summary/,$p'
