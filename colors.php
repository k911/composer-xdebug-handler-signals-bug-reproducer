<?php
declare(strict_types=1);

use Composer\XdebugHandler\XdebugHandler;
use Symfony\Component\Console\Style\SymfonyStyle;
use Symfony\Component\Console\Input\ArgvInput;
use Symfony\Component\Console\Output\ConsoleOutput;

require __DIR__ . '/vendor/autoload.php';

$xdebugHandler = new XdebugHandler('APP');
$xdebugHandler->check();
unset($xdebugHandler);

$input = new ArgvInput();
$output = new ConsoleOutput();
$io = new SymfonyStyle($input, $output);

$io->success('Hello world!');