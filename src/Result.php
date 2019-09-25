<?php

declare(strict_types = 1);

namespace App\Test;


class Result
{
    private $data = [];

    public function add(string $name, $value): Result
    {
        $this->data[$name] = $value;

        return $this;
    }

    public function toArray(): array
    {
        return $this->data;
    }
}