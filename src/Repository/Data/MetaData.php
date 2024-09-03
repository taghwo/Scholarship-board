<?php

namespace App\Repository\Data;

class MetaData
{
    public function __construct(
        public readonly int $page,
        public readonly int $pageCount,
        public readonly int $itemCount,
    ) {
    }
}
