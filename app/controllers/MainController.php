<?php

declare(strict_types=1);

namespace app\controllers;

use app\models\Main;
use RedBeanPHP\R;

/** @property Main $model */
class MainController extends AppController
{
    public function indexAction(): void
    {
        $slides = R::findAll('slider');
        $this->set(compact('slides'));
    }
}
