<?php

declare(strict_types=1);

namespace wfm;

class App
{
    public static $app;

    public function __construct()
    {
        $query = trim(urldecode($_SERVER['REQUEST_URI']), '/');
        new ErrorHandler();

        self::$app = Registry::getInstance();

        $this->getParams();

        Router::dispatch($query);
    }

    protected function getParams(): void
    {
        $params = require_once CONFIG.'/params.php';

        $params ? array_map(fn ($k, $v) => self::$app->setProperty($k, $v), array_keys($params), $params) : null;
    }
}
