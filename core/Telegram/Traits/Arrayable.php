<?php

namespace core\Telegram\Traits;

trait Arrayable
{
    public function toArray(): array
    {
        return array_filter(
            $this->mapValue(get_object_vars($this)),
            static fn($value) => $value !== null
        );
    }

    private function mapValue(mixed $value): mixed
    {
        if ($value instanceof self) {
            return $value->toArray();
        }

        if (is_object($value) && method_exists($value, 'toArray')) {
            return $value->toArray();
        }

        if (is_array($value)) {
            return array_map(fn($item) => $this->mapValue($item), $value);
        }

        return $value;
    }
}