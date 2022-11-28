<?php

declare(strict_types=1);

namespace wfm;

class ErrorHandler
{
    public function __construct()
    {
        if (DEBUG) {
            error_reporting(-1); // добавить все php ошибки
        } else {
            error_reporting(0);
        }
        set_exception_handler([$this, 'exceptionHandler']);
        set_error_handler([$this, 'errorHandler']);
        ob_start();
        register_shutdown_function([$this, 'fatalErrorHandler']);
    }

    public function fatalErrorHandler(): void
    {
        $error = error_get_last();
        if (!empty($error) && $error['type'] & (E_ERROR | E_PARSE | E_COMPILE_ERROR |
            E_CORE_ERROR)) {
            $this->logError($error['message'], $error['file'], $error['line']);
            ob_end_clean();
            $this->displayError(
                $error['type'],
                $error['message'],
                $error['file'],
                $error['line']
            );
        } else {
            ob_end_flush();
        }
    }

    public function errorHandler($errno, $errstr, $errfile, $errline): void
    {
        $this->logError($errstr, $errfile, $errline);
        $this->displayError($errno, $errstr, $errfile, $errline);
    }

    public function exceptionHandler(\Throwable $e): void
    {
        $this->logError($e->getMessage(), $e->getFile(), $e->getLine());
        $this->displayError('Исключение', $e->getMessage(), $e->getFile(), $e->getLine(), $e->getCode());
    }

    protected function logError($message = '', $file = '', $line = ''): void
    {
        file_put_contents(
            LOGS.'/errors.log',
            '['.date('Y-m-d H:i:s')."] Текст ошибки {$message} | Файл {$file}
		| Строка: {$line}\n===================================================================================\n",
            FILE_APPEND
        );
    }

    protected function displayError($errno, $errstr, $errfile, $errline, $responce = 500): void
    {
        if (0 == $responce) {
            $responce = 404;
        }
        http_response_code($responce);

        if (404 == $responce && !DEBUG) {
            require_once WWW.'/errors/404.php';

            exit;
        }

        if (DEBUG) {
            require_once WWW.'/errors/development.php';
        } else {
            require_once WWW.'/errors/production.php';
        }

        exit;
    }
}
