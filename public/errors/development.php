<?php declare(strict_types=1);

/**
 * @var \wfm\ErrorHandler $errno
 * @var \wfm\ErrorHandler $errstr
 * @var \wfm\ErrorHandler $errfile
 * @var \wfm\ErrorHandler $errline
 */
?>
<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Ошибка</title>
</head>
<body>

<h1>Произошла ошибка</h1>
<p><b>Код ошибки:</b> <?php echo $errno; ?></p>
<p><b>Текст ошибки:</b> <?php echo $errstr; ?></p>
<p><b>Файл, в котором произошла ошибка:</b> <?php echo $errfile; ?></p>
<p><b>Строка, в которой произошла ошибка:</b> <?php echo $errline; ?></p>

</body>
</html>
