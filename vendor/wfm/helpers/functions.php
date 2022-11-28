<?php

declare(strict_types=1);

function debug($data, $die = false): void
{
    echo '<pre>'.print_r($data, true).'</pre>';
    if ($die) {
        exit;
    }
}

function h($str)
{
    return htmlspecialchars($str);
}
