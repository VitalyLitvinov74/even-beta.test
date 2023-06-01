<?php
declare(strict_types=1);

namespace app\Tables;

use yii\db\ActiveQuery;
use yii\db\ActiveRecord;

/**
 * @property int id
 * @property int meal_id
 * @property int count
 * @property int price
 * @property int summary_price
 * @property MealsTable meal
 */
final class VisitorOrderItemsTable extends ActiveRecord
{
    public static function tableName(): string
    {
        return 'visitor_order_items';
    }

    public function getMeal(): ActiveQuery
    {
        return $this->hasOne(MealsTable::class, ['id'=>'meal_id']);
    }
}