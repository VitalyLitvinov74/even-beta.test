<?php
declare(strict_types=1);

namespace app\Domain;

use app\Tables\MealsTable;

final class Meal implements PersistInterface
{
    public static function restoreByName(string $name): self
    {
        /** @var MealsTable $meal */
        $meal = MealsTable::find()->where(['id' => $name])->one();
        return new self($meal->name, $meal->price);
    }

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

    /**
     * как правило отличительно особенностью блюда является его имя, имя ему служит идентификатором
     * @return MealsTable
     */
    public function persist(): MealsTable
    {
        /** @var MealsTable $record */
        $record = MealsTable::find()->where(['price' => $this->price, 'name' => $this->name])->one();
        if (null === $record) {
            $record = new MealsTable();
            $record->name = $this->name;
            $record->price = $this->price;
        }
        $record->save();
        return $record;
    }
}