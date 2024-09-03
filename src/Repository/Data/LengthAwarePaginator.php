<?php

namespace App\Repository\Data;

use App\Core\Contracts\Arrayable;

class LengthAwarePaginator implements Arrayable
{
    use \App\Core\Concerns\Arrayable;
    public function __construct(
        private array $data,
        private MetaData $meta,
    ) {
    }

    public function getMeta(): MetaData
    {
        return $this->meta;
    }

    public function setMeta(MetaData $meta): void
    {
        $this->meta = $meta;
    }

    public function getData(): array
    {
        return $this->data;
    }

    public function setData(array $data): void
    {
        $this->data = $data;
    }
}
