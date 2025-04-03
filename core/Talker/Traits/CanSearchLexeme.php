<?php

namespace core\Talker\Traits;

use Generator;

trait CanSearchLexeme
{
    /** Разбивает строку на лексемы.
     * @param string $text
     * @param string $tokens
     * @return Generator
     */
    public function getLexemes(string $text, string $tokens = ' :|,!?'): Generator
    {
        $lexeme = strtok($text, $tokens);
        while ($lexeme !== false) {
            yield $lexeme;
            $lexeme = strtok($tokens);
        }
    }

    /** Проверяет, есть ли вхождение лексемы в массиве.
     * @param array  $haystack
     * @param string $text
     * @return bool
     */
    public function arraySearch(array $haystack, string $text): bool
    {
        return $this->arraySearchKey($haystack, $text) !== null;
    }

    /** Возвращает ключ массива при вхождении.
     * @param array  $haystack
     * @param string $text
     * @return string|int|null
     */
    public function arraySearchKey(array $haystack, string $text): string|int|null
    {
        foreach ($this->getLexemes($text) as $lexeme) {
            $key = array_search(mb_strtolower($lexeme), $haystack, true);
            if ($key !== false) {
                return $key;
            }
        }

        return null;
    }
}