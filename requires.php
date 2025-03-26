<?php
const DOCUMENT_ROOT = __DIR__;
function autoloadMainClasses($class_name): void
{
    $class_name = str_replace('\\', '/', $class_name) . '.php';
    $file = __DIR__ . '/'. $class_name;
    if (file_exists($file)) {
        include_once $file;
    }
}

spl_autoload_register('autoloadMainClasses');

require_once "vendor/autoload.php";
require_once "core/Helpers/helpers.php";
require_once "routes/routes.php";
