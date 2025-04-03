<?php

use core\SQL\SQL;

function q($sql, $params, $prefixable = false)
{
    return SQL::queryAll($sql, $params, $prefixable);
}

function q1($sql, $params, $prefixable = false)
{
    return SQL::queryFirst($sql, $params, $prefixable);
}

function qi($sql, $params, $prefixable = false)
{
    return SQL::queryInsert($sql, $params, $prefixable);
}

function dq($sql, $params, $prefixable = false)
{
    return SQL::debugQuery($sql, $params, $prefixable);
}

function ddq($sql, $params, $prefixable = false)
{
    dd(SQL::debugQuery($sql, $params, $prefixable));
}

function qInsertId()
{
    return SQL::qInsertId();
}

if (!function_exists('d')) {
    /** Dump.
     * @param mixed $content
     * @return void
     */
    function d(mixed $content): void
    {
        echo '<pre>';
        print_r($content);
        echo '</pre>';
    }
}

if (!function_exists('dd')) {
    /** Dump&Die.
     * @param mixed $content
     * @return void
     */
    function dd(mixed $content): void
    {
        d($content);
        die();
    }
}

if (!function_exists('config')) {
    /** Возвращает настройки из конфиг файлов.
     * @param string     $key
     * @param mixed|null $default
     * @return mixed
     */
    function config(string $key, mixed $default = null): mixed
    {
        $file_name = explode('.', $key)[0];
        $file_path = DOCUMENT_ROOT . '/config/' . $file_name . '.php';
        if (file_exists($file_path)) {
            $key = preg_replace('/^' . $file_name . '\./', '', $key);

            return get(include $file_path, $key, $default);
        }

        return $default;
    }
}

if (!function_exists('get')) {
    /** Возвращает значение из массива, используя точечную нотацию.
     * @param array       $array
     * @param string|null $key
     * @param mixed|null  $default
     * @return array
     */
    function get(array $array, ?string $key = null, mixed $default = null): mixed
    {
        if (is_null($key)) {
            return $array;
        }

        if (array_key_exists($key, $array)) {
            return $array[$key];
        }

        if (!str_contains($key, '.')) {
            return value($default);
        }

        foreach (explode('.', $key) as $segment) {
            if (is_array($array) && array_key_exists($segment, $array)) {
                $array = $array[$segment];
            } else {
                return value($default);
            }
        }

        return $array;
    }
}

if (!function_exists('value')) {
    /** Возвращает дефолтное значение.
     * @param $value
     * @param ...$args
     * @return mixed
     */
    function value($value, ...$args): mixed
    {
        return $value instanceof Closure ? $value(...$args) : $value;
    }
}

if (!function_exists('env')) {

    function env(string $key, mixed $default = null): mixed
    {
        $file_path = DOCUMENT_ROOT . '/.env';
        foreach (get_file_lines($file_path) as $value) {
            if (str_starts_with($value, '#')) {
                continue;
            }
            if (preg_match('/^' . $key . '=/', $value)) {
                $result = preg_replace('/^' . $key . '=/', '', $value);

                return unwrap('"', $result);
            }
        }

        return $default;
    }
}

if (!function_exists('get_file_lines')) {
    /** Читает построчно файл.
     * @param string $file_path
     * @return Generator|null
     */
    function get_file_lines(string $file_path): ?Generator
    {
        if (!file_exists($file_path)) {
            return null;
        }
        $file = fopen($file_path, 'r');
        while (!feof($file)) {
            yield fgets($file);
        }
        fclose($file);
    }
}

if (!function_exists('unwrap')) {
    /** Убирает обертку строки заданным символом.
     * @param string $symbol
     * @param string $string
     * @return string
     */
    function unwrap(string $symbol, string $string): string
    {
        if (empty($string)) {
            return $string;
        }

        $arr = mb_str_split(trim($string));
        if (isset($arr[0]) && $arr[0] === $symbol && $arr[count($arr) - 1] === $symbol) {
            unset($arr[count($arr) - 1]);
            unset($arr[0]);
        }

        return implode('', $arr);
    }
}

if (!function_exists('asset')) {
    /** Формирует url к указанному файлу в assets.
     * @param string $path
     * @return string
     */
    function asset(string $path): string
    {
        $uri = substr($_SERVER['REQUEST_URI'], 0, strrpos($_SERVER['REQUEST_URI'], '/'));
        return "https://{$_SERVER['HTTP_HOST']}{$uri}/assets/{$path}";
    }
}

if (!function_exists('quotes')) {
    /** Оборачивает в одинарные кавычки.
     * @param $data
     * @return string
     */
    function quotes($data): string
    {
        return "'" . $data . "'";
    }
}

if (!function_exists('spaces')) {
    /** Оборачивает в пробелы.
     * @param $data
     * @return string
     */
    function spaces($data): string
    {
        return " " . $data . " ";
    }
}