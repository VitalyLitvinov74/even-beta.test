<?php
declare(strict_types=1);

namespace app\Tables;

use yii\db\ActiveRecord;

/**
 * @property int id
 * @property string visitor_id
 * @property int summary_price
 */
final class VisitorOrdersTable extends ActiveRecord
{
    public static function tableName(): string
    {
        return 'visitor_orders';
    }
}