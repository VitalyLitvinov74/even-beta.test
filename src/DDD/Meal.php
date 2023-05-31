<?php
declare(strict_types=1);

namespace app\Domain;

final class Meal
{
    public function __construct(private string $name, private int $price)
    {
    }

    public function price(): int
    {
        return $this->price;
    }

    public function name(): string
    {
        return $this->name;
    }
}