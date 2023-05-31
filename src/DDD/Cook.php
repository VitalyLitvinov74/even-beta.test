<?php
declare(strict_types=1);

namespace app\Domain;


use app\Tables\CookMealTable;
use app\Tables\CooksTable;
use app\Tables\MealsTable;

final class Cook implements PersistInterface
{
    /**
     * @var Meal[]
     */
    private array $preparedMeals;

    public static function restoreById(int $id): self
    {
        /** @var CooksTable $cookRecord */
        $cookRecord = CooksTable::find()
            ->where(['id'=>$id])
            ->one();
        return new self($cookRecord->name, $cookRecord->uuid);
    }

    public function __construct(private string $name, private string $uuid)
    {
    }

    public function makeADish(string $name, int $price): Meal
    {
        $meal = new Meal($name, $price);
        $this->preparedMeals[] = $meal;
        return $meal;
    }

    public function createAMenu(): CafeMenu
    {
        return new CafeMenu($this->preparedMeals);
    }

    public function persist(): void
    {

    }
}