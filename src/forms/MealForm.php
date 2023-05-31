<?php
declare(strict_types=1);

namespace app\forms;

use yii\base\Model;

final class MealForm extends Model
{
    public $name;
    public $price;
    public $cookId;

    public function rules(): array
    {
        return [
            [['name', 'price', 'cookId'], 'required']
        ];
    }
}