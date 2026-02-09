<?php
declare(strict_types=1);

$config = require __DIR__ . '/../config.php';
date_default_timezone_set($config['timezone'] ?? 'Europe/Paris');

require __DIR__ . '/../app/bootstrap.php';

use App\Router;

$router = new Router($config);
$router->dispatch();
