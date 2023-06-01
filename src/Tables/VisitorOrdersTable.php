<?php
declare(strict_types=1);

namespace app\Tables;

use lhs\Yii2SaveRelationsBehavior\SaveRelationsBehavior;
use yii\db\ActiveQuery;
use yii\db\ActiveRecord;

/**
 * @property int id
 * @property string $visitor_uuid
 * @property int summary_price
 * @property VisitorOrderItemsTable[] items
 */
final class VisitorOrdersTable extends ActiveRecord
{
    public static function tableName(): string
    {
        return 'visitor_orders';
    }

    public function behaviors(): array
    {
        return [
            [
                'class' => SaveRelationsBehavior::class,
                'relations' => [
                    'items'
                ]
            ]
        ];
    }

    public function rules(): array
    {
        return [
            ['items', 'safe']
        ];
    }

    public function getItems(): ActiveQuery
    {
        return $this
            ->hasMany(VisitorOrderItemsTable::class,['id' => 'item_id'])
            ->viaTable('order_items_links', ['order_id' => 'id']);
    }
}