<?php

declare(strict_types=1);

namespace wfm;

abstract class Controller
{
    public array $data = []; // данные из модели
    public array $meta = ['title' => '', 'description' => '', 'keywords' => ''];
    public false|string $layout = ''; // шаблон
    public string $view = '';
    public object $model;

    public function __construct(public $route = [])
    {
    }

    public function getView(): void
    {
        $this->view = $this->view ?: $this->route['action'];
        (new View($this->route, $this->layout, $this->view, $this->meta))->render($this->data);
    }

    public function set($data): void
    {
        $this->data = $data;
    }

    public function setMeta($title = '', $description = '', $keywords = ''): void
    {
        $this->meta = [
            'title' => $title, 'description' => $description, 'keywords' => $keywords,
        ];
    }

    public function getModel(): void
    {
        $model = 'app\models\\'.$this->route['admin_prefix'].$this->route['controller'];
        if (class_exists($model)) {
            $this->model = new $model();
        }
    }
}
