<?php

declare(strict_types=1);

namespace wfm;

trait TSingleton
{
    private static ?self $instance = null;

    private function __construct()
    {
    }

    public static function getInstance(): static
    {
        return static::$instance ?? static::$instance = new static();
    }
}
