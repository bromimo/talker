<?php

namespace core\Abstracts;

abstract class AbstractLog
{
    protected static ?string $filename = null;
    protected static ?string $folder   = null;

    /** Сохраняет данные в лог.
     * @param mixed $data
     * @return void
     */
    public static function info(mixed $data): void
    {
        self::cutlog();
        $data = is_string($data)
            ? self::trim($data)
            : json_encode($data, JSON_UNESCAPED_UNICODE | JSON_UNESCAPED_SLASHES);
        $msg = date(config('monolog.date_time_format'))
            . ' '
            . $data
            . PHP_EOL;
        self::save($msg);
    }

    /** Сохраняет отладочные данные в лог. Добавляет метку [label].
     * @param string $label
     * @param mixed  $data
     * @return void
     */
    public static function debug(string $label, mixed $data): void
    {
        self::cutlog();
        $data = is_string($data)
            ? self::trim($data)
            : json_encode($data, JSON_UNESCAPED_UNICODE | JSON_UNESCAPED_SLASHES);
        $msg = date(config('monolog.date_time_format'))
            . " [$label] "
            . $data
            . PHP_EOL;
        self::save($msg);
    }

    private static function save(string $msg): void
    {
        @file_put_contents(self::getLogPath(), $msg, FILE_APPEND | LOCK_EX);
    }

    private static function cutlog(): void
    {
        $max_log_size = config('monolog.max_log_size');
        $path = self::getLogPath();
        clearstatcache();
        if (file_exists($path)) {
            if (filesize($path) > $max_log_size * 2) {
                unlink($path);

                return;
            }
            if (filesize($path) > $max_log_size && $file = file($path)) {
                $new_file = array_slice($file, intdiv(count($file), 2));
                file_put_contents($path, implode(PHP_EOL, $new_file), LOCK_EX);
            }
        }
    }

    private static function trim(string $data): string
    {
        $decode = json_decode($data);

        return !is_null($decode) ? json_encode($decode, JSON_UNESCAPED_UNICODE | JSON_UNESCAPED_SLASHES) : $data;
    }

    private static function getLogPath(): string
    {
        $folder = static::$folder ?? env('CFG_LOGS_FOLDER', '/logs');
        $file_name = static::$filename ?? config('monolog.file_name');

        return DOCUMENT_ROOT . $folder . '/' . $file_name;
    }
}