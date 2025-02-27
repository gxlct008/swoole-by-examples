#!/usr/bin/env php
<?php

declare(strict_types=1);

/**
 * In this example, the first coroutine keeps running all the time, while the second coroutine has no chance of getting
 * executed. The script will keep printing out integers.
 *
 * How to run this script:
 *     docker compose exec -ti client bash -c "./csp/scheduling/non-preemptive.php"
 */

use function Swoole\Coroutine\go;
use function Swoole\Coroutine\run;

run(
    function () {
        go(function () {
            $i = 0;
            while (true) {
                echo $i++, PHP_EOL;
            }
        });

        go(function () {
            throw new Exception('Quitting.');
        });
    }
);
