<?php

namespace core\SQL;

use PDO;
use Exception;
use PDOException;

class SQL
{
    /** @var string Имя поля, отвечающего за дату изменения данных в таблице. */
    const UPDATE_AT_FIELD = 'updated_at';
    /** @var array Имена таблиц, в которых необходимо логировать дату обновления записей. */
    const UPDATABLE_TABLES = [];
    private static ?PDO $dbConnection = null;
    /** @var string Префикс таблиц. */
    private static string $tablePrefix = "";

    private static function initDB(): void
    {
        if (!self::$dbConnection) {
            try {
                self::$tablePrefix = env('DB_TABLE_PREFIX', "");
                self::$dbConnection = new PDO(
                    sprintf("mysql:host=%s;dbname=%s;charset=utf8mb4", env('DB_HOST'), env('DB_DATABASE')),
                    env('DB_USERNAME'),
                    env('DB_PASSWORD'),
                    [
                        PDO::ATTR_ERRMODE          => PDO::ERRMODE_EXCEPTION,
                        PDO::ATTR_EMULATE_PREPARES => false
                    ]
                );
                self::$dbConnection->exec("SET time_zone = '+00:00'");
            } catch (PDOException $e) {
                throw new Exception("Database connection failed: " . $e->getMessage());
            }
        }
    }

    private static function applyTablePrefix(string $sql): string
    {
        return preg_replace_callback(
            "/(\bFROM|JOIN|UPDATE|INSERT INTO|DELETE FROM\b)\s+([`'\"]?)(\w+)\\2/i",
            function ($matches) {
                return $matches[1] . ' ' . $matches[2] . self::$tablePrefix . $matches[3] . $matches[2];
            },
            $sql
        );
    }

    private static function parseBoundArrays(string $sql, array $params, bool $prefixable = false)
    {
        if ($prefixable) {
            $sql = self::applyTablePrefix($sql);
        }
        foreach ($params as $key => $value) {
            if (is_array($value)) {
                if (!preg_match("/^[a-zA-Z0-9_]+$/", $key)) {
                    throw new Exception("Invalid parameter name: '{$key}'");
                }
                $placeholders = [];
                foreach ($value as $i => $val) {
                    $newKey = "{$key}_{$i}";
                    $params[$newKey] = $val;
                    $placeholders[] = ":{$newKey}";
                }
                unset($params[$key]);
                $sql = preg_replace("/:{$key}\b/", implode(", ", $placeholders), $sql);
            }
        }

        return [$sql, $params];
    }

    private static function fillUpdatableFields(string &$sql): void
    {
        foreach (self::UPDATABLE_TABLES as $table) {
            $table = self::$tablePrefix . $table;
            if (stripos($sql, "UPDATE {$table}") !== false && stripos($sql, self::UPDATE_AT_FIELD) === false) {
                $date = date('Y-m-d H:i:s');
                $sql = preg_replace("/(UPDATE {$table} SET )/i", "$1" . self::UPDATE_AT_FIELD . " = '{$date}', ", $sql, 1);
            }
        }
    }

    /** Возвращает массив результатов запроса к БД.
     * @param string $sql
     * @param array  $params
     * @param bool   $prefixable
     * @return array
     * @throws Exception
     */
    public static function queryAll(string $sql, array $params = [], bool $prefixable = false): array
    {
        return self::executeQuery($sql, $params, true, $prefixable);
    }

    /** Возвращает первую строку результата запроса.
     * @param string $sql
     * @param array  $params
     * @param bool   $prefixable
     * @return array|null
     * @throws Exception
     */
    public static function queryFirst(string $sql, array $params = [], bool $prefixable = false): ?array
    {
        return self::executeQuery($sql, $params, false, $prefixable);
    }

    /** Выполняет INSERT или UPDATE.
     * @param string $sql
     * @param array  $params
     * @param bool   $prefixable
     * @return bool Возвращает true в случае удачной вставки или обновления.
     *              Возвращает false если вставка не производилась или обновляемое
     *              поле уже имело данное значение и фактически обновление не производилось.
     * @throws Exception
     */
    public static function queryInsert(string $sql, array $params = [], bool $prefixable = false): bool
    {
        return self::executeQuery($sql, $params, false, $prefixable, function (&$sql) {
            self::fillUpdatableFields($sql);
        });
    }

    private static function executeQuery(
        string   $sql,
        array    $params,
        bool     $fetchAll = false,
        bool     $prefixable = false,
        callable $modifier = null)
    {
        try {
            self::initDB();
            [$sql, $params] = self::parseBoundArrays($sql, $params, $prefixable);

            if ($modifier) {
                $modifier($sql);
            }

            $stmt = self::$dbConnection->prepare($sql);
            $stmt->execute($params);

            return $fetchAll ? $stmt->fetchAll(PDO::FETCH_ASSOC) : $stmt->fetch(PDO::FETCH_ASSOC);
        } catch (PDOException $e) {
            self::$dbConnection = null;
            throw new Exception("Database query failed: " . $e->getMessage());
        }
    }

    /** Возвращает последнее присвоенное значение автоинкрементного поля.
     * @return string
     * @throws Exception
     */
    public static function qInsertId(): string
    {
        self::initDB();

        return self::$dbConnection->lastInsertId();
    }

    /** Возвращает текст запроса с подставленными параметрами.
     * @param string $sql
     * @param array  $params
     * @param bool   $prefixable
     * @return string
     * @throws Exception
     */
    public static function debugQuery(string $sql, array $params, bool $prefixable = false): string
    {
        self::initDB();
        [$sql, $params] = self::parseBoundArrays($sql, $params, $prefixable);
        $keys = [];
        foreach ($params as $key => $value) {
            if (is_string($key)) {
                $keys[] = '/:' . $key . '/';
            } else {
                $keys[] = '/[?]/';
            }
        }

        $sql = preg_replace($keys, $params, $sql, 1, $count);

        return $sql;
    }
}
