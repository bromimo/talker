<?php

namespace core\Abstracts;

abstract class Singleton
{
    private static array $instances = [];

    protected function __construct() {}
    protected function __clone() {}
    public function __wakeup()
    {
        throw new \Exception("Cannot unserialize a singleton.");
    }

    public static function getInstance()
    {
        $class = static::class;
        if (!isset(self::$instances[$class])) {
            self::$instances[$class] = new static();
        }
        return self::$instances[$class];
    }
}