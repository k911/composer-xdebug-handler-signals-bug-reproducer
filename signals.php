<?php
declare(strict_types=1);

use Composer\XdebugHandler\XdebugHandler;

require __DIR__ . '/vendor/autoload.php';

$pid = getmypid();
echo "Hello from PID: $pid\n";

$xdebugHandler = new XdebugHandler('APP');
$xdebugHandler->check();
unset($xdebugHandler);

$stop = false;

pcntl_async_signals(true);
pcntl_signal(SIGINT, function () use (&$stop): void {
    $stop = true;
    echo "\nStopping..\n";
});

$startTime = microtime(true);
echo "Started!\n";
while (!$stop) {
    usleep(100);
}
$period = floor((microtime(true) - $startTime) * 1000);

echo "Stopped after $period ms\n";