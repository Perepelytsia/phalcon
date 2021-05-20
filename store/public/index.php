<?php
declare(strict_types=1);

use Phalcon\Di\FactoryDefault;

error_reporting(E_ALL);

define('BASE_PATH', dirname(__DIR__));
define('APP_PATH', BASE_PATH . '/app');

try {
    $di = new FactoryDefault();
    include APP_PATH . '/config/services.php';

    $router = $di->getRouter();
    $router->handle($_SERVER['REQUEST_URI']);

    $config = $di->getConfig();
    $loader = new \Phalcon\Loader();
    $loader->registerDirs([$config->application->controllersDir, $config->application->modelsDir])->register();

    $application = new \Phalcon\Mvc\Application($di);
    echo $application->handle($_SERVER['REQUEST_URI'])->getContent();

} catch (\Exception $e) {
    echo $e->getMessage() . '<br>';
    echo '<pre>' . $e->getTraceAsString() . '</pre>';
}
