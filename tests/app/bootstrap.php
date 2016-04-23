<?php

/*
 * This file is part of the Uhsa package.
 *
 * (c) Victor J. C. Geyer <victor@geyer.io>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

if (file_exists($file = __DIR__.'/autoload.php')) {
    require_once $file;
} elseif (file_exists($file = __DIR__.'/../../vendor/autoload.php')) {
    require_once $file;
}

// clear cache
if (isset($_ENV['BOOTSTRAP_CLEAR_CACHE_ENV'])) {
    passthru(sprintf(
        'php "%s/console" cache:clear --env=%s',
        __DIR__,
        $_ENV['BOOTSTRAP_CLEAR_CACHE_ENV']
    ));
}

require_once __DIR__.'/AppKernel.php';