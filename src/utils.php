<?php

spl_autoload_register(function (string $classname) {
    include_once(__DIR__ . '/' . str_replace('\\', '/', $classname) . '.php');
});

function printMessage(string $message, array $messageParameters = []): void
{
    echo strtr($message . "\n", $messageParameters);
}
