<?php

declare(strict_types=1);

namespace app\controllers;

use wfm\Controller;

class AppController extends Controller
{
    public function __construct($route = [])
    {
        parent::__construct($route);
    }
}
