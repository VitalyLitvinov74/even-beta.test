<?php
declare(strict_types=1);

namespace app\Tables;

use lhs\Yii2SaveRelationsBehavior\SaveRelationsBehavior;
use yii\db\ActiveQuery;
use yii\db\ActiveRecord;

/**
 * @property int id
 * @property string name
 * @property string uuid
 * @property CafeMenuTable cafeMenu
 */
final class CooksTable extends ActiveRecord
{
    public function behaviors(): array
    {
        return [
            [
                'class' => SaveRelationsBehavior::class,
                'relations' => [
                    'cafeMenu'
                ]
            ]
        ];
    }

    public function rules(): array
    {
        return [
            ['cafeMenu', 'safe']
        ];
    }

    public static function tableName(): string
    {
        return 'cooks';
    }

    public function getCafeMenu(): ActiveQuery
    {
        return $this
            ->hasOne(CafeMenuTable::class, ['id' => 'cafe_menu_id'])
            ->viaTable('cook_cafe_menu', ['cook_id' => 'id']);
    }
}