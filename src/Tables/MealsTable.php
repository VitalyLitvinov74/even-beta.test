<?php
declare(strict_types=1);

namespace app\Tables;

use yii\db\ActiveRecord;

/**
 * @property int id
 * @property string name
 * @property int price
 */
final class MealsTable extends ActiveRecord
{
    public static function tableName(): string
    {
        return 'meals';
    }
}