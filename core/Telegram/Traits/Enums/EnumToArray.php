<?php

namespace App\Traits\Enums;

/**
 * Добавляет возможность получать варианты перечислений в виде списка (массива ключ-значение).
 */
trait EnumToArray
{
    /** Возвращает массив имен перечисления.
     * @return array<string>
     */
    public static function names(): array
    {
        return array_column(self::cases(), 'name');
    }

    /** Возвращает массив значений перечисления.
     * @return array<int|string>
     */
    public static function values(): array
    {
        return array_column(self::cases(), 'value');
    }

    /** Возвращает true, если указанное значение находится в перечислении.
     * @param mixed $value
     * @return bool
     */
    public static function hasValue(mixed $value): bool
    {
        return in_array($value, self::values());
    }

    /** Возвращает строку конкатенации значений перечисления.
     * @param string $separator
     * @return string
     */
    public static function implodedValues(string $separator = ','): string
    {
        return implode($separator, self::values());
    }

    /** Возвращает все лейблы перечисления.
     * @return array<string>
     */
    public static function labels(): array
    {
        /** @var array<string> $labels */
        $labels = collect(self::cases())->map(static fn ($case) => $case->label())->toArray();

        return $labels;
    }

    /** Возвращает ассоциативный массив в формате "значение => имя".
     * @param bool $useLabels
     * @return array<int|string, string>
     */
    public static function toArray(bool $useLabels = false): array
    {
        return array_combine(self::values(), $useLabels ? self::labels() : self::names());
    }

    /** Метка элемента перечисления (по умолчанию имя).
     * @return string
     */
    public function label(): string
    {
        return $this->name;
    }
}
