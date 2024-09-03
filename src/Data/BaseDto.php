<?php

namespace App\Data;

use App\Entity\BaseEntity;
use App\Repository\Data\LengthAwarePaginator;

abstract class BaseDto
{
    public static function collection(mixed $collection): array
    {
        $paginatedData = $collection instanceof LengthAwarePaginator;

        $preparedData = array_map(
            fn (BaseEntity $datum) => static::from($datum->toArray()), $paginatedData ? $collection->getData() : $collection
        );

        if (!$paginatedData) {
            return $preparedData;
        }

        $collection->setData($preparedData);

        return $collection->toArray();
    }

    public static function from(array $payload): self
    {
        return new static(...self::normalizeArray($payload));
    }

    private static function normalizeArray(array $data): array
    {
        $defaults = get_class_vars(static::class);
        $filteredData = array_intersect_key($data, $defaults);

        return array_merge($defaults, $filteredData);
    }
}
