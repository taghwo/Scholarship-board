<?php

namespace App\Core\Concerns;

trait Arrayable
{
    public function toArray(): array
    {
        return get_object_vars($this);
    }
}
