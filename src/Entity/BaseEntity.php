<?php

namespace App\Entity;

use App\Core\Contracts\Arrayable;

abstract class BaseEntity implements Arrayable
{
    use \App\Core\Concerns\Arrayable;
}
