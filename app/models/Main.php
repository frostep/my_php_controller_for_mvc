<?php

declare(strict_types=1);

namespace app\models;

use RedBeanPHP\R;

class Main extends AppModel
{
    public function get_names(): array
    {
        return R::findAll('name');
    }
}
