<?php
declare(strict_types=1);

namespace app\Tables;

use yii\db\ActiveRecord;

/**
 * @property int $id
 */
final class CafeMenuTable extends ActiveRecord
{
    public static function tableName(): string
    {
        return 'cafe_menu';
    }
}