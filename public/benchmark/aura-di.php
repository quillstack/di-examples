<?php

use Aura\Di\ContainerBuilder;
use DependencyInjectionExample\ExampleController;

require __DIR__ . '/../../vendor/autoload.php';

$start = microtime(true);

$container = (new ContainerBuilder())->newInstance();

for ($i = 0; $i < ExampleController::LOOPS; ++$i) {
    $controller = $container->lazyGet(ExampleController::class);
}

$time = microtime(true) - $start;
$roundedTime = round($time, 6);

$results = [
    'time' => $roundedTime,
    'memory' => memory_get_peak_usage()/1024/1024,
    'files' => count(get_included_files()),
];

echo json_encode($results, JSON_PRETTY_PRINT);
