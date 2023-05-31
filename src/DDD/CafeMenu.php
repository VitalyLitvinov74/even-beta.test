<?php
declare(strict_types=1);

namespace app\Domain;

final class CafeMenu
{
    /**
     * @param Meal[] $meals
     */
    public function __construct(private array $meals)
    {
    }

    public function persist(): void
    {
        foreach ($this->meals as $meal){
            $meal->persist();
        }
    }
}